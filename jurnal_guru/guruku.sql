-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2020 at 06:19 PM
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
-- Database: `guruku`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `kode_guru` varchar(16) NOT NULL,
  `kode_jurusan` varchar(16) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `upah` bigint(8) NOT NULL DEFAULT '0',
  `no_hp` varchar(14) NOT NULL,
  `no_wa` varchar(14) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL,
  `create_by` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`kode_guru`, `kode_jurusan`, `nama_guru`, `upah`, `no_hp`, `no_wa`, `alamat`, `status`, `create_at`, `create_by`) VALUES
('54864WWK6RJED073', 'WKIUFLX6G7I63EU4', 'Hendrawan', 0, '9012381029', '', '', 1, '2020-03-22 00:39:30', 'ADMINADMINADMINADMINADMIN'),
('AVSOFVENOYMAS6EY', 'M7ITG8FI1O607TNS', 'Andrean Three Saputra', 50334, '089696491481', '', 'jalan pelita', 1, '2020-03-04 19:51:14', 'ADMINADMINADMINADMINADMIN'),
('H9K6YKXQ7OA36J9N', '43TTJSBRG7K0XEU1', 'abiyu chanda', 1366667, '', '', 'kembang', 1, '2020-03-04 19:55:21', 'ADMINADMINADMINADMINADMIN'),
('M61OGKF2K50V281K', 'M7ITG8FI1O607TNS', 'ryan', 0, '', '', '', 1, '2020-03-18 15:25:25', 'ADMINADMINADMINADMINADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `kode_hari` varchar(8) NOT NULL,
  `urutan` int(1) NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`kode_hari`, `urutan`, `aktif`) VALUES
