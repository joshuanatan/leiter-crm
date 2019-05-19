<div class="panel-body col-lg-12">
    <div class = "form-group">
        <form action = "<?php echo base_url();?>crm/vendor/insertshippingdata" method = "post">
         
        <input type = "hidden" readonly class = "form-control" value = "SUPPLIER" id = "purpose" name = "shipping_purpose">
            <div class = "col-lg-12" style = "margin-left:0px; padding-left:0px">
            <?php foreach($requestitem->result() as $a){ ?>
                <div class="form-group">
                    <h4 class="example-title">PRICE REQUEST ITEM ID</h4>    
                    <input name = "items" type="text" class="form-control" id="items" placeholder="placeholder" readonly value = "<?php echo $a->id_request_item;?>">
                </div>
                <div class="form-group">
                    <h4 class="example-title">ITEM NAME</h4>
                    <input type="text" class="form-control" id="inputPlaceholder" placeholder="placeholder" readonly value = "<?php echo ucwords($a->nama_produk);?>">
                </div>
                <div class="form-group">
                    <h4 class="example-title">ITEM DIMENSION</h4>
                    <input type="text" class="form-control" id="inputPlaceholder" placeholder="placeholder" readonly value = "<?php echo ucwords($a->jumlah_produk)." ".$a->satuan_produk;?>">
                </div>
            <?php } ?>
            <?php foreach($supplier->result() as $a){ ?> 
                <div class="form-group">
                    <h4 class="example-title">SUPPLIER NAME</h4>
                    <input type="text" class="form-control" id="inputPlaceholder" placeholder="placeholder" readonly value = "<?php echo ucwords($a->nama_perusahaan);?>">
                    <input type="hidden" name = "id_supplier" value = "<?php echo $a->id_perusahaan;?>">
                </div>
                <div class="form-group">
                    <h4 class="example-title">SUPPLIER ADDRESS</h4>
                    <textarea class="form-control" id="inputPlaceholder" placeholder="placeholder" rows=5 readonly><?php echo ucwords($a->alamat_perusahaan);?></textarea>
                </div>
            <?php } ?>
                <div class="form-group">
                    <h4 class="example-title">SHIPPER NAME</h4>
                    <select class = "form-control" id = "shipper" name = "id_perusahaan" onchange = "loadShippingMethod()" data-plugin="select2">
                        <option selected disabled>Choose Shipping Vendor Name</option>
                        <?php foreach($shipper->result() as $a){ ?> 
                        <option value = "<?php echo $a->id_perusahaan;?>"><?php echo $a->nama_perusahaan;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <h4 class="example-title">SHIPPER CONTACT PERSON</h4>
                    <select class = "form-control" id = "cp" name = "id_cp" data-plugin="select2">
                        <option selected disabled>Choose Shipping Vendor CP</option>
                    </select>
                </div>
                <div class="form-group">
                    <h4 class="example-title">SHIPPING METHOD</h4>
                    <select class = "form-control" id = "metodePengiriman" name = "metode_pengiriman" onchange = "loadShippingPrice()" data-plugin="select2">
                        <option selected disabled>Choose Shipping Method</option>
                    </select>
                </div>
            </div>
            <table class="table table-bordered table-hover table-striped w-full"  cellspacing="0" data-plugin = "dataTable">
                <thead>
                    <tr>
                        <th>Variable Name</th>
                        <th>Variable Cost</th>
                        <th>Variable Rate</th>
                        <th>Variable Total Cost</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id ="shippingVariablePrice">
                
                </tbody>
                <button style = "margin-bottom:20px" type = "button" class = "btn btn-sm col-lg-12 btn-primary btn-outline" onclick = "addVariable()">Add Shipping Variable</button>
            </table><br/>
            <button type = "submit" class = "btn btn-primary btn-outline col-lg-2 col-sm-12">SAVE CHANGES</button>
            <a href = "<?php echo base_url();?>crm/vendor/produk/<?php echo $this->session->id_request;?>" class = "btn btn-primary btn-outline col-lg-2 col-sm-12">BACK</a>
        </form>
    </div>
</div>
