@foreach ($product->variations as $variation)
    <label for="salePrice">{{ $variation->name }} - ${{ $variation->price }}</label>
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <label for="salePrice" style="border-radius: 10px 0 0 10px;" class="input-group-text">$</label>
        </div>
        <input type="number" class="form-control" id="salePrice" name="sale_price[{{ $variation->id }}]"
            placeholder="Sale Price">
    </div>
@endforeach
