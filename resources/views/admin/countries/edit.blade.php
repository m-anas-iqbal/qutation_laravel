@extends('layouts.admin')
@section('title', 'Countries')
@section('css')

    @include('admin.includes.datatables-css')

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Update - {{ $country->name }} </h2>
        </div>
        <div class="col-md-12 col-sm-12 col-12 layout-spacing">
            <div>
                <div class="card p-5">
                <form action="{{ route('countries.update', $country->id) }}" method="POST" id="edit-country-form">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="">Country</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $country->name }}" required>
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


@endsection
