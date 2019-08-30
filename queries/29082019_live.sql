create view cashflow_overview as 
select 
date(tgl_bayar) as tanggal_transaksi,
month(tgl_bayar) as bulan_transaksi,
year(tgl_bayar) as tahun_transaksi,
pembayaran.total_pembayaran*-1 as total_pembayaran,
"Pembayaran vendor" as subject_transaksi
from pembayaran
inner join tagihan on tagihan.id_tagihan = pembayaran.id_refrensi
where status_lunas = 0 and status_aktif_invoice = 0
union
select 
date(tgl_bayar) as tanggal_transaksi,
month(tgl_bayar) as bulan_transaksi,
year(tgl_bayar) as tahun_transaksi,
total_pembayaran,
"Pelunasan Customer" as subject_transaksi
from pembayaran_customer
inner join invoice_core
on invoice_core.id_submit_invoice = pembayaran_customer.id_refrensi
where status_lunas = 0 and status_aktif_invoice = 0
union
select 
date(tgl_bayar) as tanggal_transaksi,
month(tgl_bayar) as bulan_transaksi,
year(tgl_bayar) as tahun_transaksi,
bea_cukai*-1 as total_pembayaran,
"Pembayaran Bea Cukai" as subject_transaksi
from pembayaran_pib
inner join pib on pib.id_pib = pembayaran_pib.id_refrensi
where status_aktif_pib = 0 and status_bayar_pib = 0
union
select
date(tanggal_pembayaran) as tanggal_transaksi,
month(tanggal_pembayaran) as bulan_transaksi,
year(tanggal_pembayaran) as tahun_transaksi,
if(jenis_pembayaran = 1, nominal_tagihan, nominal_tagihan*-1),
"Other Cashflow" as subject_transaksi
from other_cashflow
where status_aktif_cashflow = 0
union
select 
date(tgl_transaksi_petty) as tanggal_transaksi,
month(tgl_transaksi_petty) as bulan_transaksi,
year(tgl_transaksi_petty) as tahun_transaksi,
amount*-1 as nominal_tagihan,
"Petty Cash" as subject_transaksi
from petty_cash
where status_aktif_petty = 0
union
select 
date(tgl_reimburse_add) as tanggal_transaksi,
month(tgl_reimburse_add) as bulan_transaksi,
year(tgl_reimburse_add) as tahun_transaksi,
nominal_reimburse*-1 as nominal_pembayaran,
"Reimburse" as subject_transaksi
from reimburse
where status_paid = 0 and status_aktif_reimburse = 0;

create view margin_overview as 
select 
date(tgl_bayar) as tanggal_transaksi,
month(tgl_bayar) as bulan_transaksi,
year(tgl_bayar) as tahun_transaksi,
pembayaran.total_pembayaran*-1 as total_pembayaran,
"Pembayaran vendor" as subject_transaksi
from pembayaran
inner join tagihan on tagihan.id_tagihan = pembayaran.id_refrensi
where status_lunas = 0 and status_aktif_invoice = 0
union
select 
date(tgl_bayar) as tanggal_transaksi,
month(tgl_bayar) as bulan_transaksi,
year(tgl_bayar) as tahun_transaksi,
total_pembayaran,
"Pelunasan Customer" as subject_transaksi
from pembayaran_customer
inner join invoice_core
on invoice_core.id_submit_invoice = pembayaran_customer.id_refrensi
where status_lunas = 0 and status_aktif_invoice = 0
union
select 
date(tgl_bayar) as tanggal_transaksi,
month(tgl_bayar) as bulan_transaksi,
year(tgl_bayar) as tahun_transaksi,
if(status_transaksi = 1, total_pembayaran, total_pembayaran*-1),
"Tambahan transaksi" as subject_transaksi
from tambahan_transaksi;

drop view if exists tagihan_customer;
create view tagihan_customer as 
select *, DATEDIFF(jatuh_tempo,curdate()) AS sisa_waktu from invoice_core
where status_lunas = 1 
and status_aktif_invoice = 0
order by jatuh_tempo ASC;

