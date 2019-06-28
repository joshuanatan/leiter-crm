-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2019 at 01:38 AM
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
-- Table structure for table `harga_shipping`
--

CREATE TABLE `harga_courier` (
  `id_harga_shipping` int(11) NOT NULL,
  `id_harga_vendor` int(11) NOT NULL,
  `nama_perusahaan` varchar(200) DEFAULT NULL,
  `nama_cp` varchar(200) DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `vendor_price_rate` int(11) DEFAULT NULL,
  `mata_uang` varchar(10) DEFAULT NULL,
  `notes` text,
  `attachment` varchar(200) DEFAULT NULL,
  `status_aktif_harga_shipping` int(11) DEFAULT NULL,
  `id_user_add` int(11) DEFAULT NULL,
  `date_harga_shipping_add` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga_shipping`
--

INSERT INTO `harga_shipping` (`id_harga_shipping`, `id_harga_vendor`, `nama_perusahaan`, `nama_cp`, `harga_produk`, `vendor_price_rate`, `mata_uang`, `notes`, `attachment`, `status_aktif_harga_shipping`, `id_user_add`, `date_harga_shipping_add`) VALUES
(1, 66, 'jne', 'joko', 15000000, 1, 'IDR', 'test', 'jute-fabric-roll1.png', NULL, NULL, '2019-06-28 06:13:35'),
(2, 67, 'TRANSPORT UMUM', 'joni', 14500, 14500, 'USD', 'asdf', 'jute-fabric-roll2.png', NULL, NULL, '2019-06-28 06:35:56'),
(3, 67, 'sshipper 2', 'pic 2', 1200, 100, 'IDR', 'asdfasdf', 'images.png', NULL, NULL, '2019-06-28 06:36:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `harga_shipping`
--
ALTER TABLE `harga_shipping`
  ADD PRIMARY KEY (`id_harga_shipping`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `harga_shipping`
--
ALTER TABLE `harga_shipping`
  MODIFY `id_harga_shipping` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
