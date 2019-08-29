create view sales_monthly as
select 
sum(total_pembayaran) as total,
pembayaran_invoice.* 
from pembayaran_invoice
group by bulan_invoice,tahun_invoice;


