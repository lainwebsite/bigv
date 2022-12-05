@extends('admin.layout')

@section('dashboard-selected')
    selected
@endsection

@section('dashboard-link-active')
    active
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 align-self-center">
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Welcome, {{ Auth::user()->name }}!
                    </h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- *************************************************************** -->
            <!-- Start First Cards -->
            <!-- *************************************************************** -->
            <!-- Semua data disini di filter khusus hari ini saja kecuali yang total order pake all time -->
            <div class="card-group">
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $newusers->count() }}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">New Customers</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <!-- Total income pake total nominal order semua orderan hari ini -->
                            <div>
                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                        class="set-doller">$</sup>{{ $total_income }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Income</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $transactions_daily->count() }}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">New Order</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $transactions->count() }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Order</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *************************************************************** -->
            <!-- End First Cards -->
            <!-- *************************************************************** -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Today Order(s) Report</h4>
                    <!-- Filter buat hari ini saja -->
                    <div class="row">
                        <!-- Column -->
                        <div class="col-md-6 col-lg-13 col-xlg-2">
                            <div class="card card-hover">
                                <div class="p-2 br-18 bg-danger text-center">
                                    <h1 class="font-light text-white">
                                        {{ $transactions_daily->where('status_id', 1)->count() }}</h1>
                                    <h6 class="text-white">Order Pending</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-13 col-xlg-2">
                            <div class="card card-hover">
                                <div class="p-2 br-18 bg-primary text-center">
                                    <h1 class="font-light text-white">
                                        {{ $transactions_daily->where('status_id', 2)->count() }}</h1>
                                    <h6 class="text-white">Paid</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-13 col-xlg-2">
                            <div class="card card-hover">
                                <div class="p-2 br-18 bg-cyan text-center">
                                    <h1 class="font-light text-white">
                                        {{ $transactions_daily->where('status_id', 3)->count() }}</h1>
                                    <h6 class="text-white">Delivered</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-13 col-xlg-2">
                            <div class="card card-hover">
                                <div class="p-2 br-18 bg-success text-center">
                                    <h1 class="font-light text-white">
                                        {{ $transactions_daily->where('status_id', 4)->count() }}</h1>
                                    <h6 class="text-white">Success</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-13 col-xlg-2">
                            <div class="card card-hover">
                                <div class="p-2 br-18 bg-dark text-center">
                                    <h1 class="font-light text-white">
                                        {{ $transactions_daily->where('status_id', 7)->count() }}</h1>
                                    <h6 class="text-white">Refunded</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <!-- DIbuat sama kaya yang di order analytics (seminggu / 7 hari terakhir aja) -->
                <div class="card-body">
                    <h4 class="card-title">Number of Orders</h4>
                    <ul class="list-inline text-right">
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle mr-1 text-purple"></i>New Orders</h5>
                        </li>
                    </ul>
                    <div id="number-of-order"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- 5 orderan terakhir all time nggak harus hari ini -->
                    <h4 class="card-title mb-4">Latest Order</h4>
                    <div class="row">
                        <div class="col pt-0 pb-0 pr-4 pl-4">
                            <ul class="list-unstyled mb-5">
                                @foreach ($transactions->take(5) as $transaction)
                                    <li>
                                        <div class="w-100 card custom-border my-2">
                                            <div @class([
                                                'card-header d-flex justify-content-between flex-column',
                                                'bg-danger' => $transaction->status_id == 1,
                                                'bg-primary' => $transaction->status_id == 2,
                                                'bg-cyan' => $transaction->status_id == 3,
                                                'bg-success' => $transaction->status_id == 4,
                                                'bg-secondary' => $transaction->status_id == 5,
                                                'bg-dark' => $transaction->status_id == 6,
                                                'bg-dark' => $transaction->status_id == 7,
                                            ])>
                                                <div class="d-flex justify-content-between">
                                                    <p class="m-0 text-white">
                                                        {{ $transaction->user->name }}</p>
                                                    <p class="m-0 text-white">{{ $transaction->status->name }}
                                                    </p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="m-0 text-white">{{ $transaction->id }}</h6>
                                                    <h6 class="m-0 text-white">{{ $transaction->created_at }}
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="card-body d-flex align-items-center" style="gap: 18px;">
                                                <a href="{{ route('admin.transaction.show', $transaction->id) }}"
                                                    class="w-100 a-normal">
                                                    <div class="card-body p-0">
                                                        <ul class="list-unstyled">
                                                            <li class="media align-items-center">
                                                                <img class="d-flex mr-3 br-18"
                                                                    src="{{ asset('uploads/' . $transaction->carts->first()->product_variation->product->featured_image) }}"
                                                                    width="60" alt="Generic placeholder image">
                                                                <div class="media-body">
                                                                    <h5 class="mt-0 mb-1">
                                                                        <b>{{ $transaction->carts->first()->product_variation->product->name }}</b>
                                                                    </h5>
                                                                    <h6 class="m-0">
                                                                        {{ $transaction->carts->first()->product_variation->name }}
                                                                    </h6>
                                                                    <h6 class="m-0">
                                                                        {{ $transaction->carts->first()->price }}</h6>
                                                                </div>
                                                                <p class="m-0">
                                                                    x{{ $transaction->carts->first()->quantity }}</p>
                                                            </li>
                                                        </ul>
                                                        @if ($transaction->carts->count() > 1)
                                                            <h6 class="text-right mt-1">+
                                                                {{ $transaction->carts->count() - 1 }} other products
                                                            </h6>
                                                        @endif
                                                        <div class="divider-dash"></div>
                                                        <div class="d-flex justify-content-between">
                                                            <p class="m-0"><b>Total Payment using
                                                                    {{ $transaction->payment_method->name }}</b></p>
                                                            <p class="m-0"><b>${{ $transaction->total_price }}</b>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary text-white pr-4 pl-4" href="{{route('admin.transaction.index')}}">See More</a>
                        <!-- ke halaman manage order -->
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chart.js/dist/Chart.min.js') }}"></script>
    <script>
        const date = new Date();
        var first_date = `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate() - 6}`
        var second_date = `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()}`
        var transactions = @json($transactiones);
        var objects_noo = []
        var current_period = ""
        var object_count = 0
        var total_per_period = 0

        function refactArray(array) {
            array.forEach(element => {
                element.created_at = element.created_at.substring(0, element.created_at.indexOf("T"))
            });
        }

        function setupArray(array) {
            refactArray(array);
            array.forEach(function callback(value, index) {
                if (index == 0) {
                    object_count = 0;
                    total_per_period = 0;
                    objects_noo = []
                }
                if (current_period != value.created_at) {
                    if (current_period != "") {
                        var object = {
                            period: current_period,
                            order: object_count,
                            itouch: 10,
                        }
                        objects_noo.push(object)
                    }
                    current_period = value.created_at
                    object_count = 1
                    total_per_period = value.total_price
                } else {
                    object_count += 1;
                    total_per_period += value.total_price
                }
            });
            var object = {
                period: current_period,
                order: object_count,
                itouch: 10,
            }
            objects_noo.push(object)
            $("#number-of-order").html(null)
            $(function() {
                "use strict";
                Morris.Area({
                    element: 'number-of-order',
                    data: objects_noo,
                    xkey: 'period',
                    ykeys: ['order'],
                    labels: ['New Order'],
                    xLabels: 'day',
                    xLabelFormat: function(x) {
                        return x.getDate() + "/" + (x.getMonth() + 1).toString().padStart(2, '0')
                    },
                    pointSize: 3,
                    fillOpacity: 0,
                    pointStrokeColors: ['#5f76e8'],
                    behaveLikeLine: true,
                    gridLineColor: '#e0e0e0',
                    lineWidth: 3,
                    hideHover: 'auto',
                    lineColors: ['#5f76e8'],
                    resize: true,
                });
            });
        }
        setupArray(transactions)
    </script>
@endsection
