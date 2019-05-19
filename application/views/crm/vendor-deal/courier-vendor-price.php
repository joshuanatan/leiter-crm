<div class="panel-body col-lg-12">
    <div class = "form-group">
        <form action = "<?php echo base_url();?>crm/vendor/insertcouriershippingdata" method = "post">
            <div class = "col-lg-12" style = "margin-left:0px; padding-left:0px">
                <div class="form-group">
                    <h4 class="example-title">PRICE REQUEST ITEM ID</h4>    
                    <select class = "form-control" id = "items" name = "items" onchange = "loadItemData()" data-plugin="select2">
                        <option selected disabled>Choose Item List</option>
                        <?php foreach($requestitem->result() as $a){ ?> 
                        <option value = "<?php echo $a->id_request_item;?>"><?php echo $a->nama_produk;?></option>
                        <?php } ?>
                    </select>
                </div>
                <input type = "hidden" readonly class = "form-control" value = "CUSTOMER" name = "shipping_purpose" id = "purpose">
                <div class="form-group">
                    <h4 class="example-title">Product Dimension</h4>    
                    <input type = "text" class = "form-control" readonly id = "dimension">
                </div>
                <div class="form-group">
                    <h4 class="example-title">Franco</h4>    
                    <input type = "text" readonly class = "form-control" value = "<?php echo $a->franco;?>">
                </div>
                <div class="form-group">
                    <h4 class="example-title">Shipping Vendor</h4>    
                    <select class = "form-control" id = "shipper" name = "id_perusahaan" onchange = "loadShippingMethod()" data-plugin="select2">
                        <option selected disabled>Choose Shipping Vendor Name</option>
                        <?php foreach($shipper->result() as $a){ ?> 
                        <option value = "<?php echo $a->id_perusahaan;?>"><?php echo $a->nama_perusahaan;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <h4 class="example-title">Shipping Vendor Contact Person</h4>    
                    <select class = "form-control" id = "cp" name = "id_cp" data-plugin="select2">
                        <option selected disabled>Choose Shipping Vendor</option>
                    </select>
                </div>
                <div class="form-group">
                    <h4 class="example-title">Shipping Method</h4>    
                    <select class = "form-control" id = "metodePengiriman" name = "metode_pengiriman" onchange = "loadCourierPrice()" data-plugin="select2">
                        <option selected disabled>Choose Shipping Vendor CP</option>
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
            <a href = "<?php echo base_url();?>crm/vendor" class = "btn btn-primary btn-outline">BACK</a>
            <input type = "submit" class = "btn btn-primary btn-outline" type = "submit">
        </form>
    </div>
</div>
