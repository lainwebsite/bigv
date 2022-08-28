@extends('admin.layout')

@section('orders-manage-selected')
    selected
@endsection

@section('orders-manage-link-active')
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
                <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Order List</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Orders</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-5 align-self-center d-flex justify-content-end align-items-center">
                    <p class="mr-4 mb-0">Sort By</p>
                    <div class="customize-input float-right">
                        <select id="sort"
                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                            <option value="desc" selected>Date Descending</option>
                            <option value="asc">Date Ascending</option>
                        </select>
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
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- basic table -->
            <div class="d-flex gap-15x mb-3">
                @foreach ($statuses as $status)
                    <div id="status-filter-{{ $status->id }}"
                        class="card-not-selected pr-3 pl-3 pt-2 pb-2 status-filter"
                        onclick="changeFilter({{ $status->id }});">
                        <div class="d-flex">
                            <h6 class="m-0">{{ $status->name }}</h6>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Column -->
                                <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 br-18 bg-danger text-center">
                                            <h1 class="font-light text-white">
                                                {{ $transactiones->where('status_id', 1)->count() }}</h1>
                                            <h6 class="text-white">Payment Pending</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 br-18 bg-primary text-center">
                                            <h1 class="font-light text-white">
                                                {{ $transactiones->where('status_id', 2)->count() }}</h1>
                                            <h6 class="text-white">Paid</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 br-18 bg-cyan text-center">
                                            <h1 class="font-light text-white">
                                                {{ $transactiones->where('status_id', 3)->count() }}</h1>
                                            <h6 class="text-white">Delivered</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 br-18 bg-success text-center">
                                            <h1 class="font-light text-white">
                                                {{ $transactiones->where('status_id', 4)->count() }}</h1>
                                            <h6 class="text-white">Success</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                            </div>
                            <div class="row" id="transaction-list">
                                @include('admin.manage.transaction.inc.transaction')
                            </div>
                        </div>
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
        function changeFilter(selected) {
            page = 1;
            $(".status-filter").removeClass("card-selected");
            $(".status-filter").addClass("card-not-selected");
            if (filter != selected) {
                filter = selected;
                $(`#status-filter-${selected}`).removeClass("card-not-selected");
                $(`#status-filter-${selected}`).addClass("card-selected");
            } else {
                filter = null;
            }
            sort(page);
        };
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
            $.post(url + "/admin/transaction/sort?page=" + page, {
                    _token: CSRF_TOKEN,
                    sort: $('#sort').val(),
                    filter: filter,
                })
                .done(function(data) {
                    $('#transaction-list').html(data);
                })
                .fail(function(error) {
                    console.log(error);
                });
        }
    </script>
    <script>
        $('#sort').on('change', function() {
            page = 1;
            sort(page);
        });
    </script>
@endsection
