

select * from order_confirmation_metode_pembayaran;
select * from order_confirmation_metode_pembayaran;

select id_metode_pembayaran, count(id_metode_pembayaran) from order_confirmation_metode_pembayaran
group by id_submit_oc 
having count(id_metode_pembayaran) > 1;

delete t1 from order_confirmation_metode_pembayaran t1
inner join order_confirmation_metode_pembayaran t2
where t1.id_metode_pembayaran < t2.id_metode_pembayaran and t1.id_submit_oc = t2.id_submit_oc;

select 
id_submit_oc,
is_ada_transaksi,
is_ada_transaksi2,
nominal_pembayaran,
nominal_pembayaran2,
persentase_pembayaran,
persentase_pembayaran2,
status_bayar,
status_bayar2,
trigger_pembayaran,
trigger_pembayaran2
from metode_pembayaran_oc;

update metode_pembayaran_oc set is_ada_transaksi = 0,status_bayar = 0,is_ada_transaksi2 = 1,status_bayar2 = 1,trigger_pembayaran2 = 2 where id_submit_oc = 40;

select * from od_detail;
select * from od_item 
right join order_item_detail
on order_item_detail.id_oc_item = od_item.id_oc_item
;
select * from order_item_detail;
select * from order_detail where id_submit_oc = 40;

SELECT 
`od_item_delivered`.`id_od_item`, `od_item_delivered`.`id_oc_item`, `od_item_delivered`.`nama_oc_item`, `od_item_delivered`.`item_qty`, `delivered`, `od_item_delivered`.`satuan_produk_oc`, `od_item_delivered`.`final_amount_oc` FROM `od_item_delivered` 
JOIN `od_item_detail` 
ON `od_item_detail`.`id_od_item` = `od_item_delivered`.`id_od_item` 
WHERE `od_item_detail`.`id_submit_oc` = '40' AND ( `od_item_delivered`.`id_submit_od` = '27' OR od_item_delivered.id_submit_od is null ) AND `od_item_delivered`.`status_oc_item` = 0;

SELECT `od_item_delivered`.`id_od_item`, `od_item_delivered`.`id_oc_item`, `od_item_delivered`.`nama_oc_item`, `od_item_delivered`.`item_qty`, `delivered`, `od_item_delivered`.`satuan_produk_oc`, `od_item_delivered`.`final_amount_oc` FROM `od_item_delivered` RIGHT OUTER JOIN `od_item_detail` ON `od_item_detail`.`id_od_item` = `od_item_delivered`.`id_od_item` WHERE `od_item_detail`.`id_submit_oc` = '40' AND ( `od_item_delivered`.`id_submit_od` = '27' OR od_item_detail.id_submit_od is null ) AND `od_item_detail`.`status_oc_item` = 0;

select * from od_item_delivered where status_oc_item = 0