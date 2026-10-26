<?php
require_once 'config/database.php';

class LapanganModel extends Database {
    
    // 1. Fungsi untuk mengambil semua data lapangan
    public function getAllLapangan() {
        $statement = $this->db->prepare("SELECT * FROM lapangan");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } // <-- Pastikan kurung kurawal penutup fungsi pertama ini ada!

    // 2. Fungsi untuk menyimpan data booking ke database
   public function simpanPesanan($nama, $id_lapangan, $tanggal, $jam, $durasi, $jenis_bayar, $bukti_bayar) {
        // tambahkan kolom jenis_pembayaran dan bukti_pembayaran ke dalam query SQL
        $sql = "INSERT INTO pesanan (nama_pemesan, id_lapangan, tanggal_sewa, jam_mulai, durasi_jam, jenis_pembayaran, bukti_pembayaran) 
                VALUES (:nama, :id_lapangan, :tanggal, :jam, :durasi, :jenis_bayar, :bukti_bayar)";
        
        $statement = $this->db->prepare($sql);
        
        $statement->bindParam(':nama', $nama);
        $statement->bindParam(':id_lapangan', $id_lapangan);
        $statement->bindParam(':tanggal', $tanggal);
        $statement->bindParam(':jam', $jam);
        $statement->bindParam(':durasi', $durasi);
        $statement->bindParam(':jenis_bayar', $jenis_bayar);
        $statement->bindParam(':bukti_bayar', $bukti_bayar);
        
        return $statement->execute();
    } // <-- Penutup fungsi simpanPesanan

    // 3. Fungsi untuk mengambil semua data pesanan + nama lapangan
    public function getAllPesanan() {
        $sql = "SELECT pesanan.*, lapangan.nama_lapangan 
                FROM pesanan 
                JOIN lapangan ON pesanan.id_lapangan = lapangan.id
                ORDER BY pesanan.id DESC";
        
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } // <-- Penutup fungsi getAllPesanan
   public function cekJadwalBentrok($id_lapangan, $tanggal) {
        // Query bersih khusus mengambil pesanan di lapangan dan tanggal yang sama
        $sql = "SELECT nama_pemesan, jam_mulai, durasi_jam FROM pesanan 
                WHERE id_lapangan = :id_lapangan AND tanggal_sewa = :tanggal";
        
        $statement = $this->db->prepare($sql);
        $statement->bindParam(':id_lapangan', $id_lapangan);
        $statement->bindParam(':tanggal', $tanggal);
        $statement->execute();
        
        // Kembalikan hasil berupa array asosiatif
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } 
} // <-- Penutup akhir class LapanganModel
