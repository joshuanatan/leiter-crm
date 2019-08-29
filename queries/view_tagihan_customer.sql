use leiter_crm;
drop view if exists tagihan_customer;
create view tagihan_customer as 
select no_po_customer,nama_perusahaan, nama_cp,invoice_core.*, case when tipe_invoice=1 then "PELUNASAN UTUH" when tipe_invoice = 2 then "PEMBAYARAN DP" when tipe_invoice = 3 then "PELUNASAN (BER-DP)" end as tipe_pembayaran, DATEDIFF(jatuh_tempo,curdate()) AS sisa_waktu 
from invoice_core
inner join order_detail 
on order_detail.id_submit_oc = invoice_core.id_submit_oc
where status_lunas = 1 
and status_aktif_invoice = 0
order by jatuh_tempo ASC;

select * from tagihan_customer
where sisa_waktu >= 5;
