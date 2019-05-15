<div class="panel-body col-lg-12">
    <div class = "form-group">
        <form action = "<?php echo base_url();?>crm/vendor/insertshippingdata" method = "post">
            <div class = "col-lg-6" style = "margin-left:0px; padding-left:0px">
                <select class = "form-control" id = "items" name = "items" onchange = "loadVendorPrice()" data-plugin="select2">
                    <option selected disabled>Choose Item List</option>
                    <?php foreach($requestitem->result() as $a){ ?> 
                    <option value = "<?php echo $a->id_request_item;?>"><?php echo $a->nama_produk;?></option>
                    <?php } ?>
                </select>
                <BR/>
                <select class = "form-control" id = "shipper" name = "id_perusahaan" onchange = "loadShippingMethod()" data-plugin="select2">
                    <option selected disabled>Choose Shipping Vendor Name</option>
                    <?php foreach($shipper->result() as $a){ ?> 
                    <option value = "<?php echo $a->id_perusahaan;?>"><?php echo $a->nama_perusahaan;?></option>
                    <?php } ?>
                </select>
                <br/>
                <select class = "form-control" id = "cp" name = "id_cp" data-plugin="select2">
                    <option selected disabled>Choose Shipping Vendor CP</option>
                </select>
                <br/>
                <select class = "form-control" id = "metodePengiriman" name = "metode_pengiriman" onchange = "loadShippingPrice()" data-plugin="select2">
                    <option selected disabled>Choose Shipping Method</option>
                </select>
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
