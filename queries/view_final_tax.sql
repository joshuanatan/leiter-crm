CREATE VIEW `final_tax` AS 
select 
`tax`.`id_tax` AS `id_tax`,
`tax`.`bulan_pajak` AS `bulan_pajak`,
`tax`.`tahun_pajak` AS `tahun_pajak`,
`tax`.`jumlah_pajak` AS `jumlah_pajak`,
`tax`.`tipe_pajak` AS `tipe_pajak`,
`tax`.`jenis_pajak` AS `jenis_pajak`,
`tax`.`status_aktif_pajak` AS `status_aktif_pajak`,
`tax`.`id_refrensi` AS `id_refrensi`,
`tax`.`is_pib` AS `is_pib`,
`tax`.`no_faktur_pajak` AS `no_faktur_pajak`,
`tax`.`tgl_input_faktur` AS `tgl_input_faktur`,
`tax`.`id_submit_oc` AS `id_submit_oc`,
`tax`.`attachment` AS `attachment` 
from `tax` 
where 
`tax`.`no_faktur_pajak` is not null 
and `tax`.`tgl_input_faktur` is not null;
