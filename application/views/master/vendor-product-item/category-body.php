<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <button data-target="#AddCatalog" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button">
                <i class="icon wb-plus" aria-hidden="true"></i> Add Catalog
            </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>B/N Product</th>
                <th>Vendor Product Name</th>
                <th>B/N PT LEITER INDONESIA</th>
                <th>LEITER Product Name</th>
                <th>Product UOM</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($product->result() as $a){ ?> 
            <tr class="gradeA">
                <td><?php echo $a->id_produk_vendor;?></td>
                <td><?php echo $a->bn_produk_vendor;?></td>
                <td><?php echo $a->nama_produk_vendor;?></td>
                <td><?php echo $a->bn_produk;?></td>
                <td><?php echo $a->nama_produk;?></td>
                <td><?php echo $a->satuan_produk_vendor;?></td>
                <td class="actions">
                    
                    <a href = "<?php echo base_url();?>master/vendor/product/edit/<?php echo $a->id_produk_vendor;?>" class="btn btn-outline btn-primary"><i class="icon wb-edit" aria-hidden="true"></i></a >
                    <button class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></button>
                    
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href = "<?php echo base_url();?>master/vendor/product" class = "btn btn-outline btn-primary">BACK</a>
</div>
<!-- INSERT DATA MODAL -->
<div class="modal fade" id="AddCatalog" aria-hidden="true" aria-labelledby="DaftarUser" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleModalTabs">Product Vendor Data</h4>
            </div>

            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">LEITER Product Data</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#supplier" aria-controls="supplier" role="tab">Supplier Product Data</a></li>
            </ul>
            <form action = "<?php echo base_url();?>master/vendor/product/registeritem" method = "post">    
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="primaryData" role="tabpanel">
                            <div class="form-group">
                                <h4 class="example-title">Product ID</h4>   
                                <select class = "form-control" name = "id_produk" id = "id_produk" onchange = "getProductData()">
                                    <option value = "0">New Product</option>
                                <?php foreach($catalog->result() as $a){ ?>
                                    <option value = "<?php echo $a->id_produk;?>"><?php echo $a->nama_produk;?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <h4 class="example-title">Product B/N</h4>    
                                <input oninput="updateSupplierForm('bn_produk')" name = "bn_produk" type="text" class="form-control" id="bn_produk" placeholder="" >
                            </div>
                            <div class="form-group">
                                <h4 class="example-title">Product Name</h4>    
                                <input oninput="updateSupplierForm('nama_produk')" type="text" class="form-control" name = "nama_produk" id="nama_produk" placeholder="" >
                            </div>
                            <div class="form-group">
                                <h4 class="example-title">Product UOM</h4>    
                                <select  name = "satuan_produk" onchange="updateSupplierForm('satuan_produk')" class = "form-control" id = "satuan_produk">
                                <?php foreach($satuan->result() as $a){ ?>
                                    <option value = "<?php echo $a->nama_satuan;?>"><?php echo strtoupper($a->nama_satuan);?></option>
                                <?php } ?>
                                </select>
                                <input type = "hidden" id = "satuan_produk_value">
                            </div>
                            <div class="form-group">
                                <h4 class="example-title">New Product UOM</h4>    
                                <input oninput="updateSupplierForm('satuan_produk_new')" type="text" class="form-control" name = "satuan_produk_new" id="satuan_produk_new" placeholder="" >
                            </div>
                            <div class="form-group">
                                <h4 class="example-title">Product Description</h4>    
                                <textarea oninput="updateSupplierForm('deskripsi_produk')" class="form-control" id="deskripsi_produk" name = "deskripsi_produk" placeholder="" ></textarea>
                            </div>
                        </div>
                        <div class="tab-pane" id="supplier" role="tabpanel">
                            <input type = "hidden" name = "id_perusahaan" value = "<?php echo $id_perusahaan;?>">
                            <div class="form-group">
                                <h4 class="example-title">Product B/N</h4>    
                                <input type="text" class="form-control" name = "bn_produk_vendor" id="bn_produk_vendor" placeholder="" >
                            </div>
                            <div class="form-group">
                                <h4 class="example-title">Product Name</h4>    
                                <input type="text" class="form-control" name = "nama_produk_vendor" id="nama_produk_vendor" placeholder="" >
                            </div>
                            <div class="form-group">
                                <h4 class="example-title">Product UOM</h4>    
                                <select class = "form-control" name = "satuan_produk_vendor" id = "satuan_produk_vendor">
                                <?php foreach($satuan->result() as $a){ ?>
                                    <option value = "<?php echo $a->nama_satuan;?>"><?php echo strtoupper($a->nama_satuan);?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <h4 class="example-title">New Product UOM</h4>    
                                <input type="text" class="form-control" name = "satuan_produk_new_vendor" id="satuan_produk_new_vendor" placeholder="" >
                            </div>
                            <div class="form-group">
                                <h4 class="example-title">Product Description</h4>    
                                <textarea class="form-control" id="deskripsi_produk_vendor" name = "deskripsi_produk_vendor" placeholder="" ></textarea>
                            </div>
                            
                            <div class="form-group">
                                <input type = "submit" class = "btn btn-primary btn-outline">
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>