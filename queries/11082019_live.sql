/*done 14/08/2019*/
drop view if exists order_detail;
create view order_detail as 
select 
price_request.id_submit_request,
price_request.id_request,
price_request.bulan_request,
price_request.tahun_request,
price_request.no_request,
price_request.id_perusahaan,
price_request.id_cp,
price_request.franco,
price_request.untuk_stock,
price_request.tgl_dateline_request,
price_request.status_buat_quo,
price_request.status_aktif_request,
price_request.status_request,
price_request.id_user_add as id_user_add_request,
price_request.date_request_add,
price_request.id_user_edit as id_user_edit_request,
price_request.date_request_edit,
price_request.id_user_delete as id_user_delete_request,
price_request.date_request_delete,
quotation.id_submit_quotation,
quotation.id_quotation,
quotation.bulan_quotation,
quotation.tahun_quotation,
quotation.versi_quotation,
quotation.no_quotation,
quotation.total_quotation_price,
quotation.hal_quotation,
quotation.up_cp as up_cp_quotation,
quotation.durasi_pengiriman as durasi_pengiriman_quotation,
quotation.franco as franco_quotation,
quotation.durasi_pembayaran as durasi_pembayaran_quotation,
quotation.alamat_perusahaan,
quotation.dateline_quotation,
quotation.status_quotation,
quotation.status_aktif_quotation,
quotation.id_user_add as id_user_add_quotation,
quotation.date_quotation_add,
quotation.id_user_edit as id_user_edit_quotation,
quotation.date_quotation_edit,
quotation.id_user_delete as id_user_delete_quotation,
quotation.date_quotation_delete,
order_confirmation.id_submit_oc,
order_confirmation.id_oc,
order_confirmation.bulan_oc,
order_confirmation.tahun_oc,
order_confirmation.no_oc,
order_confirmation.no_po_customer,
order_confirmation.tgl_po_customer,
order_confirmation.total_oc_price,
order_confirmation.up_cp as up_cp_oc,
order_confirmation.durasi_pengiriman as durasi_pengiriman_oc,
order_confirmation.durasi_pembayaran as durasi_pembayaran_oc,
order_confirmation.metode_pengiriman,
order_confirmation.franco as franco_oc,
order_confirmation.status_oc,
order_confirmation.status_aktif_oc,
order_confirmation.id_user_add as id_user_add_oc,
order_confirmation.date_oc_add,
order_confirmation.id_user_edit,
order_confirmation.date_oc_edit as id_user_edit_oc,
order_confirmation.id_user_delete,
order_confirmation.date_oc_delete as id_user_delete_oc,
nama_perusahaan,
nama_cp,
price_request_user.nama_user as nama_user_add_request,
quotation_user.nama_user as nama_user_add_quotation,
oc_user.nama_user as nama_user_add_oc,

price_request_user_edit.nama_user as nama_user_edit_request,
quotation_user_edit.nama_user as nama_user_edit_quotation,
oc_user_edit.nama_user as nama_user_edit_oc,

price_request_user_delete.nama_user as nama_user_delete_request,
quotation_user_delete.nama_user as nama_user_delete_quotation,
oc_user_delete.nama_user as nama_user_delete_oc

from price_request
inner join perusahaan 
on perusahaan.id_perusahaan = price_request.id_perusahaan
inner join contact_person
on contact_person.id_cp = price_request.id_cp

left outer join user as price_request_user
on price_request_user.id_user = price_request.id_user_add
left outer join user as price_request_user_edit
on price_request_user_edit.id_user = price_request.id_user_edit
left outer join user as price_request_user_delete
on price_request_user_delete.id_user = price_request.id_user_delete

left outer join quotation
on quotation.id_request = price_request.id_submit_request

left outer join user as quotation_user
on quotation_user.id_user = quotation.id_user_add
left outer join user as quotation_user_edit
on quotation_user_edit.id_user = quotation.id_user_edit
left outer join user as quotation_user_delete
on quotation_user_delete.id_user = quotation.id_user_delete

left outer join order_confirmation
on order_confirmation.id_submit_quotation = quotation.id_submit_quotation

left outer join user as oc_user
on oc_user.id_user = order_confirmation.id_user_add
left outer join user as oc_user_edit
on oc_user_edit.id_user = order_confirmation.id_user_edit
left outer join user as oc_user_delete
on oc_user_delete.id_user = order_confirmation.id_user_delete;

rename table detail_order_item to detail_finished_order_item;

