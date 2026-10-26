<div class="container mt-5">
    <h2>💼 Riwayat Transaksi Masuk (Panel Admin)</h2>
    <p class="text-muted">Gunakan halaman ini untuk memvalidasi uang transfer dan QRIS dari user.</p>

    <div class="card shadow border-0 mt-4">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Nama Pemesan</th>
                        <th>Lapangan</th>
                        <th>Tanggal Sewa</th>
                        <th>Jam & Durasi</th>
                        <th>Metode</th>
                        <th>Bukti Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data_pesanan)) : ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada transaksi masuk.</td></tr>
                    <?php else : ?>
                        <?php $no = 1; foreach ($data_pesanan as $pesanan) : ?>
                            <tr>
                                <td class="ps-3"><?= $no++; ?></td>
                                <td class="fw-bold"><?= htmlspecialchars($pesanan['nama_pemesan']); ?></td>
                                <td><?= htmlspecialchars($pesanan['nama_lapangan']); ?></td>
                                <td><?= htmlspecialchars($pesanan['tanggal_sewa']); ?></td>
                                <td><?= date('H:i', strtotime($pesanan['jam_mulai'])); ?> WIB (<?= $pesanan['durasi_jam']; ?> Jam)</td>
                                <td><span class="badge <?= $pesanan['jenis_pembayaran'] == 'QRIS' ? 'bg-success' : 'bg-primary' ?>"><?= $pesanan['jenis_pembayaran']; ?></span></td>
                                <td>
                                    <?php if (!empty($pesanan['bukti_pembayaran'])) : ?>
                                        <a href="assets/uploads/<?= $pesanan['bukti_pembayaran']; ?>" target="_blank" class="btn btn-sm btn-outline-dark">🖼️ Lihat Struk</a>
                                    <?php else : ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

