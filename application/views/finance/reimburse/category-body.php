<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <a href = "<?php echo base_url();?>finance/reimburse/insert" class="btn btn-outline btn-primary">
                <i class="icon wb-plus" aria-hidden="true"></i> Insert Reimburse Request
            </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>No Request</th>
                <th>User Name</th> <!-- yang ngelaurin invoice ini -->
                <th>Amount</th> <!-- ini yang tertulis. backgroundnya karena yang tertulis kadang belum termasuk pph 23-->
                <th>Expanses Type</th> <!-- ini yang harus di bayarkan --> 
                <th>Notes</th> <!-- catetan aja seperti nomor rekening, dsb -->
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href = "<?php echo base_url();?>finance/reimburse/edit/1" class = "btn btn-sm btn-primary btn-outline">EDIT</a> <!-- yang ngedit requester -->
                    <a href = "<?php echo base_url();?>finance/reimburse/remove/1" class = "btn btn-sm btn-primary btn-outline">REMOVE</a> <!-- yang remove requester dan finance-->
                    <button class = "btn btn-primary btn-sm btn-outline" type="button" data-toggle = "modal" data-target="#pay1">PAY</button> <!-- acceptance dari finance -->
                    <div class = "modal fade" id = "pay1">
                        <div class = "modal-dialog modal-xl">
                            <form action = "<?php echo base_url();?>finance/reimburse/pay/1" method = "POST">
                                <div class = "modal-content">
                                    <div class = "modal-header">
                                        <h4 class = "modal-title">DO PAYMENT</h4>

                                    </div>
                                    <div class ="modal-body">
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Payment Date</h5>
                                            <input type = "date" class = "form-control">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Payment Method</h5>
                                            <select class = "form-control">
                                                <option value = "BANK">TRANSFER</option>
                                                <option value = "CASH">CASH</option>
                                            </select>
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Payment Amount</h5>
                                            <input type = "text" class = "form-control">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Notes</h5>
                                            <textarea class = "form-control" readonly></textarea>
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Image</h5> <!-- bukti bayar -->
                                            <input type = "file" class = "form-control">
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
                    <?php if(false):?>
                    <button class = "btn btn-primary btn-sm btn-outline" type="button" data-toggle = "modal" data-target="#detailPayment1">DETAIL</button> <!-- muncul hanya saat uda pernah ada pembayaran semua bisa liat-->
                    <div class = "modal fade" id = "detailPayment1">
                        <div class = "modal-dialog modal-xl">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <h4 class = "modal-title">PAYMENT DETAIL</h4>
                                </div>
                                <div class ="modal-body">
                                    <div class = "form-group">
                                        <h5 class = "opacity:0.5">Payment Date</h5>
                                        <input type = "date" class = "form-control">
                                    </div>
                                    <div class = "form-group">
                                        <h5 class = "opacity:0.5">Payment Method</h5>
                                        <select class = "form-control">
                                        <input type = "text" class = "form-control" readonly>
                                        </select>
                                    </div>
                                    <div class = "form-group">
                                        <h5 class = "opacity:0.5">Payment Amount</h5>
                                        <input type = "text" class = "form-control">
                                    </div>
                                    <div class = "form-group">
                                        <h5 class = "opacity:0.5">Image</h5> <!-- bukti bayar -->
                                        <input type = "file" class = "form-control">
                                    </div>
                                    <div class = "form-group">
                                        <button type = "submit" class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                                    </div>
                                </div>
                                <div class = "modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                </td>
            </tr>
        </tbody>
    </table>
</div>