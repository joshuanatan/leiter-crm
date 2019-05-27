<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <a href = "<?php echo base_url();?>crm/oc/create" class="btn btn-outline btn-primary">
                <i class="icon wb-plus" aria-hidden="true"></i> Create Order Confirmation
            </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>Order Confirmation ID</th>
                <th>Quotation ID</th> <!-- nanti ini keisi waktu nambahin OC-->
                <th>Quotation Version</th> <!-- nanti ini keisi waktu nambahin OC-->
                <th>Customer PO Number</th>
                <th>Customer Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($oc->result() as $a){ ?>
            <tr>
                <td><?php echo $a->id_oc;?></td>>
                <td><?php echo $a->id_quo;?></td>>
                <td><?php echo $a->versi_quotation;?></td>>
                <td><?php echo $a->no_po_customer;?></td>>
                <td><?php echo $a->id_oc;?></td>>
            </tr>     
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
