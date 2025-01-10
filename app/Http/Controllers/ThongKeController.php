<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    
    
public function thongke()
{
    // Thống kê người dùng
    $totalUsers = User::count();
    $newUsers = User::whereDate('created_at', today())->count();
    
    // Thống kê đơn hàng
    $totalOrders = Order::count();
    $newOrders = Order::whereDate('created_at', today())->count();
    $totalRevenue = Order::sum('total');
    
    // Thống kê sản phẩm
    $totalProducts = Product::count();
    $newProducts = Product::whereDate('created_at', today())->count();
    
    // Biểu đồ doanh thu (theo ngày)
    $revenueData = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as revenue'))
                        ->groupBy(DB::raw('DATE(created_at)'))
                        ->orderBy('date', 'asc')
                        ->get();
    
    return view('admin.thongke.index', compact(
        'totalUsers', 'newUsers', 'totalOrders', 'newOrders', 'totalRevenue', 'totalProducts', 'newProducts', 'revenueData'
    ));
}

  
}
