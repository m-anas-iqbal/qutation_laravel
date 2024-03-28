@extends('layouts.front')
@section('title', 'Position Details')
@section('content')

    <section class="py-8 py-md-11 bg-hn1" style="margin-top: 91px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h2 class="text-center">Request a Quote</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.css" />
    <style>
        .bs-placeholder{
            border: 1px solid #ced4da !important;
        }
        .bootstrap-select > select.mobile-device:focus + .dropdown-toggle, .bootstrap-select .dropdown-toggle:focus {
            outline: unset !important;
        }
        .dropdown > .btn{
            border: 1px solid #eee;
        }
    </style>

    <style>
        .qty .count {
            color: #000;
            display: inline-block;
            vertical-align: top;
            font-size: 25px;
            font-weight: 700;
            line-height:10px;
            padding: 0 2px;
            min-width: 35px;
            text-align: center;
        }
        .qty .plus {
            cursor: pointer;
            display: inline-block;
            vertical-align: top;
            color: white;
            width: 30px;
            height: 30px;
            font: 30px/1 Arial,sans-serif;
            text-align: center;
            border-radius: 50%;
        }
        .qty .minus {
            cursor: pointer;
            display: inline-block;
            vertical-align: top;
            color: white;
            width: 30px;
            height: 30px;
            font: 30px/1 Arial,sans-serif;
            text-align: center;
            line-height: 0.8;
            border-radius: 50%;
            background-clip: padding-box;
        }
        .minus:hover{
            background-color: #717fe0 !important;
        }
        .plus:hover{
            background-color: #717fe0 !important;
        }
        /*Prevent text selection*/
        span{
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        #review_counter{
            border: 0;
            width: 2%;
        }
        #review_counter::-webkit-outer-spin-button,
        #review_counter::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        #review_counter:disabled{
            background-color:white;
        }
        #review_status{
            font-size: 22px;
            margin-left: 30px;
            font-weight: 500;
            color: grey;
        }

    </style>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>



    <section class="py-8 py-md-10">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="content-column col-lg-8 col-md-8 col-sm-12 trader_section">


                    @include('front.includes.response')
                    <form action="{{ route('save.quote') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" value="" name="user_business_id">
                        <div class="row mb-3">


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_name">Find a Company You Want to Quote!</label>
                                    <span class="text-danger"> *</span>

                                    <select class="selectpicker form-control" name="user_business_id"
                                            data-show-subtext="true" data-live-search="true" onchange="reviewBtnFun()" required>
                                        <option value="">--Select Company Name--</option>
                                        @if(count($traders) > 0)
                                            @foreach($traders as $trader)
                                                <option value="{{ $trader->id }}">{{ $trader->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <span class="text-danger"> *</span>
                                    <textarea name="business_description" id="business_description" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>


                            @if(!Auth::user())

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <span class="text-danger"> *</span>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">E-Mail Address</label>
                                        <span class="text-danger"> *</span>
                                        <input type="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Password:</label>
                                        <span> <strong>You want to create account?</strong> <small class="text-danger">(optional)</small></span>
                                        <input type="text" id="password" name="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               value="{{ old('password') }}">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <span class="text-danger"> <small>(optional)</small></span>
                                        <input type="text" id="" name="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone') }}" onkeypress="return isNumber(event)">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Postocode</label>
                                        <span class="text-danger"> <small>(optional)</small></span>
                                        <input type="text" id="postcode" name="postcode"
                                               class="form-control @error('postcode') is-invalid @enderror"
                                               value="{{ old('postcode') }}">
                                        @error('postcode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            @endif



                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn btn-primary" disabled>
                                        Request a Quote
                                        <div class="spinner-border d-none" role="status"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        function reviewBtnFun(){
            if ($('.selectpicker').val() == '') {
                $('.theme-btn').prop('disabled', true);
            }
            else {
                $('.theme-btn').prop('disabled', false);
            }
        }
    </script>

    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
@endsection