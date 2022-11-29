@extends('user.template.layout')

@section('page-title')
Addresses - Big V
@endsection

@section('head-extra')
<link href="{{asset('assets/css/style-profile.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="content">
    <div class="header-section">
      <h2 class="orange-text">Addresses</h2>
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
      <div class="transactions-column" style="margin-bottom: 5vh;">
        <div class="vendors-card">
          <div class="address-text-div">
            <h4>All Address</h4><a href="#" class="add-button w-button">Add New Address</a>
          </div>
          @for ($i=0; $i < 5; $i++)
          <div class="delivery-add-item">
            <div>
              <h4 class="heading-7">Neilson Soeratman</h4>
              <div class="text-size-small">082337363440</div>
              <div class="text-size-small">Jl. Raya Semampir Barat no. 2Sukolilo, Kota Surabaya, 60119</div>
            </div><img
              src="{{asset('assets/630b4bc5cd03300cd594cf9c_Vector (3).svg')}}"
              loading="lazy" alt="" class="image-21" /><img
              src="{{asset('assets/630b9533cf47ce568d633011_pencil.svg')}}"
              loading="lazy" alt="" class="image-21" />
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