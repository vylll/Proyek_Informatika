<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Lapangan Futsal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h2 class="mb-0 text-start">⚽ Pilihan Lapangan Futsal Terbaik</h2>
        </div>
        
        <div class="col-md-4 text-md-end text-start mt-3 mt-md-0">
            <a href="index.php?page=riwayat" class="btn btn-outline-secondary shadow-sm">
                📋 Riwayat Pemesanan
            </a>
        </div>
    </div>

    <div class="row">
        <?php foreach ($data_lapangan as $lapangan) : ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title fw-bold text-primary"><?= htmlspecialchars($lapangan['nama_lapangan']); ?></h5>
                            <p class="card-text text-muted mb-1">Ukuran: <?= htmlspecialchars($lapangan['ukuran']); ?></p>
                            <p class="card-text text-success"><strong>Rp <?= number_format($lapangan['harga_per_jam'], 0, ',', '.'); ?> / Jam</strong></p>
                        </div>
                        
                        <div class="mt-4">
                            <button type="button" class="btn btn-outline-secondary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $lapangan['id']; ?>">
                                🔍 Lihat Detail & Benefit
                            </button>
                            
                            <a href="index.php?page=sewa&id=<?= $lapangan['id']; ?>" class="btn btn-primary w-100">Sewa Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalDetail<?= $lapangan['id']; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h5 class="modal-title">Spesifikasi & Benefit - <?= htmlspecialchars($lapangan['nama_lapangan']); ?></h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
						  <div class="text-center">
                              <img src="assets/img/lapangan<?= $lapangan['id']; ?>.jpg" class="img-fluid rounded mb-3 shadow-sm" alt="Foto <?= htmlspecialchars($lapangan['nama_lapangan']); ?>">
                          </div>
                            <h6 class="fw-bold">📐 Deskripsi Fisik:</h6>
                            <ul>
                                <li><strong>Ukuran Standar:</strong> <?= htmlspecialchars($lapangan['ukuran']); ?></li>
                                <li><strong>Jenis Lantai:</strong> <?= $lapangan['id'] == 1 ? 'Matras Interlock Pro (Sangat Empuk & Anti Slip)' : ($lapangan['id'] == 2 ? 'Rumput Sintetis Monofilament (Mirip Lapangan Asli)' : 'Vinil Premium (Standar Turnamen Internasional)'); ?></li>
                            </ul>
                            
                            <h6 class="fw-bold mt-4">🎁 Benefit Sewa Terbuka:</h6>
                            <ul class="text-muted">
                                <li>Gratis peminjaman 2 buah Bola Futsal Specs Pro.</li>
                                <li>Gratis sewa 1 set Rompi Tim (10 Pcs).</li>
                                <li>Fasilitas ruang ganti AC & Shower Air Hangat.</li>
                                <li>Akses dispenser air minum gratis di pinggir lapangan.</li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <a href="index.php?page=sewa&id=<?= $lapangan['id']; ?>" class="btn btn-primary">Langsung Booking</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
