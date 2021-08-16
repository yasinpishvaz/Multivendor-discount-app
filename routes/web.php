<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\CheckOrderItemsAvailability;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', [IndexController::class, 'index']);

Route::get('/product/{product}', [ProductController::class, 'showProduct'])->name('show-product-details');

Route::get('/products/all', [ProductController::class, 'showAllProducts']);

Route::get('cart', [CartController::class, 'cart']);
Route::get('/product/add-to-cart/{id}', [CartController::class, 'addToCart']);
Route::patch('cart/update-cart-item', [CartController::class, 'updateCartItem']);
Route::delete('cart/remove-from-cart', [CartController::class, 'removeFromCart']);

Route::post('/bill/pay_test', [PaymentController::class, 'pay_test'])->name('pay_test')->middleware(['auth', CheckOrderItemsAvailability::class]);
Route::get('/orders/verified', [PaymentController::class, 'verify']);

Route::get('orders/details/{payment}/{order}', [OrderController::class, 'orderDetails'])->name('orderDetails');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('profile', [UserController::class, 'edit'])->name('profile');

Route::get('profile/orders', [OrderController::class, 'index'])->name('userOrders');

Route::get('profile/orders/items/{id}', [OrderController::class, 'showUserOrderItems'])->name('userOrderItems');

Route::get('profile/transactions', [PaymentController::class, 'index'])->name('userTransactions');

Route::patch('updateprofile', [UserController::class, 'update'])->name('updateprofile');




//Admin Routes

Route::middleware('can:isAdmin')->group(function () {

     Route::get('/back/dashboard', function () {
          return view('back.dashboard.index');
     });


     Route::get('/back/categories/index', [CategoryController::class, 'index']);

     

     Route::get('/back/categories/create', [CategoryController::class, 'create']);

     Route::post('/back/categories/create', [CategoryController::class, 'store']);

     Route::get('/back/services/create', [CategoryController::class, 'createService']);

     Route::post('/back/services/create', [CategoryController::class, 'serviceStore']);


     Route::get('/back/categories/delete/{id}', [CategoryController::class, 'destroy']);

     Route::get('/back/categories/edit/{id}', [CategoryController::class, 'edit']);

     Route::patch('/back/categories/updatecategory/{id}', [CategoryController::class, 'update']);


     Route::get('/back/products/index', [ProductController::class, 'adminIndex']);

     Route::get('/back/users/index', [UserController::class, 'index']);

     Route::get('/back/users/block/{id}', [UserController::class, 'blockUser']);

     Route::get('/back/users/active/{id}', [UserController::class, 'activeBlockedUser']);

     Route::get('/back/products/Unapprovedproducts', [ProductController::class, 'UnapprovedProducts']);

     Route::get('/back/products/productapproval/{id}', [ProductController::class, 'productApproval']);
     Route::get('/back/products/productdisapproval/{id}', [ProductController::class, 'productDisapproval']);

     Route::get('/back/transactions/index', [PaymentController::class, 'allTransactions']);

     Route::get('/back/orders/index', [OrderController::class, 'allOrders']);

     Route::get('back/orders/index/items/{id}', [OrderController::class, 'showAllOrderItems'])->name('allOrderItems');
});









Route::get('/panel/register', [UserController::class, 'merchantSignup']);

Route::post('/panel/register/store', [UserController::class, 'storeMerchant']);


//Merchant Routes

Route::middleware('can:isMerchant')->group(function () {

// Route::get('/merchant/panel', function () {
//      return view('merchant.dashboard.index');
// })->name('merchantPanel');

Route::get('/merchant/panel/editprofile', [UserController::class, 'merchantEdit']);

Route::get('/merchant/panel/mydeals', [ProductController::class, 'merchantIndex']);

Route::get('/merchant/panel/notapproveddeals', [ProductController::class, 'NotApprovedDeals']);

Route::get('/merchant/panel/editprofile', [UserController::class, 'merchanteEdit']);

Route::get('/merchant/panel/package/create', [ProductController::class, 'create']);

Route::get('/merchant/products/services/get/{id}', [ProductController::class, 'getServices']);


Route::post('/merchant/panel/package/create', [ProductController::class, 'store']);

Route::get('/merchant/panel/delete/{id}', [ProductController::class, 'destroy']);

     
});








//categories

Route::post('/commnet/store', [CommentController::class, 'store'])->name('commentStore')->middleware('auth');;

Route::get('cities/{citySlug}', [ProductController::class, 'showProductsByCity'])->name('showProductsByCity');

Route::get('{location}/{parentSlug}', [ProductController::class, 'showProductsByCategory'])->name('showProductsByCategory');
Route::get('{location}/{parentSlug}/{childSlug}', [ProductController::class, 'showProductsByChildCategory'])->name('showProductsByChildCategory');





