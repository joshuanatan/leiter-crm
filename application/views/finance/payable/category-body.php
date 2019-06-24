<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <a href = "<?php echo base_url();?>finance/payable/insert" class="btn btn-outline btn-primary">
                <i class="icon wb-plus" aria-hidden="true"></i> Insert Invoice
            </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>No Invoice</th>
                <th>No Refrence</th>
                <th>Company Name</th> <!-- yang ngelaurin invoice ini -->
                <th>Amount</th>
                <th>Currency</th> <!-- ini yang harus di bayarkan --> 
                <th>Attachment</th> <!-- catetan aja seperti nomor rekening, dsb -->
                <th>Dateline Invoice</th>
                <th>Notes</th> <!-- catetan aja seperti nomor rekening, dsb -->
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($tagihan);$a++): ?>
            <tr>
                <td><?php echo $tagihan[$a]["no_invoice"];?></td>
                <td><?php echo $tagihan[$a]["no_refrence"];?></td>
                <td><?php echo $tagihan[$a]["nama_target"];?></td>
                <td><?php echo number_format($tagihan[$a]["total"]);?></td>
                <td><?php echo $tagihan[$a]["mata_uang"];?></td>
                <td>
                    <a target = "_blank" class = "btn btn-primary btn-sm btn-outline" href = "<?php echo base_url();?>assets/dokumen/invoice/<?php echo $tagihan[$a]["attachment"];?>">DOCUMENT</a>
                </td>
                <td><?php echo $tagihan[$a]["dateline_invoice"];?></td>
                <td>
                    <button type = "button" class = "btn btn-outline btn-sm btn-primary" data-target ="#notes<?php echo $a;?>" data-toggle = "modal">NOTES</button>
                    <div class = "modal fade" id ="notes<?php echo $a;?>">
                        <div class = "modal-dialog modal-xl">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <h4 class = "modal-title">INVOICE NOTES</h4>
                                </div>
                                <div class = "modal-body">
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">NOTES</h5>
                                        <textarea class = "form-control" readonly><?php echo $tagihan[$a]["notes"];?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <?php if($tagihan[$a]["status_lunas"] == 0):?>
                    <button class = "btn btn-success btn-outline btn-sm">PAID</button>
                    <?php else:?>
                    <button class = "btn btn-danger btn-outline btn-sm">NOT PAID</button>
                    <?php endif;?>
                </td>
                <td>
                    <a href = "<?php echo base_url();?>finance/payable/edit/<?php echo $tagihan[$a]["id_tagihan"];?>" class = "btn btn-sm btn-primary btn-outline">EDIT</a>
                    <a href = "<?php echo base_url();?>finance/payable/remove/<?php echo $tagihan[$a]["id_tagihan"];?>" class = "btn btn-sm btn-primary btn-outline">REMOVE</a>

                    <button class = "btn btn-primary btn-sm btn-outline" type="button" data-toggle = "modal" data-target="#pay<?php echo $tagihan[$a]["id_tagihan"];?>">PAY</button>
                    <div class = "modal fade" id = "pay<?php echo $tagihan[$a]["id_tagihan"];?>">
                        <div class = "modal-dialog modal-xl">
                            <form action = "<?php echo base_url();?>finance/payable/pay/<?php echo $tagihan[$a]["id_tagihan"];?>" method = "POST">
                                <div class = "modal-content">
                                    <div class = "modal-header">
                                        <h4 class = "modal-title">DO PAYMENT</h4>

                                    </div>
                                    <div class ="modal-body">
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">No Refrence</h5>
                                            <input type = "text" class = "form-control" name = "id_refrensi" value = "<?php echo $tagihan[$a]["no_refrence"];?>" readonly>
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Payment Subject</h5>
                                            <input type = "text" class = "form-control" name = "subject_pembayaran">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Payment Date</h5>
                                            <input type = "date" class = "form-control" name = "tgl_bayar">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Payment Amount</h5>
                                            <input type = "text" class = "form-control" name = "nominal_pembayaran" id="paymentAmount<?php echo $a;?>" value = "<?php echo number_format($tagihan[$a]["total"]);?>" oninput = "commas('paymentAmount<?php echo $a;?>')">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Rate</h5>
                                            <input type = "text" oninput = "commas('paymentRate<?php echo $a;?>')" id = "paymentRate<?php echo $a;?>" class = "form-control" name = "kurs_pembayaran">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Currency</h5>
                                            <input type = "text" class = "form-control" <?php echo $tagihan[$a]["mata_uang"];?> name = "mata_uang_pembayaran">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Notes</h5>
                                            <textarea class = "form-control" name = "notes_pembayaran"></textarea>
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Attachment</h5>
                                            <input type = "file" class = "form-control" name = "attachment">
                                        </div>
                                        <div class = "form-group">
                                            <button type = "submit" class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if($tagihan[$a]["status_lunas"] == 0):?>
                    <button class = "btn btn-primary btn-sm btn-outline" type="button" data-toggle = "modal" data-target="#detailPayment<?php echo $a;?>">DETAIL</button> <!-- muncul hanya saat uda pernah ada pembayaran -->
                    <div class = "modal fade" id = "detailPayment<?php echo $a;?>">
                        <div class = "modal-dialog modal-xl">
                            <form action = "<?php echo base_url();?>finance/payable/pay/<?php echo $tagihan[$a]["id_tagihan"];?>" method = "POST">
                                <div class = "modal-content">
                                    <div class = "modal-header">
                                        <h4 class = "modal-title">DO PAYMENT</h4>

                                    </div>
                                    <div class ="modal-body">
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Payment Date</h5>
                                            <input type = "date" class = "form-control" name = "tgl_bayar">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Payment Amount</h5>
                                            <input type = "text" class = "form-control" name = "nominal_pembayaran">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Rate</h5>
                                            <input type = "text" class = "form-control" name = "kurs_pembayaran">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Currency</h5>
                                            <input type = "text" class = "form-control" name = "mata_uang_pembayaran">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Notes</h5>
                                            <textarea class = "form-control" readonly name = "notes_pembayaran"></textarea>
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Attachment</h5>
                                            <input type = "file" class = "form-control" name = "attachment">
                                        </div>
                                        <div class = "form-group">
                                            <button type = "submit" class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                                        </div>
                                    </div>
                                    <div class = "modal-footer">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endif;?>
                </td>
                <?php endfor;?>
            </tr>
        </tbody>
    </table>
</div>