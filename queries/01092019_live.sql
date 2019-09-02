/* live 02/09/2019*/
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
po_core.id_user_add as id_user_add_po,
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
on cp_shipper.id_cp = po_core.id_cp_shipper;

drop view if exists od_detail;
create view od_detail as 
select 
id_submit_od,
id_od,
bulan_od,
tahun_od,
no_od,
id_courier,
delivery_method,
od_core.alamat_pengiriman,
up_cp,
status_od,
status_aktif_od,
date_od_add,
date_od_edit,
date_od_delete,
od_core.id_user_add as id_user_add_od,
order_detail.*,
courier.nama_perusahaan as nama_courier,
courier.alamat_perusahaan as alamat_perusahaan_courier,
courier.alamat_pengiriman as alamat_pengiriman_courier,
courier.nofax_perusahaan as nofax_courier,
courier.notelp_perusahaan as notelp_courier 
from od_core
inner join order_detail
on order_detail.id_submit_oc = od_core.id_submit_oc
left join perusahaan as courier
on courier.id_perusahaan = od_core.id_courier;

create table visit_call_report_attachment (
id_submit_attachment int(11) primary key auto_increment,
attachment varchar(500),
id_submit_report int(11)
);

alter table visit_call_report
modify column jenis_report int(11) comment '1 untuk visit, 0 untuk call';

alter table invoice_core
add sign_off varchar(200) after no_rekening;

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
invoice_core.sign_off,
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
where status_aktif_invoice = 0

