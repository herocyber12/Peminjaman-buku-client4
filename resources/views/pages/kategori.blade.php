    @extends('layouts/users.app')
    @section('contents')
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        @foreach($kategori as $k)
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="section-title">
                                        <h4>{{$k->kategori}}</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="btn__all">
                                        <a href="{{route('detail-kategori',$k->kategori)}}" class="poc-btn text-black">View All <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5 pb-5">
                                <?php
                                $booksInCategory = false;
                                foreach ($data as $a) {
                                    if($a->status_buku === "Tersedia"){
                                        $bg = "success";
                                    } else if($a->status_buku === "Dipinjam"){
                                        $bg = "danger";
                                    }

                                    if ($a->id_kategori === $k->kategori) {
                                        $booksInCategory = true;
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
                                }
                                if (!$booksInCategory) {
                                    echo "<p>Belum ada buku pada kategori ini</p>";
                                }
                                ?>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
