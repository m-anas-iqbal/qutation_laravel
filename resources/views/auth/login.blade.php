@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <?php
    $setting = App\Setting::first();
    ?>

        <h4 class="d-block display-6 mb-2 fw-bold" style="color:#000865; font-weight:600">@if(isset($name)){{ str_replace('{area_name}', $name, $setting->site_name) }}@else{{ str_replace('{area_name}', '', $setting->site_name) }}@endif</h4>
        
        <p class="text-muted fw-normal mb-5">Welcome back! <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a></p>
        <form action="{{ route('login') }}" method="POST">
        @csrf

                <div class="mb-3">
                    <label for="email">{{ __('E-Mail Address') }} <span class="text-danger"><sup>*</sup></span></label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="password">{{ __('Password') }} <span class="text-danger"><sup>*</sup></span></label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-5">
                    <div class="col-6 d-flex align-items-center ps-0">
                        <div class="form-check" style="padding-left: .25rem;">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-6 justify-content-end d-flex pr-0">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" onclick="myFunction()">
                            <label class="form-check-label" for="flexCheckChecked">
                                Show Password
                            </label>
                        </div>
                    </div>
                    
                </div>
                
                <button type="submit" class="btn btn-lg btn-primary">
                    Login
                    <div class="spinner-border d-none" role="status"></div>
                </button>

                
            </div>
        </div>
    </form>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
