@extends('layouts/users.app')
@section('contents')

    <!-- Login Section Begin -->
    <section class="login spad">
        <div class="container px-auto py-auto">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="section-title">
                        <h4>Mode Pencarian Advanced</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="login__form">
                        <form action="{{route('advancedbuku')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                  <input type="text" name="nama_buku" class="form-control" id="inputEmail3" placeholder="Judul">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Penulis</label>
                                <div class="col-sm-10">
                                  <input type="text" name="penulis" class="form-control" id="inputEmail3" placeholder="Penulis">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Penerbit</label>
                                <div class="col-sm-10">
                                  <input type="text" name="penerbit" class="form-control" id="inputEmail3" placeholder="Penerbit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Tahun Terbit</label>
                                <div class="col-sm-10">
                                  <input type="number" name="tahun_terbit" class="form-control" id="inputEmail3" placeholder="Tahun Terbit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Status Buku</label>
                                <div class="col-xl-10">
                                <select class="form-control" name="status_buku" id="inputEmail3">
                                  <option value="">Status Buku</option>

                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Dipinjam">Dipinjam</option>
                                    <option value="Rusak">Rusak</option>
                                </select> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Status Buku</label>
                                <div class="col-xl-10">
                                <select class="form-control mb-3" name="kategori" id="kategori">
                                  <option value="">Pilih Kategori</option>
                                  @foreach($kategori as $a)
                                    <option value="{{ $a->kategori}}">{{$a->kategori}}</option>
                                  @endforeach
                                </select> 
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary col-xl-2"> <i class="icon_search"></i> Cari</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- Login Section End -->
@endsection