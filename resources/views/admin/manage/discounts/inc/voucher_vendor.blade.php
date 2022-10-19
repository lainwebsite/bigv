@foreach ($vendors as $vendor)
    <div class="d-flex align-items-center justify-content-between vendor-result-product-voucher cursor-pointer"
        onclick="selectVoucherVendor({{ $vendor->id }}, '{{ asset('uploads/' . $vendor->photo) }}', '{{ $vendor->name }}', '{{ $vendor->location->name }}', '{{ $vendor->products->count() }}');">
        <div class="d-flex align-items-center">
            <img class="d-flex br-18 mr-3" src="{{ asset('uploads/' . $vendor->photo) }}" height="60" width="60"
                alt="Generic placeholder image">
            <div class="d-flex justify-content-center flex-column">
                <h5 class="m-0"><b>{{ $vendor->name }}</b></h5>
                <small class="m-0">Location <b>{{ $vendor->location->name }}</b></small>
            </div>
        </div>
        <p class="m-0">Total Product <b>{{ $vendor->products->count() }}</b></p>
    </div>
    <div class="divider-dash"></div>
@endforeach
