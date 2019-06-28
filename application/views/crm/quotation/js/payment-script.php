<script>
function countTotal(){
    var totalTagihan = "";
    var no_quotation = $("#no_quo").val();
    var versi_quotation = $("#versi_quo").val();
    //alert(id_payment_method);
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>interface/quotation/countTotalQuotationPrice",
            data:{no_quotation:no_quotation,versi_quotation:versi_quotation},
            dataType:"JSON",
            type:"POST",
            success:function(respond){
                totalTagihan = respond;
                $("#totalQuotation").val(addCommas(respond));
                $("#totalQuotationClean").val(respond);
            }
        });

    });
    
}
</script>
<script>
function paymentWithDP(){
    var persenDp = $("#persenDp").val();
    var persen = splitter(persenDp,"%");
    var totalTagihan = $("#totalQuotationClean").val();
    $("#persenSisa").val(100-parseInt(persen)+"%"); /*persenSisa*/
    $("#jumlahSisa").val(addCommas((100-parseInt(persen))/100*totalTagihan));
    $("#jumlahDp").val(addCommas(parseInt(persen)/100*totalTagihan));
    $("#jumlahSisaClean").val((100-parseInt(persen))/100*totalTagihan);
    $("#jumlahDpClean").val(parseInt(persen)/100*totalTagihan);
}
</script>