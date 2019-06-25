<div class="panel-body col-lg-12">
    <div class = "row">
        <div class="col-lg-3">
            <div class="card card-block p-25 bg-blue-600">
                <div class="counter counter-lg counter-inverse">
                    <div class="counter-label text-uppercase">TOTAL PPN MASUKAN</div>
                    <span class="counter-number">1,000,000</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-block p-25 bg-blue-600">
                <div class="counter counter-lg counter-inverse">
                    <div class="counter-label text-uppercase">TOTAL PPN KELUARAN</div>
                    <span class="counter-number">500,000</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-block p-25 bg-blue-600">
                <div class="counter counter-lg counter-inverse">
                    <div class="counter-label text-uppercase">SELISIH</div>
                    <span class="counter-number">500,000</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-block p-25 bg-blue-600">
                <div class="counter counter-lg counter-inverse">
                    <div class="counter-label text-uppercase">YANG LEBIH BESAR</div>
                    <span class="counter-number">MASUKAN</span>
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
                <th>ID Refrensi</th> <!-- ini yang tertulis. backgroundnya karena yang tertulis kadang belum termasuk pph 23-->
                <th>Invoice</th> <!-- invoice yang dikeluarin vendor -->
            </tr>
        </thead>
        <tbody>
            <?php for($a =0; $a<count($tax); $a++):?>
            <?php if($tax[$a]["tipe_pajak"] == "MASUKAN"):?>
            <tr>
                <td><?php echo $tax[$a]["id_tax"];?></td>
                <td><?php echo $tax[$a]["jumlah_pajak"];?></td>
                <td><?php echo $tax[$a]["id_refrensi"];?> </td>
                <td><a href = "_blank" href = "<?php echo base_url();?>assets/dokumen/invoice/<?php echo $tax[$a]["id_refrensi"];?>" class = "btn btn-primary btn-outline btn-sm">INCOME INVOICE</a> </td>
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
                <th>ID Refrensi</th> <!-- ini yang tertulis. backgroundnya karena yang tertulis kadang belum termasuk pph 23-->
            </tr>
        </thead>
        <tbody>
            <?php for($a =0; $a<count($tax); $a++):?>
            <?php if($tax[$a]["tipe_pajak"] == "KELUARAN"):?>
            <tr>
                <td><?php echo $tax[$a]["id_tax"];?></td>
                <td><?php echo $tax[$a]["jumlah_pajak"];?></td>
                <td><?php echo $tax[$a]["id_refrensi"];?> </td>
            </tr>
            <?php endif;?>
            <?php endfor;?>
        </tbody>
    </table>
</div>