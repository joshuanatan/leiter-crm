-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2019 at 02:07 AM
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
-- Table structure for table `po_core`
--

CREATE TABLE `po_core` (
  `id_submit_po` int(11) NOT NULL,
  `id_submit_oc` int(11) NOT NULL,
  `id_po` int(11) NOT NULL COMMENT 'untuk versi setiap bulan',
  `bulan_po` varchar(20) NOT NULL,
  `tahun_po` int(11) NOT NULL,
  `no_po` varchar(100) NOT NULL,
  `id_supplier` varchar(100) NOT NULL,
  `id_cp_supplier` int(11) NOT NULL,
  `id_shipper` int(11) NOT NULL,
  `id_cp_shipper` int(11) NOT NULL,
  `shipping_method` varchar(100) NOT NULL,
  `shipping_term` text NOT NULL,
  `requirement_date` date NOT NULL,
  `destination` varchar(200) NOT NULL,
  `total_supplier_payment` int(11) NOT NULL COMMENT 'sebelum di submit, dijumlahin dulu supaya ga repot ngitung2 lagi',
  `mata_uang_pembayaran` varchar(200) NOT NULL,
  `notify_party` text,
  `status_aktif_po` int(11) NOT NULL DEFAULT '0',
  `id_user_add` int(11) DEFAULT NULL,
  `date_po_core_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_po_core_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_po_core_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_core`
--

INSERT INTO `po_core` (`id_submit_po`, `id_submit_oc`, `id_po`, `bulan_po`, `tahun_po`, `no_po`, `id_supplier`, `id_cp_supplier`, `id_shipper`, `id_cp_shipper`, `shipping_method`, `shipping_term`, `requirement_date`, `destination`, `total_supplier_payment`, `mata_uang_pembayaran`, `notify_party`, `status_aktif_po`, `id_user_add`, `date_po_core_add`, `id_user_edit`, `date_po_core_edit`, `id_user_delete`, `date_po_core_delete`) VALUES
(1, 7, 1, '07', 2019, 'LI-001/PO/VII/2019/018', '20', 33, 21, 35, 'SEA', 'Use Plastic Packaging and Box Packaging', '2019-07-31', 'Japan', 0, 'USD', '', 1, 11, '2019-07-08 06:53:18', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 5, 2, '07', 2019, 'LI-002/PO/VII/2019/018', '23', 39, 21, 35, 'AIR', 'Tolong jangan dilipat', '2019-08-03', 'JAKARTA', 0, 'IDR', '', 0, 11, '2019-07-08 09:54:39', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 8, 3, '07', 2019, 'LI-003/PO/VII/2019/022', '23', 39, 44, 54, 'LAND', 'Pake Packaging Kain dan Bubble', '2019-08-02', 'Japan', 0, 'IDR', '', 1, NULL, '2019-07-08 22:04:19', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 9, 4, '07', 2019, 'LI-004/PO/VII/2019/056', '23', 39, 43, 65, 'SEA', 'Plastic wrap bubble wrap', '2019-07-31', 'Jakarta', 0, 'USD', 'Agent Shipper\r\n089616916195', 0, 11, '2019-07-11 01:02:26', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `po_core`
--
ALTER TABLE `po_core`
  ADD PRIMARY KEY (`id_submit_po`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `po_core`
--
ALTER TABLE `po_core`
  MODIFY `id_submit_po` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
