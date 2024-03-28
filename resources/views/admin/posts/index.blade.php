@extends('layouts.admin')
@section('title', 'Posts')
@section('css')

    @include('admin.includes.datatables-css')

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Manage Jobs</h2>
        </div>
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive">
                    <div id="html5-extension_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" role="grid" aria-describedby="html5-extension_info">
                            <thead>
                                <tr role="row">
                                    <th>ID</th>
                                    <th>Job Title</th>
                                    <th>Department</th>
                                    <th>Location(s)</th>
                                    <th>Positions<br>Available</th>
                                    <th>Date<br>Created</th>
                                    <th>Added By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
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
                    <form action="" method="POST" id="delete-post-form">
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
    <script>
        $(document).ready(function() {
            $('#html5-extension').DataTable({
                dom: '<"row"<"col-md-12 px-0"<"row"  <"col-md-4"l>  <"col-md-4 text-center"B>  <"col-md-4"f>>>' +
                '<"col-md-12 px-0"tr>' +
                '<"col-md-12"<"row"  <"col-md-5 pl-0"i>  <"col-md-7 text-right"p>>> >',
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
                    "url": SITE_URL + "/posts-list",
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
                        "data": "title",
                        orderable: true
                    },
                    {
                        "data": "department",
                        orderable: false
                    },
                    {
                        "data": "state",
                        orderable: true
                    },
                    
                    {
                        "data": "positions",
                        orderable: true
                    },
                    {
                        "data": "date",
                        orderable: true
                    },
                    {
                        "data": "added",
                        orderable: false
                    },
                    {
                        "data": "status",
                        orderable: true
                    },
                    {
                        "data": "action",
                        orderable: true
                    },
                ]
            });
        });
        $(document).on('click', '.delete-post', function() {
            alert();
            $('#delete-post-form').prop('action', $(this).data('action'));
        });
    </script>

@endsection
