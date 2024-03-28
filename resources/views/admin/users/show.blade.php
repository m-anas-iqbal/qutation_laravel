@extends('layouts.admin')
@section('title', 'User Details')
@section('content')

    <div class="d-flex flex-column flex-md-row align-items-center jobTitlePadding">
        <h2 class="my-0 mr-md-auto">View User Details</h2>
        <a href="{{ route('users.edit', encrypt($user->id)) }}" class="btn btn-md btn-primary my-2 my-md-0">Update User</a>

    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="card p-5">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Role</label>
                        <p>{{ $user->as_admin == 1 ? 'Admin' : 'User' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label>Account Status</label>
                        <p>
                            @if ($user->status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Deactive</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Name</label>
                        <p>{{ $user->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label>E-Mail Address</label>
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="type"></span> User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to <span id="type-status"></span> <strong>{{ $user->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ url('/users', 'delete-user') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')

    <script></script>

@endsection
