<script>
function loadOcDetail(){
    var id_oc = $("#idoc").val();
    $.ajax({
        url:"<?php echo base_url();?>crm/oc/getOcDetail",
        data:{id_oc:id_oc, result:"array"},
        type:"POST",
        dataType:"JSON",
        success:function(respond){
            $("#nopo").val(respond["no_po"]);
            $("#namaperusahaan").val(respond["nama_perusahaan"]);
            $("#namacustomer").val(respond["nama_customer"]);
            $("#franco").val(respond["franco"]);
        }
    });
    $.ajax({
        url:"<?php echo base_url();?>crm/oc/getOcItem",
        type:"POST",
        dataType:"JSON",
        data:{id_oc:id_oc, result:"array"},
        success:function(respond){
            var html = "";
            for(var a =0; a<respond.length; a++){
                html += "<tr><td>"+respond[a]["nama_produk"]+"<input type = 'hidden' name = 'id_quotation_item[]' value = '"+respond[a]["id_quotation_item"]+"'></td><td>"+respond[a]["jumlah_pesan"]+"</td><td>"+respond[a]["terkirim"]+"</td><td><input type ='text' class = 'form-control' name = 'jumlah_kirim[]'></td><td>"+respond[a]["uom"]+"</td></tr>"
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