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
                    <form action = "<?php echo base_url();?>crm/oc/insertoc" method = "post">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation</h5>
                                    <select onchange = "quotationDetail()" id = "id_quotation" name = "id_quotation" class = "form-control" data-plugin ="select2">
                                    <option value = "0" disabled selected>Choose Quotation</option>
                                    <?php foreach($oc->result() as $a){ ?>)
                                        <option value = "<?php echo $a->id_quo;?>-<?php echo $a->versi_quo;?>"><?php echo "QUO-".sprintf("%05d",$a->id_quo);?> Ver.<?php echo $a->versi_quo;?></option>
                                    <?php 
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class = "form-group"> <!-- nanti bentuknya nomorquotation/versi -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Quotation No</h5> 
                                    <input name = "no_quo"  id="no_quo" type ="text" value = "" class = "form-control" readonly><!-- auto keisi dari onchange -->
                                    <input name = "id_quo"  id = "id_quo"  type ="hidden" value = ""/> <!-- keisi setelah dia pilih dari select itu -->
                                    <input name = "versi_quo" id = "versi_quo"  type ="hidden" value = ""/> <!-- keisi setelah dia pilih dari select itu -->
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                    <input name = "" id = "namaCust" type ="text" class = "form-control namaCust" readonly>
                                    <input name = "id_cp" id ="idCust" value = "" type ="hidden" class = "form-control"  readonly>
                                </div>
                            </div>
                            <!-- fungsi -->
                            <div class="tab-pane" id="items" role="tabpanel">
                                
                                <div class = "form-group col-lg-12">
                                    <table class = "table table-stripped col-lg-12" style = "width:100%" data-plugin = "dataTable">
                                        <thead>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Amount</th>
                                            <th>Selling Price</th>
                                            <th>Final Price</th>
                                        </thead>
                                        <tbody id ="t1">
                                            <!-- di load pake foreach abis onchange -->
                                            <!-- bentuknya checklist, nanti yang ke checklist masuk ke db -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="payment" role="tabpanel">
                                
                                <!-- nanti ngeload sesuai kebutuhan klo ada dp atau kalau ada 2x pembayaran -->
                                <div class = "form-group containerDp" style = "display:none"> <!-- textarea klo DP % -->
                                    <h5 style = "color:darkgrey; opacity:0.8">DP Percentage</h5>
                                    <input name = "persen[]" readonly id = "persenDp" value = "%" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group containerDp" style = "display:none"> <!-- Nominal DP -->
                                    <h5 style = "color:darkgrey; opacity:0.8">DP Amount</h5>
                                    <input name = "jumlah[]" readonly id = "jumlahDp" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group containerDp" style = "display:none"> <!-- Nominal DP -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Payment Trigger</h5>
                                    <input name = "jumlah[]" readonly id = "triggerDp" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group containerSisa" style = "display:none"> <!-- textarea klo DP% -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Rest Percentage</h5>
                                    <input name = "persen[]" readonly id = "persenSisa" value = "%" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group containerSisa" style = "display:none"> <!-- Nominal DP -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Rest Amount</h5>
                                    <input name = "jumlah[]" readonly id = "jumlahSisa" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group containerSisa  " style = "display:none"> <!-- Nominal DP -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Payment Trigger</h5>
                                    <input name = "jumlah[]" readonly id = "triggerSisa" type ="text" class = "form-control">
                                </div>
                                <!-- end ngeloadnya pembayaran -->
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Mata Uang Pembayaran</h5>
                                    <input name = "mata_uang_pembayaran" id = "kurs" type ="text" class = "form-control" readonly>
                                </div>
                            </div>
                            <!-- dokumen -->
                            <div class="tab-pane" id="detail" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No OC</h5>
                                    <input value = "OC-<?php echo sprintf("%05d",$maxId);?>" type ="text" class = "form-control" readonly> <!-- keisi sendiri dari db max(), bentuknya berformat -->
                                    <input value = "" type ="hidden" name = "no_oc" class = "form-control" readonly> <!-- buat isi dalam bentuk angka -->
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No PO</h5>
                                    <input name = "no_po" type ="text" class = "form-control">
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
                                    <textarea class = "form-control" id ="alamatCust" readonly></textarea>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Up Nama Customer</h5>
                                    <input name = "up_cp" id = "up_cp" type ="text" class = "form-control">
                                </div>
                            </div>
                            <div class="tab-pane" id="tambahan" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Durasi Pembayaran</h5>
                                    <input name = "durasi_pembayaran" id = "durasi_pembayaran" type ="text" class = "form-control">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Durasi Pengiriman</h5>
                                    <input name = "durasi_pengiriman" id = "durasi_pengiriman" type ="text" class = "form-control"> 
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Metode Pengiriman</h5> <!-- by air land atau sea -->
                                    <input name = "metode_pengiriman" id = "metode_courier" type ="text" class = "form-control"> 
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
