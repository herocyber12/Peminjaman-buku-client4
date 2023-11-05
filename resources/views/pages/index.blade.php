@extends('layouts/users.app')
@section('contents')
<!-- Hero Section Begin -->
<section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                <div class="hero__items set-bg img-fluid" data-setbg="{{asset('storage/img/hero/hero-1.jpg')}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class=
                    "hero__text">
                                <h2>Judul Kegiatan</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg img-fluid" data-setbg="img/hero/hero-1.jpg">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <h2>Judul Kegiatan</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg img-fluid" data-setbg="img/hero/hero-1.jpg">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <h2>Judul Kegiatan</h2>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 pb-5">
                            @foreach($data as $a)
                            @if($a->status_buku ==="Tersedia")

                                <div class="col-lg-4 col-md-6 col-sm-6 mb-5 pb-5 col-xl-3">
                                <div class="product__item"  style="width: 230px; height: 325px;">
                                    <div class="product__item__pic set-bg" data-setbg="{{asset('storage/'.$a->cover)}}">
                                        <div class="ep">18 / 18</div>
                                        <div class="st bg-success">{{$a->status_buku}}</div>
                                        <div class="comment"><i class="fa fa-comments"></i> {{
                                             $ulasanPerBuku[$a->id_buku]}}</div>
                                        <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>{{$a->id_kategori}}</li>
                                        </ul>
                                        <h5><a href="{{url('detail-buku', $a->id_buku   )}}">{{$a->nama_buku}}</a></h5>
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
                                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 pb-5">
                        @foreach($data as $a)
                            @if($a->status_buku ==="Dipinjam")
                                <div class="col-lg-4 col-md-6 col-sm-6 mb-5 pb-5 col-xl-3">
                                <div class="product__item"  style="width: 230px; height: 325px;">
                                    <div class="product__item__pic set-bg" data-setbg="{{asset('storage/'.$a->cover)}}">
                                        <div class="ep">18 / 18</div>
                                        <div class="st bg-danger">{{$a->status_buku}}</div>
                                        <div class="comment"><i class="fa fa-comments"></i> {{ $ulasanPerBuku[$a->id_buku]}}</div>
                                        <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>{{$a->id_kategori}}</li>
                                        </ul>
                                        <h5><a href="{{url('detail-buku', $a->id_buku   )}}">{{$a->nama_buku}}</a></h5>
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