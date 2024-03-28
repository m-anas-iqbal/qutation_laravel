@extends('layouts.admin')
@section('title', 'Change Password')
@section('content')

    <div class="row">
         <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Change Password</h2>
        </div>
        <div class="col-md-12 col-sm-12 col-12">
            <div class="card p-5">
                <form action="{{ url('/password-settings') }}" method="POST" onsubmit="return loginLoadingBtn(this)">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Old Password</label>
                            <span class="text-danger"> *</span>
                            <input type="password" name="old_password"
                                class="form-control @error('old_password') is-invalid @enderror"
                                placeholder="Old Password" required autocomplete="off">
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label>New Password</label>
                            <span class="text-danger"> *</span>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="New Password"
                                required autocomplete="off">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Re-type Password</label>
                            <span class="text-danger"> *</span>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('confirm_password') is-invalid @enderror"
                                placeholder="Re-type Password" required autocomplete="off">
                            @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="loading-btn">
                            <button type="submit" class="btn btn-primary btn-lg mr-3">
                                Change Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
