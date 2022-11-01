@extends('user.template.layout')

@section('page-title')
Transaction - Big V
@endsection

@section('head-extra')
<link href="{{asset('assets/css/style-transaction.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="content">
    <div class="header-section">
      <h2 class="orange-text">Transactions</h2>
    </div>
    <div class="transactions-page-wrapper">
      <div class="profile-page-menu">
        <div class="flex gap-small"><img
            src="{{asset('assets/630193c64ebe686851463727_profile-002.jpg')}}"
            loading="lazy" width="40" alt="" class="image-13" />
          <div>John Doe</div>
        </div>
        <div class="w-form">
          <form id="email-form-2" name="email-form-2" data-name="Email Form 2" method="get" class="form-2"><label
              for="email" class="transaction-menus">Transactions</label><label for="email"
              class="transaction-menus">Profile Settings</label><label for="email"
              class="transaction-menus">Addresses</label><label for="email" class="transaction-menus">Promos</label>
          </form>
        </div>
      </div>
      <div class="transactions-column">
        <div class="form-block w-form">
          <form id="email-form" name="email-form" data-name="Email Form" method="get" autocomplete="off" class="form">
            <div class="input _w-100-responsive">
              <div class="input__reset"></div>
              <div class="input__field-wrapper">
                <input type="text" class="input__field-copy w-input" maxlength="256"
                  name="Search-2" data-name="Search 2" placeholder="Search a Product" id="Search-2" />
                <div class="input__icon w-embed"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M18.677 19.607L12.962 13.891C10.4196 15.6985 6.91642 15.2564 4.90285 12.8739C2.88929 10.4915 3.03714 6.96361 5.24298 4.75802C7.44824 2.55147 10.9765 2.40298 13.3594 4.41644C15.7422 6.42989 16.1846 9.93347 14.377 12.476L20.092 18.192L18.678 19.606L18.677 19.607ZM9.48498 5.00001C7.58868 4.99958 5.95267 6.3307 5.56745 8.18745C5.18224 10.0442 6.15369 11.9163 7.89366 12.6703C9.63362 13.4242 11.6639 12.8529 12.7552 11.3021C13.8466 9.75129 13.699 7.64734 12.402 6.26402L13.007 6.86402L12.325 6.18402L12.313 6.17202C11.5648 5.4192 10.5464 4.99715 9.48498 5.00001Z"
                      fill="currentColor"></path>
                  </svg></div>
              </div>
            </div>
          </form>
        </div>
        <div class="flex gap-small column-responsive">
          <div>Status</div>
          <div class="div-block-27 wrap-responsive"><a href="#" class="delivery-button w-inline-block">
              <div>Order Pending</div>
            </a><a href="#" class="delivery-button w-inline-block">
              <div>Paid</div>
            </a><a href="#" class="delivery-button w-inline-block">
              <div>Delivered</div>
            </a><a href="#" class="delivery-button w-inline-block">
              <div>Success</div>
            </a><a href="#" class="delivery-button w-inline-block">
              <div>Refund</div>
            </a></div>
        </div>
        @foreach ($transactions as $transaction)
          <div class="transaction-card">
            <div class="flex space-between">
              <div class="flex gap-small">
                <div>
                  <h5 class="text-color-dark-grey">ID: {{ $transaction->id }}</h5>
                  <div class="text-size-small text-color-grey">{{ date('d F Y', strtotime($transaction->created_at)) }}</div>
                  {{-- <div class="text-size-small text-color-grey">4 September</div> --}}
                </div>
              </div>
              <div class="flex gap-small">
                <h5 class="text-color-dark-grey">Status</h5><a href="#" class="status-button-like w-inline-block">
                  <div>{{ $transaction->transaction_status->name }}</div>
                </a>
              </div>
            </div>
            <div class="div-line-sumarry"></div>
            @php ($current_vendor = 0)
            @foreach ($transaction->carts as $cart)
              @if ($current_vendor != $cart->vendor_id)
                <div class="flex space-between">
                  <div class="flex gap-small"><img
                      src="{{asset('assets/630193c64ebe68075a463721_profile-005.jpg')}}"
                      loading="lazy" alt="" class="vendor-image" />
                    <div>
                      <h5 class="text-color-dark-grey">{{ $cart->vendor_name }}</h5>
                    </div>
                  </div>
                </div>
                @php ($current_vendor = $cart->vendor_id)
              @endif
              <div class="vendor-item">
                <div class="flex gap-medium"><img
                    src="{{asset('assets/6308e8ded34a4e6728a0f147_image%2031.jpg')}}"
                    loading="lazy"
                    srcset="{{asset('assets/6308e8ded34a4e6728a0f147_image%2031.jpg')}}"
                    sizes="(max-width: 479px) 61vw, 70px" alt="" class="image-18" />
                  <div>
                    <h5 class="text-color-dark-grey">{{ $cart->product_name }}</h5>
                    <div class="text-size-small text-color-grey">Variant: {{ $cart->product_variation_name }}</div>
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
<script src="{{asset('assets/js/script-transaction.js')}}" type="text/javascript"></script>
@endsection