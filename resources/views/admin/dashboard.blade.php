@extends('layouts.admin')
@section('title', 'Dashboard')
@section('css')

    @include('admin.includes.datatables-css')

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Hello, {{ Auth::user()->name }}</h2>
            <!--@include('admin.partials.response')-->
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="card">
                <div class="card-body">

                    <h4 class="jobTitlePadding">Welcome! To Admin Panel</h4>
                </div>
            </div>
        </div>
    </div>

@endsection