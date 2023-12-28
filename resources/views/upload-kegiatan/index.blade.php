@extends('layouts/dashboard.app')
@section('contents')

<!-- Page Heading -->
<div class="d-flex flex-column flex-sm-row justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Unggah Kegiatan</h1>
    <div class="d-flex">
        <a href="#" class="d-inline-block d-sm-inline-block btn btn-sm btn-success mb-2 shadow-sm mr-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-download fa-sm text-white-50"></i> Upload Kegiatan</a>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <center>
                    <form>
                        @csrf
                        <div class="image-container">
	                      <label for="gambarInput" class="btn btn-secondary btn-choose ml-auto"><i class="fa fa-file-image"></i> Pilih Cover</label>
	                      <input type="file" id="gambarInput" accept="image/*" value="#">
	                      <img id="gambarPreview" src="#" alt="" class="img-fluid mb-3" style="max-width: 100%; max-height: 100%; border-radius: 5px;">
	                    </div>
                        <input type="text" id="nama_kegiatan" class="form-control" placeholder="Nama Kegiatan Anda">
                        <button type="button" id="uploadKegiatan" class="btn btn-sm btn-success d-block mt-2 col-sm-12" >Unggah Kegiatan!</button>
                    </form>
                </center>
                
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal -->
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kegiatan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                      <th>Banner</th>
                      <th>Nama Kegiatan</th>
					            <th>Aksi</th>
                  </tr>
                </thead>
                <tfoot>
                    <tr>
                      <th>Banner</th>
                      <th>Nama Kegiatan</th>
					            <th>Aksi</th>
                  </tr>
                </tfoot>
                <tbody class="text-center ">
				          @foreach($data as $a)
                    <tr>
                        <td><img src="{{asset('storage/'. $a->banner)}}" class="img-fluid" width="150px" alt="alternative"></td>
                        <td>{{$a->nama_kegiatan}}</td>
                        <td class="align-middle">
                            <a href="{{route('kegiatan.hapus',$a->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                    @endforeach
			        </tbody>
            </table>
        </div>
    </div>
</div>
@endsection