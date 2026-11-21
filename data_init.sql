-- Struktur tabel untuk data konsultasi dan riwayat hasil diagnosis
CREATE TABLE IF NOT EXISTS `konsultasi` (
  `id_konsultasi` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `usia` TINYINT UNSIGNED NOT NULL,
  `jenis_kelamin` ENUM('L','P') NOT NULL,
  `nomor_telepon` VARCHAR(30) NOT NULL,
  `alamat` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_konsultasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `hasil_diagnosa` (
  `id_hasil_diagnosa` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_konsultasi` INT UNSIGNED NOT NULL,
  `id_penyakit` INT NOT NULL,
  `nilai_cf` DECIMAL(8,6) NOT NULL,
  `persentase` DECIMAL(7,2) NOT NULL,
  `gejala_terpilih` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_hasil_diagnosa`),
  KEY `idx_hasil_konsultasi` (`id_konsultasi`),
  CONSTRAINT `fk_hasil_konsultasi` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`) ON DELETE CASCADE,
  CONSTRAINT `fk_hasil_penyakit` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 1. Jalankan perintah ini untuk memasukkan Data Penyakit
-- KOSONGKAN TABEL UNTUK INSTALASI BERSIH
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `hasil_diagnosa`;
TRUNCATE TABLE `konsultasi`;
TRUNCATE TABLE `admin`;
TRUNCATE TABLE `penyakit`;
TRUNCATE TABLE `gejala`;
TRUNCATE TABLE `bobot_pakar`;
TRUNCATE TABLE `bobot_user`;
SET FOREIGN_KEY_CHECKS = 1;

-- 1. DATA ADMIN
-- Username: admin | Password: admin
INSERT INTO admin (username, password) VALUES 
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- 2. DATA PENYAKIT
INSERT INTO penyakit (kode_penyakit, nama_penyakit) VALUES
('P001', 'Tuberkulosis (TB)'),
('P002', 'COVID-19'),
('P003', 'Difteri'),
('P004', 'Pneumonia');

-- 3. DATA GEJALA
INSERT INTO gejala (id_gejala, kode_gejala, nama_gejala) VALUES
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

-- 4. DATA BOBOT PAKAR (RULE)
INSERT INTO bobot_pakar (id_gejala, id_penyakit, bobot) VALUES
-- Rule A001 (P001: Tuberkulosis)
(1, 1, 0.8), (2, 1, 1), (3, 1, 1), (8, 1, 1), (9, 1, 1), 
(15, 1, 1), (16, 1, 0.8), (18, 1, 1), (19, 1, 1), (21, 1, 1), 
(22, 1, 1), (24, 1, 1), (28, 1, 1), (30, 1, 1), (33, 1, 0.2), 
(34, 1, 0.6), (39, 1, 1), (40, 1, 1), (41, 1, 1),

-- Rule A002 (P002: COVID-19)
(1, 2, 1), (2, 2, 1), (4, 2, 1), (5, 2, 0.6), (6, 2, 1), 
(7, 2, 1), (10, 2, 0.6), (11, 2, 0.8), (13, 2, 0.6), (14, 2, 1), 
(15, 2, 0.4), (18, 2, 1), (20, 2, 1), (21, 2, 1), (25, 2, 0.4), 
(28, 2, 1), (31, 2, 1), (34, 2, 1), (36, 2, 0.4), (40, 2, 1), 
(41, 2, 1),

-- Rule A003 (P003: Difteri)
(1, 3, 1), (5, 3, 0.2), (11, 3, 1), (12, 3, 1), (14, 3, 1), 
(17, 3, 1), (29, 3, 1), (32, 3, 1), (36, 3, 0.8), (37, 3, 1), 
(38, 3, 1), (41, 3, 1),

-- Rule A004 (P004: Pneumonia)
(1, 4, 1), (2, 4, 0.6), (5, 4, 0.2), (10, 4, 0.2), (11, 4, 0.2), 
(13, 4, 0.2), (14, 4, 0.2), (16, 4, 1), (18, 4, 1), (28, 4, 0.8), 
(31, 4, 1), (41, 4, 1);

-- 5. DATA BOBOT USER (SKALA KEYAKINAN PENGGUNA SESUAI JURNAL)
INSERT INTO `bobot_user` (`keterangan`, `nilai`) VALUES
('Tidak Yakin', 0),
('Sedikit Yakin', 0.4),
('Yakin', 0.8),
('Sangat Yakin', 1);
