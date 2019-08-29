create view pembayaran_tagihan as
	select 
		order_detail.id_submit_oc,
		no_invoice, 
		no_refrence, 
		peruntukan_tagihan, 
		total, 
		mata_uang, 
		kurs_pembayaran,
		"KELUAR" as status_transaksi 
		from tagihan
		inner join od_core on od_core.no_od = tagihan.no_refrence
		inner join order_detail on order_detail.id_submit_oc = od_core.id_submit_oc
		inner join pembayaran on pembayaran.id_refrensi = tagihan.id_tagihan
	union
	/*select pembayaran supplier dan pembayaran ke shipper*/
	select 
		order_detail.id_submit_oc,
		no_invoice, 
		no_refrence, 
		peruntukan_tagihan, 
		total, 
		mata_uang, 
		kurs_pembayaran,
		"KELUAR" as status_transaksi 
		from tagihan
		inner join po_core on po_core.no_po = tagihan.no_refrence
		inner join order_detail on order_detail.id_submit_oc = po_core.id_submit_oc
		inner join pembayaran on pembayaran.id_refrensi = tagihan.id_tagihan
	union
	/*select pembayaran dari customer*/    
	select 
		order_detail.id_submit_oc,
		invoice_core.no_invoice,
		no_po_customer as no_refrence, 
		"CUSTOMER" as peruntukan_tagihan, 
		pembayaran_customer.nominal_pembayaran as total, 
		mata_uang_pembayaran as mata_uang, 
		pembayaran_customer.kurs_pembayaran, 
		"MASUK" as status_transaksi 
		from invoice_core
		inner join order_detail on order_detail.id_submit_oc = invoice_core.id_submit_oc
		inner join pembayaran_customer on pembayaran_customer.id_refrensi = invoice_core.id_submit_invoice
