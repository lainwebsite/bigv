@extends('user.template.layout')

@section('page-title')
Product Name - Big V
@endsection

@section('head-extra')
<link href="{{asset('assets/css/style-product-detail.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
@endsection

@section('content')
<?php $shareLink = "https://my.ubaya.ac.id"; ?>
<div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0" nonce="7vBOYaJD"></script>
<div class="content">
<div style="margin-bottom: 1rem;">
    <img src="{{asset('assets/6303b67a5064f05035c5a701_shape 1.svg')}}" loading="lazy" alt="" class="absolute shape-1 ea-right" />
    <div class="product-hero">
        <div class="content-col col--width-50 display-none">
            <img src="{{asset('assets/6308e8ded34a4e6728a0f147_image%2031.jpg')}}" sizes="100vw" srcset="{{asset('assets/6308e8ded34a4e6728a0f147_image%2031.jpg')}}" alt="" class="image-9 card27" />
            <img src="{{asset('assets/6308e8dff31701dadd206186_image%2032.jpg')}}" sizes="100vw" srcset="{{asset('assets/6308e8dff31701dadd206186_image%2032.jpg')}}" alt="" class="image-9 card27" />
            <img src="{{asset('assets/6308e8ded34a4e6728a0f147_image%2031.jpg')}}" sizes="100vw" srcset="{{asset('assets/6308e8ded34a4e6728a0f147_image%2031.jpg')}}" alt="" class="image-9 card27" />
        </div>
        <div id="productImage" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58-300x300.jpeg" alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58-300x300.jpeg" alt="Second slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="https://bigvsg.com/wp-content/uploads/2021/12/WhatsApp-Image-2021-12-28-at-11.47.58-300x300.jpeg" alt="Third slide">
                </div>
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
                    <h5 class="heading-4 inline text-weight-normal padding-right padding-xsmall text-color-grey">Food and Beverage</h5>
                    <h5 class="heading-4 inline text-weight-normal padding-right padding-xsmall text-color-grey"> &gt; </h5>
                    <h5 class="heading-4 inline text-weight-normal padding-right padding-xsmall text-color-grey">Chinese New Year</h5>
                    <h2 class="product-variation heading-2 text-color-grey margin-vertical margin-xsmall" variation-id="{{ $product->variations[0]->id }}">{{ count($product->variations) > 0 ? ($product->variations[0]->name == "novariation" ? $product->name : $product->variations[0]->name) : $product->name }}</h2>
                    <div class="flex" style="justify-content: space-between; gap: 10px;">
                        <div class="c-product-rating">
                            <div class="flex">
                                <div class="c-product-rating__star">
                                    <div class="icon">
                                        <div class="fas fa-star">
                                            <img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="c-product-rating__star">
                                    <div class="icon">
                                        <div class="fas fa-star">
                                            <img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="c-product-rating__star">
                                    <div class="icon">
                                        <div class="fas fa-star">
                                            <img src="{{asset('assets/Star 2.svg')}}" loading="lazy" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="c-product-rating__star">
                                    <div class="icon">
                                        <div class="fas fa-star">
                                            <img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="c-product-rating__star">
                                    <div class="icon">
                                        <div class="fas fa-star">
                                            <img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="heading-4 p-beside-star">{{ $product->rating }} (300 rating)</h5>
                            <h5 class="heading-4 p-beside-star">1.000 sold</h5>
                        </div>
                        <div class="share-dialog">
                            <header class="share-header">
                                <h3 class="dialog-title">Share Product</h3>
                                <button class="close-button share-media-button share-svg"><svg><use href="#close"></use></svg></button>
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
                                <symbol id="share-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></symbol>
                                <symbol id="facebook" viewBox="0 0 24 24" fill="#3b5998" stroke="#3b5998" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></symbol>
                                <symbol id="twitter" viewBox="0 0 24 24" fill="#1da1f2" stroke="#1da1f2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></symbol>
                                <symbol id="email" viewBox="0 0 24 24" fill="#777" stroke="#fafafa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></symbol>
                                <symbol id="linkedin" viewBox="0 0 24 24" fill="#0077B5" stroke="#0077B5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></symbol>
                                <symbol id="close" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></symbol>
                            </defs>
                        </svg>
                    </div>

                    @if ($product->variations[0]->name == "novariation") <!-- NO VARIATIONS -->
                        <h3 class="product-price heading-3 margin-vertical margin-xsmall" price="{{ $product->variations[0]->price }}" variation-id="{{ $product->variations[0]->id }}">${{ $product->variations[0]->price }}</h3>
                        <div class="div-line"></div>
                    @else <!-- VARIATIONS -->
                        <h3 class="product-price heading-3 margin-vertical margin-xsmall" min-price="{{ $minProductPrice }}" max-price="{{ $maxProductPrice }}">${{ $minProductPrice }} - ${{ $maxProductPrice }}</h3>
                        <div class="div-line"></div>
                        <h5 class="heading-4 mb-2">Variant Name</h5>
                        <div class="flex flex-wrap mb-3">
                            @foreach($product->variations as $productVariation) 
                                <button class="product-variation button-secondary-copy w-button" variation-id="{{ $productVariation->id }}" price="{{ $productVariation->price }}">{{ $productVariation->name }}</button>
                            @endforeach
                        </div>
                    @endif

                    <!-- ADDONS -->
                    @if(count($addons) > 0)
                    <div class="row">
                        @foreach($addons as $addon)
                            <div class="col-6 input-group mb-2">
                                <h5 class="heading-4 mb-2">{{ $addon->name }}</h5>
                                <select class="addons-option w-100 custom-select" name="" id="" @if($addon->required) required @endif>
                                    @foreach($addon->addons_options as $addons_option)
                                        <option price="{{ $addons_option->price }}" value="{{ $addons_option->id }}">{{ $addons_option->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                    <div class="div-line"></div>
                    @endif
                </div>
                <div data-w-id="e5486bd2-858d-5f10-525d-cc969625544d" class="product-info flex actionSectionProductDetail">
                    <div class="quantity-pill">
                        <div class="cursor-pointer quantity-change" id="subQuantity">-</div>
                        <input type="number" class="product-quantity" value="1" min="1">
                        <div class="cursor-pointer quantity-change" id="addQuantity">+</div>
                    </div>
                    <div class="upper-product-buttons">
                        @if ($product->variations[0]->name == "novariation")
                            <a href="#" class="btn-add-cart atc-product-page oh-grow w-button">Add to Cart</a>
                            <a href="#" class="btn-buy-now button-secondary oh-grow w-button">Buy Now</a>
                        @else
                            <a href="#" class="btn-add-cart btn-secondary atc-product-page oh-grow w-button">Add to Cart</a>
                            <a href="#" class="btn-buy-now btn-outline-secondary text-secondary button-secondary oh-grow w-button">Buy Now</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- VENDOR -->
<div class="product-vendor-n-info ea-up">
    <div class="div-block-8">
        <div class="vendor-product-detail" >
            <img src="{{ $product->vendor->photo }}" loading="lazy" alt="" class="image-10" />
            <div class="vendor-detail-product-detail">
                <h4 class="text-color-dark-grey">{{ $product->vendor->name }}</h4>
                <div class="text-color-grey" style="font-size: 0.8rem;">Location: <b>{{ $product->vendor->location->name }}</b></div>
                <div class="c-product-rating">
                    <div class="flex">
                        <div class="c-product-rating__star">
                            <div class="icon">
                                <div class="fas fa-star"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" /></div>
                            </div>
                        </div>
                        <div class="c-product-rating__star">
                            <div class="icon">
                                <div class="fas fa-star"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" /></div>
                            </div>
                        </div>
                        <div class="c-product-rating__star">
                            <div class="icon">
                                <div class="fas fa-star"><img src="{{asset('assets/Star 2.svg')}}" loading="lazy" alt="" /></div>
                            </div>
                        </div>
                        <div class="c-product-rating__star">
                            <div class="icon">
                                <div class="fas fa-star"><img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" /></div>
                            </div>
                        </div>
                        <div class="c-product-rating__star">
                            <div class="icon">
                                <div class="fas fa-star"><img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" /></div>
                            </div>
                        </div>
                    </div>
                    <h5 class="heading-4 p-beside-star">{{ $product->vendor->rating }} (300 rating)</h5>
                    <h5 class="heading-4 p-beside-star">1.000 sold</h5>
                </div>
            </div>
        </div>
        <a href="#" class="text-style-link margin-right div-block-7">
                <div class="text-color-grey">Visit Vendor</div>
        </a>
    </div>
    <div class="div-line"></div>
    <h4 class="text-color-grey mb-2">Product Description</h4>
    <p class="paragraph-2 text-color-grey mb-3" style="max-width: 500px;">{{ $product->description }}</p>
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
<div class="flex relative max-width-full align-center"><img src="{{asset('assets/6303b7b9afc8585f7943565c_shape 2.svg')}}" loading="lazy" alt="" class="absolute bottom-left ea-left" />
    <div class="flex top-align max-width relative">
        <div class="card27 padding-small margin-small sticky-top ea-left" id="reviewSummary">
            <h4 class="text-color-dark-grey">Reviews</h4>
            <div class="flex gap-small"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" />
                <h5 class="heading-4 p-beside-star">{{ $product->rating }}</h5>
                <h5 class="heading-4 p-beside-star">/</h5>
                <h5 class="heading-4 p-beside-star">5</h5></div>
            <h5 class="heading-4 p-beside-star">300 Rating</h5>
            <div class="div-block-16">
                <div class="flex gap-small"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" class="image-11" />
                    <h5 class="heading-4 p-beside-star text-weight-medium">5</h5>
                    <div class="div-block-10">
                        <div class="div-block-11"></div>
                    </div>
                    <h5 class="heading-4 p-beside-star text-weight-medium">121</h5></div>
                <div class="flex gap-small"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" class="image-11" />
                    <h5 class="heading-4 p-beside-star text-weight-medium">4</h5>
                    <div class="div-block-10">
                        <div class="div-block-12"></div>
                    </div>
                    <h5 class="heading-4 p-beside-star text-weight-medium">40</h5></div>
                <div class="flex gap-small"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" class="image-11" />
                    <h5 class="heading-4 p-beside-star text-weight-medium">3</h5>
                    <div class="div-block-10">
                        <div class="div-block-13"></div>
                    </div>
                    <h5 class="heading-4 p-beside-star text-weight-medium">13</h5></div>
                <div class="flex gap-small"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" class="image-11" />
                    <h5 class="heading-4 p-beside-star text-weight-medium">2</h5>
                    <div class="div-block-10">
                        <div class="div-block-14"></div>
                    </div>
                    <h5 class="heading-4 p-beside-star text-weight-medium">8</h5></div>
                <div class="flex gap-small"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" class="image-11" />
                    <h5 class="heading-4 p-beside-star text-weight-medium">1</h5>
                    <div class="div-block-10">
                        <div class="div-block-15"></div>
                    </div>
                    <h5 class="heading-4 p-beside-star text-weight-medium">2</h5></div>
            </div>
        </div>
        <div class="text-color-dark-grey ea-right">
            @for ($i = 0; $i < 10; $i++)
            <div class="card27 padding-small margin-small">
                <div class="div-block-17">
                    <h4>Chris William</h4>
                    <h5 class="heading-4 p-beside-star">29-10-2022</h5></div>
                <div class="flex">
                    <div class="c-product-rating__star">
                        <div class="icon">
                            <div class="fas fa-star"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" /></div>
                        </div>
                    </div>
                    <div class="c-product-rating__star">
                        <div class="icon">
                            <div class="fas fa-star"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" /></div>
                        </div>
                    </div>
                    <div class="c-product-rating__star">
                        <div class="icon">
                            <div class="fas fa-star"><img src="{{asset('assets/Star 2.svg')}}" loading="lazy" alt="" /></div>
                        </div>
                    </div>
                    <div class="c-product-rating__star">
                        <div class="icon">
                            <div class="fas fa-star"><img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" /></div>
                        </div>
                    </div>
                    <div class="c-product-rating__star">
                        <div class="icon">
                            <div class="fas fa-star"><img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" /></div>
                        </div>
                    </div>
                </div>
                <h5 class="heading-4 p-beside-star">300 Rating</h5>
                <div class="text-size-tiny text-color-grey">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</div>
            </div>
            @endfor
        </div>
    </div>
</div>
<div class="pagination flex justify-center margin-large">
    <a href="#" class="pagination-selected text-style-none">
        <div class="text-color-white">1</div>
    </a>
    <a href="#" class="pagination-not-selected text-style-none">
        <div class="orange-text">1</div>
    </a>
</div>
</div>
<div data-w-id="1469b1e8-77d5-4eda-0931-cc24293decef" style="-webkit-transform:translate3d(0, -100%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, -100%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, -100%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, -100%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="atc-popup">
<div class="c-product-form w-form">
    <div class="c-product-form__row">
        <div class="c-product-form__col col-sizing--grow">
            <h3 class="product-name heading-2 text-color-grey">{{ count($product->variations) > 0 ? ($product->variations[0]->name == "novariation" ? $product->name : $product->variations[0]->name) : $product->name }}</h3>
            <div class="popup-atc-price-n-star">
                @if ($product->variations[0]->name == "novariation")
                    <h4 class="product-price heading-3">${{ $product->variations[0]->price }}</h4>
                @else
                    <h4 class="product-price heading-3">${{ $minProductPrice }} - ${{ $maxProductPrice }}</h4>
                @endif
                <div class="flex">
                    <div class="c-product-rating__star">
                        <div class="icon">
                            <div class="fas fa-star"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" /></div>
                        </div>
                    </div>
                    <div class="c-product-rating__star">
                        <div class="icon">
                            <div class="fas fa-star"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" /></div>
                        </div>
                    </div>
                    <div class="c-product-rating__star">
                        <div class="icon">
                            <div class="fas fa-star"><img src="{{asset('assets/Star 2.svg')}}" loading="lazy" alt="" /></div>
                        </div>
                    </div>
                    <div class="c-product-rating__star">
                        <div class="icon">
                            <div class="fas fa-star"><img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" /></div>
                        </div>
                    </div>
                    <div class="c-product-rating__star">
                        <div class="icon">
                            <div class="fas fa-star"><img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" /></div>
                        </div>
                    </div>
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
    @for ($i=0; $i < 10; $i++)
    <a href="https://www.google.com">
        <div id="w-node-_6b6feb56-ca1c-a712-de43-c09a32981649-fac73a6b" class="product-card padding-small">
            <div class="text-rich-text text-size-small text-color-grey">Cak Har</div><img src="{{asset('assets/62fc7f0ee2b4118e2f35c5d6_image%2034.png')}}" loading="lazy" alt="" class="product-image" />
            <div class="product-card-stars"><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" class="card-stars" /><img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" class="card-stars" /><img src="{{asset('assets/Star 2.svg')}}" loading="lazy" alt="" class="card-stars" /><img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" class="card-stars" /><img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" class="card-stars" /></div>
            <div class="product-card-title text-rich-text text-size-regular text-weight-bold text-color-dark-grey">Macaroni</div>
            <div class="product-card-low-div">
                <div class="card-discount">
                    <div class="discount">50%</div>
                </div>
                <div id="w-node-_6b6feb56-ca1c-a712-de43-c09a32981656-fac73a6b" class="sale-price text-color-light-grey">$24.00</div>
                <div class="text-rich-text text-color-orange text-weight-bold">$12.00</div>
            </div>
        </div>
    </a>
    @endfor
    </div><a href="#" class="button margin-top margin-large ea-grow w-button">See More</a>
    <div data-w-id="2763fafa-9663-7a88-db5c-9d4056894d11" class="product-info"></div>
</div>
<div class="cursor">
    <div data-w-id="43814446-d33a-082e-5ffc-db029d2c2dc1" class="dot"></div>
</div>
@endsection

@section('javascript-extra')
<script src="{{asset('assets/js/script-product-detail.js')}}" type="text/javascript"></script>
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    $(".product-variation").on("click", function() {    
        if ($(this).hasClass("selected")) {
            $(this).removeClass("selected");
            $(".product-price").html("$" + $(".product-price").attr("min-price") + " - $" + $(".product-price").attr("max-price")).removeAttr("product-id");
            $(".btn-add-cart").attr("disabled", "").addClass("btn-secondary");
            $(".btn-buy-now").attr("disabled", "").addClass("btn-outline-secondary text-secondary");
        } else {
            $(".product-variation").each(function() {
                $(this).removeClass("selected");
            });

            $(this).addClass("selected");
            $(".product-price").html("$" + $(this).attr("price")).attr("variation-id", $(this).attr("variation-id"));
            $(".btn-add-cart").removeAttr("disabled").removeClass("btn-secondary");
            $(".btn-buy-now").removeAttr("disabled").removeClass("btn-outline-secondary text-secondary");
        }
    });

    $(".addons-option option").on("click", function() {
        var price = parseFloat($(".product-price").attr("price"));
        var addons_price = parseFloat($(this).attr("price"));
        
        $(".product-price").html("$"+(price + addons_price));
    });

    $(".quantity-change").on('click', function(){
        var qty = parseInt($(".product-quantity").val());
        if ($(this).attr("id") == "addQuantity"){
            $(".product-quantity").val(qty + 1);
        }
        else {
            if (qty - 1 >= 1){
                $(".product-quantity").val(qty -1);
            }
        }
    });

    @if (auth()->user() != null)
        @if (auth()->user()->role_id == 1)
            document.querySelector(".btn-add-cart").addEventListener("click", function(event) {
                event.preventDefault();

                if ($(".product-variation.selected").length > 0) {
                    $.post(url + "/user/cart", {
                        _token: CSRF_TOKEN,
                        product_variation_id: $(".product-variation.selected").attr("variation-id"),
                        quantity: $(".product-quantity").val()
                    }).done(function(data) {
                        alert(data);
                    }).fail(function(error) {
                        console.log(error);
                    });
                } else {
                    $.post(url + "/user/cart", {
                        _token: CSRF_TOKEN,
                        product_variation_id: $(".product-price").attr("variation-id"),
                        quantity: $(".product-quantity").val()
                    }).done(function(data) {
                        alert(data);
                    }).fail(function(error) {
                        console.log(error);
                    });
                }
            });
            document.querySelector(".btn-buy-now").addEventListener("click", function(event) {
                event.preventDefault();

                $.post(url + "/user/cart/verify-checkout", {
                    _token: CSRF_TOKEN,
                    carts: {},
                }).done(function(data) {
                    alert(data);
                }).fail(function(error) {
                    console.log(error);
                });
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

    $(document).on('click', "#copyLink", function(){
        navigator.permissions.query({ name: "write-on-clipboard" }).then((result) => {
            if (result.state == "granted" || result.state == "prompt") {
                alert("Write access granted!");
            }
        });
        navigator.clipboard.writeText(shareLink); //product link
        $("#copyLink").html("Link Copied");
    });
</script>
@endsection