<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    dashboard
    @if ($any->count() > 0)
        @foreach ($any as $a)
            <p>{{ $a->name }}</p>
        @endforeach
    @endif
</body>

</html>
