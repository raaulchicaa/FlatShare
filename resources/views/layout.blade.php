<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Un7 p1</title>

    @section('stylesheets')
        <link rel="stylesheet" href="{{ asset('css/tabla.css')}}"/>
    @show

</head>
<body>
    
    @include('navbar')

    <div class="container">
        @yield('content')
    </div>

</body>
</html>