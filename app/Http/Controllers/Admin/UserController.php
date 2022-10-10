<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserTier;
use Illuminate\Http\Request;
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
            $users = User::where('role_id', 1)->orderBy('created_at', $request->sort)->where('tier_id', $request->filter)->paginate(10);
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
}
