@extends('layouts/users.app')
@section('contents')
    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="{{asset('img/normal-breadcrumb.jpg')}}">
        
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Reset Password Section Begin -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login__form text-center">
                        <h3>Ganti Kata Sandi</h3>
                        <form>
							<center>
                            <div class="input__item">
                                <input type="password" id="oldPassword" placeholder="Kata sandi lama">
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" id="password" placeholder="Kata Sandi baru">
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" id="confirmation" placeholder="Kata Sandi baru">
                                <span class="icon_lock"></span>
                                <div id="passwordMatchStatus" class="mt-3"></div>
                            </div>
							</center>
                            <button id="ubahSandi" class="site-btn">Ganti</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- Reset Password Section End -->
@endsection