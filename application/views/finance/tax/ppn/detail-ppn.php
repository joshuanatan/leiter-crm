<?php $jumlahMasukan = 0; $jumlahKeluaran = 0;
for($a =0; $a<count($tax); $a++){
    if($tax[$a]["tipe_pajak"] == "MASUKAN"){ /*ppn masukan*/
        $jumlahMasukan += $tax[$a]["jumlah_pajak"];
    }
    else{/*ppn keluaran*/
        $jumlahKeluaran += $tax[$a]["jumlah_pajak"];
    }
}
?>
<div class="panel-body col-lg-12">
    <div class = "row">
        <div class="col-lg-3">
            <div class="card card-block p-25 bg-blue-600">
                <div class="counter counter-lg counter-inverse">
                    <div class="counter-label text-uppercase">TOTAL PPN MASUKAN</div>
                    <span class="counter-number"><?php echo number_format($jumlahMasukan);?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-block p-25 bg-blue-600">
                <div class="counter counter-lg counter-inverse">
                    <div class="counter-label text-uppercase">TOTAL PPN KELUARAN</div>
                    <span class="counter-number"><?php echo number_format($jumlahKeluaran);?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-block p-25 bg-blue-600">
                <div class="counter counter-lg counter-inverse">
                    <div class="counter-label text-uppercase">SELISIH</div>
                    <span class="counter-number">
                        <?php if($jumlahKeluaran > $jumlahMasukan) echo number_format(($jumlahKeluaran-$jumlahMasukan)); else echo number_format(($jumlahMasukan-$jumlahKeluaran));?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-block p-25 bg-blue-600">
                <div class="counter counter-lg counter-inverse">
                    <div class="counter-label text-uppercase">YANG LEBIH BESAR</div>
                    <span class="counter-number">
                        <?php if($jumlahKeluaran > $jumlahMasukan) echo "KELUARAN"; else echo "MASUKAN";?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class = "col-lg-12">
            <H5>PPN MASUKAN</H5>
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
            <?php $jumlahMasukan = 0;for($a =0; $a<count($tax); $a++):?>
            <?php if($tax[$a]["tipe_pajak"] == "MASUKAN"): $jumlahMasukan += $tax[$a]["jumlah_pajak"];?>
            <tr>
                <td><?php echo $tax[$a]["id_tax"];?></td>
                <td><?php echo number_format($tax[$a]["jumlah_pajak"]);?></td>
                <td>
                    <?php if($tax[$a]["is_pib"] != 0):?>
                    <a target = "_blank" href = "<?php echo base_url();?>finance/payable/"><?php echo $ppn[$a]["no_tagihan"];?></a>
                    <?php else:?>
                    <a target = "_blank" href = "<?php echo base_url();?>finance/tax/pib/"><?php echo $ppn[$a]["no_tagihan"];?></a>
                    <?php endif;?>
                </td>
                <td>
                    <a target = "_blank" href = "<?php echo base_url();?>assets/dokumen/buktibayar/<?php echo $tax[$a]["bukti_bayar"];?>" class = "btn btn-primary btn-outline btn-sm">BUKTI BAYAR</a>
                </td>

                <td>
                    <?php if($tax[$a]["is_pib"] != 0):?>
                    <a target = "_blank" href = "<?php echo base_url();?>assets/dokumen/invoice/<?php echo $tax[$a]["invoice"];?>" class = "btn btn-primary btn-outline btn-sm">INCOME INVOICE</a> 
                    <?php else:?>
                    <a target = "_blank" href = "<?php echo base_url();?>assets/dokumen/pib/<?php echo $tax[$a]["invoice"];?>" class = "btn btn-primary btn-outline btn-sm">PIB INVOICE</a> 
                    <?php endif;?>
                </td>
            </tr>
            <?php endif;?>
            <?php endfor;?>
        </tbody>
    </table>
    <br/><br/>
    <HR/>
    <br/><br/>
    <div class="row">
        <div class = "col-lg-12">
            <H5>PPN KELUARAN</H5>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
    <thead>
            <tr>
            <th>ID Tax</th>
                <th>Jumlah Pajak</th> <!-- yang ngelaurin invoice ini -->
                <th>ID Tagihan</th> <!-- ini yang tertulis. backgroundnya karena yang tertulis kadang belum termasuk pph 23-->
                <th>Bukti Bayar</th>
             
            </tr>
        </thead>
        <tbody>
            <?php for($a =0; $a<count($tax); $a++):?>
            <?php if($tax[$a]["tipe_pajak"] == "KELUARAN"):?>
            <tr>
                <td><?php echo $tax[$a]["id_tax"];?></td>
                <td><?php echo number_format($tax[$a]["jumlah_pajak"]);?></td>
                <td>
                    <a target = "_blank" href = "<?php echo base_url();?>finance/receivable/"><?php echo $ppn[$a]["no_tagihan"];?></a>
                </td>
                <td>
                    <a target = "_blank" href = "<?php echo base_url();?>assets/dokumen/buktibayar/<?php echo $tax[$a]["bukti_bayar"];?>" class = "btn btn-primary btn-outline btn-sm">BUKTI BAYAR</a>
                </td>

            </tr>
            <?php endif;?>
            <?php endfor;?>
        </tbody>
    </table>
    <div class = "form-group">
        <a href = "<?php echo base_url();?>finance/tax/ppn" class = "btn btn-outline btn-primary btn-sm">BACK</a>
    </div>
</div>