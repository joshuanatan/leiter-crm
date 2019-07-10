-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2019 at 10:08 AM
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
  `nohp_cp` varchar(20) NOT NULL DEFAULT '-',
  `jabatan_cp` varchar(100) NOT NULL DEFAULT '-',
  `status_cp` int(11) NOT NULL DEFAULT '0',
  `id_perusahaan` int(11) DEFAULT NULL,
  `id_user_add` int(11) DEFAULT '0',
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
  `id_request_item` int(11) NOT NULL COMMENT 'butuh tau barangnya apa trus anter ke customer',
  `id_perusahaan` varchar(200) DEFAULT NULL,
  `id_cp` varchar(200) DEFAULT NULL,
  `harga_produk` decimal(10,2) DEFAULT NULL COMMENT 'harga courier',
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
  `id_harga_vendor` int(11) NOT NULL COMMENT 'butuh tau dari vendor apa ',
  `id_perusahaan` varchar(200) DEFAULT NULL,
  `id_cp` varchar(200) DEFAULT NULL,
  `harga_produk` decimal(10,2) DEFAULT NULL COMMENT 'harga shipping per satuan',
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
  `id_perusahaan` varchar(200) DEFAULT NULL COMMENT 'nahan value harganya pake ini aja karena 1 item 1 perusahaan sama',
  `id_cp` varchar(200) DEFAULT NULL COMMENT 'merujuk pada vendor mana yang ditanya terkait barang tersebut',
  `harga_produk` decimal(10,2) DEFAULT NULL,
  `vendor_price_rate` int(11) DEFAULT '1',
  `mata_uang` varchar(100) DEFAULT 'USD',
  `nama_produk_vendor` text,
  `notes` text,
  `attachment` text,
  `status_harga_vendor` int(11) DEFAULT '1',
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

-- --------------------------------------------------------

--
-- Table structure for table `invoice_packaging_box`
--

