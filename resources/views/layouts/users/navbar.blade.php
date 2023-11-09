<header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="{{route('daftar')}}">
                            <img src="{{asset('img/logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="{{route('daftar')}}">Home</a></li>
                                <li><a href="{{route('kategori')}}">Kategori <span class="arrow_carrot-down"></span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right d-flex">
                        @if(auth()->user())
                            <a href="{{route('guest.profil')}}" class="btn btn-outline-warning btn-sm">Member</a>
                            <a href="{{url('guest/logout')}}" class="btn btn-danger btn-sm">Logout</a>
                        @else
                            <a href="{{url('guest/login')}}" class="btn btn-success btn-sm">Login</a>
                        @endif
                        <!-- <a href="./login.html"><span class="icon_profile"></span></a> -->
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>