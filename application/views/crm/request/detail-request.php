<?php foreach($request->result() as $a){ ?> 
<div class="panel-body col-lg-12">
    <form action = "<?php echo base_url();?>crm/request/submitedit" method = "POST">
        <div class="col-lg-12 col-md-12" style = "z-index:10">
            <div class="form-group">
                <div class="example-wrap">
                    <h4 class="example-title">Price Request ID</h4>
                    <input type="text" class="form-control" id="inputHelpText" value = "<?php echo "REQ-". sprintf("%05d",$a->id_request);?>" readonly>
                    <input type="hidden" name = "id_request" value = "<?php echo $a->id_request;?>" class="form-control" id="inputHelpText">
                    <span class="text-help">Before:<?php echo "REQ-". sprintf("%05d",$a->id_request);?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="example-wrap">
                    <h4 class="example-title">Price Request Dateline</h4>
                    <input type="date" class="form-control" value = "<?php echo $a->tgl_dateline_request;?>" name = "tgl_dateline_request" id="inputHelpText">
                    <?php
                    $date = date_create($a->tgl_dateline_request);

                    ?>
                    <span class="text-help">Before: <?php echo date_format($date,"d/m/Y");?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="example-wrap">
                    <h4 class="example-title">Customer Firm Name</h4>
                    <select class = "form-control" data-plugin="select2" name = "id_perusahaan" id = "idperusahaan" onchange = "getContactPerson()">
                        <option disabled selected>Choose Customer</option>
                        <?php foreach($customer->result() as $b){ ?>
                        <option value = "<?php echo $b->id_perusahaan;?>" <?php if($b->id_perusahaan == $a->id_perusahaan) echo "SELECTED"; ?> ><?php echo strtoupper($b->nama_perusahaan);?></option>
                        <?php } ?>
                    </select>
                    <span class="text-help">Before: <?php echo $a->nama_perusahaan;?></span>
                </div>
            </div>
            <div class="form-group" >
                <div class="example-wrap">
                    <h4 class="example-title">Contact Person Name</h4>
                    <select tabindex="-3" class = "form-control" name = "id_cp" data-plugin="select2" id="cpperusahaan">
                        <?php foreach($contactPerson->result() as $b){ ?> 
                        <option value = "<?php echo $b->id_cp?>"><?php echo ucwords($b->nama_cp);?></option>
                            <?php } ?>
                    </select>
                    <span class="text-help">Before: <?php echo ucwords($a->nama_cp);?></span>
                </div>
            </div>
            <div class="form-group" >
                <div class="example-wrap">
                    <button type = "submit" class = "btn btn-primary col-lg-2 col-sm-12">SAVE CHANGES</button>
                    <span class="text-help">Don't forget to save the data before adding more items</span>
                </div>
            </div>
        </div>
        
        <div class = "col-lg-12 col-md-12" style = "z-index:10">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-15">
                    <button data-target="#TambahRequest" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button">
                        <i class="icon wb-plus" aria-hidden="true"></i> Add Item Request
                    </button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>B/N Product</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Product UOM</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produkrequest->result() as $a){ ?> 
                    <tr class="gradeA">
                        <td><?php echo $a->id_produk;?></td>
                        <td><?php echo $a->bn_produk;?></td>
                        <td><?php echo $a->nama_produk;?></td>
                        <td><?php echo $a->jumlah_produk;?></td>
                        <td><?php echo $a->satuan_produk;?></td>
                        <td class="actions">

                            <a href = "<?php echo base_url();?>crm/request/delete/<?php echo $a->id_request_item;?>" class="btn btn-outline btn-danger"
                            data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></a>
                            
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <a class = "btn btn-primary btn-outline col-lg-2 col-sm-12" href = "<?php echo base_url();?>crm/request">BACK</a>
        </div>
        
        <BR/>
        <BR/>
    </form>
</div>
<?php } ?>
<div class="modal fade" id="TambahRequest" aria-hidden="false" aria-labelledby="TambahRequestLabel" style = "z-index:1000000" role="dialog">
    <div class="modal-dialog modal-simple">
        <form class="modal-content" action = "<?php echo base_url();?>crm/request/insertitems/<?php echo $id_request;?>" method = "post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleFormModalLabel">Price Request</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin="dataTable">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>UOM</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id = "t1">
                            </tbody>
                        </table>
                        <button type = "button" class = "btn btn-sm btn-success col-lg-12" onclick="add()">Add Item</button>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="hidden" value = "<?php echo $this->session->id_detail;?>" class="form-control" name="id_request" placeholder="Customer ID" readonly>
                    </div>
                </div>
                <input type = "submit" class = "btn btn-primary btn-outline">
            </div>
        </form>
    </div>
</div>

