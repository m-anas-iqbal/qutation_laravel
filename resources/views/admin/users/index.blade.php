@extends('layouts.admin')
@section('title', 'Users')
@section('css')

    @include('admin.includes.datatables-css')

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Users</h2>
        </div>
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="alert alert-success d-none noti-response" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-x close" data-dismiss="alert">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg></button>
                <strong>Success!</strong> User notification status changed successfully.</button>
            </div>

            {{--<div class="card-body">--}}
                {{--<form action="{{ route('import') }}"--}}
                      {{--method="POST"--}}
                      {{--enctype="multipart/form-data">--}}
                    {{--@csrf--}}
                    {{--<input type="file" name="file"--}}
                           {{--class="form-control">--}}
                    {{--<br>--}}
                    {{--<button class="btn btn-success">--}}
                        {{--Import User Data--}}
                    {{--</button>--}}
                    {{--<a class="btn btn-warning"--}}
                       {{--href="{{ route('export') }}">--}}
                        {{--Export User Data--}}
                    {{--</a>--}}
                {{--</form>--}}
            {{--</div>--}}


            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <div id="html5-extension_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" role="grid"
                            aria-describedby="html5-extension_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting">ID</th>
                                    <th class="sorting">Name</th>
                                    <th class="sorting">Email</th>
                                    <th class="sorting">Role</th>
                                    <th class="sorting">Status</th>
                                    <th class="sorting"></th>
                                    <th class="sorting">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <div id="html5-extension_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <table id="html5-extension_2" class="table table-hover non-hover dataTable no-footer" role="grid"
                            aria-describedby="html5-extension_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting">ID</th>
                                    <th class="sorting">Name</th>
                                    <th class="sorting">Email</th>
                                    <th class="sorting">Role</th>
                                    <th class="sorting">Status</th>
                                    <th class="sorting"></th>
                                    <th class="sorting">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="delete-user" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete the user?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" id="delete-user-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">
                            Submit
                            <div class="spinner-border d-none" role="status"></div>
                        </button>
                    </form>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

    @include('admin.includes.datatables-js')
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
                    [0, "desc"]
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
                    "url": SITE_URL + "/users-list",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: CSRF_TOKEN
                    }
                },
                "columns": [{
                        "data": "id",
                        orderable: false
                    },
                    {
                        "data": "name",
                        orderable: false
                    },
                    {
                        "data": "email",
                        orderable: true
                    },
                    {
                        "data": "role",
                        orderable: true
                    },
                    {
                        "data": "status",
                        orderable: true
                    },
                    {
                        "data": "ratings",
                        orderable: true
                    },
                    {
                        "data": "action",
                        orderable: true
                    },
                ]
            });
        });
        $(document).ready(function() {
            $('#html5-extension_2').DataTable({
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
                    [0, "desc"]
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
                    "url": SITE_URL + "/users-list_2",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: CSRF_TOKEN
                    }
                },
                "columns": [{
                        "data": "id",
                        orderable: false
                    },
                    {
                        "data": "name",
                        orderable: false
                    },
                    {
                        "data": "email",
                        orderable: true
                    },
                    {
                        "data": "role",
                        orderable: true
                    },
                    {
                        "data": "status",
                        orderable: true
                    },
                    {
                        "data": "ratings",
                        orderable: true
                    },
                    {
                        "data": "action",
                        orderable: true
                    },
                ]
            });
        });
        $(document).on('change', '.notification-toggle', function() {
            if ($(this).is(':checked')) {
                flag = 1;
            } else {
                flag = 0;
            }
            $.post(SITE_URL + '/users-get-email-status', {
                _token: CSRF_TOKEN,
                id: $(this).data('id'),
                status: flag,
            }, function(r) {
                $('.noti-response').removeClass('d-none');
            });
        });
        $(document).on('click', '.delete-user', function() {
            $('#delete-user-form').prop('action', $(this).data('action'));
        });
    </script>

@endsection
