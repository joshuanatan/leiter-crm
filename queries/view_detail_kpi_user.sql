drop view if exists detail_kpi_user;
create view detail_kpi_user as
select 
kpi_user.kpi,
kpi_user.target_kpi,
report_weeks.id_weeks,
concat("week ",report_weeks.id_weeks) as week_name,
report_weeks.tahun,
report_weeks.tgl_mulai,
report_weeks.tgl_selesai,
user.nama_user,
report.* from report
inner join kpi_user on kpi_user.id_kpi_user = report.tipe_report
inner join report_weeks on report_weeks.id_weeks = report.id_week
inner join user on user.id_user = report.id_user_add
where status_aktif_report = 0

select * from detail_kpi_user;

show columns from report_weeks