<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\VendorLocation;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::orderBy('created_at', 'desc')->paginate(10);
        $locations = VendorLocation::all();
        return view('admin.manage.vendors.index', compact('vendors', 'locations'));
    }

    public function view_analytics()
    {
        $vendors = Vendor::orderBy('created_at', 'asc')
            ->withCount(['carts as transaction_count' => function ($query) {
                $query->whereHas('transaction', function ($q) {
                    $q->where('created_at', '<=', Carbon::now())
                        ->where('created_at', '>=', Carbon::now()->subDays(7));
                })->select(DB::raw('count(distinct(transaction_id))'));
            }])->withCount(['carts as total_income' => function ($query) {
                $query->whereHas('transaction', function ($q) {
                    $q->where('created_at', '<=', Carbon::now())
                        ->where('created_at', '>=', Carbon::now()->subDays(7));
                })->select(DB::raw('sum(carts.price * quantity)'));
            }])
            ->paginate(10);

        $fdate = Carbon::now();
        $tdate =  Carbon::now()->subDays(7);
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        $vendor_sales = Vendor::orderBy('created_at', 'asc');

        for ($i = 0; $i < $days; $i++) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $vendor_sales = $vendor_sales->withCount(["carts as $date" => function ($query) use ($i) {
                $query->whereHas('transaction', function ($q) use ($i) {
                    $q->where('created_at', '<', Carbon::now()->subDays($i - 1))
                        ->where('created_at', '>=', Carbon::now()->subDays($i));
                })->select(DB::raw('count(distinct(transaction_id))'));
            }]);
        }

        $vendor_sales = $vendor_sales->get();

        $sales = [];
        $sales_keys = [];
        $sales_names = [];

        foreach ($vendor_sales as $key => $vendor) {
            array_push($sales_keys, $key);
            array_push($sales_names, $vendor->name);
            if (count($sales) == 0) {
                $new_vendor = [];
                for ($i = 0; $i < $days; $i++) {
                    $date = Carbon::now()->subDays($i)->toDateString();
                    array_push($new_vendor, [
                        "period" => $date,
                        $key => $vendor[$date] ?? 0,
                        "itouch" => 10
                    ]);
                }
                array_push($sales, $new_vendor);
            } else {
                for ($i = 0; $i < $days; $i++) {
                    $date = Carbon::now()->subDays($i)->toDateString();
                    $sales[0][$i][$key] = $vendor[$date] ?? 0;
                }
            }
        }

        $vendor_income = Vendor::orderBy('created_at', 'asc');

        for ($i = 0; $i < $days; $i++) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $vendor_income = $vendor_income->withCount(["carts as $date" => function ($query) use ($i) {
                $query->whereHas('transaction', function ($q) use ($i) {
                    $q->where('created_at', '<', Carbon::now()->subDays($i - 1))
                        ->where('created_at', '>=', Carbon::now()->subDays($i));
                })->select(DB::raw('sum(carts.price * quantity)'));
            }]);
        }

        $vendor_income = $vendor_income->get();

        $income = [];
        $income_keys = [];
        $income_names = [];

        foreach ($vendor_income as $key => $vendor) {
            array_push($income_keys, $key);
            array_push($income_names, $vendor->name);
            if (count($income) == 0) {
                $new_vendor = [];
                for ($i = 0; $i < $days; $i++) {
                    $date = Carbon::now()->subDays($i)->toDateString();
                    array_push($new_vendor, [
                        "period" => $date,
                        $key => $vendor[$date] ?? 0,
                        "itouch" => 10
                    ]);
                }
                array_push($income, $new_vendor);
            } else {
                for ($i = 0; $i < $days; $i++) {
                    $date = Carbon::now()->subDays($i)->toDateString();
                    $income[0][$i][$key] = $vendor[$date] ?? 0;
                }
            }
        }

        return view('admin.analytics.vendors.index', compact('vendors', 'sales', 'income', 'sales_keys', 'income_keys', 'sales_names', 'income_names'));
    }

    public function analytics_detail(Vendor $vendor)
    {
        $products = Product::orderBy('created_at', 'desc')
            ->where('vendor_id', $vendor->id)
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

        $fdate = Carbon::now();
        $tdate =  Carbon::now()->subDays(7);
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        $product_sold = [];

        for ($i = 0; $i < $days; $i++) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $cartes = Cart::where('transaction_id', '!=', null)
                ->whereHas('product_variation', function ($q) use ($vendor) {
                    $q->whereHas('product', function ($q) use ($vendor) {
                        $q->where('vendor_id', $vendor->id);
                    });
                })
                ->where('created_at', '<', Carbon::now()->subDays(($i - 1)))
                ->where('created_at', '>=', Carbon::now()->subDays($i))
                ->get();
            $sold_count = 0;
            foreach ($cartes as $key => $cart) {
                $sold_count += $cart->quantity;
            }
            array_push($product_sold, [
                'period' => $date,
                'sold' => $sold_count,
                'itouch' => 10,
            ]);
        }

        return view('admin.analytics.vendors.detail', compact('vendor', 'products', 'product_sold'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = VendorLocation::all();
        return view('admin.manage.vendors.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo = 'vendor-' . time() . '-' . $request['photo']->getClientOriginalName();
        $request->photo->move(public_path('uploads'), $photo);
        $vendor = Vendor::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'description' => $request->description,
            'location_id' => $request->location,
            'photo' => $photo,
            'slug' => \Str::slug($request->name)
        ]);
        return redirect()->route('admin.vendor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view('admin.manage.vendors.detail', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        $locations = VendorLocation::all();
        return view('admin.manage.vendors.edit', compact('vendor', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        if ($request->photo) {
            $photo = 'vendor-' . time() . '-' . $request['photo']->getClientOriginalName();
            $request->photo->move(public_path('uploads'), $photo);
        } else {
            $photo = $vendor->photo;
        }
        $vendor->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'description' => $request->description,
            'location_id' => $request->location,
            'photo' => $photo,
            'slug' => \Str::slug($request->name)
        ]);
        return redirect()->route('admin.vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
    }

    public function sort(Request $request)
    {
        if ($request->filter) {
            $vendors = Vendor::orderBy('created_at', $request->sort)->where('location_id', $request->filter)
                ->where('name', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $vendors = Vendor::orderBy('created_at', $request->sort)
                ->where('name', 'LIKE', '%' . $request->search . '%')->paginate(10);
        }
        return view('admin.manage.vendors.inc.vendor', compact('vendors'));
    }
    public function date_analytics(Request $request)
    {
        $fdate =  date('Y-m-d', strtotime($request->end_date . ' + 1 days'));
        $tdate = $request->start_date;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        $vendor_sales = Vendor::orderBy('created_at', 'asc');

        for ($i = 0; $i < $days; $i++) {
            $x = $i + 1;
            $date = date('Y-m-d', strtotime($fdate . " - $x days"));
            $vendor_sales = $vendor_sales->withCount(["carts as $date" => function ($query) use ($i, $x, $fdate, $tdate) {
                $query->whereHas('transaction', function ($q) use ($i, $x, $fdate, $tdate) {
                    $q->where('created_at', '<', date('Y-m-d', strtotime($fdate . " - $i days")))
                        ->where('created_at', '>=', date('Y-m-d', strtotime($fdate . " - $x days")));
                })->select(DB::raw('count(distinct(transaction_id))'));
            }]);
        }

        $vendor_sales = $vendor_sales->get();

        $sales = [];
        $sales_keys = [];
        $sales_names = [];

        foreach ($vendor_sales as $key => $vendor) {
            array_push($sales_keys, $key);
            array_push($sales_names, $vendor->name);
            if (count($sales) == 0) {
                $new_vendor = [];
                for ($i = 0; $i < $days; $i++) {
                    $x = $i + 1;
                    $date = date('Y-m-d', strtotime($fdate . " - $x days"));
                    array_push($new_vendor, [
                        "period" => $date,
                        $key => $vendor[$date] ?? 0,
                        "itouch" => 10
                    ]);
                }
                array_push($sales, $new_vendor);
            } else {
                for ($i = 0; $i < $days; $i++) {
                    $x = $i + 1;
                    $date = date('Y-m-d', strtotime($fdate . " - $x days"));
                    $sales[0][$i][$key] = $vendor[$date] ?? 0;
                }
            }
        }

        $vendor_income = Vendor::orderBy('created_at', 'asc');

        for ($i = 0; $i < $days; $i++) {
            $x = $i + 1;
            $date = date('Y-m-d', strtotime($fdate . " - $x days"));
            $vendor_income = $vendor_income->withCount(["carts as $date" => function ($query) use ($i, $x, $fdate, $tdate) {
                $query->whereHas('transaction', function ($q) use ($i, $x, $fdate, $tdate) {
                    $q->where('created_at', '<', date('Y-m-d', strtotime($fdate . " - $i days")))
                        ->where('created_at', '>=', date('Y-m-d', strtotime($fdate . " - $x days")));
                })->select(DB::raw('sum(carts.price * quantity)'));
            }]);
        }

        $vendor_income = $vendor_income->get();

        $income = [];
        $income_keys = [];
        $income_names = [];

        foreach ($vendor_income as $key => $vendor) {
            array_push($income_keys, $key);
            array_push($income_names, $vendor->name);
            if (count($income) == 0) {
                $new_vendor = [];
                for ($i = 0; $i < $days; $i++) {
                    $x = $i + 1;
                    $date = date('Y-m-d', strtotime($fdate . " - $x days"));
                    array_push($new_vendor, [
                        "period" => $date,
                        $key => $vendor[$date] ?? 0,
                        "itouch" => 10
                    ]);
                }
                array_push($income, $new_vendor);
            } else {
                for ($i = 0; $i < $days; $i++) {
                    $x = $i + 1;
                    $date = date('Y-m-d', strtotime($fdate . " - $x days"));
                    $income[0][$i][$key] = $vendor[$date] ?? 0;
                }
            }
        }

        $data = [
            "sales" => $sales,
            "sales_keys" => $sales_keys,
            "sales_names" => $sales_names,
            "income" => $income,
            "income_keys" => $income_keys,
            "income_names" => $income_names
        ];

        return $data;
    }
    public function sort_analytics(Request $request)
    {
        $vendors = Vendor::orderBy('created_at', 'asc')
            ->withCount(['carts as transaction_count' => function ($query) use ($request) {
                $query->whereHas('transaction', function ($q) use ($request) {
                    $q->where('created_at', '>=', $request->start_date)
                        ->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')));
                })->select(DB::raw('count(distinct(transaction_id))'));
            }])->withCount(['carts as total_income' => function ($query) use ($request) {
                $query->whereHas('transaction', function ($q) use ($request) {
                    $q->where('created_at', '>=', $request->start_date)
                        ->where('created_at', '<=', date('Y-m-d', strtotime($request->end_date . ' + 1 days')));
                })->select(DB::raw('sum(carts.price * quantity)'));
            }]);
        if ($request->sort == "transaction_count") {
            $vendors = $vendors->orderBy('transaction_count', 'desc')->paginate(10);
        } else if ($request->sort == "total_income") {
            $vendors = $vendors->orderBy('total_income', 'desc')->paginate(10);
        } else if ($request->sort == "rating") {
            $vendors = $vendors->orderBy('rating', 'desc')->paginate(10);
        } else {
            $vendors = $vendors->paginate(10);
        }
        return view('admin.analytics.vendors.inc.vendor', compact('vendors'));
    }

    public function date_analytics_detail(Vendor $vendor, Request $request)
    {
        $fdate =  date('Y-m-d', strtotime($request->end_date . ' + 1 days'));
        $tdate = $request->start_date;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        $product_sold = [];

        for ($i = 0; $i < $days; $i++) {
            $x = $i + 1;
            $date = date('Y-m-d', strtotime($fdate . " - $x days"));
            $cartes = Cart::where('transaction_id', '!=', null)
                ->whereHas('product_variation', function ($q) use ($vendor) {
                    $q->whereHas('product', function ($q) use ($vendor) {
                        $q->where('vendor_id', $vendor->id);
                    });
                })
                ->where('created_at', '<', date('Y-m-d', strtotime($fdate . " - $i days")))
                ->where('created_at', '>=', date('Y-m-d', strtotime($fdate . " - $x days")))
                ->get();
            $sold_count = 0;
            foreach ($cartes as $key => $cart) {
                $sold_count += $cart->quantity;
            }
            array_push($product_sold, [
                'period' => $date,
                'sold' => $sold_count,
                'itouch' => 10,
            ]);
        }

        $data = [
            "product_sold" => $product_sold,
        ];

        return $data;
    }
    public function sort_analytics_detail(Vendor $vendor, Request $request)
    {
        $products = Product::where('vendor_id', $vendor->id)
            ->withCount(['carts as transaction_count' => function ($query) use ($request) {
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
            }])
            ->orderBy($request->sort == "-" ? 'created_at' : $request->sort, 'desc')
            ->paginate(10);
        return view('admin.analytics.vendors.inc.detail', compact('products'));
    }
}
