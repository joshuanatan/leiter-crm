-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2019 at 03:27 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leiter-crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(200) NOT NULL DEFAULT '-',
  `nofax_perusahaan` varchar(100) NOT NULL DEFAULT '-',
  `alamat_perusahaan` text,
  `notelp_perusahaan` varchar(15) NOT NULL DEFAULT '-',
  `peran_perusahaan` varchar(100) NOT NULL DEFAULT '-',
  `jenis_perusahaan` varchar(200) NOT NULL,
  `status_perusahaan` int(11) NOT NULL DEFAULT '0',
  `permanent` int(11) NOT NULL DEFAULT '0' COMMENT '0: permanen, 1: Tidak permanen',
  `id_user_add` int(11) NOT NULL DEFAULT '0',
  `date_perusahaan_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_perusahaan_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_perusahaan_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_perusahaan`, `nofax_perusahaan`, `alamat_perusahaan`, `notelp_perusahaan`, `peran_perusahaan`, `jenis_perusahaan`, `status_perusahaan`, `permanent`, `id_user_add`, `date_perusahaan_add`, `id_user_edit`, `date_perusahaan_edit`, `id_user_delete`, `date_perusahaan_delete`) VALUES
(18, 'PT Adil Makmur Fajar', '12345678', 'Jl. Industri Raya No. 1 Km. 21, \r\nDesa Budimulya, Kec. Cikupa, \r\nTangerang 15710', '5963470-71', 'CUSTOMER', 'Food', 0, 0, 11, '2019-06-11 23:33:10', 11, '0000-00-00 00:00:00', 11, '0000-00-00 00:00:00'),
(19, 'PT Agarindo Bogatama', '12345678', 'Jelambar Selatan II No. 4, \r\nGedung Agar-agar', '569 66930', 'CUSTOMER', 'Food', 0, 0, 11, '2019-06-11 23:56:55', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 'SEFAR SINGAPORE PTE LTD', '12345678', '8 Kallang Avenue #04-03 Aperia Tower 1 \r\nSINGAPORE 339509 ', '+65 6299 9092 ', 'PRODUK', '-', 0, 0, 11, '2019-06-12 09:41:26', 11, '0000-00-00 00:00:00', 11, '0000-00-00 00:00:00'),
(21, 'Cargo-partner Logistics Pte. Ltd.', '12345678', '300 Tampines Avenue 5 #07-04 Income @ Tampines Junction SG-529653 Singapore Singapore', '+65 6578 5094', 'SHIPPING', 'Glass Expert Shipper', 0, 0, 11, '2019-06-12 13:56:46', 11, '0000-00-00 00:00:00', 11, '0000-00-00 00:00:00'),
(22, 'PT Example', '12345678', 'Kembang Molek IX\r\nKembangan Selatan\r\n11610', '54808080', 'CUSTOMER', 'Sugar ', 0, 0, 11, '2019-06-14 15:18:37', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(23, 'PT Product Vendor', '12345678', 'Alamat 1\r\nalamt 2', '08980980', 'PRODUK', 'Machine', 0, 0, 11, '2019-06-14 15:21:16', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
