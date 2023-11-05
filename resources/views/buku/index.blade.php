@extends('layouts/dashboard.app')
@section('contents')

                    <!-- Page Heading -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between mb-4">
					    <h1 class="h3 mb-0 text-gray-800">Daftar Buku</h1>
					    <div class="d-flex">
					        <button type="button" class="d-inline-block d-sm-inline-block btn btn-sm btn-success mb-2 shadow-sm mr-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</button>
					        <button type="button" class="d-inline-block d-sm-inline-block btn btn-sm btn-info mb-2 shadow-sm mr-2"  data-toggle="modal" data-target="#daftarKategori"><i class="fas fa-sm text-white-50 fa-archive"></i> Daftar Kategori</button>
					        <a href="#" class="d-inline-block d-sm-inline-block btn btn-sm btn-primary mb-2 shadow-sm mr-2"><i class="fas fa-download fa-sm text-white-50"></i> Export</a>
					    </div>
					</div>
					
					<!-- Modal Kategori -->
<div class="modal fade" id="daftarKategori" tabindex="-1" role="dialog" aria-labelledby="daftarKategorilabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title" id="daftarKategorilabel">
          <h5>Daftar Kategori</h5>
          <button type="button" class="btn btn-primary btn-sm mt-2" data-toggle="modal" data-target="#buatKategoriA">
             Buat Kategori Baru
          </button>

          <!-- Modal -->
          <div class="modal fade" id="buatKategoriA" tabindex="-1" role="dialog" aria-labelledby="buatKategoriLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-sm modal-dialog-centered">
                <div class="modal-header">
                  <h5 class="modal-title" id="buatKategoriLabel">Buat Kategori Baru</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form>
                    @csrf
                    <label for="input_kategori">Masukan Kategori</label>
                    <input type="text" name="input_kategori" id="input_kategori" class="form-control form-control-sm mb-3" required>
                    <button type="button" class="btn btn-success btn-md col-md-12" id="buatKategori">Buat</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
         </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Kategori</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="dataKategori">
            @php($no = 1)
            @foreach($kategori as $b)
            <tr>
              <td>{{ $no ++}}</td>
              <td>{{$b->kategori}}</td>
              <td>
                <div class="d-flex">
                  <a href= "{{route('kategori.hapus',$b->id_kategori)}}"class="btn btn-danger btn-sm m-2"><i class="fa fa-trash"></i> Hapus</a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Kategori -->

					
					<!-- Modal tambah data -->
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
							  <div class="row">
							  	<div class="col-md-6 mb-3">
                    <form enctype="multipart/form-data">
								      <div class="image-container">
        						    <label for="gambarInput" class="btn btn-secondary btn-choose ml-auto"><i class="fa fa-file-image"></i> Pilih Cover</label>
        						    <input type="file" id="gambarInput" accept="image/*">
        						    <img id="gambarPreview" src="#" alt="" style="max-width: 100%; max-height: 100%; border-radius: 5px;">
        						  </div>

                    </form>
								 </div>
								  <div class="col-md-6 mb-3">
                    <h5 class="text-primary">Form Data Buku</h5>
									  <div class="mt-3">
									<form >
                    @csrf  
										<input type="text" id="nama_buku" class="form-control mb-3" placeholder="Masukan Nama Buku">  
										<input type="text" id="penerbit" class="form-control mb-3" placeholder="Penerbit">  
										<input type="text" id="penulis" class="form-control mb-3" placeholder="Penulis">  
										<input type="number" id="tahun_terbit" class="form-control mb-3" placeholder="Tahun Terbit"> 
                    <select class="form-control mb-3" id="kategori">
                      <option>Pilih Kategori</option>
                      @foreach($kategori as $a)
                        <option value="{{ $a->kategori}}">{{$a->kategori}}</option>
                      @endforeach
                    </select> 
                    <textarea id="editor" name="sinopsis" style="height: 100px"></textarea>
									</form>
									  </div>
								  </div>
							  </div>
                
									  <button type="button" id="tambahBuku" class="btn btn-success col-12 d-block">Tambah</button>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button type="button" class="btn btn-primary">Save changes</button>
					      </div>
					    </div>
					  </div>
					</div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Cover</th>
                                            <th>Nama Buku</th>
                                            <th>Penerbit</th>
                                            <th>Penulis</th>
                                            <th>Tahun Terbit</th>
                                            <th>Kategori</th>
                                            <th>QR Code</th>
											                      <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Cover</th>
                                            <th>Nama Buku</th>
                                            <th>Penerbit</th>
                                            <th>Penulis</th>
                                            <th>Tahun Terbit</th>
                                            <th>Kategori</th>
                                            <th>QR Code</th>
											                      <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody class="text-center ">
                                        @foreach($data_buku as $a)
									                  	<tr>
									                  		<td class="align-middle"><img src="{{asset('storage/'.$a->cover)}}" class="img-fluid" alt="" width="100"></td>
									                  		<td class="align-middle">{{$a->nama_buku}}</td>
									                  		<td class="align-middle">{{$a->penerbit}}</td>
									                  		<td class="align-middle">{{$a->penulis}}</td>
									                  		<td class="align-middle">{{$a->tahun_terbit}}</td>
									                  		<td class="align-middle">{{$a->id_kategori}}</td>
									                  		<td class="align-middle">{!! QrCode::size(100)->generate(route('login')) !!}</td>
									                  		<td class="align-middle">
									                  			<button class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</button>
									                  			<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{$a->id_buku}}"><i class="fa fa-wrench"></i> Edit</button>
									                  			<a href="{{route('buku.hapus',$a->id_buku)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
									                  		</td>
									                  	</tr>
                                      
                                          <!-- Modal -->
                                          <div class="modal fade" id="editModal{{$a->id_buku}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Form Edit</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <div class="row">
							                                    	<div class="col-md-6 mb-3">
                                                      <form enctype="multipart/form-data">
								                                        <div class="image-container">
        				                                  		    <label for="gambarInputEdit" class="btn btn-secondary btn-choose ml-auto"><i class="fa fa-file-image"></i> Pilih Cover</label>
        				                                  		    <input type="file" id="gambarInputEdit" accept="image/*" value="{{$a->cover}}">
        				                                  		    <img id="gambarPreviewEdit" src="{{asset('storage/'.$a->cover)}}" alt="" style="max-width: 100%; max-height: 100%; border-radius: 5px;">
        				                                  		  </div>

                                                      </form>
								                                   </div>
								                                    <div class="col-md-6 mb-3">
                                                      <h5 class="text-primary">Form Edit Data Buku</h5>
								                                  	  <div class="mt-3">
								                                  	<form >
                                                      @csrf  
                                                      <input type="hidden" id="id_buku" value="{{$a->id_buku}}">
								                                  		<input type="text" id="nama_bukuEdit" class="form-control mb-3" value="{{$a->nama_buku}}" placeholder="Masukan Nama Buku">  
								                                  		<input type="text" id="penerbitEdit" class="form-control mb-3" value="{{$a->penerbit}}" placeholder="Penerbit">  
								                                  		<input type="text" id="penulisEdit" class="form-control mb-3" value="{{$a->penulis}}" placeholder="Penulis">  
								                                  		<input type="number" id="tahun_terbitEdit" class="form-control mb-3" value="{{$a->tahun_terbit}}" placeholder="Tahun Terbit"> 
                                                      <select class="form-control mb-3" id="kategoriEdit">
                                                        <option>Pilih Kategori</option>
                                                        @foreach($kategori as $b)
                                                          <option value="{{ $b->kategori}}">{{$b->kategori}}</option>
                                                        @endforeach
                                                      </select> 
                                                      <textarea id="editorEdit" class="editorEdit" name="sinopsis" style="height: 100px">{{$a->sinopsis}}</textarea>
								                                  	</form>
								                                  	  </div>
								                                    </div>
							                                    </div>
                                                  <button type="button" id="editBuku" class="btn btn-success col-12 d-block">Ubah</button>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>

									                  	@endforeach
									                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection