<div class="panel-body col-lg-12">
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>Customer PO No</th> <!-- nanti ini keisi waktu nambahin OC-->
                <th>Order Confirmation No</th>
                <th>Item Name</th>
                <th>Amount</th>
                <th>Selling Price</th>
                <th>Harga Supplier</th>
                <th>Courier Price</th>
                <th>Shipping Price</th>
                <th>Margin</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($oc_item); $a++):?>
            <tr>
                <td><?php echo $oc["no_po_customer"];?></td>
                <td><?php echo $oc["no_oc"];?></td>
                <td><?php echo $oc_item[$a]["nama_item"];?></td>
                <td><?php echo $oc_item[$a]["jumlah_pesan"];?></td>
                <td><?php echo number_format($oc_item[$a]["harga_jual"]);?></td>
                <td><?php echo number_format($oc_item[$a]["harga_supplier"]);?></td>
                <td><?php echo number_format($oc_item[$a]["harga_courier"]);?></td>
                <td><?php echo number_format($oc_item[$a]["harga_shipping"]);?></td>
                <td><?php echo $oc_item[$a]["margin"];?>%</td>
                <td>
                    <button class = "btn btn-primary btn-outline btn-sm" data-toggle = "modal" data-target = "#detailSupplier<?php echo $a;?>">SUPPLIER PRICE</button>
                    <div class = "modal fade" id = "detailSupplier<?php echo $a;?>">
                        <div class = "modal-dialog modal-xl">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <h4 class = "modal-title">SUPPLIER PRICE</h4>
                                </div>
                                <form action = "<?php echo base_url();?>finance/margin/insertSupplier/<?php echo $oc_item[$a]["id_quotation_item"];?>" method = "POST">
                                    <div class = "modal-body">
                                        <input type = "hidden" name = "id_oc" value = "<?php echo $id_oc;?>" readonly>
                                        <div class = "form-group">
                                            <h5>Existing Amount</h5>
                                            <input type = "text" class = "form-control" name ="current_supplier" value = "<?php echo $oc_item[$a]["harga_supplier"];?>">
                                        </div>
                                        <div class = "form-group">
                                            <h5>New Amount</h5>
                                            <input type = "text" value = "0" class = "form-control" name = "harga_supplier">
                                        </div>
                                        <div class = "form-group">
                                            <h5>Notes</h5>
                                            <textarea class = "form-control" name = "notes_supplier"><?php echo $oc_item[$a]["notes_supplier"];?></textarea>
                                        </div>
                                        <div class = "form-group">
                                            <button stype = "submit" class = "btn btn-sm btn-outline btn-primary">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button class = "btn btn-primary btn-outline btn-sm" data-toggle = "modal" data-target = "#detailShipper<?php echo $a;?>">SHIPPER PRICE</button>
                    <div class = "modal fade" id = "detailShipper<?php echo $a;?>">
                        <div class = "modal-dialog modal-xl">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <h4 class = "modal-title">SHIPPER PRICE</h4>
                                </div>
                                <form action = "<?php echo base_url();?>finance/margin/insertShipper/<?php echo $oc_item[$a]["id_quotation_item"];?>" method = "POST">
                                    <input type = "hidden" name = "id_oc" value = "<?php echo $id_oc;?>" readonly>
                                    <div class = "modal-body">
                                        <div class = "form-group">
                                            <h5>Existing Amount</h5>
                                            <input type = "text" class = "form-control" name = "current_shipping" value = "<?php echo $oc_item[$a]["harga_shipping"];?>">
                                        </div>
                                        <div class = "form-group">
                                            <h5>New Amount</h5>
                                            <input type = "text" value = "0" class = "form-control" name = "harga_shipping">
                                        </div>
                                        <div class = "form-group">
                                            <h5>Notes</h5>
                                            <textarea class = "form-control" name = "notes_shipper"><?php echo $oc_item[$a]["notes_shipper"];?></textarea>
                                        </div>
                                        <div class = "form-group">
                                            <button stype = "submit" class = "btn btn-sm btn-outline btn-primary">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button class = "btn btn-primary btn-outline btn-sm" data-toggle = "modal" data-target = "#detailCourier<?php echo $a;?>">COURIER PRICE</button>
                    <div class = "modal fade" id = "detailCourier<?php echo $a;?>">
                        <div class = "modal-dialog modal-xl">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <h4 class = "modal-title">COURIER PRICE</h4>
                                </div>
                                <form action = "<?php echo base_url();?>finance/margin/insertCourier/<?php echo $oc_item[$a]["id_quotation_item"];?>" method = "POST">
                                    <input type = "hidden" name = "id_oc" value = "<?php echo $id_oc;?>" readonly>
                                    <div class = "modal-body">
                                        <div class = "form-group">
                                            <h5>Existing Amount</h5>
                                            <input type = "text" class = "form-control" name = "current_courier" value = "<?php echo $oc_item[$a]["harga_courier"];?>">
                                        </div>
                                        <div class = "form-group">
                                            <h5>New Amount</h5>
                                            <input type = "text" value = "0" class = "form-control" name = "harga_courier">
                                        </div>
                                        <div class = "form-group">
                                            <h5>Notes</h5>
                                            <textarea class = "form-control" name = "notes_courier"><?php echo $oc_item[$a]["notes_courier"];?></textarea>
                                        </div>
                                        <div class = "form-group">
                                            <button stype = "submit" class = "btn btn-sm btn-outline btn-primary">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>