{{-- PRODUCT VOUCHER --}}
<h4 class="heading-7 ml-2 mb-3">Product Discount Voucher</h4>
<div id="productVoucher" class="d-flex flex-column modal-list-container-2">
    @foreach($product_discounts as $productDiscount)
        <div code="{{ $productDiscount->code }}" class="delivery-add-item w-auto mr-2 ml-2 flex-column align-items-start product-discount-button cursor-pointer">
            <h4 class="heading-7">{{ $productDiscount->code }}</h4>
            <div class="text-size-small">{{ $productDiscount->name }}</div>
        </div>
    @endforeach
</div>
<div class="div-line ml-3 mr-3"></div>

{{-- SHIPPING VOUCHER --}}
<h4 class="heading-7 ml-2 mb-3">Shipping Discount Voucher</h4>
<div id="shippingVoucher" class="d-flex flex-column modal-list-container-2">
    @foreach($shipping_discounts as $shippingDiscount)
        <div code="{{ $shippingDiscount->code }}" class="delivery-add-item w-auto mr-2 ml-2 flex-column align-items-start shipping-discount-button cursor-pointer">
            <h4 class="heading-7">{{ $shippingDiscount->code }}</h4>
            <div class="text-size-small">{{ $shippingDiscount->name }}</div>
        </div>
    @endforeach
</div>

<script>
    $(".product-discount-button").on('click', function() {
        $(".product-discount-button").removeClass("product-discount-button-active");
        $(this).addClass("product-discount-button-active");

        $(this).parent().attr("selected-voucher", $(this).attr("code"));
    });
    
    $(".shipping-discount-button").on('click', function() {
        $(".shipping-discount-button").removeClass("shipping-discount-button-active");
        $(this).addClass("shipping-discount-button-active");
        
        $(this).parent().attr("selected-voucher", $(this).attr("code"));
    });
</script>