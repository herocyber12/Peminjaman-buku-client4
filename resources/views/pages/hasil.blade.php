    @extends('layouts/users.app')
    @section('contents')
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="section-title">
                                        <h4>Hasil Pencarian</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5 pb-5">
                                <?php
                                $books = false;
                                foreach ($data as $a) {
                                    if($a->status_buku === "Tersedia"){
                                        $bg = "success";
                                    } else if($a->status_buku === "Dipinjam"){
                                        $bg = "danger";
                                    }
                                    $books=true;
                                        ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6 mb-5 pb-5 col-xl-3">
                                            <div class="product__item" style="width: 230px; height: 325px;">
                                            <div class="product__item__pic set-bg" data-setbg="{{asset('storage/'.$a->cover)}}">
                                        <div class="st bg-{{$bg}}">{{$a->status_buku}}</div>
                                        <div class="comment"><i class="fa fa-comments"></i> {{
                                             $ulasanPerBuku[$a->id_buku]}}</div>
                                        <div class="view"><i class="fa fa-book"></i> {{$a->totalpeminjaman}}</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>{{$a->id_kategori}}</li>
                                        </ul>
                                        <h5><a href="{{url('detail-buku', $a->id_buku)}}">{{$a->nama_buku}}</a></h5>
                                    </div>
                                            </div>
                                        </div>
                                        <?php
                                    
                                }
                                ?>
                                @if (!$books)
                                    <div class="col-lg-12 col-md-6 col-sm-6 mb-5 pb-5 col-xl-12 card">
                                        <div class="card-body">
                                            <span class="mt-5"><center>Belum ada Buku atau Tidak ditemukan</center></span>
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
