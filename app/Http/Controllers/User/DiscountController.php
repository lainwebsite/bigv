<?php

namespace App\Http\Controllers\User;

use DB;
use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Cart;
use App\Models\VariationDiscount;
use App\Models\VendorDiscount;
use App\Models\CategoryDiscount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
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
            if ($disc->min_order != null) if (session()->get('total-checkout-price') < $disc->min_order) continue;
            
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
    
    public function tes($visibility){
        // KHUSUS PRODUCT VOUCHER
        
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
        $allDisc = Discount::whereIn('visible', $visibility)
            ->where('duration_start', '<=', Carbon::now())
            ->where('duration_end', '>=', Carbon::now())
            ->where('type_id', '2')
            ->get();
            
        $voucherListFinal = [];
        foreach($allDisc as $disc){
            // Cek minimum order
            if ($disc->min_order != null) if (session()->get('total-checkout-price') < $disc->min_order) continue;
            
            // Cek maximum quota
            if ($disc->max_quota != null) if($discount->transaction_discounts->count() >= $disc->max_quota) continue;
            
            // Cek applicable
            if ($disc->applicable_id == 1){
                // Cek applicable variation (id 1)
                $aval = count(VariationDiscount::where('discount_id', $disc->id)->whereIn('product_variation_id', $productVariationIdList)->get());
                if ($aval > 0) array_push($voucherListFinal, $disc);
            }
            else if ($disc->applicable_id == 2){
                // Cek applicable vendor (id 2)
                $aval = count(VendorDiscount::where('discount_id', $disc->id)->whereIn('vendor_id', $vendorIdList)->get());
                if ($aval > 0) array_push($voucherListFinal, $disc);
            } 
            else {
                // Cek applicable category (id 3)
                $aval = count(CategoryDiscount::where('discount_id', $disc->id)->whereIn('product_category_id', $categoryIdList)->get());
                if ($aval > 0) array_push($voucherListFinal, $disc);
            }
        }
        
        return $voucherListFinal;
    }

    public function applyVoucher(Request $request)
    {
        session()->forget('product-voucher-used');
        session()->forget('shipping-voucher-used');
        session()->save();

        $productVoucher = $request->product_voucher;
        $shippingVoucher = $request->shipping_voucher;
        $output = [];
        $totalPrice = session()->get('grandtotal-checkout-price');

        if (isset($productVoucher)) {
            $voucher = Discount::where('code', $productVoucher)->first();
            $output['product_voucher'] = $voucher;
            $totalPrice -= $voucher->amount;

            session()->put('product-voucher-used', $voucher);
            session()->save();
        }

        if (isset($shippingVoucher)) {
            $voucher = Discount::where('code', $shippingVoucher)->first();
            $output['shipping_voucher'] = $voucher;
            $totalPrice -= $voucher->amount;

            session()->put('shipping-voucher-used', $voucher);
            session()->save();
        }

        $output["total_price_after_discount"] = $totalPrice;

        return $output;
    }

    public function cancelVoucher()
    {
        session()->forget('product-voucher-used');
        session()->forget('shipping-voucher-used');

        return session()->get('grandtotal-checkout-price');
    }
}
