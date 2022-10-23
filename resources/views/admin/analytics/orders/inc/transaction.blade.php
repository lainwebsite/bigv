<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total Items</th>
                    <th>Total Spent</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td class="align-middle">
                            <a href="{{ route('admin.transaction.show', $transaction->id) }}">{{ $transaction->id }}</a>
                        </td>
                        <td>{{ date_format(date_create($transaction->created_at), 'd/m/Y') }}</td>
                        <td class="align-middle">{{ $transaction->carts->count() }}</td>
                        <td class="align-middle">${{ $transaction->total_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $transactions->links() }}
</div>
