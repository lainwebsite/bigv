<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function dashboard()
    {
        $newusers = User::where('role_id', 1)
            ->where('created_at', '<', Carbon::now())
            ->where('created_at', '>=', Carbon::now()->subDays(1))
            ->get();
        $transactions_daily = Transaction::orderBy('created_at', 'asc')
            ->where('created_at', '<', Carbon::now())
            ->where('created_at', '>=', Carbon::now()->subDays(1))
            ->withCount(['carts as sold_price' => function ($query) {
                $query->select(DB::raw('sum((quantity*price))'));
            }])
            ->get();
        $total_income = 0;
        foreach ($transactions_daily as $key => $transaction) {
            $total_income += $transaction->sold_price;
        }
        $transactions = Transaction::all();
        $transactiones = Transaction::orderBy('created_at', 'asc')
            ->where('created_at', '<=', Carbon::now())->where('created_at', '>=', Carbon::now()->subDays(7))
            ->withCount(['carts as sold_count' => function ($query) {
                $query->select(DB::raw('sum(quantity)'));
            }])->get();
        return view('admin.dashboard', compact('newusers', 'total_income', 'transactions', 'transactions_daily', 'transactiones'));
    }

    public function login()
    {
        return view('admin.auth.login');
    }
}
