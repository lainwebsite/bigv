<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction History</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <div class="mt-4 mb-3">
        <h1>Transaction History</h1>
    </div>
    <div class="container">
        <div class="mt-5 d-flex justify-content-between">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary"><span><i data-feather="arrow-left"></i></span> Back</a>
        </div>
    </div>
    <div class="container my-3">
        <div class="border border-secondary">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Billing Address</th>
                        <th scope="col">Shipping Address</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $transaction->billing_address->street }}</td>
                            <td>{{ $transaction->shipping_address->street }}</td>
                            <td>{{ $transaction->total_price }}</td>
                            <td>
                                <a href="{{ route('user.transaction.show', $transaction->id) }}" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>