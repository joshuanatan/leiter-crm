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
