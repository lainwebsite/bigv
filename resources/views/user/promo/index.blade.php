@extends('user.template.layout')

@section('page-title')
    Promos - Big V
@endsection

@section('meta-title')
    Promo - BigV
@endsection

@section('meta-description')
    Take a look at our exciting promos.
@endsection

@section('meta-image')
    {{asset('assets/62ffbe41b946fc3a2b7b6747_Big%20V(NoTag)-ColorB%202.png')}}
@endsection

@section('head-extra')
    <link href="{{ asset('assets/css/style-transaction.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content">
        <div class="header-section">
            <h2 class="orange-text">Promos</h2>
        </div>
        <div class="transactions-page-wrapper">
            <div class="profile-page-menu">
                <div class="flex gap-small">
                    <div><b>{{ auth()->user()->name }}</b></div>
                </div>
                <div class="div-line" style="margin:0 !important;"></div>
                <div class="w-form">
                    <div class="form-2">
                        <a href="{{ url('/profile') }}" class="transaction-menus text-color-grey"
                            style="text-decoration: none; white-space: nowrap;">Profile Settings</a>
                        <a href="{{ url('/user/transaction') }}" class="transaction-menus text-color-grey"
                            style="text-decoration: none;">Transactions</a>
                        <a href="{{ url('/user/user-address') }}" class="transaction-menus text-color-grey"
                            style="text-decoration: none;">Addresses</a>
                        <a href="{{ url('/user/discount') }}" class="transaction-menus text-color-grey"
                            style="text-decoration: none;">Promos</a>
                    </div>
                </div>
            </div>
            <div class="promo-column-profile">
                <div class="promo-row-top">
                    <div class="text-size-small text-color-grey">Here are the Promos available for you</div>
                    <style>
                        .four-promo-container{
                            display: -ms-flexbox;
                            display: flex;
                            -ms-flex-wrap: wrap;
                            flex-wrap: wrap;
                            row-gap: 15px;
                        }
                        
                        .promo-image{
                            max-width:450px;
                            height: 100%;
                            border-radius: 10px;
                            width: 100%;
                        }
                        
                        .promo-content{
                            display: flex;
                            position: relative;
                            width: 100%;
                            min-height: 1px;
                            padding-right: 15px;
                            padding-left: 15px;
                        }
                        
                        .promo-content{
                            -ms-flex: 0 0 50%;
                            flex: 0 0 50%;
                            max-width: 50%;
                        }
                        
                        @media screen and (max-width: 479px) {
                            #column-reverse-responsive{
                                flex-direction: column-reverse;
                            }
                            .promo-content{
                                -ms-flex: 0 0 100%;
                                flex: 0 0 100%;
                                max-width: 100%;
                            }
                            
                            .value-section{
                                margin-top: 10vh !important;
                                margin-bottom: 10vh !important;
                            }
                        }
                    </style>
                    <div class="four-promo-container" style="display:none;">
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
                    <div class="promo-div" style="display: block">
                        <img src="{{ asset('promo/promobig.jpg') }}" loading="lazy" alt="" class="promo-image" style="max-width: unset;" />
                    </div>
                </div>
                <div class="promo-row-bottom" style="margin-bottom: 5vh;">
                    <div class="div-block-29">
                        <h4 class="heading-7"><b>Apply Code</b></h4>
                        <div class="form-block-2 w-form">
                            <form id="email-form-2" name="email-form-2" data-name="Email Form 2" method="get">
                                <input type="text" id="search-code" class="text-field-2 w-input" placeholder="Enter Code"
                                    required="" />
                            </form>
                        </div>
                    </div>
                    <div id="discount-list">
                        @include('user.promo.inc.discount')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/js/script-transaction.js') }}" type="text/javascript"></script>
    <script>
        $('#search-code').keyup(function() {
            var hostname = "{{ request()->getHost() }}"
            var url = ""
            if (hostname.includes('www')) {
                url = "https://" + hostname
            } else {
                url = "{{ config('app.url') }}"
            }
            $.post(url + "/user/discount/search", {
                    _token: CSRF_TOKEN,
                    code: $('#search-code').val()
                })
                .done(function(data) {
                    $('#discount-list').html(data);
                })
                .fail(function(error) {
                    console.log(error);
                });
        });
    </script>
@endsection
