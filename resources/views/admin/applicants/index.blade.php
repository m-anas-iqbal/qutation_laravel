@extends('layouts.admin')
@section('title', 'Applicants')
@section('css')

    @include('admin.includes.datatables-css')
    <link href="{{ my_asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ my_asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

@endsection
@section('content')

    @include('admin.partials.response')
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="widget-content widget-content-area">
                <h4>Select Filter</h4>
                <hr>
                <form action="">
                    <div class="row container-fluid">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="date_flatpickr" placeholder="Select From Date" name="from"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="date_flatpickr1" placeholder="Select To Date" name="to"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Filter Applicants</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <div id="html5-extension_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" role="grid"
                            aria-describedby="html5-extension_info">
                            <thead>
                                <tr role="row">
                                    <th>ID</th>
                                    <th>Action</th>
                                    <th>Department</th>
                                    <th>Job</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Resume</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="delete-applicant" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Applicant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" id="delete-applicant-form">
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

    @include('admin.includes.datatables-js')
    <script src="{{ my_asset('plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ my_asset('plugins/flatpickr/custom-flatpickr.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#html5-extension').DataTable({
                dom: '<"row"<"col-md-12"<"row"  <"col-md-4"l>  <"col-md-4 text-center"B>  <"col-md-4"f>>>' +
                    '<"col-md-12"tr>' +
                    '<"col-md-12 mt-2"<"row mt-3"  <"col-md-5"i>  <"col-md-7 text-right"p>>> >',
                buttons: {
                    buttons: [{
                        extend: 'csv',
                        className: 'btn'
                    }, {
                        extend: 'excel',
                        className: 'btn'
                    }]
                },
                "processing": true,
                "serverSide": true,
                "responsive": true,
                order: [
                    [8, "desc"]
                ],
                "pageLength": 4,
                lengthMenu: [
                    [4, 10, 20, -1],
                    [4, 10, 20, 'All']
                ],
                stateSave: true,
                columnDefs: [{
                    'visible': false,
                    'targets': [0]
                }],
                "ajax": {
                    "url": SITE_URL + "/applicants-list",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: CSRF_TOKEN,
                        from: '{{ $from }}',
                        to: '{{ $to }}',
                    }
                },
                "columns": [{
                        "data": "id",
                        orderable: false
                    },
                    {
                        "data": "action",
                        orderable: false
                    },
                    {
                        "data": "department",
                        orderable: true
                    },
                    {
                        "data": "job",
                        orderable: true
                    },
                    {
                        "data": "name",
                        orderable: true
                    },
                    {
                        "data": "email",
                        orderable: true
                    },
                    {
                        "data": "phone",
                        orderable: true
                    },
                    {
                        "data": "city",
                        orderable: true
                    },
                    {
                        "data": "resume",
                        orderable: true
                    },
                    {
                        "data": "date",
                        orderable: true
                    },
                ]
            });
        });
        $(document).on('click', '.delete-applicant', function() {
            $('#delete-applicant-form').prop('action', $(this).data('action'));
        });
    </script>

@endsection