DROP TABLE IF EXISTS `invoice_packaging_box`;
CREATE TABLE `invoice_packaging_box` (
  `id_packaging` int(11) NOT NULL,
  `id_submit_invoice` int(11) NOT NULL,
  `berat_bersih` int(11) NOT NULL,
  `berat_kotor` int(11) NOT NULL,
  `dimensi_box` varchar(200) NOT NULL
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
-- Table structure for table `od_core`
--

DROP TABLE IF EXISTS `od_core`;
CREATE TABLE `od_core` (
  `id_submit_od` int(11) NOT NULL,
  `id_submit_oc` varchar(200) NOT NULL,
  `id_od` int(11) NOT NULL,
  `bulan_od` varchar(10) NOT NULL,
  `tahun_od` int(11) NOT NULL,
  `no_od` varchar(100) NOT NULL,
  `id_courier` int(11) NOT NULL,
  `delivery_method` varchar(100) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `up_cp` varchar(200) NOT NULL,
  `status_od` int(11) NOT NULL DEFAULT '0',
  `status_aktif_od` int(11) NOT NULL DEFAULT '0',
  `id_user_add` int(11) DEFAULT NULL,
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
  `id_submit_od` varchar(200) NOT NULL,
  `id_oc_item` int(11) NOT NULL COMMENT 'butuh ambil nama barang leiter',
  `item_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_confirmation`
--

DROP TABLE IF EXISTS `order_confirmation`;
CREATE TABLE `order_confirmation` (
  `id_submit_oc` int(11) NOT NULL,
  `id_submit_quotation` varchar(200) NOT NULL,
  `id_oc` int(11) NOT NULL,
  `bulan_oc` varchar(2) NOT NULL,
  `tahun_oc` int(11) NOT NULL,
  `no_oc` varchar(100) NOT NULL,
  `no_po_customer` varchar(200) NOT NULL,
  `tgl_po_customer` date NOT NULL,
  `total_oc_price` bigint(20) NOT NULL,
  `up_cp` varchar(200) NOT NULL,
  `durasi_pengiriman` varchar(200) NOT NULL,
  `durasi_pembayaran` varchar(200) NOT NULL,
  `metode_pengiriman` varchar(200) NOT NULL,
  `franco` varchar(200) NOT NULL,
  `status_oc` int(11) NOT NULL DEFAULT '0' COMMENT '0 setelah submit',
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
-- Table structure for table `order_confirmation_item`
--

DROP TABLE IF EXISTS `order_confirmation_item`;
CREATE TABLE `order_confirmation_item` (
  `id_oc_item` int(11) NOT NULL,
  `id_submit_oc` int(11) NOT NULL,
  `id_quotation_item` int(11) NOT NULL COMMENT 'butuh data nama barang leiter',
  `nama_oc_item` text NOT NULL,
  `final_amount` bigint(20) NOT NULL COMMENT 'pake split untuk dapetin jumlah item',
  `satuan_produk` varchar(200) NOT NULL COMMENT 'pake split untuk dapetin satuan item',
  `final_selling_price` int(11) NOT NULL COMMENT 'harga peritem',
  `status_oc_item` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_confirmation_metode_pembayaran`
--

DROP TABLE IF EXISTS `order_confirmation_metode_pembayaran`;
CREATE TABLE `order_confirmation_metode_pembayaran` (
  `id_metode_pembayaran` int(11) NOT NULL,
  `id_submit_oc` varchar(200) NOT NULL,
  `persentase_pembayaran` int(11) NOT NULL,
  `nominal_pembayaran` bigint(20) NOT NULL COMMENT 'udah total semua tagihan',
  `trigger_pembayaran` int(11) NOT NULL COMMENT '0: gakpake, kalau persennya 0;1: sesudah OC; 2: setelah OD;',
  `status_bayar` int(11) NOT NULL DEFAULT '1' COMMENT '0: sudah dibayar, 1 belum dibayar,',
  `is_ada_transaksi` int(11) NOT NULL COMMENT '0, ada transaksi; 1 tidak ada transaksi',
  `persentase_pembayaran2` int(11) DEFAULT NULL,
  `nominal_pembayaran2` bigint(20) DEFAULT NULL COMMENT 'udah total semua tagihan',
  `trigger_pembayaran2` int(11) NOT NULL COMMENT '0: gakpake, kalau persennya 0;1: sesudah OC; 2: setelah OD;',
  `status_bayar2` int(11) NOT NULL DEFAULT '1' COMMENT '0: sudah dibayar, 1 belum dibayar',
  `is_ada_transaksi2` int(11) NOT NULL COMMENT '0, ada transaksi; 1 tidak ada transaksi',
  `kurs` varchar(100) NOT NULL
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
  `kategori_pembayaran` varchar(200) NOT NULL COMMENT 'ngerefrence ke finance_usage_type'
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
  `alamat_pengiriman` text COMMENT 'gaperlu diisii buat yang courier dan shipper',
  `notelp_perusahaan` varchar(20) NOT NULL DEFAULT '-',
  `peran_perusahaan` varchar(100) NOT NULL DEFAULT '-',
  `jenis_perusahaan` varchar(200) DEFAULT '-',
  `status_perusahaan` int(11) NOT NULL DEFAULT '0',
  `permanent` int(11) NOT NULL DEFAULT '0' COMMENT '0: permanen, 1: Tidak permanen',
  `id_user_add` int(11) DEFAULT '0',
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
  `status_aktif_po` int(11) NOT NULL DEFAULT '0',
  `id_user_add` int(11) DEFAULT NULL,
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
  `id_submit_po` int(11) NOT NULL,
  `id_oc_item` int(11) NOT NULL,
  `nama_produk_vendor` text NOT NULL COMMENT 'dijoin ke harga_vendor untuk dapet namanya',
  `harga_item` int(11) NOT NULL,
  `jumlah_item` int(11) NOT NULL COMMENT 'pake split untuk dapetin jumlah item',
  `satuan_item` varchar(200) NOT NULL COMMENT 'pake split untuk dapetin satuan item'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `price_request`
--

DROP TABLE IF EXISTS `price_request`;
CREATE TABLE `price_request` (
  `id_submit_request` int(11) NOT NULL,
  `id_request` int(11) DEFAULT NULL COMMENT 'mempermudah mendapatkan no rfq',
  `bulan_request` varchar(11) DEFAULT NULL,
  `tahun_request` varchar(11) DEFAULT NULL,
  `no_request` varchar(200) DEFAULT NULL COMMENT 'yang keluar di dokumen, yang selalu unik, kurang lebih seperti id request, tahun, bulan yang jadi composite key gitu',
  `id_perusahaan` int(11) DEFAULT NULL COMMENT 'perlu untuk menjaga kalau ada pegawai yang pindah kantor dan masih berinteraksi dengan leiter',
  `id_cp` int(11) DEFAULT NULL,
  `franco` varchar(200) DEFAULT NULL,
  `untuk_stock` int(11) DEFAULT '1' COMMENT '0: untuk stock, 1 tidak stock',
  `tgl_dateline_request` date DEFAULT NULL,
  `status_buat_quo` int(11) DEFAULT '1' COMMENT 'tujuannya supaya gabisa create quo baru berkali2',
  `status_aktif_request` int(11) DEFAULT '0' COMMENT '0 aktif, 1 tidak aktif. penolakan dari vendor price itu rubahnya kesini',
  `status_request` int(11) DEFAULT '0' COMMENT '0: rfq, 1 (setelah rfq): vendor price, 2 (setelah vendor price) quotation, 3 (setelah quotation).',
  `id_user_add` int(11) DEFAULT NULL,
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
  `id_submit_request` varchar(200) NOT NULL,
  `nama_produk` text,
  `jumlah_produk` int(11) DEFAULT NULL COMMENT 'pake split untuk dapetin jumlah item',
  `satuan_produk` varchar(200) NOT NULL COMMENT 'pake split untuk dapetin satuan item',
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
-- Table structure for table `quotation`
--

DROP TABLE IF EXISTS `quotation`;
CREATE TABLE `quotation` (
  `id_submit_quotation` int(11) NOT NULL,
  `id_quotation` int(11) NOT NULL,
  `bulan_quotation` varchar(11) NOT NULL,
  `tahun_quotation` int(11) NOT NULL,
  `versi_quotation` int(11) NOT NULL,
  `no_quotation` varchar(200) NOT NULL DEFAULT '-',
  `id_request` varchar(200) NOT NULL DEFAULT '0',
  `total_quotation_price` bigint(20) NOT NULL,
  `hal_quotation` text,
  `up_cp` varchar(200) NOT NULL DEFAULT '-',
  `durasi_pengiriman` varchar(20) NOT NULL DEFAULT '8',
  `franco` varchar(200) NOT NULL DEFAULT '-',
  `durasi_pembayaran` varchar(20) NOT NULL DEFAULT '8',
  `alamat_perusahaan` text,
  `dateline_quotation` date NOT NULL DEFAULT '0000-00-00',
  `status_quotation` int(11) NOT NULL DEFAULT '0' COMMENT 'status quo 1: loss, 2: win, 3 uda oc, 5 sudah di revisi',
  `status_aktif_quotation` int(11) NOT NULL DEFAULT '0',
  `id_user_add` int(11) DEFAULT '0',
  `date_quotation_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_edit` int(11) NOT NULL DEFAULT '0',
  `date_quotation_edit` datetime DEFAULT NULL,
  `id_user_delete` int(11) NOT NULL DEFAULT '0',
  `date_quotation_delete` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_item`
--

DROP TABLE IF EXISTS `quotation_item`;
CREATE TABLE `quotation_item` (
  `id_quotation_item` int(11) NOT NULL,
  `id_submit_quotation` varchar(200) DEFAULT NULL,
  `id_request_item` int(11) DEFAULT NULL,
  `nama_produk_leiter` text,
  `attachment` text NOT NULL,
  `id_harga_vendor` int(11) DEFAULT NULL COMMENT 'untuk tau, di quotation item ini kasih harga berdasaran harga apa',
  `id_harga_shipping` int(11) DEFAULT NULL COMMENT 'untuk tau, di quotation item ini kasih harga berdasaran harga apa',
  `id_harga_courier` int(11) DEFAULT NULL COMMENT 'untuk tau, di quotation item ini kasih harga berdasaran harga apa',
  `item_amount` int(11) DEFAULT NULL COMMENT 'pake split untuk dapetin jumlah item',
  `satuan_produk` varchar(200) NOT NULL COMMENT 'pake split untuk dapetin satuan item',
  `selling_price` bigint(20) DEFAULT NULL COMMENT 'harga per item',
  `margin_price` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_metode_pembayaran`
--

DROP TABLE IF EXISTS `quotation_metode_pembayaran`;
CREATE TABLE `quotation_metode_pembayaran` (
  `id_metode_pembayaran` int(11) NOT NULL,
  `id_submit_quotation` varchar(200) NOT NULL,
  `persentase_pembayaran` int(11) NOT NULL,
  `nominal_pembayaran` bigint(11) NOT NULL,
  `trigger_pembayaran` int(11) NOT NULL COMMENT '0: gakpake, kalau persennya 0;1: sesudah OC; 2: setelah OD;',
  `status_bayar` int(11) NOT NULL DEFAULT '1' COMMENT '0: sudah dibayar, 1 belum dibayar,',
  `is_ada_transaksi` int(11) NOT NULL COMMENT '0, ada transaksi; 1 tidak ada transaksi',
  `persentase_pembayaran2` int(11) DEFAULT NULL,
  `nominal_pembayaran2` bigint(20) DEFAULT NULL,
  `trigger_pembayaran2` int(11) NOT NULL COMMENT '0: gakpake, kalau persennya 0;1: sesudah OC; 2: setelah OD;',
  `status_bayar2` int(11) NOT NULL DEFAULT '1' COMMENT '0: sudah dibayar, 1 belum dibayar',
  `is_ada_transaksi2` int(11) NOT NULL COMMENT '0, ada transaksi; 1 tidak ada transaksi',
  `kurs` varchar(100) NOT NULL
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
  `jenis_pajak` varchar(200) NOT NULL COMMENT 'PPN,PPH23,PPH21,BEA CUKAI',
  `status_aktif_pajak` int(11) NOT NULL,
  `id_refrensi` varchar(200) NOT NULL COMMENT 'nomor invoice, id pib, dll',
  `is_pib` int(11) NOT NULL DEFAULT '1' COMMENT '1: non pib, 0, pib',
  `no_faktur_pajak` varchar(200) DEFAULT NULL,
  `tgl_input_faktur` date DEFAULT NULL
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email_user`, `nohp_user`, `password`, `jenis_user`, `status_user`, `id_user_add`, `date_user_add`, `id_user_edit`, `date_user_edit`, `id_user_delete`, `date_user_delete`) VALUES
(11, 'Joshua Natan', 'joshuanatan.jn@gmail.com', '089616961915', '523c2c2940a37fb651b7a19b68149e0b', 'USER', 0, 11, '2019-06-12 14:25:08', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(27, 'Darus', 'shinta@leiter.co.id', '081239438491', 'e10adc3949ba59abbe56e057f20f883e', 'USER', 0, 11, '2019-06-12 14:40:34', 11, '0000-00-00 00:00:00', 11, '0000-00-00 00:00:00'),
(28, 'Daniel Wijaya', 'daniel@leiter.co.id', '089766784456', 'e10adc3949ba59abbe56e057f20f883e', 'USER', 0, 11, '2019-06-12 15:02:25', 11, '0000-00-00 00:00:00', 11, '0000-00-00 00:00:00');

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
  ADD PRIMARY KEY (`id_submit_invoice`);

--
-- Indexes for table `invoice_packaging_box`
--
ALTER TABLE `invoice_packaging_box`
  ADD PRIMARY KEY (`id_packaging`);

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
-- Indexes for table `od_core`
--
ALTER TABLE `od_core`
  ADD PRIMARY KEY (`id_submit_od`);

--
-- Indexes for table `od_item`
--
ALTER TABLE `od_item`
  ADD PRIMARY KEY (`id_od_item`);

--
-- Indexes for table `order_confirmation`
--
ALTER TABLE `order_confirmation`
  ADD PRIMARY KEY (`id_submit_oc`);

--
-- Indexes for table `order_confirmation_item`
--
ALTER TABLE `order_confirmation_item`
  ADD PRIMARY KEY (`id_oc_item`);

--
-- Indexes for table `order_confirmation_metode_pembayaran`
--
ALTER TABLE `order_confirmation_metode_pembayaran`
  ADD PRIMARY KEY (`id_metode_pembayaran`);

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
  ADD PRIMARY KEY (`id_submit_po`);

--
-- Indexes for table `po_item`
--
ALTER TABLE `po_item`
  ADD PRIMARY KEY (`id_po_item`);

--
-- Indexes for table `price_request`
--
ALTER TABLE `price_request`
  ADD PRIMARY KEY (`id_submit_request`);

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
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`id_submit_quotation`);

--
-- Indexes for table `quotation_item`
--
ALTER TABLE `quotation_item`
  ADD PRIMARY KEY (`id_quotation_item`);

--
-- Indexes for table `quotation_metode_pembayaran`
--
ALTER TABLE `quotation_metode_pembayaran`
  ADD PRIMARY KEY (`id_metode_pembayaran`);

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
  MODIFY `id_submit_invoice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_packaging_box`
--
ALTER TABLE `invoice_packaging_box`
  MODIFY `id_packaging` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `od_core`
--
ALTER TABLE `od_core`
  MODIFY `id_submit_od` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `od_item`
--
ALTER TABLE `od_item`
  MODIFY `id_od_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_confirmation`
--
ALTER TABLE `order_confirmation`
  MODIFY `id_submit_oc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_confirmation_item`
--
ALTER TABLE `order_confirmation_item`
  MODIFY `id_oc_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_confirmation_metode_pembayaran`
--
ALTER TABLE `order_confirmation_metode_pembayaran`
  MODIFY `id_metode_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `po_core`
--
ALTER TABLE `po_core`
  MODIFY `id_submit_po` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `po_item`
--
ALTER TABLE `po_item`
  MODIFY `id_po_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_request`
--
ALTER TABLE `price_request`
  MODIFY `id_submit_request` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `id_submit_quotation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_item`
--
ALTER TABLE `quotation_item`
  MODIFY `id_quotation_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_metode_pembayaran`
--
ALTER TABLE `quotation_metode_pembayaran`
  MODIFY `id_metode_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
