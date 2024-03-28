@extends('layouts.front')
@section('title', 'Position Details')
@section('content')

    <section class="py-8 py-md-11 bg-hn1" style="margin-top: 91px;">
        <div class="container">
            <div class="row">
                <col-md-12>
                    <div class="job-block-seven">
                        <div class="inner-box">
                            <div class="content">
                                <h2>{{ $post->title }}</h2>
                                <ul class="job-info">
                                    <li>
                                        <svg class="mb-1" viewBox="0 0 24 24" width="16" height="16"
                                            stroke="currentColor" stroke-width="1" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="2" y="7" width="20" height="14" rx="2"
                                                ry="2"></rect>
                                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                        </svg> {{ $post->department }}
                                    </li>
                                    <li>
                                        <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="10" r="3"></circle>
                                            <path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z">
                                            </path>
                                        </svg> {{ $post->state }}
                                    </li>
                                    <li>
                                        <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg> {{ $post->created_at->diffForHumans() }}
                                    </li>
                                    <li>
                                        <svg class="mb-1" id="folder-alt" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" width="16" height="16" fill="none"
                                            stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path id="primary"
                                                d="M3,20V5A1,1,0,0,1,4,4H8a1,1,0,0,1,.71.29l2.41,2.42a1,1,0,0,0,.71.29H17a1,1,0,0,1,1,1v3">
                                            </path>
                                            <polygon id="primary-2" data-name="primary"
                                                points="18 20 21 11 7 11 3 20 18 20"></polygon>
                                        </svg> {{ $post->positions }} available
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </col-md-12>
            </div>
        </div>
    </section>

    <section class="py-8 py-md-11">
        <div class="container">
            <div class="row justify-content-center">
                <div class="content-column col-lg-8 col-md-8 col-sm-12">
                    <h1 class="mb-3">Apply Now</h1>
                    <hr>
                    @include('front.includes.response')
                    <form action="{{ route('apply.now.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ encrypt($post->id) }}">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Department</label>
                                    <span class="text-danger"> *</span>
                                    <input type="text" value="{{ $post->department }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Job Title</label>
                                    <span class="text-danger"> *</span>
                                    <input type="text" value="{{ $post->title }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
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
                                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <span class="text-danger"> *</span>
                                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">City</label>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="city"
                                        class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" required>
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Resume</label>
                                    <span class="text-danger"> *</span>
                                    <input type="file" name="attachment_id"
                                        class="form-control @error('attachment_id') is-invalid @enderror" required>
                                    @error('attachment_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn-style-one no-border">
                                        Apply Now
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
