@extends('layouts/users.app')
@section('contents')

@if(!auth()->user())

<!-- Modal -->
<div class="modal fade" id="landingTamu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Anda Belum Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <input type="text" name="nama" class="form-control mb-3" id="namaTamu" placeholder="Masukan Nama Anda">
            <input type="text" name="asal" class="form-control mb-3" id="asalTamu" placeholder="Masukan Asal Anda, Contoh : SDN 3 Contoh Kelas 3">
            <input type="text" name="tujuan" class="form-control mb-3" id="tujuanTamu" placeholder="Masukan Tujuan Anda Mengunjungi situs ini">
            <button type="button" class="btn btn-success col-12 btn-sm d-block" id="absen">Lanjut Pinjam Buku</button>
        </form>
        <hr>
            <div clas="row">
                <center>
                <div>
                    <a href="{{route('login')}}">Sudah Punya Akun? Masuk!</a>
                </div>
                <div>
                    <a href="{{route('register')}}">Belum Punya Akun? Daftar!</a>
                </div> 

                </center>
            </div>
      </div>
    </div>
  </div>
</div>
@endif 
<!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                @php($kegiatanbanner=false)
                @foreach($kegiatan as $i)
                <?php $kegiatanbanner=true; ?>
                <div class="hero__items set-bg img-fluid" data-setbg="{{asset('storage/'.$i->banner)}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <h2>{{$i->nama_kegiatan}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                @if(!$kegiatanbanner)
                <div class="hero__items set-bg img-fluid" data-setbg="{{asset('img/hero/hero-1.jpg')}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <h2>Belum ada kegiatan</h2>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Hero Section End -->     
	
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Buku Yang Tersedia</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{route('detail-stats','Tersedia')}}" class="poc-btn">Lihat Semua <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 pb-5">
                            <?php
                            $booktersedia = false;
                            foreach($data as $a){
                            if($a->status_buku ==="Tersedia" || $a->status_buku === "Rusak"){
                                $booktersedia = true; 
                                if($a->status_buku === "Tersedia"){
                                    $bg = "bg-success";
                                } else if ($a->status_buku === "Rusak"){
                                    $bg = "bg-warning";
                                }
                            ?>
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-5 pb-5 col-xl-2 mr-3 card shadow">
                                <a href="{{url('detail-buku', $a->id_buku)}}">
                                    <div>
                                        <div class="product__item" style="width: 163px; height: 265px;">
                                            <div class="product__item__pic set-bg" data-setbg="{{asset('storage/'.$a->cover)}}">
                                                <div class="st {{ $bg }}">{{$a->status_buku}}</div>
                                                    <div class="comment"><i class="fa fa-comments"></i> {{$ulasanPerBuku[$a->id_buku]}}</div>
                                                    <div class="view"><i class="fa fa-book"></i> {{$a->totalpeminjaman}}</div>
                                                </div>
                                                <div class="product__item__text">
                                                    <ul>
                                                        <li>{{$a->id_kategori}}</li>
                                                    </ul>
                                                    <h5>{{$a->nama_buku}}</h5>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                    </a>
                            <?php 

                                }
                            }

                            ?>

                            @if(!$booktersedia)
                                <div class="col-lg-12 col-md-6 col-sm-6 mb-5 pb-5 col-xl-12 card shadow">
                                    <div class="card-body">
                                        <span class="mt-5"><center>Belum ada Buku</center></span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="popular__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Buku Yang TIDAK TERSEDIA</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{route('detail-stats','Dipinjam')}}" class="poc-btn">Lihat Semua <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 pb-5">
                        <?php
                        $booktidaktersedia=false;
                        foreach($data as $a){
                            if($a->status_buku ==="Dipinjam"){
                            $booktidaktersedia=true; 
                            
                            ?>
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-5 pb-5 col-xl-2 mr-3 card shadow">
                                <a href="{{url('detail-buku', $a->id_buku)}}">
                                    <div>
                                        <div class="product__item" style="width: 163px; height: 265px;">
                                            <div class="product__item__pic set-bg" data-setbg="{{asset('storage/'.$a->cover)}}">
                                                <div class="st bg-danger">{{$a->status_buku}}</div>
                                                    <div class="comment"><i class="fa fa-comments"></i> {{$ulasanPerBuku[$a->id_buku]}}</div>
                                                    <div class="view"><i class="fa fa-book"></i> {{$a->totalpeminjaman}}</div>
                                                </div>
                                                <div class="product__item__text">
                                                    <ul>
                                                        <li>{{$a->id_kategori}}</li>
                                                    </ul>
                                                    <h5>{{$a->nama_buku}}</h5>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                    </a>
                                <?php 
                            }
                        }
                                ?>
                        
                        @if(!$booktidaktersedia)
                                <div class="col-lg-12 col-md-6 col-sm-6 mb-5 pb-5 col-xl-12 card shadow">
                                    <div class="card-body">
                                        <span class="mt-5"><center>Belum ada Buku</center></span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Product Section End -->
@endsection