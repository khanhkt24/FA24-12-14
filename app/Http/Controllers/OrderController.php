<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProOrder;
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
        $data = Order::query()->paginate(10);
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $date = $order->created_at->format('Y-m-d');
        $data = ProOrder::query()->where('id_order',$order->id)->get();
        return view(self::PATH_VIEW.__FUNCTION__,compact('data','order','date'));
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
