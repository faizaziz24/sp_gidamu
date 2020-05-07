-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2019 at 02:48 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp_gidamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diagnosis`
--

CREATE TABLE `tbl_diagnosis` (
  `diagnosis_code` varchar(8) NOT NULL,
  `patient_code` varchar(8) NOT NULL,
  `disease_code` varchar(8) NOT NULL,
  `cf_total` float NOT NULL,
  `created_by` varchar(8) NOT NULL,
  `created_dtm` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_diagnosis`
--

INSERT INTO `tbl_diagnosis` (`diagnosis_code`, `patient_code`, `disease_code`, `cf_total`, `created_by`, `created_dtm`) VALUES
('DG000001', 'PC00001', 'DC0016', 77.3609, 'UC00004', '2019-11-27 10:09:22'),
('DG000002', 'PC00002', 'DC0001', 83.3625, 'UC00004', '2019-11-27 10:28:05'),
('DG000003', 'PC00003', 'DC0001', 95.2344, 'UC00004', '2019-11-27 10:43:59'),
('DG000004', 'PC00004', 'DC0001', 92.9367, 'UC00004', '2019-11-27 10:57:42'),
('DG000005', 'PC00005', 'DC0001', 90.5976, 'UC00004', '2019-11-27 11:12:04'),
('DG000006', 'PC00006', 'DC0016', 87.2704, 'UC00004', '2019-11-27 11:26:21'),
('DG000007', 'PC00007', 'DC0016', 91.7632, 'UC00004', '2019-11-27 11:40:13'),
('DG000008', 'PC00008', 'DC0016', 94.399, 'UC00004', '2019-11-27 11:58:44'),
('DG000009', 'PC00009', 'DC0001', 96.7662, 'UC00004', '2019-11-30 08:11:01'),
('DG000010', 'PC00010', 'DC0001', 94.8681, 'UC00004', '2019-11-30 08:28:25'),
('DG000011', 'PC00011', 'DC0001', 91.7568, 'UC00004', '2019-11-30 08:46:08'),
('DG000012', 'PC00012', 'DC0004', 93.7753, 'UC00004', '2019-11-30 09:05:17'),
('DG000013', 'PC00013', 'DC0001', 94.0752, 'UC00004', '2019-11-30 09:22:49'),
('DG000014', 'PC00014', 'DC0007', 84.5625, 'UC00004', '2019-11-30 09:40:03'),
('DG000015', 'PC00015', 'DC0001', 97.5528, 'UC00004', '2019-11-30 09:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diseases`
--

CREATE TABLE `tbl_diseases` (
  `disease_code` varchar(8) NOT NULL,
  `disease_name` varchar(128) NOT NULL,
  `disease_explain` text NOT NULL,
  `healing` text NOT NULL,
  `preventing` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_diseases`
--

INSERT INTO `tbl_diseases` (`disease_code`, `disease_name`, `disease_explain`, `healing`, `preventing`) VALUES
('DC0000', 'Tidak terdeteksi penyakit', 'Maaf untuk sementara sistem belum dapat mendeteksi penyakit yang dialami berdasarkan gejala-gejala yang muncul.', '-', '-'),
('DC0001', 'Persistensi', 'Suatu kasus dimana gigi susu bertahan pada lengkung gigi melebihi waktu normal sehingga menyebabkan gangguan erupsi dari gigi permanen penggantinya.', 'Pemberian obat Analgenik, Paracetamol, Ibuprofen, Antalgin, Asam Mefenamat, Vitamin C', 'Melakukan pencabutan gigi dengan kontrol ke dokter gigi secara rutin.'),
('DC0002', 'Trauma Gigi Dan Jaringan Penyangga', 'Suatu kondisi dimana suatu kondisi hilangnya kontiunitasjaringan keras gigi dan atau periodontal karena sebab mekanis.', 'pemberian obat Parasetamol, analgetik lainnya seperti ibuprofen atau asam mefenamat.', '<ol><li>Pertolongan pertama dilakukan untuk semua luka pada wajah dan mulut. Jaringan lunak harus dirawat dengan baik.&nbsp;</li><li>Pembersihan dan irigasi yang perlahan dengan saline akan membantu mengurangi jumlah jaringan yang mati dan resiko adanya keadaan anaerobik.</li></ol>'),
('DC0003', 'Karies Email', 'Suatu kasus dimana lapisan keras gigi (email atau enamel) mengalami kerusakan permanen bagian luar (email).', '<p>\r\nMelakukan penambalan gigi (filling).</p>', '<p></p><ol><li>Pemberian fluoride bisa membantu mengembalikan keadaan enamel gigi.</li><li>Menyikat gigi dengan perlahan secara rutin dua kali sehari.</li><li>Membersihkan celah gigi menggunakan benang gigi.</li></ol>\r\n\r\n<br><p></p>'),
('DC0004', 'Karies Dentin', 'Karies atau gigi berlubang dimana lapisan keras gigi (email atau enamel) mengalami kerusakan permanen bagian dalam (dentin)', '<p>\r\nMelakukan penambalan gigi (filling).</p>', '<p></p><ol><li>Pemberian fluoride bisa membantu mengembalikan keadaan enamel gigi.</li><li>Menyikat gigi dengan perlahan secara rutin dua kali sehari.</li><li>Membersihkan celah gigi menggunakan benang gigi.</li></ol>\r\n\r\n<br><p></p>'),
('DC0005', 'Dentin Hipersensitif ', 'Dentin Hipersensitif atau sering disebut gigi sensitif, suatu kasus dimana klinis gigi yang relatif umum pada gigi permanen yang disebabkan oleh dentin yang terpapar akibat hilangnya enamel atau sementum.', '<p></p><ol><li>Melakukan <i>filling </i>(tambal gigi).</li><li>\r\n\r\nMenyikat gigi menggunakan pasta gigi yang mengandung desensitasi.</li></ol><p></p>', '<ol><li>Menyikat gigi secara perlahan-lahan.<br></li><li>Membersihkan celah gigi menggunakan benang gigi.</li></ol>'),
('DC0006', 'Kalkulus ', 'Kalkulus atau karang gigi, suatu kasus dimana lapisan deposit (bahan keras yang melekat pada permukaan gigi) mineral yang berwarna kuning atau cokelat pada gigi karena plak gigi yang mengeras.', '<p>\r\n\r\n\r\n\r\nMelakukan pembersihan gigi (scalling).</p>', '<ol><li>Menyikat gigi secara teratur dan perlahan selama dua kali sehari.</li><li>Membersihkan celah gigi menggunakan benang gigi.</li><li>Menggunakan obat kumur antiseptik setiap hari untuk membunuh bakteri penyebab plak.</li><li>Konsumsi makanan yang sehat dan batasi jumlah asupan makanan yang mengandung gula seperti permen atau cokelat.</li><li>Melakukan kontrol gigi ke dokter gigi secara rutin.</li></ol>'),
('DC0007', 'Gingivitis Plak Mikrobial', 'Suatu kasus yang diakibatkan oleh plak dan peradangan gingiva tanpa disertai kehilangan perlekatan.', '<div><ol><li>Melakukan scalling (pembersihan karang gigi).</li><li>Mengkonsumsi makanan yang mengandung vitamin C dan obat kumur (Betadine, Minosep, Bactidol, Listerin, dan Inkasari).</li></ol></div>', '<p>Melakukan kontrol gigi ke dokter gigi secara rutin.</p>'),
('DC0008', 'Acut Necroticing Ulserative Gingivitis', 'Acut Necroticing Ulserative Gingivitis (ANUG), suatu kasus dimana radang gusi yang terjadi karena terdapat bakteri yang berlebih serta berjumlah tidak biasanya yang diakibatkan oleh infeksi pada gusi. Bakteri tersebut mengeluarkan racun dan mengiritasi gusi yang akan menimbulkan infeksi lebih lanjut.', '<ol><li>Pemberian obat kumur (Betadine, Minosep, Bactidol, Listerin, dan Enkasari), anti radang (Dexametason, Prednison, Natrium Dikloferon, Kalium Dikloferon, Meloxicam), dan antibiotik (Amoxilin, Amoxiclav, Metronidazole, Eritromisin, Siprofloxacin, Klindermicin, Levofloxalin).</li><li>\r\n\r\nMelakukan scalling (pembersihan karang gigi).<br></li></ol>', '<p></p><ol><li>Perbanyak minum air putih dan hindari makanan atau minuman yang terlalu panas atau dingin.</li><li>Jauhi rokok atau produk tembakau lain.</li><li>Melakukan kontrol secara rutin.</li></ol><p></p>\r\n\r\n<br>'),
('DC0009', 'Recurrent Aphthous Stomatitis', 'Recurrent Aphthous Stomatitis (RAS) sering disebut juga sariawan berulang, suatu kasus dimana lesi mukosa rongga mulut yang paling sering terjadi dengan ditandai ulser yang timbul berulang di mukosa.', 'Mengkonsumsi makanan yang mengandung vitamin C, B12 dan zat besi (anemia kekurangan zat besi dan B12 juga berperan dalam kejadian RAS)', 'Menjaga kebersihan rongga mulut dapat juga dilakukan dengan berkumur-kumur menggunakan air garam hangat atau obat kumur.'),
('DC0010', 'Geographic Tongue', 'Suatu kondisi dimana papila pada permukaan lidah hilang dan terlihat seperti “pulau” merah halus dengan pinggiran berwarna putih. ', 'Mengkonsumsi makanan yang mengandung vitamin B6 yang dikonsumsi sebanyak dua kali sehari.', 'Menjaga pola makan secara teratur.'),
('DC0011', 'Herpes Labialis', 'Herpes Labialis dimana lesi/luka yang terdapat pada wajah di sekeliling bibir pada satu bagian dalam kurun waktu 1-3 minggu setelah terinfeksi virus (masa inkubasi virus).', 'Pemberian obat anti virus seperti <i>Acyclovir</i>, <i>Famciclovir</i>, atau <i>Valacyclovir</i>', '<ol><li>Menjaga kondisi bibir dan mulut tetap bersih.</li><li>Menjaga pola makan yang teratur serta istirahat yang cukup.</li><li>Mengompres area yang luka dengan kompres dingin atau hangat untuk meredakan rasa sakit yang muncul.&nbsp;</li><li>Menghindari konsumsi minuman hangat, makanan pedas, asam dan asin selama beberapa waktu.</li></ol>'),
('DC0012', 'Herpes Zoster', 'Suatu kondisi dimana munculnya rasa nyeri disekitar mulut yang disebabkan oleh virus herpes yang juga dapat menyebabkan cacar air.', '<ol><li>Pemberian vaksin <i>Herpes Zoster.</i></li><li>Pemberian obat Analgesik (<i>Paracetamol, Aspirin, Ibuprofen, Kodein</i>), Antikonvulsan, dan Antidepresan trisiklik (TCA). </li></ol>', '<ol><li>Menutup luka lepuh agar cairan pada lepuh tidak mengontaminasi benda-benda yang dapat menjadi perantara penularan.&nbsp;</li><li>Tidak menggaruk luka yang melepuh.&nbsp;</li><li>Menghindari kontak langsung dengan wanita hamil yang belum pernah mengalami cacar air, bayi dengan berat badan lahir rendah atau bayi prematur, serta orang dengan kekebalan tubuh yang lemah.&nbsp;</li><li>Sering mencuci tangan.</li></ol>'),
('DC0013', 'Pulpitis Reversible', 'Suatu kondisi dimana pulpa mengalami peradangan ringan dan jika penyebabnya dihilangkan maka peradangan akan pulih kembali dan pulpa akan sehat selalu.', '<p></p><ol><li>Pemberian obat Analgenik.</li><li>Membersihkan dengan eksavator</li><li>Melakukan penutupan sementara dengan kapas.</li></ol><p></p>', '<p></p><p></p><ol><li>Menjaga kebersihan dan kesehatan rongga mulut dengan menyikat gigi dua kali sehari.</li><li>Membersihkan celah gigi menggunakan benang gigi.</li></ol><p></p><p></p>'),
('DC0014', 'Pulpitis Irreversible', 'Suatu kondisi dimana peradangan pulpa yang menetap dan simtomatik atau asimtomatik yang disebabkan oleh suatu luka, dimana pulpa tidak dapat menanggulangi peradangan yang terjadi sehingga pulpa tidak dapat kembali ke kondisi sehat.', '<div>\r\n\r\nMerujuk pada dokter gigi spesialis endodontik yang fokus menangani masalah yang berhubungan dengan perawatan saraf gigi.<br></div>', '<p></p><ol><li>Menjaga kebersihan dan kesehatan rongga mulut dengan menyikat gigi dua kali sehari.</li><li>Membersihkan celah gigi menggunakan benang gigi.</li><li>Rutin konsultasi ke dokter gigi setiap 6 bulan sekali untuk memeriksa keadaan seluruh gigi.</li><li>Mengurangi konsumsi makanan dan minuman yang dapat memicu terjadinya gigi berlubang seperti permen, kue, dan minuman bersoda.</li></ol><br>\r\n\r\n<br><p></p>'),
('DC0015', 'Abses Periapikal', 'Suatu kondisi dapat ditemukan pada gigi dimana terjadinya pembentukan kantung atau benjolan setempat diujung akar gigi dan jaringan tulang di sekitarnya.', '<div>\r\n\r\n<ol><li>Pemberian obat Aspirin, Ibuprofen, atau Paracetamol (Acetaminophen).&nbsp;</li><li>Dilakukan penyayatan supaya terbuka sehingga nanah yang mengandung bakteri bisa keluar dan kering. </li><li>Perawatan akar kanal gigi bisa dilakukan untuk menghilangkan kantong nanah di gigi.</li></ol><div>* Ibuprofen tidak dianjurkan bagi orang dengan asma dan tukak lambung.&nbsp;<br></div><div>* Aspirin tidak boleh diberikan untuk anak berusia di bawah 16 tahun, ibu hamil, atau wanita yang sedang menyusui. </div></div>', 'Jika abses gigi dan infeksi yang sering terjadi mungkin harus menjalani operasi untuk mengangkat jaringan yang rusak melalui dokter gigi bedah mulut.<br>'),
('DC0016', 'Periodontitis', 'Suatu kondisi dimana peradangan gingivia yang meluas kepekatan jaringan disekitarnya.', '<p>\r\n\r\n</p><p></p><ol><li>Menggunakan metode root planing diperlukan untuk membersihkan dan mencegah penumpukan bakteri dan karang gigi lebih lanjut, serta menghaluskan permukaan akar.</li><li>Melakukan scalling (pembersihan karang gigi) guna menghilangkan karang gigi dan bakteri dari permukaan gigi atau bagian bawah gusi.</li><li>Pemberian obat antibiotik minum atau topikal (berupa gel atau obat kumur) untuk menghilangkan bakteri penyebab infeksi.</li></ol><p></p><p></p>', '<br><p></p><ol><li>Menyikat gigi secara teratur dan perlahan selama dua kali sehari.<br></li><li>Membersihkan celah gigi menggunakan benang gigi.</li><li>Menggunakan sikat gigi yang lembut, dan ganti sikat gigi setelah dipakai selama 3-4 bulan.</li><li>Memeriksakan gigi tiap 6 bulan sekali.</li></ol>\r\n\r\n<br><p></p>'),
('DC0017', 'Luksasi Goyang', '<p>Suatu kasus dimana gigi mengalami goyang ke segala arah dikarenakan kehilangan perlekatan.</p>', '<p>\r\nPemberian obat Analgenik, Antibiotik, Asepsis, dan Anastesi.</p>', '<p>Pencabutan gigi</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_login`
--

CREATE TABLE `tbl_last_login` (
  `id` int(64) NOT NULL,
  `user_code` varchar(8) NOT NULL,
  `session_data` varchar(2048) NOT NULL,
  `machine_ip` varchar(1024) NOT NULL,
  `browser_type` varchar(128) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `created_dtm` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_last_login`
--

INSERT INTO `tbl_last_login` (`id`, `user_code`, `session_data`, `machine_ip`, `browser_type`, `platform`, `created_dtm`) VALUES
(1, 'UC00004', '{\"userCode\":\"UC00004\",\"roleName\":\"Perawat\",\"userName\":\"Perawat 1\"}', '36.65.106.104', 'Opera 64.0.3417.92', 'Windows 10', '2019-11-25 09:33:39'),
(2, 'UC00004', '{\"userCode\":\"UC00004\",\"roleName\":\"Perawat\",\"userName\":\"Yuki Umia Susanthi\"}', '36.65.106.104', 'Chrome 78.0.3904.108', 'Android', '2019-11-25 09:45:38'),
(3, 'UC00002', '{\"userCode\":\"UC00002\",\"roleName\":\"Pakar\",\"userName\":\"Pakar 1\"}', '36.65.106.104', 'Chrome 78.0.3904.96', 'Android', '2019-11-25 09:50:18'),
(4, 'UC00004', '{\"userCode\":\"UC00004\",\"roleName\":\"Perawat\",\"userName\":\"Yuki Umia Susanthi\"}', '36.65.106.104', 'Firefox 70.0', 'Windows 8.1', '2019-11-25 10:02:51'),
(5, 'UC00004', '{\"userCode\":\"UC00004\",\"roleName\":\"Perawat\",\"userName\":\"Yuki Umia Susanthi\"}', '36.65.5.45', 'Firefox 70.0', 'Windows 8.1', '2019-11-26 09:02:32'),
(6, 'UC00004', '{\"userCode\":\"UC00004\",\"roleName\":\"Perawat\",\"userName\":\"Yuki Umia Susanthi\"}', '36.65.69.150', 'Firefox 70.0', 'Windows 8.1', '2019-11-27 10:05:09'),
(7, 'UC00002', '{\"userCode\":\"UC00002\",\"roleName\":\"Pakar\",\"userName\":\"Drg. Fasihul Ibad\"}', '36.65.69.150', 'Chrome 78.0.3904.96', 'Android', '2019-11-27 10:50:18'),
(8, 'UC00001', '{\"userCode\":\"UC00001\",\"roleName\":\"Administrator\",\"userName\":\"dr.Abdul Mursid\"}', '36.65.69.150', 'Chrome 78.0.3904.108', 'Android', '2019-11-27 11:28:56'),
(9, 'UC00004', '{\"userCode\":\"UC00004\",\"roleName\":\"Perawat\",\"userName\":\"Yuki Umia Susanthi\"}', '36.65.59.187', 'Firefox 70.0', 'Windows 8.1', '2019-11-30 08:03:11'),
(10, 'UC00004', '{\"userCode\":\"UC00004\",\"roleName\":\"Perawat\",\"userName\":\"Yuki Umia Susanthi\"}', '36.65.59.187', 'Firefox 70.0', 'Windows 8.1', '2019-11-30 09:34:29'),
(11, 'UC00004', '{\"userCode\":\"UC00004\",\"roleName\":\"Perawat\",\"userName\":\"Yuki Umia Susanthi\"}', '::1', 'Chrome 78.0.3904.108', 'Windows 10', '2019-12-11 09:44:55'),
(12, 'UC00002', '{\"userCode\":\"UC00002\",\"roleName\":\"Pakar\",\"userName\":\"Drg. Fasihul Ibad\"}', '::1', 'Chrome 78.0.3904.108', 'Windows 10', '2019-12-12 14:07:42'),
(13, 'UC00001', '{\"userCode\":\"UC00001\",\"roleName\":\"Administrator\",\"userName\":\"dr.Abdul Mursid\"}', '::1', 'Chrome 78.0.3904.108', 'Windows 10', '2019-12-13 09:28:52'),
(14, 'UC00002', '{\"userCode\":\"UC00002\",\"roleName\":\"Pakar\",\"userName\":\"Drg. Fasihul Ibad\"}', '::1', 'Opera 65.0.3467.62', 'Windows 10', '2019-12-13 09:30:44'),
(15, 'UC00001', '{\"userCode\":\"UC00001\",\"roleName\":\"Administrator\",\"userName\":\"Dr.abdul Mursid\"}', '::1', 'Opera 65.0.3467.62', 'Windows 10', '2019-12-13 09:30:55'),
(16, 'UC00002', '{\"userCode\":\"UC00002\",\"roleName\":\"Pakar\",\"userName\":\"Drg. Fasihul Ibad\"}', '::1', 'Opera 65.0.3467.62', 'Windows 10', '2019-12-13 10:22:53'),
(17, 'UC00001', '{\"userCode\":\"UC00001\",\"roleName\":\"Administrator\",\"userName\":\"Dr.abdul Mursid\"}', '::1', 'Opera 65.0.3467.62', 'Windows 10', '2019-12-13 10:59:38'),
(18, 'UC00004', '{\"userCode\":\"UC00004\",\"roleName\":\"Perawat\",\"userName\":\"Yuki Umia Susanthi\"}', '::1', 'Chrome 78.0.3904.108', 'Windows 10', '2019-12-16 04:01:12'),
(19, 'UC00004', '{\"userCode\":\"UC00004\",\"roleName\":\"Perawat\",\"userName\":\"Yuki Umia Susanthi\"}', '::1', 'Chrome 78.0.3904.108', 'Windows 10', '2019-12-16 07:43:14'),
(20, 'UC00004', '{\"userCode\":\"UC00004\",\"roleName\":\"Perawat\",\"userName\":\"Yuki Umia Susanthi\"}', '::1', 'Chrome 78.0.3904.108', 'Windows 10', '2019-12-17 05:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients`
--

CREATE TABLE `tbl_patients` (
  `patient_code` varchar(8) NOT NULL,
  `patient_name` varchar(128) NOT NULL,
  `patient_gender` varchar(1) NOT NULL,
  `patient_born_date` date NOT NULL,
  `patient_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`patient_code`, `patient_name`, `patient_gender`, `patient_born_date`, `patient_address`) VALUES
('PC00001', 'Suni', 'P', '1958-12-20', 'Desa Bumiharjo, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00002', 'Gaza', 'L', '2012-03-20', 'Desa Bumiharjo, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00003', 'Firsa', 'P', '2012-08-23', 'Desa Ngadiroyo, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00004', 'Niko', 'L', '2014-05-10', 'Desa Ngadiroyo, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00005', 'Husna', 'P', '2010-12-24', 'Desa Bumiharjo, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00006', 'Wagi', 'P', '1978-03-25', 'Desa Pondoksari, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00007', 'Lastri', 'P', '1979-05-21', 'Desa Pondoksari, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00008', 'Ginem', 'P', '1943-04-10', 'Desa Gebang, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00009', 'Tasya', 'P', '2010-04-12', 'Desa Ngadiroyo, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00010', 'Aura', 'P', '2009-10-20', 'Desa Bumiharjo, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00011', 'Risma', 'P', '2013-01-12', 'Desa Ngadipiro, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00012', 'Cintia', 'P', '2004-01-30', 'Desa Pondoksari, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00013', 'Aska', 'L', '2012-05-20', 'Desa Pondoksari, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00014', 'Nanik', 'P', '1981-06-22', 'Desa Pondoksari, Kec. Nguntoronadi, Kab. Wonogiri'),
('PC00015', 'Aurel', 'P', '2005-03-07', 'Desa Pondoksari, Kec. Nguntoronadi, Kab. Wonogiri');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `role_code` varchar(8) NOT NULL,
  `role_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`role_code`, `role_name`) VALUES
('RC001', 'Administrator'),
('RC002', 'Pakar'),
('RC003', 'Perawat');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rules`
--

CREATE TABLE `tbl_rules` (
  `rule_code` varchar(8) NOT NULL,
  `disease_code` varchar(8) NOT NULL,
  `symptom_code` varchar(8) NOT NULL,
  `cf_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_rules`
--

INSERT INTO `tbl_rules` (`rule_code`, `disease_code`, `symptom_code`, `cf_value`) VALUES
('RL000001', 'DC0001', 'SC00001', 0.9),
('RL000002', 'DC0001', 'SC00002', 0.9),
('RL000003', 'DC0001', 'SC00003', 0.9),
('RL000004', 'DC0002', 'SC00004', 0.8),
('RL000005', 'DC0002', 'SC00005', 0.8),
('RL000006', 'DC0002', 'SC00006', 0.8),
('RL000007', 'DC0002', 'SC00007', 0.8),
('RL000011', 'DC0004', 'SC00011', 0.85),
('RL000012', 'DC0004', 'SC00012', 0.85),
('RL000013', 'DC0004', 'SC00013', 0.85),
('RL000016', 'DC0006', 'SC00016', 0.8),
('RL000018', 'DC0006', 'SC00017', 0.8),
('RL000019', 'DC0007', 'SC00018', 0.75),
('RL000020', 'DC0007', 'SC00019', 0.75),
('RL000021', 'DC0008', 'SC00020', 0.8),
('RL000022', 'DC0008', 'SC00021', 0.8),
('RL000023', 'DC0008', 'SC00022', 0.8),
('RL000025', 'DC0009', 'SC00023', 0.9),
('RL000026', 'DC0009', 'SC00024', 0.9),
('RL000027', 'DC0009', 'SC00025', 0.9),
('RL000031', 'DC0011', 'SC00029', 0.8),
('RL000032', 'DC0011', 'SC00030', 0.8),
('RL000033', 'DC0011', 'SC00031', 0.8),
('RL000034', 'DC0012', 'SC00032', 0.75),
('RL000035', 'DC0012', 'SC00033', 0.75),
('RL000037', 'DC0013', 'SC00035', 0.8),
('RL000038', 'DC0013', 'SC00036', 0.8),
('RL000040', 'DC0014', 'SC00038', 0.8),
('RL000041', 'DC0014', 'SC00039', 0.8),
('RL000042', 'DC0014', 'SC00040', 0.8),
('RL000044', 'DC0015', 'SC00042', 0.9),
('RL000045', 'DC0015', 'SC00043', 0.9),
('RL000046', 'DC0015', 'SC00044', 0.9),
('RL000050', 'DC0012', 'SC00034', 0.75),
('RL000052', 'DC0015', 'SC00045', 0.9),
('RL000053', 'DC0014', 'SC00041', 0.8),
('RL000054', 'DC0013', 'SC00037', 0.8),
('RL000058', 'DC0004', 'SC00008', 0.85),
('RL000061', 'DC0016', 'SC00046', 0.8),
('RL000062', 'DC0016', 'SC00047', 0.8),
('RL000063', 'DC0016', 'SC00048', 0.8),
('RL000065', 'DC0017', 'SC00050', 0.75),
('RL000066', 'DC0017', 'SC00051', 0.75),
('RL000068', 'DC0010', 'SC00026', 0.75),
('RL000069', 'DC0010', 'SC00028', 0.75),
('RL000070', 'DC0010', 'SC00027', 0.75),
('RL000071', 'DC0016', 'SC00049', 0.8),
('RL000072', 'DC0005', 'SC00008', 0.8),
('RL000073', 'DC0005', 'SC00014', 0.8),
('RL000074', 'DC0005', 'SC00015', 0.8),
('RL000075', 'DC0003', 'SC00008', 0.75),
('RL000076', 'DC0003', 'SC00009', 0.75),
('RL000077', 'DC0003', 'SC00010', 0.75),
('RL000079', 'DC0017', 'SC00052', 0.75);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_symptoms`
--

CREATE TABLE `tbl_symptoms` (
  `symptom_code` varchar(8) NOT NULL,
  `symptom_name` varchar(128) NOT NULL,
  `symptom_question` varchar(128) NOT NULL,
  `if_yes` varchar(8) NOT NULL,
  `if_no` varchar(8) NOT NULL,
  `start` varchar(1) NOT NULL,
  `end` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_symptoms`
--

INSERT INTO `tbl_symptoms` (`symptom_code`, `symptom_name`, `symptom_question`, `if_yes`, `if_no`, `start`, `end`) VALUES
('SC00000', 'Tidak ada gejala yang muncul lagi', 'Maaf untuk sementara gejala yang berikutnya tidak muncul.', 'SC00000', 'SC00000', 'T', 'Y'),
('SC00001', 'Gigi susu masih ada', 'Apakah masih terdapat gigi susu?', 'SC00002', 'SC00004', 'Y', 'T'),
('SC00002', 'Gigi susu goyah', 'Apakah gigi susu mengalami goyah ?', 'SC00003', 'DC0000', 'T', 'T'),
('SC00003', 'Gusi gigi mengalami sakit', 'Apakah gusi gigi mengalami sakit?', 'DC0001', 'SC00000', 'T', 'Y'),
('SC00004', 'Gigi terbentur benda keras', 'Apakah gigi terbentur benda keras ?', 'SC00005', 'SC00008', 'T', 'T'),
('SC00005', 'Gigi mengalami goyah', 'Apakah gigi mengalami goyah ?', 'SC00006', 'DC0000', 'T', 'T'),
('SC00006', 'Gusi gigi mengalami pendarahan', 'Apakah gusi gigi mengalami pendarahan ?', 'SC00007', 'DC0000', 'T', 'T'),
('SC00007', 'Wajah mengalami pembengkakan/luka', 'Apakah wajah mengalami pembengkakan/luka ?', 'DC0002', 'SC00000', 'T', 'Y'),
('SC00008', 'Terdapat noda berwarna cokelat, hitam, atau putih pada permukaan gigi', 'Apakah terdapat noda berwarna cokelat, hitam, atau putih pada permukaan gigi ?', 'SC00009', 'SC00016', 'T', 'T'),
('SC00009', 'Terdapat lubang kecil pada enamel gigi', 'Apakah terdapat lubang kecil pada enamel gigi ?', 'SC00010', 'SC00011', 'T', 'T'),
('SC00010', 'Mengalami nyeri ringan hingga tajam saat mengunyah', 'Apakah mengalami nyeri ringan hingga tajam saat mengunyah ?', 'DC0003', 'SC00000', 'T', 'Y'),
('SC00011', 'Terdapat lubang sedang hingga permukaan dentin gigi', 'Apakah terdapat lubang sedang hingga permukaan dentin gigi ?', 'SC00012', 'SC00014', 'T', 'T'),
('SC00012', 'Terdapat makanan yang menyangkut pada gigi', 'Apakah terdapat makanan yang menyangkut pada gigi ?', 'SC00013', 'DC0000', 'T', 'T'),
('SC00013', 'Permukaan gigi terasa kasar', 'Apakah permukaan gigi terasa kasar ?', 'DC0004', 'SC00000', 'T', 'Y'),
('SC00014', 'Tedapat lubang kecil hingga kedalaman dentin gigi.', 'Apakah terdapat lubang kecil hingga kedalaman dentin gigi ?', 'SC00015', 'SC00016', 'T', 'T'),
('SC00015', 'Gigi mengalami nyeri dan ngilu', 'Apakah gigi mengalami rasa nyeri dan ngilu ?', 'DC0005', 'SC00000', 'T', 'Y'),
('SC00016', 'Gusi gigi berwarna kemerahan', 'Apakah gusi gigi berwarna kemerahan ?', 'SC00017', 'SC00018', 'T', 'T'),
('SC00017', 'Terdapat karang pada gigi', 'Apakah terdapat karang pada gigi?', 'DC0006', 'SC00000', 'T', 'Y'),
('SC00018', 'Pembesaran pada tepi gusi gigi', 'Apakah tepi gusi gigi mengalami pembesaran ?', 'SC00019', 'SC00020', 'T', 'T'),
('SC00019', 'Terdapat kalkulus atau plak mikobial', 'Apakah terdapat kalkulus atau plak mikobial ?', 'DC0007', 'SC00000', 'T', 'Y'),
('SC00020', 'Tubuh terasa demam', 'Apakah tubuh mengalami demam ?', 'SC00021', 'SC00023', 'T', 'T'),
('SC00021', 'Pembengkakan pada gusi gigi', 'Apakah gusi gigi mengalami pembengkakan ?', 'SC00022', 'DC0000', 'T', 'T'),
('SC00022', 'Gusi gigi mengalami nyeri', 'Apakah gusi gigi mengalami rasa nyeri ?', 'DC0008', 'SC00000', 'T', 'Y'),
('SC00023', 'Terdapat luka berwarna putih atau merah pada lidah / dinding mulut', 'Apakah terdapat luka berwarna putih atau merah pada lidah / dinding mulut ?', 'SC00024', 'SC00026', 'T', 'T'),
('SC00024', 'Dalam mulut dan tenggorokan berwarna memerah dan terasa perih', 'Apakah didalam mulut dan tenggorokan berwarna memerah dan terasa perih ?', 'SC00025', 'DC0000', 'T', 'T'),
('SC00025', 'Muncul rasa sakit saat menelan makanan', 'Apakah muncul rasa sakit saat menelan makanan ?', 'DC0009', 'SC00000', 'T', 'Y'),
('SC00026', 'Susah makan', 'Apakah mengalami susah makan ?', 'SC00027', 'SC00029', 'T', 'T'),
('SC00027', 'Permukaan lidah berwarna putih dengan pola yang tidak teratur', 'Apakah permukaan lidah berwarna putih dengan pola yang tidak teratur ?', 'SC00028', 'DC0000', 'T', 'T'),
('SC00028', 'Adanya perubahan lokasi, ukuran, dan bentuk pola putih pada lidah', 'Apakah terdapat perubahan lokasi, ukuran, dan bentuk pola putih pada lidah ?', 'DC0010', 'SC00000', 'T', 'Y'),
('SC00029', 'Mulut terasa gatal', 'Apakah mulut terasa gatal ?', 'SC00030', 'SC00032', 'T', 'T'),
('SC00030', 'Munculnya vesikel pada mulut', 'Apakah pada mulut muncul vesikel ?', 'SC00031', 'DC0000', 'T', 'T'),
('SC00031', 'Pembengkakan kelenjar getah bening pada leher', 'Apakah terdapat pembengkakan kelenjar getah bening pada leher ?', 'DC0011', 'SC00000', 'T', 'Y'),
('SC00032', 'Sakit dan timbul banyak bercak gatal dikulit trigeminal, vesikal unilateral, dan ulser mulut', 'Apakah muncul rasa sakit dan timbul banyak bercak gatal dikulit trigeminal, vesikal unilateral, dan ulser mulut ?', 'SC00033', 'SC00035', 'T', 'T'),
('SC00033', 'Tubuh terasa pegal', 'Apakah tubuh terasa pegal ?', 'SC00034', 'DC0000', 'T', 'T'),
('SC00034', 'Tubuh terasa meriang', 'Apakah tubuh terasa meriang ?', 'DC0012', 'SC00000', 'T', 'Y'),
('SC00035', 'Terdapat lubang besar dan tidak mendalam pada gigi', 'Apakah terdapat lubang besar dan tidak mendalam pada gigi ?', 'SC00036', 'SC00038', 'T', 'T'),
('SC00036', 'Gigi mengalami sensitif pada rasa asam, manis, panas, atau dingin', 'Apakah gigi mengalami sensitif pada rasa asam, manis, panas, atau dingin ?', 'SC00037', 'DC0000', 'T', 'T'),
('SC00037', 'Gigi mengalami sakit tajam sebentar', 'Apakah gigi mengalami sakit tajam sebentar ?', 'DC0013', 'SC00000', 'T', 'Y'),
('SC00038', 'Terdapat lubang besar dan dalam pada gigi', 'Apakah terdapat lubang besar dan dalam pada gigi ?', 'SC00039', 'SC00042', 'T', 'T'),
('SC00039', 'Gigi mengalami nyeri spontan', 'Apakah gigi mengalami nyeri spontan ?', 'SC00040', 'DC0000', 'T', 'T'),
('SC00040', 'Gigi mengalami  nyeri sampai daerah sinus, pelipa atau telinga', 'Apakah gigi mengalami  nyeri sampai daerah sinus, pelipa atau telinga ?', 'SC00041', 'DC0000', 'T', 'T'),
('SC00041', 'Gigi terasa sakit saat penghisapan lidah', 'Apakah gigi terasa sakit saat penghisapan lidah ?', 'DC0014', 'SC00000', 'T', 'Y'),
('SC00042', 'Terdapat fistula / lubang pada gigi', 'Apakah terdapat fistula / lubang pada gigi ?', 'SC00043', 'SC00046', 'T', 'T'),
('SC00043', 'Sensitif pada tekanan saat mengunyah', 'Apakah gigi mengalami sensitif pada tekanan saat mengunyah ?', 'SC00044', 'DC0000', 'T', 'T'),
('SC00044', 'Munculnya peradangan disekitar gigi', 'Apakah muncul peradangan disekitar gigi ?', 'SC00045', 'DC0000', 'T', 'T'),
('SC00045', 'Kelenjar getah bening (terdapat benjolan) pada rahang bawah mengalami pembengkakan', 'Apakah kelenjar getah bening (terdapat benjolan) pada rahang bawah mengalami pembengkakan ?', 'DC0015', 'SC00000', 'T', 'Y'),
('SC00046', 'Gusi mengalami perubahan warna', 'Gusi mengalami perubahan warna', 'SC00047', 'SC00050', 'T', 'T'),
('SC00047', 'Sela gigi atau gusi gigi mengalami rasa gatal', 'Apakah sela gigi atau gusi gigi mengalami rasa gatal ?', 'SC00048', 'DC0000', 'T', 'T'),
('SC00048', 'Terdapat penumpukan plak dan karang gigi pada gigi', 'Apakah terdapat penumpukan plak dan karang gigi pada gigi', 'SC00049', 'DC0000', 'T', 'T'),
('SC00049', 'Timbul rasa ngelu', 'Apakah gigi mengalami rasa ngelu ?', 'DC0016', 'SC00000', 'T', 'Y'),
('SC00050', 'Gigi goyah segala arah', 'Apakah gigi mengalami goyah ke segala arah ?', 'SC00051', 'DC0000', 'T', 'T'),
('SC00051', 'Gigi terasa sakit ketika mengunyah', 'Apakah gigi terasa sakit ketika mengunyah ?', 'SC00052', 'DC0000', 'T', 'T'),
('SC00052', 'Gigi berdarah ketika mengunyah', 'Apakah gigi berdarah ketika mengunyah ?', 'DC0017', 'SC00000', 'T', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tmp_diagnosis`
--

CREATE TABLE `tbl_tmp_diagnosis` (
  `user_code` varchar(8) NOT NULL,
  `patient_code` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tmp_symptoms`
--

CREATE TABLE `tbl_tmp_symptoms` (
  `user_code` varchar(8) NOT NULL,
  `symptom_code` varchar(8) NOT NULL,
  `cf_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `role_code` varchar(8) NOT NULL,
  `user_code` varchar(8) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_email` varchar(128) NOT NULL,
  `user_password` varchar(128) NOT NULL,
  `user_activated` tinyint(4) NOT NULL DEFAULT 1,
  `user_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`role_code`, `user_code`, `user_name`, `user_phone`, `user_email`, `user_password`, `user_activated`, `user_deleted`) VALUES
('RC001', 'UC00001', 'Dr.abdul Mursid', '0895401222543', 'admin@gidamu.com', '$2y$10$Hj.wojEmMILSPP1pcyh7ruF9nHjUAGsbgXo3tp/oABZpOgM2iLi0m', 1, 0),
('RC002', 'UC00002', 'Drg. Fasihul Ibad', '081336554112', 'pakar1@gidamu.com', '$2y$10$2ItWjOF82nHkFFZZ2n98SONVXpJmpiBUiarJWucZuAGnbehcYg2cy', 1, 0),
('RC002', 'UC00003', 'Pakar 2', '0895401222543', 'pakar2@gidamu.com', '$2y$10$zLk9m6k2PKK7dEfpPgGVhu4lBfNGZ0PwMMaDe0bTGilOswQQEvHOq', 1, 0),
('RC003', 'UC00004', 'Yuki Umia Susanthi', '085328735965', 'perawat1@gidamu.com', '$2y$10$..H3DxgjmFPNkBchcOChG.qR8BnIq9Xwh.PammcjYH9JbCao1awLC', 1, 0),
('RC003', 'UC00005', 'Perawat 2', '0895401222543', 'perawat2@gidamu.com', '$2y$10$YkCVXprUibO1GzMRmU3EAubz6AdG0N7N0o.kTF7U9G5WpE10Uw2BO', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_diagnosis`
--
ALTER TABLE `tbl_diagnosis`
  ADD PRIMARY KEY (`diagnosis_code`),
  ADD KEY `fk_diagnosis_1` (`patient_code`),
  ADD KEY `fk_diagnosis_2` (`disease_code`),
  ADD KEY `fk_diagnosis_3` (`created_by`);

--
-- Indexes for table `tbl_diseases`
--
ALTER TABLE `tbl_diseases`
  ADD PRIMARY KEY (`disease_code`);

--
-- Indexes for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_last_login_1` (`user_code`) USING BTREE;

--
-- Indexes for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  ADD PRIMARY KEY (`patient_code`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`role_code`);

--
-- Indexes for table `tbl_rules`
--
ALTER TABLE `tbl_rules`
  ADD PRIMARY KEY (`rule_code`),
  ADD KEY `fk_rules_1` (`disease_code`),
  ADD KEY `fk_rules_2` (`symptom_code`);

--
-- Indexes for table `tbl_symptoms`
--
ALTER TABLE `tbl_symptoms`
  ADD PRIMARY KEY (`symptom_code`);

--
-- Indexes for table `tbl_tmp_diagnosis`
--
ALTER TABLE `tbl_tmp_diagnosis`
  ADD KEY `fk_tmp_diagnosis_1` (`user_code`),
  ADD KEY `fk_tmp_diagnosis_2` (`patient_code`);

--
-- Indexes for table `tbl_tmp_symptoms`
--
ALTER TABLE `tbl_tmp_symptoms`
  ADD KEY `fk_tmp_symptoms_1` (`user_code`),
  ADD KEY `fk_tmp_symptoms_2` (`symptom_code`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_code`),
  ADD KEY `fk_users_1` (`role_code`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_diagnosis`
--
ALTER TABLE `tbl_diagnosis`
  ADD CONSTRAINT `fk_diagnosis_1` FOREIGN KEY (`patient_code`) REFERENCES `tbl_patients` (`patient_code`),
  ADD CONSTRAINT `fk_diagnosis_2` FOREIGN KEY (`disease_code`) REFERENCES `tbl_diseases` (`disease_code`),
  ADD CONSTRAINT `fk_diagnosis_3` FOREIGN KEY (`created_by`) REFERENCES `tbl_users` (`user_code`);

--
-- Constraints for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD CONSTRAINT `fk_last_login_user_code_1` FOREIGN KEY (`user_code`) REFERENCES `tbl_users` (`user_code`),
  ADD CONSTRAINT `fk_user_code_1` FOREIGN KEY (`user_code`) REFERENCES `tbl_users` (`user_code`);

--
-- Constraints for table `tbl_rules`
--
ALTER TABLE `tbl_rules`
  ADD CONSTRAINT `fk_rules_1` FOREIGN KEY (`disease_code`) REFERENCES `tbl_diseases` (`disease_code`),
  ADD CONSTRAINT `fk_rules_2` FOREIGN KEY (`symptom_code`) REFERENCES `tbl_symptoms` (`symptom_code`);

--
-- Constraints for table `tbl_tmp_diagnosis`
--
ALTER TABLE `tbl_tmp_diagnosis`
  ADD CONSTRAINT `fk_tmp_diagnosis_1` FOREIGN KEY (`user_code`) REFERENCES `tbl_users` (`user_code`),
  ADD CONSTRAINT `fk_tmp_diagnosis_2` FOREIGN KEY (`patient_code`) REFERENCES `tbl_patients` (`patient_code`);

--
-- Constraints for table `tbl_tmp_symptoms`
--
ALTER TABLE `tbl_tmp_symptoms`
  ADD CONSTRAINT `fk_tmp_symptoms_1` FOREIGN KEY (`user_code`) REFERENCES `tbl_users` (`user_code`),
  ADD CONSTRAINT `fk_tmp_symptoms_2` FOREIGN KEY (`symptom_code`) REFERENCES `tbl_symptoms` (`symptom_code`);

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `fk_users_role_code_1` FOREIGN KEY (`role_code`) REFERENCES `tbl_roles` (`role_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
