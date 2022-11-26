<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductCategory;
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
        // $search = $request->input('search', '');

        $productCategories = ProductCategory::all();
        // $products = Product::where('name', 'LIKE', '%' . $search . '%')->withCount(['carts as items_sold' => function ($query) {
        //     $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
        // }])->orderBy('items_sold', 'desc')->paginate(20);
        $products = Product::withCount(['carts as items_sold' => function ($query) {
            $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
        }])->orderBy('items_sold', 'desc')->paginate(20);

        return view('home', [
            'products' => $products,
            'productCategories' => $productCategories,
            'active' => 0
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = Product::withCount(['carts as items_sold' => function ($query) {
            $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
        }])->withCount(['reviews as reviews_count' => function ($query) use ($product) {
            $query->where('product_id', $product->id);
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

    //     $productCategories = ProductCategory::all();
    //     $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->withCount(['carts as items_sold' => function ($query) {
    //         $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
    //     }])->orderBy('items_sold', 'desc')->paginate(20);

    //     return view('home', [
    //         'products' => $products,
    //         'productCategories' => $productCategories,
    //         'active' => 0
    //     ]);
    // }

    public function filter(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $category = $request->input('category', '');
        $min_price = $request->input('min_price', 0);
        $max_price = $request->input('max_price', 0);
        $sort_by = $request->input('sort_by', '');
        // dd($category);

        $productCategories = ProductCategory::all();

        $products = Product::join('product_variations', 'products.id', '=', 'product_variations.product_id')
            ->select(DB::raw('products.*, max(price) as highest_price_variation'))
            ->groupBy('products.id');

        if ($keyword != '') {
            $products = $products->where('products.name', 'LIKE', '%' . $keyword . '%');
        }

        if ($category != '') {
            $categories = explode(',', $category);
            $products = $products->where(function ($query) use ($categories) {
                foreach ($categories as $category) {
                    $query->orWhere('category_id', $category);
                }
            });
        }

        if ($min_price != 0) {
            $products = $products->where('price', '>=', $request->min_price);
        }

        if ($max_price != 0) {
            $products = $products->where('price', '<=', $request->max_price);
        }

        if ($sort_by != '') {
            if ($sort_by == 'highest_price') {
                $products = $products->orderBy('highest_price_variation', 'desc')
                    ->paginate(20);
            } else if ($sort_by == 'lowest_price') {
                $products = $products->orderBy('highest_price_variation', 'asc')
                    ->paginate(20);
            } else {
                $products = $products->withCount(['carts as items_sold' => function ($query) {
                    $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
                }])->orderBy('items_sold', 'desc')->paginate(20);
            }
        }

        return view('home', [
            'keyword' => $keyword,
            'category' => $category,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'sort_by' => $sort_by,
            'products' => $products,
            'productCategories' => $productCategories,
            'active' => 0
        ]);
        // return view('user.product.products', compact('products'));
    }

    // public function sort(Request $request)
    // {
    //     $products = Product::join('product_variations', 'products.id', '=', 'product_variations.product_id')
    //         ->select(DB::raw('products.*, max(price) as highest_price_variation'))
    //         ->groupBy('products.id');

    //     if ($request->keyword != '') {
    //         $products = $products->where('products.name', 'LIKE', '%' . $request->keyword . '%');
    //     }

    //     if ($request->categories) {
    //         $products = $products->where(function ($query) use ($request) {
    //             foreach ($request->categories as $category) {
    //                 $query->orWhere('category_id', $category);
    //             }
    //         });
    //     }

    //     if ($request->min_price != 0) {
    //         $products = $products->where('price', '>=', $request->min_price);
    //     }

    //     if ($request->max_price != 0) {
    //         $products = $products->where('price', '<=', $request->max_price);
    //     }
    //     if ($request->metric == 'items_sold') {
    //         $products = $products->withCount(['carts as items_sold' => function ($query) {
    //             $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
    //         }])->orderBy('items_sold', 'desc')->paginate(20);
    //     } else {
    //         $products = $products->orderBy('highest_price_variation', $request->sort)
    //             ->paginate(20);
    //     }

    //     return view('user.product.products', compact('products'));
    // }
}
