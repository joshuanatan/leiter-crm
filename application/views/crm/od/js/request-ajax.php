<script>
function loadPoDetail(){
    var no_oc = $("#idpo").val();
    /*
    $.ajax({
        url:"<?php echo base_url();?>interface/oc/loadPoDetail",
        data:{id_oc:id_oc},
        type:"POST",
        dataType:"JSON",
        success:function(respond){
            $("#nopo").val(respond["no_po"]);
            $("#namaperusahaan").val(respond["nama_perusahaan"]);
            $("#namacustomer").val(respond["nama_customer"]);
            $("#franco").val(respond["franco"]);
        }
    });
    */
    $.ajax({
        url:"<?php echo base_url();?>interface/oc/getOcItem",
        type:"POST",
        dataType:"JSON",
        data:{no_oc:no_oc},
        success:function(respond){
            var html = "";
            for(var a =0; a<respond["item_oc"].length; a++){
                html += "<tr><td>"+respond["item_oc"][a]["nama_produk"]+"<input type = 'hidden' name = 'id_quotation_item[]' value = '"+respond["item_oc"][a]["id_quotation_item"]+"'></td><td>"+respond["item_oc"][a]["item_amount"]+"</td><td>"+respond["item_oc"][a]["terkirim"]+"</td><td><input type ='text' class = 'form-control' name = 'jumlah_kirim[]'></td></tr>"
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