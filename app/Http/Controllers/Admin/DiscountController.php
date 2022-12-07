<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryDiscount;
use App\Models\Discount;
use App\Models\DiscountType;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariation;
use App\Models\VariationDiscount;
use App\Models\Vendor;
use App\Models\VendorDiscount;
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
        $products = ProductVariation::where('discount_start_date', '!=', null)->get();
        return view('admin.manage.discounts.index', compact('discounts', 'products'));
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
                'type_id' => 1,
                'visible' => $request->visible == 'on' ? 1 : 0
            ]);
        } else if ($request->discount_type == "3") {
            $validator = Validator::make($request->all(), [
                'sale_price' => 'required',
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            $variation = ProductVariation::find($request->product_sale);
            if (
                Discount::where('name', $variation->id)
                ->where('duration_end', '>=', Carbon::now())
                ->get()->count() > 0
            ) {
                return redirect()->route('admin.discount.create')->with('wrong', 'An active Sale Price of that product already exists!');
            }
            //product sale
            $variation->update([
                "discount_start_date" => $request->duration_start,
                "discount_end_date" => $request->duration_end,
                "discount" => $request->sale_price
            ]);
            $discount = Discount::create([
                'name' => $variation->id,
                'code' => $variation->product->name . '-' . $variation->name . '-' . (Discount::latest()->first()->id),
                'amount' => $request->sale_price,
                'duration_start' => $request->duration_start,
                'duration_end' => $request->duration_end,
                'type_id' => 3,
                'visible' => $request->visible == 'on' ? 1 : 0
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
            $discount = Discount::create([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
                'amount' => $request->voucher_value,
                'duration_start' => $request->duration_start,
                'duration_end' => $request->duration_end,
                'min_order' => $request->min_order,
                'voucher_type' => $request->voucher_type,
                'type_id' => 2,
                'applicable_id' => $request->discount_applicable,
                'visible' => $request->visible == 'on' ? 1 : 0
            ]);
            if ($request->max_quota_bool == "on") {
                $discount->update([
                    'max_quota' => $request->max_quota
                ]);
            }
            if ($request->max_discount_bool == "on") {
                $discount->update([
                    'max_discount' => $request->max_discount
                ]);
            }

            if ($request->discount_applicable == 2) {
                $vendor_ids = explode(",", $request->voucher_vendors);
                $vendors = Vendor::whereIn('id', $vendor_ids)->get();

                foreach ($vendors as $key => $vendor) {
                    VendorDiscount::create([
                        'vendor_id' => $vendor->id,
                        'discount_id' => $discount->id
                    ]);
                }
            } else if ($request->discount_applicable == 3) {
                $category_ids = explode(",", $request->voucher_categories);
                $categories = ProductCategory::whereIn('id', $category_ids)->get();

                foreach ($categories as $key => $category) {
                    CategoryDiscount::create([
                        'product_category_id' => $category->id,
                        'discount_id' => $discount->id
                    ]);
                }
            } else if ($request->discount_applicable == 1) {
                if ($request->all_products == "on") {
                    $discount->update([
                        'all_products' => 1
                    ]);
                }
                $product_ids = explode(",", $request->voucher_products);
                $products = ProductVariation::whereIn('id', $product_ids)->get();

                foreach ($products as $key => $product) {
                    VariationDiscount::create([
                        'product_variation_id' => $product->id,
                        'discount_id' => $discount->id
                    ]);
                }
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
        $product = Product::first();
        return view('admin.manage.discounts.edit', compact('types', 'product', 'discount'));
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
        foreach ($discount->vendor_discounts as $key => $vendor_discount) {
            $vendor_discount->delete();
        }
        foreach ($discount->variation_discounts as $key => $variation_discount) {
            $variation_discount->delete();
        }
        foreach ($discount->category_discounts as $key => $category_discount) {
            $category_discount->delete();
        }
        if ($request->discount_type == "1") {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'code' => 'required',
                'description' => 'required',
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            $discount->update([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
                'amount' => $request->amount_shipping,
                'duration_start' => $request->duration_start,
                'duration_end' => $request->duration_end,
                'type_id' => 1,
                'visible' => $request->visible == 'on' ? 1 : 0,
                'voucher_type' => 1
            ]);
        } else if ($request->discount_type == "3") {
            $validator = Validator::make($request->all(), [
                'sale_price' => 'required',
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            //product sale
            if ($request->product_sale == $discount->name) {
                $variation = ProductVariation::find($request->product_sale);
                $variation->update([
                    "discount_start_date" => $request->duration_start,
                    "discount_end_date" => $request->duration_end,
                    "discount" => $request->sale_price
                ]);
                $discount->update([
                    'name' => $variation->id,
                    'code' => $variation->product->name . '-' . $variation->name . '-' . (Discount::latest()->first()->id),
                    'amount' => $request->sale_price,
                    'duration_start' => $request->duration_start,
                    'duration_end' => $request->duration_end,
                    'type_id' => 3,
                    'visible' => $request->visible == 'on' ? 1 : 0,
                    'voucher_type' => 1
                ]);
            } else {
                $variation = ProductVariation::find($request->product_sale);
                if (
                    Discount::where('name', $variation->id)

                    ->where('duration_end', '>=', Carbon::now())
                    ->get()->count() > 0
                ) {
                    return redirect()->route('admin.discount.create')->with('wrong', 'An active Sale Price of that product already exists!');
                }
                if ($discount->type_id == 3) {
                    $variation = ProductVariation::find($discount->name);
                    $variation->update([
                        "discount_start_date" => null,
                        "discount_end_date" => null,
                        "discount" => 0
                    ]);
                }
                $variation = ProductVariation::find($request->product_sale);
                $variation->update([
                    "discount_start_date" => $request->duration_start,
                    "discount_end_date" => $request->duration_end,
                    "discount" => $request->sale_price
                ]);

                $discount->update([
                    'name' => $variation->id,
                    'code' => $variation->product->name . '-' . $variation->name . '-' . (Discount::latest()->first()->id),
                    'amount' => $request->sale_price,
                    'duration_start' => $request->duration_start,
                    'duration_end' => $request->duration_end,
                    'type_id' => 3,
                    'visible' => $request->visible == 'on' ? 1 : 0
                ]);
            }
        } else if ($request->discount_type == "2") {
            //product
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'code' => 'required',
                'description' => 'required',
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            $discount->update([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
                'amount' => $request->voucher_value,
                'duration_start' => $request->duration_start,
                'duration_end' => $request->duration_end,
                'min_order' => $request->min_order,
                'voucher_type' => $request->voucher_type,
                'type_id' => 2,
                'applicable_id' => $request->discount_applicable,
                'visible' => $request->visible == 'on' ? 1 : 0
            ]);
            if ($request->max_quota_bool == "on") {
                $discount->update([
                    'max_quota' => $request->max_quota
                ]);
            } else {
                $discount->update([
                    'max_quota' => null
                ]);
            }
            if ($request->max_discount_bool == "on") {
                $discount->update([
                    'max_discount' => $request->max_discount
                ]);
            } else {
                $discount->update([
                    'max_discount' => null
                ]);
            }

            if ($request->discount_applicable == 2) {
                $vendor_ids = explode(",", $request->voucher_vendors);
                $vendors = Vendor::whereIn('id', $vendor_ids)->get();

                foreach ($vendors as $key => $vendor) {
                    VendorDiscount::create([
                        'vendor_id' => $vendor->id,
                        'discount_id' => $discount->id
                    ]);
                }
            } else if ($request->discount_applicable == 3) {
                $category_ids = explode(",", $request->voucher_categories);
                $categories = ProductCategory::whereIn('id', $category_ids)->get();

                foreach ($categories as $key => $category) {
                    CategoryDiscount::create([
                        'product_category_id' => $category->id,
                        'discount_id' => $discount->id
                    ]);
                }
            } else if ($request->discount_applicable == 1) {
                if ($request->all_products == "on") {
                    $discount->update([
                        'all_products' => 1
                    ]);
                } else {
                    $discount->update([
                        'all_products' => 0
                    ]);
                }
                $product_ids = explode(",", $request->voucher_products);
                $products = ProductVariation::whereIn('id', $product_ids)->get();

                foreach ($products as $key => $product) {
                    VariationDiscount::create([
                        'product_variation_id' => $product->id,
                        'discount_id' => $discount->id
                    ]);
                }
            }
        }
        return redirect()->route('admin.discount.index');
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
            $discounts = Discount::where('duration_start', '>', Carbon::now())->orderBy('created_at', $request->sort)
                ->where('code', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else if ($request->filter == "active") {
            $discounts = Discount::where('duration_start', '<=', Carbon::now())->where('duration_end', '>=', Carbon::now())->orderBy('created_at', $request->sort)
                ->where('code', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else if ($request->filter == "ended") {
            $discounts = Discount::where('duration_end', '<', Carbon::now())->orderBy('created_at', $request->sort)
                ->where('code', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $discounts = Discount::orderBy('created_at', $request->sort)
                ->where('code', 'LIKE', '%' . $request->search . '%')->paginate(10);
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

    public function search_voucher_product(Request $request)
    {
        $variations = ProductVariation::where('name', 'like', '%' . $request->search . '%')
            ->orWhereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->get();
        return view('admin.manage.discounts.inc.voucher_product', compact('variations'));
    }

    public function search_voucher_vendor(Request $request)
    {
        $vendors = Vendor::where('name', 'like', '%' . $request->search . '%')->get();
        return view('admin.manage.discounts.inc.voucher_vendor', compact('vendors'));
    }

    public function search_voucher_category(Request $request)
    {
        $categories = ProductCategory::where('name', 'like', '%' . $request->search . '%')->get();
        return view('admin.manage.discounts.inc.voucher_category', compact('categories'));
    }
}
