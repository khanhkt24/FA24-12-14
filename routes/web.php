<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BientheController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Home\AcountController;
use App\Http\Controllers\Home\HomeController;
use App\Models\Category;

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

});

/////////////////////                              LOGIN ADMIN                           //////////////////////////////////
Route::get('/admin/login',[AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login',[AdminController::class, 'check_login']);

Route::get('/admin/register',[AdminController::class, 'register'])->name('admin.register');
Route::post('/admin/register',[AdminController::class, 'check_register']);

/////////////////////                              ADMIN                           //////////////////////////////////
Route::group(['middleware' => ['auth', 'admin']], function () {

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

});


// $cats = Category::orderBy('name','ASC')->get();
// $products = Product::orderBy('id','DESC')->limit(6)->get();
// return view('Client.master',compact('cats','products'));
// Route::get('/user/cat',[HomeController::class, 'cat'])->name('cate');


