create view detail_finished_order as 
	select 
		order_confirmation.bulan_oc,
        order_confirmation.id_submit_oc,
        order_confirmation.tahun_oc,
        order_confirmation.date_oc_add,
        order_confirmation.no_po_customer,
        order_confirmation.tgl_po_customer,
        order_confirmation.total_oc_price,
        order_confirmation.no_oc,
        order_confirmation.status_aktif_oc,
        quotation.id_submit_quotation,
        quotation.id_quotation,
        quotation.date_quotation_add,
        quotation.total_quotation_price,
        quotation.bulan_quotation,
        quotation.tahun_quotation,
        quotation.no_quotation,
        quotation.status_aktif_quotation,
        price_request.id_submit_request,
        price_request.date_request_add,
        price_request.id_perusahaan,
        price_request.id_cp,
        price_request.no_request,
        price_request.status_request,
        price_request.status_aktif_request,
        perusahaan.nama_perusahaan,
        perusahaan.peran_perusahaan,
        perusahaan.notelp_perusahaan,
        contact_person.nama_cp
    from order_confirmation
		inner join quotation on quotation.id_submit_quotation = order_confirmation.id_submit_quotation
        inner join price_request on price_request.id_submit_request = quotation.id_request
        inner join perusahaan on perusahaan.id_perusahaan = price_request.id_perusahaan
        inner join contact_person on contact_person.id_cp = price_request.id_cp;