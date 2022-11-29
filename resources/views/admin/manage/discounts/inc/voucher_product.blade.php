@foreach ($variations as $variation)
    <div class="d-flex align-items-center justify-content-between product-result-voucher cursor-pointer"
        onclick="selectVoucherProduct({{ $variation->id }}, '{{ asset('uploads/' . $variation->product->featured_image) }}', '{{ $variation->product->name }} - {{ $variation->name }}',  '{{ $variation->product->category->name }}');">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center">
                <img class="d-flex br-18 mr-3" src="{{ asset('uploads/') . '/' . $variation->product->featured_image }}"
                    height="60" width="60" alt="Generic placeholder image">
                <div class="d-flex justify-content-center flex-column">
                    <h5 class="m-0"><b>{{ $variation->product->name }} - {{ $variation->name }}</b></h5>
                    <small class="m-0">{{ $variation->product->category->name }}</small>
                </div>
            </div>
        </div>
    </div>
    <div class="divider-dash"></div>
@endforeach
