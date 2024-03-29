<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="google-signin-client_id" content="328098397708-rc589apqeivagiq52o8pnm3gtov7kief.apps.googleusercontent.com.apps.googleusercontent.com">
    <meta name="description" content="Selamat datang di Perpustakaan Widaya Kusuma, tempat peminjaman buku terbaik untuk mengeksplorasi pengetahuan. Nikmati koleksi buku yang kaya dan beragam. Bergabunglah dengan komunitas membaca kami!">
    <meta name="keywords" content="Peminjaman Buku, Perpustakaan Widaya Kusuma, Literasi dan Pendidikan, Koleksi Buku Terbaru, Komunitas Membaca, Sumber Bacaan Berkualitas, Pengetahuan dan Pembelajaran, Bacaan untuk Semua Usia, Katalog Buku Online, Pengembangan Diri melalui Buku">
    <meta name="author" content="oneprocyber.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perpustakaan Widaya Kusuma</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('css/landing/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/plyr.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/style.css')}}" type="text/css">
	<link href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    
    <style>
    @font-face {
    	font-family: 'ElegantIcons';
    	src:url('https://democl4.oneprocyber.com/public/fonts/ElegantIcons.eot');
    	src:url('https://democl4.oneprocyber.com/public/fonts/ElegantIcons.eot?#iefix') format('embedded-opentype'),
    		url('https://democl4.oneprocyber.com/public/fonts/ElegantIcons.woff') format('woff'),
    		url('https://democl4.oneprocyber.com/public/fonts/ElegantIcons.ttf') format('truetype'),
    		url('https://democl4.oneprocyber.com/public/fonts/ElegantIcons.svg#ElegantIcons') format('svg');
    	font-weight: normal;
    	font-style: normal;
    }

    @font-face {
  font-family: "FontAwesome";
  src: url("https://tunasndorenan.my.id/public//fonts/fontawesome-webfont.eot?v=4.7.0");
  src: url("https://tunasndorenan.my.id/public//fonts/fontawesome-webfont.eot?#iefix&v=4.7.0")
      format("embedded-opentype"),
    url("https://tunasndorenan.my.id/public//fonts/fontawesome-webfont.woff2?v=4.7.0") format("woff2"),
    url("https://tunasndorenan.my.id/public//fonts/fontawesome-webfont.woff?v=4.7.0") format("woff"),
    url("https://tunasndorenan.my.id/public//fonts/fontawesome-webfont.ttf?v=4.7.0") format("truetype"),
    url("https://tunasndorenan.my.id/public//fonts/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular")
      format("svg");
  font-weight: normal;
  font-style: normal;
}
    	.image-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 200px; /* Lebar frame sesuai kebutuhan */
            height: 200px; /* Tinggi frame sesuai kebutuhan */
        }
        #gambarInput {
            opacity: 0;
        }
        #gambarInputEdit {
            opacity: 0;
        }
        .btn-choose {
			position: absolute;
        	opacity: 0.15; /* Set opacity awal ketika tidak ada kursor di atasnya */
        	transition: opacity 0.2s; /* Efek transisi ketika opacity berubah */
    	}
    	.btn-choose:hover {
    	    opacity: 1; /* Set opacity saat kursor di atasnya */
    	}
	
        #gambarPreview {
            max-width: 100%;
            display: block;
        }
        #gambarPreviewEdit {
            max-width: 100%;
            display: block;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    @include('layouts.users.navbar')
    <!-- Header End -->

    @yield('contents')

    <!-- Footer Section Begin -->
    @include('layouts.users.footer')
    <!-- Footer Section End -->

