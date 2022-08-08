<?php

use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\Admin\DiscountController as AdminDiscountController;
use App\Http\Controllers\Admin\PaymentMethodController as AdminPaymentMethodController;
use App\Http\Controllers\Admin\PickupMethodController as AdminPickupMethodController;
use App\Http\Controllers\Admin\ProductCategoryController as AdminProductCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductImageController as AdminProductImageController;
use App\Http\Controllers\Admin\ProductReviewController as AdminProductReviewController;
use App\Http\Controllers\Admin\ProductVariationController as AdminProductVariationController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\TransactionDiscountController as AdminTransactionDiscountController;
use App\Http\Controllers\Admin\TransactionStatusController as AdminTransactionStatusController;
use App\Http\Controllers\Admin\UserAddressController as AdminUserAddressController;
use App\Http\Controllers\Admin\UserRoleController as AdminUserRoleController;
use App\Http\Controllers\Admin\UserTierController as AdminUserTierController;
use App\Http\Controllers\Admin\VendorController as AdminVendorController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\DiscountController;
use App\Http\Controllers\User\PaymentMethodController;
use App\Http\Controllers\User\PickupMethodController;
use App\Http\Controllers\User\ProductCategoryController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProductImageController;
use App\Http\Controllers\User\ProductReviewController;
use App\Http\Controllers\User\ProductVariationController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\User\TransactionDiscountController;
use App\Http\Controllers\User\TransactionStatusController;
use App\Http\Controllers\User\UserAddressController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserRoleController;
use App\Http\Controllers\User\UserTierController;
use App\Http\Controllers\User\VendorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [PageController::class, 'home'])->name('home');

Route::group(['middleware' => ['user', 'verified']], function () {
    Route::resource('user', UserController::class);
});

Route::group(['middleware' => ['user', 'verified'], 'as' => 'user.', 'prefix' => 'user'], function () {
    Route::resource('cart', CartController::class);
    Route::resource('discount', DiscountController::class);
    Route::resource('paymentmethod', PaymentMethodController::class);
    Route::resource('pickupmethod', PickupMethodController::class);
    Route::resource('product', ProductController::class);
    Route::resource('productcategory', ProductCategoryController::class);
    Route::resource('productimage', ProductImageController::class);
    Route::resource('productreview', ProductReviewController::class);
    Route::resource('productvariation', ProductVariationController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('transactiondiscount', TransactionDiscountController::class);
    Route::resource('transactionstatus', TransactionStatusController::class);
    Route::resource('useraddress', UserAddressController::class);
    Route::resource('userrole', UserRoleController::class);
    Route::resource('usertier', UserTierController::class);
    Route::resource('vendor', VendorController::class);
});

Route::group(['middleware' => ['admin', 'verified'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::resource('cart', AdminCartController::class);
    Route::resource('discount', AdminDiscountController::class);
    Route::resource('paymentmethod', AdminPaymentMethodController::class);
    Route::resource('pickupmethod', AdminPickupMethodController::class);
    Route::resource('product', AdminProductController::class);
    Route::resource('productcategory', AdminProductCategoryController::class);
    Route::resource('productimage', AdminProductImageController::class);
    Route::resource('productreview', AdminProductReviewController::class);
    Route::resource('productvariation', AdminProductVariationController::class);
    Route::resource('transaction', AdminTransactionController::class);
    Route::resource('transactiondiscount', AdminTransactionDiscountController::class);
    Route::resource('transactionstatus', AdminTransactionStatusController::class);
    Route::resource('useraddress', AdminUserAddressController::class);
    Route::resource('userrole', AdminUserRoleController::class);
    Route::resource('usertier', AdminUserTierController::class);
    Route::resource('vendor', AdminVendorController::class);
});
