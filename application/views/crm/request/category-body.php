<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <button data-target="#TambahRequest" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button">
                <i class="icon wb-plus" aria-hidden="true"></i> Add Price Request
            </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="exampleAddRow">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Customer Name</th>
                <th>Request</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr class="gradeA">
                <td>REQ-001</td>
                <td>Joshua Natan W</td>
                <td><button data-target="#RequestData" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button"><i class="icon wb-book" aria-hidden="true"></i>Item's Price Request</button></td>
                <td class="actions">
                    
                    <button data-target="#EditRequest" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button"><i class="icon wb-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></button>
                    
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="modal fade" id="RequestData" aria-hidden="true" aria-labelledby="RequestData" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">REQ-001/Joshua Natan W - Request for Price</h4>
            </div>
        <div class="modal-body">
            <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="DataPesanan">
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <td>ITM-001</td>
                        <td>Meja Tulis</td>
                        <td>5</td>
                    </tr>
                    <tr class="gradeA">
                        <td>ITM-002</td>
                        <td>Kursi Kayu</td>
                        <td>7</td>
                    </tr>
                </tbody>
            </table>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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
                        <input type="text" class="form-control" name="firstName" placeholder="Request ID" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <select class = "form-control" placeholder="Last Name" data-plugin="select2">
                            <option disabled selected>Choose Customer</option>
                            <option>Joshua Natan W</option>
                            <option>PT Garuda Indonesia</option>
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" placeholder="Customer ID" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="date" class="form-control" name="email" placeholder="Dateline">
                    </div>
                    <div class="col-xl-12 form-group">
                        <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="DataPesanan">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id = "t1">
                            </tbody>
                        </table>
                        <button type = "button" class = "btn btn-sm btn-success col-lg-12" onclick="add()">Add Item</button>
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
                        <input type="text" class="form-control" name="firstName" value = "REQ-001" placeholder="Request ID" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <select class = "form-control" placeholder="Last Name" data-plugin="select2">
                            <option disabled >Choose Customer</option>
                            <option selected>Joshua Natan W</option>
                            <option>PT Garuda Indonesia</option>
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="text" class="form-control" name="firstName" placeholder="Customer ID" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <input type="date" class="form-control" name="email" placeholder="Dateline">
                    </div>
                    <div class="col-xl-12 form-group">
                        <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="DataPesanan">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id = "t1">
                                <tr class='gradeA'>
                                    <td>
                                        <select class = 'form-control' id ='items' placeholder='Last Name' data-plugin='select2'>
                                            <option disabled >Choose Item</option>
                                            <option selected>Meja Tulis</option>
                                            <option>Kursi Kayu</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control' name='touchSpinVertical' data-plugin='TouchSpin' data-verticalbuttons='true' value='5' />
                                    </td>
                                    <td>
                                        <button class = 'btn btn-sm btn-danger col-lg-12' onclick='deleteRow(this)' >Remove</button></td>
                                    </tr>
                            </tbody>
                        </table>
                        <button type = "button" class = "btn btn-sm btn-success col-lg-12" onclick="add()">Add Item</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>