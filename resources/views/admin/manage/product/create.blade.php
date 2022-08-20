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
            <div class="col align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Create Product</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/products')}}" class="text-muted">Products</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Create Product</li>
                        </ol>
                    </nav>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST">
                            <h4 class="card-title mb-4">Basic Information</h4>
                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="productName" required placeholder="Product Name">
                            </div>
                            <div class="form-group">
                                <label for="productDescription">Product Description</label>
                                <textarea class="form-control" id="productDescription" name="productDescription" required placeholder="Product Description" rows="4"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="productCategory">Category</label>
                                        <select class="custom-select" id="productCategory">
                                            <option selected value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="productVendor">Vendor</label>
                                        <select class="custom-select" id="productVendor">
                                            <option selected value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="productAdditionalInformation">Additional Information</label>
                                <textarea class="form-control" id="productAdditionalInformation" name="productAdditionalInformation" placeholder="Additional Information" rows="4"></textarea>
                            </div>
                            <div class="divider-dash mt-4 mb-4"></div>
                            <h4 class="card-title mb-4">Product Images</h4>
                            <div class="form-group">
                                <label for="productFeaturedImage">Featured Image</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="productFeaturedImage">
                                        <label class="custom-file-label" for="productFeaturedImage">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <label class="mt-3">Additional Product Image</label>
                            <div id="productImageGroup"></div>
                            <p class="text-lg-right mt-4">
                                <a href="javascript:void(0)" class="btn btn-primary text-white" id="addImage">Add Another Image</a>
                            </p>
                            <div class="divider-dash mt-4 mb-4"></div>
                            <h4 class="card-title mb-4">Product Images</h4>
                            <div id="productVariationGroup"></div>
                            <p class="text-lg-right mt-4">
                                <a href="javascript:void(0)" class="btn btn-primary text-white" id="addVariation">Add Another Variation</a>
                            </p>
                            <div class="divider-dash mt-4 mb-4"></div>
                            <div class="d-flex mt-4 gap-15x">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <a href="{{route('products.index')}}" class="btn btn-light">Cancel</a>
                            </div>
                        </form>
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
    var countImage = 0;
    $(".review-filter").on('click',function(){
        $(".review-filter").removeClass("card-selected");
        $(".review-filter").addClass("card-not-selected");
        $(this).removeClass("card-not-selected");
        $(this).addClass("card-selected");
    });

    var variation = [];
    $("#addImage").on('click',function(){
        countImage++;
        $("#productImageGroup").append(`
            <div class="form-group mt-2" id="inputProductImage` + countImage + `">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="productImage[]" id="productImage` + countImage + `">
                        <label class="custom-file-label" for="productImage` + countImage + `">Choose file</label>
                    </div>
                    <div class="pl-2 pr-2 d-flex align-items-center justify-content-center custom-border deleteImage cursor-pointer border-danger" count="` + countImage + `">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x feather-icon text-danger"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </div>
                </div>
            </div>
        `);
    });

    $(document).on('click', '.deleteImage', function(){
        var id = $(this).attr("count");
        $("#inputProductImage" + id).remove();
    });

    var countVariant = 0;
    $("#addVariation").on('click', function(){
        countVariant++;
        $("#productVariationGroup").append(`
            <div class="form-group mt-2" id="inputProductVariant` + countVariant + `">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <p style="white-space: nowrap;" class="m-0 mr-3">Variant</p>
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" id="productName" name="productName" required placeholder="Name">
                    </div>
                    <div class="col-4">
                        <input type="number" class="form-control" id="productName" name="productName" required placeholder="Price">
                    </div>
                    <div class="col-2">
                        <div class="d-flex h-100">
                            <div class="pl-2 pr-2 d-flex align-items-center justify-content-center custom-border deleteVariant cursor-pointer border-danger" count="` + countVariant + `">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x feather-icon text-danger"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);
    });

    $(document).on('click', '.deleteVariant', function(){
        var id = $(this).attr("count");
        $("#inputProductVariant" + id).remove();
    });

</script>
@endsection
