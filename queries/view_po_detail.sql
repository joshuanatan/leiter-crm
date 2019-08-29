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

select * from po_detail;
select * from perusahaan;