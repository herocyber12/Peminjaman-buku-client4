<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-signin-client_id" content="328098397708-rc589apqeivagiq52o8pnm3gtov7kief.apps.googleusercontent.com.apps.googleusercontent.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/dashboard/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css">
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
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Keluar ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">                   
                        <button class="btn btn-secondary mr-3" type="button" data-dismiss="modal">Batal</button>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger" value="logout"><i class="fa fa-logout"></i>Keluar</button>
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
    <?php 
        $chartData = isset($chartData);
    ?>
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
    const editorElements = document.querySelectorAll('.editorEdit');
        var sinopsisData = {};

        editorElements.forEach(element => {
            const idBuku = element.dataset.idBuku;
            ClassicEditor
                .create(element)
                .then(editorEdit => {
                    // sinopsisData[idBuku] = sinopsisData[idBuku] || '';
                    editorEdit.setData(sinopsisData[idBuku]);

                    editorEdit.model.document.on('change:data', () => {
                        sinopsisData[idBuku] = editorEdit.getData();
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        });

        var sinopsis;
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then(editor => {
                sinopsis = editor;
            });
        // var sinopsis2;
        // ClassicEditor
        //     .create( document.querySelector( '.editorEdit' ) )
        //     .then(editor => {
        //         sinopsis2 = editor;
        //     });
    </script>
    <?php 
        $bukuSimpan = route('buku.simpan');
        $bukuEdit = route('buku.update',['id'=>':id']);
        $kategoriSimpan = route('kategori.simpan');
        $penggunaEdit = route('pengguna.update',['id'=>':id']);
        $reservasi = route('reservasi.update');
        $profil = route('udpate.profil');
        $l = route('kegiatan.simpan');
    ?>
    <script>
        $(document).ready(function(){
            
            const urlKegiatan = "{{$l}}";
            const urlProfil = "{{$profil}}";
            const url = "{{$bukuSimpan}}";
            const urlBukuEdit = "{{$bukuEdit}}";
            const urlPenggunaEdit = "{{$penggunaEdit}}";
            const urlKategoriSimpan = "{{$kategoriSimpan}}";
            const urlReservasi = "{{$reservasi}}";
            const urlChartss = "{{route('chart')}}";

            chartnyaPuh();

            function chartnyaPuh(){
                $.ajax({
                url:urlChartss,
                type: 'GET',
                success:function(e){
                    drawChart(e);
                }
            })
            
            function drawChart(chartData){
                 // Area Chart Example
                var labels = [];
                var data = [];          

                chartData.forEach(function(item){
                  labels.push(item.tanggal);
                  data.push(item.tanggal_data);
                });   

                var ctx = document.getElementById("myAreaChart");
                var myLineChart = new Chart(ctx, {
                  type: 'line',
                  data: {
                    labels: labels,
                    datasets: [{
                      label: "Pengunjung",
                      lineTension: 0.3,
                      backgroundColor: "rgba(78, 115, 223, 0.05)",
                      borderColor: "rgba(78, 115, 223, 1)",
                      pointRadius: 3,
                      pointBackgroundColor: "rgba(78, 115, 223, 1)",
                      pointBorderColor: "rgba(78, 115, 223, 1)",
                      pointHoverRadius: 3,
                      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                      pointHitRadius: 10,
                      pointBorderWidth: 2,
                      data:data,
                    }],
                  },
                  options: {
                    maintainAspectRatio: false,
                    layout: {
                      padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                      }
                    },
                    scales: {
                      xAxes: [{
                        time: {
                          unit: 'date'
                        },
                        gridLines: {
                          display: false,
                          drawBorder: false
                        },
                        ticks: {
                          maxTicksLimit: 7
                        }
                      }],
                      yAxes: [{
                        ticks: {
                          maxTicksLimit: 5,
                          padding: 10,
                          // Include a dollar sign in the ticks
                          callback: function(value, index, values) {
                            return number_format(value);
                          }
                        },
                        gridLines: {
                          color: "rgb(234, 236, 244)",
                          zeroLineColor: "rgb(234, 236, 244)",
                          drawBorder: false,
                          borderDash: [2],
                          zeroLineBorderDash: [2]
                        }
                      }],
                    },
                    legend: {
                      display: false
                    },
                    tooltips: {
                      backgroundColor: "rgb(255,255,255)",
                      bodyFontColor: "#858796",
                      titleMarginBottom: 10,
                      titleFontColor: '#6e707e',
                      titleFontSize: 14,
                      borderColor: '#dddfeb',
                      borderWidth: 1,
                      xPadding: 15,
                      yPadding: 15,
                      displayColors: false,
                      intersect: false,
                      mode: 'index',
                      caretPadding: 10,
                      callbacks: {
                        label: function(tooltipItem, chart) {
                          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                          return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                        }
                      }
                    }
                  }
                });
            }
            }
            $('#tambahBuku').on('click',function(){
                var fileupload = $('#gambarInput')[0].files;
                // var sinopsis = CKEditor.instances.editor.getData();
                
                var formData = new FormData();
                    formData.append('image', fileupload[0]);
                    formData.append('nama_buku', $('#nama_buku').val());
                    formData.append('penerbit', $('#penerbit').val());
                    formData.append('penulis', $('#penulis').val());
                    formData.append('tahun_terbit', $('#tahun_terbit').val());
                    formData.append('rak_buku', $('#rak_buku').val());
                    formData.append('kategori', $('#kategori').val());
                    formData.append('status_buku', $('#status_buku').val());
                    formData.append('jumlh_buku', $('#jumlh_buku').val());
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
            var urlHapus = "{{route('buku.hapus',['id'=>':id'])}}";
            
            $('.editBuku').on('click',function(){
                var id_buku = $(this).closest('.edit-modal').data('id-buku');
                var fileupload = $('#gambarInputEdit')[0].files;
                // var sinopsis = CKEditor.instances.editor.getData();
                var sinopsisDataBuku = sinopsisData[id_buku];
                var formData = new FormData();
                    formData.append('image', fileupload[0]);
                    formData.append('id_buku', id_buku);
                    formData.append('nama_buku', $('#nama_bukuEdit'+ id_buku).val());
                    formData.append('penerbit', $('#penerbitEdit'+ id_buku).val());
                    formData.append('penulis', $('#penulisEdit'+ id_buku).val());
                    formData.append('tahun_terbit', $('#tahun_terbitEdit'+ id_buku).val());
                    formData.append('rak_buku', $('#rak_bukuEdit'+ id_buku).val());
                    formData.append('kategori', $('#kategoriEdit'+ id_buku).val());
                    formData.append('status_buku', $('#status_bukuEdit'+ id_buku).val());
                    formData.append('jumlh_buku', $('#jumlh_bukuEdit'+ id_buku).val());
                    formData.append('sinopsisEdit', sinopsisDataBuku);
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

            $('.btn-reservasi').on('click', function () {
                var tombol = $(this).val();
                var id = $(this).closest('tr').find('.id_reservasi').val();

                // Simpan teks asli elemen <h5> ke dalam atribut data-title
                $('#konfirmasiModalLabel').data('title', 'Yakin hapus data ini ?');
                $('#konfirmasiButton').data('text', 'Hapus').data('id', id).data('tombol', tombol);
                $('#konfirmasiButton').removeClass('btn-success btn-warning btn-danger');

                if (tombol === 'setuju') {
                    // Jika tombol Setuju di-klik, ubah teks elemen <h5>
                    $('#konfirmasiModalLabel').text('Yakin ingin menyetujui data ini ?');
                    $('#konfirmasiButton').text('Setuju');

                    $('#konfirmasiButton').addClass('btn-success');
                } else if (tombol === 'tolak') {
                    // Jika tombol Tolak di-klik, ubah teks elemen <h5>
                    $('#konfirmasiModalLabel').text('Yakin ingin menolak data ini ?');
                    $('#konfirmasiButton').text('Tolak');
                    $('#konfirmasiButton').addClass('btn-warning');
                } else if (tombol === 'hapus') {
                    // Jika tombol Hapus di-klik, ubah teks elemen <h5>
                    $('#konfirmasiModalLabel').text('Yakin ingin menghapus data ini ?');
                    $('#konfirmasiButton').text('Hapus');
                    $('#konfirmasiButton').addClass('btn-danger');
                } else {
                    // Jika tombol lain di-klik, kembalikan teks elemen <h5> ke teks asli
                    $('#konfirmasiModalLabel').text($('#konfirmasiModalLabel').data('title'));
                    
                    $('#konfirmasiButton').text('Hapus');
                    $('#konfirmasiButton').addClass('btn-danger');
                }
            });
        
            // Tambahkan event listener untuk tombol Hapus di modal
            $('#konfirmasiButton').on('click', function () {
                var id = $(this).data('id');
                var tombol = $(this).data('tombol');
                // Lakukan penghapusan menggunakan AJAX di sini
                $.ajax({
                    url: urlReservasi,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tombol: tombol,
                        id: id
                    },
                    success: function (e) {
                        var title = e.header;
                        var text = e.text;
                        var icon = e.icon;
                        Swal.fire({
                            title: title,
                            text: text,
                            icon: icon
                        }).then(() => {
                            location.reload();
                        });
                    }
                });
                // Sembunyikan modal setelah penghapusan
                $('#konfirmasiModal').modal('hide');
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

            $('#uploadKegiatan').on('click',function(){
            var fileupload = $('#gambarInput')[0].files;
                // var sinopsis = CKEditor.instances.editor.getData();
                
            var formData = new FormData();
                formData.append('image', fileupload[0]);
                formData.append('nama_kegiatan', $('#nama_kegiatan').val());
                formData.append('_token', "{{ csrf_token() }}");
            
                $.ajax({
                    url:urlKegiatan,
                    type:"POST",
                    data:formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(e){
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
                    },
                });
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