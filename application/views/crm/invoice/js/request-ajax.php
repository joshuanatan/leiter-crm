<script>
function oc_detail(){
    var id_oc = $("#idoc").val();
    $.ajax({
        url:"<?php echo base_url();?>crm/oc/getOcDetail",
        data:{id_oc:id_oc, result:"array"},
        dataType:"JSON",
        type:"POST",
        success:function(respond){
            $("#nopo").val(respond["no_po"]);
            $("#namaperusahaan").val(respond["nama_perusahaan"]);
            $("#namaCust").val(respond["nama_customer"]);
            $("#franco").val(respond["franco"]);
            $("#up").val(respond["up_cp"]);
        }
    });
    /*
    $.ajax({
        url:"<?php echo base_url();?>crm/invoice/getMetodePembayaran",
        data:{id_oc:id_oc, result:"array"},
        dataType:"JSON",
        type:"POST",
        success:function(respond){
            var html = "<option>Choose Payment</option>";
            for(var a = 0; a<respond.length; a++){
                html += "<option value = '"+respond[a]["id_metode_pembayaran"]+"'>Payment "+(a+1)+" - "+respond[a]["persentase"]+"%</option>";
            }
            $("#metodepembayaran").html(html);
        } 
    });
    */
}
</script>
<script>
function changePayment(){
    
    var paymentType = $("#paymentType").val();
    console.log(paymentType);
    switch(parseInt(paymentType)){
        case 0: $("#od").html("");
        break;
        case 1: 
            var oc = $("#idoc").val();
            $("#od").html("");
            $("#paymentWithOdT1").html();
            $.ajax({
                url:"<?php echo base_url();?>crm/invoice/getDp",
                data:{id_oc:oc},
                type:"POST",
                dataType:"JSON",
                success:function(respond){
                    var html = "<tr><td>1</td><td>Down Payment "+respond["persentase"]+"%<input type = 'hidden' name = 'persentase_pembayaran' value = '"+respond["persentase"]+"'></td><td>-</td><td>"+respond["total"]+"</td><td>"+respond["nominal"]+"<input type = 'hidden' name = 'nominal_pembayaran' value = '"+respond["clean_nominal"]+"'></td></tr>";
                    
                    $("#paymentWithOdT1").html(html); 
                }
            });
        break;
        case 2:
            var oc = $("#idoc").val();
            console.log(oc);
            $.ajax({
                data:{id_oc:oc},
                url: "<?php echo base_url();?>crm/od/getOD",
                type:"POST",
                dataType:"JSON",
                success:function(respond){
                    var html = "<option>Choose Order Delivery no</option>"
                    for( var a = 0 ; a<respond.length; a++){
                        html += "<option value = '"+respond[a]["id_od"]+"'>"+respond[a]["no_od"]+"</option>";
                    }
                    $("#od").html(html);
                }
            });
        break;
    }
}
</script>
<script>
function detailPayment(){
    var id_metode_pembayaran = $("#metodepembayaran").val();
    var id_oc = $("#idoc").val();
    $.ajax({
        url:"<?php echo base_url();?>crm/invoice/getDetailMetodePembayaran",
        dataType:"JSON",
        data:{id_metode_pembayaran:id_metode_pembayaran},
        type:"POST",
        success:function(respond){
            var trigger = "";
            if(respond["trigger_pembayaran"] == 1){
                $("#paymentWithOd").css("display","none");
                trigger = "AFTER OC, BEFORE OD";
                $(".method1").css("display","block");
                $(".method2").css("display","none");
                $("#paymentPercentage").val(respond["persentase"]);
                $("#paymentAmount").val(respond["nominal"]);
                $("#paymentTrigger").val(trigger);
            }
            else{
                $(".method2").css("display","block");
                $(".method1").css("display","none");
                trigger = "AFTER OD";
                $.ajax({
                    url:"<?php echo base_url();?>crm/invoice/getPaymentWithOd",
                    data:{id_oc:id_oc,use_od:0},
                    type:"POST",
                    dataType:"JSON",
                    success:function(responde){
                        //alert(responde);
                        var html = "";
                        for(var a = 0 ; a<responde["historyOd"].length; a++){ //length ga kebaca disini
                            html += "<tr><td>"+responde["historyOd"][a]["no_invoice"]+"</td><td>"+responde["historyOd"][a]["no_od"]+"</td><td>"+responde["historyOd"][a]["nominal"]+"</td><td>"+responde["historyOd"][a]["tanggal_keluar"]+"</td></tr>";
                        }
                        $("#paymentWithOdT1").html(html);
                    }
                });
                $.ajax({
                    url:"<?php echo base_url();?>crm/invoice/getOD",
                    data:{id_oc:id_oc,use_od:0},
                    type:"POST",
                    dataType:"JSON",
                    success:function(responde){
                        //alert(responde);
                        var html = "<option>Choose OD</option>";
                        for(var a = 0 ; a<responde["od"].length; a++){
                            html += "<option value = '"+responde["od"][a]["id_od"]+"'>"+responde["od"][a]["no_od"]+"</option>";
                        }
                        $("#orderDelivery").html(html);
                    }
                });
            }
        }
    });
}
</script>
<script>
function detailOd(){
    var id_od = $("#orderDelivery").val();
    $.ajax({
        url:"<?php echo base_url();?>crm/od/getOdItemPayment",
        data:{id_od:id_od},
        dataType:"JSON",
        type:"POST",
        success:function(respond){
            var html = "";
            for(var a = 0 ; a<respond.length; a++){
                html += "<tr><td>"+respond[a]["nama_produk"]+"</td><td>"+respond[a]["item_qty"]+"</td><td>"+respond[a]["paymentAmount"]+"</td></tr>"
                
            }
            $("#paymentWithOdBawah").html(html);
        }
    }); 
}
</script>
<script>
function loadOdItem(){
    var id_od = $("#od").val();
    $.ajax({
        data:{id_od:id_od},
        type:"POST",
        dataType:"JSON",
        url:"<?php echo base_url();?>crm/od/getOdItemPayment",
        success:function(respond){
            var html = "";
            for(var a = 0; a<respond.length; a++){
                html += "<tr><td>"+(a+1)+"</td><td>"+respond[a]["nama_produk"]+"</td><td>"+respond[a]["item_qty"]+"</td><td>"+respond[a]["selling_price"]+"</td><td>"+respond[a]["paymentAmount"]+"<input type = 'hidden' name = 'persentase_pembayaran' value = '-'><input type = 'hidden' name = 'nominal_pembayaran' value = '"+respond[a]["clean_nominal"]+"'></td></tr>";
            }
            $("#paymentWithOdT1").html(html); 
        }
    })
}
</script>