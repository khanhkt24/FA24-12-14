<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProOrder;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin/order.';
    public function index()
    {
        $statuses = [
            '0'  => Order::TYPE_0,  // 'Đang xác nhận'
            '1'  => Order::TYPE_1,  // 'Đang vận chuyển'
            '2'  => Order::TYPE_2,  // 'Đã giao hàng'
            '3'  => Order::TYPE_3,  // 'Đã bị hủy'
        ];
        $data = Order::with('customer')->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function updateStatus(Request $request, $id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);

        // Kiểm tra xem giá trị cập nhật có hợp lệ không
        if (!array_key_exists($request->giaohang, Order::getGiaoHangStatuses())) {
            return back()->with('error', 'Trạng thái không hợp lệ.');
        }

        // Cập nhật trạng thái giao hàng
        $order->giaohang = $request->giaohang;
        $order->save();

        return redirect()->route('order.index')->with('success', 'Trạng thái giao hàng đã được cập nhật!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $date = $order->created_at->format('Y-m-d');
        $data = ProOrder::query()->where('id_order', $order->id)->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'order', 'date'));
    }
    public function updated(Request $request, $id)
    {
        order::query()->where('id', $id)->update(['giaohang' => $request->giaohang]);

        // Cập nhật chỉ các trường cần thiết

        // Chuyển hướng về danh sách đơn hàng với thông báo thành công
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function checkout(Request $request)
{
    if ($request->payment_method == 'vnpay') {
        return redirect()->route('vnpay.payment', ['amount' => $request->total_amount]);
    }

    // Xử lý thanh toán COD
    $order = $this->saveOrder($request); // Hàm xử lý lưu đơn hàng
    return redirect()->route('order.success');
}

}
