<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Number of Transaction</th>
                    <th>Total Spent</th>
                    <th>Join Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('admin.user.analytics.detail', $user->id) }}"
                                class="a-normal d-flex align-items-center">
                                <div class="d-flex align-items-start flex-column">
                                    <h5 class="m-0"><b>{{ $user->name }}</b></h5>
                                    <small class="m-0">{{ $user->phone }}</small>
                                </div>
                            </a>
                        </td>
                        <td class="align-middle">{{ $user->transaction_count }}</td>
                        <td class="align-middle">${{ $user->total_spent }}</td>
                        <td class="align-middle">{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item">
            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
        </li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</div>
