<div class="panel-body col-lg-12">
    <div class = "form-group">
        <div class = "col-lg-6" style = "margin-left:0px; padding-left:0px">
            <select class = "form-control col-lg-6" id = "items" onchange = "loadVendorPrice()" data-plugin="select2">
                <option selected disabled>Choose Item List</option>
                <?php foreach($requestitem->result() as $a){ ?> 
                <option value = "<?php echo $a->id_request_item;?>"><?php echo $a->nama_produk;?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th style = "width:10%">Vendor Name</th>
                <th style = "width:10%">Contact Person Name</th>
                <th style = "width:15%">Vendor B/N</th>
                <th style = "width:15%">Vendor Product Name</th>
                <th style = "width:15%">Price</th>
                <th style = "width:10%">Rate</th>
                <th style = "width:10%">UOM</th>
                <th style = "width:10%">Shipping Price</th>
                <th style = "width:10%">Actions</th>
            </tr>
        </thead>
        <tbody id = "t1">
        </tbody>
    </table>
    <a href = "<?php echo base_url();?>crm/vendor" class = "btn btn-primary btn-outline">BACK</a>
</div>
