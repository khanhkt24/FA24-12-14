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
    public function index(Request $request)
{
    // Lấy các giá trị lọc từ request
    $searchOrder = $request->get('searchOrder');
    $giaohang = $request->get('giaohang');
    $thanhtoan = $request->get('thanhtoan');


    $query = Order::query();

    if ($searchOrder) {
        $query->where('order_code', 'like', '%' . $searchOrder . '%');
    }


    if ($giaohang && $giaohang !== 'all') {
        $query->where('giaohang', $giaohang);
    }

   
    if ($thanhtoan && $thanhtoan !== 'all') {
        $query->where('thanhtoan', $thanhtoan);
    }

  
    $statuses = [
        '0' => Order::TYPE_0,
        '1' => Order::TYPE_1, 
        '2' => Order::TYPE_2,  
        '3' => Order::TYPE_3,  
    ];

    $data = $query->with('customer')->paginate(10);

    return view('admin.order.index', compact('data', 'statuses'));
}

    
    public function updateStatus(Request $request, $id)
    {

        $order = Order::findOrFail($id);

        if (!array_key_exists($request->giaohang, Order::getGiaoHangStatuses())) {
            return back()->with('error', 'Trạng thái không hợp lệ.');
        }

       
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
        $data = ProOrder::query()->where('order_id', $order->id)->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'order', 'date'));
    }
    public function updated(Request $request, $id)
    {
        order::query()->where('id', $id)->update(['giaohang' => $request->giaohang]);

        
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
}
