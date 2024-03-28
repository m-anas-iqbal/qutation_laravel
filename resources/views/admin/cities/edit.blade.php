@extends('layouts.admin')
@section('title', 'Countries')
@section('css')

    @include('admin.includes.datatables-css')

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Update - {{ $city->name }} </h2>
        </div>
        <div class="col-md-12 col-sm-12 col-12 layout-spacing">
            <div>
                <div class="card p-5">
                <form action="{{ route('cities.update', $city->id) }}" method="POST" id="edit-country-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Country</label>
                        <span class="text-danger"> *</span>
                        <select name="country" id="country" class="form-control" required>
                            <option value="">--Select--</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->name }}" {{ $country->name == $city->country ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">State</label>
                        <span class="text-danger"> *</span>
                        <select name="state" id="state" class="form-control" onchange="stateFun()" required>
                            <option value="">--Select--</option>
                            @foreach($states as $state)
                                <option value="{{ $state->name }}" {{ $state->name == $city->state ? 'selected' : '' }}>{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">County</label>
                        <span class="text-danger"> *</span>
                        <select name="county" id="county" class="form-control" required>
                            <option value="">--Select--</option>
                            @foreach($counties as $county)
                                @if($county->name == $city->county)
                                    <option value="{{ $county->name }}" selected>{{ $county->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                        <div class="form-group">
                            <label for="">City</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $city->name }}" required>
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
    </script>

@endsection
