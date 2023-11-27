@extends('layouts/users.app')
@section('contents')
    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            
            <div class="anime__details__content">
                <div class="row">
                    @foreach($data as $a)
                    <div class="col-lg-3">
                        <div class="card card-body shadow">
                            <div class="anime__details__pic set-bg" data-setbg="{{asset('storage/'.$a->cover)}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card card-body shadow">
                            
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{$a->nama_buku}}</h3>
                                <hr>
                            </div>
                            <?php echo $a->sinopsis ?>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Kategori:</span> {{$a->kategori}}</li>
                                            <li><span>Penerbit:</span> {{$a->penerbit}}</li>
                                            <li><span>Tahun Terbit:</span> {{$a->tahun_terbit}}</li>
                                            <li><span>Rak:</span> 1.E.02</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn d-flex">
                                <!-- <a href="#" class="follow-btn"><i class="fa fa-bookmark-o"></i> Bookmark</a> -->
                                @php
                                if($a->status_buku === "Dipinjam")
                                {
                                    {{$disabled = "disabled";}}
                                }elseif($a->status_buku === "Tersedia"){
                                    {{$disabled = "";}}
                                }
                                @endphp
                                <form action="{{route('pengajuan')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_buku" value="{{$a->id_buku}}">
                                    <button type="submit" class="btn follow-btn" {{$disabled}}><span>Pinjam</span></button>
                                </form>
                                
                                <!--Akan Muncul Jika buku sedang dipinjam oleh pengguna -->
								<!-- <a href="#" class="watch-btn"><span>Perpanjang</span><i -->
                                    <!-- class="fa fa-angle-right"></i></a> -->
								<!-- ******************************************************* -->
                                </div>
                            </div>
                        </div>
                        </div>
                    
                    @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-xl-8">
                        
                        <div class="anime__details__review">
                            <div class="section-title">
                                <h5>Reviews</h5>
                            </div>
                            @if(empty($review))
                            <div class="anime__review__item">
                                <center><h2>Belum ada komentar</h2></center>
                            </div>
                            @else
                            @foreach($review as $r)
                                @foreach($profil as $p)
                                    @if($r->id_profil === $p->id_profil)
                                    <div class="anime__review__item">
                                        <div class="anime__review__item__pic">
                                            <img src="{{isset($p->foto) ? asset('storage/'.$p->foto) : asset('img/anime/review-0.jpg')}}" alt="">
                                        </div>
                                        <div class="anime__review__item__text">
                                            <h6>{{$p->nama}}</h6>
                                            <p>{{$r->komentar}}</p>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @endforeach
                            @endif
                           
                        </div>
                        
                        <div class="anime__details__form">
                            <div class="section-title">
                                <h5>Your Comment</h5>
                            </div>
                            <form action="{{route('komentar')}}" method="post">
                                @csrf
                                <input type="hidden" name="id_buku" value="{{$a->id_buku}}">
                                <textarea name="koment" placeholder="Your Comment"></textarea>
                                <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                            </form>
                        </div>
                    </div>
					<div class="col-lg-4 col-md-4">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>you might like...</h5>
                            </div>
                            @foreach($random as $d)
                            <div class="product__sidebar__view__item set-bg" data-setbg="{{asset('storage/'.$d->cover)}}">
                                <h5><a href="{{route('detail-buku',$d->id_buku)}}" class="text-primary">{{$d->nama_buku}}</a></h5>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Anime Section End -->
@endsection