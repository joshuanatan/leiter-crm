<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <button data-target="#AddShippingVendor" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button">
                <i class="icon wb-plus" aria-hidden="true"></i> Add Shipping Vendor
            </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>Company ID</th>
                <th>CP Name</th>
                <th>Company Name</th>
                <th>Company Field</th>
                <th>Company Address</th>
                <th>Company Line</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($perusahaan->result() as $a){ 
                
                ?> 
            <tr class="gradeA">
                <td><?php echo $a->id_perusahaan;?></td>
                <td><?php echo $a->nama_cp;?></td>
                <td><?php echo $a->nama_perusahaan;?></td>
                <td><?php echo $a->jenis_perusahaan;?></td>
                <td><?php echo $a->alamat_perusahaan;?></td>
                <td><?php echo $a->notelp_perusahaan;?></td>
                <td class="actions">
                    
                    <button data-target="#editModal" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button"><i class="icon wb-edit" aria-hidden="true"></i></button>

                    <button class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></button>
                    
                    <a href = "<?php echo base_url();?>master/vendor/shipping/items/<?php echo $a->id_perusahaan;?>" class="btn btn-outline btn-dark"><i class="icon wb-grid-9" aria-hidden="true"></i></a>
                    
                    <button class="btn btn-outline btn-success"
                    data-toggle="tooltip"><i class="icon wb-eye" aria-hidden="true"></i></button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="AddShippingVendor" aria-hidden="true" aria-labelledby="DaftarUser" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleModalTabs">Product Vendor Data</h4>
            </div>

            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData"
                    aria-controls="primaryData" role="tab">Primary Data</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#privilage"
                    aria-controls="privilage" role="tab">Contact Person</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#shipping"
                    aria-controls="Shipping Method" role="tab">Shipping Method</a></li>
            </ul>
            <form action = "<?php echo base_url();?>master/vendor/shipping/register" method = "post">    
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="primaryData" role="tabpanel">
                            <?php
                            $form_data = array(
                                "input0" => array(
                                    "input" => "input",
                                    "type" => "text",
                                    "name" => "nama_perusahaan",
                                    "title" => "Company Name",
                                    "placeholder" => "",
                                    "value" => "",
                                    "help" => "Use all capital letter. ex: PT EXAMPLE COMPANY NAME"
                                ),
                                "input1" => array(
                                    "input" => "input",
                                    "type" => "text",
                                    "name" => "jenis_perusahaan",
                                    "title" => "Company Field",
                                    "placeholder" => "",
                                    "value" => "",
                                    "help" => "Vendor's main product/services"
                                ),
                                "input2" => array(
                                    "input" => "textarea",
                                    "title" => "Company Address",
                                    "name" => "alamat_perusahaan",
                                    "placeholder" => "",
                                    "value" => "",
                                    "help" => "",
                                    "rows" => 5,
                                    "cols" => 0
                                ),
                                "input3" => array(
                                    "input" => "input",
                                    "type" => "text",
                                    "name" => "notelp_perusahaan",
                                    "title" => "Company Line",
                                    "placeholder" => "",
                                    "value" => "",
                                    "help" => "The easiest number to contact vendor"
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
                                            <input type="<?php echo $form_data["input".$a]["type"];?>" name = "<?php echo $form_data["input".$a]["name"];?>" class="form-control" id="inputHelpText" placeholder = "<?php echo $form_data["input".$a]["placeholder"];?>" required value = "<?php echo $form_data["input".$a]["value"];?>">
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
                                            <select name = "<?php echo $form_data["input".$a]["name"];?>" class="form-control" id="inputHelpText" required >
                                            <?php 
                                            foreach($form_data["input".$a]["options"]->result() as $option){ ?>
                                                <option value = ""><?php echo $option->id_produk;?></option>
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
                                            <textarea name = "<?php echo $form_data["input".$a]["name"];?>" class="form-control" id="inputHelpText" required <?php if($form_data["input".$a]["rows"] != 0) echo "rows = ".$form_data["input".$a]["rows"];?> <?php if($form_data["input".$a]["cols"] != 0) echo "cols = ".$form_data["input".$a]["cols"];?> ><?php echo $form_data["input".$a]["value"];?></textarea>
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
                        <div class="tab-pane" id="privilage" role="tabpanel">
                            <?php
                                $form_data = array(
                                    "input0" => array(
                                        "input" => "input",
                                        "type" => "text",
                                        "name" => "nama_cp",
                                        "title" => "Contact Person",
                                        "placeholder" => "",
                                        "value" => "",
                                        "help" => "Capital each first alphabet. ex: Firstname Lastname"
                                    ),
                                    "input1" => array(
                                        "input" => "select",
                                        "title" => "CP Gender",
                                        "name" => "jk_cp",
                                        "options" => array("Mr","Ms"),
                                        "help" => ""
                                    ),
                                    "input2" => array(
                                        "input" => "input",
                                        "type" => "email",
                                        "name" => "email_cp",
                                        "title" => "Email",
                                        "placeholder" => "",
                                        "value" => "",
                                        "help" => "ex: username@example.com"
                                    ),
                                    "input3" => array(
                                        "input" => "input",
                                        "type" => "text",
                                        "name" => "nohp_cp",
                                        "title" => "Contact Person Mobile Phone",
                                        "placeholder" => "",
                                        "value" => "",
                                        "help" => "089612345678"
                                    ),
                                    "input4" => array(
                                        "input" => "input",
                                        "type" => "text",
                                        "name" => "jabatan_cp",
                                        "title" => "Contact Person Position",
                                        "placeholder" => "",
                                        "value" => "",
                                        "help" => "Sales/Marketing/CEO"
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
                                                <input type="<?php echo $form_data["input".$a]["type"];?>" name = "<?php echo $form_data["input".$a]["name"];?>" class="form-control" id="inputHelpText" placeholder = "<?php echo $form_data["input".$a]["placeholder"];?>" required value = "<?php echo $form_data["input".$a]["value"];?>">
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
                                                <select name = "<?php echo $form_data["input".$a]["name"];?>" class="form-control" id="inputHelpText" required >
                                                <?php 
                                                for($c = 0 ; $c<count($form_data["input".$a]["options"]); $c++){ ?>
                                                    <option value = "<?php echo $form_data["input".$a]["options"][$c];?>"><?php echo $form_data["input".$a]["options"][$c];?></option>
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
                                                <textarea name = "<?php echo $form_data["input".$a]["name"];?>" class="form-control" id="inputHelpText" required <?php if($form_data["input".$a]["rows"] != 0) echo "rows = ".$form_data["input".$a]["rows"];?> <?php if($form_data["input".$a]["cols"] != 0) echo "cols = ".$form_data["input".$a]["cols"];?> ><?php echo $form_data["input".$a]["value"];?></textarea>
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
                        <div class="tab-pane" id="shipping" role="tabpanel">
                        <?php
                            $kategori = "";
                            $title = "Delivery Method";
                            $mulai = 0;
                            $menu = array("SEA","AIR","LAND");
                            ?>
                            <?php 
                            for($a = 0 ; $a<count($menu);$a++){ 
                                if($kategori != "delivery"){ /*kalau ganti kategori / mulai pertama*/
                                    if($mulai == 1){ ?> <!-- kalau bukan lagi kategori pertama. Karena kalau kategori pertama, gaperlu di tutup-->
                                                </div>
                                                    <span class="text-help"></span>
                                                </div>
                                        </div>   
                                        <hr/> 
                                    <?php
                                    }
                                    $kategori = "delivery";
                                    $mulai = 1;
                                    ?>
                                    <div class = "form-group">
                                        <div class="col-md-12 col-lg-12">
                                            <!-- Example With Help -->
                                            <h4 class="example-title"><?php echo $title;?></h4>
                                            <div class="col-md-12 col-xl-12">
                                                <!-- Example Checkboxes -->
                                    <?php
                                }
                            ?> 
                            <!-- selebihnya ngeload ini aja, ini checkbox -->
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" value = "<?php echo $menu[$a];?>" id="inputUnchecked<?php echo $menu[$a];?>" name = "<?php echo strtolower($kategori);?>[]";/>
                                <label for="inputUnchecked<?php echo $menu[$a];?>"><?php echo $menu[$a];?></label>
                            </div>
                            <!-- end checkboxnya -->  
                            <?php } ?>
                            <hr/>
                            <button class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

