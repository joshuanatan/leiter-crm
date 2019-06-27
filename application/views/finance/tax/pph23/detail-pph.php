<div class="panel-body col-lg-12">
    <div class = "row">
        <div class="col-lg-3">
            <div class="card card-block p-25 bg-blue-600">
                <div class="counter counter-lg counter-inverse">
                    <div class="counter-label text-uppercase">TOTAL PPH</div>
                    <span class="counter-number"><?php echo number_format($jumlahPph);?></span>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>ID Tax</th>
                <th>Jumlah Pajak</th> <!-- yang ngelaurin invoice ini -->
                <th>ID Tagihan</th> <!-- ini yang tertulis. backgroundnya karena yang tertulis kadang belum termasuk pph 23-->
                <th>Bukti Bayar</th>
                <th>Invoice</th> <!-- invoice yang dikeluarin vendor -->
            </tr>
        </thead>
        <tbody>
            <?php $jumlahMasukan = 0;for($a =0; $a<count($pph); $a++):?>
            <tr>
                <td><?php echo $pph[$a]["id_tax"];?></td>
                <td><?php echo number_format($pph[$a]["jumlah_pajak"]);?></td>
                <td><a target = "_blank" href = "<?php echo base_url();?>finance/payable/"><?php echo $pph[$a]["no_tagihan"];?></a></td>
                <td><a target = "_blank" href = "<?php echo base_url();?>assets/dokumen/buktibayar/<?php echo $pph[$a]["bukti_bayar"];?>" class = "btn btn-primary btn-outline btn-sm">BUKTI BAYAR</a></td>
                <td><a target = "_blank" href = "<?php echo base_url();?>assets/dokumen/invoice/<?php echo $pph[$a]["invoice"];?>" class = "btn btn-primary btn-outline btn-sm">INCOME INVOICE</a> </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
    <div class = "form-group">
        <a href = "<?php echo base_url();?>finance/tax/pph23" class = "btn btn-outline btn-primary btn-sm">BACK</a>
    </div>
</div>