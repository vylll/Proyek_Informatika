<?php
class LapanganController {
    
    public function index() {
        require_once 'app/models/LapanganModel.php';
        $model = new LapanganModel();
        $data_lapangan = $model->getAllLapangan();

        require_once 'views/lapangan/index.php';
    }
	
    public function formSewa() {
        // Tangkap ID lapangan yang dikirim dari tombol "Sewa Sekarang"
        $id_lapangan = isset($_GET['id']) ? $_GET['id'] : 0;

        require_once 'app/models/LapanganModel.php';
        $model = new LapanganModel();
        
        // Ambil semua data lapangan berdasarkan ID (kita manfaatkan data yang ada)
        $data_lapangan = $model->getAllLapangan();
        
        // Cari lapangan yang ID-nya cocok untuk diambil harga per jam-nya
        $harga_per_jam = 0;
        $nama_lapangan = "";
        foreach ($data_lapangan as $lap) {
            if ($lap['id'] == $id_lapangan) {
                $harga_per_jam = $lap['harga_per_jam'];
                $nama_lapangan = $lap['nama_lapangan'];
                break;
            }
        }

        // Panggil file tampilan form sewa (sekarang sudah membawa variabel $harga_per_jam dan $nama_lapangan)
        require_once 'views/lapangan/sewa.php';
    }
	
  public function prosesSewa() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama_pemesan'];
            $id_lapangan = $_POST['id_lapangan'];
            $tanggal = $_POST['tanggal_sewa']; // Format: YYYY-MM-DD
            $jam_mulai_baru = $_POST['jam_mulai']; // Format: HH:MM
            $durasi_baru = (int)$_POST['durasi_jam'];
            $jenis_bayar = $_POST['jenis_pembayaran'];

            // 1. KREASIKAN OBJEK DATETIME UNTUK PESANAN BARU (MENGGABUNGKAN TANGGAL + JAM)
            $string_mulai_baru = $tanggal . ' ' . $jam_mulai_baru;
            $dt_mulai_baru = new DateTime($string_mulai_baru);
            
            // Jam selesai baru otomatis menghitung maju berdasarkan durasi jam (Aman walau lewat tengah malam)
            $dt_selesai_baru = clone $dt_mulai_baru;
            $dt_selesai_baru->modify("+$durasi_baru hours");

            // Ubah ke format angka timestamp detik agar bisa dibandingkan dengan matematika dasar
            $time_mulai_baru = $dt_mulai_baru->getTimestamp();
            $time_selesai_baru = $dt_selesai_baru->getTimestamp();

            require_once 'app/models/LapanganModel.php';
            $model = new LapanganModel();

            // 2. AMBIL DATA BOOKING. Kita ambil data H-1, hari H, dan H+1 dari database 
            // untuk jaga-jaga jika ada pesanan hari kemarin yang selesainya subuh hari ini.
            $tanggal_kemarin = date('Y-m-to', strtotime("$tanggal -1 day"));
            $tanggal_besok = date('Y-m-d', strtotime("$tanggal +1 day"));
            
            // Kita modifikasi sedikit pencarian model agar lebih luas jangkauan tanggalnya
            $db = $this->db; // atau gunakan koneksi db yang ada di modelmu
            
            // Mengambil semua pesanan pada lapangan ini yang rentang tanggalnya berdekatan
            $pesanan_sekitar = $model->cekJadwalBentrok($id_lapangan, $tanggal);
            
            // TIPS: Agar makin aman, kita gabungkan juga dengan pesanan hari kemarin dan besok
            $pesanan_kemarin = $model->cekJadwalBentrok($id_lapangan, $tanggal_kemarin);
            $pesanan_besok = $model->cekJadwalBentrok($id_lapangan, $tanggal_besok);
            $semua_pesanan_cek = array_merge($pesanan_kemarin, $pesanan_hari_ini = $pesanan_sekitar, $pesanan_besok);
            
