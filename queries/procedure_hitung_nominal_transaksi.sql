select * from pembayaran_invoice;
drop procedure if exists hitung_nominal_transaksi;
DELIMITER //
create procedure hitung_nominal_transaksi(IN tahun int, in bulan varchar(2), out nominal double(20,3))
BEGIN
select sum(total_pembayaran) into nominal from pembayaran_invoice where  bulan_invoice = bulan and tahun_invoice = tahun;
END //
DELIMITER ;

call hitung_nominal_transaksi(2019,'08',@nominal);
select 
if(@nominal is null,0, @nominal);
