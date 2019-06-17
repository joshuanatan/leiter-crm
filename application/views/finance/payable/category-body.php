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
                <th>Company Name</th> <!-- yang ngelaurin invoice ini -->
                <th>Written Amount</th> <!-- ini yang tertulis. backgroundnya karena yang tertulis kadang belum termasuk pph 23-->
                <th>Amount</th> <!-- ini yang harus di bayarkan --> 
                <th>Notes</th> <!-- catetan aja seperti nomor rekening, dsb -->
                <th>Dateline Invoice</th>
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
                <td></td>
                <td>
                    <a href = "<?php echo base_url();?>finance/payable/edit/1" class = "btn btn-sm btn-primary btn-outline">EDIT</a>
                    <a href = "<?php echo base_url();?>finance/payable/remove/1" class = "btn btn-sm btn-primary btn-outline">REMOVE</a>
                    <button class = "btn btn-primary btn-sm btn-outline" type="button" data-toggle = "modal" data-target="#pay1">PAY</button>
                    <div class = "modal fade" id = "pay1">
                        <div class = "modal-dialog modal-xl">
                            <form action = "<?php echo base_url();?>finance/payable/pay/1" method = "POST">
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
                                            <h5 class = "opacity:0.5">Currency</h5>
                                            <input type = "text" class = "form-control">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Rate</h5>
                                            <input type = "text" class = "form-control">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Notes</h5>
                                            <textarea class = "form-control" readonly></textarea>
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Image</h5>
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
                    <button class = "btn btn-primary btn-sm btn-outline" type="button" data-toggle = "modal" data-target="#detailPayment1">DETAIL</button> <!-- muncul hanya saat uda pernah ada pembayaran -->
                    <div class = "modal fade" id = "detailPayment1">
                        <div class = "modal-dialog modal-xl">
                            <form action = "<?php echo base_url();?>finance/payable/pay/1" method = "POST">
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
                                            <h5 class = "opacity:0.5">Currency</h5>
                                            <input type = "text" class = "form-control">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Rate</h5>
                                            <input type = "text" class = "form-control">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Notes</h5>
                                            <textarea class = "form-control" readonly></textarea>
                                        </div>
                                        <div class = "form-group">
                                            <h5 class = "opacity:0.5">Image</h5>
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
                    <?php endif;?>
                </td>
            </tr>
        </tbody>
    </table>
</div>