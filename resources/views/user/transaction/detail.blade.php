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
      <h2 class="orange-text">Transaction Detail</h2>
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
        <div class="transaction-card">
          <div class="flex space-between">
            <div class="flex gap-small">
              <div>
                <h5 class="text-color-dark-grey">Transaction ID</h5>
                <div class="text-size-small text-color-grey">4 September</div>
              </div>
            </div>
            <div class="flex gap-small">
              <h5 class="text-color-dark-grey">Status</h5><a href="#" class="status-button-like w-inline-block">
                <div>Delivered</div>
              </a>
            </div>
          </div>
          <div class="div-line-sumarry"></div>
          <div class="flex space-between">
            <div class="flex gap-small"><img
                src="{{asset('assets/630193c64ebe68075a463721_profile-005.jpg')}}"
                loading="lazy" alt="" class="vendor-image" />
              <div>
                <h5 class="text-color-dark-grey">Vendor Name</h5>
              </div>
            </div>
          </div>
          <div style="display: flex; flex-direction: column;">
            <div class="vendor-item">
              <div class="flex gap-medium"><img
                  src="{{asset('assets/6308e8ded34a4e6728a0f147_image%2031.jpg')}}"
                  loading="lazy"
                  srcset="{{asset('assets/6308e8ded34a4e6728a0f147_image%2031.jpg')}}"
                  sizes="(max-width: 479px) 61vw, 70px" alt="" class="image-18" />
                <div>
                  <h5 class="text-color-dark-grey">Cute Tiger Aroma Stone Set</h5>
                  <div class="text-size-small text-color-grey">Color: white</div>
                  <div class="text-size-small text-color-grey">$10</div>
                </div>
              </div>
              <div class="div-block-36">
                <div>14x</div>
                <div>$140</div>
              </div>
            </div>
            <div class="flex" style="flex-direction: column; gap: 15px; margin-bottom: 18px;">
              <div class="flex" style="justify-content:space-between; width: 100%;">
                  <div class="text-size-small text-color-grey">Submit your Review</div>
                  <div class="flex">
                      @for ($j = 1; $j <= 5; $j++)
                      <div class="c-product-rating__star star-review" style="cursor: pointer;" step="{{$j}}">
                          <div class="icon">
                              <div class="fas fa-star">
                                <img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" />
                              </div>
                          </div>
                      </div>
                      @endfor
                  </div>
                  <input type="hidden" value="5">
              </div>
              <textarea style="width: 100%; border-radius: 10px; padding: 10px; resize: none; border: #c5c5c5 1px solid; font-size: 0.875rem;" rows="2"></textarea>
            </div>
          </div>
          <div class="div-line-sumarry"></div>
          <div class="flex space-between">
            <div class="flex gap-small"><img
                src="{{asset('assets/630193c64ebe68075a463721_profile-005.jpg')}}"
                loading="lazy" alt="" class="vendor-image" />
              <div>
                <h5 class="text-color-dark-grey">Vendor Name</h5>
              </div>
            </div>
          </div>
          @for ($i = 0; $i < 4; $i++)
          <div style="display: flex; flex-direction: column;">
            <div class="vendor-item">
              <div class="flex gap-medium"><img
                  src="{{asset('assets/6308e8ded34a4e6728a0f147_image%2031.jpg')}}"
                  loading="lazy"
                  srcset="{{asset('assets/6308e8ded34a4e6728a0f147_image%2031.jpg')}}"
                  sizes="(max-width: 479px) 61vw, 70px" alt="" class="image-18" />
                <div>
                  <h5 class="text-color-dark-grey">Cute Tiger Aroma Stone Set</h5>
                  <div class="text-size-small text-color-grey">Color: white</div>
                  <div class="text-size-small text-color-grey">$10</div>
                </div>
              </div>
              <div class="div-block-36">
                <div>14x</div>
                <div>$140</div>
              </div>
            </div>
            <div class="flex" style="flex-direction: column; gap: 15px; margin-bottom: 18px;">
              <div class="flex" style="justify-content:space-between; width: 100%;">
                  <div class="text-size-small text-color-grey">Submit your Review</div>
                  <div class="flex">
                      @for ($j = 1; $j <= 5; $j++)
                      <div class="c-product-rating__star star-review" style="cursor: pointer;" step="{{$j}}">
                          <div class="icon">
                              <div class="fas fa-star">
                                <img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" />
                              </div>
                          </div>
                      </div>
                      @endfor
                  </div>
                  <input type="hidden" value="5">
              </div>
              <textarea style="width: 100%; border-radius: 10px; padding: 10px; resize: none; border: #c5c5c5 1px solid; font-size: 0.875rem;" rows="2"></textarea>
            </div>
          </div>
          @endfor
          <!-- <input type='file' id="imgInp" />
          <img id="blah" src="#" alt="your image" /> -->
          <div class="flex" style="justify-content: flex-end;">
            <button class="button-3 button-size--small w-inline-block">
                <div class="text-color-white">Submit Review</div>
            </button>
          </div>
        </div>
        <div class="vendors-card">
          <div>
            <h4>Shipping Method</h4>
            <div>
                <div class="checkout-buttons">
                    <a href="#" class="delivery-button w-inline-block">
                        <svg width="33" height="33" viewBox="0 0 33 33" class="shipping-icon" fill="#444349" xmlns="http://www.w3.org/2000/svg">
                            <path d="M26.125 9.625C26.125 8.1125 24.8875 6.875 23.375 6.875H19.25V9.625H23.375V13.2687L18.59 19.25H13.75V12.375H8.25C5.21125 12.375 2.75 14.8362 2.75 17.875V22H5.5C5.5 24.2825 7.3425 26.125 9.625 26.125C11.9075 26.125 13.75 24.2825 13.75 22H19.91L26.125 14.2313V9.625ZM9.625 23.375C8.86875 23.375 8.25 22.7563 8.25 22H11C11 22.7563 10.3812 23.375 9.625 23.375Z"></path>
                            <path d="M6.875 8.25H13.75V11H6.875V8.25ZM26.125 17.875C23.8425 17.875 22 19.7175 22 22C22 24.2825 23.8425 26.125 26.125 26.125C28.4075 26.125 30.25 24.2825 30.25 22C30.25 19.7175 28.4075 17.875 26.125 17.875ZM26.125 23.375C25.3687 23.375 24.75 22.7563 24.75 22C24.75 21.2437 25.3687 20.625 26.125 20.625C26.8813 20.625 27.5 21.2437 27.5 22C27.5 22.7563 26.8813 23.375 26.125 23.375Z"></path>
                        </svg>
                        <div class="text-size-small">Delivery</div>
                    </a>
                    <a href="#" class="self-collection-button w-inline-block">
                        <svg width="24" height="24" viewBox="0 0 24 24" class="shipping-icon" fill="#444349" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1.5C12.9946 1.5 13.9484 1.89509 14.6517 2.59835C15.3549 3.30161 15.75 4.25544 15.75 5.25V6H8.25V5.25C8.25 4.25544 8.64509 3.30161 9.34835 2.59835C10.0516 1.89509 11.0054 1.5 12 1.5ZM17.25 6V5.25C17.25 3.85761 16.6969 2.52226 15.7123 1.53769C14.7277 0.553123 13.3924 0 12 0C10.6076 0 9.27226 0.553123 8.28769 1.53769C7.30312 2.52226 6.75 3.85761 6.75 5.25V6H1.5V21C1.5 21.7956 1.81607 22.5587 2.37868 23.1213C2.94129 23.6839 3.70435 24 4.5 24H19.5C20.2956 24 21.0587 23.6839 21.6213 23.1213C22.1839 22.5587 22.5 21.7956 22.5 21V6H17.25Z"></path>
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
              <h4 class="heading-7">Neilson Soeratman</h4>
              <div class="text-size-small">082337363440</div>
              <div class="text-size-small">Jl. Raya Semampir Barat no. 2Sukolilo, Kota Surabaya, 60119</div>
            </div>
          </div>
          <div class="different-add-div">
            <div class="div-block-26">
              <h4 class="heading-7">Shipped to Different Address</h4><img
                src="{{asset('assets/630b960db00126d372dcaef4_check.svg')}}"
                loading="lazy" alt="" />
            </div>
            <div class="div-line"></div>
            <div class="div-block-26">
              <div>
                <h4 class="heading-7">Neilson Soeratman</h4>
                <div class="text-size-small">082337363440</div>
                <div class="text-size-small">Jl. Raya Semampir Barat no. 2Sukolilo, Kota Surabaya, 60119</div>
              </div>
            </div>
          </div>
          <div class="div-line"></div>
          <h4 class="heading-6 margin-vertical margin-small text-color-dark-grey">Shipping/Pickup Time</h4>
          <div class="delivery-add-item">
            <div>
              <div class="text-size-small text-color-grey">Delivery Date</div>
              <h5 class="text-color-grey">Monday, 4th July</h5>
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
        <h4 class="text-color-dark-grey">Discount</h4><a href="#" class="payment-gateway-button w-inline-block">
          <div>
            <div class="text-weight-bold">Discount Name</div>
            <div class="text-size-xtiny">Discount terms and conditions like Discount 50% with minimum order $30 and
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
<script src="{{asset('assets/js/script-transaction.js')}}" type="text/javascript"></script>
<script>

//   function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();

//         reader.onload = function (e) {
//             $('#blah').attr('src', e.target.result);
//         }

//         reader.readAsDataURL(input.files[0]);
//     }
// }

// $("#imgInp").change(function(){
//     readURL(this);
// });

$(".star-review").on('click', function(){
  var rate = $(this).attr('step');
  var count = 0;
  $(this).parent().children().each(function(){
    count++;
    $(this).children().children().children().attr('src', ((count > rate) ? "{{asset('assets/Star 3.svg')}}" : "{{asset('assets/Star 1.svg')}}"));
  });
  $(this).parent().parent().children('input').val(rate);
});
</script>
@endsection