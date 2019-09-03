/*done 03/09/2019 */
create view po_stock as 
select 
po_core.*,
supplier.nama_perusahaan as nama_supplier,
shipper.nama_perusahaan as nama_shipper,
cp_supplier.nama_cp as nama_cp_supplier,
cp_shipper.nama_cp as nama_cp_shipper
from po_core
inner join perusahaan as supplier
on supplier.id_perusahaan = po_core.id_supplier
inner join perusahaan as shipper
on shipper.id_perusahaan = po_core.id_shipper
inner join contact_person as cp_supplier
on cp_supplier.id_cp = po_core.id_cp_supplier
inner join contact_person as cp_shipper
on cp_shipper.id_cp = po_core.id_cp_shipper
where id_submit_oc != -1 
and status_aktif_po = 0;

create table po_stock_item
like po_item;

alter table po_stock_item
change column id_oc_item  id_produk_item int(11);

alter table po_stock_item
change column id_produk_item id_produk int(11);

drop view if exists po_stock;
create view po_stock as 
select 
po_core.*,
supplier.nama_perusahaan as nama_supplier,
shipper.nama_perusahaan as nama_shipper,
cp_supplier.nama_cp as nama_cp_supplier,
cp_shipper.nama_cp as nama_cp_shipper
from po_core
inner join perusahaan as supplier
on supplier.id_perusahaan = po_core.id_supplier
inner join perusahaan as shipper
on shipper.id_perusahaan = po_core.id_shipper
inner join contact_person as cp_supplier
on cp_supplier.id_cp = po_core.id_cp_supplier
inner join contact_person as cp_shipper
on cp_shipper.id_cp = po_core.id_cp_shipper
where id_submit_oc = -1 
and status_aktif_po = 0;

create view po_stock_item_detail as 
select 
po_stock_item.*,
deskripsi_produk,
satuan_produk 
from po_stock_item
inner join produk on produk.id_produk = po_stock_item.id_produk;

drop view if exists po_stock;
create view po_stock as 
select 
po_core.*,
supplier.nama_perusahaan as nama_supplier,
supplier.alamat_perusahaan as alamat_supplier,
supplier.notelp_perusahaan as notelp_supplier,
supplier.nofax_perusahaan as nofax_supplier,
shipper.nama_perusahaan as nama_shipper,
shipper.alamat_perusahaan as alamat_shipper,
shipper.notelp_perusahaan as notelp_shipper,
shipper.nofax_perusahaan as nofax_shipper,
cp_supplier.nama_cp as nama_cp_supplier,
cp_shipper.nama_cp as nama_cp_shipper
from po_core
inner join perusahaan as supplier
on supplier.id_perusahaan = po_core.id_supplier
inner join perusahaan as shipper
on shipper.id_perusahaan = po_core.id_shipper
inner join contact_person as cp_supplier
on cp_supplier.id_cp = po_core.id_cp_supplier
inner join contact_person as cp_shipper
on cp_shipper.id_cp = po_core.id_cp_shipper
where id_submit_oc = -1 
and status_aktif_po = 0;
