<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\PaymentGateway\PaynowController;
use App\Models\Cart;
use App\Models\PickupMethod;
use App\Models\PickupTime;
use App\Models\ProductVariation;
use App\Models\UserAddress;
use App\Models\Transaction;
use App\Models\OptionCart;
use App\Models\Vendor;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Traits\Tappable;
use DB;

class CheckoutController extends Controller
{
    public function getCheckout(Request $request)
    {
        if (
            session()->has('checkout-items') &&
            session()->has('total-checkout-price') &&
            session()->has('grandtotal-checkout-price') &&
            session()->has('total-checkout-items')
        ) {
            $addresses = UserAddress::where('user_id', auth()->user()->id)->get();
            
            $sub = OptionCart::join('addon_options', 'addon_options.id', '=', 'option_carts.addon_option_id')
                ->select('addon_options.name as addon_name', 'addon_options.price as addon_price', 'option_carts.cart_id')
                ->toSql();
                
            $checkout_items = Vendor::with(['products' => function ($q1) use ($sub) {
                $q1->select(
                    'vendor_id',
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
                    ->whereIn('carts.id', session()->get('checkout-items'))
                    ->whereNull('carts.transaction_id')
                    ->where('user_id', auth()->user()->id);
            }, 'location'])->whereHas('products', function ($q1) use ($sub) {
                $q1->select('vendor_id')
                    ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
                    ->join('carts', 'carts.product_variation_id', '=', 'product_variations.id')
                    ->leftJoin(DB::raw('(' . $sub . ') as addon_carts'), 'addon_carts.cart_id', '=', 'carts.id')
                    ->whereIn('carts.id', session()->get('checkout-items'))
                    ->whereNull('carts.transaction_id')
                    ->where('user_id', auth()->user()->id);
            })->orderBy('id', 'ASC')->get()->map(function ($vendor) {
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
            
            $pickup_methods = PickupMethod::all();
            $pickup_times = PickupTime::all();

            $first_address_id = (count($addresses) > 0) ? $addresses[0]->id : 0;
            return view('user.cart.checkout', [
                'pickup_methods' => $pickup_methods,
                'pickup_times' => $pickup_times,
                'first_address_id' => $first_address_id,
                'checkouts' => $checkout_items,
                'total_price' => session()->get('total-checkout-price'),
                'total_items' => session()->get('total-checkout-items'),
                'shipping_price' => (float) env('SHIPPING_PRICE'),
                'grandtotal_price' => session()->get('grandtotal-checkout-price'),
            ]);
        }

        return redirect()->back();
    }

    public function preCheckout(Request $request)
    {
        $carts = json_decode($request->carts, true);

        $cart_checkout_id = [];
        $total_price = 0;
        $total_items = 0;
        if (isset($carts)) {
            if (count($carts) > 0) {
                foreach ($carts as $cart) {
                    array_pop($cart);

                    foreach ($cart as $cart_id => $product) {
                        if (isset($product['sub_total_price']) && isset($product['quantity'])) {
                            $cart_checkout_id[] = $cart_id;
                            $total_price += $product['sub_total_price'];
                            $total_items += $product['quantity'];
                        }
                    }
                }

                if (count($cart_checkout_id) > 0) {
                    $shipping_price = (float) env('SHIPPING_PRICE');

                    session()->put('total-checkout-items', $total_items);
                    session()->put('total-checkout-price', $total_price);
                    session()->put('grandtotal-checkout-price', $total_price + $shipping_price);
                    session()->put('checkout-items', $cart_checkout_id);
                    session()->save();

                    return redirect('/user/cart/checkout');
                }
            }
        }

        return redirect()->back();
    }

    public function buyNowCheckout(Request $request)
    {
        if ($request->product_addons_id != "" || $request->product_addons_id != null) {
            $request['product_addons_id'] = json_decode($request->product_addons_id);
        }
        
        $request->validate([
            'quantity' => 'required|numeric',
            'product_variation_id' => 'required|numeric',
            'product_addons_id' => 'sometimes|nullable|array',
        ]);
        
        $productVariation = ProductVariation::where('id', $request->product_variation_id)->first();
        $cart = Cart::whereNull('transaction_id')->where('user_id', auth()->user()->id)->where('product_variation_id', $request->product_variation_id)->first();
        if ($productVariation == null) {
            return redirect()->back()->with('error', 'Please choose at least one product.');
        }
        
        if ($request->quantity > 0) {
            $now = \Carbon\Carbon::now()->format("Y-m-d H:i:s");
            
            if ($cart != null) {
                $addon_cart = OptionCart::where('cart_id', $cart->id)
                                ->orderBy('id', 'ASC')
                                ->pluck('addon_option_id')
                                ->toArray();
                                
                if (count($addon_cart) <= 0) { 
                    $qty = $cart->quantity + $request->quantity;
                    $dataUpdated = [
                        'quantity' => $qty,
                        'price' => ($productVariation->discount != 0 && ($now >= $productVariation->discount_start_date) && ($now < $productVariation->discount_end_date)) ? $productVariation->discount : $productVariation->price
                    ];

                    $cart = tap($cart)->update($dataUpdated);
                } else {
                    $addons_db = join("", $addon_cart);

                    if ($request->product_addons_id != null) {
                         $product_addons_id = $request->product_addons_id;
                        if (gettype($request->product_addons_id) == "string") $product_addons_id = json_decode($request->product_addons_id, true);
                        if (count($product_addons_id) > 1) sort($product_addons_id);
                        $addons_request = join("",$product_addons_id);

                        // Check if cart has addons or not
                        if ($addons_db == $addons_request) {
                            $qty = $cart->quantity + $request->quantity;
                            $dataUpdated = [
                                'quantity' => $qty,
                                'price' => ($productVariation->discount != 0 && ($now >= $productVariation->discount_start_date) && ($now < $productVariation->discount_end_date)) ? $productVariation->discount : $productVariation->price
                            ];
                            
                            $cart = tap($cart)->update($dataUpdated);
                        } else {
                            $data = $request->except('product_addons_id');
                            $data += [
                                'price' => ($productVariation->discount != 0 && ($now >= $productVariation->discount_start_date) && ($now < $productVariation->discount_end_date)) ? $productVariation->discount : $productVariation->price,
                                'user_id' => auth()->user()->id,
                            ];
                            
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
            } else {
                $data = $request->except('product_addons_id');
                $data += [
                    'price' => ($productVariation->discount != 0 && ($now >= $productVariation->discount_start_date) && ($now < $productVariation->discount_end_date)) ? $productVariation->discount : $productVariation->price,
                    'user_id' => auth()->user()->id,
                ];
                
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
            
            $addons_price = OptionCart::join('carts', 'carts.id', '=', 'option_carts.cart_id')
                                ->join('addon_options', 'addon_options.id', '=', 'option_carts.addon_option_id')
                                ->where('option_carts.cart_id', $cart->id)
                                ->select('addon_options.price as addon_price')
                                ->sum('addon_options.price');

            $cart->price = $cart->price + $addons_price;

            $shipping_price = (float) env('SHIPPING_PRICE');

            $total_price = $cart->quantity * $cart->price;
            session()->put('total-checkout-items', $cart->quantity);
            session()->put('total-checkout-price', $total_price);
            session()->put('grandtotal-checkout-price', $total_price + $shipping_price);
            session()->put('checkout-items', [$cart->id]);
            session()->save();

            return redirect('/user/cart/checkout');
        } else {
            return redirect()->back()->with('error', 'Please choose at least one product.'); // di UI belum ada modal error
        }

        return redirect()->back();
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'delivery_date' => 'string|date_format:Y-m-d',
            // 'payment_method_id' => 'required|numeric',
            'pickup_method_id' => 'required|numeric',
            'pickup_time_id' => 'required|numeric',
            'billing_address_id' => 'required_without:self_collection_address_id|numeric',
            'self_collection_address_id' => 'required_without:billing_address_id|numeric',
            'shipping_address_id' => 'sometimes|required|numeric',
        ]);
        
        if (!session()->has('grandtotal-checkout-price') || !session()->has('checkout-items')) {
            return redirect('/user/cart');
        }
        
        $grandtotal_checkout_price = (float) session()->get('grandtotal-checkout-price', 0);
        if (session()->has('total-price-after-discount')) {
            $grandtotal_checkout_price = (float) session()->get('total-price-after-discount', 0);
        }
        
        $shipping_price = (float) env('SHIPPING_PRICE');
        if ($request->pickup_method_id == 2) {
            $grandtotal_checkout_price -= (float) $shipping_price;
            $shipping_price = 0;
        }

        $data = $request->all();
        $data += [
            'total_price' => $grandtotal_checkout_price,
            'shipping_fee' => $shipping_price,
            'user_id' => auth()->user()->id,
            'status_id' => 1, // default "Order Pending"
            'payment_method_id' => 2, // Pay Now
            'product_discount_total' => session()->get('total-discount-product', 0),
            'shipping_discount_total' => session()->get('total-discount-shipping', 0),
        ];

        $transaction = Transaction::create($data);

        // update transaction id in cart
        $checkout_items = session()->get('checkout-items');
        foreach ($checkout_items as $item) {
            Cart::where('id', $item)->update(['transaction_id' => $transaction->id]);
        }

        $paynow = new PaynowController();
        return $paynow->pay($grandtotal_checkout_price, $transaction->id);
    }

    public function transitStatusPayment(Request $request)
    {
        $target = Carbon::now()->addSeconds(10);
        $transaction_id = $request->get('id', 0);
        do {
            $now = Carbon::now();
            $timeDiff = $target->diffInRealSeconds($now);
            $transaction = Transaction::where('id', $transaction_id)->first();

            if ($transaction->status_id == 2) {
                break;
            }
        } while ($timeDiff > 0);

        return redirect('/user/transaction');
    }
    
    public function rePayment(Request $request)
    {
        $transaction_id = $request->get('transaction_id', 0);
        $transaction = Transaction::where('user_id', auth()->user()->id)->where('id', $transaction_id)->first();
        
        if ($transaction->status_id == 1) {
            $paynow = new PaynowController();
            return $paynow->pay($transaction->total_price, $transaction->id);
        }
        
        return redirect()->back();
    }
}
