<div class="panel-body col-lg-12">
    <div class="row row-lg">
        <div class="col-xl-12">
            <!-- Example Tabs Left -->
            <div class="example-wrap">
                <div class="nav-tabs-vertical" data-plugin="tabs">
                    <ul class="nav nav-tabs nav-tabs-line mr-25" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">Primary Data</a></li>
                    </ul>
                    <form action = "<?php echo base_url();?>master/vendor/product/editvendor" method = "post">    
                        
                        <div class="tab-content">
                            <?php foreach($perusahaan->result() as $a):?>
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                            <?php
                            $form_data = array(
                                "input0" => array(
                                    "input" => "input",
                                    "type" => "text",
                                    "name" => "nama_perusahaan",
                                    "title" => "Company Name",
                                    "placeholder" => "",
                                    "value" => $a->nama_perusahaan,
                                    "help" => "before: ". $a->nama_perusahaan
                                ),
                                "input1" => array(
                                    "input" => "input",
                                    "type" => "text",
                                    "name" => "jenis_perusahaan",
                                    "title" => "Company Field",
                                    "placeholder" => "",
                                    "value" => $a->jenis_perusahaan,
                                    "help" => "before: ". $a->jenis_perusahaan
                                ),
                                "input2" => array(
                                    "input" => "textarea",
                                    "title" => "Company Address",
                                    "name" => "alamat_perusahaan",
                                    "placeholder" => "",
                                    "value" => $a->alamat_perusahaan,
                                    "help" => "before: ". $a->alamat_perusahaan,
                                    "rows" => 5,
                                    "cols" => 0
                                ),
                                "input3" => array(
                                    "input" => "input",
                                    "type" => "text",
                                    "name" => "notelp_perusahaan",
                                    "title" => "Company Line",
                                    "placeholder" => "",
                                    "value" => $a->notelp_perusahaan,
                                    "help" => "before: ". $a->notelp_perusahaan
                                ),
                                "input4" => array(
                                    "input" => "input",
                                    "type" => "hidden",
                                    "name" => "id_perusahaan",
                                    "title" => "",
                                    "placeholder" => "",
                                    "value" => $a->id_perusahaan,
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
                            <div class = "form-group">
                                <div class="col-md-12 col-lg-12">
                                    <button type = "submit" class = "btn btn-primary btn-outline col-lg-2 col-md-12">SUBMIT</button>
                                    <a href = "<?php echo base_url();?>master/vendor/product" class = "btn btn-primary btn-outline col-lg-2 col-md-12">BACK</a>
                                </div>
                            </div>
                            </div>
                            
                            <?php endforeach;?>
                        </div>
                        
                    </form>
                </div>
            </div>
            <!-- End Example Tabs Left -->
        </div>
    </div>
</div>
