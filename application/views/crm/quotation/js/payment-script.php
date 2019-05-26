<script>
function paymentMethodForm(){
    var id_payment_method = parseInt($("#paymentMethod").val());
    var totalTagihan = "";
    var id_quotation = $("#id_quo").val();
    var quo_version = $("#versi_quo").val();
    //alert(id_payment_method);
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>crm/quotation/countTotalQuotationPrice",
            data:{id_quotation:id_quotation,quo_version:quo_version},
            dataType:"JSON",
            type:"POST",
            success:function(respond){
                //alert("hello");
                totalTagihan = respond;
                //alert(totalTagihan);
                switch(id_payment_method){
                    case 1:
                    //alert("hello");
                    case 2:
                    $(".containerDp").css("display","none");
                    $(".containerSisa").css("display","block");
                    $(".containerSisa input").attr("readonly","true");
                    $("#persenSisa").val("100%");
                    $("#jumlahSisa").val(addCommas(totalTagihan));
                    break;
                    case 11:
                    case 12:
                    $("#jumlahDp").attr("readonly","true");
                    $("#persenSisa").attr("readonly","true");
                    $("#jumlahSisa").attr("readonly","true");
                    $(".containerDp").css("display","block");
                    $(".containerSisa").css("display","block");
                    break;
                    default:
                    //alert("hello");
                    $(".containerDp").css("display","none");
                    $(".containerSisa").css("display","none");
                    break;
                }
            }
        });

    });
    
}
</script>
<script>
function paymentWithDP(){
    var persenDp = $("#persenDp").val();
    var persen = splitter(persenDp,"%");

    var totalTagihan = "";
    var id_quotation = $("#id_quo").val();
    var quo_version = $("#versi_quo").val();
    //alert(id_payment_method);
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>crm/quotation/countTotalQuotationPrice",
            data:{id_quotation:id_quotation,quo_version:quo_version},
            dataType:"JSON",
            type:"POST",
            success:function(respond){
                totalTagihan = respond;
                $("#persenSisa").val(100-parseInt(persen)+"%"); /*persenSisa*/
                $("#jumlahSisa").val(addCommas((100-parseInt(persen))/100*totalTagihan));
                $("#jumlahDp").val(addCommas(parseInt(persen)/100*totalTagihan));
            }
        });

    });

}
</script>