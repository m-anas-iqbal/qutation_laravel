<?php
//$countries = \App\Country::select('name')->groupBy('name')->get();
?>
<footer class="footer pt-3" style="background-color: #1e212c">
    <div class="container mt-lg-3 py-md-5 py-4">
        {{--<div class="row mb-5">--}}
            {{--<div class="col-lg-5 col-md-6">--}}
                {{--<div class="d-sm-flex align-items-center justify-content-between mb-4">--}}
                    {{--<a href="{{ url('/') }}">--}}
                        {{--@if(isset($setting->logo))--}}
                            {{--<img src="{{ asset('upload/settings/'.$setting->logo) }}" alt="logo"--}}
                                 {{--style="height: 80px; width: 80px">--}}
                        {{--@endif--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
        <div class="row mb-sm-5 mb-4">
            <div class="col-md-4 col-sm-12 mb-md-0 mb-4">
                <h2 class="text-light text-uppercase">@if(isset($name)){{ str_replace('{area_name}', $name, $setting->site_name) }}@else{{ str_replace('{area_name}', '', $setting->site_name) }}@endif</h2>
                <p class="text-light">
                    @if(isset($name)){!! str_replace('{area_name}', $name, $setting->site_description) !!}@else{!! str_replace('{area_name}', '', $setting->site_description) !!}@endif
                </p>
            </div>
            <div class="col-md-6 col-sm-12 mb-md-0 mb-4">
                <h2 class="text-light text-uppercase" style="font-size: 25px;">Categories</h2>
                @if(isset($signup_status) && $signup_status == 1)

                    <ul class="nav nav-light">
                    </ul>
                    @else
                <ul class="nav nav-light footer_cats">
                    @if(isset($states) && isset($name) && count($states) > 0)
                        @foreach($states as $key=>$state)
                            <li class="nav-item mb-2">
                                <span class="me-1 text-light">@if($key != 0)&nbsp;&nbsp;|&nbsp;&nbsp;@endif <a href="{{ url('a/'.$name.'/'.$state->name) }}">{{ $state->name }}</a></span>
                            </li>
                        @endforeach
                    @elseif(isset($counties) && isset($name) && count($counties) > 0)
                        @foreach($counties as $key=>$county)
                            <li class="nav-item mb-2">
                                <span class="me-1 text-light">@if($key != 0)&nbsp;&nbsp;|&nbsp;&nbsp;@endif <a href="{{ url('a/'.$country.'/'.$name.'/'.$county->name) }}">{{ $county->name }}</a></span>
                            </li>
                        @endforeach
                    @elseif(isset($cities) && isset($name) && count($cities) > 0)
                        @foreach($cities as $key=>$city)
                            <li class="nav-item mb-2">
                                <span class="me-1 text-light">@if($key != 0)&nbsp;&nbsp;|&nbsp;&nbsp;@endif  <a href="{{ url('a/'.$country.'/'.$state.'/'.$name.'/'.$city->name) }}">{{ $city->name }}</a></span>
                            </li>
                        @endforeach
                    @elseif(isset($towns) && count($towns) > 0)
                        @foreach($towns as $key=>$town)
                            <li class="nav-item mb-2">
                                <span class="me-1 text-light">@if($key != 0)&nbsp;&nbsp;|&nbsp;&nbsp;@endif <a href="{{ url('a/'.$country.'/'.$state.'/'.$county .'/'.$town->city .'/'. $town->name) }}">{{ $town->name }}</a></span>
                            </li>
                        @endforeach
                    @elseif(isset($countries) && count($countries) > 0)
                            @foreach($countries as $key=>$country)
                                <li class="nav-item mb-2">
                                    <span class="me-1 text-light">@if($key != 0)&nbsp;&nbsp;|&nbsp;&nbsp;@endif <a href="{{ url('a', $country->name) }}">{{ $country->name }}</a></span>
                                </li>
                            @endforeach

                    @endif
                </ul>
                    @endif
            </div>
            <div class="col-md-2 col-sm-12 mb-md-0 mb-4">
                <h2 class="text-light text-uppercase" style="font-size: 25px;">Contacts</h2>
                <p class="text-light opacity-60"><strong>{{ $setting->email }}</strong></p>
                <p class="text-light opacity-60"><strong>{{ $setting->phone }}</strong></p>
            </div>
        </div>
        <div class="d-flex align-items-sm-center justify-content-between py-1">
            <div class="fs-xs text-light">
                <span class="d-sm-inline small d-block mb-1">
                    {{ $setting->copyright }}
                </span>

            </div>
        </div>
    </div>
</footer>
