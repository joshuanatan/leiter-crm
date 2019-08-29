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
where status_paid = 0 and status_aktif_reimburse = 0;

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

drop view if exists tagihan_customer;
create view tagihan_customer as 
select *, DATEDIFF(jatuh_tempo,curdate()) AS sisa_waktu from invoice_core
where status_lunas = 1 
and status_aktif_invoice = 0
order by jatuh_tempo ASC;

drop view if exists detail_finished_order_item;
CREATE VIEW `detail_finished_order_item` AS 
select `order_confirmation_item`.`id_oc_item` AS `id_oc_item`,
`order_confirmation_item`.`id_submit_oc` AS `id_submit_oc`,
`order_confirmation_item`.`nama_oc_item` AS `nama_oc_item`,
`order_confirmation_item`.`final_amount` AS `final_amount`,
`order_confirmation_item`.`satuan_produk` AS `satuan_oc_item`,
`order_confirmation_item`.`final_selling_price` AS `final_selling_price`,
`order_confirmation_item`.`status_oc_item` AS `status_oc_item`,
`order_confirmation_item`.`id_produk` AS `id_produk_oc`,
`quotation_item`.`id_quotation_item` AS `id_quotation_item`,
`quotation_item`.`id_submit_quotation` AS `id_submit_quotation`,
`quotation_item`.`nama_produk_leiter` AS `nama_quotation_item`,
`quotation_item`.`id_harga_vendor` AS `id_harga_vendor`,
`quotation_item`.`id_harga_shipping` AS `id_harga_shipping`,
`quotation_item`.`id_harga_courier` AS `id_harga_courier`,
`quotation_item`.`item_amount` AS `item_amount`,
`quotation_item`.`satuan_produk` AS `satuan_quotation_item`,
`quotation_item`.`selling_price` AS `selling_price`,
`price_request_item`.`id_request_item` AS `id_request_item`,
`price_request_item`.`id_submit_request` AS `id_submit_request`,
`price_request_item`.`nama_produk` AS `nama_request_item`,
`price_request_item`.`jumlah_produk` AS `jumlah_produk`,
`price_request_item`.`satuan_produk` AS `satuan_request_item`,
`produk`.`id_produk` AS `id_produk`,
`produk`.`bn_produk` AS `bn_produk`,
`produk`.`nama_produk` AS `nama_produk`,
`produk`.`satuan_produk` AS `satuan_produk`,
`produk`.`deskripsi_produk` AS `deskripsi_produk`,
`produk`.`gambar_produk` AS `gambar_produk`,
`produk`.`status_produk` AS `status_produk` 
from `order_confirmation_item` 
join `quotation_item` 
on `quotation_item`.`id_quotation_item` = `order_confirmation_item`.`id_quotation_item`
join `price_request_item` 
on `price_request_item`.`id_request_item` = `quotation_item`.`id_request_item`
join `produk` 
on `produk`.`id_produk` = `order_confirmation_item`.`id_produk`;

drop view if exists jumlah_produk_terjual;
create view jumlah_produk_terjual as
select detail_finished_order_item.*,count(id_produk), oc.bulan_oc, oc.tahun_oc jumlah_perproduk from detail_finished_order_item 
inner join order_confirmation as oc on
oc.id_submit_oc = detail_finished_order_item.id_submit_oc
group by id_produk
order by jumlah_perproduk desc;

drop view if exists quotation_jatuh_tempo;
create view quotation_jatuh_tempo as
select *, datediff(dateline_quotation,curdate()) as waktu_jatuh_tempo from quotation
where status_aktif_quotation = 0 and status_quotation = 0
order by waktu_jatuh_tempo ASC;

alter table po_core
add status_selesai_po int default 1 comment '1 kaalu belom kelar ponya, 0 kalau sudah';

drop view if exists po_jatuh_tempo;
create view po_jatuh_tempo as 
select *, datediff(requirement_date,curdate()) as waktu_jatuh_tempo from po_core
where status_aktif_po = 0 and status_selesai_po = 1
order by waktu_jatuh_tempo ASC