<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Home - BigV</title>
    <meta content="BigV Homepage" property="og:title" />
    <meta content="BigV Homepage" property="twitter:title" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />

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
    <link href="{{ asset('assets/css/style-user-home.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="body" style="overflow-x: hidden; width: 100vw !important;">
    <div class="hero-section-w-nav wf-section">
        <div style="width:80%;-webkit-transform:translate3d(0, 3em, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 3em, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 3em, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 3em, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
            data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease"
            role="banner" class="navbar w-nav">
            <div data-w-id="bca3a5c8-7269-035c-5884-488e78117e3e" style="width:100%;height:0%" class="overlay"></div>
            <div data-w-id="bca3a5c8-7269-035c-5884-488e78117e3f"
                style="-webkit-transform:translate3d(0, 0, 0) scale3d(0.4, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(0.4, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(0.4, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(0.4, 0.5, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0"
                class="container-navbar"><a href="#" data-w-id="bca3a5c8-7269-035c-5884-488e78117e4d"
                    class="brand w-nav-brand"><img
                        src="{{ asset('assets/62ffbe41b946fc3a2b7b6747_Big%20V(NoTag)-ColorB%202.png') }}"
                        loading="lazy" alt="" class="nav-logo" /><img
                        src="{{ asset('assets/62ffbe6e9682d20502999910_Big%20V(NoTag)-ColorB%202%20(2).png') }}"
                        loading="lazy" style="opacity:0" data-w-id="bca3a5c8-7269-035c-5884-488e78117e50" alt=""
                        class="nav-logo-white" /></a>
                <nav role="navigation" class="nav-menu w-nav-menu">
                    <div class="form-block w-form">
                        <form id="formSearch" name="email-form" data-name="Email Form" method="GET" autocomplete="off"
                            class="form" action="{{ url('product/filter') }}">
                            <div class="input">
                                <div data-w-id="322b334f-cb7d-a0a4-b9ca-b6b874d7aa25" class="input__reset"></div>
                                <div data-w-id="322b334f-cb7d-a0a4-b9ca-b6b874d7aa26" class="input__field-wrapper">
                                    <input type="text" class="input__field w-input" maxlength="256"
                                        style="background-color: #ffffff !important; width: auto;" name="keyword" data-name="Search"
                                        placeholder="Search" id="search" />
                                    <div class="input__suggestions">
                                        <div class="input__suggestions-wrapper">
                                            <div class="suggestion">&quot;beauty&quot;</div>
                                            <div class="suggestion">&quot;beverage&quot;</div>
                                            <div class="suggestion">&quot;cooked food&quot;</div>
                                            <div class="suggestion">&quot;bakery&quot;</div>
                                            <div class="suggestion">&quot;vegan&quot;</div>
                                        </div>
                                    </div>
                                    <div class="input__icon w-embed"><svg width="24" height="24"
                                            viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18.677 19.607L12.962 13.891C10.4196 15.6985 6.91642 15.2564 4.90285 12.8739C2.88929 10.4915 3.03714 6.96361 5.24298 4.75802C7.44824 2.55147 10.9765 2.40298 13.3594 4.41644C15.7422 6.42989 16.1846 9.93347 14.377 12.476L20.092 18.192L18.678 19.606L18.677 19.607ZM9.48498 5.00001C7.58868 4.99958 5.95267 6.3307 5.56745 8.18745C5.18224 10.0442 6.15369 11.9163 7.89366 12.6703C9.63362 13.4242 11.6639 12.8529 12.7552 11.3021C13.8466 9.75129 13.699 7.64734 12.402 6.26402L13.007 6.86402L12.325 6.18402L12.313 6.17202C11.5648 5.4192 10.5464 4.99715 9.48498 5.00001Z"
                                                fill="currentColor"></path>
                                        </svg></div>
                                </div>
                            </div>
                        </form>
                        <div class="w-form-done"></div>
                        <div class="w-form-fail"></div>
                    </div>
                </nav>
                <nav role="navigation" class="nav-menu w-nav-menu">
                    <div class="nav-link-wrapper"><a href="{{ url('/') }}"
                            data-w-id="bca3a5c8-7269-035c-5884-488e78117e53" class="nav-link w-nav-link">Home</a>
                        <div class="underline"></div>
                    </div>
                    <div class="nav-link-wrapper"><a href="{{ url('product') }}"
                            data-w-id="bca3a5c8-7269-035c-5884-488e78117e57" class="nav-link w-nav-link">Products</a>
                        <div class="underline"></div>
                    </div>
                    <div class="nav-link-wrapper"><a href="{{url('vendor')}}" data-w-id="bca3a5c8-7269-035c-5884-488e78117e5b"
                            class="nav-link w-nav-link">Vendors</a>
                        <div class="underline"></div>
                    </div>
                    <div class="nav-link-wrapper"><a href="{{url('about')}}" style="white-space: nowrap;" data-w-id="33ebaa1d-c890-4ed1-df4b-2410c2296afb"
                            class="nav-link w-nav-link">About Us</a>
                        <div class="underline"></div>
                    </div>
                    <div class="nav-link-wrapper">
                        <div style="display: flex; justify-content:space-between; height: 100%;">
                            @auth
                                <a href="{{ route('user.cart.index') }}" data-w-id="33ebaa1d-c890-4ed1-df4b-2410c2296afb"
                                    class="nav-link w-nav-link"
                                    style="font-size: 24px; margin:0 !important; display: flex; align-items:center; height: 100%; padding:20px 10px;"><i
                                        class="fa fa-shopping-cart"></i></a>
                                <a href="{{route('user.transaction.index')}}" data-w-id="33ebaa1d-c890-4ed1-df4b-2410c2296afb"
                                    class="nav-link w-nav-link"
                                    style="font-size: 24px; margin:0 !important; display: flex; align-items:center; height: 100%; padding:20px 10px;"><i
                                        class="fa fa-user-circle"></i></a>
                            @endauth
                            @guest
                                <a href="{{ route('login') }}" data-w-id="33ebaa1d-c890-4ed1-df4b-2410c2296afb"
                                    class="nav-link w-nav-link"
                                    style="font-size: 24px; margin:0 !important; display: flex; align-items:center; height: 100%; padding:20px 10px;"><i
                                        class="fa fa-user-circle"></i></a>
                            @endguest
                            @auth
                                <a href="{{ route('logout') }}" data-w-id="33ebaa1d-c890-4ed1-df4b-2410c2296afb"
                                    class="nav-link w-nav-link"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    style="font-size: 24px; margin:0 !important; display: flex; align-items:center; height: 100%; padding:20px 10px;"><i
                                        class="fa fa-sign-out"></i></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endauth
                        </div>
                    </div>
                </nav>
                <div class="w-nav-button">
                    <div class="w-icon-nav-menu"></div>
                </div>
            </div>
        </div>
        <div data-w-id="bca3a5c8-7269-035c-5884-488e78117e60" class="nav-animation-trigger"></div>
        <div class="hero">
            <div class="hero-left"><img src="{{ asset('assets/633659fd3354ba2449576a3e_Rectangle 62 (2).webp') }}"
                    loading="lazy" width="241" data-w-id="47b878b6-5fd4-a8e3-a242-6bf091c18187" alt=""
                    class="image" /><img src="{{ asset('assets/633f7db809c5ff224b96427e_image 81.webp') }}"
                    loading="lazy" width="426" data-w-id="47b878b6-5fd4-a8e3-a242-6bf091c18186"
                    sizes="(max-width: 479px) 93vw, (max-width: 767px) 30vw, (max-width: 991px) 31vw, 32vw"
                    srcset="{{ asset('assets/633f7db809c5ff224b96427e_image%2081.webp') }}" alt=""
                    class="image-2" /></div>
            <div class="hero-center">
                <div class="text-rich-text text-size-small text-align-center text-color-orange ea-top">Treat your
                    family every
                    season</div>
                <div class="heading-xlarge text-align-center ea-top">By <span
                        class="text-color-orange">Community</span><br />with <span
                        class="text-color-orange">Love</span></div>
                <div class="text-align-center text-color-grey ea-bottom">Shop and help Small Medium Enterprises all around Singapore. Made with love. Sign up to become a Vendor and Rise with BigV.</div>
                <div class="hero-button ea-bottom"><a href="{{url('/product')}}" class="button w-button">Order Now</a><a
                        href="#" class="button w-button">Join Now</a></div>
            </div>
            <div class="hero-right"><img src="{{ asset('assets/63365a23566e80a62a58f972_Rectangle 60 (1).webp') }}"
                    loading="lazy" width="385" data-w-id="11418749-c043-2a0d-68a6-46d1a59afeeb"
                    sizes="(max-width: 479px) 100vw, (max-width: 767px) 27vw, (max-width: 991px) 28vw, 29vw"
                    srcset="{{ asset('assets/63365a23566e80a62a58f972_Rectangle%2060%20(1).webp') }}" alt=""
                    class="image-3" /><img src="{{ asset('assets/63365a7b4115e969fefef896_Rectangle 61 (1).webp') }}"
                    loading="lazy" width="201" data-w-id="47b878b6-5fd4-a8e3-a242-6bf091c1819c" alt=""
                    class="image-4" /></div>
        </div>
        <div data-w-id="14ca08aa-f598-2259-1a4a-17cce45a4822" class="bg-parallax hidden-x-small">
            <div class="content-2 mod--bg-parallax">
                <div class="bg-circle-wrap"><img src="{{ asset('assets/631d3741341fb5b1f8884c93_Union (1).svg') }}"
                        loading="eager" data-w-id="14ca08aa-f598-2259-1a4a-17cce45a4825" alt=""
                        class="bg-circle" /></div>
            </div>
        </div>
    </div>
    <div class="promo-section" style="margin-top: 20vh;">
        <div class="todays-pick-promo-container">
            <div class="heading-large margin-bottom margin-large ea-bottom">Latest Promos</div>
            <div class="promo-div" style="display:none;">
                <div id="w-node-_5eb6a600-3317-8d0d-76be-b3ed7dd852c4-92c73a6a"><img
                        src="{{ asset('assets/diskon1.jpg') }}" loading="lazy"
                        id="w-node-_5eb6a600-3317-8d0d-76be-b3ed7dd852c5-92c73a6a" height="410"
                        sizes="(max-width: 479px) 46vw, (max-width: 767px) 41vw, (max-width: 991px) 50vw, 46vw"
                        srcset="{{ asset('assets/diskon1.jpg') }}" alt=""
                        class="ea-left" /></div>
                <div id="w-node-_5eb6a600-3317-8d0d-76be-b3ed7dd852c6-92c73a6a" class="div-block-2"><img
                        src="{{ asset('assets/diskon2.webp') }}" loading="lazy"
                        id="w-node-_5eb6a600-3317-8d0d-76be-b3ed7dd852c7-92c73a6a" alt="" class="ea-top" />
                </div>
                <div id="w-node-_5eb6a600-3317-8d0d-76be-b3ed7dd852c8-92c73a6a" class="div-block-2"><img
                        src="{{ asset('assets/diskon3.jpg') }}" width="351" height="183" loading="lazy"
                        id="w-node-_5eb6a600-3317-8d0d-76be-b3ed7dd852c9-92c73a6a" alt="" class="ea-right" />
                </div>
            </div>
            <div class="four-promo-container">
                <div class="promo-content" style="justify-content: flex-end;">
                    <img src="{{ asset('promo/promo-1.png') }}" loading="lazy" alt="" class="promo-image"  />
                </div>
                <div class="promo-content">
                    <img src="{{ asset('promo/promo-2.png') }}" loading="lazy" alt="" class="promo-image" />
                </div>
                <div class="promo-content" style="justify-content: flex-end;">
                    <img src="{{ asset('promo/promo-3.png') }}" loading="lazy" alt="" class="promo-image" />
                </div>
                <div class="promo-content">
                    <img src="{{ asset('promo/promo-4.png') }}" loading="lazy" alt="" class="promo-image" />
                </div>
            </div>
        </div>
    </div>
    <div class="today-s-pick-section">
        <div class="todays-pick-container ea-bottom">
            <div class="new-products-text-div">
                <div class="heading-large ea-left">Today&#x27;s Pick</div>
                <div class="text-block-4 ea-right">Our team handpicked products that we feature based on interest and
                    just right
                    for today’s current occasion</div>
            </div>
            <div class="today-s-pick-product-div ea-bottom">
                @php(date_default_timezone_set('Asia/Singapore'))
                @php($dateNow = new DateTime(date("Y-m-d H:i:s")))
                @foreach ($productToday as $product)
                    <a href="{{ route('product.show', $product->id) }}" style="text-decoration:none !important;">
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
                                                ${{ $product->variations[0]->price }}</div>
                                            <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em;">
                                                ${{ $product->variations[0]->price - $product->variations[0]->discount }}</div>
                                        @else
                                            <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em;">
                                                ${{ $product->variations[0]->price }}</div>
                                        @endif
                                    @else
                                        <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em;">
                                            ${{ $product->variations[0]->price }}</div>
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
                                    
                                    <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em;">
                                                    ${{ $product->variations->min('price') }} - ${{ $product->variations->max('price') }}
                                                </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="new-products-section">
        <div class="max-width flex vertical">
            <div class="new-products-text-div">
                <h2>New Products</h2>
                <div class="text-block-4">Here are some of our most recent products,<br />Be the first to taste and
                    rate it!
                </div>
            </div>
            <div class="products-archive-grid ea-bottom">
                @foreach ($productNew as $product)
                    <a href="{{ route('product.show', $product->id) }}" style="text-decoration:none !important;">
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
                                                ${{ $product->variations[0]->price }}</div>
                                            <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em;">
                                                ${{ $product->variations[0]->price - $product->variations[0]->discount }}</div>
                                        @else
                                            <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em;">
                                                ${{ $product->variations[0]->price }}</div>
                                        @endif
                                    @else
                                        <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em;">
                                            ${{ $product->variations[0]->price }}</div>
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
                                    
                                    <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em;">
                                                    ${{ $product->variations->min('price') }} - ${{ $product->variations->max('price') }}
                                                </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div><a href="{{url('/product')}}" class="button margin-top margin-large ea-grow ea-bottom w-button">See More</a>
            <div data-w-id="4ff858c5-71e9-73e3-d44c-eb80bb583953" class="product-info"></div>
        </div>
    </div>
    <div class="categories-section">
        <div class="heading-large text-align-center ea-top">Categories</div>
        <div class="categories-grid ea-bottom">
            <a href="{{ url('/product') }}/filter?category=1" style="text-decoration: none !important;">
                <div class="categories-card cat-1-color"><img
                        src="{{ asset('assets/62fc7f0ee2b4118e2f35c5d6_image%2034.png') }}" loading="lazy"
                        alt="" class="category-image" />
                    <div
                        class="text-rich-text text-size-large text-weight-bold text-color-white margin-left padding-small">
                        Cooked
                        Food</div>
                </div>
            </a>
            <a href="{{ url('/product') }}/filter?category=2" style="text-decoration: none !important;">
                <div class="categories-card cat-2-color"><img
                        src="{{ asset('assets/62fccd5cb02a381d35ef3d4e_image 35 (1).webp') }}" loading="lazy"
                        alt="" class="category-image" />
                    <div
                        class="text-rich-text text-size-large text-weight-bold text-color-white padding-left padding-small">
                        Bakery
                    </div>
                </div>
            </a>
            <a href="{{ url('/product') }}/filter?category=3" style="text-decoration: none !important;">
                <div class="categories-card cat-3-color"><img
                        src="{{ asset('assets/62fccd5cb02a38b24def3d46_image 35 (2).webp') }}" loading="lazy"
                        alt="" class="category-image" />
                    <div
                        class="text-rich-text text-size-large text-weight-bold text-color-white padding-left padding-small">
                        Vegan
                        &amp; Glutten Free</div>
                </div>
            </a>
            <a href="{{ url('/product') }}/filter?category=4" style="text-decoration: none !important;">
                <div class="categories-card categories-bottom cat-4-color"><img
                        src="{{ asset('assets/62fccd5cb02a38a37aef3d48_image 35 (3).webp') }}" loading="lazy"
                        alt="" class="category-image" />
                    <div
                        class="text-rich-text text-size-large text-weight-bold text-color-white padding-left padding-small">
                        Muslim
                        Owned</div>
                </div>
            </a>
            <a href="{{ url('/product') }}/filter?category=5" style="text-decoration: none !important;">
                <div class="categories-card categories-bottom cat-5-color"><img
                        src="{{ asset('assets/62fccd5cb02a380d2cef3d4a_image 35 (4).webp') }}" loading="lazy"
                        alt="" class="category-image" />
                    <div
                        class="text-rich-text text-size-large text-weight-bold text-color-white padding-left padding-small">
                        Beauty
                    </div>
                </div>
            </a>
            <a href="{{ url('/product') }}/filter?category=7" style="text-decoration: none !important;">
                <div class="categories-card categories-bottom cat-6-color"><img
                        src="{{ asset('assets/62fccd5cb02a3831ebef3d4c_image 35 (5).webp') }}" loading="lazy"
                        alt="" class="category-image" />
                    <div
                        class="text-rich-text text-size-large text-weight-bold text-color-white padding-left padding-small">
                        Grocery
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="div-block-33"><img src="{{ asset('assets/633657c00ab1d66c4dcf0530_Vector (4).svg') }}"
            loading="lazy" alt="" class="ea-bottom" /><img
            src="{{ asset('assets/6336580aa13203333deff644_Intersect (2).svg') }}" loading="lazy" alt=""
            class="image-25" /></div>
    <!-- <div class="soft-sell-section">
        <div class="soft-sell-left d-flex">
            <div class="heading-xlarge ea-top">Join us at<span class="orange-text"> Albert Street Pasar Malan </span> at <span
                    class="orange-text">Tekka Place</span></div>
            <div class="heading-medium orange-text ea-left">9th December 2022</div>
            <div class="text-size-regular text-color-grey ea-left character-limit">Join us and reminisce good old memories at Albert Street Pasar Malam! Place where Home Based Business could expand their business & explore their market. In 1970’s – 80’s Albert Street at Selegie House used to accommodate many hampers, alcohol and fresh fruits suppliers. Many of them are home based businesses who would open up their hawkers stalls during the night time along Albert Street. Are you an HBB owner? Sign Up Now!</div>
            <a href="#" class="button ea-bottom w-button">Enroll Now</a>
        </div>
        <div class="soft-sell-right"><img src="{{ asset('assets/Tekka Place.jpg') }}"
                loading="lazy" sizes="(max-width: 479px) 94vw, 53vw"
                srcset="{{ asset('assets/Tekka Place.jpg') }}" alt=""
                class="image-6 ea-right" /></div>
    </div> -->
    <div class="value-section" id="column-reverse-responsive" style="z-index:4;">
        <div class="value-right">
            <div class="heading-xlarge ea-top">Join us at<span class="orange-text"> Albert Street Pasar Malan </span> at <span
                    class="orange-text">Tekka Place</span></div>
            <div class="heading-medium orange-text ea-right">9th December 2022</div>
            <div class="text-size-regular text-color-grey ea-right">Join us and reminisce good old memories at Albert Street Pasar Malam! Place where Home Based Business could expand their business & explore their market. In 1970’s – 80’s Albert Street at Selegie House used to accommodate many hampers, alcohol and fresh fruits suppliers. Many of them are home based businesses who would open up their hawkers stalls during the night time along Albert Street. Are you an HBB owner? Sign Up Now!
            </div><!--<a href="#" class="button ea-bottom w-button">Enroll Now</a>-->
        </div>
        <div class="value-left max-width-medium"><img
            src="{{ asset('assets/Tekka Place.jpg') }}" loading="lazy"
            srcset="{{ asset('assets/Tekka Place.jpg') }}"
            sizes="(max-width: 479px) 94vw, (max-width: 767px) 49vw, (max-width: 991px) 45vw, 48vw" alt=""
            class="image-8 ea-left" style="border-radius:10px;" /></div>
    </div>
    <div class="value-section"><img src="{{ asset('assets/633652c3764cda2b58895a36_Intersect.svg') }}"
            loading="lazy" data-w-id="d482b9a8-9984-a9ec-8860-e4973c48c7e1" alt="" class="image-24" />
        <div class="value-left max-width-medium"><img
                src="{{ asset('assets/63365480eb20ee37f49a8fbb_image 76.webp') }}" loading="lazy"
                srcset="{{ asset('assets/63365480eb20ee37f49a8fbb_image%2076.webp') }}"
                sizes="(max-width: 479px) 94vw, (max-width: 767px) 49vw, (max-width: 991px) 45vw, 48vw" alt=""
                class="image-8 ea-left" /></div>
        <div class="value-right">
            <div class="heading-xlarge ea-top">Meet with Vincent</div>
            <div class="heading-medium orange-text ea-right">27th November</div>
            <div class="text-size-regular text-color-grey ea-right">Join our BigV Gathering with Vincent to learn more about the insights and benefits of becoming a vendor. Vincent will also show the tips and tricks to excell in your home-based business with social media. Click the button bellow to sign up!
            </div><a href="#" class="button ea-bottom w-button">Enroll Now</a>
        </div><img src="{{ asset('assets/633652c5de27787915ec9b2f_Intersect (1).svg') }}" loading="lazy"
            data-w-id="55107afb-6f21-606b-b271-a1ff35a970cf" alt="" class="image-23" />
    </div>
    <div class="sustainability-section">
        <div class="value-right">
            <div class="heading-xlarge blue-haze ea-top">PM Haze</div>
            <div class="heading-medium-copy ea-left">BigV&#x27;s Sustainable Movement</div>
            <div class="text-size-regular text-color-grey ea-left">As our steps toward supporting Sustainability,
                we&#x27;ve
                partnered with PM Haze which is a Singapore registered charity and local environmental organization
                formed in
                2014 that deals with the transboundary haze crisis in Singapore, Malaysia, and Indonesia.</div><a
                href="#" class="button ea-bottom w-button">Learn more</a>
        </div>
        <div class="value-left"><img
                src="{{ asset('assets/636a8676e25120c679da870b_5_SupermarketGuide_Poster.png') }}" loading="lazy"
                alt="" class="image-8 ea-left" /></div>
    </div>
    <div class="testimonial-section" style="min-height: 30vh;">
        <div class="heading-large text-align-center text-color-white ea-top" style="display: none;">What People Say</div>
        <div class="testimonial-grid" style="display: none;">
            <div class="testimonial-card"><img
                    src="{{ asset('assets/62fc7f3686b3ffedc7337819_Rectangle%2040.jpg') }}" loading="lazy"
                    alt="" class="testimonial-image" />
                <div class="margin-left margin-small">
                    <div class="heading-small">Winnie Lin</div>
                    <div class="text-size-regular orange-text">Vendor</div>
                    <div class="text-size-tiny text-color-grey">BigV Helped me scale up my business from 0 to being able to afford all sorts of things that I couldn't possibly dreamt off!</div>
                </div>
            </div>
            <div class="testimonial-card"><img
                    src="{{ asset('assets/testi2.jpg') }}" loading="lazy"
                    alt="" class="testimonial-image" />
                <div class="margin-left margin-small">
                    <div class="heading-small">Christian Wong</div>
                    <div class="text-size-regular orange-text">Customer</div>
                    <div class="text-size-tiny text-color-grey">I always loved the idea of helping SME's and it's products. It always gives the touch of love compared to a food cooked in a restaurant.</div>
                </div>
            </div>
            <div class="testimonial-card"><img
                    src="{{ asset('assets/testi1.jpg') }}" loading="lazy"
                    alt="" class="testimonial-image" />
                <div class="margin-left margin-small">
                    <div class="heading-small">Jennie Tan</div>
                    <div class="text-size-regular orange-text">Customer</div>
                    <div class="text-size-tiny text-color-grey">The products that I bought here always exceed all of my expectations! Loved every single purchase. ❤️</div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-top text-color-white relative">
            <div class="div-block-37"><img
                    src="{{ asset('assets/62fc7f3f35498aa012756c07_Big%20V-BW%20(Reverse)%201.png') }}"
                    loading="lazy" alt="" class="ea-left" /></div>
            <div class="align-vertical">
                <h3 class="ea-bottom">Enjoy <span class="text-color-dark-grey">200+</span> foods from<br /><span
                        class="text-color-dark-grey">30+</span> Vendors</h3>
            </div>
            <div class="flex align-vertical ea-right">
                <div class="flex flex-vertical left-align margin-small">
                    <h4>Contact Us</h4><a href="https://www.instagram.com/bigvsg.official/" target="_blank" class="text-color-white text-style-link">Instagram</a><a
                    href="https://www.facebook.com/BigVSG/" target="_blank" class="text-color-white text-style-link">Facebook</a><a href="https://www.tiktok.com/@bigvsg.official" target="_blank"
                        class="text-color-white text-style-link">Tiktok</a><a href="https://api.whatsapp.com/send?phone=6582151509" target="_blank"
                        class="text-color-white text-style-link">Whatsapp</a>
                </div>
                <div class="flex flex-vertical left-align margin-small">
                    <h4>Company</h4><a href="#" class="text-color-white text-style-link">Become a Vendor</a><a
                        href="#" class="text-color-white text-style-link">About Us</a><a href="#"
                        class="text-color-white text-style-link">Terms &amp; Conditions</a><a href="#"
                        class="text-color-white text-style-link">Privacy Policy</a>
                </div>
            </div>
        </div>
        <!-- <div class="footer-mid padding-small relative ea-bottom"><img
                src="{{ asset('assets/62fc7f3f35498a656c756c0c_Vector-4.svg') }}" loading="lazy"
                alt="" /><img src="{{ asset('assets/62fc7f3f35498ad2a7756c0a_Vector-1.svg') }}"
                loading="lazy" alt="" /><img src="{{ asset('assets/62fc7f3f35498a35b1756c0d_Vector.svg') }}"
                loading="lazy" alt="" /><img
                src="{{ asset('assets/62fc7f3f35498a83cc756c0b_Vector-3.svg') }}" loading="lazy"
                alt="" /><img src="{{ asset('assets/62fc7f3f35498ab948756c09_Vector-2.svg') }}"
                loading="lazy" alt="" /></div> -->
        <div class="footer-bottom background-color-grey text-align-center text-color-white padding-xsmall relative">
            <div>©2022 <span class="text-color-orange">BigV</span> | All Rights Reserved</div>
        </div>
    </div>
    <script src="{{ asset('assets/js/script-user-home.js') }}" type="text/javascript"></script>
    <script>
        $("#search").on('keyup', function() {
            if ($(this).val() != "") {
                $(".input__suggestions-wrapper").hide();
            } else {
                $(".input__suggestions-wrapper").show();
            }
        });

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
</body>

</html>
