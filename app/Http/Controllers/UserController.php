<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::where('id', '!=', Auth::id()); // Loại bỏ tài khoản đăng nhập

    // Kiểm tra nếu có tham số tìm kiếm "query"
    if ($request->has('query') && $request->input('query') !== '') {
        $query->where('email', 'like', '%' . $request->input('query') . '%');
    }

    $user = $query->get();
        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
//     public function showUsers(Request $request)
// {
//     $query = User::where('id', '!=', Auth::id()); // Loại bỏ tài khoản đăng nhập

//     // Kiểm tra nếu có tham số tìm kiếm "query"
//     if ($request->has('query') && $request->input('query') !== '') {
//         $query->where('email', 'like', '%' . $request->input('query') . '%');
//     }

//     $user = $query->get();
//     return view('admin.user.index', compact('user'));
// }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $delete = User::find($id);
        $delete->delete();
        return redirect()->route('user.index')->with('success', 'Xóa thành công');
    }
}
