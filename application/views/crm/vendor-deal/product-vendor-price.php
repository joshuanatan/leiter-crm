<div class="panel-body col-lg-12">
    <div class = "form-group">
        <div class = "col-lg-6" style = "margin-left:0px; padding-left:0px">
            <select class = "form-control col-lg-6" id = "items" onchange = "getDetailPriceRequestItem()" data-plugin="select2">
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
    <table data-plugin = "dataTable" class="table table-bordered table-hover table-striped w-full" cellspacing="0">
        <thead>
            <tr>
                <th style = "width:15%">Supplier Name</th>
                <th style = "width:10%">Supplier PIC</th>
                <th style = "width:10%">Email PIC</th>
                <th style = "width:10%">Phone Number PIC</th>
                <th style = "width:10%">Price</th>
                <th style = "width:10%">Rate</th>
                <th style = "width:10%">Currency</th>
                <th style = "width:15%">Notes</th>
                <th style = "width:5%">Actions</th>
                <th style = "width:5%">Shipping</th>
            </tr>
        </thead>
        <tbody id = "t1">
            <?php for($a = 0; $a<15; $a++):?>
            <tr>
                <td>
                    <select id = "supplier<?php echo $a;?>" onchange = "getCp(<?php echo $a;?>)" class = "form-control" data-plugin = "select2">
                        <option value = "0">New Supplier</option>
                        <?php for($b = 0; $b<count($supplier);$b++): ?>
                        <option value = "<?php echo $supplier[$b]["id_perusahaan"];?>"><?php echo $supplier[$b]["nama_perusahaan"];?></option>
                        <?php endfor;?>
                    </select>
                    <button class = "btn btn-primary btn-outline col-lg-12 btn-sm" data-toggle ="modal" data-target="#supplierBaru<?php echo $a;?>">NEW SUPPLIER</button>
                    
                    <div class = "modal fade" id = "supplierBaru<?php echo $a;?>">
                        <div class = "modal-dialog modal-xl">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <h4 class = "modal-title">NEW SUPPLIER</h4>
                                </div>
                                <div class = "modal-body">
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">Supplier Name</h5>
                                        <input type = "text" class = "form-control" id = "supplier_add_name<?php echo $a;?>">
                                    </div>
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">PIC</h5>
                                        <input type = "text" class = "form-control" id = "supplier_add_pic<?php echo $a;?>">
                                    </div>
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">PIC Gender</h5>
                                        <select class = "form-control" id = "supplier_add_jk<?php echo $a;?>">
                                            <option value = "Mr">MR</option>
                                            <option value = "Ms">MS</option>
                                        </select>
                                    </div>
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">Email PIC</h5>
                                        <input type = "text" class = "form-control" id = "supplier_add_email<?php echo $a;?>">
                                    </div>
                                    <div class = "form-group">
                                        <h5 style = "opacity:0.5">Phone Number PIC</h5>
                                        <input type = "text" class = "form-control" id = "supplier_add_phone<?php echo $a;?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <select onchange = "getDetailCp(<?php echo $a;?>)" id = "pic<?php echo $a;?>" class = "form-control">
                    
                    </select>
                </td>
                <td id = "email<?php echo $a;?>"></td>
                <td id = "phone<?php echo $a;?>"></td>
                <td><input oninput = "commas('price<?php echo $a;?>')" id = "price<?php echo $a;?>" type = "text" class = "form-control"></td>
                <td><input oninput = "commas('rate<?php echo $a;?>')" id = "rate<?php echo $a;?>" type = "text" class = "form-control"></td>
                <td>
                    <select id = "kurs<?php echo $a;?>" class = "form-control">
                        <?php for($b = 0; $b<count($mata_uang);$b++): ?>
                            <option value = "<?php echo $mata_uang[$b]["mata_uang"];?>"><?php echo $mata_uang[$b]["mata_uang"];?></option>
                        <?php endfor;?>
                    </select>
                </td>
                <td><textarea id = "notes<?php echo $a;?>" class = "form-control"></textarea></td>
                <td><button class = "btn btn-primary btn-sm btn-outline" onclick = "submitData(<?php echo $a;?>)">SAVE</button></td>
                <td><button class = "btn btn-primary btn-sm btn-outline">SHIPPING</button></td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
    <a href = "<?php echo base_url();?>crm/vendor" class = "btn btn-primary btn-outline">BACK</a>
</div>
