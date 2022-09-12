<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Transaction</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <div class="container mb-5">
        <div class="mt-5 d-flex justify-content-between">
            <a href="{{ route('user.transaction.index') }}" class="btn btn-outline-secondary"><span><i data-feather="arrow-left"></i></span> Back</a>
        </div>
        <div class="border rounded px-5 py-3 mt-3">
            <div class="mb-3 row">
                <h1>Detail Transaction</h1>
            </div>
            <hr>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Total Price</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" value="{{ $transaction->total_price }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Shipping Fee</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" value="{{ $transaction->shipping_fee }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Transaction Discount</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" value="{{ $discounts }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Billing Address</label>
                <div class="col-sm-10">
                    <textarea readonly class="form-control-plaintext">{{ $transaction->billing_address->street }}</textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Shipping Address</label>
                <div class="col-sm-10">
                    <textarea readonly class="form-control-plaintext">{{ $transaction->shipping_address->street }}</textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Payment Method</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" value="{{ $transaction->payment_method->name }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Pickup Method</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" value="{{ $transaction->pickup_method->name }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Payment Time</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" value="{{ $transaction->pickup_time->time }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" value="{{ $transaction->transaction_status->name }}">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script>
        feather.replace()
    </script>
</body>
</html>