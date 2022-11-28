@extends('user.template.layout')

@section('page-title')
Transaction - Big V
@endsection

@section('head-extra')
<link href="{{asset('assets/css/style-transaction.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="content" style="min-height:100vh;">
    <div class="header-section">
      <h2 class="orange-text">Transactions</h2>
    </div>
    <div class="transactions-page-wrapper">
      <div class="profile-page-menu">
        <div class="flex gap-small">
          <div><b>{{auth()->user()->name}}</b></div>
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
                    @if ($cart->product_variation_name != "novariation"):
                      <div class="text-size-small text-color-grey">Variant: {{ $cart->product_variation_name }}</div>
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
    <div class="pagination flex justify-center margin-large" style="display:none;">
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
