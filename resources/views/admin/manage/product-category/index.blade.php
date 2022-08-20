@extends('admin.layout')

@section('categories-manage-selected')
selected
@endsection

@section('categories-manage-link-active')
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Category List</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Categories</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-7 align-self-center d-flex justify-content-end align-items-center">
                <p class="mr-4 mb-0">Sort By</p>
                <div class="customize-input float-right mr-4">
                    <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                        <option value="1" selected>Newest</option>
                        <option value="2">Oldest</option>
                    </select>
                </div>
                <a class="btn btn-primary text-white pr-4 pl-4" href="{{route('categories.create')}}">Create Category</a>
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
        <div class="alert alert-success" role="alert">
            <strong>Success - </strong> A simple success alert—check it out!
        </div>
        <div class="alert alert-danger" role="alert">
            <strong>Error - </strong> A simple danger alert—check it out!
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Number of Products</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 5; $i++)
                                    <tr>
                                        <td>
                                            <a href="/categorydet" class="a-normal">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Food & Beverages</b></h5>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores maiores accusamus quas debitis assumenda cumque, itaque voluptate quibusdam officiis excepturi animi dolor. Commodi error aliquam vel. Vero vitae incidunt quisquam.</td>
                                        <td class="align-middle">3</td>
                                        <td class="align-middle">
                                            <div class="d-flex" style="gap: 10px;">
                                                <a href="" class="a-normal text-info"><i data-feather="edit" class="feather-icon"></i></a>
                                                <a href="" class="a-normal text-danger"><i data-feather="trash" class="feather-icon"></i></a>
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
