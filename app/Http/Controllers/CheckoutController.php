<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout()
    {

        $auth = auth('cus')->user();
        $cats = Category::orderBy('name', 'ASC')->get();
        $carts = Cart::with(['product', 'bienthe'])->where('customer_id', auth('cus')->id())->get();
        // $proOrder = new ProOrder();
        // dd($proOrder);
        // dd($carts);
        // @dd(auth('cus')->id());
        return view('Client.checkout', compact('cats', 'auth', 'carts'));
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
            'giaohang' => Order::TYPE_0,
            'thanhtoan' => $request->thanhtoan,
            'order_code' => 'BILL-' . strtoupper(Str::random(10)),

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
            $proOrder->color = $cart->bienthe->color;
            $proOrder->size = $cart->bienthe->size;
            $proOrder->quantity = $cart->quantity;
            $proOrder->total = $cart->quantity * $cart->price;

            $proOrder->save();

            $total += $proOrder->total;
        }
        if ($request->payment_method == 'vnpay') {
            // Thực hiện redirect tới cổng thanh toán VNPay
            return redirect()->route('vnpay.payment', ['order_id' => $order->id]);
        }

        $order->total = $total;
        $order->save();

        Cart::where('customer_id', $auth->id)->delete();

        return redirect()->route('client.thanku')->with('success', 'Đặt hàng thành công!');
    }
    
    public function index()
    {
        $orders = Order::with('proOrder', 'customer')
            ->select('orders.*', 'payment_histories.status as payment_status')
            ->leftJoin('payment_histories', 'orders.order_code', '=', 'payment_histories.order_code')
            ->latest()->paginate(10);
        $cats = Category::orderBy('name', 'ASC')->get();
        if (!session()->has('orderCode')) {
            $orderCode = 'BILL-' . strtoupper(Str::random(10));
            session()->put('orderCode', $orderCode);
        } else {
            $orderCode = session('orderCode');
        }
        // dd($orders);
        return view('Client.donhang', compact('orders', 'cats', 'orderCode'));
    }
    public function detail($id)
    {
        // $products = ProOrder::with('product')->where('order_id', $id)->get();
        $orders = Order::with('proOrder', 'customer')->findOrFail($id);
        $cats = Category::orderBy('name', 'ASC')->get();
        $orderCode = 'BILL-' . strtoupper(Str::random(10));

        return view('Client.orderdetail', compact('orders', 'cats', 'orderCode'));
    }
    public function detail_payment($id)
    {
        $products = ProOrder::with('product')->where('order_id', $id)->get();
        $orders = Order::with('proOrder', 'customer')->findOrFail($id);
        $cats = Category::orderBy('name', 'ASC')->get();
        $orderCode = 'BILL-' . strtoupper(Str::random(10));

        return view('Client.orderdetailPayment', compact( 'orders','cats', 'orderCode', 'products'));
    }
    public function cancelOrder($id)
    {
        try {
            $order = Order::findOrFail($id);

            if ($order->giaohang == Order::TYPE_0) {

                $order->giaohang = Order::TYPE_3;
                $order->save();

                return redirect()->route('checkout.index')->with('success', 'Hủy đơn hàng thành công');
            }

            return redirect()->route('checkout.index')->with('error', 'Không thể hủy đơn hàng vì trạng thái không phải "Đang xác nhận".');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('checkout.index')->with('error', 'Đơn hàng không tồn tại.');
        } catch (\Exception $e) {
            return redirect()->route('checkout.index')->with('error', 'Đã xảy ra lỗi khi hủy đơn hàng.');
        }
    }
}
