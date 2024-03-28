@extends('layouts.admin')
@section('title', 'Update User')
@section('content')
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
    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Update User</h2>
        </div>
        <div class="col-md-12 col-sm-12 col-12" id="flFormsGrid">
            <div class="card p-5">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        {{--<div class="form-group col-md-6">--}}
                            {{--<label>Role</label>--}}
                            {{--<span class="text-danger"> *</span>--}}
                            {{--<select name="role_id" class="form-control form-select @error('role_id') is-invalid @enderror"--}}
                                {{--required>--}}
                                {{--<option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>--}}
                                {{--<option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>User</option>--}}
                            {{--</select>--}}
                            {{--@error('role_id')--}}
                                {{--<span class="invalid-feedback" role="alert">--}}
                                    {{--<strong>{{ $message }}</strong>--}}
                                {{--</span>--}}
                            {{--@enderror--}}
                        {{--</div>--}}
                        @if($user->role_id  == 2)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Your Service Area</label>
                                <span class="text-danger"> *</span>

                                <select class="select2 form-control" id="service_area" name="short_service_area[]"
                                        multiple required onchange="serviceAreaFunc()">
                                    <optgroup label="Country">
                                        @if(count($countries) > 0)
                                            @foreach($countries as $country)
                                                <option value="{{ $country->name }}" @if(in_array($country->name, $arr_values)) selected @endif>{{ $country->name }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                    <optgroup label="States">
                                        @if(count($states) > 0)
                                            @foreach($states as $state)
                                                <option value="{{ $state->name }}" @if(in_array($state->name, $arr_values)) selected @endif>{{ $state->name }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                    <optgroup label="Counties">
                                        @if(count($counties) > 0)
                                            @foreach($counties as $county)
                                                <option value="{{ $county->name }}" @if(in_array($county->name, $arr_values)) selected @endif>{{ $county->name }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                    <optgroup label="Cities">
                                        @if(count($cities) > 0)
                                            @foreach($cities as $city)
                                                <option value="{{ $city->name }}" @if(in_array($city->name, $arr_values)) selected @endif>{{ $city->name }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                    <optgroup label="Towns">
                                        @if(count($towns) > 0)
                                            @foreach($towns as $town)
                                                <option value="{{ $town->name }}" @if(in_array($town->name, $arr_values)) selected @endif>{{ $town->name }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" value="{{ $user->service_area }}" name="service_area[]" id="service_values" class="form-control">


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
                                                <!-- <option value="{{ $trade->name }}" >{{ $trade->name }}</option> -->
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

@endif
                        <div class="form-group col-md-6">
                            <label>Account Status</label>
                            <span class="text-danger"> *</span>
                            <select name="status" class="form-control form-select @error('status') is-invalid @enderror"
                                required>
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label>E-Mail Address</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="E-Mail" required autocomplete="off" value="{{ $user->email }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Full Name</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Full Name" required autocomplete="off" value="{{ $user->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>




                        <div class="col-md-6">
                            @if($user->photo)
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <th>

                                            <img src="{{ asset('upload/user/'. $user->photo) }}" style="border-radius: 50%; height: 60px; width: 60px" alt="{{ $user->photo }}"/>
                                        </th>
                                    </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>

                        <div class="col-md-6">

                            @if(isset($images))
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        @foreach($images as $image)
                                            <th>

                                                <img src="{{ asset('upload/user/images/'. $image->name) }}" style="border-radius: 50%; height: 60px; width: 60px" alt="{{ $image->name }}"/>
                                                <span><a href="{{ route('delete.user.image', $image->id) }}">Delete</a></span>
                                            </th>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            @endif

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Your Photo</label>
                                <span class="text-danger"> *</span>
                                <input type="file" name="photo" class="form-control">
                            </div>
                        </div>
                        @if($user->role_id  == 2)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Upload Images</label>
                                    <span class="text-danger"> *</span>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                </div>
                            </div>


                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Business Description</label>
                                <span class="text-danger"> *</span>
                                <textarea name="business_description" id="business_description" cols="30" rows="10" class="form-control">{{$user->business_description }}</textarea>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Business Phone</label>
                                <span class="text-danger"> *</span>
                                <input type="text" id="" name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{$user->phone }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Business Postcode</label>
                                <span class="text-danger"> *</span>
                                <input type="text" id="postcode" name="postcode"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{$user->postcode }}" >
                                @error('postcode')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Business Type</label>
                                <span class="text-danger"> *</span>

                                <select name="business_type" id="business_type" class="form-control" required>
                                    <option value="">--Select--</option>
                                    <option value="Limited Company" {{$user->business_type == 'Limited Company' ? 'selected' : ''}}>Limited Company</option>
                                    <option value="Self Employed" {{$user->business_type == 'Self Employed' ? 'selected' : '' }}>Self-Employed</option>
                                    <option value="Own Business" {{$user->business_type == 'Own Business' ? 'selected' : '' }}>Looking to start own business</option>
                                    <option value="None" {{$user->business_type == 'None' ? 'selected' : '' }}>None of the above</option>
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
                                    <option value="1" {{$user->no_of_employee == '1' ? 'selected' : ''}}>1</option>
                                    <option value="2-5" {{$user->no_of_employee == '2-5' ? 'selected' : ''}}>2-5</option>
                                    <option value="6-9" {{$user->no_of_employee == '6-9' ? 'selected' : ''}}>6-9</option>
                                    <option value="10+" {{$user->no_of_employee == '10+' ? 'selected' : ''}}>10+</option>
                                </select>
                            </div>
                        </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Website Url</label>
                                    <input type="text" id="website_url" name="website_url"
                                           class="form-control "
                                           value="{{ $user->website_url }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Ranking order no</label>
                                    <input type="number" id="rank_order_no" name="rank_order_no"
                                           class="form-control "
                                           value="{{ $user->rank_order_no }}">

                                </div>
                            </div>
                            @endif
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="loading-btn">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Update User
                                <div class="spinner-border d-none" role="status"></div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')
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
                console.log(res)
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
