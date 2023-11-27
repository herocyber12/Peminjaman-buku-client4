<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Buat Akun | Perpustakaan Widaya Kusuma</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('css/dashboard/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/dashboard/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        .bg-cover {
    position: relative;
}

.bg-cover::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.8); /* Warna hitam dengan opasitas 10% */
    z-index: 0; /* Atur z-index sesuai kebutuhan Anda */
}

.bg-cover {
    background-color: #4e73df;
    background-image: url("{{asset('img/bg-login.jpg')}}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
}

    body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
    }
    .card {
    position: relative;
    z-index: 1; /* Atur z-index sesuai kebutuhan Anda, harus lebih tinggi dari pseudo-elemen ::before */
}
    </style>
</head>

<body class="bg-cover">
    <div class="container">
	<div class="col-xl-7 col-md-8 ml-auto mr-auto">
		
        <div class="card o-hidden border-0 shadow-lg my-5 ml-auto mr-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun</h1>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{route('create')}}" method="POST" class="user">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="nama" class="form-control form-control-user" id=""
                                        placeholder="Nama Anda">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="alamat" class="form-control form-control-user" id=""
                                        placeholder="Alamat">
                                </div>
                                <div class="form-group">
                                    <input type="number" name="no_hp" class="form-control form-control-user" id=""
                                        placeholder="Nomor Wa AKtif">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" id=""
                                        placeholder="E-mail anda">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Username">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Masukan Kata Sandi">
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                    Buat Akun
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Lupa Kata Sandi?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{route('login')}}">Sudah Punya? Masuk!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/dashboard/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/dashboard/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/dashboard/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/dashboard/sb-admin-2.min.js')}}"></script>
    <script>
$(document).ready(function () {
  $('#a').toast('show');
});


    </script>

</body>

</html>