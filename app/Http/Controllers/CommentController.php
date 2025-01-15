<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function binhluan(){
        $comment = Comment::with('product','customer')->get();
        // dd($comment);
        return view('admin.binhluan.index',compact('comment'));
    }
    public function delete($id)
{
    $comment = Comment::findOrFail($id);
    
    // Chuyển trạng thái của bình luận sang "ẩn" hoặc "hiện" nếu đã ẩn
    $comment->is_hidden = !$comment->is_hidden;
    $comment->save();

    return redirect()->back();
}
    public function create($orderId)
    {
        $order = Order::with('proOrder.product')->where('id', $orderId)->where('customer_id', auth('cus')->id())->firstOrFail();
        $cats = Category::orderBy('name', 'ASC')->get();
        return view('Client.comment', compact('order','cats'));
    }

    public function store(Request $request, $productId)
{
    // Xác thực dữ liệu nhập từ form
    $request->validate([
        'content' => 'required|string|max:500',
    ]);

    // Kiểm tra xem khách hàng đã mua sản phẩm này chưa
    $hasPurchased = Order::where('customer_id', auth('cus')->id())
        ->whereHas('proOrder', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        })
        ->exists();

    if (!$hasPurchased) {
        // Nếu khách hàng chưa mua sản phẩm, trả về trang trước đó với thông báo lỗi
        return back()->with('error', 'Bạn chỉ có thể bình luận nếu đã mua sản phẩm này.');
    }

    // Tạo bình luận mới
    Comment::create([
        'customer_id' => auth('cus')->id(),
        'product_id' => $productId,
        'content' => $request->content,
    ]);

    // Quay lại trang chi tiết sản phẩm và gửi thông báo thành công
    return redirect()->route('client.detail', $productId)->with('success', 'Bình luận của bạn đã được gửi.');
}

}
