<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Company Name</th>
                <th>Customer Name</th>
                <th>Request</th>
                <th>Purpose</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($request->result() as $a){ ?>
            <tr class="gradeA">
                <td>REQ-<?php echo sprintf("%05d",$a->id_request) ?></td>
                <td><?php echo $a->nama_perusahaan;?></td>
                <td><?php echo ucwords($a->nama_cp);?></td>
                <td>
                    <a href = "<?php echo base_url();?>crm/vendor/produk/<?php echo $a->id_request;?>" data-target="#RequestData" class="btn btn-outline btn-primary col-lg-5"><i class="icon wb-book" aria-hidden="true"></i>Product Vendor Price</a>
                    <?php if($a->untuk_stock == 1): ?>

                    <a href = "<?php echo base_url();?>crm/vendor/courier/<?php echo $a->id_request;?>" data-target="#RequestData" class="btn btn-outline btn-primary col-lg-5"><i class="icon wb-book" aria-hidden="true"></i>Courier Vendor Price</a>
                    
                    <?php endif;?>
                </td>
                <td>
                    <?php if($a->untuk_stock == 1): ?>
                    CUSTOMER
                    <?php else: ?>
                    STOCK
                    <?php endif;?>
                </td>
                <td class="actions">
                    
                    <a href = "<?php echo base_url();?>crm/vendor/delete/<?php echo $a->id_request;?>" class="btn btn-outline btn-danger" data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></a>
                    <a href = "<?php echo base_url();?>crm/vendor/submit/<?php echo $a->id_request;?>" class="btn btn-outline btn-success" data-trigger = "hover" data-content = <?php if($a->untuk_stock == 1) echo "Proceed to Quotation"; else echo "Proceed to PO";?> data-toggle="popover"><i class="icon fa fa-check" aria-hidden="true"></i></a>
                    
                </td>
            </tr> 
            <?php } ?>
        </tbody>
    </table>
</div>