@extends('layouts/users.app')
@section('contents')

    <!-- Login Section Begin -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 text-center">
                    <form action="{{route('caribuku')}}">
                        @csrf
                        <img src="{{asset('img/1x/cari.png')}}" class="mb-3"> 
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="cari" placeholder="Cari Nama Buku" aria-label="Recipient's username" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"> <i class="icon_search"></i></button>
                            @php($advanced = route('advanced'))
                            <button class="btn btn-outline-secondary" onclick="window.location.href='{{$advanced}}'" type="button">Mode Advance</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->
@endsection