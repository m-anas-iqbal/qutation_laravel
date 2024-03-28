@extends('layouts.front')
@section('title', 'Health Network One')
@section('content')

    <section class="pt-8 pt-md-11 bg-hn1">
        <div class="container">
            <div class="row align-items-center" style="padding: 80px 0px 0px 0px;">
                <div class="col-12 col-md-12">
                    <h2>
                        Leave Feedback
                        <hr>
                    </h2>
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



    <section id="open" class=" pt-4 py-7 bg-hn1">
        <div class="container">
            <div class="row">


                @include('front.includes.response')
                <div class="content-column col-lg-12 col-md-12 col-sm-12">
                <form action="{{ route('store.review') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="company_name">Find a Company You Want to Review!</label>
                                <span class="text-danger"> *</span>

                                <select class="selectpicker form-control" name="company_name"
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
                                <label for="">Review Title</label>
                                <span class="text-danger"> *</span>
                                <input type="text" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" required>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Review Description</label>
                                <span class="text-danger"> *</span>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
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
                                <input type="text" id="phone" name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone') }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        @endif


                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="qty mt-1">
                                            <span class="minus bg-dark">-</span>
                                            <input id="review_counter" type="number" class="count" name="value" value="7">
                                            <span class="plus bg-dark">+</span>

                                            <span id="review_status">Ok</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Based on your experience,
                                            would you recommend this company?</label>
                                        <span class="text-danger"> <small>(optional)</small></span>
                                        <br>
                                        <input type="radio" id="Yes" value="Yes" name="recommend"> <label for="Yes">Yes</label>
                                        <input type="radio" id="No" value="No" name="recommend"> <label for="No">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="theme-btn btn btn-primary" disabled>
                                    Submit
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
    $(document).ready(function(){
        // $('.count').prop('disabled', true);
        $(document).on('click','.plus',function(){
            $('.count').val(parseInt($('.count').val()) + 1 );
            if ($('.count').val() >= 10) {
                $('.count').val(10);
            }
            if ($('.count').val() == 10) {
                $('#review_status').html('Excellent!');
            }
            else if($('.count').val() == 9){
                $('#review_status').html('Very good!');
            }
            else if($('.count').val() == 8){
                $('#review_status').html('Good');
            }
            else if($('.count').val() == 7){
                $('#review_status').html('Ok');
            }
            else if($('.count').val() == 6){
                $('#review_status').html('Acceptable');
            }
            else if($('.count').val() == 5){
                $('#review_status').html('Disappointing');
            }
            else if($('.count').val() == 4){
                $('#review_status').html('Below Expectations');
            }
            else if($('.count').val() == 3){
                $('#review_status').html('Poor');
            }
            else if($('.count').val() == 2){
                $('#review_status').html('Very Poor');
            }
            else if($('.count').val() == 1){
                $('#review_status').html('Terrible');
            }
            else{
                $('#review_status').html('Unacceptable');
            }

        });
        $(document).on('click','.minus',function(){
            $('.count').val(parseInt($('.count').val()) - 1 );
            if ($('.count').val() <= 0) {
                $('.count').val(0);
            }
            if ($('.count').val() == 10) {
                $('#review_status').html('Excellent!');
            }
            else if($('.count').val() == 9){
                $('#review_status').html('Very good!');
            }
            else if($('.count').val() == 8){
                $('#review_status').html('Good');
            }
            else if($('.count').val() == 7){
                $('#review_status').html('Ok');
            }
            else if($('.count').val() == 6){
                $('#review_status').html('Acceptable');
            }
            else if($('.count').val() == 5){
                $('#review_status').html('Disappointing');
            }
            else if($('.count').val() == 4){
                $('#review_status').html('Below Expectations');
            }
            else if($('.count').val() == 3){
                $('#review_status').html('Poor');
            }
            else if($('.count').val() == 2){
                $('#review_status').html('Very Poor');
            }
            else if($('.count').val() == 1){
                $('#review_status').html('Terrible');
            }
            else{
                $('#review_status').html('Unacceptable');
            }

        });
    });
</script>

@endsection
