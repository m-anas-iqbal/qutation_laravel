@extends('layouts.front')
@section('title', 'Health Network One')
@section('content')


    <style>
        .button:hover {
            background: #06D85F;
        }

        .overlay {
            position: fixed;
            margin-top: 50px;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
        }
        .overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 30%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
            font-family: Tahoma, Arial, sans-serif;
        }
        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }
        .popup .close:hover {
            color: #06D85F;
        }
        .popup .content {
            max-height: 30%;
            overflow: auto;
        }

        @media screen and (max-width: 700px){
            .box{
                width: 70%;
            }
            .popup{
                width: 70%;
            }
        }
        .number{
            position: absolute;
            top: 44%;
            left: 91%;
            transform: translate(-50%, -50%);
        }
    </style>


    <section class="pt-8 pt-md-11 bg-hn1">
        <div class="container">
            <div class="row align-items-center" style="padding: 80px 0px 0px 0px;">
                <div class="col-12 col-md-12">
                    <h1>
                         Trader Details
                        <hr>
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section id="open" class=" pt-4 py-7 bg-hn1">
        <div class="container">
            <div class="row">
                        <?php
                        $reviews = \App\Review::where('company_name', $trader->id)->get();
                        $sum = \App\Review::where('company_name', $trader->id)->sum('value');
                        if (count($reviews)>0){
                            $count = count($reviews)*10;
                            $count1 = $sum / $count;
                            $count2 = $count1 * 10;
                            $avg = number_format($count2, 0);
//                            echo $count;
                        }

                        ?>


