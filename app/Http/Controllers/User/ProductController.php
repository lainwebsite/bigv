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

        // $product->load('vendor', 'category', 'variations', 'images');
        // $product->vendor->load('location');
        $product = Product::withCount(['carts as items_sold' => function ($query) {
            $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
        }])->where('id', $product->id)->get()[0];

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

    // public function search(Request $request)
    // {
    //     $keyword = $request->input('keyword', '');
    //     $products = Product::paginate(20);

    //     if ($keyword != '') {
    //         $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->paginate(20);
    //     }

    //     return view('user.product.products', compact('products'));
    // }

    // public function filter(Request $request)
    // {
    //     $products = Product::with(['vendor']);

    //     if (isset($request->categories)) {
    //         foreach ($request->categories as $category) {
    //             $products->orWhere('category_id', $category);
    //         }
    //     }

    //     if (isset($request->min_price)) {
    //         $products->with(['variations' => function ($query) use ($request) {
    //             $query->where('price', '>=', $request->min_price);
    //         },])->whereHas('variations', function ($query) use ($request) {
    //             $query->where('price', '>=', $request->min_price);
    //         });
    //     }

    //     if (isset($request->max_price)) {
    //         $products->with(['variations' => function ($query) use ($request) {
    //             $query->where('price', '<=', $request->max_price);
    //         },])->whereHas('variations', function ($query) use ($request) {
    //             $query->where('price', '<=', $request->max_price);
    //         });
    //     }
    //     $products = $products->get();

    //     return view('user.product.products', ['products' => $products]);
    // }

    public function sort(Request $request)
    {
        $products = Product::join('product_variations', 'products.id', '=', 'product_variations.product_id')
            ->select(DB::raw('products.*, max(price) as highest_price_variation'))
            ->groupBy('products.id');

        if ($request->keyword != '') {
            $products = $products->where('products.name', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->categories) {
            $products = $products->where(function ($query) use ($request) {
                foreach ($request->categories as $category) {
                    $query->orWhere('category_id', $category);
                }
            });
        }

        if ($request->min_price != 0) {
            $products = $products->where('price', '>=', $request->min_price);
        }

        if ($request->max_price != 0) {
            $products = $products->where('price', '<=', $request->max_price);
        }
        if ($request->metric == 'items_sold') {
            $products = $products->withCount(['carts as items_sold' => function ($query) {
                $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
            }])->orderBy('items_sold', 'desc')->paginate(20);
        } else {
            $products = $products->orderBy('highest_price_variation', $request->sort)
                ->paginate(20);
        }

        // else {
        //     $products = Product::select(DB::raw('products.*, max(price) as highest_price_variation'))
        //         ->join('product_variations', 'products.id', '=', 'product_variations.product_id')
        //         ->groupBy('products.id')
        //         ->orderBy('highest_price_variation', $request->sort)
        //         ->paginate(20);
        // }



        return view('user.product.products', compact('products'));
    }
}
