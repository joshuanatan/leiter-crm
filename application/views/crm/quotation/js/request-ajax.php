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
        alert(id_perusahaan);
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
    alert("hei");
    var shipper = $("#hargashipping").val();
    var produk = $("#hargaProduk").val();
    var splitShipper = shipper.split(".");
    var splitProduk = produk.split(".");
    for(var a= 0; a<splitShipper.length; a++){
        shipper += splitShipper[a];
    }
    for(var a= 0; a<splitProduk.length; a++){
        produk += splitProduk[a];
    }
    var input = $("#inputNominal").val();
    var margin = input-parseInt(shipper)-parseInt(produk);
    $("#totalMargin").val(margin);
}
</script>