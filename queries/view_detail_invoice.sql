drop view if exists detail_invoice;
create view detail_invoice as 
select 
invoice_core.id_submit_od as id_od_invoice,
invoice_core.id_submit_invoice,
invoice_core.no_invoice,
invoice_core.id_invoice,
invoice_core.bulan_invoice,
invoice_core.tahun_invoice,
invoice_core.nominal_pembayaran as nominal_invoice,
invoice_core.tipe_invoice,
invoice_core.jatuh_tempo,
invoice_core.durasi_pembayaran,
invoice_core.att,
invoice_core.franco as franco_invoice,
invoice_core.jatuh_tempo as jatuh_tempo_invoice,
invoice_core.alamat_penagihan,
invoice_core.is_ppn,
invoice_core.no_rekening,
metode_pembayaran.is_ada_transaksi,
metode_pembayaran.is_ada_transaksi2,
metode_pembayaran.nominal_pembayaran,
metode_pembayaran.nominal_pembayaran2,
metode_pembayaran.persentase_pembayaran,
metode_pembayaran.persentase_pembayaran2,
metode_pembayaran.status_bayar,
metode_pembayaran.status_bayar2,
metode_pembayaran.trigger_pembayaran,
metode_pembayaran.trigger_pembayaran2,
order_detail.*
from invoice_core
inner join order_detail on order_detail.id_submit_oc = invoice_core.id_submit_oc
inner join order_confirmation_metode_pembayaran as metode_pembayaran on metode_pembayaran.id_submit_oc = order_detail.id_submit_oc
where status_aktif_invoice = 0
