@extends('admin.layout')

@section('discounts-manage-selected')
selected
@endsection

@section('discounts-manage-link-active')
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Create Discount</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{url('/')}}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/discounts')}}" class="text-muted">Discounts</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Edit Discount</li>
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
                        <h4 class="card-title mb-4">Discount Type</h4>
                        <p class="m-0">Product Sale Price</p>
                        <div class="divider-dash mt-4 mb-4"></div>
                        <h4 class="card-title mb-4">Basic Information</h4>
                        <div class="form-group">
                            <label for="discountName">Discount Name</label>
                            <input type="text" class="form-control" id="discountName" name="discountName" required placeholder="Discount Name">
                        </div>
                        <div class="form-group">
                            <label for="discountDescription">Discount Description</label>
                            <textarea class="form-control" id="discountDescription" name="discountDescription" required placeholder="Discount Description" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Active Period</label>    
                            <div class="align-self-center d-flex align-items-center">
                                <p class="mr-4 mb-0 text-nowrap">Start Datetime</p>
                                <input type="datetime-local" class="form-control w-auto" value="2018-05-13">
                                <p class="ml-4 mr-4 mb-0">-</p>
                                <p class="mr-4 mb-0 text-nowrap">End Datetime</p>
                                <input type="datetime-local" class="form-control w-auto mr-4" value="2018-05-13">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="productSalePriceSection">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Discount Setting</h4>
                        <div class="card-not-selected border-lightgray p-3 br-18 mb-2" id="expandSearchProductSale">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                    <div class="d-flex justify-content-center flex-column">
                                        <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                                        <small class="m-0">Snacks</small>
                                    </div>
                                </div>
                                <p class="m-0">Normal Price: <b>$5</b></p>
                                <i class="fa fa-chevron-down" id="iconExpandSearchProductSale"></i>
                            </div>
                        </div>
                        <div class="w-100 card" id="expandableSearchProductSale" style="z-index: 1000; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; display:none;">
                            <div class="p-3">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="productName" name="productName" required placeholder="Product Name">
                                    <div class="input-group-append">
                                        <button id="searchProductSale" style="border-radius: 0 10px 10px 0 !important;" class="btn btn-outline-secondary border-lightgray">Search</button>
                                    </div>
                                </div>
                                <div class="w-100 pr-3 custom-scroll" id="containerSearchProductResultSalePrice">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label for="salePrice">Sale Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label for="salePrice" style="border-radius: 10px 0 0 10px;" class="input-group-text">$</label>
                                </div>
                                <input type="number" class="form-control" id="salePrice" name="salePrice" placeholder="Sale Price">
                            </div>
                        </div>  
                        <div class="d-flex mt-4 gap-15x">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="{{route('products.index')}}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-none" id="productVoucherSection">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Discount Setting</h4>
                        <div class="form-group mb-4">
                            <label for="productName">Apply Discount by</label>
                            <div class="d-flex gap-15x">
                                <div class="pr-3 pl-3 pt-2 pb-2 voucher-base card-selected" id="productBasedVoucher">
                                    <div class="d-flex gap-15x align-items-center">
                                        <i width="20" height="20" data-feather="archive" class="feather-icon"></i>
                                        <h6 class="m-0">Products</h6>
                                    </div>
                                </div>
                                <div class="pr-3 pl-3 pt-2 pb-2 voucher-base card-not-selected" id="vendorBasedVoucher">
                                    <div class="d-flex gap-15x align-items-center">
                                        <i width="20" height="20" data-feather="smile" class="feather-icon"></i>
                                        <h6 class="m-0">Vendor</h6>
                                    </div>
                                </div>
                                <div class="pr-3 pl-3 pt-2 pb-2 voucher-base card-not-selected" id="categoryBasedVoucher">
                                    <div class="d-flex gap-15x align-items-center">
                                        <i width="20" height="20" data-feather="grid" class="feather-icon"></i>
                                        <h6 class="m-0">Category</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 h-auto" id="containerProductBasedVoucher">
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="allProductVoucher">
                                    <label class="custom-control-label" for="allProductVoucher">Apply Discount for All Products</label>
                                </div>
                            </div>
                            <div class="divider-dash mt-3 mb-3"></div>
                            <div class="w-100" id="chooseProductVoucher">
                                <div class="form-group">
                                    <label for="productName">Search Product for Discount</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="productName" name="productName" required placeholder="Product Name">
                                        <div class="input-group-append">
                                            <button id="searchProductVoucher" style="border-radius: 0 10px 10px 0 !important;" class="btn btn-outline-secondary border-lightgray">Search</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 card" id="containerProductVoucher" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; display:none;">
                                    <div class="p-3">
                                        <div class="w-100 pr-3 custom-scroll" id="containerSearchProductResultVoucher">
                                            
                                        </div>
                                    </div>
                                </div>
                                <label for="productListVoucher" class="pt-3">Discounted Products</label>
                                <div class="container custom-scroll" id="productListVoucher">
                                    
                                </div>
                                <div class="divider-dash mt-3 mb-3"></div>
                            </div>
                        </div>
                        <div class="w-100 h-auto d-none" id="containerVendorBasedVoucher">
                            <div class="card-not-selected border-lightgray p-3 br-18 mb-2" id="expandSearchVendorProductVoucher">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                                        <div class="d-flex justify-content-center flex-column">
                                            <h5 class="m-0"><b>Pollia</b></h5>
                                            <small class="m-0">Location <b>East</b></small>
                                        </div>
                                    </div>
                                    <p class="m-0">Total Product <b>30</b></p>
                                    <i class="fa fa-chevron-down" id="iconExpandSearchVendorProductVoucher"></i>
                                </div>
                            </div>
                            <div class="w-100 card" id="expandableSearchVendorProductVoucher" style="z-index: 1000; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; display:none;">
                                <div class="p-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="vendorName" name="vendorName" required placeholder="Vendor Name">
                                        <div class="input-group-append">
                                            <button id="searchVendorProductVoucher" style="border-radius: 0 10px 10px 0 !important;" class="btn btn-outline-secondary border-lightgray">Search</button>
                                        </div>
                                    </div>
                                    <div class="w-100 pr-3 custom-scroll" id="containerSearchVendorResultProductVoucher">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 h-auto d-none" id="containerCategoryBasedVoucher">
                            <select class="custom-select">
                                <option selected="" value="1">Food</option>
                                <option value="2">Muslim Owned</option>
                                <option value="3">Beverage</option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="salePrice">Discount</label>
                            <div class="input-group">
                                <div class="input-group-prepend w-25">
                                    <select class="custom-select custom-border" id="discountTypeProductVoucher" style="border-radius: 10px 0 0 10px !important;">
                                        <option selected value="1">Fixed</option>
                                        <option value="2">Percentage</option>
                                    </select>
                                </div>
                                <div class="input-group w-75">
                                    <div class="input-group-prepend" id="discountTypeFixedLabelProductVoucher">
                                        <label class="input-group-text" style="border-radius:0;">$</label>
                                    </div>
                                    <input type="number" class="form-control" id="discountProductVoucher" name="discountProductVoucher" style="border-radius: 0 10px 10px 0;" placeholder="Discount">
                                    <div class="input-group-append d-none" id="discountTypePercentageLabelProductVoucher">
                                        <label class="input-group-text" style="border-radius:0 10px 10px 0;">%</label>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="form-check form-check-inline form-group" style="display:none;" id="expandableCheckboxMaxDiscountProductVoucher">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="setMaxDiscountProductVoucher">
                                <label class="custom-control-label" for="setMaxDiscountProductVoucher">Set Maximum Discount Amount</label>
                            </div>
                        </div>
                        <div class="form-group" id="expandableMaxDiscountProductVoucher" style="display:none;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" style="border-radius:10px 0 0 10px;">$</label>
                                </div>
                                <input type="number" class="form-control" id="maxDiscountProductVoucher" name="maxDiscountProductVoucher" required placeholder="Maximum Discount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="minOrderProductVoucher">Minimum Order</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" style="border-radius:10px 0 0 10px;">$</label>
                                </div>
                                <input type="number" class="form-control" id="minOrderProductVoucher" name="minOrderProductVoucher" required placeholder="Minimum Order">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="maxQuotaProductVoucher">Maximum Usage Quota</label>
                            <input type="number" class="form-control" id="maxQuotaProductVoucher" name="maxQuotaProductVoucher" required placeholder="Maximum Usage Quota">
                        </div>
                        <div class="d-flex mt-4 gap-15x">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="{{route('products.index')}}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-none" id="shippingVoucherSection">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Discount Setting</h4>
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
    $(".discount-type").on('click',function(){
        $(".discount-type").removeClass("card-selected");
        $(".discount-type").addClass("card-not-selected");
        $(this).removeClass("card-not-selected");
        $(this).addClass("card-selected");
    });

    var expandSearchProductSale = false;
    $("#expandSearchProductSale").on('click', function(){
        if (expandSearchProductSale == true){
            $("#expandableSearchProductSale").slideUp();
            expandSearchProductSale = false;
            $("#iconExpandSearchProductSale").toggleClass("flip");
        } else { 
            $("#expandableSearchProductSale").slideDown();
            expandSearchProductSale = true;
            $("#iconExpandSearchProductSale").toggleClass("flip");
        }
    }); 

    $("#searchProductSale").on('click', function(){
        $("#containerSearchProductResultSalePrice").html("");
        for(var i=0; i<9; i++){
            $("#containerSearchProductResultSalePrice").append(`
                <div class="d-flex align-items-center justify-content-between product-result-sale-price cursor-pointer">
                    <div class="d-flex align-items-center">
                        <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                        <div class="d-flex justify-content-center flex-column">
                            <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                            <small class="m-0">Snacks</small>
                        </div>
                    </div>
                    <p class="m-0">Normal Price: <b>$5</b></p>
                </div>
                <div class="divider-dash"></div>
            `);
        }
    });

    $(document).on('click', '.product-result-sale-price', function(){
        $("#expandableSearchProductSale").slideUp();
        expandSearchProductSale = false;
        $("#iconExpandSearchProductSale").toggleClass("flip");
    });

    $(document).on('click', ".voucher-base",function(){
        $(".voucher-base").removeClass("card-selected");
        $(".voucher-base").addClass("card-not-selected");
        $(this).removeClass("card-not-selected");
        $(this).addClass("card-selected");
    });

    $("#productSalePrice").on('click', function(){
        $("#productSalePriceSection").removeClass("d-none");
        $("#productVoucherSection").addClass("d-none");
        $("#shippingVoucherSection").addClass("d-none");
    });

    $("#productVoucher").on('click', function(){
        $("#productSalePriceSection").addClass("d-none");
        $("#productVoucherSection").removeClass("d-none");
        $("#shippingVoucherSection").addClass("d-none");
    });

    $("#shippingVoucher").on('click', function(){
        $("#productSalePriceSection").addClass("d-none");
        $("#productVoucherSection").addClass("d-none");
        $("#shippingVoucherSection").removeClass("d-none");
    });

    $("#allProductVoucher").on('change', function(){
        if($("#allProductVoucher").is(":checked")){
            $("#chooseProductVoucher").slideUp();
        } else{
            $("#chooseProductVoucher").slideDown();
        }
    });

    $("#searchProductVoucher").on('click', function(){
        $("#containerProductVoucher").slideDown();
        $("#containerSearchProductResultVoucher").html("");
        for(var i= 0; i < 5; i++){
            $("#containerSearchProductResultVoucher").append(`
                <div class="d-flex align-items-center justify-content-between product-result-voucher cursor-pointer">
                    <div class="d-flex align-items-center">
                        <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                        <div class="d-flex justify-content-center flex-column">
                            <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                            <small class="m-0">Snacks</small>
                        </div>
                    </div>
                    <p class="m-0">Normal Price: <b>$5</b></p>
                </div>
                <div class="divider-dash"></div>
            `);
        }
    });

    $(document).on('click', '.product-result-voucher', function(){
        $("#containerProductVoucher").slideUp();
        $("#productListVoucher").append(`
            <div>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                        <div class="d-flex justify-content-center flex-column">
                            <h5 class="m-0"><b>Cute Tiger Aroma Stone Set”</b></h5>
                            <small class="m-0">Snacks</small>
                        </div>
                    </div>
                    <p class="m-0">Normal Price: <b>$5</b></p>
                    <i class="fa fa-times cursor-pointer delete-product-voucher" width="20" height="20"></i>
                </div>
                <div class="divider-dash"></div>
            <div>
        `);
    });

    $(document).on('click', '.delete-product-voucher', function(){
        $(this).parent().parent().remove();
    });

    $("#productBasedVoucher").on('click', function(){
        $("#containerProductBasedVoucher").removeClass("d-none");
        $("#containerVendorBasedVoucher").addClass("d-none");
        $("#containerCategoryBasedVoucher").addClass("d-none");
    });

    $("#vendorBasedVoucher").on('click', function(){
        $("#containerProductBasedVoucher").addClass("d-none");
        $("#containerVendorBasedVoucher").removeClass("d-none");
        $("#containerCategoryBasedVoucher").addClass("d-none");
    });

    $("#categoryBasedVoucher").on('click', function(){
        $("#containerProductBasedVoucher").addClass("d-none");
        $("#containerVendorBasedVoucher").addClass("d-none");
        $("#containerCategoryBasedVoucher").removeClass("d-none");
    });

    var expandSearchVendorProductVoucher = false;
    $("#expandSearchVendorProductVoucher").on('click', function(){
        if (expandSearchVendorProductVoucher == true){
            $("#expandableSearchVendorProductVoucher").slideUp();
            expandSearchVendorProductVoucher = false;
            $("#iconExpandSearchVendorProductVoucher").toggleClass("flip");
        } else { 
            $("#expandableSearchVendorProductVoucher").slideDown();
            expandSearchVendorProductVoucher = true;
            $("#iconExpandSearchVendorProductVoucher").toggleClass("flip");
        }
    }); 

    $("#searchVendorProductVoucher").on('click', function(){
        $("#containerSearchVendorResultProductVoucher").html("");
        for(var i=0; i<9; i++){
            $("#containerSearchVendorResultProductVoucher").append(`
                <div class="d-flex align-items-center justify-content-between vendor-result-product-voucher cursor-pointer">
                    <div class="d-flex align-items-center">
                        <img class="d-flex br-18 mr-3" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58.jpeg" width="60" alt="Generic placeholder image">
                        <div class="d-flex justify-content-center flex-column">
                            <h5 class="m-0"><b>Pollia</b></h5>
                            <small class="m-0">Location <b>East</b></small>
                        </div>
                    </div>
                    <p class="m-0">Total Product <b>30</b></p>
                </div>
                <div class="divider-dash"></div>
            `);
        }
    });

    $(document).on('click', '.vendor-result-product-voucher', function(){
        $("#expandableSearchVendorProductVoucher").slideUp();
        expandSearchVendorProductVoucher = false;
        $("#iconExpandSearchVendorProductVoucher").toggleClass("flip");
    });

    $("#discountTypeProductVoucher").on('change', function(){
        if($(this).val() == 1){
            $("#discountTypeFixedLabelProductVoucher").removeClass("d-none");
            $("#discountTypePercentageLabelProductVoucher").addClass("d-none");
            $("#discountProductVoucher").css("border-radius", "0 10px 10px 0");
            if ($("#setMaxDiscountProductVoucher").prop("checked") == true){
                $("#setMaxDiscountProductVoucher").prop("checked", false);
                $("#expandableMaxDiscountProductVoucher").slideUp();
            }
        }
        else{
            $("#discountTypeFixedLabelProductVoucher").addClass("d-none");
            $("#discountTypePercentageLabelProductVoucher").removeClass("d-none");
            $("#discountProductVoucher").css("border-radius", "0");
        }
    });

    $("#setMaxDiscountProductVoucher").on('change', function(){
        if($("#setMaxDiscountProductVoucher").is(":checked")){
            $("#expandableMaxDiscountProductVoucher").slideDown();
        } else {
            $("#expandableMaxDiscountProductVoucher").slideUp();
        }
    });

    $("#discountTypeProductVoucher").on('change', function(){
        if ($("#setMaxDiscountProductVoucher").prop("checked") == true){
            $("#setMaxDiscountProductVoucher").prop("checked", false);
            $("#expandableMaxDiscountProductVoucher").slideUp();
        }
        if($(this).val() == 1){
            $("#expandableCheckboxMaxDiscountProductVoucher").slideUp();
        }
        else {
            $("#expandableCheckboxMaxDiscountProductVoucher").slideDown();
        }
    });

</script>
@endsection