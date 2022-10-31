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
            //product sale
            $variation = ProductVariation::find($request->product_sale);
            $variation->update([
                "discount_start_date" => $request->duration_start,
                "discount_end_date" => $request->duration_end,
                "discount" => $request->sale_price
            ]);
            $discount = Discount::create([
                'name' => $variation->id,
                'code' => $variation->name . '-' . (Discount::where('name', $variation->product->name . ' - ' . $variation->name)->get()->count() + 1),
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
                'type_id' => $request->voucher_type,
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

    public function search_voucher_product(Request $request)
    {
        $variations = ProductVariation::where('name', 'like', '%' . $request->search . '%')->get();
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
