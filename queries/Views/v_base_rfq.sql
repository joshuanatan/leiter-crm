drop view if exists v_base_rfq;
create view v_base_rfq as
select 
id_submit_request,
id_request,
bulan_request,
tahun_request,
no_request,
price_request.id_perusahaan,
price_request.id_cp,
franco,
untuk_stock,
tgl_dateline_request,
status_buat_quo,
status_aktif_request,
status_request,
date_request_add,
date_request_edit,
date_request_delete,
perusahaan.nama_perusahaan,
contact_person.nama_cp
from price_request 
inner join perusahaan on
perusahaan.id_perusahaan = price_request.id_perusahaan
inner join contact_person on
contact_person.id_cp = price_request.id_cp;

show columns from v_base_rfq;