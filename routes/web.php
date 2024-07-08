<?php

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









//admin
Route::get('/admin_login',[AdminController::class,'index'])->name('admin_login');
Route::post('/user_auth_data',[AdminController::class,'authData'])->name('login');
Route::get('/admin_logout',[AdminController::class,'adminLogout'])->name('admin_logout');

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





    //admin banner
    Route::get('/home_banner', [HomeBannerController::class,'index'])->name('home_banner');
    Route::post('/home_banner_processor', [HomeBannerController::class,'bannerProcessing'])->name('home_banner_processor');
    Route::get('/show_banner_details', [HomeBannerController::class,'showBannerData'])->name('show_banner_details');
    Route::post('/manage_banner_status', [HomeBannerController::class,'mangeBannerStatus'])->name('manage_banner_status');
    Route::delete('/delete_banner/{id}', [HomeBannerController::class,'deleteBanner']);
    //admin service
    Route::get('/company_service', [CompanyServiceController::class,'index'])->name('company_service');
    Route::post('/company_service_processor', [CompanyServiceController::class,'addServiceDetails'])->name('company_service_processor');
    Route::get('/show_service_details', [CompanyServiceController::class,'showServiceDetails'])->name('show_service_details');
    Route::delete('/delete_service/{id}', [CompanyServiceController::class,'deleteService']);
    Route::post('/manage_service_status', [CompanyServiceController::class,'mangeServiceStatus'])->name('manage_service_status');

    //partner manage
    Route::get('/partners_management', [PartnerController::class,'index'])->name('partners_management');
    Route::post('/manage_partner_status', [PartnerController::class,'managePartner'])->name('manage_partner_status');
    Route::get('/show_partner_logo', [PartnerController::class,'showPartnerDetails'])->name('show_partner_logo');
    Route::delete('/delete_partner_logo/{id}', [PartnerController::class,'deletePartnerLogo']);
    Route::post('/manage_status', [PartnerController::class,'managePartnerStatus'])->name('manage_status');

    //companyServiceFact
    Route::get('/company_service_fact', [CompanyFactController::class,'index'])->name('company_service_fact');
    Route::post('/company_service_fact_processor', [CompanyFactController::class,'manageServiceFact'])->name('company_service_fact_processor');
    Route::get('/show_company_service_fact', [CompanyFactController::class,'showCompanyServiceFact'])->name('show_company_service_fact');
    Route::delete('/delete_service_fact/{id}', [CompanyFactController::class,'deleteServiceFact']);
    Route::post('/service_fact_manage_status', [CompanyFactController::class,'manageServiceFactStatus'])->name('service_fact_manage_status');

    //Company profile manage
    Route::get('/company_profile', [companyProfileController::class,'index'])->name('company_profile');
    Route::post('/company_profile_manage', [companyProfileController::class,'companyProfileManage'])->name('company_profile_manage');
    Route::get('/company_profile_data_show', [companyProfileController::class,'showProfileDetails'])->name('company_profile_data_show');

    //Team members profile manage
    Route::get('/team_profile', [TeamManageController::class,'index'])->name('team_profile');
    Route::post('/team_members_profile_manage', [TeamManageController::class,'teamProfileManage'])->name('team_members_profile_manage');
    Route::get('/show_all_team_members', [TeamManageController::class,'showTeamMemberProfileDetails'])->name('show_all_team_members');
    Route::post('/manage_member_status', [TeamManageController::class,'mangeTeamProfileStatus'])->name('manage_member_status');
    Route::delete('/delete_member_profile/{id}', [TeamManageController::class,'deleteTeamMemberProfile']);

});
