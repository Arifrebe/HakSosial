<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= defined('WEBNAME') ? WEBNAME : 'Website' ?> | <?= $title ?? 'Not defined' ?></title>
    
    <!-- Font awesome 6.7.2 -->
    <link rel="stylesheet" href="<?= asset('fontawesome-6.7.2/css/all.min.css') ?>">
    <!-- Bootstrap 5.2.3 -->
    <link rel="stylesheet" type="text/css" href="<?= asset('bootstrap-5.2.3/css/bootstrap.min.css') ?>">
    <!-- Costum css -->
    <link rel="stylesheet" href="<?= asset('style.css') ?>">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm p-3">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand mb-0 h1" href="#"><?= defined('WEBNAME') ? WEBNAME : 'Website' ?></a>

            <!-- Search Bar -->
            <div class="search-bar mx-3">
                <input type="search" id="form1" class="form-control" placeholder="Cari produk" aria-label="Search" />
            </div>

            <!-- Navbar Toggler for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas Navbar -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?= defined('WEBNAME') ? WEBNAME : 'Website' ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav gap-1 ms-auto mb-2 mb-lg-0 align-items-start">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <?php if (!isset($_SESSION['user_id'])) { ?>
                                <a href="<?= url('auth/login') ?>" class="btn btn-primary btn-rounded">Login</a>
                            <?php }else { ?>
                                <div class="dropdown">
                                    <a class="btn btn-sm border dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="https://live.staticflickr.com/65535/49626939558_2308fc6b73_z.jpg" alt="User" class="rounded-circle me-2" style="width:30px; height:30px; object-fit:cover;">
                                        <span class="text-dark">John Doe</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end shadow">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="<?= url('auth/logout'); ?>"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                                    </ul>
                                </div>
                            <?php } ?>
                        </li>
                        <li class="nav-item" >
                            <a href="#" class="btn btn-outline-primary d-flex align-items-center gap-2">
                                <i class="fa-solid fa-bag-shopping"></i> <span>Keranjang</span> 
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<div class="container-fluid my-3">
