/*sudah live*/
alter table tax
add id_submit_oc int;

alter table other_cashflow
add jenis_pembayaran int comment 'untuk tau apakah dia flow masuk atau keluar';

alter table other_cashflow 
modify column nominal_tagihan double(20,3);

alter table petty_cash
modify column status_transaksi_petty int comment 'jenis pembayaran, 0 uang keluar, 1 uang masuk';

alter table other_cashflow
modify column id_user_add int null;

alter table other_cashflow
change tgl_transaksi_cashflow tgl_input_transaksi date;

create view other_cashflow_detail as 
select 
other_cashflow.*,
tipe.name_type,
tipe.kode_type,
user.nama_user
from other_cashflow
inner join finance_usage_type as tipe
on other_cashflow.id_type = tipe.id_type
inner join user
on user.id_user = other_cashflow.id_user_add;

alter table tax
add attachment varchar(200);

create view final_tax as
select * from tax where no_faktur_pajak is not null and tgl_input_faktur is not null;

create table pembayaran_pib like pembayaran;
select * from pembayaran;
alter table pembayaran_pib
modify column id_refrensi int;

/*ternyata di live ga ada other cashflow*/
CREATE TABLE `other_cashflow` (
  `id_submit_tagihan_other` int(11) NOT NULL AUTO_INCREMENT,
  `subject_tagihan` varchar(100) NOT NULL,
  `id_type` varchar(100) NOT NULL,
  `nominal_tagihan` double(20,3) DEFAULT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `id_user_add` int(11) DEFAULT NULL,
  `attachment` varchar(200) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `status_aktif_cashflow` varchar(1) NOT NULL,
  `tgl_input_transaksi` date DEFAULT NULL,
  `jenis_pembayaran` int(11) DEFAULT NULL COMMENT 'untuk tau apakah dia flow masuk atau keluar',
  PRIMARY KEY (`id_submit_tagihan_other`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;