<div class="panel-body col-lg-12">
    <div class = "row">
        <div class = "col-lg-12">
            <button type = "button" class = "btn btn-sm btn-primary" data-toggle = "modal" data-target = "#transaksiTambahan">Transaksi Tambahan</button>
            <br/><br/>
        </div>
    </div>
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

<div class = "modal fade" id = "transaksiTambahan">
    <div class = "modal-dialog modal-xl">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">DO PAYMENT</h4>
            </div>
            <div class ="modal-body">
                <form action = "<?php echo base_url();?>finance/margin/transaksitambahan" method = "POST" enctype = "multipart/form-data">
                    <div class = "form-group">
                        <h5 class = "opacity:0.5">No Refrence</h5>
                        <input type = "text" class = "form-control" name = "no_refrence" value = "">
                    </div>
                    <div class = "form-group">
                        <h5 class = "opacity:0.5">Pihak yang Terkait</h5>
                        <select class = "form-control" name = "peruntukan_tagihan">
                            <option value = "CUSTOMER">CUSTOMER</option>
                            <option value = "SUPPLIER">SUPPLIER</option>
                            <option value = "SHIPPER">SHIPPER</option>
                            <option value = "COURIER">COURIER</option>
                            <option value = "LAIN-LAIN">LAIN-LAIN</option>
                        </select>
                    </div>
                    
                    <div class = "form-group">
                        <input type = "hidden" class = "form-control" name = "id_submit_oc" value = "<?php echo $pembayaran[0]["id_submit_oc"];?>" readonly>
                    </div>
                    <div>
                        <h5 class = "opacity:0.5">Payment Subject</h5>
                        <input required type = "text" class = "form-control" name = "subject_pembayaran">
                    </div>
                    <div class = "form-group">
                        <h5 class = "opacity:0.5">Payment Date</h5>
                        <input required type = "date" class = "form-control" name = "tgl_bayar">
                    </div>
                    <div class = "form-group">
                        <h5 class = "opacity:0.5">Payment Amount</h5>
                        <input required type = "text" class = "form-control" name = "nominal_pembayaran" id="paymentAmount" value = "" oninput = "commas('paymentAmount')">
                    </div>
                    <div class = "form-group">
                        <h5 class = "opacity:0.5">Rate</h5>
                        <input required type = "text" oninput = "commas('paymentRate')" id = "paymentRate" placeholder = "Kurs mata uang pembayaran ke IDR. 1 untuk IDR ke IDR" class = "form-control" name = "kurs_pembayaran">
                    </div>
                    <div class = "form-group">
                        <h5 class = "opacity:0.5">Mata Uang Pembayaran</h5>
                        <input required type = "text" class = "form-control" name = "mata_uang_pembayaran" placeholder = "Mata uang pembayaran" >
                    </div>
                    <div class = "form-group">
                        <h5 class = "opacity:0.5">Payment Method</h5>
                        <select name = "metode_pembayaran" class = "form-control" data-plugin = "select2">
                            <option value = "0">TRANSFER</option>
                            <option value = "1">CASH</option>
                        </select>
                    </div>
                    <div class = "form-group">
                        <h5 class = "opacity:0.5">Status Pembayaran</h5>
                        <select name = "status_pembayaran" class = "form-control" data-plugin = "select2">
                            <option value = "0">MASUK</option>
                            <option value = "1">KELUAR</option>
                        </select>
                    </div>
                    <div class = "form-group">
                        <h5 class = "opacity:0.5">Attachment</h5>
                        <input type = "file" class = "form-control" name = "attachment">
                    </div>
                    <div class = "form-group">
                        <button type = "submit" class = "btn btn-primary col-lg-2 btn-outline btn-sm">SUBMIT</button>
                    </div>
            </form>
                </div>
        </div>
    </div>
</div>