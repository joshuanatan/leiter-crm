use leiter_crm;
show columns from order_confirmation;
alter table order_confirmation
	modify column total_oc_price double(20,3);
show columns from order_confirmation_item;
alter table order_confirmation_item 
	modify column final_selling_price double(20,3);
show columns from quotation_item;

show columns from invoice_core;
alter table invoice_core 
	modify column nominal_pembayaran decimal(20,3);
    
show columns from pembayaran_customer;
alter table pembayaran_customer
	modify column nominal_pembayaran double(20,3),
    modify column kurs_pembayaran double(20,3),
    modify column total_pembayaran double(20,3);
    
show columns from tagihan;
alter table tagihan 
	modify column subtotal double(20,3),
	modify column discount double(20,3),
    modify column total double(20,3),
    modify column ppn double(20,3),
    modify column pph double(20,3);

show columns from pembayaran;
alter table pembayaran
	modify column nominal_pembayaran double(20,3),
    modify column kurs_pembayaran double(20,3),
    modify column total_pembayaran double(20,3);
    
show columns from order_confirmation_metode_pembayaran;
alter table order_confirmation_metode_pembayaran
	modify column nominal_pembayaran double(20,3),
    modify column nominal_pembayaran2 double(20,3);
    
show columns from quotation_metode_pembayaran;
alter table quotation_metode_pembayaran
	modify column nominal_pembayaran double(20,3),
    modify column nominal_pembayaran2 double(20,3);
    
SHOW FULL TABLES IN leiter_crm WHERE TABLE_TYPE LIKE 'VIEW';
select * from detail_order_item;
SELECT * from order_confirmation;
select * from order_detail;
select * from od_item where id_submit_od = 25;
select * from order_confirmation_item;
select * from invoice_core;
select * from od_core;
select * from pembayaran_customer;
delete from pembayaran_customer where id_pembayaran = 16;
update invoice_core set status_lunas = 1 where invoice_core.id_submit_invoice not in
(select pembayaran_customer.id_refrensi from pembayaran_customer)