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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Products</li>
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
                        <option value="3">Highest Price</option>
                        <option value="4">Lowest Price</option>
                        <option value="5">Highest Rating</option>
                        <option value="6">Lowest Rating</option>
                    </select>
                </div>
                <a class="btn btn-primary text-white pr-4 pl-4" href="{{route('products.create')}}">Create Product</a>
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
                    <h6 class="m-0">Food & Beverages</h6>
                </div>
            </div>
            <div class="card-not-selected pr-3 pl-3 pt-2 pb-2 category-filter">
                <div class="d-flex">
                    <h6 class="m-0">Snacks</h6>
                </div>
            </div>
            <div class="card-not-selected pr-3 pl-3 pt-2 pb-2 category-filter">
                <div class="d-flex">
                    <h6 class="m-0">Muslim Owned</h6>
                </div>
            </div>
        </div>
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
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Variations</th>
                                        <th>Vendor</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 5; $i++)
                                    <tr>
                                        <td>
                                            <a href="/productdet" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                                    <small class="m-0">Snacks</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">$10</td>
                                        <td class="align-middle">Red, Yellow, Blue, Black</td>
                                        <td class="align-middle">Mont Delizioso</td>
                                        <td class="align-middle">
                                            <div class="d-flex" style="gap: 10px;">
                                                <a href="" class="a-normal text-info"><i data-feather="edit" class="feather-icon"></i></a>
                                                <a href="" class="a-normal text-danger"><i data-feather="trash" class="feather-icon"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endfor
                                    <tr>
                                        <td>
                                            <a href="" class="a-normal d-flex align-items-center">
                                                <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                                <div class="d-flex align-items-start flex-column">
                                                    <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                                    <small class="m-0">Snacks</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle"><s>$20</s><br>$10</td>
                                        <td class="align-middle">Red, Yellow, Blue, Black</td>
                                        <td class="align-middle">Mont Delizioso</td>
                                        <td class="align-middle">
                                            <div class="d-flex" style="gap: 10px;">
                                                <a href="" class="a-normal text-info"><i data-feather="edit" class="feather-icon"></i></a>
                                                <a href="" class="a-normal text-danger"><i data-feather="trash" class="feather-icon"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination justify-content-center">
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
    $(".category-filter").on('click',function(){
        $(".category-filter").removeClass("card-selected");
        $(".category-filter").addClass("card-not-selected");
        $(this).removeClass("card-not-selected");
        $(this).addClass("card-selected");
    });
</script>
@endsection
