@extends('layouts.front')
@section('title', 'Position Details')
@section('content')

    <section class="py-8 py-md-11 bg-hn1" style="margin-top: 91px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="text-center">Welcome! Please Login</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.css">
    <style>
        .select2-choices {
            border: unset !important;
        }

        .select2-container-multi .select2-choices {
            background-image: unset !important;
        }
    </style>

    <section class="py-8 py-md-10">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12" align="center">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary trader_tab" style="background: #0B5ED7" onclick="registerTab('trader')">
                            Login Trader
                        </button>
                        <button type="button" class="btn btn-primary user_tab" onclick="registerTab('user')">
                            Login User
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="content-column col-lg-8 col-md-8 col-sm-12 trader_section">
                    <h1 class="mb-3">Login Trader</h1>
                    <hr>
                    @include('front.includes.response')
                    <form action="{{ route('post.trader.login') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">E-Mail Address</label>
                                    <span class="text-danger"> *</span>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <span class="text-danger"> *</span>
                                    <input type="password" id="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           value="{{ old('password') }}" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn btn-primary">
                                        Login
                                        <div class="spinner-border d-none" role="status"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="content-column col-lg-8 col-md-8 col-sm-12 user_section" style="display: none">
                    <h1 class="mb-3">Login User</h1>
                    <hr>
                    @include('front.includes.response')
                    <form action="{{ route('post.user.login') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role_id" value="3">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">E-Mail Address</label>
                                    <span class="text-danger"> *</span>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <span class="text-danger"> *</span>
                                    <input type="password" id="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           value="{{ old('password') }}" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn btn-primary">
                                        Login
                                        <div class="spinner-border d-none" role="status"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

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
            escapeMarkup: function (m) {
                return m;
            },
            matcher: function (term, text, opt) {
                return text.toUpperCase().indexOf(term.toUpperCase()) >= 0 || opt.parent("optgroup").attr("label").toUpperCase().indexOf(term.toUpperCase()) >= 0
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
        function registerTab(type){
            if(type == 'trader'){
                $(".trader_tab").css({"backgroundColor": "#0B5ED7"});
                $(".user_tab").css({"backgroundColor": ""});

                $(".trader_section").css({"display": "block"});
                $(".user_section").css({"display": "none"});
            }
            else{
                $(".user_tab").css({"backgroundColor": "#0B5ED7"});
                $(".trader_tab").css({"backgroundColor": ""});

                $(".trader_section").css({"display": "none"});
                $(".user_section").css({"display": "block"});
            }
        }
    </script>
@endsection