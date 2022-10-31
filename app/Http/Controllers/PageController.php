<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $productCategories = ProductCategory::all();
        $products = Product::with(['vendor', 'category', 'variations', 'images'])->get();

        // return view('home', [
        //     'products' => $products,
        //     'productCategories' => $productCategories,
        //     'active' => 0
        // ]);
        return view('home', [
            'products' => $products,
            'productCategories' => $productCategories,
            'active' => 0
        ]);
    }
}
