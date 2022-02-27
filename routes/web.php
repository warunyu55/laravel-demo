<?php

use App\Http\Controllers\AdminBankingController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// AdminPages
Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/admin',[AdminDashboardController::class,'index'])->name('dashboard');
    // member
    Route::get('/admin/member',[AdminMemberController::class,'index'])->name('member');
    // category
    Route::get('/admin/category',[AdminCategoryController::class,'index'])->name('category');
    Route::get('/admin/category/addcategory',[AdminCategoryController::class,'addform'])->name('add-category');
    Route::post('/admin/category/addcategory/add',[AdminCategoryController::class,'add'])->name('add-category-db');
    Route::get('/admin/category/editcategory/{id}',[AdminCategoryController::class,'editform']);
    Route::post('/admin/category/editcategory/update',[AdminCategoryController::class,'update'])->name('update-category-db');
    Route::get('/admin/category/delete/{id}',[AdminCategoryController::class,'delete']);
    // product
    Route::get('/admin/product',[AdminProductController::class,'index'])->name('product');
    Route::get('/admin/product/addproduct',[AdminProductController::class,'addform'])->name('add-product');
    Route::post('/admin/product/addproduct/add',[AdminProductController::class,'add'])->name('add-product-db');
    Route::post('/admin/product/status',[AdminProductController::class,'status'])->name('status');
    Route::get('/admin/product/editproduct/{id}',[AdminProductController::class,'editform']);
    Route::post('/admin/product/editproduct/update',[AdminProductController::class,'update'])->name('update-product-db');
    Route::get('/admin/product/delete/{id}',[AdminProductController::class,'delete']);
    // Banking
    Route::get('/admin/banking',[AdminBankingController::class,'index'])->name('banking');
    Route::get('/admin/banking/addbanking',[AdminBankingController::class,'addform'])->name('add-banking');
    Route::post('/admin/banking/addbanking/add',[AdminBankingController::class,'add'])->name('add-banking-db');
    Route::get('/admin/banking/editbanking/{id}',[AdminBankingController::class,'editform']);
    Route::post('/admin/banking/editbanking/update',[AdminBankingController::class,'update'])->name('update-banking-db');
    Route::get('/admin/banking/delete/{id}',[AdminBankingController::class,'delete']);
    // order
    Route::get('/admin/order',[AdminOrderController::class,'index'])->name('admin_order');
    Route::get('/admin/order/view/{id}',[AdminOrderController::class,'view']);
    Route::get('/admin/order/confirm/{id}',[AdminOrderController::class,'confirm']);
    Route::get('/admin/order/cancel/{id}',[AdminOrderController::class,'cancel']);
    Route::get('/admin/order/delete/{id}',[AdminOrderController::class,'delete']);
});
    
// UserPages
Route::get('/',[IndexController::class,'index']);
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login/checklogin',[LoginController::class,'check'])->name('c-login');
// shop
Route::get('/shop',[ShopController::class,'index'])->name('shop');
Route::get('/shop/{name}',[ShopController::class,'category']);
Route::get('/shop/search/{name}',[ShopController::class,'search']);
Route::get('/shop/product/{id}',[ShopController::class,'product']);

Route::middleware(['checkregister'])->group(function(){
    Route::get('/register',[RegisterController::class,'index'])->name('register');
    Route::post('/register/add',[RegisterController::class,'add'])->name('add-register');
});
Route::middleware(['checklogin'])->group(function(){
    // profile
    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');
    Route::post('/profile/update',[ProfileController::class,'update']);
    // address
    Route::get('/profile/address',[ProfileController::class,'index_address'])->name('address');
    Route::get('/profile/address/addform',[ProfileController::class,'address_add'])->name('add-address');
    Route::post('/profile/address/addform/add',[ProfileController::class,'add'])->name('add-address-db');
    Route::get('/profile/address/editform/{id}',[ProfileController::class,'address_edit']);
    Route::post('/profile/address/editform/update',[ProfileController::class,'address_update'])->name('edit-address-db');
    Route::get('/profile/address/delete/{id}',[ProfileController::class,'delete']);
    Route::post('/profile/address/addform/province',[ProfileController::class,'ajaxprovince'])->name('ajaxprovince');
    Route::post('/profile/address/addform/district',[ProfileController::class,'ajaxdistrict'])->name('ajaxdistrict');
    Route::post('/profile/address/addform/tambon',[ProfileController::class,'ajaxtambon'])->name('ajaxtambon');
    
    // password
    Route::get('/profile/password',[ProfileController::class,'index_password'])->name('password');
    Route::post('/profile/password/update',[ProfileController::class,'password']);
    // order
    Route::get('/profile/order',[ProfileController::class,'index_order'])->name('order');
    Route::get('/profile/payment',[ProfileController::class,'index_payment'])->name('payment');
    Route::post('/profile/payment/ajaxpaid',[ProfileController::class,'ajaxpaid'])->name('ajaxpaid');
    Route::post('/profile/payment/confirmpayment',[ProfileController::class,'payment'])->name('c_payment');
    // cart
    Route::get('/cart',[CartController::class,'index'])->name('cart');
    Route::post('/cart/add',[CartController::class,'add'])->name('add-cart');
    Route::get('/cart/delete/{id}',[CartController::class,'delete']);
    Route::post('/cart/checkout',[CartController::class,'checkout'])->name('checkout');
});


