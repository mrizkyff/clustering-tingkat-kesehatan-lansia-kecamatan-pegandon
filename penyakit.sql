-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 30, 2021 at 04:07 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cluster_kesehatan`
--

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id` int(11) NOT NULL,
  `nama_desa` varchar(50) NOT NULL,
  `mental` int(11) DEFAULT NULL,
  `imt` int(11) DEFAULT NULL,
  `tek_darah` int(11) DEFAULT NULL,
  `hb_kurang` int(11) DEFAULT NULL,
  `kolesterol` int(11) DEFAULT NULL,
  `dm` int(11) DEFAULT NULL,
  `asam_urat` int(11) DEFAULT NULL,
  `ginjal` int(11) DEFAULT NULL,
  `kognitif` int(11) DEFAULT NULL,
  `pengelihatan` int(11) DEFAULT NULL,
  `pendengaran` int(11) DEFAULT NULL,
  `cluster` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id`, `nama_desa`, `mental`, `imt`, `tek_darah`, `hb_kurang`, `kolesterol`, `dm`, `asam_urat`, `ginjal`, `kognitif`, `pengelihatan`, `pendengaran`, `cluster`) VALUES
(1, 'PEKUNCEN', 5, 57, 146, 16, 55, 50, 54, 0, 12, 24, 32, 2),
(2, 'PUGUH', 7, 33, 137, 40, 71, 59, 61, 0, 4, 10, 33, 2),
(3, 'WONOSARI', 2, 16, 143, 15, 62, 71, 46, 0, 0, 16, 34, 2),
(4, 'DAWUNGSARI', 19, 41, 134, 30, 53, 64, 44, 2, 15, 21, 19, 2),
(5, 'MARGOMULYO', 3, 29, 143, 12, 42, 47, 34, 0, 14, 22, 34, 2),
(6, 'TEGOREJO', 24, 57, 215, 28, 52, 120, 70, 0, 20, 14, 54, 1),
(7, 'PESAWAHAN', 5, 58, 138, 28, 36, 53, 50, 0, 16, 32, 32, 2),
(8, 'PEGANDON', 9, 25, 140, 28, 54, 57, 46, 0, 5, 15, 34, 2),
(9, 'PENANGGULAN', 0, 40, 134, 11, 55, 82, 63, 0, 11, 35, 47, 2),
(10, 'GUBUGSARI', 11, 46, 120, 12, 55, 50, 60, 0, 0, 13, 34, 2),
(11, 'PUCANGREJO', 18, 23, 128, 32, 54, 44, 26, 0, 10, 20, 28, 2),
(12, 'KARANGMULYO', 4, 17, 111, 30, 49, 48, 43, 0, 0, 46, 26, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
