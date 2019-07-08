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
                    <form action = "<?php echo base_url();?>crm/quotation/insertquotation" method = "post" enctype = "multipart/form-data">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <input type = "hidden" value = "<?php echo $id_submit_quotation;?>" id = "id_submit_quotation">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">RFQ</h5>
                                    <select onchange = "detailPriceRequest()" id = "id_request" name = "id_request" class = "form-control" data-plugin ="select2">
                                        <option selected disabled>RFQ</option>
                                        <?php for($a = 0; $a<count($request); $a++):?>
                                        <option value = "<?php echo $request[$a]["id_submit_request"];?>"><?php echo $request[$a]["no_request"];?> - <?php echo $request[$a]["nama_perusahaan"]; ?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation No</h5> <!-- nanti ganti jadi select -->
                                    <input id = "no_quotation" name = "no_quotation" type ="text" class = "form-control" readonly  value = "LI-<?php echo sprintf("%03d",$quotation_id);?>/QUO/<?php echo bulanRomawi(date("m"));?>/2019">
                                    <input name = "id_quotation"  type ="hidden" value = "<?php echo $quotation_id;?>" id = "id_quotation"/>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation Versi</h5>
                                    <input name = "versi_quotation" id = "versi_quotation" value = "1" readonly type ="text" class = "form-control">
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
                                <div class = "row">
                                    <div class = "form-group col-lg-5">
                                        <h5 style = "opacity:0.5">Items</h5>
                                        <select class = "form-control" id = "itemsOrdered" data-plugin = "select2" onchange = "loadVendors()">
                                            <option selected disabled>Choose Item</option>
                                        </select>
                                    </div>
                                    <div class = "form-group col-lg-2">
                                        <h5 style = "opacity:0.5">Quantity</h5>
                                        <input name = "Abc" type ="text" class = "form-control" id = "itemamount" value = "">
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "form-group col-lg-5">
                                        <h5 style = "opacity:0.5">Supplier</h5>
                                        <select data-plugin = "select2" class = "form-control" id = "products" onchange = "getVendorPrice()">
                                            <option selected disabled>Choose Product Vendor</option>
                                        </select>
                                    </div>
                                    <div class = "form-group col-lg-5">
                                        <h5 style = "opacity:0.5">Supplier Price (Per satuan)</h5>
                                        <input name = "Abc" type ="text" id = "hargaProduk" class = "form-control" disabled placeholder = "Product Price">
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "form-group col-lg-5">
                                        <h5 style = "opacity:0.5">Shipping</h5>
                                        <select data-plugin = "select2" class = "form-control" id="shippers" onchange = "getShippingPrice()">
                                            <option selected disabled>Choose Shipping Vendor</option>
                                        </select>
                                    </div>
                                    <div class = "form-group col-lg-5">
                                        <h5 style = "opacity:0.5">Shipping Price (Per satuan)</h5>
                                        <input name = "Abc" type ="text" id = "hargashipping" class = "form-control" disabled placeholder = "Shipping Price">
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "form-group col-lg-5">
                                        <h5 style = "opacity:0.5">Courier</h5>
                                        <select data-plugin = "select2" class = "form-control" id = "courier" onchange = "getCourierPrice()">
                                            <option selected disabled>Choose Courier</option>
                                        </select>
                                    </div>
                                    <div class = "form-group col-lg-5">
                                        <h5 style = "opacity:0.5">Courier Price (Per satuan)</h5>
                                        <input name = "Abc" type ="text" id = "hargaCourier" class = "form-control" disabled placeholder = "Courier Price">
                                    </div>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "opacity:0.5">Nama Produk Leiter</h5>
                                    <textarea class = "form-control" id = "nama_produk_leiter" name = "nama_produk_leiter"></textarea>
                                </div>
                                <div class = "form-group" onclick = "getTotal()">
                                    <h5 style = "opacity:0.5">Total Price (All Qty)</h5>
                                    <input name = "Abc"  type ="text" class = "form-control" id = "totalPrice" disabled placeholder = "Click to get Total Price">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "opacity:0.5">Selling Price (Per Satuan)</h5>
                                    <input name = "Abc" type ="text" class = "form-control" id = "inputNominal" oninput ="decimal()" placeholder = "Selling Price">
                                </div>
                                <div class = "form-group" onclick = "getMargin()">
                                    <h5 style = "opacity:0.5">Margin</h5>
                                    <input name = "Abc"  type ="text" class = "form-control" id = "totalMargin" disabled placeholder = "Margin">
                                </div>
                                <div class = "form-group">
                                    <button type = "button" onclick = "quotationItem()" class = "col-lg-2 btn btn-primary btn-outline btn-sm">ADD TO QUOTATION</button>
                                    <button type = "button" onclick = "showItem()" class = "col-lg-2 btn btn-primary btn-outline btn-sm">SHOW QUOTATION ITEM</button>
                                </div>
                                <div class = "form-group col-lg-12">
                                    <table class = "table table-stripped col-lg-12" style = "width:100%" data-plugin = "dataTable">
                                        <thead>
                                            <th>#</th>
                                            <th>Item Request ID</th>
                                            <th>Product Name</th>
                                            <th>Amount</th>
                                            <th>Selling Price</th>
                                            <th>Margin</th>
                                            <th>Gambar</th>
                                        </thead>
                                        <tbody id ="t1">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="payment" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "opacity:0.5">Total Quotation Amount</h5>
                                    <input type = "text" id = "totalQuotation" class = "form-control" name = "total_quotation_price" readonly onclick = "countTotal()">
                                </div>
                                <div class = "row">
                                    <div class = "form-group col-lg-4 containerDp" style = ""> <!-- textarea klo DP % -->
                                        <h5 style = "opacity:0.5">DP (%)</h5>
                                        <input name = "persentase_pembayaran" id = "persenDp" oninput = "paymentWithDP()" type ="text" class = "form-control">
                                    </div>
                                    <div class = "form-group col-lg-4">
                                        <h5 style = "opacity:0.5">Payment Method</h5>
                                        <select class = "form-control" id = "paymentMethod" name = "trigger_pembayaran">
                                            <option value = "1">BEFORE DELIVERY</option>
                                        </select>
                                    </div>
                                    <div class = "form-group col-lg-4 containerDp" style = ""> <!-- Nominal DP -->
                                        <h5 style = "opacity:0.5">Jumlah DP</h5>
                                        <input name = "nominal_pembayaran" id = "jumlahDp" type ="text" class = "form-control">
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "form-group col-lg-4 containerSisa" style = ""> <!-- textarea klo DP% -->
                                        <h5 style = "opacity:0.5">Pelunasan (%)</h5>
                                        <input name = "persentase_pembayaran2" id = "persenSisa" type ="text" class = "form-control">
                                    </div>
                                    <div class = "form-group col-lg-4">
                                        <h5 style = "opacity:0.5">Payment Method</h5>
                                        <select class = "form-control" id = "paymentMethod" name = "trigger_pembayaran2">
                                            <option value = "1">BEFORE DELIVERY</option>
                                            <option value = "2" selected>AFTER DELIVERY</option>
                                        </select>
                                    </div>  
                                    <div class = "form-group col-lg-4 containerSisa" style = ""> <!-- Nominal DP -->
                                        <h5 style = "opacity:0.5">Jumlah Pelunasan</h5>
                                        <input name = "nominal_pembayaran2" id = "jumlahSisa" type ="text" class = "form-control">
                                    </div>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "opacity:0.5">Durasi Pembayaran (... minggu setelah invoice diterima)</h5>
                                    <input name = "durasi_pembayaran" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "opacity:0.5">Mata Uang Pembayaran</h5>
                                    <input name = "mata_uang_pembayaran" type ="text" value ="IDR" class = "form-control">
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
                                    <input value = "LI-<?php echo sprintf("%03d",$quotation_id);?>/QUO/<?php echo bulanRomawi(date("m"));?>/2019" type ="text" class = "form-control" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation Perihal</h5>
                                    <input name = "hal_quotation" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <input type ="text" class = "form-control perusahaanCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                    <input name = "" type ="text" class = "form-control namaCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Alamat Customer</h5>
                                    <textarea name = "alamat_perusahaan" class = "form-control" id ="alamatCust"></textarea>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Up Nama Customer</h5>
                                    <input name = "up_cp" type ="text" class = "form-control">
                                </div>
                            </div>
                            <div class="tab-pane" id="tambahan" role="tabpanel">
                                
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Durasi Pengiriman (... Minggu setelah PO di konfirmasi)</h5>
                                    <input name = "durasi_pengiriman" type ="text" class = "form-control"> Minggu
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Masa Berlaku Quotation</h5>
                                    <input name = "dateline_quotation" type ="date" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Franco</h5>
                                    <input name = "franco" id = "franco" type ="text" class = "form-control"> 
                                </div>
                                
                                <button class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                            </div>
                        </div>
                        <div class = "form-group">
                            <a href = "<?php echo base_url();?>crm/quotation" class = "btn btn-outline btn-primary btn-sm">BACK</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Example Tabs Left -->
        </div>
    </div>
</div>
