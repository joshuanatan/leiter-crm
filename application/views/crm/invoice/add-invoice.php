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
                    <form action = "<?php echo base_url();?>crm/invoice/createinvoice" method = "post">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <!--<div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Order Confirmation</h5>
                                    <select onchange = "oc_detail()" id = "idoc" name = "id_oc" class = "form-control" data-plugin ="select2">
                                        <option value = "0" disabled selected>Choose Order Confirmation</option>
                                        <?php for($a = 0;  $a<count($oc); $a++): ?>
                                        <option value = "<?php echo $oc[$a]["id_oc"];?>"><?php echo $oc[$a]["no_oc"];?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>-->
                                <div class = "form-group"> <!-- nanti bentuknya nomorquotation/versi -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Invoice No</h5> <!-- max id -->
                                    <input id="nopo" name = "no_invoice" type ="text" value = "INV-<?php echo sprintf("%05d",$maxId);?>" class = "form-control" readonly><!-- auto keisi dari onchange -->
                                    <input id="" name = "id_invoice" type ="hidden" value = "<?php echo $maxId;?>" class = "form-control" readonly><!-- auto keisi dari onchange -->
                                </div>
                                <div class = "form-group"> <!-- nanti bentuknya nomorquotation/versi -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Order Confirmation No</h5> <!-- ngejax di item --> 
                                    <select class = "form-control" name = "id_oc" id = "idoc" onchange = "oc_detail()">
                                        <option value = "0">Choose Order Confirmation No</option>
                                        <?php for($a = 0; $a<count($oc);$a++):?>
                                        <option value = "<?php echo $oc[$a]["id_oc"];?>"><?php echo $oc[$a]["no_oc"];?></option><
                                        <?php endfor;?>
                                    </select><!-- auto keisi dari onchange -->
                                </div>
                                <div class = "form-group"> <!-- nanti bentuknya nomorquotation/versi -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Customer PO No</h5> <!-- ngejax di item --> 
                                    <input id="nopo" type ="text" value = "" class = "form-control" readonly><!-- auto keisi dari onchange -->
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <input type ="text" id = "namaperusahaan" class = "form-control" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                    <input name = "" id = "namaCust" type ="text" class = "form-control namaCust" readonly>
                                </div>
                                <div class = "form-group"> <!-- nanti bentuknya nomorquotation/versi -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Payment Type</h5> <!-- ngejax di item --> 
                                    <select class = "form-control" id = "paymentType" onchange = "changePayment()">
                                        <option value = "0">Choose Payment Type</option>
                                        <option value = "1">Down Payment</option>
                                        <option value = "2">Order Delivery</option>
                                    </select>
                                </div>
                                <div class = "form-group"> <!-- nanti bentuknya nomorquotation/versi -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Order Delivery No</h5> <!-- ngejax di item --> 
                                    <select class = "form-control" name = "id_od" id = "od" onchange = "loadOdItem()">
                                        <option>Choose Order Delivery No</option>
                                    </select>
                                </div>
                                
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Franco</h5>
                                    <input name = "" id = "franco" type ="text" class = "form-control namaCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Up</h5>
                                    <input name = "" id = "up" type ="text" class = "form-control namaCust">
                                </div>
                            </div>
                            <!-- fungsi -->
                            <div class="tab-pane" id="items" role="tabpanel">
                                <div class = "form-group col-lg-12 method2">
                                    <table class = "table table-stripped col-lg-12" id="paymentWithOd" style = "width:100%;">
                                        <thead>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Amount</th>
                                            <th>Selling Price</th>
                                            <th>Final Price</th>
                                        </thead>
                                        <tbody id ="paymentWithOdT1">
                                            <!-- di load pake foreach abis onchange -->
                                            <!-- bentuknya checklist, nanti yang ke checklist masuk ke db -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class = "form-group">
                                    <button type = "submit" class = "btn btn-primary btn-outline">CREATE INVOICE</button>
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
