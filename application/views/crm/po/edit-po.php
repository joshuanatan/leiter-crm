<div class="panel-body col-lg-12">
    <div class="row row-lg">
        <div class="col-xl-12">
            <!-- Example Tabs Left -->
            <div class="example-wrap">
                <div class="nav-tabs-vertical" data-plugin="tabs">
                    <ul class="nav nav-tabs mr-25" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">Primary Data</a></li>

                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#items" aria-controls="pengiriman" role="tab">Supplier & Items</a></li>

                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#shipper" aria-controls="produksi" role="tab">Shipper</a></li>
                        

                    </ul>
                    <form action = "<?php echo base_url();?>crm/po/editPo" method = "post">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                               <div class = "form-group">
                                    <h5 style = "opacity:0.5">No PO Customer</h5>
                                    <input type = "text" class = "form-control" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "opacity:0.5">No PO</h5>
                                    <input type = "text" class = "form-control" id = "no_po" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Perusahaan Customer</h5>
                                    <input type ="text" id = "nama_perusahaan" class = "form-control perusahaanCust" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Nama Customer</h5>
                                    <input name = "" id = "namaCust" type ="text" class = "form-control namaCust" readonly>
                                    <input name = "id_cp" id ="idCust" value = "" type ="hidden" class = "form-control"  readonly>
                                </div>
                            </div>
                            <!-- fungsi -->
                            <div class="tab-pane" id="items" role="tabpanel">
                                <div class = "row">
                                    <div class = "form-group col-lg-4">
                                        <h5 style = "opacity:0.5">Supplier</h5>
                                        <input type = "text" readonly class = "form-control">
                                    </div>
                                    <div class = "form-group col-lg-4">
                                        <h5 style = "opacity:0.5">PIC Supplier</h5>
                                        <input type = "text" readonly class = "form-control">
                                    </div>
                                    <div class = "form-group col-lg-2">
                                        <h5 style = "opacity:0.5">Phone</h5>
                                        <input type = "text" readonly class = "form-control">
                                    </div>
                                    <div class = "form-group col-lg-2">
                                        <h5 style = "opacity:0.5">Fax</h5>
                                        <input type = "text" readonly class = "form-control">
                                    </div>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "opacity:0.5">Address</h5>
                                    <textarea readonly class = "form-control"></textarea>
                                </div>
                                <div class = "form-group">
                                    <table class = "table table-bordered table-stripped" style = "Width:100%" data-plugin = "dataTable">
                                        <thead>
                                            <th>#</th>
                                            <th style = "width:18%">Nama Produk Leiter</th>
                                            <th style = "width:18%">Nama Produk Vendor</th>
                                            <th style = "width:18%">Quantity</th>
                                            <th style = "width:18%">Selling Price</th>
                                            <th style = "width:18%">Vendor Price</th>
                                        </thead>
                                        <tbody>
                                            <?php for($a = 0; $a<15; $a++):?>
                                            <tr>
                                                <td>
                                                    <div class = "checkbox-custom checkbox-primary">
                                                        <input type = "checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><textarea readonly rows = "4" id = "nama_produk_leiter<?php echo $a;?>" class = "form-control" name = ""></textarea></td>
                                                <td><textarea rows = "4" id = "nama_produk_vendor<?php echo $a;?>" class = "form-control" name = "" ></textarea></td>
                                                <td><input type = "text" id = "jumlah_produk<?php echo $a;?>" class = "form-control" name = ""></td>
                                                <td><input type = "text" readonly id = "harga_jual_satuan_produk<?php echo $a;?>" class = "form-control" name = ""></td>
                                                <td><input type = "text" oninput = "commas('harga_satuan_produk<?php echo $a;?>')" id = "harga_satuan_produk<?php echo $a;?>" class = "form-control" name = ""></td>
                                            </tr>
                                            <?php endfor;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="shipper" role="tabpanel">
                                
                                <div class = "row">
                                    <div class = "form-group col-lg-4">
                                        <h5 style = "opacity:0.5">Shipper</h5>
                                        <select class = "form-control" name = "id_shipper" data-plugin = "select2">
                                            <?php for($sup = 0; $sup<count($shipper);$sup++):?>
                                            <option value = "<?php echo $shipper[$sup]["id_perusahaan"];?>"><?php echo $shipper[$sup]["nama_perusahaan"];?></option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class = "form-group col-lg-4">
                                        <h5 style = "opacity:0.5">PIC Supplier</h5>
                                        <input type = "text" readonly class = "form-control">
                                    </div>
                                    <div class = "form-group col-lg-2">
                                        <h5 style = "opacity:0.5">Phone</h5>
                                        <input type = "text" readonly class = "form-control">
                                    </div>
                                    <div class = "form-group col-lg-2">
                                        <h5 style = "opacity:0.5">Fax</h5>
                                        <input type = "text" readonly class = "form-control">
                                    </div>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "opacity:0.5">Address</h5>
                                    <textarea readonly class = "form-control"></textarea>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "opacity:0.5">Shipping Method</h5>
                                    <select class = "form-control" name = "metode_pengiriman" data-plugin = "select2">
                                        <option value = "SEA">SEA</option>
                                        <option value = "AIR">AIR</option>
                                        <option value = "LAND">LAND</option>
                                    </select>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "opacity:0.5">Shipping Term</h5>
                                    <input type = "text" class = "form-control">
                                </div>
                                <div class = "row">
                                    <div class = "form-group col-lg-4">
                                        <h5 style = "opacity:0.5">Requirement Date</h5>
                                        <input type = "date" class = "form-control">
                                    </div>
                                    <div class = "form-group col-lg-4">
                                        <h5 style = "opacity:0.5">Destination</h5>
                                        <input type = "text" class = "form-control">
                                    </div>
                                </div>
                                <button class = "btn btn-primary btn-outline btn-sm">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Example Tabs Left -->
        </div>
    </div>
</div>
