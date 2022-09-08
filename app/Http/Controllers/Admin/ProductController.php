<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = false;
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        $categories = ProductCategory::all();
        return view('admin.manage.product.index', compact('products', 'categories', 'vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        $vendors = Vendor::all();
        return view('admin.manage.product.create', compact('categories', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $featured = 'product-' . time() . '-' . $request->featured_image->getClientOriginalName();
        $request->featured_image->move(public_path('uploads'), $featured);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'rating' => 0,
            'featured_image' => $featured,
            'vendor_id' => $request->vendor,
            'category_id' => $request->category
        ]);

        if ($request->productImage) {
            foreach ($request->productImage as $key => $image) {
                $imaged = 'product-' . time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imaged);
                ProductImage::create([
                    'link' => $imaged,
                    'product_id' => $product->id
                ]);
            }
        }

        foreach ($request->variation_name as $key => $variation) {
            ProductVariation::create([
                'name' => $request->variation_name[$key],
                'price' => $request->variation_price[$key],
                'discount' => $request->variation_discount[$key] ?? 0,
                'discount_date' => $request->variation_discount_date[$key] ?? Carbon::now(),
                'product_id' => $product->id
            ]);
        }
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        $vendors = Vendor::all();
        return view('admin.manage.product.edit', compact('product', 'categories', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($request->featured_image) {
            $featured = 'product-' . time() . '-' . $request->featured_image->getClientOriginalName();
            $request->featured_image->move(public_path('uploads'), $featured);
        } else {
            $featured = $product->featured_image;
        }
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'featured_image' => $featured,
            'vendor_id' => $request->vendor,
            'category_id' => $request->category
        ]);
        foreach ($request->delete_product_image_id as $key => $id) {
            if ($id) {
                $productImage = ProductImage::where('id', $id)->first();
                $productImage->delete();
            }
        }
        if ($request->productImage) {
            foreach ($request->productImage as $key => $image) {
                $imaged = 'product-' . time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imaged);
                ProductImage::create([
                    'link' => $imaged,
                    'product_id' => $product->id
                ]);
            }
        }

        foreach ($product->variations as $key => $productVariation) {
            $productVariation->delete();
        }
        foreach ($request->variation_name as $key => $variation) {
            ProductVariation::create([
                'name' => $request->variation_name[$key],
                'price' => $request->variation_price[$key],
                'discount' => $request->variation_discount[$key] ?? 0,
                'discount_date' => $request->variation_discount_date[$key] ?? Carbon::now(),
                'product_id' => $product->id
            ]);
        }
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index');
    }
    public function sort(Request $request)
    {
        if ($request->vendor) {
            $vendor = true;
            $products = Product::orderBy($request->metric, $request->sort)->where('vendor_id', $request->vendor)->paginate(10);
            return view('admin.manage.product.inc.product', compact('products', 'vendor'));
        } else {
            $vendor = false;
            if ($request->filter) {
                $products = Product::orderBy($request->metric, $request->sort)->where('category_id', $request->filter)->paginate(10);
            } else {
                $products = Product::orderBy($request->metric, $request->sort)->paginate(10);
            }
            return view('admin.manage.product.inc.product', compact('products', 'vendor'));
        }
    }
}
