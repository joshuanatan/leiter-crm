select * from order_detail;
select * from order_item_detail;
select * from quotation_metode_pembayaran;
select * from price_request_item;
select * from quotation_item;
select id_request_item, count(id_request_item) as jumlah from price_request_item group by id_request_item;
select id_request_item, count(id_request_item) as jumlah from quotation_item group by id_request_item;
select * from quotation_item;

select * from quotation_item;
use leiter_crm;
select * from order_item_detail
left join harga_vendor
on harga_vendor.id_request_item = order_item_detail.id_request_item
left join harga_courier
on harga_courier.id_request_item = order_item_detail.id_request_item
left join harga_shipping
on harga_shipping.id_harga_vendor = harga_vendor.id_harga_vendor;

select * from order_item_detail;

show columns from harga_vendor;

select * from price_request join quotation on price_request.id_submit_request = quotation.id_request join perusahaan on perusahaan.id_perusahaan = price_request.id_perusahaan WHERE quotation.id_submit_quotation =33;

select * from quotation_metode_pembayaran;

select id_quotation from order_detail;
select * from order_detail;

INSERT INTO `quotation` (`id_quotation`, `bulan_quotation`, `tahun_quotation`, `versi_quotation`, `no_quotation`, `id_request`, `total_quotation_price`, `hal_quotation`, `up_cp`, `durasi_pengiriman`, `franco`, `durasi_pembayaran`, `alamat_perusahaan`, `dateline_quotation`, `status_quotation`, `status_aktif_quotation`, `id_user_add`, `date_quotation_add`, `id_user_edit`, `date_quotation_edit`, `date_quotation_delete`) VALUES ('1', '08', '2019', '3', 'LI-001/QUO/VIII/2019/RV2', '1', '715.00', 'hal', 'Bapak Joko', '5', 'medan', '3', 'asdf', '2019-08-21', '0', '0', '11', '2019-08-15 19:51:35', '0', '2019-08-15 19:51:35', '2019-08-15 19:51:35');

show columns from quotation;

select * from quotation;
use leiter_crm;
select * from order_detail;


select * from order_item_detail;
select * from order_confirmation_metode_pembayaran;

select * from order_item_detail where id_submit_oc = 38;
select * from order_detail where no_oc = 'LI20190005';

use leiter_crm;
select * from po_item;
show columns from po_item;