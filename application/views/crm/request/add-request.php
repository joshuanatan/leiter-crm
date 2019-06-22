<div class="panel-body col-lg-12">
    <form action = "<?php echo base_url();?>crm/request/insert" method = "POST" enctype="multipart/form-data">
        <div class = "form-group">
            <h5 style = "opacity:0.5">Price Request ID</h5>
            <input name = "no_request" type = "text" class = "form-control" value = "LI-<?php echo sprintf("%03d",$maxId);?>/RFQ/<?php echo bulanRomawi(date("m"));?>/<?php echo date("Y");?>" readonly>
        </div>
        <div class = "form-group">
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
            <button type = "submit" class = "btn btn-primary btn-outline col-lg-2">SUBMIT</button>
            <a href = "<?php echo base_url();?>crm/request" class = "btn btn-primary btn-outline col-lg-2">BACK</a>
        </div>
    </form>
</div>