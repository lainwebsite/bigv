<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(10);
        $transactiones = Transaction::all();
        $statuses = TransactionStatus::all();
        return view('admin.manage.transaction.index', compact('transactions', 'transactiones', 'statuses'));
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
        $statuses = TransactionStatus::all();
        return view('admin.manage.transaction.detail', compact('transaction', 'statuses'));
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

    public function sort(Request $request)
    {
        if ($request->filter) {
            $transactions = Transaction::orderBy('created_at', $request->sort)->where('status_id', $request->filter)->paginate(10);
        } else {
            $transactions = Transaction::orderBy('created_at', $request->sort)->paginate(10);
        }
        return view('admin.manage.transaction.inc.transaction', compact('transactions'));
    }
    public function status(Request $request, Transaction $transaction)
    {
        $transaction->update([
            'status_id' => $request->status_id,
        ]);
        return $transaction;
    }
}
