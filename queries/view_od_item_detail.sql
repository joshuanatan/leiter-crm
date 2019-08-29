drop view if exists od_item_detail;
create view od_item_detail as
select 
od_item.id_od_item,
od_item.id_submit_od,
od_item.item_qty,
order_item_detail.*,
delivered
from order_item_detail
left join od_item
on order_item_detail.id_oc_item = od_item.id_oc_item
left join od_item_delivered
on od_item_delivered.id_oc_item = order_item_detail.id_oc_item


