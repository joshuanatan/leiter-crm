-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2019 at 07:20 PM
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
-- Table structure for table `order_confirmation_metode_pembayaran`
--

CREATE TABLE `order_confirmation_metode_pembayaran` (
  `id_metode_pembayaran` int(11) NOT NULL,
  `id_submit_quotation` varchar(200) NOT NULL,
  `persentase_pembayaran` int(11) NOT NULL,
  `nominal_pembayaran` bigint(11) NOT NULL,
  `trigger_pembayaran` int(11) NOT NULL COMMENT '0: gakpake, kalau persennya 0;1: sesudah OC; 2: setelah OD;',
  `status_bayar` int(11) NOT NULL DEFAULT '1' COMMENT '0: sudah dibayar, 1 belum dibayar,',
  `is_ada_transaksi` int(11) NOT NULL COMMENT '0, ada transaksi; 1 tidak ada transaksi',
  `persentase_pembayaran2` int(11) DEFAULT NULL,
  `nominal_pembayaran2` int(11) DEFAULT NULL,
  `trigger_pembayaran2` int(11) NOT NULL COMMENT '0: gakpake, kalau persennya 0;1: sesudah OC; 2: setelah OD;',
  `status_bayar2` int(11) NOT NULL DEFAULT '1' COMMENT '0: sudah dibayar, 1 belum dibayar',
  `is_ada_transaksi2` int(11) NOT NULL COMMENT '0, ada transaksi; 1 tidak ada transaksi',
  `kurs` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_confirmation_metode_pembayaran`
--

INSERT INTO `order_confirmation_metode_pembayaran` (`id_metode_pembayaran`, `id_submit_quotation`, `persentase_pembayaran`, `nominal_pembayaran`, `trigger_pembayaran`, `status_bayar`, `is_ada_transaksi`, `persentase_pembayaran2`, `nominal_pembayaran2`, `trigger_pembayaran2`, `status_bayar2`, `is_ada_transaksi2`, `kurs`) VALUES
(3, '3', 0, 0, 1, 1, 1, 100, 309200000, 2, 1, 0, 'IDR'),
(4, '18', 0, 0, 1, 1, 1, 100, 156000000, 2, 1, 0, 'IDR'),
(5, '19', 35, 142434845, 1, 1, 0, 65, 264521855, 2, 1, 0, 'USD'),
(6, '20', 40, 124146800, 1, 1, 0, 60, 186220200, 2, 1, 0, 'IDR'),
(7, '21', 25, 101962500, 1, 1, 0, 75, 305887500, 2, 1, 0, 'USD'),
(8, '22', 25, 101962500, 1, 1, 0, 75, 305887500, 2, 1, 0, 'USD'),
(9, '23', 60, 94140000, 1, 1, 0, 40, 62760000, 2, 1, 0, 'IDR'),
(10, '24', 40, 94000000, 1, 1, 0, 60, 141000000, 2, 1, 0, 'IDR'),
(11, '25', 50, 139000000, 1, 1, 0, 50, 139000000, 2, 1, 0, 'IDR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_confirmation_metode_pembayaran`
--
ALTER TABLE `order_confirmation_metode_pembayaran`
  ADD PRIMARY KEY (`id_metode_pembayaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_confirmation_metode_pembayaran`
--
ALTER TABLE `order_confirmation_metode_pembayaran`
  MODIFY `id_metode_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
