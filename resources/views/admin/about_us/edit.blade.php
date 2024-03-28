@extends('layouts.admin')
@section('title', 'Countries')
@section('css')

    @include('admin.includes.datatables-css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css">
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Update - {{ $about_us->title }} </h2>
        </div>
        <div class="col-md-12 col-sm-12 col-12 layout-spacing">
            <div>
                <div class="card p-5">
                <form action="{{ route('about-us.update', $about_us->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="">Title</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $about_us->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <span class="text-danger"> *</span>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $about_us->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Update
                            <div class="spinner-border d-none" role="status"></div>
                        </button>
                </form>
            </div>
        </div>
    </div>
    </div>


@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<script>

    $(document).ready(function() {
        var $editor = $('#description');
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