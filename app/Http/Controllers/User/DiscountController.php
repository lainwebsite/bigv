<?php

namespace App\Http\Controllers\User;

use DB;
use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\OptionCart;
use App\Models\Cart;
use App\Models\VariationDiscount;
use App\Models\ProductVariation;
use App\Models\VendorDiscount;
use App\Models\CategoryDiscount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    protected $shipping_price = 25;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::where('visible', 1)
            ->where('duration_start', '<=', Carbon::now())
            ->where('duration_end', '>=', Carbon::now())
            ->get();
        return view('user.promo.index', compact('discounts'));
    }

    public function search(Request $request)
    {
        if ($request->code) {
            $discounts = Discount::where('code', $request->code)
                ->where('duration_start', '<=', Carbon::now())
                ->where('duration_end', '>=', Carbon::now())
                ->get();
        } else {
            $discounts = Discount::where('visible', 1)
                ->where('duration_start', '<=', Carbon::now())
                ->where('duration_end', '>=', Carbon::now())
                ->get();
        }

        return view('user.promo.inc.discount', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        //
    }

    // public function productSearch($keyword = null)
    // {
        
        
    //     $productDiscounts = Discount::where('type_id', '2');

    //     if (isset($keyword)) {
    //         $productDiscounts->where('code', $keyword);
    //     }

    //     $productDiscounts = $productDiscounts->get();

    //     return view('user.cart.itemProductDiscCheckout', [
    //         'product_discounts' => $productDiscounts,
    //     ]);
    // }
    
    public function productSearch($keyword = null)
    {
        // visibility dlm bentuk array. 
        $cartId = session()->get('checkout-items');
        $productVariationIdList = [];
        $vendorIdList = [];
        $categoryIdList = [];
        foreach($cartId as $c){
            $cart = Cart::where('id', $c)->get()[0];
            array_push($productVariationIdList, $cart->product_variation_id);
            array_push($vendorIdList, $cart->product_variation->product->vendor_id);
            array_push($categoryIdList, $cart->product_variation->product->category_id);
        }
        
        // Cek visibility, duration active
        $visibility = [1];
        $allDisc = Discount::where('duration_start', '<=', Carbon::now())
            ->where('duration_end', '>=', Carbon::now())
            ->where('type_id', '2');
            
        if (isset($keyword)){
            array_push($visibility, 0);
            $allDisc->where(DB::raw('lower(code)'), strtolower($keyword));
        }
        
        $allDisc = $allDisc->whereIn('visible', $visibility)->get();
            
        $voucherListFinal = [];
        foreach($allDisc as $disc){
            // Cek minimum order
            if ($disc->min_order != null) if ((float)session()->get('total-checkout-price') < $disc->min_order) continue;
            
            // Cek maximum quota
            if ($disc->max_quota != null) if($disc->transaction_discounts->count() >= $disc->max_quota) continue;
            
            // Cek apakah bisa untuk semua produk
            if ($disc->all_products == 1){
                array_push($voucherListFinal, $disc);
                continue;
            }
            
            // Cek applicable
            if ($disc->applicable_id == 1){
                // Cek applicable variation (id 1)
                $var = VariationDiscount::where('discount_id', $disc->id)->whereIn('product_variation_id', $productVariationIdList)->get();
                $aval = count($var);
                if ($aval > 0) array_push($voucherListFinal, $disc);
            }
            else if ($disc->applicable_id == 2){
                // Cek applicable vendor (id 2)
                $ven = VendorDiscount::where('discount_id', $disc->id)->whereIn('vendor_id', $vendorIdList)->get();
                $aval = count($ven);
                if ($aval > 0) array_push($voucherListFinal, $disc);
            } 
            else {
                // Cek applicable category (id 3)
                $cat = CategoryDiscount::where('discount_id', $disc->id)->whereIn('product_category_id', $categoryIdList)->get();
                $aval = count($cat);
                if ($aval > 0) array_push($voucherListFinal, $disc);
            }
        }

        return view('user.cart.itemProductDiscCheckout', [
            'product_discounts' => $voucherListFinal,
        ]);
    }

    public function shippingSearch($keyword = null)
    {
        // Cek visibility, duration active
        $visibility = [1];
        $allDisc = Discount::where('duration_start', '<=', Carbon::now())
            ->where('duration_end', '>=', Carbon::now())
            ->where('type_id', '1');
            
        if (isset($keyword)){
            array_push($visibility, 0);
            $allDisc->where(DB::raw('lower(code)'), strtolower($keyword));
        }
        
        $allDisc = $allDisc->whereIn('visible', $visibility)->get();

        return view('user.cart.itemShipDiscCheckout', [
            'shipping_discounts' => $allDisc,
        ]);
    }

    public function applyVoucher(Request $request)
    {
        session()->forget('product-voucher-used');
        session()->forget('shipping-voucher-used');
        session()->forget('total-price-after-discount');
        session()->forget('total-discount-product');
        session()->forget('total-discount-shipping');
        session()->save();

        if (!$request->product_voucher && !$request->shipping_voucher) {
            return [];
        }

        $productVoucher = $request->product_voucher;
        $shippingVoucher = $request->shipping_voucher;
        $pickupMethodId = $request->pickup_method_id;
        $shippingPrice = (float) $this->shipping_price;
        
        $cartId = session()->get('checkout-items');
        $productVariationIdList = [];
        $vendorIdList = [];
        $categoryIdList = [];
        
        $productDiscount = null;
        if (isset($productVoucher)) {
            $productDiscount = Discount::where('code', $productVoucher)->first();
        }
        $shippingDiscount = null;
        if (isset($shippingVoucher)) {
            $shippingDiscount = Discount::where('code', $shippingVoucher)->first();
        }
        
        $output = [];
        $rawPrice = 0;
        $totalPrice = 0;
        $totalDiscount = 0;
        $totalDiscountShipping = 0;
        foreach($cartId as $c){
            $cart = Cart::where('id', $c)->get()[0];
            $product = $cart->product_variation;
            $productPrice = $product->price;
            if ($product->discount != 0){
                $checkSaleValidDate = ProductVariation::where('id', $product->id)->where('discount_start_date', '<=', Carbon::now())->where('discount_end_date', '>=', Carbon::now())->get();
                if (count($checkSaleValidDate) > 0) $productPrice = $product->discount;
            }
            $addons = OptionCart::where('cart_id', $c)->get();
            foreach($addons as $ad){
                $productPrice += $ad->addon_option->price;
            }
            $productPrice = $productPrice * $cart->quantity;
            $rawPrice += $productPrice;
            
            if ($productDiscount != null){
                $disc = $productDiscount;
                $output['product_voucher'] = $disc;
                session()->put('product-voucher-used', $disc);
                session()->save();
                if ($disc->all_products == 1){
                    if ($disc->voucher_type == 1){
                        $finalPrice = $productPrice - $disc->amount;
                        if ($finalPrice > 0) {
                            $totalPrice += $finalPrice;
                            $totalDiscount += $disc->amount;
                        }
                        else {
                            $totalPrice += 0;
                            $totalDiscount += $productPrice;
                        }
                    }
                    else if ($disc->voucher_type == 2){
                        $discountAmount = $productPrice * $disc->amount / 100;
                        if ($disc->max_discount != null){
                            if ($discountAmount > $disc->max_discount) $discountAmount = $disc->max_discount;
                        }
                        if ($discountAmount > $productPrice){
                            $totalDiscount += $productPrice;
                            $productPrice = 0;
                        }
                        else {
                            $productPrice = $productPrice - $discountAmount;
                            $totalDiscount += $discountAmount;
                        }
                        
                        $totalPrice += $productPrice;
                    }
                }
                else {
                    if ($disc->applicable_id == 1){
                        // Cek applicable variation (id 1)
                        $var = VariationDiscount::where('discount_id', $disc->id)->where('product_variation_id', $product->id)->get();
                        $aval = count($var);
                        // print($aval);
                        // dd($var);
                        if ($aval > 0){
                            if ($disc->voucher_type == 1){
                                $finalPrice = $productPrice - $disc->amount;
                                if ($finalPrice > 0) {
                                    $totalPrice += $finalPrice;
                                    $totalDiscount += $disc->amount;
                                }
                                else {
                                    $totalPrice += 0;
                                    $totalDiscount += $productPrice;
                                }
                            }
                            else if ($disc->voucher_type == 2){
                                $discountAmount = $productPrice * $disc->amount / 100;
                                if ($disc->max_discount != null){
                                    if ($discountAmount > $disc->max_discount) $discountAmount = $disc->max_discount;
                                }
                                if ($discountAmount > $productPrice){
                                    $totalDiscount += $productPrice;
                                    $productPrice = 0;
                                }
                                else {
                                    $productPrice = $productPrice - $discountAmount;
                                    $totalDiscount += $discountAmount;
                                }
                                
                                $totalPrice += $productPrice;
                            }
                        }
                        else {
                            $totalPrice += $productPrice;
                        }
                    }
                    else if ($disc->applicable_id == 2){
                        // Cek applicable vendor (id 2)
                        $ven = VendorDiscount::where('discount_id', $disc->id)->where('vendor_id', $product->product->vendor_id)->get();
                        $aval = count($ven);
                        if ($aval > 0){
                            if ($disc->voucher_type == 1){
                                $finalPrice = $productPrice - $disc->amount;
                                if ($finalPrice > 0) {
                                    $totalPrice += $finalPrice;
                                    $totalDiscount += $disc->amount;
                                }
                                else {
                                    $totalPrice += 0;
                                    $totalDiscount += $productPrice;
                                }
                            }
                            else if ($disc->voucher_type == 2){
                                $discountAmount = $productPrice * $disc->amount / 100;
                                if ($disc->max_discount != null){
                                    if ($discountAmount > $disc->max_discount) $discountAmount = $disc->max_discount;
                                }
                                if ($discountAmount > $productPrice){
                                    $totalDiscount += $productPrice;
                                    $productPrice = 0;
                                }
                                else {
                                    $productPrice = $productPrice - $discountAmount;
                                    $totalDiscount += $discountAmount;
                                }
                                
                                $totalPrice += $productPrice;
                            }
                        }
                        else {
                            $totalPrice += $productPrice;
                        }
                    } 
                    else {
                        // Cek applicable category (id 3)
                        $cat = CategoryDiscount::where('discount_id', $disc->id)->where('product_category_id', $product->product->category_id)->get();
                        $aval = count($cat);
                        if ($aval > 0){
                            if ($disc->voucher_type == 1){
                                $finalPrice = $productPrice - $disc->amount;
                                if ($finalPrice > 0) {
                                    $totalPrice += $finalPrice;
                                    $totalDiscount += $disc->amount;
                                }
                                else {
                                    $totalPrice += 0;
                                    $totalDiscount += $productPrice;
                                }
                            }
                            else if ($disc->voucher_type == 2){
                                $discountAmount = $productPrice * $disc->amount / 100;
                                if ($disc->max_discount != null){
                                    if ($discountAmount > $disc->max_discount) $discountAmount = $disc->max_discount;
                                }
                                if ($discountAmount > $productPrice){
                                    $totalDiscount += $productPrice;
                                    $productPrice = 0;
                                }
                                else {
                                    $productPrice = $productPrice - $discountAmount;
                                    $totalDiscount += $discountAmount;
                                }
                                
                                $totalPrice += $productPrice;
                            }
                        }
                        else {
                            $totalPrice += $productPrice;
                        }
                    }
                }
            } else {
                $totalPrice += $productPrice;
            }
        } 
        
        if ($pickupMethodId == 1) {
            if ($shippingDiscount != null){
                $disc = $shippingDiscount;
                $output['shipping_voucher'] = $disc;
                session()->put('shipping-voucher-used', $disc);
                session()->save();
                $shippingFinalPrice = $shippingPrice - $disc->amount;
                if ($shippingFinalPrice > 0) {
                    $totalPrice += $shippingFinalPrice;
                    $totalDiscountShipping += $disc->amount;
                }
                else {
                    $totalPrice += 0;
                    $totalDiscountShipping += $shippingPrice;
                }
            }
            else {
                $totalPrice += $shippingPrice;
            }
        } 
        
        $output["total_price_before_discount"] = $rawPrice;
        $output["total_discount"] = $totalDiscount;
        $output["total_discount_shipping"] = $totalDiscountShipping;
        $output["total_price_after_discount"] = $totalPrice;
        
        session()->put('total-price-after-discount', $output["total_price_after_discount"]);
        session()->put('total-discount-product', $output["total_discount"]);
        session()->put('total-discount-shipping', $output["total_discount_shipping"]);
        session()->save();
        
        // $totalPrice = session()->get('grandtotal-checkout-price');
        // if (isset($productVoucher)) {
        //     $voucher = Discount::where('code', $productVoucher)->first();
            
        //     $output['product_voucher'] = $voucher;
        //     $totalPrice -= $voucher->amount;

        //     session()->put('product-voucher-used', $voucher);
        //     session()->save();
        // }

        // if (isset($shippingVoucher)) {
        //     $voucher = Discount::where('code', $shippingVoucher)->first();
        //     $output['shipping_voucher'] = $voucher;
        //     $totalPrice -= $voucher->amount;

        //     session()->put('shipping-voucher-used', $voucher);
        //     session()->save();
        // }

        // $output["total_price_after_discount"] = $totalPrice;

        return $output;
    }

    public function cancelVoucher(Request $request)
    {
        // $pickupMethodId = $request->get('pickup_method_id', 1);
        $pickupMethodId = $request->pickup_method_id;
        
        \Artisan::call('cache:clear');
        session()->forget([
            'total-price-after-discount',
            'total-price-before-discount',
            'shipping-voucher-used',
            'product-voucher-used',
            'total-discount-product',
            'total-discount-shipping'
        ]);
        session()->save();
        \Artisan::call('cache:clear');

        if ($pickupMethodId == 2)
            return session()->get('grandtotal-checkout-price') - (float) $this->shipping_price;
        
        return session()->get('grandtotal-checkout-price');
    }
}
