drop view if exists list_transaksi_per_oc;
create view list_transaksi_per_oc as
select 
id_pembayaran,
pembayaran_customer.nominal_pembayaran*pembayaran_customer.kurs_pembayaran as total_pembayaran,
no_invoice,
invoice_core.id_submit_oc,
pembayaran_customer.tgl_bayar,
pembayaran_customer.subject_pembayaran,
"Pembayaran Customer" as status_transaksi,
"1" as is_lain_lain
from pembayaran_customer /*ambil id_refrensi as id-oc*/
inner join invoice_core on invoice_core.id_submit_invoice = pembayaran_customer.id_refrensi
inner join order_detail on order_detail.id_submit_oc = invoice_core.id_submit_oc
union
select 
id_pembayaran,
pembayaran.nominal_pembayaran*pembayaran.kurs_pembayaran*-1 as total_pembayaran,
no_po,
po_core.id_submit_oc,
pembayaran.tgl_bayar,
pembayaran.subject_pembayaran,
"Pembayaran Supplier dan Shipper" as status_transaksi,
"1" as is_lain_lain
from pembayaran
inner join tagihan on tagihan.id_tagihan = pembayaran.id_refrensi
inner join po_core on po_core.no_po = tagihan.no_refrence
union
select 
id_pembayaran,
pembayaran.nominal_pembayaran*pembayaran.kurs_pembayaran*-1 as total_pembayaran,
no_od,
od_core.id_submit_oc,
pembayaran.tgl_bayar,
pembayaran.subject_pembayaran,
"Pembayaran Courier" as status_transaksi,
"1" as is_lain_lain
from pembayaran
inner join tagihan on tagihan.id_tagihan = pembayaran.id_refrensi
inner join od_core on od_core.no_od = tagihan.no_refrence
union
select 
id_pembayaran,
if(status_transaksi = 0, nominal_pembayaran*kurs_pembayaran,nominal_pembayaran*kurs_pembayaran*-1) as total_pembayaran,
no_refrence,
id_submit_oc,
tambahan_transaksi.tgl_bayar,
tambahan_transaksi.subject_pembayaran,
"Lain-lain" as status_transaksi,
"0" as is_lain_lain
from tambahan_transaksi

select * from list_transaksi_per_oc
select * from tambahan_transaksi