@extends('layouts.admin')
@section('title', 'Countries')
@section('css')

    @include('admin.includes.datatables-css')

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Update - {{ $category->name }} </h2>
        </div>
        <div class="col-md-12 col-sm-12 col-12 layout-spacing">
            <div>
                <div class="card p-5">
                <form action="{{ route('business-sub-categories.update', $category->id) }}" method="POST" id="edit-country-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Category</label>
                        <span class="text-danger"> *</span>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">--Select--</option>
                            @foreach($cats as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $category->category_id ? 'selected' : ''}}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="form-group">
                            <label for="">Sub Category</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
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
