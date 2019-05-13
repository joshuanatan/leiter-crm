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
                <th>Product Name</th>
                <th>Product UOM</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produk->result() as $a){ ?> 
            <tr class="gradeA">
                <td><?php echo $a->id_produk;?></td>
                <td><?php echo $a->bn_produk;?></td>
                <td><?php echo $a->nama_produk;?></td>
                <td><?php echo $a->satuan_produk;?></td>
                <td class="actions">
                    
                    <button data-target="#editModal" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button"><i class="icon wb-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></button>
                    
                    <button class="btn btn-outline btn-success"
                    data-toggle="tooltip"><i class="icon wb-eye" aria-hidden="true"></i></button>
                </td>
            </tr>
            <?php } ?>
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
            <form action = "<?php echo base_url();?>master/product/insert" method="post">
                <div class="modal-body">
                <?php
                $form_data = array(
                    "input0" => array(
                        "input" => "input",
                        "type" => "text",
                        "name" => "bn_produk",
                        "title" => "B/N Product",
                        "placeholder" => "",
                        "value" => "",
                        "help" => "Format: xxxx-xxxx-xxx-xx"
                    ),
                    "input1" => array(
                        "input" => "input",
                        "type" => "text",
                        "name" => "nama_produk",
                        "title" => "Product Name",
                        "placeholder" => "Enter your product name",
                        "value" => "",
                        "help" => ""
                    ),
                    "input2" => array(
                        "input" => "select",
                        "title" => "Unit of Measure",
                        "name" => "satuan_produk",
                        "options" => $satuan,
                        "help" => "",
                        "plugin" => "select2"
                    ),
                    "input3" => array(
                        "input" => "input",
                        "type" => "text",
                        "name" => "satuan_produk_add",
                        "title" => "Adding Unit of Measure",
                        "placeholder" => "Leave it blank if your choice is in the options above",
                        "value" => "",
                        "help" => "Type here if your choice is not in options above"
                    ),
                    "input4" => array(
                        "input" => "textarea",
                        "title" => "title",
                        "name" => " deskripsi_produk",
                        "placeholder" => "Product Description",
                        "value" => "",
                        "help" => "",
                        "rows" => 5,
                        "cols" => 0
                    ),
                );
                ?>
                <?php for($a = 0; $a<count($form_data); $a++){ 
                    
                    switch($form_data["input".$a]["input"]){
                        case "input": ?>
                        <div class = "form-group">
                            <div class="col-md-12 col-lg-12">
                                <!-- Example With Help -->
                                <h4 class="example-title"><?php echo $form_data["input".$a]["title"];?></h4>
                                <input type="<?php echo $form_data["input".$a]["type"];?>" name = "<?php echo $form_data["input".$a]["name"];?>" class="form-control" id="inputHelpText" placeholder = "<?php echo $form_data["input".$a]["placeholder"];?>" value = "<?php echo $form_data["input".$a]["value"];?>">
                                <span class="text-help"><?php echo $form_data["input".$a]["help"];?></span>
                            </div>
                        </div>
                        <?php
                        break;
                        case "select": ?>
                        <div class = "form-group">
                            <div class="col-md-12 col-lg-12">
                                <!-- Example With Help -->
                                <h4 class="example-title"><?php echo $form_data["input".$a]["title"];?></h4>
                                <select data-plugin = "<?php echo $form_data["input".$a]["plugin"];?>" name = "<?php echo $form_data["input".$a]["name"];?>" class="form-control" id="inputHelpText" >
                                <?php 
                                foreach($form_data["input".$a]["options"]->result() as $option){ ?>
                                    <option value = "<?php echo $option->nama_satuan;?>"><?php echo strtoupper($option->nama_satuan);?></option>
                                <?php 
                                } 
                                ?>
                                </select>
                                <span class="text-help"><?php echo $form_data["input".$a]["help"];?></span>
                            </div>
                        </div>
                        <?php
                        break;
                        case "textarea": ?>
                        <div class = "form-group">
                            <div class="col-md-12 col-lg-12">
                                <!-- Example With Help -->
                                <h4 class="example-title"><?php echo $form_data["input".$a]["title"];?></h4>
                                <textarea name = "<?php echo $form_data["input".$a]["name"];?>" class="form-control" id="inputHelpText" <?php if($form_data["input".$a]["rows"] != 0) echo "rows = ".$form_data["input".$a]["rows"];?> <?php if($form_data["input".$a]["cols"] != 0) echo "cols = ".$form_data["input".$a]["cols"];?> ><?php echo $form_data["input".$a]["value"];?></textarea>
                                <span class="text-help"><?php echo $form_data["input".$a]["help"];?></span>
                            </div>
                        </div>
                        <?php
                        break;
                    }
                    ?>
                    <?php
                }
                ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>