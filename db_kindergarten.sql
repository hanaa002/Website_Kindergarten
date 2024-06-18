-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 09:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kindergarten`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'Admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `barang_bawaan`
--

CREATE TABLE `barang_bawaan` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL DEFAULT '',
  `info_kegiatan` varchar(50) NOT NULL DEFAULT '',
  `tgl_bawa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_bawaan`
--

INSERT INTO `barang_bawaan` (`id_barang`, `nama_barang`, `info_kegiatan`, `tgl_bawa`) VALUES
(1, 'Sapu Lidi', 'Kerja Bakti', '2024-06-11'),
(3, 'Belimbing Bintang', 'Mengenal warna dengan men-cap menggunakan bentuk b', '2024-06-19'),
(4, 'Kertas Origami & Gunting', 'Membuat berbagai macam karakter menggunakan origam', '2024-06-25');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nip` varchar(10) NOT NULL DEFAULT '',
  `nama_guru` varchar(50) NOT NULL DEFAULT '',
  `alamat_guru` varchar(50) NOT NULL DEFAULT '',
  `jns_kel_guru` enum('L','P') NOT NULL,
  `password_guru` varchar(255) NOT NULL DEFAULT '',
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama_guru`, `alamat_guru`, `jns_kel_guru`, `password_guru`, `foto`) VALUES
(1, '2020', 'Handoko', 'Bulan', 'L', '$2y$10$Ft9boM2nzuGd7tPtAOv19u93qzx2xkcb213FfW6xGYsd0TM3h90QK', ''),
(2, '123', 'Jeno', 'Kwangya', 'L', '$2y$10$R2LenSP5VdAGZgqQSrwtbeXzHV/7VrrdZw1ODxMcbtLx4uP1ESVFK', 'Renjun.jfif'),
(3, '1212', 'sally', 'Surabaya', 'P', '$2y$10$8YzDpIzO4IXByvIEax3m9.NGJbvoxB2V42I8XKxoShGs2Dj0K/DfC', 'download.jfif'),
(5, '1230', 'Renjun', 'Surabaya', 'L', '$2y$10$Nv.aPjRrKHWISJtqWqopMeKXdHSo2FaVG.c7JOfcK3OHTwDy6J/bi', 'SHOOPINK.png'),
(6, '12345', 'Didi', 'Surabaya', 'L', '$2y$10$Du6ObPG3W50tKMyF7xV35OqTWUrx0j.xHbuORcRuumXAI0SpnMO1y', 'gallery-3.jpg'),
(8, '3030', 'Windah', 'Surabaya', 'P', '$2y$10$mZsrBuJHB/e4V5z8qQOEoOjfUcwwe0NcBcq2.iOOMSoq5bVIM7WXm', 'masak.png');

-- --------------------------------------------------------

--
-- Table structure for table `informasi_kegiatan`
--

CREATE TABLE `informasi_kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` varchar(50) NOT NULL DEFAULT '',
  `deskripsi` varchar(50) NOT NULL DEFAULT '',
  `dokumentasi` varchar(255) DEFAULT '',
  `tgl_kegiatan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `informasi_kegiatan`
--

