<div class="panel-body col-lg-12">
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <!-- List OC yang sudah di selesaikan -->
        <thead>
            <tr>
                <th>Price Request ID</th>
                <th>Dateline</th>
                <th>Items Remaining</th>
                <th>Requested By</th>
                <th>Request Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr class="gradeA">
                <?php for($a = 0 ; $a<count($price_request); $a++): ?>
                <td><?php echo $price_request[$a]["id_request"];?></td>
                <td><?php echo $price_request[$a]["tgl_dateline_request"];?></td>
                <td><?php if($price_request[$a]["items_ordered"][1] != 0) echo $price_request[$a]["items_ordered"][1]." Items Remaining"; else echo "Ready to Order";?> </td> <!--jumlah item yang ga ada di PO Item -->
                <td><?php echo $price_request[$a]["nama_user"];?></td>
                <td><?php $date = date_create($price_request[$a]["date_request_add"]); echo date_format($date,"d/m/Y H:i:s");?></td>
                <td class="actions">
                    <a href = "<?php if($price_request[$a]["already_setting"] == 1){ echo base_url();?>crm/po/settingstock/<?php echo $price_request[$a]["id_request"];} else echo "#";?>" class = "btn btn-outline btn-success" data-content="Setting PO" data-trigger="hover" data-toggle="popover"><i class = "icon wb-menu" data-toggle="modal" aria-hidden="true"></i></a>

                    <?php if($price_request[$a]["already_setting"] == 0){ ?><a href = "<?php echo base_url();?>crm/po/generate/<?php echo $price_request[$a]["id_po_setting"];?>" class = "btn btn-outline btn-primary" data-content="Generate PO" data-trigger="hover" data-toggle="popover"><i class = "icon fa fa-briefcase" data-toggle="modal" aria-hidden="true"></i></a><?php } ?>
                </td>
                
                <?php endfor;?>
            </tr>
        </tbody>
    </table>
    <a href = "<?php echo base_url();?>crm/po" class = "btn btn-primary btn-outline col-lg-2">BACK</a>
</div>
