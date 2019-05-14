<div class="panel-body col-lg-12">
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
    <a class = "btn btn-primary btn-outline" href = "<?php echo base_url();?>crm/request">BACK</a>
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