INSERT INTO `informasi_kegiatan` (`id_kegiatan`, `nama_kegiatan`, `deskripsi`, `dokumentasi`, `tgl_kegiatan`) VALUES
(2, 'Manasik Haji', 'Manasik haji kecil di alun alun sidoarjo', 'image3.jpg', '2024-06-11'),
(3, 'Outbond ', 'melakukan outbond bersama teman-teman di taman pel', 'outbond.jpeg', '2024-06-18'),
(4, 'Memasak Bersama', 'Melakukan Praktek memasak ubi kuning bersama', 'masak.png', '2024-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nilai` varchar(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL DEFAULT '',
  `tgl_input` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_siswa`, `nilai`, `kategori`, `deskripsi`, `tgl_input`) VALUES
(6, 8, 'A', 'Nilai Akademik', 'Raca memiliki kemampuan akademik yang baik. Ia dapat memahami dan menerapkan konsep-konsep dasar Berhitung dengan cukup baik, serta berpartisipasi aktif dalam kegiatan belajar mengajar. ', '2024-06-17'),
(7, 8, 'B', 'Nilai Budi Pekerti', 'Raca memiliki sikap dan perilaku yang baik. Ia umumnya bersikap sopan kepada guru dan teman-temannya, serta menunjukkan rasa hormat dan empati. Meskipun ada kalanya perlu diingatkan untuk mengikuti aturan', '2024-06-10'),
(8, 7, 'A', 'Nilai Jati Diri', 'Abrory memiliki kepercayaan diri yang baik dan menunjukkan kepribadian yang positif. Ia mampu mengungkapkan pendapatnya dan bekerja sama dengan teman-teman dalam kelompok. ', '2024-06-17'),
(9, 10, 'A', 'Nilai Akademik', 'Hilmira memiliki kemampuan yang meningkat pesat dalam hafalan bahasa inggris mengenai warna-warna dasar di minggu ini, Good Job hilmira', '2024-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL DEFAULT '',
  `nama_siswa` varchar(50) NOT NULL DEFAULT '',
  `alamat_siswa` varchar(50) NOT NULL DEFAULT '',
  `jenis_kelamin` enum('L','P') NOT NULL,
  `password_siswa` varchar(255) NOT NULL DEFAULT '',
  `tinggi_badan` int(11) NOT NULL DEFAULT 0,
  `berat_badan` int(11) NOT NULL DEFAULT 0,
  `nama_ortu` varchar(50) NOT NULL DEFAULT '',
  `notelp_ortu` varchar(50) NOT NULL DEFAULT '',
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nisn`, `nama_siswa`, `alamat_siswa`, `jenis_kelamin`, `password_siswa`, `tinggi_badan`, `berat_badan`, `nama_ortu`, `notelp_ortu`, `foto`) VALUES
(1, '1010', 'Agus Renaldo', 'Tanggul Angin, Sidoarjo', 'L', '$2y$10$Ft9boM2nzuGd7tPtAOv19u93qzx2xkcb213FfW6xGYsd0TM3h90QK', 105, 18, 'Yanto cibi', '0987654321', 'agus.jpg'),
(2, '0202', 'Mario', 'Tulangan, SIdoarjo', 'L', '$2y$10$XQO6o1/YZa0s.Je/fI19mORB3pP5lrBftoh/F6P1A8Ywf6wsB2ZIK', 100, 20, 'Rahul', '085851161298', 'mario.jpg'),
(3, '1111', 'Maudy Effrosina', 'Tulangan, Sidoarjo ', 'P', '$2y$10$xqPpaUEc6yDX9E5jo7MxsuCTVAFJjfFVuxPP/RvkvU7IUyldtJxVK', 106, 17, 'Fidiya', '087118998023', 'maudy.jpg'),
(4, '1112', 'Mawar Eva', 'Tulangan, Sidoarjo ', 'P', '$2y$10$yLnwT0siEl2Ow9WC2lP9tOOhvYRxDoQdoRggS3XWrKsA75Kuqa28e', 109, 19, 'Aliando', '081123453709', 'mawar.jpg'),
(5, '1113', 'Abdul Anwar ', 'Tulangan, Sidoarjo ', 'L', '$2y$10$/EG8oLjvQwhGBiT2/2Zj.OfbpQPZnXPapqi8Hwfek/SSXBs4Lyofi', 110, 20, 'Lukman', '089902675145', 'abdul.jpg'),
(6, '1114', 'Reyza Risky', 'Tanggul Angin, Sidoarjo', 'L', '$2y$10$IL5eMeo6m6vn235HjhGo/.7E6QA.Xm2szqm7SYQePqS5K9LlQV6Ly', 110, 21, 'Rakha', '087990564231', 'reyza.jpg'),
(7, '1115', 'Abrory Miguel', 'Tulangan, Sidoarjo ', 'L', '$2y$10$muTT/fNYHSt6VbH9UiRnou6hDutOGDDPeLTw2ucz4VkGarvx/fSEq', 107, 19, 'Deva', '087115268907', 'abrory.jpg'),
(8, '1116', 'Raca Januar', 'Tulangan, Sidoarjo ', 'L', '$2y$10$kJdOxlfuf4PMoxn461nlWeWXAMHOCsPiUaFuEbA5Q/k9v89eKVs22', 107, 19, 'Izzah', '089076245617', 'caca.jpg'),
(9, '1117', 'Fitri Tsabita ', 'Tulangan, Sidoarjo ', 'P', '$2y$10$xk4aDcTqqnIiAwW3qX488eEt3ZpRlyUc/DVJRUUtGytHUmZR8kIcy', 105, 16, 'Ariyak', '087652441098', NULL),
(10, '1118', 'Hilmira Fara', 'Tulangan, Sidoarjo ', 'P', '$2y$10$EarXU.XQTWsse2v.H2QjR.ZknmZMhmtBgjAIH66ZgMgIdLAw.AWle', 109, 19, 'Maulana', '08988026152', NULL),
(11, '1119', 'Dirga Akbar', 'Tanggul Angin, Sidoarjo', 'L', '$2y$10$1oSS4pX2a61UFOGaGpyhgOeP3rQrf6KMO.4Kfy9jOymN9KgYLxdqO', 110, 23, 'Anggi', '087678493028', NULL),
(13, '1101', 'Nadlyne Aurora', 'Tanggul Angin, Sidoarjo', 'P', '$2y$10$rtvEaYf5TMU2MFN1SfRPMu9jgzSmzMl8bhawNhUJJ925z9Mvejmkq', 110, 19, 'Sana', '087678493028', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang_bawaan`
--
ALTER TABLE `barang_bawaan`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `informasi_kegiatan`
--
ALTER TABLE `informasi_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nisn` (`nisn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang_bawaan`
--
ALTER TABLE `barang_bawaan`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `informasi_kegiatan`
--
ALTER TABLE `informasi_kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `id_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