@if(count($images)>0)
                            <div class="col-md-6 col-sm-12">
                                {{--<h2 class="text-center mb-5"></h2>--}}
                                <div class="card border-0 mb-4 shadow-lg ">
                                    <div class="card-body p-4 openPostions">

                                        {{--//--}}
                                        <style>
                                            .img-display{
                                                overflow: hidden;
                                            }
                                            .img-showcase{
                                                display: flex;
                                                width: 100%;
                                                transition: all 0.5s ease;
                                            }
                                            .img-showcase img{
                                                min-width: 100%;
                                            }
                                            .img-select{
                                                display: flex;
                                            }
                                            .img-item{
                                                margin: 0.3rem;
                                            }
                                            .img-item:nth-child(1),
                                            .img-item:nth-child(2),
                                            .img-item:nth-child(3){
                                                margin-right: 0;
                                            }
                                            .img-item:hover{
                                                opacity: 0.8;
                                            }

                                            @media screen and (min-width: 992px) {

                                                .product-imgs {
                                                    display: flex;
                                                    flex-direction: column;
                                                    justify-content: center;
                                                }
                                                .card{
                                                    /*display: grid;*/
                                                    /*grid-template-columns: repeat(2, 1fr);*/
                                                    /*grid-gap: unset;*/
                                                }
                                            }

                                            .product-imgs{
                                                height: 600px;
                                            }
                                        </style>

<style>
    .img-select{
        width: 100%;
    display: flex;
    overflow-x: scroll;
    overflow-y:hidden ;
    }
    img{
        max-width:unset;
    }
</style>
                                        <!-- card left -->
                                        {{--<div class = "product-imgs">--}}
                                            {{--<div class = "img-display">--}}
                                                {{--<div class = "img-showcase">--}}
                                                    {{--<img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg" alt = "shoe image">--}}
                                                    {{--<img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg" alt = "shoe image">--}}
                                                    {{--<img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg" alt = "shoe image">--}}
                                                    {{--<img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg" alt = "shoe image">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class = "img-select">--}}
                                                {{--<div class = "img-item">--}}
                                                    {{--<a href = "#" data-id = "1">--}}
                                                        {{--<img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg" alt = "shoe image">--}}
                                                    {{--</a>--}}
                                                {{--</div>--}}
                                                {{--<div class = "img-item">--}}
                                                    {{--<a href = "#" data-id = "2">--}}
                                                        {{--<img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg" alt = "shoe image">--}}
                                                    {{--</a>--}}
                                                {{--</div>--}}
                                                {{--<div class = "img-item">--}}
                                                    {{--<a href = "#" data-id = "3">--}}
                                                        {{--<img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg" alt = "shoe image">--}}
                                                    {{--</a>--}}
                                                {{--</div>--}}
                                                {{--<div class = "img-item">--}}
                                                    {{--<a href = "#" data-id = "4">--}}
                                                        {{--<img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg" alt = "shoe image">--}}
                                                    {{--</a>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <!-- card left -->
                                        <div class = "product-imgs">
                                            <div class = "img-display">
                                                <div class = "img-showcase">
                                                    @foreach($images as $image)
                                                    <img src = "{{ asset('upload/user/images/'. $image->name) }}" alt = "{{ $image->name }}">
                                                        @endforeach
                                                </div>
                                            </div>
                                            <div class = "img-select">

                                                @foreach($images as $key=>$image)
                                                <div class = "img-item">
                                                    <a href = "#" data-id = "{{ $key+1 }}">
                                                        <img src = "{{ asset('upload/user/images/'. $image->name) }}" alt = "{{ $image->name }}" style="height: 150px; width: 200px">
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        {{----}}

                                    </div>
                                </div>
                            </div>
@endif
                        <div class="col-md-6 col-sm-12">
                            {{--<h2 class="text-center mb-5"></h2>--}}
                            <div class="card border-0 mb-4 shadow-lg">
                                <div class="card-body p-4 openPostions">

                                    @if($trader->photo)
                                        <img src="{{ asset('upload/user/'. $trader->photo) }}" alt="{{ $trader->photo }}" style="border-radius: 5%;height: 400px;width: 400px"/>
                                    @else
                                        <img src="{{ asset('images/nophoto.jpg') }}" alt="no-photo" style="border-radius: 5%;height: 400px;width: 400px"/>
                                    @endif

                                    <h2 class="mt-3"><a href="javascript:void(0)">{{ $trader->name }}</a></h2>
                                    <ul class="job-info">

                                        <li><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16"
                                                 height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="10" r="3" />
                                                <path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z" />
                                            </svg> {{ $trader->service_area_values }}</li>

                                    </ul>
<ul>
                                        <li><svg style="height: 20px;margin-top: -5px;" fill="#000000" viewBox="-1 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_iconCarrier"><path d="M16.417 9.583A7.917 7.917 0 1 1 8.5 1.666a7.917 7.917 0 0 1 7.917 7.917zm-2.693-.801c.603-.559.43-1.095-.387-1.192l-1.472-.174-1.485-.176-1.247-2.704c-.172-.373-.4-.56-.626-.56-.228 0-.455.187-.627.56L6.633 7.24l-1.485.176-1.471.174c-.817.097-.991.633-.387 1.192l1.088 1.006 1.098 1.015-.292 1.467-.289 1.453c-.114.574.084.908.466.908a1.159 1.159 0 0 0 .548-.171l2.598-1.455 2.598 1.455a1.157 1.157 0 0 0 .547.17c.382 0 .58-.333.466-.907l-.58-2.92 1.098-1.015 1.088-1.006zm-.7-.431-.925.855-.003.002L11 10.222a.793.793 0 0 0-.239.735l.538 2.704-2.406-1.346a.792.792 0 0 0-.773 0L5.715 13.66l.245-1.236v-.002l.292-1.466a.792.792 0 0 0-.239-.735L3.989 8.35l2.737-.325a.79.79 0 0 0 .626-.455l1.155-2.503L9.66 7.571a.79.79 0 0 0 .626.455z"></path></g></svg>
                                            @if (count($reviews)>0) {{ $avg }}({{ count($reviews) }} reviews) @else 0 reviews @endif
                                        </li>
</ul>

                                        @if($trader->website_url)
                                            <p class="mt-2">Website Url: <a href="{{ $trader->website_url }}">{{ $trader->website_url }}</a></p>
                                        @endif
                                    <ul class="job-info mt-4">
                                        <li>
                                            {{--<button class="btn btn-info" style="border-radius: 18px;">{{ $trader->phone }}</button>--}}
                                            <a class="btn btn-info" href="tel:{{ $trader->phone }}" aria-label="Click to call .'{{ $trader->name }}'. on .'{{ $trader->phone }}'." style="border-radius: 18px;">{{ $trader->phone }}</a>
                                        </li>

{{--                                        @if(Auth::user())--}}
                                        <li>
                                            <a href="#"
                                               class="btn btn-success" style="border-radius: 18px;" onclick="quoteFun({{ $trader->id }})">Request
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





                            <div class="col-md-12">
                                <h1 class="">Company Info</h1>
                                <div class="card border-0 mb-4 shadow-lg ">
                                    <div class="card-body p-4 openPostions">

                                       <p> {!! $trader->business_description !!}</p>

                                    </div>
                                </div>
                            </div>



                        @if(count($reviews) > 0)
                            <div class="col-md-12">
                                <h1 class="">Feedbacks</h1>
                                <div class="card border-0 mb-4 shadow-lg ">
                                    <div class="card-body p-4">
@foreach($reviews as $key=>$review)
    <?php
                                            $user = \App\User::where('id', $review->user_id)->first();
                                            ?>

                                            <style>
                                                ::root {
                                                    --val: 0;
                                                }

                                                svg {
                                                    transform: rotate(-90deg);
                                                }

                                                .percent {
                                                    stroke-dasharray: 100;
                                                    stroke-dashoffset: calc(100 - var(--val));
                                                }

                                                .percent_value{{$key}} {
                                                    --val: {{-- $review->value*10 --}};
                                                }
                                            </style>



    <div class="row">
        <div class="col-md-3 col-sm-12">
            @if(isset($user->photo))
                <img src="{{ asset('upload/user/'. $user->photo) }}" style="border-radius: 50%; height: 60px; width: 60px;" alt="{{ $user->photo }}"/>
            @else
                <img src="{{ asset('images/nophoto.jpg') }}" alt="no-photo" style="border-radius: 50%;height: 60px; width: 60px;"/>
            @endif
            <p style="margin-top: 2px;margin-left: 12px;">  @if(isset($user->name))
{{ $user->name }}
            @endif </p>
                <p>{{ $review->created_at->format('d/m/Y') }}</p>

        </div>
        <div class="col-md-7 col-sm-12">

            <p>{{ $review->title }}</p>
            <p> {!! $review->description !!}</p>
        </div>
        <div class="col-md-2 col-sm-12">


            <div>
                <center>
                    {{--               <p style="padding: 0px 35px;"> {!! $review->title !!}</p>--}}
                    <svg width="120" height="120" viewBox="0 0 120 120">
                        <circle cx="60" cy="60" r="54" fill="none" stroke="#e6e6e6" stroke-width="12" />
                        <circle class="percent percent_value{{$key}}" cx="60" cy="60" r="54" fill="none" stroke="#f77a52" stroke-width="12" pathLength="100" />
                        <div class="number">
                            <h3>{{ $review->value }}</h3>
                        </div>
                    </svg>
                </center>
            </div>
        </div>
    </div>




@endforeach





                                    </div>
                                </div>
                            </div>
    @endif


                                    </div>
        </div>
    </section>

    @include('front.includes.quote_modal')




@endsection

@section('script')

    <script>
        $(function(){
            if(navigator.userAgent.match(/(iPhone|Android.*Mobile)/i))
            {
                $('a[data-tel]').each(function(){
                    $(this).prop('href', 'tel:' + $(this).data('tel'));
                });
            }
        })
    </script>

    <script>
        const imgs = document.querySelectorAll('.img-select a');
        const imgBtns = [...imgs];
        let imgId = 1;

        imgBtns.forEach((imgItem) => {
            imgItem.addEventListener('click', (event) => {
            event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
        });
        });

        function slideImage(){
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

            document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', slideImage);
    </script>

@endsection
