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
      <h2 class="orange-text">Promos</h2>
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
      <div class="promo-column-profile">
        <div class="promo-row-top">
          <div class="text-size-small text-color-grey">Here are the Promos available for you</div>
          <div class="promo-div">
            <div id="w-node-_431f4a13-fa2b-44ca-bc6f-d5a892166bff-48a9ac08"><img
                src="{{asset('assets/62fc7f0235498a4fb875692e_Rectangle 37.webp')}}"
                loading="lazy" id="w-node-_431f4a13-fa2b-44ca-bc6f-d5a892166c00-48a9ac08" height="410"
                sizes="(max-width: 479px) 46vw, (max-width: 767px) 52vw, (max-width: 991px) 54vw, 534.265625px"
                srcset="{{asset('assets/62fc7f0235498a4fb875692e_Rectangle%2037.webp')}}"
                alt="" class="image-26" /></div>
            <div id="w-node-_431f4a13-fa2b-44ca-bc6f-d5a892166c01-48a9ac08" class="div-block"><img
                src="{{asset('assets/62fc7f0235498a5404756931_Rectangle 38.webp')}}"
                loading="lazy" id="w-node-_431f4a13-fa2b-44ca-bc6f-d5a892166c02-48a9ac08" alt="" class="ea-top" /></div>
            <div id="w-node-_431f4a13-fa2b-44ca-bc6f-d5a892166c03-48a9ac08" class="div-block-2"><img
                src="{{asset('assets/62fc7f0235498a3850756933_Rectangle 39.webp')}}"
                loading="lazy" id="w-node-_431f4a13-fa2b-44ca-bc6f-d5a892166c04-48a9ac08" alt="" class="ea-right" />
            </div>
          </div>
        </div>
        <div class="promo-row-bottom">
          <div class="div-block-29">
            <h4 class="heading-7">Apply Code</h4>
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