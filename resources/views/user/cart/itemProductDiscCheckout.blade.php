@foreach($product_discounts as $productDiscount)
    <div code="{{ $productDiscount->code }}" class="delivery-add-item w-auto mr-2 ml-2 flex-column align-items-start product-discount-button cursor-pointer">
        <h4 class="heading-7"><b>{{ $productDiscount->code }}</b></h4>
        <div class="text-size-small"><b>{{ $productDiscount->name }}</b></div>
        <div class="text-size-small">
            @if ($productDiscount->voucher_type == 1)
            Discount ${{$productDiscount->amount}}
            @else
            {{$productDiscount->amount}}% @if($productDiscount->max_discount != null)up to ${{$productDiscount->max_discount}}@endif
            @endif
        </div>
        <small class="text-size-small">{{ $productDiscount->description }}</small>
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