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
                @foreach($kegiatan as $i)
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
                                    <a href="{{route('detail-stats','Tersedia')}}" class="poc-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 pb-5">
                            @foreach($data as $a)
                            @if($a->status_buku ==="Tersedia")

                                <div class="col-lg-4 col-md-6 col-sm-6 mb-5 pb-5 col-xl-3 card">
                                    <div class="card-body shadow">
                                        <div class="product__item"  style="width: 230px; height: 325px;">
                                            <div class="product__item__pic set-bg" data-setbg="{{asset('storage/'.$a->cover)}}">
                                                <div class="st bg-success">{{$a->status_buku}}</div>
                                                    <div class="comment"><i class="fa fa-comments"></i> {{$ulasanPerBuku[$a->id_buku]}}</div>
                                                    <div class="view"><i class="fa fa-book"></i> {{$a->totalpeminjaman}}</div>
                                                </div>
                                                <div class="product__item__text">
                                                    <ul>
                                                        <li>{{$a->id_kategori}}</li>
                                                    </ul>
                                                    <h5><a href="{{url('detail-buku', $a->id_buku   )}}">{{$a->nama_buku}}</a></h5>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @endforeach
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
                                    <a href="{{route('detail-stats','Dipinjam')}}" class="poc-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 pb-5">
                        @foreach($data as $a)
                            @if($a->status_buku ==="Dipinjam")
                                <div class="col-lg-4 col-md-6 col-sm-6 mb-5 pb-5 col-xl-3 card shadow">
                                    <div class="card-body">
                                        <div class="product__item"  style="width: 230px; height: 325px;">
                                            <div class="product__item__pic set-bg" data-setbg="{{asset('storage/'.$a->cover)}}">
                                                <div class="st bg-danger">{{$a->status_buku}}</div>
                                                <div class="comment"><i class="fa fa-comments"></i> {{ $ulasanPerBuku[$a->id_buku]}}</div>
                                                <div class="view"><i class="fa fa-book"></i> {{$a->totalpeminjaman}}</div>
                                            </div>
                                            <div class="product__item__text">
                                                <ul>
                                                    <li>{{$a->id_kategori}}</li>
                                                </ul>
                                                <h5><a href="{{url('detail-buku', $a->id_buku   )}}">{{$a->nama_buku}}</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        </div>
                    </div>
                </div>
                
</div>
</div>
</section>
<!-- Product Section End -->
@endsection