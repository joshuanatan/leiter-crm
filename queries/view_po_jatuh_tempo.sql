drop view if exists po_jatuh_tempo;
create view po_jatuh_tempo as 
select *, datediff(requirement_date,curdate()) as waktu_jatuh_tempo from po_core
where status_aktif_po = 0 and status_selesai_po = 1
order by waktu_jatuh_tempo ASC
