<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <a href = "<?php echo base_url();?>crm/request/add" class="btn btn-outline btn-primary">
                <i class="icon wb-plus" aria-hidden="true"></i> Add RFQ
            </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>RFQ ID</th>
                <th>Company Name</th>
                <th>Contact Person</th>
                <th>Franco</th>
                <th>Items Quantity</th>
                <th>Dateline</th>
                <th>Detail Item</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($request); $a++): ?> 
            <tr class="gradeA">
                <td><?php echo $request[$a]["no_request"];?></td>
                <td><?php echo $request[$a]["nama_perusahaan"];?></td>
                <td><?php echo ucwords($request[$a]["nama_cp"]);?></td>
                <td><?php echo ucwords($request[$a]["franco"]);?></td>
                <td><?php echo $request[$a]["jumlah"]." Items";?></td>
                <td><?php $date = date_create($request[$a]["dateline"]); echo date_format($date,"d-m-Y") ?></td>
                <td>
                    <button class ="btn btn-primary btn-outline btn-sm" data-target = "#detailRequest<?php echo $a;?>" data-toggle = "modal">DETAIL</button>
                    <div class = "modal fade" id = "detailRequest<?php echo $a;?>">
                        <div class = "modal-dialog modal-xl">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <h4 class = "modal-title">RFQ DETAIL</h4>
                                </div>
                                <div class = "modal-body">
                                    <table style = "width:100%" class = "table table-stripped table-bordered" data-plugin = "dataTable">
                                        <thead>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Notes</th>
                                            <th>File</th>
                                        </thead>
                                        <tbody>
                                            <?php for($b=0; $b<count($request[$a]["items"]); $b++):?>
                                            <tr>
                                                <td><?php echo ($b+1);?></td>
                                                <td><?php echo $request[$a]["items"][$b]["nama_produk"];?></td>
                                                <td><?php echo $request[$a]["items"][$b]["jumlah_produk"];?></td>
                                                <td><?php echo $request[$a]["items"][$b]["notes_produk"];?></td>
                                                <td>
                                                    <?php if($request[$a]["items"][$b]["file"] != "-"):?>
                                                    <a target = "_blank" href = "<?php if( $request[$a]["items"][$b]["file"] == "-") echo "#"; else echo base_url();?>assets/rfq/<?php echo $request[$a]["items"][$b]["file"];?>" class = "btn btn-primary btn-sm">DOWNLOAD</a>
                                                    <?php else:?>
                                                    <button class = "btn btn-danger btn-sm">NO DOCUMENT</button>
                                                    <?php endif;?>
                                                </td>
                                            </tr>
                                            <?php endfor;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <?php if($request[$a]["status_request"] == 0):?>
                    <button class = "btn btn-primary btn-outline btn-sm">ON RFQ</button>
                    <?php elseif($request[$a]["status_request"] == 1):?>
                    <button class = "btn btn-primary btn-outline btn-sm">ON VENDOR PRICE</button>
                    <?php elseif($request[$a]["status_request"] == 2):?>
                    <button class = "btn btn-primary btn-outline btn-sm">ON QUOTATION</button>
                    <?php elseif($request[$a]["status_request"] == 3):?>
                    <button class = "btn btn-primary btn-outline btn-sm">QUOTATION WIN</button>
                    <?php endif;?>
                </td>
                <td class="actions">
                    
                    <?php if($request[$a]["status_request"] == 0):?>
                    <a href = "<?php echo base_url();?>crm/request/edit/<?php echo $request[$a]["id_request"];?>/<?php echo $request[$a]["bulan_request"];?>/<?php echo $request[$a]["tahun_request"];?>" class="btn btn-outline btn-primary btn-sm"><i class="icon wb-edit" aria-hidden="true"></i></a>

                    <a href = "<?php echo base_url();?>crm/request/delete/<?php echo $request[$a]["id_request"];?>/<?php echo $request[$a]["bulan_request"];?>/<?php echo $request[$a]["tahun_request"];?>" class="btn btn-outline btn-danger btn-sm" data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></a>
                    
                    <a href = "<?php echo base_url();?>crm/request/confirm/<?php echo $request[$a]["id_request"];?>/<?php echo $request[$a]["bulan_request"];?>/<?php echo $request[$a]["tahun_request"];?>" class="btn btn-outline btn-success btn-sm"
                    data-toggle="tooltip"><i class="icon wb-check" aria-hidden="true"></i></a>
                    <?php endif;?>
                    
                </td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>