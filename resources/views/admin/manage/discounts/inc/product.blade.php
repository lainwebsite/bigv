@foreach ($products as $product)
    <div class="d-flex align-items-center justify-content-between product-result-sale-price cursor-pointer"
        onclick="selectProduct({{ $product->id }}, '{{ asset('uploads/' . $product->featured_image) }}', '{{ $product->name }}', '{{ $product->category->name }}');">
        <div class="d-flex align-items-center">
            <img class="d-flex br-18 mr-3" src="{{ asset('uploads/' . $product->featured_image) }}" height="60"
                width="60" alt="Generic placeholder image">
            <div class="d-flex justify-content-center flex-column">
                <h5 class="m-0"><b>{{ $product->name }}</b></h5>
                <small class="m-0">{{ $product->category->name }}</small>
            </div>
        </div>
    </div>
    <div class="divider-dash"></div>
@endforeach
