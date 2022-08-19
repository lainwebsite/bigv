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

Auth::routes(['verify' => true]);

Route::get('/', [PageController::class, 'home'])->name('home');

Route::group(['middleware' => ['user', 'verified'], 'as' => 'user.', 'prefix' => 'user'], function () {
    Route::resource('cart', CartController::class);
    Route::resource('discount', DiscountController::class);
    Route::resource('payment-method', PaymentMethodController::class);
    Route::resource('pickup-method', PickupMethodController::class);
    Route::resource('product', ProductController::class);
    Route::resource('product-category', ProductCategoryController::class);
    Route::resource('product-image', ProductImageController::class);
    Route::resource('product-review', ProductReviewController::class);
    Route::resource('product-variation', ProductVariationController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('transaction-discount', TransactionDiscountController::class);
    Route::resource('transaction-status', TransactionStatusController::class);
    Route::resource('user-address', UserAddressController::class);
    Route::resource('user-role', UserRoleController::class);
    Route::resource('user-tier', UserTierController::class);
    Route::resource('vendor', VendorController::class);
});

Route::group(['middleware' => ['user', 'verified']], function () {
    Route::resource('user', UserController::class);

    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::get('profile/edit', [UserController::class, 'showEditProfile'])->name('editProfileForm');
    Route::post('profile/edit', [UserController::class, 'editProfile'])->name('editProfile');
});

Route::group(['middleware' => ['admin', 'verified'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::resource('cart', AdminCartController::class);
    Route::resource('discount', AdminDiscountController::class);
    Route::resource('payment-method', AdminPaymentMethodController::class);
    Route::resource('pickup-method', AdminPickupMethodController::class);
    Route::resource('product', AdminProductController::class);
    Route::resource('product-category', AdminProductCategoryController::class);
    Route::resource('product-image', AdminProductImageController::class);
    Route::resource('product-review', AdminProductReviewController::class);
    Route::resource('product-variation', AdminProductVariationController::class);
    Route::resource('transaction', AdminTransactionController::class);
    Route::resource('transaction-discount', AdminTransactionDiscountController::class);
    Route::resource('transaction-status', AdminTransactionStatusController::class);
    Route::resource('user-address', AdminUserAddressController::class);
    Route::resource('user-role', AdminUserRoleController::class);
    Route::resource('user-tier', AdminUserTierController::class);
    Route::resource('vendor', AdminVendorController::class);
});
