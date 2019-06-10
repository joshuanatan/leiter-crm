<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <a href = "<?php echo base_url();?>crm/od/create" class="btn btn-outline btn-primary">
                <i class="icon wb-plus" aria-hidden="true"></i> Add Order Delivery
            </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin="dataTable">
        <thead>
            <tr>
                <th>Order Delivery ID</th>
                <th>Order Confirmation ID</th>
                <th>Customer Purchase Order ID</th>
                <th>Customer Firm</th>
                <th>Courier</th>
                <th>Franco</th>
                <th>Date Issued</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr class="gradeA">
                <?php for($a = 0; $a<count($od); $a++): ?>
                <td><?php echo $od[$a]["no_od"];?></td>
                <td><?php echo $od[$a]["no_oc"];?></td>
                <td><?php echo $od[$a]["no_po_cusomter"];?></td>
                <td><?php echo $od[$a]["nama_courier"];?></td>
                <td><?php echo $od[$a]["nama_perusahaan"];?></td>
                <td><?php echo $od[$a]["franco"];?></td>
                <td><?php echo $od[$a]["date_issued"];?></td>
                <td class="actions">
                    
                </td>
                <?php endfor;?>
            </tr>
            
        </tbody>
    </table>
</div>
