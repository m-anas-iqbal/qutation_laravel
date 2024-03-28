@extends('layouts.front')
@section('title', 'Health Network One')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.css">
    <style>
        .select1-choice {
            border: unset !important;
        }

        .select1-choice {
            background-image: unset !important;
        }
        .select1-container .select2-choice div{
            display: none !important;
        }
        .select1-dropdown-open .select2-choice{
            background: white;
        }

        .select2-choice {
            border: unset !important;
        }

        .select2-choice {
            background-image: unset !important;
        }
        .select2-container .select2-choice div{
            display: none !important;
        }
        .select2-dropdown-open .select2-choice{
            background: white;
        }

    </style>



    <style>
        /*! CSS Used from: Embedded */
        .crZSbT{display:flex;-webkit-box-align:center;align-items:center;-webkit-box-pack:center;justify-content:center;cursor:pointer;background:none;border:none;border-radius:4px;font-family:"Open Sans", "Open Sans-fallback", Arial, sans-serif;font-size:1rem;font-weight:600;line-height:1.25rem;padding:0px 16px;box-sizing:border-box;text-decoration:none;text-align:center;min-height:40px;outline:0px;}
        .crZSbT:disabled{background-color:rgb(215, 215, 215);color:rgb(98, 104, 122);pointer-events:none;border:none;}
        @media (min-width: 600px){
            .crZSbT{padding:0px 24px;}
        }
        .fxqnjv{background-color:#0d6efd;color:rgb(255, 255, 255);}
        .fxqnjv:hover,.fxqnjv:active{background-color:#0c68f0;}
        .iuwDVC{font-family:"Open Sans", "Open Sans-fallback", Arial, sans-serif;font-weight:400;font-style:normal;font-size:1rem;letter-spacing:0em;-webkit-font-smoothing:antialiased;color:rgb(102, 102, 102);display:block;line-height:24px;position:absolute;top:calc(50% - 12px);left:15px;margin:0px;pointer-events:none;user-select:none;transition:font-size 0.2s ease 0s, top 0.2s ease 0s, color 0.2s ease 0s;width:calc(100% - 32px);text-align:left;}
        .FhzTQ{font-family:"Open Sans", "Open Sans-fallback", Arial, sans-serif;font-weight:400;font-style:normal;font-size:1rem;line-height:1.5;letter-spacing:0em;-webkit-font-smoothing:antialiased;border:1px solid rgb(153, 153, 153);border-radius:4px;box-sizing:border-box;color:rgb(51, 51, 51);outline:none;padding:30px 16px 16px;height:50px;width:100%;transition:border-color 0.2s ease 0s;}
        .FhzTQ:focus{border-color:rgb(0, 88, 162);border-left-width:4px;padding-left:13px;}
        .FhzTQ:focus + .sc-35359047-0{font-family:"Open Sans", "Open Sans-fallback", Arial, sans-serif;font-weight:400;font-style:normal;font-size:0.75rem;letter-spacing:0em;-webkit-font-smoothing:antialiased;line-height:15px;top:6px;}
        .deTTKO{position:relative;display:inline-block;width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
        .etHtyY{position:relative;width:100%;}
        @media (min-width: 600px){
            .etHtyY{width:435px;}
        }
        .etHtyY > div{display:block;}
        .etHtyY input{cursor:pointer;}
        .etHtyY .sc-6bac5830-1{position:absolute;right:5px;top:4px;min-height:42px;width:32%;max-width:166px;}

    </style>

    <style>
        /*! CSS Used from: Embedded */
        .exzNCu{font-family:"Open Sans", "Open Sans-fallback", Arial, sans-serif;font-weight:400;font-style:normal;font-size:1rem;line-height:1.5;letter-spacing:0em;-webkit-font-smoothing:antialiased;border:1px solid rgb(153, 153, 153);border-radius:4px;box-sizing:border-box;color:rgb(51, 51, 51);outline:none;padding:30px 16px 16px;height:50px;width:100%;transition:border-color 0.2s ease 0s;}

    </style>

    <style>
        @media(max-width:34em){
            .main{
                min-width:150px;
                width:auto;
            }
        }
        select {
            display: none !important;
        }

        .dropdown-select {
            background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0) 100%);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#40FFFFFF', endColorstr='#00FFFFFF', GradientType=0);
            background-color: #fff;
            border-radius: 6px;
            border: solid 1px #eee;
            box-shadow: 0px 2px 5px 0px rgba(155, 155, 155, 0.5);
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            float: left;
            font-size: 14px;
            font-weight: normal;
            height: 42px;
            line-height: 40px;
            outline: none;
            padding-left: 18px;
            padding-right: 30px;
            position: relative;
            text-align: left !important;
            transition: all 0.2s ease-in-out;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            white-space: nowrap;
            width: auto;

        }

        .dropdown-select:focus {
            background-color: #fff;
        }

        .dropdown-select:hover {
            background-color: #fff;
        }

        .dropdown-select:active,
        .dropdown-select.open {
            background-color: #fff !important;
            border-color: #bbb;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05) inset;
        }

        .dropdown-select:after {
            height: 0;
            width: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid #777;
            -webkit-transform: origin(50% 20%);
            transform: origin(50% 20%);
            transition: all 0.125s ease-in-out;
            content: '';
            display: block;
            margin-top: -2px;
            pointer-events: none;
            position: absolute;
            right: 10px;
            top: 50%;
        }

        .dropdown-select.open:after {
            -webkit-transform: rotate(-180deg);
            transform: rotate(-180deg);
        }

        .dropdown-select.open .list {
            -webkit-transform: scale(1);
            transform: scale(1);
            opacity: 1;
            pointer-events: auto;
        }

        .dropdown-select.open .option {
            cursor: pointer;
        }

        .dropdown-select.wide {
            width: 100%;
        }

        .dropdown-select.wide .list {
            left: 0 !important;
            right: 0 !important;
        }

        .dropdown-select .list {
            box-sizing: border-box;
            transition: all 0.15s cubic-bezier(0.25, 0, 0.25, 1.75), opacity 0.1s linear;
            -webkit-transform: scale(0.75);
            transform: scale(0.75);
            -webkit-transform-origin: 50% 0;
            transform-origin: 50% 0;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.09);
            background-color: #fff;
            border-radius: 6px;
            margin-top: 4px;
            padding: 3px 0;
            opacity: 0;
            overflow: hidden;
            pointer-events: none;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 999;
            max-height: 250px;
            overflow: auto;
            border: 1px solid #ddd;
        }

        .dropdown-select .list:hover .option:not(:hover) {
            background-color: transparent !important;
        }
        .dropdown-select .dd-search{
            overflow:hidden;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:0.5rem;
        }

        .dropdown-select .dd-searchbox{
            /*width:99%;*/
            /*padding:0.5rem;*/
            border:1px solid #999;
            border-color:#999;
            border-radius:4px;
            outline:none;
        }
        .dropdown-select .dd-searchbox:focus{
            border-color:#12CBC4;
        }

        .dropdown-select .list ul {
            padding: 0;
        }

        .dropdown-select .option {
            cursor: default;
            font-weight: 400;
            line-height: 40px;
            outline: none;
            padding-left: 18px;
            padding-right: 29px;
            text-align: left;
            transition: all 0.2s;
            list-style: none;
        }

        .dropdown-select .option:hover,
        .dropdown-select .option:focus {
            background-color: #f6f6f6 !important;
        }

        .dropdown-select .option.selected {
            font-weight: 600;
            color: #12cbc4;
        }

        .dropdown-select .option.selected:focus {
            background: #f6f6f6;
        }

        .dropdown-select a {
            color: #aaa;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }

        .dropdown-select a:hover {
            color: #666;
        }
        input[type='text'], input[type="email"]{
            padding: unset !important;
        }
    </style>


    <style>
        .dropdown-select{
            height: 0px !important;
            border: unset !important;
        }
        .dropdown-select.wide .list{
            margin-top: 0px !important;
        }
    </style>


    <style>
        .overlay{
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 999;
            background: rgba(255,255,255,0.8) url("{{ asset('loader.gif') }}") center no-repeat;
        }
        /* Turn off scrollbar when body element has the loading class */
        body.loading{
            overflow: hidden;
        }
        /* Make spinner image visible when body element has the loading class */
        body.loading .overlay{
            display: block;
        }
    </style>

    {{--<section id="about" class="mt-3 pt-8 pt-md-11 bg-hn1">--}}
        {{--<div class="container">--}}
            {{--<div class="col-6">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="" class="mb-2">Type Area</label>--}}
                    {{--<select class="select2 form-control" id="service_area" name="short_service_area[]">--}}
                        {{--<option value="">--Select--</option>--}}
                        {{--@foreach(\App\County::all() as $data)--}}
                            {{--<option value="{{ $data->name }}">{{ $data->name }}</option>--}}
                        {{--@endforeach--}}
                        {{--@foreach(\App\State::all() as $data)--}}
                            {{--<option value="{{ $data->name }}">{{ $data->name }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}

    <section id="about" class="mt-3 pt-8 pt-md-11 bg-hn1">
        <div class="container">
            <div class="row align-items-center justify-content-between" style="padding: 30px 0px 30px 0px;">

                <div class="col-12 col-md-6 offset-md-3">


                    <div role="button" aria-label="Press to Search Trade" tabindex="0" class="sc-7b03cae1-0 etHtyY"><div class="sc-35359047-2 deTTKO"><input aria-label="Trade (e.g. Electrician)" readonly="" tabindex="-1" aria-hidden="true" type="text" class="sc-35359047-1 FhzTQ" value="" data-gaconnector-tracked="true" onclick="searchFunc()"><label class="sc-35359047-0 iuwDVC

  ">Trade (e.g. Electrician)</label></div><button class="sc-6bac5830-0 crZSbT sc-6bac5830-1 fxqnjv" tabindex="-1" aria-hidden="true">Search</button></div>


                </div>
            </div>
        </div>
    </section>

    <br>
    <section id="about" class="pt-8 pt-md-11 bg-hn1">
        <div class="container">
            <div class="row align-items-center justify-content-between" style="padding: 30px 0px 30px 0px;">
                <div class="col-12 col-md-12">
                    <h1>
                        {{ $about_us->title }} <br>
                    </h1>
                    <p class="">
                      {!! $about_us->description !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-8 pt-md-11 bg-hn1" style="background: white;">
        <div class="container">
            <div class="row align-items-center" style="padding: 0px 0px 80px 0px;">
                <div class="col-12 col-md-12">
                    <h1>
                        Business Categories Sitemap
                        <br>
                        <br>
                    </h1>
                </div>
                <div class="col-12 col-md-12">
                    <h3>
                        Countries
                        <br>
                    </h3>
                </div>
                @foreach($countries as $country)
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <h5>
                        <a href="{{ url('a', $country->name) }}">{{ $country->name }}</a>
                    </h5>
                </div>
                    @endforeach
            </div>
        </div>
    </section>

    <section class="" style="background: white;">
        <div class="container">
            <div class="row align-items-center">


                @if(isset($trader))
                    <?php
                    $reviews = \App\Review::where('company_name', $trader->id)->get();
                    $sum = \App\Review::where('company_name', $trader->id)->sum('value');
                    if (count($reviews) > 0) {
                        $count = count($reviews) * 10;
                        $count1 = $sum / $count;
                        $count2 = $count1 * 10;
                        $avg = number_format($count2, 0);
                    }

                    ?>
                    <div class="col-md-12">
                        <div class="card border-0 mb-4 shadow-lg ">
                            <div class="card-body p-4 openPostions">
                                <h2>
                                    <a href="{{ route('trader.details',$trader->name) }}">{{ $trader->name }}</a>
                                </h2>
                                <ul class="job-info">

                                    <li>
                                        <svg class="mb-1" xmlns="http://www.w3.org/2000/svg"
                                             width="16"
                                             height="16" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <circle cx="12" cy="10" r="3"/>
                                            <path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z"/>
                                        </svg> {{ $trader->service_area_values }}</li>


                                    <li>
                                        <svg style="height: 20px;margin-top: -5px;" fill="#000000"
                                             viewBox="-1 0 19 19" xmlns="http://www.w3.org/2000/svg"
                                             class="cf-icon-svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M16.417 9.583A7.917 7.917 0 1 1 8.5 1.666a7.917 7.917 0 0 1 7.917 7.917zm-2.693-.801c.603-.559.43-1.095-.387-1.192l-1.472-.174-1.485-.176-1.247-2.704c-.172-.373-.4-.56-.626-.56-.228 0-.455.187-.627.56L6.633 7.24l-1.485.176-1.471.174c-.817.097-.991.633-.387 1.192l1.088 1.006 1.098 1.015-.292 1.467-.289 1.453c-.114.574.084.908.466.908a1.159 1.159 0 0 0 .548-.171l2.598-1.455 2.598 1.455a1.157 1.157 0 0 0 .547.17c.382 0 .58-.333.466-.907l-.58-2.92 1.098-1.015 1.088-1.006zm-.7-.431-.925.855-.003.002L11 10.222a.793.793 0 0 0-.239.735l.538 2.704-2.406-1.346a.792.792 0 0 0-.773 0L5.715 13.66l.245-1.236v-.002l.292-1.466a.792.792 0 0 0-.239-.735L3.989 8.35l2.737-.325a.79.79 0 0 0 .626-.455l1.155-2.503L9.66 7.571a.79.79 0 0 0 .626.455z"></path>
                                            </g>
                                        </svg>
                                        @if (count($reviews)>0) {{ $avg }}({{ count($reviews) }}
                                        reviews) @else 0 reviews @endif
                                    </li>


                                </ul>
                                <p> {!! $trader->business_description !!}</p>
                                <ul class="job-info mt-4">
                                    <li>
                                        <a class="btn btn-info" href="tel:{{ $trader->phone }}"
                                           aria-label="Click to call .'{{ $trader->name }}'. on .'{{ $trader->phone }}'."
                                           style="border-radius: 18px;">{{ $trader->phone }}</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="btn btn-success" style="border-radius: 18px;" onclick="quoteFun({{ $trader->id }})">Request
                                            a Quote</a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </section>


    @if(count($area_url) > 0)
    <section class="" style="background: white;">
        <div class="container">
            <div class="row align-items-center">


                    @foreach ($area_url as $area)
                    <div class="col-md-12">
                        <div class="card border-0 mb-4 shadow-lg ">
                            <div class="card-body p-4 openPostions">
                                <h2>
                                    <a href="{{ preg_replace('/([^:])(\/{2,})/', '$1/', $area->slug) }}">{{ $area->name }}</a>
                                </h2>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    @endif




    <!-- Product Card -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="product_card">
                    <div class="card">
                        <div class="card-header bg-transparent border-0 p-0">
                            {{--<img class="card-img-top" src="{{ my_asset('front/images/photo-13.jpg') }}" alt="">--}}
                        </div>
                        <div class="card-body">
                            <strong>
                                <a href="#" class="text-body"><h2>{{ $setting->home_h1 }}</h2></a>
                            </strong>
                            <div class="mt-2">

                                <a href="{{ route('review') }}" class="btn btn-primary">Leave a Review <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="product_card">
                    <div class="card">
                        <div class="card-header bg-transparent border-0 p-0">
                            {{--<img class="card-img-top" src="{{ my_asset('front/images/photo-14.jpg') }}" alt="">--}}
                        </div>
                        <div class="card-body">
                            <strong>
                                <a href="#" class="text-body"><h2>{{ $setting->home_h2 }}</h2></a>
                            </strong>
                            <div class="mt-2">

                               @if(Auth::user())

                                    <a href="javascript:void(0)" class="btn btn-dark" disabled>Join Today <i class="fas fa-long-arrow-alt-right"></i></a>
                                @else
                                    <a href="{{ route('user.create.account') }}" class="btn btn-dark">Join Today <i class="fas fa-long-arrow-alt-right"></i></a>

                                   @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="col-lg-4 col-md-4 col-sm-12">--}}
                {{--<div class="product_card">--}}
                    {{--<div class="card">--}}
                        {{--<div class="card-header bg-transparent border-0 p-0">--}}
                            {{--<img class="card-img-top" src="{{ my_asset('front/images/photo-15.jpg') }}" alt="">--}}
                        {{--</div>--}}
                        {{--<div class="card-body">--}}
                            {{--<strong>--}}
                                {{--<a href="#" class="text-body"><h2>{{ $setting->home_h3 }}</h2></a>--}}
                            {{--</strong>--}}
                            {{--<div class="mt-2">--}}

                                {{--<a href="{{ route('send.quote') }}" class="btn btn-success">Request a Quote <i class="fas fa-long-arrow-alt-right"></i></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
    <!-- /Product Card -->

    @include('front.includes.quote_modal')



    {{--<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">--}}
        {{--<div class="modal-dialog modal-lg">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<h2 class="modal-title" id="myModalLabel">Search Trades</h2>--}}
                    {{--<a type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 24px">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}

                    {{--<div class="overlay"></div>--}}
                    {{--<div class="form-container cf-form">--}}
                        {{--<form id="questionnaire-form" action="{{ route('search') }}" method="GET">--}}
                            {{--@csrf--}}
                            {{--<input type="hidden" name="search_category_id" id="search_category_id">--}}
                            {{--<input type="hidden" name="search_subcategory_id" id="search_subcategory_id">--}}
                            {{--<div class="slide-container">--}}
                                {{--<div class="slide0">--}}
                                        {{--<div class="main">--}}
                                            {{--<h2>Search Trades</h2>--}}
                                                    {{--<select name="category_id" id="category_id" onchange="getSubCatFunc()">--}}
                                                        {{--@foreach($categories as $category)--}}
                                                        {{--<option value="{{ $category->id }}">{{ $category->name }}</option>--}}
                                                        {{--@endforeach--}}
                                                    {{--</select>--}}
                                        {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                        {{--<div class="buttons-container">--}}
                            {{--<button class="btn_search float-right btn-btn-primary" style="display: none;">Continue</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

<?php
$career_cities = \App\City::all();
$career_towns = \App\Town::all();
//array_unique($career_cities);
?>

    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="myModalLabel">Search Trades</h2>
                    <a type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 24px">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">

                    <div class="overlay"></div>
                    <div class="form-container cf-form">
                        <div class="slide-container">
                            <div class="slide0">
                                <div class="main">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="" class="mb-2">Type Area</label>
                                                <select class="select2 form-control" id="area_slug" name="area_slug" onchange="findArea()">
                                                    <option value="">--Select--</option>
                                                    @foreach(\App\Country::all() as $data)
                                                        <option value="{{ $data->slug }}">{{ $data->name }}</option>
                                                    @endforeach
                                                    @foreach(\App\State::all() as $data)
                                                        <option value="{{ preg_replace('/([^:])(\/{2,})/', '$1/', $data->slug) }}">{{ $data->name }}</option>
                                                    @endforeach
                                                    @foreach(\App\County::all() as $data)
                                                        <option value="{{ preg_replace('/([^:])(\/{2,})/', '$1/', $data->slug) }}">{{ $data->name }}</option>
                                                    @endforeach
                                                    @foreach($career_cities->unique('name') as $data)
                                                        <?php
                                                        $city_arr[] = $data->name;
                                                        ?>
                                                        <option value="{{ preg_replace('/([^:])(\/{2,})/', '$1/', $data->slug) }}">{{ $data->name }}</option>
                                                    @endforeach
                                                    @foreach($career_towns->unique('name') as $data)
                                                        @if(!in_array($data->name, $city_arr))
                                                        <option value="{{ preg_replace('/([^:])(\/{2,})/', '$1/', $data->slug) }}">{{ $data->name }}</option>
                                                        @endif
                                                    @endforeach
                                                    @foreach($career_towns->unique('half_postcode') as $data)
                                                        <option value="{{ preg_replace('/([^:])(\/{2,})/', '$1/', $data->postcode_url) }}">{{ $data->half_postcode }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.min.js"></script>

    <script>
        // var select = $('select');
        var select = $('.select2');

        function formatSelection(state) {
            return state.text;
        }

        function formatResult(state) {
            console.log(state)
            if (!state.id) return state.text; // optgroup
            var id = 'state' + state.id.toLowerCase();
            var label = $('<label></label>', {for: id})
                .text(state.text);
            var checkbox = $('<input type="checkbox" style="display: none">', {id: id});

            return checkbox.add(label);
        }

        select.select2({
            closeOnSelect: false,
            formatResult: formatResult,
            formatSelection: formatSelection,
            minimumInputLength: 2,
            escapeMarkup: function (m) {
                return m;
            }
        }).on("change", function (e) {
            // alert($(this).val());
            if ($(this).val() == '') {
                $('.theme-btn').prop('disabled', true);
            }
            else {
                $('.theme-btn').prop('disabled', false);
            }
        });

        // select.select2({
        // }).on("change", function (e) {
        //     if($(this).val() == '') {
        //         $('.theme-btn').prop('disabled', true);
        //     }
        //     else {
        //         $('.theme-btn').prop('disabled', false);
        //     }
        // });
    </script>


    <script>

        function searchFunc(){
            $('#searchModal').modal('toggle');
            $('#searchModal').modal('show');
            $('#searchModal').modal('hide');
        }
        function create_custom_dropdowns() {
            $('#category_id').each(function (i, select) {
                if (!$(this).next().hasClass('dropdown-select')) {
                    $(this).after('<div class="dropdown-select wide' + ($(this).attr('class') || '') + '" tabindex="0"><div class="list"><ul></ul></div></div>');
                    var dropdown = $(this).next();
                    var options = $(select).find('option');
                    var selected = $(this).find('option:selected');
                    dropdown.find('.current').html(selected.data('display-text') || selected.text());
                    options.each(function (j, o) {
                        var display = $(o).data('display-text') || '';
                        dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
                    });
                }
            });
            $('#subcategory_id').each(function (i, select) {
                if (!$(this).next().hasClass('dropdown-select')) {
                    $(this).after('<div class="dropdown-select wide' + ($(this).attr('class') || '') + '" tabindex="0"><div class="list"><ul></ul></div></div>');
                    var dropdown = $(this).next();
                    var options = $(select).find('option');
                    var selected = $(this).find('option:selected');
                    dropdown.find('.current').html(selected.data('display-text') || selected.text());
                    options.each(function (j, o) {
                        var display = $(o).data('display-text') || '';
                        dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
                    });
                }
            });

            $('.dropdown-select ul').before('<div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>');
        }

        // Event listeners

        // Open/close
        $(document).on('click', '.dropdown-select', function (event) {
            if($(event.target).hasClass('dd-searchbox')){
                return;
            }
            // $('.dropdown-select').not($(this)).removeClass('open');
            // $(this).toggleClass('open');
            if ($(this).hasClass('open')) {
                $(this).find('.option').attr('tabindex', 0);
                $(this).find('.selected').focus();
            } else {
                $(this).find('.option').removeAttr('tabindex');
                $(this).focus();
            }
        });

        // Close when clicking outside
        $(document).on('click', function (event) {
            if ($(event.target).closest('.dropdown-select').length === 0) {
                // $('.dropdown-select').removeClass('open');
                $('.dropdown-select .option').removeAttr('tabindex');
            }
            event.stopPropagation();
        });

        function filter(){
            var valThis = $('#txtSearchValue').val();
            $('.dropdown-select ul > li').each(function(){
                var text = $(this).text();
                (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();
            });
        };
        // Search

        // Option click
        $(document).on('click', '.dropdown-select .option', function (event) {
            $(this).closest('.list').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            var text = $(this).data('display-text') || $(this).text();
            $(this).closest('.dropdown-select').find('.current').text(text);
            $(this).closest('.dropdown-select').prev('select').val($(this).data('value')).trigger('change');
        });

        // Keyboard events
        $(document).on('keydown', '.dropdown-select', function (event) {
            var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
            // Space or Enter
            //if (event.keyCode == 32 || event.keyCode == 13) {
            if (event.keyCode == 13) {
                if ($(this).hasClass('open')) {
                    focused_option.trigger('click');
                } else {
                    $(this).trigger('click');
                }
                return false;
                // Down
            } else if (event.keyCode == 40) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    focused_option.next().focus();
                }
                return false;
                // Up
            } else if (event.keyCode == 38) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
                    focused_option.prev().focus();
                }
                return false;
                // Esc
            } else if (event.keyCode == 27) {
                if ($(this).hasClass('open')) {
                    $(this).trigger('click');
                }
                return false;
            }
        });

        $(document).ready(function () {
            create_custom_dropdowns();
        });
    </script>

    <script>
        function getSubCatFunc(){
            var category_id = $('#category_id').val();
            $('#search_category_id').val(category_id);
            $.ajax({
                url : "{{ url('show-subcats') }}",
                type: 'get',
                data: {
                    category_id : category_id
                },
                success: function(res)
                {
                    $('.main').html(res);
                    create_custom_dropdowns();
                    $('.dropdown-select').addClass('open');
                },
                error: function()
                {
                }
            });
        }

        function PostecodeFunc(){

            var subcategory_id = $('#subcategory_id').val();
            $('#search_subcategory_id').val(subcategory_id);
            $.ajax({
                url : "{{ url('show-postcode-area-input') }}",
                type: 'get',
                success: function(res)
                {
                    $('.main').html(res);
                    create_custom_dropdowns();
                    $('.dropdown-select').addClass('open');
                    // $('.btn_search').css({ display: "" });
                },
                error: function()
                {
                }
            });
        }


    </script>


    <script>
        // Add remove loading class on body element based on Ajax request status
        $(document).on({
            ajaxStart: function(){
                $("body").addClass("loading");
            },
            ajaxStop: function(){
                $("body").removeClass("loading");
            }
        });
    </script>


    <script>

        function findArea(){
            var area_slug = $('#area_slug').val();
            window.location.href = area_slug;
        }

    </script>

@endsection
