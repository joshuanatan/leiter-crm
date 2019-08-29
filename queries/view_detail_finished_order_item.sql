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
