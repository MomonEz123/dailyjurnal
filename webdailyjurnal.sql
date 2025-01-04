-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2025 at 05:23 AM
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
-- Database: `webdailyjurnal`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `isi` text NOT NULL,
  `gambar` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Orang Karbit', 'Waspadalah sosok karbit yang suka mengerjakan tugas dengan tidak serius dan yang penting selesai.', 'Anda siapa ratio.JPG', '2024-12-18 19:01:31', 'admin'),
(2, 'Panggil Ustad', 'Orang ini sudah di diagnosa gangguan jiwa karena terlalu lama menjoblo.', 'my kisah ratio.JPG', '2024-12-18 18:44:51', 'admin'),
(3, 'P By One', 'Kalau masalah permainan satu ini tidak diragukan lagi kemampuan dari admin yang membuat web sudah diatas rata-rata.', 'maen ygo ratio.JPG', '2024-12-18 18:46:08', 'admin'),
(4, 'Jadi Sider', 'Bahkan dengan akalnya ikut organisasi mahasiswa dirinya tetap jadi NPC.', 'DI day1 ratio.JPG', '2024-12-18 18:46:00', 'admin'),
(5, 'Upacara', 'Mahasiswa, upacara memperingati hari besar? CIH.... TIDAK AKAN.', 'orma bersama ratio.JPG', '2024-12-18 18:45:51', 'admin'),
(6, 'Adegan Berbahaya', 'Peringatan adegan diatas hanya dilakukan orang gabut yang mencari kegiatan supaya tidak dicap nolep oleh orangtuanya sendiri.', 'Rapat ratio.JPG', '2024-12-18 18:45:42', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `judul` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `judul`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Panggil Ustad', 'my kisah ratio gallery.jpg', '2025-01-03 17:32:24', 'admin'),
(2, 'Orang Karbit', 'Anda siapa ratio gallery.jpg', '2025-01-03 17:39:57', 'admin'),
(3, 'P By One', 'maen ygo ratio gallery.jpg', '2025-01-03 17:43:24', 'admin'),
(4, 'Jadi Sider', 'DI day1 ratio gallery.jpg', '2025-01-03 17:48:09', 'admin'),
(5, 'Upacara', 'orma bersama ratio gallery.jpg', '2025-01-03 17:51:43', 'admin'),
(6, 'Adegan Berbahaya', 'Rapat ratio gallery.jpg', '2025-01-03 17:52:13', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `gambar`) VALUES
(1, 'admin', '751cb3f4aa17c36186f4856c8982bf27', 'Anda siapa ratio user.JPG'),
(2, 'selamet kopling', 'd861f982b39dd6d2825d7410f62530e5', 'selamet kopling user.jpg'),
(3, 'linnggang guli', 'd39e9ca94611f7f717ef9e98b9221b6d', 'linggang gulli user.jpeg'),
(4, 'danny', '21232f297a57a5a743894a0e4a801fc3', 'Danny user.jpg'),
(5, 'sigit', 'd1a6a6dd46027f8a5f29d00ee470433f', 'sigit user.jpeg'),
(6, 'manis', '1ff12f88e06e43b83ee2e3b7b06bdd77', 'si manis user.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
