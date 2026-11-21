-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2026 at 06:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sistem_pakar_cf`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `bobot_pakar`
--

CREATE TABLE `bobot_pakar` (
  `id_bobot` int(11) NOT NULL,
  `id_gejala` int(11) DEFAULT NULL,
  `id_penyakit` int(11) DEFAULT NULL,
  `bobot` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bobot_pakar`
--

INSERT INTO `bobot_pakar` (`id_bobot`, `id_gejala`, `id_penyakit`, `bobot`) VALUES
(1, 1, 1, 0.8),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 8, 1, 1),
(5, 9, 1, 1),
(6, 15, 1, 1),
(7, 16, 1, 0.8),
(8, 18, 1, 1),
(9, 19, 1, 1),
(10, 21, 1, 1),
(11, 22, 1, 1),
(12, 24, 1, 1),
(13, 28, 1, 1),
(14, 30, 1, 1),
(15, 33, 1, 0.2),
(16, 34, 1, 0.6),
(17, 39, 1, 1),
(18, 40, 1, 1),
(19, 41, 1, 1),
(20, 1, 2, 1),
(21, 2, 2, 1),
(22, 4, 2, 1),
(23, 5, 2, 0.6),
(24, 6, 2, 1),
(25, 7, 2, 1),
(26, 10, 2, 0.6),
(27, 11, 2, 0.8),
(28, 13, 2, 0.6),
(29, 14, 2, 1),
(30, 15, 2, 0.4),
(31, 18, 2, 1),
(32, 20, 2, 1),
(33, 21, 2, 1),
(34, 25, 2, 0.4),
(35, 28, 2, 1),
(36, 31, 2, 1),
(37, 34, 2, 1),
(38, 36, 2, 0.4),
(39, 40, 2, 1),
(40, 41, 2, 1),
(41, 1, 3, 1),
(42, 5, 3, 0.2),
(43, 11, 3, 1),
(44, 12, 3, 1),
(45, 14, 3, 1),
(46, 17, 3, 1),
(47, 29, 3, 1),
(48, 32, 3, 1),
(49, 36, 3, 0.8),
(50, 37, 3, 1),
(51, 38, 3, 1),
(52, 41, 3, 1),
(53, 1, 4, 1),
(54, 2, 4, 0.6),
(55, 5, 4, 0.2),
(56, 10, 4, 0.2),
(57, 11, 4, 0.2),
(58, 13, 4, 0.2),
(59, 14, 4, 0.2),
(60, 16, 4, 1),
(61, 18, 4, 1),
(62, 28, 4, 0.8),
(63, 31, 4, 1),
(64, 41, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bobot_user`
--

CREATE TABLE `bobot_user` (
  `id_bobot_user` int(11) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `nilai` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bobot_user`
--

INSERT INTO `bobot_user` (`id_bobot_user`, `keterangan`, `nilai`) VALUES
(1, 'Tidak Yakin', 0),
(2, 'Sedikit Yakin', 0.4),
(3, 'Yakin', 0.8),
(4, 'Sangat Yakin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL,
  `kode_gejala` varchar(10) DEFAULT NULL,
  `nama_gejala` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`) VALUES
(1, 'G001', 'Bepergian ke luar kota/negeri dalam seminggu'),
(2, 'G002', 'Kelelahan atau lemas (Malaise)'),
(3, 'G003', 'Penurunan nafsu makan'),
(4, 'G004', 'Nyeri otot (Myalgia)'),
(5, 'G005', 'Mual atau muntah'),
(6, 'G006', 'Gangguan rasa (tidak bisa merasakan makanan)'),
(7, 'G007', 'Anosmia (tidak bisa mencium bau)'),
(8, 'G008', 'Penurunan berat badan'),
(9, 'G009', 'Berkeringat di malam hari tanpa alasan'),
(10, 'G010', 'Bersin-bersin'),
(11, 'G011', 'Sakit tenggorokan'),
(12, 'G012', 'Suara serak'),
(13, 'G013', 'Flu'),
(14, 'G014', 'Sakit kepala'),
(15, 'G0015A', 'Batuk terus menerus'),
(16, 'G0015B', 'Batuk sering'),
(17, 'G0015C', 'Batuk jarang'),
(18, 'G0016A', 'Batuk berdahak'),
(19, 'G0016B', 'Batuk berdarah'),
(20, 'G0016C', 'Batuk kering (Hacking Cough)'),
(21, 'G0017A', 'Dahak kuning atau kehijauan'),
(22, 'G0017B', 'Dahak merah'),
(23, 'G0017C', 'Dahak tidak berwarna'),
(24, 'G0018A', 'Batuk > 21 hari'),
(25, 'G0018B', 'Batuk < 14 hari'),
(26, 'G0018C', 'Batuk < 7 hari'),
(27, 'G0019A', 'Demam (39°C)'),
(28, 'G0019B', 'Demam (38°C-39°C)'),
(29, 'G0019C', 'Demam (37°C-37.9°C)'),
(30, 'G0020A', 'Demam > 21 hari'),
(31, 'G0020B', 'Demam < 14 hari'),
(32, 'G0020C', 'Demam < 7 hari'),
(33, 'G0021', 'Nyeri dada'),
(34, 'G0022', 'Sesak napas'),
(35, 'G0023', 'Napas berbunyi (Noisy breathing)'),
(36, 'G0024', 'Detak jantung cepat'),
(37, 'G0025', 'Bercak putih/abu pada amandel'),
(38, 'G0026', 'Benjolan di bagian belakang leher'),
(39, 'G0027', 'Riwayat HIV/AIDS'),
(40, 'G0028', 'Riwayat penyakit bawaan (Diabetes, dll)'),
(41, 'G0029', 'Kontak langsung dengan pasien ISPA');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_diagnosa`
--

CREATE TABLE `hasil_diagnosa` (
  `id_hasil_diagnosa` int(10) UNSIGNED NOT NULL,
  `id_konsultasi` int(10) UNSIGNED NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `nilai_cf` decimal(8,6) NOT NULL,
  `persentase` decimal(7,2) NOT NULL,
  `gejala_terpilih` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_diagnosa`
--

INSERT INTO `hasil_diagnosa` (`id_hasil_diagnosa`, `id_konsultasi`, `id_penyakit`, `nilai_cf`, `persentase`, `gejala_terpilih`, `created_at`) VALUES
(1, 1, 1, 0.800000, 80.00, '{\"2\":0,\"9\":0.8,\"41\":0}', '2026-07-10 14:42:04'),
(2, 2, 2, 0.928000, 92.80, '{\"36\":1,\"40\":0.8,\"41\":0.4}', '2026-07-10 14:50:23'),
(3, 3, 1, 1.000000, 100.00, '{\"2\":1,\"32\":0.4,\"14\":1,\"34\":0.4,\"39\":0}', '2026-07-12 03:04:20'),
(4, 4, 3, 0.800000, 80.00, '{\"36\":1,\"40\":0.4}', '2026-07-12 03:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `usia` tinyint(3) UNSIGNED NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `nomor_telepon` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `nama`, `usia`, `jenis_kelamin`, `nomor_telepon`, `alamat`, `created_at`) VALUES
(1, 'adit', 20, 'L', '08123456789', 'tegal', '2026-07-10 14:41:26'),
(2, 'ana', 30, 'P', '08123409000', 'tegal', '2026-07-10 14:49:29'),
(3, 'budi', 45, 'L', '08987654321', 'surabaya', '2026-07-12 03:03:26'),
(4, 'elsa', 23, 'P', '0898765432', 'bandung', '2026-07-12 03:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int(11) NOT NULL,
  `kode_penyakit` varchar(10) DEFAULT NULL,
  `nama_penyakit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `kode_penyakit`, `nama_penyakit`) VALUES
(1, 'P001', 'Tuberkulosis (TB)'),
(2, 'P002', 'COVID-19'),
(3, 'P003', 'Difteri'),
(4, 'P004', 'Pneumonia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bobot_pakar`
--
ALTER TABLE `bobot_pakar`
  ADD PRIMARY KEY (`id_bobot`),
  ADD KEY `id_gejala` (`id_gejala`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `bobot_user`
--
ALTER TABLE `bobot_user`
  ADD PRIMARY KEY (`id_bobot_user`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  ADD PRIMARY KEY (`id_hasil_diagnosa`),
  ADD KEY `idx_hasil_konsultasi` (`id_konsultasi`),
  ADD KEY `fk_hasil_penyakit` (`id_penyakit`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bobot_pakar`
--
ALTER TABLE `bobot_pakar`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `bobot_user`
--
ALTER TABLE `bobot_user`
  MODIFY `id_bobot_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  MODIFY `id_hasil_diagnosa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot_pakar`
--
ALTER TABLE `bobot_pakar`
  ADD CONSTRAINT `bobot_pakar_ibfk_1` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id_gejala`),
  ADD CONSTRAINT `bobot_pakar_ibfk_2` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`);

--
-- Constraints for table `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  ADD CONSTRAINT `fk_hasil_konsultasi` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_hasil_penyakit` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
