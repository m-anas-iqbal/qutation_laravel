<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Home | {{ env('APP_NAME') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ my_asset('img/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ my_asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ my_asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ my_asset('assets/css/pages/contact_us.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ my_asset('assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ my_asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ my_asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ my_asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="contact-us mb-5" style="margin-top: 50px;">
        <div class="cu-contact-section" style="background-color: #fff;">
            <div class="contact-form">
                <h1 class="mb-3">Open Positions </h1>
                @foreach ($posts as $post)
                    <div class="row mb-4 post-single">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <h3>{{ $post->title }}</h3>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <h5>{{ $post->department }}</h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>{{ $post->state }}</h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>{{ $post->created_at->toFormattedDateString() }}</h5>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <p>{!! $post->desc !!}</p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <a href="{{ route('learn.more', $post->slug) }}" class="btn btn-md btn-primary">
                                        LEARN MORE
                                    </a>
                                    <a href="{{ route('apply.now', $post->slug) }}" class="btn btn-md btn-primary">
                                        APPLY NOW
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="{{ my_asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ my_asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ my_asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ my_asset('assets/js/validation.js') }}"></script>
    <script src="{{ my_asset('assets/js/custom.js') }}"></script>
    <script src="{{ my_asset('plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ my_asset('plugins/flatpickr/custom-flatpickr.js') }}"></script>
</body>

</html>
