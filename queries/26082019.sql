use leiter_crm;
	
show columns from order_item_detail;
select * from order_detail;
select * from order_item_detail;
select * from produk where id_produk = 1;

select * from po_core;
select * from order_confirmation_item;
select * from order_confirmation_item;

select * from po_item;

create view po_item_detail as 
select * from po_item inner join 
order_item_detail on order_item_detail.id_oc_item = po_item.id_oc_item;

use leiter_crm;
select * from po_detail;
show columns from po_detail;
select * from po_item_detail;
select * from po_item;
show columns from po_item_detail;



