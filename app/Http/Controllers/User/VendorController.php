<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::paginate(20);

        return view('user.vendor.index', compact('vendors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        $vendor = Vendor::where('id', $vendor->id)->withCount(['carts as items_sold' => function ($query) {
            $query->whereHas('transaction')->select(DB::raw('count(*)'));
        }])->first();

        $products = Product::where('vendor_id', $vendor->id)->paginate(20);

        return view('user.vendor.detail', compact('vendor', 'products'));
    }
}