<!-- Js Plugins -->
<script src="{{asset('js/landing/jquery-3.3.1.min.js')}}"></script>
<!-- <script src="https://code.jquery.com/jquery-migrate-3.4.1.js" integrity="sha256-CfQXwuZDtzbBnpa5nhZmga8QAumxkrhOToWweU52T38=" crossorigin="anonymous"></script> -->
<script src="{{asset('js/landing/bootstrap.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/landing/player.js')}}"></script>
<script src="{{asset('js/landing/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('js/landing/mixitup.min.js')}}"></script>
<script src="{{asset('js/landing/jquery.slicknav.js')}}"></script>
<script src="{{asset('js/landing/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/landing/main.js')}}"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<?php 
    $a = route('guest.update');
    $l = route('kegiatan.simpan');
?>
<script>
    $(document).ready(function(){
        var delayTime = 3000;

        setTimeout(function (){
            $('#landingTamu').modal('show');
        },delayTime);

        var liso;

            $("#password, #confirmation").on("input", function() {
                var password = $("#password").val();
                var confirmation = $("#confirmation").val();
                var passwordMatchStatus = $("#passwordMatchStatus");
                if (password === "" && confirmation === "") {
                    passwordMatchStatus.text(""); // Kosongkan pesan jika kedua input kosong
                    passwordMatchStatus.removeClass(); // Kosongkan pesan jika kedua input kosong
                } else if (password === confirmation) {
                    liso = "cocok";
                    passwordMatchStatus.text("Password cocok");
                    passwordMatchStatus.removeClass('alert alert-danger');
                    passwordMatchStatus.addClass('alert alert-success');
                } else {
                    liso = "tidak cocok";
                    passwordMatchStatus.text("Password tidak cocok. Silakan periksa kembali.");
                    passwordMatchStatus.removeClass('alert alert-success');
                    passwordMatchStatus.addClass('alert alert-danger');
                }
            });
        
        const urlUpdate = "{{$a}}";
        const urlKegiatan = "{{$l}}";
        $('#ubahGuestProfil').on('click',function(){
            var fileupload = $('#gambarInput')[0].files;
                // var sinopsis = CKEditor.instances.editor.getData();
                
            var formData = new FormData();
                formData.append('image', fileupload[0]);
                formData.append('nama', $('#nama').val());
                formData.append('alamat', $('#alamat').val());
                formData.append('no_hp', $('#no_hp').val());
                formData.append('email', $('#email').val());
                formData.append('username', $('#username').val());
                formData.append('_token', "{{ csrf_token() }}");

            $.ajax({
                url:urlUpdate,
                type:"POST",
                data:formData,
                cache: false,
                contentType: false,
                processData: false,
                success:function(e){
                    var title =e.title;
                    var text =e.text;
                    var icon =e.icon;
                    if(e.stats === "berhasil"){
                        Swal.fire({
                            title:title,
                            text:text,
                            icon:icon
                        }).then(() => {
                            location.reload();
                        });
                    } else if(e.stats === "gagal") {
                            Swal.fire({
                            title:title,
                            text:text,
                            icon:icon
                        }).then(() => {
                            location.reload();
                        });
                    }
                },error: function (xhr, status, error) {
                       console.log("Gagal: " + xhr.status + " - " + error);
                    }      
            });
        });

        var urlTamu = "{{route('tamu-form')}}";

        $('#absen').on('click',function(){
            var namaTamu = $('#namaTamu').val();
            var asalTamu = $('#asalTamu').val();
            var tujuanTamu = $('#tujuanTamu').val();
            var data = {
                _token : "{{csrf_token()}}",
                nama:namaTamu,
                asal:asalTamu,
                tujuan:tujuanTamu
            }
            $.ajax({
                url: urlTamu,
                type: 'POST',
                data:data,
                success:function(e){
                    if(e.stats === "Berhasil")
                    {
                        alert('Silahkan Lanjut Mengunjungi Perpustakaan Widya Kusuma');
                        $('#landingTamu').modal('hide');
                    }
                }
                
            });
        })

        $("#password, #confirmation").on("input", function() {
                var password = $("#password").val();
                var confirmation = $("#confirmation").val();
                var passwordMatchStatus = $("#passwordMatchStatus");
                if (password === "" && confirmation === "") {
                    passwordMatchStatus.text(""); // Kosongkan pesan jika kedua input kosong
                    passwordMatchStatus.removeClass(); // Kosongkan pesan jika kedua input kosong
                } else if (password === confirmation) {
                    liso = "cocok";
                    passwordMatchStatus.text("Password cocok");
                    passwordMatchStatus.removeClass('alert alert-danger');
                    passwordMatchStatus.addClass('alert alert-success');
                } else {
                    liso = "tidak cocok";
                    passwordMatchStatus.text("Password tidak cocok. Silakan periksa kembali.");
                    passwordMatchStatus.removeClass('alert alert-success');
                    passwordMatchStatus.addClass('alert alert-danger');
                }
        });
        var gantiPassword = "{{route('passwordchange')}}";

        $('#ubahSandi').on('click',function(){
            var oldPassword = $('#oldPassword').val();
            var newPassword = $('#password').val();
            var data = {
                _token : "{{csrf_token()}}",
                oldPassword : oldPassword,
                newPassword : newPassword
            };
            if(liso === "cocok"){
                $.ajax({
                    url:gantiPassword,
                    type: 'POST',
                    data: data,
                    success: function (e){
                        var title = e.title;
                        var text = e.text;
                        var icon = e.icon;
                        Swal.fire({
                            title: title,
                            text: text,
                            icon: icon,
                        }).then((result)=> {
                            if (result) {
                                location.reload();
                            }
                        });
                    },error: function (xhr, status, error) {
                      Swal.fire(
                        'error',
                        xhr.status,
                        error,
                      );
                    }  
                });
            }
        });

        var gantiPassword = "{{route('passwordchange')}}";

            $('#ubahSandi').on('click',function(){
                var oldPassword = $('#oldPassword').val();
                var newPassword = $('#password').val();

                var data = {
                    _token : "{{csrf_token()}}",
                    oldPassword : oldPassword,
                    newPassword : newPassword
                };

                if(liso === "cocok"){
                    $.ajax({
                        url:gantiPassword,
                        type: 'POST',
                        data: data,
                        success: function (e){
                            var title = e.title;
                            var text = e.text;
                            var icon = e.icon;
                            Swal.fire({
                                title: title,
                                text: text,
                                icon: icon,
                            }).then((result)=> {
                                if (result) {
                                    location.reload();
                                }
                            });
                        },error: function (xhr, status, error) {
                          Swal.fire(
                            'error',
                            xhr.status,
                            error,
                          );
                        }  
                    });
                }
            });
    });
