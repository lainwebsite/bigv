<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\UserAddress;
use App\Models\TransactionStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function view_analytics()
    {
        $transactions = Transaction::orderBy('created_at', 'asc')
            ->where('created_at', '<=', Carbon::now())->where('created_at', '>=', Carbon::now()->subDays(7))
            ->withCount(['carts as sold_count' => function ($query) {
                $query->select(DB::raw('sum(quantity)'));
            }])->paginate(10);
        $transactiones = Transaction::orderBy('created_at', 'asc')
            ->where('created_at', '<=', Carbon::now())->where('created_at', '>=', Carbon::now()->subDays(7))
            ->withCount(['carts as sold_count' => function ($query) {
                $query->select(DB::raw('sum(quantity)'));
            }])->get();
        return view('admin.analytics.orders.index', compact('transactions', 'transactiones'));
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
        
        if ($transaction->pickup_method_id == 1){
            $billingAddress = UserAddress::withTrashed()->where('id', $transaction->billing_address_id)->get()[0];
            if ($transaction->shipping_address_id != null){
                $shippingAddress = UserAddress::withTrashed()->where('id', $transaction->shipping_address_id)->get()[0];
            } else {
                $shippingAddress = null;
            }
        }
        else {
            $billingAddress = null;
            $shippingAddress = null;
        }
        return view('admin.manage.transaction.detail', compact('transaction', 'billingAddress', 'shippingAddress', 'statuses'));
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
            $transactions = Transaction::orderBy('created_at', $request->sort)
                ->where('status_id', $request->filter)
                ->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->search . '%');
                })
                ->paginate(10);
        } else {
            $transactions = Transaction::orderBy('created_at', $request->sort)
                ->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->search . '%');
                })
                ->paginate(10);
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
    public function change_status(Request $request)
    {
        $transaction_ids = explode(",", $request->transaction_id);
        $transactions = Transaction::whereIn('id', $transaction_ids)->get();

        foreach ($transactions as $key => $transaction) {
            $transaction->update([
                'status_id' => $request->status_id
            ]);
        }
        return redirect()->route('admin.transaction.index');
    }

    public function sort_analytics(Request $request)
    {
        if ($request->sort == "carts") {
            $transactions = Transaction::where('created_at', '>=', $request->start_date)
                ->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                ->withCount(['carts as sold_count' => function ($query) {
                    $query->select(DB::raw('sum(quantity)'));
                }])->orderBy('sold_count', 'desc')
                ->paginate(10);
        } else if ($request->sort == "total_price") {
            $transactions = Transaction::where('created_at', '>=', $request->start_date)
                ->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                ->withCount(['carts as sold_count' => function ($query) {
                    $query->select(DB::raw('sum(quantity)'));
                }])
                ->orderBy('total_price', 'desc')
                ->paginate(10);
        } else {
            $transactions = Transaction::where('created_at', '>=', $request->start_date)
                ->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                ->withCount(['carts as sold_count' => function ($query) {
                    $query->select(DB::raw('sum(quantity)'));
                }])
                ->orderBy('created_at', 'asc')
                ->paginate(10);
        }
        return view('admin.analytics.orders.inc.transaction', compact('transactions'));
    }

    public function date_analytics(Request $request)
    {
        $transactiones = Transaction::orderBy('created_at', 'asc')
            ->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
            ->where('created_at', '>=', $request->start_date)
            ->withCount(['carts as sold_count' => function ($query) {
                $query->select(DB::raw('sum(quantity)'));
            }])
            ->get();
        return $transactiones;
    }
}
