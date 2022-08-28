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
                <div class="col-5 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Vendor List</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Vendors</li>
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
                    <a class="btn btn-primary text-white pr-4 pl-4" href="{{route('admin.vendor.create')}}">Create Vendor</a>
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
                <div class="card-selected pr-3 pl-3 pt-2 pb-2 category-filter">
                    <div class="d-flex">
                        <h6 class="m-0">East</h6>
                    </div>
                </div>
                <div class="card-not-selected pr-3 pl-3 pt-2 pb-2 category-filter">
                    <div class="d-flex">
                        <h6 class="m-0">West</h6>
                    </div>
                </div>
                <div class="card-not-selected pr-3 pl-3 pt-2 pb-2 category-filter">
                    <div class="d-flex">
                        <h6 class="m-0">South</h6>
                    </div>
                </div>
                <div class="card-not-selected pr-3 pl-3 pt-2 pb-2 category-filter">
                    <div class="d-flex">
                        <h6 class="m-0">North</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Vendor</th>
                                            <th>Contact</th>
                                            <th>Number of Products</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 5; $i++)
                                            <tr>
                                                <td>
                                                    <a href="/vendordet" class="a-normal d-flex align-items-center">
                                                        <img class="d-flex br-18 mr-3"
                                                            src="https://bigvsg.com/wp-content/uploads/2021/10/14-2-300x300.jpg"
                                                            width="60" alt="Generic placeholder image">
                                                        <div class="d-flex align-items-start flex-column">
                                                            <h5 class="m-0"><b>Vendor Name</b></h5>
                                                            <small class="m-0">Location</small>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="align-middle"><a href="mailto:charisel@mail.com"
                                                        target="_blank">charisel@mail.com</a><br><a
                                                        href="tel:087612381221">087612381221</a></td>
                                                <td class="align-middle">3</td>
                                                <td class="align-middle">
                                                    <div class="d-flex" style="gap: 10px;">
                                                        <a href="" class="a-normal text-info"><i data-feather="edit"
                                                                class="feather-icon"></i></a>
                                                        <a href="" class="a-normal text-danger"><i
                                                                data-feather="trash" class="feather-icon"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination justify-content-center mt-4">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
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
        $(".category-filter").on('click', function() {
            $(".category-filter").removeClass("card-selected");
            $(".category-filter").addClass("card-not-selected");
            $(this).removeClass("card-not-selected");
            $(this).addClass("card-selected");
        });
    </script>
@endsection
