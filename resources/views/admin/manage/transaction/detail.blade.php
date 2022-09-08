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
                            <a href="https://api.whatsapp.com/send?phone={{ $transaction->billing_address->user->phone ?? '#' }}"
                                class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2">
                                <img src="{{ asset('assets/images/whatsapp.svg') }}" width="24"
                                    height="24" />Customer</a>
                        </div>
                        <div class="col-9 d-flex flex-column gap-15x gap-3y justify-content-end align-items-end">
                            @php
                                $vendors = [];
                            @endphp
                            @foreach ($transaction->carts as $cart)
                                @if (!in_array($cart->product_variation->product->vendor_id, $vendors))
                                    <div class="d-flex gap-15x">
                                        <button
                                            class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><img
                                                src="{{ asset('assets/images/whatsapp.svg') }}" width="24"
                                                height="24" />{{ $cart->product_variation->product->vendor->name }}</button>
                                        <button
                                            class="btn btn-primary d-flex gap-15x align-items-center pr-4 pl-4 pb-2 pt-2"><i
                                                data-feather="mail"
                                                class="feather-icon"></i>{{ $cart->product_variation->product->vendor->name }}</button>
                                    </div>
                                    @php
                                        array_push($vendors, $cart->product_variation->product->vendor_id);
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
                                            <p class="m-0">{{ $transaction->billing_address->name }}</p>
                                            <p class="m-0">{{ $transaction->billing_address->phone }}</p>
                                            <p class="m-0">{{ $transaction->billing_address->user->tier->name }}</p>
                                            <div class="divider-dash mt-4 mb-4"></div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h4 class="card-title mb-4">Billing Address</h4>
                                                    <p class="m-0">{{ $transaction->billing_address->name }}</p>
                                                    <p class="m-0">{{ $transaction->billing_address->phone }}</p>
                                                    <p class="mb-2">[{{ $transaction->billing_address->block_number }}]
                                                        [{{ $transaction->billing_address->street }}]<br>#[{{ $transaction->billing_address->unit_level }}]-[{{ $transaction->billing_address->unit_number }}]
                                                        [{{ $transaction->billing_address->building_name }}]<br>Singapore
                                                        [{{ $transaction->billing_address->postal_code }}]</p>
                                                    <small>{{ $transaction->billing_address->additional_info }}</small>
                                                </div>
                                                <div class="col-6">
                                                    <h4 class="card-title mb-4">Shipping Address</h4>
                                                    <p class="m-0">{{ $transaction->shipping_address->name }}</p>
                                                    <p class="m-0">{{ $transaction->shipping_address->phone }}</p>
                                                    <p class="mb-2">[{{ $transaction->shipping_address->block_number }}]
                                                        [{{ $transaction->shipping_address->street }}]<br>#[{{ $transaction->shipping_address->unit_level }}]-[{{ $transaction->shipping_address->unit_number }}]
                                                        [{{ $transaction->shipping_address->building_name }}]<br>Singapore
                                                        [{{ $transaction->shipping_address->postal_code }}]</p>
                                                    <small>{{ $transaction->shipping_address->additional_info }}</small>
                                                </div>
                                            </div>
                                            <div class="divider-dash mt-4 mb-4"></div>
                                            <div class="row">
                                                <div class="col">
                                                    <h4 class="card-title mb-4">Shipping/Pickup Time</h4>
                                                    <p class="m-0">
                                                        {{ date('d, F Y', strtotime($transaction->created_at)) }} |
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
                                                        src="{{ asset('uploads/' . $cart->product_variation->product->featured_image) }}"
                                                        width="60" alt="Generic placeholder image">
                                                    <div class="d-flex flex-column">
                                                        <h5 class="mt-0 mb-1">
                                                            <b>{{ $cart->product_variation->product->name }}</b>
                                                        </h5>
                                                        <h6 class="m-0">{{ $cart->product_variation->name }}</h6>
                                                        <h6 class="m-0">${{ $cart->product_variation->price }}</h6>
                                                    </div>
                                                </div>
                                                <p class="m-0">x{{ $cart->quantity }}</p>
                                                <p class="m-0">${{ $cart->price }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="divider-dash"></div>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0">Product Total</p>
                                        <p class="m-0">${{ $transaction->total_price }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0">Shipping Fee</p>
                                        <p class="m-0">${{ $transaction->shipping_fee }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0">Discount Subtotal</p>
                                        @php
                                            $discountval = 0;
                                        @endphp
                                        @if ($transaction->transaction_discounts->count() > 0)
                                            @foreach ($transaction->transaction_discounts as $discount)
                                                @switch($discount->discount->type_id)
                                                    @case(1)
                                                        @php
                                                            $discountval += ($discount->discount->amount * $transaction->shipping_fee) / 100;
                                                        @endphp
                                                    @break

                                                    @case(2)
                                                        @php
                                                            $discountval += ($discount->discount->amount * $transaction->total_price) / 100;
                                                        @endphp
                                                    @break

                                                    @case(3)
                                                        @php
                                                            $discountval += $transaction->total_price - $discount->discount->amount;
                                                        @endphp
                                                    @break

                                                    @default
                                                @endswitch
                                            @endforeach
                                            <p class="m-0">${{ $discountval }}</p>
                                        @else
                                            <p class="m-0">$0</p>
                                        @endif
                                    </div>
                                    <div class="divider-dash"></div>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0 font-20x"><b>Total</b></p>
                                        <p class="m-0 text-orange font-20x">
                                            <b>${{ $transaction->total_price + $transaction->shipping_fee - $discountval }}</b>
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
