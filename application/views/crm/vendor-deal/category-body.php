<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="exampleAddRow">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Company Name</th>
                <th>Customer Name</th>
                <th>Request</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($request->result() as $a){ ?>
            <tr class="gradeA">
                <td>REQ-<?php echo sprintf("%05d",$a->id_request) ?></td>
                <td><?php echo $a->nama_perusahaan;?></td>
                <td><?php echo ucwords($a->nama_cp);?></td>
                <td>
                    <a href = "<?php echo base_url();?>crm/vendor/produk/<?php echo $a->id_request;?>" data-target="#RequestData" class="btn btn-outline btn-primary col-lg-5"><i class="icon wb-book" aria-hidden="true"></i>Product Vendor Price</a>
                    <a href = "<?php echo base_url();?>crm/vendor/courier/<?php echo $a->id_request;?>" data-target="#RequestData" class="btn btn-outline btn-primary col-lg-5"><i class="icon wb-book" aria-hidden="true"></i>Courier Vendor Price</a>
                </td>
                <td class="actions">
                    
                    <button data-target="#EditRequest" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button"><i class="icon wb-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></button>
                    <button class="btn btn-outline btn-success" data-trigger = "hover" data-content = "Proceed to Quotation"
                    data-toggle="popover"><i class="icon fa fa-check" aria-hidden="true"></i></button>
                    
                </td>
            </tr> 
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="RequestData" aria-hidden="true" aria-labelledby="RequestData" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">REQ-001/Joshua Natan W - Request for Price</h4>
            </div>
        <div class="modal-body">
            <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="DataPesanan">
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Vendor Price</th>
                        <th>Vendor Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <td>ITM-002</td>
                        <td>Kursi Kayu</td>
                        <td>15</td>
                        <td><?php echo number_format(0,2)?></td>
                        <td><button class = "btn btn-sm btn-primary btn-outline" data-target="#DetailVendor" data-toggle="modal" type="button">Mitra Adi Perkasa</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="DetailVendor" aria-hidden="true" aria-labelledby="RequestData" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Vendor contact</h4>
            </div>
        <div class="modal-body">
            <table class="table table-bordered table-hover table-striped w-full" cellspacing="0">
                <tr>
                    <th>Nama Vendor</th>
                    <td>Mitra Adi Perkasan</td>
                </tr>
                <tr>
                    <th>Nomor Telpon</th>
                    <td>00000</td>
                </tr>
                <tr>
                    <th>Contact person</th>
                    <td>Adi</td>
                </tr>
            </table>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="EditRequest" aria-hidden="false" aria-labelledby="TambahRequestLabel" role="dialog" >
    <div class="modal-dialog modal-simple">
        <form class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleFormModalLabel">Price Request</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" value = "REQ-001" placeholder="Request ID" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        
                        <input type="text" class="form-control" name="firstName" value = "Joshua Natan W" placeholder="Request ID" readonly>   
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" value = "CST-001" placeholder="Customer ID" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <select class = "form-control" data-plugin="select2">
                            <option disabled selected>Choose Item</option>
                            <option>Meja Tulis</option>
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="DataPesanan">
                            <thead>
                                <tr>
                                    <th style = "Width:30%">Vendor</th>
                                    <th style = "Width:25%">Price</th>
                                    <th style = "Width:10%">Quantity</th>
                                    <th style = "Width:15%">Min Qty</th>
                                    <th style = "Width:20%">Action</th>
                                </tr>
                            </thead>
                            <tbody id = "t1">
                                
                            </tbody>
                        </table>
                        <button type = "button" class = "btn btn-sm col-lg-12 btn-warning" onclick = "add()">Add Vendor Price</button>
                        <br/><button type = "button" class = "btn btn-sm col-lg-12 btn-success">Save List</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>