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
                <div class="col-8 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Product Detail</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}"
                                        class="text-muted">Products</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Product Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-4 d-flex justify-content-end gap-15x">
                    <a href="{{ route('admin.product.edit', $product->id) }}"
                        class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 text-white"><i
                            class="fa fa-edit text-white"></i>Edit</a>
                    <a onclick="deleteData({{ $product->id }}, '{{ $product->name }}');"
                        class="btn btn-danger d-flex gap-15x align-items-center pr-4 pl-4 text-white"><i
                            class="fa fa-trash text-white"></i>Delete</a>
                </div>
                <form action="{{ route('admin.product.destroy', $product->id) }}"
                    id="delete-product-form-{{ $product->id }}" method="post">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                </form>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div id="carouselProductImage" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner br-18">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100"
                                                    src="{{ asset('uploads/' . $product->featured_image) }}"
                                                    alt="First slide">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8 d-flex flex-column justify-content-center">
                                    <h4 class="text-muted m-0">{{ $product->category->name }}</h4>
                                    <h2 class="card-title mb-2">{{ $product->name }}</h2>
                                    <div class="d-flex mb-3">
                                        <i style="margin-top: 1px;" class="fas fa-star mr-1"></i>
                                        <h4 class="m-0">{{ $product->rating }} ({{ $product->reviews->count() }}
                                            rating)
                                        </h4>
                                    </div>
                                    <p class="m-0">{{ $product->description }}</p>
                                    <!-- Addon -->
                                    <div class="divider-dash mt-4 mb-4"></div>
                                    @foreach ($product->addons as $addon)
                                        <h4 class="card-title">{{ $addon->name }} @if ($addon->required == 1)
                                                (required)
                                            @endif
                                        </h4>
                                        <p class="mb-3">
                                            @foreach ($addon->options as $addon_option)
                                                {{ $addon_option->name }} (${{ $addon_option->price }}) @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </p>
                                    @endforeach
                                    <!-- Addon -->
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
                            <h4 class="card-title mb-4">Variations</h4>
                            @foreach ($product->variations as $variation)
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <h3 class="card-title mb-0">{{ $variation->name }}</h3>
                                            <small class="mb-2"><b>$
                                                    {{ $variation->price }}</b></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider-dash mt-2 mb-2"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Vendor</h4>
                            <div class="d-flex justify-content-between">
                                <a href="{{route('admin.vendor.show', $product->vendor_id)}}" class="d-flex align-items-center">
                                    <img width="60" height="60"
                                        src="{{ asset('uploads/' . $product->vendor->photo) }}" alt=""
                                        class="br-18 mr-4">
                                    <div class="d-flex flex-column">
                                        <h3 class="card-title mb-0">{{ $product->vendor->name }}</h3>
                                        <small class="mb-2"><b>Location:
                                                {{ $product->vendor->location->name }}</b></small>
                                    </div>
                                </a>
                                <div class="d-flex gap-15x justify-content-end">
                                    <a target="_blank"
                                        href="{{ 'https://wa.me/' . $product->vendor->phone . '?text=Hello%20Vendor%20%22vendor%20name%22' }}"
                                        class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><img
                                            src="{{ asset('assets/images/whatsapp.svg') }}" width="24"
                                            height="24" />Whatsapp</a>
                                    <a href="mailto:{{ $product->vendor->email }}"
                                        class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><i
                                            data-feather="mail" class="feather-icon"></i>Mail</a>
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
                            <h4 class="card-title">Reviews</h4>
                            <div class="d-flex gap-5x mb-4">
                                <div id="review-filter-5" class="card-not-selected pr-3 pl-3 pt-2 pb-2 review-filter"
                                    onclick="changeFilter(5);">
                                    <div class="d-flex">
                                        <i style="margin-top: 1px;" class="fas fa-star mr-1 font-14"></i>
                                        <h6 class="m-0">5</h6>
                                    </div>
                                </div>
                                <div id="review-filter-4" class="card-not-selected pr-3 pl-3 pt-2 pb-2 review-filter"
                                    onclick="changeFilter(4);">
                                    <div class="d-flex">
                                        <i style="margin-top: 1px;" class="fas fa-star mr-1 font-14"></i>
                                        <h6 class="m-0">4</h6>
                                    </div>
                                </div>
                                <div id="review-filter-3" class="card-not-selected pr-3 pl-3 pt-2 pb-2 review-filter"
                                    onclick="changeFilter(3);">
                                    <div class="d-flex">
                                        <i style="margin-top: 1px;" class="fas fa-star mr-1 font-14"></i>
                                        <h6 class="m-0">3</h6>
                                    </div>
                                </div>
                                <div id="review-filter-2" class="card-not-selected pr-3 pl-3 pt-2 pb-2 review-filter"
                                    onclick="changeFilter(2);">
                                    <div class="d-flex">
                                        <i style="margin-top: 1px;" class="fas fa-star mr-1 font-14"></i>
                                        <h6 class="m-0">2</h6>
                                    </div>
                                </div>
                                <div id="review-filter-1" class="card-not-selected pr-3 pl-3 pt-2 pb-2 review-filter"
                                    onclick="changeFilter(1);">
                                    <div class="d-flex">
                                        <i style="margin-top: 1px;" class="fas fa-star mr-1 font-14"></i>
                                        <h6 class="m-0">1</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column" id="review-list">
                                @include('admin.manage.product.inc.review')
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
            $(".review-filter").removeClass("card-selected");
            $(".review-filter").addClass("card-not-selected");
            if (filter != selected) {
                filter = selected;
                $(`#review-filter-${selected}`).removeClass("card-not-selected");
                $(`#review-filter-${selected}`).addClass("card-selected");
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
            $.post(url + "/admin/product/review/sort?page=" + page, {
                    _token: CSRF_TOKEN,
                    filter: filter,
                    product_id: @json($product->id)
                })
                .done(function(data) {
                    $('#review-list').html(data);
                })
                .fail(function(error) {
                    console.log(error);
                });
        }
    </script>
    <script>
        function deleteData(id, name) {
            event.preventDefault();
            if (confirm(`Are you sure you want to delete ${name}?`)) {
                document.getElementById(`delete-product-form-${id}`).submit();
            }
        }
    </script>
@endsection
