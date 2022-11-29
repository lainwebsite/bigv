<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionStatus;
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
                    'carts.price as product_price',
                )
                    ->join('product_variations', 'product_variations.id', '=', 'product_variation_id')
                    ->join('products', 'products.id', '=', 'product_variations.product_id')
                    ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
                    ->orderBy('products.vendor_id', 'ASC')
                    ->get();
            }])->orderBy('created_at', 'DESC')->paginate(10);
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
                    'carts.price as product_price',
                )
                    ->join('product_variations', 'product_variations.id', '=', 'product_variation_id')
                    ->join('products', 'products.id', '=', 'product_variations.product_id')
                    ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
                    ->orderBy('products.vendor_id', 'ASC')
                    ->get();
            }])
            ->whereHas('transaction_status', function ($query) use ($status) {
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
