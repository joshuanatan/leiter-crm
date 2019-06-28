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
                <th>Order Confirmation No</th>
                <th>Quotation No</th> <!-- nanti ini keisi waktu nambahin OC-->
                <th>Quotation Version</th> <!-- nanti ini keisi waktu nambahin OC-->
                <th>Customer Firm</th>
                <th>Customer Contact Person</th>
                <th>Customer PO Number</th>
                <th>Items Confirmed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0 ; $a<count($oc); $a++){ ?>
            <tr>
                <td><?php echo $oc[$a]["no_oc"];?></td>
                <td><?php echo $oc[$a]["no_quotation"];?></td>
                <td><?php echo $oc[$a]["versi_quotation"];?></td>
                <td><?php echo $oc[$a]["nama_perusahaan"];?></td>
                <td><?php echo $oc[$a]["nama_cp"];?></td>
                <td><?php echo $oc[$a]["no_po_customer"];?></td>
                <td><?php echo $oc[$a]["jumlah_item"];?></td>
                <td class="actions">
                    
                    <a href = "<?php echo base_url();?>crm/oc/delete/<?php echo $oc[$a]["id_oc"];?>/<?php echo $oc[$a]["bulan_oc"];?>/<?php echo $oc[$a]["tahun_oc"];?>" class="btn btn-outline btn-danger" data-content="Delete OC" data-trigger="hover" data-toggle="popover"><i class="icon wb-trash" aria-hidden="true"></i></a> 
                    
                    <a href = "<?php echo base_url();?>crm/oc/accepted/<?php echo $oc[$a]["id_oc"];?>/<?php echo $oc[$a]["bulan_oc"];?>/<?php echo $oc[$a]["tahun_oc"];?>" class="btn btn-outline btn-primary" data-content="Proceed to PO Vendor" data-trigger="hover" data-toggle="popover"><i class="icon wb-briefcase" aria-hidden="true"></i></a>
                </td>
            </tr>     
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
