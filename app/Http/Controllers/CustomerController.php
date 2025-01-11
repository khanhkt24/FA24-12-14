<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Customer::where('id', '!=', Auth::id()); // Loại bỏ tài khoản đăng nhập

    // Kiểm tra nếu có tham số tìm kiếm "query"
    if ($request->has('query') && $request->input('query') !== '') {
        $query->where('email', 'like', '%' . $request->input('query') . '%');
    }

    $user = $query->get();
        return view('admin.customer.index', compact('user'));
    }

    public function destroy(String $id)
    {
        $delete = Customer::findorFail($id);
        $delete->delete();
        return redirect()->route('customer.index')->with('success','Xóa thành công');
    }
    public function hienthi()
    {
        $auth = auth('cus')->user();
        $cats = Category::orderBy('name', 'ASC')->get();
        return view('client.profile',compact('auth','cats'));
    }
    
    
}
