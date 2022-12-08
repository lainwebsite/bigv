@extends('user.template.layout')

@section('page-title')
    Transaction - Big V
@endsection

@section('head-extra')
    <link href="{{ asset('assets/css/style-transaction.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content" style="min-height:55vh; width: 100%;">
        <div class="header-section">
            <h2 class="orange-text">Transactions</h2>
        </div>
        <div class="transactions-page-wrapper" style="min-height: 100vh;">
            <div class="profile-page-menu">
                <div class="flex gap-small">
                  <div><b>{{auth()->user()->name}}</b></div>
                </div>
                <div class="div-line" style="margin:0 !important;"></div>
                <div class="w-form">
                  <div class="form-2">
                      <a href="{{url('/profile')}}" class="transaction-menus text-color-grey" style="text-decoration: none; white-space:nowrap;">Profile Settings</a>
                      <a href="{{url('/user/transaction')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Transactions</a>
                      <a href="{{url('/user/user-address')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Addresses</a>
                      <a href="{{url('/user/discount')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Promos</a>
                  </div>
                </div>
            </div>
            <div class="transactions-column">
                <div class="flex gap-small column-responsive">
                    <div>Status</div>
                    <div class="div-block-27 wrap-responsive" style="flex-wrap:wrap; gap: 9px;">
                        <a href="{{ url('user/transaction') }}"
                            class="delivery-button w-inline-block @if (!isset($status_selected)) selected @endif">
                            <div>All</div>
                        </a>
                        @foreach ($transaction_status as $status)
                            <a href="{{ url('user/transaction/filter?status=' . $status->id) }}"
                                class="delivery-button w-inline-block @if (isset($status_selected)) @if ($status_selected == $status->id) selected @endif @endif">
                                <div>{{ $status->name }}</div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @foreach ($transactions as $transaction)
                    <div class="transaction-card" style="width: 100%;">
                        <a class="transaction-detail" href="{{ url('user/transaction/' . $transaction->id) }}"
                            style="text-decoration: none; display: none;"></a>
                        <div class="flex space-between">
                            <div class="flex gap-small">
                                <div>
                                    <h5 class="text-color-dark-grey">ID: {{ $transaction->id }}</h5>
                                    <div class="text-size-small text-color-grey">
                                        {{ date('d F Y', strtotime($transaction->created_at)) }}</div>
                                </div>
                            </div>
                            <div class="flex gap-small">
                                <h5 class="text-color-dark-grey">Status</h5><a href="#"
                                    class="status-button-like w-inline-block" style="font-size:12px;">
                                    <div>{{ $transaction->status->name }}</div>
                                </a>
                            </div>
                        </div>
                        <div class="div-line-sumarry"></div>
                        @php($current_vendor = 0)
                        @foreach ($transaction->carts as $cart)
                            @if ($current_vendor != $cart->vendor_id)
                                <div class="flex space-between">
                                    <div class="flex gap-small"><img src="{{ asset('uploads/'.$cart->vendor_photo) }}" loading="lazy"
                                            alt="" class="vendor-image" />
                                        <div>
                                            <h5 class="text-color-dark-grey">{{ $cart->vendor_name }}</h5>
                                        </div>
                                    </div>
                                </div>
                                @php($current_vendor = $cart->vendor_id)
                            @endif
                            <div class="vendor-item">
                                <div class="flex gap-medium"><img src="{{ asset('uploads/'.$cart->product_featured_image) }}"
                                        loading="lazy" sizes="(max-width: 479px) 61vw, 70px" alt=""
                                        class="image-18" />
                                    <div>
                                        <h5 class="text-color-dark-grey">{{ $cart->product_name }}</h5>
                                        @if ($cart->product_variation_name != 'novariation')
                                            :
                                            <div class="text-size-small text-color-grey">Variant:
                                                {{ $cart->product_variation_name }}</div>
                                        @endif
                                        <div class="text-size-small text-color-grey">${{ $cart->product_price }}</div>
                                        <!-- <div class="text-size-small text-color-grey">+ 4 more products</div> -->
                                    </div>
                                </div>
                                <div class="div-block-36">
                                    <div>{{ $cart->qty }}x</div>
                                    <div>${{ $cart->product_price * $cart->qty }}</div>
                                </div>
                            </div>
                            <div class="div-line-sumarry"></div>
                        @endforeach
                        <div style="display: flex; flex-direction: row; justify-content: space-between;">
                            <div><b>Total Price</b></div>
                            <div><b>${{ $transaction->total_price }}</b></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{ $transactions->links() }}
    </div>
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/js/script-transaction.js') }}" type="text/javascript"></script>
    <script>
        var form = "#" + $(this).parents("form").attr("id");
        var param = $(location).attr("search");

        if (param != "") {
            param = param.substring(1, param.length).split("&");
            param.forEach(function(item) {
                var items = item.split("=");
                if (items[0] != "page") {
                    if ($("input[type=hidden][name=" + items[0] + "]").length <= 0) {
                        $("<input>").attr({
                            type: "hidden",
                            name: items[0],
                            value: items[1]
                        }).appendTo(form);
                    }
                }
            });
        }

        $(".delivery-button").on("click", function() {
            $(".delivery-button").each(function() {
                $(this).removeClass("selected");
            });
            $(this).addClass("selected");
        });

        $(".transaction-card").on("click", function() {
            window.location = $(this).find(".transaction-detail").attr("href");
            return false;
        });
    </script>
@endsection
