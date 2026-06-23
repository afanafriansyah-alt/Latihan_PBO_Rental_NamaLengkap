-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2026 at 02:37 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simulasi_pbo_kelas_namalengkap`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_penyewaan`
--

CREATE TABLE `tabel_penyewaan` (
  `id_sewa` int NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `merk_kendaraan` varchar(50) NOT NULL,
  `durasi_hari` int NOT NULL,
  `tarif_dasar_perhari` decimal(10,2) NOT NULL,
  `jenis_layanan` enum('Standar','Korporat','LepasKunci') NOT NULL,
  `nama_sopir` varchar(100) DEFAULT NULL,
  `biaya_makan_sopir` decimal(10,2) DEFAULT NULL,
  `npwp_perusahaan` varchar(20) DEFAULT NULL,
  `nama_kontrak` varchar(100) DEFAULT NULL,
  `jaminan_keamanan` varchar(100) DEFAULT NULL,
  `nomor_sim` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_penyewaan`
--

INSERT INTO `tabel_penyewaan` (`id_sewa`, `nama_pelanggan`, `merk_kendaraan`, `durasi_hari`, `tarif_dasar_perhari`, `jenis_layanan`, `nama_sopir`, `biaya_makan_sopir`, `npwp_perusahaan`, `nama_kontrak`, `jaminan_keamanan`, `nomor_sim`) VALUES
(1, 'Ahmad Fauzi', 'Toyota Avanza', 3, '350000.00', 'Standar', 'Budi Santoso', '50000.00', NULL, NULL, NULL, NULL),
(2, 'Siti Rahma', 'Mitsubishi Xpander', 2, '400000.00', 'Standar', 'Joko Susilo', '50000.00', NULL, NULL, NULL, NULL),
(3, 'Bambang Tri', 'Toyota Innova Reborn', 5, '600000.00', 'Standar', 'Andi Wijaya', '60000.00', NULL, NULL, NULL, NULL),
(4, 'Dewi Lestari', 'Suzuki Ertiga', 1, '300000.00', 'Standar', 'Budi Santoso', '50000.00', NULL, NULL, NULL, NULL),
(5, 'Eko Prasetyo', 'Toyota Fortuner', 4, '1000000.00', 'Standar', 'Joko Susilo', '75000.00', NULL, NULL, NULL, NULL),
(6, 'Fitriani', 'Honda Mobilio', 2, '350000.00', 'Standar', 'Andi Wijaya', '50000.00', NULL, NULL, NULL, NULL),
(7, 'Hendra Wijaya', 'Toyota Avanza', 3, '350000.00', 'Standar', 'Budi Santoso', '50000.00', NULL, NULL, NULL, NULL),
(8, 'PT Maju Mundur', 'Toyota Innova Zenix', 10, '750000.00', 'Korporat', NULL, NULL, '01.234.567.8-999.000', 'Kontrak_Kemitraan_01', NULL, NULL),
(9, 'CV Sumber Makmur', 'Toyota HiAce', 5, '1200000.00', 'Korporat', NULL, NULL, '02.987.654.3-111.000', 'Kontrak_Operasional_B', NULL, NULL),
(10, 'PT Tech Indonesia', 'Honda CR-V', 7, '900000.00', 'Korporat', NULL, NULL, '03.111.222.3-444.000', 'Kontrak_Direksi_2026', NULL, NULL),
(11, 'Perum Bulog Regional', 'Mitsubishi Triton', 15, '800000.00', 'Korporat', NULL, NULL, '01.555.666.7-888.000', 'Kontrak_Logistik_C', NULL, NULL),
(12, 'PT Global Niaga', 'Toyota Avanza', 30, '300000.00', 'Korporat', NULL, NULL, '04.888.999.1-222.000', 'Kontrak_Bulanan_Sales', NULL, NULL),
(13, 'CV Creative Studio', 'Honda HR-V', 4, '550000.00', 'Korporat', NULL, NULL, '02.444.555.6-777.000', 'Kontrak_Project_Event', NULL, NULL),
(14, 'PT Samudra Logistik', 'Toyota Innova Reborn', 12, '600000.00', 'Korporat', NULL, NULL, '01.777.888.9-333.000', 'Kontrak_Operasional_D', NULL, NULL),
(15, 'Rian Hidayat', 'Honda Brio', 2, '250000.00', 'LepasKunci', NULL, NULL, NULL, NULL, 'KTP & Motor Vario', '320102-123456-0001'),
(16, 'Siska Putri', 'Toyota Yaris', 3, '400000.00', 'LepasKunci', NULL, NULL, NULL, NULL, 'KTP & Deposit Uang Rp1jt', '317103-654321-0002'),
(17, 'Doni Salman', 'Honda Civic', 2, '800000.00', 'LepasKunci', NULL, NULL, NULL, NULL, 'KTP & Sertifikat Rumah', '357804-112233-0003'),
(18, 'Maya Sandria', 'Daihatsu Sigra', 5, '250000.00', 'LepasKunci', NULL, NULL, NULL, NULL, 'KTP & Motor Beat', '327305-445566-0004'),
(19, 'Fahmi Idris', 'Mitsubishi Pajero', 3, '1200000.00', 'LepasKunci', NULL, NULL, NULL, NULL, 'KTP & Deposit Uang Rp2jt', '317506-778899-0005'),
(20, 'Gita Gutawa', 'Honda Jazz', 1, '350000.00', 'LepasKunci', NULL, NULL, NULL, NULL, 'KTP & Kartu Keluarga', '320407-990011-0006');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_penyewaan`
--
ALTER TABLE `tabel_penyewaan`
  ADD PRIMARY KEY (`id_sewa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_penyewaan`
--
ALTER TABLE `tabel_penyewaan`
  MODIFY `id_sewa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
