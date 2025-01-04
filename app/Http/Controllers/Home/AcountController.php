<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Mail\VerifyAcount;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AcountController extends Controller
{
    public function login()
    {
        $cats = Category::orderBy('name', 'ASC')->get();

        return view('Client.account.login',compact('cats'));
    }

    public function check_login()
    {
        return view('Client.account.login');
    }

    public function register()
    {
        $cats = Category::orderBy('name', 'ASC')->get();

        // if($acc = Customer::create($data)){
        //     Mail::to($acc->email)->send(new VerifyAcount($acc));
        // }
        return view('Client.account.register', compact('cats'));
    }

    public function check_register(Request $req)
    {
        $req->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|min:2|max:100|unique:customers',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',

        ], [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ]);
        $data = $req->only([
            'name',
            'email',
            'phone',
            'address',
            'gender',
        ]);
        $data['password'] = bcrypt($req->password);

        if ($acc = Customer::create($data)) {

            if ($acc->email) {
                Mail::to($acc->email)->send(new VerifyAcount($acc));
                return redirect()->route('acount.login')->with('success','Hãy check gmail của bạn để kích hoạt tài khoản!');

            } else {
                return back()->with('error','Gmail này ko tồn tại');

            }
        } else {
            return back()->with('error','Gmail này ko tồn tại');
        }
    }

    public function verify($email)
    {
        $acc = Customer::where('email',$email)->whereNull('email_verified_at')->firstOrFail();

        Customer::where('email',$email)->update(['email_verified_at'=>date('Y-m-d')]);
        return redirect()->route('acount.login')->with('success','kích hoạt tài khoản thành công');

    }
    public function profile()
    {
        return view('Client.account.profile');
    }

    public function check_profile()
    {
        return view('Client.account.profile');
    }

    public function change_password()
    {
        return view('Client.account.change_password');
    }

    public function check_change_password()
    {
        return view('Client.account.change_password');
    }

    public function reset_password()
    {
        return view('Client.account.reset_password');
    }

    public function check_reset_password()
    {
        return view('Client.account.reset_password');
    }
}
