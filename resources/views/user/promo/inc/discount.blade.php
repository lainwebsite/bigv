@foreach ($discounts as $discount)
    <div class="discount-div-claim">
        <div class="div-block-30-copy">
            <h4 class="heading-7">{{ $discount->code }}</h4>
        </div>
        <div class="text-size-small">{{ $discount->description }}</div>
    </div>
@endforeach
