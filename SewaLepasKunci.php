<?php
/**
 * Kelas SewaLepasKunci
 * Turunan dari abstract class Penyewaan untuk layanan sewa lepas kunci
 */

require_once 'Penyewaan.php';

class SewaLepasKunci extends Penyewaan {
    // Properti private untuk layanan lepas kunci
    private $jaminan_keamanan;
    private $nomor_sim;
    
    /**
     * Constructor SewaLepasKunci
     * Memanggil parent::__construct() dan menginisialisasi properti tambahan
     * 
     * @param int $id_sewa ID penyewaan
     * @param string $nama_pelanggan Nama pelanggan
     * @param string $merk_kendaraan Merk kendaraan
     * @param int $durasi_hari Durasi penyewaan dalam hari
     * @param float $tarif_dasar_perhari Tarif dasar per hari
     * @param float $jaminan_keamanan Nilai jaminan keamanan
     * @param string $nomor_sim Nomor SIM penyewa
     */
    public function __construct($id_sewa, $nama_pelanggan, $merk_kendaraan, $durasi_hari, 
                                $tarif_dasar_perhari, $jaminan_keamanan, $nomor_sim) {
        parent::__construct($id_sewa, $nama_pelanggan, $merk_kendaraan, $durasi_hari, $tarif_dasar_perhari);
        $this->jaminan_keamanan = $jaminan_keamanan;
        $this->nomor_sim = $nomor_sim;
    }
    
    /**
     * Metode statis getDaftarLepasKunci()
     * Mengambil daftar penyewaan lepas kunci dari database
     * 
     * @param PDO $db Objek koneksi PDO
     * @return array Array hasil query atau array kosong jika gagal
     */
    public static function getDaftarLepasKunci($db) {
        try {
            $query = "SELECT * FROM tabel_penyewaan WHERE jenis_layanan = 'LepasKunci'";
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
     * Implementasi Overriding metode abstrak hitungTotalTarif()
     * Menghitung total tarif untuk layanan lepas kunci dengan biaya administrasi flat.
     * Rumus: (tarif_dasar_perhari * durasi_hari) + 50000
     * 
     * @return float Total tarif penyewaan lepas kunci dengan administrasi
     */
    public function hitungTotalTarif() {
        return ($this->tarif_dasar_perhari * $this->durasi_hari) + 50000;
    }
    
    /**
     * Implementasi Overriding metode abstrak tampilkanInfoLayanan()
     * Menampilkan informasi lengkap layanan lepas kunci tanpa sopir
     * 
     * @return string Informasi layanan lepas kunci
     */
    public function tampilkanInfoLayanan() {
        $jaminan_format = number_format($this->jaminan_keamanan, 0, ',', '.');
        
        return "Layanan: Lepas Kunci (Tanpa Sopir) | No. SIM: {$this->nomor_sim} | Jaminan: Rp{$jaminan_format}";
    }
}
?>
