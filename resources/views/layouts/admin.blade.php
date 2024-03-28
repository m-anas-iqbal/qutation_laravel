<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ my_asset('img/hn1-favicon.png') }}" />
    <link href="{{ my_asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ my_asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ my_asset('assets/css/admin-custom.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
    <script>
        var SITE_URL = '{{ url('/') }}';
        var CSRF_TOKEN = '{{ csrf_token() }}';
    </script>
</head>

<body>
    @include('admin.includes.sub-header')
    <div class="main-container" id="container">
        <div class="overlay"></div>
        @include('admin.includes.sidebar')
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @include('admin.partials.response')
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ my_asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ my_asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ my_asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ my_asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ my_asset('assets/js/app.js') }}"></script>
    <script src="{{ my_asset('assets/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    @yield('js')
</body>

</html>
