@extends('layouts/dashboard.app')
@section('contents')
        <!-- Content Wrapper -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex">
                            <h6 class="m-0 font-weight-bold text-primary mr-0">Profil Anda</h6>
							<button type="button" class="btn btn-success ml-auto btn-sm" id="editButton" value="Edit"> Ubah</button>
                        </div>
                        <div class="card-body">
							@foreach($data as $a)
								@if($a->id_profil === auth()->user()->id_profil)
									<div class="row">
										<div class="col-xl-4">

										  <div class="image-container img-fluid">
        								      <label for="gambarInput" class="btn btn-secondary btn-choose ml-auto"><i class="fa fa-file-image"></i> Ganti Profil</label>
        								      <input type="file" id="gambarInput" accept="image/*" value="{{$a->foto}}">
        								      <img id="gambarPreview" src="{{isset($a->foto) ? asset('storage/'.$a->foto) : asset('img/anime/details-pic.jpg')}}" class="img-fluid" alt="" style="max-width: 100%; max-height: 100%; border-radius: 20px;">
											  <img>
        								  </div>
										</div>
										<div class="col-xl-8 pt-3">
											<form>
												@csrf
												<input type="text" class="form-control mb-3" name="nama" id="nama" placeholder="Nama Anda" value="{{$a->nama}}" readonly>
												<input type="text" class="form-control mb-3" name="alamat" placeholder="Alamat Anda" id="alamat" value="{{$a->alamat}}" readonly>
												<input type="number" class="form-control mb-3" name="no_hp" placeholder="Nomor WA Aktif" id="no_hp" value="{{$a->no_hp}}" readonly>
												<input type="email" class="form-control mb-3" name="email" placeholder="Alamat Email" id="email" value="{{auth()->user()->email}}" readonly>
												<input type="text" class="form-control mb-3" name="username" id="username" placeholder="Username" value="{{auth()->user()->username}}" readonly>
											</form>
											<div class="d-flex">
													<button class="btn btn-info mr-1" data-toggle="modal" data-target="#exampleModal">Ganti Password</button>
													
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
													<!-- <button class="btn btn-danger mr-1">Reset Password</button> -->
												</div>
										</div>
									</div>
								@endif
							@endforeach
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
@endsection