<?php

namespace App\Http\Controllers\Home;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $cats = Category::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->limit(6)->get();
        // dd($products);
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
        $comments = Comment::where('product_id', $id)->get();
        $bienthes = $product->bienthe;
        return view('Client.detail',compact('product','cats','comments','bienthes'));
    }
    public function contact(){
        $cats = Category::orderBy('name', 'ASC')->get();
        return view('client.contact',compact('cats'));
    }
    public function sendMail(){
        $name = request('name');
        $email = request('email');
        $body = request('body');
        Mail::to($email)->send(new ContactEmail($name,$email,$body));
        return redirect()->route('client.contact')->with('success','Đã gửi thành công vui lòng đợi trong giây lát!');
    }

}
