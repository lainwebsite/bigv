<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserTier;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->where('role_id', 1)->paginate(10);
        $tiers = UserTier::all();
        return view('admin.manage.customers.index', compact('users', 'tiers'));
    }

    public function view_analytics()
    {
        $users = User::orderBy('created_at', 'asc')->where('role_id', 1)
            ->withCount(['carts as transaction_count' => function ($query) {
                $query->whereHas('transaction', function ($q) {
                    $q->where('created_at', '<=', Carbon::now())
                        ->where('created_at', '>=', Carbon::now()->subDays(7));
                })->select(DB::raw('count(distinct(transaction_id))'));
            }])->withCount(['carts as total_spent' => function ($query) {
                $query->whereHas('transaction', function ($q) {
                    $q->where('created_at', '<=', Carbon::now())
                        ->where('created_at', '>=', Carbon::now()->subDays(7));
                })->select(DB::raw('sum(carts.price * quantity)'));
            }])
            ->paginate(10);

        $fdate = Carbon::now();
        $tdate =  Carbon::now()->subDays(7);
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        $newusers = [];

        for ($i = 0; $i < $days; $i++) {
            $date = Carbon::now()->subDays($i - 1)->toDateString();
            $new_users = User::orderBy('created_at', 'asc')->where('role_id', 1)
                ->where('created_at', '<', Carbon::now()->subDays(($i - 1)))
                ->where('created_at', '>=', Carbon::now()->subDays($i))
                ->get();
            array_push($newusers, [
                'period' => $date,
                'customer' => $new_users->count(),
                'itouch' => 10,
            ]);
        }

        $allusers = User::where('role_id', 1)->get()->count();

        $transaction_ratio = [];
        for ($i = 0; $i < $days; $i++) {
            $date = Carbon::now()->subDays($i - 1)->toDateString();
            $transactions = Transaction::orderBy('created_at', 'asc')
                ->where('created_at', '<', Carbon::now()->subDays(($i - 1)))
                ->where('created_at', '>=', Carbon::now()->subDays($i))
                ->get();
            array_push($transaction_ratio, [
                'period' => $date,
                'ratio' => $transactions->count() / $allusers,
                'itouch' => 10,
            ]);
        }

        $average_spending = [];
        for ($i = 0; $i < $days; $i++) {
            $date = Carbon::now()->subDays($i - 1)->toDateString();
            $transactions = Transaction::orderBy('created_at', 'asc')
                ->where('created_at', '<', Carbon::now()->subDays(($i - 1)))
                ->where('created_at', '>=', Carbon::now()->subDays($i))
                ->withCount(['carts as sold_price' => function ($query) {
                    $query->select(DB::raw('sum((quantity*price))'));
                }])
                ->get();
            $total_spend = 0;
            foreach ($transactions as $key => $transaction) {
                $total_spend += $transaction->sold_price;
            }
            array_push($average_spending, [
                'period' => $date,
                'average' => $total_spend / $allusers,
                'itouch' => 10,
            ]);
        }

        return view('admin.analytics.customers.index', compact('users', 'newusers', 'transaction_ratio', 'average_spending'));
    }

    public function analytics_detail(User $user)
    {
        return view('admin.analytics.customers.detail', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = UserRole::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'role_id' => $request->role_id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.manage.customers.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = UserRole::all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->password) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'date_of_birth' => $request->date_of_birth,
                'role_id' => $request->role_id
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'role_id' => $request->role_id
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->ban == 1) {
            $user->update([
                'ban' => 0
            ]);
        } else {
            $user->update([
                'ban' => 1
            ]);
        }
        return redirect()->route('admin.user.show', $user->id);
    }

    public function sort(Request $request)
    {
        if ($request->filter) {
            if ($request->filter != "ban") {
                $users = User::where('role_id', 1)->orderBy('created_at', $request->sort)->where('tier_id', $request->filter)->paginate(10);
            } else {
                $users = User::where('role_id', 1)->orderBy('created_at', $request->sort)->where('ban', 1)->paginate(10);
            }
        } else {
            $users = User::where('role_id', 1)->orderBy('created_at', $request->sort)->paginate(10);
        }
        return view('admin.manage.customers.inc.user', compact('users'));
    }

    public function analytics(Request $request)
    {
        $transactions = Transaction::where('created_at', '>=', $request->start)
            ->where('created_at', '<=', date('Y-m-d', strtotime($request->end . ' + 1 days')))
            ->where("user_id", $request->id)->get();
        return view('admin.manage.customers.inc.analytics', compact('transactions'));
    }

    public function date_analytics(Request $request)
    {
        $fdate =  date('Y-m-d', strtotime($request->end_date . ' + 1 days'));
        $tdate = $request->start_date;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        $newusers = [];

        for ($i = 0; $i < $days; $i++) {
            $x = $i + 1;
            $date = date('Y-m-d', strtotime($fdate . " - $x days"));
            $new_users = User::orderBy('created_at', 'asc')->where('role_id', 1)
                ->where('created_at', '<', date('Y-m-d', strtotime($fdate . " - $i days")))
                ->where('created_at', '>=', date('Y-m-d', strtotime($fdate . " - $x days")))
                ->get();
            array_push($newusers, [
                'period' => $date,
                'customer' => $new_users->count(),
                'itouch' => 10,
            ]);
        }

        $allusers = User::where('role_id', 1)->get()->count();

        $transaction_ratio = [];

        for ($i = 0; $i < $days; $i++) {
            $x = $i + 1;
            $date = date('Y-m-d', strtotime($fdate . " - $x days"));
            $transactions = Transaction::orderBy('created_at', 'asc')
                ->where('created_at', '<', date('Y-m-d', strtotime($fdate . " - $i days")))
                ->where('created_at', '>=', date('Y-m-d', strtotime($fdate . " - $x days")))
                ->get();
            array_push($transaction_ratio, [
                'period' => $date,
                'ratio' => $transactions->count() / $allusers,
                'itouch' => 10,
            ]);
        }

        $average_spending = [];

        for ($i = 0; $i < $days; $i++) {
            $x = $i + 1;
            $date = date('Y-m-d', strtotime($fdate . " - $x days"));
            $transactions = Transaction::orderBy('created_at', 'asc')
                ->where('created_at', '<', date('Y-m-d', strtotime($fdate . " - $i days")))
                ->where('created_at', '>=', date('Y-m-d', strtotime($fdate . " - $x days")))
                ->withCount(['carts as sold_price' => function ($query) {
                    $query->select(DB::raw('sum((quantity*price))'));
                }])
                ->get();
            $total_spend = 0;
            foreach ($transactions as $key => $transaction) {
                $total_spend += $transaction->sold_price;
            }
            array_push($average_spending, [
                'period' => $date,
                'average' => $total_spend / $allusers,
                'itouch' => 10,
            ]);
        }

        $data = [
            "newusers" => $newusers,
            "transaction_ratio" => $transaction_ratio,
            "average_spending" => $average_spending
        ];

        return $data;
    }
    public function sort_analytics(Request $request)
    {
        $users = User::where('role_id', 1)
            ->withCount(['carts as transaction_count' => function ($query) use ($request) {
                $query->whereHas('transaction', function ($q) use ($request) {
                    $q->where('created_at', '>=', $request->start_date)
                        ->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')));
                })->select(DB::raw('count(distinct(transaction_id))'));
            }])->withCount(['carts as total_spent' => function ($query) use ($request) {
                $query->whereHas('transaction', function ($q) use ($request) {
                    $q->where('created_at', '>=', $request->start_date)
                        ->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')));
                })->select(DB::raw('sum(carts.price * quantity)'));
            }])
            ->paginate(10);
        if ($request->sort == "transaction_count") {
            $users = $users->orderBy('transaction_count', 'desc')->paginate(10);
        } else if ($request->sort == "total_spent") {
            $users = $users->orderBy('total_spent', 'desc')->paginate(10);
        } else {
            $users = $users->orderBy('created_at', 'asc')->paginate(10);
        }
        return view('admin.analytics.users.inc.user', compact('users'));
    }
}
