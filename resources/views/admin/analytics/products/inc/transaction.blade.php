<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Total Income</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $transaction->user->name }}</td>
                        <td class="align-middle">{{ $transaction->sold_count }}</td>
                        <td class="align-middle">${{ $transaction->sold_price }}</td>
                        <td class="align-middle">{{ date_format(date_create($transaction->created_at), 'd/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $transactions->links() }}
</div>
