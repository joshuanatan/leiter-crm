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
                <th>Items Ordered</th>
                <th>Date Issued</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($od); $a++): ?>
            <tr class="gradeA">
                <td><?php echo $od[$a]["no_od"];?></td>
                <td><?php echo $od[$a]["no_oc"];?></td>
                <td><?php echo $od[$a]["no_po_cusomter"];?></td>
                <td><?php echo $od[$a]["nama_courier"];?></td>
                <td><?php echo $od[$a]["nama_perusahaan"];?></td>
                <td><?php echo $od[$a]["franco"];?></td>
                <td><button class = "btn btn-primary btn-outline" type = "button" data-target = "#detail<?php echo $a;?>" data-toggle = "modal">Detail Items</button></td>
                <td><?php echo $od[$a]["date_issued"];?></td>
                <td class="actions">
                    <a href = "<?php echo base_url();?>crm/od/remove/<?php echo $od[$a]["id_od"];?>" class = "btn btn-danger btn-sm btn-outline">REMOVE</a>
                </td>
                <div class="modal fade" id="detail<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Sent Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <ul>
                            <?php for($b = 0 ; $b<count($od[$a]["items"]); $b++): ?>
                            <li><?php echo $od[$a]["items"][$b]["nama_produk"]." - ".$od[$a]["items"][$b]["jumlah"];?></li>

                            <?php endfor;?>
                            </ul>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>
