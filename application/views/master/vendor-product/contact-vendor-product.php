<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <button data-target="#AddCustomer" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button">
                <i class="icon wb-plus" aria-hidden="true"></i> Add Contact Person
            </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>CP Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cp->result() as $a): ?>
            <tr class="gradeA">
                <td><?php echo ucwords($a->nama_cp);?></td>
                <td><?php echo $a->jk_cp;?></td>
                <td><?php echo strtolower($a->email_cp);?></td>
                <td><?php echo $a->nohp_cp;?></td>
                <td><?php echo strtoupper($a->jabatan_cp);?></td>
                <td class="actions">
                    
                    <button type ="button" data-target="#editCpVendorProduct<?php echo $a->id_cp;?>" data-toggle="modal" class="btn btn-outline btn-primary" ><i class="icon wb-edit"></i></button>

                    <a href = "<?php echo base_url();?>master/vendor/product/removecp/<?php echo $a->id_cp;?>/<?php echo $id_perusahaan;?>" class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></a>
                </td>
            </tr>
            <div class="modal fade" id="editCpVendorProduct<?php echo $a->id_cp;?>" aria-hidden="true" aria-labelledby="DaftarUser" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-simple">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalTabs">Contact Person Data</h4>
                        </div>

                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#privilage"
                                aria-controls="privilage" role="tab">Contact Person</a></li>
                        </ul>
                        <form action = "<?php echo base_url();?>master/vendor/product/editcp" method = "post">    
                            <div class="modal-body">
                                <div class="tab-content">
                                    
                                    <div class="tab-pane active" id="privilage" role="tabpanel">
                                        <?php
                                            $form_data = array(
                                                "input0" => array(
                                                    "input" => "input",
                                                    "type" => "text",
                                                    "name" => "nama_cp",
                                                    "title" => "Contact Person",
                                                    "placeholder" => "",
                                                    "value" => $a->nama_cp,
                                                    "help" => "before: ".$a->nama_cp
                                                ),
                                                "input1" => array(
                                                    "input" => "select",
                                                    "title" => "CP Gender",
                                                    "name" => "jk_cp",
                                                    "options" => array("Mr","Ms"),
                                                    "help" => "before: ".$a->jk_cp
                                                ),
                                                "input2" => array(
                                                    "input" => "input",
                                                    "type" => "email",
                                                    "name" => "email_cp",
                                                    "title" => "Email",
                                                    "placeholder" => "",
                                                    "value" => $a->email_cp,
                                                    "help" => "before: ".$a->email_cp
                                                ),
                                                "input3" => array(
                                                    "input" => "input",
                                                    "type" => "text",
                                                    "name" => "nohp_cp",
                                                    "title" => "Contact Person Mobile Phone",
                                                    "placeholder" => "",
                                                    "value" => $a->nohp_cp,
                                                    "help" => "before: ".$a->nohp_cp
                                                ),
                                                "input4" => array(
                                                    "input" => "input",
                                                    "type" => "text",
                                                    "name" => "jabatan_cp",
                                                    "title" => "Contact Person Position",
                                                    "placeholder" => "",
                                                    "value" => $a->jabatan_cp,
                                                    "help" => "before: ".$a->jabatan_cp
                                                ),
                                                "input5" => array(
                                                    "input" => "input",
                                                    "type" => "hidden",
                                                    "name" => "id_perusahaan",
                                                    "title" => "",
                                                    "placeholder" => "",
                                                    "value" => $id_perusahaan,
                                                    "help" => ""
                                                ),
                                                "input6" => array(
                                                    "input" => "input",
                                                    "type" => "hidden",
                                                    "name" => "id_cp",
                                                    "title" => "",
                                                    "placeholder" => "",
                                                    "value" => $a->id_cp,
                                                    "help" => ""
                                                ),
                                                
                                            );
                                            ?>
                                            <?php for($b = 0; $b<count($form_data); $b++){ 
                                                
                                                switch($form_data["input".$b]["input"]){
                                                    case "input": ?>
                                                    <div class = "form-group">
                                                        <div class="col-md-12 col-lg-12">
                                                            <!-- Example With Help -->
                                                            <h4 class="example-title"><?php echo $form_data["input".$b]["title"];?></h4>
                                                            <input type="<?php echo $form_data["input".$b]["type"];?>" name = "<?php echo $form_data["input".$b]["name"];?>" class="form-control" id="inputHelpText" placeholder = "<?php echo $form_data["input".$b]["placeholder"];?>"  value = "<?php echo $form_data["input".$b]["value"];?>">
                                                            <span class="text-help"><?php echo $form_data["input".$b]["help"];?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    break;
                                                    case "select": ?>
                                                    <div class = "form-group">
                                                        <div class="col-md-12 col-lg-12">
                                                            <!-- Example With Help -->
                                                            <h4 class="example-title"><?php echo $form_data["input".$b]["title"];?></h4>
                                                            <select name = "<?php echo $form_data["input".$b]["name"];?>" class="form-control" id="inputHelpText"  >
                                                            <?php 
                                                            for($c = 0 ; $c<count($form_data["input".$b]["options"]); $c++){ ?>
                                                                <option value = "<?php echo $form_data["input".$b]["options"][$c];?>"<?php if($form_data["input".$b]["options"][$c] == $a->jk_cp) echo "selected";?>><?php echo $form_data["input".$b]["options"][$c];?></option>
                                                            <?php 
                                                            } 
                                                            ?>
                                                            </select>
                                                            <span class="text-help"><?php echo $form_data["input".$b]["help"];?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    break;
                                                    case "textarea": ?>
                                                    <div class = "form-group">
                                                        <div class="col-md-12 col-lg-12">
                                                            <!-- Example With Help -->
                                                            <h4 class="example-title"><?php echo $form_data["input".$b]["title"];?></h4>
                                                            <textarea name = "<?php echo $form_data["input".$b]["name"];?>" class="form-control" id="inputHelpText"  <?php if($form_data["input".$b]["rows"] != 0) echo "rows = ".$form_data["input".$b]["rows"];?> <?php if($form_data["input".$b]["cols"] != 0) echo "cols = ".$form_data["input".$b]["cols"];?> ><?php echo $form_data["input".$b]["value"];?></textarea>
                                                            <span class="text-help"><?php echo $form_data["input".$b]["help"];?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    break;
                                                }
                                                ?>
                                                <?php
                                            }
                                            ?>
                                        <button class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </tbody>
    </table>
        <a href = "<?php echo base_url();?>master/vendor/product" class = "btn btn-primary btn-outline">BACK</a>
