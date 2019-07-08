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
                        
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#detail" aria-controls="produksi2" role="tab">Detail OC</a></li>
                        
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#tambahan" aria-controls="pengiriman" role="tab">S&K OC</a></li>

                    </ul>
                    <form action = "<?php echo base_url();?>crm/oc/editoc" method = "post">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                            <input type = "hidden" name = "id_submit_oc" value = "<?php echo $detail["id_submit_oc"];?>">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No OC</h5>
                                    <input type = "text" value = "<?php echo $detail["no_oc"];?>" class = "form-control" readonly> <!-- keisi sendiri dari db max(), bentuknya berformat -->
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <input type ="text" id = "nama_perusahaan" value = "<?php echo $detail["nama_perusahaan"];?>" class = "form-control perusahaanCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                    <input id = "namaCust" type ="text" value = "<?php echo $detail["nama_cp"];?>" class = "form-control namaCust" readonly>
                                </div>
                            </div>
                            <!-- fungsi -->
                            <div class="tab-pane" id="items" role="tabpanel">
                                
                                <div class = "form-group col-lg-12">
                                    <table class = "table table-stripped col-lg-12" style = "width:100%">
                                        <thead>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Amount</th>
                                            <th>Final Price (Per satuan)</th>
                                        </thead>
                                        <tbody id ="t1">
                                            <?php for($item = 0; $item<count($items); $item++):?>
                                            <tr>
                                                <td>
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input id="checks<?php echo $item;?>" name = "checkbox[]" <?php if($items[$item]["status_oc_item"] == 0) echo "checked";?> value = "<?php echo $item;?>" type="checkbox"/>
                                                        <label for="inputChecked"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <textarea name = "nama_oc_item[]" class = "form-control"><?php echo $items[$item]["nama_oc_item"]?></textarea>

                                                    <input type = "hidden" name = "id_oc_item[]" class = "form-control" value = "<?php echo $items[$item]["id_oc_item"]?>">
                                                </td>
                                                <td>
                                                    <input id = "jumlah_produk<?php echo $item;?>" type = "text" name = "final_amount[]" class = "form-control" value = "<?php echo $items[$item]["final_amount"]?> <?php echo $items[$item]["satuan_produk"]?>">
                                                </td>
                                                <td>
                                                    <input id = "selling_price<?php echo $item;?>" oninput = "commas('selling_price<?php echo $item;?>')" type = "text" name = "final_selling_price[]" class = "form-control" value = "<?php echo number_format($items[$item]["final_selling_price"]);?>">
                                                </td>
                                            </tr>
                                            <?php endfor;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="payment" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "opacity:0.5">Total Quotation Amount</h5>
                                    <input type = "text" id = "totalQuotation" value = "<?php echo number_format($detail["total_oc_price"]);?>" class = "form-control" name = "total_oc_price" readonly onclick = "countTotal()">
                                </div>
                                <div class = "row">
                                    <div class = "form-group col-lg-4 containerDp" style = ""> <!-- textarea klo DP % -->
                                        <h5 style = "opacity:0.5">DP (%)</h5>
                                        <input name = "persentase_pembayaran" value = "<?php echo $pembayaran["persentase_pembayaran"];?>%" id = "persenDp" oninput = "paymentWithDP()" type ="text" class = "form-control">
                                    </div>
                                    <div class = "form-group col-lg-4">
                                        <h5 style = "opacity:0.5">Payment Method</h5>
                                        <select class = "form-control" id = "paymentMethod" name = "trigger_pembayaran">
                                            <option value = "1">BEFORE DELIVERY</option>
                                        </select>
                                    </div>
                                    <div class = "form-group col-lg-4 containerDp" style = ""> <!-- Nominal DP -->
                                        <h5 style = "opacity:0.5">Jumlah DP</h5>
                                        <input name = "nominal_pembayaran" value = "<?php echo number_format($pembayaran["nominal_pembayaran"]);?>" id = "jumlahDp" type ="text" class = "form-control">
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "form-group col-lg-4 containerSisa" style = ""> <!-- textarea klo DP% -->
                                        <h5 style = "opacity:0.5">Pelunasan (%)</h5>
                                        <input name = "persentase_pembayaran2" value = "<?php echo $pembayaran["persentase_pembayaran2"];?>%" id = "persenSisa" type ="text" class = "form-control">
                                    </div>
                                    <div class = "form-group col-lg-4">
                                        <h5 style = "opacity:0.5">Payment Method</h5>
                                        <select class = "form-control" id = "paymentMethod" name = "trigger_pembayaran2">
                                            <option value = "2">AFTER DELIVERY</option>
                                            <option value = "1" <?php if($pembayaran["trigger_pembayaran2"] == 1) echo "selected"; ?> >BEFORE DELIVERY</option>
                                        </select>
                                    </div>  
                                    <div class = "form-group col-lg-4 containerSisa" style = ""> <!-- Nominal DP -->
                                        <h5 style = "opacity:0.5">Jumlah Pelunasan</h5>
                                        <input name = "nominal_pembayaran2" value = "<?php echo number_format($pembayaran["nominal_pembayaran2"]);?>" id = "jumlahSisa" type ="text" class = "form-control">
                                    </div>
                                </div>
                                <!-- end ngeloadnya pembayaran -->
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Durasi Pembayaran</h5>
                                    <input name = "durasi_pembayaran" value = "<?php echo $detail["durasi_pembayaran"];?>" id = "durasi_pembayaran" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Mata Uang Pembayaran</h5>
                                    <input name = "mata_uang_pembayaran" value = "<?php echo $pembayaran["kurs"];?>" id = "kurs" type ="text" class = "form-control">
                                </div>
                            </div>
                            <!-- dokumen -->
                            <div class="tab-pane" id="detail" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No OC</h5>
                                    <input name ="no_oc" value = "<?php echo $detail["no_oc"];?>" type ="text" class = "form-control" readonly> <!-- keisi sendiri dari db max(), bentuknya berformat -->
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No PO Customer</h5>
                                    <input name = "no_po_customer" value = "<?php echo $detail["no_po_customer"];?>" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Tanggal PO Customer</h5>
                                    <input name = "tgl_po_customer" type ="date" class = "form-control" value = "<?php echo $detail["tgl_po_customer"];?>">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <input type ="text" value = "<?php echo $detail["nama_perusahaan"];?>" class = "form-control perusahaanCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                    <input type ="text" value = "<?php echo $detail["nama_cp"];?>" class = "form-control namaCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Alamat Customer</h5>
                                    <textarea class = "form-control" id ="alamatCust" readonly><?php echo $detail["alamat_perusahaan"];?></textarea>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Up Nama Customer</h5>
                                    <input name = "up_cp" id = "up_cp" type ="text" class = "form-control" value = "<?php echo $detail["up_cp"];?>"> 
                                </div>
                            </div>
                            <div class="tab-pane" id="tambahan" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Durasi Pengiriman</h5>
                                    <input name = "durasi_pengiriman" id = "durasi_pengiriman" value = "<?php echo $detail["durasi_pengiriman"];?>" type ="text" class = "form-control"> 
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Metode Pengiriman</h5> <!-- by air land atau sea -->
                                    <input name = "metode_pengiriman" id = "metode_courier" value = "<?php echo $detail["metode_pengiriman"];?>" type ="text" class = "form-control"> 
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Franco</h5>
                                    <input name = "franco" id = "franco" type ="text" value = "<?php echo $detail["franco"];?>" class = "form-control"> 
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
