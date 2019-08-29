create view order_detail as 
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
        


	
select * from po_core;
select * from tagihan;
select * from tagihan
	inner join po_core on po_core.no_po = tagihan.no_refrence;

select no_po_customer, tgl_po_customer,nama_perusahaan,no_oc,total_oc_price from order_detail;
select * from invoice_core;
select * from tagihan;
select * from od_core where od_core.id_submit_oc = 5;
show columns from pembayaran;
alter table pembayaran drop column kategori_pembayaran;
alter table pembayaran drop column jenis_pembayaran;
select * from pembayaran;
show columns from tagihan;

/*ini nanti di union untuk dapet semua tagihan yang related dengan suatu order*/
/* bagian in imasih error karena ga ada pembayaran (input pembayaran error) */
/*pembayaran kurir*/
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
    inner join pembayaran_customer on pembayaran_customer.id_refrensi = invoice_core.id_submit_invoice;

/*end view */

show columns from pembayaran_customer;
create table pembayaran_customer like pembayaran;
insert pembayaran_customer select * from pembayaran;

truncate table pembayaran;
update tagihan set tagihan.status_lunas = 1;
truncate table pembayaran_customer;
update invoice_core set invoice_core.status_lunas = 1 where invoice_core.status_aktif_invoice = 0;

select * from pembayaran;
select * from pembayaran_customer;
