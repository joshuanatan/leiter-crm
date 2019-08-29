
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
