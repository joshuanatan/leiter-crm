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
                <th>RFQ ID</th>
                <th>Nama Perusahaan</th>
                <th>Nama CP</th>
                <th>Harga Vendor</th>
                <th>Purpose</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0 ; $a<count($request); $a++){ ?>
            <tr class="gradeA">
                <td><?php echo $request[$a]["no_request"]?></td>
                <td><?php echo $request[$a]["nama_perusahaan"];?></td>
                <td><?php echo $request[$a]["nama_cp"];?></td>
                <td>
                    <a href = "<?php echo base_url();?>crm/vendor/produk/<?php echo $request[$a]["id_submit_request"];?>" class="btn btn-outline btn-primary btn-sm"><i class="icon wb-book" aria-hidden="true"></i>Harga Vendor</a>
                    <?php if($request[$a]["untuk_stock"]): ?>
                    <?php endif;?>
                </td>
                <td>
                    <?php if($request[$a]["untuk_stock"] == 1): ?>
                    CUSTOMER
                    <?php else: ?>
                    STOCK
                    <?php endif;?>
                </td>
                <td class="actions">
                    
                    <a href = "<?php echo base_url();?>crm/vendor/delete/<?php echo $request[$a]["id_request"];?>" class="btn btn-outline btn-danger btn-sm" data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></a>

                    <a href = "<?php echo base_url();?>crm/vendor/submit/<?php echo $request[$a]["id_request"];?>" class="btn btn-outline btn-success btn-sm" data-trigger = "hover" data-content = <?php if($request[$a]["untuk_stock"] == 1) echo "Proceed to Quotation"; else echo "Proceed to PO";?> data-toggle="popover"><i class="icon fa fa-check" aria-hidden="true"></i></a>
                    
                </td>
            </tr> 
            <?php } ?>
        </tbody>
    </table>
</div>