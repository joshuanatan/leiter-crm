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
                    <form action = "<?php echo base_url();?>crm/oc/insertoc" method = "post">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Order Confirmation</h5>
                                    <select onchange = "oc_detail()" id = "idoc" name = "id_oc" class = "form-control" data-plugin ="select2">
                                        <option value = "0" disabled selected>Choose Order Confirmation</option>
                                        <?php for($a = 0;  $a<count($oc); $a++): ?>
                                        <option value = "<?php echo $oc[$a]["id_oc"];?>"><?php echo $oc[$a]["no_oc"];?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>
                                <div class = "form-group"> <!-- nanti bentuknya nomorquotation/versi -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Customer Po No</h5> 
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
                            </div>
                            <!-- fungsi -->
                            <div class="tab-pane" id="items" role="tabpanel">
                                <div class = "form-group">
                                    <select class = "form-control" id = "metodepembayaran" onchange = "detailPayment()">

                                    </select>
                                </div>
                                <div class = "form-group method1">
                                    <h5 style = "color:darkgrey; opacity:0.8">Payment Percentage</h5>
                                    <input name = "" id = "paymentPercentage" type ="text" class = "form-control" readonly>
                                </div>
                                <div class = "form-group method1">
                                    <h5 style = "color:darkgrey; opacity:0.8">Payment Amount</h5>
                                    <input name = "" id = "paymentAmount" type ="text" class = "form-control" readonly>
                                </div>
                                <div class = "form-group method1">
                                    <h5 style = "color:darkgrey; opacity:0.8">Payment Trigger</h5>
                                    <input name = "" id = "paymentTrigger" type ="text" class = "form-control" readonly>
                                </div>
                                <div class = "form-group col-lg-12 method2" style = "display:none">
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
                                <div class = "form-group method2" style = "display:none">
                                    <select class = "form-control" id = "orderDelivery" onchange = "detailOd()">

                                    </select>
                                </div>
                                <div class = "form-group method2" style = "display:none">
                                    <h5 style = "color:darkgrey; opacity:0.8">Delivery Item</h5>
                                    <table class = "table table-stripped col-lg-12" id="odItem" style = "width:100%;">
                                        <thead>
                                            <th>Product Name</th>
                                            <th>Amount</th>
                                            <th>Selling Price</th>
                                        </thead>
                                        <tbody id ="paymentWithOdBawah">
                                            <!-- di load pake foreach abis onchange -->
                                            <!-- bentuknya checklist, nanti yang ke checklist masuk ke db -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class = "form-group method2" style = "display:none">
                                    <h5 style = "color:darkgrey; opacity:0.8">Payment Amount</h5>
                                    <input name = "" id = "paymentAmount" type ="text" class = "form-control" readonly> <!-- nanti diisi dengan jumlah perhitungan itu-->
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
