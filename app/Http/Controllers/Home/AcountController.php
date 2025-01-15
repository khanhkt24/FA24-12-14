<?php

namespace App\Http\Controllers\Home;


use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Customer;
use App\Mail\VerifyAcount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Notifications\Messages\MailMessage;

class AcountController extends Controller
{
    public function login()
    {
        $cats = Category::orderBy('name', 'ASC')->get();

        return view('Client.account.login',compact('cats'));
    }

    public function logout()
    {
        auth('cus')->logout();
        return redirect()->route('client.home')->with('success','bạn đã đăng xuất khỏi tài khoản');
    }
    public function check_login(Request $req)
    {
        $req->validate([
            'email' => 'required|exists:customers',
            'password' => 'required|min:8',
        ]);
        $data = $req->only(
            'email',
            'password',
        );
        $check = auth('cus')->attempt($data);

        if($check){
            if(auth('cus')->user()->email_verified_at == ''){
                auth('cus')->logout();
                return redirect()->back()->with('error','Hãy xem lại email của bạn tài khoản chưa kích hoạt!');
            };
            return redirect()->route('client.home')->with('success','chào mừng bạn quay lại');
        }

        return redirect()->back()->with('error','Mật khẩu hoặc tài khoản ko hợp lệ');
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
        $cats = Category::orderBy('name', 'ASC')->get();
        return view('Client.account.reset_password',compact('cats'));
    }

    // public function check_reset_password()
    // {
    //     return view('Client.account.reset_password');
    // }
    public function send_reset_link(Request $req)
{
    // Validate email
    $req->validate([
        'email' => 'required|email|exists:customers,email',
    ]);

    // Tạo token ngẫu nhiên
    $token = Str::random(60);

    // Tìm khách hàng và cập nhật token
    $customer = Customer::where('email', $req->email)->first();

    // Đặt token và thời gian hết hạn (60 phút)
    $customer->password_reset_token = $token;
    $customer->password_reset_expires_at = Carbon::now()->addMinutes(60); 
    $customer->save();

    // Gửi email chứa link reset mật khẩu
    Mail::to($customer->email)->send(new ResetPasswordMail($token, $customer->email));

    // Thông báo thành công
    return redirect()->route('password.request')->with('success', 'Chúng tôi đã gửi link đặt lại mật khẩu vào email của bạn.');
}

public function update_password(Request $req)
{
    // Validate form input
    $req->validate([
        'email' => 'required|email',
        'token' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    // Kiểm tra tính hợp lệ của token và email
    $customer = Customer::where('email', $req->email)
                        ->where('password_reset_token', $req->token)
                        ->where('password_reset_expires_at', '>', Carbon::now())
                        ->first();

    // Nếu không tìm thấy customer hợp lệ hoặc token hết hạn
    if (!$customer) {
        return back()->withErrors(['email' => 'Token không hợp lệ hoặc đã hết hạn.']);
    }

    // Cập nhật mật khẩu mới
    $customer->password = Hash::make($req->password);
    $customer->password_reset_token = null; // Xóa token để tránh việc sử dụng lại
    $customer->password_reset_expires_at = null; // Xóa thời gian hết hạn token
    $customer->save();

    // Chuyển hướng về trang login với thông báo thành công
    return redirect()->route('acount.login')->with('success', 'Mật khẩu của bạn đã được cập nhật!');
}
public function showResetForm($token)
{
    $cats = Category::orderBy('name', 'ASC')->get();
    return view('Client.account.new_password', compact('token','cats'));
}
}
