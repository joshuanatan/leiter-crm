<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <button data-target="#TambahRequest" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button">
                <i class="icon wb-plus" aria-hidden="true"></i> Create Quotation
            </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="exampleAddRow">
        <thead>
            <tr>
                <th>Quotation ID</th>
                <th>Version</th>
                <th>Customer Firm</th>
                <th>Customer Name</th>
                <th>Status Quotation</th>
                <th>Sending Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($quotation->result() as $a){ ?> 
            <tr class="gradeA">
                <td><?php echo $a->no_quo;?></td>
                <td><?php echo $a->versi_quo;?></td>
                <td><?php echo $a->nama_perusahaan;?></td>
                <td><?php echo $a->nama_cp;?></td>
                <td>
                    <?php if($a->status_quo == 0){ ?> 
                    <button class = "btn btn-sm btn-primary btn-outline">ON GOING</button>
                    <?php } ?>
                    <?php if($a->status_quo == 1){ ?> 
                    <button class = "btn btn-sm btn-warning btn-outline">LOSS</button>
                    <?php } ?>
                    <?php if($a->status_quo == 2){ ?> 
                    <button class = "btn btn-sm btn-success btn-outline">ACCEPTED</button>
                    <?php } ?>
                    <?php if($a->status_quo == 3){ echo "&nbsp"; } ?> 
                </td>
                <td><?php echo $a->date_quo_add;?></td>
                <td class="actions">
                    
                    <a href = "<?php echo base_url();?>crm/quotation/edit/<?php echo $a->id_quo;?>" class="btn btn-outline btn-primary"><i class="icon wb-edit" aria-hidden="true"></i></a>
                    <!-- setelah email dikirim, gabisa di edit / dihapus -->
                    <a href = "#" class = "btn btn-outline btn-warning" data-trigger="hover" data-content="Send to Customer" data-trigger="hover" data-toggle="popover"><i class = "icon wb-chat"></i></a>

                    <button class="btn btn-outline btn-success" data-content="Put & See Customer Feedback Here" data-trigger="hover" data-toggle="popover"><i class="icon wb-eye" aria-hidden="true" data-target="#FeedbackQuotation" data-toggle="modal"></i></button>

                    <button class="btn btn-outline btn-danger" data-content="Quotation Loss" data-trigger="hover" data-toggle="popover"><i class="icon wb-trash" aria-hidden="true"></i></button> 
                    
                    <button class="btn btn-outline btn-primary" data-content="Proceed to Order Confirmation" data-trigger="hover" data-toggle="popover"><i class="icon wb-briefcase" aria-hidden="true" data-target="#FeedbackQuotation" data-toggle="modal"></i></button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="TambahRequest" aria-hidden="true" aria-labelledby="DaftarUser" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleModalTabs">Quotation Data</h4>
            </div>

            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">Primary Data</a></li>

                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#pengiriman" aria-controls="pengiriman" role="tab">T&C</a></li>

                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#produksi" aria-controls="produksi" role="tab">T&C (Cont.)</a></li>

                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#produksi2" aria-controls="produksi2" role="tab">T&C (Cont.)</a></li>

                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#items" aria-controls="items" role="tab">Items</a></li>
            </ul>
            <form action = "<?php echo base_url();?>crm/quotation/editquotation" method = "post">    
                <div class="modal-body">
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
                                <input name = "no_quo" type ="text" class = "form-control" readonly value = "QUO-<?php echo sprintf('%05d',$quotation_id) ?>">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Quotation Versi</h5>
                                <input name = "versi_quo" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Quotation Perihal</h5>
                                <input name = "hal_quo" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                <input type ="text" class = "form-control" id ="perusahaanCust" readonly>
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                <input name = "" type ="text" class = "form-control" id ="namaCust" readonly>
                                <input name = "id_cp" type ="hidden" class = "form-control" id ="idCust" readonly>
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Up Nama Customer</h5>
                                <input name = "up_cp" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Jabatan Customer</h5>
                                <input name = "jabatan_up" type ="text" class = "form-control">
                            </div>
                        </div>
                        <div class="tab-pane" id="pengiriman" role="tabpanel">
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Durasi Pengiriman</h5>
                                <input name = "durasi_pengiriman" type ="text" class = "form-control"> Minggu
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Trigger Pengiriman</h5>
                                <input name = "trigger_pengiriman" type ="text" class = "form-control"> 
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Tambahan Detail Pengiriman</h5>
                                <input name = "tambahan_pengiriman" type ="text" class = "form-control"> 
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Franco</h5>
                                <input name = "franco" type ="text" class = "form-control"> 
                            </div>
                        </div>
                        <div class="tab-pane" id="produksi" role="tabpanel">
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Jadwal Produksi</h5>
                                <input name = "jadwal_produksi" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Jadwal Pengiriman</h5>
                                <input name = "jadwal_pengiriman" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Durasi Pembayaran</h5>
                                <input name = "durasi_pembayaran" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Trigger Pembayaran</h5>
                                <input name = "trigger_pembayaran" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Tambahan Detail Pembayaran</h5>
                                <input name = "tambahan_pembayaran" type ="text" class = "form-control">
                            </div>
                        </div>
                        <div class="tab-pane" id="produksi2" role="tabpanel">
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Mata Uang Pembayaran</h5>
                                <input name = "mata_uang_pembayaran" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">PPN</h5>
                                <input name = "ppn" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Termasuk PPN</h5>
                                <select name = "termasuk_ppn" class = "form-control">
                                    <option value = "0">Termasuk</option>
                                    <option value = "1">Tidak Termasuk</option>
                                </select>
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Dateline Quotation</h5>
                                <input name = "dateline_quo" type ="date" class = "form-control">
                            </div>
                        </div>
                        <div class="tab-pane" id="items" role="tabpanel">
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Items</h5>
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
                            <input name = "Abc"  type ="hidden" value = "<?php echo $quotation_id;?>" id = "id_quo">
                            
                            <button class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="EditRequest" aria-hidden="true" aria-labelledby="DaftarUser" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleModalTabs">Quotation Data</h4>
            </div>

            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">Primary Data</a></li>

                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#pengiriman" aria-controls="pengiriman" role="tab">T&C</a></li>

                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#produksi" aria-controls="produksi" role="tab">T&C (Cont.)</a></li>

                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#produksi2" aria-controls="produksi2" role="tab">T&C (Cont.)</a></li>

                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#items" aria-controls="items" role="tab">Items</a></li>
            </ul>
            <form action = "<?php echo base_url();?>crm/quotation/insertquotation" method = "post">    
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="primaryData" role="tabpanel">
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Price Request</h5>
                                <select onchange = "detailPriceRequest()" id = "id_request" class = "form-control" data-plugin ="select2">
                                    <option selected disabled>Item Request ID</option>
                                    <?php foreach($request->result() as $a){ ?> 
                                    <option value = "<?php echo $a->id_request?>"><?php echo "REQ-".sprintf('%05d',$a->id_request);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Quotation No</h5> <!-- nanti ganti jadi select -->
                                <input name = "no_quo" type ="text" class = "form-control" readonly value = "QUO-<?php echo sprintf('%05d',$quotation_id) ?>">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Quotation Versi</h5>
                                <input name = "versi_quo" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Quotation Perihal</h5>
                                <input name = "hal_quo" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                <input type ="text" class = "form-control" id ="perusahaanCust" readonly>
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                <input name = "" type ="text" class = "form-control" id ="namaCust" readonly>
                                <input name = "id_cp" type ="hidden" class = "form-control" id ="idCust" readonly>
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Up Nama Customer</h5>
                                <input name = "up_cp" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Jabatan Customer</h5>
                                <input name = "jabatan_up" type ="text" class = "form-control">
                            </div>
                        </div>
                        <div class="tab-pane" id="pengiriman" role="tabpanel">
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Durasi Pengiriman</h5>
                                <input name = "durasi_pengiriman" type ="text" class = "form-control"> Minggu
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Trigger Pengiriman</h5>
                                <input name = "trigger_pengiriman" type ="text" class = "form-control"> 
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Tambahan Detail Pengiriman</h5>
                                <input name = "tambahan_pengiriman" type ="text" class = "form-control"> 
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Franco</h5>
                                <input name = "franco" type ="text" class = "form-control"> 
                            </div>
                        </div>
                        <div class="tab-pane" id="produksi" role="tabpanel">
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Jadwal Produksi</h5>
                                <input name = "jadwal_produksi" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Jadwal Pengiriman</h5>
                                <input name = "jadwal_pengiriman" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Durasi Pembayaran</h5>
                                <input name = "durasi_pembayaran" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Trigger Pembayaran</h5>
                                <input name = "trigger_pembayaran" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Tambahan Detail Pembayaran</h5>
                                <input name = "tambahan_pembayaran" type ="text" class = "form-control">
                            </div>
                        </div>
                        <div class="tab-pane" id="produksi2" role="tabpanel">
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Mata Uang Pembayaran</h5>
                                <input name = "mata_uang_pembayaran" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">PPN</h5>
                                <input name = "ppn" type ="text" class = "form-control">
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Termasuk PPN</h5>
                                <select name = "termasuk_ppn" class = "form-control">
                                    <option value = "0">Termasuk</option>
                                    <option value = "1">Tidak Termasuk</option>
                                </select>
                            </div>
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Dateline Quotation</h5>
                                <input name = "dateline_quo" type ="date" class = "form-control">
                            </div>
                        </div>
                        <div class="tab-pane" id="items" role="tabpanel">
                            <div class = "form-group">
                                <h5 style = "color:darkgrey; opacity:0.8">Items</h5>
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
                            <input name = "Abc"  type ="hidden" value = "<?php echo $quotation_id;?>" id = "id_quo">
                            
                            <button class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="FeedbackQuotation" aria-hidden="true" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Customer Feedback</h4>
            </div>
            <div class="modal-body">
                <form>
                    <textarea class = "form-control" rows=5 placeholder="Submit Customer Feedback Here..."></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>