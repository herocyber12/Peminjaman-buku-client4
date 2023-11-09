<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Perpustakaan Widaya Kusuma">
    <meta name="keywords" content="education,public,html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anime | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('css/landing/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/plyr.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/landing/style.css')}}" type="text/css">
	<link href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    
    <style>
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

  <!-- Search model Begin -->
  <div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch"><i class="icon_close"></i></div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search model end -->

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
</script>
<?php 
    $a = route('guest.update');
    $l = route('kegiatan.simpan');
?>
<script>
    $(document).ready(function(){
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
                }
            });
        });

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
    });
</script>
</body>

</html>