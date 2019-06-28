<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
                <!--<a class = "btn btn-primary btn-outline" href = "<?php echo base_url();?>crm/po/create">Create Purchase Order</a>-->
                <button class = "btn btn-primary btn-outline" data-toggle = "modal" data-target = "#addPO">Create Purchase Order</button>
                <button class = "btn btn-primary btn-outline" data-toggle = "modal" data-target = "#addPO">Purchase Order for Stock</button>
                <!--
                <a class = "btn btn-primary btn-outline" href = "<?php echo base_url();?>crm/po/stock">Purchase Order for Stock</a>-->
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
                <th>Order Confirmation</th>
                <th>Issued Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($purchase_order);$a++): ?>
            <tr class="gradeA">
                <td><?php echo $purchase_order[$a]["no_po"];?></td>
                <td><?php echo $purchase_order[$a]["supplier"];?></td>
                <td><?php echo $purchase_order[$a]["shipper"];?></td>
                <td><?php echo $purchase_order[$a]["items_amount"];?></td>
                <td>OC-<?php echo sprintf("%05d",$purchase_order[$a]["id_oc"]);?></td>
                <td><?php echo $purchase_order[$a]["issued_date"];?></td>
                <td class="actions">
                    <button class = "btn btn-outline btn-success" data-content="View PO Details" data-trigger="hover" data-toggle="popover"><i class = "icon wb-menu" data-toggle="modal" data-target="#DetailPO" aria-hidden="true"></i></button>
                </td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>
<div class = "modal fade" id = "addPO">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">CREATE PURCHASE ORDER</h4>
            </div>
            <div class = "modal-body">
                <div class = "form-group">
                    <h5 style = "opacity:0.5">NO PO</h5>
                    <input type = "text" class = "form-control" name = "no_po">
                </div>
                <div class = "form-group">
                    <h5 style = "opacity:0.5">ID PO Customer</h5>
                    <select class = "form-control" name = "po_customer">
                        <option>PO/CUST/001/180</option>
                    </select>
                </div>
                <div class = "form-group">
                    <h5 style = "opacity:0.5">Supplier</h5>
                    <input type = "text" class = "form-control" name = "no_po">
                </div>
                <div class = "form-group">
                    <h5 style = "opacity:0.5">Shipper</h5>
                    <input type = "text" class = "form-control" name = "no_po">
                </div>
                <div class = "form-group">
                    <h5 style = "opacity:0.5">Shipping Method</h5>
                    <input type = "text" class = "form-control" name = "no_po">
                </div>
                <div class = "form-group">
                    <table class = "table table-bordered table-stripped" style = "Width:100%" data-plugin = "dataTable">
                        <thead>
                            <th>#</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </thead>
                        <tbody>
                            <?php for($a = 0; $a<15; $a++):?>
                            <tr>
                                <td>
                                    <div class = "checkbox-custom checkbox-primary">
                                        <input type = "checkbox">
                                        <label></label>
                                    </div>
                                </td>
                                <td><input type = "text" class = "form-control" name = "" value = "Item<?php echo ($a+1);?>"></td>
                                <td><input type = "text" class = "form-control" name = ""></td>
                                <td><input type = "text" class = "form-control" name = ""></td>
                            </tr>
                            <?php endfor;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>