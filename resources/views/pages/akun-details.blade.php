@extends('layouts/users.app')
@section('contents')
<!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="row mb-3 ">
				<div class="col-xl-12 col-md-12 row justifiy-content-between">
                    <div class="col-sm-6">
                        <a href="{{route('guest.riwayat')}}" class="btn btn-sm btn-info mr-2">Riwayat Peminjaman</button>
                        <!--<button type="button" class="btn btn-sm btn-info">Bookmark</button>-->
					    <a href="{{route('guest.profil')}}" class="btn btn-sm btn-info ml-2">Profil</a>
                    </div>
                </div>
			</div>
        <div class="row mb-5 pb-5">            
        @foreach($data as $a)
            @if($a->id_profil === auth()->user()->id_profil)
                
            <div class="d-md-flex justify-content-center align-items-center ml-auto offset-xl-0 col-xl-4">
                <div class="ml-3">
                    <div class="akun__details mb-4 mt-3 ml-5 pl-auto">
                        <div class="image-container img-fluid">
	                        <label for="gambarInput" class="btn btn-secondary btn-choose ml-auto"><i class="fa fa-file-image"></i> Pilih Cover</label>
	                        <input type="file" id="gambarInput" accept="image/*" value="{{$a->foto}}">
	                        <img id="gambarPreview" src="{{isset($a->foto) ? asset('storage/'.$a->foto) : asset('img/anime/review-0.jpg')}}" alt="" style="max-width: 100%; max-height: 100%; border-radius: 5px;">
	                    </div>
                    </div>
                    <div class="akun__qrcode mb-2 mt-3 ml-5 pl-auto">
                        <!-- <img src="{{asset('img/qrcode/qrcode1.png')}}" class="img-fluid" alt=""> -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#kartuMember">Kartu Member Anda</button>

                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="login__form mt-3 align-content-end">
                    <form class="col-xl-6 offset-xl-0">
                        @csrf
                      <div class="input__item">
                            <input type="text" id="nama" placeholder="Nama Anda" value="{{$a->nama}}">
                            <span class="icon_tag_alt"></span>
                        </div>
                        <div class="input__item">
                          <input type="text" id="alamat" placeholder="Alamat" value="{{$a->alamat}}">
                            <span class="icon_pin"></span>
                        </div>
                        <div class="input__item">
                            <input type="text" id="no_hp" placeholder="Nomor Wa Aktif" value="{{$a->no_hp}}">
                            <span class="icon_phone"></span>
                        </div>
                        <div class="input__item">
                            <input type="text" id="email" placeholder="Alamat E-mail Anda" value="{{auth()->user()->email}}">
                            <span class="icon_mail"></span>
                        </div>
                        <div class="input__item">
                            <input type="text" id="username" placeholder="Username Anda" value="{{auth()->user()->username}}">
                            <span class="icon_profile"></span>
                        </div>
                        <div class="row mt-2">
                            <div class="d-flex flex-row">
                                <div class="col-xl-3">
                                    <button type="button" class="btn btn-success" id="ubahGuestProfil" style="border-radius: 5px;">Ubah</button>
                                </div>
                                <div class="col-xl-7 text-center">
                                    <button type="button" class="btn btn-info mr-1 mt-2 btn-block" data-toggle="modal" data-target="#exampleModal">Ganti Password</button>
													
													<!-- Modal -->
													<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													  <div class="modal-dialog modal-dialog-centered" role="document">
													    <div class="modal-content">
													      <div class="modal-header">
													        <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
													        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
													          <span aria-hidden="true">&times;</span>
													        </button>
													      </div>
													      <div class="modal-body">
													    	<form>
																@csrf
                                                                <div class="input-group mb-3">
                                                                    <input type="password" id="oldPassword" class="form-control" placeholder = "Masukan Password Lama">
                                                                    <button type="button" class="input-group-text bg-transparent btn-inverse-white m-0"  onclick="togglepassword3()"><i class="fa fa-eye" id="iconnya3"></i></button>

                                                                </div>
																<div class="input-group mb-3">
																    <input type="password" id="password" class="form-control" placeholder = "Masukan Password Baru">
                                                                    <button type="button" class="input-group-text bg-transparent btn-inverse-white m-0"  onclick="togglepassword1()"><i class="fa fa-eye" id="iconnya1"></i></button>
                                                                </div>
																<div class="input-group mb-3">
																    <input type="password" id="confirmation" class="form-control" placeholder = "Konfirmasi Password Baru">
                                                                    <button type="button" class="input-group-text bg-transparent btn-inverse-white m-0"  onclick="togglepassword2()"><i class="fa fa-eye" id="iconnya2"></i></button>
                                                                </div>
																<div id="passwordMatchStatus"></div>

																<button type="button" id="ubahSandi" class="btn btn-success col-12 d-block btn-sm">Ubah</button>
															</form>
													      </div>
													    </div>
													  </div>
													</div>

                                </div>
                                <div class="col-xl-2">
                                    <a href="{{url('guest/logout')}}" class="btn btn-danger mt-2">Logout</a>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        @endforeach
        </div>
    </div>
</section>
    <!-- Anime Section End -->

@endsection


                        <!-- Modal -->
                        <div class="modal fade" id="kartuMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-body">
                                
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="card shadow">
                                    <div class="card-header bg-info">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-xl-6">
                                                <img src="{{asset('img/logo.png')}}" alt="">
                                            </div>
                                            <div class="col-xl-6 d-flex flex-row-reverse">
                                                <p class="text-white">Member Card</p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-body bg-info">
                                        <div class="row d-flex align-items-cneter">
                                            <div class="col-xl-4">
                                            <img src="{{isset($a->foto) ? asset('storage/'.$a->foto) : asset('img/anime/review-0.jpg')}}" alt="" style="width:100%; height:auto; max-width: 100%; max-height: 100%; border-radius: 5px;">
	                    
                                            </div>  
                                            <div class="col-xl-7 d-flex flex-column">
                                                <label class="text-white">ID : <span>{{$a->id_profil}}</span></label>
                                                <label class="text-white">Nama : <span>{{$a->nama}}</span></label>
                                                <label class="text-white">Alamat : <span>{{$a->alamat}}</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>