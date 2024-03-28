@extends('layouts.admin')
@section('title', 'Countries')
@section('css')

    @include('admin.includes.datatables-css')

@endsection
@section('content')

    <div class="d-flex flex-column flex-md-row align-items-center jobTitlePadding">
        <h2 class="my-0 mr-md-auto">Manage Countries</h2>
        <button class="btn btn-lg btn-primary my-2 my-md-0 " data-toggle="modal" data-target="#add-country">Add Country</button>
    </div>



    {{--<div class="card-body">--}}
        {{--<form action="{{ route('country-import') }}"--}}
              {{--method="POST"--}}
              {{--enctype="multipart/form-data">--}}
            {{--@csrf--}}
            {{--<input type="file" name="file"--}}
                   {{--class="form-control">--}}
            {{--<br>--}}
            {{--<button class="btn btn-success">--}}
                {{--Import User Data--}}
            {{--</button>--}}

        {{--</form>--}}
    {{--</div>--}}


    <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                {{--<a class="btn btn-info"--}}
                   {{--href="{{ route('country-export') }}" style="float: right;margin-right: 32px;">--}}
                    {{--Export Country Data--}}
                {{--</a>--}}
                <div class="table-responsive mb-4 mt-4">
                    <div id="html5-extension_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" role="grid" aria-describedby="html5-extension_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting">ID</th>
                                    <th class="sorting">Country</th>
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

    <div class="modal" id="add-country" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('countries.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Country</label>
                            <span class="text-danger"> *</span>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Submit
                            <div class="spinner-border d-none" role="status"></div>
                        </button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="delete-country" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" id="delete-country-form">
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
                    buttons: [
                    //     {
                    //     extend: 'csv',
                    //     className: 'btn'
                    // }, {
                    //     extend: 'excel',
                    //     className: 'btn'
                    // }
                    ]
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
                    "url": SITE_URL + "/countries-list",
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
                        "data": "country",
                        orderable: true
                    },
                    {
                        "data": "action",
                        orderable: false
                    }
                ]
            });
        });
        // $('.edit-country').click(function() {
        //     $("#edit-country-form").prop('action', $(this).data('action'));
        //     $("#name").val($(this).data('name'));
        // });

        $(document).on('click', '.delete-country', function() {
            $("#delete-country-form").prop('action', $(this).data('action'));
        });
    </script>

@endsection
