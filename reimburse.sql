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
-- Table structure for table `reimburse`
--

CREATE TABLE `reimburse` (
  `id_reimburse` int(11) NOT NULL,
  `subject_reimburse` varchar(200) NOT NULL,
  `nominal_reimburse` int(11) NOT NULL,
  `attachment` text NOT NULL,
  `notes` text NOT NULL,
  `id_user_add` int(11) DEFAULT NULL,
  `tgl_reimburse_add` datetime DEFAULT NULL,
  `status_paid` int(11) NOT NULL DEFAULT '1',
  `status_aktif_reimburse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reimburse`
--

INSERT INTO `reimburse` (`id_reimburse`, `subject_reimburse`, `nominal_reimburse`, `attachment`, `notes`, `id_user_add`, `tgl_reimburse_add`, `status_paid`, `status_aktif_reimburse`) VALUES
(10, 'Fotokopi', 342000, '-', 'Fotokopi buku', 11, '2019-07-10 00:00:00', 2, 1),
(11, 'Pembelian handphone', 5600000, '246x0w.jpg', '', 11, '2019-07-10 00:00:00', 2, 1),
(12, 'Pembelian komputer 23', 20000000, 'images.png', 'ROG RTX 22', 27, '2019-07-10 00:00:00', 0, 0),
(13, 'Pembelian AC', 5460000, '246x0w1.jpg', 'Pembelian AC buat kantor\r\n', 27, '2019-07-10 00:00:00', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reimburse`
--
ALTER TABLE `reimburse`
  ADD PRIMARY KEY (`id_reimburse`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reimburse`
--
ALTER TABLE `reimburse`
  MODIFY `id_reimburse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
