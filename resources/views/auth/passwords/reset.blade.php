@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
        <div class="row">
            <div class="col-md-12">
                <h1>Reset Password</h1>
                <p><a href="{{ url('/') }}">{{ env('APP_NAME') }}</a></p>
                <hr>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <span class="text-danger"><sup>*</sup></span>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" autofocus>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password-confirm">Confirm Password</label>
                    <span class="text-danger"><sup>*</sup></span>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                        autocomplete="new-password">
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-lg mr-3 btn-primary">
                        Reset Password
                        <div class="spinner-border d-none" role="status"></div>
                    </button>
                </div>
            </div>
        </div>
    </form>

@endsection
