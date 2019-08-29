delete from pembayaran_customer where id_pembayaran = 16;
update invoice_core set status_lunas = 1 where invoice_core.id_submit_invoice not in
(select pembayaran_customer.id_refrensi from pembayaran_customer);
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