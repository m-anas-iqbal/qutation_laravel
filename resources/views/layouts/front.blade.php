<!doctype html>
<html lang="en">
<?php
$setting = App\Setting::first();
$cat = App\BusinessCategory::first();

if (isset($name)){
$service_area_meta_description = App\CategoryDescription::whereRaw('Find_IN_SET(?, service_area)', [$name])->orderBy('id', 'asc')->first();
}


$currentURL = url()->current();

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    {{--<meta name="description" content="@if(isset($name)){{ str_replace('{area_name}', $name, $setting->site_meta_description) }}@else{{ $setting->site_meta_description }}@endif">--}}
    <meta name="keywords" content="@if(isset($name)){{ str_replace('{area_name}', $name, $setting->site_meta_tags) }}@else{{ str_replace('{area_name}', '', $setting->site_meta_tags) }}@endif">


    @if(isset($country) && isset($state) && isset($county) && isset($city) && isset($name))
        <?php


        $title_data = str_replace('{country_name}', $country, $setting->town_meta_title);
        $title_data = str_replace('{state_name}', $state, $title_data);
        $title_data = str_replace('{county_name}', $county, $title_data);
        $title_data = str_replace('{city_name}', $city, $title_data);
        $title_data = str_replace('{town_name}', $name, $title_data);

        $spaceString = str_replace('nbsp;', ' ', $setting->town_meta);
        $spaceString = str_replace('{country_name}', $country, $spaceString);
        $spaceString = str_replace('{state_name}', $state, $spaceString);
        $spaceString = str_replace('{county_name}', $county, $spaceString);
        $spaceString = str_replace('{city_name}', $city, $spaceString);
        $spaceString = str_replace('{town_name}', $name, $spaceString);

        if(isset($bname)){
            $title_data = str_replace('{category}', $bname, $title_data);
        }
        else{
            $title_data = str_replace('{category}', $cat->name, $title_data);
        }

        if(isset($bname)){
            $spaceString = str_replace('{category}', $bname, $spaceString);
        }
        else{
            $spaceString = str_replace('{category}', $cat->name, $spaceString);
        }

        $data = strip_tags($spaceString);
        $data = preg_replace('/[^\p{L}\p{N}\s]/u', '', $data);
        ?>
            <meta name="description" content="{{ $data }}">
        <meta property="og:site_name" content="{{ $title_data }}"/>
        <meta property="og:title" content="{{ $title_data }}"/>
        <meta name="area_meta_description" content="{{ $data }}">



            <?php
            $country_bc = \App\Country::where('name', $country)->first();
            $state_bc = \App\State::where('name', $state)->first();

            $county_bc = \App\County::where('name', $county)->first();
            $city_bc = \App\City::where('name', $city)->first();
            $town_bc = \App\Town::where('name', $name)->first();
            ?>
            <script type="application/ld+json">
            {
             "@context": "https://schema.org",
             "@type": "BreadcrumbList",
             "itemListElement":
             [
              {
               "@type": "ListItem",
               "position": 1,
               "item":
               {
                "@id": "{{ $country_bc->slug }}",
                "name": "{{ $country_bc->name }}"
                }
              },
             {
               "@type": "ListItem",
              "position": 2,
              "item":
               {
                "@id": "{{ $state_bc->slug }}",
                "name": "{{ $state_bc->name }}"
               }
              },
              {
               "@type": "ListItem",
              "position": 3,
              "item":
               {
                "@id": "{{ $county_bc->slug }}",
                "name": "{{ $county_bc->name }}"
               }
              },
              {
               "@type": "ListItem",
              "position": 4,
              "item":
               {
                "@id": "{{ $city_bc->slug }}",
                "name": "{{ $city_bc->name }}"
               }
              }

              @if($town_bc)
              ,{
               "@type": "ListItem",
              "position": 5,
              "item":
               {
                "@id": "{{ $town_bc->slug }}",
                "name": "{{ $town_bc->name }}"
               }
              }
              @endif


             ]
            }
            </script>

            <title>{{ $title_data }}</title>


    @elseif(isset($country) && isset($state) && isset($county) && isset($name))
        <?php
        $spaceString = str_replace('nbsp;', ' ', $setting->city_meta);
        $spaceString = str_replace('{country_name}', $country, $spaceString);
        $spaceString = str_replace('{state_name}', $state, $spaceString);
        $spaceString = str_replace('{county_name}', $county, $spaceString);


        $title_data = str_replace('{country_name}', $country, $setting->city_meta_title);
        $title_data = str_replace('{state_name}', $state, $title_data);
        $title_data = str_replace('{county_name}', $county, $title_data);



        if(isset($postcode)){
            $title_data = str_replace('{postcode}', $name, $title_data);
            $spaceString = str_replace('{postcode}', $name, $spaceString);
            $spaceString = str_replace('{city_name}', '', $spaceString);
            $title_data = str_replace('{city_name}', '', $title_data);
        }
        else{
            $spaceString = str_replace('{city_name}', $name, $spaceString);
            $title_data = str_replace('{city_name}', $name, $title_data);
            $title_data = str_replace('{postcode}', '', $title_data);
            $spaceString = str_replace('{postcode}', '', $spaceString);
        }



        if(isset($bname)){
            $title_data = str_replace('{category}', $bname, $title_data);
        }
        else{
            $title_data = str_replace('{category}', $cat->name, $title_data);
        }

        if(isset($bname)){
            $spaceString = str_replace('{category}', $bname, $spaceString);
        }
        else{
            $spaceString = str_replace('{category}', $cat->name, $spaceString);
        }

        $data = strip_tags($spaceString);
        $data = preg_replace('/[^\p{L}\p{N}\s]/u', '', $data);
        ?>

            <meta name="description" content="{{ $data }}">
            <meta property="og:site_name" content="{{ $title_data }}"/>
            <meta property="og:title" content="{{ $title_data }}"/>
        <meta name="area_meta_description" content="{{ $data }}">



            <?php
            $country_bc = \App\Country::where('name', $country)->first();
            $state_bc = \App\State::where('name', $state)->first();
            $county_bc = \App\County::where('name', $county)->first();
            $city_bc = \App\City::where('name', $name)->orWhere('half_postcode', $name)->first();
            ?>
            <script type="application/ld+json">
            {
             "@context": "https://schema.org",
             "@type": "BreadcrumbList",
             "itemListElement":
             [
              {
               "@type": "ListItem",
               "position": 1,
               "item":
               {
                "@id": "{{ $country_bc->slug }}",
                "name": "{{ $country_bc->name }}"
                }
              },
              {
               "@type": "ListItem",
              "position": 2,
              "item":
               {
                "@id": "{{ $state_bc->slug }}",
                "name": "{{ $state_bc->name }}"
               }
              },
              {
               "@type": "ListItem",
              "position": 3,
              "item":
               {
                "@id": "{{ $county_bc->slug }}",
                "name": "{{ $county_bc->name }}"
               }
              },
               @if(isset($city_bc))
              {
               "@type": "ListItem",
              "position": 4,
              "item":
               {
                "@id": "{{ $city_bc->slug }}",
                "name": "{{ $city_bc->name }}"
               }
              }
              @endif
             ]
            }
            </script>

            <title>{{ $title_data }}</title>

    @elseif(isset($country) && isset($state) && isset($name))
        <?php
        $spaceString = str_replace('nbsp;', ' ', $setting->county_meta);
        $spaceString = str_replace('{country_name}', $country, $spaceString);
        $spaceString = str_replace('{state_name}', $state, $spaceString);
        $spaceString = str_replace('{county_name}', $name, $spaceString);


        $title_data = str_replace('{country_name}', $country, $setting->county_meta_title);
        $title_data = str_replace('{state_name}', $state, $title_data);
        $title_data = str_replace('{county_name}', $name, $title_data);
        if(isset($bname)){
            $title_data = str_replace('{category}', $bname, $title_data);
        }
        else{
            $title_data = str_replace('{category}', $cat->name, $title_data);
        }

        if(isset($bname)){
            $spaceString = str_replace('{category}', $bname, $spaceString);
        }
        else{
            $spaceString = str_replace('{category}', $cat->name, $spaceString);
        }

        $data = strip_tags($spaceString);
        $data = preg_replace('/[^\p{L}\p{N}\s]/u', '', $data);
        ?>

            <meta name="description" content="{{ $data }}">
            <meta property="og:site_name" content="{{ $title_data }}"/>
            <meta property="og:title" content="{{ $title_data }}"/>
        <meta name="area_meta_description" content="{{ $data }}">

            <?php
            $country_bc = \App\Country::where('name', $country)->first();
            $state_bc = \App\State::where('name', $state)->first();
            $county_bc = \App\County::where('name', $name)->first();
            $city_bc = \App\City::where('name', $name)->first();
            ?>
            <script type="application/ld+json">
            {
             "@context": "https://schema.org",
             "@type": "BreadcrumbList",
             "itemListElement":
             [
              {
               "@type": "ListItem",
               "position": 1,
               "item":
               {
                "@id": "{{ $country_bc->slug }}",
                "name": "{{ $country_bc->name }}"
                }
              },
              {
               "@type": "ListItem",
              "position": 2,
              "item":
               {
                "@id": "{{ $state_bc->slug }}",
                "name": "{{ $state_bc->name }}"
               }
              },
              @if(isset($county_bc))
              {
               "@type": "ListItem",
              "position": 3,
              "item":
               {
                "@id": "{{ $county_bc->slug }}",
                "name": "{{ $county_bc->name }}"
               }
               @endif
              @if(isset($city_bc))
              {
               "@type": "ListItem",
              "position": 3,
              "item":
               {
                "@id": "{{ preg_replace('/([^:])(\/{2,})/', '$1/', $city_bc->slug) }}",
                "name": "{{ $city_bc->name }}"
               }
               @endif
              }
             ]
            }
            </script>

            <title>{{ $title_data }}</title>

    @elseif(isset($country) && isset($name))
        <?php
        $spaceString = str_replace('nbsp;', ' ', $setting->state_meta);
        $spaceString = str_replace('{country_name}', $country, $spaceString);
        $spaceString = str_replace('{state_name}', $name, $spaceString);


        $title_data = str_replace('{country_name}', $country, $setting->state_meta_title);
        $title_data = str_replace('{state_name}', $name, $title_data);
        if(isset($bname)){
            $title_data = str_replace('{category}', $bname, $title_data);
        }
        else{
            $title_data = str_replace('{category}', $cat->name, $title_data);
        }

        if(isset($bname)){
            $spaceString = str_replace('{category}', $bname, $spaceString);
        }
        else{
            $spaceString = str_replace('{category}', $cat->name, $spaceString);
        }

        $data = strip_tags($spaceString);
        $data = preg_replace('/[^\p{L}\p{N}\s]/u', '', $data);
        ?>

            <meta name="description" content="{{ $data }}">
        <meta property="og:site_name" content="{{ $title_data }}"/>
        <meta property="og:title" content="{{ $title_data }}"/>
        <meta name="area_meta_description" content="{{ $data }}">

            <?php
            $country_bc = \App\Country::where('name', $country)->first();
            $state_bc = \App\State::where('name', $name)->first();
            ?>
            <script type="application/ld+json">
            {
             "@context": "https://schema.org",
             "@type": "BreadcrumbList",
             "itemListElement":
             [
              {
               "@type": "ListItem",
               "position": 1,
               "item":
               {
                "@id": "{{ $country_bc->slug }}",
                "name": "{{ $country_bc->name }}"
                }
              }
              @if($state_bc)
              ,{
               "@type": "ListItem",
              "position": 2,
              "item":
               {
                "@id": "{{ $state_bc->slug }}",
                "name": "{{ $name }}"
               }
              }@endif
             ]
            }
            </script>

            <title>{{ $title_data }}</title>


    @elseif(isset($name))
        <?php
        $spaceString = str_replace('nbsp;', ' ', $setting->country_meta);
        $spaceString = str_replace('{country_name}', $name, $spaceString);


        $title_data = str_replace('{country_name}', $name, $setting->country_meta_title);
        if(isset($bname)){
            $title_data = str_replace('{category}', $bname, $title_data);
        }
        else{
            $title_data = str_replace('{category}', $cat->name, $title_data);
        }

        if(isset($bname)){
            $spaceString = str_replace('{category}', $bname, $spaceString);
        }
        else{
            $spaceString = str_replace('{category}', $cat->name, $spaceString);
        }

        $data = strip_tags($spaceString);
        $data = preg_replace('/[^\p{L}\p{N}\s]/u', '', $data);
        ?>
        <meta name="description" content="{{ $data }}">
        <meta property="og:site_name" content="{{ $title_data }}"/>
        <meta property="og:title" content="{{ $title_data }}"/>
        <meta name="area_meta_description" content="{{ $data }}">

            <?php
            $country_bc = \App\Country::where('name', $name)->first();
            ?>
        @if(isset($country_bc))
            <script type="application/ld+json">
                {
                 "@context": "https://schema.org",
                 "@type": "BreadcrumbList",
                 "itemListElement":
                 [
                  {
                   "@type": "ListItem",
                   "position": 1,
                   "item":
                   {
                    "@id": "{{ $country_bc->slug }}",
                    "name": "{{ $name }}"
                    }
                  }
                  }
                 ]
                }
            </script>
            @endif

            <title>{{ $title_data }}</title>


        @else

        <?php
        $spaceString = str_replace('nbsp;', ' ', $setting->country_meta);
        $spaceString = str_replace('{country_name}', '', $spaceString);


        $title_data = str_replace('{country_name}', '', $setting->country_meta_title);
        $title_data = str_replace('{category}', '', $title_data);

        $data = strip_tags($spaceString);
        $data = preg_replace('/[^\p{L}\p{N}\s]/u', '', $data);
        ?>
        <meta name="description" content="{{ $data }}">
        <meta property="og:site_name" content="{{ $title_data }}"/>
        <meta property="og:title" content="{{ $title_data }}"/>
        <meta name="area_meta_description" content="{{ $data }}">
        <title>{{ $title_data }}</title>

    @endif
    {!! $setting->single_schema !!}

