@extends('user.template.layout')

@section('page-title')
Profile Settings - BigV
@endsection

@section('meta-title')
    Profile - BigV
@endsection

@section('meta-description')
    Take a look at your profile.
@endsection

@section('meta-image')
    {{asset('assets/62ffbe41b946fc3a2b7b6747_Big%20V(NoTag)-ColorB%202.png')}}
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
              <a href="{{url('/profile')}}" class="transaction-menus text-color-grey" style="text-decoration: none; white-space: nowrap;">Profile Settings</a>
              <a href="{{url('/user/transaction')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Transactions</a>
              <a href="{{url('/user/user-address')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Addresses</a>
              <a href="{{url('/user/discount')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Promos</a>
          </div>
        </div>
      </div>
      <div class="profile-column" style="padding: 20px;">
        <div class="form-wrapper-profile">
          <h1 class="signup-header">Your Profile</h1>
          <div class="margin-bottom-2">Change to edit your information</div>
          @if(session('success'))
            <p style="font-size:14px; color: #00ab41; margin: 15px 0;"><b>{{session('success')}}</b></p>
          @endif
          <div class="w-form">
            <form method="POST" class="form-field-wrapper-2" action="{{url('/profile/edit')}}">
                @csrf
              <div class="text-field-wrapper">
                <label class="field-label">First Name</label>
                <input type="text" class="text-field-3 w-input" maxlength="256" name="name" value="{{$user->name}}" placeholder="e.g. Eddy" required="" />
              </div>
              <div class="text-field-wrapper">
                <label class="field-label">Email</label>
                <input type="email" class="text-field-3 w-input" maxlength="256" value="{{$user->email}}" placeholder="e.g. eddy.lin@email.com" readonly />
              </div>
              <div class="text-field-wrapper">
                <label class="field-label">Password</label>
                <input type="password" class="text-field-3 w-input" style="margin-bottom:10px;" maxlength="256" name="password" placeholder="Password" />
                <label class="field-label">Confirm Password</label>
                <input type="password" class="text-field-3 w-input" maxlength="256" name="password_confirmation" placeholder="Password" />
                <div class="field-description">Must be at least 8 characters</div>
                <div class="field-description">*Input a new Password to change the old Password!</div>
              </div>
              <div class="text-field-wrapper">
                <label class="field-label">Phone Number</label>
                <input type="tel" class="text-field-3 w-input" maxlength="256" value="{{$user->phone}}" name="phone" placeholder="e.g. 6123847502" required="" />
              </div>
              <div class="text-field-wrapper">
                <label class="field-label">Birthdate</label>
                <input type="date" class="text-field-3 w-input" maxlength="256" name="date_of_birth" value="{{$user->date_of_birth}}" placeholder="e.g. 19 April 2002" required="" />
              </div>
              @if ($errors->any())
              @foreach ($errors->all() as $error)
              <p style="font-size:14px; color: #ed3419; margin-bottom: 15px;"><b>{{$error}}</b></p>
              <?php break; ?>
              @endforeach
              @endif
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