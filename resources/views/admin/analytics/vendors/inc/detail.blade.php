<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product</th>
                    <th>Number of Transaction</th>
                    <th>Total Sold</th>
                    <th>Total Income</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="align-middle">1</td>
                        <td>
                            <a href="{{ route('admin.product.analytics.detail', $product->id) }}"
                                class="a-normal d-flex align-items-center">
                                <img class="d-flex br-18 mr-3" src="{{ asset('uploads/' . $product->featured_image) }}"
                                    width="60" alt="Generic placeholder image">
                                <div class="d-flex align-items-start flex-column">
                                    <h5 class="m-0"><b>{{ $product->name }}</b></h5>
                                    <small class="m-0">{{ $product->category->name }}</small>
                                </div>
                            </a>
                        </td>
                        <td class="align-middle">{{ $product->transaction_count }}</td>
                        <td class="align-middle">{{ $product->sold_count ?? 0 }}</td>
                        <td class="align-middle">${{ $product->total_income ?? 0 }}</td>
                        <td class="align-middle">{{ $product->rating }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
</div>
