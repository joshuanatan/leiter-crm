select * from order_detail;

select count(id_submit_request) as jumlah_rfq,bulan_request,tahun_request from order_detail
where tahun_request = 2019
and status_aktif_request = 0
group by bulan_request ;

update price_request set bulan_request = '12' where id_submit_request > 46;select * from price_request;

select count(id_quotation) as quotation_loss, bulan_quotation,tahun_quotation from order_detail
where tahun_quotation = 2019
and status_quotation = 1
group by bulan_quotation;

select count(id_quotation) as quotation_win, bulan_quotation,tahun_quotation from order_detail
where tahun_quotation = 2019
and status_quotation = 0
group by bulan_quotation;

select * from order_detail
where tahun_quotation = 2019
and status_quotation = 1;

select * from order_detail;

select * from quotation
where tahun_quotation = 2019;

update quotation set bulan_quotation = '05'
where id_submit_quotation between 80 and 85;
select * from quotation
where tahun_quotation = 2019;