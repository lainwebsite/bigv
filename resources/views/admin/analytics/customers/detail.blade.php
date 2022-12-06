@extends('admin.layout')

@section('customers-analytics-selected')
    selected
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
                <div class="col-6 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ $user->name }}</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/customer-analytics') }}"
                                        class="text-muted">Customer Analytics</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">{{ $user->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-6 align-self-center d-flex justify-content-end align-items-center">
                    <div class="card-not-selected border-lightgray pl-4 pb-2 pt-2 pr-4 rounded-pill mb-2" id="expandFilter">
                        <div class="d-flex align-items-center justify-content-between" style="gap: 10px;">
                            <i class="fa fa-filter"></i>
                            <p class="m-0">Filter</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3" id="expandableFilter" style="display:none;">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <label><b>Date</b></label>
                                    <div class="align-self-center mb-3 d-flex align-items-center flex-wrap">
                                        <input type="date" class="form-control w-auto" id="start-date">
                                        <p class="ml-3 mr-3 mb-0">-</p>
                                        <input type="date" class="form-control w-auto mr-4" id="end-date">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-2 gap-15x">
                                <button class="btn btn-primary" id="btnApplyFilter">Apply</button>
                            </div>
                        </div>
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
            <div class="row">
                <div class="col-12">
                    <div id="order-status" class="card bg-orange">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 d-flex">
                                    <div class="m-0">
                                        <h4 class="card-title m-0 text-white">{{ $user->tier->name }} Tier</h4>
                                        <p class="m-0 text-white">Registered since
                                            <b>{{ date('d-m-Y', strtotime($user->created_at)) }}</b>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <div class="m-0">
                                        <h4 class="card-title m-0 text-white text-lg-right">{{ $user->visits }} Visits</h4>
                                        <p class="m-0 text-white">{{ $user->transactions->count() }} Transactions</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title mb-4">Customer Info</h4>
                                    <p class="m-0">{{ $user->name }}</p>
                                    <p class="m-0">{{ $user->phone }}</p>
                                    <p class="m-0">{{ $user->email }}</p>
                                    <p class="m-0">Date of Birth
                                        <b>{{ date('d-m-Y', strtotime($user->created_at)) }}</b>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Product Purchases</h4>
                            {{-- <p class="mb-0 mt-3">Total Product Sold: <b>401</b></p>
                            <p class="mb-0">Total Income: <b>$401</b></p> --}}
                            <ul class="list-inline text-right">
                                <li class="list-inline-item">
                                    <h5><i class="fa fa-circle mr-1 text-purple"></i>Product Sold</h5>
                                </li>
                            </ul>
                            <div id="product-sold"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ml-2 mb-4">
                <div class="col-lg-6 col-sm-12 d-flex align-items-center">
                    <h4 class="card-title m-0">Product Transaction History</h4>
                </div>
                <div class="col-lg-6 col-sm-12 d-flex justify-content-end">
                    <div class="d-flex align-items-center">
                        <p class="mr-4 mb-0">Sort By</p>
                        <div class="customize-input float-right mr-4">
                            <select id="sort"
                                class="custom-select rounded-pill custom-select-set form-control bg-white custom-shadow custom-radius">
                                <option value="desc" selected>Date Descending</option>
                                <option value="asc">Date Ascending</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card" id="product-list">
                        @include('admin.analytics.customers.inc.detail')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection

@section('javascript-extra')
    <script>
        var filterOpened = false;
        $("#expandFilter").on("click", function() {
            if (filterOpened) {
                $("#expandableFilter").slideUp();
                filterOpened = false;
            } else {
                $("#expandableFilter").slideDown();
                filterOpened = true;
            }
        });
    </script>
    <script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chart.js/dist/Chart.min.js') }}"></script>
    <script>
        var user_id = @json($user->id);
        const date = new Date();
        var first_date = `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate() - 6}`
        var second_date = `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()}`
        var product_sold = @json($product_sold);

        function setupChart() {
            $("#product-sold").html(null)
            $(function() {
                "use strict";
                Morris.Area({
                    element: 'product-sold',
                    data: product_sold,
                    xkey: 'period',
                    ykeys: ['sold'],
                    labels: ['Sold'],
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
        setupChart();
    </script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    </script>
    <script>
        var page = 1;
        var filter = null;
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            page = $(this).attr('href').split('page=')[1];
            sort(page);
        });
    </script>
    <script>
        $('#sort').on('change', function() {
            page = 1;
            sort(page);
        });
    </script>
    <script>
        $("#btnApplyFilter").on("click", function() {
            $("#expandFilter").click();
            first_date = $("#start-date").val();
            second_date = $("#end-date").val();
            current_period = "";
            var hostname = "{{ request()->getHost() }}"
            var url = ""
            if (hostname.includes('www')) {
                url = "https://" + hostname
            } else {
                url = "{{ config('app.url') }}"
            }
            $.post(url + `/admin/user/${user_id}/date/analytics?page=` + page, {
                    _token: CSRF_TOKEN,
                    start_date: first_date,
                    end_date: second_date
                })
                .done(function(data) {
                    product_sold = data.product_sold;
                    setupChart();
                    sort(page);
                })
                .fail(function(error) {
                    console.log(error);
                });
        });
    </script>
    <script>
        function sort(page) {
            var hostname = "{{ request()->getHost() }}"
            var url = ""
            if (hostname.includes('www')) {
                url = "https://" + hostname
            } else {
                url = "{{ config('app.url') }}"
            }
            $.post(url + `/admin/user/${user_id}/sort/analytics?page=` + page, {
                    _token: CSRF_TOKEN,
                    sort: $('#sort').val(),
                    start_date: first_date,
                    end_date: second_date
                })
                .done(function(data) {
                    $('#product-list').html(data);
                })
                .fail(function(error) {
                    console.log(error);
                });
        }
    </script>
@endsection
