-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2019 at 06:16 PM
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
-- Table structure for table `invoice_core`
--

CREATE TABLE `invoice_core` (
  `id_submit_invoice` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `bulan_invoice` varchar(10) NOT NULL,
  `tahun_invoice` int(11) NOT NULL,
  `no_invoice` varchar(100) NOT NULL,
  `id_submit_oc` int(11) NOT NULL,
  `id_submit_od` int(11) DEFAULT '0' COMMENT '0 kalau ga pake od',
  `nominal_pembayaran` bigint(20) NOT NULL,
  `kurs_pembayaran` int(11) NOT NULL DEFAULT '1',
  `mata_uang` varchar(10) NOT NULL DEFAULT 'IDR',
  `is_ppn` int(11) NOT NULL,
  `ppn` bigint(20) NOT NULL,
  `franco` varchar(200) NOT NULL,
  `att` varchar(200) NOT NULL,
  `alamat_penagihan` text NOT NULL,
  `tipe_invoice` int(11) NOT NULL COMMENT '1 = pelunasan total tanpa dp. 2:invoice dp, 3 transaksi pelunasan yang sudah dp',
  `status_lunas` int(11) NOT NULL DEFAULT '1' COMMENT '1: blum lunas, 0 lunas',
  `status_aktif_invoice` int(11) NOT NULL DEFAULT '0' COMMENT '1: blum aktif, 0 aktif',
  `jatuh_tempo` date NOT NULL,
  `durasi_pembayaran` varchar(200) NOT NULL COMMENT 'xx minggu',
  `no_rekening` int(11) NOT NULL COMMENT 'langsung keisi didepan',
  `jumlah_box` int(11) NOT NULL,
  `berat_bersih` decimal(10,5) NOT NULL,
  `berat_kotor` decimal(10,5) NOT NULL,
  `dimensi` varchar(200) NOT NULL,
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

INSERT INTO `invoice_core` (`id_submit_invoice`, `id_invoice`, `bulan_invoice`, `tahun_invoice`, `no_invoice`, `id_submit_oc`, `id_submit_od`, `nominal_pembayaran`, `kurs_pembayaran`, `mata_uang`, `is_ppn`, `ppn`, `franco`, `att`, `alamat_penagihan`, `tipe_invoice`, `status_lunas`, `status_aktif_invoice`, `jatuh_tempo`, `durasi_pembayaran`, `no_rekening`, `jumlah_box`, `berat_bersih`, `berat_kotor`, `dimensi`, `id_user_add`, `tgl_invoice_add`, `id_user_edit`, `tgl_invoice_edit`, `id_user_delete`, `tgl_user_delete`) VALUES
(4, 1, '07', 2019, '190701/LI/07/19', 5, 0, 18, 1, 'IDR', 0, 1818000000, 'Surabaya', 'Bapak Johny', 'Kembang Molek IX\r\nKembangan Puri Indah', 2, 1, 1, '2019-07-29', '8 Minggu', 489, 0, '0.00000', '0.00000', '-', 11, '2019-07-08 14:50:08', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 1, '07', 2019, '190701/LI/07/19', 8, 3, 9165000000, 1, 'IDR', 1, 0, 'Medan', 'Bapak Johny', 'Kembang Molek IX', 1, 1, 1, '2019-07-26', '9-12 ', 489, 2, '35.60000', '37.35000', '8*10*65 m', NULL, '2019-07-09 09:58:56', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 2, '07', 2019, '190702/LI/07/19', 5, 0, 2430000, 1, 'IDR', 1, 0, 'Medan', 'Bapak Johny', 'Kembangan', 2, 1, 1, '2019-07-31', '9-12', 489, 0, '0.00000', '0.00000', '-', NULL, '2019-07-09 10:03:38', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 3, '07', 2019, '190703/LI/07/19', 7, 0, 60000000000, 1, 'IDR', 0, 6000000000, 'Surabaya', 'Bapak Johny', 'Jl. Industri Raya No. 1 Km. 21, \r\nDesa Budimulya, Kec. Cikupa, \r\nTangerang 15710', 2, 1, 1, '2019-07-31', '8-12 ', 489, 0, '0.00000', '0.00000', '-', NULL, '2019-07-09 10:49:02', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 3, '07', 2019, '190703/LI/07/19', 7, 0, 66000000000, 1, 'IDR', 0, 6000000000, 'Surabaya', 'Bapak Johny', 'Jl. Industri Raya No. 1 Km. 21, \r\nDesa Budimulya, Kec. Cikupa, \r\nTangerang 15710', 2, 0, 0, '2019-07-09', '8-12 ', 489, 0, '0.00000', '0.00000', '-', NULL, '2019-07-09 10:58:58', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 4, '07', 2019, '190704/LI/07/19', 8, 0, 14025000000, 1, 'IDR', 0, 1275000000, 'Surabaya', 'Bapak Johny', 'Kembang Molek IX\r\nKembangan Selatan\r\n11610', 1, 1, 0, '2019-07-24', '9-12', 489, 0, '0.00000', '0.00000', '-', NULL, '2019-07-09 10:59:28', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 5, '07', 2019, '190705/LI/07/19', 5, 0, 2673000, 1, 'IDR', 0, 243000, 'Medan', 'Bapak Johny Gunawan', 'Jl. Industri Raya No. 1 Km. 21, \r\nDesa Budimulya, Kec. Cikupa, \r\nTangerang 15710', 2, 0, 0, '2019-07-31', '8', 489, 0, '0.00000', '0.00000', '-', NULL, '2019-07-09 12:21:57', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice_core`
--
ALTER TABLE `invoice_core`
  ADD PRIMARY KEY (`id_submit_invoice`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice_core`
--
ALTER TABLE `invoice_core`
  MODIFY `id_submit_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
