@foreach ($addresses as $address) 
    <div address-id={{ $address->id }} class="delivery-add-item w-auto mr-2 ml-2 flex-column align-items-start address-button cursor-pointer" data-dismiss="modal">
        <h4 class="heading-7">{{ $address->name }}</h4>
        <div class="text-size-small">{{ $address->phone }}</div>
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
    $(".address-button").on("click", function() {      
        var addressId = $(this).attr("address-id");
        $.get(url + "/user/user-address/get-address/" + addressId).done(function(data) {
            if (data.block_number) {
                $(editAddress).html(`
                    <h4 class="heading-7">` + data.name + `</h4>
                    <div class="text-size-small">` + data.phone + `</div>
                    <div class="text-size-small">
                        ` + data.block_number + ` ` + data.street + ` <br>
                        #` + data.unit_level + `-` + data.unit_number + ` ` + data.building_name + ` <br>
                        Singapore ` + data.postal_code + `
                    </div>`);
            } else {
                $(editAddress).html(`
                    <h4 class="heading-7">` + data.name + `</h4>
                    <div class="text-size-small">` + data.phone + `</div>
                    <div class="text-size-small">
                        ` + data.unit_number + ` ` + data.street + ` <br>
                        Singapore ` + data.postal_code + `
                    </div>`);
            }

            $(editAddress).attr("selected-address", addressId);
        }).fail(function() {
            console.log("Error get user address!");
        });
    });
</script>