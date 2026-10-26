<div class="container mt-5">
    <h2>📅 Jadwal Penggunaan Lapangan</h2>
    <p class="text-muted">Silakan cek jam yang tersedia sebelum melakukan pemesanan.</p>

    <div class="card shadow border-0 mt-4">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Hari & Tanggal</th>
                        <th>Waktu (Jam)</th>
                        <th>Nama Lapangan</th>
                        <th>Status Penggunaan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data_pesanan)) : ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Semua lapangan kosong!</td></tr>
                    <?php else : ?>
                        <?php foreach ($data_pesanan as $pesanan) : 
                            $timestamp = strtotime($pesanan['tanggal_sewa']);
                            $daftar_hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
                            $hari_indo = $daftar_hari[date('l', $timestamp)];
                            
                            $jam_mulai = date('H:i', strtotime($pesanan['jam_mulai']));
                            $jam_selesai = date('H:i', strtotime($pesanan['jam_mulai'] . " +" . $pesanan['durasi_jam'] . " hours"));
                        ?>
                            <tr>
                                <td class="ps-4"><strong><?= $hari_indo; ?></strong><br><small><?= date('d M Y', $timestamp); ?></small></td>
                                <td><span class="badge bg-light text-dark border p-2">⏰ <?= $jam_mulai; ?> - <?= $jam_selesai; ?> WIB</span></td>
                                <td><span class="fw-bold text-primary"><?= htmlspecialchars($pesanan['nama_lapangan']); ?></span></td>
                                <td><span class="spinner-grow spinner-grow-sm text-danger me-1"></span> <strong class="text-danger">TERPESAN</strong><br><small class="text-muted">Oleh: Team <?= htmlspecialchars($pesanan['nama_pemesan']); ?></small></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
