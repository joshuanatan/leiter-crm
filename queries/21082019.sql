use leiter_crm;
select * from pembayaran_tagihan;

select * from pembayaran;
select * from order_confirmation;

select * from pembayaran 
inner join tagihan on pembayaran.id_pembayaran= pembayaran.id_refrensi;

select * from tagihan;
select * from pembayaran_tagihan
inner join invoice_core on invoice_core.id_submit_invoice = pembayaran.id_refrensi;

select 
id_refrensi,
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
union
select 
no_invoice,
'CUSTOMER' as peruntukan_tagihan,
id_refrensi,
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
inner join invoice_core on invoice_core.id_submit_invoice = pembayaran_customer.id_refrensi;


select * from invoice_core;
select * from pembayaran_customer;



select * from po_core;
select * from od_core;

select * from tagihan;
select * from po_core;
select * from tagihan;

use leiter_crm;
select * from tambahan_transaksi;
show columns from tambahan_transaksi;

select * from transaction_oc;
use leiter_crm;
select * from pembayaran_invoice;

select * from quotation;

use leiter_crm;
show columns from order_confirmation_item;

alter table order_confirmation_item 
modify column final_selling_price double(20,2);

use leiter_crm;
SELECT `nama_oc_item`, `final_selling_price`, `final_amount`, `satuan_produk`, `id_oc_item` FROM `order_confirmation_item` WHERE `status_oc_item` = 0 AND `id_submit_oc` = '40';

select * from order_confirmation_item;
show columns from order_confirmation_item

select count(id_request_item) from order_item_detail

select count(id_request_item) from order_item_detail left join
po_item on po_item.id_oc_item = order_item_detail.id_oc_item
select * from po_item_detail
update order_confirmation_item set status_oc_item = 0;

use leiter_crm;
show columns from order_item_detail;
select 
po_item.* 
from order_item_detail 
left join po_item on
po_item.id_oc_item = order_item_detail.id_oc_item
where id_submit_oc = 40 
and (id_submit_po = 9 or id_submit_po is null)

update order_confirmation_item set id_submit_oc = 40 where id_oc_item = 44