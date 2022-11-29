@extends('user.template.layout')

@section('page-title')
Promos - Big V
@endsection

@section('head-extra')
<link href="{{asset('assets/css/style-transaction.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="content">
    <div class="header-section">
      <h2 class="orange-text">Promos</h2>
    </div>
    <div class="transactions-page-wrapper">
      <div class="profile-page-menu">
        <div class="flex gap-small">
          <div><b>{{auth()->user()->name}}</b></div>
        </div>
        <div class="div-line" style="margin:0 !important;"></div>
        <div class="w-form">
          <div class="form-2">
              <a href="{{url('/user/profile')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Profile Settings</a>
              <a href="{{url('/user/transaction')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Transactions</a>
              <a href="{{url('/user/address')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Addresses</a>
              <a href="{{url('/user/promo')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Promos</a>
          </div>
        </div>
      </div>
      <div class="promo-column-profile">
        <div class="promo-row-top">
          <div class="text-size-small text-color-grey">Here are the Promos available for you</div>
            <div class="promo-div">
                <div id="w-node-_5eb6a600-3317-8d0d-76be-b3ed7dd852c4-92c73a6a"><img
                        src="{{ asset('assets/diskon1.jpg') }}" loading="lazy"
                        id="w-node-_5eb6a600-3317-8d0d-76be-b3ed7dd852c5-92c73a6a" height="410"
                        sizes="(max-width: 479px) 46vw, (max-width: 767px) 41vw, (max-width: 991px) 50vw, 46vw"
                        srcset="{{ asset('assets/diskon1.jpg') }}" alt=""
                        class="ea-left" /></div>
                <div id="w-node-_5eb6a600-3317-8d0d-76be-b3ed7dd852c6-92c73a6a" class="div-block-2"><img
                        src="{{ asset('assets/diskon2.webp') }}" loading="lazy"
                        id="w-node-_5eb6a600-3317-8d0d-76be-b3ed7dd852c7-92c73a6a" alt="" class="ea-top" />
                </div>
                <div id="w-node-_5eb6a600-3317-8d0d-76be-b3ed7dd852c8-92c73a6a" class="div-block-2"><img
                        src="{{ asset('assets/diskon3.jpg') }}" width="351" height="183" loading="lazy"
                        id="w-node-_5eb6a600-3317-8d0d-76be-b3ed7dd852c9-92c73a6a" alt="" class="ea-right" />
                </div>
            </div>
        </div>
        <div class="promo-row-bottom" style="margin-bottom: 5vh;">
          <div class="div-block-29">
            <h4 class="heading-7"><b>Apply Code</b></h4>
            <div class="form-block-2 w-form">
              <form id="email-form-2" name="email-form-2" data-name="Email Form 2" method="get"><input type="text"
                  class="text-field-2 w-input" maxlength="256" name="Code-2" data-name="Code 2" placeholder="Enter Code"
                  id="Code-2" required="" /></form>
            </div>
          </div>
          @for($i = 0; $i < 5; $i++)
          <div class="discount-div-claim">
            <div class="div-block-30-copy">
              <h4 class="heading-7">November Sale</h4>
              <!-- <a href="#" class="discount-button-claim w-button">Claim</a> -->
            </div>
            <div class="text-size-small">Discount 50%, max $10 with minimum purchase of $30</div>
          </div>
          @endfor
        </div>
      </div>
    </div>
</div>
@endsection

@section('javascript-extra')
<script src="{{asset('assets/js/script-transaction.js')}}" type="text/javascript"></script>
@endsection