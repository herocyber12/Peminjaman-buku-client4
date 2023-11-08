<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/dashboard/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/dashboard/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
    	.image-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 378px; /* Lebar frame sesuai kebutuhan */
            height: 378px; /* Tinggi frame sesuai kebutuhan */
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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.dashboard.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.dashboard.navbar');
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('contents')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog dialog-modal-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yain Keluar ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">                   
                        <button class="btn btn-secondary mr-3" type="button" data-dismiss="modal">Cancel</button>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger" value="logout"><i class="fa fa-logout"></i>Logout</button>
                        </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/dashboard/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/dashboard/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/dashboard/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/dashboard/demo/chart-pie-demo.js')}}"></script>
    <script>
      // Ambil semua elemen menu di dalam sidebar
      const sidebarMenuItems = document.querySelectorAll('.navbar-nav .nav-item');

      // Tambahkan event listener ke setiap elemen menu
      sidebarMenuItems.forEach((menuItem) => {
        menuItem.addEventListener('click', function () {
          // Hapus kelas "active" dari semua elemen menu
          sidebarMenuItems.forEach((item) => {
            item.classList.remove('active');
          });

          // Tambahkan kelas "active" ke elemen yang baru diklik
          menuItem.classList.add('active');
        });
      });
    </script>
<script>
        var sinopsis;
        var sinopsis2;
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then(editor => {
                sinopsis = editor;
            })
        
        ClassicEditor
            .create( document.querySelector( '.editorEdit' ) )
            .then(editorEdit => {
                sinopsis2 = editorEdit;
            })
    </script>
    <?php 
        $bukuSimpan = route('buku.simpan');
        $bukuEdit = route('buku.update',['id'=>':id']);
        $kategoriSimpan = route('kategori.simpan');
        $penggunaEdit = route('pengguna.update',['id'=>':id']);
        $reservasi = route('reservasi.update',['id'=>':id']);
        $profil = route('udpate.profil');
    ?>
    <script>
        $(document).ready(function(){
            const urlProfil = "{{$profil}}";
            const url = "{{$bukuSimpan}}";
            const urlBukuEdit = "{{$bukuEdit}}";
            const urlPenggunaEdit = "{{$penggunaEdit}}";
            const urlKategoriSimpan = "{{$kategoriSimpan}}";
            const urlReservasi = "{{$reservasi}}";

            $('#tambahBuku').on('click',function(){
                var fileupload = $('#gambarInput')[0].files;
                // var sinopsis = CKEditor.instances.editor.getData();
                
                var formData = new FormData();
                    formData.append('image', fileupload[0]);
                    formData.append('nama_buku', $('#nama_buku').val());
                    formData.append('penerbit', $('#penerbit').val());
                    formData.append('penulis', $('#penulis').val());
                    formData.append('tahun_terbit', $('#tahun_terbit').val());
                    formData.append('kategori', $('#kategori').val());
                    formData.append('sinopsis', sinopsis.getData());
                    formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url:url,
                    type:'POST',
                    data:formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(e){
                        var title = e.act;
                        var text = e.message;
                        var icon = e.header;
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
                       console.log("Gagal: " + xhr.status + " - " + error);
                    }                    
                });
            });
            var urlHapus = "{{route('buku.hapus',['id'=>':id'])}}"
            $('#editBuku').on('click',function(){
                var id_buku = $('#id_buku').val();
                var fileupload = $('#gambarInputEdit')[0].files;
                // var sinopsis = CKEditor.instances.editor.getData();
                
                var formData = new FormData();
                    formData.append('image', fileupload[0]);
                    formData.append('id_buku', id_buku);
                    formData.append('nama_buku', $('#nama_bukuEdit').val());
                    formData.append('penerbit', $('#penerbitEdit').val());
                    formData.append('penulis', $('#penulisEdit').val());
                    formData.append('tahun_terbit', $('#tahun_terbitEdit').val());
                    formData.append('kategori', $('#kategoriEdit').val());
                    formData.append('sinopsisEdit', sinopsis2.getData());
                    formData.append('_token', "{{ csrf_token() }}");

                    var urlFinal = urlBukuEdit.replace(':id',id_buku);
                $.ajax({
                    url:urlFinal,
                    type:'POST',

                    data:formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(e) {
                        var title = e.act;
                        var text = e.message;
                        var icon = e.header;
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
            });
            $('#editPengguna').on('click',function(){
                var id_profil = $('#id_profil').val();
                var fileupload = $('#gambarInput')[0].files;
                // var sinopsis = CKEditor.instances.editor.getData();
                var formData = new FormData();
                    formData.append('image', fileupload[0]);
                    formData.append('id_profil', id_profil);
                    formData.append('nama', $('#nama').val());
                    formData.append('alamat', $('#alamat').val());
                    formData.append('no_hp', $('#no_hp').val());
                    formData.append('_token', "{{ csrf_token() }}");

                    var urlFinal = urlPenggunaEdit.replace(':id',id_profil);
                $.ajax({
                    url:urlFinal,
                    type:'POST',

                    data:formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(e) {
                        var title = e.act;
                        var text = e.text;
                        var icon = e.header;
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
            });

            $('#buatKategori').on('click',function(){
                var data = {
                        _token: "{{ csrf_token() }}",
                        kategori: $('#input_kategori').val(),
                    }
                $.ajax({
                    url: urlKategoriSimpan,
                    method :"POST",
                    data:data,
                    success: function(e){
                        urlHapusKat = "{{route('kategori.hapus',['id' => ':id'])}}";

                        Swal.fire(
                            e.header,
                            e.text,
                            e.icon
                        )
                        var html = "";
                        for(i=0; i<e.data.length;i++){
                            var urlFinal = url.replace('id',e.data[i].id_kategori);
                            html += '<tr>'+
                                        '<td>'+i+ '</td>'+
                                        '<td>'+e.data[i].kategori+'</td>'+
                                        '<td>'+ 
                                            '<div class="d-flex">' +
                                              '<a href= "' + urlFinal+'"class="btn btn-danger btn-sm m-2"><i class="fa fa-trash"></i> Hapus</a>' + 
                                            '</div>'+
                                        '</td>'+

                                    '</tr>';
                        }

                        $('#dataKategori').html(html);
                    }
                });
            });

            $('.btn-reservasi').on('click',function(){
                var tombol = $(this).val();
                var id = $('#id_reservasi').val();
                console.log(tombol);
                var urlFinal = urlReservasi.replace(':id',id);
                $.ajax({
                    url: urlFinal,
                    type:'POST',
                    data:{
                        _token: "{{ csrf_token() }}",
                        tombol:tombol,
                        id:id
                    },
                    success:function(e){
                        var title =e.header;
                        var text =e.text;
                        var icon =e.icon;
                        Swal.fire({
                            title:title,
                            text:text,
                            icon:icon
                        }).then(() => {
                            location.reload();
                        });
                    }
                })
            });

            var isEditable = false;
            
            $('#editButton').click(function() {
                if (isEditable) {
                    $('.form-control').prop('readonly', true);
                    isEditable = false;
                    $(this).text('Edit');
                    $(this).val('Edit');
                } else {
                    $('.form-control').prop('readonly', false);
                    isEditable = true;
                    $(this).text('Selesai');
                    $(this).val('Kirim'); 
                }
            });
            
            $('#editButton').on('click', function (){
                var simpanButton = $(this).val();
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

                if(simpanButton === "Edit"){
                    $.ajax({
                        url: urlProfil,
                        type:'POST',
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
                                    // location.reload();
                                });
                            } else if(e.stats === "gagal") {
                                    Swal.fire({
                                    title:title,
                                    text:text,
                                    icon:icon
                                }).then(() => {
                                    // location.reload();
                                });
                            }
                        }
                    });
                } else {
                    console.log("Eror");
                }
            });

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

         var inputEdit = document.getElementById('gambarInputEdit');
        var previewEdit = document.getElementById('gambarPreviewEdit');
        inputEdit.addEventListener('change', function() {
            var fileEdit = inputEdit.files[0];
            if (fileEdit) {
                var urlEdit = URL.createObjectURL(fileEdit);
                previewEdit.src = urlEdit;
                previewEdit.style.display = 'block';
            }
        });
    </script>
</body>

</html>