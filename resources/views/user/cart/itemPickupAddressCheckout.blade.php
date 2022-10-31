@foreach ($addresses as $address) 
    <div address-id={{ $address->id }} class="delivery-add-item w-auto flex-column align-items-start pickup-address-button cursor-pointer">
        <h4 class="heading-7">{{ $address->name }}</h4>
        @if (isset($address->block_number))
            <div class="text-size-small">
                {{ $address->block_number }} {{ $address->street }} <br>
                #{{ $address->unit_level }}-{{ $address->unit_number }} {{ $address->building_name }}<br>
                Singapore {{ $address->postal_code }}
            </div>
        @else
            <div class="text-size-small">
                {{ $address->unit_number }} {{ $address->street }}<br>
                Singapore {{ $address->postal_code }}
            </div>
        @endif
    </div>
@endforeach
<script>
    $(".pickup-address-button").on("click", function() {      
        var addressId = $(this).attr("address-id");
        $("#pickupShippingDetail").attr("selected-address", addressId);

        $(".pickup-address-button").removeClass("pickup-address-button-active");
        $(this).addClass("pickup-address-button-active");
    });
</script>