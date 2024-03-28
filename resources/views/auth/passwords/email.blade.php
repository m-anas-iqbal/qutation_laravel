@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')

        <h4 class="d-block display-6 mb-2 fw-bold" style="color:#000865; font-weight:600">Career<span class="fw-light" style="color:#0d6efd;font-weight:300">Website</span></h4>
        <p class="text-muted fw-normal mb-5">Let's reset your password! <a href="{{ route('login') }}">Login Instead?</a></p>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf

                    <div class="mb-4">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <span class="text-danger"><sup>*</sup></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">
                        Send Email 
                        <div class="spinner-border d-none" role="status"></div>
                    </button>
                    
                </div>
            </div>
        </form>

@endsection
