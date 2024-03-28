@extends('layouts.admin')
@section('title', 'Countries')
@section('css')

@endsection
@section('content')


    <div class="d-flex flex-column flex-md-row align-items-center jobTitlePadding">
        <h2 class="my-0 mr-md-auto">All Details</h2>
    </div>



    <div class="row">
        <div class="col-xl-6 col-lg-6 col-sm-6  layout-spacing">
    <div class="card">
        <div class="card-body">
            <p>
                <span style="font-weight: 600">Service Area:</span>   <span>{{ $description->service_area_values }}</span>
            </p>
            <p>
                <span style="font-weight: 600">Description:</span>   <span>{{ $description->description }}</span>
            </p>
            <p>
                <span style="font-weight: 600">Tag Description:</span>   <span>{{ $description->tag_description }}</span>
            </p>
        </div>
    </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-sm-6  layout-spacing">
    <div class="card">
        <div class="card-body">
            @if(count($faqs) > 0)
                @foreach($faqs as $key=>$faq)
            <p>
                <span style="font-weight: 600">Question {{ $key+1  }}:</span>   <span>{{ $faq->question }}</span>
            </p>
            <p>
                <span style="font-weight: 600">Answer:</span>   <span>{{ $faq->answer }}</span>
            </p>
                @endforeach
                @endif
        </div>
    </div>
        </div>
    </div>

    @endsection