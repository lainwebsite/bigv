<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title')</title>
    <meta content="@yield('meta-title')" property="og:title" />
    <meta property="og:description" content="@yield('meta-description')" />
    <meta property="og:image" content="@yield('meta-image')" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    @yield('head-extra')
    <script type="text/javascript">
        ! function(o, c) {
            var n = c.documentElement,
                t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n
                .className += t + "touch")
        }(window, document);
    </script>
    <link href="{{ asset('assets/favicon.png') }}" rel="shortcut icon" type="image/x-icon" />
    <link href="{{ asset('assets/favicon.png') }}" rel="apple-touch-icon" />
    <style>
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .w-nav-brand {
            width: 80px !important;
        }

        input#search {
            width: auto;
        }

        @media screen and (min-width: 992px) {
            #nav-menu {
                width: calc(100% - 80px) !important;
            }

            .w-container {
                display: flex;
                align-items: center;
            }
        }
    </style>
</head>

<body style="background: #f7f7f7; overflow-x:hidden;">
    <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease"
        role="banner" class="navbar-3 sticky w-nav">
        <div class="w-container">
            <a href="{{url('/')}}" class="w-nav-brand"><img
                    src="{{ asset('assets/62ffbe41b946fc3a2b7b6747_Big%20V(NoTag)-ColorB%202.png') }}" loading="lazy"
                    width="80" alt="" /></a>
            <div class="menu-button w-nav-button">
                <div data-w-id="a94f6aff-cf03-9ce6-7aab-1fe8609b45f0" class="d-117-menu-trigger-wrapper">
                    <i class="fa fa-bars" style="color:#ff8000 !important;"></i>
                </div>
            </div>
            <nav role="navigation" class="dropdown-nav padding-small w-nav-menu" id="nav-menu">
                <div class="form-block w-form">
                    <div class="form">
                        <div class="input">
                            <div class="input__reset"></div>
                            <div class="input__field-wrapper">
                                <form id="formSearch" method="GET" action="{{ url('product/filter') }}">
                                    <input type="text" class="input__field-copy w-input" maxlength="256"
                                        name="keyword" value="{{ isset($keyword) ? $keyword : '' }}"
                                        data-name="Search 2" placeholder="Search" id="search" />
                                </form>
                                <div class="input__suggestions">
                                    <div class="input__suggestions-wrapper">
                                        <div class="suggestion">&quot;beauty&quot;</div>
                                        <div class="suggestion">&quot;beverage&quot;</div>
                                        <div class="suggestion">&quot;cooked food&quot;</div>
                                        <div class="suggestion">&quot;bakery&quot;</div>
                                        <div class="suggestion">&quot;vegan&quot;</div>
                                    </div>
                                </div>
                                <div class="input__icon w-embed">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18.677 19.607L12.962 13.891C10.4196 15.6985 6.91642 15.2564 4.90285 12.8739C2.88929 10.4915 3.03714 6.96361 5.24298 4.75802C7.44824 2.55147 10.9765 2.40298 13.3594 4.41644C15.7422 6.42989 16.1846 9.93347 14.377 12.476L20.092 18.192L18.678 19.606L18.677 19.607ZM9.48498 5.00001C7.58868 4.99958 5.95267 6.3307 5.56745 8.18745C5.18224 10.0442 6.15369 11.9163 7.89366 12.6703C9.63362 13.4242 11.6639 12.8529 12.7552 11.3021C13.8466 9.75129 13.699 7.64734 12.402 6.26402L13.007 6.86402L12.325 6.18402L12.313 6.17202C11.5648 5.4192 10.5464 4.99715 9.48498 5.00001Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-form-done"></div>
                    <div class="w-form-fail"></div>
                </div><a href="{{ url('/') }}" class="text-color-grey w-nav-link">Home</a>
                <div class="div-line-orange"></div><a href="{{ url('product') }}"
                    class="text-color-grey w-nav-link">Products</a>
                <div class="div-line-orange"></div><a href="{{url('vendors')}}" class="text-color-grey w-nav-link">Vendors</a>
                <div class="div-line-orange"></div><a href="{{url('about')}}" style="white-space: nowrap;" class="text-color-grey w-nav-link">About Us</a>
                <div class="div-block-22">
                    @auth
                        <div class="div-line-orange"></div>
                        <a href="{{ route('user.cart.index') }}" class="text-color-grey w-nav-link"
                            style="font-size: 24px; padding: 20px 10px;"><i class="fa fa-shopping-cart"></i></a>
                        <a href="{{ route('user.transaction.index') }}" class="text-color-grey w-nav-link"
                            style="font-size: 24px; padding: 20px 10px;"><i class="fa fa-user-circle"></i></a>
                    @endauth

                    @guest
                        <div class="div-line-orange"></div><a href="{{ route('login') }}"
                            class="text-color-grey w-nav-link" style="font-size: 24px; padding: 20px 10px;"><i
                                class="fa fa-user-circle"></i></a>
                    @endguest

                    @auth
                        <a class="text-color-grey w-nav-link" style="font-size: 24px; padding: 20px 10px;"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="fa fa-sign-out"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endauth
                </div>
            </nav>
        </div>
    </div>

    @yield('content')

    <div class="footer overflow-hidden relative ea-up"><img
            src="{{ asset('assets/6303a4ccee19b64624bf8501_HDB Building.svg') }}" loading="lazy" alt=""
            class="image-12" />
        <div class="footer-top text-color-white relative ea-right">
            <div class="ea-left"><img
                    src="{{ asset('assets/62fc7f3f35498aa012756c07_Big%20V-BW%20(Reverse)%201.png') }}"
                    loading="lazy" alt="" /></div>
            <div class="align-vertical">
                <h3 class="heading-5">Enjoy <span class="text-color-dark-grey">200+</span> foods from<br />‍<span
                        class="text-color-dark-grey">30+</span> HBB</h3>
            </div>
            <div class="flex align-vertical" style="align-items: flex-start !important;">
                <div class="flex flex-vertical left-align margin-small">
                    <h4>Contact Us</h4>
                    <a href="https://www.instagram.com/bigvsg.official/" target="_blank"
                        class="text-color-white text-style-link">Instagram</a>
                    <a href="https://www.facebook.com/BigVSG/" target="_blank"
                        class="text-color-white text-style-link">Facebook</a>
                    <a href="https://www.tiktok.com/@bigvsg.official" target="_blank"
                        class="text-color-white text-style-link">Tiktok</a>
                    <a href="https://api.whatsapp.com/send?phone=6586543515" target="_blank"
                        class="text-color-white text-style-link">Whatsapp</a>
                </div>
                <div class="flex flex-vertical left-align margin-small">
                    <h4>Company</h4><a href="https://wa.me/6586543515?text=Hello%20BigV!%20I'm%20interested%20to%20become%20a%20vendor" class="text-color-white text-style-link">Become a Vendor</a><a
                        href="{{url('/about')}}" class="text-color-white text-style-link">About Us</a><a href="#" style="display:none;"
                        class="text-color-white text-style-link">Terms &amp; Conditions</a><a href="#"
                        class="text-color-white text-style-link" style="display:none;">Privacy Policy</a>
                </div>
            </div>
        </div>
        <!-- <div class="footer-mid padding-small relative">
            <a href="#" class="text-color-white text-style-link"><img
                    src="{{ asset('assets/62fc7f3f35498a656c756c0c_Vector-4.svg') }}" loading="lazy"
                    alt="" /></a>
            <a href="#" class="text-color-white text-style-link"><img
                    src="{{ asset('assets/62fc7f3f35498ad2a7756c0a_Vector-1.svg') }}" loading="lazy"
                    alt="" /></a>
            <a href="#" class="text-color-white text-style-link"><img
                    src="{{ asset('assets/62fc7f3f35498a35b1756c0d_Vector.svg') }}" loading="lazy"
                    alt="" /></a>
            <a href="#" class="text-color-white text-style-link"><img
                    src="{{ asset('assets/62fc7f3f35498a83cc756c0b_Vector-3.svg') }}" loading="lazy"
                    alt="" /></a>
            <a href="#" class="text-color-white text-style-link"><img
                    src="{{ asset('assets/62fc7f3f35498ab948756c09_Vector-2.svg') }}" loading="lazy"
                    alt="" /></a>
        </div> -->
        <div class="footer-bottom background-color-grey text-align-center text-color-white padding-xsmall relative">
            <div>©2022 <span class="text-color-orange">BigV</span> | All Rights Reserved</div>
        </div>
    </div>
    <script>
        feather.replace();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var hostname = "{{ request()->getHost() }}";
        // var url = "{{ config('app.url') }}";
        var url = "https://www.bigvsg.com";

        if (hostname.includes('localhost')) {
            url += ":8000";
        }

        $("#search").keypress(function(e) {
            if (e.keyCode == 13) {
                var param = $(location).attr("search");

                if (param != '') {
                    param = param.substring(1, param.length).split("&");
                    param.forEach(function(item) {
                        var items = decodeURIComponent(item).split("=");
                        if (items[0] != "keyword") {
                            if ($("input[type=hidden][name=" + items[0] + "]").length <= 0) {
                                $("<input>").attr({
                                    type: "hidden",
                                    name: items[0],
                                    value: items[1]
                                }).appendTo("#formSearch");
                            }
                        }
                    });
                }
            }
        });
    </script>
    @yield('javascript-extra')
    <script>
        $("#search").on('keyup', function() {
            if ($(this).val() != "") {
                $(".input__suggestions-wrapper").hide();
            } else {
                $(".input__suggestions-wrapper").show();
            }
        });

        $(".page").on("click", function(e) {
            var param = $(location).attr("search");

            if (param != "") {
                param = param.substring(1, param.length).split("&");
                current_param = "";
                param.forEach(function(item) {
                    var items = item.split("=");
                    if (items[0] != "page") {
                        current_param += "&" + items[0] + "=" + items[1];
                    }
                });
                $(this).attr("href", $(this).attr("href") + current_param);
            }
        });
    </script>
</body>

</html>
