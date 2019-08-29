create view cashflow_overview as 
select 
date(tgl_bayar) as tanggal_transaksi,
month(tgl_bayar) as bulan_transaksi,
year(tgl_bayar) as tahun_transaksi,
pembayaran.total_pembayaran*-1 as total_pembayaran,
"Pembayaran vendor" as subject_transaksi
from pembayaran
inner join tagihan on tagihan.id_tagihan = pembayaran.id_refrensi
where status_lunas = 0 and status_aktif_invoice = 0
union
select 
date(tgl_bayar) as tanggal_transaksi,
month(tgl_bayar) as bulan_transaksi,
year(tgl_bayar) as tahun_transaksi,
total_pembayaran,
"Pelunasan Customer" as subject_transaksi
from pembayaran_customer
inner join invoice_core
on invoice_core.id_submit_invoice = pembayaran_customer.id_refrensi
where status_lunas = 0 and status_aktif_invoice = 0
union
select 
date(tgl_bayar) as tanggal_transaksi,
month(tgl_bayar) as bulan_transaksi,
year(tgl_bayar) as tahun_transaksi,
bea_cukai*-1 as total_pembayaran,
"Pembayaran Bea Cukai" as subject_transaksi
from pembayaran_pib
inner join pib on pib.id_pib = pembayaran_pib.id_refrensi
where status_aktif_pib = 0 and status_bayar_pib = 0
union
select
date(tanggal_pembayaran) as tanggal_transaksi,
month(tanggal_pembayaran) as bulan_transaksi,
year(tanggal_pembayaran) as tahun_transaksi,
if(jenis_pembayaran = 1, nominal_tagihan, nominal_tagihan*-1),
"Other Cashflow" as subject_transaksi
from other_cashflow
where status_aktif_cashflow = 0
union
select 
date(tgl_transaksi_petty) as tanggal_transaksi,
month(tgl_transaksi_petty) as bulan_transaksi,
year(tgl_transaksi_petty) as tahun_transaksi,
amount*-1 as nominal_tagihan,
"Petty Cash" as subject_transaksi
from petty_cash
where status_aktif_petty = 0
union
select 
date(tgl_reimburse_add) as tanggal_transaksi,
month(tgl_reimburse_add) as bulan_transaksi,
year(tgl_reimburse_add) as tahun_transaksi,
nominal_reimburse*-1 as nominal_pembayaran,
"Reimburse" as subject_transaksi
from reimburse
where status_paid = 0 and status_aktif_reimburse = 0