('Jumat', 5, 1),
('Kamis', 4, 1),
('Minggu', 7, 1),
('Rabu', 3, 1),
('Sabtu', 6, 1),
('Selasa', 2, 1),
('Senin', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ijin_guru`
--

CREATE TABLE `ijin_guru` (
  `kode_ijin` varchar(16) NOT NULL,
  `kode_guru` varchar(16) NOT NULL,
  `awal` datetime NOT NULL,
  `akhir` datetime NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `lampiran` varchar(75) NOT NULL DEFAULT 'assets/default.png',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1 = wait acc 2 = acc 3 = tolak 0 = batal',
  `create_at` datetime NOT NULL,
  `create_by` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ijin_guru`
--

INSERT INTO `ijin_guru` (`kode_ijin`, `kode_guru`, `awal`, `akhir`, `keterangan`, `lampiran`, `status`, `create_at`, `create_by`) VALUES
('028MNIUZ2OE8KTHX', 'AVSOFVENOYMAS6EY', '2020-03-15 11:05:00', '2020-03-26 11:05:00', 'Tesk Gan', 'assets/default.png', 2, '2020-03-16 11:05:17', 'FHV894T2YNK0MKF4U0LBINMARDVS1JUH'),
('7RYCHFW5XW9X9F4M', 'M61OGKF2K50V281K', '2020-04-03 21:52:00', '2020-04-08 21:52:00', 'Izin Kepentingan Pribadi', 'assets/default.png', 1, '2020-04-03 21:53:00', 'NKDCQHPAN9GH8SYCMX9CKED2WYLGDZ36'),
('FTRHCHNWE8YETBBX', 'AVSOFVENOYMAS6EY', '2020-03-12 00:00:00', '2020-03-13 23:59:59', 'perjalanan dinas 2', 'assets/upload/ijin/6578ba3e77557cf147d4390883b6c31c.jpeg', 2, '2020-03-08 18:08:35', 'FHV894T2YNK0MKF4U0LBINMARDVS1JUH'),
('K22L20TL6NDXJDNL', 'AVSOFVENOYMAS6EY', '2020-03-08 00:00:00', '2020-03-10 23:59:59', 'perjalanan dinas', 'assets/default.png', 2, '2020-03-08 18:08:08', 'FHV894T2YNK0MKF4U0LBINMARDVS1JUH');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `kode_jadwal` varchar(16) NOT NULL,
  `kode_kelas` varchar(16) NOT NULL,
  `kode_mapel` varchar(16) NOT NULL,
  `kode_guru` varchar(16) NOT NULL,
  `kode_tahun` varchar(16) NOT NULL,
  `semester` int(1) NOT NULL DEFAULT '1',
  `hari` varchar(6) NOT NULL,
  `jam_awal` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `this_week` int(1) NOT NULL DEFAULT '0' COMMENT '0 = belum 1 = sudah 2 = proses',
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`kode_jadwal`, `kode_kelas`, `kode_mapel`, `kode_guru`, `kode_tahun`, `semester`, `hari`, `jam_awal`, `jam_akhir`, `status`, `this_week`, `create_at`) VALUES
('0N4WAM1SDQXI2L4G', '80L7Z6SI', 'BQXAQIO1OVIF2QUD', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 1, 'Senin', '02:00:00', '23:37:00', 1, 0, '2020-03-05 01:10:21'),
('11C8YRKZH4O9FY6W', '2SDNB5LXM6EFMC3X', 'O3BMB28OMK69997X', '54864WWK6RJED073', 'CD4XM6DJGLX5ERDH', 2, 'Minggu', '09:00:00', '09:15:00', 1, 0, '2020-03-28 15:58:23'),
('2T7QA7W5FVY40KKX', '80L7Z6SI', 'O3BMB28OMK69997X', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 2, 'Kamis', '12:22:00', '14:00:00', 1, 0, '2020-03-25 03:06:07'),
('3BQ0QUMR8YMGOA7X', '3SCOM14X', 'MXQNA5814PJ0A2D0', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 2, 'Senin', '04:38:00', '20:00:00', 1, 1, '2020-03-22 18:37:23'),
('5IZ3N6MRVFD0D3YR', '80L7Z6SI', 'O3BMB28OMK69997X', 'H9K6YKXQ7OA36J9N', 'CD4XM6DJGLX5ERDH', 2, 'Selasa', '09:00:00', '10:30:00', 1, 0, '2020-04-03 01:39:49'),
('65S7NV5AMDTK99M0', '3SCOM14X', 'O3BMB28OMK69997X', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 1, 'Jumat', '01:00:00', '23:59:00', 1, 0, '2020-03-10 00:21:32'),
('67LLV9HVQWO5WPMK', '3SCOM14X', 'WPOXJSZQSFQARQFJ', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 2, 'Selasa', '10:00:00', '09:00:00', 1, 0, '2020-03-25 03:01:03'),
('7PB7ZUNRPB84MZ39', '3SCOM14X', '0DLZI2PQ4QTDOE7Z', 'M61OGKF2K50V281K', 'CD4XM6DJGLX5ERDH', 2, 'Minggu', '09:00:00', '09:15:00', 1, 0, '2020-03-28 15:57:38'),
('8GTA75VTC6LRJX3O', '80L7Z6SI', 'WPOXJSZQSFQARQFJ', '54864WWK6RJED073', 'CD4XM6DJGLX5ERDH', 2, 'Senin', '04:38:00', '10:00:00', 1, 0, '2020-03-23 04:30:06'),
('8Y8XNSUCW8F33U8U', '3SCOM14X', 'O3BMB28OMK69997X', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 2, 'Rabu', '10:00:00', '11:11:00', 1, 0, '2020-03-25 03:01:17'),
('92VNIVVEKRWWC7NQ', 'YDEODAFS95EQRWUG', 'O3BMB28OMK69997X', 'M61OGKF2K50V281K', 'CD4XM6DJGLX5ERDH', 2, 'Sabtu', '02:00:00', '02:30:00', 1, 1, '2020-04-04 02:05:52'),
('962UQXQRREWNTMKI', '3SCOM14X', 'O3BMB28OMK69997X', 'H9K6YKXQ7OA36J9N', 'CD4XM6DJGLX5ERDH', 1, 'rabu', '12:11:00', '11:11:00', 0, 0, '2020-03-05 08:12:44'),
('9GG01PIKQZSMU88V', 'YDEODAFS95EQRWUG', 'MXQNA5814PJ0A2D0', '54864WWK6RJED073', 'CD4XM6DJGLX5ERDH', 1, 'Minggu', '00:30:00', '02:00:00', 1, 0, '2020-03-22 00:41:05'),
('BGVGIT2G2V3NF6XJ', '3SCOM14X', 'MXQNA5814PJ0A2D0', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 2, 'Senin', '12:00:00', '14:00:00', 1, 0, '2020-04-03 01:58:02'),
('D0QE8YTRAPEA2BXH', '80L7Z6SI', 'BQXAQIO1OVIF2QUD', 'H9K6YKXQ7OA36J9N', 'CD4XM6DJGLX5ERDH', 1, 'Jumat', '14:00:00', '16:00:00', 1, 0, '2020-03-12 23:28:15'),
('DDNTIS2AJURSAZZE', '80L7Z6SI', 'WPOXJSZQSFQARQFJ', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 2, 'Rabu', '00:11:00', '10:00:00', 1, 0, '2020-03-25 03:05:11'),
('DXM0LHQ2WMWHMMXZ', 'YDEODAFS95EQRWUG', 'WPOXJSZQSFQARQFJ', '54864WWK6RJED073', 'CD4XM6DJGLX5ERDH', 1, 'Minggu', '00:45:00', '04:00:00', 1, 0, '2020-03-22 00:41:30'),
('H2SDD5IX614XJ7MS', '3SCOM14X', 'O3BMB28OMK69997X', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 2, 'Sabtu', '05:25:00', '15:35:00', 1, 0, '2020-03-28 15:19:07'),
('KEHFDRC9Q9O4JLO1', '3SCOM14X', 'BQXAQIO1OVIF2QUD', 'M61OGKF2K50V281K', 'CD4XM6DJGLX5ERDH', 2, 'Senin', '10:00:00', '11:00:00', 1, 0, '2020-04-03 01:39:48'),
('M6LTNM476OHJV3XH', '80L7Z6SI', '5HJQQWLJEG3J4AKI', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 1, 'Sabtu', '03:11:00', '10:00:00', 1, 0, '2020-03-06 08:06:14'),
('MMB9WIM4VO3ZRYTD', '80L7Z6SI', 'O3BMB28OMK69997X', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 1, 'Jumat', '09:00:00', '23:59:00', 1, 0, '2020-03-12 09:09:55'),
('O0X0E1G1EXUF6BIA', '3SCOM14X', 'O3BMB28OMK69997X', 'H9K6YKXQ7OA36J9N', 'CD4XM6DJGLX5ERDH', 2, 'Rabu', '09:00:00', '09:15:00', 1, 0, '2020-03-28 15:59:41'),
('P9QFFN2695DGA6EU', '80L7Z6SI', 'BQXAQIO1OVIF2QUD', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 1, 'Rabu', '01:30:00', '23:59:00', 1, 0, '2020-03-11 01:40:43'),
('PX0N552JBG8M36WB', '80L7Z6SI', 'O3BMB28OMK69997X', 'H9K6YKXQ7OA36J9N', 'CD4XM6DJGLX5ERDH', 1, 'Jumat', '00:10:00', '23:59:00', 1, 0, '2020-03-12 23:29:36'),
('Q6CM3GLKRI1RKNQT', '3SCOM14X', 'MXQNA5814PJ0A2D0', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 2, 'Kamis', '11:11:00', '09:00:00', 1, 0, '2020-03-25 03:02:18'),
('QH5SODZ7HWQ10VYU', '80L7Z6SI', 'O3BMB28OMK69997X', 'M61OGKF2K50V281K', 'CD4XM6DJGLX5ERDH', 2, 'Selasa', '05:22:00', '07:00:00', 1, 0, '2020-04-03 22:07:04'),
('QKSB7XBHSYPJ7JJK', '80L7Z6SI', 'BQXAQIO1OVIF2QUD', 'AVSOFVENOYMAS6EY', 'CD4XM6DJGLX5ERDH', 1, 'Sabtu', '03:00:00', '20:22:00', 1, 0, '2020-03-15 00:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `kode_jurusan` varchar(16) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `nama_singkat` varchar(6) NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` varchar(32) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`kode_jurusan`, `nama_jurusan`, `nama_singkat`, `create_at`, `create_by`, `status`) VALUES
('43TTJSBRG7K0XEU1', 'TKJ', 'TKJ', '2020-03-04 15:38:59', 'ADMINADMINADMINADMINADMIN', 1),
('M7ITG8FI1O607TNS', 'Rekayasa Perangkat', 'RPL', '2020-03-04 15:32:33', 'ADMINADMINADMINADMINADMIN', 1),
('WKIUFLX6G7I63EU4', 'Multimedia', 'MM', '2020-03-22 00:38:48', 'ADMINADMINADMINADMINADMIN', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` varchar(16) NOT NULL,
  `kode_jurusan` varchar(16) NOT NULL,
  `no_kelas` int(2) NOT NULL,
  `rombel` char(1) NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` varchar(32) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `kode_jurusan`, `no_kelas`, `rombel`, `create_at`, `create_by`, `status`) VALUES
('2SDNB5LXM6EFMC3X', '43TTJSBRG7K0XEU1', 11, 'D', '2020-03-15 23:38:19', 'ADMINADMINADMINADMINADMIN', 1),
('3SCOM14X', '43TTJSBRG7K0XEU1', 10, 'C', '2020-03-04 17:47:00', 'ADMINADMINADMINADMINADMIN', 1),
('80L7Z6SI', 'M7ITG8FI1O607TNS', 10, 'A', '2020-03-04 17:46:53', 'ADMINADMINADMINADMINADMIN', 1),
('YDEODAFS95EQRWUG', 'WKIUFLX6G7I63EU4', 12, 'A', '2020-03-22 00:40:19', 'ADMINADMINADMINADMINADMIN', 1),
('ZVKW7C0BCAAAZ5WE', '43TTJSBRG7K0XEU1', 12, 'C', '2020-03-15 23:31:07', 'ADMINADMINADMINADMINADMIN', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `kode_mapel` varchar(16) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL,
  `create_by` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kode_mapel`, `nama_mapel`, `status`, `create_at`, `create_by`) VALUES
('5HJQQWLJEG3J4AKI', 'Matematika', 1, '2020-03-04 19:06:29', 'ADMINADMINADMINADMINADMIN'),
('BQXAQIO1OVIF2QUD', 'Pemodelan Perangkat Lunak', 1, '2020-03-04 18:46:55', 'ADMINADMINADMINADMINADMIN'),
('MFQ4D7OUKVW148XI', 'aa', 0, '2020-03-04 19:06:29', 'ADMINADMINADMINADMINADMIN'),
('MXQNA5814PJ0A2D0', 'Desain', 1, '2020-03-22 00:39:55', 'ADMINADMINADMINADMINADMIN'),
('O3BMB28OMK69997X', 'IPS', 1, '2020-03-04 18:47:23', 'ADMINADMINADMINADMINADMIN'),
('QV0XFX2F3UPGMVVA', 'dasdsa', 0, '2020-03-04 18:57:09', 'ADMINADMINADMINADMINADMIN'),
('WPOXJSZQSFQARQFJ', 'Edit Video', 1, '2020-03-22 00:39:55', 'ADMINADMINADMINADMINADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

CREATE TABLE `mengajar` (
  `kode_mengajar` varchar(32) NOT NULL,
  `kode_jadwal` varchar(16) NOT NULL,
  `kode_guru` varchar(16) NOT NULL,
  `mulai` datetime NOT NULL,
  `akhir` datetime NOT NULL,
  `tipe` int(1) NOT NULL COMMENT '1 = asli 2 = pengganti',
  `rating` int(1) NOT NULL,
  `reward` int(7) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 = proses 2 wait rating 3 selesai 4 = dak masuk 5 = izin',
  `catatan_siswa` varchar(100) NOT NULL,
  `materi` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mengajar`
--

INSERT INTO `mengajar` (`kode_mengajar`, `kode_jadwal`, `kode_guru`, `mulai`, `akhir`, `tipe`, `rating`, `reward`, `status`, `catatan_siswa`, `materi`) VALUES
('6K8VMF0L2YAU29I9', '8GTA75VTC6LRJX3O', '54864WWK6RJED073', '2020-03-23 04:39:15', '2020-03-23 04:39:15', 1, 0, 0, 5, '', ''),
('81ZQOIK7JXMHASM6', '9GG01PIKQZSMU88V', '54864WWK6RJED073', '2020-03-22 00:46:44', '2020-03-22 00:46:55', 1, 1, 0, 3, '', 'ujian'),
('AMK0HIL5BFZRQDAD', 'DXM0LHQ2WMWHMMXZ', 'AVSOFVENOYMAS6EY', '2020-03-22 00:51:50', '2020-03-22 00:52:14', 2, 5, 0, 3, '', 'tugas'),
('BR9FIG10GOJ407XO', 'QKSB7XBHSYPJ7JJK', 'AVSOFVENOYMAS6EY', '2020-03-15 03:34:04', '2020-03-15 03:34:21', 1, 3, 0, 3, '', 'eerr'),
('FHLRM49IP1C21A7M', 'PX0N552JBG8M36WB', 'H9K6YKXQ7OA36J9N', '2020-03-13 00:15:33', '2020-03-13 00:16:05', 2, 3, 0, 3, '', 'ngasik tugas'),
('K36R7UXMYPLOF93W', 'MMB9WIM4VO3ZRYTD', 'AVSOFVENOYMAS6EY', '2020-03-12 22:47:02', '2020-03-12 23:07:02', 2, 5, 66667, 3, '', 'baca buku'),
('MA9PAI5UF5WD7GA6', 'DXM0LHQ2WMWHMMXZ', '54864WWK6RJED073', '2020-03-22 00:51:50', '2020-03-22 00:51:50', 1, 0, 0, 5, '', ''),
('PX2T0NUJZ9RD4OAQ', 'MMB9WIM4VO3ZRYTD', 'AVSOFVENOYMAS6EY', '2020-03-12 22:47:02', '2020-03-12 22:47:02', 1, 1, 0, 5, '', ''),
('QCP4PE0WJYOG1SR4', '0N4WAM1SDQXI2L4G', 'AVSOFVENOYMAS6EY', '2020-03-16 04:41:35', '2020-03-16 04:41:42', 1, 3, 0, 3, '', 'tyyy'),
('RKP7DR99ZBIPBYKR', '92VNIVVEKRWWC7NQ', 'H9K6YKXQ7OA36J9N', '2020-04-04 01:07:05', '2020-04-04 02:14:53', 2, 5, 23333, 3, 'mantap', 'ujian'),
('RLTF4SXHEQGO4MJD', 'DDNTIS2AJURSAZZE', 'AVSOFVENOYMAS6EY', '2020-03-25 03:35:45', '2020-03-25 03:35:45', 1, 0, 0, 5, '', ''),
('V2SQMPOUFFIYQPQ8', '92VNIVVEKRWWC7NQ', 'M61OGKF2K50V281K', '2020-04-04 02:07:05', '2020-04-04 02:07:05', 1, 0, 0, 5, '', ''),
('XXVODGVOLIM9HBJF', 'PX0N552JBG8M36WB', 'H9K6YKXQ7OA36J9N', '2020-03-13 00:15:33', '2020-03-13 00:15:33', 1, 0, 0, 5, '', ''),
('ZESEPFGK6HXIDY3X', 'DDNTIS2AJURSAZZE', '54864WWK6RJED073', '2020-03-25 03:35:45', '2020-03-25 03:36:18', 2, 0, 0, 3, '', 'ujian');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `kode_notifikasi` varchar(16) NOT NULL,
  `kode_pengguna` varchar(32) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `kode_key` varchar(16) NOT NULL,
  `tipe_key` int(1) NOT NULL COMMENT '1 = warm ajar 2 = rating 3 = ijin ',
  `baca` int(1) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`kode_notifikasi`, `kode_pengguna`, `judul`, `keterangan`, `kode_key`, `tipe_key`, `baca`, `create_at`) VALUES
('DBWCNGEKQWNHICN4', 'NKDCQHPAN9GH8SYCMX9CKED2WYLGDZ36', 'Mengingatkan Saatnya Mengajar', 'Siswa Kelas 12 MM A Mengingatkan Anda Untuk Mengajar Di Kelas Tersebut', '92VNIVVEKRWWC7NQ', 1, 0, '2020-04-04 02:06:11'),
('FMS7U7A8DPD0TP4H', 'FHV894T2YNK0MKF4U0LBINMARDVS1JUH', 'Mengingatkan Saatnya Mengajar', 'Siswa Kelas 10 RPL A Mengingatkan Anda Untuk Mengajar Di Kelas Tersebut', 'DDNTIS2AJURSAZZE', 1, 0, '2020-03-25 03:34:12'),
('MK3E8PQWQL6WJ3SR', 'FHV894T2YNK0MKF4U0LBINMARDVS1JUH', 'Mengingatkan Saatnya Mengajar', 'Siswa Kelas 10 RPL A Mengingatkan Anda Untuk Mengajar Di Kelas Tersebut', 'M6LTNM476OHJV3XH', 1, 0, '2020-03-21 01:36:47'),
('QVO1IW1SJFJFZV9Q', 'FHV894T2YNK0MKF4U0LBINMARDVS1JUH', 'Mengingatkan Saatnya Mengajar', 'Siswa Kelas 10 RPL A Mengingatkan Anda Untuk Mengajar Di Kelas Tersebut', 'QKSB7XBHSYPJ7JJK', 1, 0, '2020-03-15 02:51:53'),
('T6KY5AINYTA1T0IC', '6L46A05EKN2F45FVMESJOAJ3425DHJR4', 'Mengingatkan Saatnya Mengajar', 'Siswa Kelas 12 MM A Mengingatkan Anda Untuk Mengajar Di Kelas Tersebut', 'DXM0LHQ2WMWHMMXZ', 1, 0, '2020-03-22 00:48:14'),
('XUOB89R0BB9RJ07K', 'NKDCQHPAN9GH8SYCMX9CKED2WYLGDZ36', 'Mengingatkan Saatnya Mengajar', 'Siswa Kelas 10 RPL A Mengingatkan Anda Untuk Mengajar Di Kelas Tersebut', 'QH5SODZ7HWQ10VYU', 1, 0, '2020-04-03 22:07:14');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan_app`
--

CREATE TABLE `pengaturan_app` (
  `kode` int(1) NOT NULL,
  `app_name` varchar(35) NOT NULL,
  `semester` int(1) NOT NULL DEFAULT '1' COMMENT '1 = ganjil 2 = genap',
  `gaji_lembur` int(7) NOT NULL,
  `min_notif_jurusan` int(3) NOT NULL,
  `min_notif_semua` int(3) NOT NULL,
  `interval_kirim_auto` int(2) NOT NULL,
  `aktif_kirim_auto` int(1) NOT NULL COMMENT '1 = on 0 =off',
  `email_cs` varchar(50) NOT NULL,
  `nohp` varchar(14) NOT NULL,
  `nowa` varchar(14) NOT NULL,
  `template_email` text NOT NULL,
  `smtp_user` varchar(50) NOT NULL,
  `smtp_pass` varchar(50) NOT NULL,
  `smtp_host` varchar(50) NOT NULL,
  `smtp_port` int(4) NOT NULL,
  `key_fcm` varchar(200) NOT NULL,
  `id_fcm` varchar(16) NOT NULL,
  `revisi_code` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan_app`
--

INSERT INTO `pengaturan_app` (`kode`, `app_name`, `semester`, `gaji_lembur`, `min_notif_jurusan`, `min_notif_semua`, `interval_kirim_auto`, `aktif_kirim_auto`, `email_cs`, `nohp`, `nowa`, `template_email`, `smtp_user`, `smtp_pass`, `smtp_host`, `smtp_port`, `key_fcm`, `id_fcm`, `revisi_code`) VALUES
(1, 'Guruku', 2, 200000, 1, 2, 9, 1, 'guruku@gmail.com', '9043394893', '', '<!DOCTYPE html>\r\n<html>\r\n\r\n<head>\r\n    <title></title>\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n    <style type=\"text/css\">\r\n        /* FONTS */\r\n        @import url(\'https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i\');\r\n\r\n        /* CLIENT-SPECIFIC STYLES */\r\n        body,\r\n        table,\r\n        td,\r\n        a {\r\n            -webkit-text-size-adjust: 100%;\r\n            -ms-text-size-adjust: 100%;\r\n        }\r\n\r\n        table,\r\n        td {\r\n            mso-table-lspace: 0pt;\r\n            mso-table-rspace: 0pt;\r\n        }\r\n\r\n        img {\r\n            -ms-interpolation-mode: bicubic;\r\n        }\r\n\r\n        /* RESET STYLES */\r\n        img {\r\n            border: 0;\r\n            height: auto;\r\n            line-height: 100%;\r\n            outline: none;\r\n            text-decoration: none;\r\n        }\r\n\r\n        table {\r\n            border-collapse: collapse !important;\r\n        }\r\n\r\n        body {\r\n            height: 100% !important;\r\n            margin: 0 !important;\r\n            padding: 0 !important;\r\n            width: 100% !important;\r\n        }\r\n\r\n        /* iOS BLUE LINKS */\r\n        a[x-apple-data-detectors] {\r\n            color: inherit !important;\r\n            text-decoration: none !important;\r\n            font-size: inherit !important;\r\n            font-family: inherit !important;\r\n            font-weight: inherit !important;\r\n            line-height: inherit !important;\r\n        }\r\n\r\n        /* MOBILE STYLES */\r\n        @media screen and (max-width:600px) {\r\n            h1 {\r\n                font-size: 32px !important;\r\n                line-height: 32px !important;\r\n            }\r\n        }\r\n\r\n        /* ANDROID CENTER FIX */\r\n        div[style*=\"margin: 16px 0;\"] {\r\n            margin: 0 !important;\r\n        }\r\n    </style>\r\n</head>\r\n\r\n<body style=\"background-color: #f3f5f7; margin: 0 !important; padding: 0 !important;\">\r\n\r\n    <!-- HIDDEN PREHEADER TEXT -->\r\n    <div style=\"display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: \'Poppins\', sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;\">\r\n        Hello User [app_name]\r\n    </div>\r\n\r\n    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n        <!-- LOGO -->\r\n        <tr>\r\n            <td align=\"center\">\r\n                <!--[if (gte mso 9)|(IE)]>\r\n            <table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\">\r\n            <tr>\r\n            <td align=\"center\" valign=\"top\" width=\"600\">\r\n            <![endif]-->\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">\r\n                    <tr>\r\n                        <td align=\"left\" valign=\"top\" style=\"padding: 40px 10px 40px 10px;\">\r\n                            <a href=\"#\" target=\"_blank\" style=\"text-decoration: none;\">\r\n                                <span style=\"display: block; font-family: \'Poppins\', sans-serif; color: #1e88e5; font-size: 36px;\" border=\"0\"><b>[app_name]</span>\r\n                            </a>\r\n                        </td>\r\n                        <td align=\"right\" valign=\"middle\" style=\"padding: 40px 10px 40px 10px;\">\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <!--[if (gte mso 9)|(IE)]>\r\n            </td>\r\n            </tr>\r\n            </table>\r\n            <![endif]-->\r\n            </td>\r\n        </tr>\r\n        <!-- HERO -->\r\n        <tr>\r\n            <td align=\"center\" style=\"padding: 0px 10px 0px 10px;\">\r\n                <!--[if (gte mso 9)|(IE)]>\r\n            <table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\">\r\n            <tr>\r\n            <td align=\"center\" valign=\"top\" width=\"600\">\r\n            <![endif]-->\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">\r\n                    <tr>\r\n                        <td bgcolor=\"#ffffff\" align=\"center\" valign=\"top\" style=\"padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: \'Poppins\', sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 2px; line-height: 48px;\">\r\n                            <h1 style=\"font-size: 36px; font-weight: 600; margin: 0;\">Hi! [nama_user]</h1>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <!--[if (gte mso 9)|(IE)]>\r\n            </td>\r\n            </tr>\r\n            </table>\r\n            <![endif]-->\r\n            </td>\r\n        </tr>\r\n        <!-- COPY BLOCK -->\r\n        <tr>\r\n            <td align=\"center\" style=\"padding: 0px 10px 0px 10px;\">\r\n                <!--[if (gte mso 9)|(IE)]>\r\n            <table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\">\r\n            <tr>\r\n            <td align=\"center\" valign=\"top\" width=\"600\">\r\n            <![endif]-->\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">\r\n                    <!-- COPY -->\r\n                    <tr>\r\n                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 20px 30px 20px 30px; color: #666666; font-family: \'Poppins\', sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;\">\r\n                            <p style=\"margin: 0;\">[keperluan]</p>\r\n                        </td>\r\n                    </tr>\r\n                    <!-- BULLETPROOF BUTTON -->\r\n                    <tr>\r\n                        <td bgcolor=\"#ffffff\" align=\"left\">\r\n                            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                                <tr>\r\n                                    <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 30px 30px 30px;\">\r\n                                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                                            <tr>\r\n                                                <td align=\"center\" style=\"border-radius: 3px;\" bgcolor=\"#26c6da\"><[tag_button] href=\"[link_button]\" target=\"_blank\" style=\"font-size: 18px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 12px 50px; border-radius: 2px; border: 1px solid #26c6da; display: inline-block;\">[text_button]</[tag_button]></td>\r\n                                            </tr>\r\n                                        </table>\r\n                                    </td>\r\n                                </tr>\r\n                            </table>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 0px 30px 20px 30px; color: #666666; font-family: &apos;Lato&apos;, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;\">\r\n                            <p style=\"margin: 0;\">Jika perlu bantuan silahkan hubungi kami di email berikut <b>[email_cs]</b></p>\r\n                        </td>\r\n                    </tr>\r\n                    <!-- COPY -->\r\n                    <tr>\r\n                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 0px 30px 40px 30px; border-radius: 0px 0px 0px 0px; color: #666666; font-family: \'Poppins\', sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;\">\r\n                            <p style=\"margin: 0;\">[app_name],<br>Team</p>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <!--[if (gte mso 9)|(IE)]>\r\n            </td>\r\n            </tr>\r\n            </table>\r\n            <![endif]-->\r\n            </td>\r\n        </tr>\r\n        <!-- SUPPORT CALLOUT -->\r\n        <tr>\r\n            <td align=\"center\" style=\"padding: 10px 10px 0px 10px;\">\r\n                <!--[if (gte mso 9)|(IE)]>\r\n            <table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\">\r\n            <tr>\r\n            <td align=\"center\" valign=\"top\" width=\"600\">\r\n            <![endif]-->\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">\r\n                    <!-- HEADLINE -->\r\n                    <tr>\r\n                        <td bgcolor=\"#26c6da\" align=\"center\" style=\"padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: \'Poppins\', sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;\">\r\n                            <h2 style=\"font-size: 16px; font-weight: 400; color: #ffffff; margin: 0;\">Terima Kasih Telah Menggunakan Aplikasi Kami :)</h2>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <!--[if (gte mso 9)|(IE)]>\r\n            </td>\r\n            </tr>\r\n            </table>\r\n            <![endif]-->\r\n            </td>\r\n        </tr>\r\n        <!-- FOOTER -->\r\n        <tr>\r\n            <td align=\"center\" style=\"padding: 10px 10px 50px 10px;\">\r\n                <!--[if (gte mso 9)|(IE)]>\r\n            <table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\">\r\n            <tr>\r\n            <td align=\"center\" valign=\"top\" width=\"600\">\r\n            <![endif]-->\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">\r\n                    <!-- NAVIGATION -->\r\n                    <tr>\r\n                        <td align=\"center\" style=\"padding: 30px 30px 30px 30px; color: #333333; font-family: \'Poppins\', sans-serif; font-size: 12px; font-weight: 400; line-height: 18px;\">\r\n                            <p style=\"margin: 0;\">Copyright © [tahun] [app_name]. All rights reserved.</p>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <!--[if (gte mso 9)|(IE)]>\r\n            </td>\r\n            </tr>\r\n            </table>\r\n            <![endif]-->\r\n            </td>\r\n        </tr>\r\n    </table>\r\n\r\n</body>\r\n\r\n</html>', 'optima@evoindo.com', 'optima2020', 'mail.evoindo.com', 465, 'AAAA7olbdQs:APA91bGBf2j-CWdqpei3m-mryUedGZTyrifxUP0eYefcr3Ut0K4aDQOgyM865R3fy7bTUtfNAC2jsaS0ftt5bp3WItB0H-Ua3Wnu9q6f-gIQIEy2_Mxf1r2s1_10oJ19Jw7Q9HQfg9Wv', '1024506688779', '2020-04-03 22:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `kode_pengguna` varchar(32) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(125) NOT NULL,
  `last_login` datetime NOT NULL,
  `level` int(1) NOT NULL,
  `last_token` varchar(200) NOT NULL,
  `last_api` varchar(128) NOT NULL,
  `akses_data` varchar(16) NOT NULL,
  `st_email` int(1) NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`kode_pengguna`, `nama_pengguna`, `email`, `password`, `last_login`, `level`, `last_token`, `last_api`, `akses_data`, `st_email`, `create_at`, `status`) VALUES
('0EVUR0I5GSA8VJGEGDN93ZE29MTQ3657', 'Siswa Abi yu', 'abi@gmail.com', '$2y$10$g.cJFLLm38Sj1wghDs3N/edxs6EATjICmmI9IXkw/igwd0B/nBmxe', '2020-04-03 23:07:48', 3, 'eByr_v3uTCa2lc0v2SVG0t:APA91bF3fuXfsRCfhroJDqsrvjZAEpWrSh8TAgcx3ZOCeV4SMj25qLmHx8cmhjMGvIsRQnxUqLDo30c6ajDl7FJa2H8m4CtiGRx7LvcQRCnvd5mJjYd3XzTxyo5gDvSTiERwtxFVqA1H', 'E0PIjTyHVMVgSSB3H9MwN015ChBWZBpH0eF0Vgoa6MIJ1dzRYWRaO652bW1hbIMNvFPfE0hXGDogiNJdsAQIxRwR9yTtNeo0QhBMrCcdXas5tNMk8tpC4OKafYpk0aa1', '80L7Z6SI', 0, '2020-03-05 11:03:36', 1),
('35KD5WQ9DXLLFHZGXYLEZQ8J1S96WMBW', 'Siswa Kelas 12 MM A', 'siswa12mm', '$2y$10$UgIWwGr74s3Ij0X/9bx68.HRzTxepSnQ3QlepV/qR4/VDmDU.BKdW', '2020-04-04 02:04:44', 3, 'ds0afGegTb2Al9aVnN4L-o:APA91bFGjdUbXqPYU5x9JztJkjYjkn9fLrEqa_a8Rj7kFPvu9GwksM657Gbj1MGGc0HhBOYRgqnUQFYPGcOQbeh2gpOHe1dFXYXiILHvehRBJ--rAbdR5f5WAYCbvWe7xpLXZBiJMFHF', 'Ptov8CNpMPnJhzkvAxZQCySSU8pUE2gwCeEvWwebFrFkkbkdJRmpoKvrK7FXFRphES0V3EKgKcM0LudckmzrWJ3JpWtUR8mGEYRanebUljYMFjzx1uHniDgvn6NAK5OU', 'YDEODAFS95EQRWUG', 0, '2020-03-22 00:40:19', 1),
('6L46A05EKN2F45FVMESJOAJ3425DHJR4', 'Hendrawan', 'guruhendra', '$2y$10$ZgAFmJb6Vr/CxTjbwYH9ze44tUUIR1r9T2jeRPDWwSlU3qgJnK8ee', '2020-03-25 03:33:01', 2, 'fIYoZcQhTSqPJrYtlb6erc:APA91bGBOs4XK_LlqfwBsYCYi4eVX6anXmIuKp_fEChjhlfc0jtSXoodTtu-UF5SOAV4EUHQ2abBH64f3WeGjsOdlGpjGj98IbX-bYo7chrQmftFEnkMlNzjJPrJjeMAJlMaD7E7LFZJ', 'qMquFX77LEz3MRCHUgRzU1tQl0khbfrGoi7oMq0Dm9nfyd9pQzeBV3Ifc3AKBuekt239SYnwtV8FHCeTzmvpjmIHOc52Nygp2OjbFUMguCvS3uX7RNHDZw2lnvEeuptD', '54864WWK6RJED073', 0, '2020-03-22 00:39:30', 1),
('7E9NQ6A1DT3F2M1WAL71JCAHH7CNZ3KM', 'Siswa Kelas 11 TKJ D', '11tkjd', '$2y$10$vB6rBpxCBNiwMh.WAU.nzeFJdEXTZYniQqWB8r75QYqV3zqmk5k8K', '0000-00-00 00:00:00', 3, '', '', '', 0, '2020-03-15 23:38:20', 1),
('ADMINADMINADMINADMINADMIN', 'admin', 'admin@admin.com', '$2y$10$DUoL07a6Kdl/5oFg/RUC/OzbgllXtMFVnVDzFS7GAcaWVOjBuK0ku', '2020-04-15 10:43:27', 1, '', '', 'ADMIN', 1, '2019-11-16 23:09:37', 1),
('FHV894T2YNK0MKF4U0LBINMARDVS1JUH', 'Andrean', 'guruandre', '$2y$10$01ZvpABtdYNu1u82hN02VuDoG3MpKWxOq04Pu3bHleq76dDch9cJa', '2020-03-25 03:32:54', 2, 'eCZRwVPeTha9qVoiR67JGQ:APA91bFVyDPDJzZ_iitGDtT7UusOsQSTsarzBrZWgo69OJxQWYTrwDNjCQ1WuVyJEB2_apU6cYwuh8InCzeK2kiPM8QRpgb_wpKJ9A3ctuT7xwgCOkN1osZ0xhRcLUNhCKOgVER7e-am', 'zhKZbVtOKHyUupWrKvfMsehYPTHyKgxa5Mj8HvA1BmhqCFgVFKsFJhxOjF6gApa7txWA5VHCLdoC2YKrE0s77Yc3EeKq0A73TWXNXR2YuhhtgC7NjGN33utlFKQcVN3c', 'AVSOFVENOYMAS6EY', 0, '2020-03-05 23:00:15', 1),
('NKDCQHPAN9GH8SYCMX9CKED2WYLGDZ36', 'Guru ryan', 'ryan', '$2y$10$NMckrfx/CemwODg9bNh2QeUVAjZR5l7yecmsO66N1gqMMndx7blGC', '2020-04-04 02:04:02', 2, 'e79OkXF0SJGXQLHS7urAL7:APA91bFVsiDDD8Uzcv-_8U3rkzN7hxbxZbwN-yfOnIh7xXgD2WcO-vYwKiAKYyDxbs9Uzc32pcMmhiwK5f6j5KxZKI7Ii6xRTEPyJ8Bv42z8Bh0_1O2vXKiE-QO8OM7lGnwxI-mHH4Ke', 'pPcSqum94oaMvPiViS9kdyr2LM1TLV3lD7zGF8Nt3PzoFCYBRjQ6AfcZbwUnv5r31zW106fr22odtpB73Otk5AIXrg5n6qleq75LPpMduiyu5YCtMUSEcoBX0tOOKOOh', 'M61OGKF2K50V281K', 0, '2020-03-18 15:25:25', 1),
('ONOSGX2ZR7URNTJDD4UA094S9H23FO13', 'guru abi', 'guruabi@gmail.com', '$2y$10$SkY3qelRTJOj1RpT57NHj.Ro/ZJdCECUkWDSr8dNUAsTbs8/yfp0a', '2020-04-04 04:04:05', 2, '', '', 'H9K6YKXQ7OA36J9N', 0, '2020-03-08 22:35:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `req_guru`
--

CREATE TABLE `req_guru` (
  `kode_req` varchar(16) NOT NULL,
  `kode_jadwal` varchar(16) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `awal` datetime NOT NULL,
  `akhir` datetime NOT NULL,
  `tipe` int(1) NOT NULL COMMENT '1 = guru sejenis, 2 = semua guru',
  `pick_by` varchar(16) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0 = invalid1= oke 2 = selesai',
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req_guru`
--

INSERT INTO `req_guru` (`kode_req`, `kode_jadwal`, `deskripsi`, `awal`, `akhir`, `tipe`, `pick_by`, `status`, `create_at`) VALUES
('0605Y8F6VZZTKN1R', 'M6LTNM476OHJV3XH', 'Siswa Kelas 10 RPL A Membutuhkan Guru Pengganti Dengan Mata Pelajaran Matematika', '2020-03-21 01:36:00', '2020-03-21 01:37:56', 1, '', 0, '2020-03-21 01:36:56'),
('2C85SMU06Z7UFF8I', 'QKSB7XBHSYPJ7JJK', 'Siswa Kelas 10 RPL A Membutuhkan Guru Pengganti Dengan Mata Pelajaran Pemodelan Perangkat Lunak', '2020-03-15 02:55:00', '2020-03-15 02:56:28', 1, '', 0, '2020-03-15 02:55:28'),
('3T5D6V2KAEG2PIZM', 'DDNTIS2AJURSAZZE', 'Siswa Kelas 10 RPL A Membutuhkan Guru Pengganti Dengan Mata Pelajaran Edit Video', '2020-03-25 03:34:00', '2020-03-25 03:35:26', 1, '', 0, '2020-03-25 03:34:26'),
('46C30PA32E4L1UHL', 'QH5SODZ7HWQ10VYU', 'Siswa Kelas 10 RPL A Membutuhkan Guru Pengganti Dengan Mata Pelajaran IPS', '2020-04-04 05:32:00', '2020-04-04 05:33:56', 1, '', 1, '2020-04-04 05:32:56'),
('7R4ZZQX230GOA5SV', 'QH5SODZ7HWQ10VYU', 'Siswa Kelas 10 RPL A Membutuhkan Guru Pengganti Dengan Mata Pelajaran IPS', '2020-04-03 22:16:00', '2020-04-03 22:17:43', 1, '', 0, '2020-04-03 22:16:43'),
('89KDHO7009LFJOJV', 'QH5SODZ7HWQ10VYU', 'Siswa Kelas 10 RPL A Membutuhkan Guru Pengganti Dengan Mata Pelajaran IPS', '2020-04-04 05:16:00', '2020-04-04 05:17:03', 1, '', 1, '2020-04-04 05:16:03'),
('AMK0HIL5BFZRQDAD', 'DXM0LHQ2WMWHMMXZ', 'Siswa Kelas 12 MM A Membutuhkan Guru Pengganti Dengan Mata Pelajaran Edit Video', '2020-03-22 00:51:00', '2020-03-22 00:53:26', 2, 'AVSOFVENOYMAS6EY', 2, '2020-03-22 00:51:26'),
('C1ZGXO46CJYLEA5N', 'QKSB7XBHSYPJ7JJK', 'Siswa Kelas 10 RPL A Membutuhkan Guru Pengganti Dengan Mata Pelajaran Pemodelan Perangkat Lunak', '2020-03-15 02:56:00', '2020-03-15 02:58:43', 2, 'AVSOFVENOYMAS6EY', 2, '2020-03-15 02:56:43'),
('MKHMXJKBTUCS3CY1', 'DXM0LHQ2WMWHMMXZ', 'Siswa Kelas 12 MM A Membutuhkan Guru Pengganti Dengan Mata Pelajaran Edit Video', '2020-03-22 00:48:00', '2020-03-23 03:59:32', 1, '', 0, '2020-03-22 00:48:32'),
('QRVGVUQQOW2P8U6X', 'H2SDD5IX614XJ7MS', 'Siswa Kelas 10 TKJ C Membutuhkan Guru Pengganti Dengan Mata Pelajaran IPS', '2020-04-04 05:34:00', '2020-04-04 05:35:12', 1, '', 1, '2020-04-04 05:34:12'),
('RKP7DR99ZBIPBYKR', '92VNIVVEKRWWC7NQ', 'Siswa Kelas 12 MM A Membutuhkan Guru Pengganti Dengan Mata Pelajaran IPS', '2020-04-04 02:06:00', '2020-04-04 02:07:45', 1, 'H9K6YKXQ7OA36J9N', 2, '2020-04-04 02:06:45'),
('t6564554trege', 'QH5SODZ7HWQ10VYU', 'Siswa Kelas 10 RPL A Membutuhkan Guru Pengganti Dengan Mata Pelajaran IPS', '2020-04-03 22:16:00', '2020-04-03 22:17:43', 1, '', 1, '2020-04-03 22:16:43'),
('TSER7TQ5S1B2WVHX', 'P9QFFN2695DGA6EU', 'Siswa Kelas 10 RPL A Membutuhkan Guru Pengganti Dengan Mata Pelajaran Pemodelan Perangkat Lunak', '2020-03-18 16:13:00', '2020-03-18 16:14:41', 1, '', 0, '2020-03-18 16:13:41'),
('Y3JNWKGBXW8PATQ7', 'QH5SODZ7HWQ10VYU', 'Siswa Kelas 10 RPL A Membutuhkan Guru Pengganti Dengan Mata Pelajaran IPS', '2020-04-03 23:06:00', '2020-04-03 23:08:33', 2, '', 1, '2020-04-03 23:06:33'),
('ZESEPFGK6HXIDY3X', 'DDNTIS2AJURSAZZE', 'Siswa Kelas 10 RPL A Membutuhkan Guru Pengganti Dengan Mata Pelajaran Edit Video', '2020-03-25 03:35:00', '2020-03-25 03:37:35', 2, '54864WWK6RJED073', 2, '2020-03-25 03:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `rw_reward`
--

CREATE TABLE `rw_reward` (
  `kode_reward` varchar(16) NOT NULL,
  `kode_guru` varchar(16) NOT NULL,
  `keterangan` varchar(100) NOT NULL DEFAULT 'Hasil Mengajar',
  `jumlah` int(7) NOT NULL,
  `tipe` int(1) NOT NULL COMMENT '1 =out 2 = in',
  `create_at` datetime NOT NULL,
  `create_by` varchar(32) NOT NULL DEFAULT 'SYSTEM'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rw_reward`
--

INSERT INTO `rw_reward` (`kode_reward`, `kode_guru`, `keterangan`, `jumlah`, `tipe`, `create_at`, `create_by`) VALUES
('82HDA4B7LZ1WX53X', 'AVSOFVENOYMAS6EY', 'sip', 50000, 1, '2020-03-22 02:59:39', 'ADMINADMINADMINADMINADMIN'),
('AMK0HIL5BFZRQDAD', 'AVSOFVENOYMAS6EY', 'Hasil Mengajar', 0, 2, '2020-03-22 00:52:14', 'SYSTEM'),
('FHLRM49IP1C21A7M', 'H9K6YKXQ7OA36J9N', 'hasil mengajar', 0, 2, '2020-03-13 00:16:05', 'SYSTEM'),
('G2GCNXD5FVTGQMTK', 'H9K6YKXQ7OA36J9N', 'Penarikan Saldo #695265', 200000, 1, '2020-03-22 22:22:00', 'ADMINADMINADMINADMINADMIN'),
('K36R7UXMYPLOF93W', 'AVSOFVENOYMAS6EY', 'hasil mengajar', 66667, 2, '2020-03-12 23:07:02', 'SYSTEM'),
('PRR9RGITVAAHUXAI', 'AVSOFVENOYMAS6EY', 'Penarikan Saldo #950343', 13000, 1, '2020-03-22 23:22:00', 'ADMINADMINADMINADMINADMIN'),
('RKP7DR99ZBIPBYKR', 'H9K6YKXQ7OA36J9N', 'Hasil Mengajar', 0, 2, '2020-04-04 02:07:59', 'SYSTEM'),
('ZESEPFGK6HXIDY3X', '54864WWK6RJED073', 'Hasil Mengajar', 0, 2, '2020-03-25 03:36:18', 'SYSTEM');

--
-- Triggers `rw_reward`
--
DELIMITER $$
CREATE TRIGGER `edit_saldo` AFTER INSERT ON `rw_reward` FOR EACH ROW BEGIN
	IF NEW.tipe = 2 THEN
    	update guru set upah = upah + NEW.jumlah
        where kode_guru=NEW.kode_guru;
    ELSEIF NEW.tipe = 1 THEN
    	update guru set upah = upah - NEW.jumlah
        where kode_guru=NEW.kode_guru;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `kode_tahun` varchar(16) NOT NULL,
  `tahun` varchar(9) NOT NULL,
  `aktif` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL,
  `create_by` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`kode_tahun`, `tahun`, `aktif`, `status`, `create_at`, `create_by`) VALUES
('99I0B6YMQLND2R1I', '2342342', 0, 0, '2020-03-04 20:22:58', 'ADMINADMINADMINADMINADMIN'),
('CD4XM6DJGLX5ERDH', '2020/2021', 1, 1, '2020-03-04 20:22:39', 'ADMINADMINADMINADMINADMIN'),
('W8CYJE6WVBV5UZU5', '2021/2022', 0, 1, '2020-03-04 20:21:34', 'ADMINADMINADMINADMINADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`kode_guru`),
  ADD KEY `kode_jurusan` (`kode_jurusan`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`kode_hari`);

--
-- Indexes for table `ijin_guru`
--
ALTER TABLE `ijin_guru`
  ADD PRIMARY KEY (`kode_ijin`),
  ADD KEY `kode_guru` (`kode_guru`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`kode_jadwal`),
  ADD KEY `kode_kelas` (`kode_kelas`),
  ADD KEY `kode_mapel` (`kode_mapel`),
  ADD KEY `kode_guru` (`kode_guru`),
  ADD KEY `kode_tahun` (`kode_tahun`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`kode_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kode_kelas`),
  ADD KEY `kode_jurusan` (`kode_jurusan`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kode_mapel`);

--
-- Indexes for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD PRIMARY KEY (`kode_mengajar`),
  ADD KEY `kode_jadwal` (`kode_jadwal`),
  ADD KEY `kode_guru` (`kode_guru`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`kode_notifikasi`),
  ADD KEY `kode_pengguna` (`kode_pengguna`);

--
-- Indexes for table `pengaturan_app`
--
ALTER TABLE `pengaturan_app`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`kode_pengguna`);

--
-- Indexes for table `req_guru`
--
ALTER TABLE `req_guru`
  ADD PRIMARY KEY (`kode_req`),
  ADD KEY `kode_jadwal` (`kode_jadwal`);

--
-- Indexes for table `rw_reward`
--
ALTER TABLE `rw_reward`
  ADD PRIMARY KEY (`kode_reward`),
  ADD KEY `kode_guru` (`kode_guru`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`kode_tahun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
