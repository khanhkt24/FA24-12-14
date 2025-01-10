<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProOrder;
use App\Http\Requests\StoreProOrderRequest;
use App\Http\Requests\UpdateProOrderRequest;

class ProOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function checkout()
    {
        // $proOrders = ProOrder::with('product','order')->get();
        // dd($proOrders);
        // return view('Client.donhang',compact('proOrders'));
        $proOrders = ProOrder::with(['product','order'])->get();
        $cats = Category::orderBy('name', 'ASC')->get();
        return view('Client.donhang', compact('proOrders','cats'));

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
    public function store(StoreProOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProOrder $proOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProOrder $proOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProOrderRequest $request, ProOrder $proOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProOrder $proOrder)
    {
        //
    }
}
