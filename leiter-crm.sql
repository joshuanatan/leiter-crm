-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2019 at 10:39 AM
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
-- Table structure for table `contact_person`
--

CREATE TABLE `contact_person` (
  `id_cp` int(11) NOT NULL,
  `nama_cp` varchar(100) NOT NULL DEFAULT '-',
  `jk_cp` varchar(2) NOT NULL DEFAULT '-',
  `email_cp` varchar(100) NOT NULL DEFAULT '-',
  `nohp_cp` varchar(15) NOT NULL DEFAULT '-',
  `jabatan_cp` varchar(100) NOT NULL DEFAULT '-',
  `status_cp` int(11) NOT NULL DEFAULT '0',
  `id_perusahaan` int(11) DEFAULT NULL,
  `id_user_add` int(11) NOT NULL DEFAULT '0',
  `date_cp_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_cp_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_cp_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_person`
--

INSERT INTO `contact_person` (`id_cp`, `nama_cp`, `jk_cp`, `email_cp`, `nohp_cp`, `jabatan_cp`, `status_cp`, `id_perusahaan`, `id_user_add`, `date_cp_add`, `id_user_edit`, `date_cp_edit`, `id_user_delete`, `date_cp_delete`) VALUES
(30, 'Anthony', 'Mr', 'anthony_jasman@hotmail.com', '0811 855 818', 'Marketing', 0, 18, 11, '2019-06-11 23:33:10', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(31, 'Suwandi', 'Mr', 'suwandi@gmail.com', '0877648947488', 'Marketing', 0, 19, 11, '2019-06-11 23:56:55', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(32, 'Liu', 'Mr', 'Liu@gmail.com', '', 'Marketing', 0, 18, 11, '2019-06-12 00:00:19', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(33, 'Celine Kow', 'Ms', 'celine@sefar.com', '', '', 0, 20, 11, '2019-06-12 09:41:26', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(34, 'Selahattin Sahin', 'Mr', 'ssahin@ugurgrubu.com', '089677898878', 'Marketing', 1, 20, 11, '2019-06-12 09:45:04', 11, '0000-00-00 00:00:00', 11, '0000-00-00 00:00:00'),
(35, 'Vivian Beh', 'Ms', 'vivian.beh@cargo-partner.com', '0808089988', 'CEO', 0, 21, 11, '2019-06-12 13:56:46', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(36, 'Emily', 'Ms', 'emily@penanshin.com.sg', '0808080808', 'CEO', 1, 21, 11, '2019-06-12 14:01:29', 0, '0000-00-00 00:00:00', 11, '0000-00-00 00:00:00'),
(37, 'Joshua Natan', 'Mr', 'joshuanatan.jn@gmail.com', '089616961915', 'CEO', 0, 22, 11, '2019-06-14 15:18:37', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(38, 'Davin', 'Mr', 'davin@gmail.com', '089272989', 'Marketing', 0, 22, 11, '2019-06-14 15:19:07', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(39, 'CP 1', 'Mr', 'cp@gmail.com', '08980980', 'CEO', 0, 23, 11, '2019-06-14 15:21:16', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(42, 'Joshua Natan', 'Mr', 'joshuanatan.jn@gmail.com', '089616961915', '-', 0, 26, 0, '2019-06-22 09:11:13', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(43, '', 'Mr', '', '', '-', 0, NULL, 0, '2019-06-22 22:19:44', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(44, '', 'Mr', '', '', '-', 0, NULL, 0, '2019-06-22 22:20:52', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `finance_usage_type`
--

CREATE TABLE `finance_usage_type` (
  `id_type` int(11) NOT NULL,
  `is_patent` int(11) NOT NULL COMMENT '0: paten, gabole diliat dan dirubah, 1, bisa diedit',
  `name_type` varchar(200) NOT NULL DEFAULT '-' COMMENT 'nama tipe pemasukan / pengeluaran',
  `kode_type` varchar(200) NOT NULL COMMENT 'untuk penginputan cashflow secara manual seperti pengeluaran dan yang lain sebagainya, guna menjadi potakan dalam id. contoh: gaji-001',
  `status_type` int(11) NOT NULL DEFAULT '0' COMMENT '0:aktif, 1 tidak',
  `id_user_add` int(11) NOT NULL DEFAULT '0',
  `date_type_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_type_edit` datetime DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_type_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_usage_type`
--

INSERT INTO `finance_usage_type` (`id_type`, `is_patent`, `name_type`, `kode_type`, `status_type`, `id_user_add`, `date_type_add`, `id_user_edit`, `date_type_edit`, `id_user_delete`, `date_type_delete`) VALUES
(1, 0, 'Reimburse', 'RMBS', 0, 11, '2019-06-12 01:36:45', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 1, 'Bunga Bank', 'BGBNK', 0, 11, '2019-06-12 01:48:34', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 0, 'Pembayaran Supplier/Shipper/Courier', 'PMBYRN', 0, 11, '2019-06-24 11:38:34', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 1, 'Fotokopi', 'FC', 0, 0, '2019-06-24 13:02:32', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 0, 'Pembayaran Pajak', 'TAX', 0, 11, '2019-06-25 00:37:41', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 1, 'Tol', 'TOL', 1, 11, '2019-06-27 14:15:03', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `harga_vendor`
--

CREATE TABLE `harga_vendor` (
  `id_harga_vendor` int(11) NOT NULL,
  `id_request_item` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL COMMENT 'nahan value harganya pake ini aja karena 1 item 1 perusahaan sama',
  `id_cp` int(11) NOT NULL COMMENT 'merujuk pada vendor mana yang ditanya terkait barang tersebut',
  `harga_produk` int(11) NOT NULL,
  `satuan_harga_produk` int(11) NOT NULL DEFAULT '1',
  `vendor_price_rate` int(11) NOT NULL DEFAULT '1',
  `mata_uang` varchar(100) NOT NULL DEFAULT 'USD',
  `status_harga_vendor` int(11) NOT NULL DEFAULT '1',
  `notes` text,
  `id_user_add` int(11) NOT NULL,
  `date_harga_vendor_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_harga_vendor_edit` datetime DEFAULT NULL,
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_harga_vendor_delete` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga_vendor`
--

INSERT INTO `harga_vendor` (`id_harga_vendor`, `id_request_item`, `id_perusahaan`, `id_cp`, `harga_produk`, `satuan_harga_produk`, `vendor_price_rate`, `mata_uang`, `status_harga_vendor`, `notes`, `id_user_add`, `date_harga_vendor_add`, `id_user_edit`, `date_harga_vendor_edit`, `id_user_delete`, `date_harga_vendor_delete`) VALUES
(53, 40, 23, 39, 12000, 1, 1110, 'EUR', 1, 'tgl 23', 0, '2019-06-22 22:47:14', 0, NULL, 0, NULL),
(54, 40, 20, 33, 11000, 1, 1200, 'IDR', 1, 'tgl 25', 0, '2019-06-22 23:12:59', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_core`
--

CREATE TABLE `invoice_core` (
  `id_invoice` int(11) NOT NULL,
  `no_invoice` varchar(100) NOT NULL,
  `id_oc` int(11) NOT NULL,
  `id_od` int(11) DEFAULT '0' COMMENT '0 kalau ga pake od',
  `bulan_invoice` varchar(10) NOT NULL,
  `tahun_invoice` int(11) NOT NULL,
  `nominal_pembayaran` bigint(20) NOT NULL,
  `kurs_pembayaran` int(11) NOT NULL DEFAULT '1',
  `mata_uang` varchar(10) NOT NULL DEFAULT 'IDR',
  `is_ppn` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `franco` varchar(200) NOT NULL,
  `up` varchar(200) NOT NULL,
  `status_lunas` int(11) NOT NULL DEFAULT '1' COMMENT '1: blum lunas, 0 lunas',
  `status_aktif_invoice` int(11) NOT NULL DEFAULT '1' COMMENT '1: blum aktif, 0 aktif',
  `id_user_add` int(11) DEFAULT '0',
  `tgl_invoice_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `tgl_invoice_edit` datetime DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `tgl_user_delete` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_core`
--

INSERT INTO `invoice_core` (`id_invoice`, `no_invoice`, `id_oc`, `id_od`, `bulan_invoice`, `tahun_invoice`, `nominal_pembayaran`, `kurs_pembayaran`, `mata_uang`, `is_ppn`, `ppn`, `franco`, `up`, `status_lunas`, `status_aktif_invoice`, `id_user_add`, `tgl_invoice_add`, `id_user_edit`, `tgl_invoice_edit`, `id_user_delete`, `tgl_user_delete`) VALUES
(1, '190601/LI/06/19', 3, 2, '06', 2019, 124667, 1, 'IDR', 0, 11333, '', '', 1, 0, 11, '2019-06-27 14:40:31', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, '190602/LI/06/19', 3, 0, '06', 2019, 187000, 1, 'IDR', 0, 17000, 'jakarta', 'finance department', 1, 0, 11, '2019-06-27 14:40:56', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_margin`
--

CREATE TABLE `item_margin` (
  `id_quotation_item` int(11) NOT NULL,
  `margin_produk` decimal(11,2) NOT NULL,
  `harga_supplier` int(11) NOT NULL,
  `harga_shipping` int(11) NOT NULL,
  `harga_courier` int(11) NOT NULL,
  `notes_supplier` text NOT NULL,
  `notes_shipper` text NOT NULL,
  `notes_courier` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_margin`
--

INSERT INTO `item_margin` (`id_quotation_item`, `margin_produk`, `harga_supplier`, `harga_shipping`, `harga_courier`, `notes_supplier`, `notes_shipper`, `notes_courier`) VALUES
(7, '72.26', 35800, 45000, 13500, 'test1,\r\ntest2', 'test1,\r\ntest2', 'test2');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_user`
--

CREATE TABLE `kpi_user` (
  `id_kpi_user` int(11) NOT NULL COMMENT 'JANGAN NGERFRENCE KESINI KARENA INI BAKAL DI DELETE INSERT TERUS',
  `id_user` int(11) NOT NULL,
  `kpi` varchar(200) NOT NULL COMMENT 'LANGSUNG TEMBAK KESINI DAN ID USER AJA UNTUK PENCACATAN KPI',
  `target_kpi` int(11) NOT NULL,
  `status_aktif_kpi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kpi_user`
--

INSERT INTO `kpi_user` (`id_kpi_user`, `id_user`, `kpi`, `target_kpi`, `status_aktif_kpi`) VALUES
(21, 27, 'kpi 23', 10, 0),
(22, 27, 'kpi 24', 11, 0),
(23, 27, '', 0, 1),
(24, 27, '', 0, 1),
(25, 27, '', 0, 1),
(26, 27, '', 0, 1),
(27, 27, '', 0, 1),
(28, 27, '', 0, 1),
(29, 27, '', 0, 1),
(30, 27, '', 0, 1),
(41, 11, 'kpi 1', 11, 0),
(42, 11, 'kpi 2', 21, 0),
(43, 11, 'kpi 3', 12, 0),
(44, 11, 'kpi 4', 13, 0),
(45, 11, 'kpi 5', 14, 1),
(46, 11, 'kpi 6', 15, 0),
(47, 11, '', 0, 1),
(48, 11, '', 0, 1),
(49, 11, '', 0, 1),
(50, 11, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_privilage`
--

CREATE TABLE `log_privilage` (
  `id_log_privilage` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `status_privilage` int(11) NOT NULL,
  `id_user_edit` int(11) NOT NULL,
  `date_user_edit` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_privilage`
--

INSERT INTO `log_privilage` (`id_log_privilage`, `id_user`, `id_menu`, `status_privilage`, `id_user_edit`, `date_user_edit`) VALUES
(1, 11, 2, 1, 0, '2019-05-12 22:07:53'),
(2, 11, 3, 1, 0, '2019-05-12 22:07:53'),
(3, 12, 1, 1, 0, '2019-05-12 22:14:49'),
(4, 12, 2, 1, 0, '2019-05-12 22:14:49'),
(5, 12, 3, 1, 0, '2019-05-12 22:14:49'),
(6, 12, 1, 0, 0, '2019-05-12 22:15:27'),
(7, 11, 4, 1, 0, '2019-05-13 13:15:50'),
(8, 12, 4, 1, 0, '2019-05-13 13:15:50'),
(9, 11, 5, 1, 0, '2019-05-13 13:15:50'),
(10, 12, 5, 1, 0, '2019-05-13 13:15:50'),
(11, 11, 6, 1, 0, '2019-05-13 13:15:50'),
(12, 12, 6, 1, 0, '2019-05-13 13:15:50'),
(13, 11, 7, 1, 0, '2019-05-13 13:15:50'),
(14, 12, 7, 1, 0, '2019-05-13 13:15:50'),
(15, 11, 8, 1, 0, '2019-05-13 13:15:50'),
(16, 12, 8, 1, 0, '2019-05-13 13:15:50'),
(17, 11, 9, 1, 0, '2019-05-13 13:15:50'),
(18, 12, 9, 1, 0, '2019-05-13 13:15:50'),
(19, 11, 10, 1, 0, '2019-05-13 13:15:50'),
(20, 12, 10, 1, 0, '2019-05-13 13:15:50'),
(21, 11, 11, 1, 0, '2019-05-13 13:15:50'),
(22, 12, 11, 1, 0, '2019-05-13 13:15:50'),
(23, 13, 1, 1, 0, '2019-05-13 14:37:41'),
(24, 13, 2, 1, 0, '2019-05-13 14:37:41'),
(25, 13, 3, 1, 0, '2019-05-13 14:37:41'),
(26, 13, 4, 1, 0, '2019-05-13 14:37:41'),
(27, 13, 5, 1, 0, '2019-05-13 14:37:41'),
(28, 13, 6, 1, 0, '2019-05-13 14:37:41'),
(29, 13, 7, 1, 0, '2019-05-13 14:37:41'),
(30, 13, 8, 1, 0, '2019-05-13 14:37:41'),
(31, 13, 9, 1, 0, '2019-05-13 14:37:41'),
(32, 13, 10, 1, 0, '2019-05-13 14:37:41'),
(33, 13, 11, 1, 0, '2019-05-13 14:37:41'),
(34, 14, 1, 1, 0, '2019-05-13 14:49:13'),
(35, 14, 2, 1, 0, '2019-05-13 14:49:13'),
(36, 14, 3, 1, 0, '2019-05-13 14:49:13'),
(37, 14, 4, 1, 0, '2019-05-13 14:49:13'),
(38, 14, 5, 1, 0, '2019-05-13 14:49:13'),
(39, 14, 6, 1, 0, '2019-05-13 14:49:13'),
(40, 14, 7, 1, 0, '2019-05-13 14:49:13'),
(41, 14, 8, 1, 0, '2019-05-13 14:49:13'),
(42, 14, 9, 1, 0, '2019-05-13 14:49:13'),
(43, 14, 10, 1, 0, '2019-05-13 14:49:13'),
(44, 14, 11, 1, 0, '2019-05-13 14:49:13'),
(45, 15, 1, 1, 0, '2019-05-13 14:50:06'),
(46, 15, 2, 1, 0, '2019-05-13 14:50:06'),
(47, 15, 3, 1, 0, '2019-05-13 14:50:06'),
(48, 15, 4, 1, 0, '2019-05-13 14:50:06'),
(49, 15, 5, 1, 0, '2019-05-13 14:50:06'),
(50, 15, 6, 1, 0, '2019-05-13 14:50:06'),
(51, 15, 7, 1, 0, '2019-05-13 14:50:06'),
(52, 15, 8, 1, 0, '2019-05-13 14:50:06'),
(53, 15, 9, 1, 0, '2019-05-13 14:50:06'),
(54, 15, 10, 1, 0, '2019-05-13 14:50:06'),
(55, 15, 11, 1, 0, '2019-05-13 14:50:06'),
(56, 16, 1, 1, 0, '2019-05-13 14:50:40'),
(57, 16, 2, 1, 0, '2019-05-13 14:50:40'),
(58, 16, 3, 1, 0, '2019-05-13 14:50:40'),
(59, 16, 4, 1, 0, '2019-05-13 14:50:40'),
(60, 16, 5, 1, 0, '2019-05-13 14:50:40'),
(61, 16, 6, 1, 0, '2019-05-13 14:50:40'),
(62, 16, 7, 1, 0, '2019-05-13 14:50:40'),
(63, 16, 8, 1, 0, '2019-05-13 14:50:40'),
(64, 16, 9, 1, 0, '2019-05-13 14:50:40'),
(65, 16, 10, 1, 0, '2019-05-13 14:50:40'),
(66, 16, 11, 1, 0, '2019-05-13 14:50:40'),
(67, 17, 1, 1, 0, '2019-05-13 14:50:48'),
(68, 17, 2, 1, 0, '2019-05-13 14:50:48'),
(69, 17, 3, 1, 0, '2019-05-13 14:50:48'),
(70, 17, 4, 1, 0, '2019-05-13 14:50:48'),
(71, 17, 5, 1, 0, '2019-05-13 14:50:48'),
(72, 17, 6, 1, 0, '2019-05-13 14:50:48'),
(73, 17, 7, 1, 0, '2019-05-13 14:50:48'),
(74, 17, 8, 1, 0, '2019-05-13 14:50:48'),
(75, 17, 9, 1, 0, '2019-05-13 14:50:48'),
(76, 17, 10, 1, 0, '2019-05-13 14:50:48'),
(77, 17, 11, 1, 0, '2019-05-13 14:50:48'),
(78, 18, 1, 1, 0, '2019-05-13 14:51:02'),
(79, 18, 2, 1, 0, '2019-05-13 14:51:02'),
(80, 18, 3, 1, 0, '2019-05-13 14:51:02'),
(81, 18, 4, 1, 0, '2019-05-13 14:51:02'),
(82, 18, 5, 1, 0, '2019-05-13 14:51:02'),
(83, 18, 6, 1, 0, '2019-05-13 14:51:02'),
(84, 18, 7, 1, 0, '2019-05-13 14:51:02'),
(85, 18, 8, 1, 0, '2019-05-13 14:51:02'),
(86, 18, 9, 1, 0, '2019-05-13 14:51:02'),
(87, 18, 10, 1, 0, '2019-05-13 14:51:02'),
(88, 18, 11, 1, 0, '2019-05-13 14:51:02'),
(89, 19, 1, 1, 0, '2019-05-13 14:51:22'),
(90, 19, 2, 1, 0, '2019-05-13 14:51:22'),
(91, 19, 3, 1, 0, '2019-05-13 14:51:22'),
(92, 19, 4, 1, 0, '2019-05-13 14:51:22'),
(93, 19, 5, 1, 0, '2019-05-13 14:51:22'),
(94, 19, 6, 1, 0, '2019-05-13 14:51:22'),
(95, 19, 7, 1, 0, '2019-05-13 14:51:22'),
(96, 19, 8, 1, 0, '2019-05-13 14:51:22'),
(97, 19, 9, 1, 0, '2019-05-13 14:51:22'),
(98, 19, 10, 1, 0, '2019-05-13 14:51:22'),
(99, 19, 11, 1, 0, '2019-05-13 14:51:22'),
(100, 20, 1, 1, 0, '2019-05-13 14:51:48'),
(101, 20, 2, 1, 0, '2019-05-13 14:51:48'),
(102, 20, 3, 1, 0, '2019-05-13 14:51:48'),
(103, 20, 4, 1, 0, '2019-05-13 14:51:48'),
(104, 20, 5, 1, 0, '2019-05-13 14:51:48'),
(105, 20, 6, 1, 0, '2019-05-13 14:51:48'),
(106, 20, 7, 1, 0, '2019-05-13 14:51:48'),
(107, 20, 8, 1, 0, '2019-05-13 14:51:48'),
(108, 20, 9, 1, 0, '2019-05-13 14:51:48'),
(109, 20, 10, 1, 0, '2019-05-13 14:51:48'),
(110, 20, 11, 1, 0, '2019-05-13 14:51:48'),
(111, 21, 1, 1, 0, '2019-05-13 14:53:16'),
(112, 21, 2, 1, 0, '2019-05-13 14:53:16'),
(113, 21, 3, 1, 0, '2019-05-13 14:53:16'),
(114, 21, 4, 1, 0, '2019-05-13 14:53:16'),
(115, 21, 5, 1, 0, '2019-05-13 14:53:16'),
(116, 21, 6, 1, 0, '2019-05-13 14:53:16'),
(117, 21, 7, 1, 0, '2019-05-13 14:53:16'),
(118, 21, 8, 1, 0, '2019-05-13 14:53:16'),
(119, 21, 9, 1, 0, '2019-05-13 14:53:16'),
(120, 21, 10, 1, 0, '2019-05-13 14:53:16'),
(121, 21, 11, 1, 0, '2019-05-13 14:53:16'),
(122, 21, 6, 0, 11, '2019-05-13 14:53:16'),
(123, 21, 7, 0, 11, '2019-05-13 14:53:16'),
(124, 21, 8, 0, 11, '2019-05-13 14:53:16'),
(125, 21, 9, 0, 11, '2019-05-13 14:53:16'),
(126, 21, 1, 0, 11, '2019-05-13 14:53:16'),
(127, 21, 2, 0, 11, '2019-05-13 14:53:16'),
(128, 22, 1, 1, 0, '2019-05-13 14:54:20'),
(129, 22, 2, 1, 0, '2019-05-13 14:54:20'),
(130, 22, 3, 1, 0, '2019-05-13 14:54:20'),
(131, 22, 4, 1, 0, '2019-05-13 14:54:20'),
(132, 22, 5, 1, 0, '2019-05-13 14:54:20'),
(133, 22, 6, 1, 0, '2019-05-13 14:54:20'),
(134, 22, 7, 1, 0, '2019-05-13 14:54:20'),
(135, 22, 8, 1, 0, '2019-05-13 14:54:20'),
(136, 22, 9, 1, 0, '2019-05-13 14:54:20'),
(137, 22, 10, 1, 0, '2019-05-13 14:54:20'),
(138, 22, 11, 1, 0, '2019-05-13 14:54:20'),
(139, 22, 6, 0, 11, '2019-05-13 14:54:20'),
(140, 22, 8, 0, 11, '2019-05-13 14:54:21'),
(141, 22, 10, 0, 11, '2019-05-13 14:54:21'),
(142, 22, 1, 0, 11, '2019-05-13 14:54:21'),
(143, 22, 2, 0, 11, '2019-05-13 14:54:21'),
(144, 23, 1, 1, 0, '2019-05-13 15:00:39'),
(145, 23, 2, 1, 0, '2019-05-13 15:00:39'),
(146, 23, 3, 1, 0, '2019-05-13 15:00:39'),
(147, 23, 4, 1, 0, '2019-05-13 15:00:39'),
(148, 23, 5, 1, 0, '2019-05-13 15:00:39'),
(149, 23, 6, 1, 0, '2019-05-13 15:00:39'),
(150, 23, 7, 1, 0, '2019-05-13 15:00:39'),
(151, 23, 8, 1, 0, '2019-05-13 15:00:39'),
(152, 23, 9, 1, 0, '2019-05-13 15:00:39'),
(153, 23, 10, 1, 0, '2019-05-13 15:00:39'),
(154, 23, 11, 1, 0, '2019-05-13 15:00:39'),
(155, 23, 6, 0, 11, '2019-05-13 15:00:39'),
(156, 23, 8, 0, 11, '2019-05-13 15:00:39'),
(157, 23, 9, 0, 11, '2019-05-13 15:00:39'),
(158, 24, 1, 1, 0, '2019-05-23 08:32:34'),
(159, 24, 2, 1, 0, '2019-05-23 08:32:34'),
(160, 24, 3, 1, 0, '2019-05-23 08:32:34'),
(161, 24, 4, 1, 0, '2019-05-23 08:32:34'),
(162, 24, 5, 1, 0, '2019-05-23 08:32:34'),
(163, 24, 6, 1, 0, '2019-05-23 08:32:34'),
(164, 24, 7, 1, 0, '2019-05-23 08:32:34'),
(165, 24, 8, 1, 0, '2019-05-23 08:32:34'),
(166, 24, 9, 1, 0, '2019-05-23 08:32:34'),
(167, 24, 10, 1, 0, '2019-05-23 08:32:34'),
(168, 24, 11, 1, 0, '2019-05-23 08:32:34'),
(169, 24, 6, 0, 11, '2019-05-23 08:32:34'),
(170, 24, 9, 0, 11, '2019-05-23 08:32:34'),
(171, 24, 10, 0, 11, '2019-05-23 08:32:34'),
(172, 24, 11, 0, 11, '2019-05-23 08:32:35'),
(173, 24, 1, 0, 11, '2019-05-23 08:32:35'),
(174, 24, 2, 0, 11, '2019-05-23 08:32:35'),
(175, 25, 1, 1, 0, '2019-05-23 09:37:40'),
(176, 25, 2, 1, 0, '2019-05-23 09:37:40'),
(177, 25, 3, 1, 0, '2019-05-23 09:37:40'),
(178, 25, 4, 1, 0, '2019-05-23 09:37:40'),
(179, 25, 5, 1, 0, '2019-05-23 09:37:40'),
(180, 25, 6, 1, 0, '2019-05-23 09:37:40'),
(181, 25, 7, 1, 0, '2019-05-23 09:37:40'),
(182, 25, 8, 1, 0, '2019-05-23 09:37:40'),
(183, 25, 9, 1, 0, '2019-05-23 09:37:40'),
(184, 25, 10, 1, 0, '2019-05-23 09:37:40'),
(185, 25, 11, 1, 0, '2019-05-23 09:37:40'),
(186, 25, 4, 0, 11, '2019-05-23 09:37:41'),
(187, 25, 6, 0, 11, '2019-05-23 09:37:41'),
(188, 25, 8, 0, 11, '2019-05-23 09:37:41'),
(189, 25, 10, 0, 11, '2019-05-23 09:37:41'),
(190, 25, 2, 0, 11, '2019-05-23 09:37:41'),
(191, 11, 1, 1, 11, '2019-05-23 09:47:40'),
(192, 11, 2, 1, 11, '2019-05-23 09:47:40'),
(193, 11, 3, 1, 11, '2019-05-23 09:47:40'),
(194, 11, 4, 1, 11, '2019-05-23 09:47:40'),
(195, 11, 5, 1, 11, '2019-05-23 09:47:40'),
(196, 11, 6, 1, 11, '2019-05-23 09:47:40'),
(197, 11, 7, 1, 11, '2019-05-23 09:47:40'),
(198, 11, 8, 1, 11, '2019-05-23 09:47:40'),
(199, 11, 9, 1, 11, '2019-05-23 09:47:40'),
(200, 11, 10, 1, 11, '2019-05-23 09:47:40'),
(201, 11, 11, 1, 11, '2019-05-23 09:47:40'),
(202, 11, 9, 0, 11, '2019-05-23 09:47:40'),
(203, 11, 10, 0, 11, '2019-05-23 09:47:40'),
(204, 11, 11, 0, 11, '2019-05-23 09:47:40'),
(205, 11, 1, 0, 11, '2019-05-23 09:47:40'),
(206, 11, 2, 0, 11, '2019-05-23 09:47:40'),
(207, 23, 1, 1, 11, '2019-05-23 09:48:09'),
(208, 23, 2, 1, 11, '2019-05-23 09:48:09'),
(209, 23, 3, 1, 11, '2019-05-23 09:48:09'),
(210, 23, 4, 1, 11, '2019-05-23 09:48:09'),
(211, 23, 5, 1, 11, '2019-05-23 09:48:09'),
(212, 23, 6, 1, 11, '2019-05-23 09:48:09'),
(213, 23, 7, 1, 11, '2019-05-23 09:48:09'),
(214, 23, 8, 1, 11, '2019-05-23 09:48:09'),
(215, 23, 9, 1, 11, '2019-05-23 09:48:09'),
(216, 23, 10, 1, 11, '2019-05-23 09:48:09'),
(217, 23, 11, 1, 11, '2019-05-23 09:48:09'),
(218, 23, 4, 0, 11, '2019-05-23 09:48:09'),
(219, 23, 5, 0, 11, '2019-05-23 09:48:10'),
(220, 23, 1, 0, 11, '2019-05-23 09:48:10'),
(221, 23, 2, 0, 11, '2019-05-23 09:48:10'),
(222, 23, 3, 0, 11, '2019-05-23 09:48:10'),
(223, 25, 1, 1, 11, '2019-05-23 09:48:20'),
(224, 25, 2, 1, 11, '2019-05-23 09:48:20'),
(225, 25, 3, 1, 11, '2019-05-23 09:48:20'),
(226, 25, 4, 1, 11, '2019-05-23 09:48:20'),
(227, 25, 5, 1, 11, '2019-05-23 09:48:20'),
(228, 25, 6, 1, 11, '2019-05-23 09:48:20'),
(229, 25, 7, 1, 11, '2019-05-23 09:48:20'),
(230, 25, 8, 1, 11, '2019-05-23 09:48:20'),
(231, 25, 9, 1, 11, '2019-05-23 09:48:20'),
(232, 25, 10, 1, 11, '2019-05-23 09:48:20'),
(233, 25, 11, 1, 11, '2019-05-23 09:48:20'),
(234, 25, 4, 0, 11, '2019-05-23 09:48:20'),
(235, 25, 5, 0, 11, '2019-05-23 09:48:20'),
(236, 25, 6, 0, 11, '2019-05-23 09:48:20'),
(237, 25, 7, 0, 11, '2019-05-23 09:48:20'),
(238, 25, 8, 0, 11, '2019-05-23 09:48:20'),
(239, 25, 9, 0, 11, '2019-05-23 09:48:20'),
(240, 25, 10, 0, 11, '2019-05-23 09:48:20'),
(241, 25, 11, 0, 11, '2019-05-23 09:48:21'),
(242, 25, 1, 0, 11, '2019-05-23 09:48:21'),
(243, 25, 2, 0, 11, '2019-05-23 09:48:21'),
(244, 25, 3, 0, 11, '2019-05-23 09:48:21'),
(245, 26, 1, 1, 0, '2019-06-02 20:16:33'),
(246, 26, 2, 1, 0, '2019-06-02 20:16:33'),
(247, 26, 3, 1, 0, '2019-06-02 20:16:33'),
(248, 26, 4, 1, 0, '2019-06-02 20:16:33'),
(249, 26, 5, 1, 0, '2019-06-02 20:16:33'),
(250, 26, 6, 1, 0, '2019-06-02 20:16:33'),
(251, 26, 7, 1, 0, '2019-06-02 20:16:33'),
(252, 26, 8, 1, 0, '2019-06-02 20:16:33'),
(253, 26, 9, 1, 0, '2019-06-02 20:16:33'),
(254, 26, 10, 1, 0, '2019-06-02 20:16:33'),
(255, 26, 11, 1, 0, '2019-06-02 20:16:33'),
(256, 26, 4, 0, 11, '2019-06-02 20:16:33'),
(257, 26, 6, 0, 11, '2019-06-02 20:16:33'),
(258, 26, 8, 0, 11, '2019-06-02 20:16:33'),
(259, 26, 10, 0, 11, '2019-06-02 20:16:33'),
(260, 26, 1, 0, 11, '2019-06-02 20:16:33'),
(261, 26, 2, 0, 11, '2019-06-02 20:16:33'),
(262, 26, 3, 0, 11, '2019-06-02 20:16:33'),
(263, 26, 1, 1, 11, '2019-06-02 20:16:53'),
(264, 26, 2, 1, 11, '2019-06-02 20:16:53'),
(265, 26, 3, 1, 11, '2019-06-02 20:16:53'),
(266, 26, 4, 1, 11, '2019-06-02 20:16:53'),
(267, 26, 5, 1, 11, '2019-06-02 20:16:53'),
(268, 26, 6, 1, 11, '2019-06-02 20:16:53'),
(269, 26, 7, 1, 11, '2019-06-02 20:16:53'),
(270, 26, 8, 1, 11, '2019-06-02 20:16:53'),
(271, 26, 9, 1, 11, '2019-06-02 20:16:53'),
(272, 26, 10, 1, 11, '2019-06-02 20:16:53'),
(273, 26, 11, 1, 11, '2019-06-02 20:16:53'),
(274, 26, 5, 0, 11, '2019-06-02 20:16:54'),
(275, 26, 7, 0, 11, '2019-06-02 20:16:54'),
(276, 26, 9, 0, 11, '2019-06-02 20:16:54'),
(277, 26, 11, 0, 11, '2019-06-02 20:16:54'),
(278, 26, 1, 0, 11, '2019-06-02 20:16:54'),
(279, 26, 3, 0, 11, '2019-06-02 20:16:54'),
(280, 11, 1, 1, 0, '2019-06-12 14:25:08'),
(281, 11, 2, 1, 0, '2019-06-12 14:25:08'),
(282, 11, 3, 1, 0, '2019-06-12 14:25:08'),
(283, 11, 4, 1, 0, '2019-06-12 14:25:08'),
(284, 11, 5, 1, 0, '2019-06-12 14:25:08'),
(285, 11, 6, 1, 0, '2019-06-12 14:25:08'),
(286, 11, 7, 1, 0, '2019-06-12 14:25:08'),
(287, 11, 8, 1, 0, '2019-06-12 14:25:08'),
(288, 11, 9, 1, 0, '2019-06-12 14:25:08'),
(289, 11, 10, 1, 0, '2019-06-12 14:25:08'),
(290, 11, 11, 1, 0, '2019-06-12 14:25:08'),
(291, 27, 1, 1, 0, '2019-06-12 14:40:34'),
(292, 27, 2, 1, 0, '2019-06-12 14:40:34'),
(293, 27, 3, 1, 0, '2019-06-12 14:40:34'),
(294, 27, 4, 1, 0, '2019-06-12 14:40:34'),
(295, 27, 5, 1, 0, '2019-06-12 14:40:34'),
(296, 27, 6, 1, 0, '2019-06-12 14:40:34'),
(297, 27, 7, 1, 0, '2019-06-12 14:40:34'),
(298, 27, 8, 1, 0, '2019-06-12 14:40:34'),
(299, 27, 9, 1, 0, '2019-06-12 14:40:34'),
(300, 27, 10, 1, 0, '2019-06-12 14:40:34'),
(301, 27, 11, 1, 0, '2019-06-12 14:40:34'),
(302, 27, 5, 0, 11, '2019-06-12 14:40:34'),
(303, 27, 6, 0, 11, '2019-06-12 14:40:34'),
(304, 27, 7, 0, 11, '2019-06-12 14:40:34'),
(305, 27, 8, 0, 11, '2019-06-12 14:40:34'),
(306, 27, 9, 0, 11, '2019-06-12 14:40:34'),
(307, 27, 11, 0, 11, '2019-06-12 14:40:34'),
(308, 27, 1, 0, 11, '2019-06-12 14:40:34'),
(309, 27, 2, 0, 11, '2019-06-12 14:40:34'),
(310, 27, 3, 0, 11, '2019-06-12 14:40:34'),
(311, 27, 1, 1, 11, '2019-06-12 14:41:09'),
(312, 27, 2, 1, 11, '2019-06-12 14:41:09'),
(313, 27, 3, 1, 11, '2019-06-12 14:41:09'),
(314, 27, 4, 1, 11, '2019-06-12 14:41:09'),
(315, 27, 5, 1, 11, '2019-06-12 14:41:09'),
(316, 27, 6, 1, 11, '2019-06-12 14:41:09'),
(317, 27, 7, 1, 11, '2019-06-12 14:41:09'),
(318, 27, 8, 1, 11, '2019-06-12 14:41:09'),
(319, 27, 9, 1, 11, '2019-06-12 14:41:09'),
(320, 27, 10, 1, 11, '2019-06-12 14:41:09'),
(321, 27, 11, 1, 11, '2019-06-12 14:41:09'),
(322, 27, 1, 1, 11, '2019-06-12 14:41:19'),
(323, 27, 2, 1, 11, '2019-06-12 14:41:19'),
(324, 27, 3, 1, 11, '2019-06-12 14:41:19'),
(325, 27, 4, 1, 11, '2019-06-12 14:41:19'),
(326, 27, 5, 1, 11, '2019-06-12 14:41:19'),
(327, 27, 6, 1, 11, '2019-06-12 14:41:19'),
(328, 27, 7, 1, 11, '2019-06-12 14:41:19'),
(329, 27, 8, 1, 11, '2019-06-12 14:41:19'),
(330, 27, 9, 1, 11, '2019-06-12 14:41:19'),
(331, 27, 10, 1, 11, '2019-06-12 14:41:19'),
(332, 27, 11, 1, 11, '2019-06-12 14:41:19'),
(333, 27, 5, 0, 11, '2019-06-12 14:41:20'),
(334, 27, 6, 0, 11, '2019-06-12 14:41:20'),
(335, 27, 7, 0, 11, '2019-06-12 14:41:20'),
(336, 27, 8, 0, 11, '2019-06-12 14:41:20'),
(337, 27, 9, 0, 11, '2019-06-12 14:41:20'),
(338, 27, 10, 0, 11, '2019-06-12 14:41:20'),
(339, 27, 1, 0, 11, '2019-06-12 14:41:20'),
(340, 27, 2, 0, 11, '2019-06-12 14:41:20'),
(341, 27, 3, 0, 11, '2019-06-12 14:41:20'),
(342, 28, 1, 1, 0, '2019-06-12 15:02:25'),
(343, 28, 2, 1, 0, '2019-06-12 15:02:25'),
(344, 28, 3, 1, 0, '2019-06-12 15:02:25'),
(345, 28, 4, 1, 0, '2019-06-12 15:02:25'),
(346, 28, 5, 1, 0, '2019-06-12 15:02:25'),
(347, 28, 6, 1, 0, '2019-06-12 15:02:25'),
(348, 28, 7, 1, 0, '2019-06-12 15:02:25'),
(349, 28, 8, 1, 0, '2019-06-12 15:02:25'),
(350, 28, 9, 1, 0, '2019-06-12 15:02:25'),
(351, 28, 10, 1, 0, '2019-06-12 15:02:25'),
(352, 28, 11, 1, 0, '2019-06-12 15:02:25'),
(353, 28, 4, 0, 11, '2019-06-12 15:02:25'),
(354, 28, 6, 0, 11, '2019-06-12 15:02:25'),
(355, 28, 8, 0, 11, '2019-06-12 15:02:25'),
(356, 28, 10, 0, 11, '2019-06-12 15:02:25'),
(357, 28, 2, 0, 11, '2019-06-12 15:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `log_user`
--

CREATE TABLE `log_user` (
  `id_log_user` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `nohp_user` varchar(14) NOT NULL,
  `status_user` int(11) NOT NULL,
  `id_user_author` int(11) NOT NULL,
  `date_edit` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_user`
--

INSERT INTO `log_user` (`id_log_user`, `id_user`, `nama_user`, `email_user`, `nohp_user`, `status_user`, `id_user_author`, `date_edit`) VALUES
(1, 11, 'Joshua Natan', 'joshuanatan.jn@gmail.com', '089616961915', 0, 1, '2019-05-12 21:55:11'),
(6, 12, 'Shinta Melinda Sukardi', 'shinta.melinda@leiter.co.id', '08111045532', 0, 1, '2019-05-12 22:14:49'),
(7, 13, 'Robert Cau', 'bob@leiter.co.id', '123456789', 0, 11, '2019-05-13 14:37:41'),
(8, 14, 'Robert Cau', 'bob@leiter.co.id', '123456789', 0, 11, '2019-05-13 14:49:13'),
(9, 15, 'Test Account ', 'testaccount@example.com', '123412341234', 0, 11, '2019-05-13 14:50:06'),
(10, 16, 'Test Account ', 'testaccount@example.com', '123412341234', 0, 11, '2019-05-13 14:50:40'),
(11, 17, 'Test Account ', 'testaccount@example.com', '123412341234', 0, 11, '2019-05-13 14:50:48'),
(12, 18, 'Test Account ', 'testaccount@example.com', '123412341234', 0, 11, '2019-05-13 14:51:02'),
(13, 19, 'Test Account ', 'testaccount@example.com', '123412341234', 0, 11, '2019-05-13 14:51:22'),
(14, 20, 'Test Account ', 'testaccount@example.com', '123412341234', 0, 11, '2019-05-13 14:51:48'),
(15, 21, 'Test Account ', 'testaccount@example.com', '123412341234', 0, 11, '2019-05-13 14:53:16'),
(16, 22, 'test acount 2', 'testaccount2@gmail.com', '123412341234', 0, 11, '2019-05-13 14:54:20'),
(17, 23, 'Test account 3', 'testacoount@gmail.com', '123412341234', 0, 11, '2019-05-13 15:00:39'),
(18, 24, 'Test Employee 4', 'asdf@gmail.com', '12341234', 0, 11, '2019-05-23 08:32:34'),
(19, 24, 'Test Employee 444444444444444', 'asdf@gmail.com4444444444444444444', '12341234444444', 0, 11, '2019-05-23 08:32:34'),
(20, 24, 'Test Employee 444444444444444', 'asdf@gmail.com4444444444444444444', '12341234444444', 1, 11, '2019-05-23 08:32:34'),
(21, 25, 'test edit privilege', 'privilege@user.cin', '12341234', 0, 11, '2019-05-23 09:37:40'),
(22, 26, 'Stevan Nathan', 'stevannathanwijaya@gmail.com', '12332132132', 0, 11, '2019-06-02 20:16:33'),
(23, 26, 'Stevan Nathan W', 'stevannathanwijaya@yahoo.com', '1111111111111', 0, 11, '2019-06-02 20:16:33'),
(24, 23, 'Test account 3', 'testacoount@gmail.com', '123412341234', 1, 11, '2019-05-13 15:00:39'),
(25, 25, 'test edit privilege', 'privilege@user.cin', '12341234', 1, 11, '2019-05-23 09:37:40'),
(26, 11, 'Joshua Natan', 'joshuanatan.jn@gmail.com', '089616961915', 0, 11, '2019-06-12 14:25:08'),
(27, 27, 'Darus', 'darus@leiter.co.id', '081239438491', 0, 11, '2019-06-12 14:40:34'),
(28, 27, 'Darus0', 'darus@leiter.co.id0', '0812394384910', 0, 11, '2019-06-12 14:40:34'),
(29, 27, 'Darus', 'darus@leiter.co.id', '081239438491', 0, 11, '2019-06-12 14:40:34'),
(30, 27, 'Darus', 'darus@leiter.co.id', '081239438491', 1, 11, '2019-06-12 14:40:34'),
(31, 27, 'Darus', 'darus@leiter.co.id', '081239438491', 0, 11, '2019-06-12 14:40:34'),
(32, 11, 'Joshua Natan', 'joshuanatan.jn@gmail.com', '089616961915', 0, 11, '2019-06-12 14:25:08'),
(33, 11, 'Joshua Natan', 'joshuanatan.jn@gmail.com', '089616961915', 0, 11, '2019-06-12 14:25:08'),
(34, 11, 'Joshua Natan', 'joshuanatan.jn@gmail.com', '089616961915', 0, 11, '2019-06-12 14:25:08'),
(35, 27, 'Darus', 'darus@leiter.co.id', '081239438491', 0, 11, '2019-06-12 14:40:34'),
(36, 27, 'Darus', 'darus@leiter.co.id', '081239438491', 0, 11, '2019-06-12 14:40:34'),
(37, 27, 'Darus', 'darus@leiter.co.id', '081239438491', 0, 11, '2019-06-12 14:40:34'),
(38, 28, 'Daniel Wijaya', 'daniel@leiter.co.id', '089766784456', 0, 11, '2019-06-12 15:02:25'),
(39, 28, 'Daniel Wijaya', 'daniel@leiter.co.id', '089766784456', 0, 11, '2019-06-12 15:02:25'),
(40, 28, 'Daniel Wijaya', 'daniel@leiter.co.id', '089766784456', 1, 11, '2019-06-12 15:02:25'),
(41, 28, 'Daniel Wijaya', 'daniel@leiter.co.id', '089766784456', 0, 11, '2019-06-12 15:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `mata_uang`
--

CREATE TABLE `mata_uang` (
  `id_mata_uang` int(11) NOT NULL,
  `mata_uang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_uang`
--

INSERT INTO `mata_uang` (`id_mata_uang`, `mata_uang`) VALUES
(1, 'USD'),
(2, 'IDR'),
(3, 'EUR');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `link_control` varchar(100) NOT NULL,
  `type_menu` varchar(100) NOT NULL COMMENT 'MASTER, CRM',
  `head_menu` varchar(100) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `status_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `link_control`, `type_menu`, `head_menu`, `nama_menu`, `status_menu`) VALUES
(1, 'employee', 'MASTER', 'master/user/', 'Employee', 0),
(2, 'labor', 'MASTER', 'master/user/', 'Labor', 0),
(3, 'sales', 'MASTER', 'master/user/', 'Sales', 0),
(4, 'goods', 'CRM', 'crm/', 'Goods', 0),
(5, 'invoice', 'CRM', 'crm/', 'Invoice', 0),
(6, 'oc', 'CRM', 'crm/', 'Order Confirmation', 0),
(7, 'od', 'CRM', 'crm/', 'Order Delivery', 0),
(8, 'po', 'CRM', 'crm/', 'Purchase Order', 0),
(9, 'quotation', 'CRM', 'crm/', 'Quotation', 0),
(10, 'request', 'CRM', 'crm/', 'Price Request', 0),
(11, 'vendor', 'CRM', 'crm/', 'Vendor Price', 0);

--
-- Triggers `menu`
--
DELIMITER $$
CREATE TRIGGER `add additional privilage` AFTER INSERT ON `menu` FOR EACH ROW BEGIN
    insert into privilage(id_menu,id_user,status_privilage,id_user_edit,date_user_edit) select NEW.id_menu, user.id_user, 1, 'SYSTEM', now() from user;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_metode_pembayaran` int(11) NOT NULL,
  `persentase_pembayaran` int(11) NOT NULL,
  `nominal_pembayaran` bigint(11) NOT NULL,
  `trigger_pembayaran` int(11) NOT NULL COMMENT '1: sesudah OC; 2: setelah OD;',
  `persentase_pembayaran2` int(11) DEFAULT NULL,
  `nominal_pembayaran2` int(11) DEFAULT NULL,
  `trigger_pembayaran2` int(11) NOT NULL,
  `id_quotation` int(11) NOT NULL,
  `id_versi` int(11) NOT NULL,
  `kurs` varchar(100) NOT NULL,
  `id_oc` int(11) NOT NULL DEFAULT '0',
  `status_invoice` int(11) NOT NULL DEFAULT '1' COMMENT '0: sudah aktif, 1 belum',
  `id_invoice` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id_metode_pembayaran`, `persentase_pembayaran`, `nominal_pembayaran`, `trigger_pembayaran`, `persentase_pembayaran2`, `nominal_pembayaran2`, `trigger_pembayaran2`, `id_quotation`, `id_versi`, `kurs`, `id_oc`, `status_invoice`, `id_invoice`) VALUES
(74, 50, 170000, 1, 50, 170000, 2, 1, 8, 'IDR', 3, 1, 0),
(80, 0, 0, 0, 100, 200000, 2, 2, 3, 'IDR', 4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `metode_pengiriman_shipping`
--

CREATE TABLE `metode_pengiriman_shipping` (
  `id_perusahaan` int(11) NOT NULL,
  `metode_pengiriman` varchar(10) NOT NULL,
  `status_metode_pengiriman` int(11) NOT NULL DEFAULT '1',
  `id_user_add` int(11) NOT NULL,
  `date_metode_pengiriman_add` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_metode_pengiriman_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_metode_pengiriman_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metode_pengiriman_shipping`
--

INSERT INTO `metode_pengiriman_shipping` (`id_perusahaan`, `metode_pengiriman`, `status_metode_pengiriman`, `id_user_add`, `date_metode_pengiriman_add`, `id_user_edit`, `date_metode_pengiriman_edit`, `id_user_delete`, `date_metode_pengiriman_delete`) VALUES
(0, '', 1, 0, '2019-05-23 02:03:05', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'AIR', 1, 11, '2019-05-14 15:59:46', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'LAND', 1, 11, '2019-05-14 15:59:46', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'AIR', 0, 11, '2019-05-14 16:12:58', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'LAND', 0, 11, '2019-05-14 16:12:58', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'SEA', 1, 11, '2019-05-14 16:12:58', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 'AIR', 0, 11, '2019-05-18 22:04:33', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 'LAND', 1, 11, '2019-05-18 22:04:33', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 'SEA', 1, 11, '2019-05-18 22:04:33', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 'AIR', 0, 11, '2019-06-02 20:12:57', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 'LAND', 0, 11, '2019-06-02 20:12:57', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 'SEA', 0, 11, '2019-06-02 20:12:57', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(21, 'AIR', 0, 11, '2019-06-12 13:56:47', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(21, 'LAND', 1, 11, '2019-06-12 13:56:47', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(21, 'SEA', 0, 11, '2019-06-12 13:56:47', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `od_core`
--

CREATE TABLE `od_core` (
  `id_od` int(11) NOT NULL,
  `no_od` varchar(100) NOT NULL,
  `id_oc` int(11) NOT NULL,
  `id_courier` int(11) NOT NULL,
  `delivery_method` varchar(100) NOT NULL,
  `status_od` int(11) NOT NULL DEFAULT '0',
  `bulan_od` varchar(10) NOT NULL,
  `tahun_od` int(11) NOT NULL,
  `id_user_add` int(11) NOT NULL,
  `date_od_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_od_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_od_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `od_core`
--

INSERT INTO `od_core` (`id_od`, `no_od`, `id_oc`, `id_courier`, `delivery_method`, `status_od`, `bulan_od`, `tahun_od`, `id_user_add`, `date_od_add`, `id_user_edit`, `date_od_edit`, `id_user_delete`, `date_od_delete`) VALUES
(1, '190601/LI/SJ/19', 3, 21, 'LAND', 0, '06', 2019, 11, '2019-06-14 01:55:12', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, '190602/LI/SJ/19', 3, 21, 'LAND', 0, '06', 2019, 11, '2019-06-14 01:55:58', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `od_item`
--

CREATE TABLE `od_item` (
  `id_od_item` int(11) NOT NULL,
  `id_od` int(11) NOT NULL,
  `id_quotation_item` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `od_item`
--

INSERT INTO `od_item` (`id_od_item`, `id_od`, `id_quotation_item`, `item_qty`) VALUES
(2, 1, 7, 10),
(3, 2, 7, 20);

-- --------------------------------------------------------

--
-- Table structure for table `order_confirmation`
--

CREATE TABLE `order_confirmation` (
  `id_oc` int(11) NOT NULL,
  `no_oc` varchar(100) NOT NULL,
  `id_quotation` int(11) NOT NULL,
  `versi_quotation` int(11) NOT NULL,
  `no_po_customer` varchar(200) NOT NULL,
  `status_oc` int(11) NOT NULL DEFAULT '0' COMMENT 'kalau 0, masih oc, 1: delete, 2 sudah po, 3 udah oc',
  `status_aktif_oc` int(11) NOT NULL DEFAULT '0' COMMENT '0 aktif, 1, tidak aktof',
  `id_user_add` int(11) NOT NULL,
  `date_oc_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_oc_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_oc_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_confirmation`
--

INSERT INTO `order_confirmation` (`id_oc`, `no_oc`, `id_quotation`, `versi_quotation`, `no_po_customer`, `status_oc`, `status_aktif_oc`, `id_user_add`, `date_oc_add`, `id_user_edit`, `date_oc_edit`, `id_user_delete`, `date_oc_delete`) VALUES
(3, 'LI-20190003', 1, 8, 'PO/CUST/2019/001', 0, 0, 11, '2019-06-13 20:49:49', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'LI-20190004', 2, 3, 'PO/CUST/2019/002', 2, 0, 11, '2019-06-14 02:56:33', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_refrensi` varchar(200) NOT NULL COMMENT 'nomor tagihan / id tagihan (untuk uang keluar) / no invoice leiter (untuk uang masuk)',
  `subject_pembayaran` varchar(200) NOT NULL COMMENT 'judul pembayarannya',
  `tgl_bayar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'harusnay ini ada input dari depan karena ga setiap kali bayar langsung di masukin ke sistem',
  `attachment` text NOT NULL COMMENT 'bukti bayarnya',
  `notes_pembayaran` text NOT NULL,
  `nominal_pembayaran` int(11) NOT NULL COMMENT 'yang dibayarkan dalam mata uang masing-masing',
  `kurs_pembayaran` int(11) NOT NULL COMMENT 'mata uang pembayaran terhadap idr ',
  `mata_uang_pembayaran` varchar(10) NOT NULL,
  `total_pembayaran` int(11) NOT NULL COMMENT 'dalam IDR',
  `metode_pembayaran` int(11) NOT NULL COMMENT 'bank & cash',
  `jenis_pembayaran` varchar(200) NOT NULL COMMENT 'MASUK / KELUAR',
  `kategori_pembayaran` int(11) NOT NULL COMMENT 'ngerefrence ke finance_usage_type'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_refrensi`, `subject_pembayaran`, `tgl_bayar`, `attachment`, `notes_pembayaran`, `nominal_pembayaran`, `kurs_pembayaran`, `mata_uang_pembayaran`, `total_pembayaran`, `metode_pembayaran`, `jenis_pembayaran`, `kategori_pembayaran`) VALUES
(13, '2', 'Pembayaran sefar DP', '2019-07-03 00:00:00', 'error_login.png', 'Pembayaran 1/3', 2484000, 1, 'IDR', 2484000, 0, 'KELUAR', 3),
(14, '3', 'Pelunasan Tiki', '2019-07-06 00:00:00', '-', 'barang sudah sampai semua', 3850000, 1, 'IDR', 3850000, 0, 'KELUAR', 3),
(18, 'RMBS-5', 'Pembayaran uang tol jeen', '2019-07-02 00:00:00', '593213.jpg', 'semagnat ya ', 400000, 1, 'IDR', 400000, 0, 'KELUAR', 3),
(19, 'RMBS-6', 'ganti uang beli atk', '2019-06-26 00:00:00', '381811.jpg', 'sudah ya', 230000, 1, 'IDR', 230000, 0, 'KELUAR', 3),
(20, 'RMBS-7', 'Pembayaran uang makan', '2019-06-27 00:00:00', '-', '', 34000, 1, 'IDR', 34000, 1, 'KELUAR', 3),
(23, '00000000447120190509700469', 'pembayaran pib sefar', '2019-06-27 00:00:00', '-', 'pembayaran barang masuk', 156748000, 1, 'IDR', 156748000, 0, 'KELUAR', 5);

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
(23, 'PT Product Vendor', '12345678', 'Alamat 1\r\nalamt 2', '08980980', 'PRODUK', 'Machine', 0, 0, 11, '2019-06-14 15:21:16', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(26, 'PT Example 2', '-', NULL, '-', 'CUSTOMER', 'Food', 0, 1, 0, '2019-06-22 09:11:12', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(31, '', '-', NULL, '-', 'PRODUK', '', 0, 1, 0, '2019-06-22 22:19:44', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(32, '', '-', NULL, '-', 'PRODUK', '', 0, 1, 0, '2019-06-22 22:20:53', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `petty_cash`
--

CREATE TABLE `petty_cash` (
  `id_transaksi_petty` int(11) NOT NULL,
  `id_user_add` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `expanses_type` varchar(200) NOT NULL,
  `notes` text NOT NULL,
  `attachment` varchar(200) NOT NULL,
  `status_transaksi_petty` int(11) NOT NULL,
  `status_aktif_petty` int(11) NOT NULL,
  `tgl_transaksi_petty` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petty_cash`
--

INSERT INTO `petty_cash` (`id_transaksi_petty`, `id_user_add`, `amount`, `expanses_type`, `notes`, `attachment`, `status_transaksi_petty`, `status_aktif_petty`, `tgl_transaksi_petty`, `subject`) VALUES
(12, 11, 30000, '4', 'makanan rapat', '5932136.jpg', 0, 0, '2019-06-26 00:00:00', 'Pembayaran makanan');

-- --------------------------------------------------------

--
-- Table structure for table `pib`
--

CREATE TABLE `pib` (
  `id_pib` int(11) NOT NULL,
  `no_pib` varchar(200) NOT NULL,
  `tgl_pib_masuk` date NOT NULL,
  `ppn_impor` int(11) NOT NULL,
  `pph_impor` int(11) NOT NULL,
  `bea_cukai` int(11) NOT NULL,
  `no_po` varchar(200) NOT NULL,
  `notes_pib` text NOT NULL,
  `attachment` text NOT NULL,
  `status_aktif_pib` int(11) NOT NULL,
  `status_bayar_pib` int(11) NOT NULL DEFAULT '1' COMMENT '1 belum bayar,0 sudah bayar',
  `tgl_input_pib` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pib`
--

INSERT INTO `pib` (`id_pib`, `no_pib`, `tgl_pib_masuk`, `ppn_impor`, `pph_impor`, `bea_cukai`, `no_po`, `notes_pib`, `attachment`, `status_aktif_pib`, `status_bayar_pib`, `tgl_input_pib`) VALUES
(4, '00000000447120190509700469', '2019-05-01', 90805000, 22702000, 43241000, 'PO-000001', 'Biaya PIB nanshin 49 - sefar- barang ica #2 petrokimia 2321 pa1', '38181.jpg', 0, 0, '2019-06-27 07:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `po_core`
--

CREATE TABLE `po_core` (
  `id_po` int(11) NOT NULL,
  `id_po_setting` int(11) NOT NULL,
  `no_po` varchar(100) NOT NULL,
  `id_supplier` varchar(100) NOT NULL,
  `id_shipper` int(11) NOT NULL,
  `shipping_method` varchar(100) NOT NULL,
  `total_supplier_payment` int(11) NOT NULL,
  `total_shipper_payment` int(11) NOT NULL,
  `kurs_supplier` varchar(100) NOT NULL,
  `kurs_shipping` varchar(100) NOT NULL,
  `status_po` int(11) NOT NULL DEFAULT '0',
  `id_user_add` int(11) NOT NULL,
  `date_po_core_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_po_core_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_po_core_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_core`
--

INSERT INTO `po_core` (`id_po`, `id_po_setting`, `no_po`, `id_supplier`, `id_shipper`, `shipping_method`, `total_supplier_payment`, `total_shipper_payment`, `kurs_supplier`, `kurs_shipping`, `status_po`, `id_user_add`, `date_po_core_add`, `id_user_edit`, `date_po_core_edit`, `id_user_delete`, `date_po_core_delete`) VALUES
(1, 1, 'PO-00001', '20', 21, 'AIR', 220000, 252000000, 'EUR', '-', 0, 11, '2019-06-14 03:13:45', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `po_item`
--

CREATE TABLE `po_item` (
  `id_po_item` int(11) NOT NULL,
  `id_po_setting` int(11) NOT NULL,
  `id_request_item` int(11) NOT NULL COMMENT 'nanti di join sampe produk vendor',
  `harga_item` int(11) NOT NULL,
  `jumlah_item` int(11) NOT NULL,
  `kurs` int(11) NOT NULL,
  `mata_uang` varchar(10) NOT NULL,
  `id_supplier` int(11) NOT NULL DEFAULT '0' COMMENT 'barang request ini akan dipesan kesiapa',
  `id_shipper` int(11) NOT NULL DEFAULT '0' COMMENT 'akan diantar pake apa ke leiter',
  `shipping_method` varchar(100) NOT NULL,
  `harga_shipping` int(11) NOT NULL,
  `id_po` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_item`
--

INSERT INTO `po_item` (`id_po_item`, `id_po_setting`, `id_request_item`, `harga_item`, `jumlah_item`, `kurs`, `mata_uang`, `id_supplier`, `id_shipper`, `shipping_method`, `harga_shipping`, `id_po`) VALUES
(10, 1, 1, 220000, 350, 10000, 'EUR', 20, 21, 'AIR', 252000000, 1),
(11, 2, 7, 60000, 300, 12000, 'EUR', 20, 21, 'SEA', 549000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `po_setting`
--

CREATE TABLE `po_setting` (
  `id_po_setting` int(11) NOT NULL,
  `id_oc` int(11) NOT NULL,
  `sudah_po` int(11) NOT NULL DEFAULT '1' COMMENT '1: belum po, 0 sudah po',
  `tgl_po` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_add` int(11) NOT NULL,
  `date_po_setting_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_po_setting_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_po_setting_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_setting`
--

INSERT INTO `po_setting` (`id_po_setting`, `id_oc`, `sudah_po`, `tgl_po`, `id_user_add`, `date_po_setting_create`, `id_user_edit`, `date_po_setting_edit`, `id_user_delete`, `date_po_setting_delete`) VALUES
(1, 3, 1, '2019-06-14 01:35:09', 11, '2019-06-14 01:35:09', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 4, 1, '2019-06-14 03:00:06', 11, '2019-06-14 03:00:06', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

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
(2, 'LI-002/RFQ/VI/2019', '2019-06-29', 19, 31, 'Surabaya', '06', '2019', 1, 1, 0, 11, '2019-06-22 00:11:53', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'LI-003/RFQ/VI/2019', '2019-06-30', 26, 42, 'Surabaya', '06', '2019', 1, 1, 0, 11, '2019-06-22 09:11:44', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

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
(36, 'LI-002/RFQ/VI/2019', 'Sefar Accuflow 03-600-20 ADBLUE 75cm', '30meter', 'harga 30ribu', 'assignment3_0000002027110.docx', 0, 11, '2019-06-22 07:24:07', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(37, 'LI-002/RFQ/VI/2019', 'items 4', '40meter', 'harga 40ribu', 'assignment4_00000020271.docx', 0, 11, '2019-06-22 07:24:07', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(38, 'LI-002/RFQ/VI/2019', 'items 5', '50meter', 'harga 50ribu', '-', 0, 11, '2019-06-22 07:24:08', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(39, 'LI-001/RFQ/VI/2019', 'Sefar Accuflow 07-230-60 75cm', '10 meter', '10ribu / meter', 'assignment1_0000002027110.docx', 0, 11, '2019-06-22 07:24:49', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(40, 'LI-001/RFQ/VI/2019', 'items 2', '20 mter', '20ribu/meter', '-', 0, 11, '2019-06-22 07:24:49', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(50, 'LI-003/RFQ/VI/2019', 'item 1', '10 meter', '10ribu/meter', 'assignment5_000000202713.docx', 0, 11, '2019-06-22 09:15:34', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(51, 'LI-003/RFQ/VI/2019', 'item 2', '20 meter', '20ribu/meter2', 'assignment5_000000202714.docx', 0, 11, '2019-06-22 09:15:34', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1),
(52, 'LI-003/RFQ/VI/2019', 'item3', '30 meter', '30ribu/meter', '-', 0, 11, '2019-06-22 09:15:34', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `privilage`
--

CREATE TABLE `privilage` (
  `id_privilage` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_privilage` int(11) NOT NULL,
  `id_user_edit` int(11) NOT NULL,
  `date_user_edit` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privilage`
--

INSERT INTO `privilage` (`id_privilage`, `id_menu`, `id_user`, `status_privilage`, `id_user_edit`, `date_user_edit`) VALUES
(4, 1, 11, 0, 11, '2019-05-23 04:47:40'),
(5, 2, 11, 0, 11, '2019-05-23 04:47:40'),
(6, 3, 11, 1, 11, '2019-05-23 04:47:40'),
(7, 1, 12, 0, 0, '2019-05-12 22:14:49'),
(8, 2, 12, 1, 0, '2019-05-12 22:14:49'),
(9, 3, 12, 1, 0, '2019-05-12 22:14:49'),
(10, 4, 11, 1, 11, '2019-05-23 04:47:40'),
(11, 4, 12, 1, 0, '2019-05-13 13:15:50'),
(13, 5, 11, 1, 11, '2019-05-23 04:47:40'),
(14, 5, 12, 1, 0, '2019-05-13 13:15:50'),
(16, 6, 11, 1, 11, '2019-05-23 04:47:40'),
(17, 6, 12, 1, 0, '2019-05-13 13:15:50'),
(19, 7, 11, 1, 11, '2019-05-23 04:47:40'),
(20, 7, 12, 1, 0, '2019-05-13 13:15:50'),
(22, 8, 11, 1, 11, '2019-05-23 04:47:40'),
(23, 8, 12, 1, 0, '2019-05-13 13:15:50'),
(25, 9, 11, 0, 11, '2019-05-23 04:47:40'),
(26, 9, 12, 1, 0, '2019-05-13 13:15:50'),
(28, 10, 11, 0, 11, '2019-05-23 04:47:40'),
(29, 10, 12, 1, 0, '2019-05-13 13:15:50'),
(31, 11, 11, 0, 11, '2019-05-23 04:47:40'),
(32, 11, 12, 1, 0, '2019-05-13 13:15:50'),
(34, 1, 13, 1, 0, '2019-05-13 14:37:41'),
(35, 2, 13, 1, 0, '2019-05-13 14:37:41'),
(36, 3, 13, 1, 0, '2019-05-13 14:37:41'),
(37, 4, 13, 1, 0, '2019-05-13 14:37:41'),
(38, 5, 13, 1, 0, '2019-05-13 14:37:41'),
(39, 6, 13, 1, 0, '2019-05-13 14:37:41'),
(40, 7, 13, 1, 0, '2019-05-13 14:37:41'),
(41, 8, 13, 1, 0, '2019-05-13 14:37:41'),
(42, 9, 13, 1, 0, '2019-05-13 14:37:41'),
(43, 10, 13, 1, 0, '2019-05-13 14:37:41'),
(44, 11, 13, 1, 0, '2019-05-13 14:37:41'),
(49, 1, 14, 1, 0, '2019-05-13 14:49:13'),
(50, 2, 14, 1, 0, '2019-05-13 14:49:13'),
(51, 3, 14, 1, 0, '2019-05-13 14:49:13'),
(52, 4, 14, 1, 0, '2019-05-13 14:49:13'),
(53, 5, 14, 1, 0, '2019-05-13 14:49:13'),
(54, 6, 14, 1, 0, '2019-05-13 14:49:13'),
(55, 7, 14, 1, 0, '2019-05-13 14:49:13'),
(56, 8, 14, 1, 0, '2019-05-13 14:49:13'),
(57, 9, 14, 1, 0, '2019-05-13 14:49:13'),
(58, 10, 14, 1, 0, '2019-05-13 14:49:13'),
(59, 11, 14, 1, 0, '2019-05-13 14:49:13'),
(64, 1, 15, 1, 0, '2019-05-13 14:50:06'),
(65, 2, 15, 1, 0, '2019-05-13 14:50:06'),
(66, 3, 15, 1, 0, '2019-05-13 14:50:06'),
(67, 4, 15, 1, 0, '2019-05-13 14:50:06'),
(68, 5, 15, 1, 0, '2019-05-13 14:50:06'),
(69, 6, 15, 1, 0, '2019-05-13 14:50:06'),
(70, 7, 15, 1, 0, '2019-05-13 14:50:06'),
(71, 8, 15, 1, 0, '2019-05-13 14:50:06'),
(72, 9, 15, 1, 0, '2019-05-13 14:50:06'),
(73, 10, 15, 1, 0, '2019-05-13 14:50:06'),
(74, 11, 15, 1, 0, '2019-05-13 14:50:06'),
(79, 1, 16, 1, 0, '2019-05-13 14:50:40'),
(80, 2, 16, 1, 0, '2019-05-13 14:50:40'),
(81, 3, 16, 1, 0, '2019-05-13 14:50:40'),
(82, 4, 16, 1, 0, '2019-05-13 14:50:40'),
(83, 5, 16, 1, 0, '2019-05-13 14:50:40'),
(84, 6, 16, 1, 0, '2019-05-13 14:50:40'),
(85, 7, 16, 1, 0, '2019-05-13 14:50:40'),
(86, 8, 16, 1, 0, '2019-05-13 14:50:40'),
(87, 9, 16, 1, 0, '2019-05-13 14:50:40'),
(88, 10, 16, 1, 0, '2019-05-13 14:50:40'),
(89, 11, 16, 1, 0, '2019-05-13 14:50:40'),
(94, 1, 17, 1, 0, '2019-05-13 14:50:48'),
(95, 2, 17, 1, 0, '2019-05-13 14:50:48'),
(96, 3, 17, 1, 0, '2019-05-13 14:50:48'),
(97, 4, 17, 1, 0, '2019-05-13 14:50:48'),
(98, 5, 17, 1, 0, '2019-05-13 14:50:48'),
(99, 6, 17, 1, 0, '2019-05-13 14:50:48'),
(100, 7, 17, 1, 0, '2019-05-13 14:50:48'),
(101, 8, 17, 1, 0, '2019-05-13 14:50:48'),
(102, 9, 17, 1, 0, '2019-05-13 14:50:48'),
(103, 10, 17, 1, 0, '2019-05-13 14:50:48'),
(104, 11, 17, 1, 0, '2019-05-13 14:50:48'),
(109, 1, 18, 1, 0, '2019-05-13 14:51:02'),
(110, 2, 18, 1, 0, '2019-05-13 14:51:02'),
(111, 3, 18, 1, 0, '2019-05-13 14:51:02'),
(112, 4, 18, 1, 0, '2019-05-13 14:51:02'),
(113, 5, 18, 1, 0, '2019-05-13 14:51:02'),
(114, 6, 18, 1, 0, '2019-05-13 14:51:02'),
(115, 7, 18, 1, 0, '2019-05-13 14:51:02'),
(116, 8, 18, 1, 0, '2019-05-13 14:51:02'),
(117, 9, 18, 1, 0, '2019-05-13 14:51:02'),
(118, 10, 18, 1, 0, '2019-05-13 14:51:02'),
(119, 11, 18, 1, 0, '2019-05-13 14:51:02'),
(124, 1, 19, 1, 0, '2019-05-13 14:51:22'),
(125, 2, 19, 1, 0, '2019-05-13 14:51:22'),
(126, 3, 19, 1, 0, '2019-05-13 14:51:22'),
(127, 4, 19, 1, 0, '2019-05-13 14:51:22'),
(128, 5, 19, 1, 0, '2019-05-13 14:51:22'),
(129, 6, 19, 1, 0, '2019-05-13 14:51:22'),
(130, 7, 19, 1, 0, '2019-05-13 14:51:22'),
(131, 8, 19, 1, 0, '2019-05-13 14:51:22'),
(132, 9, 19, 1, 0, '2019-05-13 14:51:22'),
(133, 10, 19, 1, 0, '2019-05-13 14:51:22'),
(134, 11, 19, 1, 0, '2019-05-13 14:51:22'),
(139, 1, 20, 1, 0, '2019-05-13 14:51:48'),
(140, 2, 20, 1, 0, '2019-05-13 14:51:48'),
(141, 3, 20, 1, 0, '2019-05-13 14:51:48'),
(142, 4, 20, 1, 0, '2019-05-13 14:51:48'),
(143, 5, 20, 1, 0, '2019-05-13 14:51:48'),
(144, 6, 20, 1, 0, '2019-05-13 14:51:48'),
(145, 7, 20, 1, 0, '2019-05-13 14:51:48'),
(146, 8, 20, 1, 0, '2019-05-13 14:51:48'),
(147, 9, 20, 1, 0, '2019-05-13 14:51:48'),
(148, 10, 20, 1, 0, '2019-05-13 14:51:48'),
(149, 11, 20, 1, 0, '2019-05-13 14:51:48'),
(154, 1, 21, 0, 11, '0000-00-00 00:00:00'),
(155, 2, 21, 0, 11, '0000-00-00 00:00:00'),
(156, 3, 21, 1, 0, '2019-05-13 14:53:16'),
(157, 4, 21, 1, 0, '2019-05-13 14:53:16'),
(158, 5, 21, 1, 0, '2019-05-13 14:53:16'),
(159, 6, 21, 0, 11, '0000-00-00 00:00:00'),
(160, 7, 21, 0, 11, '0000-00-00 00:00:00'),
(161, 8, 21, 0, 11, '0000-00-00 00:00:00'),
(162, 9, 21, 0, 11, '0000-00-00 00:00:00'),
(163, 10, 21, 1, 0, '2019-05-13 14:53:16'),
(164, 11, 21, 1, 0, '2019-05-13 14:53:16'),
(169, 1, 22, 0, 11, '0000-00-00 00:00:00'),
(170, 2, 22, 0, 11, '0000-00-00 00:00:00'),
(171, 3, 22, 1, 0, '2019-05-13 14:54:20'),
(172, 4, 22, 1, 0, '2019-05-13 14:54:20'),
(173, 5, 22, 1, 0, '2019-05-13 14:54:20'),
(174, 6, 22, 0, 11, '0000-00-00 00:00:00'),
(175, 7, 22, 1, 0, '2019-05-13 14:54:20'),
(176, 8, 22, 0, 11, '0000-00-00 00:00:00'),
(177, 9, 22, 1, 0, '2019-05-13 14:54:20'),
(178, 10, 22, 0, 11, '0000-00-00 00:00:00'),
(179, 11, 22, 1, 0, '2019-05-13 14:54:20'),
(184, 1, 23, 0, 11, '2019-05-23 04:48:10'),
(185, 2, 23, 0, 11, '2019-05-23 04:48:10'),
(186, 3, 23, 0, 11, '2019-05-23 04:48:10'),
(187, 4, 23, 0, 11, '2019-05-23 04:48:09'),
(188, 5, 23, 0, 11, '2019-05-23 04:48:10'),
(189, 6, 23, 1, 11, '2019-05-23 04:48:09'),
(190, 7, 23, 1, 11, '2019-05-23 04:48:09'),
(191, 8, 23, 1, 11, '2019-05-23 04:48:09'),
(192, 9, 23, 1, 11, '2019-05-23 04:48:09'),
(193, 10, 23, 1, 11, '2019-05-23 04:48:09'),
(194, 11, 23, 1, 11, '2019-05-23 04:48:09'),
(195, 1, 24, 0, 11, '2019-05-23 03:32:35'),
(196, 2, 24, 0, 11, '2019-05-23 03:32:35'),
(197, 3, 24, 1, 0, '2019-05-23 08:32:34'),
(198, 4, 24, 1, 0, '2019-05-23 08:32:34'),
(199, 5, 24, 1, 0, '2019-05-23 08:32:34'),
(200, 6, 24, 0, 11, '2019-05-23 03:32:34'),
(201, 7, 24, 1, 0, '2019-05-23 08:32:34'),
(202, 8, 24, 1, 0, '2019-05-23 08:32:34'),
(203, 9, 24, 0, 11, '2019-05-23 03:32:34'),
(204, 10, 24, 0, 11, '2019-05-23 03:32:34'),
(205, 11, 24, 0, 11, '2019-05-23 03:32:35'),
(210, 1, 25, 0, 11, '2019-05-23 04:48:21'),
(211, 2, 25, 0, 11, '2019-05-23 04:48:21'),
(212, 3, 25, 0, 11, '2019-05-23 04:48:21'),
(213, 4, 25, 0, 11, '2019-05-23 04:48:20'),
(214, 5, 25, 0, 11, '2019-05-23 04:48:20'),
(215, 6, 25, 0, 11, '2019-05-23 04:48:20'),
(216, 7, 25, 0, 11, '2019-05-23 04:48:20'),
(217, 8, 25, 0, 11, '2019-05-23 04:48:20'),
(218, 9, 25, 0, 11, '2019-05-23 04:48:20'),
(219, 10, 25, 0, 11, '2019-05-23 04:48:20'),
(220, 11, 25, 0, 11, '2019-05-23 04:48:21'),
(221, 1, 26, 0, 11, '2019-06-02 15:16:54'),
(222, 2, 26, 1, 11, '2019-06-02 15:16:53'),
(223, 3, 26, 0, 11, '2019-06-02 15:16:54'),
(224, 4, 26, 1, 11, '2019-06-02 15:16:53'),
(225, 5, 26, 0, 11, '2019-06-02 15:16:54'),
(226, 6, 26, 1, 11, '2019-06-02 15:16:53'),
(227, 7, 26, 0, 11, '2019-06-02 15:16:54'),
(228, 8, 26, 1, 11, '2019-06-02 15:16:53'),
(229, 9, 26, 0, 11, '2019-06-02 15:16:54'),
(230, 10, 26, 1, 11, '2019-06-02 15:16:53'),
(231, 11, 26, 0, 11, '2019-06-02 15:16:54'),
(232, 1, 11, 1, 0, '2019-06-12 14:25:08'),
(233, 2, 11, 1, 0, '2019-06-12 14:25:08'),
(234, 3, 11, 1, 0, '2019-06-12 14:25:08'),
(235, 4, 11, 1, 0, '2019-06-12 14:25:08'),
(236, 5, 11, 1, 0, '2019-06-12 14:25:08'),
(237, 6, 11, 1, 0, '2019-06-12 14:25:08'),
(238, 7, 11, 1, 0, '2019-06-12 14:25:08'),
(239, 8, 11, 1, 0, '2019-06-12 14:25:08'),
(240, 9, 11, 1, 0, '2019-06-12 14:25:08'),
(241, 10, 11, 1, 0, '2019-06-12 14:25:08'),
(242, 11, 11, 1, 0, '2019-06-12 14:25:08'),
(247, 1, 27, 0, 11, '2019-06-12 09:41:20'),
(248, 2, 27, 0, 11, '2019-06-12 09:41:20'),
(249, 3, 27, 0, 11, '2019-06-12 09:41:20'),
(250, 4, 27, 1, 11, '2019-06-12 09:41:19'),
(251, 5, 27, 0, 11, '2019-06-12 09:41:20'),
(252, 6, 27, 0, 11, '2019-06-12 09:41:20'),
(253, 7, 27, 0, 11, '2019-06-12 09:41:20'),
(254, 8, 27, 0, 11, '2019-06-12 09:41:20'),
(255, 9, 27, 0, 11, '2019-06-12 09:41:20'),
(256, 10, 27, 0, 11, '2019-06-12 09:41:20'),
(257, 11, 27, 1, 11, '2019-06-12 09:41:19'),
(262, 1, 28, 1, 0, '2019-06-12 15:02:25'),
(263, 2, 28, 0, 11, '2019-06-12 10:02:25'),
(264, 3, 28, 1, 0, '2019-06-12 15:02:25'),
(265, 4, 28, 0, 11, '2019-06-12 10:02:25'),
(266, 5, 28, 1, 0, '2019-06-12 15:02:25'),
(267, 6, 28, 0, 11, '2019-06-12 10:02:25'),
(268, 7, 28, 1, 0, '2019-06-12 15:02:25'),
(269, 8, 28, 0, 11, '2019-06-12 10:02:25'),
(270, 9, 28, 1, 0, '2019-06-12 15:02:25'),
(271, 10, 28, 0, 11, '2019-06-12 10:02:25'),
(272, 11, 28, 1, 0, '2019-06-12 15:02:25');

--
-- Triggers `privilage`
--
DELIMITER $$
CREATE TRIGGER `Insert privilage Log` AFTER INSERT ON `privilage` FOR EACH ROW BEGIN
	insert into log_privilage(id_user,id_menu,status_privilage,id_user_edit, date_user_edit) values (NEW.id_user, NEW.id_menu, NEW.status_privilage, NEW.id_user_edit, now());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Update privilage Log` AFTER UPDATE ON `privilage` FOR EACH ROW BEGIN
	insert into log_privilage(id_user,id_menu,status_privilage,id_user_edit, date_user_edit) values (NEW.id_user, NEW.id_menu, NEW.status_privilage, NEW.id_user_edit, now());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `bn_produk` varchar(200) NOT NULL DEFAULT '-',
  `nama_produk` varchar(400) NOT NULL DEFAULT '-',
  `satuan_produk` varchar(200) NOT NULL DEFAULT '-',
  `deskripsi_produk` text,
  `gambar_produk` varchar(500) NOT NULL DEFAULT 'default.jpg',
  `status_produk` int(11) NOT NULL DEFAULT '0',
  `id_user_add` int(11) NOT NULL DEFAULT '0',
  `date_produk_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_produk_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_produk_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `bn_produk`, `nama_produk`, `satuan_produk`, `deskripsi_produk`, `gambar_produk`, `status_produk`, `id_user_add`, `date_produk_add`, `id_user_edit`, `date_produk_edit`, `id_user_delete`, `date_produk_delete`) VALUES
(9, '3F03-0600-075-00', 'Sefar Accuflow 03-600-20 ADBLUE 75cm', 'M', 'Color: ADBLUE\r\nLength: 75 CM', 'images1.png', 0, 11, '2019-06-11 22:04:09', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, '3F06-0150-075-00', 'Sefar Accuflow 06-150-30 75cm', 'M', '-', 'default.jpg', 1, 11, '2019-06-11 22:08:10', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, '3F07-0230-075-00', 'Sefar Accuflow 07-230-60 75cm', 'M', 'Length: 75 Cm', 'jute-fabric-roll1.png', 0, 11, '2019-06-11 22:39:50', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, '3F03-0600-075-000', 'Sefar Accuflow 03-600-20 ADBLUE 75cm0', 'M0', 'Sefar Accuflow 03-600-20 ADBLUE 75cm0', 'images.png', 1, 11, '2019-06-11 23:08:29', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, '3F03-0600-075-00', 'Sefar Accuflow 03-600-20 ADBLUE 75cm', 'M', 'Color: ADBLUE\r\nLength: 75 CM', 'default.jpg', 1, 11, '2019-06-11 23:09:12', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, '3F03-0600-075-00', 'Sefar Accuflow 03-600-20 ADBLUE 75cm', 'M', 'Color: ADBLUE\r\nLength: 75 CM', 'default.jpg', 1, 11, '2019-06-11 23:09:35', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, '3100-2026-005-00', '', 'M', 'Filter Bag for Dust Filters made of 07-351-600NFI, Size: 120mm (Dia) x 3035mm (L) , Top Open , Bottom Round', 'beats1.png', 0, 11, '2019-06-15 19:12:41', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `produk_vendor`
--

CREATE TABLE `produk_vendor` (
  `id_produk_vendor` int(11) NOT NULL,
  `bn_produk_vendor` varchar(200) NOT NULL,
  `nama_produk_vendor` text NOT NULL,
  `satuan_produk_vendor` varchar(200) NOT NULL,
  `deskripsi_produk_vendor` text NOT NULL,
  `status_produk_vendor` int(11) NOT NULL DEFAULT '0',
  `id_perusahaan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user_add` int(11) NOT NULL,
  `date_produk_vendor_add` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_produk_vendor_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_produk_vendor_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_vendor`
--

INSERT INTO `produk_vendor` (`id_produk_vendor`, `bn_produk_vendor`, `nama_produk_vendor`, `satuan_produk_vendor`, `deskripsi_produk_vendor`, `status_produk_vendor`, `id_perusahaan`, `id_produk`, `id_user_add`, `date_produk_vendor_add`, `id_user_edit`, `date_produk_vendor_edit`, `id_user_delete`, `date_produk_vendor_delete`) VALUES
(14, '3F03-0600-055-11', 'Sefar Accuflow 03-600-20 ADBLUE 50 items/package', 'PACKAGE', 'Color: ADBLUE\r\nAmount: 50 items/package', 0, 20, 9, 11, '2019-06-12 13:38:39', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, '3F07-0230-075-00', 'Sefar Accuflow 07-230-60 80cm', 'M', 'Length: 80Cm', 0, 20, 11, 11, '2019-06-13 19:14:31', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, '0834-32432-444', 'Tepung beras', 'PACKAGE', 'packages', 0, 23, 0, 11, '2019-06-14 15:24:35', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `id_quo` int(11) NOT NULL,
  `versi_quo` int(11) NOT NULL,
  `id_request` int(11) NOT NULL DEFAULT '0',
  `no_quo` varchar(200) NOT NULL DEFAULT '-',
  `hal_quo` text,
  `id_perusahaan` int(11) NOT NULL DEFAULT '0',
  `id_cp` int(11) NOT NULL DEFAULT '0' COMMENT 'nanti ini ambil data perusahaanya',
  `up_cp` varchar(200) NOT NULL DEFAULT '-',
  `durasi_pengiriman` int(11) NOT NULL DEFAULT '8',
  `franco` varchar(200) NOT NULL DEFAULT '-',
  `durasi_pembayaran` int(11) NOT NULL DEFAULT '8',
  `mata_uang_pembayaran` varchar(100) NOT NULL DEFAULT 'IDR',
  `alamat_perusahaan` text,
  `dateline_quo` date NOT NULL DEFAULT '0000-00-00',
  `status_quo` int(11) NOT NULL DEFAULT '0' COMMENT 'status quo 1: loss, 2: win, 3 uda oc',
  `id_user_add` int(11) NOT NULL DEFAULT '0',
  `date_quo_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_quo_edit` datetime DEFAULT NULL,
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_quo_delete` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`id_quo`, `versi_quo`, `id_request`, `no_quo`, `hal_quo`, `id_perusahaan`, `id_cp`, `up_cp`, `durasi_pengiriman`, `franco`, `durasi_pembayaran`, `mata_uang_pembayaran`, `alamat_perusahaan`, `dateline_quo`, `status_quo`, `id_user_add`, `date_quo_add`, `id_user_edit`, `date_quo_edit`, `id_user_delete`, `date_quo_delete`) VALUES
(1, 8, 1, 'LI-001/QUO/VI/2019 ver. 8', 'Penawaran Barang 1', 18, 30, 'Bapak Jhony Kurniawan', 12, 'Medan', 12, 'IDR', 'Jl. Industri Raya No. 1 Km. 21, \r\nDesa Budimulya, Kec. Cikupa, \r\nTangerang 15710', '2019-07-05', 3, 11, '2019-06-13 17:07:28', 0, NULL, 0, NULL),
(2, 3, 2, 'LI-002/QUO/VI/2019 ver. 3', 'Penawaran 1', 19, 31, 'Bapak Jhony', 12, 'Medan', 12, 'IDR', 'Jelambar Selatan II No. 4, \r\nGedung Agar-agar', '2019-06-21', 3, 11, '2019-06-13 19:29:24', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_item`
--

CREATE TABLE `quotation_item` (
  `id_quotation_item` int(11) NOT NULL,
  `id_quotation` int(11) NOT NULL,
  `quo_version` int(11) NOT NULL,
  `id_request_item` int(11) NOT NULL,
  `id_shipper` int(11) NOT NULL,
  `metode_shipping` varchar(200) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_courier` int(11) NOT NULL,
  `metode_courier` varchar(200) NOT NULL,
  `item_amount` int(11) NOT NULL,
  `selling_price` bigint(20) NOT NULL,
  `final_amount` int(11) NOT NULL DEFAULT '0',
  `final_selling_price` bigint(20) NOT NULL DEFAULT '0',
  `margin_price` decimal(10,3) NOT NULL,
  `id_oc` int(11) NOT NULL DEFAULT '0' COMMENT 'awalnyakan bleom ke oc mana2, setelah oc terbuat dan item di centang, ini ke update dia ada di oc mana ',
  `status_oc_item` int(11) NOT NULL DEFAULT '1' COMMENT '1 : ga di accept di OC; 0 yang fixed dipesen',
  `sudah_po` int(11) NOT NULL DEFAULT '1' COMMENT '1: belum po, 0: sudah po'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_item`
--

INSERT INTO `quotation_item` (`id_quotation_item`, `id_quotation`, `quo_version`, `id_request_item`, `id_shipper`, `metode_shipping`, `id_supplier`, `id_courier`, `metode_courier`, `item_amount`, `selling_price`, `final_amount`, `final_selling_price`, `margin_price`, `id_oc`, `status_oc_item`, `sudah_po`) VALUES
(7, 1, 8, 36, 21, 'AIR', 20, 21, 'AIR', 30, 3500000000, 30, 340000, '32.220', 3, 0, 1),
(12, 2, 3, 39, 21, 'AIR', 20, 21, 'AIR', 10, 7850000000, 10, 200000, '13.378', 4, 0, 1);

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
  `id_user_add` int(11) NOT NULL,
  `tgl_reimburse_add` datetime DEFAULT NULL,
  `expanses_type` int(11) NOT NULL,
  `status_paid` int(11) NOT NULL DEFAULT '1',
  `status_aktif_reimburse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reimburse`
--

INSERT INTO `reimburse` (`id_reimburse`, `subject_reimburse`, `nominal_reimburse`, `attachment`, `notes`, `id_user_add`, `tgl_reimburse_add`, `expanses_type`, `status_paid`, `status_aktif_reimburse`) VALUES
(4, 'Bayar uang tol', 350000, '-', '25 hari bolak balik', 11, '2019-06-26 00:00:00', 4, 1, 1),
(5, 'Bayar tol 1 bulan 1', 400000, '593213.jpg', 'bolak balik 28hari ', 11, '2019-06-26 00:00:00', 4, 0, 0),
(6, 'Pembelian ATK dan buku tulis', 230000, '38181.jpg', 'beli atk buat kantor request by abc', 11, '2019-06-26 00:00:00', 4, 0, 0),
(7, 'uang makan', 34000, '381811.jpg', 'makan sama client', 11, '2019-06-26 00:00:00', 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id_report` int(11) NOT NULL,
  `tipe_report` varchar(200) NOT NULL,
  `pic_target` varchar(200) NOT NULL COMMENT 'lawan bicara',
  `location` text NOT NULL COMMENT 'dari mana melakukan hal guna memenuhi KPI ini dan waktunya juga',
  `progress_percentage` int(11) NOT NULL,
  `report` text NOT NULL COMMENT 'menjelaskan progress percentage',
  `tgl_report` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_aktif_report` int(11) NOT NULL,
  `id_user_add` int(11) NOT NULL,
  `judul_report` varchar(200) NOT NULL,
  `attachment` text NOT NULL,
  `support_need` text NOT NULL,
  `next_plan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id_report`, `tipe_report`, `pic_target`, `location`, `progress_percentage`, `report`, `tgl_report`, `status_aktif_report`, `id_user_add`, `judul_report`, `attachment`, `support_need`, `next_plan`) VALUES
(1, 'kpi 1', 'waefawefea', 'efweafew', 221, 'awefawefa', '2019-06-28 20:39:16', 0, 11, 'weafawefawef', 'jute-fabric-roll1.png', 'awefawefawef', 'waefawef'),
(2, 'kpi 2', 'target pic 1', 'location 1', 21, 'report 1', '2019-06-27 20:40:32', 0, 11, 'report title 1', 'images.png', 'support\r\nneed\r\n1', 'next\r\nplan\r\n1'),
(3, 'kpi 1', 'joshua natan - isupport indonesia', 'resto dekat sini ', 90, 'hampir sekaliii tinggal kasih apanya', '2019-07-09 14:33:53', 0, 11, 'Cek week 2', '593213.jpg', 'butuh quotation aja', 'tinggal tanda tangan kontrak');

-- --------------------------------------------------------

--
-- Table structure for table `report_weeks`
--

CREATE TABLE `report_weeks` (
  `id_weeks` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report_weeks`
--

INSERT INTO `report_weeks` (`id_weeks`, `tahun`, `tgl_mulai`, `tgl_selesai`) VALUES
(1, 2019, '2019-06-26', '2019-07-03'),
(2, 2019, '2019-07-04', '2019-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(200) NOT NULL DEFAULT '-',
  `status_satuan` int(11) NOT NULL DEFAULT '0',
  `id_user_add` int(11) NOT NULL DEFAULT '0',
  `date_satuan_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_satuan_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date-satuan_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `status_satuan`, `id_user_add`, `date_satuan_add`, `id_user_edit`, `date_satuan_edit`, `id_user_delete`, `date-satuan_delete`) VALUES
(9, 'M', 0, 11, '2019-06-11 22:04:09', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 'M0', 1, 11, '2019-06-11 23:08:29', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 'KM', 1, 0, '2019-06-12 00:47:45', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 'ASDF', 1, 0, '2019-06-12 00:47:57', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 'PCS', 0, 11, '2019-06-12 10:31:44', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 'ROLL', 0, 11, '2019-06-12 13:31:59', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 'PACKAGE', 0, 11, '2019-06-12 13:35:25', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 'Package', 0, 11, '2019-06-14 15:24:35', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(17, 'PACKAGE', 0, 11, '2019-06-14 15:24:35', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `success_project`
--

CREATE TABLE `success_project` (
  `id_success_project` int(11) NOT NULL,
  `id_quo` int(11) NOT NULL,
  `status_po` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `no_invoice` varchar(100) DEFAULT NULL COMMENT 'nomor invoice dair yang ngeluarin',
  `no_refrence` varchar(100) DEFAULT NULL COMMENT 'no refrence ke sistem kita entah od atau po',
  `peruntukan_tagihan` varchar(200) DEFAULT NULL COMMENT 'kalau supplier/shipper, rujuk ke PO leiter vendor, untuk courier, merujuk ke surat jalan',
  `rekening_pembayaran` varchar(200) DEFAULT NULL COMMENT 'karena semua pembayaran invoice pake bank, jadi uda paten ada rekneing pembayaran. Siapa tau mau masukin atas nama',
  `subtotal` int(11) DEFAULT NULL COMMENT 'dalam mata uang sendiri2',
  `is_ppn` int(11) DEFAULT NULL,
  `is_pph` int(11) DEFAULT NULL,
  `ppn` int(11) DEFAULT '0',
  `pph` int(11) DEFAULT '0',
  `discount` int(11) DEFAULT NULL COMMENT 'kurangin dlu ke subtotal, dalam mata uang yang sama',
  `total` int(11) DEFAULT NULL COMMENT 'dalam mata uang tersebut; hasil dari subtotal-diskon+ppn-pph',
  `mata_uang` varchar(10) DEFAULT NULL COMMENT 'mata uang untuk bayar',
  `notes_tagihan` text,
  `attachment` varchar(200) DEFAULT NULL COMMENT 'invoice dari mereka, entah pdf atau foto',
  `dateline_invoice` date DEFAULT NULL COMMENT 'batas pembayaran dair mereka sebelum kena charge',
  `status_lunas` int(11) DEFAULT '1' COMMENT '1: belum. 0 sudah lunas',
  `status_aktif_invoice` int(11) DEFAULT '0' COMMENT '0:aktif, 1: deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `no_invoice`, `no_refrence`, `peruntukan_tagihan`, `rekening_pembayaran`, `subtotal`, `is_ppn`, `is_pph`, `ppn`, `pph`, `discount`, `total`, `mata_uang`, `notes_tagihan`, `attachment`, `dateline_invoice`, `status_lunas`, `status_aktif_invoice`) VALUES
(2, 'PO-0001/sefar/2019/16', 'PO-0002', 'SUPPLIER', '2830498839 A/N Joshua Natan', 2300000, 0, 0, 230000, 46000, 0, 2484000, 'IDR', '', 'CV_-_Joshua_Natan_W.pdf', '2019-06-27', 0, 0),
(3, 'PO/tiki/20019/2018/11', 'OD-00011', 'COURIER', '23451234 A/N Jaya Tiki Nasional SEKALI', 4200000, 0, 1, 350000, 0, 700000, 3850000, 'IDR', 'Bayar setelah sampai DISINI', 'error_login.png', '2020-04-01', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id_tax` int(11) NOT NULL,
  `bulan_pajak` varchar(10) NOT NULL,
  `tahun_pajak` int(11) NOT NULL,
  `jumlah_pajak` int(11) NOT NULL,
  `tipe_pajak` varchar(200) NOT NULL COMMENT 'MASUKAN / KELUARAN / -',
  `jenis_pajak` varchar(200) NOT NULL COMMENT 'PPN,PPH23',
  `status_aktif_pajak` int(11) NOT NULL,
  `id_refrensi` varchar(200) NOT NULL COMMENT 'nomor invoice, id pib, dll',
  `is_pib` int(11) NOT NULL DEFAULT '1' COMMENT '1: non pib, 0, pib'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id_tax`, `bulan_pajak`, `tahun_pajak`, `jumlah_pajak`, `tipe_pajak`, `jenis_pajak`, `status_aktif_pajak`, `id_refrensi`, `is_pib`) VALUES
(8, '06', 2019, 230000, 'MASUKAN', 'PPN', 0, '2', 1),
(9, '06', 2019, 46000, '-', 'PPH', 0, '2', 1),
(10, '06', 2019, 350000, 'MASUKAN', 'PPN', 0, '3', 1),
(17, '06', 2019, 22702000, '-', 'PPH', 0, '00000000447120190509700469', 0),
(18, '06', 2019, 90805000, 'MASUKAN', 'PPN', 0, '00000000447120190509700469', 0),
(19, '06', 2019, 43241000, '-', 'BEA CUKAI', 0, '00000000447120190509700469', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_user`
--

CREATE TABLE `tipe_user` (
  `id_user` int(11) NOT NULL,
  `id_tipe` int(11) NOT NULL COMMENT '0 = employee, 1 = sales, 2 = labor, 3 = super'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_user`
--

INSERT INTO `tipe_user` (`id_user`, `id_tipe`) VALUES
(23, 0),
(11, 3),
(24, 0),
(25, 0),
(26, 0),
(27, 0),
(28, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL DEFAULT '-',
  `email_user` varchar(100) NOT NULL DEFAULT '-',
  `nohp_user` varchar(15) NOT NULL DEFAULT '-',
  `password` text,
  `jenis_user` varchar(100) NOT NULL DEFAULT '-',
  `status_user` int(11) NOT NULL DEFAULT '0',
  `id_user_add` int(11) NOT NULL DEFAULT '0',
  `date_user_add` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_user_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_user_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email_user`, `nohp_user`, `password`, `jenis_user`, `status_user`, `id_user_add`, `date_user_add`, `id_user_edit`, `date_user_edit`, `id_user_delete`, `date_user_delete`) VALUES
(11, 'Joshua Natan', 'joshuanatan.jn@gmail.com', '089616961915', '523c2c2940a37fb651b7a19b68149e0b', 'USER', 0, 11, '2019-06-12 14:25:08', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(27, 'Darus', 'darus@leiter.co.id', '081239438491', 'e10adc3949ba59abbe56e057f20f883e', 'USER', 0, 11, '2019-06-12 14:40:34', 11, '0000-00-00 00:00:00', 11, '0000-00-00 00:00:00'),
(28, 'Daniel Wijaya', 'daniel@leiter.co.id', '089766784456', 'e10adc3949ba59abbe56e057f20f883e', 'USER', 0, 11, '2019-06-12 15:02:25', 11, '0000-00-00 00:00:00', 11, '0000-00-00 00:00:00');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `Default Privilage and log user` AFTER INSERT ON `user` FOR EACH ROW BEGIN
	insert into privilage(privilage.id_menu, privilage.id_user, privilage.status_privilage, privilage.id_user_edit,privilage.date_user_edit) select menu.id_menu, NEW.id_user,1,'SYSTEM',now() from menu;
    
    insert into log_user(log_user.id_user, log_user.nama_user, log_user.email_user, log_user.nohp_user, log_user.status_user, log_user.id_user_author,log_user.date_edit) values(NEW.id_user, NEW.nama_user, NEW.email_user, NEW.nohp_user, NEW.status_user, NEW.id_user_add, NEW.date_user_add);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Edit Log User` AFTER UPDATE ON `user` FOR EACH ROW BEGIN
	insert into log_user(log_user.id_user, log_user.nama_user, log_user.email_user, log_user.nohp_user, log_user.status_user, log_user.id_user_author,log_user.date_edit) values(NEW.id_user, NEW.nama_user, NEW.email_user, NEW.nohp_user, NEW.status_user, NEW.id_user_add, NEW.date_user_add);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `variable_courier_price`
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
  `mata_uang` varchar(100) NOT NULL DEFAULT 'USD',
  `status_variable` int(11) NOT NULL DEFAULT '0',
  `id_request_item` int(11) NOT NULL,
  `id_user_add` int(11) NOT NULL,
  `date_variable_shipping_price_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_variable_shipping_price_edit` datetime DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_variable_shipping_price_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variable_courier_price`
--

INSERT INTO `variable_courier_price` (`id_variable_courier`, `shipping_purpose`, `metode_pengiriman`, `id_cp`, `id_perusahaan`, `nama_variable`, `biaya_variable`, `kurs_variable`, `mata_uang`, `status_variable`, `id_request_item`, `id_user_add`, `date_variable_shipping_price_add`, `id_user_edit`, `date_variable_shipping_price_edit`, `id_user_delete`, `date_variable_shipping_price_delete`) VALUES
(12, 'CUSTOMER', 'AIR', 35, 21, 'Variable 1 Courier AIR', 12000000, 1, 'IDR', 1, 1, 11, '2019-06-13 03:26:37', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 'CUSTOMER', 'AIR', 35, 21, 'Variable 2 Courier AIR', 1400, 14500, 'USD', 0, 1, 11, '2019-06-13 03:26:37', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 'CUSTOMER', 'SEA', 35, 21, 'Variable 1 Courier SEA', 19000, 10000, 'EUR', 0, 1, 11, '2019-06-13 03:32:38', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 'CUSTOMER', 'SEA', 35, 21, 'Variable 2 Courier SEA', 11000, 14500, 'USD', 0, 1, 11, '2019-06-13 03:33:28', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 'CUSTOMER', 'SEA', 35, 21, 'Variable 3 Courier SEA', 1600000, 1, 'IDR', 0, 1, 11, '2019-06-13 03:33:28', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(17, 'CUSTOMER', 'AIR', 35, 21, 'Variable Courier 1', 12000, 11000, 'USD', 0, 6, 11, '2019-06-13 19:20:41', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(18, 'CUSTOMER', 'SEA', 35, 21, 'Courier SEA', 87600, 7800, 'IDR', 0, 7, 11, '2019-06-13 19:21:09', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(19, 'CUSTOMER', 'AIR', 35, 21, '-', 0, 0, 'USD', 0, 9, 11, '2019-06-17 17:44:38', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 'CUSTOMER', 'AIR', 35, 21, '-', 0, 0, 'USD', 0, 10, 11, '2019-06-17 18:02:29', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `variable_shipping_price`
--

CREATE TABLE `variable_shipping_price` (
  `id_variable_shipping` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL DEFAULT '0',
  `shipping_purpose` varchar(50) NOT NULL DEFAULT '-',
  `metode_pengiriman` varchar(10) NOT NULL DEFAULT '-',
  `id_cp` int(11) NOT NULL DEFAULT '0',
  `id_perusahaan` int(11) NOT NULL,
  `nama_variable` varchar(300) NOT NULL DEFAULT '-',
  `biaya_variable` int(11) NOT NULL DEFAULT '0',
  `kurs_variable` int(11) NOT NULL DEFAULT '0',
  `mata_uang` varchar(100) NOT NULL DEFAULT 'USD',
  `status_variable` int(11) NOT NULL DEFAULT '0',
  `id_request_item` int(11) NOT NULL DEFAULT '0',
  `id_user_add` int(11) NOT NULL DEFAULT '0',
  `id_variable_shipping_price_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `id_variable_shipping_price_edit` datetime DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `id_variable_shipping_price_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variable_shipping_price`
--

INSERT INTO `variable_shipping_price` (`id_variable_shipping`, `id_supplier`, `shipping_purpose`, `metode_pengiriman`, `id_cp`, `id_perusahaan`, `nama_variable`, `biaya_variable`, `kurs_variable`, `mata_uang`, `status_variable`, `id_request_item`, `id_user_add`, `id_variable_shipping_price_add`, `id_user_edit`, `id_variable_shipping_price_edit`, `id_user_delete`, `id_variable_shipping_price_delete`) VALUES
(37, 20, 'SUPPLIER', 'AIR', 35, 21, 'Variable AIR 1', 10000, 12000, 'USD', 0, 1, 11, '2019-06-13 02:42:01', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(38, 20, 'SUPPLIER', 'AIR', 35, 21, 'Variable AIR 2', 12000, 11000, 'EUR', 0, 1, 11, '2019-06-13 02:42:01', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(39, 20, 'SUPPLIER', 'AIR', 35, 21, 'Variable AIR 3', 11000, 11000, 'USD', 1, 1, 11, '2019-06-13 02:53:31', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(40, 20, 'SUPPLIER', 'SEA', 35, 21, 'Variable SEA 1', 19000, 12000, 'USD', 0, 1, 11, '2019-06-13 02:56:42', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(41, 20, 'SUPPLIER', 'SEA', 35, 21, 'Variable SEA 2', 120000, 1, 'IDR', 1, 1, 11, '2019-06-13 02:56:42', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(42, 20, 'SUPPLIER', 'AIR', 35, 21, 'Variable Shipping item 2 -1', 1200000, 16000, 'USD', 0, 7, 11, '2019-06-13 19:16:46', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(43, 20, 'SUPPLIER', 'AIR', 35, 21, 'Variable Shipping item 2 -2', 13000, 13000, 'EUR', 0, 7, 11, '2019-06-13 19:16:46', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(44, 20, 'SUPPLIER', 'SEA', 35, 21, 'Variable SEA 2', 19000, 11000, 'USD', 0, 7, 11, '2019-06-13 19:17:21', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(45, 20, 'SUPPLIER', 'SEA', 35, 21, 'Variable SEA 3', 20000, 17000, 'EUR', 0, 7, 11, '2019-06-13 19:17:22', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(46, 20, 'SUPPLIER', 'AIR', 35, 21, 'Variable item 1', 123000, 3450, 'USD', 0, 6, 11, '2019-06-13 19:18:53', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(47, 20, 'SUPPLIER', 'AIR', 35, 21, 'Variable item 2', 345000, 12300, 'USD', 0, 6, 11, '2019-06-13 19:18:53', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(48, 20, 'SUPPLIER', 'SEA', 35, 21, 'Variable SEA 2', 789000, 8670, 'USD', 0, 6, 11, '2019-06-13 19:20:05', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(49, 20, 'SUPPLIER', 'SEA', 35, 21, 'Variable SEA 1 4', 99000, 88000, 'USD', 0, 6, 11, '2019-06-13 19:20:05', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(50, 20, 'SUPPLIER', 'AIR', 35, 21, 'Variable SEA 1', 1100, 5400, 'USD', 1, 8, 11, '2019-06-14 13:52:01', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(51, 20, 'SUPPLIER', 'AIR', 35, 21, 'Variable AIR 1', 1200, 1100, 'USD', 1, 8, 11, '2019-06-14 13:52:57', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(52, 20, 'SUPPLIER', 'SEA', 35, 21, 'Secara sadar SEA', 1200, 110000, 'USD', 0, 8, 11, '2019-06-14 13:53:16', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(53, 20, 'SUPPLIER', 'AIR', 35, 21, '-', 0, 0, 'USD', 0, 8, 11, '2019-06-17 17:43:43', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(54, 20, 'SUPPLIER', 'AIR', 35, 21, '-', 0, 0, 'USD', 0, 9, 11, '2019-06-17 18:01:13', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(55, 20, 'SUPPLIER', 'AIR', 35, 21, '-', 0, 0, 'USD', 0, 10, 11, '2019-06-17 18:01:40', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_person`
--
ALTER TABLE `contact_person`
  ADD PRIMARY KEY (`id_cp`);

--
-- Indexes for table `finance_usage_type`
--
ALTER TABLE `finance_usage_type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `harga_vendor`
--
ALTER TABLE `harga_vendor`
  ADD PRIMARY KEY (`id_harga_vendor`);

--
-- Indexes for table `invoice_core`
--
ALTER TABLE `invoice_core`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indexes for table `item_margin`
--
ALTER TABLE `item_margin`
  ADD PRIMARY KEY (`id_quotation_item`);

--
-- Indexes for table `kpi_user`
--
ALTER TABLE `kpi_user`
  ADD PRIMARY KEY (`id_kpi_user`);

--
-- Indexes for table `log_privilage`
--
ALTER TABLE `log_privilage`
  ADD PRIMARY KEY (`id_log_privilage`);

--
-- Indexes for table `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id_log_user`);

--
-- Indexes for table `mata_uang`
--
ALTER TABLE `mata_uang`
  ADD PRIMARY KEY (`id_mata_uang`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_metode_pembayaran`);

--
-- Indexes for table `metode_pengiriman_shipping`
--
ALTER TABLE `metode_pengiriman_shipping`
  ADD PRIMARY KEY (`id_perusahaan`,`metode_pengiriman`);

--
-- Indexes for table `od_core`
--
ALTER TABLE `od_core`
  ADD PRIMARY KEY (`id_od`);

--
-- Indexes for table `od_item`
--
ALTER TABLE `od_item`
  ADD PRIMARY KEY (`id_od_item`);

--
-- Indexes for table `order_confirmation`
--
ALTER TABLE `order_confirmation`
  ADD PRIMARY KEY (`id_oc`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `petty_cash`
--
ALTER TABLE `petty_cash`
  ADD PRIMARY KEY (`id_transaksi_petty`);

--
-- Indexes for table `pib`
--
ALTER TABLE `pib`
  ADD PRIMARY KEY (`id_pib`);

--
-- Indexes for table `po_core`
--
ALTER TABLE `po_core`
  ADD PRIMARY KEY (`id_po`);

--
-- Indexes for table `po_item`
--
ALTER TABLE `po_item`
  ADD PRIMARY KEY (`id_po_item`);

--
-- Indexes for table `po_setting`
--
ALTER TABLE `po_setting`
  ADD PRIMARY KEY (`id_po_setting`);

--
-- Indexes for table `price_request`
--
ALTER TABLE `price_request`
  ADD PRIMARY KEY (`no_request`);

--
-- Indexes for table `price_request_item`
--
ALTER TABLE `price_request_item`
  ADD PRIMARY KEY (`id_request_item`);

--
-- Indexes for table `privilage`
--
ALTER TABLE `privilage`
  ADD PRIMARY KEY (`id_privilage`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_vendor`
--
ALTER TABLE `produk_vendor`
  ADD PRIMARY KEY (`id_produk_vendor`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`id_quo`,`versi_quo`);

--
-- Indexes for table `quotation_item`
--
ALTER TABLE `quotation_item`
  ADD PRIMARY KEY (`id_quotation_item`);

--
-- Indexes for table `reimburse`
--
ALTER TABLE `reimburse`
  ADD PRIMARY KEY (`id_reimburse`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id_report`);

--
-- Indexes for table `report_weeks`
--
ALTER TABLE `report_weeks`
  ADD PRIMARY KEY (`id_weeks`,`tahun`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `success_project`
--
ALTER TABLE `success_project`
  ADD PRIMARY KEY (`id_success_project`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id_tax`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `variable_courier_price`
--
ALTER TABLE `variable_courier_price`
  ADD PRIMARY KEY (`id_variable_courier`);

--
-- Indexes for table `variable_shipping_price`
--
ALTER TABLE `variable_shipping_price`
  ADD PRIMARY KEY (`id_variable_shipping`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_person`
--
ALTER TABLE `contact_person`
  MODIFY `id_cp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `finance_usage_type`
--
ALTER TABLE `finance_usage_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `harga_vendor`
--
ALTER TABLE `harga_vendor`
  MODIFY `id_harga_vendor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `invoice_core`
--
ALTER TABLE `invoice_core`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kpi_user`
--
ALTER TABLE `kpi_user`
  MODIFY `id_kpi_user` int(11) NOT NULL AUTO_INCREMENT COMMENT 'JANGAN NGERFRENCE KESINI KARENA INI BAKAL DI DELETE INSERT TERUS', AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `log_privilage`
--
ALTER TABLE `log_privilage`
  MODIFY `id_log_privilage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- AUTO_INCREMENT for table `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_log_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `mata_uang`
--
ALTER TABLE `mata_uang`
  MODIFY `id_mata_uang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `od_item`
--
ALTER TABLE `od_item`
  MODIFY `id_od_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `petty_cash`
--
ALTER TABLE `petty_cash`
  MODIFY `id_transaksi_petty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pib`
--
ALTER TABLE `pib`
  MODIFY `id_pib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `po_item`
--
ALTER TABLE `po_item`
  MODIFY `id_po_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `price_request_item`
--
ALTER TABLE `price_request_item`
  MODIFY `id_request_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `privilage`
--
ALTER TABLE `privilage`
  MODIFY `id_privilage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `produk_vendor`
--
ALTER TABLE `produk_vendor`
  MODIFY `id_produk_vendor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `quotation_item`
--
ALTER TABLE `quotation_item`
  MODIFY `id_quotation_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reimburse`
--
ALTER TABLE `reimburse`
  MODIFY `id_reimburse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `success_project`
--
ALTER TABLE `success_project`
  MODIFY `id_success_project` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id_tax` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `variable_courier_price`
--
ALTER TABLE `variable_courier_price`
  MODIFY `id_variable_courier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `variable_shipping_price`
--
ALTER TABLE `variable_shipping_price`
  MODIFY `id_variable_shipping` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
