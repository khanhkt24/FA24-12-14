<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    
    
    public function thongke()
    {
        // Thống kê khách hàng
        $totalUsers = Customer::count();
        $newUsers = Customer::whereDate('created_at', today())->count();
        
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
    
        // Danh sách khách hàng đã mua từ 3 đơn trở lên
        $customers = Customer::select('customers.name', DB::raw('COUNT(orders.id) AS order_count'))
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->groupBy('customers.name')
            ->having('order_count', '>=', 3)
            ->get();
        // Lấy sản phẩm có doanh thu cao nhất theo loại
            // $topSellingProducts = Category::select('categories.id', 'categories.name')
            // ->with(['products' => function ($query) {
            //     $query->select('products.*', DB::raw('SUM(pro_orders.total) as revenue'))
            //         ->join('pro_orders', 'products.id', '=', 'pro_orders.product_id')
            //         ->groupBy('products.id', 'products.category_id')
            //         ->orderByDesc('revenue');
            // }])->get()->map(function ($category) {
            //     $category->top_product = $category->products->sortByDesc('revenue')->first();
            //     return $category;
            // });
            
            
        return view('admin.thongke.index', compact(
            'totalUsers', 'newUsers', 'totalOrders', 'newOrders', 'totalRevenue', 
            'totalProducts', 'newProducts', 'revenueData', 'customers'
        ));
    }
    

  
}
