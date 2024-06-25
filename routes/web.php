<?php

use App\Http\Controllers\landingViewController\HomeController;
use App\Http\Controllers\landingViewController\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landingViewController\CartController;

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
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
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

