/* live  16/08/2019 pagi */
drop view if exists order_item_detail;
create view order_item_detail AS 
select 
    price_request_item.id_request_item AS id_request_item,
    price_request_item.id_submit_request AS id_submit_request,
    price_request_item.nama_produk AS nama_produk_request,
    price_request_item.jumlah_produk AS jumlah_produk_request,
    price_request_item.satuan_produk AS satuan_produk_request,
    price_request_item.notes_produk AS notes_produk_request,
    price_request_item.file AS file,
    price_request_item.status_request_item AS status_request_item,
    price_request_item.sudah_po AS sudah_po,
    quotation_item.id_quotation_item AS id_quotation_item,
    quotation_item.id_submit_quotation AS id_submit_quotation,
    quotation_item.nama_produk_leiter AS nama_produk_leiter,
    quotation_item.id_harga_vendor AS id_harga_vendor,
    quotation_item.id_harga_shipping AS id_harga_shipping,
    quotation_item.id_harga_courier AS id_harga_courier,
    quotation_item.attachment AS attachment_quotation,
    quotation_item.item_amount AS item_amount_quotation,
    quotation_item.satuan_produk AS satuan_produk_quotation,
    quotation_item.selling_price AS selling_price_quotation,
    quotation_item.margin_price AS margin_price_quotation,
    order_confirmation_item.id_oc_item AS id_oc_item,
    order_confirmation_item.id_submit_oc AS id_submit_oc,
    order_confirmation_item.nama_oc_item AS nama_oc_item,
    order_confirmation_item.final_amount AS final_amount_oc,
    order_confirmation_item.satuan_produk AS satuan_produk_oc,
    order_confirmation_item.final_selling_price AS final_selling_price_oc,
    order_confirmation_item.status_oc_item AS status_oc_item,
    order_confirmation_item.id_produk AS id_produk,
    produk.bn_produk AS bn_produk,
    produk.nama_produk AS nama_produk,
    produk.satuan_produk AS satuan_produk,
    produk.deskripsi_produk AS deskripsi_produk,
    produk.gambar_produk AS gambar_produk,
    produk.status_produk AS status_produk,
    harga_courier.id_perusahaan as id_courier,
    harga_courier.harga_produk AS harga_produk_courier,
    harga_courier.vendor_price_rate AS vendor_price_rate_courier,
    harga_courier.mata_uang AS mata_uang_courier,
    harga_courier.notes AS notes_courier,
    harga_courier.attachment AS attachment_courier,
    harga_courier.metode_pengiriman AS metode_pengiriman_courier,
    harga_courier.status_aktif_harga_shipping AS status_aktif_harga_shipping_courier,
    harga_vendor.id_perusahaan as id_vendor,
    harga_vendor.nama_produk_vendor as nama_produk_vendor,
    harga_vendor.harga_produk AS harga_produk_vendor,
    harga_vendor.vendor_price_rate AS vendor_price_rate_vendor,
    harga_vendor.mata_uang AS mata_uang_vendor,
    harga_vendor.notes AS notes_vendor,
    harga_vendor.attachment AS attachment_vendor,
    harga_vendor.status_harga_vendor AS status_harga_vendor_vendor,
    harga_shipping.id_perusahaan as id_shipping,
    harga_shipping.harga_produk AS harga_produk_shipping,
    harga_shipping.vendor_price_rate AS vendor_price_rate_shipping,
    harga_shipping.mata_uang AS mata_uang_shipping,
    harga_shipping.notes AS notes_shipping,
    harga_shipping.attachment AS attachment_shipping,
    harga_shipping.metode_pengiriman AS metode_pengiriman_shipping,
    harga_shipping.status_aktif_harga_shipping AS status_aktif_harga_shipping_shipping,
    vendor.nama_perusahaan AS nama_vendor,
    courier.nama_perusahaan AS nama_courier,
    shipping.nama_perusahaan AS nama_shipper 
    from 
        price_request_item 
    left join quotation_item 
        on quotation_item.id_request_item = price_request_item.id_request_item 
    left join order_confirmation_item 
        on order_confirmation_item.id_quotation_item = quotation_item.id_quotation_item 
    left join produk 
        on produk.id_produk = order_confirmation_item.id_produk 
    left join harga_courier 
        on harga_courier.id_harga_courier = quotation_item.id_harga_courier 
    left join harga_vendor 
        on harga_vendor.id_harga_vendor = quotation_item.id_harga_vendor 
    left join harga_shipping 
        on harga_shipping.id_harga_vendor = harga_vendor.id_harga_vendor 
    left join perusahaan vendor 
        on vendor.id_perusahaan = harga_vendor.id_perusahaan 
    left join perusahaan courier 
        on courier.id_perusahaan = harga_courier.id_perusahaan
    left join perusahaan shipping 
        on shipping.id_perusahaan = harga_shipping.id_perusahaan
