@extends('layouts/dashboard.app')
@section('contents')

<!-- Page Heading -->
<div class="d-flex flex-column flex-sm-row justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengguna</h1>
    <div class="d-flex">
        <a href="#" class="d-inline-block d-sm-inline-block btn btn-sm btn-primary mb-2 shadow-sm mr-2"><i class="fas fa-download fa-sm text-white-50"></i> Export</a>
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
                      <th>Id Profil</th>
                      <th>Foto</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Nomor Handphone</th>
                      <th>Level</th>
                      <th>QR Code</th>
						          <th>Aksi</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Id Profil</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Nomor Handphone</th>
                    <th>Level</th>
                    <th>QR Code</th>
						        <th>Aksi</th>
                  </tr>
                </tfoot>
                <tbody class="text-center ">
                    @foreach($pengguna as $a)
				          <tr>
                    <td class="align-middle">{{$a->id_profil}}</td>
					          <td class="align-middle"><img src="{{isset($a->foto) ? asset('storage/'.$a->foto) : asset('img/anime/review-0.jpg')}}" class="img-fluid" alt="" width="100"></td>
					          <td class="align-middle">{{$a->nama}}</td>
					          <td class="align-middle">{{$a->alamat}}</td>
					          <td class="align-middle">{{$a->no_hp}}</td>
					          <td class="align-middle">{{$a->level}}</td>
					          <td class="align-middle">{!! QrCode::size(100)->generate('showModalstrp("editModal{{$a->id_profil}}")') !!}</td>
					          <td class="align-middle">
					          	<button class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</button>
					          	<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{$a->id_profil}}"><i class="fa fa-wrench"></i> Edit</button>
					          	<a href="{{route('pengguna.hapus',$a->id_profil)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
					          </td>
				          </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="editModal{{$a->id_profil}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	                                <label for="gambarInput" class="btn btn-secondary btn-choose ml-auto"><i class="fa fa-file-image"></i> Pilih Cover</label>
	                                <input type="file" id="gambarInput" accept="image/*" value="{{$a->cover}}">
	                                <img id="gambarPreview" src="{{asset('storage/'.$a->foto)}}" alt="" style="max-width: 100%; max-height: 100%; border-radius: 5px;">
	                              </div>
                              </form>
			                      </div>
			                      <div class="col-md-6 mb-3">
                              <h5 class="text-primary">Form Edit Data Buku</h5>
			                 	      <div class="mt-3">
			                 	        <form >
                                @csrf  
                                  <input type="hidden" id="id_profil" value="{{$a->id_profil}}" readonly>
			                            <input type="text" id="nama" class="form-control mb-3" value="{{$a->nama}}" placeholder="Masukan Nama Buku">  
			                            <input type="text" id="alamat" class="form-control mb-3" value="{{$a->alamat}}" placeholder="Penerbit">  
			                            <input type="number" id="no_hp" class="form-control mb-3" value="{{$a->no_hp}}" placeholder="Penulis">  
			                          </form>
			                	      </div>
			                      </div>
		                      </div>
                          <button type="button" id="editPengguna" class="btn btn-success col-12 d-block">Ubah</button>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
<script>
  function showModalstrp(id) {
    $(`#${id}`).modal('show');
  }
</script>
