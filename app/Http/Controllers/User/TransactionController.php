<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\UserAddress;
use App\Models\Transaction;
use App\Models\OptionCart;
use App\Models\TransactionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $transactions = Transaction::where('user_id', auth()->user()->id)
        //     ->with(['carts' => function ($q1) {
        //         $q1->select(
        //             'transaction_id',
        //             'carts.id as cart_id',
        //             'carts.quantity as qty',
        //             'vendor_id',
        //             'vendors.name as vendor_name',
        //             'vendors.photo as vendor_photo',
        //             'products.name as product_name',
        //             'products.featured_image as product_featured_image',
        //             'product_variations.name as product_variation_name',
        //             'carts.price as product_price'
        //         )
        //             ->join('product_variations', 'product_variations.id', '=', 'product_variation_id')
        //             ->join('products', 'products.id', '=', 'product_variations.product_id')
        //             ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
        //             ->orderBy('products.vendor_id', 'ASC')
        //             ->get();
        //     }])->orderBy('created_at', 'DESC')->paginate(10);
        $sub = OptionCart::join('addon_options', 'addon_options.id', '=', 'option_carts.addon_option_id')
                ->select('addon_options.name as addon_name', 'addon_options.price as addon_price', 'option_carts.cart_id')
                ->toSql();
        
        $transactions = Transaction::where('user_id', auth()->user()->id)
            ->with(['carts' => function ($q1) use ($sub) {
                $q1->select(
                    'transaction_id',
                    'carts.id as cart_id',
                    'carts.quantity as qty',
                    'carts.price as cart_price',
                    'vendor_id',
                    'vendors.name as vendor_name',
                    'vendors.photo as vendor_photo',
                    'products.id as product_id',
                    'products.name as product_name',
                    'products.featured_image as product_featured_image',
                    'product_variations.name as product_variation_name',
                    'product_variations.price as product_price',
                    'product_variations.discount',
                    'addon_carts.addon_name',
                    'addon_carts.addon_price'
                )
                    ->join('product_variations', 'product_variations.id', '=', 'product_variation_id')
                    ->join('products', 'products.id', '=', 'product_variations.product_id')
                    ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
                    ->leftJoin(DB::raw('(' . $sub . ') as addon_carts'), 'addon_carts.cart_id', '=', 'carts.id')
                    ->orderBy('products.vendor_id', 'ASC')
                    ->get();
            }])->orderBy('created_at', 'DESC')->paginate(10)->map(function ($transaction) {
                $addons_name = $transaction->carts->mapToGroups(function ($item, $key) {
                    return [$item['cart_id'] => $item['addon_name']];
                });
                $addons_price = $transaction->carts->groupBy('cart_id')
                    ->map(function ($item) {
                        return $item->sum('addon_price');
                    });
                
                $transaction->cart_customs = $transaction->carts->mapToGroups(function ($item, $key) use ($addons_name, $addons_price) {
                        $product = collect($item)->except(['addon_name', 'addon_price'])->toArray();
                        $product['product_price'] = $product['product_price'] + $addons_price[$product['cart_id']];
                        $product['cart_price'] = $product['cart_price'] + $addons_price[$product['cart_id']];
                        $product += [
                            'addons' => $addons_name[$product['cart_id']][0] == null ? [] : implode(', ', $addons_name[$product['cart_id']]->toArray())
                        ];

                        return [(object) $product];
                    })->map(function ($product) {
                        return collect($product)->unique('cart_id');
                    })->first();
                return $transaction;
            })->paginate(10);

        $transaction_statuses = TransactionStatus::all();
        
        return view('user.transaction.history', [
            'transactions' => $transactions,
            'transaction_status' => $transaction_statuses,
        ]);
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $sub = OptionCart::join('addon_options', 'addon_options.id', '=', 'option_carts.addon_option_id')
                ->select('addon_options.name as addon_name', 'addon_options.price as addon_price', 'option_carts.cart_id')
                ->toSql();
        
        $data = Transaction::where('id', $transaction->id)
            ->with(['carts' => function ($q1) use ($sub) {
                $q1->select(
                    'transaction_id',
                    'carts.id as cart_id',
                    'carts.quantity as qty',
                    'carts.price as cart_price',
                    'vendor_id',
                    'vendors.name as vendor_name',
                    'vendors.photo as vendor_photo',
                    'products.id as product_id',
                    'products.name as product_name',
                    'products.featured_image as product_featured_image',
                    'product_variations.name as product_variation_name',
                    'product_variations.price as product_price',
                    'product_variations.discount',
                    'addon_carts.addon_name',
                    'addon_carts.addon_price'
                )
                    ->join('product_variations', 'product_variations.id', '=', 'product_variation_id')
                    ->join('products', 'products.id', '=', 'product_variations.product_id')
                    ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
                    ->leftJoin(DB::raw('(' . $sub . ') as addon_carts'), 'addon_carts.cart_id', '=', 'carts.id')
                    ->orderBy('products.vendor_id', 'ASC')
                    ->get();
            }])->get()->map(function ($transaction) {
                $addons_name = $transaction->carts->mapToGroups(function ($item, $key) {
                    return [$item['cart_id'] => $item['addon_name']];
                });
                $addons_price = $transaction->carts->groupBy('cart_id')
                    ->map(function ($item) {
                        return $item->sum('addon_price');
                    });

                return (object) [
                    'transaction' => $transaction,
                    'carts' => $transaction->carts->mapToGroups(function ($item, $key) use ($addons_name, $addons_price) {
                        $product = collect($item)->except(['addon_name', 'addon_price'])->toArray();
                        $product['product_price'] = $product['product_price'] + $addons_price[$product['cart_id']];
                        $product['cart_price'] = $product['cart_price'] + $addons_price[$product['cart_id']];
                        $product += [
                            'addons' => $addons_name[$product['cart_id']][0] == null ? [] : implode(', ', $addons_name[$product['cart_id']]->toArray())
                        ];

                        return [(object) $product];
                    })->map(function ($product) {
                        return collect($product)->unique('cart_id');
                    })->first()
                ];
            })->first();

        if ($data->transaction->pickup_method_id == 1){
            $billingAddress = UserAddress::withTrashed()->where('id', $data->transaction->billing_address_id)->get()[0];
            if ($data->transaction->shipping_address_id != null){
                $shippingAddress = UserAddress::withTrashed()->where('id', $data->transaction->shipping_address_id)->get()[0];
            } else {
                $shippingAddress = null;
            }
        }
        else {
            $billingAddress = null;
            $shippingAddress = null;
        }
        
        $statusPayment = 0;
        if ($data->transaction->status_id == 1) {
            if ($data->transaction->payment_request_id) {
                try {
                    $response = Http::withHeaders([
                        'X-BUSINESS-API-KEY' => '7cf06a78a52b715c117bca86fe326e3fffdc1288b9b6c5ed2fdaf102983477b7', // test
                        // 'X-BUSINESS-API-KEY' => 'b17440ac8264ee31eead33c6ae3846d2c13b1d4a368d43af84ec39d643162270',
                        'X-Requested-With' => 'XMLHttpRequest',
                        'accept' => 'application/json',
                        'content-type' => 'application/json'
                    ])->get('https://api.sandbox.hit-pay.com/v1/payment-requests/'.$data->transaction->payment_request_id);
                    
                    $responseJSON = json_decode($response->getBody()->getContents());
                    if ($responseJSON->status == 'completed') {
                        Transaction::where('id', $data->transaction->id)
                                ->update(['status_id' => 2]);
                        $statusPayment = 1;
                    }
                } catch (\GuzzleHttp\Exception\RequestException $ex) {
                    dd($ex->getResponse()->getBody()->getContents());
                }
            }
        }

        $discounts = [];
        foreach ($transaction->transaction_discounts as $discount)
            $discounts[] = $discount->discount->name;
        $discounts = implode(", ", $discounts);
        
        return view('user.transaction.detail', [
            'transaction' => $data, 
            'billingAddress'=>$billingAddress, 
            'shippingAddress'=>$shippingAddress, 
            'discounts' => $discounts,
            'statusPayment' => $statusPayment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    public function filter(Request $request)
    {
        $status = $request->get('status', '');

        $transactions = Transaction::where('user_id', auth()->user()->id)
            ->with(['carts' => function ($q1) {
                $q1->select(
                    'transaction_id',
                    'carts.id as cart_id',
                    'carts.quantity as qty',
                    'vendor_id',
                    'vendors.name as vendor_name',
                    'vendors.photo as vendor_photo',
                    'products.name as product_name',
                    'products.featured_image as product_featured_image',
                    'product_variations.name as product_variation_name',
                    'carts.price as product_price'
                )
                    ->join('product_variations', 'product_variations.id', '=', 'product_variation_id')
                    ->join('products', 'products.id', '=', 'product_variations.product_id')
                    ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
                    ->orderBy('products.vendor_id', 'ASC')
                    ->get();
            }])
            ->whereHas('status', function ($query) use ($status) {
                $query->where('id', $status);
            })->orderBy('created_at', 'DESC')->paginate(10);
        $transaction_statuses = TransactionStatus::all();

        return view('user.transaction.history', [
            'transactions' => $transactions,
            'transaction_status' => $transaction_statuses,
            'status_selected' => $status
        ]);
    }
}
