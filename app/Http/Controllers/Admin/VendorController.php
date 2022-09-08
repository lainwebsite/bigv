<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorLocation;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::orderBy('created_at', 'desc')->paginate(10);
        $locations = VendorLocation::all();
        return view('admin.manage.vendors.index', compact('vendors', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = VendorLocation::all();
        return view('admin.manage.vendors.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo = 'vendor-' . time() . '-' . $request['photo']->getClientOriginalName();
        $request->photo->move(public_path('uploads'), $photo);
        $vendor = Vendor::create([
           'name' => $request->name,
           'phone' => $request->phone,
           'email' => $request->email,
           'description' => $request->description,
           'location_id' => $request->location,
           'photo' => $photo
        ]);
        return redirect()->route('admin.vendor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view('admin.manage.vendors.detail', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        $locations = VendorLocation::all();
        return view('admin.manage.vendors.edit', compact('vendor', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        if($request->photo){
            $photo = 'vendor-' . time() . '-' . $request['photo']->getClientOriginalName();
            $request->photo->move(public_path('uploads'), $photo);
        }else{
            $photo = $vendor->photo;
        }
        $vendor->update([
           'name' => $request->name,
           'phone' => $request->phone,
           'email' => $request->email,
           'description' => $request->description,
           'location_id' => $request->location,
           'photo' => $photo
        ]);
        return redirect()->route('admin.vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
    }

    public function sort(Request $request)
    {
        if ($request->filter) {
            $vendors = Vendor::orderBy('created_at', $request->sort)->where('location_id', $request->filter)->paginate(10);
        } else {
            $vendors = Vendor::orderBy('created_at', $request->sort)->paginate(10);
        }
        return view('admin.manage.vendors.inc.vendor', compact('vendors'));
    }
}
