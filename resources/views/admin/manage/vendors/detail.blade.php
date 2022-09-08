@extends('admin.layout')

@section('vendors-manage-selected')
    selected
@endsection

@section('vendors-manage-link-active')
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
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Vendor Detail</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.vendor.index') }}"
                                        class="text-muted">Vendors</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Vendor Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-4 d-flex justify-content-end gap-15x">
                    <a href="{{ route('admin.vendor.edit', $vendor->id) }}"
                        class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 text-white"><i
                            class="fa fa-edit text-white"></i>Edit</a>
                    <a onclick="event.preventDefault(); document.getElementById('delete-vendor-form-{{ $vendor->id }}').submit();"
                        class="btn btn-danger d-flex gap-15x align-items-center pr-4 pl-4 text-white"><i
                            class="fa fa-trash text-white"></i>Delete</a>
                </div>
                <form action="{{ route('admin.vendor.destroy', $vendor->id) }}" id="delete-vendor-form-{{ $vendor->id }}"
                    method="post">
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
                                <div class="col-12 d-flex flex-column justify-content-center">
                                    <h2 class="card-title mb-4">{{ $vendor->name }}</h2>
                                    <p class="m-0">{{ $vendor->description }}</p>
                                    <div class="divider-dash mt-4 mb-4"></div>
                                    <h4 class="card-title">Contact</h4>
                                    <p class="m-0">{{ $vendor->email }}</p>
                                    <p class="m-0">{{ $vendor->phone }}</p>
                                    <div class="d-flex gap-15x justify-content-end">
                                        <button
                                            class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><img
                                                src="{{ asset('assets/images/whatsapp.svg') }}" width="24"
                                                height="24" />Whatsapp</button>
                                        <button
                                            class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><i
                                                data-feather="mail" class="feather-icon"></i>Mail</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" id="product-list">
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
        var vendor = @json($vendor->id);
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            page = $(this).attr('href').split('page=')[1];
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
                    metric: metric,
                    vendor: vendor
                })
                .done(function(data) {
                    $('#product-list').html(data);
                })
                .fail(function(error) {
                    console.log(error);
                });
        }
    </script>
    <script>
        sort(page);
    </script>
@endsection
