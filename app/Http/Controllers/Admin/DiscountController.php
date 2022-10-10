<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\DiscountType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.manage.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = DiscountType::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $discount = Discount::create([
            'name' => $request->name,
            'description' => $request->description,
            'amount' => $request->amount,
            'duration_start' => $request->duration_start,
            'duration_end' => $request->duration_end,
            'type_id' => $request->type_id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        $types = DiscountType::all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $discount->update([
            'name' => $request->name,
            'description' => $request->description,
            'amount' => $request->amount,
            'duration_start' => $request->duration_start,
            'duration_end' => $request->duration_end,
            'type_id' => $request->type_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.discount.index');
    }

    public function sort(Request $request)
    {
        if ($request->filter == "upcoming") {
            $discounts = Discount::where('duration_start', '>', Carbon::now())->orderBy('created_at', $request->sort)->paginate(10);
        } else if ($request->filter == "active") {
            $discounts = Discount::where('duration_start', '<=', Carbon::now())->where('duration_end', '>=', Carbon::now())->orderBy('created_at', $request->sort)->paginate(10);
        } else if ($request->filter == "ended") {
            $discounts = Discount::where('duration_end', '<', Carbon::now())->orderBy('created_at', $request->sort)->paginate(10);
        }else{
            $discounts = Discount::orderBy('created_at', $request->sort)->paginate(10);
        }
        return view('admin.manage.discounts.inc.discount', compact('discounts'));
    }
}
