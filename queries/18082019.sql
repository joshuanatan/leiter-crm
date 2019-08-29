use leiter_crm;
select * from order_detail;

select * from order_confirmation;
select * from order_item_detail;
 
SELECT * FROM QUOTATION_ITEM;
select * from price_request_item;

delete from quotation_item where id_quotation_item between 36 and 51;
delete from quotation_item where id_quotation_item between 53 and 55; /*53nya juga ikut*/

select * from order_item_detail where id_submit_quotation is null;

SELECT `id_submit_quotation`,`nama_produk_leiter`, `attachment_quotation`, `id_quotation_item`, `id_harga_vendor`, `id_harga_courier`, `id_harga_shipping`, `item_amount_quotation`, `satuan_produk_quotation`, `selling_price_quotation`, `margin_price_quotation`, `id_request_item`, `jumlah_produk_request`, `satuan_produk_request`, `nama_produk_request`, `harga_produk_vendor`, `nama_produk_vendor`, `vendor_price_rate_vendor`, `mata_uang_vendor`, `notes_vendor`, `harga_produk_shipping`, `vendor_price_rate_shipping`, `mata_uang_shipping`, `notes_shipping`, `harga_produk_courier`, `vendor_price_rate_courier`, `mata_uang_courier`, `notes_courier`, `id_harga_shipping`, `id_harga_vendor`, `id_harga_courier`, `id_vendor`, `id_courier`, `id_shipping` FROM `order_item_detail` WHERE ( `id_submit_request` = '40' AND id_submit_quotation is null ) OR ( `id_submit_request` = '40' AND `id_submit_quotation` = '74' );

select * from order_item_detail where id_submit_request = 45 

SELECT `nama_produk_leiter`, `attachment_quotation`, `id_quotation_item`, `id_harga_vendor`, `id_harga_courier`, `id_harga_shipping`, `item_amount_quotation`, `satuan_produk_quotation`, `selling_price_quotation`, `margin_price_quotation`, `id_request_item`, `jumlah_produk_request`, `satuan_produk_request`, `nama_produk_request`, `harga_produk_vendor`, `nama_produk_vendor`, `vendor_price_rate_vendor`, `mata_uang_vendor`, `notes_vendor`, `harga_produk_shipping`, `vendor_price_rate_shipping`, `mata_uang_shipping`, `notes_shipping`, `harga_produk_courier`, `vendor_price_rate_courier`, `mata_uang_courier`, `notes_courier`, `id_harga_shipping`, `id_harga_vendor`, `id_harga_courier`, `id_vendor`, `id_courier`, `id_shipping` FROM `order_item_detail` WHERE ( `id_submit_request` = '46' AND `id_submit_quotation` = '' ) OR ( `id_submit_request` = '46' AND `id_submit_quotation` = '89' )

select * from price_request_item left join 

SELECT `nama_produk_leiter`, `attachment_quotation`, `id_quotation_item`, `id_harga_vendor`, `id_harga_courier`, `id_harga_shipping`, `item_amount_quotation`, `satuan_produk_quotation`, `selling_price_quotation`, `margin_price_quotation`, `id_request_item`, `jumlah_produk_request`, `satuan_produk_request`, `nama_produk_request`, `harga_produk_vendor`, `nama_produk_vendor`, `vendor_price_rate_vendor`, `mata_uang_vendor`, `notes_vendor`, `harga_produk_shipping`, `vendor_price_rate_shipping`, `mata_uang_shipping`, `notes_shipping`, `harga_produk_courier`, `vendor_price_rate_courier`, `mata_uang_courier`, `notes_courier`, `id_harga_shipping`, `id_harga_vendor`, `id_harga_courier`, `id_vendor`, `id_courier`, `id_shipping` FROM `order_item_detail` WHERE `id_submit_request` = '45' GROUP BY `id_request_item`;

select * from order_confirmation_item