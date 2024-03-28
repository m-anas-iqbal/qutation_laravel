
<style>
    .form-container {
        background: white;
        max-width: 700px;
        width: 100%;
        padding: 10px;
        border-radius: 3px;
    }
    .buttons-container{
        margin-top: 3em;
    }
    button{
        -webkit-appearance: none;
        padding: 1em 2em;
        width: 140px;
        text-align: center;
    &.btn-white{
         background: white;
     }
    &.btn-submit{
         background: black;
         color: white;
     }
    }
    .float-right{
        float: right;
    }

    .radio-container{
        display: inline-block;
    }
    input[type="radio"]{
        opacity: 0;
        height: 0;
        width: 0;
    }

    input[type="radio"] ~ label {
        opacity: 1;
        border: 1px solid grey;
        padding: 10px 20px;
        background: white;
        color: black;
    }

    input[type="radio"]:active + label {
        opacity: 1;
        border: 1px solid grey;
        background: black;
        color: white;
    }

    input[type="radio"]:checked + label {
        opacity: 1;
        border: 1px solid grey;
        background: black;
        color: white;
    }
    .error-message{
        color: red;
        /*margin-top: 20px;*/
        display: none;
    }
    input[type='text'],input[type="email"]{
        border: 1px solid black;
        padding: 5px;
        width: 100%;
    }
    .btn-submit{
        display: none;
    }
    .btn-submit:disabled{
        background: #333;
        color: #777;
    }
    .slide-container{
        transition: ease-in .3s all;
        position: relative;
        top: 0;
    }

    form#questionnaire-form{
        height: 340px;
        /*height: 427px;*/
        width: 100%;
        overflow: hidden;
    }
    .slide{
        height: 340px;
        /*height: 319px;*/
        width: 100%;
    }
    .slide h2{
        margin-top: 0;
    }

    .form-container button,.form-container label{
        cursor: pointer;
    }
</style>


    {{--<div class="row mb-4">--}}
        {{--<div class="col text-center">--}}
            {{--<a href="#" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#quoteModal">Click to open Modal</a>--}}
        {{--</div>--}}
    {{--</div>--}}

<!-- large modal -->
<div class="modal fade" id="quoteModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabel">Request a Quote</h2>
                <a type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">

                <div class="form-container cf-form">
                        <form id="questionnaire-form" action="{{ route('save.quote') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="slide-container">
                            <div class="slide">
                                <h2> Describe Your Job </h2>
                                <span style="color: red" class="alert_text d-none">Please add minimum 50 characters</span>
                                <textarea data-limit="50" name="description" id="job_description" cols="30" rows="9" class="form-control limited" onchange="textAreaFunc()"></textarea><span id="character-remaining" class="counter" style="float: right">50</span>
                            </div>
                            <div class="slide">
                                <h2> When would you like the job to start? </h2>
                                <div class="error-message"> Please Select an Option </div>
                                <div class="radio-container d-block form-group" style="margin-bottom: 0.5rem;">
                                    <input type="radio" id="option1" name="job_status" value="I am flexible on the start date">
                                    <label for="option1"> I am flexible on the start date</label>
                                </div>
                                <div class="radio-container d-block form-group" style="margin-bottom: 0.5rem;">
                                    <input type="radio" id="option2" name="job_status" value="Its urgent (within 24 hours)">
                                    <label for="option2"> Its urgent (within 24 hours)</label>
                                </div>
                                <div class="radio-container d-block form-group" style="margin-bottom: 0.5rem;">
                                    <input type="radio" id="option3" name="job_status" value="Within 2 weeks">
                                    <label for="option3"> Within 2 weeks</label>
                                </div>
                                <div class="radio-container d-block form-group" style="margin-bottom: 0.5rem;">
                                    <input type="radio" id="option4" name="job_status" value="Within 1 month">
                                    <label for="option4"> Within 1 month</label>
                                </div>
                                <div class="radio-container d-block form-group" style="margin-bottom: 0.5rem;">
                                    <input type="radio" id="option5" name="job_status" value="i am budgeting/researching">
                                    <label for="option5"> i am budgeting/researching</label>
                                </div>
                            </div>
                            <div class="slide">
                                <h2>Your Details </h2>

                                <div class="error-detail-message mb-3" style="display: none; color: red"> <b>Please fill out fields</b> </div>

                                    <input type="hidden" name="user_business_id" id="user_business_id">

                                <div class="form-group" style="margin-top: -9px;">
                                    <label for="name">Your Full Name</label>
                                    <input type="text" name="name" placeholder="" id="username" value="@if(Auth::user()) {{ Auth ::user()->name}} @endif">
                                </div>
                                <div class="form-group" style="margin-top: -9px;">
                                    <label for="email">Your Email Address</label>
                                    <input type="email" name="email" id="lead_email" placeholder="" value="@if(Auth::user()) {{ Auth ::user()->email}} @endif">
                                </div>
                                <div class="form-group" style="margin-top: -9px;">
                                    <label for="phone">Your Contact Number </label>
                                    <input type="text" name="phone" id="phone" placeholder="" value="@if(Auth::user()){{ Auth ::user()->phone}}@endif">
                                </div>
                                <div class="form-group" style="margin-top: -9px;">
                                    <label for="postcode">Your Full Postcode</label>
                                    <input type="text" name="postcode" id="postcode" placeholder="" value="@if(Auth::user()){{ Auth ::user()->postcode}}@endif">
                                </div>
                            </div>
                        </div>
                        <?php
                        $google_ads_tag = DB::table('settings')->select('google_ads_tag')->first();
                        ?>
                        <script>
                            function googleadsbtn() {
                                {!!   $google_ads_tag->google_ads_tag   !!}
                            }
                        </script>

                    </form>
                    <div class="buttons-container">
                        <button class="btn-white btn-previous" style="display: none">Previous</button>
                        <button class="btn-white btn-next d-none">Continue</button>
                        <button class="btn-white disable_btn btn-next-start">Continue</button>
                        <button class="float-right btn-submit" onclick="googleadsbtn()">Submit</button>
                    </div>
                </div>
            </div>
            {{--<div class="modal-footer">--}}
            {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
            {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
