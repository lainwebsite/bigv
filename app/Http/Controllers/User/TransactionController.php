<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $transactions = Transaction::with(['carts' => function ($query) {
        //     $query->with(['product_variation']);
        // }, 'transaction_discounts' => function ($query) {
        //     $query->with(['discount']);
        // }, 'billing_address', 'shipping_address', 'payment_method', 'pickup_method', 'pickup_time'])->get();

        // $transactions = Transaction::with(['carts' => function ($q1) {
        //     $q1->select('carts.id')
        //         ->join('product_variations', 'product_variations.id', '=', 'carts.product_variation_id')
        //         ->join('products', 'products.id', '=', 'product_variations.product_id')
        //         ->join('vendors', 'vendors.id', '=', 'products.vendors_id')
        //         ->get();
        // }])->get();

        // $transactions = Transaction::with(['carts' => function ($q1) {
        //     $q1->with(['product_variation' => function ($q2) {
        //         $q2->with(['product' => function ($q3) {
        //             $q3->with(['vendor' => function ($q4) {
        //                 $q4->with(['products' => function ($q) {
        //                     $q->select('vendor_id', 'carts.id as cart_id', 'products.featured_image', 'products.name as product_name', 'product_variations.name as product_variation_name', 'carts.price', 'carts.quantity', 'carts.user_id')
        //                         ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
        //                         ->join('carts', 'carts.product_variation_id', '=', 'product_variations.id')
        //                         ->join('transactions', 'transactions.id', '=', 'carts.transaction_id')
        //                         ->whereNotNull('carts.transaction_id')
        //                         ->where('carts.user_id', auth()->user()->id);
        //                 }])->whereHas('products', function ($q) {
        //                     $q->select('vendor_id')
        //                         ->join('product_variations', 'product_variations.product_id', '=', 'products.id')
        //                         ->join('carts', 'carts.product_variation_id', '=', 'product_variations.id')
        //                         ->join('transactions', 'transactions.id', '=', 'carts.transaction_id')
        //                         ->whereNotNull('carts.transaction_id')
        //                         ->where('carts.user_id', auth()->user()->id);
        //                 })->get();
        //             }]);
        //         }]);
        //     }]);
        // }])->get();

        // $transactions = Transaction::with(['carts' => function ($q1) {
        //     $q1->select('carts.transaction_id', 'vendors.id as vendor_id', 'product_variations.price')
        //         ->join('transactions', 'transactions.id', '=', 'carts.transaction_id') //
        //         ->join('product_variations', 'product_variations.id', '=', 'carts.product_variation_id')
        //         ->join('products', 'products.id', '=', 'product_variations.product_id')
        //         ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
        //         ->get()
        //         ->groupBy('vendor_id');
        // }])->whereHas('carts', function ($q1) {
        //     $q1->select('carts.transaction_id', 'vendors.id as vendor_id', 'product_variations.price')
        //         ->join('transactions', 'transactions.id', '=', 'carts.transaction_id') //
        //         ->join('product_variations', 'product_variations.id', '=', 'carts.product_variation_id')
        //         ->join('products', 'products.id', '=', 'product_variations.product_id')
        //         ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
        //         ->get()
        //         ->groupBy('vendor_id');
        // })->get();

        // $transactions = Transaction::with(['carts' => function ($q1) {
        //     $q1->select('carts.transaction_id', 'vendors.id as vendor_id', 'product_variations.price')
        //         ->join('transactions', 'transactions.id', '=', 'carts.transaction_id') //
        //         ->join('product_variations', 'product_variations.id', '=', 'carts.product_variation_id')
        //         ->join('products', 'products.id', '=', 'product_variations.product_id')
        //         ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
        //         ->whereNotNull('transaction_id')
        //         ->get()
        //         ->map(function ($row) {
        //             return $row->groupBy('vendor_id');
        //         });
        // }])->get();

        // $transactions = Transaction::where('user_id', auth()->user()->id)
        //     ->with(['carts' => function ($q1) {
        //         $q1->with(['product_variation' => function ($q2) {
        //             $q2->with(['product' => function ($q3) {
        //                 $q3->with(['vendor'])->orderBy('products.vendor_id', 'ASC');
        //             }]);
        //         }]);
        //     }])->get();

        $transactions = Transaction::where('user_id', auth()->user()->id)
            ->with(['carts' => function ($q1) {
                $q1->select(
                    'transaction_id',
                    'carts.id as cart_id',
                    'carts.quantity as qty',
                    'vendor_id',
                    'vendors.name as vendor_name',
                    'products.name as product_name',
                    'product_variations.name as product_variation_name',
                    'carts.price as product_price',
                )
                    ->join('product_variations', 'product_variations.id', '=', 'product_variation_id')
                    ->join('products', 'products.id', '=', 'product_variations.product_id')
                    ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
                    ->orderBy('products.vendor_id', 'ASC')
                    ->get();
            }, 'transaction_status'])->get();

        // dd($transactions);
        return view('user.transaction.history', ['transactions' => $transactions]);
        // return view('user.transaction.history');
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
        $transaction->load([
            'carts' => function ($query) {
                $query->with(['product_variation']);
            }, 'transaction_discounts' => function ($query) {
                $query->with(['discount']);
            }, 'billing_address', 'shipping_address', 'payment_method', 'pickup_method', 'pickup_time', 'transaction_status',
            'transaction_discounts' => function ($query) {
                $query->with(['discount']);
            }
        ]);

        $discounts = [];
        foreach ($transaction->transaction_discounts as $discount)
            $discounts[] = $discount->discount->name;
        $discounts = implode(", ", $discounts);

        return view('user.transaction.detail', ['transaction' => $transaction, 'discounts' => $discounts]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
