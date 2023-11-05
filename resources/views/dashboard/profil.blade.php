@extends('layouts/dashboard.app')
@section('contents')
        <!-- Content Wrapper -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex">
                            <h6 class="m-0 font-weight-bold text-primary mr-0">Profile Anda</h6>
							<button type="button" class="btn btn-success ml-auto btn-sm" id="editButton" value="Edit"> Edit</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
								<div class="col-xl-4">
									
								  <div class="image-container">
        						      <label for="gambarInput" class="btn btn-secondary btn-choose ml-auto"><i class="fa fa-file-image"></i> Ganti Profil</label>
        						      <input type="file" id="gambarInput" accept="image/*">
        						      <img id="gambarPreview" src="../../UI-peminjaman-buku/img/anime/details-pic.jpg" alt="" style="max-width: 100%; max-height: 100%; border-radius: 20px;">
        						  </div>
								</div>
								<div class="col-xl-8 pt-3">
									<form>
										<input type="text" class="form-control mb-3" name="nama" placeholder="Nama Anda" readonly>
										<input type="text" class="form-control mb-3" name="nama" placeholder="Alamat Anda" readonly>
										<input type="text" class="form-control mb-3" name="nama" placeholder="Nomor WA Aktif" readonly>
										<input type="text" class="form-control mb-3" name="nama" placeholder="Username" readonly>
										<div class="d-flex">
											<button class="btn btn-info mr-1">Ganti Password</button>
											<button class="btn btn-danger mr-1">Reset Password</button>
										</div>
									</form>
								</div>
							</div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
@endsection