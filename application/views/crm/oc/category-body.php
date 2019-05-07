<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="exampleAddRow">
        <thead>
            <tr>
                <th>Order Confirmation ID</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr class="gradeA">
                <td>OC-001</td>
                <td>CUS-001</td>
                <td>Joshua Natan W</td>
                <td class="actions">
                    <button class = "btn btn-outline btn-success" data-content="Set Payment Agreement" data-trigger="hover" data-toggle="popover"><i class = "icon wb-menu" data-toggle="modal" data-target="#paymentagreement" aria-hidden="true"></i></button>
                    <button class="btn btn-outline btn-warning" data-content="Generate PO Manually" data-trigger="hover" data-toggle="popover"><i class="icon wb-eye" aria-hidden="true" data-target="#FeedbackQuotation" data-toggle="modal"></i></button>
                    <button class="btn btn-outline btn-primary" data-content="Generate PO Automatically" data-trigger="hover" data-toggle="popover"><i class="icon wb-briefcase" aria-hidden="true" data-target="#FeedbackQuotation" data-toggle="modal"></i></button>

                </td>
            </tr>
            
        </tbody>
    </table>
</div>
<div class="modal fade" id="paymentagreement" aria-hidden="true" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Payment Agreement</h4>
            </div>
            <div class="modal-body">
                <form>
                    
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" value="Rp 15.000.000" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" value="Garuda Package" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" value="2 Item" readonly>
                    </div>
                    <div class = "col-lg-12 form-group">
                        <label>Payment Agreement</label>
                        <table class = "table table-bordered table-hover table-striped w-full">
                            <thead>
                                <th>Value</th>
                                <th>Dateline</th>
                                <th>Event</th>
                                <th>Action</th>
                            </thead>
                            <tbody id ="t1">
                                
                            </tbody>
                            
                        </table>
                        <button type = "button" class = "btn btn-sm btn-success col-lg-12" onclick="add()">Add Variable</button>
                    </div>
                    <div class="col-xl-12 form-group">
                        <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="DataPesanan">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Selling Price</th>
                                    <th>Net Margin</th>
                                </tr>
                            </thead>
                            <tbody id = "t1">
                                <tr class='gradeA'>
                                    <td>Meja Tulis</td>
                                    <td>5</td>
                                    <td>25.000</td>
                                    <td>15%</td>
                                    
                                </tr>
                                <tr class='gradeA'>
                                    <td>Meja Tulis</td>
                                    <td>5</td>
                                    <td>45.000</td>
                                    <td>23%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
