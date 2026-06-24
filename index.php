<?php
/**
 * File: index.php
 * Deskripsi: Halaman utama antarmuka (View) untuk sistem penyewaan kendaraan
 * Tahap 6: Implementasi View dengan integrasi database dan polimorfisme
 */

// Load semua dependency yang diperlukan
require_once 'koneksi/database.php';
require_once 'Penyewaan.php';
require_once 'SewaStandar.php';
require_once 'SewaKorporat.php';
require_once 'SewaLepasKunci.php';

// Instansiasi koneksi database
$database = new Database();
$db = $database->getConnection();

// Periksa apakah koneksi berhasil
if ($db === null) {
    die('Koneksi database gagal. Silakan cek konfigurasi database.');
}

// Panggil metode query statis dari masing-masing subclass
$dataStandar = SewaStandar::getDaftarStandar($db);
$dataKorporat = SewaKorporat::getDaftarKorporat($db);
$dataLepasKunci = SewaLepasKunci::getDaftarLepasKunci($db);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penyewaan Kendaraan - Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        header h1 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        header p {
            font-size: 14px;
            opacity: 0.9;
        }
        
        section {
            margin-bottom: 40px;
        }
        
        section h2 {
            background-color: #667eea;
            color: white;
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 5px 5px 0 0;
            font-size: 20px;
        }
        
        .table-wrapper {
            background-color: white;
            border-radius: 0 0 5px 5px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table thead {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }
        
        table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        table tbody tr {
            border-bottom: 1px solid #dee2e6;
            transition: background-color 0.3s ease;
        }
        
        table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        table tbody tr:last-child {
            border-bottom: none;
        }
        
        table td {
            padding: 15px;
            font-size: 14px;
        }
        
        .info-cell {
            color: #666;
            font-style: italic;
        }
        
        .tarif-cell {
            font-weight: bold;
            color: #667eea;
            font-size: 15px;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
            font-style: italic;
        }
        
        footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            color: #999;
            font-size: 12px;
            border-top: 1px solid #eee;
        }
        
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>🚗 Sistem Penyewaan Kendaraan</h1>
            <p>Dashboard Manajemen Penyewaan Kendaraan - Implementasi PHP OOP</p>
        </div>
    </header>
    
    <div class="container">
        <!-- Bagian 1: Tabel Layanan Standar -->
        <section>
            <h2>📋 Daftar Penyewaan Standar (Dengan Sopir)</h2>
            <div class="table-wrapper">
                <?php if (!empty($dataStandar)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Sewa</th>
                                <th>Pelanggan</th>
                                <th>Kendaraan</th>
                                <th>Durasi (Hari)</th>
                                <th>Informasi Layanan</th>
                                <th>Total Tarif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataStandar as $row): ?>
                                <?php
                                // Instansiasi objek SewaStandar dengan data array
                                $sewaStandar = new SewaStandar(
                                    $row['id_sewa'],
                                    $row['nama_pelanggan'],
                                    $row['merk_kendaraan'],
                                    $row['durasi_hari'],
                                    $row['tarif_dasar_perhari'],
                                    $row['nama_sopir'],
                                    $row['biaya_makan_sopir']
                                );
                                
                                // Hitung total tarif menggunakan polimorfisme
                                $totalTarif = $sewaStandar->hitungTotalTarif();
                                $infoLayanan = $sewaStandar->tampilkanInfoLayanan();
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id_sewa']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['merk_kendaraan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['durasi_hari']); ?></td>
                                    <td class="info-cell"><?php echo htmlspecialchars($infoLayanan); ?></td>
                                    <td class="tarif-cell">Rp<?php echo number_format($totalTarif, 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="no-data">
                        ℹ️ Tidak ada data penyewaan standar saat ini.
                    </div>
                <?php endif; ?>
            </div>
        </section>
        
        <!-- Bagian 2: Tabel Layanan Korporat -->
        <section>
            <h2>🏢 Daftar Penyewaan Korporat (Dengan Diskon 15%)</h2>
            <div class="table-wrapper">
                <?php if (!empty($dataKorporat)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Sewa</th>
                                <th>Nama Perusahaan</th>
                                <th>Kendaraan</th>
                                <th>Durasi (Hari)</th>
                                <th>Informasi Layanan</th>
                                <th>Total Tarif (Termasuk Diskon)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataKorporat as $row): ?>
                                <?php
                                // Instansiasi objek SewaKorporat dengan data array
                                $sewaKorporat = new SewaKorporat(
                                    $row['id_sewa'],
                                    $row['nama_pelanggan'],
                                    $row['merk_kendaraan'],
                                    $row['durasi_hari'],
                                    $row['tarif_dasar_perhari'],
                                    $row['npwp_perusahaan'],
                                    $row['nama_kontrak']
                                );
                                
                                // Hitung total tarif menggunakan polimorfisme
                                $totalTarif = $sewaKorporat->hitungTotalTarif();
                                $infoLayanan = $sewaKorporat->tampilkanInfoLayanan();
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id_sewa']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['merk_kendaraan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['durasi_hari']); ?></td>
                                    <td class="info-cell"><?php echo htmlspecialchars($infoLayanan); ?></td>
                                    <td class="tarif-cell">Rp<?php echo number_format($totalTarif, 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="no-data">
                        ℹ️ Tidak ada data penyewaan korporat saat ini.
                    </div>
                <?php endif; ?>
            </div>
        </section>
        
        <!-- Bagian 3: Tabel Layanan Lepas Kunci -->
        <section>
            <h2>🔑 Daftar Penyewaan Lepas Kunci (Tanpa Sopir + Administrasi)</h2>
            <div class="table-wrapper">
                <?php if (!empty($dataLepasKunci)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Sewa</th>
                                <th>Penyewa</th>
                                <th>Kendaraan</th>
                                <th>Durasi (Hari)</th>
                                <th>Informasi Layanan</th>
                                <th>Total Tarif (Incl. Admin)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataLepasKunci as $row): ?>
                                <?php
                                // Instansiasi objek SewaLepasKunci dengan data array
                                // URUTAN ARGUMEN CONSTRUCTOR (PENTING!):
                                // 1. $id_sewa (integer) - dari kolom 'id_sewa'
                                // 2. $nama_pelanggan (string) - dari kolom 'nama_pelanggan'
                                // 3. $merk_kendaraan (string) - dari kolom 'merk_kendaraan'
                                // 4. $durasi_hari (integer) - dari kolom 'durasi_hari'
                                // 5. $tarif_dasar_perhari (float) - dari kolom 'tarif_dasar_perhari'
                                // 6. $jaminan_keamanan (string!) - dari kolom 'jaminan_keamanan' [BUKAN angka]
                                // 7. $nomor_sim (string) - dari kolom 'nomor_sim'
                                
                                // Validasi tipe data untuk menghindari error
                                $id_sewa = (int)$row['id_sewa'];
                                $durasi_hari = (int)$row['durasi_hari'];
                                $tarif_dasar_perhari = (float)$row['tarif_dasar_perhari'];
                                
                                $sewaLepasKunci = new SewaLepasKunci(
                                    $id_sewa,
                                    $row['nama_pelanggan'],           // string
                                    $row['merk_kendaraan'],           // string
                                    $durasi_hari,                     // integer
                                    $tarif_dasar_perhari,             // float
                                    $row['jaminan_keamanan'],         // string (bukan angka!)
                                    $row['nomor_sim']                 // string
                                );
                                
                                // Hitung total tarif menggunakan polimorfisme
                                $totalTarif = $sewaLepasKunci->hitungTotalTarif();
                                $infoLayanan = $sewaLepasKunci->tampilkanInfoLayanan();
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id_sewa']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['merk_kendaraan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['durasi_hari']); ?></td>
                                    <td class="info-cell"><?php echo htmlspecialchars($infoLayanan); ?></td>
                                    <td class="tarif-cell">Rp<?php echo number_format($totalTarif, 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="no-data">
                        ℹ️ Tidak ada data penyewaan lepas kunci saat ini.
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
    
    <footer>
        <p>&copy; 2026 Sistem Penyewaan Kendaraan | Implementasi PHP-OOP (Tahap 6: View Interface)</p>
    </footer>
</body>
</html>
