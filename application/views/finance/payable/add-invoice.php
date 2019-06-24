<div class="panel-body col-lg-12">
    <div class="row row-lg">
        <div class="col-xl-12">
            <!-- Example Tabs Left -->
            <div class="example-wrap">
                <div class="nav-tabs-vertical" data-plugin="tabs">
                    <ul class="nav nav-tabs mr-25" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#primaryData" aria-controls="primaryData" role="tab">Primary Data</a></li>
                        
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#detailData" aria-controls="primaryData" role="tab">Detail Data</a></li>
                    </ul>
                    <form action = "<?php echo base_url();?>finance/payable/insertinvoice" method = "post" enctype="multipart/form-data">    
                        <div class="tab-content">
                            <div class="tab-pane active" id="primaryData" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No Invoice</h5>
                                    <input type = "text" class = "form-control" name = "no_invoice" value = "noinvoice001">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Payment For</h5>
                                    <select class = "form-control" name = "peruntukan_tagihan" id ="peruntukan">
                                        <option value = "SUPPLIER">SUPPLIER</option>
                                        <option value = "SHIPPER">SHIPPER</option>
                                        <option value = "COURIER">COURIER</option>
                                    </select>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">No Refrence</h5> <!-- Nanti ajax, kalau pilih supplier/shipper ngeload nomor po vendor, kalau courier, no OD -->
                                    <input type = "text" class = "form-control" id ="no_refrence" oninput = "isExistsInRefrence()" name = "no_refrence" value = "norefrence001">
                                    <h5 class = "color:red" id = "resultMessage"></h5>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Transfer To</h5>
                                    <input type = "text" class = "form-control" name = "rekening" value = "12345678">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Dateline</h5>
                                    <input type = "date" class = "form-control" name = "dateline">
                                </div>
                            </div>
                            <div class="tab-pane" id="detailData" role="tabpanel">
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Subtotal</h5>
                                    <input type = "text" class = "form-control" oninput = "commas('subtotal')" id = "subtotal" name = "subtotal">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Discount</h5>
                                    <input type = "text" class = "form-control" value = "0" oninput = "commas('discount')" name = "discount" id = "discount">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Total After Discount</h5>
                                    <input type = "text" class = "form-control" id = "afterDiscount" onfocus = "countAfterDiscont()" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Tax</h5>
                                    <div class="checkbox-custom checkbox-primary">
                                        <input type="checkbox" id="inputUnchecked" name = "is_ppn[]">
                                        <label for="inputUnchecked">PPN</label>
                                    </div>
                                    <input type = "text" class = "form-control" value = "0" onfocus = "countPpn()" id = "afterPpn" readonly>

                                    <div class="checkbox-custom checkbox-primary">
                                        <input type="checkbox" id="inputUnchecked" name = "is_pph[]">
                                        <label for="inputUnchecked">PPH 23</label>
                                    </div>
                                    <input type = "text" class = "form-control" value = "0" onfocus = "countPph()"  id = "afterPph" readonly>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Total</h5>
                                    <input type = "text" class = "form-control" value = "0" onfocus = "countTotal()" name = "total" id = "total">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Currency (USD,IDR,EUR,etc)</h5>
                                    <input type = "text" class = "form-control" name = "mata_uang">
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Notes</h5>
                                    <textarea class = "form-control" name = "notes_tagihan"></textarea>
                                </div>
                                <div class = "form-group">
                                    <h5 style = "color:darkgrey; opacity:0.8">Attachment</h5>
                                    <input type = "file" class = "form-control" name = "attachment">
                                </div>
                                <div class = "form-group">
                                    <button class = "col-lg-2 btn btn-primary btn-outline">SUBMIT</button>
                                    <a href = "<?php echo base_url();?>finance/payable/index" class = "col-lg-2 btn btn-outline btn-primary">BACK</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Example Tabs Left -->
        </div>
    </div>
</div>
