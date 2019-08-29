create view margin_overview as 
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
if(status_transaksi = 1, total_pembayaran, total_pembayaran*-1),
"Tambahan transaksi" as subject_transaksi
from tambahan_transaksi;



