<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProOrder;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $auth = auth('cus')->user();
        $cats = Category::orderBy('name', 'ASC')->get();
        return view('Client.checkout', compact('cats', 'auth'));
    }

    public function post_checkout(Request $request)
    {
        $auth = auth('cus')->user();

        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'thanhtoan' => 'required|string',
        ]);

        $order = Order::create([
            'customer_id' => $auth->id,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => 0,
            'ngaydathang' => now(),
            'giaohang' => Order::TYPE_1,
            'thanhtoan' => $request->thanhtoan,
        ]);

        $carts = Cart::where('customer_id', $auth->id)->get();

        $total = 0;

        foreach ($carts as $cart) {
            $proOrder = new ProOrder();
            $proOrder->order_id = $order->id;
            $proOrder->product_id = $cart->product_id;
            $proOrder->name_pro = $cart->product->name;
            $proOrder->img = $cart->product->img;
            $proOrder->price = $cart->price;
            $proOrder->color = $cart->color;
            $proOrder->size = $cart->size;
            $proOrder->quantity = $cart->quantity;
            $proOrder->total = $cart->quantity * $cart->price;

            $proOrder->save();

            $total += $proOrder->total;
        }

        $order->total = $total;
        $order->save();

        Cart::where('customer_id', $auth->id)->delete();

        return redirect()->route('client.thanku')->with('success', 'Đặt hàng thành công!');
    }
}
