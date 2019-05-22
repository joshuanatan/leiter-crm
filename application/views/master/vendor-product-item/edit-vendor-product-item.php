<div class="panel-body col-lg-12">
    <div class="row row-lg">
        <div class="col-xl-12">
            <!-- Example Tabs Left -->
            <div class="example-wrap">
                <div class="nav-tabs-vertical" data-plugin="tabs">
                    <ul class="nav nav-tabs nav-tabs-line mr-25" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">LEITER Product Data</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#items" aria-controls="items" role="tab">Supplier Product Data</a></li>
                    </ul>
                    <form action = "<?php echo base_url();?>crm/quotation/insertquotation" method = "post">    
                        
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Price Request</h5>
                                    <input name = "" type ="text" class = "form-control" readonly value = "">
                                    <input name = "id_request" id = "id_request" type ="hidden" class = "form-control" readonly value = "">
                                </div>
                            </div>
                            <div class="tab-pane" id="pengiriman" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Durasi Pengiriman</h5>
                                    <input name = "durasi_pengiriman" type ="text" value = "" class = "form-control"> Minggu
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
