@extends('user.template.layout')

@section('page-title')
Cart - Big V
@endsection

@section('head-extra')
<link href="{{asset('assets/css/style-cart-checkout.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="content">
    <div class="max-width flex vertical">
        <h2 class="text-color-grey ea-top">Your Cart</h2>
        <div class="cart-wrapper">
            <div class="vendors-column">
                @foreach ($carts as $cart)
                    @if (count($cart->products) > 0)
                        <div class="vendors-card ea-left">
                            <div class="flex gap-medium"><img src="{{asset('assets/630193c64ebe68075a463721_profile-005.jpg')}}" loading="lazy" alt="" class="image-17" />
                                <div>
                                    <h5 class="text-color-dark-grey">{{ $cart->name }}</h5>
                                    <div class="text-size-small text-color-grey">Location: {{ $cart->location->name }}</div>
                                </div>
                            </div>
                            <div class="div-line"></div>
                            @foreach ($cart->products as $product)
                                <div class="vendor-item" vendor-id="{{ $cart->id }}">
                                    <div class="flex gap-medium">
                                        <input type="checkbox" class="product-cart" value="{{ $product->cart_id }}">
                                        <img src="{{ $product->featured_image }}" loading="lazy" alt="" class="image-18" />
                                        <div>
                                            <h5 class="text-color-dark-grey">{{ $product->product_variation_name == "novariation" ? $product->product_name : $product->product_name." (".$product->product_variation_name.")" }}</h5>
                                            <div class="text-size-small text-color-grey">Color: white</div>
                                            <div class="text-size-small text-color-grey">${{ $product->price }}</div>
                                        </div>
                                    </div>
                                    <div class="flex gap-small">
                                        <div class="quantity-pill-small">
                                            <div class="cursor-pointer quantity-change" logic="sub">-</div>
                                            <input type="number" class="product-quantity" value="{{ $product->quantity }}" min="1">
                                            <div class="cursor-pointer quantity-change" logic="add">+</div>
                                        </div>
                                        <button type="button" class="btn-delete-product flex" style="background: none;">
                                            <img src="{{asset('assets/630b4bc5cd03300cd594cf9c_Vector (3).svg')}}" loading="lazy" alt="" class="image-20" />
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
                        <div class="inline text-weight-bold">$<span id="grand-total-price">0</span></div>
                    </div>
                        <form method="POST" action="{{ url('user/cart/verify-checkout') }}">
                            @csrf

                            <input id="cart-items" type="hidden" name="carts">
                            <button id="btn-proceed" type="submit" class="checkout-button oh-grow w-button" style="width: 100%;">Proceed to Checkout</button>
                        </form>
                    </div>
            </div>
        </div><img src="{{asset('assets/6303b67a5064f05035c5a701_shape 1.svg')}}" loading="lazy" alt="" class="absolute shape-cart" />
        <div class="new-products-section padding-xxlarge ea-fade">
            <div class="heading-large text-align-center margin-bottom margin-large text-color-dark-grey">Suggested Products</div>
            <div class="products-archive-grid" id="productsList">
                <!-- 20 product per page -->
                @for ($i = 0; $i < 15; $i++)
                <a href="https://www.google.com" class="text-style-none">
                    <div id="w-node-_98aa59c7-5c20-8fcb-852c-972bad093e75-fac73a6c" class="product-card padding-small">
                        <div class="text-rich-text text-size-small text-color-grey">Cak Har</div><img src="{{asset('assets/62fc7f0ee2b4118e2f35c5d6_image%2034.png')}}" loading="lazy" alt="" class="product-image" />
                        <div class="product-card-stars"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" class="card-stars" /><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" class="card-stars" /><img src="{{asset('assets/Star 2.svg')}}" loading="lazy" alt="" class="card-stars" /><img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" class="card-stars" /><img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" class="card-stars" /></div>
                        <div class="product-card-title text-rich-text text-size-regular text-weight-bold text-color-dark-grey">Macaroni</div>
                        <div class="product-card-low-div">
                            <div class="card-discount">
                                <div class="discount">50%</div>
                            </div>
                            <div id="w-node-_98aa59c7-5c20-8fcb-852c-972bad093e85-fac73a6c" class="sale-price text-color-light-grey">$24.00</div>
                            <div class="text-rich-text text-color-orange text-weight-bold">$12.00</div>
                        </div>
                    </div>
                </a>
                @endfor
            </div>
            <a href="#" class="button margin-top margin-large ea-grow w-button">See More</a>
            <div data-w-id="1371aed2-3fc5-f904-82f2-4cec36fc3a06" class="product-info"></div>
        </div>
    </div>
</div>
@endsection

@section('javascript-extra')
<script src="{{asset('assets/js/script-cart-checkout.js')}}" type="text/javascript"></script>
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
                        totalPrice += vendor[item].sub_total_price;
                        totalItem += vendor[item].quantity;
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
        $("#grand-total-price").html(grandTotalPrice.toFixed(2));
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
                    cartItems[data.vendor_id][cartId] = {sub_total_price: roundUp((data.price * data.quantity), 2), quantity: data.quantity};
                } else {
                    cartItems[data.vendor_id] = {};
                    cartItems[data.vendor_id][cartId] = {sub_total_price: roundUp((data.price * data.quantity), 2), quantity: data.quantity};
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
        $("input[type=checkbox]").each(function() {
            if ($(this).is(":checked")) {
                $(this).prop("checked", false);
            }
        });
    });

    $(document).on("click", ".quantity-change", function(){
        var qty = $(this).parent().find(".product-quantity");
        if ($(this).attr("logic") == "add"){
            qty.val(parseInt(qty.val()) + 1);
        }
        else{
            if (qty.val() != 1) qty.val(parseInt(qty.val()) - 1);
        }

        updateBaseCheckout($(this).parents(".vendor-item").find(".product-cart"));
        updateCheckout();
    });

    $(document).on("change", ".product-cart", function() {
        updateBaseCheckout($(this));
    });

    $(document).on("click", ".btn-delete-product", function() {
        var parent = $(this).parents(".vendor-item");
        var checkbox = $(this).parent().prev().find(".product-cart");
        var vendorId = parent.attr("vendor-id");
        var cartId = checkbox.val();

        if (confirm('Are you sure you want to delete this item?')) {
            $.post(url + "/user/cart/" + cartId, {
                _token: CSRF_TOKEN,
                _method: "DELETE",
            }).done(function(data) {
                var obj = JSON.parse(data);

                if (checkbox.is(":checked")) {
                    if (Object.keys(cartItems).length <= 1) {
                        delete cartItems[obj.vendor_id];
                    } else {
                        delete cartItems[obj.vendor_id][obj.cart_id];
                        if (Object.keys(cartItems[obj.vendor_id]).length <= 1) {
                            delete cartItems[obj.vendor_id];
                        }
                    }
                    updateCheckout();
                }
                parent.remove();
                
                alert(obj.message);
            }).fail(function(error) {
                console.log(error);
            });
        }
    });

    $("#btn-proceed").on("click", function() {
        if (Object.keys(cartItems).length > 0) {
            if (Object.keys(cartItems[Object.keys(cartItems)[0]]).length > 0) {
                $("#cart-items").val(JSON.stringify(cartItems));
            }
        }
    });
</script>
@endsection