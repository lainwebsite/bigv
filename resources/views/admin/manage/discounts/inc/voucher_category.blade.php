@foreach ($categories as $category)
    <div class="d-flex align-items-center justify-content-between category-result-product-voucher cursor-pointer"
        onclick="selectVoucherCategory({{ $category->id }}, '{{ asset('uploads/' . $category->photo_url) }}', '{{ $category->name }}',  '{{ $category->products->count() }}');">
        <div class="d-flex align-items-center">
            <img class="d-flex br-18 mr-3" src="{{ asset('uploads/') . $category->photo_url }}" width="60"
                height="60" alt="Generic placeholder image">
            <div class="d-flex justify-content-center flex-column">
                <h5 class="m-0"><b>{{ $category->name }}</b></h5>
            </div>
        </div>
        <p class="m-0">Total Product <b>{{ $category->products->count() }}</b></p>
    </div>
    <div class="divider-dash"></div>
@endforeach
