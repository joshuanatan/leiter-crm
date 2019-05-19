-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2019 at 04:58 PM
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
-- Table structure for table `variable_shipping_price`
--

CREATE TABLE `variable_courier_price` (
  `id_variable_courier` int(11) NOT NULL,
  `shipping_purpose` varchar(50) NOT NULL,
  `metode_pengiriman` varchar(10) NOT NULL,
  `id_cp` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `nama_variable` varchar(300) NOT NULL,
  `biaya_variable` int(11) NOT NULL,
  `kurs_variable` int(11) NOT NULL,
  `status_variable` int(11) NOT NULL DEFAULT '0',
  `id_request_item` int(11) NOT NULL,
  `id_user_add` int(11) NOT NULL,
  `id_variable_shipping_price_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `id_variable_shipping_price_edit` datetime DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `id_variable_shipping_price_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variable_shipping_price`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `variable_shipping_price`
--
ALTER TABLE `variable_shipping_price`
  ADD PRIMARY KEY (`id_variable_courier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `variable_shipping_price`
--
ALTER TABLE `variable_shipping_price`
  MODIFY `id_variable_courier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
