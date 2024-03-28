@extends('layouts.admin')
@section('title', 'Add User')
@section('content')

    <div class="row ">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Create User</h2>
        </div>
        <div class="col-md-12 col-sm-12 col-12">
            <div class="card p-5">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Role</label>
                            <span class="text-danger"> *</span>
                            <select name="role_id" class="form-control form-select @error('role_id') is-invalid @enderror"
                                required>
                                <option value="">Choose...</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Full Name</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Full Name" required autocomplete="off" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>E-Mail</label>
                            <span class="text-danger"> *</span>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="E-Mail" required autocomplete="off" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <span class="text-danger"> *</span>
                            <input type="text" class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Password" required autocomplete="off"
                                value="{{ old('password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12" id="loading-btn">
                            <button type="submit" class="btn btn-primary btn-lg mr-3">
                                Add User
                                <div class="spinner-border d-none" role="status"></div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
