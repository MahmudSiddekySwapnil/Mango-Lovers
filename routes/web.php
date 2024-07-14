<?php

use App\Http\Controllers\AdminViewController\AdminBannerController;
use App\Http\Controllers\AdminViewController\AdminController;
use App\Http\Controllers\AdminViewController\AdminOrderController;
use App\Http\Controllers\AdminViewController\AdminProductController;
use App\Http\Controllers\AdminViewController\CategoryController;
use App\Http\Controllers\landingViewController\HomeController;
use App\Http\Controllers\landingViewController\OrderController;
use App\Http\Controllers\landingViewController\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landingViewController\CartController;
use App\Http\Controllers\landingViewController\CheckoutController;

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
Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/dashboard',[HomeController::class,'home'])->name('home');
Route::get('/user_login',[HomeController::class,'userLogin'])->name('user_login');
Route::get('/user_register',[HomeController::class,'userRegister'])->name('user_register');
Route::post('/user_registration_process',[HomeController::class,'userRegistrationProcess'])->name('user_registration_process');
Route::post('/user_login_process',[HomeController::class,'userLoginProcess'])->name('user_login_process');
Route::get('/products/{id}', [ProductController::class, 'show']);






//Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
//Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
//Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');



Route::post('/addToCart', [CartController::class, 'addToCart']);
Route::post('/updateCart', [CartController::class, 'updateCart']);
Route::post('/clearCart', [CartController::class, 'clearCart']);
Route::post('/removeFromCart', [CartController::class, 'removeFromCart']);  // Add this route
Route::get('/fetch-cart', [CartController::class, 'fetchCart'])->name('fetch.cart');
//Route::get('/order-confirmation/{order_id}/', [OrderController::class, 'orderConfirmation'])->name('order.confirmation');


Route::middleware(['user_auth'])->group(function () {
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');
    Route::get('download/invoice/{id}', [OrderController::class,'downloadInvoice'])->name('download.invoice');
    Route::get('/order-confirmation', [OrderController::class, 'orderConfirmation'])->name('order.confirmation');
    Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

});









//admin without middleware------------------------------------------>
Route::get('/admin_login',[AdminController::class,'index'])->name('admin_login');
Route::post('/user_auth_data',[AdminController::class,'authData'])->name('login');
Route::get('/admin_logout',[AdminController::class,'adminLogout'])->name('admin_logout');
//auth middleware routes-------------------------------------------->
Route::middleware(['admin_auth'])->group(function () {
Route::get('/admin_dashboard', [AdminController::class,'adminDashboard'])->name('admin_dashboard');
//Order Management
Route::get('/new_order', [AdminOrderController::class,'index'])->name('new_order');
Route::get('/order_details', [AdminOrderController::class,'showOrderDetails'])->name('order_details');
Route::get('download_invoice/{id}', [OrderController::class,'downloadInvoice'])->name('download_invoice');
Route::post('update-order-status/{id}',[OrderController::class,'updateStatus'])->name('update.order.status');
//product
Route::get('/product_details', [AdminProductController::class,'index'])->name('product_details');
Route::get('/product_mange', [AdminProductController::class,'productManage'])->name('product_mange');
Route::post('/product_processor', [AdminProductController::class,'productProcessor'])->name('product_processor');
Route::get('/product_list', [AdminProductController::class,'showProductList'])->name('product_list');
Route::post('/manage_product_status', [AdminProductController::class,'mangeProductStatus'])->name('manage_product_status');
Route::delete('/delete_producct/{id}', [AdminProductController::class,'deleteProduct']);
//category
Route::get('/category_list', [CategoryController::class, 'categoryListShow'])->name('category_list');
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::post('/category_manage', [CategoryController::class,'mangeCategory'])->name('category_manage');
Route::get('/category_data', [CategoryController::class,'showCategoryList'])->name('category_data');
Route::post('/manage_category_status', [CategoryController::class,'mangeCategoryStatus'])->name('manage_category_status');
Route::delete('/delete_category/{id}', [CategoryController::class,'deleteCategory']);
//banner
Route::get('/banner', [AdminBannerController::class, 'index'])->name('banner');
Route::post('/banner_manage', [AdminBannerController::class,'mangeBanner'])->name('banner_manage');
Route::get('/banner_data', [AdminBannerController::class,'showBannerList'])->name('banner_data');
Route::post('/manage_banner_status', [AdminBannerController::class,'mangeBannerStatus'])->name('manage_banner_status');
Route::delete('/delete_banner/{id}', [AdminBannerController::class,'deleteBanner']);



});
