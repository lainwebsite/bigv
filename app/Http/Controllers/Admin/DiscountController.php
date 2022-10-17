<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\DiscountType;
use App\Models\Product;
use App\Models\ProductVariation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
        $product = Product::first();
        return view('admin.manage.discounts.create', compact('types', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->discount_type == "1") {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'code' => 'required',
                'description' => 'required',
                'code' => 'unique:discounts,code',
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            $discount = Discount::create([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
                'amount' => $request->amount_shipping,
                'duration_start' => $request->duration_start,
                'duration_end' => $request->duration_end,
                'type_id' => 1
            ]);
        } else if ($request->discount_type == "0") {
            $validator = Validator::make($request->all(), [
                'sale_price' => 'required',
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            //product sale
            $variation = ProductVariation::find($request->product_sale);
            $variation->update([
                "discount_start_date" => $request->duration_start,
                "discount_end_date" => $request->duration_end,
                "discount" => $request->sale_price
            ]);
        } else if ($request->discount_type == "2") {
            //product
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'code' => 'required',
                'description' => 'required',
                'code' => 'unique:discounts,code',
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
        }
        return redirect()->route('admin.discount.index');
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
        } else {
            $discounts = Discount::orderBy('created_at', $request->sort)->paginate(10);
        }
        return view('admin.manage.discounts.inc.discount', compact('discounts'));
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->search . '%')->get();
        return view('admin.manage.discounts.inc.product', compact('products'));
    }

    public function get_variations(Request $request)
    {
        $product = Product::find($request->id);
        return $product->variations;
    }
}
