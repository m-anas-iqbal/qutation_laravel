@extends('layouts.front')
@section('title', 'Position Details')
@section('content')

    <section class="py-8 py-md-11 bg-hn1" style="margin-top: 91px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h2 class="text-center">Request a Quote</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.css">
    <style>
        .select2-choices {
            border: unset !important;
        }

        .select2-container-multi .select2-choices {
            background-image: unset !important;
        }
    </style>





    <section class="py-8 py-md-10">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="content-column col-lg-8 col-md-8 col-sm-12 trader_section">


                    @include('front.includes.response')
                    <form action="{{ route('save.quote') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" value="{{ $user_id }}" name="user_business_id">
                        <div class="row mb-3">


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <span class="text-danger"> *</span>
                                    <textarea name="business_description" id="business_description" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>


                            @if(!Auth::user())

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <span class="text-danger"> *</span>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">E-Mail Address</label>
                                        <span class="text-danger"> *</span>
                                        <input type="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Password:</label>
                                        <span> <strong>You want to create account?</strong> <small class="text-danger">(optional)</small></span>
                                        <input type="text" id="password" name="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               value="{{ old('password') }}">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <span class="text-danger"> <small>(optional)</small></span>
                                        <input type="text" id="phone" name="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone') }}">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            @endif



                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn btn-primary">
                                        Request a Quote
                                        <div class="spinner-border d-none" role="status"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('script')

@endsection