drop view if exists detail_finished_order_item;
CREATE VIEW `detail_finished_order_item` AS 
select `order_confirmation_item`.`id_oc_item` AS `id_oc_item`,
`order_confirmation_item`.`id_submit_oc` AS `id_submit_oc`,
`order_confirmation_item`.`nama_oc_item` AS `nama_oc_item`,
`order_confirmation_item`.`final_amount` AS `final_amount`,
`order_confirmation_item`.`satuan_produk` AS `satuan_oc_item`,
`order_confirmation_item`.`final_selling_price` AS `final_selling_price`,
`order_confirmation_item`.`status_oc_item` AS `status_oc_item`,
`order_confirmation_item`.`id_produk` AS `id_produk_oc`,
`quotation_item`.`id_quotation_item` AS `id_quotation_item`,
`quotation_item`.`id_submit_quotation` AS `id_submit_quotation`,
`quotation_item`.`nama_produk_leiter` AS `nama_quotation_item`,
`quotation_item`.`id_harga_vendor` AS `id_harga_vendor`,
`quotation_item`.`id_harga_shipping` AS `id_harga_shipping`,
`quotation_item`.`id_harga_courier` AS `id_harga_courier`,
`quotation_item`.`item_amount` AS `item_amount`,
`quotation_item`.`satuan_produk` AS `satuan_quotation_item`,
`quotation_item`.`selling_price` AS `selling_price`,
`price_request_item`.`id_request_item` AS `id_request_item`,
`price_request_item`.`id_submit_request` AS `id_submit_request`,
`price_request_item`.`nama_produk` AS `nama_request_item`,
`price_request_item`.`jumlah_produk` AS `jumlah_produk`,
`price_request_item`.`satuan_produk` AS `satuan_request_item`,
`produk`.`id_produk` AS `id_produk`,
`produk`.`bn_produk` AS `bn_produk`,
`produk`.`nama_produk` AS `nama_produk`,
`produk`.`satuan_produk` AS `satuan_produk`,
`produk`.`deskripsi_produk` AS `deskripsi_produk`,
`produk`.`gambar_produk` AS `gambar_produk`,
`produk`.`status_produk` AS `status_produk` 
from `order_confirmation_item` 
join `quotation_item` 
on `quotation_item`.`id_quotation_item` = `order_confirmation_item`.`id_quotation_item`
join `price_request_item` 
on `price_request_item`.`id_request_item` = `quotation_item`.`id_request_item`
join `produk` 
on `produk`.`id_produk` = `order_confirmation_item`.`id_produk`;

drop view if exists jumlah_produk_terjual;
create view jumlah_produk_terjual as
select detail_finished_order_item.*,count(id_produk), oc.bulan_oc, oc.tahun_oc jumlah_perproduk from detail_finished_order_item 
inner join order_confirmation as oc on
oc.id_submit_oc = detail_finished_order_item.id_submit_oc
group by id_produk
order by jumlah_perproduk desc;

drop view if exists quotation_jatuh_tempo;
create view quotation_jatuh_tempo as
select *, datediff(dateline_quotation,curdate()) as waktu_jatuh_tempo from quotation
where status_aktif_quotation = 0 and status_quotation = 0
order by waktu_jatuh_tempo ASC;

alter table po_core
add status_selesai_po int default 1 comment '1 kaalu belom kelar ponya, 0 kalau sudah';

drop view if exists po_jatuh_tempo;
create view po_jatuh_tempo as 
select *, datediff(requirement_date,curdate()) as waktu_jatuh_tempo from po_core
where status_aktif_po = 0 and status_selesai_po = 1
order by waktu_jatuh_tempo ASC;

drop view if exists tagihan_customer;
create view tagihan_customer as 
select no_po_customer,nama_perusahaan, nama_cp,invoice_core.*, case when tipe_invoice=1 then "PELUNASAN UTUH" when tipe_invoice = 2 then "PEMBAYARAN DP" when tipe_invoice = 3 then "PELUNASAN (BER-DP)" end as tipe_pembayaran, DATEDIFF(jatuh_tempo,curdate()) AS sisa_waktu 
from invoice_core
inner join order_detail 
on order_detail.id_submit_oc = invoice_core.id_submit_oc
where status_lunas = 1 
and status_aktif_invoice = 0
order by jatuh_tempo ASC;

drop view if exists quotation_jatuh_tempo;
create view quotation_jatuh_tempo as
select nama_perusahaan,quotation.*, datediff(quotation.dateline_quotation,curdate()) as waktu_jatuh_tempo from quotation
inner join order_detail on order_detail.id_submit_quotation = quotation.id_submit_quotation
where quotation.status_aktif_quotation = 0 and quotation.status_quotation = 0
order by waktu_jatuh_tempo ASC;

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

