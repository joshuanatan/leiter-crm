<div class="panel-body col-lg-12">
    <div class="row row-lg">
        <div class="col-xl-12">
            <!-- Example Tabs Left -->
            <div class="example-wrap">
                <div class="nav-tabs-vertical" data-plugin="tabs">
                    <ul class="nav nav-tabs nav-tabs-line mr-25" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">Primary Data</a></li>

                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#pengiriman" aria-controls="pengiriman" role="tab">T&C</a></li>

                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#produksi" aria-controls="produksi" role="tab">T&C (Cont.)</a></li>

                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#produksi2" aria-controls="produksi2" role="tab">T&C (Cont.)</a></li>

                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#items" aria-controls="items" role="tab">Items</a></li>
                    </ul>
                    <?php foreach($quotation->result() as $a){ ?> 
                    <form action = "<?php echo base_url();?>crm/quotation/insertquotation" method = "post">    
                        
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Price Request</h5>
                                    <input name = "" type ="text" class = "form-control" readonly value = "REQ-<?php echo sprintf('%05d',$a->id_request) ?>">
                                    <input name = "id_request" id = "id_request" type ="hidden" class = "form-control" readonly value = "<?php echo $a->id_request;?>">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation No</h5> <!-- nanti ganti jadi select -->
                                    <input name = "no_quo" type ="text" class = "form-control" readonly value = "QUO-<?php echo sprintf('%05d',$a->id_quo) ?>">
                                    <input name = "id_quo"  type ="hidden" value = "<?php echo $a->id_quo;?>" id = "id_quo">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation Versi</h5>
                                    <input name = "versi_quo" id = "versi_quo" value = "<?php echo $last_version;?>" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation Perihal</h5>
                                    <input name = "hal_quo" type ="text" value = "<?php echo $a->hal_quo;?>" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <input type ="text" class = "form-control" value = "<?php echo $a->nama_perusahaan;?>" id ="perusahaanCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                    <input name = "" type ="text" class = "form-control" value = "<?php echo $a->nama_cp;?>" id ="namaCust" readonly>
                                    <input name = "id_cp" type ="hidden" class = "form-control" value = "<?php echo $a->id_cp;?>" id ="idCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Up Nama Customer</h5>
                                    <input name = "up_cp" type ="text" value = "<?php echo $a->up_cp;?>" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Jabatan Customer</h5>
                                    <input name = "jabatan_up" type ="text" value = "<?php echo $a->jabatan_up;?>" class = "form-control">
                                </div>
                            </div>
                            <div class="tab-pane" id="pengiriman" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Durasi Pengiriman</h5>
                                    <input name = "durasi_pengiriman" type ="text" value = "<?php echo $a->durasi_pengiriman;?>" class = "form-control"> Minggu
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Trigger Pengiriman</h5>
                                    <input name = "trigger_pengiriman" type ="text" value = "<?php echo $a->trigger_pengiriman;?>" class = "form-control"> 
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Tambahan Detail Pengiriman</h5>
                                    <input name = "tambahan_pengiriman" type ="text" value = "<?php echo $a->tambahan_pengiriman;?>" class = "form-control"> 
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Franco</h5>
                                    <input name = "franco" type ="text" value = "<?php echo $a->franco;?>" class = "form-control"> 
                                </div>
                            </div>
                            <div class="tab-pane" id="produksi" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Jadwal Produksi</h5>
                                    <input name = "jadwal_produksi" value = "<?php echo $a->jadwal_produksi;?>" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Jadwal Pengiriman</h5>
                                    <input name = "jadwal_pengiriman" value = "<?php echo $a->jadwal_pengiriman;?>" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Durasi Pembayaran</h5>
                                    <input name = "durasi_pembayaran" value = "<?php echo $a->durasi_pembayaran;?>" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Trigger Pembayaran</h5>
                                    <input name = "trigger_pembayaran" value = "<?php echo $a->trigger_pembayaran;?>" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Tambahan Detail Pembayaran</h5>
                                    <input name = "tambahan_pembayaran" value = "<?php echo $a->tambahan_pembayaran;?>" type ="text" class = "form-control">
                                </div>
                            </div>
                            <div class="tab-pane" id="produksi2" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Mata Uang Pembayaran</h5>
                                    <input name = "mata_uang_pembayaran" value = "<?php echo $a->mata_uang_pembayaran;?>" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">PPN</h5>
                                    <input name = "ppn" type ="text" value = "<?php echo $a->ppn;?>" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Termasuk PPN</h5>
                                    <select name = "termasuk_ppn" class = "form-control">
                                        <option value = "0">Termasuk</option>
                                        <option value = "1" <?php if($a->termasuk_ppn == 1) echo "selected" ;?>>Tidak Termasuk</option>
                                    </select>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Dateline Quotation</h5>
                                    <input name = "dateline_quo" type ="date" value = "<?php echo $a->dateline_quo;?>" class = "form-control">
                                </div>
                            </div>
                            <?php } ?>
                            <div class="tab-pane" id="items" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8" onclick = "detailPriceRequestPageEdit()">Items</h5>
                                    <select class = "form-control" id = "itemsOrdered" onchange = "loadVendors()"><option selected disabled>Choose Item</option></select>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quantity</h5>
                                    <input name = "Abc" type ="text" class = "form-control" id = "itemamount" value = "">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Shipping</h5>
                                    <select class = "form-control" id="shippers" onchange = "getShippingPrice()"><option selected disabled>Choose Shipping Vendor</option></select>
                                </div>
                                <div class = "form-group">
                                    <input name = "Abc" type ="text" id = "hargashipping" class = "form-control" disabled placeholder = "Shipping Price">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Product</h5>
                                    <select class = "form-control" id = "products" onchange = "getVendorPrice()"><option selected disabled>Choose Product Vendor</option></select>
                                </div>
                                <div class = "form-group">
                                    <input name = "Abc" type ="text" id = "hargaProduk" class = "form-control" disabled placeholder = "Product Price">
                                </div>
                                <div class = "form-group">
                                    <input name = "Abc" type ="text" class = "form-control" id = "inputNominal" placeholder = "Selling Price">
                                </div>
                                <div class = "form-group" onclick = "getMargin()">
                                    <input name = "Abc"  type ="text" class = "form-control" id = "totalMargin" disabled placeholder = "Margin">
                                </div>
                                <div class = "form-group">
                                    <button type = "button" onclick = "quotationItem()" class = "btn btn-primary btn-outline">ADD TO QUOTATION</button>
                                </div>
                                <div class = "form-group col-lg-12">
                                    <table class = "table table-stripped col-lg-12">
                                        <thead>
                                            <th>Item Request ID</th>
                                            <th>Product Name</th>
                                            <th>Amount</th>
                                            <th>Selling Price</th>
                                            <th>Margin</th>
                                        </thead>
                                        <tbody id ="t1">

                                        </tbody>
                                    </table>
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
