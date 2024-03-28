<header>
    <!-- Desktop navbar -->
    <nav class="navbar navbar-top-default navbar-expand-lg  nav-box-round" style="background: white;">
        <div class="container">
            <a href="{{ url('/') }}">
                @if(isset($setting->logo))
                    <img src="{{ asset('upload/settings/'.$setting->logo) }}" alt="logo" style="height: 80px; width: 80px">
                @endif
            </a>
            <div class="collapse navbar-collapse" id="wexim">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                    @if(Auth::user())

                        <style>

                            .action {
                                position: fixed;
                                top: 20px;
                                right: 30px;
                            }

                            .action .profile {
                                position: relative;
                                width: 45px;
                                height: 45px;
                                border-radius: 50%;
                                overflow: hidden;
                                cursor: pointer;
                            }

                            .action .profile img {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                            }

                            .action .menu {
                                position: absolute;
                                top: 120px;
                                right: -10px;
                                padding: 10px 20px;
                                background: #fff;
                                width: 200px;
                                box-sizing: 0 5px 25px rgba(0, 0, 0, 0.1);
                                border-radius: 15px;
                                transition: 0.5s;
                                visibility: hidden;
                                opacity: 0;
                            }

                            .action .menu.active {
                                top: 80px;
                                visibility: visible;
                                opacity: 1;
                            }

                            .action .menu::before {
                                content: "";
                                position: absolute;
                                top: -5px;
                                right: 28px;
                                width: 20px;
                                height: 20px;
                                background: #fff;
                                transform: rotate(45deg);
                            }

                            .action .menu h3 {
                                width: 100%;
                                text-align: center;
                                font-size: 18px;
                                padding: 20px 0;
                                font-weight: 500;
                                color: #555;
                                line-height: 1.5em;
                            }

                            .action .menu h3 span {
                                font-size: 14px;
                                color: #cecece;
                                font-weight: 300;
                            }

                            .action .menu ul li {
                                list-style: none;
                                padding: 16px 0;
                                border-top: 1px solid rgba(0, 0, 0, 0.05);
                                display: flex;
                                align-items: center;
                            }

                            .action .menu ul li img {
                                max-width: 20px;
                                margin-right: 10px;
                                opacity: 0.5;
                                transition: 0.5s;
                            }

                            .action .menu ul li:hover img {
                                opacity: 1;
                            }

                            .action .menu ul li a {
                                display: inline-block;
                                text-decoration: none;
                                color: #555;
                                font-weight: 500;
                                transition: 0.5s;
                            }

                            .action .menu ul li:hover a {
                                color: #ff5d94;
                            }

                        </style>

                        <div class="action">
                            <div class="profile">
                                @if(Auth::user()->photo)
                                    <img src="{{ asset('upload/user/'. Auth::user()->photo) }}" alt="{{ Auth::user()->photo }}"/>
                                @else
                                    <img src="{{ asset('images/nophoto.jpg') }}" alt="no-photo"/>
                                @endif

                            </div>
                            <div class="menu">
                                {{--<h3>Someone Famous<br /><span>Website Designer</span></h3>--}}
                                <ul>
                                    <li>
                                        <img src="{{ asset('images/profile.png') }}" /><a href="{{ route('user.profile') }}">My profile</a>
                                    </li>
                                    {{--<li>--}}
                                    {{--<img src="./assets/icons/edit.png" /><a href="#">Edit profile</a>--}}
                                    {{--</li>--}}
                                    <li>
                                        <img src="{{ asset('images/logout.png') }}" /><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf</form>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    @else
                        <a class="nav-link btn btn-primary" href="{{ route('user.create.account') }}">Sign up</a>
                        <a class="nav-link btn btn-info" href="{{ route('front.user.login') }}" style="margin-left: 10px;">Login</a>
                    @endif
                </div>
            </div>
            <a href="#" aria-label="sidenav" class="d-inline-block sidemenu_btn" id="sidemenu_toggle">
                <span></span>
                <span></span>
                <span></span>
            </a>

        </div>
    </nav>

    <!--Mobile Nav-->
    <div class="side-menu">
        <div class="inner-wrapper">
            <span class="btn-close" id="btn_sideNavClose"><i></i><i></i></span>
            <nav class="side-nav w-100">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    @if(Auth::user())
                        <li>
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf</form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.create.account') }}">Sign up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.user.login') }}">Login</a>
                        </li>
                    @endif


                </ul>
            </nav>
        </div>
    </div>
    <a id="close_side_menu" href="#"></a>
</header>
