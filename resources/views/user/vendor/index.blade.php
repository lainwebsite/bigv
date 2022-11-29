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
                style="width: 100vw; min-width: 0 !important; max-width: 1200px; margin:auto;">
                <div style="display:flex; flex-direction: column; align-items:center;width: calc(100% - 288px);">
                    <div class="products-archive-grid" id="productsList" style="margin-bottom: 15vh;">
                    @for ($i = 0; $i < 15; $i++)
                        <a href="#" class="text-style-none">
                            <div id="w-node-_98aa59c7-5c20-8fcb-852c-972bad093e75-fac73a6c" class="product-card padding-small">
                                <div class="text-rich-text text-size-small text-color-grey">North</div><img
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTGPBymlWd3hUAnHiqrwRWmjLEvMRPdPJqcfQ&usqp=CAU" loading="lazy" alt="" class="product-image" />
                                <div class="product-card-stars">
                                        <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy" alt="" class="card-stars" />
                                        <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy" alt="" class="card-stars" />
                                        <img src="{{ asset('assets/Star 1.svg') }}" loading="lazy" alt="" class="card-stars" />
                                        <img src="{{ asset('assets/Star 2.svg') }}" loading="lazy" alt="" class="card-stars" />
                                        <img src="{{ asset('assets/Star 3.svg') }}" loading="lazy" alt="" class="card-stars" />
                                </div>
                                <div class="product-card-title text-rich-text text-size-regular text-weight-bold text-color-dark-grey text-center text-truncate">
                                    Vendor Name
                                </div>
                            </div>
                        </a>
                    @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cursor">
        <div data-w-id="f4b78bbc-ea93-bb5a-a490-cac406bb401d" class="dot"></div>
    </div>
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/js/script-product-list.js') }}" type="text/javascript"></script>
@endsection
