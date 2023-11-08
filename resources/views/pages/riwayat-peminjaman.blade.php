@extends('layouts/users.app')
@section('contents')
<!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
			<div class="row mb-3 ">
				<div class="col-xl-12 col-md-12 ">
					<a href="{{route('guest.riwayat')}}" class="btn btn-sm btn-info mr-2">Riwayat Peminjaman</button>
<!--					<button type="button" class="btn btn-sm btn-info">Bookmark</button>-->
					<a href="{{route('guest.profil')}}" class="btn btn-sm btn-info ml-2">Profil</a>
				</div>
			</div>
			<div class="row mb-5 pb-5">
				<h4 class="mb-4">Riwayat Peminjaman</h4>
				<div class="col-xl-12">
					<table id="example" class="display" style="width:100%">
					<thead>
						<tr>
							<th>Cover Buku</th>
							<th>Judul Buku</th>
							<th>Tanggal Dipinjam</th>
							<th>Tanggal yang harus dikembalikan</th>
                            <th>Status Pengajuan Peminjaman</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Cover Buku</th>
							<th>Judul Buku</th>
							<th>Tanggal Dipinjam</th>
							<th>Tanggal yang harus dikembalikan</th>
                            <th>Status Pengajuan Peminjaman</th>
						</tr>
					</tfoot>
					<tbody>
                        @php
                        @foreach($data as $a)
                        <tr>
                            <td><img src="{{asset('storage/'.$a->cover)}}" class="img-fluid" style="max-width:100%;max-height:100%;"></td>
                            <td>{{$a->nama_buku}}</td>
                            <td>{{isset($a->tgl_dipinjam)?$a->tgl_dipinjam:"Belum disetujui"}}</td>
                            <td>{{isset($a->tgl_dikembalikan)?$a->tgl_dikembalikan:"Belum disetujui"}}</td>
                            <td>{{$a->status_peminjaman}}</td>
                        </tr>
                        @endforeach
					</tbody>
				</table>
				
				</div>
				
			</div>

   	  </div>
    </section>
        <!-- Anime Section End -->

@endsection