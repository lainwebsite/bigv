@extends('user.template.layout')

@section('page-title')
    Cart - BigV
@endsection

@section('meta-title')
    Cart - BigV
@endsection

@section('meta-description')
    Take a look at your cart.
@endsection

@section('meta-image')
    {{asset('assets/62ffbe41b946fc3a2b7b6747_Big%20V(NoTag)-ColorB%202.png')}}
@endsection

@section('head-extra')
    <link href="{{ asset('assets/css/style-cart-checkout.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content">
        @csrf
        <div class="max-width flex vertical">
            <h2 class="text-color-grey ea-top">Your Cart</h2>
            <div class="cart-wrapper" style="gap: 15px;">
                <div class="vendors-column">
                    @foreach ($carts as $cart)
                        @if (count($cart->products) > 0)
                            <div class="vendors-card ea-left">
                                <div class="flex gap-medium"><img
                                        src="{{asset('uploads/'.$cart->vendor->photo)}}" loading="lazy"
                                        alt="" class="image-17" />
                                    <div>
                                        <h5><a href={{ url('/vendors/'.$cart->vendor->slug) }} class="text-style-none text-color-dark-grey">{{ $cart->vendor->name }}</a></h5>
                                        <div class="text-size-small text-color-grey">Location: {{ $cart->vendor->location->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="div-line"></div>
                                @foreach ($cart->products as $product)
                                    <div class="vendor-item" vendor-id="{{ $cart->vendor->id }}">
                                        <div class="flex gap-medium">
                                            <input type="checkbox" class="product-cart" value="{{ $product->cart_id }}">
                                            <img src="{{ asset('uploads/'.$product->featured_image) }}" loading="lazy" alt=""
                                                class="image-18" />
                                            <div>
                                                <h5><a href={{ url('/product/'.$product->product_id) }} class="text-style-none text-color-dark-grey">{{ $product->product_name }}</a></h5>
                                                @if ($product->product_variation_name != 'novariation')
                                                    <div class="text-size-small text-color-grey">Variant:
                                                        {{ $product->product_variation_name }}</div>
                                                @endif
                                                @if (count($product->addons) > 0)
                                                    <div class="text-size-small text-color-grey">Addons:
                                                        {{ implode(", ", $product->addons) }}</div>
                                                @endif
                                                <div class="text-size-small text-color-grey">
                                                    @php ($now = \Carbon\Carbon::now())
                                                    @if ($product->discount > 0 && 
                                                         $now->format("Y-m-d H:i:s") >= $product->discount_start_date &&
                                                         $now->format("Y-m-d H:i:s") < $product->discount_end_date)
                                                        <span style="text-decoration: line-through;">${{ number_format($product->product_price, 2, ".", ",") }}</span>
                                                        <span>${{ number_format($product->cart_price, 2, ".", ",") }}</span>
                                                    @else
                                                        <span>${{ number_format($product->cart_price, 2, ".", ",") }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex gap-small">
                                            <div class="quantity-pill-small">
                                                <div class="cursor-pointer quantity-change" logic="sub">-</div>
                                                <input type="number" class="product-quantity"
                                                    value="{{ $product->quantity }}" min="1">
                                                <div class="cursor-pointer quantity-change" logic="add">+</div>
                                            </div>
                                            <button type="button" class="btn-delete-product flex"
                                                style="background: none;">
                                                <img src="{{ asset('assets/630b4bc5cd03300cd594cf9c_Vector (3).svg') }}"
                                                    loading="lazy" alt="" class="image-20" />
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="sticky-summary">
                    <div class="cart-summary ea-right">
                        <h4>Summary</h4>
                        <div class="container-summary-item">
                            <div class="summary-item div-block-24">
                                <div class="inline">-</div>
                            </div>
                        </div>
                        <div class="div-line"></div>
                        <div class="div-block-24">
                            <div class="inline text-weight-bold">Total</div>
                            <div class="inline text-weight-bold">$<span id="grandTotalPrice">0</span></div>
                        </div>
                        <form method="POST" action="{{ url('user/cart/verify-checkout') }}">
                            @csrf

                            <input id="cart-items" type="hidden" name="carts">
                            <button id="btnProceed" type="submit" class="checkout-button oh-grow w-button" disabled
                                style="width: 100%;">Proceed to Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><img src="{{ asset('assets/6303b67a5064f05035c5a701_shape 1.svg') }}" loading="lazy" alt=""
            class="absolute shape-cart" />
        <div class="new-products-section padding-xxlarge ea-fade">
            <div class="heading-large text-align-center margin-bottom margin-large">Suggested Products</div>
            <div class="products-archive-grid margin-auto">
                @php(date_default_timezone_set('Asia/Singapore'))
                @php($dateNow = new DateTime(date("Y-m-d H:i:s")))
                @foreach ($productSuggestion as $product)
                    <a href="{{ route('product.show', $product->id) }}" class="text-style-none">
                        <div id="w-node-_98aa59c7-5c20-8fcb-852c-972bad093e75-fac73a6c" class="product-card padding-small">
                            <div class="text-rich-text text-size-small text-color-grey">{{ $product->vendor->name }}</div><img
                                src="{{ asset('uploads/'.$product->featured_image) }}" loading="lazy" alt="" class="product-image" />
                            <div class="product-card-stars">
                                @php($arr_rating = explode('.', $product->rating))
                                @php($first_num = $arr_rating[0])
                                @while ($first_num > 0)
                                    <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy" alt="" class="card-stars" />
                                    @php($first_num--)
                                @endwhile
            
                                @if (isset($arr_rating[1]))
                                    <img src="{{ asset('assets/Star 2.svg') }}" loading="lazy" alt="" class="card-stars" />
                                @endif
            
                                @php($remaining_rating = explode('.', 5 - $product->rating)[0])
                                @if ($remaining_rating > 0)
                                    @while ($remaining_rating > 0)
                                        <img src="{{ asset('assets/Star 3.svg') }}" loading="lazy" alt="" class="card-stars" />
                                        @php($remaining_rating--)
                                    @endwhile
                                @endif
                            </div>
                            <div
                                class="product-card-title text-rich-text text-size-regular text-weight-bold text-color-dark-grey text-center text-truncate">
                                {{ $product->name }}
                            </div>
                            <div class="product-card-low-div">
                                @if (count($product->variations) <= 1)
                                    @if ($product->variations[0]->discount != 0)
                                        @php($startDate = new DateTime($product->variations[0]->discount_start_date))
                                        @php($endDate = new DateTime($product->variations[0]->discount_end_date))
                                        
                                        @if ($startDate <= $dateNow && $dateNow <= $endDate)
                                            <div class="card-discount">
                                                <!--<div class="discount">-${{ $product->variations[0]->discount }}</div>-->
                                                <div class="discount">Sale</div>
                                            </div>
                                            <div id="w-node-_98aa59c7-5c20-8fcb-852c-972bad093e85-fac73a6c"
                                                class="sale-price text-color-light-grey" style="padding: 0.25em;">
                                                ${{ number_format($product->variations[0]->price, 2, ".", ",") }}</div>
                                            <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em;">
                                                ${{ number_format($product->variations[0]->discount, 2, ".", ",") }}</div>
                                        @else
                                            <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em;">
                                                ${{ number_format($product->variations[0]->price, 2, ".", ",") }}</div>
                                        @endif
                                    @else
                                        <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em;">
                                            ${{ number_format($product->variations[0]->price, 2, ".", ",") }}</div>
                                    @endif
                                @else
                                    @php($salePriceAvailable = false)
                                    @foreach($product->variations as $pv)
                                        @if ($pv->discount != 0)
                                            @php($startDate = new DateTime($product->variations[0]->discount_start_date))
                                            @php($endDate = new DateTime($product->variations[0]->discount_end_date))
                                            
                                            @if ($startDate <= $dateNow && $dateNow <= $endDate)
                                                @php($salePriceAvailable = true)
                                                @break
                                            @endif
                                        @endif
                                    @endforeach
                                    
                                    @if ($salePriceAvailable)
                                        <div class="card-discount">
                                            <!--<div class="discount">-${{ $product->variations[0]->discount }}</div>-->
                                            <div class="discount">Sale</div>
                                        </div>
                                    @endif
                                    
                                    @if (($product->variations->max('price') - $product->variations->min('price')) != 0)
                                    <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em; white-space:nowrap;">
                                                    ${{ number_format($product->variations->min('price'), 2, ".", ",") }} - ${{ number_format($product->variations->max('price'), 2, ".", ",") }}
                                                </div>
                                    @else
                                    <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em; white-space:nowrap;">
                                                    ${{ number_format($product->variations->min('price'), 2, ".", ",") }}
                                                </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <a href="{{url('/product')}}" class="button margin-top margin-large ea-grow w-button">See More</a>
            <div data-w-id="2763fafa-9663-7a88-db5c-9d4056894d11" class="product-info"></div>
        </div>
    </div>
    </div>
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/js/script-cart-checkout.js') }}" type="text/javascript"></script>
    <script>
        var cartItems = {};

        function roundUp(num, precision) {
            precision = Math.pow(10, precision);
            return Math.ceil(num * precision) / precision;
        }

        function updateCheckout() {
            var grandTotalPrice = 0;
            if (Object.keys(cartItems).length > 0) {
                $(".container-summary-item").html("");
                for (var key in cartItems) {
                    if (!cartItems.hasOwnProperty(key)) continue;

                    var totalPrice = 0;
                    var totalItem = 0;
                    var vendor = cartItems[key];
                    for (var item in vendor) {
                        if (!vendor.hasOwnProperty(item)) continue;

                        if (!isNaN(parseInt(item))) {
                            totalPrice += parseFloat(vendor[item].sub_total_price);
                            totalItem += parseInt(vendor[item].quantity);
                        }
                    }

                    $(".container-summary-item").append(`
                    <div id="summary-item-` + key + `" class="summary-item div-block-24">
                        <div class="inline">` + vendor["vendor_name"] + ` (` + totalItem + ` items)</div>
                        <div class="inline">$` + totalPrice.toFixed(2) + `</div>
                    </div>
                `);

                    grandTotalPrice += totalPrice;
                }
            } else {
                $(".container-summary-item").html(`
                <div class="summary-item div-block-24">
                    <div class="inline">-</div>
                </div>
            `);
            }
            $("#grandTotalPrice").html(grandTotalPrice.toFixed(2));

            if ($(".product-cart:checked").length > 0) {
                $("#btnProceed").removeAttr("disabled");
            } else {
                $("#btnProceed").attr("disabled", "");
            }
        }

        function updateBaseCheckout(checkbox) {
            var parent = checkbox.parents(".vendor-item");
            var vendorId = parent.attr("vendor-id");
            var cartId = checkbox.val();
            

            if (checkbox.is(":checked")) {
                var quantity = checkbox.parents().next().find(".product-quantity").val();

                $.post(url + "/user/cart/" + cartId, {
                    _token: CSRF_TOKEN,
                    _method: "PUT",
                    quantity: quantity,
                }).done(function(data) {
                    if (quantity <= 0) {
                        parent.remove();
                    }

                    if (data.vendor_id in cartItems) {
                        cartItems[data.vendor_id][cartId] = {
                            sub_total_price: roundUp((data.price * data.quantity), 2),
                            quantity: data.quantity
                        };
                    } else {
                        cartItems[data.vendor_id] = {};
                        cartItems[data.vendor_id][cartId] = {
                            sub_total_price: roundUp((data.price * data.quantity), 2),
                            quantity: data.quantity
                        };
                    }

                    cartItems[data.vendor_id]["vendor_name"] = data.vendor_name;

                    updateCheckout();
                }).fail(function(error) {
                    console.log(error);
                });
            } else {
                if (Object.keys(cartItems).length > 0) {
                    delete cartItems[vendorId][cartId];
                    if (Object.keys(cartItems[vendorId]).length <= 1) {
                        delete cartItems[vendorId];
                    }
                    updateCheckout();
                }
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#btnProceed").attr("disabled", "");
            $("input[type=checkbox]").each(function() {
                if ($(this).is(":checked")) {
                    $(this).prop("checked", false);
                }
            });
        });

        $(document).ajaxSend(function(event, request, settings) {
            $("#btnProceed").attr("disabled", "");
        });

        $(document).ajaxSuccess(function() {
            if ($(".product-cart:checked").length > 0) {
                $("#btnProceed").removeAttr("disabled");
            } else {
                $("#btnProceed").attr("disabled", "");
            }
        });

        $(document).on("click", ".quantity-change", function() {
            var parent = $(this).parents(".vendor-item");
            var checkbox = parent.find(".product-cart");
            var qty = parent.find(".product-quantity");
            if ($(this).attr("logic") == "add") {
                qty.val(parseInt(qty.val()) + 1);
            } else {
                if (qty.val() != 1) qty.val(parseInt(qty.val()) - 1);
            }
        
            if (checkbox.is(":checked")) {
                updateBaseCheckout(checkbox);
            }
        });

        $(document).on("change", ".product-quantity", function() {
            if ($(this).val() != "") {
                $(this).attr("disabled", "");
                updateBaseCheckout($(this).parents(".vendor-item").find(".product-cart"));

                var product_qty = $(this);
                setTimeout(function() {
                    product_qty.removeAttr("disabled");
                }, 2000);
            }
        });

        $(document).on("change", ".product-cart", function() {
            updateBaseCheckout($(this));
        });

        $(document).on("click", ".btn-delete-product", function() {
            var grandParent = $(this).parents(".vendors-card");
            var parent = $(this).parents(".vendor-item");
            var checkbox = $(this).parent().prev().find(".product-cart");
            var vendorId = parent.attr("vendor-id");
            var cartId = checkbox.val();

            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                   type:'POST',
                   url: url + "/user/cart/" + cartId,
                   data:{
                        _token: CSRF_TOKEN,
                        _method: "DELETE",
                   }
                }).done(function(data) {
                    if (checkbox.is(":checked")) {
                        delete cartItems[data.vendor_id][data.cart_id];
                        if (Object.keys(cartItems[data.vendor_id]).length <= 1) {
                            delete cartItems[data.vendor_id];
                        }

                        updateCheckout();
                        console.log(cartItems);
                    }
                    parent.remove();

                    if (data.vendor_product_exist <= 0) {
                        grandParent.remove();
                    }

                    alert(data.message);
                }).fail(function(error) {
                    console.log(error);
                });
                
                // $.post(url + "/user/cart/" + cartId, {
                //     _token: CSRF_TOKEN,
                //     _method: "DELETE",
                // }).done(function(data) {
                //     if (checkbox.is(":checked")) {
                //         delete cartItems[data.vendor_id][data.cart_id];
                //         if (Object.keys(cartItems[data.vendor_id]).length <= 1) {
                //             delete cartItems[data.vendor_id];
                //         }

                //         updateCheckout();
                //         console.log(cartItems);
                //     }
                //     parent.remove();

                //     if (data.vendor_product_exist <= 0) {
                //         grandParent.remove();
                //     }

                //     alert(data.message);
                // }).fail(function(error) {
                //     console.log(error);
                // });
            }
        });

        $(document).on("click", "#btnProceed", function(e) {
            if ($(this).attr("disabled") === undefined) {
                if (Object.keys(cartItems).length > 0) {
                    if (Object.keys(cartItems[Object.keys(cartItems)[0]]).length > 0) {
                        $("#cart-items").val(JSON.stringify(cartItems));
                    }
                }
            }
        });
    </script>
@endsection
