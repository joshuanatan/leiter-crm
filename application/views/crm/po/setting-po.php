<div class="panel-body col-lg-12">
    <div class="row row-lg">
        <div class="col-xl-12">
            <!-- Example Tabs Left -->
            <div class="example-wrap">
                <div class="nav-tabs-vertical" data-plugin="tabs">
                    <ul class="nav nav-tabs mr-25" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">Primary Data</a></li>

                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#items" aria-controls="pengiriman" role="tab">Items</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#dokumen" aria-controls="pengiriman" role="tab">Dokumen</a></li>

                    </ul>
                    <form action = "<?php echo base_url();?>crm/po/submitSettingStock" method = "post">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <div class = "form-group"> <!-- nanti bentuknya nomorquotation/versi -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Setting PO</h5> 
                                    <input name = "id_po_setting"  id="id_po_setting" type ="text" value = "<?php echo $id_po_setting;?>" class = "form-control" readonly>
                                </div>
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
                                
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Items</h5>
                                    <select class = "form-control" id = "itemsOrdered" data-plugin = "select2" onchange = "loadVendors()">
                                        <option selected disabled>Choose Item</option>
                                        <?php for($a = 0; $a<count($items); $a++): ?>
                                        <option value = '<?php echo $items[$a]["id_request_item"];?>' ><?php echo $items[$a]["nama_produk"];?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quantity</h5>
                                    <input name = "Abc" type ="text" class = "form-control" id = "itemamount" value = "">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Supplier</h5>
                                    <select class = "form-control" id = "products" onchange = "getVendorPrice()">
                                        <option selected disabled>Choose Product Vendor</option>
                                    </select>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Product Price</h5>
                                    <input name = "Abc" type ="text" id = "hargaProduk" class = "form-control" placeholder = "Product Price">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Product Rate</h5>
                                    <input name = "Abc" type ="text" id = "rateHarga" class = "form-control" placeholder = "Product Price">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Currency</h5>
                                    <input name = "Abc" type ="text" id = "matauang" class = "form-control" placeholder = "Product Price">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Buying Price</h5>
                                    <input name = "Abc" type ="text" class = "form-control" id = "inputNominal" oninput ="decimal()" placeholder = "buying Price">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Shipping</h5>
                                    <select class = "form-control" id="shippers" onchange = "getShippingPrice()">
                                        <option selected disabled>Choose Shipping Vendor</option>
                                    </select>
                                </div><div class = "form-group">
                                    <input name = "Abc" type ="text" id = "hargashipping" class = "form-control" disabled placeholder = "Shipping Price">
                                </div>
                                <div class = "form-group">
                                    <button type = "button" onclick = "poitem()" class = "col-lg-3 btn btn-primary btn-outline">ADD TO PURCHASE ORDER</button>
                                    <button type = "button" onclick = "showItem()" class = "col-lg-3 btn btn-primary btn-outline">SHOW PURCHASE ORDER ITEM</button>
                                </div>
                                <div class = "form-group col-lg-12">
                                    <table class = "table table-stripped col-lg-12" style = "width:100%" data-plugin = "dataTable">
                                        <thead>
                                            <th>Item Request ID</th>
                                            <th>Product Name</th>
                                            <th>Amount</th>
                                            <th>Buying Price</th>
                                            <th>Currency</th>
                                            <th>Shipper</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id ="t1">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="dokumen" role="tabpanel">
                                
                                <div class = "form-group">
                                    <button type = "submit" class = "btn btn-primary btn-outline">SUBMIT</button>
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
