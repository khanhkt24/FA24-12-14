<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cats = Category::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->limit(6)->get();
        return view('Client.home', compact('cats', 'products'));
    }

    public function indexLayout()
    {
        $cats = Category::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->paginate(1);
        return view('Client.shop', compact('cats', 'products'));
    }

    Public function product(String $id){

        $cats = Category::orderBy('name', 'ASC')->get();
        $product = Product::with('bienthe')->findOrFail($id);
        return view('Client.detail',compact('product','cats'));
    }

}