{{--    <title>@if(isset($name)){{ str_replace('{area_name}', $name, $setting->site_name) }}@else{{ str_replace('{area_name}', '', $setting->site_name) }}@endif</title>--}}
    @if(isset($users) && count($users) > 0)
        @foreach($users as $user)
            @if(isset($user))
                <?php
                $schema = App\UserSchema::where('user_id', $user->id)->first();
                // print_r($schema);
                ?>
            @if(isset($schema))
                <?php
                        $schema = str_replace('&lt;', '<', $schema->text);
                        $schema = str_replace('&nbsp;', '', $schema);
                        $schema = str_replace('&gt;', '>', $schema);

                        ?>
                          @if(isset($name)){!! str_replace('{area_name}', $name, $schema)  !!}@endif
                @endif
            @endif
        @endforeach
    @endif

    <link rel=canonical href={{ $currentURL }}>
    <link rel="icon" href="@if(isset($setting->favicon)){{ asset('upload/settings/'.$setting->favicon) }}@endif">
{{--    <link rel="stylesheet" href="{{ my_asset('front/css/animate.min.css') }}">--}}
    <link rel="stylesheet" href="{{ my_asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ my_asset('front/css/style.css') }}">

    @yield('style')
    <style>
        p{
            font-weight: 500;
            font-size: 20px;
        }

        .footer_cats>li>.me-1{

        }
        .footer_cats>li>span>a{
            font-size: 20px;
            color: white;
        }
        .breadcrumb-item>a{
            font-weight: 600;
            font-size: 19px;
            color: black;
        }
        .nav-link{
            font-weight: 600;
            font-size: 19px;
            color: black;
        }
        .job-info>li{
            font-weight: 500;
            font-size: 19px;
            color: black;
        }
        .breadcrumb-item.active{
            font-weight: 500;
            color:black;
        }
    </style>
    <?php
    ?>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="90" id="home">
    @include('front.includes.header')
    @yield('content')
    @include('front.includes.footer')
{{--    <script src="{{ my_asset('front/js/jquery-3.3.1.min.js') }}"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            type="text/javascript"></script>
{{--    <script src="{{ my_asset('front/js/popper.min.js') }}"></script>--}}
    <script src="{{ my_asset('front/js/bootstrap.min.js') }}"></script>
{{--    <script src="{{ my_asset('front/js/wow.js') }}"></script>--}}
    <script src="{{ my_asset('front/js/script.js') }}"></script>
{{--    <script src="{{ my_asset('front/js/jquery.mask.min.js') }}"></script>--}}
    {{--<script>--}}
        {{--$(document).ready(function(){--}}
          {{--$('#phone').mask('(000) 000-0000');--}}
        {{--});--}}
    {{--</script>--}}
    @yield('script')


    <script>
        $(document).on('click', '.profile', function() {
            const toggleMenu = document.querySelector(".menu");
            toggleMenu.classList.toggle("active");
        });
    </script>



    {{--///--}}


    <script>
        var next = document.querySelector('.btn-next');
        var previous = document.querySelector('.btn-previous');
        var form = document.querySelector('.slide-container');
        var slides = document.querySelectorAll(".slide");
        var slideNumber = 0;
        var url = "ENTER GOOGLE SHEET URL HERE";
        var $form = $('form');

        next.addEventListener('click', function(){
            changePosition("next");
            $(".btn-previous").css({"display":""});
        });

        previous.addEventListener('click', function(){
            changePosition("previous");
        });

        function changePosition(type){
            if(type=="next"){
                var form_valid = false;
                form_valid = validateForm(slideNumber);
                if(form_valid){
                    hideError(slideNumber);
                    slideNumber += 1;
                }else{
                    showError(slideNumber);
                }
            }else{
                if(slideNumber == 0){
                }else{
                    slideNumber -= 1;
                }
            }
            if(slideNumber < slides.length){
                pos = slideNumber * -340;
                form.style.top = pos +"px";
                document.querySelector('.btn-submit').style.display = "none";
                document.querySelector('.btn-next').style.display = "inline-block";
            }
            if(slideNumber == slides.length-1){
                document.querySelector('.btn-next').style.display = "none";
                document.querySelector('.btn-submit').style.display = "inline-block";
            }
        }

        function validateForm(slideNumber){
            var form_valid = false;
            var inputs = slides[slideNumber].querySelectorAll("input");
            console.log(inputs);

            // if($.trim($('#job_description').text()) == '') {
            //     form_valid = false;
            // }

            if(inputs.length !== 0){
                if(inputs[0].type === "radio"){
                    inputs.forEach(function(input){
                        if(input.checked){
                            form_valid = true;
                        }
                    });
                }

                if(inputs[0].type === "text" && inputs[0].value !== ""){
                    form_valid = true;
                }

                // if(inputs[0].type === "email" && inputs[0].value !== ""){
                //     form_valid = validateEmail(inputs[0].value);
                // }


            }else{
                form_valid = true;
            }

            return form_valid;
        }

        function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        function showError(slideNumber){
            var error = slides[slideNumber].querySelector(".error-message");
            if(error) error.style.display = "block";
        }

        function hideError(slideNumber){
            var error = slides[slideNumber].querySelector(".error-message");
            if(error) error.style.display = "none";
        }

        var submit = document.querySelector('.btn-submit');
        submit.addEventListener('click', function(e){


            if($('#lead_email').val() == '' || $('#username').val() == '' || $('#phone').val() == '' || $('#postcode').val() == '') {
                $(".error-detail-message").css({"display":"block"});
            }
            else{
                $('#questionnaire-form').submit();
            }

        })

    </script>

    <script>
        $("#job_description").on("keyup paste", function() {
            var $this, limit, val;
            limit = 50;
            $this = $(this);
            // val = $this.val();
            // $this.val(val.substring(0, limit));
            if($this.val().length >= 50) {
                // document.querySelector('.btn-next').disabled = false;
            }
            else{
                // document.querySelector('.btn-next').disabled = true;
            }

            // Variables
            var limit = $('.limited');
            var text = limit.val().length;
            var max = limit.data('limit');
            var counter = $('.counter');
            var count = (max - text);

            // Output Number
            if (count < 0) {
                counter.html( 0 );
                // document.querySelector('.btn-next-start').addClass("btn-next");

                // $(".btn-next-start").addClass("btn-next");
                // var next = document.querySelector('.btn-next');
                // var previous = document.querySelector('.btn-previous');
                // var form = document.querySelector('.slide-container');
                // var slides = document.querySelectorAll(".slide");
                // var slideNumber = 0;
                // var url = "ENTER GOOGLE SHEET URL HERE";
                // var $form = $('form');
                //
                // next.addEventListener('click', function(){
                //     changePosition("next");
                //     $(".btn-previous").css({"display":""});
                // });
                //
                // previous.addEventListener('click', function(){
                //     changePosition("previous");
                // });
                //
                // function changePosition(type) {
                //     if (type == "next") {
                //         var form_valid = false;
                //         form_valid = validateForm(slideNumber);
                //         if (form_valid) {
                //             hideError(slideNumber);
                //             slideNumber += 1;
                //         } else {
                //             showError(slideNumber);
                //         }
                //     } else {
                //         if (slideNumber == 0) {
                //         } else {
                //             slideNumber -= 1;
                //         }
                //     }
                //     if (slideNumber < slides.length) {
                //         pos = slideNumber * -340;
                //         form.style.top = pos + "px";
                //         document.querySelector('.btn-submit').style.display = "none";
                //         document.querySelector('.btn-next').style.display = "inline-block";
                //     }
                //     if (slideNumber == slides.length - 1) {
                //         document.querySelector('.btn-next').style.display = "none";
                //         document.querySelector('.btn-submit').style.display = "inline-block";
                //     }
                // }
                $(".disable_btn").addClass("d-none");
                $(".btn-next").removeClass("d-none");

            } else {
                $(".disable_btn").removeClass("d-none");
                $(".btn-next").addClass("d-none");
                counter.html( Math.abs(count) );

                // $(".btn-next-start").removeClass("btn-next");
            }

        });
    </script>
    <script>
        function quoteFun($id){
            $('#quoteModal').modal('toggle');
            $('#quoteModal').modal('show');
            $('#quoteModal').modal('hide');
            $('#user_business_id').val($id);
        }
    </script>

    <script>
        $(".btn-next-start").on('click', function(event){
            $(".alert_text").removeClass("d-none");
        });
    </script>


    {{--////send notifications--}}
    <script>
        let tel = $('a[href^="tel:"]');
        let globalLatitude
        let globalLongitude
        let globalCity
        let globalPostal
        let globalGPSLatitude
        let globalGPSLongitude
        const userAgent = navigator.userAgent;
        const currentUrl = window.location.href;
        async function myFunction () {
            /* Get user country from api */
            const res = await fetch('https://ipapi.co/json')
            /* Store data as json */
            const data = await res.json()
            /* Store country in a variable */
            globalLatitude = data.latitude
            globalLongitude = data.longitude
            globalCity = data.city
            globalPostal = data.postal
        }
        myFunction ()
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }
        const getDeviceType = () => {
            const ua = navigator.userAgent;
            if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
                return "tablet";
            }
            if (
                /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(
                    ua
                )
            ) {
                return "mobile";
            }
            return "desktop";
        };

        tel.click(function (e) {
            // e.preventDefault();
            tel = $(this).text();
            console.log(tel);
            $.ajax({
                type: "POST",
                url: "https://www.gripelectric.net/report/clicks",
                data: { count: 1, url: currentUrl, latitude: globalLatitude, longitude: globalLongitude, city: globalCity, postal: globalPostal, gpslongitude: globalGPSLongitude, gpslatitude: globalGPSLatitude, browser: userAgent, device: getDeviceType(), tel: tel  },
                success: function (response) {
                    console.log(response);
                }
            });
        });
        function showPosition(position) {
            globalGPSLatitude = position.coords.latitude;
            globalGPSLongitude = position.coords.longitude;
        }
    </script>
    {{--////send notifications--}}


</body>

</html>
