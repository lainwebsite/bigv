<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Vendor</th>
                    <th>Number of Transaction</th>
                    <th>Total Income</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendors as $vendor)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td>
                            <a
                            {{-- href="{{ route('admin.vendor.analytics.detail', $vendor->id) }}" --}}
                                class="a-normal d-flex align-items-center">
                                <img class="d-flex br-18 mr-3" src="{{ asset('uploads/' . $vendor->photo) }}"
                                    width="60" alt="Generic placeholder image">
                                <div class="d-flex align-items-start flex-column">
                                    <h5 class="m-0"><b>{{ $vendor->name }}</b></h5>
                                    <small class="m-0">{{ $vendor->location->name }}</small>
                                </div>
                            </a>
                        </td>
                        <td class="align-middle">{{ $vendor->transaction_count }}</td>
                        <td class="align-middle">${{ $vendor->total_income }}</td>
                        <!-- Rating average dari semua product (all time) -->
                        <td class="align-middle">{{ $vendor->rating }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $vendors->links() }}
</div>
