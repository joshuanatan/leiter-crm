<div class="panel-body col-lg-12">
    <div class="row row-lg">
        <div class="col-xl-12">
            <!-- Example Tabs Left -->
            <div class="example-wrap">
                <div class="nav-tabs-vertical" data-plugin="tabs">
                    <ul class="nav nav-tabs mr-25" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">Primary Data</a></li>

                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#items" aria-controls="pengiriman" role="tab">Items</a></li>

                    </ul>
                    <form action = "<?php echo base_url();?>crm/oc/settingpo" method = "post">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <div class = "form-group"> <!-- nanti bentuknya nomorquotation/versi -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Order Confirmation No</h5> 
                                    <input name = "no_oc"  id="nooc" type ="text" value = "<?php echo $primary_data["no_oc"]?>" class = "form-control" readonly>
                                    <input name = "id_oc"  id = "idoc"  type ="hidden" value = "<?php echo $primary_data["id_oc"]?>"/>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No PO Customer</h5>
                                    <input type ="text" name = "no_po" id = "nopo" class = "form-control perusahaanCust" value = "<?php echo $primary_data["no_po_customer"]?>" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <input type ="text" name = "nama_perusahaan" id = "namaperusahaan" value = "<?php echo $primary_data["perusahaan_customer"]?>" class = "form-control perusahaanCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                    <input name = "" id = "namacp" type ="text" value = "<?php echo ucwords($primary_data["nama_customer"])?>" class = "form-control namaCust" readonly>
                                </div>
                            </div>
                            <!-- fungsi -->
                            <div class="tab-pane" id="items" role="tabpanel">
                                
                                <div class = "form-group col-lg-12">
                                    <table class = "table table-stripped col-lg-12" style = "width:100%">
                                        <thead>
                                            <th>Product Name</th>
                                            <th>Detail Quotation Item</th>
                                            <th>Detail Supplier Firm</th>
                                            <th>Supplier Price</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id ="t1">
                                            <?php for($a = 0; $a<count($items); $a++):?>
                                            <td><?php echo ucwords($items[$a]["nama_produk"]);?></td>
                                            <td>
                                                <button type = "Button" class = "col-lg-12 btn btn-primary btn-outline" data-target = "#exampleModalPrimary" data-toggle="modal">Quotation Item</button>
                                            </td>
                                            <div class="modal fade modal-primary" id="exampleModalPrimary" aria-hidden="true" aria-labelledby="exampleModalPrimary" role="dialog" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title">Quotation Item</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Supplier</h5>
                                                                <input type ="text" value = "<?php echo $items[$a]["supplier_oc"]["nama_perusahaan"]; ?>" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Item Price</h5>
                                                                <input type ="text" value = "<?php echo $items[$a]["supplier_oc"]["harga_supplier"]; ?>" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Item Price Rate</h5>
                                                                <input type ="text" value = "<?php echo $items[$a]["supplier_oc"]["rate_harga"]; ?>" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Currency</h5>
                                                                <input type ="text" value = "<?php echo $items[$a]["supplier_oc"]["currency"]; ?>" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td>
                                                <button type = "Button" class = "col-lg-12 btn btn-primary btn-outline" data-target = "#detailSupplierFirm" data-toggle="modal">Quotation Item</button>
                                            </td>
                                            <div class="modal fade modal-primary" id="detailSupplierFirm" aria-hidden="true" aria-labelledby="exampleModalPrimary" role="dialog" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title">Detail Item</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Shipper</h5>
                                                                <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Shipping Method</h5>
                                                                <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Item Shipping Price</h5>
                                                                <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Item Shipping Price Rate</h5>
                                                                <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td>
                                                <button type = "Button" class = "col-lg-12 btn btn-primary btn-outline" data-target = "#detailSupplierFirm" data-toggle="modal">Quotation Item</button>
                                            </td>
                                            <div class="modal fade modal-primary" id="detailSupplierFirm" aria-hidden="true" aria-labelledby="exampleModalPrimary" role="dialog" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title">Detail Item</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Supplier</h5>
                                                                <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Item Price</h5>
                                                                <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Item Price Rate</h5>
                                                                <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Shipper</h5>
                                                                <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Shipping Method</h5>
                                                                <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Item Shipping Price</h5>
                                                                <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                            <div class = "form-group">
                                                                <h5 style = "color:darkgrey; opacity:0.8">Item Shipping Price Rate</h5>
                                                                <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td><button class = "col-lg-12 btn btn-primary btn-outline">SAVE</button></td>
                                            <?php endfor;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Example Tabs Left -->
        </div>
    </div>
</div>
