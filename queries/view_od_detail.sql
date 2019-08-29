drop view if exists od_detail;
create view od_detail as 
select 
id_submit_od,
id_od,
bulan_od,
tahun_od,
no_od,
id_courier,
delivery_method,
od_core.alamat_pengiriman,
up_cp,
status_od,
status_aktif_od,
date_od_add,
date_od_edit,
date_od_delete,
order_detail.*,
courier.nama_perusahaan as nama_courier,
courier.alamat_perusahaan as alamat_perusahaan_courier,
courier.alamat_pengiriman as alamat_pengiriman_courier,
courier.nofax_perusahaan as nofax_courier,
courier.notelp_perusahaan as notelp_courier 
from od_core
inner join order_detail
on order_detail.id_submit_oc = od_core.id_submit_oc
left join perusahaan as courier
on courier.id_perusahaan = od_core.id_courier