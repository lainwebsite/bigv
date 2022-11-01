@foreach($product_discounts as $productDiscount)
    <div code="{{ $productDiscount->code }}" class="delivery-add-item w-auto mr-2 ml-2 flex-column align-items-start product-discount-button cursor-pointer">
        <h4 class="heading-7">{{ $productDiscount->code }}</h4>
        <div class="text-size-small">{{ $productDiscount->name }}</div>
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