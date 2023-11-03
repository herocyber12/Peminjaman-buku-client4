@extends('layouts/dashboard.app')
@section('contents')
<!-- Page Heading -->
<div class="d-flex flex-column flex-sm-row justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Reservasi</h1>
    <div class="d-flex">
        <a href="#" class="d-inline-block d-sm-inline-block btn btn-sm btn-primary mb-2 shadow-sm mr-2"><i class="fas fa-download fa-sm text-white-50"></i> Export</a>
    </div>
	</div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Reservasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>Id Reservasi</th>
							<th>Nama Peminjam</th>
							<th>Buku</th>
                            <th>Tanggal Dipinjam</th>
                            <th>Tanggal Dikembalikan</th>
                            <th>Status Reservasi</th>
							<th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Id Reservasi</th>
							<th>Nama Peminjam</th>
							<th>Nama Buku</th>
                            <th>Tanggal Dipinjam</th>
                            <th>Tanggal Dikembalikan</th>
                            <th>Status Reservasi</th>
							<th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody class="text-center">
                        @php($no=1)
                        @foreach($data as $a)
                        @if($a->status_reservasi === "Masih Dipinjam")
                            {{$bg = "success";}}
                        @elseif($a->status_reservasi === "Sudah Di Kembalikan")
                            {{$bg = "danger";}}
                        @else 
                            {{$bg = "warning";}}
                        @endif
						<tr>
                            <td>{{$no++}}</td>
							<td class="align-middle">{{$a->id_reservasi}}</td>
							<td class="align-middle">{{$a->nama_profil}}</td>
							<td class="align-middle">{{$a->nama_buku}}</td>
							<td class="align-middle">{{$a->tanggal_dipinjam}}</td>
							<td class="align-middle">{{$a->tanggal_dikembalikan}}</td>
							<td class="align-middle"><span class="bg-{{$bg}} text-white p-2" style="border-radius: 7px; ">{{$a->status_reservasi}}</span></td>
							<td class="align-middle">
                                <input type="hidden" id="id_reservasi" value="{{$a->id_reservasi}}">
                                @if($a->status_peminjaman === "Disetujui" )
                                    <button class="btn btn-success btn-sm" disabled><i class="fa fa-check"></i> Setuju</button>
                                @elseif($a->status_peminjaman === "Tidak Di Setujui")
								    <button class="btn btn-warning btn-sm" disabled><i class="fa fa-times"></i> Tolak</button>

                                @else
                                    <button type="button" class="btn btn-success btn-sm btn-reservasi" value="setuju"><i class="fa fa-check"></i> Setuju</button>
								    <button type="button" class="btn btn-warning btn-sm btn-reservasi" value="tolak"><i class="fa fa-times"></i> Tolak</button>
                                @endif
								    <button type="button" class="btn btn-danger btn-sm btn-reservasi" value="hapus"><i class="fa fa-trash"></i> Hapus</button>
							</td>
						</tr>
                        @endforeach
					</tbody>
                </table>
            </div>
        </div>
    </div>
@endsection