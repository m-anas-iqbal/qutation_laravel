@extends('layouts.admin')
@section('title', 'Countries')
@section('css')

    @include('admin.includes.datatables-css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css">
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Update - Site Settings </h2>
        </div>
        <div class="col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="card p-5">
                    <form action="{{ route('settings.update', $setting->id) }}" method="POST" id="edit-country-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Site Name</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="site_name" id="site_name" class="form-control"
                                   value="{{ $setting->site_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Site Description</label>
                            <span class="text-danger"> *</span>
                            <textarea name="site_description" id="site_description" cols="30" rows="10"
                                      class="form-control">{{ $setting->site_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Site Email</label>
                            <span class="text-danger"> *</span>
                            <input type="email" name="email" id="email" class="form-control"
                                   value="{{ $setting->email }}">
                        </div>
                        <div class="form-group">
                            <label for="">Site Tel</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="phone" id="phone" class="form-control"
                                   value="{{ $setting->phone }}">
                        </div>
                        @if(isset($setting->logo))
                        <div class="form-group">
                            <img src="{{ asset('upload/settings/'.$setting->logo) }}" alt="" style="height: 80px; width: 80px">
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="">Site Logo</label>
                            <span class="text-danger"> *</span>
                            <input type="file" name="logo" id="logo" class="form-control">
                        </div>
                        @if(isset($setting->favicon))
                            <div class="form-group">
                                <img src="{{ asset('upload/settings/'.$setting->favicon) }}" alt="" style="height: 80px; width: 80px">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Site Favicon</label>
                            <span class="text-danger"> *</span>
                            <input type="file" name="favicon" id="favicon" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Site Meta tags</label>
                            <span class="text-danger"> * use {area_name}</span>
                            <input type="text" name="site_meta_tags" id="site_meta_tag" class="form-control" value="{{ $setting->site_meta_tags }}">
                        </div>
                        <div class="form-group">
                            <label for="">Site Meta Description</label>
                            <span class="text-danger"> * use {area_name}</span>
                            <textarea name="site_meta_description" id="site_meta_description" cols="30" rows="10" class="form-control">{{ $setting->site_meta_description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="">User Schema</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {trader_name},{trader_phone},{area_name},{opening},{closing} and {web_url} if you need to mention Trader details</span>
                            <textarea name="user_schema" id="user_schema1" cols="30" rows="10" class="form-control">{{ $setting->user_schema }}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="">Single Schema</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {trader_name} if you need to mention Trader</span>
                            <textarea name="single_schema" id="single_schema1" cols="30" rows="10" class="form-control">{{ $setting->single_schema }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Home heading 1</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="home_h1" id="home_h1" class="form-control"
                                   value="{{ $setting->home_h1 }}" required>
                        </div>

                        <div class="form-group">
                            <label for="">Home heading 2</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="home_h2" id="home_h2" class="form-control"
                                   value="{{ $setting->home_h2 }}" required>
                        </div>

                        <div class="form-group">
                            <label for="">Home heading 3</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="home_h3" id="home_h3" class="form-control"
                                   value="{{ $setting->home_h3 }}" required>
                        </div>





                        <div class="form-group">
                            <label for="">Country meta Title</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {country_name}, {category} as a tag</span>
                            <input type="text" name="country_meta_title" id="country_meta_title" class="form-control"
                                   value="{{ $setting->country_meta_title }}">
                        </div>


                        <div class="form-group">
                            <label for="">State meta Title</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {country_name}, {state_name}, {category} as a tag</span>
                            <input type="text" name="state_meta_title" id="state_meta_title" class="form-control"
                                   value="{{ $setting->state_meta_title }}">
                        </div>

                        <div class="form-group">
                            <label for="">County meta</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {country_name}, {state_name}, {county_name}, {category} as a tag</span>
                            <input type="text" name="county_meta_title" id="county_meta_title" class="form-control"
                                   value="{{ $setting->county_meta_title }}">
                        </div>



                        <div class="form-group">
                            <label for="">City meta Title</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {country_name}, {state_name}, {county_name}, {city_name}, {category}, {postcode} as a tag</span>
                            <input type="text" name="city_meta_title" id="city_meta_title" class="form-control"
                                   value="{{ $setting->city_meta_title }}">
                        </div>



                        <div class="form-group">
                            <label for="">Town meta Title</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {country_name}, {state_name}, {county_name}, {city_name}, {town_name}, {category} as a tag</span>
                            <input type="text" name="town_meta_title" id="town_meta_title" class="form-control"
                                   value="{{ $setting->town_meta_title }}">
                        </div>



                        <div class="form-group">
                            <label for="">Country meta</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {country_name}, {category} as a tag</span>
                            <textarea name="country_meta" id="country_meta" cols="30" rows="10" class="form-control">{{ $setting->country_meta }}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="">State meta</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {country_name}, {state_name}, {category} as a tag</span>
                            <textarea name="state_meta" id="state_meta" cols="30" rows="10" class="form-control">{{ $setting->state_meta }}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="">County meta</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {country_name}, {state_name}, {county_name}, {category} as a tag</span>
                            <textarea name="county_meta" id="county_meta" cols="30" rows="10" class="form-control">{{ $setting->county_meta }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="">City meta</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {country_name}, {state_name}, {county_name}, {city_name}, {category}, {postcode} as a tag</span>
                            <textarea name="city_meta" id="city_meta" cols="30" rows="10" class="form-control">{{ $setting->city_meta }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Town meta</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {country_name}, {state_name}, {county_name}, {city_name}, {town_name}, {category} as a tag</span>
                            <textarea name="town_meta" id="town_meta" cols="30" rows="10" class="form-control">{{ $setting->town_meta }}</textarea>
                        </div>



                        <div class="form-group">
                            <label for="">H1 Variable</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {area_name}, {category} as a tag</span>
                            <textarea name="h1_variable" id="h1_variable" cols="30" rows="10" class="form-control">{{ $setting->h1_variable }}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="">Mail Subject</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="mail_subject" id="mail_subject" class="form-control"
                                   value="{{ $setting->mail_subject }}" required>
                        </div>


                        <div class="form-group">
                            <label for="">Copyright</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="copyright" id="copyright" class="form-control"
                                   value="{{ $setting->copyright }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Pushover Mail</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="pushover" id="pushover" class="form-control"
                                   value="{{ $setting->pushover }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Google Ads tag</label>
                            <textarea name="google_ads_tag" id="google_ads_tag" cols="30" rows="10" class="form-control">{{ $setting->google_ads_tag }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Area Url Permissions</label>
                            <span class="text-danger"> *</span>
                            <br>
                            <input type="checkbox" name="area_url[]" value="state" id="area_url" {{  in_array('state', explode(",", $setting->permissions_area)) ? 'checked' : '' }}>
                            <label for="">State</label>
                            <input type="checkbox" name="area_url[]" value="county" id="area_url" {{  in_array('county', explode(",", $setting->permissions_area)) ? 'checked' : '' }}>
                            <label for="">County</label>
                            <input type="checkbox" name="area_url[]" value="city" id="area_url" {{  in_array('city', explode(",", $setting->permissions_area)) ? 'checked' : '' }}>
                            <label for="">City</label>
                            <input type="checkbox" name="area_url[]" value="town" id="area_url" {{  in_array('town', explode(",", $setting->permissions_area)) ? 'checked' : '' }}>
                            <label for="">Town</label>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update
                            <div class="spinner-border d-none" role="status"></div>
                        </button>
                    </form>
                </div>
        </div>
    </div>


@endsection


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<script>

    $(document).ready(function() {
        var $editor = $('#user_schema');
        $editor.summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });

    });

    $(document).ready(function() {
        var $editor = $('#single_schema');
        $editor.summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });

    });

    $(document).ready(function() {
        var $editor = $('#site_meta_description');
        $editor.summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });

    });

    $(document).ready(function() {
        var $editor = $('#site_description');
        $editor.summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });

    });

    $(document).ready(function() {
        var $editor = $('#country_meta');
        $editor.summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });

    });

    $(document).ready(function() {
        var $editor = $('#state_meta');
        $editor.summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });

    });

    $(document).ready(function() {
        var $editor = $('#county_meta');
        $editor.summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });

    });

    $(document).ready(function() {
        var $editor = $('#city_meta');
        $editor.summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });

    });

    $(document).ready(function() {
        var $editor = $('#town_meta');
        $editor.summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });

    });

    $(document).ready(function() {
        var $editor = $('#h1_variable');
        $editor.summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });

    });
</script>
@endsection
