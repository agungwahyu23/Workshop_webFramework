-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2020 at 12:08 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuliah_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `kode_artikel` int(3) NOT NULL,
  `penulis` varchar(40) NOT NULL,
  `judul` varchar(75) NOT NULL,
  `deskripsi` text NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`kode_artikel`, `penulis`, `judul`, `deskripsi`, `create_at`) VALUES
(1, 'andrean', 'buku', 'buku bagus', '2020-03-02 13:48:10'),
(2, 'andrean', 'Membuat Rancangan', 'sip', '2020-03-05 08:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `kerja`
--

CREATE TABLE `kerja` (
  `kode_kerja` int(3) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `lowker` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kerja`
--

INSERT INTO `kerja` (`kode_kerja`, `nama`, `no_hp`, `lowker`, `create_at`) VALUES
(2, 'Andrean Three Saputra', '089696491481', 'coding', '2020-03-09 16:01:31'),
(3, 'dingga', '324324', 'ssd', '2020-03-09 16:30:49');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `kode_pengguna` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`kode_pengguna`, `nama`, `email`, `password`, `create_at`) VALUES
(1, 'aaa', 'aa@mail.com', '202cb962ac59075b964b07152d234b70', '2020-03-28 20:08:10'),
(3, 'Andrean Three', 'andreanthree1@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-03-28 22:30:24'),
(4, 'Andre', 'andreanthree@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-04-08 05:04:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`kode_artikel`);

--
-- Indexes for table `kerja`
--
ALTER TABLE `kerja`
  ADD PRIMARY KEY (`kode_kerja`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`kode_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `kode_artikel` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kerja`
--
ALTER TABLE `kerja`
  MODIFY `kode_kerja` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `kode_pengguna` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
