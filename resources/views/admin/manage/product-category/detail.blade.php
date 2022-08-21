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
            <div class="col-8 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Category Detail</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.product-category.index')}}" class="text-muted">Categories</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Category Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-end gap-15x">
                <a href="#" class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 text-white"><i class="fa fa-edit text-white"></i>Edit</a>
                <a href="#" class="btn btn-danger d-flex gap-15x align-items-center pr-4 pl-4 text-white"><i class="fa fa-trash text-white"></i>Delete</a>
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
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 d-flex flex-column justify-content-center">
                                <h2 class="card-title mb-4">Cute Tiger Aroma Stone Set”</h2>
                                <p class="m-0">Farewell to the year of Ox, and the Year of Tiger on the way! Over here we launch our cute “Cute Tiger Aroma Stone Set” to welcome the New Year.<br>
                                The stone set is decorated with the festive red dried flowers paired with a blessed essential oil blend and a cute tiger aroma stone! It signifies peace, prosperity, good health, good luck, good dreams, happiness, wealth and all the good things come to you in the “Tiger year”</p>
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
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection

@section('scripts')
<script>
    $(".review-filter").on('click',function(){
        $(".review-filter").removeClass("card-selected");
        $(".review-filter").addClass("card-not-selected");
        $(this).removeClass("card-not-selected");
        $(this).addClass("card-selected");
    });
</script>
@endsection
