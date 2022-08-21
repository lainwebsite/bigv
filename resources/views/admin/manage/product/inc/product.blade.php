<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Variations</th>
                    <th>Vendor</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    @if ($product->variations->count() > 0)
                        <tr>
                            <td>
                                <a href="{{ route('admin.product.show', $product->id) }}"
                                    class="a-normal d-flex align-items-center">
                                    <img class="d-flex br-18 mr-3"
                                        src="{{ asset('uploads/' . $product->images->first()->link) }}" width="60"
                                        alt="Generic placeholder image">
                                    <div class="d-flex align-items-start flex-column">
                                        <h5 class="m-0"><b>{{ $product->name }}</b></h5>
                                        <small class="m-0">{{ $product->category->name }}</small>
                                    </div>
                                </a>
                            </td>
                            @if ($product->variations->first()->discount != 0 && $product->variations->first()->discount_date > Carbon\Carbon::now())
                                <td class="align-middle">
                                    <s>${{ $product->variations->first()->price }}</s><br>${{ $product->variations->first()->price - $product->variations->first()->discount }}
                                </td>
                            @else
                                <td class="align-middle">
                                    ${{ $product->variations->first()->price }}</td>
                            @endif
                            <td class="align-middle">
                                @foreach ($product->variations as $variant)
                                    @if ($loop->last || $product->variations->count() == 1)
                                        {{ $variant->name }}
                                    @else
                                        {{ $variant->name }},
                                    @endif
                                @endforeach
                            </td>
                            <td class="align-middle">{{ $product->vendor->name }}</td>
                            <td class="align-middle">
                                <div class="d-flex" style="gap: 10px;">
                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                        class="a-normal text-info"><i data-feather="edit" class="feather-icon"></i></a>
                                    <a onclick="event.preventDefault(); document.getElementById('delete-product-form-{{ $product->id }}').submit();"
                                        class="a-normal text-danger"><i data-feather="trash"
                                            class="feather-icon"></i></a>
                                </div>
                            </td>
                        </tr>
                        <form action="{{ route('admin.product.destroy', $product->id) }}"
                            id="delete-product-form-{{ $product->id }}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                        </form>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
</div>
