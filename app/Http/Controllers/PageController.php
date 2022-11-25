<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function home()
    {
        $productCategories = ProductCategory::all();
        $products = Product::withCount(['carts as items_sold' => function ($query) {
            $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
        }])->orderBy('items_sold', 'desc')->paginate(20);

        // $products = Product::with(['vendor', 'category', 'variations', 'images'])->get( );

        // dd($products);
        // dd($products);
        // $products = Product::with(['variations' => function ($q) {
        //     $q->where('product_id', '=', 'products.id')
        //         ->select());
        // }])->select('variations.highest_price')->orderBy('variations.highest_price', 'desc')->get();

        // $products = Product::with(['variations:product_id,price'])->orderBy('variations.price')->get();

        // $products = Product::with(['variations' => function ($query) {
        //     $query->select(DB::raw('max(price) as highest_price'))->orderBy('highest_price', 'asc')->get();
        // }])->get();

        // $products = Transaction::select('id', 'total_price')->with(['carts as a' => function ($q) {
        //     return $q->select('id', 'quantity', 'transaction_id')->whereHas('transaction')->orderBy('quantity', 'desc')->first();
        // }])->paginate(10);

        // $products = Product::all();
        // $products->load('carts');
        // $a = $products->carts->orderBy('pivot_price', 'desc')->limit(1)->get();

        // $products = Transaction::all();
        // $products->load('carts');
        // $a = $products->carts;

        // $products = Product::with(['category' => function ($query) {
        //     $query->orderBy('color_code', 'desc');
        // }])->get();

        // $products->variations;
        // $products->variation->orderBy('product_variations.price', 'desc')->get();
        // dd($products[0]->carts);

        // $products = Product::select(DB::raw('products.*, max(price) as highest_price_variation'))
        //     ->join('product_variations', 'products.id', '=', 'product_variations.product_id')
        //     ->groupBy('products.id')
        //     ->orderBy('highest_price_variation', 'asc')
        //     ->get();
        // dd($products);

        return view('home', [
            'products' => $products,
            'productCategories' => $productCategories,
            'active' => 0
        ]);
    }

    public function home2(){
        return view('user.home.index');
        // Home
        // Product
        // About
        // Event
    }
}
