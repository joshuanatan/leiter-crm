<script>
function quotationDetail(){
    $(document).ready(function(){
        var id_quotation = $("#id_quotation").val();
        var split = id_quotation.split("-");
        //alert(id_quotation);alert(split[0]);alert(split[1]);
        $.ajax({
            url:"<?php echo base_url();?>crm/quotation/getQuotationDetail",
            data:{id_quo:split[0],versi_quo:split[1]},
            dataType:"JSON",
            type:"POST",
            success:function(respond){
                //alert(respond["no_quo"]);
                /*ngisi detail disini*/
                $("#no_quo").val(respond["no_quo"]);
                $("#id_quo").val(respond["id_quo"]);
                $("#versi_quo").val(respond["versi_quo"]);
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
            url:"<?php echo base_url();?>crm/quotation/getOrderedItem",
            data:{id_quo:split[0],versi_quo:split[1]},
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
            url:"<?php echo base_url();?>crm/quotation/getMetodePembayaran",
            data:{id_quotation:split[0],id_versi:split[1]},
            dataType:"JSON",
            type:"POST",
            success:function(respond){    
                
                if(respond.length == 1){ /*bayar lunas entah sebelum / sesudah barang sampai*/
                    $(".containerSisa").css("display","block");
                    $(".containerDp").css("display","none");
                    $("#persenSisa").val(respond[0]["persentase_pembayaran"]);
                    $("#jumlahSisa").val(respond[0]["nominal_pembayaran"]);
                    $("#triggerSisa").val(respond[0]["trigger_pembayaran"]);
                    $("#kurs").val(respond[0]["kurs"]);
                }
                else{ /* kalau yang pake DP */-
                    $(".containerSisa").css("display","block");
                    $(".containerDp").css("display","block");
                    $("#persenSisa").val(respond[1]["persentase_pembayaran"]+"%");
                    $("#jumlahSisa").val(respond[1]["nominal_pembayaran"]);
                    $("#triggerSisa").val(respond[1]["trigger_pembayaran"]);
                    $("#kurs").val(respond[1]["kurs"]);

                    $("#persenDp").val(respond[0]["persentase_pembayaran"]+"%");;
                    $("#jumlahDp").val(respond[0]["nominal_pembayaran"]);
                    $("#triggerDp").val(respond[0]["trigger_pembayaran"]);
                    $("#kurs").val(respond[0]["kurs"]);
                }
            }

        }); 
    });
}
</script>