/*live 28/08/2019*/
create table tambahan_transaksi like pembayaran;
alter table tambahan_transaksi CHANGE `id_refrensi` `id_submit_oc` INT;
alter table tambahan_transaksi 
add no_refrence varchar(200) after id_pembayaran;
alter table tambahan_transaksi
add peruntukan_tagihan varchar(200) after no_refrence;
alter table tambahan_transaksi
add status_transaksi varchar(200) after metode_pembayaran;
create view transaction_oc as 
select 
no_invoice as no_refrence,
'CUSTOMER' as peruntukan_tagihan,
id_refrensi as id_submit_invoice, /*id submit invoice*/
id_pembayaran,
subject_pembayaran,
tgl_bayar,
pembayaran_customer.attachment as attachment,
notes_pembayaran,
pembayaran_customer.nominal_pembayaran as nominal_pembayaran,
pembayaran_customer.kurs_pembayaran,
pembayaran_customer.mata_uang_pembayaran,
pembayaran_customer.total_pembayaran,
pembayaran_customer.metode_pembayaran,
'MASUK' as status_transaksi 
from pembayaran_customer 
inner join invoice_core on invoice_core.id_submit_invoice = pembayaran_customer.id_refrensi
union
select 
no_refrence,
peruntukan_tagihan,
id_submit_oc,
id_pembayaran,
subject_pembayaran,
tgl_bayar,
pembayaran.attachment as attachment,
notes_pembayaran,
pembayaran.nominal_pembayaran as nominal_pembayaran,
pembayaran.kurs_pembayaran,
pembayaran.mata_uang_pembayaran,
pembayaran.total_pembayaran,
pembayaran.metode_pembayaran,
'KELUAR' as status_transaksi
from pembayaran
inner join tagihan on pembayaran.id_refrensi = tagihan.id_tagihan
inner join po_core on po_core.no_po = tagihan.no_refrence
union
select 
no_refrence,
peruntukan_tagihan,
id_submit_oc,
id_pembayaran,
subject_pembayaran,
tgl_bayar,
pembayaran.attachment as attachment,
notes_pembayaran,
pembayaran.nominal_pembayaran as nominal_pembayaran,
pembayaran.kurs_pembayaran,
pembayaran.mata_uang_pembayaran,
pembayaran.total_pembayaran,
pembayaran.metode_pembayaran,
'KELUAR' as status_transaksi
from pembayaran
inner join tagihan on pembayaran.id_refrensi = tagihan.id_tagihan
inner join od_core on od_core.no_od = tagihan.no_refrence
union
select 
no_refrence,
peruntukan_tagihan,
id_submit_oc,
id_pembayaran,
subject_pembayaran,
tgl_bayar,
attachment,
notes_pembayaran,
nominal_pembayaran,
kurs_pembayaran,
mata_uang_pembayaran,
total_pembayaran,
metode_pembayaran,
status_transaksi
from 
tambahan_transaksi;


drop procedure if exists count_margin_oc;
DELIMITER //
CREATE PROCEDURE count_margin_oc(IN id_submit_oc int, OUT margin double(20,2))
BEGIN
	select @pemasukan, @pengeluaran;
    select sum(nominal_pembayaran) into @pemasukan from transaction_oc where status_transaksi = 'MASUK';
    select sum(nominal_pembayaran) into @pengeluaran from transaction_oc where status_transaksi = 'KELUAR';
    select ((@pemasukan-@pengeluaran)/@pemasukan)*100 into margin;
END //
DELIMITER ;

