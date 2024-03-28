@extends('layouts.admin')
@section('title', 'About Us')
@section('css')

    @include('admin.includes.datatables-css')

@endsection
@section('content')

    <div class="d-flex flex-column flex-md-row align-items-center jobTitlePadding">
        <h2 class="my-0 mr-md-auto">Manage About Us</h2>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4 mt-4">
                    <div id="html5-extension_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" role="grid" aria-describedby="html5-extension_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting">ID</th>
                                    <th class="sorting">About Us</th>
                                    <th class="sorting">Description</th>
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
                    "url": SITE_URL + "/about-us-list",
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
                        "data": "description",
                        orderable: true
                    },
                    {
                        "data": "action",
                        orderable: false
                    }
                ]
            });
        });
    </script>

@endsection