drop view if exists po_detail;
create view po_detail as 
select 
po_core.id_submit_po,
po_core.id_po,
po_core.bulan_po,
po_core.tahun_po,
po_core.no_po,
po_core.id_supplier,
po_core.id_cp_supplier,
po_core.id_shipper,
po_core.id_cp_shipper,
po_core.shipping_method,
po_core.shipping_term,
po_core.requirement_date,
po_core.destination,
po_core.total_supplier_payment,
po_core.mata_uang_pembayaran,
po_core.status_aktif_po,
po_core.date_po_core_add,
po_core.date_po_core_edit,
po_core.date_po_core_delete,
po_core.status_selesai_po,
supplier.nama_perusahaan as nama_supplier_po,
supplier.alamat_perusahaan as alamat_supplier_po,
supplier.notelp_perusahaan as notelp_supplier_po,
supplier.nofax_perusahaan as nofax_supplier_po,
shipper.nama_perusahaan as nama_shipper_po,
shipper.alamat_perusahaan as alamat_shipper_po,
shipper.notelp_perusahaan as notelp_shipper_po,
shipper.nofax_perusahaan as nofax_shipper_po,
cp_shipper.nama_cp as nama_cp_shipper,
cp_supplier.nama_cp as nama_cp_supplier,
order_detail.*
from po_core
inner join order_detail on
order_detail.id_submit_oc = po_core.id_submit_oc
inner join perusahaan as supplier 
on supplier.id_perusahaan = po_core.id_supplier
inner join perusahaan as shipper 
on shipper.id_perusahaan = po_core.id_shipper
inner join contact_person as cp_supplier
on cp_supplier.id_cp = po_core.id_cp_supplier
inner join contact_person as cp_shipper
on cp_shipper.id_cp = po_core.id_cp_shipper
;
create view detail_kpi_user as
select 
kpi_user.kpi,
kpi_user.target_kpi,
report.* from report
inner join kpi_user on kpi_user.id_kpi_user = report.tipe_report
where status_aktif_report = 0;

alter table report 
add id_week int null;

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
where status_aktif_report = 0;

drop view if exists detail_invoice;
create view detail_invoice as 
select 
invoice_core.id_submit_od as id_od_invoice,
invoice_core.id_submit_invoice,
invoice_core.no_invoice,
invoice_core.id_invoice,
invoice_core.bulan_invoice,
invoice_core.tahun_invoice,
invoice_core.nominal_pembayaran as nominal_invoice,
invoice_core.tipe_invoice,
invoice_core.jatuh_tempo,
invoice_core.durasi_pembayaran,
invoice_core.att,
invoice_core.franco as franco_invoice,
invoice_core.jatuh_tempo as jatuh_tempo_invoice,
invoice_core.alamat_penagihan,
invoice_core.is_ppn,
invoice_core.no_rekening,
metode_pembayaran.is_ada_transaksi,
metode_pembayaran.is_ada_transaksi2,
metode_pembayaran.nominal_pembayaran,
metode_pembayaran.nominal_pembayaran2,
metode_pembayaran.persentase_pembayaran,
metode_pembayaran.persentase_pembayaran2,
metode_pembayaran.status_bayar,
metode_pembayaran.status_bayar2,
metode_pembayaran.trigger_pembayaran,
metode_pembayaran.trigger_pembayaran2,
order_detail.*
from invoice_core
inner join order_detail on order_detail.id_submit_oc = invoice_core.id_submit_oc
inner join order_confirmation_metode_pembayaran as metode_pembayaran on metode_pembayaran.id_submit_oc = order_detail.id_submit_oc
where status_aktif_invoice = 0;

alter table invoice_packaging_box
modify column berat_bersih double(10,2);

alter table invoice_packaging_box
modify column berat_kotor double(10,2);

create view list_transaksi_per_oc as
select 
id_pembayaran,
pembayaran_customer.nominal_pembayaran*pembayaran_customer.kurs_pembayaran as total_pembayaran,
no_invoice,
invoice_core.id_submit_oc,
"Pembayaran Customer" as status_transaksi
from pembayaran_customer /*ambil id_refrensi as id-oc*/
inner join invoice_core on invoice_core.id_submit_invoice = pembayaran_customer.id_refrensi
inner join order_detail on order_detail.id_submit_oc = invoice_core.id_submit_oc
union
select 
id_pembayaran,
pembayaran.nominal_pembayaran*pembayaran.kurs_pembayaran*-1 as total_pembayaran,
no_po,
po_core.id_submit_oc,
"Pembayaran Supplier dan Shipper" as status_transaksi
from pembayaran
inner join tagihan on tagihan.id_tagihan = pembayaran.id_refrensi
inner join po_core on po_core.no_po = tagihan.no_refrence
union
select 
id_pembayaran,
pembayaran.nominal_pembayaran*pembayaran.kurs_pembayaran*-1 as total_pembayaran,
no_od,
od_core.id_submit_oc,
"Pembayaran Courier" as status_transaksi
from pembayaran
inner join tagihan on tagihan.id_tagihan = pembayaran.id_refrensi
inner join od_core on od_core.no_od = tagihan.no_refrence
union
select 
id_pembayaran,
if(status_transaksi = 0, nominal_pembayaran*kurs_pembayaran,nominal_pembayaran*kurs_pembayaran*-1) as total_pembayaran,
no_refrence,
id_submit_oc,
"Lain-lain" as status_transaksi
from tambahan_transaksi

