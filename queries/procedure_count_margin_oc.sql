drop procedure if exists count_margin_oc;
DELIMITER //
CREATE PROCEDURE count_margin_oc(IN id_submit_oc int, OUT margin double(20,2))
BEGIN
	select @pemasukan, @pengeluaran;
    select sum(nominal_pembayaran) into @pemasukan from transaction_oc where status_transaksi = 'MASUK';
    select sum(nominal_pembayaran) into @pengeluaran from transaction_oc where status_transaksi = 'KELUAR';
    select ((@pemasukan-@pengeluaran)/@pemasukan)*100 into margin;
END //
DELIMITER ;
