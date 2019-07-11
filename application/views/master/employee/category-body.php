
<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <button data-target="#TambahUser" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button">
                <i class="icon wb-plus" aria-hidden="true"></i> Add Employee
            </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin="dataTable">
        <thead>
            <tr>
                <th>ID User</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Phone</th>
                <th>User Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($employee);$a++): ?> 
            <tr class="gradeA">
                <td><?php echo $employee[$a]["id_user"];?></td>
                <td><?php echo $employee[$a]["nama_user"];?></td>
                <td><?php echo $employee[$a]["email_user"]?></td>
                <td><?php echo $employee[$a]["nohp_user"];?></td>
                <td><?php echo $employee[$a]["jenis_user"];?></td>
                <td class="actions">
                    
                    <button type="button" data-target = "#DetailUser<?php echo $employee[$a]["id_user"];?>" data-toggle="modal" class="btn btn-outline btn-primary" type="button"><i class="icon wb-edit" data-content="Detail Profile" data-trigger="hover" data-toggle="popover" aria-hidden="true"></i></button>

                    <a href = "<?php echo base_url();?>master/user/employee/delete/<?php echo $employee[$a]["id_user"];?>" class="btn btn-outline btn-danger" data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></a>
                    
                    <button class="btn btn-outline btn-success" data-toggle="modal" data-target="#Privilege<?php echo $employee[$a]["id_user"];?>"><i class="icon wb-eye" aria-hidden="true"></i></button>
                </td>
            </tr>
            <!-- here goes modal -->
            <div class="modal fade" id="DetailUser<?php echo $employee[$a]["id_user"];?>" aria-hidden="true" aria-labelledby="DaftarUser" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-simple">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalTabs">EMPLOYEE EDIT</h4>
                        </div>

                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"  href="#primaryData<?php echo $employee[$a]["id_user"];?>"  aria-controls="primaryData<?php echo $employee[$a]["id_user"];?>" role="tab">Primary Data</a></li>
                        </ul>
                        <div class="modal-body">
                            <form action = "<?php echo base_url();?>master/user/employee/editemployee" method = "post">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="primaryData<?php echo $employee[$a]["id_user"];?>" role="tabpanel">
                                        <input type = "hidden" name = "id_user" value = "<?php echo $employee[$a]["id_user"];?>">
                                        <div class = "form-group">
                                            <h4 class="example-title">Full Name</h4>
                                            <input type="text" name = "nama_user" class="form-control" id="inputHelpText" required value = "<?php echo $employee[$a]["nama_user"];?>">
                                        </div>
                                        <div class = "form-group">
                                            <h4 class="example-title">Email</h4>
                                            <input type="text" name = "email_user" class="form-control" id="inputHelpText" required value = "<?php echo $employee[$a]["email_user"];?>">
                                        </div>
                                        <div class = "form-group">
                                            <h4 class="example-title">No HP User</h4>
                                            <input type="text" name = "nohp_user" class="form-control" id="inputHelpText" required value = "<?php echo $employee[$a]["nohp_user"];?>">
                                        </div>
                                        <div class = "form-group">
                                            <h4 class="example-title">Override Password</h4>
                                            <input type="text" name = "password" class="form-control" id="inputHelpText" required value = "-">
                                        </div>
                                        <div class = "form-group">
                                            <h5 class ="example-title">User Type</h5>
                                            <select class = "form-control" name = "jenis_user">
                                                <option value = "USER">USER</option>
                                                <option value = "SALES" <?php if($employee[$a]["jenis_user"] == "SALES") echo "selected";?>>SALES</option>
                                            </select>
                                        </div>
                                        <div class = "form-group">
                                            <div class = "col-md-12 col-lg-12">
                                                <button type = "submit" class = "btn btn-primary btn-outline col-lg-2 col-md-12">SUBMIT</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="Privilege<?php echo $employee[$a]["id_user"];?>" aria-hidden="true" aria-labelledby="Privilege" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-simple">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalTabs">EMPLOYEE PRIVILEGE</h4>
                        </div>

                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"  href="#primaryData<?php echo $employee[$a]["id_user"];?>"  aria-controls="primaryData<?php echo $employee[$a]["id_user"];?>" role="tab">Primary Data</a></li>
                        </ul>
                        <div class="modal-body">
                            
                            <form action = "<?php echo base_url();?>master/user/employee/editprivilege/<?php echo $employee[$a]["id_user"];?>" method = "post">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="privilege<?php echo $employee[$a]["id_user"];?>" role="tabpanel">
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "product")) == 0) echo "checked"; ?> value = "product">
                                            <label><?php echo strtoupper("product") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "customer")) == 0) echo "checked"; ?> value = "customer">
                                            <label><?php echo strtoupper("customer") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "uom")) == 0) echo "checked"; ?> value = "uom">
                                            <label><?php echo strtoupper("uom") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "expanses")) == 0) echo "checked"; ?> value = "expanses">
                                            <label><?php echo strtoupper("expanses") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "supplier")) == 0) echo "checked"; ?> value = "supplier">
                                            <label><?php echo strtoupper("supplier") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "shipping")) == 0) echo "checked"; ?> value = "shipping">
                                            <label><?php echo strtoupper("shipping") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "user")) == 0) echo "checked"; ?> value = "user">
                                            <label><?php echo strtoupper("user") ?></label>
                                        </div>
                                        <hr/>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "rfq")) == 0) echo "checked"; ?> value = "rfq">
                                            <label><?php echo strtoupper("rfq") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "vendor")) == 0) echo "checked"; ?> value = "vendor">
                                            <label><?php echo strtoupper("vendor") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "quotation")) == 0) echo "checked"; ?> value = "quotation">
                                            <label><?php echo strtoupper("quotation") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "oc")) == 0) echo "checked"; ?> value = "oc">
                                            <label><?php echo strtoupper("oc") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "po")) == 0) echo "checked"; ?> value = "po">
                                            <label><?php echo strtoupper("po") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "od")) == 0) echo "checked"; ?> value = "od">
                                            <label><?php echo strtoupper("od") ?></label>
                                        </div>
                                        <hr/>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "receivable")) == 0) echo "checked"; ?> value = "receivable">
                                            <label><?php echo strtoupper("receivable") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "payable")) == 0) echo "checked"; ?> value = "payable">
                                            <label><?php echo strtoupper("payable") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "reimburse")) == 0) echo "checked"; ?> value = "reimburse">
                                            <label><?php echo strtoupper("reimburse") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "margin")) == 0) echo "checked"; ?> value = "margin">
                                            <label><?php echo strtoupper("margin") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "ppn")) == 0) echo "checked"; ?> value = "ppn">
                                            <label><?php echo strtoupper("ppn") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "pph23")) == 0) echo "checked"; ?> value = "pph23">
                                            <label><?php echo strtoupper("pph23") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "pib")) == 0) echo "checked"; ?> value = "pib">
                                            <label><?php echo strtoupper("pib") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "petty")) == 0) echo "checked"; ?> value = "petty">
                                            <label><?php echo strtoupper("petty") ?></label>
                                        </div>
                                        <hr/>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "kpi")) == 0) echo "checked"; ?> value = "kpi">
                                            <label><?php echo strtoupper("kpi") ?></label>
                                        </div>
                                        <div class = "checkbox-custom checkbox-primary">
                                            <input type = "checkbox" name = "privileges[]" <?php if(isExistsInTable("privilage", array("id_user" => $employee[$a]["id_user"],"id_menu" => "report")) == 0) echo "checked"; ?> value = "report">
                                            <label><?php echo strtoupper("report") ?></label>
                                        </div>
                                        <div class = "form-group">
                                            <button type = "submit" class = "btn btn-primary btn-outline col-lg-2 col-md-12">SUBMIT</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
            <?php endfor; ?>
        </tbody>
    </table>
