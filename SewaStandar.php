<?php
/**
 * Kelas SewaStandar
 * Turunan dari abstract class Penyewaan untuk layanan sewa standar
 */

require_once 'Penyewaan.php';

class SewaStandar extends Penyewaan {
    // Properti private untuk layanan standar
    private $nama_sopir;
    private $biaya_makan_sopir;
    
    /**
     * Constructor SewaStandar
     * Memanggil parent::__construct() dan menginisialisasi properti tambahan
     * 
     * @param int $id_sewa ID penyewaan
     * @param string $nama_pelanggan Nama pelanggan
     * @param string $merk_kendaraan Merk kendaraan
     * @param int $durasi_hari Durasi penyewaan dalam hari
     * @param float $tarif_dasar_perhari Tarif dasar per hari
     * @param string $nama_sopir Nama sopir yang disediakan
     * @param float $biaya_makan_sopir Biaya makan sopir per hari
     */
    public function __construct($id_sewa, $nama_pelanggan, $merk_kendaraan, $durasi_hari, 
                                $tarif_dasar_perhari, $nama_sopir, $biaya_makan_sopir) {
        parent::__construct($id_sewa, $nama_pelanggan, $merk_kendaraan, $durasi_hari, $tarif_dasar_perhari);
        $this->nama_sopir = $nama_sopir;
        $this->biaya_makan_sopir = $biaya_makan_sopir;
    }
    
    /**
     * Metode statis getDaftarStandar()
     * Mengambil daftar penyewaan standar dari database
     * 
     * @param PDO $db Objek koneksi PDO
     * @return array Array hasil query atau array kosong jika gagal
     */
    public static function getDaftarStandar($db) {
        try {
            $query = "SELECT * FROM tabel_penyewaan WHERE jenis_layanan = 'Standar'";
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
     * Menghitung total tarif untuk layanan standar dengan rumus:
     * (tarif_dasar_perhari * durasi_hari) + biaya_makan_sopir
     * 
     * @return float Total tarif penyewaan standar
     */
    public function hitungTotalTarif() {
        return ($this->tarif_dasar_perhari * $this->durasi_hari) + $this->biaya_makan_sopir;
    }
    
    /**
     * Implementasi Overriding metode abstrak tampilkanInfoLayanan()
     * Menampilkan informasi lengkap layanan standar dengan sopir
     * 
     * @return string Informasi layanan standar
     */
    public function tampilkanInfoLayanan() {
        // Format biaya makan sopir ke format Rupiah
        $biaya_format = number_format($this->biaya_makan_sopir, 0, ',', '.');
        
        return "Layanan: Standar (Dengan Sopir) | Sopir: {$this->nama_sopir} | Uang Makan: Rp{$biaya_format}";
    }
}
?>
