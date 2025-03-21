-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 08:06 AM
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
-- Database: `db_rekam_medis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `id_dokter` int(5) NOT NULL,
  `nama_dokter` varchar(30) NOT NULL,
  `jk_dokter` varchar(15) NOT NULL,
  `alamat_dokter` varchar(30) NOT NULL,
  `umur` int(10) NOT NULL,
  `stts` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama_dokter`, `jk_dokter`, `alamat_dokter`, `umur`, `stts`) VALUES
(1, 'gunawan dwi cahyo', 'Laki-laki', 'Jl Granger, No.24 ', 35, '1'),
(2, 'syahrul anwar ramadhan', 'Laki-laki', 'Jl. Miya Estehmiya No.21', 27, '1'),
(3, 'Muthia Azzahra', 'Perempuan', 'Jl. Cibubur Raya Bogor', 28, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` int(10) NOT NULL,
  `nik_pasien` varchar(25) NOT NULL,
  `nama_pasien` varchar(30) NOT NULL,
  `umur` int(10) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat_pasien` text NOT NULL,
  `tgl_daftar` date NOT NULL,
  `stts` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `nik_pasien`, `nama_pasien`, `umur`, `jk`, `tgl_lahir`, `alamat_pasien`, `tgl_daftar`, `stts`) VALUES
(1, '0001775251102441332014445', 'indra gunawan', 28, 'Laki-laki', '1997-04-21', 'semarang tengah', '2025-03-13', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendaftaran`
--

CREATE TABLE `tb_pendaftaran` (
  `no_pendaftaran` int(10) NOT NULL,
  `id_pasien` int(20) NOT NULL,
  `id_dokter` int(20) NOT NULL,
  `tgl_periksa` varchar(25) NOT NULL,
  `waktu_pendaftaran` varchar(25) NOT NULL,
  `stts` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_pendaftaran`
--

INSERT INTO `tb_pendaftaran` (`no_pendaftaran`, `id_pasien`, `id_dokter`, `tgl_periksa`, `waktu_pendaftaran`, `stts`) VALUES
(1, 1, 3, '13:12:32 20-03-2025', '16:25:49 16-03-2025', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekam_medis`
--

CREATE TABLE `tb_rekam_medis` (
  `id` int(5) NOT NULL,
  `id_pasien` int(10) NOT NULL,
  `id_dokter` int(5) NOT NULL,
  `tgl_periksa` varchar(25) NOT NULL,
  `umur` int(5) NOT NULL,
  `terapi` varchar(50) NOT NULL,
  `diagnosa` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_rekam_medis`
--

INSERT INTO `tb_rekam_medis` (`id`, `id_pasien`, `id_dokter`, `tgl_periksa`, `umur`, `terapi`, `diagnosa`) VALUES
(1, 1, 3, '13:12:32 20-03-2025', 28, 'Cek Rutin', 'Hipertensi + Autoimun');

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

CREATE TABLE `tb_setting` (
  `id_setting` int(5) NOT NULL,
  `nama_developer` varchar(200) NOT NULL,
  `nama_website` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `foto_icon` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_setting`
--

INSERT INTO `tb_setting` (`id_setting`, `nama_developer`, `nama_website`, `alamat`, `foto_icon`) VALUES
(1, 'IkoAlmasDevGame', 'Aplikasi Rekam Medis (Rumah Sakit)', 'Jl. Gang Haji Kohir', 'logo_icon.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_pengguna` int(5) NOT NULL,
  `id_dokter` int(5) DEFAULT NULL,
  `pengguna` varchar(50) NOT NULL,
  `sandi` varchar(64) NOT NULL,
  `hak_akses` enum('admin','dokter','kepala_klinik') NOT NULL,
  `status` enum('offline','online') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_pengguna`, `id_dokter`, `pengguna`, `sandi`, `hak_akses`, `status`) VALUES
(1, NULL, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'offline'),
(2, NULL, 'kepala', '870f669e4bbbfa8a6fde65549826d1c4', 'kepala_klinik', 'offline'),
(3, 1, 'gunawan', 'dc96b97c4ffbead46ca25ef5d4b77cbe', 'dokter', 'offline'),
(4, 2, 'syahrul', '95ffb7a15f02c6c23f403edeae956a42', 'dokter', 'offline'),
(5, 3, 'MuthiaAzzahra', '5a433f9aee1084b9c84e4a731bed2d4b', 'dokter', 'offline');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  ADD PRIMARY KEY (`no_pendaftaran`);

--
-- Indexes for table `tb_rekam_medis`
--
ALTER TABLE `tb_rekam_medis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_setting`
--
ALTER TABLE `tb_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  MODIFY `id_dokter` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  MODIFY `id_pasien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  MODIFY `no_pendaftaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_rekam_medis`
--
ALTER TABLE `tb_rekam_medis`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `id_setting` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_pengguna` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
