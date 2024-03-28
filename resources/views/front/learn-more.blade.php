<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Post Details</title>
    <link rel="icon" type="image/x-icon" href="{{ my_asset('img/' . $settings->fav) }}">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ my_asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ my_asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ my_asset('assets/css/pages/contact_us.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ my_asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link href="{{ my_asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ my_asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <style>
        body {
            font-size: 1.05rem;
            font-family: "Ubuntu", sans-serif;
            color: #333;
            letter-spacing: 0;
            background: #eee
        }

        h1 {
            font-weight: 700;
            color: #0069d1
        }

        h5 {
            font-weight: 700;
            color: #333
        }

        p {
            color: #333
        }

        .portal-title {
            padding: 25px
        }

        .portal-title h1 {
            font-weight: 700;
            color: #0069d1;
            margin-top: 25px
        }

        .form-control {
            color: #333
        }

        .cu-contact-section .contact-form {
            position: initial;
            padding: 20px;
        }

        .contact-us {
            margin-right: auto;
            margin-left: auto;
            max-width: 80%;
            padding-right: 10px;
            padding-left: 10px;
            box-shadow: none
        }

        .cu-contact-section .contact-form form {
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            padding: 0 25px 25px;
            margin-top: 5px
        }

        .cu-contact-section .contact-form form input {
            padding: 8px
        }

        .form-group label,
        label {
            color: #333;
            letter-spacing: .03em;
            font-size: 1em;
            font-weight: 700
        }

        .cu-contact-section .form-group textarea {
            padding: 8px
        }

        .cu-contact-section .contact-form form input {
            font-weight: 400
        }

        .cu-contact-section .contact-form form input:focus {
            box-shadow: 0 0 5px 2px rgba(194, 213, 255, 0.6196078431372549);
            border-color: #1b55e2
        }

        .cu-contact-section .contact-form form textarea:focus {
            box-shadow: 0 0 5px 2px rgba(194, 213, 255, 0.6196078431372549);
            border-color: #1b55e2
        }

        .report {
            margin-right: 5px
        }

        .red-required {
            color: #d32f2f
        }

        .btn {
            font-size: 1.1em
        }

        svg {
            display: inline-block;
            vertical-align: middle
        }

        .login {
            text-align: right;
            position: absolute;
            right: 25px;
            top: 40px;
            font-weight: 700
        }

        .login a {
            text-decoration: none;
            display: inline-block;
            color: inherit
        }

        .login a svg {
            display: inline-block;
            vertical-align: middle;
            width: 24px;
            height: 24px;
            margin-bottom: 2px;
            margin-right: 2px
        }

        .new-control {
            font-weight: 400;
            font-size: 1em
        }

        .new-control.new-radio .new-control-indicator {
            background-color: #EEEEEE;
        }

        .clear-image {
            color: red;
        }

        .post-single {
            border: 1px solid #b9b9b9;
            padding: 3px;
        }

    </style>
</head>

<body>

    <div class="contact-us mb-5" style="margin-top: 50px;">
        <div class="cu-contact-section" style="background-color: #fff;">
            <div class="contact-form">
                <div class="row mb-3">
                    <div class="col-md-7">
                        <h1 class="mb-3">{{ $post->title }}</h1>
                        <hr>
                        <p class="mb-5">{!! $post->long_desc !!}</p>
                        <h4><b>Essential Functions & Responsibilities</b></h4>
                        <p class="mb-5">{!! $post->essential_functions_responsibilites !!}</p>
                        <h4><b>Required Education and Experience</b></h4>
                        <p class="mb-5">{!! $post->required_eduaction_experince !!}</p>
                    </div>
                    <div class="col-md-5">
                        <h4><b>Share This Position</b></h4>
                        <button class="btn btn-sm btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-facebook">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                </path>
                            </svg>
                        </button>
                        <button class="btn btn-sm btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-twitter">
                                <path
                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                </path>
                            </svg>
                        </button>
                        <button class="btn btn-sm btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-linkedin">
                                <path
                                    d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                </path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </button>
                        <button class="btn btn-sm btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-git-pull-request">
                                <circle cx="18" cy="18" r="3"></circle>
                                <circle cx="6" cy="6" r="3"></circle>
                                <path d="M13 6h3a2 2 0 0 1 2 2v7"></path>
                                <line x1="6" y1="9" x2="6" y2="21"></line>
                            </svg>
                        </button>
                    </div>
                </div>
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
