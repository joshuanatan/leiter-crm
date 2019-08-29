CREATE ALGORITHM=UNDEFINED DEFINER=`;`@`%` SQL SECURITY DEFINER VIEW `leiter_crm`.`detail_finished_order` AS select `leiter_crm`.`order_confirmation`.`bulan_oc` AS `bulan_oc`,`leiter_crm`.`order_confirmation`.`id_submit_oc` AS `id_submit_oc`,`leiter_crm`.`order_confirmation`.`tahun_oc` AS `tahun_oc`,`leiter_crm`.`order_confirmation`.`date_oc_add` AS `date_oc_add`,`leiter_crm`.`order_confirmation`.`no_po_customer` AS `no_po_customer`,`leiter_crm`.`order_confirmation`.`tgl_po_customer` AS `tgl_po_customer`,`leiter_crm`.`order_confirmation`.`total_oc_price` AS `total_oc_price`,`leiter_crm`.`order_confirmation`.`no_oc` AS `no_oc`,`leiter_crm`.`order_confirmation`.`status_aktif_oc` AS `status_aktif_oc`,`leiter_crm`.`quotation`.`id_submit_quotation` AS `id_submit_quotation`,`leiter_crm`.`quotation`.`id_quotation` AS `id_quotation`,`leiter_crm`.`quotation`.`date_quotation_add` AS `date_quotation_add`,`leiter_crm`.`quotation`.`total_quotation_price` AS `total_quotation_price`,`leiter_crm`.`quotation`.`bulan_quotation` AS `bulan_quotation`,`leiter_crm`.`quotation`.`tahun_quotation` AS `tahun_quotation`,`leiter_crm`.`quotation`.`no_quotation` AS `no_quotation`,`leiter_crm`.`quotation`.`status_aktif_quotation` AS `status_aktif_quotation`,`leiter_crm`.`price_request`.`id_submit_request` AS `id_submit_request`,`leiter_crm`.`price_request`.`date_request_add` AS `date_request_add`,`leiter_crm`.`price_request`.`id_perusahaan` AS `id_perusahaan`,`leiter_crm`.`price_request`.`id_cp` AS `id_cp`,`leiter_crm`.`price_request`.`no_request` AS `no_request`,`leiter_crm`.`price_request`.`status_request` AS `status_request`,`leiter_crm`.`price_request`.`status_aktif_request` AS `status_aktif_request`,`leiter_crm`.`perusahaan`.`nama_perusahaan` AS `nama_perusahaan`,`leiter_crm`.`perusahaan`.`peran_perusahaan` AS `peran_perusahaan`,`leiter_crm`.`perusahaan`.`notelp_perusahaan` AS `notelp_perusahaan`,`leiter_crm`.`contact_person`.`nama_cp` AS `nama_cp` from ((((`leiter_crm`.`order_confirmation` join `leiter_crm`.`quotation` on((`leiter_crm`.`quotation`.`id_submit_quotation` = `leiter_crm`.`order_confirmation`.`id_submit_quotation`))) join `leiter_crm`.`price_request` on((`leiter_crm`.`price_request`.`id_submit_request` = `leiter_crm`.`quotation`.`id_request`))) join `leiter_crm`.`perusahaan` on((`leiter_crm`.`perusahaan`.`id_perusahaan` = `leiter_crm`.`price_request`.`id_perusahaan`))) join `leiter_crm`.`contact_person` on((`leiter_crm`.`contact_person`.`id_cp` = `leiter_crm`.`price_request`.`id_cp`)));
/*done 06082019*/    
/*dimulai dari hapus oc, ini mau hapus anak2nya semua*/

delete from order_confirmation where order_confirmation.status_aktif_oc = 1;
delete from quotation where quotation.id_submit_quotation not in 
	(select order_confirmation.id_submit_quotation from order_confirmation);
delete from price_request where price_request.id_submit_request not in
	(select quotation.id_request from quotation);
delete from invoice_core where invoice_core.id_submit_oc not in 
	(select order_confirmation.id_submit_oc from order_confirmation);
select * from pembayaran_customer WHERE	pembayaran_customer.id_refrensi not in 
	(select invoice_core.id_submit_invoice from invoice_core);

delete from price_request_item where price_request_item.id_submit_request not in
	(select price_request.id_submit_request from price_request);
    
delete from quotation_item where quotation_item.id_submit_quotation not in 
	(select quotation.id_submit_quotation from quotation);
delete from quotation_metode_pembayaran where quotation_metode_pembayaran.id_submit_quotation not in 
	(select quotation.id_submit_quotation from quotation);
    
delete from order_confirmation_item where order_confirmation_item.id_submit_oc not in 
	(select order_confirmation.id_submit_oc from order_confirmation);
delete from order_confirmation_metode_pembayaran where order_confirmation_metode_pembayaran.id_submit_oc not in 
	(select order_confirmation.id_submit_oc from order_confirmation);

select * from price_request;
select * from quotation;
select * from order_confirmation;

select * from price_request_item;
select * from quotation_item;
select * from quotation_metode_pembayaran;
select * from order_confirmation_item;
select * from order_confirmation_metode_pembayaran;

create view detail_order_item as 
select 
	order_confirmation_item.id_oc_item,
    order_confirmation_item.id_submit_oc,
	order_confirmation_item.nama_oc_item,
    order_confirmation_item.final_amount,
    order_confirmation_item.satuan_produk as satuan_oc_item,
    order_confirmation_item.final_selling_price,
    order_confirmation_item.status_oc_item,
    quotation_item.id_quotation_item,
    quotation_item.id_submit_quotation,
    quotation_item.nama_produk_leiter as nama_quotation_item,
    quotation_item.id_harga_vendor,
    quotation_item.id_harga_shipping,
    quotation_item.id_harga_courier,
    quotation_item.item_amount,
    quotation_item.satuan_produk as satuan_quotation_item,
    quotation_item.selling_price,
    price_request_item.id_request_item,
    price_request_item.id_submit_request,
    price_request_item.nama_produk as nama_request_item,
    price_request_item.jumlah_produk,
    price_request_item.satuan_produk as satuan_request_item,
    produk.id_produk,
    produk.bn_produk,
    produk.nama_produk,
    produk.satuan_produk,
    produk.deskripsi_produk,
    produk.gambar_produk,
    produk.status_produk
	from order_confirmation_item
	inner join quotation_item on 
		quotation_item.id_quotation_item = order_confirmation_item.id_quotation_item
	inner join price_request_item on 
		price_request_item.id_request_item = quotation_item.id_request_item
	inner join produk on
		produk.id_produk = order_confirmation_item.id_produk;
/*end part 1*/

