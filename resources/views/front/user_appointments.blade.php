@extends('layouts.front')
@section('title', 'Position Details')
@section('content')

    <section class="py-8 py-md-11 bg-hn1" style="margin-top: 91px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h2 class="text-center">User Appointments</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('front.includes.user_menu')


    <section class="py-8 py-md-10" style="padding-top: unset !important;">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="content-column col-lg-12 col-md-12 col-sm-12 trader_section">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Business Name</th>
                            <th scope="col">User Name</th>
                            <th scope="col">User Email</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">User Postcode</th>
                            <th scope="col">Job Status</th>
                            <th scope="col">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user_appointments as $key=>$contact)
                            <?php
                            $business = \App\User::where('id', $contact->user_business_id)->first();
                            $user = \App\User::where('id', $contact->user_id)->first();
                            ?>
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $business->name }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->postcode }}</td>
                                <td>{{ $contact->job_status }}</td>
                                <td>{{ $contact->description }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </section>

@endsection

@section('script')

@endsection