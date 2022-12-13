@extends('user.template.layout')

@section('page-title')
    Vendor - Big V
@endsection

@section('head-extra')
    <link href="{{ asset('assets/css/style-product-list.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content" style="width: 100vw; min-width: 0 !important; max-width: 1200px; margin:auto;">
        <div class="flex flex-vertical row-gap margin-large" style="width: 85%; min-width: 980px; position:relative;">
            <div class="text-align-center orange-text">Showing result for</div>
            <h3 class="text-align-center">All Vendor</h3>
        </div>
        <div>
            <div class="flex flex-center top-align relative archive-flex"
                style="width: 100vw; min-width: 0 !important; max-width: 1200px; margin:auto auto 15vh auto;">
                <div style="display:flex; flex-direction: column; align-items:center;width: calc(100% - 288px);">
                    <div class="products-archive-grid" id="productsList" style="margin-bottom: 8vh;">
                        @foreach ($vendors as $vendor)
                            <a href="{{ url('vendors/' . $vendor->id) }}" class="text-style-none">
                                <div id="w-node-_98aa59c7-5c20-8fcb-852c-972bad093e75-fac73a6c"
                                    class="product-card padding-small">
                                    <div class="text-rich-text text-size-small text-color-grey">
                                        {{ $vendor->location->name }}</div><img src="{{ asset('uploads/'.$vendor->photo) }}"
                                        loading="lazy" alt="" class="product-image" />
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
                                    <div
                                        class="product-card-title text-rich-text text-size-regular text-weight-bold text-color-dark-grey text-center text-truncate">
                                        {{ $vendor->name }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    {{ $vendors->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/js/script-product-list.js') }}" type="text/javascript"></script>
@endsection