            // 3. VALIDASI BENTROKAN JADWAL MENGGUNAKAN TIMESTAMP DETIK MUTLAK
            foreach ($semua_pesanan_cek as $pesanan) {
                // Buat objek waktu untuk data lama di database
                $string_mulai_lama = $pesanan['tanggal_sewa'] . ' ' . $pesanan['jam_mulai'];
                $dt_mulai_lama = new DateTime($string_mulai_lama);
                
                $durasi_lama = (int)$pesanan['durasi_jam'];
                $dt_selesai_lama = clone $dt_mulai_lama;
                $dt_selesai_lama->modify("+$durasi_lama hours");

                $time_mulai_lama = $dt_mulai_lama->getTimestamp();
                $time_selesai_lama = $dt_selesai_lama->getTimestamp();

                // RUMUS OVERLAPPING UTAMA: (Mulai Baru < Selesai Lama) AND (Selesai Baru > Mulai Lama)
                if ($time_mulai_baru < $time_selesai_lama && $time_selesai_baru > $time_mulai_lama) {
                    
                    // Format text info untuk pop-up alert agar informatif
                    $info_mulai_lama = $dt_mulai_lama->format('d M (H:i)');
                    $info_selesai_lama = $dt_selesai_lama->format('d M (H:i)');

                    echo "<script>
                        alert('❌ JADWAL BERTABRAKAN! Lapangan ini sudah dibooking oleh Team " . addslashes($pesanan['nama_pemesan']) . " dari tanggal $info_mulai_lama sampai $info_selesai_lama WIB.\\n\\nSilakan ganti jam atau tanggal booking kamu.');
                        window.history.back();
                    </script>";
                    exit;
                }
            }

            // 4. JIKA LOLOS VALIDASI, PROSES SEPERTI BIASA (UPLOAD & SIMPAN)
            $nama_file = $_FILES['bukti_pembayaran']['name'];
            $tmp_name = $_FILES['bukti_pembayaran']['tmp_name'];
            $ekstensi = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
            $nama_file_baru = time() . '_' . preg_replace("/[^a-zA-Z0-9]/", "", $nama) . '.' . $ekstensi;
            $target_dir = "assets/uploads/" . $nama_file_baru;

            $ekstensi_boleh = ['jpg', 'jpeg', 'png'];
            if (in_array($ekstensi, $ekstensi_boleh)) {
                if (move_uploaded_file($tmp_name, $target_dir)) {
                    $jam_save_ke_db = date('H:i:s', strtotime($jam_mulai_baru));
                    
                    if ($model->simpanPesanan($nama, $id_lapangan, $tanggal, $jam_save_ke_db, $durasi_baru, $jenis_bayar, $nama_file_baru)) {
                        header("Location: index.php?page=jadwal");
                        exit;
                    } else {
                        echo "Gagal memasukkan data transaksi ke database.";
                    }
                } else {
                    echo "Gagal mengunggah gambar ke server lokal.";
                }
            } else {
                echo "Format file salah! Hanya diperbolehkan file gambar (JPG, JPEG, PNG).";
            }
        }
    } // <-- Penutup fungsi prosesSewa (Sekarang sudah beres di sini)
	
    public function riwayatSewa() {
        require_once 'app/models/LapanganModel.php';
        $model = new LapanganModel();
        
        // Ambil data pesanan dari model
        $data_pesanan = $model->getAllPesanan();

        // Panggil file tampilan riwayat
        require_once 'views/lapangan/riwayat.php';
    } // <-- Penutup fungsi riwayatSewa
	public function jadwalPublic() {
        require_once 'app/models/LapanganModel.php';
        $model = new LapanganModel();
        
        // Ambil data pesanan dari model
        $data_pesanan = $model->getAllPesanan();

        // Panggil file tampilan baru khusus jadwal publik
        require_once 'views/lapangan/jadwal.php';
    }
    
} // <-- Penutup akhir class LapanganController


