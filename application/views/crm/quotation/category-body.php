<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <a href = "<?php echo base_url();?>crm/quotation/create" class="btn btn-outline btn-primary">
                <i class="icon wb-plus" aria-hidden="true"></i> Create Quotation
            </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>Quotation ID</th>
                <th>Version</th>
                <th>Customer Firm</th>
                <th>Customer Name</th>
                <th>Status Quotation</th>
                <th>Sending Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($quotation->result() as $a){ ?> 
            <tr class="gradeA">
                <td><?php echo $a->no_quo;?></td>
                <td><?php echo $a->versi_quo;?></td>
                <td><?php echo $a->nama_perusahaan;?></td>
                <td><?php echo $a->nama_cp;?></td>
                <td>
                    <?php if($a->status_quo == 0){ ?> 
                    <button class = "btn btn-sm btn-primary btn-outline">ON GOING</button>
                    <?php } ?>
                    <?php if($a->status_quo == 1){ ?> 
                    <button class = "btn btn-sm btn-warning btn-outline">LOSS</button>
                    <?php } ?>
                    <?php if($a->status_quo == 2){ ?> 
                    <button class = "btn btn-sm btn-success btn-outline">ACCEPTED</button>
                    <?php } ?>
                    <?php if($a->status_quo == 3){ echo "&nbsp"; } ?> 
                </td>
                <td><?php echo $a->date_quo_add;?></td>
                <td class="actions">
                    
                    <a href = "<?php echo base_url();?>crm/quotation/edit/<?php echo $a->id_quo;?>" class="btn btn-outline btn-primary"><i class="icon wb-edit" aria-hidden="true"></i></a>
                    <!-- setelah email dikirim, gabisa di edit / dihapus -->
                    <a href = "#" class = "btn btn-outline btn-warning" data-trigger="hover" data-content="Send to Customer" data-trigger="hover" data-toggle="popover"><i class = "icon wb-chat"></i></a>

                    <button class="btn btn-outline btn-success" data-content="Put & See Customer Feedback Here" data-trigger="hover" data-toggle="popover"><i class="icon wb-eye" aria-hidden="true" data-target="#FeedbackQuotation" data-toggle="modal"></i></button>

                    <a href = "<?php echo base_url();?>crm/quotation/loss/<?php echo $a->id_quo;?>/<?php echo $a->versi_quo;?>" class="btn btn-outline btn-danger" data-content="Quotation Loss" data-trigger="hover" data-toggle="popover"><i class="icon wb-trash" aria-hidden="true"></i></a> 
                    
                    <a href = "<?php echo base_url();?>crm/quotation/accepted/<?php echo $a->id_quo;?>/<?php echo $a->versi_quo;?>" class="btn btn-outline btn-primary" data-content="Proceed to Order Confirmation" data-trigger="hover" data-toggle="popover"><i class="icon wb-briefcase" aria-hidden="true"></i></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="FeedbackQuotation" aria-hidden="true" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Customer Feedback</h4>
            </div>
            <div class="modal-body">
                <form>
                    <textarea class = "form-control" rows=5 placeholder="Submit Customer Feedback Here..."></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>