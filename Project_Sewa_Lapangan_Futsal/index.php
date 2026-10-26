<?php
// --- BARIS CRITICAL: Inisialisasi variabel $page agar tidak Undefined ---
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Futsal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">⚽ FutsalHub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'home' ? 'active fw-bold' : '' ?>" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'lapangan' ? 'active fw-bold' : '' ?>" href="index.php?page=lapangan">Lihat Lapangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'jadwal' ? 'active fw-bold' : '' ?>" href="index.php?page=jadwal">Jadwal Lapangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'riwayat' ? 'active fw-bold' : '' ?>" href="index.php?page=riwayat">Riwayat Transaksi (Admin)</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="py-2">
<?php
if ($page == 'lapangan') {
    require_once 'app/controllers/LapanganControllers.php';
    $controller = new LapanganController();
    $controller->index();
} else if ($page == 'sewa') {
    require_once 'app/controllers/LapanganControllers.php';
    $controller = new LapanganController();
    $controller->formSewa();
} else if ($page == 'proses_sewa') {
    require_once 'app/controllers/LapanganControllers.php';
    $controller = new LapanganController();
    $controller->prosesSewa();
} else if ($page == 'jadwal') {
    require_once 'app/controllers/LapanganControllers.php';
    $controller = new LapanganController();
    $controller->jadwalPublic();
} else if ($page == 'riwayat') {
    require_once 'app/controllers/LapanganControllers.php';
    $controller = new LapanganController();
    $controller->riwayatSewa();
} else {
    require_once 'views/lapangan/home.php';
}
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
