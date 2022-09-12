<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        $transactions = Transaction::with(['carts' => function ($query) {
            $query->with(['product_variation']);
        }, 'transaction_discounts' => function ($query) {
            $query->with(['discount']);
        }, 'billing_address', 'shipping_address', 'payment_method', 'pickup_method', 'pickup_time'])->get();

        return view('user.transaction.history', ['transactions' => $transactions]);
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
