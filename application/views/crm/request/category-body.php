<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <button data-target="#TambahRequest" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button">
                <i class="icon wb-plus" aria-hidden="true"></i> Add Price Request
            </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Company Name</th>
                <th>Contact Person</th>
                <th>Franco</th>
                <th>Items Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($request->result() as $a){ ?> 
            <tr class="gradeA">
                <td>REQ-<?php echo sprintf("%05d",$a->id_request) ?></td>
                <td><?php echo $a->nama_perusahaan ?></td>
                <td><?php echo ucwords($a->nama_cp) ?></td>
                <td><?php echo ucwords($a->franco) ?></td>
                <td><?php echo $a->a." Items";?></td>
                <td class="actions">
                    
                    <a href = "<?php echo base_url();?>crm/request/items/<?php echo $a->id_request;?>" class="btn btn-outline btn-primary"><i class="icon wb-edit" aria-hidden="true"></i></a>
                    <a href = "<?php echo base_url();?>crm/request/remove/<?php echo $a->id_request;?>" class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></a>
                    <a href = "<?php echo base_url();?>crm/request/submit/<?php echo $a->id_request;?>" class="btn btn-outline btn-success"
                    data-toggle="tooltip"><i class="icon wb-check" aria-hidden="true"></i></a>
                    
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="TambahRequest" aria-hidden="false" aria-labelledby="TambahRequestLabel" role="dialog">
    <div class="modal-dialog modal-simple">
        <form class="modal-content" action = "<?php echo base_url();?>crm/request/insert" method = "post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleFormModalLabel">Price Request</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <h6 style = "color:grey;opacity:0.7">REQUEST ID</h6>
                        <input type="text" value = "REQ-<?php echo sprintf('%05d', $request_id);?>" class="form-control" name="asdf" placeholder="Request ID" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <h6 style = "color:grey;opacity:0.7">CUSTOMER FIRM</h6>
                        <select class = "form-control" data-plugin="select2" name = "id_perusahaan" id = "idperusahaan" onchange = "getContactPerson()">
                            <option disabled selected>Choose Customer</option>
                            <?php foreach($customer->result() as $a){ ?>
                            <option value = "<?php echo $a->id_perusahaan;?>"><?php echo strtoupper($a->nama_perusahaan);?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <h6 style = "color:grey;opacity:0.7">CUSTOMER CP</h6>
                        <select class = "form-control" placeholder="Last Name" name = "id_cp" data-plugin="select2" id="cpperusahaan">
                            <option disabled selected>Choose Contact Person</option>
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <h6 style = "color:grey;opacity:0.7">Franco</h6>
                        <input type="text" class="form-control" name="franco" placeholder="Franco">
                    </div>
                    <div class="col-xl-12 form-group">
                        <h6 style = "color:grey;opacity:0.7">DATELINE</h6>
                        <input type="date" class="form-control" name="tgl_dateline_request" placeholder="Dateline">
                    </div>
                    <div class="col-xl-12 form-group">
                        <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="DataPesanan">
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
                        <input type="hidden" value = "<?php echo $request_id;?>" class="form-control" name="id_request" placeholder="Customer ID" readonly>
                    </div>
                </div>
                <input type = "submit" class = "btn btn-primary btn-outline">
            </div>
        </form>
    </div>
</div>
