<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profil - {{$data->nama}}</title>

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/dashboard/fontawesome-free/css/dashboard/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/dashboard/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/dashboard/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
</head>

<body id="page-top"class="bg-info">

    <!-- Page Wrapper -->
    <div id="wrapper" >
        
		<div class="container py-5 mt-5">
			<div class="card card-body shadow">
				<h1>Profil Pengguna</h1>
				<hr>
			<div class="row p-4">
				<div class="col-xl-6 text-center mb-3">
					<img src="{{isset($data->foto) ? asset('storage/'.$data->foto) : asset('img/anime/review-0.jpg')}}" alt="alternative" style="border-radius: 5px;max-height: 100%;max-width: 100%;">
				</div>
				<div class="col-xl-6 d-flex flex-column">
					<table style="font-size: 24px;">
						<tr>
							<td>Nama</td>
							<td> : {{$data->nama}}</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td> : {{$data->alamat}}</td>
						</tr>
						<tr>
							<td>No HP</td>
							<td>: {{$data->no_hp}}</td>
						</tr>
						<tr>
							<td>E-mail</td>
							<td>: {{$data->email}}</td>
						</tr>
						<tr>
							<td>Level</td>
							<td>: {{$data->level}}</td>
						</tr>
					</table>
				</div>
			</div>
			</div>
		</div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/dashboard/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/dashboard/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/dashboard/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/dashboard/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/dashboard/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
	<script>
        // Ambil elemen input file
        var input = document.getElementById('gambarInput');
        // Ambil elemen gambar preview
        var preview = document.getElementById('gambarPreview');

        // Tambahkan event listener ketika input berubah
        input.addEventListener('change', function() {
            var file = input.files[0];
            if (file) {
                // Buat objek URL untuk gambar yang dipilih
                var url = URL.createObjectURL(file);
                // Set gambar preview dengan URL yang dibuat
                preview.src = url;
                preview.style.display = 'block'; // Tampilkan gambar
            }
        });
    </script>
	<script>
	$(document).ready(function() {
    var isEditable = false; // Mode awal non-edit

    // Event handler untuk tombol "Edit"
    $('#editButton').click(function() {
        if (isEditable) {
            // Jika sedang dalam mode edit, maka kembalikan semua input menjadi readonly
            $('.form-control').prop('readonly', true);
            isEditable = false;
            // Ubah teks tombol menjadi "Edit"
            $(this).text('Selesai');
            $(this).val('Kirim'); // Ubah nilai tombol menjadi "Kirim"
        } else {
            // Jika sedang dalam mode non-edit, maka hapus readonly dari semua input
            $('.form-control').prop('readonly', false);
            isEditable = true;
            // Ubah teks tombol menjadi "Selesai"
            $(this).text('Edit');
            $(this).val('Edit'); // Kembalikan nilai tombol menjadi "Edit"
        }
    });
});
</script>

</body>

</html>