@extends('layouts.admin')
@section('title', 'Countries')
@section('css')

    @include('admin.includes.datatables-css')

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Update - {{ $business_category->name }} </h2>
        </div>
        <div class="col-md-12 col-sm-12 col-12 layout-spacing">
            <div>
                <div class="card p-5">
                <form action="{{ route('business-categories.update', $business_category->id) }}" method="POST" id="edit-country-form">
                    @csrf
                    @method('PUT')

                    {{--<div class="form-group">--}}
                        {{--<label for="">Country</label>--}}
                        {{--<span class="text-danger"> *</span>--}}
                        {{--<select name="country" id="country" class="form-control" required>--}}
                            {{--<option value="">--Select--</option>--}}
                            {{--@foreach($countries as $country)--}}
                                {{--<option value="{{ $country->name }}" {{ $country->name == $business_category->country ? 'selected' : '' }}>{{ $country->name }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="">State</label>--}}
                        {{--<span class="text-danger"> *</span>--}}
                        {{--<select name="state" id="state" class="form-control" onchange="stateFun()">--}}
                            {{--<option value="">--Select--</option>--}}
                            {{--@foreach($states as $state)--}}
                                {{--<option value="{{ $state->name }}" {{ $state->name == $business_category->state ? 'selected' : '' }}>{{ $state->name }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="">County</label>--}}
                        {{--<span class="text-danger"> *</span>--}}
                        {{--<select name="county" id="county" class="form-control" onchange="countyFun()">--}}
                            {{--<option value="">--Select--</option>--}}
                            {{--@foreach($counties as $county)--}}
                                {{--@if($county->name == $business_category->county)--}}
                                {{--<option value="{{ $county->name }}" selected>{{ $county->name }}</option>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="">City</label>--}}
                        {{--<span class="text-danger"> *</span>--}}
                        {{--<select name="city" id="city" class="form-control" onchange="cityFun()">--}}
                            {{--<option value="">--Select--</option>--}}
                            {{--@foreach($cities as $city)--}}
                                {{--@if($city->name == $business_category->city)--}}
                                {{--<option value="{{ $city->name }}" selected>{{ $city->name }}</option>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label for="">Town</label>--}}
                        {{--<span class="text-danger"> *</span>--}}
                        {{--<select name="town" id="town" class="form-control">--}}
                            {{--<option value="">--Select--</option>--}}
                            {{--@foreach($towns as $town)--}}
                                {{--@if($town->name == $business_category->town)--}}
                                {{--<option value="{{ $town->name }}" selected>{{ $town->name }}</option>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}

                        <div class="form-group">
                            <label for="">Category Name</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $business_category->name }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Update
                            <div class="spinner-border d-none" role="status"></div>
                        </button>
                </form>
            </div>
        </div>
    </div>
    </div>


    <script>
        function stateFun(){
            var state = $('#state').val();
            $('#city').html('');
            $('#town').html('');
            $.ajax({
                url : "{{ url('get-county') }}",
                type: 'get',
                data: {
                    state : state
                },
                success: function(res)
                {
                    $('#county').html(res);
                },
                error: function()
                {
                    // alert('failed...');

                }
            });
        }

        function countyFun(){
            var county = $('#county').val();
            $.ajax({
                url : "{{ url('get-cities') }}",
                type: 'get',
                data: {
                    county : county
                },
                success: function(res)
                {
                    $('#city').html(res);
                },
                error: function()
                {
                    // alert('failed...');

                }
            });
        }

        function cityFun(){
            var city = $('#city').val();
            $.ajax({
                url : "{{ url('get-towns') }}",
                type: 'get',
                data: {
                    city : city
                },
                success: function(res)
                {
                    $('#town').html(res);
                },
                error: function()
                {
                    // alert('failed...');

                }
            });
        }
    </script>

@endsection
