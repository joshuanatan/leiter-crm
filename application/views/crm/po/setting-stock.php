<div class="panel-body col-lg-12">
    <div class="row row-lg">
        <div class="col-xl-12">
            <!-- Example Tabs Left -->
            <div class="example-wrap">
                <div class="nav-tabs-vertical" data-plugin="tabs">
                    <ul class="nav nav-tabs mr-25" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">Primary Data</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#items" aria-controls="pengiriman" role="tab">Items</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#dokumen" aria-controls="pengiriman" role="tab">Document</a></li>

                    </ul>
                    <form action = "<?php echo base_url();?>crm/po/submitSettingPoStock" method = "post">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <?php foreach($primary_data->result() as $a):?>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No Refrence</h5> 
                                    <input value = "<?php echo $a->id_request;?>" name = "id_request" id = "idrequest" type ="text" class = "form-control" readonly/>
                                </div>
                                
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No Purchase Order Setting</h5>
                                    <input name = "no_po" value = "PO/SETTING-<?php echo sprintf("%05d",$maxId);?>" type ="text" class = "form-control" readonly>
                                    <input name = "id_po_setting" id = "idposetting" value = "<?php echo $maxId;?>" type ="hidden" class = "form-control"  readonly>
                                </div>
                                
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Request Date</h5>
                                    <input name = "" value = "<?php $date = date_create($a->date_request_add); echo date_format($date,"d/m/y H:i:s");?>" id = "namaCust" type ="text" class = "form-control namaCust" readonly>
                                    <input name = "id_cp" id ="idCust" value = "" type ="hidden" class = "form-control"  readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Dateline</h5>
                                    <input type ="text" value = <?php $date = date_Create($a->tgl_dateline_request); echo date_format($date,"d/m/Y");?> id = "nama_perusahaan" class = "form-control" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Requested By</h5>
                                    <input type ="text" id = "nama_perusahaan" value = "<?php echo $a->nama_user;?>" class = "form-control" readonly>
                                </div>
                                
                                <?php endforeach;?>
                            </div>
                            <!-- fungsi -->
                            <div class="tab-pane" id="items" role="tabpanel">
                                
                                <div class = "form-group col-lg-12">
                                    <table class = "table table-stripped col-lg-12" style = "width:100%">
                                        <thead>
                                            <th>Product Name</th>
                                            <th>Already PO</th>
                                            <th>Supplier</th>
                                            <th>Shipper</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id ="t1">
                                            <?php $counter = 0; for($a = 0; $a<count($items); $a++): ?>
                                                <tr>
                                                    <td>
                                                        <?php echo ucwords($items[$a]["nama_produk"]);?>
                                                        <input type ="hidden" id ="idrequestitem<?php echo $counter;?>" name = "id_request_item" value = "<?php echo $items[$a]["id_produk"];?>">
                                                    </td>
                                                    <td>
                                                        <?php if($items[$a]["status_po"] == 0):?>
                                                        <button class = "btn btn-success btn-outline" type = "button">ALREADY SET</button>
                                                        <?php endif;?>
                                                    </td>
                                                    <td>
                                                        <button type = "Button" class = "col-lg-12 btn btn-primary btn-outline" <?php if($items[$a]["status_po"] == 1):?>data-target = "#Supplier<?php echo $counter;?>"<?php endif;?> data-toggle="modal">Set Supplier</button>
                                                    </td>
                                                    <div class="modal fade modal-primary" id="Supplier<?php echo $counter;?>" aria-hidden="true" aria-labelledby="Supplier<?php echo $items[$a]["id_produk"]; ?>" role="dialog" tabindex="4">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                    </button>
                                                                    <h4 class="modal-title"><?php echo ucwords($items[$a]["nama_produk"]);?> Supplier</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class = "form-group">
                                                                        <h5 style = "color:darkgrey; opacity:0.8">Supplier</h5>
                                                                        <select class = "form-control" name = "id_supplier" onchange = "getVendorDetailPrice(<?php echo $counter;?>)" id = "idsupplier<?php echo $counter;?>">
                                                                            <option disabled selected>Choose Supplier</option>
                                                                            <?php for($supplier = 0; $supplier<count($items[$a]["suppliers"]); $supplier++):?>
                                                                            <option value = "<?php echo $items[$a]["suppliers"][$supplier]["id_vendor"];?>"><?php echo $items[$a]["suppliers"][$supplier]["nama_vendor"];?></option>
                                                                            <?php
                                                                            endfor;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class = "form-group">
                                                                        <h5 style = "color:darkgrey; opacity:0.8">Item Price</h5>
                                                                        <input type ="text" id = "hargabarang<?php echo $counter;?>" class = "form-control" oninput = "commas('hargabarang<?php echo $counter;?>')">
                                                                    </div>
                                                                    <div class = "form-group">
                                                                        <h5 style = "color:darkgrey; opacity:0.8">Item Price Rate</h5>
                                                                        <input type ="text" id = "ratebarang<?php echo $counter;?>" class = "form-control" oninput = "commas('ratebarang<?php echo $counter;?>')">
                                                                    </div>
                                                                    <div class = "form-group">
                                                                        <h5 style = "color:darkgrey; opacity:0.8">Currency</h5>
                                                                        <select class = "form-control" id = "matauangbarang<?php echo $counter;?>">
                                                                            <?php foreach($mata_uang->result() as $matauang ): ?>
                                                                            <option value = "<?php echo $matauang->mata_uang?>"><?php echo $matauang->mata_uang;?></option> 
                                                                            <?php endforeach;?>
                                                                        </select>
                                                                    </div>
                                                                    <div class = "form-group">
                                                                        <h5 style = "color:darkgrey; opacity:0.8">Minimum Order</h5>
                                                                        <input type ="text" id = "minimumbarang<?php echo $counter;?>" class = "form-control" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <td>
                                                        <button type = "Button" class = "col-lg-12 btn btn-primary btn-outline" <?php if($items[$a]["status_po"] == 1):?>data-target = "#detailSupplierFirm<?php echo $counter;?>"<?php endif;?> data-toggle="modal">Set Shipper</button>
                                                    </td>
                                                    <div class="modal fade modal-primary" id="detailSupplierFirm<?php echo $counter;?>" aria-hidden="true" aria-labelledby="exampleModalPrimary" role="dialog" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                    </button>
                                                                    <h4 class="modal-title">Supplier Shipper</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class = "form-group">
                                                                        <h5 style = "color:darkgrey; opacity:0.8">Supplier</h5>
                                                                        <input type ="text" id = "namaperusahaan<?php echo $counter;?>" class = "form-control" readonly>
                                                                    </div>
                                                                    <div class = "form-group">
                                                                        <h5 style = "color:darkgrey; opacity:0.8">Supplier Address</h5>
                                                                        <textarea type ="text" id = "alamatperusahaan<?php echo $counter;?>" class = "form-control" readonly></textarea>
                                                                    </div>
                                                                    <div class = "form-group">
                                                                        <h5 style = "color:darkgrey; opacity:0.8">Shipper</h5>
                                                                        <select class = "form-control" id = "idshipper<?php echo $counter;?>" onchange = "getShipperDetailPrice(<?php echo $counter;?>)"></select>
                                                                    </div>
                                                                    <div class = "form-group">
                                                                        <h5 style = "color:darkgrey; opacity:0.8">Shipping Method</h5>
                                                                        <input type ="text" id = "shippingmethod<?php echo $counter;?>" class = "form-control" readonly>
                                                                    </div>
                                                                    <div class = "form-group">
                                                                        <h5 style = "color:darkgrey; opacity:0.8">Item Shipping Price</h5>
                                                                        <input type ="text" id = "hargashipping<?php echo $counter;?>" class = "form-control" oninput = "commas('hargashipping<?php echo $counter;?>')">
                                                                    </div>
                                                                    <div class = "form-group">
                                                                        <h5 style = "color:darkgrey; opacity:0.8">Currency</h5>
                                                                        <input type ="text" id = "matauangshipping<?php echo $counter;?>" class = "form-control" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <td><?php if($items[$a]["status_po"] == 1):?><button type = "button" class = "col-lg-12 btn btn-primary btn-outline" onclick = "saveItemPO(<?php echo $counter;?>)">SAVE</button><?php else: echo "<p align = 'center' style = 'col-lg-12'>-</p>"; endif;?></td>
                                                </tr>
                                            <?php $counter++;endfor;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="dokumen" role="tabpanel">
                                <div class = "form-group">
                                    <button class = "btn btn-primary btn-outline col-lg-2 col-sm-12" >SAVE</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Example Tabs Left -->
                <div class = "form-group">
                    <a href = "<?php echo base_url();?>crm/po/stock" class = "btn btn-primary btn-outline col-lg-2">BACK</a>
                </div>
        </div>
    </div>
</div>
