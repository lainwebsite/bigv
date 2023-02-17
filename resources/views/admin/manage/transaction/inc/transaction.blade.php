<div class="col pt-0 pb-0 pr-4 pl-4">
    <ul class="list-unstyled mb-5">
        @foreach ($transactions as $transaction)
            @if ($transaction->carts->first() != null)
                <li>
                <div class="w-100 card custom-border my-2">
                    <div @class([
                        'card-header d-flex justify-content-between flex-column',
                        'bg-danger' => $transaction->status_id == 1,
                        'bg-primary' => $transaction->status_id == 2,
                        'bg-cyan' => $transaction->status_id == 3,
                        'bg-success' => $transaction->status_id == 4,
                        'bg-secondary' => $transaction->status_id == 5,
                        'bg-dark' => $transaction->status_id == 6,
                        'bg-dark' => $transaction->status_id == 7,
                    ])>
                        <div class="d-flex justify-content-between">
                            <p class="m-0 text-white">
                                {{ $transaction->user->name }}</p>
                            <p class="m-0 text-white">{{ $transaction->status->name }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="m-0 text-white">{{ $transaction->id }}</h6>
                            <h6 class="m-0 text-white">{{ $transaction->created_at }}
                            </h6>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-center" style="gap: 18px;">
                        <div class="d-flex align-items-center">
                            <div class="form-check form-check-inline m-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input status-checkbox"
                                        data-tid={{ $transaction->id }} id="checkOrder{{ $transaction->id }}">
                                    <label class="custom-control-label" for="checkOrder{{ $transaction->id }}"></label>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.transaction.show', $transaction->id) }}" class="w-100 a-normal">
                            <div class="card-body p-0">
                                <ul class="list-unstyled">
                                    <li class="media align-items-center">
                                        <img class="d-flex mr-3 br-18"
                                            src="{{ asset('uploads/' . $transaction->carts->first()->product_variation_trashed->product_trashed->featured_image) }}"
                                            width="60" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-1">
                                                <b>{{ $transaction->carts->first()->product_variation_trashed->product_trashed->name }}</b>
                                            </h5>
                                            @if ($transaction->carts->first()->product_variation_trashed->name != "novariation")
                                                <h6 class="m-0">{{ $transaction->carts->first()->product_variation_trashed->name }}</h6>
                                            @endif
                                            @if ($transaction->carts->first()->addon_options->count() > 0)
                                                @php 
                                                    $addonOptArr = [];
                                                @endphp
                                                @foreach ($transaction->carts->first()->addon_options as $addon)
                                                    @php
                                                        array_push($addonOptArr, $addon->addon_option_trashed->name);
                                                    @endphp
                                                @endforeach
                                                <h6 class="m-0">Addon: {{join(",", $addonOptArr)}}</h6>
                                            @endif
                                            <h6 class="m-0">
                                                ${{ $transaction->carts->first()->price }}</h6>
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
                        </a>
                    </div>
                </div>
            </li>
            @endif
        @endforeach
    </ul>
    {{ $transactions->links() }}
</div>
