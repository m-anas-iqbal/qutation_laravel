@extends('layouts.admin')
@section('title', 'User Details')
@section('content')

    <div class="d-flex flex-column flex-md-row align-items-center jobTitlePadding">
        <h2 class="my-0 mr-md-auto">View User Feedbacks</h2>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="card p-5">
                <div class="row mb-3">

                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Company Name</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Recommended</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ratings as $rating)
                                <?php
                                $user = \App\User::where('id', $rating->user_id)->first();
                                ?>
                            <tr>
                                <td>{{ $rating->company_name }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $rating->title }}</td>
                                <td>{{ $rating->description }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($rating->value == 10)
                                        Excellent
                                        @elseif($rating->value == 9)
                                        Very good!
                                        @elseif($rating->value == 8)
                                        Good
                                        @elseif($rating->value == 7)
                                        Ok
                                        @elseif($rating->value == 6)
                                        Acceptable
                                        @elseif($rating->value == 5)
                                        Disappointing
                                        @elseif($rating->value == 4)
                                        Below Expectations
                                        @elseif($rating->value == 3)
                                        Poor
                                        @elseif($rating->value == 2)
                                        Very Poor
                                        @elseif($rating->value == 1)
                                        Terrible
                                        @else
                                        Unacceptable
                                        @endif
                                </td>
                                <td> @if (isset($rating->recommend)) {{ $rating->recommend }} @else Empty @endif</td>
                                <td><a href="{{ url('delete-rating', $rating->id) }}"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a></td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('js')

    <script></script>

@endsection
