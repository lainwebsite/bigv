<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Vendor;
use App\Models\ProductVariation;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
    public function __construct()
    {
        session()->forget('total-checkout-price');
        session()->forget('checkout-items');
        session()->save();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Vendor::with(['products' => function ($q1) {
            $q1->select('vendor_id', 'carts.id as cart_id', 'products.featured_image', 'products.name as product_name', 'product_variations.name as product_variation_name', 'carts.price', 'carts.quantity', 'carts.user_id')
                ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
                ->join('carts', 'carts.product_variation_id', '=', 'product_variations.id')
                ->whereNull('carts.transaction_id')
                ->where('user_id', auth()->user()->id);
        }, 'location'])->whereHas('products', function ($q1) {
            $q1->select('vendor_id')
                ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
                ->join('carts', 'carts.product_variation_id', '=', 'product_variations.id')
                ->whereNull('carts.transaction_id')
                ->where('user_id', auth()->user()->id);
        })->get();

        return view('user.cart.index', ['carts' => $carts]);
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
        try {
            $request->validate([
                'quantity' => 'required|numeric',
                'product_variation_id' => 'required|numeric',
            ]);

            $productVariation = ProductVariation::where('id', $request->product_variation_id)->first();
            $cart = Cart::whereNull('transaction_id')->where('product_variation_id', $request->product_variation_id)->first();

            if ($cart == null) {
                $data = $request->all();
                $data += [
                    'price' => $productVariation->price,
                    'user_id' => auth()->user()->id,
                ];
                $cart = Cart::create($data);
            } else {
                $qty = $cart->quantity + $request->quantity;
                $cart->update([
                    'quantity' => $qty
                ]);
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
        }

        return isset($errorInfo) ? "There is an error when adding product to cart. Please try again or contact our developer." : "Product has been successfully added to your cart.";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */

    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $productDeleted = false;
        try {
            $request->validate([
                'quantity' => 'required|numeric',
            ]);

            $quantity = (int) $request->quantity;

            if ($quantity <= 0) {
                $cart->delete();
                $productDeleted = true;
            } else {
                if ($quantity != $cart->quantity) {
                    $cart->update([
                        'quantity' => $quantity
                    ]);
                }

                $productVariation = ProductVariation::find($cart->product_variation_id);
                $productVariation->product->vendor;

                $cart['vendor_id'] = $productVariation->product->vendor->id;
                $cart['vendor_name'] = $productVariation->product->vendor->name;
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
        }

        if ($productDeleted) {
            return isset($errorInfo) ? "There is an error when deleting product in the cart. Please try again or contact our developer." : "Product in the cart has been deleted.";
        } else {
            return isset($errorInfo) ? "There is an error when update product in the cart. Please try again or contact our developer." : $cart->makeHidden(['id', 'product_variation_id', 'transaction_id', 'user_id', 'created_at', 'updated_at']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->product_variation->product->vendor;

        try {
            $cart->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
        }

        return json_encode(isset($errorInfo) ? [
            'message' => "Error when delete this product. Please try again or contact our developer."
        ] : [
            'message' => "Successfully delete this product",
            'vendor_id' => $cart->product_variation->product->vendor->id,
            'cart_id' => $cart->id
        ]);
    }
}