</script>
<script>
    
	new DataTable('#example');
    var input = document.getElementById('gambarInput');
    var preview = document.getElementById('gambarPreview');
    input.addEventListener('change', function() {
        var file = input.files[0];
        if (file) {
            var url = URL.createObjectURL(file);
            preview.src = url;
            preview.style.display = 'block';
        }
    });

    function togglepassword1(){
          const passwordInput = document.getElementById('password');
          const classPassword = document.getElementById('iconnya1');
          if(passwordInput.type === "password"){
            passwordInput.type = "text";
            classPassword.className = "fa fa-eye-slash";
          } else {
            passwordInput.type = "password";
            classPassword.className = "fa fa-eye";
            }
        }
    function togglepassword2(){
        const passwordInput = document.getElementById('confirmation');
        const classPassword = document.getElementById('iconnya2');
        if(passwordInput.type === "password"){
        passwordInput.type = "text";
        classPassword.className = "fa fa-eye-slash";
        } else {
        passwordInput.type = "password";
        classPassword.className = "fa fa-eye";
        }
    }
    function togglepassword3(){
        const passwordInput = document.getElementById('oldPassword');
        const classPassword = document.getElementById('iconnya3');
        if(passwordInput.type === "password"){
        passwordInput.type = "text";
        classPassword.className = "fa fa-eye-slash";
        } else {
        passwordInput.type = "password";
        classPassword.className = "fa fa-eye";
        }
    }
</script>
</body>

</html>