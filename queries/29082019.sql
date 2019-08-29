select 
bulan_transaksi,
tahun_transaksi,
sum(total_pembayaran) as total_pembayaran
from cashflow_overview
group by bulan_transaksi,tahun_transaksi;


SELECT sum(total_pembayaran) as total_pembayaran, `bulan_transaksi`, `tahun_transaksi` FROM `cashflow_overview` WHERE `tahun_transaksi` = '2019' AND `total_pembayaran` > 0 GROUP BY `bulan_transaksi`;
SELECT sum(total_pembayaran) as total_pembayaran, `bulan_transaksi`, `tahun_transaksi` FROM `cashflow_overview` WHERE `tahun_transaksi` = '2019' AND `total_pembayaran` < 0 GROUP BY `bulan_transaksi`;