</div>

<!-- add user modal -->
<div class="modal fade" id="TambahUser" aria-hidden="true" aria-labelledby="DaftarUser" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleModalTabs">User Data</h4>
            </div>

            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData"
                    aria-controls="primaryData" role="tab">Primary Data</a></li>
            </ul>
            <form action = "<?php echo base_url();?>master/user/employee/register" method = "post">    
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="primaryData" role="tabpanel">
                            <?php
                            $title = array(
                                "Full Name",
                                "Email",
                                "Mobile Number",
                                "password"
                            );
                            $type = array(
                                "text",
                                "email",
                                "text",
                                "password"
                            );
                            $name = array(
                                "nama_user",
                                "email_user",
                                "nohp_user",
                                "password"
                            );
                            $help = array(
                                "Please capitalize each word ex: Firstname Lastname",
                                "Use the proper email format username@example.com. Email will be used for login and CRM",
                                "Active mobile phone",
                                "Default password:123456"
                            );
                            $value = array(
                                "",
                                "",
                                "",
                                "12345612345",
                            );
                            $placeholder = array(
                                "Full Name",
                                "username@example.com",
                                "089612345678",
                                ""
                            );
                            ?>
                            <?php for($a = 0; $a<count($help); $a++){ ?>
                            <div class = "form-group">
                                <div class="col-md-12 col-lg-12">
                                    <!-- Example With Help -->
                                    <h4 class="example-title"><?php echo $title[$a];?></h4>
                                    <input type="<?php echo $type[$a];?>" name = "<?php echo $name[$a];?>" class="form-control" id="inputHelpText" placeholder = "<?php echo $placeholder[$a];?>" required value = "<?php echo $value[$a];?>">
                                    <span class="text-help"><?php echo $help[$a];?></span>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <div class = "form-group">
                                <div class="col-md-12 col-lg-12">
                                    <!-- Example With Help -->
                                    <h4 class="example-title">User Type</h4>
                                    <select class = "form-control" name = "jenis_user">
                                        <option value = "USER">USER</option>
                                        <option value = "SALES">SALES</option>
                                        <option value = "LABOR">LABOR</option>
                                    </select>
                                    <span class="text-help">User Type</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add employee modal -->

