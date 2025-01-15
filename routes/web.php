<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BientheController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProOrderController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\AcountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/////////////////////                              HOME                           //////////////////////////////////
Route::get('/',[HomeController::class, 'index'])->name('client.home');
Route::get('/shop',[HomeController::class, 'indexLayout'])->name('client.shop');
Route::get('/product/{id}',[HomeController::class, 'product'])->name('client.detail');

Route::get('/thankyou', function () {
    $cats = Category::orderBy('name', 'ASC')->get();

    return view('Client.thankyou',compact('cats'));
})->name(
    'client.thanku'
);
Route::get('/chitietorder', function () {
    $cats = Category::orderBy('name', 'ASC')->get();

    return view('Client.orderdetail',compact('cats'));
})->name(
    'client.orderdetail'
);

// Route::get('/donhang', function () {
//     $cats = Category::orderBy('name', 'ASC')->get();

//     return view('Client.donhang',compact('cats'));
// })->name(
//     'client.donhang'
// );

Route::get('/thongtincanhan', function () {
    $cats = Category::orderBy('name', 'ASC')->get();

    return view('Client.thongtincanhan',compact('cats'));
})->name(
    'client.thongtincanhan'
);
Route::get('/contact', function () {
    $cats = Category::orderBy('name', 'ASC')->get();

    return view('Client.contact',compact('cats'));
})->name(
    'client.contact'
);

Route::get('/test', function () {
    $cats = Category::orderBy('name', 'ASC')->get();

    return view('Client.test',compact('cats'));
})->name(
    'client.test'
);
Route::get('/orderdetail', function () {
    $cats = Category::orderBy('name', 'ASC')->get();

    return view('Client.orderdetail',compact('cats'));
})->name(
    'client.orderdetail'
);

Route::get('/profile', function () {
    $cats = Category::orderBy('name', 'ASC')->get();

    return view('Client.profile',compact('cats'));
})->name(
    'client.profile'
);
Route::get('/customer', [CustomerController::class, 'hienthi'])->name('client.profile');

// Route::get('/send-test-email', [AcountController::class, 'sendTestEmail']);
/////////////////////                              LOGIN CLIENT                           //////////////////////////////////
Route::group(['prefix'=>'acount'], function(){

    Route::get('/login',[AcountController::class, 'login'])->name('acount.login');
    Route::get('/logout',[AcountController::class, 'logout'])->name('acount.logout');

    Route::get('/verify-acount/{email}',[AcountController::class, 'verify'])->name('acount.verify');

    Route::post('/login',[AcountController::class, 'check_login']);

    Route::get('/register',[AcountController::class, 'register'])->name('acount.register');
    Route::post('/register',[AcountController::class, 'check_register']);

    Route::get('/profile',[AcountController::class, 'profile'])->name('acount.profile');
    Route::post('/profile',[AcountController::class, 'check_profile']);

    Route::get('/change_password',[AcountController::class, 'change_password'])->name('acount.change_password');
    Route::post('/change_password',[AcountController::class, 'check_change_password']);

    Route::get('/forgot_password',[AcountController::class, 'forgot_password'])->name('acount.forgot_password');
    Route::post('/forgot_password',[AcountController::class, 'check_forgot_password']);


    Route::get('/reset_password',[AcountController::class, 'reset_password'])->name('acount.reset_password');
    Route::post('/reset_password',[AcountController::class, 'check_reset_password']);

});

/////////////////////                              CART                           //////////////////////////////////
Route::group(['prefix'=>'cart','middleware'=>'customers'], function(){

    Route::get('/',[CartController::class, 'index'])->name('cart.index');

    Route::post('/add/{product}',[CartController::class, 'add'])->name('cart.add');

    Route::delete('/delete/{product}',[CartController::class, 'delete'])->name('cart.delete');

    Route::get('/update/{product}',[CartController::class, 'update'])->name('cart.update');

    Route::get('/clear',[CartController::class, 'clear'])->name('cart.clear');

});


/////////////////////                              ORDER                           //////////////////////////////////
Route::group(['prefix'=>'order','middleware'=>'customers'], function(){

    Route::get('/checkout',[CheckoutController::class, 'checkout'])->name('order.checkout');

    Route::post('/checkout',[CheckoutController::class, 'post_checkout']);

    Route::get('/orders', [CheckoutController::class, 'index'])->name('checkout.index');

    Route::get('/order/cancel/{id}', [CheckoutController::class, 'cancel'])->name('order.cancel1');

    Route::patch('/order/cancel/{id}', [CheckoutController::class, 'cancelOrder'])->name('order.cancel1');

});

