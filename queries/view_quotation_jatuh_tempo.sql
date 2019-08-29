drop view if exists quotation_jatuh_tempo;
create view quotation_jatuh_tempo as
select nama_perusahaan,quotation.*, datediff(quotation.dateline_quotation,curdate()) as waktu_jatuh_tempo from quotation
inner join order_detail on order_detail.id_submit_quotation = quotation.id_submit_quotation
where quotation.status_aktif_quotation = 0 and quotation.status_quotation = 0
order by waktu_jatuh_tempo ASC

select * from quotation_jatuh_tempo;