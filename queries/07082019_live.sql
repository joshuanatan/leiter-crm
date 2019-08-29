/*done 14/08/2019*/
alter table price_request_item 
drop column date_request_item_add,
drop column id_user_edit,
drop column date_request_item_edit,
drop column id_user_delete,
drop column date_request_item_delete;

create view detail_quotation as 
select 
	quotation.id_submit_quotation,
    quotation.id_quotation,
    quotation.bulan_quotation,
    quotation.tahun_quotation,
    quotation.versi_quotation,
    quotation.no_quotation,
    quotation.total_quotation_price,
    quotation.dateline_quotation,
    quotation.status_quotation,
    quotation.status_aktif_quotation,
    quotation.id_user_add,
    quotation.date_quotation_add,
    quotation.id_user_edit,
    quotation.date_quotation_edit,
    price_request.id_submit_request,
    price_request.no_request,
    perusahaan.id_perusahaan,
    perusahaan.nama_perusahaan,
    contact_person.id_cp,
    contact_person.nama_cp,
    price_request.status_buat_quo,
    price_request.status_aktif_request,
    price_request.status_request
from quotation 
inner join price_request
on price_request.id_submit_request = quotation.id_request
inner join perusahaan
on perusahaan.id_perusahaan = price_request.id_perusahaan
inner join contact_person
on contact_person.id_cp = price_request.id_cp