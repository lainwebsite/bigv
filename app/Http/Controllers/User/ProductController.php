<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load('vendor', 'category', 'variations', 'images');
        $product->vendor->load('location');

        $addons = Addon::where('product_id', $product->id)->with(['addons_options'])->get();

        if (count($product->variations) > 0) {
            if ($product->variations[0]->name != 'novariation') {
                $min = ProductVariation::where('product_id', $product->id)->min('price');
                $max = ProductVariation::where('product_id', $product->id)->max('price');

                return view('user.product.detail', [
                    'product' => $product,
                    'minProductPrice' => $min,
                    'maxProductPrice' => $max,
                    'addons' => $addons,
                ]);
            }
        }

        return view('user.product.detail', [
            'product' => $product,
            'addons' => $addons,
        ]);
    }

    public function filter(Request $request)
    {
        $products = Product::with(['vendor']);

        if (isset($request->categories)) {
            foreach ($request->categories as $category) {
                $products->orWhere('category_id', $category);
            }
        }

        if (isset($request->min_price)) {
            $products->with(['variations' => function ($query) use ($request) {
                $query->where('price', '>=', $request->min_price);
            },])->whereHas('variations', function ($query) use ($request) {
                $query->where('price', '>=', $request->min_price);
            });
        }

        if (isset($request->max_price)) {
            $products->with(['variations' => function ($query) use ($request) {
                $query->where('price', '<=', $request->max_price);
            },])->whereHas('variations', function ($query) use ($request) {
                $query->where('price', '<=', $request->max_price);
            });
        }
        $products = $products->get();

        return view('user.product.products', ['products' => $products]);
    }
}
