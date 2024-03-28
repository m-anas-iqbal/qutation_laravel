@extends('layouts.admin')
@section('title', 'Update Post')
@section('css')

    <link href="{{ my_asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ my_asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Update - {{ $post->title }} </h2>
        </div>
        <div class="col-md-12 col-sm-12 col-12 layout-spacing">
            <div>
                <div class="card p-5">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Select Department</label>
                                <span class="text-danger"> *</span>
                                <select name="department_id"
                                    class="form-select form-control @error('department_id') is-invalid @enderror" required>
                                    <option value="">--Select--</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ $post->department_id == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Location's</label>
                                <span class="text-danger"> *</span>
                                <input type="text" name="state"
                                    class="form-control @error('state') is-invalid @enderror" required
                                    value="{{ $post->state }}">
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Job Title</label>
                                <span class="text-danger"> *</span>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" required value="{{ $post->title }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Positions</label>
                                <span class="text-danger"> *</span>
                                <input type="text" class="form-control @error('positions') is-invalid @enderror"
                                    name="positions" required value="{{ $post->positions }}">
                                @error('positions')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Opened Date</label>
                                <span class="text-danger"> *</span>
                                <input type="text" class="form-control @error('opened_date') is-invalid @enderror"
                                    name="opened_date" id="date_flatpickr" placeholder="Select Opened Date"
                                    value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $post->opened_date)->format('m-d-Y') }}" required autocomplete="off">
                                @error('opened_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <span class="text-danger"> *</span>
                                <select class="form-select form-control @error('status') is-invalid @enderror"
                                    name="status" id="status" required>
                                    <option value="">-- Select --</option>
                                    <option {{ $post->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $post->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-group col-md-12">
                                <h4 class="mb-3">Job/Position Summary:</h4>
                                <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" rows="5">{{ $post->desc }}</textarea>
                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-group col-md-12">
                                <h4 class="mb-3">Essential Functions & Responsibilities:</h4>
                                <textarea id="essential_functions_responsibilites"
                                    class="form-control @error('essential_functions_responsibilites') is-invalid @enderror"
                                    name="essential_functions_responsibilites" rows="5">{{ $post->essential_functions_responsibilites }}</textarea>
                                @error('essential_functions_responsibilites')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="form-group col-md-12">
                                <h4 class="mb-3">Required Education and Experience:</h4>
                                <textarea id="required_eduaction_experince"
                                    class="form-control @error('required_eduaction_experince') is-invalid @enderror" name="required_eduaction_experince"
                                    rows="5">{{ $post->required_eduaction_experince }}</textarea>
                                @error('required_eduaction_experince')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="loading-btn">
                                <button type="submit" class="btn btn-primary btn-lg mr-3">
                                    Update Position
                                    <div class="spinner-border d-none" role="status"></div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script src="https://cdn.tiny.cloud/1/jadie5q2a90ymrxs71qaz734zlyhepjf90uovc7fy333ro7k/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'autolink advlist lists link media table imagetools image hr pagebreak',
            toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect styleselect | alignleft aligncenter alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | link image',
            style_formats: [

                {
                    title: 'Training Title',
                    inline: 'strong',
                    styles: {
                        color: '#0069d1',
                        fontSize: '20pt'
                    }
                },
                {
                    title: 'Page Title',
                    inline: 'strong',
                    styles: {
                        fontSize: '16pt'
                    }
                },
                {
                    title: 'Links',
                    inline: 'span',
                    inline: 'u',
                    styles: {
                        color: '#0000EE'
                    }
                },
                {
                    title: 'red',
                    inline: 'span',
                    styles: {
                        color: '#d32f2f'
                    }
                },
                {
                    title: 'Badge',
                    inline: 'span',
                    styles: {
                        display: 'inline-block',
                        border: '1px solid #2276d2',
                        'border-radius': '5px',
                        padding: '2px 5px',
                        margin: '0 2px',
                        color: '#2276d2'
                    }
                },

            ],

            toolbar_mode: 'floating',
            image_advtab: true,
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });;
    </script>
    <script src="{{ my_asset('plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ my_asset('plugins/flatpickr/custom-flatpickr.js') }}"></script>
    <script>
        var f1 = flatpickr(document.getElementById('opened_date'), {
            dateFormat: "m-d-Y",
        });
    </script>

@endsection