/////////////////////                              ORDERDetail                           //////////////////////////////////
Route::group(['prefix'=>'orderdetaill','middleware'=>'customers'], function(){

    Route::get('/orderdetail/{id}',[CheckoutController::class, 'detail'])->name('detail.detail');

});

/////////////////////                              LOGIN ADMIN                           //////////////////////////////////
Route::get('/admin/login',[AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login',[AdminController::class, 'check_login']);
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/admin/register',[AdminController::class, 'register'])->name('admin.register');
Route::post('/admin/register',[AdminController::class, 'check_register']);

/////////////////////                              ADMIN                           //////////////////////////////////
Route::group(['middleware' => ['auth']], function () {

    Route::resource('/admin/category', CategoryController::class);
    Route::get('/category/bin', [CategoryController::class, 'bin'])->name('category.bin');
    Route::get('category/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');

    Route::resource('/admin/tag', TagController::class);
    Route::get('/tag/bin', [TagController::class, 'bin'])->name('tag.bin');
    Route::get('/tag/search', [TagController::class, 'search'])->name('tag.search');
    Route::get('tag/restore/{id}', [TagController::class, 'restore'])->name('tag.restore');

    Route::resource('/admin/product', ProductController::class);
    Route::get('/product/bin', [ProductController::class, 'bin'])->name('product.bin');
    Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');
    Route::get('/product/filter', [ProductController::class, 'filter'])->name('product.filter');
    Route::get('/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::delete('/delete/{id}', [ProductController::class, 'forceDelete'])->name('product.delete');

    Route::get('/admin/warehouse', [BientheController::class, 'index'])->name('warehouse.index');
    Route::get('/admin/warehouse/create/{id}', [BientheController::class, 'create'])->name('warehouse.create');
    Route::post('/admin/warehouse/store', [BientheController::class, 'store'])->name('warehouse.store');
    Route::get('/admin/warehouse/edit/{id}', [BientheController::class, 'edit'])->name('warehouse.edit');
    Route::delete('/admin/warehouse/destroy/{id}', [BientheController::class, 'destroy'])->name('warehouse.destroy');

    Route::resource('/admin/order', OrderController::class);
    Route::get('/admin/orderUpdate', [OrderController::class,'orderUpdate'])->name('admin.orderUpdate');
    // Route::put('/admin/orderUpdated', [OrderController::class,'updated'])->name('admin.orderUpdated');
    Route::put('/admin/order/update/{id}', [OrderController::class, 'updateStatus'])->name('admin.orderUpdated');
    Route::get('/admin/orders/filter', [OrderController::class, 'filter'])->name('admin.filter');
    
    //
    Route::resource('/admin/customer', CustomerController::class);
    Route::get('/admin/index', [CustomerController::class,'index'])->name('customer.index');
  
    Route::delete('/destroy/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    //

    Route::resource('/admin/user', UserController::class);
    Route::get('/admin/user', [UserController::class,'index'])->name('user.index');
    Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::resource('/admin/thongke', ThongKeController::class);
    Route::get('/admin/thongke', [ThongKeController::class, 'thongke'])->name('admin.thongke');

    
});
Route::get('/payment/return', [PayController::class, 'returnFromVNPAY'])->name('checkout.vnpay.returnFrom');
Route::post('/vnpay_payment',[PayController::class,'vnpayPayment'])->name('vnpay.payment');
Route::get('/payment/callback', [PayController::class, 'vnpayReturn'])->name('payment.callback');
Route::get('/payment/success', function() {
    return view('client.thankyou'); // View thành công
});
Route::get('password/reset', [AcountController::class, 'reset_password'])->name('password.request');
Route::post('password/email', [AcountController::class, 'send_reset_link'])->name('password.email');
Route::get('password/reset/{token}', [AcountController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AcountController::class, 'update_password'])->name('password.update');

Route::get('/contact', [HomeController::class, 'contact'])->name('client.contact');
Route::post('/contact', [HomeController::class, 'sendMail'])->name('client.contactt');
// $cats = Category::orderBy('name','ASC')->get();
// $products = Product::orderBy('id','DESC')->limit(6)->get();
// return view('Client.master',compact('cats','products'));
// Route::get('/user/cat',[HomeController::class, 'cat'])->name('cate');


