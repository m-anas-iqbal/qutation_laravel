@extends('layouts.admin')
@section('title', 'Emails')
@section('css')
@include('admin.includes.datatables-css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css">
@endsection
@section('content')
<?php

// print_r($email);
// die();
?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Emails - Settings </h2>
        </div>
        <div class="col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="card p-5">

                    <form action="{{ route('email_settings_post') }}" method="POST" id="edit-country-form" enctype="multipart/form-data">
                        @csrf
                        <h5>Users</h5>
                        <div class="form-group">
                            <label for="">Subject</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {subject_name} as a tag</span>
                            <input type="text" name="user_sub" id="user_sub" required class="form-control"
                                   value="{{ $email->user_subject }}">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {company_name}, {phone_no},and {datetime} this as a tag</span>
                            <textarea name="user_description" id="user_description" required cols="30" rows="10" class="form-control">{{ $email->user_description }}</textarea>
                        </div>
                        <hr>
                        <h5>Traders</h5>
                        <div class="form-group">
                            <label for="">Subject</label>
                            <span class="text-danger"> *</span> <span style="color: red">use {subject_name} as a tag</span>
                            <input type="text" name="trader_sub" id="user_sub" required class="form-control"
                                   value="{{ $email->trader_subject }}">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>  <span class="text-danger"> *</span> <span style="color: red">use {name}, {email},{phone},{postcode},{email},{description},{datetime} and {job_status} this as a tag</span>
                            <textarea name="trader_description" id="trader_description" required cols="30" rows="10" class="form-control">{{ $email->trader_description }}</textarea>
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
        var $editor = $('#user_description');
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
        var $editor = $('#trader_description');
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
