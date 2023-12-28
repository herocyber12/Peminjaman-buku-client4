@extends('layouts/users.app')
@section('contents')
    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="{{asset('img/normal-breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Masuk ke Akun</h2>
                        <p>Selamat Datang Di [Nama Tempat Peminjaman]</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Login Section Begin -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Masuk</h3>
                        <form action="{{route('guest.ceklogin')}}" method="POST">
                            @csrf
                            <div class="input__item">
                                <input type="text" name="username" placeholder="Username">
                                <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" name="password" placeholder="Kata Sandi">
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">Masuk Sekarang</button>
                        </form>
                        <!-- <a href="#" class="forget_pass">Lupa Kata sandi?</a> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                        <h3>Sudah Punya Akun ?</h3>
                        <a href="#" class="primary-btn">Buat Sekarang</a>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- Login Section End -->
@endsection