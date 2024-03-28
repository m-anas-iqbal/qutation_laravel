@extends('layouts.front')
@section('title', 'Position Details')
@section('content')

    <section class="py-8 py-md-11 bg-hn1" style="margin-top: 91px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="text-center">Profile Information</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-8 py-md-10">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="content-column col-lg-8 col-md-8 col-sm-12 trader_section">
                        <h1 class="mb-3">Profile Details</h1>
                        <hr>
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                            <br>
                        @endif
                        @include('front.includes.response')
                        <form action="{{ route('update.user.profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">

                                <div class="col-md-6 md-offset-3">
                                    <div class="form-group">
                                        <label for="">Your Name</label>
                                        <span class="text-danger"> *</span>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ Auth::user()->name }}" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Your Email Address</label>
                                        <span class="text-danger"> *</span>
                                        <input type="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ Auth::user()->email }}" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    @if(Auth::user()->photo)
                                    <table class="table table-borderless">
                                        <tbody>
                                        <tr>
                                            <th>

                                                    <img src="{{ asset('upload/user/'. Auth::user()->photo) }}" style="border-radius: 50%; height: 60px; width: 60px" alt="{{ Auth::user()->photo }}"/>
                                            </th>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @endif
                                </div>

                                <div class="col-md-6">

                                    @if(isset($images))
                                        <table class="table table-borderless">
                                            <tbody>
                                            <tr>
                                                @foreach($images as $image)
                                                <th>

                                                    <img src="{{ asset('upload/user/images/'. $image->name) }}" style="border-radius: 50%; height: 60px; width: 60px" alt="{{ $image->name }}"/>
                                                    <span><a href="{{ route('delete.user.image', $image->id) }}">Delete</a></span>
                                                </th>
                                                    @endforeach
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endif

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Your Photo</label>
                                        <span class="text-danger"> *</span>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>
@if(Auth::user()->role_id == 2)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Upload Images</label>
                                        <span class="text-danger"> *</span>
                                        <input type="file" name="images[]" class="form-control" multiple>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Your Business Description</label>
                                        <span class="text-danger"> *</span>
                                        <textarea name="business_description" id="business_description" cols="30" rows="10" class="form-control">{{ Auth::user()->business_description }}</textarea>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Your Business Phone</label>
                                        <span class="text-danger"> *</span>
                                        <input type="text" id="" name="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ Auth::user()->phone }}">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Your Business Postcode</label>
                                        <span class="text-danger"> *</span>
                                        <input type="text" id="postcode" name="postcode"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ Auth::user()->postcode }}" >
                                        @error('postcode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Your Business Type</label>
                                        <span class="text-danger"> *</span>

                                        <select name="business_type" id="business_type" class="form-control" required>
                                            <option value="">--Select--</option>
                                            <option value="Limited Company" {{ Auth::user()->business_type == 'Limited Company' ? 'selected' : ''}}>Limited Company</option>
                                            <option value="Self Employed" {{ Auth::user()->business_type == 'Self Employed' ? 'selected' : '' }}>Self-Employed</option>
                                            <option value="Own Business" {{ Auth::user()->business_type == 'Own Business' ? 'selected' : '' }}>Looking to start own business</option>
                                            <option value="None" {{ Auth::user()->business_type == 'None' ? 'selected' : '' }}>None of the above</option>
                                        </select>
                                        @error('business_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No Of Employees</label>
                                        <span class="text-danger"> *</span>
                                        <select name="no_of_employee" id="no_of_employees" class="form-control" required>
                                            <option value="">--Select--</option>
                                            <option value="1" {{ Auth::user()->no_of_employee == '1' ? 'selected' : ''}}>1</option>
                                            <option value="2-5" {{ Auth::user()->no_of_employee == '2-5' ? 'selected' : ''}}>2-5</option>
                                            <option value="6-9" {{ Auth::user()->no_of_employee == '6-9' ? 'selected' : ''}}>6-9</option>
                                            <option value="10+" {{ Auth::user()->no_of_employee == '10+' ? 'selected' : ''}}>10+</option>
                                        </select>
                                    </div>
                                </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Website Url</label>
                                            <span class="text-danger"> *optional</span>
                                            <input type="text" id="website_url" name="website_url"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   value="{{ Auth::user()->website_url }}">
                                            @error('website_url')
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
                                            Update
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