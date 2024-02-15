@extends('layouts/dashboard.app')
@section('contents')

<!-- Page Heading -->
<div class="d-flex flex-column flex-sm-row justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Riwayat Reservasi</h1>
    <div class="d-flex">
        <a href="{{url('exportreservasi')}}" class="d-inline-block d-sm-inline-block btn btn-sm btn-primary mb-2 shadow-sm mr-2"><i class="fas fa-download fa-sm text-white-50"></i> Export</a>
    </div>
	</div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Reservasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>

                            <th>Id Reservasi</th>
							<th>Nama Peminjam</th>
							<th>Buku</th>
                            <th>Tanggal Dipinjam</th>
                            <th>Tanggal Dikembalikan</th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Id Reservasi</th>
							<th>Nama Peminjam</th>
							<th>Nama Buku</th>
                            <th>Tanggal Dipinjam</th>
                            <th>Tanggal Dikembalikan</th>
                        </tr>
                    </tfoot>
                    <tbody class="text-center">
                        @php($no=1)
                        @foreach($data as $a)
						<tr>
                            <td>{{$no++}}</td>
							<td class="align-middle">{{$a->id_reservasi}}</td>
							<td class="align-middle">{{$a->nama_profil}}</td>
							<td class="align-middle">{{$a->nama_buku}}</td>
							<td class="align-middle">{{$a->tanggal_dipinjam}}</td>
							<td class="align-middle">{{$a->tanggal_dikembalikan}}</td>
							
						</tr>
                        @endforeach
					</tbody>
                </table>
            </div>
        </div>
    </div>
@endsection