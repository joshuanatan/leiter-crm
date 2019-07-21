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
                    </ul>
                    <form action = "<?php echo base_url();?>crm/oc/dataentry" method = "post">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No OC</h5>
                                    <input type ="text" name = "no_oc" class = "form-control" placeholder = "LI20190001">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No PO Customer</h5>
                                    <input name = "no_po_customer" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Tanggal PO Customer</h5>
                                    <input name = "tgl_po_customer" type ="date" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <select class = "form-control" data-plugin="select2" name = "id_perusahaan">
                                        <?php for($a = 0; $a<count($customer); $a++):?>
                                        <option value = "<?php echo $customer[$a]["id_perusahaan"];?>-<?php echo $customer[$a]["id_cp"];?>"><?php echo $customer[$a]["nama_perusahaan"];?> - <?php echo $customer[$a]["nama_cp"];?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Franco</h5>
                                    <input name = "franco" id = "franco" type ="text" class = "form-control"> 
                                </div>
                            </div>
                            <!-- fungsi -->
                            <div class="tab-pane" id="items" role="tabpanel">
                                
                                <div class = "form-group col-lg-12">
                                    <table class = "table table-stripped col-lg-12" style = "width:100%" data-plugin = "dataTable">
                                        <thead>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Amount</th>
                                            <th>Final Price (Per item)</th>
                                        </thead>
                                        <tbody id ="t1">
                                            <?php for($a = 0; $a<20; $a++):?>
                                            <tr>
                                                <td>
                                                    <select class = "form-control" name = "id_produk[]" data-plugin="select2">
                                                        <option value = "">Pilih Produk</option>
                                                        <?php for($prod_counter = 0; $prod_counter < count($produk); $prod_counter++):?>
                                                        <option value = "<?php echo $produk[$prod_counter]["id_produk"];?>"><?php echo $produk[$prod_counter]["nama_produk"];?></option>
                                                        <?php endfor;?>
                                                    </select>
                                                </td>
                                                <td><textarea name = "nama_oc_item[]" class = "form-control"></textarea></td>
                                                <td><input type = "text" id = "jumlah_produk<?php echo $a;?>" name = "final_amount[]" class = "form-control"></td>
                                                <td><input type = "text" id = "selling_price<?php echo $a;?>" oninput = "commas('selling_price<?php echo $a;?>')" name ="final_selling_price[]" class = "form-control"></td>
                                            </tr>
                                            <?php endfor;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="payment" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "opacity:0.5">Total oc Amount</h5>
                                    <input type = "text" id = "totalQuotation" class = "form-control" name = "total_oc_price" onclick = "countTotalDataEntry()">
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
                                <!-- end ngeloadnya pembayaran -->
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Mata Uang Pembayaran</h5>
                                    <input name = "mata_uang_pembayaran" id = "kurs" type ="text" class = "form-control">
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
