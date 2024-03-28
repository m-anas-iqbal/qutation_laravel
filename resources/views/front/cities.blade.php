@extends('layouts.front')
@section('title', 'Health Network One')
@section('content')


    <section class="pt-8 pt-md-11 bg-hn1">
        <div class="container">
            {{--////--}}

            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" style="padding-top: 80px">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('a', $country) }}">{{ $country }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('a/'.$country.'/'.$state) }}">{{ $state }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            {{--////--}}
            {{--<div class="row align-items-center" style="padding: 0px 0px 80px 0px;">--}}
                {{--<div class="col-12 col-md-12">--}}
                    {{--<ul class="job-info  align-items-center justify-content-between"> <li>--}}
                            {{--<h3>--}}
                                {{--{{ $name }} Cities--}}
                            {{--</h3>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<h2><a href="{{ url('traders/'.$country.'/'.$state.'/'.$name) }}" style="float: right"> Show all Traders </a></h2>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                {{--@foreach($cities as $data)--}}
                    {{--<div class="col-sm-12 col-md-4 col-lg-4">--}}
                        {{--<h5>--}}
                            {{--<a href="{{ url('city-towns/'.$country.'/'.$state.'/'.$name.'/'.$data->name) }}">{{ $data->name }}</a>--}}
                        {{--</h5>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}


            <div class="row align-items-center" style="">
                <div class="col-12 col-md-12">
                    <ul class="job-info  align-items-center justify-content-between"> <li>
                            <h1>
                                <?php
                                $filter_data = str_replace('{area_name}', $name, setting()->h1_variable);
                                $filter_data = str_replace('{category}', '', $filter_data)
                                ?>
                                {!!  $filter_data !!}
                            </h1>
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>

        </div>
    </section>


    <section id="open" class=" pt-4 py-7 bg-hn1">
        <div class="container">
            <div class="row">


                <div class="col-md-2">
                    @include('front.includes.categories')
                </div>

                <div class="col-md-10">
                    <div class="row">

                    @if(count($users) > 0)
                    @foreach($users as $user)
                        @if(isset($user))
                            <?php
                            $reviews = \App\Review::where('company_name', $user->id)->get();
                            $sum = \App\Review::where('company_name', $user->id)->sum('value');

                            if (count($reviews)>0){
                                $count = count($reviews)*10;
                                $count1 = $sum / $count;
                                $count2 = $count1 * 10;
                                $avg = number_format($count2, 0);
//                            echo $count;
                            }

                            ?>

                            <div class="col-md-6">
                                {{--<h2 class="text-center mb-5"></h2>--}}
                                <div class="card border-0 mb-4 shadow-lg ">
                                    <div class="card-body p-4 openPostions">
                                        <h2><a href="{{ route('trader.details',$user->name) }}">{{ $user->name }}</a></h2>
                                        <ul class="job-info">

                                            <li><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16"
                                                     height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="10" r="3" />
                                                    <path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z" />
                                                </svg> {{ $name }}</li>



                                            <li><svg style="height: 20px;margin-top: -5px;" fill="#000000" viewBox="-1 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_iconCarrier"><path d="M16.417 9.583A7.917 7.917 0 1 1 8.5 1.666a7.917 7.917 0 0 1 7.917 7.917zm-2.693-.801c.603-.559.43-1.095-.387-1.192l-1.472-.174-1.485-.176-1.247-2.704c-.172-.373-.4-.56-.626-.56-.228 0-.455.187-.627.56L6.633 7.24l-1.485.176-1.471.174c-.817.097-.991.633-.387 1.192l1.088 1.006 1.098 1.015-.292 1.467-.289 1.453c-.114.574.084.908.466.908a1.159 1.159 0 0 0 .548-.171l2.598-1.455 2.598 1.455a1.157 1.157 0 0 0 .547.17c.382 0 .58-.333.466-.907l-.58-2.92 1.098-1.015 1.088-1.006zm-.7-.431-.925.855-.003.002L11 10.222a.793.793 0 0 0-.239.735l.538 2.704-2.406-1.346a.792.792 0 0 0-.773 0L5.715 13.66l.245-1.236v-.002l.292-1.466a.792.792 0 0 0-.239-.735L3.989 8.35l2.737-.325a.79.79 0 0 0 .626-.455l1.155-2.503L9.66 7.571a.79.79 0 0 0 .626.455z"></path></g></svg>
                                                @if (count($reviews)>0) {{ $avg }}({{ count($reviews) }} reviews) @else 0 reviews @endif
                                            </li>




                                        </ul>
                                       <p> {!! $user->business_description !!}</p>


                                        <ul class="job-info mt-4">
                                            <li>
                                                <a class="btn btn-info" href="tel:{{ $user->phone }}" aria-label="Click to call .'{{ $user->name }}'. on .'{{ $user->phone }}'." style="border-radius: 18px;">{{ $user->phone }}</a>
                                            </li>

                                            {{--                                    @if(Auth::user())--}}
                                            <li>
                                                <a href="#"
                                                   class="btn btn-success" style="border-radius: 18px;" onclick="quoteFun({{ $user->id }})">Request
                                                    a Quote</a>
                                            </li>
                                            {{--@else--}}

                                            {{--<li class="box">--}}
                                            {{--<a class="btn btn-danger" href="#quote_popup" style="border-radius: 18px;">Request a Quote</a>--}}
                                            {{--</li>--}}

                                            {{--@endif--}}
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                @else

                    <!-- <p>Trades not found!</p> -->
                    <script>
                var seg=[];
                var url =   '{{ URL::to("/"); }}';
 <?php    $current_uri = request()->segments();
 foreach ($current_uri as $data) { ?>
seg.push("{{ $data }}")
 <?php } ?>

                        seg.forEach(function(currentValue, index, arr){
                            if (index !=0) {
                                url +="/"+currentValue;
                            }
                        });
                        console.log(url);
                        // console.log(seg);
                        window.location.href = url;
                    </script>
                @endif

                    </div>
                </div>

            </div>
        </div>
    </section>

    @if(isset($group) && isset($service_area_description) && !empty($service_area_description))
        <section id="open" class=" pt-4 py-7 bg-hn1">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="card border-0 mb-4 shadow-lg ">
                            <div class="card-body p-4 openPostions">
                                {{--                                <h2>Group: {{ $group->name }}</h2>--}}
                                <h2>{{ $name }}</h2>
                                <p>{{ $service_area_description->description }}</p>


                                {{--///--}}
                                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

                                <style>

                                    .faq-container{
                                        /*max-width: 600px;*/
                                        margin: 0 auto;
                                    }

                                    .faq{
                                        background-color: transparent;
                                        border: 1px solid #9fa4a8;
                                        border-radius: 10px;
                                        margin: 20px 0;
                                        padding: 30px;
                                        position: relative;
                                        overflow: hidden;
                                        transition: 0.3s ease;
                                    }

                                    .faq.active {
                                        background-color: #fff;
                                        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1), 0 3px
                                        6px rgba(0, 0, 0, 0.1);
                                    }

                                    .faq.active::before,
                                    .faq.active::after {
                                        font-family: 'Font awesome 5 free';
                                        color: #2ecc71;
                                        font-size: 7rem;
                                        position: absolute;
                                        opacity: 0.2;
                                        top: 20px;
                                        left: 20px;
                                        z-index: 0;
                                    }

                                    .faq.active::before{
                                        color: #3498db;
                                        top: -10px;
                                        left: -30px;
                                        transform: rotateY(180deg);
                                    }

                                    .faq-title{
                                        margin: 0 35px 0 0;
                                    }

                                    .faq-text{
                                        display: none;
                                        margin: 30px 0 0;
                                    }

                                    .faq.active .faq-text{
                                        display: block;
                                    }

                                    .faq-toggle{
                                        background-color: transparent;
                                        border-radius: 50%;
                                        border: 0;
                                        cursor: pointer;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        font-size: 16px;
                                        padding: 0;
                                        position: absolute;
                                        top: 30px;
                                        right: 30px;
                                        width: 30px;
                                        height: 30px;
                                    }

                                    .faq-toggle:focus{
                                        outline: none;
                                    }

                                    .faq-toggle .fa-times {
                                        display: none;
                                    }

                                    .faq.active .faq-toggle .fa-times {
                                        display: block;
                                        color: white;
                                    }

                                    .faq.active .faq-toggle .fa-chevron-down{
                                        display: none;
                                    }

                                    .faq.active .faq-toggle {
                                        background-color: #9fa4a8;
                                    }
                                </style>
                                <div class="faq-container">
                                    @if(count($faqs) > 0)
                                        @foreach($faqs as $faq)
                                            <div class="faq">
                                                <h3 class="faq-title">
                                                    {{ $faq->question }}
                                                </h3>
                                                <p class="faq-text">
                                                    {{ strip_tags($faq->answer) }}
                                                </p>
                                                <button class="faq-toggle">
                                                    <i class="fas fa-chevron-down"></i>
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                        @endforeach
                                    @endif
                                    <div>

                                        @if(count($group_tags) > 0)
                                            @foreach($group_tags as $tag)
                                                <div>
                                                    {!! $tag->description !!}
                                                </div>

                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                {{--///--}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @include('front.includes.quote_modal')
@endsection


@section('script')

    <script>
        const buttons = document.querySelectorAll('.faq-toggle');

        buttons.forEach((button) =>{
            button.addEventListener('click', () =>{
            button.parentNode.classList.toggle('active')
        })
        })
    </script>

@endsection
