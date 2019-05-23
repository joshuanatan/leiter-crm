
<?php 
$privileges = array();
foreach($privilege->result() as $a){
    $privileges[$a->id_user][$a->id_menu] = $a->status_privilage;
}
?>
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
                <th>Employee Name</th>
                <th>Employee Email</th>
                <th>Employee Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($employee->result() as $a){ ?> 
            <tr class="gradeA">
                <td><?php echo $a->id_user;?></td>
                <td><?php echo $a->nama_user;?></td>
                <td><?php echo $a->email_user?></td>
                <td><?php echo $a->nohp_user;?></td>
                <td class="actions">
                    
                    <button type="button" data-target = "#DetailUser<?php echo $a->id_user;?>" data-toggle="modal" class="btn btn-outline btn-primary" type="button"><i class="icon wb-edit" data-content="Detail Profile" data-trigger="hover" data-toggle="popover" aria-hidden="true"></i></button>

                    <a href = "<?php echo base_url();?>master/user/employee/delete/<?php echo $a->id_user;?>" class="btn btn-outline btn-danger" data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></a>
                    
                    <button class="btn btn-outline btn-success" data-toggle="modal" data-target="#Privilege<?php echo $a->id_user;?>"><i class="icon wb-eye" aria-hidden="true"></i></button>
                </td>
            </tr>
            <!-- here goes modal -->
            <div class="modal fade" id="DetailUser<?php echo $a->id_user;?>" aria-hidden="true" aria-labelledby="DaftarUser" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-simple">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalTabs">EMPLOYEE EDIT</h4>
                        </div>

                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"  href="#primaryData<?php echo $a->id_user;?>"  aria-controls="primaryData<?php echo $a->id_user;?>" role="tab">Primary Data</a></li>
                        </ul>
                        <div class="modal-body">
                            <form action = "<?php echo base_url();?>master/user/employee/editemployee" method = "post">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="primaryData<?php echo $a->id_user;?>" role="tabpanel">
                                        <?php
                                        $title = array(
                                            "Full Name",
                                            "Email",
                                            "Mobile Number",
                                            ""
                                        );
                                        $type = array(
                                            "text",
                                            "email",
                                            "text",
                                            "hidden"
                                        );
                                        $name = array(
                                            "nama_user",
                                            "email_user",
                                            "nohp_user",
                                            "id_user"
                                        );
                                        $help = array(
                                            "Before: ".$a->nama_user,
                                            "Before: ".$a->email_user,
                                            "Before: ".$a->nohp_user,
                                            ""
                                        );
                                        $value = array(
                                            $a->nama_user,
                                            $a->email_user,
                                            $a->nohp_user,
                                            $a->id_user
                                        );
                                        $placeholder = array(
                                            "Full Name",
                                            "username@example.com",
                                            "089612345678",
                                            ""
                                        );
                                        ?>
                                        <?php for($c = 0; $c<count($help); $c++){ ?>
                                        <div class = "form-group">
                                            <div class="col-md-12 col-lg-12">
                                                <!-- Example With Help -->
                                                <h4 class="example-title"><?php echo $title[$c];?></h4>
                                                <input type="<?php echo $type[$c];?>" name = "<?php echo $name[$c];?>" class="form-control" id="inputHelpText" placeholder = "<?php echo $placeholder[$c];?>" required value = "<?php echo $value[$c];?>">
                                                <span class="text-help"><?php echo $help[$c];?></span>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
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

            <div class="modal fade" id="Privilege<?php echo $a->id_user;?>" aria-hidden="true" aria-labelledby="Privilege" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-simple">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalTabs">EMPLOYEE PRIVILEGE</h4>
                        </div>

                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab"  href="#primaryData<?php echo $a->id_user;?>"  aria-controls="primaryData<?php echo $a->id_user;?>" role="tab">Primary Data</a></li>
                        </ul>
                        <div class="modal-body">
                            
                            <form action = "<?php echo base_url();?>master/user/employee/editprivilege/<?php echo $a->id_user;?>" method = "post">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="privilege<?php echo $a->id_user;?>" role="tabpanel">
                                    <?php
                                        $kategori = "";
                                        $mulai = 0;
                                        ?>
                                        <?php 
                                        foreach($menu->result() as $b){ 
                                            if($b->type_menu != $kategori){ /*kalau ganti kategori / mulai pertama*/
                                                if($mulai == 1){ ?> <!-- kalau bukan lagi kategori pertama. Karena kalau kategori pertama, gaperlu di tutup-->
                                                            </div>
                                                                <span class="text-help"></span>
                                                            </div>
                                                    </div>   
                                                    <hr/> 
                                                <?php
                                                }
                                                $kategori = $b->type_menu;
                                                $mulai = 1;
                                                ?>
                                                <div class = "form-group">
                                                    <div class="col-md-12 col-lg-12">
                                                        <!-- Example With Help -->
                                                        <h4 class="example-title"><?php echo $kategori;?></h4>
                                                        <div class="col-md-12 col-xl-12">
                                                            <!-- Example Checkboxes -->
                                                <?php
                                            }
                                        ?> 
                                        <!-- selebihnya ngeload ini aja, ini checkbox -->
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" value = "<?php echo $b->id_menu;?>" id="inputUnchecked<?php echo $b->id_menu;?>" name = "<?php echo strtolower($kategori);?>[]" <?php if($privileges[$a->id_user][$b->id_menu] == 0) echo "checked"; ?>/>

                                            <label for="inputUnchecked<?php echo $b->id_menu;?>"><?php echo $b->nama_menu;?></label>
                                        </div>
                                        <!-- end checkboxnya -->  
                                        <?php } ?>
                                        <hr/>
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
            <?php } ?>
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
                <h4 class="modal-title" id="exampleModalTabs">Employee Data</h4>
            </div>

            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData"
                    aria-controls="primaryData" role="tab">Primary Data</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#privilage"
                    aria-controls="privilage" role="tab">Privilege</a></li>
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
                            
                        </div>
                        <div class="tab-pane" id="privilage" role="tabpanel">
                            <?php
                            $kategori = "";
                            $mulai = 0;
                            ?>
                            <?php 
                            foreach($menu->result() as $a){ 
                                if($a->type_menu != $kategori){ /*kalau ganti kategori / mulai pertama*/
                                    if($mulai == 1){ ?> <!-- kalau bukan lagi kategori pertama. Karena kalau kategori pertama, gaperlu di tutup-->
                                                </div>
                                                    <span class="text-help"></span>
                                                </div>
                                        </div>   
                                        <hr/> 
                                    <?php
                                    }
                                    $kategori = $a->type_menu;
                                    $mulai = 1;
                                    ?>
                                    <div class = "form-group">
                                        <div class="col-md-12 col-lg-12">
                                            <!-- Example With Help -->
                                            <h4 class="example-title"><?php echo $kategori;?></h4>
                                            <div class="col-md-12 col-xl-12">
                                                <!-- Example Checkboxes -->
                                    <?php
                                }
                            ?> 
                            <!-- selebihnya ngeload ini aja, ini checkbox -->
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" value = "<?php echo $a->id_menu;?>" id="inputUnchecked<?php echo $a->id_menu;?>" name = "<?php echo strtolower($kategori);?>[]";/>
                                <label for="inputUnchecked<?php echo $a->id_menu;?>"><?php echo $a->nama_menu;?></label>
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
<!-- end add employee modal -->

