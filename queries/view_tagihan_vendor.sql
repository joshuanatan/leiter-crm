drop view if exists tagihan_vendor;
create view tagihan_vendor as 
select 
*, datediff(dateline_invoice,curdate()) as sisa_waktu
from tagihan
where status_aktif_invoice = 0 
and status_lunas = 1
order by dateline_invoice asc;

select * from tagihan_vendor
where sisa_waktu <= 5
