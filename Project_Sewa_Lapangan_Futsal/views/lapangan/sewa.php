<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Sewa Lapangan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<!-- --- METODE PEMBAYARAN --- -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Form Pemesanan & Pembayaran</h4>
                </div>
                <div class="card-body">
                    
                    <div class="alert alert-info py-2 mb-4">
                        <small class="text-muted d-block">Lapangan Dipilih:</small>
                        <strong class="text-dark"><?= htmlspecialchars($nama_lapangan); ?></strong>
                        <span class="badge bg-secondary float-end">Rp <?= number_format($harga_per_jam, 0, ',', '.'); ?> / Jam</span>
                    </div>

                    <form action="index.php?page=proses_sewa" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id_lapangan" value="<?= htmlspecialchars($id_lapangan); ?>">

                        <div class="mb-3">
                            <label class="form-label">Nama Pemesan</label>
                            <input type="text" name="nama_pemesan" class="form-control" placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Sewa</label>
                            <input type="date" name="tanggal_sewa" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jam Mulai</label>
                                <input type="time" name="jam_mulai" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Durasi (Jam)</label>
                                <input type="number" id="durasiJam" name="durasi_jam" class="form-control" min="1" max="12" value="1" required>
                            </div>
                        </div>

                        <div class="card bg-dark text-white p-3 mb-4 text-center shadow-inner">
                            <small class="text-white-50 text-uppercase tracking-wider">Total Biaya Yang Harus Dibayar</small>
                            <h2 class="fw-bold text-warning my-1">Rp <span id="totalBiayaTeks"><?= number_format($harga_per_jam, 0, ',', '.'); ?></span></h2>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="jenis_pembayaran" id="pilihanBayar" class="form-select" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="QRIS">QRIS (Otomatis)</option>
                                <option value="Transfer Bank">Transfer Bank (Manual)</option>
                            </select>
                        </div>

                        <div id="kotakQris" class="mb-3 d-none text-center p-3 border rounded bg-white shadow-sm">
                            <label class="form-label d-block fw-bold text-success">📱 Silakan Scan QRIS di Bawah Ini:</label>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=FutsalHub_Payment" class="img-fluid my-2" alt="Kode QRIS Pembayaran" style="max-width: 200px;">
                            <div class="form-text text-danger fw-bold">Pastikan nominal transfer sesuai dengan total harga sewa!</div>
                        </div>

                        <div id="kotakTransfer" class="mb-3 d-none p-3 border rounded bg-white shadow-sm">
                            <label class="form-label d-block fw-bold text-primary">🏦 Informasi Rekening Transfer:</label>
                            <div class="card bg-light border-0 p-3 mb-2">
                                <p class="mb-1 text-muted small">Nama Bank:</p>
                                <h6 class="fw-bold mb-2">Bank Central Asia (BCA)</h6>
                                <p class="mb-1 text-muted small">Nomor Rekening:</p>
                                <h5 class="fw-bold text-dark mb-2">872-0948-231</h5>
                                <p class="mb-1 text-muted small">Atas Nama:</p>
                                <h6 class="fw-bold text-uppercase mb-0">FutsalHub Indonesia</h6>
                            </div>
                            <div class="form-text text-danger fw-bold text-center">Simpan bukti transfer kertas/m-banking kamu untuk diunggah di bawah!</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Unggah Bukti Transfer / QRIS (Foto)</label>
                            <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*" required>
                            <div class="form-text text-muted">Format: JPG, JPEG, atau PNG. Max 2MB.</div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="index.php?page=lapangan" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success">Konfirmasi & Bayar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Ambil harga dasar lapangan dari variabel PHP
    const hargaPerJam = <?= $harga_per_jam; ?>;
    
    const durasiJamInput = document.getElementById('durasiJam');
    const totalBiayaTeks = document.getElementById('totalBiayaTeks');
    
    const pilihanBayar = document.getElementById('pilihanBayar');
    const kotakQris = document.getElementById('kotakQris');
    const kotakTransfer = document.getElementById('kotakTransfer');

    // --- LOGIKA 1: KALKULATOR HARGA LIVE ---
    durasiJamInput.addEventListener('input', function() {
        let durasi = parseInt(this.value);
        
        // Jaga-jaga kalau user mengosongkan input atau mengetik angka di bawah 1
        if (isNaN(durasi) || durasi < 1) {
            durasi = 1;
        }
        
        // Rumus matematika yang kamu inginkan: durasi x harga lapangan
        let total = durasi * hargaPerJam;
        
        // Tampilkan ke layar dengan format ribuan indonesia
        totalBiayaTeks.innerText = total.toLocaleString('id-ID');
    });

    // --- LOGIKA 2: DETEKSI DROPDOWN PEMBAYARAN ---
    pilihanBayar.addEventListener('change', function() {
        if (this.value === 'QRIS') {
            kotakQris.classList.remove('d-none');
            kotakTransfer.classList.add('d-none');
        } else if (this.value === 'Transfer Bank') {
            kotakTransfer.classList.remove('d-none');
            kotakQris.clZassList.add('d-none');
        } else {
            kotakQris.classList.add('d-none');
            kotakTransfer.classList.add('d-none');
        }
    });
</script>
</body>
</html>
