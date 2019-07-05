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
                <th>No Quotation</th>
                <th>Version</th>
                <th>Customer Firm</th>
                <th>Customer Name</th>
                <th>Status Quotation</th>
                <th>Sending Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0 ; $a<count($quotation);$a++){ ?> 
            <tr class="gradeA">
                <td><?php echo $quotation[$a]["no_quotation"];?></td>
                <td><?php echo $quotation[$a]["versi_quotation"];?></td>
                <td><?php echo $quotation[$a]["nama_perusahaan"];?></td>
                <td><?php echo $quotation[$a]["nama_cp"];?></td>
                <td>
                    <?php if($quotation[$a]["status_quotation"] == 0){ ?> 
                    <button class = "btn btn-sm btn-primary btn-outline">ON GOING</button>
                    <?php } ?>
                    <?php if($quotation[$a]["status_quotation"] == 1){ ?> 
                    <button class = "btn btn-sm btn-warning btn-outline">LOSS</button>
                    <?php } ?>
                    <?php if($quotation[$a]["status_quotation"] == 2){ ?> 
                    <button class = "btn btn-sm btn-success btn-outline">WIN</button>
                    <?php } ?>
                    <?php if($quotation[$a]["status_quotation"] == 3){ echo "&nbsp"; } ?> 
                </td>
                <td><?php echo $quotation[$a]["date_quotation_add"];?></td>
                <td class="actions">
                    
                    <a href = "<?php echo base_url();?>crm/quotation/edit/<?php echo $quotation[$a]["id_submit_quotation"];?>" class="btn btn-outline btn-primary"><i class="icon wb-edit" aria-hidden="true"></i></a>
                    <a href = "<?php echo base_url();?>crm/quotation/revision/<?php echo $quotation[$a]["id_submit_quotation"];?>" class="btn btn-outline btn-success" data-content="Do Revision Here" data-trigger="hover" data-toggle="popover"><i class="icon wb-eye" aria-hidden="true"></i></a>

                    <a href = "<?php echo base_url();?>crm/quotation/loss/<?php echo $quotation[$a]["id_submit_quotation"];?>" class="btn btn-outline btn-danger" data-content="Quotation Loss" data-trigger="hover" data-toggle="popover"><i class="icon wb-trash" aria-hidden="true"></i></a> 
                    
                    <a href = "<?php echo base_url();?>crm/quotation/accepted/<?php echo $quotation[$a]["id_submit_quotation"];?>/<?php echo $quotation[$a]["bulan_quotation"];?>/<?php echo $quotation[$a]["tahun_quotation"];?>" class="btn btn-outline btn-success" data-content="Proceed to Order Confirmation" data-trigger="hover" data-toggle="popover"><i class="icon fa fa-check" aria-hidden="true"></i></a>
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