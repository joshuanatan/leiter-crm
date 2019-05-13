<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <button data-target="#TambahRequest" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button">
                <i class="icon wb-plus" aria-hidden="true"></i> Create Goods Arrival Report
            </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="exampleAddRow">
        <thead>
            <tr>
                <th>Purchase Order ID</th>
                <th>Date Arrived</th>
                <th>Receiver</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="gradeA">
                <td>PO-001</td>
                <td>13/03/2018</td>
                <td>Anggara Budiman</td>
                <td class="actions">
                    
                    <button data-target="#DetailData" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button"><i class="icon wb-edit" aria-hidden="true"></i></button>
                    
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
                <h4 class="modal-title" id="exampleFormModalLabel">Goods Arrival</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <select class = "form-control" placeholder="Last Name" data-plugin="select2">
                            <option selected>Select PO ID</option> <!-- kalau pilih yang ini, auto generate nomor quotation baru -->
                            <option>PO-001</option> <!--kalau pilih yang ini, auto generate revisi ke berapa -->
                        </select>
                    </div>
                    <div class="col-xl-12 form-group">
                        <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="DataPesanan">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Quality</th>
                                </tr>
                            </thead>
                            <tbody id = "t1">
                                <tr class='gradeA'>
                                    <td>Meja Tulis</td>
                                    <td>5</td>
                                    <td>
                                        <input type="checkbox" id="inputUnchecked" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                        <input type = "submit" class = "form-control">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="DetailData" aria-hidden="false" aria-labelledby="TambahRequestLabel" role="dialog">
    <div class="modal-dialog modal-simple">
        <form class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleFormModalLabel">Goods Arrival</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <input type = "text" value = "PO-001" class = "form-control" readonly>
                    </div>
                    <div class="col-xl-12 form-group">
                        <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" id="DataPesanan">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Quality</th>
                                </tr>
                            </thead>
                            <tbody id = "t1">
                                <tr class='gradeA'>
                                    <td>Meja Tulis</td>
                                    <td>5</td>
                                    <td>
                                        <input type="checkbox" id="inputUnchecked" checked/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                        <input type = "submit" class = "form-control">
                </div>
            </div>
        </form>
    </div>
</div>
