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
        $productToday = Product::withCount(['carts as items_sold' => function ($query) {
            $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
        }])->inRandomOrder()->limit(5)->get();
        $productNew = Product::withCount(['carts as items_sold' => function ($query) {
            $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
        }])->orderBy('created_at', 'desc')->limit(10)->get();
        return view('home', [
            'productToday' => $productToday,
            'productNew' => $productNew,
        ]);
    }

    public function profile() {
        return view('user.profile.index');
    }

    public function promo() {
        return view('user.promo.index');
    }

    public function address() {
        return view('user.address-manage.index');
    }

    public function vendor() {
        return view('user.vendor.index');
    }

    public function vendordetail() {
        $products = Product::withCount(['carts as items_sold' => function ($query) {
            $query->whereHas('transaction')->select(DB::raw('sum(quantity)'));
        }])->where('vendor_id', 1)->orderBy('created_at', 'desc')->paginate(20); // Tolong dirubah filter vendornya
        return view('user.vendor.detail', ["products"=>$products]);
    }
}
