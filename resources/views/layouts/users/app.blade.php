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
<script src="{{asset('js/landing/player.js')}}"></script>
<script src="{{asset('js/landing/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('js/landing/mixitup.min.js')}}"></script>
<script src="{{asset('js/landing/jquery.slicknav.js')}}"></script>
<script src="{{asset('js/landing/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/landing/main.js')}}"></script>


</body>

</html>