<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
                <a class = "btn btn-primary btn-outline" href = "<?php echo base_url();?>crm/po/create">Create Purchase Order</a>
                <a class = "btn btn-primary btn-outline" href = "<?php echo base_url();?>crm/po/stock">Purchase Order for Stock</a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <!-- List OC yang sudah di selesaikan -->
        <thead>
            <tr>
                <th>Purchase Order ID</th>
                <th>Supplier Firm</th>
                <th>Shipper Firm</th>
                <th>Items Amount</th>
                <th>Issued Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr class="gradeA">
                <?php for($a = 0; $a<count($purchase_order);$a++): ?>
                <td><?php echo $purchase_order[$a]["no_po"];?></td>
                <td><?php echo $purchase_order[$a]["supplier"];?></td>
                <td><?php echo $purchase_order[$a]["shipper"];?></td>
                <td><?php echo $purchase_order[$a]["items_amount"];?></td>
                <td><?php echo $purchase_order[$a]["issued_date"];?></td>
                <td class="actions">
                    <button class = "btn btn-outline btn-success" data-content="View PO Details" data-trigger="hover" data-toggle="popover"><i class = "icon wb-menu" data-toggle="modal" data-target="#DetailPO" aria-hidden="true"></i></button>
                </td>
                <?php endfor; ?>
            </tr>
        </tbody>
    </table>
</div>
<div class="modal fade" id="DetailPO" aria-hidden="false" aria-labelledby="TambahRequestLabel" role="dialog">
    <div class="modal-dialog modal-simple">
        <form class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleFormModalLabel">Price Request</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" value="PO-001" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" value="OC-001" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <label>Shipper</label>
                        <input type="text" class="form-control" name="firstName" value="SHP-001" readonly><br/>
                        <input type="text" class="form-control" name="firstName" value="Garuda Packages" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <label>Dateline</label>
                        <input type="text" class="form-control" name="firstName" value="23/11/2019" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <select class = "form-control" placeholder="Last Name" data-plugin="select2">
                            <option selected disabled>Choose Shipping Vendor ID</option> <!-- kalau pilih yang ini, auto generate nomor quotation baru -->
                            <option>SHP-001</option> <!--kalau pilih yang ini, auto generate revisi ke berapa -->
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" placeholder="Shipping Vendor Name">
                    </div>
                    <div class="col-xl-12 form-group">
                        <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="DataPesanan">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Vendor Price</th>
                                </tr>
                            </thead>
                            <tbody id = "t1">
                                <tr class='gradeA'>
                                    <td>Meja Tulis</td>
                                    <td>5</td>
                                    <td>15.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>