</div>
<div class="modal fade" id="AddCustomer" aria-hidden="true" aria-labelledby="DaftarUser" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleModalTabs">Customer Data</h4>
            </div>

            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#privilage"
                    aria-controls="privilage" role="tab">Contact Person</a></li>
            </ul>
            <form action = "<?php echo base_url();?>master/vendor/product/registercp" method = "post">    
                <div class="modal-body">
                    <div class="tab-content">
                        
                        <div class="tab-pane active" id="privilage" role="tabpanel">
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
                                    "input5" => array(
                                        "input" => "input",
                                        "type" => "hidden",
                                        "name" => "id_perusahaan",
                                        "title" => "",
                                        "placeholder" => "",
                                        "value" => $id_perusahaan,
                                        "help" => ""
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
                                                <input type="<?php echo $form_data["input".$a]["type"];?>" name = "<?php echo $form_data["input".$a]["name"];?>" class="form-control" id="inputHelpText" placeholder = "<?php echo $form_data["input".$a]["placeholder"];?>"  value = "<?php echo $form_data["input".$a]["value"];?>">
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
                                                <select name = "<?php echo $form_data["input".$a]["name"];?>" class="form-control" id="inputHelpText"  >
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
                                                <textarea name = "<?php echo $form_data["input".$a]["name"];?>" class="form-control" id="inputHelpText"  <?php if($form_data["input".$a]["rows"] != 0) echo "rows = ".$form_data["input".$a]["rows"];?> <?php if($form_data["input".$a]["cols"] != 0) echo "cols = ".$form_data["input".$a]["cols"];?> ><?php echo $form_data["input".$a]["value"];?></textarea>
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
                            <button class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>