<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Account</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <div class="container">
        <div class="mt-5 d-flex justify-content-between">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary"><span><i data-feather="arrow-left"></i></span> Back</a>
            <a href="{{ route('editProfileForm') }}" class="btn btn-outline-secondary">Edit Profile</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="custom-btn-close data-dismiss"><i data-feather="x"></i></button>
            </div>
        @endif
        <div class="border rounded px-5 py-3 mt-3">
            <div class="mb-3 row">
                <h1>My Account</h1>
            </div>
            <hr>    
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="name" value="{{ auth()->user()->name }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="email" value="{{ auth()->user()->email }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="phone" value="{{ auth()->user()->phone }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="dateOfBirth" class="col-sm-2 col-form-label">Date of Birth</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="dateOfBirth" value="{{ auth()->user()->date_of_birth }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tierPoint" class="col-sm-2 col-form-label">Tier Point</label>
                <div class="col-sm-10 d-flex align-items-center">
                    <div class="progress w-100">
                        <div class="progress-bar" role="progressbar" aria-label="Default striped example" style="width: calc({{ auth()->user()->tier_points }}/10000 * 100%)" aria-valuenow="{{ auth()->user()->tier_points }}" aria-valuemin="0" aria-valuemax="10000"></div>
                    </div>
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