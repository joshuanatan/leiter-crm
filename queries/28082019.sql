select 
count(distinct(no_po_customer)), no_po_customer,bulan_oc, tahun_oc
from order_detail
group by bulan_oc, tahun_oc;

select * from order_detail where tahun_oc = 2016

update order_detail set tahun_oc = 2017 where id_submit_request = 34


show columns from order_detail

select sum(total_oc_price) as total_oc ,nama_perusahaan,tahun_oc from order_detail 
where order_detail.tahun_oc = 2019
group by id_perusahaan 
union
select sum(total_oc_price) as total_oc ,nama_perusahaan,tahun_oc from order_detail 
where order_detail.tahun_oc = 2018
group by id_perusahaan 
union
select sum(total_oc_price) as total_oc ,nama_perusahaan,tahun_oc from order_detail 
where order_detail.tahun_oc = 2017
group by id_perusahaan 
order by total_oc DESC

select sum(total_oc_price) as total_oc ,nama_perusahaan,tahun_oc from order_detail where order_detail.tahun_oc = 2019 group by id_perusahaan union select sum(total_oc_price) as total_oc ,nama_perusahaan,tahun_oc from order_detail where order_detail.tahun_oc = 2018 group by id_perusahaan union select sum(total_oc_price) as total_oc ,nama_perusahaan,tahun_oc from order_detail where order_detail.tahun_oc = 2017 group by id_perusahaan order by total_oc DESC

select id_submit_oc, total_oc_price from order_detail

update order_detail set total_oc_price = total_oc_price/10 where id_submit_oc between 12 and 21