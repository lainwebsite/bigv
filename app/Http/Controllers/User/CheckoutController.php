<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\PickupMethod;
use App\Models\PickupTime;
use App\Models\ProductVariation;
use App\Models\UserAddress;
use App\Models\Transaction;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Paynow\Payments\Paynow;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function getCheckout(Request $request)
    {
        if (
            session()->has('checkout-items') &&
            session()->has('shipping-price') &&
            session()->has('total-checkout-price') &&
            session()->has('grandtotal-checkout-price') &&
            session()->has('total-checkout-items')
        ) {
            $addresses = UserAddress::where('user_id', auth()->user()->id)->get();

            $checkout_items = Vendor::with(['products' => function ($q1) {
                $q1->select('vendor_id', 'carts.id as cart_id', 'products.featured_image', 'products.name as product_name', 'product_variations.name as product_variation_name', 'carts.price', 'carts.quantity', 'carts.user_id')
                    ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
                    ->join('carts', 'carts.product_variation_id', '=', 'product_variations.id')
                    ->whereIn('carts.id', session()->get('checkout-items'))
                    ->whereNull('carts.transaction_id')
                    ->where('user_id', auth()->user()->id);
            }, 'location'])->whereHas('products', function ($q1) {
                $q1->select('vendor_id')
                    ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
                    ->join('carts', 'carts.product_variation_id', '=', 'product_variations.id')
                    ->whereIn('carts.id', session()->get('checkout-items'))
                    ->whereNull('carts.transaction_id')
                    ->where('user_id', auth()->user()->id);
            })->orderBy('id', 'ASC')->get();

            $pickup_methods = PickupMethod::all();
            $pickup_times = PickupTime::all();

            return view('user.cart.checkout', [
                'pickup_methods' => $pickup_methods,
                'pickup_times' => $pickup_times,
                'addresses' => $addresses,
                'checkouts' => $checkout_items,
                'total_price' => session()->get('total-checkout-price'),
                'total_items' => session()->get('total-checkout-items'),
                'shipping_price' => session()->get('shipping-price'),
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
                    $shipping_price = 30;

                    session()->put('total-checkout-items', $total_items);
                    session()->put('total-checkout-price', $total_price);
                    session()->put('grandtotal-checkout-price', $total_price + $shipping_price);
                    session()->put('shipping-price', $shipping_price);
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
        $request->validate([
            'quantity' => 'required|numeric',
            'product_variation_id' => 'required|numeric',
        ]);

        $productVariation = ProductVariation::where('id', $request->product_variation_id)->first();
        $cart = Cart::whereNull('transaction_id')->where('product_variation_id', $request->product_variation_id)->first();

        if ($request->quantity > 0) {
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

            $shipping_price = 30;

            $total_price = $cart->quantity * $cart->price; // WARNING (price can be updated by user)
            session()->put('total-checkout-items', $cart->quantity);
            session()->put('total-checkout-price', $total_price);
            session()->put('grandtotal-checkout-price', $total_price + $shipping_price);
            session()->put('shipping-price', $shipping_price);
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
            'delivery_date' => 'required|string|date_format:Y-m-h',
            // 'payment_method_id' => 'required|numeric',
            'pickup_method_id' => 'required|numeric',
            'pickup_time_id' => 'required|numeric',
            'billing_address_id' => 'required_without:self_collection_address_id|numeric',
            'self_collection_address_id' => 'required_without:billing_address_id|numeric',
            'shipping_address_id' => 'sometimes|required|numeric',
        ]);

        // $paynow = new Paynow(
        //     'INTEGRATION_ID',
        //     'INTEGRATION_KEY',
        //     'http://example.com/gateways/paynow/update',

        //     // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
        //     'http://example.com/return?gateway=paynow'
        // );
        // dd($paynow);

        $data = $request->all();
        $data += [
            'total_price' => session()->get('total-checkout-price'),
            'shipping_fee' => session()->get('shipping-price'),
            'user_id' => auth()->user()->id,
            'status_id' => 1, // default "Order Pending"
            'payment_method_id' => 1, // contoh
        ];

        $transaction = Transaction::create($data);

        // update transaction id in cart
        $checkout_items = session()->get('checkout-items');
        foreach ($checkout_items as $item) {
            Cart::where('id', $item)->update(['transaction_id' => $transaction->id]);
        }

        return redirect()->route('home');
    }

    public function atomePayment(Request $request)
    {
        $response = Http::post('https://api.apaylater.net/v2/payments', [
            "referenceId" => "123456789",
            "currency" => "SGD",
            "amount" => 12010,
            "callbackUrl" => "https://api.merchant-site.com/apaylater-callback",
            "paymentResultUrl" => "https://www.merchant-site.com/orders/2382178728179823",
            "customerInfo" => [
                "mobileNumber" => "+6587654321",
                "fullName" => "Atome Developer",
                "email" => "developer@atome.sg"
            ],
            "shippingAddress" => [
                "countryCode" => "SG",
                "lines" => [
                    "80 Robinson Road",
                    "#09-01",
                    "Singapore, 068898"
                ],
                "postCode" => "068898"
            ],
            "items" => [
                [
                    "itemId" => "P100",
                    "name" => "iPhone",
                    "price" => 11020,
                    "quantity" => 1,
                    "variationName" => "Black, 128GB",
                    "originalPrice" => 12020,
                    "categories" => [
                        "Electronics"
                    ]
                ],
                [
                    "itemId" => "P101",
                    "name" => "iPhone SE case",
                    "price" => 1000,
                    "quantity" => 1,
                    "variationName" => "White",
                    "categories" => [
                        "Accessories"
                    ]
                ]
            ]
        ]);
        // $response = Http::post('https://api.apaylater.net/v2/payments', [
        //     "referenceId" => "123456789",
        //     "currency" => "SGD",
        //     "amount" => 12010,
        //     "callbackUrl" => "https://api.merchant-site.com/apaylater-callback",
        //     "paymentResultUrl" => "https://www.merchant-site.com/orders/2382178728179823",
        //     "paymentCancelUrl" => "https://www.merchant-site.com/checkout",
        //     "merchantReferenceId" => "P1293201980299030",
        //     "customerInfo" => [
        //         "mobileNumber" => "+6587654321",
        //         "fullName" => "Atome Developer",
        //         "email" => "developer@atome.sg"
        //     ],
        //     "shippingAddress" => [
        //         "countryCode" => "SG",
        //         "lines" => [
        //             "80 Robinson Road",
        //             "#09-01",
        //             "Singapore, 068898"
        //         ],
        //         "postCode" => "068898"
        //     ],
        //     "billingAddress" => [
        //         "countryCode" => "SG",
        //         "lines" => [
        //             "80 Robinson Road",
        //             "#09-01",
        //             "Singapore, 068898"
        //         ],
        //         "postCode" => "068898"
        //     ],
        //     "taxAmount" => 655,
        //     "shippingAmount" => 1020,
        //     "originalAmount" => 13020,
        //     "items" => [
        //         [
        //             "itemId" => "P100",
        //             "name" => "iPhone",
        //             "price" => 11020,
        //             "quantity" => 1,
        //             "variationName" => "Black, 128GB",
        //             "originalPrice" => 12020,
        //             "categories" => [
        //                 "Electronics"
        //             ]
        //         ],
        //         [
        //             "itemId" => "P101",
        //             "name" => "iPhone SE case",
        //             "price" => 1000,
        //             "quantity" => 1,
        //             "variationName" => "White",
        //             "categories" => [
        //                 "Accessories"
        //             ]
        //         ]
        //     ]
        // ]);
    }
}
