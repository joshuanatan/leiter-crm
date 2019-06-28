-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2019 at 06:52 PM
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

DROP TABLE IF EXISTS `contact_person`;
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

-- --------------------------------------------------------

--
-- Table structure for table `finance_usage_type`
--

DROP TABLE IF EXISTS `finance_usage_type`;
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

-- --------------------------------------------------------

--
-- Table structure for table `harga_courier`
--

DROP TABLE IF EXISTS `harga_courier`;
CREATE TABLE `harga_courier` (
  `id_harga_courier` int(11) NOT NULL,
  `id_request_item` int(11) NOT NULL,
  `nama_perusahaan` varchar(200) DEFAULT NULL,
  `nama_cp` varchar(200) DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `vendor_price_rate` int(11) DEFAULT NULL,
  `mata_uang` varchar(10) DEFAULT NULL,
  `notes` text,
  `attachment` varchar(200) DEFAULT NULL,
  `metode_pengiriman` varchar(200) NOT NULL,
  `status_aktif_harga_shipping` int(11) DEFAULT NULL,
  `id_user_add` int(11) DEFAULT NULL,
  `date_harga_shipping_add` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `harga_shipping`
--

DROP TABLE IF EXISTS `harga_shipping`;
CREATE TABLE `harga_shipping` (
  `id_harga_shipping` int(11) NOT NULL,
  `id_harga_vendor` int(11) NOT NULL,
  `nama_perusahaan` varchar(200) DEFAULT NULL,
  `nama_cp` varchar(200) DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `vendor_price_rate` int(11) DEFAULT NULL,
  `mata_uang` varchar(10) DEFAULT NULL,
  `notes` text,
  `attachment` varchar(200) DEFAULT NULL,
  `metode_pengiriman` varchar(200) NOT NULL DEFAULT 'SEA',
  `status_aktif_harga_shipping` int(11) DEFAULT NULL,
  `id_user_add` int(11) DEFAULT NULL,
  `date_harga_shipping_add` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `harga_vendor`
--

DROP TABLE IF EXISTS `harga_vendor`;
CREATE TABLE `harga_vendor` (
  `id_harga_vendor` int(11) NOT NULL,
  `id_request_item` int(11) DEFAULT NULL,
  `nama_perusahaan` varchar(200) DEFAULT NULL COMMENT 'nahan value harganya pake ini aja karena 1 item 1 perusahaan sama',
  `nama_cp` varchar(200) DEFAULT NULL COMMENT 'merujuk pada vendor mana yang ditanya terkait barang tersebut',
  `harga_produk` int(11) DEFAULT NULL,
  `vendor_price_rate` int(11) DEFAULT '1',
  `mata_uang` varchar(100) DEFAULT 'USD',
  `status_harga_vendor` int(11) DEFAULT '1',
  `notes` text,
  `attachment` text,
  `id_user_add` int(11) DEFAULT NULL,
  `date_harga_vendor_add` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) DEFAULT '0',
  `date_harga_vendor_edit` datetime DEFAULT NULL,
  `id_user_delete` int(11) DEFAULT '0',
  `date_harga_vendor_delete` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_core`
--

DROP TABLE IF EXISTS `invoice_core`;
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

-- --------------------------------------------------------

--
-- Table structure for table `item_margin`
--

DROP TABLE IF EXISTS `item_margin`;
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

-- --------------------------------------------------------

--
-- Table structure for table `kpi_user`
--

DROP TABLE IF EXISTS `kpi_user`;
CREATE TABLE `kpi_user` (
  `id_kpi_user` int(11) NOT NULL COMMENT 'JANGAN NGERFRENCE KESINI KARENA INI BAKAL DI DELETE INSERT TERUS',
  `id_user` int(11) NOT NULL,
  `kpi` varchar(200) NOT NULL COMMENT 'LANGSUNG TEMBAK KESINI DAN ID USER AJA UNTUK PENCACATAN KPI',
  `target_kpi` int(11) NOT NULL,
  `status_aktif_kpi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_privilage`
--

DROP TABLE IF EXISTS `log_privilage`;
CREATE TABLE `log_privilage` (
  `id_log_privilage` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `status_privilage` int(11) NOT NULL,
  `id_user_edit` int(11) NOT NULL,
  `date_user_edit` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_user`
--

DROP TABLE IF EXISTS `log_user`;
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

-- --------------------------------------------------------

--
-- Table structure for table `mata_uang`
--

DROP TABLE IF EXISTS `mata_uang`;
CREATE TABLE `mata_uang` (
  `id_mata_uang` int(11) NOT NULL,
  `mata_uang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `link_control` varchar(100) NOT NULL,
  `type_menu` varchar(100) NOT NULL COMMENT 'MASTER, CRM',
  `head_menu` varchar(100) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `status_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `menu`
--
DROP TRIGGER IF EXISTS `add additional privilage`;
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

DROP TABLE IF EXISTS `metode_pembayaran`;
CREATE TABLE `metode_pembayaran` (
  `id_metode_pembayaran` int(11) NOT NULL,
  `persentase_pembayaran` int(11) NOT NULL,
  `nominal_pembayaran` bigint(11) NOT NULL,
  `trigger_pembayaran` int(11) NOT NULL COMMENT '1: sesudah OC; 2: setelah OD;',
  `persentase_pembayaran2` int(11) DEFAULT NULL,
  `nominal_pembayaran2` int(11) DEFAULT NULL,
  `trigger_pembayaran2` int(11) NOT NULL,
  `no_quotation` varchar(200) NOT NULL,
  `versi_quotation` int(11) NOT NULL,
  `kurs` varchar(100) NOT NULL,
  `no_oc` varchar(200) NOT NULL DEFAULT '0',
  `status_invoice` int(11) NOT NULL DEFAULT '1' COMMENT '0: sudah aktif, 1 belum',
  `id_invoice` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `metode_pengiriman_shipping`
--

DROP TABLE IF EXISTS `metode_pengiriman_shipping`;
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

-- --------------------------------------------------------

--
-- Table structure for table `od_core`
--

DROP TABLE IF EXISTS `od_core`;
CREATE TABLE `od_core` (
  `no_od` varchar(100) NOT NULL,
  `id_od` int(11) NOT NULL,
  `no_oc` varchar(200) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `od_item`
--

DROP TABLE IF EXISTS `od_item`;
CREATE TABLE `od_item` (
  `id_od_item` int(11) NOT NULL,
  `no_od` varchar(200) NOT NULL,
  `id_quotation_item` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_confirmation`
--

DROP TABLE IF EXISTS `order_confirmation`;
CREATE TABLE `order_confirmation` (
  `no_oc` varchar(100) NOT NULL,
  `id_oc` int(11) NOT NULL,
  `no_quotation` varchar(200) NOT NULL,
  `versi_quotation` int(11) NOT NULL,
  `no_po_customer` varchar(200) NOT NULL,
  `status_oc` int(11) NOT NULL DEFAULT '0' COMMENT 'kalau 0, masih oc, 1: delete, 2 sudah po, 3 udah oc',
  `bulan_oc` varchar(2) NOT NULL,
  `tahun_oc` int(11) NOT NULL,
  `status_aktif_oc` int(11) NOT NULL DEFAULT '0' COMMENT '0 aktif, 1, tidak aktof',
  `id_user_add` int(11) DEFAULT NULL,
  `date_oc_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_oc_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_oc_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
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

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

DROP TABLE IF EXISTS `perusahaan`;
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

-- --------------------------------------------------------

--
-- Table structure for table `petty_cash`
--

DROP TABLE IF EXISTS `petty_cash`;
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

-- --------------------------------------------------------

--
-- Table structure for table `pib`
--

DROP TABLE IF EXISTS `pib`;
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

-- --------------------------------------------------------

--
-- Table structure for table `po_core`
--

DROP TABLE IF EXISTS `po_core`;
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

-- --------------------------------------------------------

--
-- Table structure for table `po_item`
--

DROP TABLE IF EXISTS `po_item`;
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

-- --------------------------------------------------------

--
-- Table structure for table `po_setting`
--

DROP TABLE IF EXISTS `po_setting`;
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

-- --------------------------------------------------------

--
-- Table structure for table `price_request`
--

DROP TABLE IF EXISTS `price_request`;
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
  `status_buat_quo` int(11) NOT NULL DEFAULT '1' COMMENT 'tujuannya supaya gabisa create quo baru berkali2',
  `status_aktif_request` int(11) NOT NULL COMMENT '0 aktif, 1 tidak aktif. penolakan dari vendor price itu rubahnya kesini',
  `id_user_add` int(11) NOT NULL,
  `date_request_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_request_edit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_request_delete` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `price_request_item`
--

DROP TABLE IF EXISTS `price_request_item`;
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

-- --------------------------------------------------------

--
-- Table structure for table `privilage`
--

DROP TABLE IF EXISTS `privilage`;
CREATE TABLE `privilage` (
  `id_privilage` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_privilage` int(11) NOT NULL,
  `id_user_edit` int(11) NOT NULL,
  `date_user_edit` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `privilage`
--
DROP TRIGGER IF EXISTS `Insert privilage Log`;
DELIMITER $$
CREATE TRIGGER `Insert privilage Log` AFTER INSERT ON `privilage` FOR EACH ROW BEGIN
	insert into log_privilage(id_user,id_menu,status_privilage,id_user_edit, date_user_edit) values (NEW.id_user, NEW.id_menu, NEW.status_privilage, NEW.id_user_edit, now());
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `Update privilage Log`;
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

DROP TABLE IF EXISTS `produk`;
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

-- --------------------------------------------------------

--
-- Table structure for table `produk_vendor`
--

DROP TABLE IF EXISTS `produk_vendor`;
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

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

DROP TABLE IF EXISTS `quotation`;
CREATE TABLE `quotation` (
  `no_quo` varchar(200) NOT NULL DEFAULT '-',
  `versi_quo` int(11) NOT NULL,
  `id_quo` int(11) NOT NULL,
  `id_request` varchar(200) NOT NULL DEFAULT '0',
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
  `id_user_add` int(11) DEFAULT '0',
  `date_quo_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_quo_edit` datetime DEFAULT NULL,
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_quo_delete` datetime DEFAULT NULL,
  `bulan_quotation` varchar(11) NOT NULL,
  `tahun_quotation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_item`
--

DROP TABLE IF EXISTS `quotation_item`;
CREATE TABLE `quotation_item` (
  `id_quotation_item` int(11) NOT NULL,
  `no_quotation` varchar(200) DEFAULT NULL,
  `versi_quotation` int(11) NOT NULL,
  `id_request_item` int(11) DEFAULT NULL,
  `id_harga_shipping` int(11) DEFAULT NULL,
  `id_harga_vendor` int(11) DEFAULT NULL,
  `id_harga_courier` int(11) DEFAULT NULL,
  `item_amount` varchar(200) DEFAULT NULL,
  `selling_price` bigint(20) DEFAULT NULL,
  `margin_price` decimal(10,3) DEFAULT NULL,
  `final_amount` varchar(200) NOT NULL DEFAULT '0',
  `final_selling_price` bigint(20) NOT NULL DEFAULT '0',
  `no_oc` varchar(200) NOT NULL DEFAULT '0' COMMENT 'awalnyakan bleom ke oc mana2, setelah oc terbuat dan item di centang, ini ke update dia ada di oc mana ',
  `status_oc_item` int(11) NOT NULL DEFAULT '1' COMMENT '1 : ga di accept di OC; 0 yang fixed dipesen',
  `sudah_po` int(11) NOT NULL DEFAULT '1' COMMENT '1: belum po, 0: sudah po'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reimburse`
--

DROP TABLE IF EXISTS `reimburse`;
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

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
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

-- --------------------------------------------------------

--
-- Table structure for table `report_weeks`
--

DROP TABLE IF EXISTS `report_weeks`;
CREATE TABLE `report_weeks` (
  `id_weeks` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

DROP TABLE IF EXISTS `satuan`;
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

-- --------------------------------------------------------

--
-- Table structure for table `success_project`
--

DROP TABLE IF EXISTS `success_project`;
CREATE TABLE `success_project` (
  `id_success_project` int(11) NOT NULL,
  `id_quo` int(11) NOT NULL,
  `status_po` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

DROP TABLE IF EXISTS `tagihan`;
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

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

DROP TABLE IF EXISTS `tax`;
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

-- --------------------------------------------------------

--
-- Table structure for table `tipe_user`
--

DROP TABLE IF EXISTS `tipe_user`;
CREATE TABLE `tipe_user` (
  `id_user` int(11) NOT NULL,
  `id_tipe` int(11) NOT NULL COMMENT '0 = employee, 1 = sales, 2 = labor, 3 = super'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
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
-- Triggers `user`
--
DROP TRIGGER IF EXISTS `Default Privilage and log user`;
DELIMITER $$
CREATE TRIGGER `Default Privilage and log user` AFTER INSERT ON `user` FOR EACH ROW BEGIN
	insert into privilage(privilage.id_menu, privilage.id_user, privilage.status_privilage, privilage.id_user_edit,privilage.date_user_edit) select menu.id_menu, NEW.id_user,1,'SYSTEM',now() from menu;
    
    insert into log_user(log_user.id_user, log_user.nama_user, log_user.email_user, log_user.nohp_user, log_user.status_user, log_user.id_user_author,log_user.date_edit) values(NEW.id_user, NEW.nama_user, NEW.email_user, NEW.nohp_user, NEW.status_user, NEW.id_user_add, NEW.date_user_add);
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `Edit Log User`;
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

DROP TABLE IF EXISTS `variable_courier_price`;
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

-- --------------------------------------------------------

--
-- Table structure for table `variable_shipping_price`
--

DROP TABLE IF EXISTS `variable_shipping_price`;
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
-- Indexes for table `harga_courier`
--
ALTER TABLE `harga_courier`
  ADD PRIMARY KEY (`id_harga_courier`);

--
-- Indexes for table `harga_shipping`
--
ALTER TABLE `harga_shipping`
  ADD PRIMARY KEY (`id_harga_shipping`);

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
  ADD PRIMARY KEY (`no_od`);

--
-- Indexes for table `od_item`
--
ALTER TABLE `od_item`
  ADD PRIMARY KEY (`id_od_item`);

--
-- Indexes for table `order_confirmation`
--
ALTER TABLE `order_confirmation`
  ADD PRIMARY KEY (`no_oc`);

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
  ADD PRIMARY KEY (`no_quo`);

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
  MODIFY `id_cp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finance_usage_type`
--
ALTER TABLE `finance_usage_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `harga_courier`
--
ALTER TABLE `harga_courier`
  MODIFY `id_harga_courier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `harga_shipping`
--
ALTER TABLE `harga_shipping`
  MODIFY `id_harga_shipping` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `harga_vendor`
--
ALTER TABLE `harga_vendor`
  MODIFY `id_harga_vendor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_core`
--
ALTER TABLE `invoice_core`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kpi_user`
--
ALTER TABLE `kpi_user`
  MODIFY `id_kpi_user` int(11) NOT NULL AUTO_INCREMENT COMMENT 'JANGAN NGERFRENCE KESINI KARENA INI BAKAL DI DELETE INSERT TERUS';

--
-- AUTO_INCREMENT for table `log_privilage`
--
ALTER TABLE `log_privilage`
  MODIFY `id_log_privilage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_log_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mata_uang`
--
ALTER TABLE `mata_uang`
  MODIFY `id_mata_uang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `od_item`
--
ALTER TABLE `od_item`
  MODIFY `id_od_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petty_cash`
--
ALTER TABLE `petty_cash`
  MODIFY `id_transaksi_petty` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pib`
--
ALTER TABLE `pib`
  MODIFY `id_pib` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `po_item`
--
ALTER TABLE `po_item`
  MODIFY `id_po_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_request_item`
--
ALTER TABLE `price_request_item`
  MODIFY `id_request_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privilage`
--
ALTER TABLE `privilage`
  MODIFY `id_privilage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk_vendor`
--
ALTER TABLE `produk_vendor`
  MODIFY `id_produk_vendor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_item`
--
ALTER TABLE `quotation_item`
  MODIFY `id_quotation_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reimburse`
--
ALTER TABLE `reimburse`
  MODIFY `id_reimburse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `success_project`
--
ALTER TABLE `success_project`
  MODIFY `id_success_project` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id_tax` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variable_courier_price`
--
ALTER TABLE `variable_courier_price`
  MODIFY `id_variable_courier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variable_shipping_price`
--
ALTER TABLE `variable_shipping_price`
  MODIFY `id_variable_shipping` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