drop view if exists order_item_detail;
create view order_item_detail as 
select
price_request_item.id_request_item,
price_request_item.id_submit_request,
price_request_item.nama_produk as nama_produk_request,
price_request_item.jumlah_produk as jumlah_produk_request,
price_request_item.satuan_produk as satuan_produk_request,
price_request_item.notes_produk as notes_produk_request,
price_request_item.file,
price_request_item.status_request_item,
price_request_item.sudah_po,
quotation_item.id_quotation_item,
quotation_item.id_submit_quotation,
quotation_item.nama_produk_leiter,
quotation_item.id_harga_vendor,
quotation_item.id_harga_shipping,
quotation_item.id_harga_courier,
quotation_item.attachment as attachment_quotation,
quotation_item.item_amount as item_amount_quotation,
quotation_item.satuan_produk as satuan_produk_quotation,
quotation_item.selling_price as selling_price_quotation,
quotation_item.margin_price as margin_price_quotation,
order_confirmation_item.id_oc_item,
order_confirmation_item.id_submit_oc,
order_confirmation_item.nama_oc_item,
order_confirmation_item.final_amount as final_amount_oc,
order_confirmation_item.satuan_produk as satuan_produk_oc,
order_confirmation_item.final_selling_price as final_selling_price_oc,
order_confirmation_item.status_oc_item,
order_confirmation_item.id_produk,
produk.bn_produk,
produk.nama_produk,
produk.satuan_produk,
produk.deskripsi_produk,
produk.gambar_produk,
produk.status_produk,
harga_courier.harga_produk as harga_produk_courier,
harga_courier.vendor_price_rate as vendor_price_rate_courier,
harga_courier.mata_uang as mata_uang_courier,
harga_courier.notes as notes_courier,
harga_courier.attachment as attachment_courier,
harga_courier.metode_pengiriman as metode_pengiriman_courier,
harga_courier.status_aktif_harga_shipping as status_aktif_harga_shipping_courier,

harga_vendor.harga_produk as harga_produk_vendor,
harga_vendor.vendor_price_rate as vendor_price_rate_vendor,
harga_vendor.mata_uang as mata_uang_vendor,
harga_vendor.notes as notes_vendor,
harga_vendor.attachment as attachment_vendor,
harga_vendor.status_harga_vendor as status_harga_vendor_vendor,

harga_shipping.harga_produk as harga_produk_shipping,
harga_shipping.vendor_price_rate as vendor_price_rate_shipping,
harga_shipping.mata_uang as mata_uang_shipping,
harga_shipping.notes as notes_shipping,
harga_shipping.attachment as attachment_shipping,
harga_shipping.metode_pengiriman as metode_pengiriman_shipping,
harga_shipping.status_aktif_harga_shipping as status_aktif_harga_shipping_shipping,

vendor.nama_perusahaan as nama_vendor,
courier.nama_perusahaan as nama_courier,
shipping.nama_perusahaan as nama_shipper

from price_request_item
left outer join quotation_item
on quotation_item.id_request_item = price_request_item.id_request_item
left outer join order_confirmation_item
on order_confirmation_item.id_quotation_item = quotation_item.id_quotation_item
left outer join produk
on produk.id_produk = order_confirmation_item.id_produk
left outer join harga_courier
on harga_courier.id_harga_courier = quotation_item.id_harga_courier
left outer join harga_vendor
on harga_vendor.id_harga_vendor = quotation_item.id_harga_vendor
left outer join harga_shipping
on harga_shipping.id_harga_vendor = harga_vendor.id_harga_vendor
left outer join perusahaan as vendor
on vendor.id_perusahaan = harga_vendor.id_perusahaan
left outer join perusahaan as courier
on courier.id_perusahaan = harga_courier.id_perusahaan
left outer join perusahaan as shipping
on shipping.id_perusahaan = harga_shipping.id_perusahaan;

alter table quotation
modify column total_quotation_price decimal(20,2);
alter table quotation_item
modify column item_amount decimal(10,2);
alter table order_confirmation_item
modify column final_amount decimal(10,2);
alter table price_request_item
modify column jumlah_produk decimal(10,2);

drop view if exists price_request_before_quotation;
create view price_request_before_quotation as 
select * from price_request
where price_request.id_submit_request not in 
(select quotation.id_request from quotation where quotation.status_aktif_quotation = 0);

alter table harga_vendor
drop column id_user_edit,
drop column date_harga_vendor_edit,
drop column id_user_delete,
drop column date_harga_vendor_delete;

show columns from harga_vendor;
show columns from harga_shipping;
show columns from harga_courier;
show columns from quotation_item;

