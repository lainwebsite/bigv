@extends('template.layout')

@section('page-title')
    Transaction - Big V
@endsection

@section('head-extra')
    <link href="{{ asset('assets/css/style-transaction.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content">
        <div class="header-section">
            <h2 class="orange-text">Transaction Detail</h2>
        </div>
        <div class="transactions-page-wrapper">
            <div class="profile-page-menu">
                <div class="flex gap-small"><img src="{{ asset('assets/630193c64ebe686851463727_profile-002.jpg') }}"
                        loading="lazy" width="40" alt="" class="image-13" />
                    <div>{{ Auth::user()->name }}</div>
                </div>
                <div class="w-form">
                    <form id="email-form-2" name="email-form-2" data-name="Email Form 2" method="get" class="form-2">
                        <label for="email" class="transaction-menus">Transactions</label><label for="email"
                            class="transaction-menus">Profile Settings</label><label for="email"
                            class="transaction-menus">Addresses</label><label for="email"
                            class="transaction-menus">Promos</label>
                    </form>
                </div>
            </div>
            @php
                $vendors = [];
                foreach ($transaction->carts as $key => $cart) {
                    if (!in_array($cart->product_variation->product->vendor_id, $vendors)) {
                        array_push($vendors, $cart->product_variation->product->vendor_id);
                    }
                }
            @endphp
            <div class="transactions-column">
                <form action="{{ route('user.product-review.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                    <div class="transaction-card">
                        <div class="flex space-between">
                            <div class="flex gap-small">
                                <div>
                                    <h5 class="text-color-dark-grey">Transaction ID: {{ $transaction->id }}</h5>
                                    <div class="text-size-small text-color-grey">
                                        {{ date('d F', strtotime($transaction->created_at)) }}</div>
                                </div>
                            </div>
                            <div class="flex gap-small">
                                <h5 class="text-color-dark-grey">Status</h5><a href="#"
                                    class="status-button-like w-inline-block">
                                    <div>{{ $transaction->transaction_status->name }}</div>
                                </a>
                            </div>
                        </div>
                        @foreach ($vendors as $vendor)
                            @php($counter = 0)
                            @foreach ($transaction->carts as $key => $cart)
                                @if ($cart->product_variation->product->vendor_id == $vendor && $counter == 0)
                                    @php($counter = 1)
                                    <div class="div-line-sumarry"></div>
                                    <div class="flex space-between">
                                        <div class="flex gap-small"><img
                                                src="{{ asset('uploads/' . $cart->product_variation->product->vendor->photo) }}"
                                                loading="lazy" alt="" class="vendor-image" />
                                            <div>
                                                <h5 class="text-color-dark-grey">
                                                    {{ $cart->product_variation->product->vendor->name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($cart->product_variation->product->vendor_id == $vendor)
                                    <div style="display: flex; flex-direction: column;">
                                        <div class="vendor-item">
                                            <div class="flex gap-medium"><img
                                                    src="{{ asset('uploads/' . $cart->product_variation->product->featured_image) }}"
                                                    loading="lazy" sizes="(max-width: 479px) 61vw, 70px" alt=""
                                                    class="image-18" />
                                                <div>
                                                    <h5 class="text-color-dark-grey">
                                                        {{ $cart->product_variation->product->name }}</h5>
                                                    <div class="text-size-small text-color-grey">
                                                        {{ $cart->product_variation->name }}</div>
                                                    <div class="text-size-small text-color-grey">${{ $cart->price }}</div>
                                                </div>
                                            </div>
                                            <div class="div-block-36">
                                                <div>{{ $cart->quantity }}x</div>
                                                <div>${{ $cart->price }}</div>
                                            </div>
                                        </div>
                                        <div class="flex" style="flex-direction: column; gap: 15px; margin-bottom: 18px;">
                                            <div class="flex" style="justify-content:space-between; width: 100%;">
                                                <div class="text-size-small text-color-grey">Submit your Review</div>
                                                <div class="flex">
                                                    @for ($j = 1; $j <= 5; $j++)
                                                        <div class="c-product-rating__star star-review"
                                                            style="cursor: pointer;" step="{{ $j }}">
                                                            <div class="icon">
                                                                <div class="fas fa-star">
                                                                    <img src="{{ asset('assets/Star 1.svg') }}"
                                                                        loading="lazy" alt="" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                                <input name="rating[{{ $cart->id }}]" type="hidden" value="5">
                                            </div>
                                            <div class="flex" style="width: 100%; gap: 10px; flex-direction: column;">
                                                <div class="flex" id="photo-review-container-{{ $cart->id }}"
                                                    style="width: 100%; flex-wrap: wrap; gap: 10px;">

                                                </div>
                                                <div id="add-photo-button-{{ $cart->id }}" class="flex"
                                                    style="justify-content: flex-end; width: 100%;">
                                                    <div class="button-3 w-inline-block button-add-photo-review"
                                                        onclick="addPhotoReview({{ $cart->id }})"
                                                        style="height: auto !important; padding: 5px 10px !important;">
                                                        <div class="text-color-white"
                                                            style="font-size: 12px; white-space: nowrap;">
                                                            Add
                                                            Photo</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <textarea name="description[{{ $cart->id }}]"
                                                style="width: 100%; border-radius: 10px; padding: 10px; resize: none; border: #c5c5c5 1px solid; font-size: 0.875rem;"
                                                rows="2"></textarea>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                        <div class="flex" style="justify-content: flex-end;">
                            <button class="button-3 button-size--small w-inline-block">
                                <div class="text-color-white">Submit Review</div>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="vendors-card">
                    <div>
                        <h4>Shipping Method</h4>
                        <div>
                            <div class="checkout-buttons">
                                <a href="#" @class([
                                    'delivery-button w-inline-block',
                                    'active' => $transaction->pickup_method_id == 1,
                                ])>
                                    <svg width="33" height="33" viewBox="0 0 33 33" class="shipping-icon"
                                        fill="#444349" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M26.125 9.625C26.125 8.1125 24.8875 6.875 23.375 6.875H19.25V9.625H23.375V13.2687L18.59 19.25H13.75V12.375H8.25C5.21125 12.375 2.75 14.8362 2.75 17.875V22H5.5C5.5 24.2825 7.3425 26.125 9.625 26.125C11.9075 26.125 13.75 24.2825 13.75 22H19.91L26.125 14.2313V9.625ZM9.625 23.375C8.86875 23.375 8.25 22.7563 8.25 22H11C11 22.7563 10.3812 23.375 9.625 23.375Z">
                                        </path>
                                        <path
                                            d="M6.875 8.25H13.75V11H6.875V8.25ZM26.125 17.875C23.8425 17.875 22 19.7175 22 22C22 24.2825 23.8425 26.125 26.125 26.125C28.4075 26.125 30.25 24.2825 30.25 22C30.25 19.7175 28.4075 17.875 26.125 17.875ZM26.125 23.375C25.3687 23.375 24.75 22.7563 24.75 22C24.75 21.2437 25.3687 20.625 26.125 20.625C26.8813 20.625 27.5 21.2437 27.5 22C27.5 22.7563 26.8813 23.375 26.125 23.375Z">
                                        </path>
                                    </svg>
                                    <div class="text-size-small">Delivery</div>
                                </a>
                                <a href="#" @class([
                                    'self-collection-button w-inline-block',
                                    'active' => $transaction->pickup_method_id == 2,
                                ])>
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="shipping-icon"
                                        fill="#444349" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 1.5C12.9946 1.5 13.9484 1.89509 14.6517 2.59835C15.3549 3.30161 15.75 4.25544 15.75 5.25V6H8.25V5.25C8.25 4.25544 8.64509 3.30161 9.34835 2.59835C10.0516 1.89509 11.0054 1.5 12 1.5ZM17.25 6V5.25C17.25 3.85761 16.6969 2.52226 15.7123 1.53769C14.7277 0.553123 13.3924 0 12 0C10.6076 0 9.27226 0.553123 8.28769 1.53769C7.30312 2.52226 6.75 3.85761 6.75 5.25V6H1.5V21C1.5 21.7956 1.81607 22.5587 2.37868 23.1213C2.94129 23.6839 3.70435 24 4.5 24H19.5C20.2956 24 21.0587 23.6839 21.6213 23.1213C22.1839 22.5587 22.5 21.7956 22.5 21V6H17.25Z">
                                        </path>
                                    </svg>
                                    <div class="text-size-small">Self Collection</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="div-line"></div>
                    <h4 class="heading-6 margin-vertical margin-small">Delivery Address</h4>
                    <div class="delivery-add-item">
                        <div>
                            <h4 class="heading-7">{{ $transaction->user->name }}</h4>
                            <div class="text-size-small">{{ $transaction->billing_address->phone }}</div>
                            <div class="text-size-small">
                                <p class="mb-2">[{{ $transaction->billing_address->block_number }}]
                                    [{{ $transaction->billing_address->street }}]<br>#[{{ $transaction->billing_address->unit_level }}]-[{{ $transaction->billing_address->unit_number }}]
                                    [{{ $transaction->billing_address->building_name }}]<br>Singapore
                                    [{{ $transaction->billing_address->postal_code }}]</p>
                                <small>{{ $transaction->billing_address->additional_info }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="different-add-div">
                        @if ($transaction->billing_address_id != $transaction->shipping_address_id)
                            <div class="div-block-26">
                                <h4 class="heading-7">Shipped to Different Address</h4><img
                                    src="{{ asset('assets/630b960db00126d372dcaef4_check.svg') }}" loading="lazy"
                                    alt="" />
                            </div>
                            <div class="div-line"></div>
                        @endif
                        <div class="div-block-26">
                            <div>
                                <h4 class="heading-7">{{ $transaction->user->name }}</h4>
                                <div class="text-size-small">{{ $transaction->shipping_address->phone }}</div>
                                <div class="text-size-small">
                                    <p class="mb-2">[{{ $transaction->shipping_address->block_number }}]
                                        [{{ $transaction->shipping_address->street }}]<br>#[{{ $transaction->shipping_address->unit_level }}]-[{{ $transaction->shipping_address->unit_number }}]
                                        [{{ $transaction->shipping_address->building_name }}]<br>Singapore
                                        [{{ $transaction->shipping_address->postal_code }}]</p>
                                    <small>{{ $transaction->shipping_address->additional_info }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="div-line"></div>
                    <h4 class="heading-6 margin-vertical margin-small text-color-dark-grey">Shipping/Pickup Time</h4>
                    <div class="delivery-add-item">
                        <div>
                            <div class="text-size-small text-color-grey">Delivery Date</div>
                            <h5 class="text-color-grey">{{$transaction->delivery_date}}</h5>
                        </div>
                    </div>
                    <div class="div-block-27"><a href="#" class="delivery-button w-inline-block">
                            <div>AM</div>
                        </a><a href="#" class="delivery-button w-inline-block">
                            <div>PM</div>
                        </a></div>
                </div>
            </div>
            <div class="cart-summary">
                <h4 class="text-color-dark-grey">Discount</h4><a href="#"
                    class="payment-gateway-button w-inline-block">
                    <div>
                        <div class="text-weight-bold">Discount Name</div>
                        <div class="text-size-xtiny">Discount terms and conditions like Discount 50% with minimum order $30
                            and
                            maximum discount $10</div>
                    </div>
                </a>
                <h4 class="heading-8 text-color-dark-grey">Summary</h4>
                <div class="div-block-24 text-color-grey">
                    <div class="inline">Total Price (30 items)</div>
                    <div class="inline">$201</div>
                </div>
                <div class="div-block-24 text-color-grey">
                    <div class="inline">Shipping Price</div>
                    <div class="inline">$30</div>
                </div>
                <div class="div-block-24 text-color-grey">
                    <div class="inline">Discounts</div>
                    <div class="inline">- $3</div>
                </div>
                <div class="div-line-sumarry"></div>
                <div class="div-block-24 text-color-dark-grey">
                    <div class="inline text-weight-bold">Total</div>
                    <div class="inline text-weight-bold">$228</div>
                </div>
            </div>
        </div>
        <div class="pagination flex justify-center margin-large">
            <div class="div-block-21">
                <div class="text-color-white">1</div>
            </div>
            <div class="div-block-21-copy">
                <div class="orange-text">1</div>
            </div>
        </div>
    </div>
@endsection

@section('javascript-extra')
    <script src="{{ asset('assets/js/script-transaction.js') }}" type="text/javascript"></script>
    <script>
        $(document).on("change", ".photoReviewInput", function() {
            var input = this;
            var inputFile = $(this);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    inputFile.parent().children("div").css("display", "unset");
                    inputFile.parent().children("div").children("img").attr('src', e.target.result);
                    inputFile.hide();
                }

                reader.readAsDataURL(input.files[0]);
            }
        });
        var carts = [];

        function addPhotoReview(id) {
            var count = $(`#photo-review-container-${id}`).children().length;
            if (count < 3) {
                $(`#photo-review-container-${id}`).append(`
      <div class="flex">
        <input type="file" style="font-size: 12px;" class="photoReviewInput" name="review_photos[${id}][${count}]">
        <div style="position:relative; display: none;">
          <img src="#" style="width: 150px; height: 150px; object-fit: cover; border-radius: 15px;" alt="">
          <div class="remove-photo-review" style="width: 20px; height: 20px; background: #fb3b1e; display: flex; z-index: 5; justify-content:center; align-items:center; color: white; font-size: 10px; border-radius: 50%; cursor: pointer; position: absolute; top: 0; right:0;">X</div>
        </div>
      </div>
    `)
            } else {
                alert("You can only add up to 3 photos per product!");
            }
        };

        $(document).on('click', ".remove-photo-review", function() {
            $(this).parent().parent().remove();
        })

        $(".star-review").on('click', function() {
            var rate = $(this).attr('step');
            var count = 0;
            $(this).parent().children().each(function() {
                count++;
                $(this).children().children().children().attr('src', ((count > rate) ?
                    "{{ asset('assets/Star 3.svg') }}" : "{{ asset('assets/Star 1.svg') }}"));
            });
            $(this).parent().parent().children('input').val(rate);
        });
    </script>
@endsection
