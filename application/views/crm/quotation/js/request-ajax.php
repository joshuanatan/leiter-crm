<script>
function detailPriceRequest(){
    
    var id_request = $("#id_request").val();
    $(document).ready(function(){
        $.ajax({
            data:{id_request:id_request},
            url:"<?php echo base_url();?>crm/request/getRequestDetail",
            type: "POST",
            dataType: "JSON",
            success:function(respond){
                $(".perusahaanCust").val(respond[0]);
                $(".namaCust").val(respond[1]);
                $("#idCust").val(respond[2]);
                $("#alamatCust").val(respond[3]);
                $("#franco").val(respond[4]);
                for(var a = 0; a<respond[respond.length-1].length; a++){
                    $("#itemsOrdered").append("<option value = '"+respond[respond.length-2][a]+"'>"+respond[respond.length-1][a]+"</option>");
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
        $("#primaryData").attr("disabled","true");
        var id_request_item = $("#itemsOrdered").val();
        alert(id_request_item);
        //alert(id_request_item);
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getShippers",
            data: {id_request_item:id_request_item},
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                //$("#shippers").html(respond);
            }
        });
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getVendors",
            data: {id_request_item:id_request_item},
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                $("#products").html(respond);
            }
        });
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getCouriers",
            data: {id_request_item:id_request_item},
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                $("#courier").html(respond);
            }
        });
        $.ajax({
            url:"<?php echo base_url();?>crm/request/getAmountOrders",
            data: {id_request_item:id_request_item},
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                $("#itemamount").val(respond);
            }
        });
    });
}
</script>
<script>
function getShippingPrice(){
    
    $(document).ready(function(){
        var id_perusahaan = $("#shippers").val();
        //alert(id_perusahaan);
        var comp = id_perusahaan.split("-");
        $.ajax({
            data:{id_cp:comp[0],metode_pengiriman:comp[1]},
            url: "<?php echo base_url();?>crm/vendor/getShipperPrice",
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                $("#hargashipping").val(respond);
            }
        }); 
    }); 
}
</script>
<script>
function getVendorPrice(){
    $(document).ready(function(){
        var id_perusahaan = $("#products").val();
        var id_request_item = $("#itemsOrdered").val();
        alert(id_perusahaan);
        alert(id_request_item);
        //alert(id_perusahaan);
        $.ajax({
            data:{id_perusahaan:id_perusahaan},
            url: "<?php echo base_url();?>crm/vendor/getVendorPrices",
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                $("#hargaProduk").val(respond);
                /*harus ngisi shipper*/
                $.ajax({
                    data:{id_perusahaan:id_perusahaan,id_request_item:id_request_item},
                    url: "<?php echo base_url();?>crm/vendor/getShipper",
                    dataType: "JSON",
                    type: "POST",
                    success:function(respond){
                        $("#shippers").html(respond);
                    }
                })
            }
        }); 
    }); 
}
</script>
<script>
function getCourierPrice(){
    $(document).ready(function(){
        var id_perusahaan = $("#courier").val();
        var comp = id_perusahaan.split("-");
        $.ajax({
            data:{id_cp:comp[0],metode_pengiriman:comp[1]},
            url: "<?php echo base_url();?>crm/vendor/getCourierPrices",
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                $("#hargaCourier").val(respond);
            }
        }); 
    }); 
}
</script>
<script>
function getMargin(){
    var shipper = $("#hargashipping").val();
    var produk = $("#hargaProduk").val();
    var courier = $("#hargaCourier").val();
    var total = $("#itemamount").val();
    var input = $("#inputNominal").val();
    var shipperfinal = splitter(shipper,",");
    var produkfinal = splitter(produk,",");
    var courierfinal = splitter(courier,",");
    var inputfinal = splitter(input,",");
    //alert(input);
    //alert(parseInt(shipperfinal)+(parseInt(produkfinal)*parseInt(total))+parseInt(courierfinal));
    var margin = (parseInt(inputfinal)-parseInt(shipperfinal)-(parseInt(produkfinal)*parseInt(total))-parseInt(courierfinal))/parseInt(inputfinal)*100;

    $("#totalMargin").val(margin+"%");
}
</script>
<script>
function quotationItem(){
    $(document).ready(function(){
        var id_quotation = $("#id_quo").val();
        var id_request_item = <?php if($this->session->id_request_item != "") echo $this->session->id_request_item; else echo 1; ?>;
        var item_amount = $("#itemamount").val();
        
        var selling_price_formatted = $("#inputNominal").val();
        var selling_price = parseInt(splitter(selling_price_formatted,","));

        var margin_price = $("#totalMargin").val();
        var splitMargin = margin_price.split("%");
        var margin_price = splitMargin[0];

        var id_cp_shipper = $("#shippers").val();
        var comp = id_cp_shipper.split("-");

        var id_cp_vendor = $("#products").val();

        var id_cp_courier = $("#courier").val();
        var comp2 = id_cp_courier.split("-");
        //alert(margin_price);
        var versi_quo = $("#versi_quo").val();
        //alert(versi_quo);
        $.ajax({
            data:{id_quotation:id_quotation,id_request_item:id_request_item,quo_version:versi_quo,item_amount:item_amount,selling_price:selling_price,margin_price:margin_price,id_cp_shipper:comp[0],id_cp_vendor:id_cp_vendor,id_cp_courier:comp2[0],metode_shipping:comp[1],metode_courier:comp2[1]},
            url:"<?php echo base_url();?>crm/quotation/addItemToQuotation",
            type:"POST",
            success:function(respond){
                //alert("ITEM ADDED TO QUOTATION");
                $.ajax({
                    data:{id_quotation:id_quotation,quo_version:versi_quo},
                    url:"<?php echo base_url();?>crm/quotation/getQuotationItem",
                    dataType:"JSON",
                    type:"POST",
                    success:function(respond){
                        //alert("uueay");
                        $("#t1").html(respond);
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
    var id_quotation = $("#id_quo").val();
    var versi_quo = $("#versi_quo").val();
    alert(id_quotation); alert(versi_quo);
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
</script>
<script>
function decimal(){
    var number = splitter($("#inputNominal").val(),",");
    $("#inputNominal").val(addCommas(parseInt(number)));
}
</script>

