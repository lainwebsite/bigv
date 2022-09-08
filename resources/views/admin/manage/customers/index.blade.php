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
                <div class="col-5 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Customer List</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Customers</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-7 align-self-center d-flex justify-content-end align-items-center">
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
                @foreach ($tiers as $userTier)
                    <div id="status-filter-{{ $userTier->id }}" class="card-not-selected pr-3 pl-3 pt-2 pb-2 status-filter"
                        onclick="changeFilter({{ $userTier->id }});">
                        <div class="d-flex">
                            <h6 class="m-0">{{ $userTier->name }}</h6>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" id="user-list">
                        @include('admin.manage.customers.inc.user')
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
            $.post(url + "/admin/user/sort?page=" + page, {
                    _token: CSRF_TOKEN,
                    sort: $('#sort').val(),
                    filter: filter,
                })
                .done(function(data) {
                    $('#user-list').html(data);
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
