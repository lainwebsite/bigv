@extends('user.template.layout')

@section('page-title')
Checkout - Big V
@endsection

@section('head-extra')
<link href="{{asset('assets/css/style-cart-checkout.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<style>
    .w-icon-close-toggle {
        top: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        margin-right: 20px;
        width: 1em;
        height: 1em;
    }

    .w-icon-close-toggle::before {
        content: "\00d7";
        font-size: 1.75rem;
        line-height: 0.265;
        font-weight: 700;
    }
</style>
@endsection

@section('content')
<div class="content">
    <div class="max-width flex vertical">
        <h2 class="text-color-grey ea-top">Checkout</h2>
        <form id="checkoutForm" method="POST" action="{{ url('user/cart/checkout/place-order') }}" class="cart-wrapper w-100">
            @csrf

            <div class="vendors-column flex-shrink-0 flex-grow-0 w-50">
                <div class="vendors-card">
                    <div>
                        <h4>Shipping Method</h4>
                        <div>
                            <div class="checkout-buttons">
                                @foreach ($pickup_methods as $key => $pickup_method)
                                    @if ($key == 0)
                                        <a href="#" pickup-method-id="{{ $pickup_method->id }}" class="shipping-button shipping-button-active w-inline-block" id="deliveryShippingButton">
                                            <svg width="33" height="33" viewBox="0 0 33 33" class="shipping-icon" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M26.125 9.625C26.125 8.1125 24.8875 6.875 23.375 6.875H19.25V9.625H23.375V13.2687L18.59 19.25H13.75V12.375H8.25C5.21125 12.375 2.75 14.8362 2.75 17.875V22H5.5C5.5 24.2825 7.3425 26.125 9.625 26.125C11.9075 26.125 13.75 24.2825 13.75 22H19.91L26.125 14.2313V9.625ZM9.625 23.375C8.86875 23.375 8.25 22.7563 8.25 22H11C11 22.7563 10.3812 23.375 9.625 23.375Z" />
                                                <path d="M6.875 8.25H13.75V11H6.875V8.25ZM26.125 17.875C23.8425 17.875 22 19.7175 22 22C22 24.2825 23.8425 26.125 26.125 26.125C28.4075 26.125 30.25 24.2825 30.25 22C30.25 19.7175 28.4075 17.875 26.125 17.875ZM26.125 23.375C25.3687 23.375 24.75 22.7563 24.75 22C24.75 21.2437 25.3687 20.625 26.125 20.625C26.8813 20.625 27.5 21.2437 27.5 22C27.5 22.7563 26.8813 23.375 26.125 23.375Z" />
                                            </svg>
                                            <div class="text-size-small">{{ $pickup_method->name }}</div>
                                        </a>
                                    @else
                                        <a href="#" pickup-method-id="{{ $pickup_method->id }}" class="shipping-button w-inline-block" id="deliveryShippingButton">
                                            <svg width="33" height="33" viewBox="0 0 33 33" class="shipping-icon" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M26.125 9.625C26.125 8.1125 24.8875 6.875 23.375 6.875H19.25V9.625H23.375V13.2687L18.59 19.25H13.75V12.375H8.25C5.21125 12.375 2.75 14.8362 2.75 17.875V22H5.5C5.5 24.2825 7.3425 26.125 9.625 26.125C11.9075 26.125 13.75 24.2825 13.75 22H19.91L26.125 14.2313V9.625ZM9.625 23.375C8.86875 23.375 8.25 22.7563 8.25 22H11C11 22.7563 10.3812 23.375 9.625 23.375Z" />
                                                <path d="M6.875 8.25H13.75V11H6.875V8.25ZM26.125 17.875C23.8425 17.875 22 19.7175 22 22C22 24.2825 23.8425 26.125 26.125 26.125C28.4075 26.125 30.25 24.2825 30.25 22C30.25 19.7175 28.4075 17.875 26.125 17.875ZM26.125 23.375C25.3687 23.375 24.75 22.7563 24.75 22C24.75 21.2437 25.3687 20.625 26.125 20.625C26.8813 20.625 27.5 21.2437 27.5 22C27.5 22.7563 26.8813 23.375 26.125 23.375Z" />
                                            </svg>
                                            <div class="text-size-small">{{ $pickup_method->name }}</div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="div-line"></div>
                    <div id="deliveryShippingDetail">
                        <h4 class="heading-6 margin-vertical margin-small">Select Delivery Address</h4>
                        <div class="delivery-add-item">
                            <div id="deliveryAddressData">
                                <h4 class="heading-7">Address name</h4>
                                <div class="text-size-small">Phone number</div>
                                <div class="text-size-small">
                                    [Block Number] [Street Name] <br>
                                    #[Unit Level]-[Unit Number] [Building Name] <br>
                                    Singapore [Postal Code]
                                </div>
                            </div>
                            <button id="btnEditDeliveryAddress" type="button" class="btn" data-toggle="modal" style="background: rgba(0,0,0,0); box-shadow: none !important;" data-target="#addressModal">
                                <img src="{{asset('assets/630b9533cf47ce568d633011_pencil.svg')}}" loading="lazy" alt="" class="image-21 cursor-pointer" />
                            </button>
                        </div>
                        <div class="different-add-div">
                            <div class="div-block-26 cursor-pointer" id="diffShippingAddress">
                                <h4 class="heading-7">Ship to a Different Address?</h4>
                                <img src="{{asset('assets/circle.svg')}}" id="iconShippingAddress" loading="lazy" alt="" />
                            </div>
                            <div id="shippingAddress" style="display: none;">
                                <div class="div-line"></div>
                                <div class="div-block-26">
                                    <div id="shippingAddressData">
                                        <h4 class="heading-7">Neilson Soeratman</h4>
                                        <div class="text-size-small">082337363440</div>
                                        <div class="text-size-small">
                                            [Block Number] [Street Name] <br>
                                            #[Unit Level]-[Unit Number] [Building Name] <br>
                                            Singapore [Postal Code]
                                        </div>
                                    </div>
                                    <button id="btnEditShippingAddress" type="button" class="btn" data-toggle="modal" style="background: rgba(0,0,0,0); box-shadow: none !important;" data-target="#addressModal">
                                        <img src="{{asset('assets/630b9533cf47ce568d633011_pencil.svg')}}" loading="lazy" alt="" class="image-21 cursor-pointer" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pickupShippingDetail" class="d-none">
                        <h4 class="heading-6 margin-vertical margin-small">Select Pickup Address</h4>
                        <div class="container-address d-flex flex-column"></div>
                    </div>
                    <div class="div-line"></div>
                    <h4 class="heading-6 margin-vertical margin-small text-color-dark-grey">Shipping/Pickup Time</h4>
                    <div class="position-relative w-100 h-auto">
                        <?php date_default_timezone_set('Asia/Singapore'); 
                        $minDate = date("Y-m-d", strtotime(date("Y-m-d")."+ 8 days")); ?>
                        <input type="date" name="delivery_date" class="delivery-add-time w-100" id="shippingDate" min="<?= $minDate ?>">
                        <div class="position-absolute d-flex justify-content-between align-items-center" style="top:18px; left:18px; width: calc(100% - 36px); background: #f7f7f7; pointer-events:none;">
                            <div class="d-flex flex-column">
                                <div class="text-size-small text-color-grey">Delivery Date</div>
                                <h5 class="text-color-grey" id="shippingDateFormat">Monday, 4th July</h5>
                            </div>
                            <!-- Only 8th day onwards  -->
                            <!-- No shipping on sunday / public holiday -->
                            <img src="{{asset('assets/630b987de146c81e1ccb7e54_chevron-expand.svg')}}" loading="lazy" alt="" class="image-21" />
                        </div>
                    </div>
                    <div class="div-block-27">
                        @foreach ($pickup_times as $key => $pickup_time)
                            @if ($key == 0)
                                <a href="#" pickup-time-id="{{ $pickup_time->id }}" class="time-button time-button-active w-inline-block">
                                    <div>{{ $pickup_time->time }}</div>
                                </a>
                            @else
                                <a href="#" pickup-time-id="{{ $pickup_time->id }}" class="time-button w-inline-block">
                                    <div>{{ $pickup_time->time }}</div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                @foreach ($checkouts as $checkout)
                    <div class="vendors-card ea-left">
                        <div class="flex gap-medium"><img src="{{ $checkout->photo }}" loading="lazy" alt="" class="image-17" />
                            <div>
                                <h5 class="text-color-dark-grey">{{ $checkout->name }}</h5>
                                <div class="text-size-small text-color-grey">Location: {{ $checkout->location->name }}</div>
                            </div>
                        </div>
                        <div class="div-line"></div>
                        @foreach ($checkout->products as $product)
                            <div class="vendor-item">
                                <div class="flex gap-medium">
                                    <img loading="lazy" srcset="{{ $product->featured_image }}" alt="" class="image-18" />
                                    <div>
                                        <h5 class="text-color-dark-grey">{{ $product->product_name }}</h5>
                                        <div class="text-size-small text-color-grey">{{ $product->product_variation_name }}</div>
                                        <div class="text-size-small text-color-grey">${{ $product->price }}</div>
                                    </div>
                                </div>
                                <div class="flex gap-small">
                                    <p class="m-0">x{{ $product->quantity }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <div class="sticky-summary flex-shrink-0 flex-grow-0 w-50">
                <div class="cart-summary">
                    <h4 class="text-color-dark-grey">Discount</h4>
                    <div id="btnSelectDiscount" class="div-block-28" data-toggle="modal" data-target="">
                        <div class="dropdown-toggle w-dropdown-toggle">
                            <img src="{{asset('assets/6312035b7fb097b080627244_discount icon.svg')}}" loading="lazy" alt="" />
                            <div id="applyVoucher" class="text-block-3 text-color-dark-grey">Apply Discount</div>
                            <div class="icon-3 w-icon-dropdown-toggle"></div>
                            <div id="voucherUsed" class="text-block-3 text-color-dark-grey d-none"></div>
                            <div class="icon-3 w-icon-close-toggle d-none"></div>
                        </div>
                    </div>
                    <h4 class="heading-8 text-color-dark-grey">Summary</h4>
                    <div class="div-block-24 text-color-grey">
                        <div class="inline">Total Price ({{ $total_items }} items)</div>
                        <div class="inline">${{ $total_price }}</div>
                    </div>
                    <div class="div-block-24 text-color-grey">
                        <div class="inline">Shipping Price</div>
                        <div class="inline">${{ $shipping_price }}</div>
                    </div>
                    <div id="shippingDiscountUsed" class="div-block-24 text-color-grey d-none">
                        <div class="inline">Shipping Discount Price</div>
                        <div class="inline">- $<span id="shippingDiscountPrice">0</span></div>
                    </div>
                    <div id="productDiscountUsed" class="div-block-24 text-color-grey d-none">
                        <div class="inline">Discount Price</div>
                        <div class="inline">- $<span id="productDiscountPrice">0</span></div>
                    </div>
                    <div class="div-line-sumarry"></div>
                    <div class="div-block-24 text-color-dark-grey">
                        <div class="inline text-weight-bold">Total</div>
                        <div class="inline text-weight-bold">$<span id="grandtotal-price">{{ $grandtotal_price }}</span></div>
                    </div><button id="placeOrder" type="submit" class="checkout-button oh-grow w-button">Place Order</button>
                    <button type="button" class="text-left payment-gateway-button w-inline-block">
                        <div class="text-weight-bold">HitPay Payment Gateway</div><img src="{{asset('assets/6312dbbdcf1b3f0de3362511_Hitpay.png')}}" loading="lazy" alt="" />
                    </button>
                    <button type="button" class="text-left payment-gateway-button w-inline-block">
                        <div><img src="{{asset('assets/6312f973553f41aa30ea54e6_atome%20(1).png')}}" loading="lazy" alt="" class="image-19" />
                            <div class="text-size-xtiny">Buy now pay later with Atome. The bill will be split into three easy payments.No hidden fees, 0% interest.*Only Singapore Dollar (SGD) is accepted.</div>
                        </div>
                    </button>
                    <button type="button" class="text-left payment-gateway-button w-inline-block">
                        <div>
                            <div class="text-weight-bold">PayNow</div>
                            <div class="text-size-xtiny">How to pay using paynow payment gateway :
                                <br />1. Process to checkout first
                                <br />2. Pay to UEN number: 202031871R
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </form>
        <img src="{{asset('assets/6303b67a5064f05035c5a701_shape 1.svg')}}" loading="lazy" alt="" class="absolute shape-cart" />
    </div>
</div>

<div id="addressModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addressModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content br-27">
            <div class="modal-header">
                <h4 class="modal-title h4 ml-2">Choose Address</h4>
                <button id="btnCloseAddress" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="shippingAddressList">
                    <div class="d-flex justify-content-between m-2">
                        <div class="form-block-3 w-form">
                            <input id="keywordAddress" type="text" name="keyword_address" class="text-field-2 w-input" maxlength="256" placeholder="Search address">
                        </div>
                        <button id="btnSearchAddress" type="button" class="search-modal" tabindex="0">Search</a>
                    </div>
                    <div class="div-line ml-3 mr-3"></div>
                    <div class="custom-button d-flex justify-content-center p-3 cursor-pointer mr-2 ml-2 mb-3" id="addNewAddressShipping">
                        <p class="m-0 color-custom-gray">Add New Address</p>
                    </div>
                    <div id="listAddress" class="d-flex flex-column modal-list-container"></div>
                </div>
                <div class="shipping-new-address d-none">
                    <div class="mb-3" id="name">
                        <h5 class="text-color-dark-grey mb-1">Name</h5>
                        <input type="text" class="text-field-2 w-input form-control" placeholder="Name">
                        <div class="invalid-feedback"></div>                    
                    </div>
                    <div class="mb-3" id="phoneNumber">
                        <h5 class="text-color-dark-grey mb-1">Phone Number</h5>
                        <input type="text" class="text-field-2 w-input form-control" placeholder="Phone Number">
                        <div class="invalid-feedback"></div>   
                    </div>
                    <div class="mb-3" id="additionalInformation">
                        <h5 class="text-color-dark-grey mb-1">Additional Information</h5>
                        <textarea class="text-field-2 w-input form-control" placeholder="Additional Information"></textarea>
                        <div class="invalid-feedback"></div>   
                    </div>
                    <div class="div-line"></div>
                    <h5 class="text-color-dark-grey mb-1">Address Format Type</h5>
                    <div class="d-flex mb-3" style="gap: 10px;">
                        <a href="#" class="address-new-button address-new-button-active w-inline-block" id="newAddressBuilding">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                                <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
                            </svg>
                            <div class="text-size-small">Building</div>
                        </a>
                        <a href="#" class="address-new-button w-inline-block" id="newAddressProperties">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                            </svg>
                            <div class="text-size-small">Landed Properties</div>
                        </a>
                    </div>
                    <div>
                        <div class="mb-3" id="blockNumber">
                            <h5 class="text-color-dark-grey mb-1">Block Number</h5>
                            <input type="number" class="text-field-2 w-input form-control" placeholder="Block Number">
                            <div class="invalid-feedback"></div>   
                        </div>
                        <div class="mb-3" id="streetName">
                            <h5 class="text-color-dark-grey mb-1">Street Name</h5>
                            <input type="text" class="text-field-2 w-input form-control" placeholder="Street Name">
                            <div class="invalid-feedback"></div>   
                        </div>
                        <div class="mb-3" id="unitLevel">
                            <h5 class="text-color-dark-grey mb-1">Unit Level</h5>
                            <input type="number" class="text-field-2 w-input form-control" placeholder="Unit Level">
                            <div class="invalid-feedback"></div>   
                        </div>
                        <div class="mb-3" id="unitNumber">
                            <h5 class="text-color-dark-grey mb-1">Unit Number</h5>
                            <input type="number" class="text-field-2 w-input form-control" placeholder="Unit Number">
                            <div class="invalid-feedback"></div>   
                        </div>
                        <div class="mb-3" id="buildingName">
                            <h5 class="text-color-dark-grey mb-1">Building Name</h5>
                            <input type="text" class="text-field-2 w-input form-control" placeholder="Building Name">
                            <div class="invalid-feedback"></div>   
                        </div>
                        <div class="mb-3" id="postalCode">
                            <h5 class="text-color-dark-grey mb-1">Postal Code</h5>
                            <input type="number" class="text-field-2 w-input form-control" placeholder="Postal Code">
                            <div class="invalid-feedback"></div>   
                        </div>
                    </div>
                    <div class="d-flex justify-content-end" style="gap: 10px;">
                        <button id="btnCreateAddress" class="pr-4 pl-4 checkout-button w-button">Save</button>
                        <a href="#" class="pr-4 pl-4 checkout-button w-button bg-secondary" id="cancelAddNewAddressShipping">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="discountModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="discountModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content br-27">
            <div class="modal-header">
                <h4 class="modal-title h4 ml-2">Choose Discount</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between m-2">
                    <div class="form-block-3 w-form">
                        <input type="text" class="text-field-2 w-input" maxlength="256" placeholder="Search discount code">
                    </div>
                    <a href="#" class="search-modal" tabindex="0">Search</a>
                </div>
                <div class="div-line ml-3 mr-3"></div>

                <div id="containerVoucher"></div>

                <div class="d-flex justify-content-end mt-3" style="gap: 10px;">
                    <button id="btnApplyDiscount" type="button" class="pr-4 pl-4 checkout-button w-button" data-dismiss="modal">Apply</button>
                    <button type="button" class="pr-4 pl-4 checkout-button w-button bg-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript-extra')
<script src="{{asset('assets/js/script-cart-checkout.js')}}" type="text/javascript"></script>
<script>
    function getDetailAddress(el, addressId, selected = false) {
        $.get(url + "/user/user-address/get-address/" + addressId).done(function(data) {
            if (data.block_number) {
                el.html(`
                    <h4 class="heading-7">` + data.name + `</h4>
                    <div class="text-size-small">` + data.phone + `</div>
                    <div class="text-size-small">
                        ` + data.block_number + ` ` + data.street + ` <br>
                        #` + data.unit_level + `-` + data.unit_number + ` ` + data.building_name + ` <br>
                        Singapore ` + data.postal_code + `
                    </div>`);
            } else {
                el.html(`
                    <h4 class="heading-7">` + data.name + `</h4>
                    <div class="text-size-small">` + data.phone + `</div>
                    <div class="text-size-small">
                        ` + data.unit_number + ` ` + data.street + ` <br>
                        Singapore ` + data.postal_code + `
                    </div>`);
            }

            if (selected != false)
                el.attr("selected-address", addressId);
            else
                el.removeAttr("selected-address");
        }).fail(function() {
            console.log("Error get user address!");
        });
    }

    function getAddresses(keyword, el) {
        $.post(url + "/user/user-address/search", {
            _token: CSRF_TOKEN,
            keyword: keyword,
        }).done(function(data) {
            el.html(data);
        }).fail(function() {
            console.log("Error!");
        });
    }

    function getDiscounts(keyword) {
        var urlDiscount = keyword == "" ? (url + "/user/discount/search") : (url + "/user/discount/search/" + keyword);
        $.get(urlDiscount).done(function(data) {
            $("#containerVoucher").html(data);
        }).fail(function() {
            console.log("Error!");
        });
    }

    function clearInput() {
        $("input, textarea").val("").removeClass("is-invalid");
        $(".invalid-feedback").html("");
    }
</script>
<script>
    var editAddress = $("#deliveryAddressData"), pickupTime = "AM";

    $(document).ready(function() {
        // give target to button modal discount
        $("#btnSelectDiscount").attr("data-target", "#discountModal");

        // load default delivery address
        getDetailAddress($("#deliveryAddressData"), 1, true);
        
        // load default different delivery address
        getDetailAddress($("#shippingAddressData"), 1);
    });
    
    $("#placeOrder").on("click", function() {
        // Shipping Method
        var shipping_method = $(".shipping-button.shipping-button-active");
        if ($("input[name=pickup_method_id]").length <= 0 && shipping_method.length > 0) {
            $("<input>").attr({
                type: "hidden",
                name: "pickup_method_id",
                value: shipping_method.attr("pickup-method-id")
            }).appendTo('#checkoutForm');
        }
        
        // Time
        var time = $(".time-button.time-button-active");
        if ($("input[name=pickup_time_id]").length <= 0 && time.length > 0) {
            $("<input>").attr({
                type: "hidden",
                name: "pickup_time_id",
                value: time.attr("pickup-time-id")
            }).appendTo('#checkoutForm');
        }

        var method_type = shipping_method.find("div").html();
        if (method_type.includes("self")) {
            if ($("input[name=self_collection_address_id]").length <= 0 && editAddress != "") {
                $("<input>").attr({
                    type: "hidden",
                    name: "self_collection_address_id",
                    value: $("#pickupShippingDetail").attr("selected-address")
                }).appendTo('#checkoutForm');
            } else {
                alert("Please try again or refresh this page!");
            }
        } else {
            if ($("input[name=billing_address_id]").length <= 0 && $("#deliveryAddressData").attr("selected-address") !== undefined) {
                $("<input>").attr({
                    type: "hidden",
                    name: "billing_address_id",
                    value: $("#deliveryAddressData").attr("selected-address")
                }).appendTo('#checkoutForm');
            }

            if ($("input[name=shipping_address_id]").length <= 0 && $("#shippingAddressData").attr("selected-address") !== undefined) {
                $("<input>").attr({
                    type: "hidden",
                    name: "shipping_address_id",
                    value: $("#shippingAddressData").attr("selected-address")
                }).appendTo('#checkoutForm');
            }
        }
        e.preventDefault();
    });
    
    $("#btnEditDeliveryAddress").on("click", function() {
        // set editAddress to accessor (#deliveryAddressData) when edit delivery address
        editAddress = $("#deliveryAddressData");

        // get list address for modal address
        getAddresses("", $("#listAddress"));
    });

    $("#btnEditShippingAddress").on("click", function() {
        // set editAddress to accessor (#shippingAddressData) when edit another delivery address
        editAddress = $("#shippingAddressData");

        // get list address for modal address
        getAddresses("", $("#listAddress"));
    });
    
    $("#btnSearchAddress").on("click", function() {
        var keyword = $("#keywordAddress").val();

        // get list address for modal address based on "keyword"
        getAddresses(keyword, $("#listAddress"));
    });

    $("#btnCloseAddress").on("click", function() {
        $("#keywordAddress").val("");
    });

    $("#btnCreateAddress").on("click", function() {
        $.post(url + "/user/user-address/create-address", {
            _token: CSRF_TOKEN,
            name: $("#name:visible input").val(),
            phone: $("#phoneNumber:visible input").val(),
            additional_info: $("#additionalInformation:visible textarea").val(),
            block_number: $("#blockNumber:visible input").val(),
            street: $("#streetName:visible input").val(),
            unit_level: $("#unitLevel:visible input").val(),
            unit_number: $("#unitNumber:visible input").val(),
            building_name: $("#buildingName:visible input").val(),
            postal_code: $("#postalCode:visible input").val(),
        }).done(function(data) {
            // clear keyword search address
            $("#keywordAddress").val("");

            // clear list address
            $("#shippingAddressList").removeClass("d-none");
            
            // hide new address modal
            $(".shipping-new-address").addClass("d-none");
            
            // get new list address
            getAddresses("", $("#listAddress"));
            
            // clear all input from new address modal
            clearInput();
            
            // alert status create address fail or success
            alert(data);
        }).fail(function(error) {
            var errorObj = error.responseJSON.errors;
            var keys = Object.keys(errorObj);

            keys.forEach((key) => {
                var elementID = "name";
                if (key == "phone") elementID = "phoneNumber";
                else if (key == "additional_info") elementID = "additionalInformation";
                else if (key == "block_number") elementID = "blockNumber";
                else if (key == "street") elementID = "streetName";
                else if (key == "unit_level") elementID = "unitLevel";
                else if (key == "unit_number") elementID = "unitNumber";
                else if (key == "building_name") elementID = "buildingName";
                else if (key == "postal_code") elementID = "postalCode";
                
                $("#" + elementID +" input").addClass("is-invalid");
                $("#" + elementID +" .invalid-feedback").html(errorObj[key]);
            });
        });
    });

    $("#deliveryShippingButton").on('click', function() {
        // clear selected address from delivery address and pickup address
        $("#pickupShippingDetail, #deliveryAddressData, #shippingAddressData").removeAttr("selected-address");
        
        // load default delivery address
        getDetailAddress($("#deliveryAddressData"), 1, true);
        
        // load default different delivery address
        getDetailAddress($("#shippingAddressData"), 1);

        // show delivery content
        $("#deliveryShippingDetail").removeClass("d-none");
        
        // hide shipping content
        $("#pickupShippingDetail").addClass("d-none");
    });

    $("#pickupShippingButton").on('click', function() {
        // clear selected address from delivery address and pickup address
        $("#pickupShippingDetail, #deliveryAddressData, #shippingAddressData").removeAttr("selected-address");

        // get all pickup address
        $.post(url + "/user/pickup-address/search", {
            _token: CSRF_TOKEN,
            keyword: "",
        }).done(function(data) {
            $("#pickupShippingDetail .container-address").html(data);
        }).fail(function(error) {
            console.log("Error!")
        });

        // hide delivery content
        $("#deliveryShippingDetail").addClass("d-none");
        
        // show shipping content
        $("#pickupShippingDetail").removeClass("d-none");
    });

    $(".shipping-button").on('click', function() {
        $(".shipping-button").removeClass("shipping-button-active");
        $(".shipping-icon").attr("fill", "#444349");
        $(this).addClass("shipping-button-active");
        $(this).find(".shipping-icon").attr("fill", "#ffffff");
    });

    $("#btnSelectDiscount").on("click", function() {
        getDiscounts("");
    });

    $("#btnApplyDiscount").on("click", function() {
        if ($("#productVoucher").attr("selected-voucher") != "" && $("#shippingVoucher").attr("selected-voucher") != "") {
            $.post(url + "/user/discount/apply-voucher", {
                _token: CSRF_TOKEN,
                product_voucher: $("#productVoucher").attr("selected-voucher"),
                shipping_voucher: $("#shippingVoucher").attr("selected-voucher"),
            }).done(function(data) {
                console.log(data);
                if (data.product_voucher !== undefined) {
                    $("#applyVoucher").addClass("d-none").next().addClass("d-none");
                    $("#voucherUsed").html(data.product_voucher.name).removeClass("d-none").next().removeClass("d-none");
                    $("#productDiscountUsed").removeClass("d-none");
                    $("#productDiscountPrice").html(data.product_voucher.amount);
                } else {
                    $("#applyVoucher").removeClass("d-none").next().removeClass("d-none");
                    $("#voucherUsed").html("").addClass("d-none").next().addClass("d-none");
                    $("#productDiscountUsed").addClass("d-none");
                    $("#productDiscountPrice").html("0");
                }

                if (data.shipping_voucher !== undefined) {
                    $("#shippingDiscountUsed").removeClass("d-none");
                    $("#shippingDiscountPrice").html(data.shipping_voucher.amount);
                } else {
                    $("#shippingDiscountUsed").addClass("d-none");
                    $("#shippingDiscountPrice").html("");
                }

                $("#grandtotal-price").html(data.total_price_after_discount);
            }).fail(function(error) {
                console.log(error);
            });
        }
    });

    $(".time-button").on('click', function() {
        $(".time-button").removeClass("time-button-active");
        $(this).addClass("time-button-active");
        pickupTime = $(this).find("div").html();
    });

    $(".payment-gateway-button").on('click', function() {
        $(".payment-gateway-button").removeClass("payment-gateway-button-active");
        $(this).addClass("payment-gateway-button-active");
    });

    var shippingAddress = false;
    $("#diffShippingAddress").on('click', function() {
        if (shippingAddress == false) {
            $("#shippingAddress").slideDown();
            shippingAddress = true;
            $("#iconShippingAddress").attr("src", $("#iconShippingAddress").attr("src").replace("circle", "check"));

            // set editAddress to accessor (#shippingAddressData)
            editAddress = $("#shippingAddressData");
            
            // default selected-address on another shipping address
            editAddress.attr("selected-address", 1);
        } else {
            $("#shippingAddress").slideUp();
            shippingAddress = false;
            $("#iconShippingAddress").attr("src", $("#iconShippingAddress").attr("src").replace("check", "circle"));

            // set editAddress to accessor (#deliveryAddressData)
            editAddress = $("#deliveryAddressData");
            
            // remove default selected-address on another shipping address
            $("#shippingAddressData").removeAttr("selected-address");

            // remove input hidden another shipping address
            $("input[name=shipping_address_id]").remove();
        }
    });

    const nth = function(d) {
        if (d > 3 && d < 21) return 'th';
        switch (d % 10) {
            case 1:
                return "st";
            case 2:
                return "nd";
            case 3:
                return "rd";
            default:
                return "th";
        }
    }

    $("#shippingDate").on('change', function() {
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        if ($(this).val() != "") {
            const selectedDate = new Date($(this).val());
            let dd = selectedDate.getDate();

            $("#shippingDateFormat").html(days[selectedDate.getDay()] + ", " + dd + nth(dd) + " " + months[selectedDate.getMonth()]);
        }
    });

    document.getElementById('shippingDate').valueAsDate = new Date("<?= $minDate ?>");
    $("#shippingDate").change();

    $("#addNewAddressShipping").on("click", function(){
        $("#shippingAddressList").addClass("d-none");
        $(".shipping-new-address").removeClass("d-none");
    });

    $("#cancelAddNewAddressShipping").on("click", function(){
        $("#shippingAddressList").removeClass("d-none");
        $(".shipping-new-address").addClass("d-none");
    });

    $("#newAddressBuilding").on("click", function(){
        $(".address-new-button").removeClass("address-new-button-active");
        $(this).addClass("address-new-button-active");
        $("#blockNumber").removeClass("d-none");
        $("#unitLevel").removeClass("d-none");
        $("#buildingName").removeClass("d-none");
    });

    $("#newAddressProperties").on("click", function(){
        $(".address-new-button").removeClass("address-new-button-active");
        $(this).addClass("address-new-button-active");
        $("#blockNumber").addClass("d-none");
        $("#unitLevel").addClass("d-none");
        $("#buildingName").addClass("d-none");
    });
</script>
@endsection