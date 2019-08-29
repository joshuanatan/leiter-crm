drop view if exists list_quotation;
create view list_quotation as
select 
quotation.id_submit_quotation,
quotation.id_quotation,
quotation.bulan_quotation,
quotation.tahun_quotation,
quotation.versi_quotation,
quotation.no_quotation,
quotation.total_quotation_price,
quotation.hal_quotation,
quotation.up_cp,
quotation.durasi_pembayaran,
quotation.durasi_pengiriman
price_request.*
from quotation
inner join list_price_request as price_request
on price_request.id_submit_request = quotation.id_request

select * from quotation