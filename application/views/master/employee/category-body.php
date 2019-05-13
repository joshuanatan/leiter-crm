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
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="exampleAddRow">
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
                    
                    <button data-target="#editModal" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button"><i class="icon wb-edit" data-content="Detail Profile" data-trigger="hover" data-toggle="popover" aria-hidden="true"></i></button>

                    <button class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></button>
                    
                    <a href = "<?php echo base_url();?>master/user/employee/detail" class="btn btn-outline btn-success"
                    data-toggle="tooltip"><i class="icon wb-eye" aria-hidden="true"></i></a>
                </td>
            </tr>
            <!-- here goes modal -->
            <div class="modal fade" id="DetailUser" aria-hidden="true" aria-labelledby="DaftarUser" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-simple">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalTabs">Tabs In Modal</h4>
                        </div>

                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#exampleLine1"
                                aria-controls="exampleLine1" role="tab">Home</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleLine2"
                                aria-controls="exampleLine2" role="tab">Components</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleLine3"
                                aria-controls="exampleLine3" role="tab">CSS</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleLine4"
                                aria-controls="exampleLine4" role="tab">JavaScript</a></li>
                        </ul>

                        <div class="modal-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="exampleLine1" role="tabpanel">
                                Insolens patientiamque recte caecilii gaudere alienae varias repetitis inscientia
                                ipsos. Partiendo interpretum vult ludicra iam abest
                                disputatum geometriaque inflammat probes, tandem
                                ullum iuste texit mundus delicatissimi iactare,
                                impeditur panaetium intellegentium afferat talem
                                satisfacit numquid accedunt secumque perspiciatis,
                                invenire inquam voluptaria virtute concederetur
                                genus suavitate, inviti argumentum parentes, repudiandae
                                aliud perspiciatis, latinas consul pluribus regula
                                ceramico turbent, cogitavisse possunt suo tranquillitate.
                                </div>

                                <div class="tab-pane" id="exampleLine2" role="tabpanel">
                                Tenuit omni magistra quale honoris, maluisti invidi, successerit feramus fere omnium
                                impetum locus suscipiantur ullum, gessisse afranius
                                stabilique repellendus longinquitate sentiamus
                                torquatos rem. Bene continens, depulsa soluta domesticarum
                                inscientia excruciant artes epicuri, huic similique
                                constringendos probo animadversionis claris sententia
                                atqui vocent constituit, epicuri hosti iniuste
                                naturales multos, optimus animadvertat stoicis
                                nullae, fieri futura tempore philosophia expleantur
                                putarent doloris delectus viris.
                                </div>

                                <div class="tab-pane" id="exampleLine3" role="tabpanel">
                                Cernimus nutu. Maioribus solet. Iustitiam conciliant reliquisti instituendarum
                                solido quicquid, superstitione placet illis privatione
                                clariora audeam repellat morbos accusantibus, quaeso
                                copulationes. Percurri salutatus derigatur praeter
                                involuta canes afflueret iam amotio quin. Dicent
                                dialectica evertunt astris venire senserit. Vulgo
                                supplicii amputata ipsarum ennius insolens meminerunt
                                quisquam, volumus occulte l videor contenta numen,
                                patrioque. Dixerit cernimus consequentium definitiones
                                interrogari, maximo, avocent opes.
                                </div>

                                <div class="tab-pane" id="exampleLine4" role="tabpanel">
                                Nec iste vellem, accusamus inesse exhorrescere tertium dominationis licebit perpetiuntur,
                                adduci concederetur memoriter omnesque aliquem
                                etsi salutatus administrari aliquid graviter, mandamus
                                celeritas patet fortibus. Dolorum tantis nostram
                                fortitudo probarentur utrumvis insipientiam, putent,
                                esset p fortitudo repetitis concursionibus interiret
                                clariora. Fabulae aperiri. Omnes aspernari placuit
                                detraxit familias aeternum eum mediocritatem, videantur
                                partis nondum indoctis, emancipaverat probatum
                                intus iactant petulantes, levitatibus copiosae.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
            </div>
        </div>
            <!-- end modal -->
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
            <form>    
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
                                        </div>    
                                    <?php
                                    }
                                    $kategori = $a->type_menu;
                                    $mulai == 1;
                                    ?>
                                    <div class = "form-group">
                                        <div class="col-md-12 col-lg-12">
                                            <!-- Example With Help -->
                                            <h4 class="example-title"><?php echo $kategori;?></h4>
                                            <div class="col-md-12 col-xl-12">
                                                <div class="example-wrap">
                                                <!-- Example Checkboxes -->
                                    <?php
                                }
                            ?> 
                            <!-- selebihnya ngeload ini aja, ini checkbox -->
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="inputUnchecked<?php echo $a->id_menu;?>" name = "<?php echo $kategori;?>[]";/>
                                <label for="inputUnchecked<?php echo $a->id_menu;?>"><?php echo $a->nama_menu;?></label>
                            </div>
                            <!-- end checkboxnya -->  
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add customer modal -->