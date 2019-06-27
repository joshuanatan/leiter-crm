<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <button type = "button" data-toggle = "modal" data-target = "#insertPib" href = "<?php echo base_url();?>finance/reimburse/insert" class="btn btn-outline btn-primary">
                <i class="icon wb-plus" aria-hidden="true"></i> Insert Reimburse Request
            </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>No PIB</th>
                <th>PPN PIB</th> <!-- yang ngelaurin invoice ini -->
                <th>PPH23 PIB</th> <!-- ini yang tertulis. backgroundnya karena yang tertulis kadang belum termasuk pph 23-->
                <th>Bea Cukai</th> <!-- ini yang harus di bayarkan --> 
                <th>PIB Notes</th> <!-- catetan aja seperti nomor rekening, dsb -->
                <th>Attachment</th>
                <th>No Refrence</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($pib); $a++): ?>
            <tr>
                <td><?php echo $pib[$a]["no_pib"];?></td>
                <td><?php echo number_format($pib[$a]["ppn_impor"]);?></td>
                <td><?php echo number_format($pib[$a]["pph_impor"]);?></td>
                <td><?php echo number_format($pib[$a]["bea_cukai"]);?></td>
                <td><?php echo $pib[$a]["notes_pib"];?></td>
                <td>
                    <a target = "_blank" href = "<?php echo base_url();?>assets/dokumen/pib/<?php echo $pib[$a]["attachment"];?>" class = "btn btn-outline btn-primary btn-sm">DOCUMENT</a>
                </td>
                <td><?php echo $pib[$a]["no_po"];?></td>
                <td>
                    <?php if($pib[$a]["status_bayar_pib"] == 1): ?>
                    <button class = "btn btn-outline btn-sm btn-danger">NOT PAID</button>
                    <?php else:?>
                    <button class ="btn btn-outline btn-success btn-sm">PAID</button>
                    <?php endif;?>
                </td>
                <td>
                    

                    <?php if($pib[$a]["status_bayar_pib"] == 1):?> 
                    <button class = "btn btn-sm btn-primary btn-outline" data-toggle = "modal" data-target = "#pay<?php echo $a;?>">PAY</button>
                    <button class = "btn btn-sm btn-primary btn-outline" data-toggle = "modal" data-target = "#edit<?php echo $a;?>">EDIT</button>
                    <div class = "modal fade" id ="edit<?php echo $a;?>">
                        <div class = "modal-dialog modal-xl">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <h4 class = "modal-title">EDIT PIB</h4>
                                </div>
                                <form action = "<?php echo base_url();?>finance/tax/pib/edit/<?php echo $pib[$a]["id_pib"];?>" method ="POST" enctype = "multipart/form-data">
                                    <div class = "modal-body">
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">No PIB</h5>
                                            <input type ="text" class = "form-control" name = "no_pib" value = "<?php echo $pib[$a]["no_pib"];?>">
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">PPN Impor</h5>
                                            <input type ="text" class = "form-control" name = "ppn_impor" oninput = "commas('ppn_impor')" id = "ppn_impor" value = "<?php echo number_format($pib[$a]["ppn_impor"]);?>">
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">PPH Impor</h5>
                                            <input type ="text" class = "form-control" name = "pph_impor" oninput = "commas('pph_impor')" id = "pph_impor" value = "<?php echo number_format($pib[$a]["pph_impor"]);?>">
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">BEA Masuk</h5>
                                            <input type ="text" class = "form-control" name = "bea_masuk" oninput = "commas('bea_masuk')" id = "bea_masuk" value = "<?php echo number_format($pib[$a]["bea_cukai"]);?>">
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">Date PIB Input</h5>
                                            <input type = "date" name = "tgl_pib_masuk" class = "form-control" value = "<?php echo $pib[$a]["tgl_pib_masuk"];?>">
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">No Refrence</h5> <!-- no po (?) -->
                                            <input type ="text" class = "form-control" name = "no_refrence" value = "<?php echo $pib[$a]["no_po"];?>">
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">Notes</h5>
                                            <textarea class = "form-control" name = "notes_pib"><?php echo $pib[$a]["notes_pib"];?></textarea>
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">Attachment</h5>
                                            <input type = "file" class = "form-control" name = "attachment">
                                            <br/>
                                            <?php if($pib[$a]["attachment"] != "-"): ?>
                                                <a href = "<?php echo base_url();?>assets/dokumen/pib/<?php echo $pib[$a]["attachment"];?>" class = "btn btn-primary btn-outline btn-sm">DOCUMENT</a>
                                            <?php else:?>
                                                <button class = "btn btn-danger btn-outline btn-sm">NO DOCUMENT</button>
                                            <?php endif;?>
                                        </div>
                                        <div class = "form-group">
                                            <button class = "btn btn-outline btn-primary btn-sm" type = "submit">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class = "modal fade" id = "pay<?php echo $a;?>">
                        <div class = "modal-dialog modal-xl">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <h4 class = "modal-title">PAY</h4>
                                </div>
                                <form action ="<?php echo base_url();?>finance/tax/pib/pay/<?php echo $pib[$a]["id_pib"];?>" method = "POST" enctype = "multipart/form-data">
                                    <div class = "modal-body">
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">ID Refrence</h5> <!-- no PIB -->
                                            <input type = "text" class = "form-control" name = "id_refrensi" value = "<?php echo $pib[$a]["no_pib"];?>">
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">Payment Subject</h5>
                                            <input type = "text" class = "form-control" name = "subject_pembayaran">
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">Payment Date</h5>
                                            <input type = "date" class = "form-control" name = "tgl_bayar">
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">Payment Amount</h5>
                                            <input oninput = "commas('paymentAmount')" id = "paymentAmount" type = "text" class = "form-control" name = "nominal_pembayaran" value = "<?php echo number_format($pib[$a]["total_tagihan"]);?>">
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">Payment Method</h5>
                                            <select class = "form-control" name = "metode_pembayaran">
                                                <option value = "0">TRANSFER</option>
                                                <option value = "1">CASH</option>
                                            </select>
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">Payment Notes</h5>
                                            <textarea class = "form-control" name = "notes_pembayaran"></textarea>
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">Attachment</h5>
                                            <input type = "file" class = "form-control" name = "pay_attachment">
                                        </div>
                                        <div class = "form-group">
                                            <button class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a href = "<?php echo base_url();?>finance/tax/pib/remove/<?php echo $pib[$a]["id_pib"];?>" class = "btn btn-danger btn-outline btn-sm"><i class ="fa fa-trash"></i></a>
                    <?php else:?>
                    <button class = "btn btn-sm btn-primary btn-outline" data-toggle = "modal" data-target = "#detail<?php echo $a;?>">DETAIL</button>
                    <div class = "modal fade" id = "detail<?php echo $a;?>">
                        <div class = "modal-dialog modal-xl">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <h4 class = "modal-title">PAY</h4>
                                </div>
                                <div class = "modal-body">
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">No Refrensi</h5>
                                        <input readonly type = "text" class = "form-control" value = "<?php echo $pib[$a]["payment_detail"]["id_refrensi"];?>" name = "id_refrensi" readonly>
                                    </div>
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">Payment Subject</h5>
                                        <input readonly type = "text" class = "form-control" value = "<?php echo $pib[$a]["payment_detail"]["subject_pembayaran"];?>" name = "subject_pembayaran">
                                    </div>
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">Payment Date</h5>
                                        <input readonly type = "text" class = "form-control" name = "tgl_bayar" value = "<?php echo $pib[$a]["payment_detail"]["tgl_bayar"];?>">
                                    </div>
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">Payment Method</h5>
                                        <input readonly type = "text" class = "form-control" value = "<?php if($pib[$a]["payment_detail"]["metode_pembayaran"] == 1) echo "CASH"; else echo "TRANSFER";?>">
                                    </div>
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">Payment Amount</h5>
                                        <input readonly type = "text" class = "form-control" value = "<?php echo number_format($pib[$a]["payment_detail"]["nominal_pembayaran"]);?>">
                                    </div>
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">Attachment</h5>
                                        <a target = "_blank" href = "<?php echo base_url();?>assets/dokumen/buktibayar/<?php echo $pib[$a]["payment_detail"]["attachment"];?>" class = "btn btn-primary btn-sm btn-outline">DOCUMENT</a>
                                    </div>
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">Payment Notes</h5>
                                        <textarea class = "form-control" name = "notes_pembayaran" readonly><?php echo $pib[$a]["payment_detail"]["notes_pembayaran"];?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>
