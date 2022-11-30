@extends('user.template.layout')

@section('page-title')
    Vendor - Big V
@endsection

@section('head-extra')
    <link href="{{ asset('assets/css/style-product-list.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="content" style="width: 100vw; min-width: 0 !important; max-width: 1200px; margin:auto auto 20vh auto;">
        <div class="vendor-details row" style="gap:0 !important; margin: 0 !important; width: 100%;">
            <div class="vendor-left-column col-sm-12 col-md-4 mb-4 ">
                <div class="w-100 d-flex justify-content-center">
                    <img src="{{ asset($vendor->photo) }}" class="w-100" style="max-width:300px; border-radius: 27px;"
                        alt="">
                </div>
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="pricing-content">
                    <div class="tagline"><strong>Location</strong>: {{ $vendor->location->name }}</div>
                    <div class="pricing-info">
                        <h3 class="orange-text">{{ $vendor->name }}</h3>
                    </div>
                    <div class="pricing-divider-two"></div>
                    <div class="pricing-details">
                        <div class="pricing-block">
                            <p class="pricing-details-text">Transactions</p>
                            <p class="tagline">{{ $vendor->items_sold }}</p>
                        </div>
                        <div class="pricing-block">
                            <p class="pricing-details-text">Rating</p>
                            <div class="product-card-stars">
                                @php($arr_rating = explode('.', $vendor->rating))
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

                                @php($remaining_rating = explode('.', 5 - $vendor->rating)[0])
                                @if ($remaining_rating > 0)
                                    @while ($remaining_rating > 0)
                                        <img src="{{ asset('assets/Star 3.svg') }}" loading="lazy" alt=""
                                            class="card-stars" />
                                        @php($remaining_rating--)
                                    @endwhile
                                @endif
                            </div>
                            <p class="tagline">{{ $vendor->rating }}</p>
                        </div>
                        <div class="pricing-block">
                            <p class="pricing-details-text">Products</p>
                            <p class="tagline">{{ $vendor->products->count() }} products</p>
                        </div>
                    </div>
                    <p>{{ $vendor->description }}</p>
                </div>
            </div>
        </div>
        <div style="display:flex; flex-direction: column; align-items:center;width: calc(100% - 288px);">
            <div class="products-archive-grid" id="productsList">
                @foreach ($products as $product)
                    <a href="{{ route('product.show', $product->id) }}" class="text-style-none">
                        <div id="w-node-_98aa59c7-5c20-8fcb-852c-972bad093e75-fac73a6c" class="product-card padding-small">
                            <div class="text-rich-text text-size-small text-color-grey">{{ $product->vendor->name }}</div>
                            <img src="{{ asset($product->featured_image) }}" loading="lazy" alt=""
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
                                @if ($product->variations[0]->name == 'novariation')
                                    @if ($product->variations[0]->discount != 0)
                                        <div class="card-discount">
                                            <div class="discount">{{ $product->variations[0]->discount }}%</div>
                                        </div>
                                    @endif

                                    @if (count($product->variations) > 1)
                                        <div class="text-rich-text text-color-orange text-weight-bold"
                                            style="padding: 0.25em;">
                                            ${{ $product->variations->min('price') }} -
                                            ${{ $product->variations->max('price') }}
                                        </div>
                                    @else
                                        <div id="w-node-_98aa59c7-5c20-8fcb-852c-972bad093e85-fac73a6c"
                                            class="sale-price text-color-light-grey" style="padding: 0.25em;">
                                            ${{ $product->variations[0]->price }}</div>
                                        <div class="text-rich-text text-color-orange text-weight-bold"
                                            style="padding: 0.25em;">
                                            ${{ $product->variations[0]->price - $product->variations[0]->discount }}</div>
                                    @endif
                                @else
                                    @if (count($product->variations) > 1)
                                        <div class="text-rich-text text-color-orange text-weight-bold"
                                            style="padding: 0.25em;">
                                            ${{ $product->variations->min('price') }} -
                                            ${{ $product->variations->max('price') }}
                                        </div>
                                    @else
                                        <div class="text-rich-text text-color-orange text-weight-bold"
                                            style="padding: 0.25em;">
                                            ${{ $product->variations[0]->name == 'novariation' ? $product->variations[0]->price : '' }}
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            {{ $products->links() }}
        </div>
    </div>
    <div class="cursor">
        <div data-w-id="f4b78bbc-ea93-bb5a-a490-cac406bb401d" class="dot"></div>
    </div>
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/js/script-product-list.js') }}" type="text/javascript"></script>
@endsection
