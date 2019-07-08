<script>
function countTotal(){
    var jumlah_row = $("#t1 tr").length;
    console.log(jumlah_row);
    var jumlah_tagihan = 0;
    for(var a = 0; a<jumlah_row; a++){
        if($('#checks'+(a+1)).is(":checked")){
            var jumlah = $("#jumlah_produk"+(a+1)).val();
            var split = jumlah.split(" ");
            jumlah_tagihan += parseInt(splitter($("#selling_price"+(a+1)).val(),","))*parseInt(split[0]);
            console.log("jumlah tagihan "+jumlah_tagihan);
        }
    }
    $("#totalQuotation").val(addCommas(jumlah_tagihan));
    
}
</script>
<script>
function paymentWithDP(){
    var persenDp = $("#persenDp").val();
    var persen = splitter(persenDp,"%");
    var totalTagihan = parseInt(splitter($("#totalQuotation").val(),","));
    $("#persenSisa").val(100-parseInt(persen)+"%"); /*persenSisa*/
    $("#jumlahSisa").val(addCommas((100-parseInt(persen))/100*totalTagihan));
    $("#jumlahDp").val(addCommas(parseInt(persen)/100*totalTagihan));
    $("#jumlahSisaClean").val((100-parseInt(persen))/100*totalTagihan);
    $("#jumlahDpClean").val(parseInt(persen)/100*totalTagihan);
}
</script>