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
                $("#t1").append(respond);
            }
        });
    });
}
</script>
<script>
function submitData(){
    $(document).ready(function(){
        var idcp = $("#cp").val();
        var id_request_item = $("#id_request_item").val();
        var price = $("#price").val();
        var uom = $("#satuan").val();
        var min = $("#minimum").val();
        $.ajax({
            url:"<?php echo base_url()?>crm/vendor/insertvendorprice/",
            data:{idcp:idcp,id_request_item:id_request_item,price:price,uom:uom,min:min},
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
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getShippingPrice",
            type: "POST",
            dataType: "JSON",
            data:{id_perusahaan:id_perusahaan,metode_pengiriman:metode_pengiriman,id_request_item:id_request_item},
            success:function(respond){
                $("#shippingVariablePrice").html(respond);
            }
        });
    });
}
</script>