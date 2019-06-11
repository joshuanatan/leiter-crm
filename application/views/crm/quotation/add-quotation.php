    <div class="panel-body col-lg-12">
    <div class="row row-lg">
        <div class="col-xl-12">
            <!-- Example Tabs Left -->
            <div class="example-wrap">
                <div class="nav-tabs-vertical" data-plugin="tabs">
                    <ul class="nav nav-tabs mr-25" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">Primary Data</a></li>

                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#items" aria-controls="pengiriman" role="tab">Items</a></li>

                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#payment" aria-controls="produksi" role="tab">Pembayaran</a></li>
                        
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#detail" aria-controls="produksi2" role="tab">Detail Quotation</a></li>
                        
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#tambahan" aria-controls="pengiriman" role="tab">S&K Quotation</a></li>

                    </ul>
                    <form action = "<?php echo base_url();?>crm/quotation/insertquotation" method = "post">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Price Request</h5>
                                    <select onchange = "detailPriceRequest()" id = "id_request" name = "id_request" class = "form-control" data-plugin ="select2">
                                        <option selected disabled>Item Request ID</option>
                                        <?php foreach($request->result() as $a){ ?> 
                                        <option value = "<?php echo $a->id_request?>"><?php echo "REQ-".sprintf('%05d',$a->id_request);?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation No</h5> <!-- nanti ganti jadi select -->
                                    <input name = "no_quo" type ="text" class = "form-control" readonly  value = "QUO-<?php echo sprintf('%05d',$quotation_id);?>">
                                    <input name = "id_quo"  type ="hidden" value = "<?php echo $quotation_id;?>" id = "id_quo"/>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation Versi</h5>
                                    <input name = "versi_quo" id = "versi_quo" value = "1" readonly type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <input type ="text" class = "form-control perusahaanCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                    <input name = "" type ="text" class = "form-control namaCust" readonly>
                                </div>
                            </div>
                            <!-- fungsi -->
                            <div class="tab-pane" id="items" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Items</h5>
                                    <select class = "form-control" id = "itemsOrdered" onchange = "loadVendors()">
                                        <option selected disabled>Choose Item</option>
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
                                    <input name = "Abc" type ="text" id = "hargaProduk" class = "form-control" disabled placeholder = "Product Price">
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
                                    <h5 style = "color:darkgrey; opacity:0.8">Courier</h5>
                                    <select class = "form-control" id = "courier" onchange = "getCourierPrice()">
                                        <option selected disabled>Choose Courier</option>
                                    </select>
                                </div>
                                <div class = "form-group">
                                    <input name = "Abc" type ="text" id = "hargaCourier" class = "form-control" disabled placeholder = "Product Price">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Selling Price</h5>
                                    <input name = "Abc" type ="text" class = "form-control" id = "inputNominal" oninput ="decimal()" placeholder = "Selling Price">
                                </div>
                                <div class = "form-group" onclick = "getMargin()">
                                    <h5 style = "color:darkgrey; opacity:0.8">Margin</h5>
                                    <input name = "Abc"  type ="text" class = "form-control" id = "totalMargin" disabled placeholder = "Margin">
                                </div>
                                <div class = "form-group">
                                    <button type = "button" onclick = "quotationItem()" class = "col-lg-3 btn btn-primary btn-outline">ADD TO QUOTATION</button>
                                    <button type = "button" onclick = "showItem()" class = "col-lg-3 btn btn-primary btn-outline">SHOW QUOTATION ITEM</button>
                                </div>
                                <div class = "form-group col-lg-12">
                                    <table class = "table table-stripped col-lg-12" style = "width:100%" data-plugin = "dataTable">
                                        <thead>
                                            <th>Item Request ID</th>
                                            <th>Product Name</th>
                                            <th>Amount</th>
                                            <th>Selling Price</th>
                                            <th>Margin</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id ="t1">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="payment" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Payment Method</h5>
                                    <select class = "form-control" id = "paymentMethod" name = "paymentMethod" onchange = "paymentMethodForm()">
                                        <option value = "0" selected disabled>Choose Payment Method</option>
                                        <option value = "1">Full Before Delivery</option>
                                        <option value = "2">Full After Delivery</option>
                                        <option value = "11">DP & Rest Before Delivery</option><!--cuman bagi 2 pembayaran -->
                                        <option value = "12">DP & Rest After Delivery</option>
                                    </select>
                                </div>
                                <div class = "form-group containerDp" style = "display:none"> <!-- textarea klo DP % -->
                                    <h5 style = "color:darkgrey; opacity:0.8">DP Percentage</h5>
                                    <input name = "persen[]" id = "persenDp" value = "%" oninput = "paymentWithDP()" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group containerDp" style = "display:none"> <!-- Nominal DP -->
                                    <h5 style = "color:darkgrey; opacity:0.8">DP Amount</h5>
                                    <input name = "" id = "jumlahDp" type ="text" class = "form-control">
                                    <input name = "jumlah[]" id = "jumlahDpClean" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group containerSisa" style = "display:none"> <!-- textarea klo DP% -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Rest Percentage</h5>
                                    <input name = "persen[]" id = "persenSisa" value = "%" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group containerSisa" style = "display:none"> <!-- Nominal DP -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Rest Amount</h5>
                                    <input name = "" id = "jumlahSisa" type ="text" class = "form-control">
                                    <input name = "jumlah[]" id = "jumlahSisaClean" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Mata Uang Pembayaran</h5>
                                    <input name = "mata_uang_pembayaran" type ="text" class = "form-control">
                                </div>
                                <!-- (1) invoice keluar triggernya abis keluarin OC -->
                                <!-- (2) invoice keluar triggernya abis keluarin OD -->
                                <!-- (3) 
                                keluar textarea buat isi persen, keluar invoice setelah OC untuk dp
                                selebihnya keluar setelah bkin OD
                                -->
                                <!-- (4) 
                                keluar textarea buat isi persen, keluar invoice setelah OC untuk dp
                                selebihnya keluar setelah bkin OD
                                -->
                            </div>
                            <!-- dokumen -->
                            <div class="tab-pane" id="detail" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No Quotation</h5>
                                    <input value = "QUO-<?php echo sprintf('%05d',$quotation_id) ?>" type ="text" class = "form-control" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation Perihal</h5>
                                    <input name = "hal_quo" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <input type ="text" class = "form-control perusahaanCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                    <input name = "" type ="text" class = "form-control namaCust" readonly>
                                    <input name = "id_cp" type ="hidden" class = "form-control" id ="idCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Alamat Customer</h5>
                                    <textarea class = "form-control" id ="alamatCust"></textarea>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Up Nama Customer</h5>
                                    <input name = "up_cp" type ="text" class = "form-control">
                                </div>
                            </div>
                            <div class="tab-pane" id="tambahan" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Durasi Pembayaran</h5>
                                    <input name = "durasi_pembayaran" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Durasi Pengiriman</h5>
                                    <input name = "durasi_pengiriman" type ="text" class = "form-control"> Minggu
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Masa Berlaku Quotation</h5>
                                    <input name = "dateline_quo" type ="date" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Franco</h5>
                                    <input name = "franco" id = "franco" type ="text" class = "form-control"> 
                                </div>
                                
                                <button class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Example Tabs Left -->
        </div>
    </div>
</div>
