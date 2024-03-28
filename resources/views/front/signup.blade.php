@extends('layouts.front')
@section('title', 'Position Details')
@section('content')

    <section class="py-8 py-md-11 bg-hn1" style="margin-top: 91px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="text-center">Welcome! Please Sign Up</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.css">
    <style>
        .select2-choices {
            border: unset !important;
        }

        .select2-container-multi .select2-choices {
            background-image: unset !important;
        }
        .sub_cat-choices {
            border: unset !important;
        }

        .sub_cat-container-multi .select2-choices {
            background-image: unset !important;
        }
    </style>





    <section class="py-8 py-md-10">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12" align="center">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary trader_tab" style="background: #0B5ED7" onclick="registerTab('trader')">
                            Sign Up Trader
                        </button>
                        <button type="button" class="btn btn-primary user_tab" onclick="registerTab('user')">
                            Sign Up User
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="content-column col-lg-8 col-md-8 col-sm-12 trader_section">


                    <h1 class="mb-3">Add Your Business Details</h1>
                    <hr>
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                        <br>
                    @endif

                    @include('front.includes.response')
                    <form action="{{ route('trader.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">

                            <input type="hidden" name="role_id" value="2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Your Service Area</label>
                                    <span class="text-danger"> *</span>

                                    <select class="select2 form-control" id="service_area" name="short_service_area[]"
                                            multiple required onchange="serviceAreaFunc()">
                                        <optgroup label="Country">
                                            @if(count($countries) > 0)
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                        <optgroup label="States">
                                            @if(count($states) > 0)
                                                @foreach($states as $state)
                                                    <option value="{{ $state->name }}">{{ $state->name }}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                        <optgroup label="Counties">
                                            @if(count($counties) > 0)
                                                @foreach($counties as $county)
                                                    <option value="{{ $county->name }}">{{ $county->name }}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                        <optgroup label="Cities">
                                            @if(count($cities) > 0)
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                        <optgroup label="Towns">
                                            @if(count($towns) > 0)
                                                @foreach($towns as $town)
                                                    <option value="{{ $town->name }}">{{ $town->name }}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" value="" name="service_area[]" id="service_values">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Business Category</label>
                                    <span class="text-danger"> *</span>

                                    <select class="form-control" id="business_name" name="business_name"
                                            required  onchange="SubCatFun()">
                                        <option value="">--Select--</option>
                                        @if(count($trades) > 0)
                                            @foreach($trades as $trade)
                                                <option value="{{ $trade->name }}">{{ $trade->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Sub Business Category</label>
                                    <span class="text-danger"> *</span>

                                    <select class="sub_cat form-control" id="sub_cat" name="business_subcat_name[]" multiple>
                                        <option value="">--Select--</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Your Business Name</label>
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
                                    <label for="">Your Business E-Mail Address</label>
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
                                    <label for="">Password</label>
                                    <span class="text-danger"> *</span>
                                    <input type="text" id="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           value="{{ old('password') }}" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Website Url</label>
                                    <span class="text-danger"> *optional</span>
                                    <input type="text" id="website_url" name="website_url"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('website_url') }}">
                                    @error('website_url')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Your Business Description</label>
                                    <span class="text-danger"> *</span>
                                    <textarea name="business_description" id="business_description" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Your Business Phone</label>
                                    <span class="text-danger"> *</span>
                                    <input type="text" id="" name="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') }}" onkeypress="return isNumber(event)" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Your Business Postcode</label>
                                    <span class="text-danger"> *</span>
                                    <input type="text" id="postcode" name="postcode"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('postcode') }}" required>
                                    @error('postcode')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Your Business Type</label>
                                    <span class="text-danger"> *</span>

                                    <select name="business_type" id="business_type" class="form-control" required>
                                        <option value="">--Select--</option>
                                        <option value="Limited Company">Limited Company</option>
                                        <option value="Self Employed">Self-Employed</option>
                                        <option value="Own Business">Looking to start own business</option>
                                        <option value="None">None of the above</option>
                                    </select>
                                    @error('business_type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">No Of Employees</label>
                                    <span class="text-danger"> *</span>
                                    <select name="no_of_employee" id="no_of_employees" class="form-control" required>
                                        <option value="">--Select--</option>
                                        <option value="1">1</option>
                                        <option value="2-5">2-5</option>
                                        <option value="6-9">6-9</option>
                                        <option value="10+">10+</option>
                                    </select>
                                </div>
                            </div>


                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Opening Time </label>
                                    <input type="time" id="" name="opening"
                                           class="form-control "
                                           value="{{ old('opening') }}" >

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Closing Time </label>
                                    <input type="time" id="" name="closing"
                                           class="form-control"
                                           value="{{ old('closing') }}" >

                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn btn-primary" disabled>
                                        Register
                                        <div class="spinner-border d-none" role="status"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="content-column col-lg-8 col-md-8 col-sm-12 user_section" style="display: none">
                    <h1 class="mb-3">Create Account</h1>
                    <hr>
                    @include('front.includes.response')
                    <form action="{{ route('user.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
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
                            {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="">Phone</label>--}}
                                    {{--<span class="text-danger"> *</span>--}}
                                    {{--<input type="text" id="phone" name="phone"--}}
                                           {{--class="form-control @error('phone') is-invalid @enderror"--}}
                                           {{--value="{{ old('phone') }}" required>--}}
                                    {{--@error('phone')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                            {{--<strong>{{ $message }}</strong>--}}
                                        {{--</span>--}}
                                    {{--@enderror--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <span class="text-danger"> *</span>
                                    <input type="text" id="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           value="{{ old('password') }}" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn btn-primary">
                                        Register
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.min.js"></script>

    <script>
        // var select = $('select');
        var select = $('.select2');

        function formatSelection(state) {
            return state.text;
        }

        function formatResult(state) {
            console.log(state)
            if (!state.id) return state.text; // optgroup
            var id = 'state' + state.id.toLowerCase();
            var label = $('<label></label>', {for: id})
                .text(state.text);
            var checkbox = $('<input type="checkbox" style="display: none">', {id: id});

            return checkbox.add(label);
        }

        select.select2({
            closeOnSelect: false,
            formatResult: formatResult,
            formatSelection: formatSelection,
            minimumInputLength: 2,
            escapeMarkup: function (m) {
                return m;
            },
            matcher: function (term, text, opt) {
                return text.toUpperCase().indexOf(term.toUpperCase()) >= 0 || opt.parent("optgroup").attr("label").toUpperCase().indexOf(term.toUpperCase()) >= 0
            }
        }).on("change", function (e) {
            // alert($(this).val());
            if ($(this).val() == '') {
                $('.theme-btn').prop('disabled', true);
            }
            else {
                $('.theme-btn').prop('disabled', false);
            }
        });

        // select.select2({
        // }).on("change", function (e) {
        //     if($(this).val() == '') {
        //         $('.theme-btn').prop('disabled', true);
        //     }
        //     else {
        //         $('.theme-btn').prop('disabled', false);
        //     }
        // });
    </script>


    <script>
        // var select = $('select');
        var select = $('.sub_cat');

        function formatSelection(state) {
            return state.text;
        }

        function formatResult(state) {
            console.log(state)
            if (!state.id) return state.text; // optgroup
            var id = 'state' + state.id.toLowerCase();
            var label = $('<label></label>', {for: id})
                .text(state.text);
            var checkbox = $('<input type="checkbox" style="display: none">', {id: id});

            return checkbox.add(label);
        }

        select.select2({
            closeOnSelect: false,
            formatResult: formatResult,
            formatSelection: formatSelection,
            // minimumInputLength: 2,
            escapeMarkup: function (m) {
                return m;
            },
            matcher: function (term, text, opt) {
                return text.toUpperCase().indexOf(term.toUpperCase()) >= 0 || opt.parent("optgroup").attr("label").toUpperCase().indexOf(term.toUpperCase()) >= 0
            }
        })
    </script>




    <script>
        function registerTab(type){
            if(type == 'trader'){
                $(".trader_tab").css({"backgroundColor": "#0B5ED7"});
                $(".user_tab").css({"backgroundColor": ""});

                $(".trader_section").css({"display": "block"});
                $(".user_section").css({"display": "none"});
            }
            else{
                $(".user_tab").css({"backgroundColor": "#0B5ED7"});
                $(".trader_tab").css({"backgroundColor": ""});

                $(".trader_section").css({"display": "none"});
                $(".user_section").css({"display": "block"});
            }
        }
    </script>

    <script>
        function serviceAreaFunc(){
            var service_area = $('#service_area').val();

            $.ajax({
                url : "{{ url('get-service-areas') }}",
                type: 'get',
                data: {
                    service_area : service_area
                },
                success: function(res)
                {
                    $('#service_values').val(res);
                },
                error: function()
                {
                    // alert('failed...');

                }
            });
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


    <script>
        function SubCatFun(){
            var business_name = $('#business_name').val();
            $.ajax({
                url : "{{ url('get-sub-cats') }}",
                type: 'get',
                data: {
                    business_name : business_name
                },
                success: function(res)
                {
                    $('#sub_cat').html(res);
                },
                error: function()
                {
                    // alert('failed...');

                }
            });
        }
    </script>
@endsection
