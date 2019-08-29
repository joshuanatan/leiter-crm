drop view if exists detail_visit_call_report;
create view detail_visit_call_report as
select 
perusahaan.nama_perusahaan,
user.nama_user,
visit_call_report.*
from visit_call_report
inner join perusahaan on
perusahaan.id_perusahaan = visit_call_report.id_perusahaan
inner join user on
user.id_user = visit_call_report.id_user_add;
