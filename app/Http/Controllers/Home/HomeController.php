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

    public function cat()
    {
        $cats = Category::orderBy('name', 'ASC')->get();
        return view('Client.layouts.patials.navbar', compact('cats'));
    }
}
