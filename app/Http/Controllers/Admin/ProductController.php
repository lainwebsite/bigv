<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use App\Models\AddonOption;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductReview;
use App\Models\ProductVariation;
use App\Models\Transaction;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $vendor = false;
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        $categories = ProductCategory::all();
        return view('admin.manage.product.index', compact('products', 'categories', 'vendor'));
    }

    public function view_analytics()
    {
        $vendor = false;
        $transactions = Transaction::orderBy('created_at', 'asc')
            ->where('created_at', '<=', Carbon::now())
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->withCount('carts')
            ->get();
        $products = Product::orderBy('created_at', 'desc')
            ->withCount(['carts as transaction_count' => function ($query) {
                $query->whereHas('transaction', function ($q) {
                    $q->where('created_at', '<=', Carbon::now())
                        ->where('created_at', '>=', Carbon::now()->subDays(7));
                })->select(DB::raw('count(distinct(transaction_id))'));
            }])->withCount(['carts as sold_count' => function ($query) {
                $query->whereHas('transaction', function ($q) {
                    $q->where('created_at', '<=', Carbon::now())
                        ->where('created_at', '>=', Carbon::now()->subDays(7));
                })->select(DB::raw('sum(quantity)'));
            }])->withCount(['carts as total_income' => function ($query) {
                $query->whereHas('transaction', function ($q) {
                    $q->where('created_at', '<=', Carbon::now())
                        ->where('created_at', '>=', Carbon::now()->subDays(7));
                })->select(DB::raw('sum(carts.price * quantity)'));
            }])
            ->paginate(10);
        $categories = ProductCategory::withCount('products')
            ->get();
        return view('admin.analytics.products.index', compact('products', 'categories', 'vendor', 'transactions'));
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
        
        // $useVariations = ;
        if ($request->with_variation){
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'rating' => 0,
                'variation_name' => $request->variation_named,
                'featured_image' => $featured,
                'vendor_id' => $request->vendor,
                'category_id' => $request->category
            ]);
            
            if ($request->variation_name) {
                foreach ($request->variation_name as $key => $variation) {
                    ProductVariation::create([
                        'name' => $request->variation_name[$key],
                        'price' => $request->variation_price[$key],
                        'product_id' => $product->id
                    ]);
                }
            }
        }
        else {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'rating' => 0,
                'variation_name' => "novariation",
                'featured_image' => $featured,
                'vendor_id' => $request->vendor,
                'category_id' => $request->category
            ]);
            
            ProductVariation::create([
                'name' => "novariation",
                'price' => $request->product_price_no_var,
                'product_id' => $product->id
            ]);
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


        if ($request->addon_name) {
            foreach ($request->option_name as $key => $option) {
                $addon = Addon::create([
                    'name' => $request->addon_name[$key],
                    'product_id' => $product->id,
                ]);
                if ($request->addon_required) {
                    if (array_key_exists($key, $request->addon_required)) {
                        $addon->update([
                            'required' => $request->addon_required[$key] == "on" ? 1 : 0,
                        ]);
                    }
                }
                foreach ($option as $keyed => $opt) {
                    AddonOption::create([
                        'name' => $request->option_name[$key][$keyed],
                        'price' => $request->option_price[$key][$keyed],
                        'addon_id' => $addon->id
                    ]);
                }
            }
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
        $reviews = ProductReview::where('product_id', $product->id)->paginate(5);
        return view('admin.manage.product.detail', compact('product', 'reviews'));
    }
    public function analytics_detail(Product $product)
    {
        $product = Product::where('id', $product->id)
            ->withCount(['carts as transaction_count' => function ($query) {
                $query->whereHas('transaction', function ($q) {
                    $q->where('created_at', '<=', Carbon::now())
                        ->where('created_at', '>=', Carbon::now()->subDays(7));
                })->select(DB::raw('count(distinct(transaction_id))'));
            }])->withCount(['carts as sold_count' => function ($query) {
                $query->whereHas('transaction', function ($q) {
                    $q->where('created_at', '<=', Carbon::now())
                        ->where('created_at', '>=', Carbon::now()->subDays(7));
                })->select(DB::raw('sum(quantity)'));
            }])->withCount(['carts as total_income' => function ($query) {
                $query->whereHas('transaction', function ($q) {
                    $q->where('created_at', '<=', Carbon::now())
                        ->where('created_at', '>=', Carbon::now()->subDays(7));
                })->select(DB::raw('sum(carts.price * quantity)'));
            }])->first();
        $transactiones = Transaction::orderBy('created_at', 'asc')
            ->where('created_at', '<=', Carbon::now())
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->withCount(['carts as sold_count' => function ($query) use ($product) {
                $query->whereHas('product_variation', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })->select(DB::raw('sum(quantity)'));
            }])
            ->withCount(['carts as sold_price' => function ($query) use ($product) {
                $query->whereHas('product_variation', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })->select(DB::raw('sum((quantity*price))'));
            }])
            ->whereHas('carts', function ($q) use ($product) {
                $q->whereHas('product_variation', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                });
            })
            ->get();
        $transactions = Transaction::orderBy('created_at', 'asc')
            ->where('created_at', '<=', Carbon::now())
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->withCount(['carts as sold_count' => function ($query) use ($product) {
                $query->whereHas('product_variation', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })->select(DB::raw('sum(quantity)'));
            }])
            ->withCount(['carts as sold_price' => function ($query) use ($product) {
                $query->whereHas('product_variation', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })->select(DB::raw('sum((quantity*price))'));
            }])
            ->whereHas('carts', function ($q) use ($product) {
                $q->whereHas('product_variation', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                });
            })
            ->paginate(10);
        return view('admin.analytics.products.detail', compact('product', 'transactions', 'transactiones'));
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
            'variation_name' => $request->variation_named,
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
                'product_id' => $product->id
            ]);
        }
        if ($product->addons->count() > 0) {
            foreach ($product->addons as $key => $addon) {
                $addon->delete();
            }
        }
        if ($request->addon_name) {
            foreach ($request->option_name as $key => $option) {
                $addon = Addon::create([
                    'name' => $request->addon_name[$key],
                    'product_id' => $product->id,
                ]);
                if ($request->addon_required) {
                    if (array_key_exists($key, $request->addon_required)) {
                        $addon->update([
                            'required' => $request->addon_required[$key] == "on" ? 1 : 0,
                        ]);
                    }
                }
                foreach ($option as $keyed => $opt) {
                    AddonOption::create([
                        'name' => $request->option_name[$key][$keyed],
                        'price' => $request->option_price[$key][$keyed],
                        'addon_id' => $addon->id
                    ]);
                }
            }
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

    public function sort_review(Request $request)
    {
        if ($request->filter) {
            $reviews = ProductReview::where('product_id', $request->product_id)
                ->where('rating', '<=', intval($request->filter + 0.9))
                ->where('rating', '>=', intval($request->filter))
                ->paginate(5);
        } else {
            $reviews = ProductReview::where('product_id', $request->product_id)
                ->paginate(5);
        }
        return view('admin.manage.product.inc.review', compact('reviews'));
    }

    public function sort_analytics(Request $request)
    {
        if ($request->category == 0) {
            $products = Product::whereHas('carts', function ($q) use ($request) {
                $q->whereHas('transaction', function ($q) use ($request) {
                    $q->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                        ->where('created_at', '>=', $request->start_date);
                });
            })->withCount(['carts as transaction_count' => function ($query) use ($request) {
                $query->whereHas('transaction', function ($q) use ($request) {
                    $q->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                        ->where('created_at', '>=', $request->start_date);
                });
            }])->withCount(['carts as sold_count' => function ($query) use ($request) {
                $query->whereHas('transaction', function ($q) use ($request) {
                    $q->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                        ->where('created_at', '>=', $request->start_date);
                })->select(DB::raw('sum(quantity)'));
            }])->withCount(['carts as total_income' => function ($query) use ($request) {
                $query->whereHas('transaction', function ($q) use ($request) {
                    $q->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                        ->where('created_at', '>=', $request->start_date);
                })->select(DB::raw('sum(carts.price * quantity)'));
            }]);
        } else {
            $products = Product::where('category_id', $request->category)
                ->whereHas('carts', function ($q) use ($request) {
                    $q->whereHas('transaction', function ($q) use ($request) {
                        $q->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                            ->where('created_at', '>=', $request->start_date);
                    });
                })->withCount(['carts as transaction_count' => function ($query) use ($request) {
                    $query->whereHas('transaction', function ($q) use ($request) {
                        $q->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                            ->where('created_at', '>=', $request->start_date);
                    })->select(DB::raw('count(distinct(transaction_id))'));
                }])->withCount(['carts as sold_count' => function ($query) use ($request) {
                    $query->whereHas('transaction', function ($q) use ($request) {
                        $q->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                            ->where('created_at', '>=', $request->start_date);
                    })->select(DB::raw('sum(quantity)'));
                }])->withCount(['carts as total_income' => function ($query) use ($request) {
                    $query->whereHas('transaction', function ($q) use ($request) {
                        $q->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                            ->where('created_at', '>=', $request->start_date);
                    })->select(DB::raw('sum(carts.price * quantity)'));
                }]);
        }
        if ($request->sort == "transaction") {
            $products = $products->orderBy('transaction_count', 'desc')->paginate(10);
        } else if ($request->sort == "sold") {
            $products = $products->orderBy('sold_count', 'desc')->paginate(10);
        } else if ($request->sort == "income") {
            $products = $products->orderBy('total_income', 'desc')->paginate(10);
        } else if ($request->sort == "rating") {
            $products = $products->orderBy('rating', 'desc')->paginate(10);
        } else {
            $products = $products->paginate(10);
        }
        return view('admin.analytics.products.inc.product', compact('products'));
    }

    public function date_analytics(Request $request)
    {
        if ($request->category == 0) {
            $transactions = Transaction::orderBy('created_at', 'asc')
                ->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                ->where('created_at', '>=', $request->start_date)
                ->withCount('carts')
                ->get();
        } else {
            $transactions = Transaction::orderBy('created_at', 'asc')
                ->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
                ->where('created_at', '>=', $request->start_date)
                ->whereHas('carts', function ($q) use ($request) {
                    $q->whereHas('product_variation', function ($q) use ($request) {
                        $q->whereHas('product', function ($q) use ($request) {
                            $q->where('category_id', $request->category);
                        })->get();
                    });
                })
                ->withCount('carts')
                ->get();
        }
        return $transactions;
    }

    public function sort_analytics_detail(Request $request, Product $product)
    {
        $transactions = Transaction::orderBy('created_at', 'asc')
            ->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
            ->where('created_at', '>=', $request->start_date)
            ->withCount(['carts as sold_count' => function ($query) use ($product) {
                $query->whereHas('product_variation', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })->select(DB::raw('sum(quantity)'));
            }])
            ->withCount(['carts as sold_price' => function ($query) use ($product) {
                $query->whereHas('product_variation', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })->select(DB::raw('sum((quantity*price))'));
            }])
            ->whereHas('carts', function ($q) use ($product) {
                $q->whereHas('product_variation', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                });
            });
        if ($request->sort == "sold") {
            $transactions = $transactions->orderBy('sold_count', 'desc')->paginate(10);
        } else if ($request->sort == "date_asc") {
            $transactions = $transactions->orderBy('created_at', 'asc')->paginate(10);
        } else if ($request->sort == "date_desc") {
            $transactions = $transactions->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $transactions = $transactions->paginate(10);
        }
        return view('admin.analytics.products.inc.transaction', compact('transactions'));
    }

    public function date_analytics_detail(Request $request, Product $product)
    {
        $transactions = Transaction::orderBy('created_at', 'asc')
            ->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')))
            ->where('created_at', '>=', $request->start_date)
            ->withCount(['carts as sold_count' => function ($query) use ($product) {
                $query->whereHas('product_variation', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })->select(DB::raw('sum(quantity)'));
            }])
            ->withCount(['carts as sold_price' => function ($query) use ($product) {
                $query->whereHas('product_variation', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })->select(DB::raw('sum((quantity*price))'));
            }])
            ->whereHas('carts', function ($q) use ($product) {
                $q->whereHas('product_variation', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                });
            })
            ->get();
        return $transactions;
    }
}
