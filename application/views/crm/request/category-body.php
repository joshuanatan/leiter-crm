<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
                <?php if(isExistsInTable("privilage", array("id_user" => $this->session->id_user,"id_menu" => "insert_rfq")) == 0):?>
                <a href = "<?php echo base_url();?>crm/request/add" class="btn btn-sm btn-outline btn-primary">
                    Add RFQ
                </a>
                <?php endif;?>
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
                <th>Last Edit</th>
                <th style = "width:5%">Actions</th>
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
                                                <td><?php echo $request[$a]["items"][$b]["jumlah_produk"];?> <?php echo $request[$a]["items"][$b]["satuan_produk"];?></td>
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
                   <?php echo $request[$a]["date_request_edit"];?>
                </td>
                <td class="actions">
                    
                <?php if($request[$a]["status_request"] == 0):?>
                    <?php if(isExistsInTable("privilage", array("id_user" => $this->session->id_user,"id_menu" => "edit_rfq")) == 0):?>
                    <a href = "<?php echo base_url();?>crm/request/edit/<?php echo $request[$a]["id_submit_request"];?>" class="btn btn-outline btn-primary btn-sm col-lg-12">EDIT</a>
                    
                    <?php endif;?>
                    <?php if(isExistsInTable("privilage", array("id_user" => $this->session->id_user,"id_menu" => "delete_rfq")) == 0):?>
                    <a href = "<?php echo base_url();?>crm/request/delete/<?php echo $request[$a]["id_submit_request"];?>" class="btn btn-outline btn-danger btn-sm col-lg-12" data-toggle="tooltip">DELETE</a>
                    <?php endif;?>
                    <a href = "<?php echo base_url();?>crm/request/confirm/<?php echo $request[$a]["id_submit_request"];?>" class="btn btn-outline btn-success btn-sm col-lg-12"
                    data-toggle="tooltip">CONFIRM</a>
                    <?php endif;?>
                    
                </td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>