create view pembayaran_invoice as 
select 
pembayaran_customer.id_pembayaran, 
pembayaran_customer.id_refrensi,
pembayaran_customer.subject_pembayaran,
pembayaran_customer.tgl_bayar,
pembayaran_customer.attachment,
pembayaran_customer.notes_pembayaran,
pembayaran_customer.nominal_pembayaran,
pembayaran_customer.kurs_pembayaran,
pembayaran_customer.mata_uang_pembayaran,
pembayaran_customer.total_pembayaran,
pembayaran_customer.metode_pembayaran,
invoice_core.id_submit_invoice,
invoice_core.id_invoice,
invoice_core.bulan_invoice,
invoice_core.tahun_invoice,
invoice_core.no_invoice,
invoice_core.id_submit_oc,
invoice_core.id_submit_od,
invoice_core.nominal_pembayaran as nominal_invoice,
invoice_core.kurs_pembayaran as kurs_invoice,
invoice_core.mata_uang as mata_uang_invoice,
invoice_core.is_ppn,
invoice_core.ppn,
invoice_core.franco,
invoice_core.att,
invoice_core.alamat_penagihan,
invoice_core.tipe_invoice,
invoice_core.status_lunas,
invoice_core.status_aktif_invoice,
invoice_core.jatuh_tempo,
invoice_core.durasi_pembayaran,
invoice_core.no_rekening,
invoice_core.jumlah_box,
invoice_core.berat_bersih,
invoice_core.berat_kotor,
invoice_core.dimensi,
invoice_core.id_user_add,
invoice_core.tgl_invoice_add,
invoice_core.id_user_edit,
invoice_core.tgl_invoice_edit
from pembayaran_customer 
inner join invoice_core on invoice_core.id_submit_invoice = pembayaran_customer.id_refrensi;

drop procedure if exists hitung_nominal_transaksi;
DELIMITER //
create procedure hitung_nominal_transaksi(IN tahun int, in bulan varchar(2), out nominal double(20,3))
BEGIN
select sum(total_pembayaran) into nominal from pembayaran_invoice where  bulan_invoice = bulan and tahun_invoice = tahun;
END //
DELIMITER ;

create view po_item_detail as 
select 
po_item.id_po_item,
po_item.id_submit_po,
po_item.nama_produk_vendor as nama_produk_vendor_po,
po_item.harga_item as harga_item_po,
po_item.jumlah_item as jumlah_item_po,
po_item.satuan_item as satuan_item_po,
order_item_detail.* 
from po_item inner join 
order_item_detail on order_item_detail.id_oc_item = po_item.id_oc_item;

alter table order_confirmation_item 
modify column final_selling_price double(20,2);

alter table order_confirmation_item
modify column status_oc_item int(11)  default 0;

alter table po_item
modify column harga_item double(10,2);

alter table po_item
modify column satuan_item varchar(10);

alter table po_item
modify column jumlah_item double(10,2);

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

create view od_item_detail as
select 
od_item.id_od_item,
od_item.id_submit_od,
od_item.item_qty,
order_item_detail.*
from od_item
right join order_item_detail
on order_item_detail.id_oc_item = od_item.id_oc_item;


create view metode_pembayaran_oc as 
select 
order_confirmation_metode_pembayaran.id_metode_pembayaran,
order_confirmation_metode_pembayaran.is_ada_transaksi,
order_confirmation_metode_pembayaran.is_ada_transaksi2,
order_confirmation_metode_pembayaran.kurs as kurs_metode_pembayaran_oc,
order_confirmation_metode_pembayaran.nominal_pembayaran,
order_confirmation_metode_pembayaran.nominal_pembayaran2,
order_confirmation_metode_pembayaran.persentase_pembayaran,
order_confirmation_metode_pembayaran.persentase_pembayaran2,
order_confirmation_metode_pembayaran.status_bayar,
order_confirmation_metode_pembayaran.status_bayar2,
order_confirmation_metode_pembayaran.trigger_pembayaran,
order_confirmation_metode_pembayaran.trigger_pembayaran2,
order_detail.*
from order_detail
inner join order_confirmation_metode_pembayaran
on order_confirmation_metode_pembayaran.id_submit_oc = order_detail.id_submit_oc;

drop view if exists od_item_delivered;
create view od_item_delivered as
select 
od_item.id_od_item,
od_item.id_submit_od,
od_item.item_qty,
od_item.id_oc_item,
sum(item_qty) as delivered
from od_item
group by id_oc_item;

drop view if exists od_item_detail;
create view od_item_detail as
select 
od_item.id_od_item,
od_item.id_submit_od,
od_item.item_qty,
order_item_detail.*,
delivered
from order_item_detail
left join od_item
on order_item_detail.id_oc_item = od_item.id_oc_item
left join od_item_delivered
on od_item_delivered.id_oc_item = order_item_detail.id_oc_item
