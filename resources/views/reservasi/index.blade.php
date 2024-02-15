@extends('layouts/dashboard.app')
@section('contents')
<!-- Page Heading -->
<div class="d-flex flex-column flex-sm-row justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Reservasi</h1>
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
                        @php($tolak=null)
                        
                        @foreach($data as $a)
                        @if($a->status_peminjaman === "Tidak Di Setujui")
                            <?php 
                            $tolak = true;
                            $message = "Pengajuan Ditolak"; 
                            ?>
                        @endif
                        @if($a->status_reservasi === "Sudah Dikembalikan")
                            <?php 
                            $bg = "success";
                            $message = "Sudah Dikembalikan"; 
                            ?>
                        @else 
                            <?php $bg = "warning";?>
                        @endif
						<tr>
                            <td>{{$no++}}</td>
							<td class="align-middle">{{$a->id_reservasi}}</td>
							<td class="align-middle">{{$a->nama_profil}}</td>
							<td class="align-middle">{{$a->nama_buku}}</td>
							<td class="align-middle">{{isset($a->tanggal_dipinjam) ? $a->tanggal_dipinjam: "-"}}</td>
							<td class="align-middle">{{isset($a->tanggal_dikembalikan)?$a->tanggal_dikembalikan:"-" }}</td>
							<td class="align-middle">
                                @if($a->status_reservasi === "Masih Dipinjam")
                                <form action="{{route('reservasi.ubah')}}" method="POST">
                                @csrf
                                    <input type="hidden" name="id" value="{{$a->id_reservasi}}">
                                    <button type="submit" name="masih_dipinjam" class="btn btn-danger">{{$a->status_reservasi}}</button>
                                </form>
                                @else
                                <span class="bg-{{$bg}} text-white p-2" style="border-radius: 7px; ">{{ isset($tolak) ? $message : $a->status_reservasi}}</span>
                                @endif
                            
                            </td>
							<td class="align-middle">
                                <input type="hidden" class="id_reservasi" value="{{$a->id_reservasi}}">
                                @if($a->status_peminjaman === "Disetujui" )
                                    <button class="btn btn-success btn-sm" disabled><i class="fa fa-check"></i> Setuju</button>
                                @elseif($a->status_peminjaman === "Tidak Di Setujui")
                                    <button class="btn btn-warning btn-sm" disabled><i class="fa fa-times"></i> Tolak</button>
                                @else
                                    <button type="button" class="btn btn-success btn-sm btn-reservasi" value="setuju" data-toggle="modal" data-target="#konfirmasiModal"><i class="fa fa-check"></i> Setuju</button>
                                    <button type="button" class="btn btn-warning btn-sm btn-reservasi" value="tolak" data-toggle="modal" data-target="#konfirmasiModal"><i class="fa fa-times"></i> Tolak</button>
                                @endif
                                <button type="button" class="btn btn-danger btn-sm btn-reservasi" value="hapus" data-toggle="modal" data-target="#konfirmasiModal"><i class="fa fa-trash"></i> Hapus</button>

                                <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="konfirmasiModalLabel" data-title="Yakin hapus data ini ?">Yakin hapus data ini ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- Pindahkan ke sini -->
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-success" id="konfirmasiButton" data-text="Hapus">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
						</tr>
                        @endforeach
					</tbody>
                </table>
            </div>
        </div>
    </div>
@endsection