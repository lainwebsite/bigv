@extends('user.template.layout')

@section('page-title')
    About Us - Big V
@endsection

@section('head-extra')
    <link href="{{ asset('assets/css/style-address-login-register.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content">
        <section class="hero-heading-center wf-section">
        	<div class="container-11">
        		<h1 class="centered-heading margin-bottom-32px orange-text">About BigV</h1>
        		<div class="hero-wrapper-2">
        			<div class="hero-split-2">
        				<p class="margin-bottom-24px-2">BigV is a start-up for homebased business, focusing on promoting and selling homebased businesses of all kinds, including F&amp;B, service, product and educational events such as online enrichment programme and webinars.
        					<br>
        				</p>
        			</div>
        			<div class="hero-split-2"><img src="{{ asset('assets/633f7db809c5ff224b96427e_image%2081.webp')}}" loading="lazy" sizes="(max-width: 479px) 94vw, (max-width: 767px) 96vw, (max-width: 991px) 92vw, (max-width: 1439px) 46vw, 538.984375px" srcset="{{ asset('assets/633f7db809c5ff224b96427e_image%2081.webp')}}" alt="" class="shadow-two-2"></div>
        		</div>
        	</div>
        </section>
        <section class="testimonial-slider-small wf-section">
        	<div class="container-11">
        		<h2 class="centered-heading orange-text">3 V Approach</h2>
        		<p class="centered-subheading">BigV works on a 3 V approach. Big Vision, Big Venture, and Big Value.</p>
        		<div class="vision-mission-div">
        			<div class="testimonial-card-2">
        				<h3 class="testimonial-author">Mission</h3>
        				<p>1. Focusing on featuring Home Based Businesses.
        					<br>
        					<br>2. Creating a marketplace for organic community growth.
        					<br>
        					<br>3. Nurture and provide holistic marketing services for Home Based Businesses.
        					<br>
        					<br>4. Create a unique, sales and marketing driven, and consumer eccentric online marketplace.
        					<br>
        				</p>
        			</div>
        			<div class="testimonial-card-2">
        				<h3 class="testimonial-author">Vision</h3>
        				<p>1. To be the No.1 Home Based Business online marketplace in the region.
        					<br>
        					<br>2. Building quality and international acclaimed local brands.
        					<br>
        					<br>3. Curating unique HBB pop up events.
        					<br>
        					<br>4. Build central kitchen for mass productions.
        					<br>
        					<br>5. Curate and achieve product visibility at major supermarkets under BigV branding.</p>
        			</div>
        		</div>
        	</div>
        </section>
        <section class="team-circles wf-section">
        	<div class="container-11">
        		<h2 class="centered-heading orange-text">The Team</h2>
        		<p class="centered-subheading">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tincidunt sagittis eros. Quisque quis euismod lorem.</p>
        		<div class="team-grid-2">
        			<div id="w-node-ed1af603-cba9-a489-202b-d35cca6aac80-48a9ac08" class="team-card"><img src="{{ asset('assets/638c81fa95fb43adbf40a25a_278385831_513021147080208_3041277267152842079_n.jpg')}}" loading="lazy" alt="" class="team-member-image">
        				<div class="team-member-name">VINCENT CHONG</div>
        				<div class="team-member-position">Managing Director</div>
        				<p>Mr Vincent is a successful Events Director with over 20 years of experience in fast-paced, bringing very strong organizational skills. &nbsp;
        					<br>
        					<br>Driven and dedicated to building a brand with growth strategies that deliver results.
        					<br>
        				</p>
        			</div>
        			<div id="w-node-ed1af603-cba9-a489-202b-d35cca6aac8b-48a9ac08" class="team-card"><img src="{{ asset('assets/638c828dcb0ed00ca3a0a51e_1646013771735.jpeg')}}" loading="lazy" sizes="(max-width: 479px) 100vw, (max-width: 991px) 190px, (max-width: 1439px) 27vw, 270px" srcset="{{ asset('assets/638c828dcb0ed00ca3a0a51e_1646013771735.jpeg')}}" alt="" class="team-member-image">
        				<div class="team-member-name">MOHAMED MUZAMMIL</div>
        				<div class="team-member-position">Business Consultant</div>
        				<p>Mr Muz is a Seasoned Sales and Consultancy with more than 10 years experience. He have a wealthy amount of experience in the Banking and Consultancy industry with Robert Walters, Citibank Singapore and Malayan Bank Berhad.
        					<br>
        					<br>He has achieved several awards as Top Consultant in 2018 and Relationship Manager in 2014 to 2016.
        					<br>
        					<br>
        				</p>
        			</div>
        			<div id="w-node-e46f252b-f3f6-43ef-0411-af84f13fbb12-48a9ac08" class="team-card"><img src="{{ asset('assets/638c831f5fd2fd3e87a27eab_unnamed.jpg')}}" loading="lazy" sizes="(max-width: 479px) 100vw, (max-width: 991px) 190px, (max-width: 1439px) 27vw, 270px" srcset="{{ asset('assets/638c831f5fd2fd3e87a27eab_unnamed.jpg')}}" alt="" class="team-member-image">
        				<div class="team-member-name">VINCENT ONG</div>
        				<div class="team-member-position">Marketing &amp; Sponsorship Senior Manager</div>
        				<p>Mr Vincent Ong has 15 years of experienced in Project Management and travel retail across APAC.
        					<br>
        					<br>Mr Vincent clientele covers from world leading luxury beauty to liquor brands such as Gucci , Moet Hennessy and many more. He has strong regional network and have lead multiple teams on and off shore.
        					<br>
        				</p>
        			</div>
        		</div>
        	</div>
        </section>
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
            var qty = $(this).parent().find(".product-quantity");
            if ($(this).attr("logic") == "add") {
                qty.val(parseInt(qty.val()) + 1);
            } else {
                if (qty.val() != 1) qty.val(parseInt(qty.val()) - 1);
            }

            updateBaseCheckout($(this).parents(".vendor-item").find(".product-cart"));
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

                    if (obj.vendor_product_exist <= 0) {
                        grandParent.remove();
                    }

                    alert(obj.message);
                }).fail(function(error) {
                    console.log(error);
                });
            }
        });

        $("#btnProceed").on("click", function(e) {
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
