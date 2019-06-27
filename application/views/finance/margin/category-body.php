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
                <th>Customer PO No</th> <!-- nanti ini keisi waktu nambahin OC-->
                <th>Order Confirmation No</th>
                <th>Items Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($oc); $a++):?>
            <tr>
                <td><?php echo $oc[$a]["no_po_customer"];?></td>
                <td><?php echo $oc[$a]["no_oc"];?></td>
                <td><?php echo $oc[$a]["items"];?> Items</td>
                <td>
                    <a href = "<?php echo base_url();?>finance/margin/detail/<?php echo $oc[$a]["id_oc"];?>" class = "btn btn-outline btn-sm btn-primary">Items Detail</a>
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>