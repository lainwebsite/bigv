<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Address</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <div class="container mb-5">
        <div class="mt-5 d-flex justify-content-between">
            <a href="{{ route('user.user-address.index') }}" class="btn btn-outline-secondary"><span><i data-feather="arrow-left"></i></span> Back</a>
        </div>
        <div class="border rounded px-5 py-3 mt-3">
            <div class="mb-3 row">
                <h1>Detail Address</h1>
            </div>
            <hr>
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="name" value="{{ $address->name }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="tel" readonly class="form-control-plaintext" id="phone" value="{{ $address->phone }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="additionalInfo" class="col-sm-2 col-form-label">Additional Info</label>
                <div class="col-sm-10">
                    <textarea readonly class="form-control-plaintext" id="additionalInfo">{{ $address->additional_info }}</textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="street" class="col-sm-2 col-form-label">Street</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="street" name="street" value="{{ $address->street }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="condo" class="col-sm-2 col-form-label">Condo</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="condo" value="{{ $address->condo }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="estate" class="col-sm-2 col-form-label">Estate</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="estate" value="{{ $address->estate }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="label" class="col-sm-2 col-form-label">Label</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="label" value="{{ $address->label }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="houseNumber" class="col-sm-2 col-form-label">House Number</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="houseNumber" value="{{ $address->house_number }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="unitNumber" class="col-sm-2 col-form-label">Unit Number</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="unitNumber" value="{{ $address->unit_number }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="postalCode" class="col-sm-2 col-form-label">Postal Code</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" maxlength="6" id="postalCode" value="{{ $address->postal_code }}">
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