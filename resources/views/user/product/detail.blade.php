@extends('user.template.layout')

@section('page-title')
    {{ $product->name }} - Big V
@endsection

@section('head-extra')
    <link href="{{ asset('assets/css/style-product-detail.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
@endsection

@section('content')
    @php($shareLink = url('product/' . $product->id))
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0"
        nonce="7vBOYaJD"></script>
    <div class="content">
        <div style="margin-bottom: 1rem;" class="col-12">
            <img src="{{ asset('assets/6303b67a5064f05035c5a701_shape 1.svg') }}" loading="lazy" alt=""
                class="absolute shape-1 ea-right" />
            <div class="product-hero margin-auto">
                <div class="content-col col--width-50 display-none">
                    <img src="{{ asset('uploads/' . $product->featured_image) }}" sizes="100vw"
                        srcset="{{ asset('uploads/' . $product->featured_image) }}" alt="" class="image-9 card27" />
                    @if (count($product->images) > 0)
                        @foreach ($product->images as $image)
                            <img src="{{ asset('uploads/' . $image->link) }}" sizes="100vw"
                                srcset="{{ asset('uploads/' . $image->link) }}" alt="" class="image-9 card27" />
                        @endforeach
                    @endif
                </div>
                <div id="productImage" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('uploads/' . $product->featured_image) }}" alt="Product Image"
                                class="d-block w-100 custom-image-carousel-product" />
                        </div>
                        @if (count($product->images) > 0)
                            @foreach ($product->images as $image)
                                <div class="carousel-item">
                                    <img src="{{ asset('uploads/' . $image->link) }}" alt="Product Image"
                                        class="d-block w-100 custom-image-carousel-product" />
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#productImage" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productImage" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="content-col col--width-50" id="productDetail">
                    <div class="div-block-5 ea-up">
                        <div class="product-info">
                            <h5 class="heading-4 inline text-weight-normal padding-right padding-xsmall text-color-grey">
                                {{ $product->category->name }}</h5>
                            <h5 class="heading-4 inline text-weight-normal padding-right padding-xsmall text-color-grey">
                                &gt; </h5>
                            <h5 class="heading-4 inline text-weight-normal padding-right padding-xsmall text-color-grey">
                                {{ $product->name }}</h5>
                            <h2 class="heading-2 text-color-grey margin-vertical margin-xsmall"
                                variation-id="{{ $product->variations[0]->id }}">
                                {{ $product->name }}
                            </h2>
                            <div class="flex" style="justify-content: space-between; gap: 10px;">
                                <div class="c-product-rating">
                                    <div class="flex">
                                        @php($arr_rating = explode('.', $product->rating))
                                        @php($first_num = $arr_rating[0])
                                        @while ($first_num > 0)
                                            <div class="c-product-rating__star">
                                                <div class="icon">
                                                    <div>
                                                        <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy"
                                                            alt="" />
                                                    </div>
                                                </div>
                                            </div>
                                            @php($first_num--)
                                        @endwhile

                                        @if (isset($arr_rating[1]))
                                            <div class="c-product-rating__star">
                                                <div class="icon">
                                                    <div>
                                                        <img src="{{ asset('assets/Star 2.svg') }}" loading="lazy"
                                                            alt="" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @php($remaining_rating = explode('.', 5 - $product->rating)[0])
                                        @if ($remaining_rating > 0)
                                            @while ($remaining_rating > 0)
                                                <div class="c-product-rating__star">
                                                    <div class="icon">
                                                        <div>
                                                            <img src="{{ asset('assets/Star 3.svg') }}" loading="lazy"
                                                                alt="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                @php($remaining_rating--)
                                            @endwhile
                                        @endif
                                    </div>
                                    <h5 class="heading-4 p-beside-star">{{ $product->rating }}
                                        ({{ $product->reviews_count }} rating)</h5>
                                    <h5 class="heading-4 p-beside-star">
                                        {{ $product->items_sold == null ? '0' : $product->items_sold }} sold</h5>
                                </div>
                                <div class="share-dialog">
                                    <header class="share-header">
                                        <h3 class="dialog-title">Share Product</h3>
                                        <button class="close-button share-media-button share-svg"><svg>
                                                <use href="#close"></use>
                                            </svg></button>
                                    </header>
                                    <div class="link">
                                        <div id="shareLink" class="pen-url"><?= $shareLink ?></div>
                                        <button class="copy-link share-media-button" id="copyLink">Copy Link</button>
                                    </div>
                                </div>
                                <button class="share-button" type="button" title="Share this product">
                                    <svg class="share-btn-svg">
                                        <use href="#share-icon"></use>
                                    </svg>
                                    <span class="small">Share</span>
                                </button>
                                <svg class="hidden">
                                    <defs>
                                        <symbol id="share-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-share">
                                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                            <polyline points="16 6 12 2 8 6"></polyline>
                                            <line x1="12" y1="2" x2="12" y2="15"></line>
                                        </symbol>
                                        <symbol id="facebook" viewBox="0 0 24 24" fill="#3b5998" stroke="#3b5998"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-facebook">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                            </path>
                                        </symbol>
                                        <symbol id="twitter" viewBox="0 0 24 24" fill="#1da1f2" stroke="#1da1f2"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-twitter">
                                            <path
                                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                            </path>
                                        </symbol>
                                        <symbol id="email" viewBox="0 0 24 24" fill="#777" stroke="#fafafa"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-mail">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                            </path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </symbol>
                                        <symbol id="linkedin" viewBox="0 0 24 24" fill="#0077B5" stroke="#0077B5"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-linkedin">
                                            <path
                                                d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                            </path>
                                            <rect x="2" y="9" width="4" height="12"></rect>
                                            <circle cx="4" cy="4" r="2"></circle>
                                        </symbol>
                                        <symbol id="close" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-x-square">
                                            <rect x="3" y="3" width="18" height="18"
                                                rx="2" ry="2"></rect>
                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                        </symbol>
                                    </defs>
                                </svg>
                            </div>

                            @php($now = \Carbon\Carbon::now())


                            @if ($product->variations[0]->name == 'novariation')
                                <!--NO VARIATIONS -->
                                @if ($product->variations[0]->discount > 0 && 
                                     $now->format("Y-m-d H:i:s") >= $product->variations[0]->discount_start_date &&
                                     $now->format("Y-m-d H:i:s") < $product->variations[0]->discount_end_date)
                                    <h3 class="sale-price-detail heading-3 text-color-light-grey margin-vertical margin-xsmall">
                                        ${{ number_format($product->variations[0]->price, 2, ".", ",") }}</h3>
                                    <h3 class="product-price heading-3 margin-vertical margin-xsmall"
                                        price="${{ $product->variations[0]->discount }}"
                                        variation-id="{{ $product->variations[0]->id }}" style="display: inline-block;">
                                        ${{ number_format($product->variations[0]->discount, 2, ".", ",") }}</h3>
                                    <div class="div-line"></div>
                                @else
                                    <h3 class="product-price heading-3 margin-vertical margin-xsmall"
                                        price="{{ $product->variations[0]->price }}"
                                        variation-id="{{ $product->variations[0]->id }}" style="display: inline-block;">
                                        ${{ number_format($product->variations[0]->price, 2, ".", ",") }}</h3>
                                    <div class="div-line"></div>
                                @endif
                            @else
                                <!--VARIATIONS -->
                                <h3 class="sale-price-detail heading-3 text-color-light-grey margin-vertical margin-xsmall"
                                    style="display: none;">$0</h3>
                                <h3 class="product-price heading-3 margin-vertical margin-xsmall"
                                    min-price="{{ $minProductPrice }}" max-price="{{ $maxProductPrice }}"
                                    style="display: inline-block;">
                                    ${{ number_format($minProductPrice, 2, ".", ",") }} - ${{ number_format($maxProductPrice, 2, ".", ",") }}</h3>
                                <div class="div-line"></div>
                                <h5 class="heading-4 mb-2">{{ ucwords($product->variation_name) }}</h5>
                                <div class="flex flex-wrap mb-3">
                                    @foreach ($product->variations as $productVariation)
                                        <button class="product-variation button-secondary-copy w-button"
                                            variation-id="{{ $productVariation->id }}"
                                            price="{{ $productVariation->price }}"
                                            @if ($productVariation->discount > 0 && 
                                                 $now->format("Y-m-d H:i:s") >= $product->variations[0]->discount_start_date &&
                                                 $now->format("Y-m-d H:i:s") < $product->variations[0]->discount_end_date) after-sale-price="{{ $productVariation->discount }}" @endif>{{ $productVariation->name }}</button>
                                    @endforeach
                                </div>
                            @endif

                            <!-- ADDONS -->
                            @if (count($addons) > 0)
                                <div class="row">
                                    @foreach ($addons as $addon)
                                        <div class="col-6 input-group mb-2">
                                            <h5 class="heading-4 mb-2">{{ $addon->name }}</h5>
                                            <select class="addons-option w-100 custom-select" name=""
                                                id="" @if ($addon->required) required @endif>
                                                @foreach ($addon->addons_options as $addons_option)
                                                    <option price="{{ $addons_option->price }}"
                                                        value="{{ $addons_option->id }}">{{ $addons_option->name }}
                                                        (${{ number_format($addons_option->price, 2, ".", ",") }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="div-line"></div>
                            @endif
                        </div>
                        <div data-w-id="e5486bd2-858d-5f10-525d-cc969625544d"
                            class="product-info flex actionSectionProductDetail">
                            <div class="quantity-pill">
                                <div class="cursor-pointer quantity-change" id="subQuantity">-</div>
                                <input type="number" class="product-quantity" value="1" min="1">
                                <div class="cursor-pointer quantity-change" id="addQuantity">+</div>
                            </div>
                            <div class="upper-product-buttons">
                                @auth
                                    @if ($product->variations[0]->name == 'novariation')
                                        <a href="#" class="btn-add-cart atc-product-page oh-grow w-button">Add to
                                            Cart</a>
                                        <form method="POST" action="{{ url('user/cart/checkout/buy-now') }}">
                                            @csrf
        
                                            <input id="productVariationId" type="hidden" name="product_variation_id">
                                            <input id="productAddonsId" type="hidden" name="product_addons_id">
                                            <input id="quantity" type="hidden" name="quantity">
                                            <button type="submit" class="btn-buy-now button-secondary oh-grow w-button"
                                                style="width: 100%;">Buy
                                                Now</button>
                                        </form>
                                    @else
                                        <a href="#" class="btn-add-cart btn-secondary atc-product-page oh-grow w-button">Add to
                                            Cart</a>
                                        <form method="POST" action="{{ url('user/cart/checkout/buy-now') }}">
                                            @csrf
        
                                            <input id="productVariationId" type="hidden" name="product_variation_id">
                                            <input id="productAddonsId" type="hidden" name="product_addons_id">
                                            <input id="quantity" type="hidden" name="quantity">
                                            <button type="submit" class="btn-buy-now button-secondary text-secondary oh-grow w-button"
                                                style="width: 100%;">Buy
                                                Now</button>
                                        </form>
                                    @endif
                                @else
                                    <a href="#"
                                        class="btn-add-cart atc-product-page oh-grow w-button">Add to
                                        Cart</a>
                                    <a href="#"
                                        class="btn-buy-now button-secondary oh-grow w-button">Buy
                                        Now</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- VENDOR -->
        <div class="product-vendor-n-info ea-up" style="width: 90%;">
            <div class="div-block-8">
                <div class="vendor-product-detail">
                    <img src="{{ asset('uploads/' . $product->vendor->photo) }}" loading="lazy" alt=""
                        class="image-10" />
                    <div class="vendor-detail-product-detail">
                        <h4 class="text-color-dark-grey">{{ $product->vendor->name }}</h4>
                        <div class="text-color-grey" style="font-size: 0.8rem;">Location:
                            <b>{{ $product->vendor->location->name }}</b>
                        </div>
                        <div class="c-product-rating">
                            <div class="flex">
                                @php($arr_rating = explode('.', $product->vendor->rating))
                                @php($first_num = $arr_rating[0])
                                @while ($first_num > 0)
                                    <div class="c-product-rating__star">
                                        <div class="icon">
                                            <div>
                                                <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy"
                                                    alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    @php($first_num--)
                                @endwhile

                                @if (isset($arr_rating[1]))
                                    <div class="c-product-rating__star">
                                        <div class="icon">
                                            <div>
                                                <img src="{{ asset('assets/Star 2.svg') }}" loading="lazy"
                                                    alt="" />
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @php($remaining_rating = explode('.', 5 - $product->vendor->rating)[0])
                                @if ($remaining_rating > 0)
                                    @while ($remaining_rating > 0)
                                        <div class="c-product-rating__star">
                                            <div class="icon">
                                                <div>
                                                    <img src="{{ asset('assets/Star 3.svg') }}" loading="lazy"
                                                        alt="" />
                                                </div>
                                            </div>
                                        </div>
                                        @php($remaining_rating--)
                                    @endwhile
                                @endif
                            </div>
                            <h5 class="heading-4 p-beside-star">{{ $product->vendor->rating }}
                                ({{ $product->reviews_count }} rating)</h5>
                        </div>
                    </div>
                </div>
                <a href="{{ url('vendors/' . $product->vendor->id) }}" class="text-style-link margin-right div-block-7">
                    <div class="text-color-grey">Visit Vendor</div>
                </a>
            </div>
            <div class="div-line"></div>
            <h4 class="text-color-grey mb-2">Product Description</h4>
            <p class="paragraph-2 text-color-grey mb-3">{{ htmlspecialchars_decode($product->description) }}</p>
            {{-- <div class="div-block-9">
        <div id="w-node-_274f20e5-cf76-d21b-b2d2-1fb0375edc27-fac73a6b">
            <h4 class="text-color-grey mb-2">Additional Information</h4>
            <div class="paragraph-2 text-color-grey">Information: Cute Tiger Aroma Stone Set come with special essential oil blend 2ml
                <br/>Product Ingredient: “Handcraft grade plaster powder, Dried flowers, Aromatherapy grade essential oil, Aromatherapy grade base oil”
                <br/>The product images shown are for illustration purposes only and may not be an exact representation of the product.</div>
        </div>
        <div id="w-node-_84a64200-c92a-b6c2-6879-3576d907de5e-fac73a6b">
            <h4 class="text-color-grey mb-2">Shipping &amp; Delivery</h4>
            <div class="paragraph-2 text-color-grey">$10 island wide delivery except off-shore islands
                <br/>Delivery only starts from 1 week from purchase date
                <br/>Delivery time from 11am – 9pm
                <br/>No deliveries available during Sunday and PH</div>
        </div>
    </div> --}}
        </div>
        <!-- END VENDOR -->
        <!-- REVIEW -->
        <div class="flex relative max-width-full align-center"><img
                src="{{ asset('assets/6303b7b9afc8585f7943565c_shape 2.svg') }}" loading="lazy" alt=""
                class="absolute bottom-left ea-left" style="z-index: -2;" />
            <div class="row top-align max-width relative">
                <div class="col-md-3 col-12">
                    <div class="card27 padding-small margin-small sticky-top ea-left" style="width: calc(100% - 2rem);" id="reviewSummary">
                    <h4 class="text-color-dark-grey">Reviews</h4>
                    <div class="flex gap-small"><img src="{{ asset('assets/Star 1.svg') }}" loading="lazy"
                            alt="" />
                        <h5 class="heading-4 p-beside-star">{{ $product->rating }}</h5>
                        <h5 class="heading-4 p-beside-star">/</h5>
                        <h5 class="heading-4 p-beside-star">5</h5>
                    </div>
                    <h5 class="heading-4 p-beside-star">{{ $product->reviews_count }} Rating</h5>
                    <div class="div-block-16">
                        <div class="flex gap-small">
                            <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy" alt=""
                                class="image-11" />
                            <h5 class="heading-4 p-beside-star text-weight-medium">5</h5>
                            <div class="div-block-10">
                                <div class="div-block-11"
                                    style="width: {{ ($product->reviews->count() > 0) ? $product->reviews->where('rating', 5)->count() / $product->reviews->count() * 100 : 0 }}%;">
                                </div>
                            </div>
                            <h5 class="heading-4 p-beside-star text-weight-medium">
                                {{ $product->reviews->where('rating', 5)->count() }}</h5>
                        </div>
                        <div class="flex gap-small"><img src="{{ asset('assets/Star 1.svg') }}" loading="lazy"
                                alt="" class="image-11" />
                            <h5 class="heading-4 p-beside-star text-weight-medium">4</h5>
                            <div class="div-block-10">
                                <div class="div-block-12"
                                    style="width: {{ ($product->reviews->count() > 0) ? $product->reviews->where('rating', '<', 5)->where('rating', '>=', 4)->count() / $product->reviews->count() * 100 : 0 }}%;">
                                </div>
                            </div>
                            <h5 class="heading-4 p-beside-star text-weight-medium">
                                {{ $product->reviews->where('rating', '<', 5)->where('rating', '>=', 4)->count() }}</h5>
                        </div>
                        <div class="flex gap-small"><img src="{{ asset('assets/Star 1.svg') }}" loading="lazy"
                                alt="" class="image-11" />
                            <h5 class="heading-4 p-beside-star text-weight-medium">3</h5>
                            <div class="div-block-10">
                                <div class="div-block-13"
                                    style="width: {{ ($product->reviews->count() > 0) ? $product->reviews->where('rating', '<', 4)->where('rating', '>=', 3)->count() / $product->reviews->count() * 100 : 0 }}%;">
                                </div>
                            </div>
                            <h5 class="heading-4 p-beside-star text-weight-medium">
                                {{ $product->reviews->where('rating', '<', 4)->where('rating', '>=', 3)->count() }}</h5>
                        </div>
                        <div class="flex gap-small"><img src="{{ asset('assets/Star 1.svg') }}" loading="lazy"
                                alt="" class="image-11" />
                            <h5 class="heading-4 p-beside-star text-weight-medium">2</h5>
                            <div class="div-block-10">
                                <div class="div-block-14"
                                    style="width: {{ ($product->reviews->count() > 0) ? $product->reviews->where('rating', '<', 3)->where('rating', '>=', 2)->count() / $product->reviews->count() * 100 : 0 }}%;">
                                </div>
                            </div>
                            <h5 class="heading-4 p-beside-star text-weight-medium">
                                {{ $product->reviews->where('rating', '<', 3)->where('rating', '>=', 2)->count() }}</h5>
                        </div>
                        <div class="flex gap-small"><img src="{{ asset('assets/Star 1.svg') }}" loading="lazy"
                                alt="" class="image-11" />
                            <h5 class="heading-4 p-beside-star text-weight-medium">1</h5>
                            <div class="div-block-10">
                                <div class="div-block-15"
                                    style="width: {{ ($product->reviews->count() > 0) ? $product->reviews->where('rating', '<', 2)->count() / $product->reviews->count() * 100 : 0 }}%;">
                                </div>
                            </div>
                            <h5 class="heading-4 p-beside-star text-weight-medium">
                                {{ $product->reviews->where('rating', '<', 2)->count() }}</h5>
                        </div>
                    </div>
                </div>
                </div>
                <div class="text-color-dark-grey ea-right col-md-9 col-12" style="width: 100%;">
                    @foreach ($product->reviews as $productReview)
                        <div class="card28 row padding-small margin-small m-3" style="width: calc(100% - 2rem) !important;">
                            @if($productReview->images->count() > 0)
                            <div class="col-md-3 col-6">
                                <div id="reviewImage{{ $productReview->id }}" class="carousel slide"
                                    data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($productReview->images as $reviewImage)
                                            <div @class(['carousel-item', 'active' => $loop->iteration == 1]) class="carousel-item active">
                                                <img class="d-block custom-image-carousel-review"
                                                    src="{{ asset('uploads' . '/' . $reviewImage->link) }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#reviewImage{{ $productReview->id }}"
                                        role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#reviewImage{{ $productReview->id }}"
                                        role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9 col-12">
                            @else
                            <div class="col-12">
                            @endif
                                <div class="div-block-17">
                                    <h4>{{ $productReview->user->name }}</h4>
                                    <h5 class="heading-4 p-beside-star">
                                        {{ date('d-m-Y', strtotime($productReview->created_at)) }}</h5>
                                </div>
                                <div class="flex">
                                    <div class="c-product-rating__star">
                                        <div class="icon">
                                            <div>
                                                @if ($productReview->rating >= 1)
                                                    <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy"
                                                        alt="" />
                                                @elseif($productReview->rating >= 0.5)
                                                    <img src="{{ asset('assets/Star 2.svg') }}" loading="lazy"
                                                        alt="" />
                                                @else
                                                    <img src="{{ asset('assets/Star 3.svg') }}" loading="lazy"
                                                        alt="" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-product-rating__star">
                                        <div class="icon">
                                            <div>
                                                @if ($productReview->rating >= 2)
                                                    <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy"
                                                        alt="" />
                                                @elseif($productReview->rating >= 1.5)
                                                    <img src="{{ asset('assets/Star 2.svg') }}" loading="lazy"
                                                        alt="" />
                                                @else
                                                    <img src="{{ asset('assets/Star 3.svg') }}" loading="lazy"
                                                        alt="" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-product-rating__star">
                                        <div class="icon">
                                            <div>
                                                @if ($productReview->rating >= 3)
                                                    <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy"
                                                        alt="" />
                                                @elseif($productReview->rating >= 2.5)
                                                    <img src="{{ asset('assets/Star 2.svg') }}" loading="lazy"
                                                        alt="" />
                                                @else
                                                    <img src="{{ asset('assets/Star 3.svg') }}" loading="lazy"
                                                        alt="" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-product-rating__star">
                                        <div class="icon">
                                            <div>
                                                @if ($productReview->rating >= 4)
                                                    <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy"
                                                        alt="" />
                                                @elseif($productReview->rating >= 3.5)
                                                    <img src="{{ asset('assets/Star 2.svg') }}" loading="lazy"
                                                        alt="" />
                                                @else
                                                    <img src="{{ asset('assets/Star 3.svg') }}" loading="lazy"
                                                        alt="" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-product-rating__star">
                                        <div class="icon">
                                            <div>
                                                @if ($productReview->rating >= 5)
                                                    <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy"
                                                        alt="" />
                                                @elseif($productReview->rating >= 4.5)
                                                    <img src="{{ asset('assets/Star 2.svg') }}" loading="lazy"
                                                        alt="" />
                                                @else
                                                    <img src="{{ asset('assets/Star 3.svg') }}" loading="lazy"
                                                        alt="" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="heading-4 p-beside-star">{{ $productReview->user->reviews->count() }} Rating
                                </h5>
                                <div class="text-size-tiny text-color-grey">{{ $productReview->description }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            {!! $product->reviews->render() !!}
        </div>
    </div>
    <div data-w-id="1469b1e8-77d5-4eda-0931-cc24293decef"
        style="-webkit-transform:translate3d(0, -100%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, -100%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, -100%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, -100%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
        class="atc-popup">
        <div class="c-product-form w-form">
            <div class="c-product-form__row">
                <div class="c-product-form__col col-sizing--grow">
                    <h3 class="product-name heading-2 text-color-grey">
                        {{ $product->name }}
                    </h3>
                    <div class="popup-atc-price-n-star">
                        @if ($product->variations[0]->name == 'novariation')
                            @if ($product->variations[0]->discount > 0 && 
                                 $now->format("Y-m-d H:i:s") >= $product->variations[0]->discount_start_date &&
                                 $now->format("Y-m-d H:i:s") < $product->variations[0]->discount_end_date)
                                <h4 class="sale-price-detail product-price heading-3 text-color-light-grey">${{ number_format($product->variations[0]->price, 2, ".", ",") }}</h4>
                                <h4 class="product-price heading-3">${{ number_format($product->variations[0]->discount, 2, ".", ",") }}</h4>
                            @else
                                <h4 class="product-price heading-3">${{ number_format($product->variations[0]->price, 2, ".", ",") }}</h4>
                            @endif
                        @else
                            <h4 class="product-price heading-3">${{ number_format($minProductPrice, 2, ".", ",") }} - ${{ number_format($maxProductPrice, 2, ".", ",") }}</h4>
                        @endif
                        <div class="flex">
                            @php($arr_rating = explode('.', $product->rating))
                            @php($first_num = $arr_rating[0])
                            @while ($first_num > 0)
                                <div class="c-product-rating__star">
                                    <div class="icon">
                                        <div>
                                            <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy" alt="" />
                                        </div>
                                    </div>
                                </div>
                                @php($first_num--)
                            @endwhile

                            @if (isset($arr_rating[1]))
                                <div class="c-product-rating__star">
                                    <div class="icon">
                                        <div>
                                            <img src="{{ asset('assets/Star 2.svg') }}" loading="lazy" alt="" />
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @php($remaining_rating = explode('.', 5 - $product->rating)[0])
                            @if ($remaining_rating > 0)
                                @while ($remaining_rating > 0)
                                    <div class="c-product-rating__star">
                                        <div class="icon">
                                            <div>
                                                <img src="{{ asset('assets/Star 3.svg') }}" loading="lazy"
                                                    alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    @php($remaining_rating--)
                                @endwhile
                            @endif
                        </div>
                    </div>
                </div>
                <div class="c-product-form__col">
                    <a href="#productDetail" class="button-3 button-size--small oh-jiggle w-inline-block">
                        <div class="text-color-white">Add to Your Cart</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="new-products-section padding-xxlarge ea-fade">
        <div class="heading-large text-align-center margin-bottom margin-large">Suggested Products</div>
        <div class="products-archive-grid margin-auto">
            @php(date_default_timezone_set('Asia/Singapore'))
            @php($dateNow = new DateTime(date('Y-m-d H:i:s')))
            @foreach ($productSuggestion as $product)
                <a href="{{ route('product.show', $product->id) }}" class="text-style-none">
                    <div id="w-node-_98aa59c7-5c20-8fcb-852c-972bad093e75-fac73a6c" class="product-card padding-small">
                        <div class="text-rich-text text-size-small text-color-grey">{{ $product->vendor->name }}</div>
                        <img src="{{ asset('uploads/' . $product->featured_image) }}" loading="lazy" alt=""
                            class="product-image" />
                        <div class="product-card-stars">
                            @php($arr_rating = explode('.', $product->rating))
                            @php($first_num = $arr_rating[0])
                            @while ($first_num > 0)
                                <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy" alt=""
                                    class="card-stars" />
                                @php($first_num--)
                            @endwhile

                            @if (isset($arr_rating[1]))
                                <img src="{{ asset('assets/Star 2.svg') }}" loading="lazy" alt=""
                                    class="card-stars" />
                            @endif

                            @php($remaining_rating = explode('.', 5 - $product->rating)[0])
                            @if ($remaining_rating > 0)
                                @while ($remaining_rating > 0)
                                    <img src="{{ asset('assets/Star 3.svg') }}" loading="lazy" alt=""
                                        class="card-stars" />
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
                                
                                <div class="text-rich-text text-color-orange text-weight-bold" style="padding: 0.25em; white-space:nowrap;">
                                                ${{ number_format($product->variations->min('price'), 2, ".", ",") }} - ${{ number_format($product->variations->max('price'), 2, ".", ",") }}
                                            </div>
                            @endif
                    </div>
                </div>
            </a>
        @endforeach
    </div><a href="{{ url('product') }}" class="button margin-top margin-large ea-grow w-button">See More</a>
    <div data-w-id="2763fafa-9663-7a88-db5c-9d4056894d11" class="product-info"></div>
</div>
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/js/script-product-detail.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script>
        function calculatePrice() {
            var price = parseFloat($(".product-price").attr("price"));
            
            if ($(".product-variation").length > 0) {
                if (($(".product-variation.selected").length > 0)){
                    if ($(".product-variation").is(".selected")) {
                        if ($(".product-variation.selected").attr("after-sale-price") != undefined) {
                            price = parseFloat($(".product-variation.selected").attr("after-sale-price"));
                        } else {
                            price = parseFloat($(".product-variation.selected").attr("price"));
                        }
                    } else {
                        price = parseFloat($(".product-variation.selected").attr("price"));
                    }
                }
                else {
                    price = parseFloat($(".product-price").attr("min-price")).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + " - $" + 
                            parseFloat($(".product-price").attr("max-price")).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
                    return price;
                }
            }
            
            if (price != undefined && $(".addons-option").length > 0) {
                var total_normal_price = ($(".product-variation.selected").attr("after-sale-price") != undefined) ?
                    parseFloat($(".product-variation.selected").attr("price")) : 0;
                $(".addons-option option:selected").each(function() {
                    if ($(".product-variation.selected").attr("after-sale-price") != undefined) {
                        total_normal_price += parseFloat($(this).attr("price"));
                    }
                    price += parseFloat($(this).attr("price"));
                });
    
                if ($(".product-variation.selected").attr("after-sale-price") != undefined) {
                    $(".sale-price-detail").html("$" + total_normal_price.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
                }
            }
    
            return price.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
        }

        $(".product-variation").on("click", function() {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
                $(".product-price").html("$" + parseFloat($(".product-price").attr("min-price")).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + 
                                        " - $" + parseFloat($(".product-price").attr("max-price")).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')).removeAttr("product-id");
                $(".btn-add-cart").attr("disabled", "").addClass("btn-secondary");
                $(".btn-buy-now").attr("disabled", "").addClass("btn-outline-secondary text-secondary");
                $(".sale-price-detail").css("display", "none");
            } else {
                $(".product-variation").each(function() {
                    $(this).removeClass("selected");
                });
    
                $(this).addClass("selected");
                if ($(this).attr("after-sale-price") != undefined) {
                    $(".sale-price-detail").css("display", "").html("$" + $(this).attr("price"));
                    $(".product-price").html("$" + calculatePrice()).attr("variation-id", $(this).attr(
                        "variation-id"));
                } else {
                    $(".sale-price-detail").css("display", "none").html(0);
                    $(".product-price").html("$" + calculatePrice()).attr("variation-id", $(this).attr(
                        "variation-id"));
                }
                $(".btn-add-cart").removeAttr("disabled").removeClass("btn-secondary");
                $(".btn-buy-now").removeAttr("disabled").removeClass("btn-outline-secondary text-secondary");
            }
        });
    
        $(document).on('change', '.addons-option', function(){
            $(".product-price").html("$" + calculatePrice());
        });
    
    
        $(".quantity-change").on('click', function() {
            var qty = parseInt($(".product-quantity").val());
            if ($(this).attr("id") == "addQuantity") {
                $(".product-quantity").val(qty + 1);
            } else {
                if (qty - 1 >= 1) {
                    $(".product-quantity").val(qty - 1);
                }
            }
        });
    
        @if (auth()->user() != null)
            @if (auth()->user()->role_id == 1)
                $(document).on("click", ".btn-add-cart", function(event) {
                    event.preventDefault();
                    
                    var product_variation_id = ($(".product-variation.selected").length > 0) ?
                        $(".product-variation.selected").attr("variation-id") : $(".product-price").attr(
                            "variation-id");
                    var product_addons_id = [];
                    $(".addons-option").each(function() {
                        if ($(this).val() > 0) {
                            product_addons_id.push($(this).val());
                        }
                    });
                    
                    if ($(".product-variation").length > 0) {
                        if ($(".product-variation.selected").length > 0) {
                            $.post(url + "/user/cart", {
                                _token: CSRF_TOKEN,
                                product_variation_id: product_variation_id,
                                product_addons_id: product_addons_id,
                                quantity: $(".product-quantity").val()
                            }).done(function(data) {
                                alert(data);
                            }).fail(function(error) {
                                console.log(error);
                            });
                        } else {
                            alert("Please select one of variation product first!");
                        }
                    } else {
                        if ($(".product-price").attr("price") != undefined) {
                            $.post(url + "/user/cart", {
                                _token: CSRF_TOKEN,
                                product_variation_id: $(".product-price").attr("variation-id"),
                                product_addons_id: product_addons_id,
                                quantity: $(".product-quantity").val()
                            }).done(function(data) {
                                alert(data);
                            }).fail(function(error) {
                                console.log(error);
                            });
                        }
                    }
                });

                $(document).on("click", ".btn-buy-now", function(e) {
                    e.preventDefault();
                    var product_variation_id = ($(".product-variation.selected").length > 0) ?
                        $(".product-variation.selected").attr("variation-id") : $(".product-price").attr(
                            "variation-id");
                    var product_addons_id = [];
                    $(".addons-option").each(function() {
                        if ($(this).val() > 0) {
                            product_addons_id.push($(this).val());
                        }
                    });

                    if (($(".product-variation").length > 0 && 
                        $(".product-variation.selected").length > 0) ||
                        $(".product-price").attr("price") != undefined) 
                    {
                        $("#productVariationId").val(product_variation_id);
                        $("#productAddonsId").val(JSON.stringify(product_addons_id));
                        $("#quantity").val($(".product-quantity").val());
                        $("form").submit();
                    }
                });
            @endif
        @else
            $(".btn-add-cart, .btn-buy-now").attr("href", "{{ route('login') }}");
        @endif
    
        var shareLink = "<?= $shareLink ?>";
    
        const shareButton = document.querySelector('.share-button');
        const shareDialog = document.querySelector('.share-dialog');
        const closeButton = document.querySelector('.close-button');
    
        shareButton.addEventListener('click', event => {
            if (navigator.share) {
                navigator.share({
                        title: 'Big V - Share Product',
                        url: shareLink // product link
                    }).then(() => {
                        console.log('Thanks for sharing!');
                    })
                    .catch(console.error);
            } else {
                shareDialog.classList.add('is-open');
            }
        });
    
        closeButton.addEventListener('click', event => {
            shareDialog.classList.remove('is-open');
        });
    
        $(document).on('click', "#copyLink", function() {
            navigator.permissions.query({
                name: "write-on-clipboard"
            }).then((result) => {
                if (result.state == "granted" || result.state == "prompt") {
                    alert("Write access granted!");
                }
            });
            navigator.clipboard.writeText(shareLink); //product link
            $("#copyLink").html("Link Copied");
        });
    </script>
@endsection
