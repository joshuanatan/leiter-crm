<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <a href = "<?php echo base_url();?>crm/invoice/create" class="btn btn-outline btn-primary">
                <i class="icon wb-plus" aria-hidden="true"></i> Create Invoice
            </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>No Invoice</th>
                <th>Invoice Percentage</th>
                <th>Invoice Amount</th>
                <th>Purpose</th>
                <th>No Order Confirmation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0 ; $a<count($invoice); $a++): ?>
            <tr class="gradeA">
                
                <td><?php echo $invoice[$a]["no_invoice"];?></td>
                <td><?php echo $invoice[$a]["persen_pembayaran"];?>%</td>
                <td><?php echo number_format($invoice[$a]["nominal_pembayaran"]);?></td>
                <td><?php echo $invoice[$a]["purpose"];?></td>
                <td><?php echo $invoice[$a]["no_oc"];?></td>
                <td class="actions">
                    
                    <a href = "<?php echo base_url();?>crm/invoice/delete/<?php echo $invoice[$a]["id_invoice"];?>" class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></a>
                    
                    <a href = "<?php echo base_url();?>crm/invoice/word" class="btn btn-outline btn-success"
                    data-toggle="tooltip"><i class="icon wb-eye" aria-hidden="true"></i></a>

                    <a href = "<?php echo base_url();?>crm/invoice/pdf" class="btn btn-outline btn-success"
                    data-toggle="tooltip"><i class="icon fa fa-briefcase" aria-hidden="true"></i></a>
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>