<?php

use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\Admin\DiscountController as AdminDiscountController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PaymentMethodController as AdminPaymentMethodController;
use App\Http\Controllers\Admin\PickupMethodController as AdminPickupMethodController;
use App\Http\Controllers\Admin\ProductCategoryController as AdminProductCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductImageController as AdminProductImageController;
use App\Http\Controllers\Admin\ProductReviewController as AdminProductReviewController;
use App\Http\Controllers\Admin\ProductVariationController as AdminProductVariationController;
use App\Http\Controllers\Admin\ReviewImageController as AdminReviewImageController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\TransactionDiscountController as AdminTransactionDiscountController;
use App\Http\Controllers\Admin\TransactionStatusController as AdminTransactionStatusController;
use App\Http\Controllers\Admin\UserAddressController as AdminUserAddressController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\UserRoleController as AdminUserRoleController;
use App\Http\Controllers\Admin\UserTierController as AdminUserTierController;
use App\Http\Controllers\Admin\VendorController as AdminVendorController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PickupAddressController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\DiscountController;
use App\Http\Controllers\User\PaymentGateway\PaynowController;
use App\Http\Controllers\User\PaymentMethodController;
use App\Http\Controllers\User\PickupMethodController;
use App\Http\Controllers\User\ProductCategoryController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProductImageController;
use App\Http\Controllers\User\ProductReviewController;
use App\Http\Controllers\User\ProductVariationController;
use App\Http\Controllers\User\ReviewImageController;
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


Route::group(['middleware' => 'general'], function () {
    // Auth::routes(['verify' => false]);
    Auth::routes();
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/profiletes', [PageController::class, 'profile'])->name('profiletes');
    Route::get('/promotes', [PageController::class, 'promo'])->name('promotes');
    Route::get('/addresstes', [PageController::class, 'address'])->name('addresstes');
    Route::get('/vendortes', [PageController::class, 'vendor'])->name('vendortes');
    Route::get('/vendordettes', [PageController::class, 'vendordetail'])->name('vendordettes');
    // Route::get('/product', [PageController::class, 'products']);
    // Route::get('product/search', [ProductController::class, 'search']);
    // Route::post('product/sort', [ProductController::class, 'sort']);
    Route::get('product/filter', [ProductController::class, 'filter']);
    Route::resource('product', ProductController::class);
    Route::resource('vendor', VendorController::class);
});

// Route::group(['middleware' => ['user', 'verified'], 'as' => 'user.', 'prefix' => 'user'], function () {
Route::group(['middleware' => ['user'], 'as' => 'user.', 'prefix' => 'user'], function () {
    Route::get('h/p/y/coba-pay', [CheckoutController::class, 'placeOrder']);
    Route::post('cart/verify-checkout', [CheckoutController::class, 'preCheckout']);
    Route::post('cart/checkout/buy-now', [CheckoutController::class, 'buyNowCheckout']);
    Route::get('cart/checkout', [CheckoutController::class, 'getCheckout']);
    // Route::post('cart/checkout/place-order', [CheckoutController::class, 'placeOrder']);
    Route::get('transit/transaction', [CheckoutController::class, 'transitStatusPayment']);
    Route::post('cart/checkout/place-order', function () {
        return redirect('/');
    });
    Route::post('cart/checkout/atome', [CheckoutController::class, 'atomePayment']);
    Route::resource('cart', CartController::class);
    Route::get('checkout/product-discount/search', [DiscountController::class, 'productSearch']);
    Route::get('checkout/shipping-discount/search', [DiscountController::class, 'shippingSearch']);
    Route::get('checkout/product-discount/search/{keyword?}', [DiscountController::class, 'productSearch']);
    Route::get('checkout/shipping-discount/search/{keyword?}', [DiscountController::class, 'shippingSearch']);
    Route::post('checkout/discount/apply-voucher', [DiscountController::class, 'applyVoucher']);
    Route::get('checkout/discount/cancel-voucher', [DiscountController::class, 'cancelVoucher']);
    Route::resource('discount', DiscountController::class);
    Route::resource('payment-method', PaymentMethodController::class);
    Route::resource('pickup-method', PickupMethodController::class);
    Route::post('checkout/pickup-address/search', [PickupAddressController::class, 'search']);
    Route::resource('product-category', ProductCategoryController::class);
    Route::resource('product-image', ProductImageController::class);
    Route::resource('product-review', ProductReviewController::class);
    Route::resource('product-variation', ProductVariationController::class);
    Route::get('transaction/filter', [TransactionController::class, 'filter']);
    Route::resource('transaction', TransactionController::class);
    Route::resource('transaction-discount', TransactionDiscountController::class);
    Route::resource('transaction-status', TransactionStatusController::class);
    Route::post('checkout/user-address/create-address', [UserAddressController::class, 'createAddressAJAX']);
    Route::get('checkout/user-address/get-address/{user_address}', [UserAddressController::class, 'getAddressAJAX']);
    Route::post('checkout/user-address/search', [UserAddressController::class, 'search']);
    Route::resource('user-address', UserAddressController::class);
    Route::resource('user-role', UserRoleController::class);
    Route::resource('user-tier', UserTierController::class);
});

