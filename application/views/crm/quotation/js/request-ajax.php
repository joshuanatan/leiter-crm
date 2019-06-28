<script>
function detailPriceRequest(){
    
    var no_request = $("#id_request").val();
    $(document).ready(function(){
        $.ajax({
            data:{no_request:no_request},
            url:"<?php echo base_url();?>interface/request/getRequestDetail",
            type: "POST",
            dataType: "JSON",
            success:function(respond){
                $(".perusahaanCust").val(respond["price_request"]["nama_perusahaan"]);
                $(".namaCust").val(respond["price_request"]["nama_cp"]);
                $("#idCust").val(respond["price_request"]["id_cp"]);
                $("#idPerusahaan").val(respond["price_request"]["id_perusahaan"]);
                $("#alamatCust").val(respond["price_request"]["alamat_perusahaan"]);
                $("#franco").val(respond["price_request"]["franco"]);
                
                for(var a = 0; a<respond["price_request_item"].length; a++){
                    $("#itemsOrdered").append("<option value = '"+respond["price_request_item"][a]["id_request_item"]+"'>"+respond["price_request_item"][a]["nama_produk"]+"</option>detailPriceRequest");
                }
            }

        });
    });
}
var sudah = 0 ;
function detailPriceRequestPageEdit(){
    if(sudah == 0){
    var id_request = $("#id_request").val();
    var id_quo = $("#id_quo").val();
    var versi_quo = $("#versi_quo").val();
    $(document).ready(function(){
        $.ajax({
            data:{id_request:id_request},
            url:"<?php echo base_url();?>crm/request/getRequestDetail",
            type: "POST",
            dataType: "JSON",
            success:function(respond){
                for(var a = 0; a<respond[respond.length-1].length; a++){
                    $("#itemsOrdered").append("<option value = '"+respond[respond.length-2][a]+"'>"+respond[respond.length-1][a]+"</option>");
                }
            }

        });
        $.ajax({
            data:{id_quotation:id_quo,quo_version:versi_quo},
            url:"<?php echo base_url();?>crm/quotation/getQuotationItem",
            dataType:"JSON",
            type:"POST",
            success:function(respond){
                $("#t1").html(respond);
            }
        });
    });
    sudah = 1;
    }
}
</script>
<script>
function loadVendors(){
    $(document).ready(function(){
        $("#itemamount").val("");
        $("#hargaProduk").val("");
        $("#hargashipping").val("");
        $("#hargaCourier").val("");
        $("#totalMargin").val("");
        $("#inputNominal").val("");
        $("#primaryData").attr("disabled","true");
        var id_request_item = $("#itemsOrdered").val();
        $.ajax({
            url:"<?php echo base_url();?>interface/request/getAmountOrders",
            data: {id_request_item:id_request_item},
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                $("#itemamount").val(respond);
            }
        });

        $.ajax({
            url:"<?php echo base_url();?>interface/vendor/getVendors",
            data: {id_request_item:id_request_item},
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                var html = "<option>Choose Supplier</option>";
                for(var a = 0 ; a<respond.length; a++){
                    html += "<option value = '"+respond[a]["id_harga_vendor"]+"'>"+respond[a]["nama_perusahaan"]+"</option>"
                }
                $("#products").html(html);
            }
        });

        $.ajax({
            url:"<?php echo base_url();?>interface/vendor/getCouriers",
            data: {id_request_item:id_request_item},
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                var html = "<option>Choose Courier</option>";
                for(var a = 0 ; a<respond.length; a++){
                    html += "<option value = '"+respond[a]["id_harga_courier"]+"'>"+respond[a]["nama_perusahaan"]+"</option>"
                }
                $("#courier").html(html);
            }
        });
        
    });
}
</script>
<script>
function getShippingPrice(){
    $("#hargashipping").val("");
    $(document).ready(function(){
        var id_harga_shipping = $("#shippers").val();
        $.ajax({
            data:{id_harga_shipping:id_harga_shipping},
            url: "<?php echo base_url();?>interface/vendor/getShipperPrice",
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                $("#hargashipping").val(respond["harga_produk"]*respond["vendor_price_rate"]);
            }
        }); 
    }); 
}
</script>
<script>
function getVendorPrice(){
    $(document).ready(function(){
        $("#hargaProduk").val("");
        $("#hargashipping").val("");
        var id_harga_vendor = $("#products").val();
        $.ajax({
            data:{id_harga_vendor:id_harga_vendor},
            url: "<?php echo base_url();?>interface/vendor/getVendorPrices",
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                $("#hargaProduk").val(respond["harga_produk"]*respond["vendor_price_rate"]);
                /*harus ngisi shipper*/
                var id_request_item = $("#itemsOrdered").val();
                $.ajax({
                    data:{id_harga_vendor:id_harga_vendor},
                    url: "<?php echo base_url();?>interface/vendor/getShipper",
                    dataType: "JSON",
                    type: "POST",
                    success:function(responde){
                        var html = "<option>Choose Shipper</option>";
                        for(var a = 0; a<responde.length; a++){
                            html += "<option value = '"+responde[a]["id_harga_shipping"]+"'>"+responde[a]["nama_perusahaan"]+" - "+responde[a]["metode_pengiriman"]+"</option>";
                        }
                        $("#shippers").html(html);
                    }
                });
            }
        }); 
    }); 
}
</script>
<script>
function getCourierPrice(){
    $("#hargaCourier").val("");
    $(document).ready(function(){
        var id_harga_courier = $("#courier").val();
        $.ajax({
            data:{id_harga_courier:id_harga_courier},
            url: "<?php echo base_url();?>interface/vendor/getCourierPrices",
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                $("#hargaCourier").val(respond["harga_produk"]*respond["vendor_price_rate"]);
            }
        }); 
    }); 
}
</script>
<script>
function getMargin(){
    var total = $("#totalPrice").val();
    var input = $("#inputNominal").val();
    var totalfinal = splitter(total,",");
    var inputfinal = splitter(input,",");
    //alert(input);
    //alert(parseInt(shipperfinal)+(parseInt(produkfinal)*parseInt(total))+parseInt(courierfinal));
    var margin = (parseInt(inputfinal) - parseInt(totalfinal))/parseInt(inputfinal)*100;

    $("#totalMargin").val(margin+"%");
}
</script>
<script>
function getTotal(){
    var shipper = $("#hargashipping").val();
    var produk = $("#hargaProduk").val();
    var courier = $("#hargaCourier").val();
    var total = $("#itemamount").val();
    var input = $("#inputNominal").val();
    var shipperfinal = splitter(shipper,",");
    var produkfinal = splitter(produk,",");
    var courierfinal = splitter(courier,",");
    var inputfinal = splitter(input,",");
    $("#totalPrice").val(addCommas(parseInt(shipperfinal)+parseInt(produkfinal)+parseInt(courierfinal)));
}
</script>
<script>
function quotationItem(){
    $(document).ready(function(){

        var selling_price_formatted = $("#inputNominal").val();
        var margin_price = $("#totalMargin").val();
        var splitMargin = margin_price.split("%");

        var no_quotation = $("#no_quo").val();
        var id_request_item = $("#itemsOrdered").val();
        var versi_quo = $("#versi_quo").val();
        var item_amount = $("#itemamount").val();
        var selling_price = parseInt(splitter(selling_price_formatted,","));
        var margin_price = splitMargin[0];
        var id_harga_shipping = $("#shippers").val();
        var id_harga_vendor = $("#products").val();
        var id_harga_courier = $("#courier").val();
        
        $.ajax({
            data:{no_quotation:no_quotation,id_request_item:id_request_item,versi_quo:versi_quo,item_amount:item_amount,selling_price:selling_price,margin_price:margin_price,id_harga_shipping:id_harga_shipping,id_harga_vendor:id_harga_vendor,id_harga_courier:id_harga_courier},
            url:"<?php echo base_url();?>interface/quotation/addItemToQuotation",
            type:"POST",
            success:function(respond){
                //alert("ITEM ADDED TO QUOTATION");
                $.ajax({
                    data:{no_quotation:no_quotation,quo_version:versi_quo},
                    url:"<?php echo base_url();?>interface/quotation/getQuotationItem",
                    dataType:"JSON",
                    type:"POST",
                    success:function(respond){
                        
                        var html = "";
                        for(var a = 0; a<respond.length; a++){
                            html = "<tr><td>"+respond[a]["id_request_item"]+"</td><td>"+respond[a]["nama_produk"]+"</td><td>"+respond[a]["item_amount"]+"</td><td>"+respond[a]["selling_price"]+"</td><td>"+respond[a]["margin_price"]+"%</td><td><button type = 'button' class = 'btn btn-danger btn-outline btn-sm' onclick = 'removeQuotationItem("+respond[a]["id_quotation_item"]+")'>REMOVE</button></td></tr>";
                        }
                        $("#t1").html(html);
                    }
                });
            }
        });
    });
}
</script>
<script>
function removeQuotationItem(i){
    $(document).ready(function(){
        var id_quotation_item = i;
        var id_quotation = $("#id_quo").val();
        var versi_quo = $("#versi_quo").val();
        $.ajax({
            url:"<?php echo base_url();?>crm/quotation/removeQuotationitem",
            type:"POST",
            data:{id_quotation_item:id_quotation_item},
            success:function(respond){
                $.ajax({
                    data:{id_quotation:id_quotation,quo_version:versi_quo},
                    url:"<?php echo base_url();?>crm/quotation/getQuotationItem",
                    dataType:"JSON",
                    type:"POST",
                    success:function(respond){
                        $("#t1").html(respond);
                    }
                });
            }
        });
    });
}
</script>
<script>
function showItem(){
    var no_quotation = $("#no_quo").val();
    var versi_quo = $("#versi_quo").val();
    //alert(id_quotation); alert(versi_quo);
    $.ajax({
        data:{no_quotation:no_quotation,quo_version:versi_quo},
        url:"<?php echo base_url();?>interface/quotation/getQuotationItem",
        dataType:"JSON",
        type:"POST",
        success:function(respond){
            var html = "";
            for(var a = 0; a<respond.length; a++){
                html = "<tr><td>"+respond[a]["id_request_item"]+"</td><td>"+respond[a]["nama_produk"]+"</td><td>"+respond[a]["item_amount"]+"</td><td>"+respond[a]["selling_price"]+"</td><td>"+respond[a]["margin_price"]+"%</td><td><button type = 'button' class = 'btn btn-danger btn-outline btn-sm' onclick = 'removeQuotationItem("+respond[a]["id_quotation_item"]+")'>REMOVE</button></td></tr>";
            }
        }
    });
}
</script>
<script>
function decimal(){
    var number = splitter($("#inputNominal").val(),",");
    $("#inputNominal").val(addCommas(parseInt(number)));
}
</script>

