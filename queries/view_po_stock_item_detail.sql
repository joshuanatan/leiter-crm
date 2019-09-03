create view po_stock_item_detail as 
select 
po_stock_item.*,
deskripsi_produk,
satuan_produk 
from po_stock_item
inner join produk on produk.id_produk = po_stock_item.id_produk
