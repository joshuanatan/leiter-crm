drop view if exists order_detail;
create view order_detail AS 
select 
    price_request.id_submit_request AS id_submit_request,
    price_request.id_request AS id_request,
    price_request.bulan_request AS bulan_request,
    price_request.tahun_request AS tahun_request,
    price_request.no_request AS no_request,
    price_request.id_perusahaan AS id_perusahaan,
    price_request.id_cp AS id_cp,
    price_request.franco AS franco,
    price_request.untuk_stock AS untuk_stock,
    price_request.tgl_dateline_request AS tgl_dateline_request,
    price_request.status_buat_quo AS status_buat_quo,
    price_request.status_aktif_request AS status_aktif_request,
    price_request.status_request AS status_request,
    price_request.id_user_add AS id_user_add_request,
    price_request.date_request_add AS date_request_add,
    price_request.id_user_edit AS id_user_edit_request,
    price_request.date_request_edit AS date_request_edit,
    price_request.id_user_delete AS id_user_delete_request,
    price_request.date_request_delete AS date_request_delete,
    quotation.id_submit_quotation AS id_submit_quotation,
    quotation.id_quotation AS id_quotation,
    quotation.loss_cause as loss_cause,
    quotation.bulan_quotation AS bulan_quotation,
    quotation.tahun_quotation AS tahun_quotation,
    quotation.versi_quotation AS versi_quotation,
    quotation.no_quotation AS no_quotation,
    quotation.total_quotation_price AS total_quotation_price,
    quotation.hal_quotation AS hal_quotation,
    quotation.up_cp AS up_cp_quotation,
    quotation.durasi_pengiriman AS durasi_pengiriman_quotation,
    quotation.franco AS franco_quotation,
    quotation.durasi_pembayaran AS durasi_pembayaran_quotation,
    quotation.alamat_perusahaan AS alamat_perusahaan,
    quotation.dateline_quotation AS dateline_quotation,
    quotation.status_quotation AS status_quotation,
    quotation.status_aktif_quotation AS status_aktif_quotation,
    quotation.id_user_add AS id_user_add_quotation,
    quotation.date_quotation_add AS date_quotation_add,
    quotation.id_user_edit AS id_user_edit_quotation,
    quotation.date_quotation_edit AS date_quotation_edit,
    quotation.id_user_delete AS id_user_delete_quotation,
    quotation.date_quotation_delete AS date_quotation_delete,
    order_confirmation.id_submit_oc AS id_submit_oc,
    order_confirmation.id_oc AS id_oc,
    order_confirmation.bulan_oc AS bulan_oc,
    order_confirmation.tahun_oc AS tahun_oc,
    order_confirmation.no_oc AS no_oc,
    order_confirmation.no_po_customer AS no_po_customer,
    order_confirmation.tgl_po_customer AS tgl_po_customer,
    order_confirmation.total_oc_price AS total_oc_price,
    order_confirmation.up_cp AS up_cp_oc,
    order_confirmation.alamat_perusahaan_oc,
    order_confirmation.durasi_pengiriman AS durasi_pengiriman_oc,
    order_confirmation.durasi_pembayaran AS durasi_pembayaran_oc,
    order_confirmation.metode_pengiriman AS metode_pengiriman,
    order_confirmation.franco AS franco_oc,
    order_confirmation.status_oc AS status_oc,
    order_confirmation.status_aktif_oc AS status_aktif_oc,
    order_confirmation.id_user_add AS id_user_add_oc,
    order_confirmation.date_oc_add AS date_oc_add,
    order_confirmation.id_user_edit AS id_user_edit,
    order_confirmation.date_oc_edit AS id_user_edit_oc,
    order_confirmation.id_user_delete AS id_user_delete,
    order_confirmation.date_oc_delete AS id_user_delete_oc,
    perusahaan.nama_perusahaan AS nama_perusahaan,
    contact_person.nama_cp AS nama_cp,
    price_request_user.nama_user AS nama_user_add_request,
    quotation_user.nama_user AS nama_user_add_quotation,
    oc_user.nama_user AS nama_user_add_oc,
    price_request_user_edit.nama_user AS nama_user_edit_request,
    quotation_user_edit.nama_user AS nama_user_edit_quotation,
    oc_user_edit.nama_user AS nama_user_edit_oc,
    price_request_user_delete.nama_user AS nama_user_delete_request,
    quotation_user_delete.nama_user AS nama_user_delete_quotation,
    oc_user_delete.nama_user AS nama_user_delete_oc 
    from price_request 
    inner join perusahaan 
        on perusahaan.id_perusahaan = price_request.id_perusahaan 
    inner join contact_person 
        on contact_person.id_cp = price_request.id_cp 
    left join user price_request_user 
        on price_request_user.id_user = price_request.id_user_add 
    left join user price_request_user_edit 
        on price_request_user_edit.id_user = price_request.id_user_edit 
    left join user price_request_user_delete 
        on price_request_user_delete.id_user = price_request.id_user_delete 
    left join quotation 
        on quotation.id_request = price_request.id_submit_request 
    left join user quotation_user 
        on quotation_user.id_user = quotation.id_user_add 
    left join user quotation_user_edit 
        on quotation_user_edit.id_user = quotation.id_user_edit 
    left join user quotation_user_delete 
        on quotation_user_delete.id_user = quotation.id_user_delete 
    left join order_confirmation 
        on order_confirmation.id_submit_quotation = quotation.id_submit_quotation 
    left join user oc_user 
        on oc_user.id_user = order_confirmation.id_user_add 
    left join user oc_user_edit 
        on oc_user_edit.id_user = order_confirmation.id_user_edit 
    left join user oc_user_delete 
        on oc_user_delete.id_user = order_confirmation.id_user_delete
        