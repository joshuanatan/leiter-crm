use leiter_crm;
drop view if exists tagihan_customer;
create view tagihan_customer as 
select *, DATEDIFF(jatuh_tempo,curdate()) AS sisa_waktu from invoice_core
where status_lunas = 1 
and status_aktif_invoice = 0
order by jatuh_tempo ASC;

select * from tagihan_customer
where sisa_waktu >= 5;

update invoice_core set jatuh_tempo = '2019-12-25' where id_submit_invoice = 7