<?php

namespace App\Http\Controllers\User;

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
        $addresses = UserAddress::where('user_id', auth()->user()->id)->get();
        return view('user.address.index', ['addresses' => $addresses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^((\+65)|(65)|0)\d{7,10}$/', 'min:10', 'max:15'],
            'additional_info' => 'nullable|string',
            'street' => 'nullable|string|max:255',
            'building_name' => 'nullable|string|max:255',
            'unit_level' => 'nullable|string|max:255',
            'block_number' => 'nullable|string|max:255',
            'unit_number' => 'nullable|string|max:255',
            'postal_code' => 'required|string|max:6',
        ]);

        $data = $request->all();
        $data += ['user_id' => auth()->user()->id];

        UserAddress::create($data);

        return redirect('user/user-address')->with('success', 'New Address created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function show(UserAddress $userAddress)
    {
        return view('user.address.show', ['address' => $userAddress]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAddress $userAddress)
    {
        return view('user.address.edit', ['address' => $userAddress]);
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
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'phone' => ['sometimes', 'required', 'regex:/^((\+65)|(65)|0)\d{7,10}$/', 'min:10', 'max:15'],
            'additional_info' => 'sometimes|nullable|string',
            'street' => 'sometimes|nullable|string|max:255',
            'building_name' => 'sometimes|nullable|string|max:255',
            'unit_level' => 'sometimes|nullable|string|max:255',
            'block_number' => 'sometimes|nullable|string|max:255',
            'unit_number' => 'sometimes|nullable|string|max:255',
            'postal_code' => 'sometimes|required|string|max:6',
        ]);

        $userAddress->fill($request->all())->save();

        return redirect('user/user-address')->with('success', 'Address updated successfully.');
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

        return redirect('user/user-address')->with('success', 'Address deleted successfully.');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $addresses = UserAddress::where('user_id', auth()->user()->id)->get();

        if (isset($keyword)) {
            $addresses = UserAddress::where('user_id', auth()->user()->id)
                ->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('street', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('building_name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('unit_level', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('block_number', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('unit_number', 'LIKE', '%' . $keyword . '%');
                })
                ->get();
        }

        if (isset($addresses)) {
            return view('user.cart.itemAddressCheckout', ['addresses' => $addresses]);
        }
    }

    public function createAddressAJAX(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^((\+65)|(65)|0)\d{7,10}$/'],
            'additional_info' => 'nullable|string',
            'street' => 'nullable|string|max:255',
            'building_name' => 'nullable|string|max:255',
            'unit_level' => 'nullable|string|max:255',
            'block_number' => 'nullable|string|max:255',
            'unit_number' => 'nullable|string|max:255',
            'postal_code' => 'required|string|max:6',
        ]);

        $data = $request->all();
        $data += ['user_id' => auth()->user()->id];

        UserAddress::create($data);

        return 'New Address created successfully.';
    }

    public function getAddressAJAX(UserAddress $userAddress)
    {
        return $userAddress;
    }
}
