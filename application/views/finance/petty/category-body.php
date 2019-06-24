<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <a href = "<?php echo base_url();?>finance/reimburse/insert" class="btn btn-outline btn-primary" data-toggle = "modal" data-target = "#addPetty">
                <i class="icon wb-plus" aria-hidden="true"></i> Insert Petty Transaction
            </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>No Transaction</th>
                <th>User Name</th> <!-- yang ngelaurin invoice ini -->
                <th>Transaction Subject</th> 
                <th>Amount</th> <!-- ini yang tertulis. backgroundnya karena yang tertulis kadang belum termasuk pph 23-->
                <th>Expanses Type</th> <!-- ini yang harus di bayarkan --> 
                <th>Notes</th> <!-- catetan aja seperti nomor rekening, dsb -->
                <th>Bon</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($petty); $a++): ?>
            <tr>
                <td><?php echo $petty[$a]["id_transaksi_petty"];?></td>
                <td><?php echo $petty[$a]["user_name"];?></td>
                <td><?php echo $petty[$a]["subject"];?></td>
                <td><?php echo number_format($petty[$a]["amount"]);?></td>
                <td><?php echo $petty[$a]["nama_expanses"];?></td>
                <td><?php echo $petty[$a]["notes"];?></td>
                <td>
                    <?php if($petty[$a]["attachment"] != "-"):?>
                    <a target = "_blank" href = "<?php echo base_url();?>assets/dokumen/petty/<?php echo $petty[$a]["attachment"];?>" class = "btn btn-primary btn-outline btn-sm">DOCUMENT</a>
                    <?php else:?>
                    <button class = "btn btn-danger btn-outline btn-sm">NO DOCUMENT</button>
                    <?php endif;?>
                </td>
                <td>
                    <a href = "<?php echo base_url();?>finance/petty/remove/<?php echo $petty[$a]["id_transaksi_petty"];?>" class = "btn btn-sm btn-primary btn-outline">REMOVE</a> <!-- yang remove requester dan finance-->

                    <button class = "btn btn-primary btn-sm btn-outline" type="button" data-toggle = "modal" data-target="#edit<?php echo $a;?>">EDIT</button> <!-- acceptance dari finance -->
                    <div class = "modal fade" id = "edit<?php echo $a;?>">
                        <div class = "modal-dialog modal-xl">
                            <div class = "modal-content">
                                <form action = "<?php echo base_url();?>finance/petty/update/<?php echo $petty[$a]["id_transaksi_petty"];?>" method = "POST" enctype = "multipart/form-data">
                                    <div class ="modal-body">
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Transaction Date</h5>
                                            <input type = "date" class = "form-control" name = "tgl_transaksi" value = <?php echo $petty[$a]["tgl_transaksi"];?>>
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Payment Subject</h5>
                                            <input type = "text" class = "form-control" name = "subject" value = <?php echo $petty[$a]["subject"];?>>
                                        </div>
                                        <div class = "form-group">
                                            <h5 style = "opacity:0.5">Expanses</h5>
                                            <select class = "form-control" name = "expanses">
                                                <?php for($b = 0; $b<count($expanses_type); $b++):?>
                                                <option value = "<?php echo $expanses_type[$b]["id_type"];?>"<?php if($expanses_type[$b]["id_type"] == $petty[$a]["expanses_type"]) echo "selected";?>><?php echo $expanses_type[$b]["name_type"];?></option>
                                                <?php endfor;?>
                                            </select>
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Payment Amount</h5>
                                            <input type = "text" class = "form-control" oninput = "commas('amountEdit')" id = "amountEdit" name = "amount" value = <?php echo number_format($petty[$a]["amount"]);?>>
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Notes</h5>
                                            <textarea class = "form-control" name = "notes"><?php echo $petty[$a]["notes"];?></textarea>
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Attachment</h5> <!-- bukti bayar -->
                                            <input type = "file" class = "form-control" name = "attachment">
                                        </div>
                                        <div class = "form-group">
                                            <button type = "submit" class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                                        </div>
                                    </div>
                                    <div class = "modal-footer">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>
<div class = "modal fade" id = "addPetty">
    <div class = "modal-dialog modal-xl">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class ="modal-title">INSERT PETTY CASH</h4>
            </div>
            <form action = "<?php echo base_url();?>finance/petty/insert" method = "POST" enctype = "multipart/form-data">
                <div class = "modal-body">
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Subject</h5>
                        <input type = "text" class = "form-control" name = "subject">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Expanses</h5>
                        <select class = "form-control" name = "expanses">
                            <?php for($a = 0; $a<count($expanses_type); $a++):?>
                            <option value = "<?php echo $expanses_type[$a]["id_type"];?>"><?php echo $expanses_type[$a]["name_type"];?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Amount</h5>
                        <input type = "text" oninput = "commas('amount')" id ="amount" class = "form-control" name = "amount">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Notes</h5>
                        <textarea class = "form-control" name = "notes"></textarea>
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Attachment</h5>
                        <input type = "file" class = "form-control" name = "attachment">
                    </div>
                    <div class = "form-group">
                        <button type = "submit" class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>