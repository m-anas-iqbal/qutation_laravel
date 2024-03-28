@extends('layouts.front')
@section('title', 'Position Details')
@section('content')

    <section class="py-8 py-md-11 bg-hn1" style="margin-top: 91px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="text-center">Profile Information</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('front.includes.user_menu')

    <section class="py-8 py-md-10">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-3" align="center">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('upload/user/'. Auth::user()->photo) }}" style="border-radius: 50%;" alt="{{ Auth::user()->photo }}"/>
                    @else
                        <img src="{{ asset('images/nophoto.jpg') }}" alt="no-photo" style="border-radius: 50%;"/>
                    @endif
                </div>
                <div class="col-md-7" align="center">

                    <!-- Main -->
                    <div class="card">
                        <div class="card-body">
                            <table>
                                <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>{{ Auth::user()->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ Auth::user()->email }}</td>
                                </tr>
                                @if(Auth::user()->role_id == 2)
                                <tr>
                                    <td>Phone</td>
                                    <td>:</td>
                                    <td>{{ Auth::user()->phone }}</td>
                                </tr>
                                    <tr>
                                        <td>Postcode</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->postcode }}</td>
                                    </tr>
                                    <tr>
                                        <td>Business Type</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->business_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>No of Employee</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->no_of_employee }}</td>
                                    </tr>
                                @if(Auth::user()->website_url)
                                    <tr>
                                        <td>Website Url</td>
                                        <td>:</td>
                                        <td>{{ Auth::user()->website_url }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <?php
                                        $business_name = Auth::user()->business_name;
                                        $array_values = explode(',', $business_name);
                                        ?>

                                        <td>Business Names</td>
                                        <td>:</td>
                                        <td>
                                            @foreach($array_values as $value)
                                                {{ $value }}
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End -->
                </div>
                <div class="col-md-2" align="center">
                    <a href="{{ route('edit.user.profile') }}"><img src="{{ asset('images/edit.png') }}"
                                                                    style="height: 20px;float: left;"/></a>
                </div>
            </div>

        </div>
    </section>

@endsection

@section('script')

@endsection