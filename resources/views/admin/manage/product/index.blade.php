@extends('admin.layout')

@section('products-manage-selected')
    selected
@endsection

@section('products-manage-link-active')
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
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Product List</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Products</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-7 align-self-center d-flex justify-content-end align-items-center">
                    <p class="mr-4 mb-0">Sort By</p>
                    <div class="customize-input float-right mr-4">
                        <select id="sort"
                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                            <option value="1" selected>Newest</option>
                            <option value="2">Oldest</option>
                            {{-- <option value="3">Highest Price</option>
                            <option value="4">Lowest Price</option> --}}
                            <option value="5">Highest Rating</option>
                            <option value="6">Lowest Rating</option>
                        </select>
                    </div>
                    <a class="btn btn-primary text-white pr-4 pl-4" href="{{ route('admin.product.create') }}">Create
                        Product</a>
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
                @foreach ($categories as $category)
                    <div id="category-filter-{{ $category->id }}"
                        class="card-not-selected pr-3 pl-3 pt-2 pb-2 category-filter"
                        onclick="changeFilter({{ $category->id }});">
                        <div class="d-flex">
                            <h6 class="m-0">{{ $category->name }}</h6>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" id="product-list">
                        @include('admin.manage.product.inc.product')
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
        var metric = "created_at";
        var sorted = "desc";
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
            $(".category-filter").removeClass("card-selected");
            $(".category-filter").addClass("card-not-selected");
            if (filter != selected) {
                filter = selected;
                $(`#category-filter-${selected}`).removeClass("card-not-selected");
                $(`#category-filter-${selected}`).addClass("card-selected");
            } else {
                filter = null;
            }
            sort(page);
        };
    </script>
    <script>
        $('#sort').on('change', function() {
            page = 1;
            switch ($('#sort').val()) {
                case "1":
                    metric = "created_at";
                    sorted = "desc";
                    break;
                case "2":
                    metric = "created_at";
                    sorted = "asc";
                    break;
                case "3":
                    metric = "price";
                    sorted = "desc";
                    break;
                case "4":
                    metric = "price";
                    sorted = "asc";
                    break;
                case "5":
                    metric = "rating";
                    sorted = "desc";
                    break;
                case "6":
                    metric = "rating";
                    sorted = "asc";
                    break;

                default:
                    break;
            }
            sort(page);
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
            $.post(url + "/admin/product/sort?page=" + page, {
                    _token: CSRF_TOKEN,
                    sort: sorted,
                    filter: filter,
                    metric: metric
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
