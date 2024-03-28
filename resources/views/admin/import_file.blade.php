@extends('layouts.admin')
@section('title', 'Countries')
@section('css')

    @include('admin.includes.datatables-css')

@endsection
@section('content')

    <div class="d-flex flex-column flex-md-row align-items-center jobTitlePadding">
        <h2 class="my-0 mr-md-auto">Manage All Excel Data</h2>
    </div>


    <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <a class="btn btn-secondary"
               href="{{ url('sitemap') }}">
                Sitemape Xml
            </a>

            <a class="btn btn-warning"
               href="{{ url('/public/sitemap_data.xml') }}" target="_blank">
                Show Sitemape Xml
            </a>

            <a class="btn btn-info"
               href="{{ route('export.url') }}" style="float: right;margin-right: 32px;">
                Export Urls
            </a>

            <a class="btn btn-info"
               href="{{ route('export.excel') }}" style="float: right;margin-right: 32px;">
                Export Data
            </a>

        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
    <div class="card-body">
        <div class="widget-content widget-content-area br-6">
        <form action="{{ route('save-import-excel') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="file" name="file"
                   class="form-control" style="padding: 8px 10px;" required>
            <br>
            <button class="btn btn-primary">
                Import Excel Data
            </button>
        </form>
        </div>
    </div>
            </div>
        </div>
    </div>

    {{--<div class="d-flex flex-column flex-md-row align-items-center jobTitlePadding">--}}
        {{--<h2 class="my-0 mr-md-auto">Update Excel Data</h2>--}}
    {{--</div>--}}

    {{--<div class="row">--}}
        {{--<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">--}}
            {{--<div class="widget-content widget-content-area br-6">--}}
    {{--<div class="card-body">--}}
        {{--<div class="widget-content widget-content-area br-6">--}}
        {{--<form action="{{ route('town-import-excel') }}"--}}
              {{--method="POST"--}}
              {{--enctype="multipart/form-data">--}}
            {{--@csrf--}}
            {{--<input type="file" name="file"--}}
                   {{--class="form-control" style="padding: 8px 10px;">--}}
            {{--<br>--}}
            {{--<button class="btn btn-primary">--}}
                {{--Import Excel Data--}}
            {{--</button>--}}
        {{--</form>--}}
        {{--</div>--}}
    {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


@endsection
@section('js')

@endsection
