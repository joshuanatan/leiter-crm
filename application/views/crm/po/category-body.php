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
