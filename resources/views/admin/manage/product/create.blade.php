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
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}"
                                        class="text-muted">Products</a>
                                </li>
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
                            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h4 class="card-title mb-4">Basic Information</h4>
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        placeholder="Product Name">
                                </div>
                                <div class="form-group" id="productPriceNoVariation">
                                    <label for="productPriceNoVar">Product Price</label>
                                    <input type="number" class="form-control" id="productPriceNoVar"
                                        name="product_price_no_var" placeholder="Product Price">
                                </div>
                                <div class="form-group">
                                    <label for="description">Product Description</label>
                                    <textarea class="form-control" id="description" name="description" required placeholder="Product Description"
                                        rows="4"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select class="custom-select" id="category" name="category">
                                                @foreach ($categories as $productCategory)
                                                    <option value="{{ $productCategory->id }}">{{ $productCategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="vendor">Vendor</label>
                                            <select class="custom-select" id="vendor" name="vendor">
                                                @foreach ($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="">Additional Information</label>
                                    <textarea class="form-control" id="" name=""
                                        placeholder="Additional Information" rows="4"></textarea>
                                </div> --}}
                                <div class="divider-dash mt-4 mb-4"></div>
                                <h4 class="card-title mb-4">Product Images</h4>
                                <div class="form-group">
                                    <label for="productFeaturedImage">Featured Image</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="productFeaturedImage"
                                                name="featured_image">
                                            <label class="custom-file-label" for="productFeaturedImage">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <label class="mt-3">Additional Product Image</label>
                                <div id="productImageGroup"></div>
                                <p class="text-lg-right mt-4">
                                    <a href="javascript:void(0)" class="btn btn-primary text-white" id="addImage">Add
                                        an Image</a>
                                </p>
                                <div class="divider-dash mt-4 mb-4"></div>
                                <div class="form-check form-check-inline mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="addVariationCheckbox"
                                            name="with_variation">
                                        <label class="custom-control-label" for="addVariationCheckbox">Add Variation</label>
                                    </div>
                                </div>
                                <div id="addProductVariationGroup" style="display:none;">
                                    <h4 class="card-title mb-4">Product Variations</h4>
                                    <div class="form-group">
                                        <label for="variation_named">Product Variation Name</label>
                                        <input type="text" class="form-control" id="variation_named"
                                            name="variation_named" placeholder="e.g Size, Flavor, Color, etc.">
                                    </div>
                                    <div id="productVariationGroup"></div>
                                    <p class="text-lg-right mt-4">
                                        <a href="javascript:void(0)" class="btn btn-primary text-white"
                                            id="addVariation">
                                            Add a Variation</a>
                                    </p>
                                </div>
                                <div class="divider-dash mt-4 mb-4"></div>
                                <!-- PRODUCT ADDON -->
                                <h4 class="card-title mb-4">Product Add-on</h4>
                                <div id="productAddonGroup" class="d-flex flex-column" style="gap:30px;">
                                </div>
                                <p class="text-lg-right mt-4">
                                    <a href="javascript:void(0)" class="btn btn-primary text-white" id="addAddon">
                                        Add Add-on
                                    </a>
                                </p>
                                <!-- PRODUCT ADDON -->
                                <div class="d-flex mt-4 gap-15x">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <a href="{{ route('admin.product.index') }}" class="btn btn-light">Cancel</a>
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
        $(".review-filter").on('click', function() {
            $(".review-filter").removeClass("card-selected");
            $(".review-filter").addClass("card-not-selected");
            $(this).removeClass("card-not-selected");
            $(this).addClass("card-selected");
        });

        var variation = [];
        $("#addImage").on('click', function() {
            countImage++;
            $("#productImageGroup").append(`
            <div class="form-group mt-2" id="inputProductImage` + countImage + `">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="productImage[]" id="productImage` +
                countImage + `">
                        <label class="custom-file-label" for="productImage` + countImage +
                `">Choose file</label>
                    </div>
                    <div class="pl-2 pr-2 d-flex align-items-center justify-content-center custom-border deleteImage cursor-pointer border-danger" count="` +
                countImage + `">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x feather-icon text-danger"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </div>
                </div>
            </div>
        `);
        });

        $(document).on('click', '.deleteImage', function() {
            var id = $(this).attr("count");
            $("#inputProductImage" + id).remove();
        });

        $("#addVariationCheckbox").on('change', function() {
            if ($(this).is(':checked')) {
                $("#addProductVariationGroup").slideDown();
                $("#productPriceNoVariation").slideUp();
            } else {
                $("#addProductVariationGroup").slideUp();
                $("#productPriceNoVariation").slideDown();
            }
        });

        var countVariation = 0;
        $("#addVariation").on('click', function() {
            countVariation++;
            $("#productVariationGroup").append(`
            <div class="form-group mt-2" id="inputProductVariation` + countVariation +
                `">
                <div class="row">
                    <div class="col-1 d-flex align-items-center">
                        <p style="white-space: nowrap;" class="m-0 mr-3">Variation</p>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" id="name" name="variation_name[${countVariation}]" required placeholder="Name">
                    </div>
                    <div class="col-3">
                        <input type="number" class="form-control" id="name" name="variation_price[${countVariation}]" required placeholder="Price">
                    </div>
                    <div class="col-1">
                        <div class="d-flex h-100">
                            <div class="pl-2 pr-2 d-flex align-items-center justify-content-center custom-border deleteVariation cursor-pointer border-danger" count="` +
                countVariation + `">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x feather-icon text-danger"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);
        });

        $(document).on('click', '.deleteVariation', function() {
            countVariation--;
            var id = $(this).attr("count");
            $("#inputProductVariation" + id).remove();
        });
        // ==================== ADDON ==================

        var countAddon = 0;
        $("#addAddon").on('click', function() {
            countAddon++;
            $("#productAddonGroup").append(`
                                    <div class="d-flex flex-column" style="gap: 12px;" data-id="${countAddon}" data-optcount=0>
                                        <div class="row align-items-center">
                                            <div class="col-12 col-md-4 d-flex">
                                                <p style="white-space: nowrap;" class="m-0">
                                                    <b>Addon <span class="addon-number">${countAddon}</span></b>
                                                </p>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input type="text" class="form-control w-100" id="addonName"
                                                    name="addon_name[${countAddon}]" required placeholder="Addon Name">
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="addon-required-${countAddon}"
                                                    name="addon_required[${countAddon}]">
                                                <label class="custom-control-label" for="addon-required-${countAddon}">Addon
                                                    Required</label>
                                            </div>
                                        </div>
                                        <div class="addon-option-group d-flex flex-column" style="gap: 10px;"></div>
                                        <div class="d-flex justify-content-end" style="gap: 10px;">
                                            <a href="javascript:void(0)"
                                                class="btn btn-primary font-12 text-white add-addon-option">Add Option</a>
                                            <a href="javascript:void(0)"
                                                class="btn btn-secondary font-12 text-white delete-addon">Delete Addon</a>
                                        </div>
                                    </div>
        `);

            $('.addon-number').each(function(i, obj) {
                $(this).html(i + 1);
            });
        });

        $(document).on('click', '.add-addon-option', function() {
            var addonIndex = $(this).parent().parent().data("id");
            var optCount = $(this).parent().parent().data("optcount");
            optCount++;
            $(this).parent().parent().data("optcount", optCount);
            $(this).parent().parent().children(".addon-option-group").append(`
            <div class="row align-items-center">
                <div class="col-12 col-md-3 d-flex">
                    <p style="white-space: nowrap;" class="m-0">Option</p>
                </div>
                <div class="col-12 col-md-9">
                    <div class="row">
                        <div class="col-5">
                            <input type="text" class="form-control" id="productName" name="option_name[${addonIndex}][${optCount}]" required="" placeholder="Name">
                        </div>
                        <div class="col-5 p-0">
                            <input type="number" class="form-control" id="productName" name="option_price[${addonIndex}][${optCount}]" required="" placeholder="Price">
                        </div>
                        <div class="col-2">
                            <div class="d-flex h-100">
                                <div class="pl-2 pr-2 d-flex align-items-center justify-content-center custom-border delete-addon-option cursor-pointer border-danger" count="1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x feather-icon text-danger"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);
        });

        $(document).on('click', '.delete-addon', function() {
            countAddon--;
            $(this).parent().parent().remove();
            $('.addon-number').each(function(i, obj) {
                $(this).html(i + 1);
            });
        });

        $(document).on('click', '.delete-addon-option', function() {
            $(this).parent().parent().parent().parent().parent().remove();
        });

        // =============================================
    </script>
@endsection
