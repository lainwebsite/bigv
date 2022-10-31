<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Discount;
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
        return view ("user.promo.index");
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

    public function search($keyword = null)
    {
        $productDiscounts = Discount::where('type_id', '2')->orWhere('type_id', '3');
        $shippingDiscounts = Discount::where('type_id', '1');

        if (isset($keyword)) {
            $productDiscounts->where('code', $keyword);
            $shippingDiscounts->where('code', $keyword);
        }

        $productDiscounts = $productDiscounts->get();
        $shippingDiscounts = $shippingDiscounts->get();

        return view('user.cart.itemDiscountCheckout', [
            'product_discounts' => $productDiscounts,
            'shipping_discounts' => $shippingDiscounts,
        ]);
    }

    public function applyVoucher(Request $request)
    {
        session()->forget('product-voucher-used');
        session()->forget('shipping-voucher-used');
        session()->save();

        $productVoucher = $request->product_voucher;
        $shippingVoucher = $request->shipping_voucher;
        $output = [];
        $totalPrice = session()->get('total-checkout-price');

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
}
