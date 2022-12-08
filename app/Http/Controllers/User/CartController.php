<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Vendor;
use App\Models\ProductVariation;
use App\Models\Product;
use App\Models\OptionCart;
use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // // $sub = OptionCart::join('addon_options', 'addon_options.id', '=', 'option_carts.cart_id')
        // //         ->select('addon_options.name as addon_name', 'option_carts.cart_id as cart_id')
        // //         ->toSql();
        
        // // $carts = Vendor::with(['products' => function ($q1) use ($sub) {
        // $carts = Vendor::with(['products' => function ($q1) {
        //     $q1->select('vendor_id', 'products.featured_image', 'products.name as product_name', 'product_variations.name as product_variation_name', 'carts.id as cart_id', 'carts.price', 'carts.quantity', 'carts.user_id'
        //         )
        //         // ,'addon_carts.addon_name')
        //         ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
        //         ->join('carts', 'carts.product_variation_id', '=', 'product_variations.id')
        //         // ->leftJoin(DB::raw('('. $sub .') as addon_carts'), 'addon_carts.cart_id', '=', 'carts.id')
        //         ->whereNull('carts.transaction_id')
        //         ->where('user_id', auth()->user()->id);
        // // }, 'location'])->whereHas('products', function ($q1) use ($sub) {
        // }, 'location'])->whereHas('products', function ($q1) {
        //     $q1->select('vendor_id')
        //         ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
        //         ->join('carts', 'carts.product_variation_id', '=', 'product_variations.id')
        //         // ->leftJoin(DB::raw('('. $sub .') as addon_carts'), 'addon_carts.cart_id', '=', 'carts.id')
        //         ->whereNull('carts.transaction_id')
        //         ->where('user_id', auth()->user()->id);
        // })->get();
        
        $sub = OptionCart::join('addon_options', 'addon_options.id', '=', 'option_carts.addon_option_id')
            ->select('addon_options.name as addon_name', 'addon_options.price as addon_price', 'option_carts.cart_id')
            ->toSql();
            
        $carts = Vendor::with(['products' => function ($q1) use ($sub) {
            $q1->select(
                'vendor_id',
                'products.featured_image',
                'products.name as product_name',
                'product_variations.name as product_variation_name',
                'product_variations.discount',
                'product_variations.discount_start_date',
                'product_variations.discount_end_date',
                'carts.id as cart_id',
                'carts.price',
                'carts.quantity',
                'carts.user_id',
                'addon_carts.addon_name',
                'addon_carts.addon_price'
            )
                ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
                ->join('carts', 'carts.product_variation_id', '=', 'product_variations.id')
                ->leftJoin(DB::raw('(' . $sub . ') as addon_carts'), 'addon_carts.cart_id', '=', 'carts.id')
                ->whereNull('carts.transaction_id')
                ->where('user_id', auth()->user()->id);
        }, 'location'])->whereHas('products', function ($q1) use ($sub) {
            $q1->select('vendor_id')
                ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
                ->join('carts', 'carts.product_variation_id', '=', 'product_variations.id')
                ->leftJoin(DB::raw('(' . $sub . ') as addon_carts'), 'addon_carts.cart_id', '=', 'carts.id')
                ->whereNull('carts.transaction_id')
                ->where('user_id', auth()->user()->id);
        })->get()->map(function ($vendor) {
            $addons_name = $vendor->products->mapToGroups(function ($item, $key) {
                return [$item['cart_id'] => $item['addon_name']];
            });
            $addons_price = $vendor->products->groupBy('cart_id')
                ->map(function ($item) {
                    return $item->sum('addon_price');
                });
            return (object) [
                'vendor' => (object) $vendor,
                'products' => $vendor->products->mapToGroups(function ($item, $key) use ($addons_name, $addons_price) {
                    $product = collect($item)->except(['addon_name', 'addon_price'])->toArray();
                    $product['price'] = $product['price'] + $addons_price[$product['cart_id']];
                    $product += [
                        'addons' => $addons_name[$product['cart_id']][0] == null ? [] : $addons_name[$product['cart_id']]->toArray()
                    ];
                    return (object) [$item['cart_id'] => $product];
                })->map(function ($product) {
                    return (object) collect($product)->unique('cart_id')->all()[0];
                })
            ];
        });
        // dd($carts);
        $productSuggestion = Product::withCount(['carts as items_sold' => function ($query) {
            $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
        }])->inRandomOrder()->limit(10)->get();

        return view('user.cart.index', ['carts' => $carts, 'productSuggestion'=>$productSuggestion]);
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
        $now = \Carbon\Carbon::now();
        try {
            $request->validate([
                'quantity' => 'required|numeric',
                'product_variation_id' => 'required|numeric',
                'product_addons_id' => 'sometimes|array',
            ]);

            $productVariation = ProductVariation::where('id', $request->product_variation_id)->first();
            $cart = Cart::whereNull('transaction_id')->where('user_id', auth()->user()->id)->where('product_variation_id', $request->product_variation_id)->first();

            if ($request->quantity > 0) {
                if ($cart == null) {
                    $data = $request->except('product_addons_id');
                    if ($productVariation->discount > 0 && 
                        $now->format("Y-m-d H:i:s") >= $productVariation->discount_start_date &&
                        $now->format("Y-m-d H:i:s") < $productVariation->discount_end_date) 
                    {
                        $data += [
                            'price' => $productVariation->discount,
                            'user_id' => auth()->user()->id,
                        ];
                    } else {
                        $data += [
                            'price' => $productVariation->price,
                            'user_id' => auth()->user()->id,
                        ];
                    }
                    
                    
                    $cart = Cart::create($data);
                    if ($request->product_addons_id) {
                        $product_addons_id = json_decode($request->product_addons_id, true);
                        if (count($request->product_addons_id) > 0) {
                            foreach ($request->product_addons_id as $addons_id) {
                                OptionCart::create([
                                    'addon_option_id' => $addons_id,
                                    'cart_id' => $cart->id
                                ]);
                            }
                        }
                    }
                } else {
                    $addon_cart = OptionCart::where('cart_id', $cart->id)->orderBy('id', 'ASC')->get();
                    if (count($addon_cart) <= 0) {
                        $qty = $cart->quantity + $request->quantity;
                        $cart->update([
                            'quantity' => $qty
                        ]);
                    } else {
                        $addons_db = implode("",$cart->toArray());
                        if ($request->product_addons_id != null) {
                            $product_addons_id = json_decode($request->product_addons_id, true);
                            $sorted_addons_req = $product_addons_id;
                            if (count($product_addons_id) > 1) {
                                $sorted_addons_req = sort($product_addons_id);
                            }
                            $addons_request = implode("",$sorted_addons_req);
                            
                            if ($addons_db == $addons_request) {
                                $qty = $cart->quantity + $request->quantity;
                                $cart->update([
                                    'quantity' => $qty
                                ]);
                            } else {
                                $data = $request->except('product_addons_id');
                                if ($productVariation->discount > 0 && 
                                    $now->format("Y-m-d H:i:s") >= $productVariation->discount_start_date &&
                                    $now->format("Y-m-d H:i:s") < $productVariation->discount_end_date) 
                                {
                                    $data += [
                                        'price' => $productVariation->discount,
                                        'user_id' => auth()->user()->id,
                                    ];
                                } else {
                                    $data += [
                                        'price' => $productVariation->price,
                                        'user_id' => auth()->user()->id,
                                    ];
                                }
                                
                                $cart = Cart::create($data);
                                if ($request->product_addons_id) {
                                    if (count($request->product_addons_id) > 0) {
                                        foreach ($request->product_addons_id as $addons_id) {
                                            OptionCart::create([
                                                'addon_option_id' => $addons_id,
                                                'cart_id' => $cart->id
                                            ]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                return "Please choose at least one product.";
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
                
                $addons_price = OptionCart::join('carts', 'carts.id', '=', 'option_carts.cart_id')
                                    ->join('addon_options', 'addon_options.id', '=', 'option_carts.addon_option_id')
                                    ->where('option_carts.cart_id', $cart->id)
                                    ->select('addon_options.price as addon_price')
                                    ->sum('addon_options.price');

                $cart['price'] = $cart['price'] + $addons_price;

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
            // return isset($errorInfo) ? $errorInfo : $cart->makeHidden(['id', 'product_variation_id', 'transaction_id', 'user_id', 'created_at', 'updated_at']);
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

        $currentCartProduct = Vendor::where('id', $cart->product_variation->product->vendor->id)->with(['products' => function ($q1) {
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
        
        try {
            $cart->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
        }

        return json_encode(isset($errorInfo) ? [
            'message' => "Error when delete this product. Please try again or contact our developer."
        ] : [
            'message' => "Successfully delete this product",
            'vendor_product_exist' => count($currentCartProduct),
            'vendor_id' => $cart->product_variation->product->vendor->id,
            'cart_id' => $cart->id
        ]);
    }
}
