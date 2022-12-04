<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Discount</th>
                    <th>Used</th>
                    <th>Status & Period</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discounts as $discount)
                    <tr>
                        <td>
                            <a href="/discountdet" class="a-normal d-flex flex-column justify-content-center">
                                <h5 class="m-0">{{ $discount->code }}</h5>
                                <small class="m-0">ID: <b>{{ $discount->id }}</b></small>
                            </a>
                        </td>
                        <td class="align-middle d-flex flex-column justify-content-center">
                            <h5 class="m-0">{{ $discount->type->name }}</h5>
                            <small
                                class="m-0">{{ $discount->variation_discounts->count() == 0 ? 'All' : $discount->variation_discounts->count() }}
                                discount(s)</small>
                        </td>
                        <td class="align-middle">
                            @if ($discount->voucher_type == 2)
                                {{ $discount->amount }}%
                            @else
                                ${{ $discount->amount }}
                            @endif
                        </td>
                        <td class="align-middle">{{ $discount->transaction_discounts->count() }}</td>
                        <td class="align-middle">
                            @if ($discount->duration_end < date('Y-m-d H:i:s'))
                                <small
                                    class="badge bg-secondary font-weight-medium badge-pill text-white m-0">Ended</small>
                            @elseif($discount->duration_start > date('Y-m-d H:i:s'))
                                <small
                                    class="badge bg-orange font-weight-medium badge-pill text-white m-0">Upcoming</small>
                            @else
                                <small
                                    class="badge bg-success font-weight-medium badge-pill text-white m-0">Active</small>
                            @endif
                            <p class="m-0">{{ date('d/m/Y H:i', strtotime($discount->duration_start)) }}
                                -<br>{{ date('d/m/Y H:i', strtotime($discount->duration_end)) }}</p>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex" style="gap: 10px;">
                                <a href="{{ route('admin.discount.edit', $discount->id) }}"
                                    class="a-normal text-info"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-edit feather-icon">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg></a>
                                <a onclick="deleteData({{ $discount->id }}, '{{ $discount->code }}');"
                                    class="a-normal text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-trash feather-icon">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                    </svg></a>
                            </div>
                            <form action="{{ route('admin.discount.destroy', $discount->id) }}"
                                id="delete-discount-form-{{ $discount->id }}" method="post">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $discounts->links() }}
</div>
