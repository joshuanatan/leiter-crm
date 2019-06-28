<div class="panel-body col-lg-12">
    <form action = "<?php echo base_url();?>crm/request/insert" method = "POST" enctype="multipart/form-data">
        <div class = "form-group">
            <h5 style = "opacity:0.5">Price Request ID</h5>
            <input name = "no_request" type = "text" class = "form-control" value = "LI-<?php echo sprintf("%03d",$maxId);?>/RFQ/<?php echo bulanRomawi(date("m"));?>/<?php echo date("Y");?>" readonly>
        </div>
        <div class = "form-group">
            <button class = "btn btn-sm btn-primary btn-outline" data-toggle = "modal" data-target = "#addNewCustomer" type = "button">ADD NEW CUSTOMER</button>
            <h5 style = "opacity:0.5">Customer Name</h5>
            
            <select id = "idperusahaan" onchange = "getContactPerson()" class = "form-control" name = "id_perusahaan" data-plugin = "select2">
                <option>Choose Customer</option>
                <?php for($a = 0; $a<count($customer);$a++):?>
                <option value = "<?php echo $customer[$a]["id_perusahaan"];?>"><?php echo $customer[$a]["nama_perusahaan"];?></option>
                <?php endfor;?>
            </select>
        </div>
        <div class = "form-group">
            <h5 style = "opacity:0.5">Customer PIC</h5>
            <select class = "form-control" name = "id_cp" id = "cpperusahaan" onchange = "getDetailContactPerson()" data-plugin="select2">
            </select>
        </div>
        <div class = "form-group">
            <h5 style = "opacity:0.5">Email PIC</h5>
            <input type = "text" class = "form-control" id = "email_cp" readonly>
        </div>
        <div class = "form-group">
            <h5 style = "opacity:0.5">Phone Number PIC</h5>
            <input type = "text" class = "form-control" id = "nohp_cp" readonly>
        </div>
        <div class = "form-group">
            <h5 style = "opacity:0.5">Franco</h5>
            <input type = "text" name = "franco" class = "form-control">
        </div>
        <div class = "form-group">
            <h5 style = "opacity:0.5">Dateline</h5>
            <input type = "date" name = "tgl_dateline_request" class = "form-control">
        </div>
        <div class="col-xl-12 form-group">
            <h5 style = "opacity:0.5">Items</h5>
            <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Notes</th>
                        <th>Attachment</th>
                    </tr>
                </thead>
                <tbody id = "t1">
                    <?php for($a = 0; $a<25; $a++):?>
                    <tr class='gradeA'>
                        <td>
                            <div class = "checkbox-custom checkbox-primary">
                                <input type = "checkbox" value = "<?php echo $a;?>" name = "checks[]">
                                <label></label>
                            </div>
                        </td>
                        <td>
                            <textarea class = "form-control" name = "item<?php echo $a;?>" placeholder="Item Description"></textarea>
                        </td>
                        <td>
                            <input type='text' class='form-control' name='jumlah_produk<?php echo $a;?>' placeholder = "Amount + Unit of Measure"/>
                        </td>
                        <td> 
                            <textarea class = "form-control" name = "notes<?php echo $a;?>"></textarea>
                        </td>
                        <td> 
                            <input type="file" name="attachment<?php echo $a;?>" class = "form-control">
                        </td>
                    </tr>
                    <?php endfor;?>
                </tbody>
            </table>
        </div>
        <div class="col-xl-12 form-group">
            <input type="hidden" value = "<?php echo $maxId;?>" class="form-control" name="id_request" placeholder="Customer ID" readonly>
        </div>
        <div class = "form-group">
            <button type = "submit" class = "btn btn-primary btn-outline col-lg-2 btn-sm">SUBMIT</button>
            <a href = "<?php echo base_url();?>crm/request" class = "btn btn-primary btn-outline col-lg-2 btn-sm">BACK</a>
        </div>
    </form>
</div>
<div class = "modal fade" id = "addNewCustomer" style = "z-index:1000000">
    <div class = "modal-dialog modal-xl">
        <div class ="modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">ADD NEW CUSTOMER</h4>
            </div>
            <form action = "<?php echo base_url();?>crm/request/insertnewcustomer" method = "POST">
                <div class = "modal-body">
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Customer Firm</h5>
                        <input type = "text" class = "form-control" name = "add_nama_customer">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Customer Segment</h5>
                        <input type = "text" class = "form-control" name = "add_segment_customer">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Customer PIC</h5>
                        <input type = "text" class = "form-control" name = "add_pic">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Gender PIC</h5>
                        <select class = "form-control" name = "add_jk_pic">
                            <option value = "Mr">MR</option>
                            <option value = "Ms">MS</option>
                        </select>
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Email PIC</h5>
                        <input type = "text" class = "form-control" name = "add_email_pic">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Phone Number PIC</h5>
                        <input type = "text" class = "form-control" name = "add_phone_pic">
                    </div>
                    <div class = "form-group">
                        <button type = "submit" class = "btn btn-primary btn-outline col-lg-2 btn-sm">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>