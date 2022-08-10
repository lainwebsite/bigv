<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
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
        $address = UserAddress::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'additional_info' => $request->additional_info,
            'street' => $request->street,
            'condo' => $request->condo,
            'estate' => $request->estate,
            'label' => $request->label,
            'house_number' => $request->house_number,
            'unit_number' => $request->unit_number,
            'postal_code' => $request->postal_code,
            'user_id' => $request->user_id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function show(UserAddress $userAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAddress $userAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAddress $userAddress)
    {
        $userAddress->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'additional_info' => $request->additional_info,
            'street' => $request->street,
            'condo' => $request->condo,
            'estate' => $request->estate,
            'label' => $request->label,
            'house_number' => $request->house_number,
            'unit_number' => $request->unit_number,
            'postal_code' => $request->postal_code,
            'user_id' => $request->user_id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAddress $userAddress)
    {
        $userAddress->delete();
    }
}
