<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Adresses</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <div class="container">
        <div class="mt-5 d-flex justify-content-between">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary"><span><i data-feather="arrow-left"></i></span> Back</a>
            <a href="{{ route('user.user-address.create') }}" class="btn btn-outline-secondary">Add Address</a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span>{{ session('success') }}</span>
            <button type="button" class="custom-btn-close data-dismiss"><i data-feather="x"></i></button>
        </div>
    @endif
    <div class="container my-3">
        <div class="border border-secondary">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Street</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($addresses as $address)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $address->name }}</td>
                            <td>{{ $address->street }}</td>
                            <td>{{ $address->phone }}</td>
                            <td>
                                <a href="{{ route('user.user-address.show', $address->id) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('user.user-address.edit', $address->id) }}" class="btn btn-warning">Edit</a>
                                <form method="POST" action="{{ route('user.user-address.destroy', $address->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this address?')">Delete</button>
                                </form>
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