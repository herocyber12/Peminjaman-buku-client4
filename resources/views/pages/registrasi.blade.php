@extends('layouts/users.app')
@section('contents')
    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="{{asset('img/normal-breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Buat Akun</h2>
                        <p>Selamat Datang Di [Nama Tempat Peminjaman]</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Signup Section Begin -->
    <section class="signup spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xl-6 py-5 mt-4">
                <div class="signup__content">
					<div class="img__form">
						
                    <img class=" img-fluid" src="{{asset('img/1x/Loginnone.png')}}" >
					</div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6">
                <div class="login__form pr-0">
                    <h3>Buat Akun</h3>
                    <form action="{{route('guest.create')}}" method="POST">
                        @csrf
                        <div class="input__item">
                            <input type="text" name="nama" placeholder="Nama">
                            <span class="icon_tag_alt"></span>
                        </div>
                        <div class="input__item">
                            <input type="text" name="alamat" placeholder="Alamat">
                            <span class=" icon_pin"></span>
                        </div>
                        <div class="input__item">
                            <input type="text" name="no_hp" placeholder="Nomor HP">
                            <span class="icon_phone"></span>
                        </div>
                        <div class="input__item">
                            <input type="text" name="email" placeholder="Alamat Email">
                            <span class="icon_mail"></span>
                        </div>
                        <div class="input__item">
                            <input type="text" name="username" placeholder="Username">
                            <span class="icon_profile"></span>
                        </div>
                        <div class="input__item">
                            <input type="text" name="password" placeholder="Kata sandi">
                            <span class="icon_lock"></span>
                            <button type="button" class="input-group-text bg-transparent btn-inverse-white m-0"  onclick="togglepassword3()"><i class="fa fa-eye" id="iconnya3"></i></button>

                        </div>
                        <button type="submit" class="site-btn">Buat Akun</button>
                    </form>
                    <h5>Sudah Punya Akun? <a href="{{url('guest/login')}}">Masuk!</a></h5>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Signup Section End -->


@endsection

