<div class="panel-body col-lg-12">
    <div class="row row-lg">
        <div class="col-xl-12">
            <!-- Example Tabs Left -->
            <div class="example-wrap">
                <div class="nav-tabs-vertical" data-plugin="tabs">
                    <ul class="nav nav-tabs mr-25" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">Primary Data</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#items" aria-controls="pengiriman" role="tab">Items</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#dokumen" aria-controls="pengiriman" role="tab">Dokumen</a></li>

                    </ul>
                    <form action = "<?php echo base_url();?>crm/od/createod" method = "post">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No Order Delivery</h5>
                                    <input type ="text" value = "OD-<?php echo sprintf("%05d",$maxId);?>" name = "no_od" class = "form-control" readonly>
                                    <input type ="hidden" value = "<?php echo $maxId;?>" name = "id_od" class = "form-control" readonly>
                                </div>
                                <div class = "form-group"> <!-- nanti bentuknya nomorquotation/versi -->
                                    <h5 style = "color:darkgrey; opacity:0.8">Order Confirmation No</h5> 
                                    <select name = "id_oc" class = "form-control" onchange = "loadOcDetail()" data-plugin = "select2" id = "idoc">
                                        <option selected>Choose No OC</option>
                                        <?php foreach($order_confirmation->result() as $a): ?>
                                        <option value = "<?php echo $a->id_oc;?>"><?php echo $a->no_oc;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No PO Customer</h5>
                                    <input type ="text" id = "nopo" class = "form-control perusahaanCust" readonly>
                                </div>
                                
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Customer Firm</h5>
                                    <input type ="text" id = "namaperusahaan" class = "form-control perusahaanCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Customer Name</h5>
                                    <input name = "" id = "namacustomer" type ="text" class = "form-control namaCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Franco</h5>
                                    <input name = "" id = "franco" type ="text" class = "form-control namaCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Courier</h5>
                                    <select name = "courier" class = "form-control" onchange = "loadDeliveryMethod()" data-plugin = "select2" id = "idcourier">
                                        <option selected>Choose Courier</option>
                                        <?php foreach($courier->result() as $a): ?>
                                        <option value = "<?php echo $a->id_perusahaan;?>"><?php echo $a->nama_perusahaan;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Delivery Method</h5>
                                    <select name = "method" id = "method" class = "form-control namaCust">
                                        
                                    </select>
                                </div>
                            </div>
                            <!-- fungsi -->
                            <div class="tab-pane" id="items" role="tabpanel">
                                
                                <div class = "form-group col-lg-12">
                                    <table class = "table table-stripped col-lg-12" style = "width:100%">
                                        <thead>
                                            <th>Product Name</th>
                                            <th>Order Quantity</th>
                                            <th>Sent Quantity</th>
                                            <th>Send Amount</th>
                                            <th>Unit of Measure</th>
                                        </thead>
                                        <tbody id ="t1">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="dokumen" role="tabpanel">
                                
                                <div class = "form-group col-lg-12">
                                    <div class = "form-group">
                                        <button type = "submit" class = "col-lg-2 btn btn-outline btn-primary">SUBMIT</button>
                                    </div>
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
