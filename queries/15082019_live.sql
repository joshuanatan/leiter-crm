/*live 16/08/2019 pagi*/
create view list_price_request as 
select 
id_submit_request,
id_request,
bulan_request,
tahun_request,
no_request,
price_request.id_perusahaan,
nama_perusahaan,
price_request.id_cp,
nama_cp,
franco,
untuk_stock,
tgl_dateline_request,
status_buat_quo,
status_aktif_request,
status_request,
price_request.id_user_add,
price_request.date_request_add,
price_request.id_user_edit,
price_request.date_request_edit,
price_request.id_user_delete,
price_request.date_request_delete 

from price_request
inner join perusahaan on perusahaan.id_perusahaan = price_request.id_perusahaan
inner join contact_person on contact_person.id_cp = price_request.id_cp