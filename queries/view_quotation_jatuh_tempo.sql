drop view if exists quotation_jatuh_tempo;
create view quotation_jatuh_tempo as
select *, datediff(dateline_quotation,curdate()) as waktu_jatuh_tempo from quotation
where status_aktif_quotation = 0 and status_quotation = 0
order by waktu_jatuh_tempo ASC