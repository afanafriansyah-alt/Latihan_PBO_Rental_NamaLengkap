<?php
/**
 * Kelas SewaKorporat
 * Turunan dari abstract class Penyewaan untuk layanan sewa korporat
 */

require_once 'Penyewaan.php';

class SewaKorporat extends Penyewaan {
    // Properti private untuk layanan korporat
    private $npwp_perusahaan;
    private $nama_kontrak;
    
    /**
     * Constructor SewaKorporat
     * Memanggil parent::__construct() dan menginisialisasi properti tambahan
     * 
     * @param int $id_sewa ID penyewaan
     * @param string $nama_pelanggan Nama pelanggan
     * @param string $merk_kendaraan Merk kendaraan
     * @param int $durasi_hari Durasi penyewaan dalam hari
     * @param float $tarif_dasar_perhari Tarif dasar per hari
     * @param string $npwp_perusahaan NPWP perusahaan
     * @param string $nama_kontrak Nama kontrak penyewaan
     */
    public function __construct($id_sewa, $nama_pelanggan, $merk_kendaraan, $durasi_hari, 
                                $tarif_dasar_perhari, $npwp_perusahaan, $nama_kontrak) {
        parent::__construct($id_sewa, $nama_pelanggan, $merk_kendaraan, $durasi_hari, $tarif_dasar_perhari);
        $this->npwp_perusahaan = $npwp_perusahaan;
        $this->nama_kontrak = $nama_kontrak;
    }
    
    /**
     * Metode statis getDaftarKorporat()
     * Mengambil daftar penyewaan korporat dari database
     * 
     * @param PDO $db Objek koneksi PDO
     * @return array Array hasil query atau array kosong jika gagal
     */
    public static function getDaftarKorporat($db) {
        try {
            $query = "SELECT * FROM tabel_penyewaan WHERE jenis_layanan = 'Korporat'";
            $stmt = $db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $e) {
            echo 'Error Query: ' . $e->getMessage();
            return [];
        }
    }
    
    /**
     * Implementasi metode abstrak hitungTotalTarif()
     * Menghitung total tarif untuk layanan korporat (sementara)
     * 
     * @return float Total tarif penyewaan
     */
    public function hitungTotalTarif() {
        // Implementasi sementara
        return 0;
    }
    
    /**
     * Implementasi metode abstrak tampilkanInfoLayanan()
     * Menampilkan informasi layanan korporat (sementara)
     */
    public function tampilkanInfoLayanan() {
        // Implementasi sementara
    }
}
?>
