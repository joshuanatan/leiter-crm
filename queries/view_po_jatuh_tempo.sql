drop view if exists po_jatuh_tempo;
create view po_jatuh_tempo as 
select supplier.nama_perusahaan as nama_supplier, shipper.nama_perusahaan as nama_shipper,po_core.*, datediff(requirement_date,curdate()) as waktu_jatuh_tempo from po_core
inner join perusahaan as supplier
on supplier.id_perusahaan = po_core.id_supplier
inner join perusahaan as shipper
on shipper.id_perusahaan = po_core.id_shipper
where status_aktif_po = 0 and status_selesai_po = 1
order by waktu_jatuh_tempo ASC;
select * from po_jatuh_tempo;