<div class="col pt-0 pb-0 pr-4 pl-4">
    <ul class="list-unstyled mb-5">
        @foreach ($transactions as $transaction)
            <li>
                <a href="{{route('admin.transaction.show', $transaction->id)}}" class="media a-normal">
                    <div class="w-100 card custom-border my-2">
                        <div @class([
                            'card-header d-flex justify-content-between flex-column',
                            'bg-danger' => $transaction->status_id == 1,
                            'bg-primary' => $transaction->status_id == 2,
                            'bg-cyan' => $transaction->status_id == 3,
                            'bg-success' => $transaction->status_id == 4,
                            'bg-secondary' => $transaction->status_id == 5,
                        ])>
                            <div class="d-flex justify-content-between">
                                <p class="m-0 text-white">
                                    {{ $transaction->billing_address->user->name }}</p>
                                <p class="m-0 text-white">{{ $transaction->status->name }}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="m-0 text-white">{{ $transaction->id }}</h6>
                                <h6 class="m-0 text-white">{{ $transaction->created_at }}
                                </h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="media align-items-center">
                                    <img class="d-flex mr-3 br-18"
                                        src="{{ asset('uploads/' . $transaction->carts->first()->product_variation->product->featured_image) }}"
                                        width="60" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">
                                            <b>{{ $transaction->carts->first()->product_variation->product->name }}</b>
                                        </h5>
                                        <h6 class="m-0">
                                            {{ $transaction->carts->first()->product_variation->name }}
                                        </h6>
                                        <h6 class="m-0">
                                            {{ $transaction->carts->first()->price }}</h6>
                                    </div>
                                    <p class="m-0">
                                        x{{ $transaction->carts->first()->quantity }}</p>
                                </li>
                            </ul>
                            @if ($transaction->carts->count() > 1)
                                <h6 class="text-right mt-1">+
                                    {{ $transaction->carts->count() - 1 }} other products
                                </h6>
                            @endif
                            <div class="divider-dash"></div>
                            <div class="d-flex justify-content-between">
                                <p class="m-0"><b>Total Payment using
                                        {{ $transaction->payment_method->name }}</b></p>
                                <p class="m-0"><b>${{ $transaction->total_price }}</b>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
    {{ $transactions->links() }}
</div>
