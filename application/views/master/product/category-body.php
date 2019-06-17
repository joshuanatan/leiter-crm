<?php if($this->session->imageerror != ""): ?>
<div class="toast-example" id="exampleToastrError" aria-live="polite" data-plugin="toastr" data-message="&lt;strong&gt;Oh snap!&lt;/strong&gt; Change a few things up and try submitting again." data-container-id="toast-container" data-position-class="toast-top-right" data-icon-class="toast-just-text toast-error" role="alert">
    <div class="toast toast-just-text toast-error">
        <button type="button" class="toast-close-button" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="toast-message">
            <?php echo $this->session->imageerror;?>
        </div>
    </div>
</div>
<?php endif;?>
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
                <th style = "width:5%">Product ID</th>
                <th style = "width:15%">B/N Product</th>
                <th style = "width:25%">Product Description</th>
                <th style = "width:10%">Product UOM</th>
                <th style = "width:30%">Product Image</th>
                <th style = "width:15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($produk); $a++): ?> 
            <tr>
                <td><?php echo $produk[$a]["id_produk"];?></td>
                <td><?php echo $produk[$a]["bn_produk"];?></td>
                <td><?php echo $produk[$a]["deskripsi_produk"];?></td>
                <td><?php echo $produk[$a]["satuan_produk"];?></td>
                <td><img style = "width:100%" src = "<?php echo base_url();?>assets/system/produk/<?php echo $produk[$a]["gambar_produk"];?>"></td>
                <td class="actions">
                    
                    <button data-target="#editItem<?php echo $produk[$a]["id_produk"];?>" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button"><i class="icon wb-edit" aria-hidden="true"></i></button>
                    <div class="modal fade" id="editItem<?php echo $produk[$a]["id_produk"];?>" aria-hidden="true" aria-labelledby="AddCatalog" role="dialog" tabindex="-1">
                        <div class="modal-dialog modal-simple modal-center">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">Catalog Data</h4>
                                </div>
                                <form action = "<?php echo base_url();?>master/product/edit/<?php echo $produk[$a]["id_produk"];?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class = "form-group">
                                            <h5>B/N Product</h5>
                                            <input type = "text" class = "form-control" value = "<?php echo $produk[$a]["bn_produk"];?>" name = "bn_produk">
                                        </div>
                                        <div class = "form-group">
                                            <h5>Product Description</h5>
                                            <textarea class = "form-control" name = "deskripsi_produk"><?php echo $produk[$a]["deskripsi_produk"];?></textarea>
                                        </div>
                                        <div class = "form-group">
                                            <h5>Unit of Measure</h5>
                                            <input type = "text" class = "form-control" name ="uom" value = "<?php echo $produk[$a]["satuan_produk"];?>">
                                        </div>
                                        <div class = "form-group" id = "newUom" style = "display:none">
                                            <h5>New UOM</h5>
                                            <input type = "text" class = "form-control" name = "uom_baru">
                                        </div>
                                        <div class = "form-group">
                                            <h5>Product Image <a href = "<?php echo base_url();?>assets/system/produk/<?php echo $produk[$a]["gambar_produk"];?>" target="_blank">Open Image</a></h5>
                                            <input type = "file" class = "form-control" name = "gambar_produk">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <a href = "<?php echo base_url();?>master/product/delete/<?php echo $produk[$a]["id_produk"];?>" class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></a>
                    
                </td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>
<!-- INSERT DATA MODAL -->
<div class="modal fade" id="AddCatalog" aria-hidden="true" aria-labelledby="AddCatalog" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Catalog Data</h4>
            </div>
            <form action = "<?php echo base_url();?>master/product/insert" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class = "form-group">
                        <h5>B/N Product</h5>
                        <input type = "text" class = "form-control" name = "bn_produk">
                    </div>
                    <div class = "form-group">
                        <h5>Product Description</h5>
                        <textarea class = "form-control" name = "deskripsi_produk"></textarea>
                    </div>
                    <div class = "form-group">
                        <h5>Unit of Measure</h5>
                        <select data-plugin = "select2" id = "uom" onchange = "showNewUOM()" class = "form-control" name = "uom">
                            <option value = "0">New UOM</option>    
                            <?php for($a = 0; $a<count($satuan); $a++): ?>
                            <option value = "<?php echo strtoupper($satuan[$a]["nama_satuan"]);?>"><?php echo $satuan[$a]["nama_satuan"];?></option>
                            <?php endfor;?>  
                        </select>
                    </div>
                    <div class = "form-group" id = "newUom">
                        <h5>New UOM</h5>
                        <input type = "text" class = "form-control" name = "uom_baru">
                    </div>
                    <div class = "form-group">
                        <h5>Product Image</h5>
                        <input type = "file" class = "form-control" name = "gambar_produk">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>