<div class = "modal fade" id = "insertPib">
    <div class = "modal-xl modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">INSERT PIB</h4>
            </div>
            <form action ="<?php echo base_url();?>finance/tax/pib/insert" method = "POST" enctype = "multipart/form-data">
                <div class = "modal-body"> 
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">No PIB</h5>
                        <input type ="text" class = "form-control" name = "no_pib">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">PPH Impor</h5>
                        <input type ="text" class = "form-control" name = "pph_impor" oninput = "commas('pph_impor')" id = "pph_impor">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">PPN Impor</h5>
                        <input type ="text" class = "form-control" name = "ppn_impor" oninput = "commas('ppn_impor')" id = "ppn_impor">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">BEA Masuk</h5>
                        <input type ="text" class = "form-control" name = "bea_masuk" oninput = "commas('bea_masuk')" id = "bea_masuk">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Date PIB Input</h5>
                        <input type = "date" name = "tgl_pib_masuk" class = "form-control">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">No Refrence</h5> <!-- no po (?) -->
                        <input type ="text" class = "form-control" name = "no_refrence">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Notes</h5>
                        <textarea class = "form-control" name = "notes_pib"></textarea>
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Attachment</h5>
                        <input type = "file" class = "form-control" name = "attachment">
                    </div>
                    <div class = "form-group">
                        <button class = "btn btn-outline btn-primary btn-sm" type = "submit">SUBMIT</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>