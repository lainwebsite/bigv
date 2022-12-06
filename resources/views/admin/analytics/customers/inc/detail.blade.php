<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Spent</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('admin.product.analytics.detail', $cart->product_variation->product_id) }}"
                                class="a-normal d-flex align-items-center">
                                <img class="d-flex br-18 mr-3"
                                    src="{{ asset('uploads/' . $cart->product_variation->product->featured_image) }}"
                                    width="60" alt="Generic placeholder image">
                                <div class="d-flex align-items-start flex-column">
                                    <h5 class="m-0"><b>{{ $cart->product_variation->product->name }}</b></h5>
                                    <small
                                        class="m-0">{{ $cart->product_variation->product->category->name }}</small>
                                </div>
                            </a>
                        </td>
                        <td class="align-middle">{{ $cart->quantity }}</td>
                        <td class="align-middle">${{ $cart->quantity * $cart->price }}</td>
                        <td class="align-middle">{{ date('d-m-Y', strtotime($cart->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $carts->links() }}
</div>
