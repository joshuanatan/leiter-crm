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
                    <form action = "<?php echo base_url();?>crm/quotation/insertrevision" method = "post">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Price Request</h5>
                                    <input name = "" type ="text" class = "form-control" readonly value = "REQ-<?php echo sprintf("%05d",$quotation["id_request"]);?>">
                                    <input name = "id_request" type ="hidden" class = "form-control" readonly value = "<?php echo $quotation["id_request"];?>">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation No</h5> <!-- nanti ganti jadi select -->
                                    <input name = "no_quo" type ="text" class = "form-control" readonly value = "<?php echo $quotation["no_quo"];?>">
                                    <input name = "id_quo" id = "id_quo" type ="hidden" class = "form-control" readonly value = "<?php echo $quotation["id_quo"];?>"> <!-- quotation yang baru -->
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation Version</h5>
                                    <input value = "<?php echo $quotation["quo_versi"]?>" type ="text" class = "form-control" readonly> <!-- pertama yang dibuka dulu, pas insert baru masuk yang baru -->
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation New Version</h5>
                                    <input id= "versi_quo" name = "versi_quo" value = "<?php echo $last_version;?>" type ="text" class = "form-control" readonly> <!-- pertama yang dibuka dulu, pas insert baru masuk yang baru -->
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <input type ="text" class = "form-control" value = "<?php echo $quotation["nama_perusahaan"];?>" id ="perusahaanCust" readonly>
                                    <input type ="hidden" name = "id_perusahaan" class = "form-control" value = "<?php echo $quotation["id_perusahaan"];?>" id ="perusahaanCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                    <input type ="text" class = "form-control" value = "<?php echo $quotation["nama_cp"];?>" id ="namaCust" readonly>
                                    <input name = "id_cp" type ="hidden" class = "form-control" value = "<?php echo $quotation["id_cp"];?>" id ="namaCust" readonly>
                                </div>
                            </div>
                            <!-- fungsi -->
                            <div class="tab-pane" id="items" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Items</h5>
                                    <select class = "form-control" id = "itemsOrdered" onchange = "loadVendors()">
                                        <option selected disabled>Choose Item</option>
                                        <?php for($a = 0 ; $a<count($items); $a++): ?>
                                        <option value = "<?php echo $items[$a]["id_request_item"];?>"><?php echo $items[$a]["nama_produk"];?></option>
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
                                <div class = "form-group" onclick = "getTotal()">
                                    <h5 style = "color:darkgrey; opacity:0.8">Total Price</h5>
                                    <input name = "Abc"  type ="text" class = "form-control" id = "totalPrice" disabled placeholder = "Click to get Total Price">
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
                                    <button type = "button" onclick = "quotationItem()" class = "btn btn-primary btn-outline">ADD TO QUOTATION</button>
                                </div>
                                <div class = "form-group col-lg-12">
                                    <table class = "table table-stripped col-lg-12" style = "width:100%" data-plugin = "dataTable">
                                        <thead>
                                            <th>Item Request ID</th>
                                            <th>Product Name</th>
                                            <th>Supplier</th>
                                            <th>Selling Price</th>
                                            <th>Margin</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id ="t1">
                                            <?php for($a= 0; $a<count($quotation_item); $a++):?>
                                            <tr>
                                                <td><?php echo $quotation_item[$a]["id_request_item"];?></td>
                                                <td><?php echo $quotation_item[$a]["nama_produk"];?></td>
                                                <td><?php echo $quotation_item[$a]["jumlah"];?></td>
                                                <td><?php echo number_format($quotation_item[$a]["selling_price"]);?></td>
                                                <td><?php echo $quotation_item[$a]["margin"];?></td>
                                                <td><button type = 'button' class = 'btn btn-danger btn-outline btn-sm' onclick = 'removeQuotationItem("<?php echo $quotation_item[$a]["id_quotation_item"];?>")' >REMOVE</button></td>
                                            </tr>

                                            <?php endfor;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="payment" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Payment Method</h5>
                                    <select class = "form-control" id = "paymentMethod" name = "paymentMethod" onchange = "paymentMethodForm()">
                                        <option value = "01" <?php if($metode_pembayaran[0]["trigger_pembayaran"].$metode_pembayaran[1]["trigger_pembayaran"] == '01') echo "selected";?>>Full Before Delivery</option>
                                        <option value = "02" <?php if($metode_pembayaran[0]["trigger_pembayaran"].$metode_pembayaran[1]["trigger_pembayaran"] == '02') echo "selected";?>>Full After Delivery</option>
                                        <option value = "11" <?php if($metode_pembayaran[0]["trigger_pembayaran"].$metode_pembayaran[1]["trigger_pembayaran"] == '11') echo "selected";?>>DP & Rest Before Delivery</option>
                                        <option value = "12" <?php if($metode_pembayaran[0]["trigger_pembayaran"].$metode_pembayaran[1]["trigger_pembayaran"] == '12') echo "selected";?>>DP & Rest After Delivery</option>
                                    </select>
                                </div>
                                <?php 
                                if(count($metode_pembayaran) == 1){ 
                                    if($metode_pembayaran["trigger_pembayaran"] == 1){ ?> <!--full sebelum pengiriman -->

                                    <?php
                                    }
                                    else{ ?> <!-- full sesudah pengiriman -->
                                    <div class = "form-group containerSisa"> <!-- textarea klo DP% -->
                                        <h5 style = "color:darkgrey; opacity:0.8">Rest Percentage</h5>
                                        <input name = "persen[]" type ="text" value = "<?php echo $metode_pembayaran[0]["persentase_pembayaran"];?>" class = "form-control">
                                    </div>
                                    <div class = "form-group containerSisa"> <!-- Nominal DP -->
                                        <h5 style = "color:darkgrey; opacity:0.8">Rest Amount</h5>
                                        <input name = "jumlah[]" type ="text" value = "<?php echo $metode_pembayaran[0]["nominal_pembayaran"];?>" class = "form-control">
                                    </div>

                                    <?php
                                    }
                                    ?> <!-- kalau tipe 1/2 -->
                                <?php 
                                } 
                                else{ ?>
                                    <div class = "form-group containerDp"> <!-- textarea klo DP % -->
                                        <h5 style = "color:darkgrey; opacity:0.8">DP Percentage</h5>
                                        <input oninput = "paymentWithDP()" id = "persenDp" name = "persen[]" type ="text" value = "<?php echo number_format($metode_pembayaran[0]["persentase_pembayaran"]);?>" class = "form-control">
                                    </div>
                                    <div class = "form-group containerDp"> <!-- Nominal DP -->
                                        <h5 style = "color:darkgrey; opacity:0.8">DP Amount</h5>
                                        <input name = "jumlah[]" id = "jumlahDp" type ="text" value = "<?php echo number_format($metode_pembayaran[0]["nominal_pembayaran"]);?>" class = "form-control" readonly>
                                    </div>
                                    <div class = "form-group containerSisa"> <!-- textarea klo DP% -->
                                        <h5 style = "color:darkgrey; opacity:0.8">Rest Percentage</h5>
                                        <input name = "persen[]" type ="text" value = "<?php echo number_format($metode_pembayaran[1]["persentase_pembayaran"]);?>" id = "persenSisa" class = "form-control" readonly>
                                    </div>
                                    <div class = "form-group containerSisa"> <!-- Nominal DP -->
                                        <h5 style = "color:darkgrey; opacity:0.8">Rest Amount</h5>
                                        <input name = "jumlah[]" type ="text" value = "<?php echo number_format($metode_pembayaran[1]["nominal_pembayaran"]);?>" id = "jumlahSisa" class = "form-control" readonly>
                                    </div>
                                <?php 
                                }
                                ?>
                                
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Mata Uang Pembayaran</h5>
                                    <input name = "mata_uang_pembayaran" type ="text" value = "<?php echo $metode_pembayaran[0]["mata_uang"];?>" class = "form-control">
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
                                    <input name = "no_quo" value = "<?php echo $quotation["no_quo"];?> Rev <?php echo $id_revision;?>" type ="text" class = "form-control" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation Perihal</h5>
                                    <input name = "hal_quo" value = "<?php echo $quotation["hal_quo"];?>" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <input type ="text" value = "<?php echo $quotation["nama_perusahaan"];?>" class = "form-control" id ="perusahaanCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                    <input name = "" type ="text" class = "form-control" value = "<?php echo $quotation["nama_cp"];?>"  id ="namaCust" readonly>
                                    <input type ="hidden" class = "form-control" id ="idCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Alamat Customer</h5>
                                    <textarea class = "form-control" id ="alamatCust" name = "alamat_perusahaan"><?php echo $quotation["alamat_perusahaan"];?></textarea>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Up Nama Customer</h5>
                                    <input name = "up_cp" value = "<?php echo $quotation["up_cp"];?>" type ="text" class = "form-control">
                                </div>
                            </div>
                            <div class="tab-pane" id="tambahan" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Durasi Pembayaran</h5>
                                    <input name = "durasi_pembayaran" value = "<?php echo $quotation["durasi_pembayaran"];?>"  type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Durasi Pengiriman</h5>
                                    <input name = "durasi_pengiriman" value = "<?php echo $quotation["durasi_pengiriman"];?>" type ="text" class = "form-control"> Minggu
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Masa Berlaku Quotation</h5>
                                    <input name = "dateline_quo" type ="date" value = "<?php echo $quotation["dateline_quo"];?>" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Franco</h5>
                                    <input name = "franco" type ="text" value = "<?php echo $quotation["franco"];?>" class = "form-control"> 
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
