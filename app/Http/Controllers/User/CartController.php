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
    public function __construct()
    {
        \Artisan::call('cache:clear');
    }
    
    public function index()
    {
        $sub = OptionCart::join('addon_options', 'addon_options.id', '=', 'option_carts.addon_option_id')
            ->select('addon_options.name as addon_name', 'addon_options.price as addon_price', 'option_carts.cart_id')
            ->toSql();
            
        $carts = Vendor::with(['products' => function ($q1) use ($sub) {
            $q1->select(
                'vendor_id',
                'products.id as product_id',
                'products.featured_image',
                'products.name as product_name',
                'product_variations.name as product_variation_name',
                'product_variations.price as product_price',
                'product_variations.discount',
                'product_variations.discount_start_date',
                'product_variations.discount_end_date',
                'carts.id as cart_id',
                'carts.price as cart_price',
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
                    $product['product_price'] = $product['product_price'] + $addons_price[$product['cart_id']];
                    $product['cart_price'] = $product['cart_price'] + $addons_price[$product['cart_id']];
                    $product += [
                        'addons' => $addons_name[$product['cart_id']][0] == null ? [] : $addons_name[$product['cart_id']]->toArray()
                    ];
                    return (object) [$item['cart_id'] => $product];
                })->map(function ($product) {
                    return (object) collect($product)->unique('cart_id')->all()[0];
                })
            ];
        });
        
        $productSuggestion = Product::withCount(['carts as items_sold' => function ($query) {
            $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
        }])->inRandomOrder()->limit(10)->get();

        return view('user.cart.index', ['carts' => $carts, 'productSuggestion'=>$productSuggestion]);
    }

    public function store(Request $request)
    {
        $now = \Carbon\Carbon::now();
        try {
            $request->validate([
                'quantity' => 'required|numeric',
                'product_variation_id' => 'required|numeric',
                'product_addons_id' => 'sometimes|array',
            ]);
            
            $addons_request = '';
            $addons = [];
            if ($request->product_addons_id != null) {
                $product_addons_id = $request->product_addons_id;
                if (gettype($request->product_addons_id) == "string") {
                    $product_addons_id = json_decode($request->product_addons_id, true);
                    $addons = $product_addons_id;
                } else if (gettype($request->product_addons_id) == "array") {
                    $addons = $product_addons_id;
                }
                if (count($product_addons_id) > 1) sort($product_addons_id);
                $addons_request = join("",$product_addons_id);
            }

            $productVariation = ProductVariation::where('id', $request->product_variation_id)->first();

            // Mengambil semua cart berdasarkan (transaksi = null), (user id = auth()->user()->id), dan (product variation id) -->> disini kemungkinan cart dihasilkan lebih dari 1
            $temp_cart = Cart::whereNull('transaction_id')->where('user_id', auth()->user()->id)->where('product_variation_id', $request->product_variation_id)->pluck('id')->toArray();
            $cart = null;
            if ($temp_cart != null) {
                // Looping tiap cart dimana memiliki (product variation id = $request->product_variation_id)
                foreach ($temp_cart as $c) {
                    // Mengambil addon tiap cart
                    $temp_addons = OptionCart::where('cart_id', $c)->get()->implode('addon_option_id', '');
                    // Mengecek apakah addon pada cart sama dengan addon yang dikirimkan melalui ($request)
                    if ($temp_addons == $addons_request) {
                        $cart = Cart::whereNull('transaction_id')->where('user_id', auth()->user()->id)->where('id', $c)->first();
                        break;
                    }
                }
            }
            
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
                         $product_addons_id = $request->product_addons_id;
                        if (gettype($request->product_addons_id) == "string") {
                            $product_addons_id = json_decode($request->product_addons_id, true);
                        }
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
                    $addon_cart = OptionCart::where('cart_id', $cart->id)
                                    ->orderBy('id', 'ASC')
                                    ->pluck('addon_option_id')
                                    ->toArray();
                                        
                    // Check if cart has addons or not
                    if (count($addon_cart) <= 0) { 
                        $qty = $cart->quantity + $request->quantity;
                        $cart->update([
                            'quantity' => $qty
                        ]);
                    } else {
                        $addons_db = join("", $addon_cart);
                        
                        if ($addons_request != "") {
                            // return [$addons_db, $addons_request];
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

                $cart->price = $cart->price + $addons_price;

                $productVariation = ProductVariation::find($cart->product_variation_id);
                $productVariation->product->vendor;

                $cart->vendor_id = $productVariation->product->vendor->id;
                $cart->vendor_name = $productVariation->product->vendor->name;
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
    
    public function destroy(Cart $cart)
    {
        $vendor_id = $cart->product_variation->product->vendor->id;
        $output = [
            'message' => "Error when delete this product. Please try again or contact our developer."
        ];

        try {
            $cart->delete();
            
            $currentCartProduct = Vendor::where('id', $vendor_id)->with(['products' => function ($q1) {
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
            })->first();
            
            $output = [
                'message' => "Successfully delete this product",
                'vendor_product_exist' => $currentCartProduct == null ? 0 : 1,
                'vendor_id' => $cart->product_variation->product->vendor->id,
                'cart_id' => $cart->id
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
        }

        return response()->json($output);
    }
}
