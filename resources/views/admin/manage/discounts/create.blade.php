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
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.discount.index') }}"
                                        class="text-muted">Discounts</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Create Discount</li>
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
            <form action="{{ route('admin.discount.store') }}" method="post">
                @csrf
                <input type="hidden" name="discount_type" id="discount-type" value="3">
                <input type="hidden" name="discount_applicable" id="discount-applicable" value="1">
                <input type="hidden" name="voucher_products" id="voucher-products">
                <input type="hidden" name="voucher_vendors" id="voucher-vendors">
                <input type="hidden" name="voucher_categories" id="voucher-categories">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <strong>Error - </strong> {{ $error }}
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Discount Type</h4>
                                <div class="d-flex gap-15x">
                                    <!-- Sale Price -->
                                    <div class="p-3 discount-type card-selected" id="productSalePrice">
                                        <div class="d-flex gap-15x align-items-center">
                                            <i width="20" height="20" data-feather="dollar-sign"
                                                class="feather-icon"></i>
                                            <h6 class="m-0">Product Sale Price</h6>
                                        </div>
                                    </div>
                                    <!-- Product Discount Voucher 50%, $10 etc -->
                                    <div class="p-3 discount-type card-not-selected" id="productVoucher">
                                        <div class="d-flex gap-15x align-items-center">
                                            <i width="20" height="20" data-feather="box" class="feather-icon"></i>
                                            <h6 class="m-0">Product Voucher</h6>
                                        </div>
                                    </div>
                                    <!-- Shipping Discount -->
                                    <div class="p-3 discount-type card-not-selected" id="shippingVoucher">
                                        <div class="d-flex gap-15x align-items-center">
                                            <i width="20" height="20" data-feather="truck" class="feather-icon"></i>
                                            <h6 class="m-0">Shipping Voucher</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider-dash mt-4 mb-4"></div>
                                <h4 class="card-title mb-4">Basic Information</h4>
                                <div class="form-group d-none voucher-input">
                                    <div class="form-check form-check-inline">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="voucher-visible"
                                                name="visible">
                                            <label class="custom-control-label" for="voucher-visible">Voucher Visible to All
                                                User</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group d-none voucher-input">
                                    <label for="discountName">Discount Name</label>
                                    <input type="text" class="form-control" id="discountName" name="name"
                                        placeholder="Discount Name">
                                </div>
                                <div class="form-group d-none voucher-input">
                                    <label for="discountCode">Discount Code</label>
                                    <input type="text" class="form-control" id="discountCode" name="code"
                                        placeholder="Discount Code">
                                </div>
                                <div class="form-group d-none voucher-input">
                                    <label for="discountDescription">Discount Description</label>
                                    <textarea class="form-control" id="discountDescription" name="description" placeholder="Discount Description"
                                        rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Active Period</label>
                                    <div class="align-self-center d-flex align-items-center flex-wrap">
                                        <p class="mr-4 mb-0 text-nowrap">Start Datetime</p>
                                        <input type="datetime-local" class="form-control w-auto" name="duration_start"
                                            required>
                                        <p class="ml-4 mr-4 mb-0">-</p>
                                        <p class="mr-4 mb-0 text-nowrap">End Datetime</p>
                                        <input type="datetime-local" class="form-control w-auto mr-4" name="duration_end"
                                            required>
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
                                <div class="card-not-selected border-lightgray p-3 br-18 mb-2"
                                    id="expandSearchProductSale">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img id="selected-product-sale-image" class="d-flex br-18 mr-3"
                                                src="{{ asset('uploads/' . $product->featured_image) }}" height="60"
                                                width="60" alt="Generic placeholder image">
                                            <div class="d-flex justify-content-center flex-column">
                                                <h5 class="m-0"><b
                                                        id="selected-product-sale-name">{{ $product->name }}</b></h5>
                                                <small class="m-0"
                                                    id="selected-product-sale-category">{{ $product->category->name }}</small>
                                            </div>
                                        </div>
                                        <i class="fa fa-chevron-down" id="iconExpandSearchProductSale"></i>
                                    </div>
                                </div>
                                <div class="w-100 card" id="expandableSearchProductSale"
                                    style="z-index: 1000; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; display:none;">
                                    <div class="p-3">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="productName"
                                                name="productName" placeholder="Product Name">
                                            <div class="input-group-append">
                                                <div id="searchProductSale"
                                                    style="border-radius: 0 10px 10px 0 !important;"
                                                    class="btn btn-outline-secondary border-lightgray">Search</div>
                                            </div>
                                        </div>
                                        <div class="w-100 pr-3 custom-scroll" id="containerSearchProductResultSalePrice">

                                        </div>
                                    </div>
                                </div>

                                <!-- Cuma muncul kalo productnya ada variation -->
                                <div class="form-group mt-4">
                                    <label for="salePriceVariation">Product Variation</label>
                                    <select class="custom-select custom-border" id="salePriceVariation"
                                        name="product_sale" style="border-radius: 10px !important;">
                                        @foreach ($product->variations as $variation)
                                            <option value="{{ $variation->id }}">{{ $variation->name }} -
                                                ${{ $variation->price }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Cuma muncul kalo productnya ada variation -->

                                <div class="form-group mt-4">
                                    <label for="salePrice">Sale Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label for="salePrice" style="border-radius: 10px 0 0 10px;"
                                                class="input-group-text">$</label>
                                        </div>
                                        <input type="number" class="form-control" id="salePrice" name="sale_price"
                                            placeholder="Sale Price">
                                    </div>
                                </div>
                                <div class="d-flex mt-4 gap-15x">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <a href="{{ route('admin.discount.index') }}" class="btn btn-light">Cancel</a>
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
                                        <div class="pr-3 pl-3 pt-2 pb-2 voucher-base card-selected"
                                            id="productBasedVoucher">
                                            <div class="d-flex gap-15x align-items-center">
                                                <i width="20" height="20" data-feather="archive"
                                                    class="feather-icon"></i>
                                                <h6 class="m-0">Products</h6>
                                            </div>
                                        </div>
                                        <div class="pr-3 pl-3 pt-2 pb-2 voucher-base card-not-selected"
                                            id="vendorBasedVoucher">
                                            <div class="d-flex gap-15x align-items-center">
                                                <i width="20" height="20" data-feather="smile"
                                                    class="feather-icon"></i>
                                                <h6 class="m-0">Vendor</h6>
                                            </div>
                                        </div>
                                        <div class="pr-3 pl-3 pt-2 pb-2 voucher-base card-not-selected"
                                            id="categoryBasedVoucher">
                                            <div class="d-flex gap-15x align-items-center">
                                                <i width="20" height="20" data-feather="grid"
                                                    class="feather-icon"></i>
                                                <h6 class="m-0">Category</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 h-auto" id="containerProductBasedVoucher">
                                    <div class="form-check form-check-inline">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="allProductVoucher"
                                                name="all_products">
                                            <label class="custom-control-label" for="allProductVoucher">Apply Discount for
                                                All
                                                Products</label>
                                        </div>
                                    </div>
                                    <div class="divider-dash mt-3 mb-3"></div>
                                    <div class="w-100" id="chooseProductVoucher">
                                        <div class="form-group">
                                            <label for="productName">Search Product for Discount</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="voucherProductName"
                                                    name="productName" placeholder="Product Name">
                                                <div class="input-group-append">
                                                    <div id="searchProductVoucher"
                                                        style="border-radius: 0 10px 10px 0 !important;"
                                                        class="btn btn-outline-secondary border-lightgray">Search</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-100 card" id="containerProductVoucher"
                                            style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; display:none;">
                                            <div class="p-3">
                                                <div class="w-100 pr-3 custom-scroll"
                                                    id="containerSearchProductResultVoucher">

                                                </div>
                                            </div>
                                        </div>
                                        <label for="productListVoucher" class="pt-3">Discounted Products</label>
                                        <div class="pr-3 custom-scroll" id="productListVoucher">

                                        </div>
                                        <div class="divider-dash mt-3 mb-3"></div>
                                    </div>
                                </div>
                                <div class="w-100 h-auto d-none" id="containerVendorBasedVoucher">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="voucherVendorName"
                                            name="vendorName" placeholder="Vendor Name">
                                        <div class="input-group-append">
                                            <div id="searchVendorProductVoucher"
                                                style="border-radius: 0 10px 10px 0 !important;"
                                                class="btn btn-outline-secondary border-lightgray">Search</div>
                                        </div>
                                    </div>
                                    <div class="w-100 card" id="expandableSearchVendorProductVoucher"
                                        style="z-index: 1000; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; display:none;">
                                        <div class="p-3">
                                            <div class="w-100 pr-3 custom-scroll"
                                                id="containerSearchVendorResultProductVoucher">

                                            </div>
                                        </div>
                                    </div>
                                    <label for="vendorListVoucher" class="pt-3">Discounted Vendors</label>
                                    <div class="pr-3 custom-scroll" id="vendorListVoucher">

                                    </div>
                                    <div class="divider-dash mt-3 mb-3"></div>
                                </div>
                                <div class="w-100 h-auto d-none" id="containerCategoryBasedVoucher">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="voucherCategoryName"
                                            name="categoryName" placeholder="Category Name">
                                        <div class="input-group-append">
                                            <div id="searchCategoryProductVoucher"
                                                style="border-radius: 0 10px 10px 0 !important;"
                                                class="btn btn-outline-secondary border-lightgray">Search</div>
                                        </div>
                                    </div>
                                    <div class="w-100 card" id="expandableSearchCategoryProductVoucher"
                                        style="z-index: 1000; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; display:none;">
                                        <div class="p-3">
                                            <div class="w-100 pr-3 custom-scroll"
                                                id="containerSearchCategoryResultProductVoucher">

                                            </div>
                                        </div>
                                    </div>
                                    <label for="categoryListVoucher" class="pt-3">Discounted Categories</label>
                                    <div class="pr-3 custom-scroll" id="categoryListVoucher">

                                    </div>
                                    <div class="divider-dash mt-3 mb-3"></div>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="salePrice">Discount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend w-25">
                                            <select class="custom-select custom-border" id="discountTypeProductVoucher"
                                                name="voucher_type" style="border-radius: 10px 0 0 10px !important;">
                                                <option selected value="1">Fixed</option>
                                                <option value="2">Percentage</option>
                                            </select>
                                        </div>
                                        <div class="input-group w-75">
                                            <div class="input-group-prepend" id="discountTypeFixedLabelProductVoucher">
                                                <label class="input-group-text" style="border-radius:0;">$</label>
                                            </div>
                                            <input type="number" class="form-control" id="discountProductVoucher"
                                                name="voucher_value" style="border-radius: 0 10px 10px 0;"
                                                placeholder="Discount">
                                            <div class="input-group-append d-none"
                                                id="discountTypePercentageLabelProductVoucher">
                                                <label class="input-group-text"
                                                    style="border-radius:0 10px 10px 0;">%</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline form-group" style="display:none;"
                                    id="expandableCheckboxMaxDiscountProductVoucher">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="max_discount_bool"
                                            id="setMaxDiscountProductVoucher">
                                        <label class="custom-control-label" for="setMaxDiscountProductVoucher">Set Maximum
                                            Discount Amount</label>
                                    </div>
                                </div>
                                <div class="form-group" id="expandableMaxDiscountProductVoucher" style="display:none;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" style="border-radius:10px 0 0 10px;">$</label>
                                        </div>
                                        <input type="number" class="form-control" id="maxDiscountProductVoucher"
                                            name="max_discount" placeholder="Maximum Discount">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="minOrderProductVoucher">Minimum Order</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" style="border-radius:10px 0 0 10px;">$</label>
                                        </div>
                                        <input type="number" class="form-control" id="minOrderProductVoucher"
                                            name="min_order" placeholder="Minimum Order" min="0" value="0">
                                    </div>
                                </div>
                                <div class="form-check form-check-inline form-group"
                                    id="expandableCheckboxMaxQuotaProductVoucher">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="max_quota_bool"
                                            id="setMaxQuotaProductVoucher">
                                        <label class="custom-control-label" for="setMaxQuotaProductVoucher">Set Maximum
                                            Usage
                                            Quota</label>
                                    </div>
                                </div>
                                <div class="form-group" id="expandableMaxQuotaProductVoucher" style="display:none;">
                                    <label for="maxQuotaProductVoucher">Maximum Usage Quota</label>
                                    <input type="number" class="form-control" id="maxQuotaProductVoucher"
                                        name="max_quota" placeholder="Maximum Usage Quota">
                                </div>
                                <div class="d-flex mt-4 gap-15x">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <a href="{{ route('admin.discount.index') }}" class="btn btn-light">Cancel</a>
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
                                <div class="form-group mt-4">
                                    <label for="discountShippingVoucher">Shipping Discount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" style="border-radius:10px 0 0 10px;">$</label>
                                        </div>
                                        <input type="number" class="form-control" id="discountShippingVoucher"
                                            name="amount_shipping" name="discountShippingVoucher"
                                            style="border-radius: 0 10px 10px 0;" placeholder="Discount">
                                    </div>
                                </div>
                                <div class="d-flex mt-4 gap-15x">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <a href="{{ route('admin.discount.index') }}" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
        $(".discount-type").on('click', function() {
            $(".discount-type").removeClass("card-selected");
            $(".discount-type").addClass("card-not-selected");
            $(this).removeClass("card-not-selected");
            $(this).addClass("card-selected");
        });

        var expandSearchProductSale = false;
        $("#expandSearchProductSale").on('click', function() {
            if (expandSearchProductSale == true) {
                $("#expandableSearchProductSale").slideUp();
                expandSearchProductSale = false;
                $("#iconExpandSearchProductSale").toggleClass("flip");
            } else {
                $("#expandableSearchProductSale").slideDown();
                expandSearchProductSale = true;
                $("#iconExpandSearchProductSale").toggleClass("flip");
            }
        });

        $("#searchProductSale").on('click', function() {
            $("#containerSearchProductResultSalePrice").html("");
            var hostname = "{{ request()->getHost() }}"
            var url = ""
            if (hostname.includes('www')) {
                url = "https://" + hostname
            } else {
                url = "{{ config('app.url') }}"
            }
            $.post(url + "/admin/discount/search", {
                    _token: CSRF_TOKEN,
                    search: $('#productName').val(),
                })
                .done(function(data) {
                    $("#containerSearchProductResultSalePrice").html(data);
                })
                .fail(function(error) {
                    console.log(error);
                });
        });

        function selectProduct(id, image, name, category) {
            $("#expandableSearchProductSale").slideUp();
            expandSearchProductSale = false;
            $("#iconExpandSearchProductSale").toggleClass("flip");
            $('#selected-product-sale-image').attr("src", image);
            $('#selected-product-sale-name').html(name);
            $('#selected-product-sale-category').html(category);
            //get variations
            $("#salePriceVariation").html("");
            var hostname = "{{ request()->getHost() }}"
            var url = ""
            if (hostname.includes('www')) {
                url = "https://" + hostname
            } else {
                url = "{{ config('app.url') }}"
            }
            $.post(url + "/admin/discount/get_variations", {
                    _token: CSRF_TOKEN,
                    id: id,
                })
                .done(function(data) {
                    data.forEach(element => {
                        $("#salePriceVariation").append(
                            `<option value="${element.id}">${element.name} -
                                            $${element.price}</option>`);
                    });
                })
                .fail(function(error) {
                    console.log(error);
                });
        }

        $(document).on('click', ".voucher-base", function() {
            $(".voucher-base").removeClass("card-selected");
            $(".voucher-base").addClass("card-not-selected");
            $(this).removeClass("card-not-selected");
            $(this).addClass("card-selected");
        });

        $("#productSalePrice").on('click', function() {
            $('#discount-type').val(3);
            $(".voucher-input").addClass("d-none");
            $("#productSalePriceSection").removeClass("d-none");
            $("#productVoucherSection").addClass("d-none");
            $("#shippingVoucherSection").addClass("d-none");
        });

        $("#productVoucher").on('click', function() {
            $('#discount-type').val(2);
            $(".voucher-input").removeClass("d-none");
            $("#productSalePriceSection").addClass("d-none");
            $("#productVoucherSection").removeClass("d-none");
            $("#shippingVoucherSection").addClass("d-none");
        });

        $("#shippingVoucher").on('click', function() {
            $('#discount-type').val(1);
            $(".voucher-input").removeClass("d-none");
            $("#productSalePriceSection").addClass("d-none");
            $("#productVoucherSection").addClass("d-none");
            $("#shippingVoucherSection").removeClass("d-none");
        });

        $("#allProductVoucher").on('change', function() {
            if ($("#allProductVoucher").is(":checked")) {
                $("#chooseProductVoucher").slideUp();
            } else {
                $("#chooseProductVoucher").slideDown();
            }
        });

        $("#searchProductVoucher").on('click', function() {
            $("#containerProductVoucher").slideDown();
            $("#containerSearchProductResultVoucher").html("");
            var hostname = "{{ request()->getHost() }}"
            var url = ""
            if (hostname.includes('www')) {
                url = "https://" + hostname
            } else {
                url = "{{ config('app.url') }}"
            }
            $.post(url + "/admin/discount/search_voucher_product", {
                    _token: CSRF_TOKEN,
                    search: $('#voucherProductName').val(),
                })
                .done(function(data) {
                    $("#containerSearchProductResultVoucher").html(data);
                })
                .fail(function(error) {
                    console.log(error);
                });
        });

        var voucher_products = [];

        function selectVoucherProduct(id, image, name, category) {
            $("#containerProductVoucher").slideUp();
            voucher_products.push(id)
            $('#voucher-products').val(voucher_products)
            $("#productListVoucher").append(`
            <div data-id="${id}">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img class="d-flex br-18 mr-3" src="${image}" height="60" width="60" alt="Generic placeholder image">
                        <div class="d-flex justify-content-center flex-column">
                            <h5 class="m-0"><b>${name}</b></h5>
                            <small class="m-0">${category}</small>
                        </div>
                    </div>
                    <i class="fa fa-times cursor-pointer delete-product-voucher" width="20" height="20"></i>
                </div>
                <div class="divider-dash"></div>
        `);
        };

        $(document).on('click', '.delete-product-voucher', function() {
            var index = voucher_products.indexOf($(this).parent().parent().data("id"));
            if (index > -1) { // only splice array when item is found
                voucher_products.splice(index, 1); // 2nd parameter means remove one item only
            }
            $('#voucher-products').val(voucher_products)
            $(this).parent().parent().remove();
        });

        $("#productBasedVoucher").on('click', function() {
            $("#discount-applicable").val(1);
            $("#containerProductBasedVoucher").removeClass("d-none");
            $("#containerVendorBasedVoucher").addClass("d-none");
            $("#containerCategoryBasedVoucher").addClass("d-none");
        });

        $("#vendorBasedVoucher").on('click', function() {
            $("#discount-applicable").val(2);
            $("#containerProductBasedVoucher").addClass("d-none");
            $("#containerVendorBasedVoucher").removeClass("d-none");
            $("#containerCategoryBasedVoucher").addClass("d-none");
        });

        $("#categoryBasedVoucher").on('click', function() {
            $("#discount-applicable").val(3);
            $("#containerProductBasedVoucher").addClass("d-none");
            $("#containerVendorBasedVoucher").addClass("d-none");
            $("#containerCategoryBasedVoucher").removeClass("d-none");
        });

        $("#searchVendorProductVoucher").on('click', function() {
            $("#expandableSearchVendorProductVoucher").slideDown();
            $("#containerSearchVendorResultProductVoucher").html("");
            var hostname = "{{ request()->getHost() }}"
            var url = ""
            if (hostname.includes('www')) {
                url = "https://" + hostname
            } else {
                url = "{{ config('app.url') }}"
            }
            $.post(url + "/admin/discount/search_voucher_vendor", {
                    _token: CSRF_TOKEN,
                    search: $('#voucherVendorName').val(),
                })
                .done(function(data) {
                    $("#containerSearchVendorResultProductVoucher").html(data);
                })
                .fail(function(error) {
                    console.log(error);
                });
        });

        var voucher_vendors = [];

        function selectVoucherVendor(id, image, name, location, products) {
            $("#expandableSearchVendorProductVoucher").slideUp();
            voucher_vendors.push(id)
            $('#voucher-vendors').val(voucher_vendors)
            $("#vendorListVoucher").append(`
            <div data-id="${id}">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img class="d-flex br-18 mr-3" src="${image}" height="60" width="60" alt="Generic placeholder image">
                        <div class="d-flex justify-content-center flex-column">
                            <h5 class="m-0"><b>${name}</b></h5>
                            <small class="m-0">Location: <b>${location}</b></small>
                        </div>
                    </div>
                    <p class="m-0">Total Product: <b>${products}</b></p>
                    <i class="fa fa-times cursor-pointer delete-vendor-voucher" width="20" height="20"></i>
                </div>
                <div class="divider-dash"></div>
            <div>
        `);
        }


        $(document).on('click', '.delete-vendor-voucher', function() {
            var index = voucher_vendors.indexOf($(this).parent().parent().data("id"));
            if (index > -1) { // only splice array when item is found
                voucher_vendors.splice(index, 1); // 2nd parameter means remove one item only
            }
            $('#voucher-vendors').val(voucher_vendors)
            $(this).parent().parent().remove();
        });

        $("#searchCategoryProductVoucher").on('click', function() {
            $("#expandableSearchCategoryProductVoucher").slideDown();
            $("#containerSearchCategoryResultProductVoucher").html("");
            var hostname = "{{ request()->getHost() }}"
            var url = ""
            if (hostname.includes('www')) {
                url = "https://" + hostname
            } else {
                url = "{{ config('app.url') }}"
            }
            $.post(url + "/admin/discount/search_voucher_category", {
                    _token: CSRF_TOKEN,
                    search: $('#voucherCategoryName').val(),
                })
                .done(function(data) {
                    $("#containerSearchCategoryResultProductVoucher").html(data);
                })
                .fail(function(error) {
                    console.log(error);
                });
        });

        var voucher_categories = [];

        function selectVoucherCategory(id, image, name, products) {
            $("#expandableSearchCategoryProductVoucher").slideUp();
            voucher_categories.push(id)
            $('#voucher-categories').val(voucher_categories)
            $("#categoryListVoucher").append(`
            <div data-id="${id}">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img class="d-flex br-18 mr-3" src="${image}" height="60" width="60" alt="Generic placeholder image">
                        <div class="d-flex justify-content-center flex-column">
                            <h5 class="m-0"><b>${name}</b></h5>
                        </div>
                    </div>
                    <p class="m-0">Total Product: <b>${products}</b></p>
                    <i class="fa fa-times cursor-pointer delete-category-voucher" width="20" height="20"></i>
                </div>
                <div class="divider-dash"></div>
            <div>
        `);
        };

        $(document).on('click', '.delete-category-voucher', function() {
            var index = voucher_categories.indexOf($(this).parent().parent().data("id"));
            if (index > -1) { // only splice array when item is found
                voucher_categories.splice(index, 1); // 2nd parameter means remove one item only
            }
            $('#voucher-vendors').val(voucher_categories)
            $(this).parent().parent().remove();
        });

        $("#discountTypeProductVoucher").on('change', function() {
            if ($(this).val() == 1) {
                $("#discountTypeFixedLabelProductVoucher").removeClass("d-none");
                $("#discountTypePercentageLabelProductVoucher").addClass("d-none");
                $("#discountProductVoucher").css("border-radius", "0 10px 10px 0");
                if ($("#setMaxDiscountProductVoucher").prop("checked") == true) {
                    $("#setMaxDiscountProductVoucher").prop("checked", false);
                    $("#expandableMaxDiscountProductVoucher").slideUp();
                }
            } else {
                $("#discountTypeFixedLabelProductVoucher").addClass("d-none");
                $("#discountTypePercentageLabelProductVoucher").removeClass("d-none");
                $("#discountProductVoucher").css("border-radius", "0");
            }
        });

        $("#setMaxDiscountProductVoucher").on('change', function() {
            if ($("#setMaxDiscountProductVoucher").is(":checked")) {
                $("#expandableMaxDiscountProductVoucher").slideDown();
            } else {
                $("#expandableMaxDiscountProductVoucher").slideUp();
            }
        });

        $("#setMaxQuotaProductVoucher").on('change', function() {
            if ($("#setMaxQuotaProductVoucher").is(":checked")) {
                $("#expandableMaxQuotaProductVoucher").slideDown();
            } else {
                $("#expandableMaxQuotaProductVoucher").slideUp();
            }
        });

        $("#discountTypeProductVoucher").on('change', function() {
            if ($("#setMaxDiscountProductVoucher").prop("checked") == true) {
                $("#setMaxDiscountProductVoucher").prop("checked", false);
                $("#expandableMaxDiscountProductVoucher").slideUp();
            }
            if ($("#setMaxQuotaProductVoucher").prop("checked") == true) {
                $("#setMaxQuotaProductVoucher").prop("checked", false);
                $("#expandableMaxQuotaProductVoucher").slideUp();
            }
            if ($(this).val() == 1) $("#expandableCheckboxMaxDiscountProductVoucher").slideUp();
            else $("#expandableCheckboxMaxDiscountProductVoucher").slideDown();
        });
    </script>
@endsection
