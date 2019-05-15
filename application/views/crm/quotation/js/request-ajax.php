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
                $("#perusahaanCust").val(respond[0]);
                $("#namaCust").val(respond[1]);
                for(var a = 0; a<respond[respond.length-1].length; a++){
                    $("#itemsOrdered").append("<option value = '"+respond[respond.length-2][a]+"'>"+respond[respond.length-1][a]+"</option>");
                }
            }

        });
    });
}
</script>
<script>
function loadVendors(){
    $(document).ready(function(){
        var id_request_item = $("#itemsOrdered").val();
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getShippers",
            data: {id_request_item:id_request_item},
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                $("#shippers").html(respond);
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
        $.ajax({
            data:{id_perusahaan:id_perusahaan},
            url: "<?php echo base_url();?>crm/vendor/getVendorPrices",
            dataType: "JSON",
            type: "POST",
            success:function(respond){
                $("#hargaProduk").val(respond);
            }
        }); 
    }); 
}
</script>
<script>
function getMargin(){
    var shipper = $("#hargashipping").val();
    var shipperfinal = "";
    var produkfinal = "";
    var produk = $("#hargaProduk").val();
    var total = $("#itemamount").val();
    var splitShipper = shipper.split(",");
    var splitProduk = produk.split(",");
    for(var a= 0; a<splitShipper.length; a++){
        shipperfinal += splitShipper[a];
        
    }
    for(var a= 0; a<splitProduk.length; a++){
        produkfinal += splitProduk[a];
    }
    var input = $("#inputNominal").val();
    var margin = input-parseInt(shipperfinal)-(parseInt(produkfinal)*parseInt(total));

    $("#totalMargin").val(margin);
}
</script>
<script>
function quotationItem(){
    $(document).ready(function(){
        var id_quotation = $("#id_quo").val();
        var id_request_item = <?php echo $this->session->id_request_item; ?>;
        var item_amount = $("#itemamount").val();
        var selling_price = $("#inputNominal").val();
        var margin_price = $("#totalMargin").val();
        $.ajax({
            data:{id_quotation:id_quotation,id_request_item:id_request_item,item_amount:item_amount,selling_price:selling_price,margin_price:margin_price},
            url:"<?php echo base_url();?>crm/quotation/addItemToQuotation",
            type:"POST",
            success:function(respond){
                alert("ITEM ADDED TO QUOTATION");
                $.ajax({
                    data:{id_quotation:id_quotation},
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