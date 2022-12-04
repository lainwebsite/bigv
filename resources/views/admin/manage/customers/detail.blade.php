@extends('admin.layout')

@section('customers-manage-selected')
    selected
@endsection

@section('customers-manage-link-active')
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
                <div class="col-8 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Customer Detail</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}"
                                        class="text-muted">Customers</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Customer Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-4 d-flex justify-content-end">
                    <form action="{{ route('admin.user.destroy', $user->id) }}" id="delete-user-form-{{ $user->id }}"
                        method="post">
                        @method('DELETE')
                        @csrf
                        @if ($user->ban == 0)
                            <div onclick="deleteData({{ $user->id }}, '{{ $user->name }}', 'ban')"
                                class="btn btn-danger d-flex gap-15x align-items-center pr-4 pl-4">
                                <i class="fa fa-ban"></i>Ban User
                            </div>
                        @else
                            <div onclick="deleteData({{ $user->id }}, '{{ $user->name }}', 'unban')"
                                class="btn btn-light d-flex gap-15x align-items-center pr-4 pl-4">
                                <i class="fa fa-ban"></i>Unban User
                            </div>
                        @endif
                    </form>
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
            <div class="row">
                <div class="col-12">
                    <div id="order-status" class="card bg-orange">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 d-flex">
                                    <div class="m-0">
                                        <h4 class="card-title m-0 text-white">{{ $user->tier->name }} Tier</h4>
                                        <p class="m-0 text-white">Registered since
                                            <b>{{ date_format(date_create($user->created_at), 'd/m/Y') }}</b>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <div class="m-0">
                                        <h4 class="card-title m-0 text-white text-lg-right">{{ $user->visits }} Visits</h4>
                                        <p class="m-0 text-white"><b>{{ $user->transactions->count() }} Transactions</b>
                                        </p>
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
                                        <b>{{ date_format(date_create($user->date_of_birth), 'd/m/Y') }}</b>
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
                            <h4 class="card-title mb-4">Analytics</h4>
                            <div class="align-self-center d-flex align-items-center">
                                <p class="mr-4 mb-0 text-nowrap">Start Date</p>
                                <input id="filter_start_date" type="date" class="form-control w-auto">
                                <p class="ml-4 mr-4 mb-0">-</p>
                                <p class="mr-4 mb-0 text-nowrap">End Date</p>
                                <input id="filter_end_date" type="date" class="form-control w-auto mr-4">
                                <a class="btn btn-primary text-white pr-4 pl-4" onclick="analytics();">Filter</a>
                            </div>
                            <div class="row mt-5" id="analytics-data">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection

@section('javascript-extra')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    </script>
    <script>
        function analytics() {
            var hostname = "{{ request()->getHost() }}"
            var url = ""
            if (hostname.includes('www')) {
                url = "https://" + hostname
            } else {
                url = "{{ config('app.url') }}"
            }
            $.post(url + "/admin/user/analytics", {
                    _token: CSRF_TOKEN,
                    start: $('#filter_start_date').val(),
                    end: $('#filter_end_date').val(),
                    id: @json($user->id)
                })
                .done(function(data) {
                    $('#analytics-data').html(data);
                })
                .fail(function(error) {
                    console.log(error);
                });
        }
    </script>
    <script>
        function deleteData(id, name, detail) {
            event.preventDefault();
            if (confirm(`Are you sure you want to ${detail} ${name}?`)) {
                document.getElementById(`delete-user-form-${id}`).submit();
            }
        }
    </script>
@endsection
