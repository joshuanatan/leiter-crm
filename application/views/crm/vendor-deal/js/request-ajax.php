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