// Route::group(['middleware' => ['user', 'verified']], function () {
Route::group(['middleware' => ['user']], function () {
    Route::resource('user', UserController::class);

    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::get('profile/edit', [UserController::class, 'showEditProfile'])->name('editProfileForm');
    Route::post('profile/edit', [UserController::class, 'editProfile'])->name('editProfile');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminPageController::class, 'login'])->name('login');
});

// Route::group(['middleware' => ['admin', 'verified'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminPageController::class, 'dashboard'])->name('dashboard');
    Route::resource('cart', AdminCartController::class);
    Route::post('discount/sort', [AdminDiscountController::class, 'sort'])->name('user.sort');
    Route::post('discount/search', [AdminDiscountController::class, 'search'])->name('user.search');
    Route::post('discount/get_variations', [AdminDiscountController::class, 'get_variations'])->name('user.get_variations');
    Route::post('discount/search_voucher_product', [AdminDiscountController::class, 'search_voucher_product'])->name('user.search_voucher_product');
    Route::post('discount/search_voucher_vendor', [AdminDiscountController::class, 'search_voucher_vendor'])->name('user.search_voucher_vendor');
    Route::post('discount/search_voucher_category', [AdminDiscountController::class, 'search_voucher_category'])->name('user.search_voucher_category');
    Route::resource('discount', AdminDiscountController::class);
    Route::resource('payment-method', AdminPaymentMethodController::class);
    Route::resource('pickup-method', AdminPickupMethodController::class);
    Route::post('product/sort', [AdminProductController::class, 'sort'])->name('product.sort');
    Route::post('product/review/sort', [AdminProductController::class, 'sort_review'])->name('product.sort_review');
    Route::get('product/analytics', [AdminProductController::class, 'view_analytics'])->name('product.view_analytics');
    Route::post('product/sort/analytics', [AdminProductController::class, 'sort_analytics'])->name('product.sort_analytics');
    Route::post('product/date/analytics', [AdminProductController::class, 'date_analytics'])->name('product.date_analytics');
    Route::get('product/analytics/{product}', [AdminProductController::class, 'analytics_detail'])->name('product.analytics.detail');
    Route::post('product/sort/analytics/{product}', [AdminProductController::class, 'sort_analytics_detail'])->name('product.sort_analytics.detail');
    Route::post('product/date/analytics/{product}', [AdminProductController::class, 'date_analytics_detail'])->name('product.date_analytics.detail');
    Route::resource('product', AdminProductController::class);
    Route::post('product-category/sort', [AdminProductCategoryController::class, 'sort'])->name('product-category.sort');
    Route::resource('product-category', AdminProductCategoryController::class);
    Route::resource('product-image', AdminProductImageController::class);
    Route::resource('product-review', AdminProductReviewController::class);
    Route::resource('product-variation', AdminProductVariationController::class);
    Route::post('transaction/{transaction}/status', [AdminTransactionController::class, 'status'])->name('transaction.status');
    Route::post('transaction/change_status', [AdminTransactionController::class, 'change_status'])->name('transaction.change_status');
    Route::post('transaction/sort', [AdminTransactionController::class, 'sort'])->name('transaction.sort');
    Route::get('transaction/analytics', [AdminTransactionController::class, 'view_analytics'])->name('transaction.view_analytics');
    Route::post('transaction/sort/analytics', [AdminTransactionController::class, 'sort_analytics'])->name('transaction.sort_analytics');
    Route::post('transaction/date/analytics', [AdminTransactionController::class, 'date_analytics'])->name('transaction.date_analytics');
    Route::resource('transaction', AdminTransactionController::class);
    Route::resource('transaction-discount', AdminTransactionDiscountController::class);
    Route::resource('transaction-status', AdminTransactionStatusController::class);
    Route::post('user/sort', [AdminUserController::class, 'sort'])->name('user.sort');
    Route::post('user/analytics', [AdminUserController::class, 'analytics'])->name('user.analytics');
    Route::get('user/analytics', [AdminUserController::class, 'view_analytics'])->name('user.view_analytics');
    Route::resource('user', AdminUserController::class);
    Route::resource('user-address', AdminUserAddressController::class);
    Route::resource('user-role', AdminUserRoleController::class);
    Route::resource('user-tier', AdminUserTierController::class);
    Route::post('vendor/sort', [AdminVendorController::class, 'sort'])->name('vendor.sort');
    Route::get('vendor/analytics', [AdminVendorController::class, 'view_analytics'])->name('vendor.view_analytics');
    Route::get('vendor/analytics/{vendor}', [AdminVendorController::class, 'analytics_detail'])->name('vendor.analytics.detail');
    Route::post('vendor/sort/analytics', [AdminVendorController::class, 'sort_analytics'])->name('vendor.sort_analytics');
    Route::post('vendor/date/analytics', [AdminVendorController::class, 'date_analytics'])->name('vendor.date_analytics');
    Route::resource('vendor', AdminVendorController::class);
});
