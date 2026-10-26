<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beranda - Platform Futsal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1575361204480-aadea25e6e68?q=80&w=1200') no-repeat center center/cover;
            color: white;
            padding: 100px 0;
        }
    </style>
</head>
<body class="bg-light">

<!-- 🚀 HERO SECTION (Bagian Atas yang Estetik) -->
<div class="position-relative overflow-hidden p-5 text-center bg-dark text-white shadow-sm" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.85)), url('https://images.unsplash.com/photo-1575361204480-aadea25e6e68?q=80&w=1200') no-repeat center center; background-size: cover; border-radius: 0 0 2rem 2rem;">
    <div class="col-md-8 p-lg-5 mx-auto my-5">
        <span class="badge bg-success px-3 py-2 rounded-pill text-uppercase font-monospace mb-3">Premium Futsal Arena</span>
        <h1 class="display-3 fw-extrabold mb-3">Pesan Lapangan Tanpa Ribet Hanya Di <span class="text-success">FutsalHub</span></h1>
        <p class="lead fw-normal text-muted-light mb-4">Pesan Lapangan Mu Sekarang!</p>
        
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
            <a class="btn btn-success btn-lg px-4 gap-3 fw-bold shadow" href="index.php?page=lapangan">⚽ Pesan Lapangan</a>
            <a class="btn btn-outline-light btn-lg px-4" href="index.php?page=jadwal">🗓️ Lihat Jadwal Publik</a>
        </div>
    </div>
</div>

<!-- 🏆 FEATURES SECTION (Keunggulan Fasilitas) -->
<div class="container my-5 py-4">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">Mengapa Harus Booking di FutsalHub?</h2>
        <p class="text-muted">Kami menyediakan fasilitas terbaik untuk kenyamanan pertandingan tim kamu.</p>
    </div>

    <div class="row g-4">
        <!-- Fasilitas 1 -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4 text-center rounded-4 hover-translate">
                <div class="icon-square bg-success-subtle text-success mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 50%;">
                    <span class="fs-3">🌱</span>
                </div>
                <h5 class="fw-bold text-dark">Rumput & Vinil Premium</h5>
                <p class="text-muted small">Pilihan Lapangan Rumput Sintetis Interlock dan Vinil standar internasional yang empuk dan anti-slip demi mengurangi risiko cedera.</p>
            </div>
        </div>

        <!-- Fasilitas 2 -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4 text-center rounded-4 hover-translate">
                <div class="icon-square bg-primary-subtle text-primary mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 50%;">
                    <span class="fs-3">⚡</span>
                </div>
                <h5 class="fw-bold text-dark">Konfirmasi Instan</h5>
                <p class="text-muted small">Sistem pembayaran gampang menggunakan QRIS atau Transfer Bank otomatis. Cukup upload struk dan jadwal tanding langsung aman.</p>
            </div>
        </div>

        <!-- Fasilitas 3 -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4 text-center rounded-4 hover-translate">
                <div class="icon-square bg-warning-subtle text-warning mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 50%;">
                    <span class="fs-3">💡</span>
                </div>
                <h5 class="fw-bold text-dark">Pencahayaan LED Terang</h5>
                <p class="text-muted small">Sistem pencahayaan stadium super terang di malam hari, membuat atmosfir mabar malam hari terasa seperti liga profesional.</p>
            </div>
        </div>
    </div>
</div>

<!-- 🏟️ CTA (Call to Action) BANNER -->
<div class="container mb-5">
    <div class="bg-dark text-white p-5 rounded-5 shadow d-flex flex-column flex-md-row align-items-center justify-content-between gap-4" style="background: linear-gradient(135deg, #111 0%, #1c3d27 100%);">
        <div>
            <h3 class="fw-bold mb-2">Sudah Siap Menguasai Lapangan?</h3>
            <p class="text-muted mb-0">Jangan biarkan slot jam emas tim rival mengambil waktu mabar favorit tim kamu.</p>
        </div>
        <a href="index.php?page=lapangan" class="btn btn-success btn-lg px-4 fw-bold rounded-pill text-nowrap shadow-sm">Gas Booking Sekarang! 🚀</a>
    </div>
</div>

<!-- 🎨 Tambahan Style CSS Khusus Efek Animasi Mini -->
<style>
    .fw-extrabold { font-weight: 800; }
    .text-muted-light { color: #rgba(255,255,255,0.7) !important; }
    .hover-translate {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-translate:hover {
        transform: translateY(-8px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,0.1) !important;
    }
    .bg-success-subtle { background-color: #d1e7dd; }
    .bg-primary-subtle { background-color: #cfe2ff; }
    .bg-warning-subtle { background-color: #fff3cd; }
</style>
</body>
</html>

