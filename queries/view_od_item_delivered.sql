drop view if exists od_item_delivered;
create view od_item_delivered as
select 
od_item.id_od_item,
od_item.id_submit_od,
od_item.item_qty,
od_item.id_oc_item,
sum(item_qty) as delivered
from od_item
group by id_oc_item

select * from od_item_delivered;

select * from