<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
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
        //
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function showEditProfile()
    {
        return view('user.editProfile');
    }

    public function editProfile(Request $request)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'phone' => ['sometimes', 'required', 'regex:/^((\+65)|(65)|0)\d{7,10}$/', 'min:10', 'max:15'],
            'date_of_birth' => 'sometimes|required|date_format:Y-m-d',
        ]);

        $user = auth()->user();
        if ($request->password != null) {
            $request->validate([
                'password' => 'required|confirmed|min:8'
            ]);

            $data = $request->except('email');
            $data['password'] = bcrypt($request->password);

            $user->update($data);
        } else {
            $user->update($request->except('email', 'password'));
        }


        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
