create view transaction_oc as 
select 
no_invoice as no_refrence,
'CUSTOMER' as peruntukan_tagihan,
id_refrensi as id_submit_invoice, /*id submit invoice*/
id_pembayaran,
subject_pembayaran,
tgl_bayar,
pembayaran_customer.attachment as attachment,
notes_pembayaran,
pembayaran_customer.nominal_pembayaran as nominal_pembayaran,
pembayaran_customer.kurs_pembayaran,
pembayaran_customer.mata_uang_pembayaran,
pembayaran_customer.total_pembayaran,
pembayaran_customer.metode_pembayaran,
'MASUK' as status_transaksi 
from pembayaran_customer 
inner join invoice_core on invoice_core.id_submit_invoice = pembayaran_customer.id_refrensi
union
select 
no_refrence,
peruntukan_tagihan,
id_submit_oc,
id_pembayaran,
subject_pembayaran,
tgl_bayar,
pembayaran.attachment as attachment,
notes_pembayaran,
pembayaran.nominal_pembayaran as nominal_pembayaran,
pembayaran.kurs_pembayaran,
pembayaran.mata_uang_pembayaran,
pembayaran.total_pembayaran,
pembayaran.metode_pembayaran,
'KELUAR' as status_transaksi
from pembayaran
inner join tagihan on pembayaran.id_refrensi = tagihan.id_tagihan
inner join po_core on po_core.no_po = tagihan.no_refrence
union
select 
no_refrence,
peruntukan_tagihan,
id_submit_oc,
id_pembayaran,
subject_pembayaran,
tgl_bayar,
pembayaran.attachment as attachment,
notes_pembayaran,
pembayaran.nominal_pembayaran as nominal_pembayaran,
pembayaran.kurs_pembayaran,
pembayaran.mata_uang_pembayaran,
pembayaran.total_pembayaran,
pembayaran.metode_pembayaran,
'KELUAR' as status_transaksi
from pembayaran
inner join tagihan on pembayaran.id_refrensi = tagihan.id_tagihan
inner join od_core on od_core.no_od = tagihan.no_refrence
union
select 
no_refrence,
peruntukan_tagihan,
id_submit_oc,
id_pembayaran,
subject_pembayaran,
tgl_bayar,
attachment,
notes_pembayaran,
nominal_pembayaran,
kurs_pembayaran,
mata_uang_pembayaran,
total_pembayaran,
metode_pembayaran,
status_transaksi
from 
tambahan_transaksi;