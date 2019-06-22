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
-- Table structure for table `price_request_item`
--

CREATE TABLE `price_request_item` (
  `id_request_item` int(11) NOT NULL,
  `no_request` varchar(200) NOT NULL,
  `nama_produk` text,
  `jumlah_produk` varchar(200) DEFAULT NULL,
  `notes_produk` text,
  `file` text,
  `status_request_item` int(11) NOT NULL DEFAULT '0',
  `id_user_add` int(11) NOT NULL,
  `date_request_item_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_request_item_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_request_item_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sudah_po` int(11) NOT NULL DEFAULT '1' COMMENT '1: belum po, 0: sudah po'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price_request_item`
--

INSERT INTO `price_request_item` (`id_request_item`, `no_request`, `nama_produk`, `jumlah_produk`, `notes_produk`, `file`, `status_request_item`, `id_user_add`, `date_request_item_add`, `id_user_edit`, `date_request_item_edit`, `id_user_delete`, `date_request_item_delete`, `sudah_po`) VALUES
(36, 'LI-002/RFQ/VI/2019', 'items 3', '30meter', 'harga 30ribu', 'assignment3_0000002027110.docx', 0, 11, '2019-06-22 07:24:07', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(37, 'LI-002/RFQ/VI/2019', 'items 4', '40meter', 'harga 40ribu', 'assignment4_00000020271.docx', 0, 11, '2019-06-22 07:24:07', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(38, 'LI-002/RFQ/VI/2019', 'items 5', '50meter', 'harga 50ribu', '-', 0, 11, '2019-06-22 07:24:08', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(39, 'LI-001/RFQ/VI/2019', 'items1', '10 meter', '10ribu / meter', 'assignment1_0000002027110.docx', 0, 11, '2019-06-22 07:24:49', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(40, 'LI-001/RFQ/VI/2019', 'items 2', '20 mter', '20ribu/meter', '-', 0, 11, '2019-06-22 07:24:49', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `price_request_item`
--
ALTER TABLE `price_request_item`
  ADD PRIMARY KEY (`id_request_item`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `price_request_item`
--
ALTER TABLE `price_request_item`
  MODIFY `id_request_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
