@extends('user.template.layout')

@section('page-title')
    Product Name - Big V
@endsection

@section('head-extra')
    <link href="{{ asset('assets/css/style-product-list.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content" style="width: 100vw; min-width: 0 !important; max-width: 1200px; margin:auto;">
        <div class="flex flex-vertical row-gap margin-large" style="width: 85%; min-width: 980px; position:relative;">
            <div class="text-align-center orange-text">Showing search result for</div>
            <h3 class="text-align-center">Search Result Name</h3>
            {{-- <div class="sort-right w-dropdown"> --}}
            <div class="sort-right">
                <div class="text-rich-text text-size-small text-color-grey" style="margin-right: 20px;">Sort By</div>
                <select class="sort" style="padding: 5px 15px; border-radius: 18px;">
                    <option value="items_sold"
                        @if (isset($sort_by)) @if ($sort_by == 'items_sold') selected @endif @endif>Items Sold</option>
                    <option value="highest_price"
                        @if (isset($sort_by)) @if ($sort_by == 'highest_price') selected @endif @endif>Highest Price</option>
                    <option value="lowest_price"
                        @if (isset($sort_by)) @if ($sort_by == 'lowest_price') selected @endif @endif>Lowest Price</option>
                </select>
                {{-- <div class="text-color-light-grey w-dropdown-toggle">
                    <div class="w-icon-dropdown-toggle"></div>
                    <div class="text-size-medium">Sort</div>
                </div>
                <nav class="sort dropdown-list w-dropdown-list">
                    <a href="#" value="3" class="text-color-grey w-dropdown-link">Items Sold</a>
                    <a href="#" value="1" class="text-color-grey w-dropdown-link">Highest
                        Price</a>
                    <a href="#" value="2" class="text-color-grey w-dropdown-link">Lowest Price</a>
                </nav> --}}
            </div>
        </div>

        @if (isset($category))
            {{-- {{ print_r($category) }} --}}
            @if ($category != '')
                @php($checkedCategories = explode(',', $category))
            @endif
        @endif

        <div>
            <div class="flex flex-center top-align relative archive-flex"
                style="width: 100vw; min-width: 0 !important; max-width: 1200px; margin:auto;">
                <div class="filter card27 padding-small text-color-grey sticky-filter" style="padding: 2rem;">
                    <h4>Categories</h4>
                    <div class="w-form">
                        <form id="formFilter1" name="email-form-2" data-name="Email Form 2" method="GET"
                            class="form-2 w-clearfix" action="{{ url('product/filter') }}">
                            @foreach ($productCategories as $productCategory)
                                <label class="w-checkbox">
                                    @if (isset($checkedCategories))
                                        @php($checking = false)
                                        @foreach ($checkedCategories as $checked)
                                            @if ($checked == $productCategory->id)
                                                <div
                                                    class="w-checkbox-input w-checkbox-input--inputType-custom checkbox w--redirected-checked">
                                                </div>
                                                @php($checking = true)
                                            @endif
                                        @endforeach

                                        @if ($checking == false)
                                            <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                        @endif
                                    @else
                                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox"></div>
                                    @endif
                                    <input type="checkbox" id="checkbox-{{ $productCategory->id + 1 }}"
                                        class="checkbox-category" style="opacity:0;position:absolute;z-index:-1"
                                        value="{{ $productCategory->id }}" /><span class="text-size-small w-form-label"
                                        for="checkbox-{{ $productCategory->id + 1 }}">{{ $productCategory->name }}</span>
                                </label>
                            @endforeach
                            <label for="email">Price</label>
                            <div class="flex justify-left" style="gap: 5px;">
                                <div class="relative">
                                    <input type="number" class="min-price quantity-pill-small price-range-filter"
                                        min="0"
                                        @if (isset($min_price)) value="{{ $min_price != 0 ? $min_price : '' }}" @endif>
                                    <p class="float-price">$</p>
                                </div>
                                <p class="margin-0">-</p>
                                <div class="relative">
                                    <input type="number" class="max-price quantity-pill-small price-range-filter"
                                        min="0"
                                        @if (isset($max_price)) value="{{ $max_price != 0 ? $max_price : '' }}" @endif>
                                    <p class="float-price">$</p>
                                </div>
                            </div>
                            <button type="submit" class="btn-filter submit-button atc-button margin-top w-button"
                                style="margin-top: 20px;">Filter</button>
                        </form>
                    </div>
                </div>
                <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease"
                    data-easing2="ease" role="banner" class="navbar-4 w-nav">
                    <div class="container-3 w-container">
                        <nav role="navigation" class="nav-menu-3 w-nav-menu">
                            <div class="filter card27 padding-small text-color-grey filter-hamburger">
                                <h3>Categories</h3>
                                <div class="w-form">
                                    <form id="formFilter2" name="email-form-2" data-name="Email Form 2" method="GET"
                                        class="form-2 w-clearfix" action="{{ url('product/filter') }}">
                                        @foreach ($productCategories as $productCategory)
                                            <label class="w-checkbox">
                                                @if (isset($checkedCategories))
                                                    @php($checking = false)
                                                    @foreach ($checkedCategories as $checked)
                                                        @if ($checked == $productCategory->id)
                                                            <div
                                                                class="w-checkbox-input w-checkbox-input--inputType-custom checkbox w--redirected-checked">
                                                            </div>
                                                            @php($checking = true)
                                                        @endif
                                                    @endforeach

                                                    @if ($checking == false)
                                                        <div
                                                            class="w-checkbox-input w-checkbox-input--inputType-custom checkbox">
                                                        </div>
                                                    @endif
                                                @else
                                                    <div
                                                        class="w-checkbox-input w-checkbox-input--inputType-custom checkbox">
                                                    </div>
                                                @endif
                                                <input type="checkbox" id="checkbox-{{ $productCategory->id + 1 }}"
                                                    class="checkbox-category" style="opacity:0;position:absolute;z-index:-1"
                                                    value="{{ $productCategory->id }}" /><span
                                                    class="text-size-small w-form-label"
                                                    for="checkbox-{{ $productCategory->id + 1 }}">{{ $productCategory->name }}</span>
                                            </label>
                                        @endforeach
                                        <label for="email">Price</label>
                                        <div class="flex justify-left" style="gap: 5px;">
                                            <input type="number" class="min-price quantity-pill-small price-range-filter"
                                                min="0"
                                                @if (isset($min_price)) value="{{ $min_price != 0 ? $min_price : '' }}" @endif>
                                            <p class="margin-0">-</p>
                                            <input type="number" class="max-price quantity-pill-small price-range-filter"
                                                min="0"
                                                @if (isset($max_price)) value="{{ $max_price != 0 ? $max_price : '' }}" @endif>
                                        </div>
                                        <button type="button"
                                            class="btn-filter submit-button atc-button margin-top w-button"
                                            style="margin-top: 20px;">Filter</button>
                                    </form>
                                </div>
                            </div>
                        </nav>
                        <div class="menu-button-2 w-nav-button">
                            <div class="text-color-light-grey text-size-medium">Filter</div>
                        </div>
                        <div data-hover="false" data-delay="0" class="w-dropdown">
                            <div class="text-color-light-grey w-dropdown-toggle">
                                <div class="w-icon-dropdown-toggle"></div>
                                <div class="text-size-medium">Sort</div>
                            </div>
                            <nav class="mini-sort dropdown-list w-dropdown-list">
                                <a href="#" value="items_sold" class="text-color-grey w-dropdown-link">Items
                                    Sold</a>
                                <a href="#" value="highest_price" class="text-color-grey w-dropdown-link">Highest
                                    Price</a>
                                <a href="#" value="lowest_price" class="text-color-grey w-dropdown-link">Lowest
                                    Price</a>
                            </nav>
                        </div>
                    </div>
                </div>
                
                @include('user.product.products')
            </div>
        </div>
    </div>
    <div class="cursor">
        <div data-w-id="f4b78bbc-ea93-bb5a-a490-cac406bb401d" class="dot"></div>
    </div>
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/js/script-product-list.js') }}" type="text/javascript"></script>
    <script>
        $(".sort").on("change", function() {
            if ($("input[type=hidden][name=sort_by]").length <= 0) {
                $("<input>").attr({
                    type: "hidden",
                    name: "sort_by",
                    value: $(this).val()
                }).appendTo("#formFilter1");
            } else {
                $("#formFilter1 input[type=hidden][name=sort_by]").val($(this).val());
            }

            $(".btn-filter").click();
        });

        $(".mini-sort a").on("click", function() {
            if ($("input[type=hidden][name=sort_by]").length <= 0) {
                $("<input>").attr({
                    type: "hidden",
                    name: "sort_by",
                    value: $(this).attr("value")
                }).appendTo("#formFilter2");
            } else {
                $("#formFilter2 input[type=hidden][name=sort_by]").val($(this).attr("value"));
            }

            $(".btn-filter").click();
        });

        $(".btn-filter").on("click", function(e) {
            var form = "#" + $(this).parents("form").attr("id");
            var param = $(location).attr("search");

            if (param != '') {
                param = param.substring(1, param.length).split("&");
                param.forEach(function(item) {
                    var items = item.split("=");
                    if ($("input[type=hidden][name=" + items[0] + "]").length <= 0) {
                        $("<input>").attr({
                            type: "hidden",
                            name: items[0],
                            value: items[1]
                        }).appendTo(form);
                    }
                });
            }

            checkedCategory = '';
            $(form + " .checkbox-category").each(function() {
                if ($(this).prev().is(".w--redirected-checked")) {
                    checkedCategory += $(this).val() + ",";
                }
            });

            if ($(form + " input[type=hidden][name=category]").length <= 0) {
                $("<input>").attr({
                    type: "hidden",
                    name: "category",
                    value: (checkedCategory != '') ? checkedCategory.slice(0, -1) : ""
                }).appendTo(form);
            } else {
                $(form + " input[type=hidden][name=category]").val((checkedCategory != '') ? checkedCategory.slice(0, -1) : "");
            }

            if ($(form + " input[type=hidden][name=min_price]").length <= 0) {
                if ($(form + " .min-price").val() != '') {
                    $("<input>").attr({
                        type: "hidden",
                        name: "min_price",
                        value: $(form + " .min-price").val()
                    }).appendTo(form);
                }
            } else {
                $(form + " input[type=hidden][name=min_price]").val($(form + " .min-price").val());
            }

            if ($(form + " input[type=hidden][name=max_price]").length <= 0) {
                if ($(form + " .max-price").val() != '') {
                    $("<input>").attr({
                        type: "hidden",
                        name: "max_price",
                        value: $(form + " .max-price").val()
                    }).appendTo(form);
                }
            } else {
                $(form + " input[type=hidden][name=max_price]").val($(form + " .max-price").val());
            }
        });
    </script>
@endsection
