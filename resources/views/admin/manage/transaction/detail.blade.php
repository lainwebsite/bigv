@extends('admin.layout')

@section('orders-manage-selected')
    selected
@endsection

@section('orders-manage-link-active')
    active
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Order Detail</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                        class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.transaction.index') }}"
                                        class="text-muted">Orders</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Order Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- basic table -->
            <div class="row">
                <div class="col-12">
                    <div id="order-status" @class([
                        'card',
                        'bg-danger' => $transaction->status_id == 1,
                        'bg-primary' => $transaction->status_id == 2,
                        'bg-cyan' => $transaction->status_id == 3,
                        'bg-success' => $transaction->status_id == 4,
                        'bg-secondary' => $transaction->status_id == 5,
                    ])>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8 d-flex justify-content-between align-items-center">
                                    <div class="m-0">
                                        <h4 class="card-title m-0 text-white">Transaction ID: {{ $transaction->id }}</h4>
                                        <p class="m-0 text-white">{{ $transaction->created_at }}</p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <select id="update-order-status"
                                        class="w-auto custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                        @foreach ($statuses as $status)
                                            <option value={{ $status->id }} @selected($status->id == $transaction->status_id)>
                                                {{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Message</h4>
                    <div class="row">
                        <div class="col-3">
                            <a href="https://api.whatsapp.com/send?phone={{ $billingAddress->user->phone ?? '#' }}"
                                class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2">
                                <img src="{{ asset('assets/images/whatsapp.svg') }}" width="24"
                                    height="24" />Customer</a>
                        </div>
                        <div class="col-9 d-flex flex-column gap-15x gap-3y justify-content-end align-items-end">
                            @php
                                $vendors = [];
                            @endphp
                            @foreach ($transaction->carts as $cart)
                                @if (!in_array($cart->product_variation_trashed->product->vendor_id, $vendors))
                                    <div class="d-flex gap-15x">
                                        @php
                                            $wa_string = 'https://wa.me/' . $cart->product_variation_trashed->product->vendor->phone . '?text=Hello%20Vendor%20*' . $cart->product_variation_trashed->product->vendor->name . '*%0AThere%20is%20a%20new%20order%20with%20the%20ID%20*' . $cart->transaction->id . '*';
                                        @endphp
                                        @foreach ($transaction->carts as $carted)
                                            @if ($carted->product_variation_trashed->product->vendor_id == $cart->product_variation_trashed->product->vendor_id)
                                                @php
                                                    $wa_string = $wa_string . '%0A*' . $carted->product_variation_trashed->product->name . '%20' . $carted->product_variation_trashed->name . '%20x%20' . $carted->quantity .'*';
                                                @endphp
                                                @foreach ($carted->addon_options as $addon)
                                                    @if ($loop->first)
                                                        @php
                                                            $wa_string = $wa_string . '%20with';
                                                        @endphp
                                                    @endif
                                                    @php
                                                        $wa_string = $wa_string . '%20*' . $addon->addon_option_trashed->name . '*';
                                                    @endphp
                                                @endforeach
                                            @endif
                                        @endforeach
                                        @php
                                            $wa_string = $wa_string . '%0Ato%20be%20prepared%20by%20' . $transaction->delivery_date . '%0A%0A*Order%20Date%20%3A%20' . $transaction->created_at . '*%0A%0AThank%20You%20';
                                        @endphp
                                        <a target="_blank" href="{{ $wa_string }}"
                                            class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><img
                                                src="{{ asset('assets/images/whatsapp.svg') }}" width="24"
                                                height="24" />{{ $cart->product_variation_trashed->product->vendor->name }}</a>
                                        <a href="mailto:{{ $cart->product_variation_trashed->product->vendor->email }}"
                                            class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><i
                                                data-feather="mail"
                                                class="feather-icon"></i>{{ $cart->product_variation_trashed->product->vendor->name }}</a>
                                    </div>
                                    @php
                                        array_push($vendors, $cart->product_variation_trashed->product->vendor_id);
                                    @endphp
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="card-title mb-4">Customer Info</h4>
                                            <p class="m-0">{{ $transaction->user->name }}</p>
                                            <p class="m-0">{{ $transaction->user->phone }}</p>
                                            <p class="m-0">{{ $transaction->user->tier->name }}</p>
                                            <div class="divider-dash mt-4 mb-4"></div>
                                            @if ($transaction->pickup_method_id == 1)
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h4 class="card-title mb-4">Billing Address</h4>
                                                        <p class="m-0">{{ $billingAddress->name }}</p>
                                                        <p class="m-0">{{ $billingAddress->phone }}</p>
                                                        @if ($billingAddress->building_name != null)
                                                            <p class="mb-2">{{ $billingAddress->block_number }}
                                                                {{ $billingAddress->street }}<br>#{{ $billingAddress->unit_level }}-{{ $billingAddress->unit_number }}
                                                                {{ $billingAddress->building_name }}<br>Singapore
                                                                {{ $billingAddress->postal_code }}</p>
                                                            <small>{{ $billingAddress->additional_info }}</small>
                                                        @else
                                                            <p class="mb-2">
                                                                {{ $billingAddress->unit_number }}
                                                                {{ $billingAddress->street }}<br>Singapore
                                                                {{ $billingAddress->postal_code }}</p>
                                                                <small>{{ $billingAddress->additional_info }}</small>
                                                        @endif
                                                    </div>
                                                    <div class="col-6">
                                                        <h4 class="card-title mb-4">Shipping Address</h4>
                                                        @if ($transaction->shipping_address_id != null)
                                                            <p class="m-0">{{ $shippingAddress->name }}</p>
                                                            <p class="m-0">{{ $shippingAddress->phone }}</p>
                                                            @if ($shippingAddress->building_name != null)
                                                                <p class="mb-2">
                                                                {{ $shippingAddress->block_number }}
                                                                {{ $shippingAddress->street }}<br>#{{ $shippingAddress->unit_level }}-{{ $shippingAddress->unit_number }}
                                                                {{ $shippingAddress->building_name }}<br>Singapore
                                                                {{ $shippingAddress->postal_code }}</p>
                                                                <small>{{ $shippingAddress->additional_info }}</small>
                                                            @else
                                                                <p class="mb-2">
                                                                {{ $shippingAddress->unit_number }}
                                                                {{ $shippingAddress->street }}<br>Singapore
                                                                {{ $shippingAddress->postal_code }}</p>
                                                                <small>{{ $shippingAddress->additional_info }}</small>
                                                            @endif
                                                        @else
                                                            <p class="m-0">Same as Billing Address</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                <h4 class="card-title mb-4">Pickup Address</h4>
                                                <p class="m-0">{{ $transaction->pickup_address_trashed->name }}</p>
                                                <p class="m-0">{{ $transaction->pickup_address_trashed->phone }}</p>
                                                @if ($transaction->pickup_address_trashed->building_name != null)
                                                    <p class="mb-2">
                                                    {{ $transaction->pickup_address_trashed->block_number }}
                                                    {{ $transaction->pickup_address_trashed->street }}<br>#{{ $transaction->pickup_address_trashed->unit_level }}-{{ $transaction->pickup_address_trashed->unit_number }}
                                                    {{ $transaction->pickup_address_trashed->building_name }}<br>Singapore
                                                    {{ $transaction->pickup_address_trashed->postal_code }}</p>
                                                    <small>{{ $transaction->pickup_address_trashed->additional_info }}</small>
                                                @else
                                                    <p class="mb-2">
                                                    {{ $transaction->pickup_address_trashed->unit_number }}
                                                    {{ $transaction->pickup_address_trashed->street }}<br>Singapore
                                                    {{ $transaction->pickup_address_trashed->postal_code }}</p>
                                                    <small>{{ $transaction->pickup_address_trashed->additional_info }}</small>
                                                @endif
                                            @endif
                                            <div class="divider-dash mt-4 mb-4"></div>
                                            <div class="row">
                                                <div class="col">
                                                    <h4 class="card-title mb-4">Shipping/Pickup Time</h4>
                                                    <p class="m-0">
                                                        {{ date('d, F Y', strtotime($transaction->delivery_date)) }} |
                                                        {{ $transaction->pickup_time->time }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Products</h4>
                                    <ul class="list-unstyled">
                                        @foreach ($transaction->carts as $cart)
                                            <li class="media align-items-center mt-3 mb-3 justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <img class="d-flex mr-3 br-18"
                                                        src="{{ asset('uploads/' . $cart->product_variation_trashed->product->featured_image) }}"
                                                        width="60" alt="Generic placeholder image">
                                                    <div class="d-flex flex-column">
                                                        <h5 class="mt-0 mb-1">
                                                            <b>{{ $cart->product_variation_trashed->product->name }}</b>
                                                        </h5>
                                                        @if ($cart->product_variation_trashed->name != "novariation")
                                                        <h6 class="m-0">{{ $cart->product_variation_trashed->name }}</h6>
                                                        @endif
                                                        @if ($cart->addon_options->count() > 0)
                                                            @php 
                                                                $addonOptArr = [];
                                                            @endphp
                                                            @foreach ($cart->addon_options as $addon)
                                                                @php
                                                                    array_push($addonOptArr, $addon->addon_option_trashed->name);
                                                                @endphp
                                                            @endforeach
                                                        <h6 class="m-0">Addon: {{join(",", $addonOptArr)}}</h6>
                                                        @endif
                                                        
                                                        <h6 class="m-0">${{ $cart->price }}</h6>
                                                    </div>
                                                </div>
                                                <p class="m-0">x{{ $cart->quantity }}</p>
                                                <p class="m-0">${{ $cart->price * $cart->quantity }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="divider-dash"></div>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0">Product Total</p>
                                        <p class="m-0">${{ $transaction->total_price - $transaction->shipping_fee + $transaction->product_discount_total + $transaction->shipping_discount_total }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0">Shipping Fee</p>
                                        <p class="m-0">${{ $transaction->shipping_fee }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0">Discount Subtotal</p>
                                        @php
                                            $discountval = $transaction->product_discount_total + $transaction->shipping_discount_total;
                                        @endphp
                                        <p class="m-0">-${{ $discountval }}</p>
                                    </div>
                                    <div class="divider-dash"></div>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0 font-20x"><b>Total</b></p>
                                        <p class="m-0 text-orange font-20x">
                                            <b>${{ $transaction->total_price }}</b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($transaction->transaction_discounts->count() > 0)
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Discount Applied</h4>
                                        <div class="row m-0">
                                            @foreach ($transaction->transaction_discounts as $discount)
                                                <div class="col-3 pl-1 pr-1 pb-2">
                                                    <div class="bg-success p-3 br-18">
                                                        <h5 class="card-title text-white">{{ $discount->discount->name }}
                                                        </h5>
                                                        <h6 class="card-text text-white">
                                                            {{ $discount->discount->description }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="divider-dash mt-4 mb-4"></div>
                                        <h4 class="card-title mb-4">Payment</h4>
                                        <p class="m-0">{{ $transaction->payment_method->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        @endsection

        @section('javascript-extra')
            <script>
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            </script>
            <script>
                function update_status(status) {
                    var hostname = "{{ request()->getHost() }}"
                    var url = ""
                    if (hostname.includes('www')) {
                        url = "https://" + hostname
                    } else {
                        url = "{{ config('app.url') }}"
                    }
                    $.post(url + `/admin/transaction/${@json($transaction->id)}/status`, {
                            _token: CSRF_TOKEN,
                            status_id: status,
                        })
                        .done(function(data) {
                            $("#order-status").removeClass("bg-success bg-primary bg-danger bg-cyan bg-secondary");
                            if (status == "1") $("#order-status").addClass("bg-danger");
                            else if (status == "2") $("#order-status").addClass("bg-primary");
                            else if (status == "3") $("#order-status").addClass("bg-cyan");
                            else if (status == "4") $("#order-status").addClass("bg-success");
                            else $("#order-status").addClass("bg-secondary");
                        })
                        .fail(function(error) {
                            console.log(error);
                        });
                }
            </script>
            <script>
                $("#update-order-status").on('change', function() {
                    update_status($(this).val());
                });
            </script>
        @endsection
