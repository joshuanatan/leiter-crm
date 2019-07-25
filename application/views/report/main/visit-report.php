
<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
                <button type="button" data-target = "#createReport" data-toggle = "modal" class = "btn btn-primary btn-outline">Create Report
                </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>ID Report</th> <!-- nanti ini keisi waktu nambahin OC-->
                <th>Nama Perusahaan</th>
                <th>PIC Target</th>
                <th>Location / Duration</th>
                <th>Conversation</th> <!--nanti kasih tombol buat image setelah konten conversationnya selesai-->
                <th>Conclusion</th> 
                <th>Next Action</th>
                <th>Support</th>
                <th>Follow Up Date</th>
                <th>Detail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($visit);$a++):?>
            <tr>
                <td><?php echo $visit[$a]["id_submit_report"];?></td>
                <td><?php echo $visit[$a]["nama_perusahaan"];?></td>
                <td><?php echo $visit[$a]["action_pic"];?> - (<?php echo $visit[$a]["pic_position"];?>)</td>
                <td>
                    <?php echo ucwords($visit[$a]["action_location"]);?> <br/>
                    <?php $split = explode(":",$visit[$a]["action_duration"]);echo $split[0] ." Jam ". $split[1]. " Menit";?>
                </td>
                <td><?php echo nl2br($visit[$a]["action_conversation"]);?><br/><a href = "<?php echo base_url();?>assets/report/visit/<?php echo $visit[$a]["conversation_image"];?>" target = "_blank" class = "btn btn-sm btn-primary">Attachment</a></td>
                <td><?php echo nl2br($visit[$a]["action_conclusion"]);?></td>
                <td><button class = "btn btn-sm btn-primary" data-toggle = "modal" data-target = "#nextAction<?php echo $a;?>">Next Action</button></td>
                <td><?php echo nl2br($visit[$a]["support_need"]);?></td>
                <td><?php $date = date_create($visit[$a]["followup_date"]); echo date_format($date,"D d-m-Y");?></td>
                <td>
                    <button class = "btn btn-primary btn-outline btn-sm" data-target = "#detailReport<?php echo $a;?>" data-toggle = "modal">DETAIL</button>
                </td>
                <td>
                    <button class = "col-lg-12 btn btn-primary btn-outline btn-sm" data-target = "#editReport<?php echo $a;?>" data-toggle = "modal">EDIT</button>
                    <a href = "<?php echo base_url();?>report/main/removeVisitReport/<?php echo $visit[$a]["id_submit_report"];?>" class = "col-lg-12 btn btn-danger btn-outline btn-sm">REMOVE</a> 
                    <a target = "_blank" href = "<?php echo base_url();?>report/main/pdfVisitReport/<?php echo $visit[$a]["id_submit_report"];?>" class = "col-lg-12 btn btn-primary btn-outline btn-sm">PDF</a> 
                    
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>
<div class = "modal fade" id = "createReport">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">CREATE VISIT REPORT</h4>
            </div>
            <form action = "<?php echo base_url();?>report/main/insertVisitReport" method = "POST" enctype = "multipart/form-data">
                <div class = "modal-body">
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Nama Perusahaan</h5>
                        <input type = "text" name = "judul_report" class = "form-control" id = "namaperusahaan" oninput = "copy('namaperusahaan','backup');getRecommendationPerusahaan()">
                        <input type = "hidden" id ="backup">
                        <input type = "hidden" id = "id_perusahaan" name = "id_perusahaan">
                    </div>
                    <div class = "form-group">
                        <span style = "color:red; display:none" id = "customerNotFound">CUSTOMER NOT FOUND</span>
                        <button class = "btn btn-primary" type = "button" data-toggle = "modal" data-target = "#customerBaru">Customer Baru</button>
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Visit Date</h5>
                        <input type = "date" name = "action_date" class = "form-control">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Location</h5>
                        <input type = "text" name = "action_location" class = "form-control">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Duration (HH:MM)</h5>
                        <input type = "text" name = "action_duration" class = "form-control">
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Purpose</h5>
                        <input type = "text" name = "action_purpose" class = "form-control">
                    </div>
                    <div class = "row">
                        <div class = "form-group col-lg-6 col-sm-12">
                            <h5 style = "opacity:0.5">PIC (Ibu Abc / Bapak Def)</h5>
                            <input type = "text" name = "action_pic" class = "form-control">
                        </div>
                        <div class = "form-group col-lg-6 col-sm-12">
                            <h5 style = "opacity:0.5">Jabatan PIC</h5>
                            <input type = "text" name = "pic_position" class = "form-control">
                        </div>
                    </div>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Dialog</h5>
                        <textarea class = "form-control" name = "action_conversation"></textarea>
                        <input type = "file" name = "conversation_image">
                    </div>  
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Potential Machine</h5>
                        <textarea class = "form-control" name = "potential_machine"></textarea>
                    </div>  
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Conclusion</h5>
                        <textarea class = "form-control" name = "action_conclusion"></textarea>
                    </div>  
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Percentage (Isi persennya saja)</h5>
                        <input type = "number" name = "action_percentage_order" class = "form-control">
                    </div>
                    <table class = "table table-stripped table-bordered" style = "width:100%" data-plugin = "dataTable">
                        <thead>
                            <th>#</th>
                            <th>Remarks</th>
                            <th>PIC</th>
                        </thead>
                        <tbody>
                            <?php for($a = 0; $a<10; $a++):?>
                            <tr>
                                <td>
                                    <div class = "checkbox-custom checkbox-primary">
                                        <input type = "checkbox" name = "checks[]" value = "<?php echo $a;?>">
                                        <label></label>
                                    </div>
                                </td>
                                <td>
                                    <input type = "text" name = "remarks<?php echo $a;?>" class = "form-control">
                                </td>
                                <td>
                                    <input type = "text" name = "pic<?php echo $a;?>" class = "form-control">
                                </td>
                            </tr>
                            <?php endfor;?>
                        </tbody>
                    </table>
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Support Needed</h5>
                        <textarea class = "form-control" name = "support_need"></textarea>
                    </div>  
                    <div class = "form-group">
                        <h5 style = "opacity:0.5">Follow Up Date</h5>
                        <input type = "date" name = "followup_date" class = "form-control">
                    </div>
                    <div class = "form-group">
                        <button class = "btn btn-primary btn-ouline col-lg-3">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php for($a = 0; $a<count($visit);$a++):?>
<div class = "modal fade" id = "nextAction<?php echo $a;?>">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Next Action
            </div>
            <div class = "modal-body">
                <table class = "table table-bordered table-stripped" data-plugin="dataTable" style = "width:100%">
                    <thead>
                        <th>Remarks</th>
                        <th>PIC</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php for($b = 0; $b<count($visit[$a]["next_action"]); $b++):?>
                        <tr>
                            <td><?php echo $visit[$a]["next_action"][$b]["remarks"];?></td>
                            <td><?php echo $visit[$a]["next_action"][$b]["pic"];?></td>
                            <td><a href = "#" class = "btn btn-danger btn-sm">DELETE</a></td>
                        </tr>
                        <?php endfor;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endfor;?>