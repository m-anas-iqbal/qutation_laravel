@extends('layouts.admin')
@section('title', 'Applicant Details')
@section('content')

    @include('admin.partials.response')
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3>
                        Applicant Details
                        <button type="button" class="btn btn-md btn-primary float-right" data-toggle="modal"
                            data-target="#update-status"> Update Status
                        </button>
                    </h3>
                    <hr>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Department</label>
                                <p>{{ $applicant->department }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>State</label>
                                <p>{{ $applicant->state }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Job</label>
                                <p>{{ $applicant->title }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Positions</label>
                                <p>{{ $applicant->positions }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Name</label>
                                <p>{{ $applicant->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Email</label>
                                <p>{{ $applicant->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Phone</label>
                                <p>{{ $applicant->phone }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>City</label>
                                <p>{{ $applicant->city }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Resume</label>
                                <p><a href="{{ my_asset('uploads/' . $applicant->attachment) }}"><u>Attachment</u></a></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Status</label>
                            <h3>{!! applicantStatus($applicant->status) !!}</h3>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Closing Comments</label>
                                <textarea class="form-control" rows="2" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="update-status" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('applicants.update', $applicant->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Status</label>
                            <span class="text-danger"> *</span>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ $applicant->status == 1 ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="3" {{ $applicant->status == 3 ? 'selected' : '' }}>
                                    Approved
                                </option>
                                <option value="4" {{ $applicant->status == 4 ? 'selected' : '' }}>
                                    Rejected
                                </option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Comment</label>
                            <span class="text-danger"> * Optional</span>
                            <textarea name="comment" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Submit
                            <div class="spinner-border d-none" role="status"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
