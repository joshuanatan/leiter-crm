<script>
function loadPoDetail(){
    var id_submit_oc = $("#id_submit_oc").val();
    $.ajax({
        url:"<?php echo base_url();?>interface/oc/getOcItem",
        type:"POST",
        dataType:"JSON",
        data:{id_submit_oc:id_submit_oc},
        success:function(respond){
            var html = "";
            for(var a =0; a<respond.length; a++){
                html += "<tr><td>"+respond[a]["nama_oc_item"]+"<input type = 'hidden' id = 'id_oc_item"+a+"' name = 'id_oc_item[]' value = '"+respond[a]["id_oc_item"]+"'></td><td>"+respond[a]["final_amount"]+" "+respond[a]["satuan_produk"]+"</td><td id = 'jumlah_terkirim"+a+"'></td><td><input type ='text' class = 'form-control' name = 'jumlah_kirim[]' value = '0'></td></tr>";
            }
            $("#t1").html(html);
        }
    });
}
</script>
<script>
function loadDeliveryMethod(){
    var id_perusahaan = $("#idcourier").val();
    $.ajax({
        url:"<?php echo base_url();?>master/vendor/shipping/getShippingMethod",
        data:{id_perusahaan:id_perusahaan,result:"array"},
        dataType:"JSON",
        type:"POST",
        success:function(respond){
            var html = "<option>Choose Shipping Method</option>";
            for(var a = 0; a<respond.length; a++){
                html += "<option value = '"+respond[a]["method"]+"'>"+respond[a]["method"]+"</option>";
            }
            $("#method").html(html);
        }
    });
}
</script>