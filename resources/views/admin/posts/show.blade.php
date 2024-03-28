@extends('layouts.admin')
@section('title', 'Post Details')
@section('content')
    
    <div class="d-flex flex-column flex-md-row align-items-center jobTitlePadding">
        <h2 class="my-0 mr-md-auto">View - {{ $post->title }}</h2>
        <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-md btn-primary my-2 my-md-0">Update Position</a>
        <button class="btn btn-modal btn-md btn-danger ml-2" data-toggle="modal" data-target="#exampleModal" title="Delete Post">Delete</button>
    </div>
    
    @include('admin.partials.response')
    <div class="row layout-top-spacing mb-3">
        
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="card p-5">
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Status</h6>
                        <p>
                            @if ($post->status)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Job Title</label>
                        <input class="form-control" type="text" value="{{ $post->title }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Positions Available</label>
                        <input class="form-control" type="text" value="{{ $post->positions }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Department</label>
                        <input class="form-control" type="text" value="{{ $post->department }}" readonly>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-4">
                        <label>Added By</label>
                        <input class="form-control" type="text" value="{{ $post->user }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Created at</label>
                        <input class="form-control" type="text" value="{{ $post->created_at }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Updated at</label>
                        <input class="form-control" type="text" value="{{ $post->updated_at }}" readonly>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h4>Job/Position Summary</h4>
                        {!! $post->desc !!}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h4>Essential Functions & Responsibilities</h4>
                        {!! $post->required_eduaction_experince !!}
                    </div>
                </div>
                <div class="row lastItem">
                    <div class="col-md-12">
                        <h4>Required Education and Experience</h4>
                        {!! $post->essential_functions_responsibilites !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete post?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" id="form-action">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

@endsection
