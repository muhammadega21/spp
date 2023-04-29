<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPP | {{ $title }}</title>
    <link rel="stylesheet" href="{{ url("css/style.css") }}">
    <link rel="stylesheet" href="{{ url("css/navbar.css") }}">
    <link rel="stylesheet" href="{{ url("css/sidebar.css") }}">
    <link rel="stylesheet" href="{{ url("css/dashboard.css") }}">
    <link rel="stylesheet" href="{{ url("css/siswa.css") }}">
    <link rel="stylesheet" href="{{ url("bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ url("fontawesome/css/all.min.css") }}">
     <script src="{{ url("js/jquery-3.6.4.min.js") }}"></script>
</head>

<body>
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <div class="bg"></div>
    @yield('container')
    @include('layouts.footer')

    <script src="{{ url("bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ url("js/script.js") }}"></script>
   

</body>

</html>
