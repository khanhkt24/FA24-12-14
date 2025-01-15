<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.layouts.master');
    }


    public function login()
    {
        return view('admin.layouts.login');
    }

    public function check_login()
    {
        request()->validate([

        "email" => 'required|email|exists:users',

        "password" => 'required',

    ]);
        $data = request()->all('email', 'password');
        if(auth()->attempt($data)){
            $user = auth()->user();
            
            return redirect()->route('admin.thongke');
        }
        return redirect()->back();
    }

    public function register()
    {
        return view('admin.layouts.register');
    }

    public function check_register()
    {

        request()->validate([

            "name" => 'required',

            "email" => 'required|email|unique:users',

            "password" => 'required',

            "confirm_password" => 'required|same:password',

        ]);
        $data = request()->all('email', 'name');
        $data['password'] = bcrypt(request('password'));
        User::create($data);
        return redirect()->route('admin.login');
    }
    public function logout()
    {
        auth()->logout(); // Log out the authenticated user
        
        return redirect()->route('admin.login');
    }

}
