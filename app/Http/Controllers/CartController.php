<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $cats = Category::orderBy('name', 'ASC')->get();
        $carts = Cart::with(['product', 'bienthe'])->where('customer_id', auth('cus')->id())->get();
        // dd($carts);
        return view('Client.cart', compact('cats','carts'));
    }


    public function add(Product $product, Request $request)
    {
        $bienthe_id = $request->input('bienthe_id');
        $quantity = $request->quantity ? $request->quantity : 1;
        $cus_id = auth('cus')->id();

        if (is_null($bienthe_id)) {
            return back()->with('error', 'Vui lòng chọn biến thể trước khi thêm vào giỏ hàng.');
        }

        $cartExist = Cart::where([
            'customer_id' => $cus_id,
            'product_id' => $product->id,
            'bienthe_id' => $bienthe_id
        ])->first();

        if ($cartExist) {
            Cart::where([
                'customer_id' => $cus_id,
                'product_id' => $product->id,
                'bienthe_id' => $bienthe_id
            ])->increment('quantity',$quantity);

            return redirect()->route('cart.index')->with('success', 'thêm sản phẩm vào giỏ hàng thành công');
        }else{
            $data = [
                'customer_id' => auth('cus')->id(),
                'product_id' => $product->id,
                'bienthe_id' => $bienthe_id,
                'price' => $product->sale ? $product->sale : $product->cost,
                'quantity' => $quantity
            ];
            if (Cart::create($data)) {
                return redirect()->route('cart.index')->with('success', 'thêm sản phẩm vào giỏ hàng thành công');
            }
        }


        return back()->with('error', 'thêm sản phẩm vào giỏ hàng không thành công, hãy thử lại!');
    }


    public function update(Request $request, Product $product)
    {
        //
    }

    public function delete($product, Request $request)
    {
        $cus_id = auth('cus')->id();

        $bienthe_id = $request->input('bienthe_id');

        $query = Cart::where('customer_id', $cus_id)
                      ->where('product_id', $product);

        if ($bienthe_id !== null) {
            $query->where('bienthe_id', $bienthe_id);
        }

        $deleted = $query->delete();

        if ($deleted) {
            return redirect()->route('cart.index')->with('success', 'Xóa sản phẩm thành công');
        } else {
            return redirect()->route('cart.index')->with('error', 'Không tìm thấy sản phẩm để xóa');
        }
    }

    public function clear()
    {
        //
    }
}
