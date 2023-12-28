<header class="header shadow">
        <div class="container">
            <div class="row ">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="{{route('daftar')}}">
                            <img src="{{asset('img/logo.png')}}" alt="" style="max-width: 100%;max-height:100%; width: 125px;">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-center">
                    <div class="header__nav mx-auto">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="{{ request()->routeIs('daftar') ? 'active' : '' }}">
                                    <a href="{{ route('daftar') }}">Home</a>
                                </li>
                                <li class="{{ request()->routeIs('kategori') ? 'active' : '' }}">
                                    <a href="{{ route('kategori') }}">Kategori</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="header__right d-flex">
                        @if(auth()->user())
                            <?php 
                            if(session('profil')->level === "Admin"):
                                $url = url('profil');
                            elseif (session('profil')->level === "Member"):
                                $url = route('guest.profil');
                            endif
                            ?>        
                            <a href="{{$url}}">{{session('profil')->nama}} <span class="icon_profile"></span></a>
                        @else
                            <a href="{{url('login')}}" class="btn btn-success btn-sm">Login</a>
                        @endif
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>