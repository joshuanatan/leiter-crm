<div class="panel-body col-lg-12">
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>No Invoice</th>
                <th>No Refrensi</th>
                <th>Pihak Terlibat</th>
                <th>Total</th>
                <th>Mata Uang</th>
                <th>Kurs Pembayaran</th>
                <th>Total (Rupiah)</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($pembayaran); $a++):?>
            <tr>
                <td><?php echo $pembayaran[$a]["no_invoice"];?></td>
                <td><?php echo $pembayaran[$a]["no_refrence"];?></td>
                <td><?php echo $pembayaran[$a]["peruntukan_tagihan"];?></td>
                <td><?php echo number_format($pembayaran[$a]["total"]);?></td>
                <td><?php echo strtoupper($pembayaran[$a]["mata_uang"]);?></td>
                <td><?php echo number_format($pembayaran[$a]["kurs_pembayaran"]);?></td>
                <td><?php echo number_format($pembayaran[$a]["kurs_pembayaran"]*$pembayaran[$a]["total"]);?></td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
    <a href = "<?php echo base_url();?>finance/margin" class = "btn btn-sm btn-primary">BACK</a>
</div>