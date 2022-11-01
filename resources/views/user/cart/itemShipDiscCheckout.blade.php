
@foreach($shipping_discounts as $shippingDiscount)
    <div code="{{ $shippingDiscount->code }}" class="delivery-add-item w-auto mr-2 ml-2 flex-column align-items-start shipping-discount-button cursor-pointer">
        <h4 class="heading-7">{{ $shippingDiscount->code }}</h4>
        <div class="text-size-small">{{ $shippingDiscount->name }}</div>
    </div>
@endforeach

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