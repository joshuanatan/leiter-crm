<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <button data-target="#TambahRequest" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button">
                <i class="icon wb-plus" aria-hidden="true"></i> Create Quotation
            </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="exampleAddRow">
        <thead>
            <tr>
                <th>Quotation ID</th>
                <th>Version</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Sending Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="gradeA">
                <td>QUO-001</td>
                <td>1</td>
                <td>CUS-001</td>
                <td>Joshua Natan W</td>
                <td>13/03/2018</td>
                <td class="actions">
                    
                    <button data-target="#EditRequest" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button"><i class="icon wb-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></button> <!-- setelah email dikirim, gabisa di edit / dihapus -->
                    <a href = "#" class = "btn btn-outline btn-warning" data-trigger="hover" data-content="Send to Customer" data-trigger="hover" data-toggle="popover"><i class = "icon wb-chat"></i></a>
                    <button class="btn btn-outline btn-success" data-content="Put & See Customer Feedback Here" data-trigger="hover" data-toggle="popover"><i class="icon wb-eye" aria-hidden="true" data-target="#FeedbackQuotation" data-toggle="modal"></i></button>
                    <button class="btn btn-outline btn-primary" data-content="Proceed to Order Confirmation" data-trigger="hover" data-toggle="popover"><i class="icon wb-briefcase" aria-hidden="true" data-target="#FeedbackQuotation" data-toggle="modal"></i></button>
                </td>
            </tr>
            
        </tbody>
    </table>
</div>
<div class="modal fade" id="TambahRequest" aria-hidden="false" aria-labelledby="TambahRequestLabel" role="dialog">
    <div class="modal-dialog modal-simple">
        <form class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleFormModalLabel">Price Request</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <select class = "form-control" placeholder="Last Name" data-plugin="select2">
                            <option selected>New Quotation</option> <!-- kalau pilih yang ini, auto generate nomor quotation baru -->
                            <option>QUO-001</option> <!--kalau pilih yang ini, auto generate revisi ke berapa -->
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" placeholder="New Quotation ID / Version">
                    </div>
                    <div class="col-xl-12 form-group">
                        <select class = "form-control" placeholder="Last Name" data-plugin="select2">
                            <option selected disabled>Choose Price Request ID</option> <!-- kalau pilih yang ini, auto generate nomor quotation baru -->
                            <option>REQ-001</option> <!--kalau pilih yang ini, auto generate revisi ke berapa -->
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <select class = "form-control" placeholder="Last Name" data-plugin="select2">
                            <option selected disabled>Choose Shipping Vendor ID</option> <!-- kalau pilih yang ini, auto generate nomor quotation baru -->
                            <option>SHP-001</option> <!--kalau pilih yang ini, auto generate revisi ke berapa -->
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" placeholder="Shipping Vendor Name">
                    </div>
                    <div class = "col-lg-12 form-group">
                        <table class = "table table-bordered table-hover table-striped w-full">
                            <thead>
                                <th>Variable</th>
                                <th>Value</th>
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
                                    <th>Vendor Price</th>
                                    <th>Selling Price</th>
                                    <th>Net Margin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id = "t1">
                                <tr class='gradeA'>
                                    <td>Meja Tulis</td>
                                    <td>5</td>
                                    <td>15.000</td>
                                    <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" /></td>
                                    <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" readonly /></td>
                                    <td>
                                        <button class = "btn btn-sm btn-success col-lg-12">Save</button>
                                        <button class = "btn btn-sm btn-danger col-lg-12">Cancel</button>
                                    </td>
                                </tr>
                                <tr class='gradeA'>
                                    <td>Meja Tulis</td>
                                    <td>5</td>
                                    <td>15.000</td>
                                    <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" /></td>
                                    <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" readonly /></td>
                                    <td>
                                        <button class = "btn btn-sm btn-success col-lg-12">Save</button>
                                        <button class = "btn btn-sm btn-danger col-lg-12">Cancel</button>
                                    </td>
                                </tr>
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="EditRequest" aria-hidden="false" aria-labelledby="TambahRequestLabel" role="dialog">
    <div class="modal-dialog modal-simple">
        <form class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleFormModalLabel">Price Request</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <select class = "form-control" placeholder="Last Name" data-plugin="select2">
                            <option selected>New Quotation</option> <!-- kalau pilih yang ini, auto generate nomor quotation baru -->
                            <option>QUO-001</option> <!--kalau pilih yang ini, auto generate revisi ke berapa -->
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" placeholder="New Quotation ID / Version">
                    </div>
                    <div class="col-xl-12 form-group">
                        <select class = "form-control" placeholder="Last Name" data-plugin="select2">
                            <option selected disabled>Choose Price Request ID</option> <!-- kalau pilih yang ini, auto generate nomor quotation baru -->
                            <option>REQ-001</option> <!--kalau pilih yang ini, auto generate revisi ke berapa -->
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <select class = "form-control" placeholder="Last Name" data-plugin="select2">
                            <option selected disabled>Choose Shipping Vendor ID</option> <!-- kalau pilih yang ini, auto generate nomor quotation baru -->
                            <option>SHP-001</option> <!--kalau pilih yang ini, auto generate revisi ke berapa -->
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" placeholder="Shipping Vendor Name">
                    </div>
                    <div class = "col-lg-12 form-group">
                        <table class = "table table-bordered table-hover table-striped w-full">
                            <thead>
                                <th>Variable</th>
                                <th>Value</th>
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
                                    <th>Vendor Price</th>
                                    <th>Selling Price</th>
                                    <th>Net Margin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id = "t1">
                                <tr class='gradeA'>
                                    <td>Meja Tulis</td>
                                    <td>5</td>
                                    <td>15.000</td>
                                    <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" /></td>
                                    <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" readonly /></td>
                                    <td>
                                        <button class = "btn btn-sm btn-success col-lg-12">Save</button>
                                        <button class = "btn btn-sm btn-danger col-lg-12">Cancel</button>
                                    </td>
                                </tr>
                                <tr class='gradeA'>
                                    <td>Meja Tulis</td>
                                    <td>5</td>
                                    <td>15.000</td>
                                    <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" /></td>
                                    <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" readonly /></td>
                                    <td>
                                        <button class = "btn btn-sm btn-success col-lg-12">Save</button>
                                        <button class = "btn btn-sm btn-danger col-lg-12">Cancel</button>
                                    </td>
                                </tr>
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
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