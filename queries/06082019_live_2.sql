/*done live 07/08/2019*/
alter table order_confirmation_item 
	modify column final_selling_price double(20,3);
    
alter table order_confirmation
	modify column total_oc_price double(20,3);
    
alter table invoice_core 
	modify column nominal_pembayaran decimal(20,3);
    
alter table pembayaran_customer
	modify column nominal_pembayaran double(20,3),
    modify column kurs_pembayaran double(20,3),
    modify column total_pembayaran double(20,3);
    
alter table tagihan 
	modify column subtotal double(20,3),
	modify column discount double(20,3),
    modify column total double(20,3),
    modify column ppn double(20,3),
    modify column pph double(20,3);
    
alter table pembayaran
	modify column nominal_pembayaran double(20,3),
    modify column kurs_pembayaran double(20,3),
    modify column total_pembayaran double(20,3);

alter table order_confirmation_metode_pembayaran
	modify column nominal_pembayaran double(20,3),
    modify column nominal_pembayaran2 double(20,3);
    
alter table quotation_metode_pembayaran
	modify column nominal_pembayaran double(20,3),
    modify column nominal_pembayaran2 double(20,3);