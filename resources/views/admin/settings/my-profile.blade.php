@extends('layouts.admin')
@section('title', 'Profile Details')
@section('content')

    <div class="row">
         <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Update My Profile</h2>
        </div>
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="card p-5">
                <form action="{{ route('profile-update') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="" value="{{ $user->name }}" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">E-Mail Adress</label>
                                    <span class="text-danger"> *</span>
                                    <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="loading-btn">
                                <button type="submit" class="btn btn-primary btn-lg mr-3">
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

@endsection
