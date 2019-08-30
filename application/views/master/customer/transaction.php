<div class="panel-body col-lg-12">
    <button type = "button" class = "btn btn-primary"><?php echo $jumlah_transaksi;?> TRANSAKSI</button>
    <br/><br/>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th style = "width:10%">Order Confirmation No</th>
                <th style = "width:15%">Quotation No</th> <!-- nanti ini keisi waktu nambahin OC-->
                <th style = "width:15%">Customer Firm</th>
                <th style = "width:15%">Customer Contact Person</th>
                <th style = "width:10%">Customer PO Number</th>
                <th style = "width:10%">Customer PO Date</th>
                <th style = "width:10%">PO Price</th>
                <th style = "width:10%">OC Detail</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0 ; $a<count($oc); $a++): ?>
            <tr>
                <td><?php echo $oc[$a]["no_oc"];?></td>
                <td><?php echo $oc[$a]["no_quotation"];?></td>
                <td><?php echo $oc[$a]["nama_perusahaan"];?></td>
                <td><?php echo $oc[$a]["nama_cp"];?></td>
                <td><?php echo $oc[$a]["no_po_customer"];?></td> 
                <td><?php $date = date_create($oc[$a]["tgl_po_customer"]);echo date_format($date,"d-m-Y") ?></td> 
                <td><?php echo number_format($oc[$a]["total_oc_price"],2,".",",");?></td>
                <td>
                    <button class = "btn btn-primary btn-sm btn-outline col-lg-12" data-toggle = "modal" data-target = "#detailItem<?php echo $a;?>">DETAIL ITEM</button>
                    <button class = "btn btn-primary btn-sm btn-outline col-lg-12" data-toggle = "modal" data-target = "#detailpayment<?php echo $a;?>">DETAIL PAYMENT</button>
                    
                </td>
                <td class="actions">
                    <a href = "<?php echo base_url();?>crm/oc/ocPdf/<?php echo $oc[$a]["id_submit_oc"];?>" class="btn btn-outline btn-sm btn-primary col-lg-12" target="_blank">CETAK</a>

                    <a href = "<?php echo base_url();?>crm/oc/edit/<?php echo $oc[$a]["id_submit_oc"];?>" class = "btn btn-outline btn-sm btn-primary col-lg-12">EDIT</a>

                    <a href = "<?php echo base_url();?>crm/oc/delete/<?php echo $oc[$a]["id_submit_oc"];?>" class="btn btn-outline btn-danger btn-sm col-lg-12" data-content="Delete OC" data-trigger="hover" data-toggle="popover">DELETE</a> 
                    
                </td>
            </tr>     
            <?php
            endfor;
            ?>
        </tbody>
    </table>
    <a href = "<?php echo base_url();?>master/customer" class = "btn btn-primary btn-sm">BACK</a>
</div>
