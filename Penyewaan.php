<?php
/**
 * Abstract Class Penyewaan
 * Kelas abstrak untuk mendefinisikan struktur dan antarmuka penyewaan kendaraan
 */

abstract class Penyewaan {
    // Properti protected untuk memetakan kolom database
    protected $id_sewa;
    protected $nama_pelanggan;
    protected $merk_kendaraan;
    protected $durasi_hari;
    protected $tarif_dasar_perhari;
    
    /**
     * Constructor (__construct)
     * Menginisialisasi kelima properti protected saat objek dibuat
     * 
     * @param int $id_sewa ID penyewaan
     * @param string $nama_pelanggan Nama pelanggan
     * @param string $merk_kendaraan Merk kendaraan
     * @param int $durasi_hari Durasi penyewaan dalam hari
     * @param float $tarif_dasar_perhari Tarif dasar per hari
     */
    public function __construct($id_sewa, $nama_pelanggan, $merk_kendaraan, $durasi_hari, $tarif_dasar_perhari) {
        $this->id_sewa = $id_sewa;
        $this->nama_pelanggan = $nama_pelanggan;
        $this->merk_kendaraan = $merk_kendaraan;
        $this->durasi_hari = $durasi_hari;
        $this->tarif_dasar_perhari = $tarif_dasar_perhari;
    }
    
    /**
     * Abstract Method hitungTotalTarif()
     * Metode abstrak untuk menghitung total tarif penyewaan
     * Harus diimplementasikan di kelas anak
     */
    abstract public function hitungTotalTarif();
    
    /**
     * Abstract Method tampilkanInfoLayanan()
     * Metode abstrak untuk menampilkan informasi layanan penyewaan
     * Harus diimplementasikan di kelas anak
     */
    abstract public function tampilkanInfoLayanan();
}
?>
