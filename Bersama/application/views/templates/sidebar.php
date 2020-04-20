<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img class="" src="<?= base_url('assets/img/logo/Logo.png') ?>" width="50px">
        </div>
        <div class="sidebar-brand-text mx-3">SiLaper Media Jaya <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Administrator
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Profile
    </div>

    <li class="nav-item">
        <a class="nav-link" href="profile">
            <i class="far fa-fw fa-user"></i>
            <span>My Profile</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="profilepercetakan">
            <i class="fas fa-fw fa-home"></i>
            <span>Profile Percetakan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Katalog</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="kalender">Contoh Kalender</a>
                <a class="collapse-item" href="undangan">Contoh Undangan</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="calendar">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Calendar</span></a>

    <li class="nav-item">
        <a class="nav-link" href="datapemesanan">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Data Pemesanan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="laporanpemesanan">
            <i class="far fa-fw fas fa-file"></i>
            <span>Laporan Pemesanan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="inbox">
            <i class="fab fa-fw fa-whatsapp"></i>
            <span>Inbox</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">


    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->