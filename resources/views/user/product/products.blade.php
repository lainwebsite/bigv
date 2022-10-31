@foreach($products as $product)
    <a href="{{ route('product.show', $product->id) }}" class="text-style-none">
        <div id="w-node-_98aa59c7-5c20-8fcb-852c-972bad093e75-fac73a6c" class="product-card padding-small">
            <div class="text-rich-text text-size-small text-color-grey">{{ $product->vendor->name }}</div><img src="{{ $product->featured_image }}" loading="lazy" alt="" class="product-image" />
            <div class="product-card-stars">
                <img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" class="card-stars" />
                <img src="{{asset('assets/Star 1.svg')}}" loading="lazy" alt="" class="card-stars" />
                <img src="{{asset('assets/Star 2.svg')}}" loading="lazy" alt="" class="card-stars" />
                <img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" class="card-stars" />
                <img src="{{asset('assets/Star 3.svg')}}" loading="lazy" alt="" class="card-stars" />
            </div>
            <div class="product-card-title text-rich-text text-size-regular text-weight-bold text-color-dark-grey">{{ ($product->variations[0]->name == "novariation" || count($product->variations) > 1) ? $product->name : $product->variations[0]->name }}</div>
            <div class="product-card-low-div">
                @if($product->variations[0]->name == "novariation" && $product->variations[0]->discount != 0)
                    @if ($product->variations[0]->discount != 0)
                        <div class="card-discount">
                            <div class="discount">{{ $product->variations[0]->discount }}%</div>
                        </div>
                    @endif    

                    @if (count($product->variations) > 1)    
                        <div class="text-rich-text text-color-orange text-weight-bold">${{ $product->variations->min('price') }} - ${{ $product->variations->max('price') }}</div>
                    @else
                        <div id="w-node-_98aa59c7-5c20-8fcb-852c-972bad093e85-fac73a6c" class="sale-price text-color-light-grey">${{ $product->variations[0]->price }}</div>
                        <div class="text-rich-text text-color-orange text-weight-bold">${{ $product->variations[0]->price - $product->variations[0]->discount }}</div>
                    @endif
                @else
                    @if (count($product->variations) > 1)
                        <div class="text-rich-text text-color-orange text-weight-bold">${{ $product->variations->min('price') }} - ${{ $product->variations->max('price') }}</div>
                    @else
                        <div class="text-rich-text text-color-orange text-weight-bold">${{ $product->variations[0]->name == "novariation" ? $product->variations[0]->price : "" }}</div>
                    @endif
                @endif
            </div>
        </div>
    </a>
@endforeach