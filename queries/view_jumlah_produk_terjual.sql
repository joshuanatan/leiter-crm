drop view if exists jumlah_produk_terjual;
create view jumlah_produk_terjual as
select detail_finished_order_item.*,count(id_produk), oc.bulan_oc, oc.tahun_oc jumlah_perproduk from detail_finished_order_item 
inner join order_confirmation as oc on
oc.id_submit_oc = detail_finished_order_item.id_submit_oc
group by id_produk
order by jumlah_perproduk desc;