
<div class="panel-body col-lg-12">
    <div class = "form-group">
        <div class = "col-lg-6" style = "margin-left:0px; padding-left:0px">
            <select class = "form-control col-lg-6" id = "items" onchange = "getDetailPriceRequestItem()">
                <option selected disabled>Choose Item List</option>
                <?php for($a = 0 ; $a<count($request_item); $a++): ?> 
                <option value = "<?php echo $request_item[$a]["id_request_item"];?>"><?php echo $request_item[$a]["nama_produk"];?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
    <div>
        <div class = "form-group">
            <h5 style = "opacity:0.5">Product Name</h5>
            <textarea class = "form-control" readonly id = "nama_produk"></textarea>
        </div>
        <div class = "form-group">
            <h5 style = "opacity:0.5">Product Quantity</h5>
            <input type ="text" class = "form-control" readonly id = "jumlah_produk">
        </div>
        <div class = "form-group">
            <h5 style = "opacity:0.5">Product Request Note</h5>
            <textarea class = "form-control" readonly id = "note_produk"></textarea>
        </div>
        <div class = "form-group">
            <a href = "#" id ="file_produk" target = "_blank" class = "btn btn-primary btn-outline btn-sm">ATTACHMENT</a>
        </div>
    </div>
    <hr/>
    <button class = "btn btn-primary btn-outline btn-sm" data-toggle = "modal" data-target = "#addSupplier">ADD SUPPLIER</button>
    <button class = "btn btn-primary btn-outline btn-sm" data-toggle = "modal" data-target = "#addShipping">ADD SHIPPING</button>
    <button class = "btn btn-primary btn-outline btn-sm" data-toggle = "modal" data-target = "#viewShipping">VIEW SHIPPING</button>
    <button class = "btn btn-primary btn-outline btn-sm" data-toggle = "modal" data-target = "#addCourier">ADD COURIER</button>
    <button class = "btn btn-primary btn-outline btn-sm" data-toggle = "modal" data-target = "#viewCourier">VIEW COURIER</button>
    <br/><br/>
    <div class = "modal fade" id = "addSupplier">
        <div class = "modal-dialog modal-xl">
            <div class = "modal-content">
                <div class = "modal-header">
                    <h4 class = "modal-title">ADD SUPPLIER PRICE</h4>
                </div>
                <form action = "<?php echo base_url();?>crm/vendor/insertHargaSupplier" method = "POST" enctype = "multipart/form-data">
                    <div class = "modal-body">
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Supplier Name</h5>
                            <input type = "text" class = "form-control" name = "nama_perusahaan">
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Supplier PIC</h5>
                            <input type = "text" class = "form-control" name = "nama_cp">
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Price</h5>
                            <input type = "text" class = "form-control" id = "price" name = "price" oninput = "commas('price')">
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Rate</h5>
                            <input type = "text" class = "form-control" id = "rate" name = "rate" oninput = "commas('rate')">
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Currency</h5>
                            <select class = "form-control" name = "currency">
                                <option value = "USD">USD</option>
                                <option value = "EUR">EUR</option>
                                <option value = "IDR">IDR</option>
                            </select>
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Notes</h5>
                            <textarea class = "form-control" name = "notes"></textarea>
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Attachment</h5>
                            <input type = "file" name = "attachment">
                        </div>
                        <div class = "form-group">
                            <button type = "submit" class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class = "modal fade" id = "addShipping">
        <div class = "modal-dialog modal-xl">
            <div class = "modal-content">
                <div class = "modal-header">
                    <h4 class = "modal-title">ADD SHIPPING PRICE</h4>
                </div>
                <form action = "<?php echo base_url();?>crm/vendor/insertHargaShipping" method = "POST" enctype = "multipart/form-data">
                    <div class = "modal-body">
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Supplier Name</h5>
                            <select class = "form-control listSupplier" name = "id_harga_vendor">
                            </select>
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Shipper Name</h5>
                            <input type = "text" class = "form-control" name = "nama_perusahaan">
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Shipper PIC</h5>
                            <input type = "text" class = "form-control" name = "nama_cp">
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Shipping Method</h5>
                            <select class = "form-control" name = "metode_pengiriman">
                                <option value = "SEA">SEA</option>
                                <option value = "AIR">AIR</option>
                                <option value = "LAND">LAND</option>
                            </select>
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Price</h5>
                            <input type = "text" class = "form-control" id = "priceShipping" name = "price" oninput = "commas('priceShipping')">
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Rate</h5>
                            <input type = "text" class = "form-control" id = "rateShipping" name = "rate" oninput = "commas('rateShipping')">
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Currency</h5>
                            <select class = "form-control" name = "currency">
                                <option value = "USD">USD</option>
                                <option value = "EUR">EUR</option>
                                <option value = "IDR">IDR</option>
                            </select>
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Notes</h5>
                            <textarea class = "form-control" name = "notes"></textarea>
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Attachment</h5>
                            <input type = "file" name = "attachment">
                        </div>
                        <div class = "form-group">
                            <button type = "submit" class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class = "modal fade" id = "viewShipping">
        <div class = "modal-dialog modal-lg">
            <div class = "modal-content">
                <div class = "modal-header">
                    <h4 class = "modal-title">VIEW SHIPPING PRICE</h4>
                </div>
                <div class = "modal-body">
                    <div class = "form-group">
                        <select class = "form-control listSupplier" id = "idhargaSupplierShipper" onchange = "getShipperList()">

                        </select>
                    </div>
                    <table class = "table table-bordered table stripped" style = "width:100%" data-plugin = "dataTable">
                        <thead>
                            <th>Shipper</th>
                            <th>Shipper PIC</th>
                            <th>Price</th>
                            <th>Currency</th>
                            <th>Rate</th>
                            <th>Method</th>
                            <th>Notes</th>
                            <th>Attachment</th>
                        </thead>
                        <tbody id = "assignedShipperList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class = "modal fade" id = "addCourier">
        <div class = "modal-dialog modal-xl">
            <div class = "modal-content">
                <div class = "modal-header">
                    <h4 class = "modal-title">ADD COURIER PRICE</h4>
                </div>
                <form action = "<?php echo base_url();?>crm/vendor/insertHargaCourier" method = "POST" enctype = "multipart/form-data">
                    <div class = "modal-body">
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Courier Name</h5>
                            <input type = "text" class = "form-control" name = "nama_perusahaan">
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Courier PIC</h5>
                            <input type = "text" class = "form-control" name = "nama_cp">
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Price</h5>
                            <input type = "text" class = "form-control" id = "priceCourier" name = "price" oninput = "commas('priceCourier')">
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Rate</h5>
                            <input type = "text" class = "form-control" id = "rateCourier" name = "rate" oninput = "commas('rateCourier')">
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Shipping Method</h5>
                            <select class = "form-control" name = "metode_pengiriman">
                                <option value = "SEA">SEA</option>
                                <option value = "AIR">AIR</option>
                                <option value = "LAND">LAND</option>
                            </select>
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Currency</h5>
                            <select class = "form-control" name = "currency">
                                <option value = "USD">USD</option>
                                <option value = "EUR">EUR</option>
                                <option value = "IDR">IDR</option>
                            </select>
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Notes</h5>
                            <textarea class = "form-control" name = "notes"></textarea>
                        </div>
                        <div class = "form-group">
                            <h5 style = "opacity:0.5">Attachment</h5>
                            <input type = "file" name = "attachment">
                        </div>
                        <div class = "form-group">
                            <button type = "submit" class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class = "modal fade" id = "viewCourier">
        <div class = "modal-dialog modal-lg">
            <div class = "modal-content">
                <div class = "modal-header">
                    <h4 class = "modal-title">VIEW COURIER PRICE</h4>
                </div>
                <div class = "modal-body">
                    <table class = "table table-bordered table stripped" style = "width:100%" data-plugin = "dataTable">
                        <thead>
                            <th>Courier</th>
                            <th>Courier PIC</th>
                            <th>Price</th>
                            <th>Currency</th>
                            <th>Rate</th>
                            <th>Method</th>
                            <th>Notes</th>
                            <th>Attachment</th>
                        </thead>
                        <tbody id = "assignedCourierList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <table data-plugin = "dataTable" class="table table-bordered table-hover table-striped w-full" cellspacing="0">
        <thead>
            <tr>
                <th style = "width:15%">Supplier Name</th>
                <th style = "width:10%">Supplier PIC</th>
                <th style = "width:10%">Price</th>
                <th style = "width:10%">Rate</th>
                <th style = "width:10%">Currency</th>
                <th style = "width:15%">Notes</th>
                <th style = "width:15%">Attachment</th>
            </tr>
        </thead>
        <tbody id = "t1">
            
        </tbody>
    </table>
    <a href = "<?php echo base_url();?>crm/vendor" class = "btn btn-primary btn-outline">BACK</a>
</div>
