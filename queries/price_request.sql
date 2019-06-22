-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2019 at 03:26 AM
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
-- Table structure for table `price_request`
--

CREATE TABLE `price_request` (
  `id_request` int(11) NOT NULL COMMENT 'mempermudah mendapatkan no rfq',
  `no_request` varchar(200) NOT NULL COMMENT 'yang keluar di dokumen, yang selalu unik, kurang lebih seperti id request, tahun, bulan yang jadi composite key gitu',
  `tgl_dateline_request` date DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL COMMENT 'perlu untuk menjaga kalau ada pegawai yang pindah kantor dan masih berinteraksi dengan leiter',
  `id_cp` int(11) DEFAULT NULL,
  `franco` varchar(200) DEFAULT NULL,
  `bulan_request` varchar(11) NOT NULL,
  `tahun_request` varchar(11) NOT NULL,
  `status_request` int(11) NOT NULL DEFAULT '0' COMMENT '0: rfq, 1 (setelah rfq): vendor price, 2 (setelah vendor price) quotation, 3 (setelah quotation).',
  `untuk_stock` int(11) NOT NULL DEFAULT '1' COMMENT '0: untuk stock, 1 tidak stock',
  `status_aktif_request` int(11) NOT NULL COMMENT '0 aktif, 1 tidak aktif. penolakan dari vendor price itu rubahnya kesini',
  `id_user_add` int(11) NOT NULL,
  `date_request_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_request_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_request_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price_request`
--

INSERT INTO `price_request` (`id_request`, `no_request`, `tgl_dateline_request`, `id_perusahaan`, `id_cp`, `franco`, `bulan_request`, `tahun_request`, `status_request`, `untuk_stock`, `status_aktif_request`, `id_user_add`, `date_request_add`, `id_user_edit`, `date_request_edit`, `id_user_delete`, `date_request_delete`) VALUES
(1, 'LI-001/RFQ/VI/2019', '2019-07-14', 18, 30, 'Surabaya', '06', '2019', 1, 1, 0, 11, '2019-06-21 23:52:37', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'LI-002/RFQ/VI/2019', '2019-06-29', 19, 31, 'Surabaya', '06', '2019', 1, 1, 0, 11, '2019-06-22 00:11:53', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `price_request`
--
ALTER TABLE `price_request`
  ADD PRIMARY KEY (`no_request`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
