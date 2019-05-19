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

CREATE TABLE `variable_shipping_price` (
  `id_variable_shipping` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
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

INSERT INTO `variable_shipping_price` (`id_variable_shipping`, `id_supplier`, `shipping_purpose`, `metode_pengiriman`, `id_cp`, `id_perusahaan`, `nama_variable`, `biaya_variable`, `kurs_variable`, `status_variable`, `id_request_item`, `id_user_add`, `id_variable_shipping_price_add`, `id_user_edit`, `id_variable_shipping_price_edit`, `id_user_delete`, `id_variable_shipping_price_delete`) VALUES
(1, 3, 'SUPPLIER', 'SEA', 8, 9, 'garuda sea ayovendor asdf 1', 11000, 11000, 0, 42, 11, '2019-05-19 20:10:09', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 3, 'SUPPLIER', 'SEA', 8, 9, 'garuda sea ayovendor asdf 2', 12000, 12000, 0, 42, 11, '2019-05-19 20:10:10', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 4, 'SUPPLIER', 'SEA', 8, 9, 'garuda sea keduasetelahpertama asdf 1', 13000, 13000, 0, 42, 11, '2019-05-19 20:12:37', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 4, 'SUPPLIER', 'SEA', 8, 9, 'garuda sea keduasetelahpertama asdf 2', 14000, 14000, 0, 42, 11, '2019-05-19 20:12:37', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 3, 'SUPPLIER', 'AIR', 8, 9, 'garuda air ayovendor asdf 1', 11000, 11000, 0, 42, 11, '2019-05-19 20:13:41', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 3, 'SUPPLIER', 'AIR', 8, 9, 'garuda air ayovendor asdf 2', 12000, 12000, 0, 42, 11, '2019-05-19 20:13:41', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 3, 'SUPPLIER', 'LAND', 7, 8, 'test1 land ayovendor asdf 1', 11000, 11000, 0, 42, 11, '2019-05-19 20:14:31', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 3, 'SUPPLIER', 'LAND', 7, 8, 'test1 land ayovendor asdf 2', 12000, 12000, 0, 42, 11, '2019-05-19 20:14:31', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 3, 'SUPPLIER', 'SEA', 7, 8, 'test1 sea ayovendor asdf 1', 11000, 11000, 0, 42, 11, '2019-05-19 20:14:56', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 3, 'SUPPLIER', 'SEA', 7, 8, 'test1 sea ayovendor asdf 2', 12000, 12000, 0, 42, 11, '2019-05-19 20:14:56', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 4, 'SUPPLIER', 'LAND', 7, 8, 'test1 land keduasetelahpertama asdf 1', 14000, 14000, 0, 42, 11, '2019-05-19 20:17:50', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 4, 'SUPPLIER', 'LAND', 7, 8, 'test1 land keduasetelahpertama asdf 2', 16000, 16000, 0, 42, 11, '2019-05-19 20:17:50', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 4, 'SUPPLIER', 'SEA', 7, 8, 'test1 sea keduasetelahpertama asdf 1', 154000, 12000, 0, 42, 11, '2019-05-19 20:18:18', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 4, 'SUPPLIER', 'SEA', 7, 8, 'test1 sea keduasetelahpertama asdf 2', 18000, 17000, 0, 42, 11, '2019-05-19 20:18:18', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 4, 'SUPPLIER', 'AIR', 8, 9, 'garuda air keduasetelahpertama asdf 1', 12300, 12000, 0, 42, 11, '2019-05-19 20:19:34', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 4, 'SUPPLIER', 'AIR', 8, 9, 'garuda air keduasetelahpertama asdf 2', 15000, 14000, 0, 42, 11, '2019-05-19 20:19:34', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `variable_shipping_price`
--
ALTER TABLE `variable_shipping_price`
  ADD PRIMARY KEY (`id_variable_shipping`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `variable_shipping_price`
--
ALTER TABLE `variable_shipping_price`
  MODIFY `id_variable_shipping` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
