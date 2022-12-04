@extends('user.template.layout')

@section('page-title')
Profile Settings - Big V
@endsection

@section('head-extra')
<link href="{{asset('assets/css/style-profile.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="content">
    <div class="header-section">
      <h2 class="orange-text">Profile</h2>
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
      <div class="profile-column" style="padding: 20px;">
        <div class="form-wrapper-profile">
          <h1 class="signup-header">Your Profile</h1>
          <div class="margin-bottom-2">Change to edit your information</div>
          <div class="w-form">
            <form method="POST" class="form-field-wrapper-2" action="{{url('/profile/edit')}}">
                @csrf
              <div class="text-field-wrapper">
                <label class="field-label">First Name</label>
                <input type="text" class="text-field-3 w-input" maxlength="256" name="first-name" placeholder="e.g. Eddy" required="" />
              </div>
              <div class="text-field-wrapper">
                <label class="field-label">Last Name</label>
                <input type="text" class="text-field-3 w-input" maxlength="256" name="last-name" placeholder="e.g. Lin" required="" />
              </div>
              <div class="text-field-wrapper">
                <label class="field-label">Email</label>
                <input type="email" class="text-field-3 w-input" maxlength="256" name="email" placeholder="e.g. eddy.lin@email.com" required="" />
              </div>
              <div class="text-field-wrapper">
                <label class="field-label">Password</label>
                <input type="password" class="text-field-3 w-input" maxlength="256" name="password" placeholder="Password" />
                <label class="field-label">Confirm Password</label>
                <input type="password" class="text-field-3 w-input" maxlength="256" name="password-confirm" placeholder="Password" />
                <div class="field-description">Must be at least 8 characters</div>
              </div>
              <div class="text-field-wrapper">
                <label class="field-label">Phone Number</label>
                <input type="tel" class="text-field-3 w-input" maxlength="256" name="phone" placeholder="e.g. 6123847502" required="" />
              </div>
              <div class="text-field-wrapper">
                <label class="field-label">Birthdate</label>
                <input type="date" class="text-field-3 w-input" maxlength="256" name="date_of_birth" placeholder="e.g. 19 April 2002" required="" />
              </div>
              <input type="submit" value="Save" data-wait="Please wait..." class="button-4 w-button" />
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('javascript-extra')
<script src="{{asset('assets/js/script-transaction.js')}}" type="text/javascript"></script>
@endsection