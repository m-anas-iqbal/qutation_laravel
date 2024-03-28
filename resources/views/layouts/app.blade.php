<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Home') | {{ env('APP_NAME') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ my_asset('img/hn1-favicon.png') }}">
    <link href="{{ my_asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ my_asset('assets/css/login.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <body class="text-center">
    <main class="form-signin w-100 m-auto px-4 py-5">
        @include('admin.partials.response')
        @yield('content')
    </main>

    <script src="{{ my_asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ my_asset('assets/js/custom.js') }}"></script>
</body>

</html>
