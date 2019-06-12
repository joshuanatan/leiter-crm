<script>
function loadVendorPrice(){
    $(document).ready(function(){
        var id_request_item = $("#items").val();
        $.ajax({
            data:{id_request_item:id_request_item},
            dataType: "JSON",
            type: "POST",
            url: "<?php echo base_url();?>crm/vendor/getvendorprice",
            success:function(respond){
                $("#t1").html(respond);
            }
        });
    });
}
</script>
<script>
function loadItemData(){
    loadVendorPrice();
    var id_request_item = $("#items").val();
    $.ajax({
        data:{id_request_item:id_request_item},
        dataType: "JSON",
        type: "POST",
        url: "<?php echo base_url();?>crm/vendor/getitemdimension",
        success:function(respond){
            $("#dimension").val(respond);
        }
    });
}
</script>
<script>
function countKurs(a){
    var price = $("#biaya"+a).val();
    var kurs = $("#kurs"+a).val();
    $("#total"+a).val(addCommas(splitter(price,",")*splitter(kurs,",")));
}
</script>
<script>
function submitData(counterId){
    $(document).ready(function(){
        var idcp = $("#cp"+counterId).val();
        var id_request_item = $("#id_request_item"+counterId).val();
        var price = $("#price"+counterId).val();
        var uom = $("#satuan_harga_produk"+counterId).val();
        var rate = $("#vendor_price_rate"+counterId).val();
        var id_perusahaan = $("#idperusahaan"+counterId).val();
        var mata_uang = $("#matauang"+counterId).val();
        $.ajax({
            url:"<?php echo base_url()?>crm/vendor/insertvendorprice/",
            data:{idcp:idcp,id_request_item:id_request_item,price:price,uom:uom,rate:rate,id_perusahaan:id_perusahaan,mata_uang:mata_uang},
            type: "POST",
            success:function(respond){

                alert("Data Recorded Successfully");
            }
        });
    });
}
</script>
<script>
function loadShippingMethod(){
    var id_perusahaan = $("#shipper").val();
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getshippingmethod",
            data:{id_perusahaan:id_perusahaan},
            type: "POST",
            dataType: "JSON",
            success:function(respond){
                $("#metodePengiriman").html(respond);
            }
        });
    });
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getContactPerson",
            data:{id_perusahaan:id_perusahaan},
            type: "POST",
            dataType: "JSON",
            success:function(respond){
                $("#cp").html(respond);
            }
        });
    });
}
</script>
<script>
function loadShippingPrice(){
    var id_perusahaan = $("#shipper").val();
    var metode_pengiriman = $("#metodePengiriman").val();
    var id_request_item = $("#items").val();
    var purpose = $("#purpose").val();
    console.log("1. "+id_perusahaan);
    console.log("2. "+metode_pengiriman);
    console.log("3. "+id_request_item);
    console.log("4. "+purpose);
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getShippingPrice",
            type: "POST",
            dataType: "JSON",
            data:{id_perusahaan:id_perusahaan,metode_pengiriman:metode_pengiriman,id_request_item:id_request_item,purpose:purpose},
            success:function(respond){
                $("#shippingVariablePrice").html(respond);
            }
        });
    });
}
</script>
<script>
function loadCourierPrice(){
    var id_perusahaan = $("#shipper").val();
    var metode_pengiriman = $("#metodePengiriman").val();
    var id_request_item = $("#items").val();
    var purpose = $("#purpose").val();
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getCourierPrice",
            type: "POST",
            dataType: "JSON",
            data:{id_perusahaan:id_perusahaan,metode_pengiriman:metode_pengiriman,id_request_item:id_request_item,purpose:purpose},
            success:function(respond){
                $("#shippingVariablePrice").html(respond);
            }
        });
    });
}
</script>