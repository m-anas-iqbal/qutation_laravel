@extends('layouts.front')
@section('title', 'Position Details')
@section('content')

    <section class="py-8 py-md-11 bg-hn1" style="margin-top: 91px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h2 class="text-center">Welcome! Please Sign Up</h2>
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
    </style>

    <section class="py-8 py-md-11">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="content-column col-lg-8 col-md-8 col-sm-12">
                    <h1 class="mb-3">Add Your Business Details</h1>
                    <hr>
                    @include('front.includes.response')
                    <form action="{{ route('trader.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">

                            <input type="hidden" name="role_id" value="2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Your Business Name</label>
                                    <span class="text-danger"> *</span>

                                    <select class="select2 form-control" id="business_name" name="business_name[]"
                                            multiple required>
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

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Your Name</label>
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
                                    <label for="">Your Business Phone</label>
                                    <span class="text-danger"> *</span>
                                    <input type="text" id="phone" name="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') }}" required>
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
                                        <option value="limited_company">Limited Company</option>
                                        <option value="self_employed">Self-Employed</option>
                                        <option value="own_business">Looking to start own business</option>
                                        <option value="none">None of the above</option>
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
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn btn-primary" disabled>
                                        Apply Now
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
@endsection