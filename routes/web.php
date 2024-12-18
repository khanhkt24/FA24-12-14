<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BientheController;

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

Route::get('/', function () {
    return view('Client.home');
});

Route::get('/shop', function () {
    return view('Client.shop');
});
Route::get('/contact', function () {
    return view('Client.contact');
});
Route::get('/cart', function () {
    return view('Client.cart');
});
Route::get('/thankyou', function () {
    return view('Client.thankyou');
});
Route::get('/checkout', function () {
    return view('Client.checkout');
});

Route::resource('/admin/category',CategoryController::class);
Route::get('/category/bin',[CategoryController::class,'bin'])->name('category.bin');
Route::get('category/restore/{id}',[CategoryController::class,'restore'])->name('category.restore');

Route::resource('/admin/tag',TagController::class);
Route::get('/tag/bin',[TagController::class,'bin'])->name('tag.bin');
Route::get('/tag/search', [TagController::class, 'search'])->name('tag.search');
Route::get('tag/restore/{id}',[TagController::class,'restore'])->name('tag.restore');

Route::resource('/admin/product',ProductController::class);
Route::get('/product/bin',[ProductController::class,'bin'])->name('product.bin');
Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/product/filter', [ProductController::class, 'filter'])->name('product.filter');
Route::get('/restore/{id}',[ProductController::class,'restore'])->name('product.restore');
Route::delete('/delete/{id}', [ProductController::class, 'forceDelete'])->name('product.delete');

Route::get('/admin/warehouse',[BientheController::class,'index'])->name('warehouse.index');
Route::get('/admin/warehouse/create/{id}',[BientheController::class,'create'])->name('warehouse.create');
Route::post('/admin/warehouse/store',[BientheController::class,'store'])->name('warehouse.store');
Route::get('/admin/warehouse/edit/{id}',[BientheController::class,'edit'])->name('warehouse.edit');
Route::delete('/admin/warehouse/destroy/{id}',[BientheController::class,'destroy'])->name('warehouse.destroy');

Route::resource('/admin/order',OrderController::class);


