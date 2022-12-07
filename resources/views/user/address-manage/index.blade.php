@extends('user.template.layout')

@section('page-title')
Addresses - Big V
@endsection

@section('head-extra')
<link href="{{asset('assets/css/style-cart-checkout.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/style-profile.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="header-section">
      <h2 class="orange-text">Addresses</h2>
    </div>
    <div class="transactions-page-wrapper" style="width: 100%;">
      <div class="profile-page-menu">
        <div class="flex gap-small">
          <div><b>{{auth()->user()->name}}</b></div>
        </div>
        <div class="div-line" style="margin:0 !important;"></div>
        <div class="w-form">
          <div class="form-2">
              <a href="{{url('/profile')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Profile Settings</a>
              <a href="{{url('/user/transaction')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Transactions</a>
              <a href="{{url('/user/user-address')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Addresses</a>
              <a href="{{url('/user/promo')}}" class="transaction-menus text-color-grey" style="text-decoration: none;">Promos</a>
          </div>
        </div>
      </div>
      <div class="transactions-column" style="margin-bottom: 5vh;">
        <div class="vendors-card">
          <div class="address-text-div">
            <h4>All Address</h4><button class="add-button w-button" type="button" class="btn" data-toggle="modal" data-target="#addressModal">Add New Address</button>
          </div>
          @if(session('success'))
            <p style="font-size:14px; color: #00ab41; margin: 15px 0;"><b>{{session('success')}}</b></p>
          @endif
          @foreach ($addresses as $a)
          <div class="delivery-add-item">
            <div style="width: 100%;">
              <h4 class="heading-7">{{$a->name}}</h4>
              <div class="text-size-small">{{$a->phone}}</div>
              @if ($a->building_name != null)
              <div class="text-size-small">
                    {{$a->block_number}} {{$a->street}}<br>
                    #{{$a->unit_level}}-{{$a->unit_number}} {{$a->building_name}} <br>
                    Singapore {{$a->postal_code}}
              </div>
              @else
              <div class="text-size-small">
                {{$a->unit_number}} {{$a->street_name}}<br>
                Singapore {{$a->postal_code}}
              </div>
              @endif
            </div>
            <form action="{{url('user/user-address/'.$a->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button style="background:none;" onclick="if(!confirm('Are you sure want to delete this Address?')) return false;" type="submit"><img src="{{asset('assets/630b4bc5cd03300cd594cf9c_Vector (3).svg')}}" loading="lazy" alt="" class="image-21" /></button>
            </form>
            <!--<img src="{{asset('assets/630b9533cf47ce568d633011_pencil.svg')}}" loading="lazy" alt="" class="image-21" />-->
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <div id="addressModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addressModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content br-27">
                <div class="modal-header">
                    <h4 class="modal-title h4 ml-2">Add New Address</h4>
                    <button id="btnCloseAddress" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="shipping-new-address">
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
                            <a href="#" class="d-flex address-new-button address-new-button-active w-inline-block"
                                id="newAddressBuilding">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                                    <path
                                        d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                                </svg>
                                <div class="text-size-small">Building</div>
                            </a>
                            <a href="#" class="d-flex address-new-button w-inline-block" id="newAddressProperties">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                    <path fill-rule="evenodd"
                                        d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                                </svg>
                                <div class="text-size-small">Landed Properties</div>
                            </a>
                            <input type="hidden" value="building" name="type" id="addressType">
                        </div>
                        <div>
                            <div class="mb-3" id="blockNumber">
                                <h5 class="text-color-dark-grey mb-1">Block Number</h5>
                                <input type="number" class="text-field-2 w-input form-control"
                                    placeholder="Block Number">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3" id="streetName">
                                <h5 class="text-color-dark-grey mb-1">Street Name</h5>
                                <input type="text" class="text-field-2 w-input form-control"
                                    placeholder="Street Name">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3" id="unitLevel">
                                <h5 class="text-color-dark-grey mb-1">Unit Level</h5>
                                <input type="number" class="text-field-2 w-input form-control" placeholder="Unit Level">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3" id="unitNumber">
                                <h5 class="text-color-dark-grey mb-1">Unit Number</h5>
                                <input type="number" class="text-field-2 w-input form-control"
                                    placeholder="Unit Number">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3" id="buildingName">
                                <h5 class="text-color-dark-grey mb-1">Building Name</h5>
                                <input type="text" class="text-field-2 w-input form-control"
                                    placeholder="Building Name">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3" id="postalCode">
                                <h5 class="text-color-dark-grey mb-1">Postal Code</h5>
                                <input type="number" class="text-field-2 w-input form-control"
                                    placeholder="Postal Code">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end" style="gap: 10px;">
                            <button id="btnCreateAddress" class="pr-4 pl-4 checkout-button w-button">Save</button>
                            <button  type="button" class="close" data-dismiss="modal" class="pr-4 pl-4 checkout-button w-button bg-secondary"
                                id="cancelAddNewAddressShipping" style="font-size:16px;">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript-extra')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
<script src="{{asset('assets/js/script-transaction.js')}}" type="text/javascript"></script>
<script>
     $("#newAddressBuilding").on("click", function() {
        $(".address-new-button").removeClass("address-new-button-active");
        $(this).addClass("address-new-button-active");
        $("#blockNumber").removeClass("d-none");
        $("#unitLevel").removeClass("d-none");
        $("#buildingName").removeClass("d-none");
        $("#addressType").val("building");
    });

    $("#newAddressProperties").on("click", function() {
        $(".address-new-button").removeClass("address-new-button-active");
        $(this).addClass("address-new-button-active");
        $("#blockNumber").addClass("d-none");
        $("#unitLevel").addClass("d-none");
        $("#buildingName").addClass("d-none");
        $("#addressType").val("property");
    });
    
    $("#btnCreateAddress").on("click", function(){
        $.post(url + "/user/checkout/user-address/create-address", {
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
            type: $("#addressType").val()
        }).done(function(data) {
            // alert status create address fail or success
            alert(data);
            location.reload();
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

                $("#" + elementID + " input").addClass("is-invalid");
                $("#" + elementID + " .invalid-feedback").html(errorObj[key]);
            });
        });
    });
</script>
@endsection