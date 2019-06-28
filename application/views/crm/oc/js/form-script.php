<script>
function quotationDetail(){
    $(document).ready(function(){
        var no_quotation = $("#no_quotation").val();
        var split = no_quotation.split(",");
        $.ajax({
            url:"<?php echo base_url();?>interface/quotation/getQuotationDetail",
            data:{no_quo:split[0],versi_quo:split[1]},
            dataType:"JSON",
            type:"POST",
            success:function(respond){
                $(".perusahaanCust").val(respond["nama_perusahaan"]);
                $(".namaCust").val(respond["nama_cp"]);
                $("#idCust").val(respond["id_cp"]);
                $("#alamatCust").val(respond["alamat_perusahaan"]);
                $("#up_cp").val(respond["up_cp"]);
                $("#durasi_pengiriman").val(respond["durasi_pengiriman"]+" minggu");
                $("#durasi_pembayaran").val(respond["durasi_pembayaran"]+" minggu");
                $("#franco").val(respond["franco"]);
                $("#metode_courier").val(respond["metode_courier"]);
            }
        });
        $.ajax({
            url:"<?php echo base_url();?>interface/quotation/getOrderedItem",
            data:{no_quo:split[0],versi_quo:split[1]},
            dataType:"JSON",
            type:"POST",
            success:function(respond){
                var html = "";
                for(var a = 0; a<respond.length; a++){
                    html += "<tr><td id = 'check"+a+"'></td><td id = 'product"+a+"'></td><td id = 'amount"+a+"'></td><td id = 'selling"+a+"'></td><td id = 'final"+a+"'></td></tr>";
                }
                //alert(html);
                $("#t1").html(html);
                
                for(var a = 0; a<respond.length; a++){
                    var check = "";
                    if(respond[a]["status_oc_item"] == 0) check = "checked";
                    //alert("hello");
                    $("#check"+a).html('<div class="checkbox-custom checkbox-primary"><input name = "checkbox[]" value = "'+a+'" type="checkbox" id="inputChecked" '+check+' /><label for="inputChecked"></label></div>');

                    $("#product"+a).html('<input type = "text" class = "form-control" value = "'+respond[a]["nama_produk"]+'"><input type = "hidden" name = "id_quotation_item[]" class = "form-control" value = "'+respond[a]["id_quotation_item"]+'">');
                    
                    $("#amount"+a).html('<input type = "text" name = "amount[]" class = "form-control" value = "'+respond[a]["item_amount"]+'">');

                    $("#selling"+a).html('<input type = "text" class = "form-control" value = "'+respond[a]["selling_price"]+'" readonly>');

                    $("#final"+a).html('<input type = "text" name ="finalPrice[]" class = "form-control" value = "'+respond[a]["selling_price"]+'">');
                    
                }
            }
        });
        $.ajax({
            url:"<?php echo base_url();?>interface/quotation/getMetodePembayaran",
            data:{no_quo:split[0],versi_quo:split[1]},
            dataType:"JSON",
            type:"POST",
            success:function(respond){    
                $("#persenDp").val(respond["persentase_pembayaran"]+"%");;
                $("#jumlahDp").val(addCommas(respond["nominal_pembayaran"]));
                $("#triggerDp").val(respond["trigger_pembayaran"]);

                $("#persenSisa").val(respond["persentase_pembayaran2"]+"%");
                $("#jumlahSisa").val(addCommas(respond["nominal_pembayaran2"]));
                $("#triggerSisa").val(respond["trigger_pembayaran2"]);

                $("#kurs").val(respond["kurs"]);
            }

        }); 
    });
}
</script>