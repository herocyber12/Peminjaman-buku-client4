<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{route('home')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Alat
</div>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{route('buku')}}">
        <i class="fas fa-fw fa-book"></i>
        <span>Buku</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('pengguna')}}">
        <i class="fas fa-fw fa-users"></i>
        <span>Pengguna</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('reservasi')}}">
        <i class="fas fa-fw fa-archive"></i>
        <span>Peminjaman</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('reservasi.riwayat')}}">
        <i class="fas fa-fw fa-history"></i>
        <span>Riwayat Peminjaman</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('tamu')}}">
        <i class="fas fa-fw fa-people"></i>
        <span>Tamu</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('kegiatan')}}">
        <i class="fas fa-fw fa-upload"></i>
        <span>Upload Kegiatan</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->