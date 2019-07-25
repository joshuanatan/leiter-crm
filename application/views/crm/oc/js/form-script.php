<script>
function quotationDetail(){
    $(document).ready(function(){
        var id_submit_quotation = $("#id_submit_quotation").val();
        $.ajax({
            url:"<?php echo base_url();?>interface/quotation/getQuotationDetail",
            data:{id_submit_quotation:id_submit_quotation},
            dataType:"JSON",
            type:"POST",
            success:function(respond){
                $(".perusahaanCust").val(respond["nama_perusahaan"]);
                $(".namaCust").val(respond["nama_cp"]);
                $("#idCust").val(respond["id_cp"]);
                $("#alamatCust").val(respond["alamat_perusahaan"]);
                $("#up_cp").val(respond["up_cp"]);
                $("#durasi_pengiriman").val(respond["durasi_pengiriman"]);
                $("#durasi_pembayaran").val(respond["durasi_pembayaran"]);
                $("#franco").val(respond["franco"]);
                $("#total_quotation_price").val(addCommas(respond["total_quotation_price"]));
            }
        });
        $.ajax({
            url:"<?php echo base_url();?>interface/quotation/getOrderedItem",
            data:{id_submit_quotation:id_submit_quotation},
            dataType:"JSON",
            type:"POST",
            success:function(respond){
                var html = "";
                /*buat wadahnya*/
                for(var a = 0; a<respond.length; a++){
                    html += "<tr><td id = 'check"+a+"'></td><td id = 'product"+a+"'></td><td id = 'amount"+a+"'></td><td id = 'selling"+a+"'></td><td id = 'final"+a+"'></td></tr>";
                }
                //alert(html);
                $("#t1").html(html);
                
                /*metodenya pake update space yang sudah ada*/
                for(var a = 0; a<respond.length; a++){
                    var check = "";
                    if(respond[a]["status_oc_item"] == 0) check = "checked"; /*ini apakah dia masuk atau engagk*/
                    //alert("hello");
                    $("#check"+a).html('<div class="checkbox-custom checkbox-primary"><input name = "checkbox[]" value = "'+a+'" type="checkbox" id="checks'+a+'" '+check+' /><label for="inputChecked"></label></div>');
                    /* id ini untuk ngitung total pembayaran, semua id harus sesuai dengan urutan*/
                    /* lalu namenya ini untuk tau mana yang diambil valuenya menentukan index array yang aktif di item oc*/

                    /*kalau ini tetep masuk semua ke db, aktif atau tidaknya tunggu dari id yang diatas*/
                    $("#product"+a).html('<textarea name = "nama_oc_item[]" class = "form-control" >'+respond[a]["nama_produk_leiter"]+'</textarea><input type = "hidden" name = "id_quotation_item[]" class = "form-control" value = "'+respond[a]["id_quotation_item"]+'">');
                    
                    $("#amount"+a).html('<input type = "text" id = "jumlah_produk'+a+'" name = "final_amount[]" class = "form-control" value = "'+respond[a]["item_amount"]+' '+respond[a]["satuan_produk"]+'">');

                    $("#selling"+a).html('<input type = "text" class = "form-control" value = "'+respond[a]["selling_price"]+'" readonly>');

                    $("#final"+a).html('<input type = "text" id = "selling_price'+a+'" oninput = "commas(\'selling_price'+a+'\')" name ="final_selling_price[]" class = "form-control" value = "'+respond[a]["selling_price"]+'">');
                    
                }
            }
        });
        $.ajax({
            url:"<?php echo base_url();?>interface/quotation/getMetodePembayaran",
            data:{id_submit_quotation:id_submit_quotation},
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
<script>
function countTotal(){
    var jumlah_row = $("#t1 tr").length;
    console.log(jumlah_row);
    var jumlah_tagihan = 0;
    for(var a = 0; a<jumlah_row; a++){
        if($('#checks'+(a)).is(":checked")){
            var jumlah = $("#jumlah_produk"+a).val();
            var split = jumlah.split(" ");
            console.log(split[0]);
            jumlah_tagihan += parseInt(splitter($("#selling_price"+(a)).val(),","))*parseInt(split[0]);
            console.log("jumlah tagihan "+jumlah_tagihan);
        }
    }
    $("#totalQuotation").val(addCommas(jumlah_tagihan));
    
}
</script>
<script>
function countTotalDataEntry(){
    var jumlah_row = $("#t1 tr").length;
    console.log(jumlah_row);
    var jumlah_tagihan = 0;
    for(var a = 0; a<jumlah_row; a++){
        if($('#selling_price'+(a)).val() != ""){
            var jumlah = $("#jumlah_produk"+a).val();
            var split = jumlah.split(" ");
            var biaya = $("#selling_price"+a).val();
            console.log(splitter(biaya),",");
            jumlah_tagihan += parseInt(splitter(biaya,","))*parseInt(split[0]);
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

<script>
function copy(id_source, id_target){
    var text = $("#"+id_source).val();
    $("#"+id_target).val(text);
}
</script>
<script>
function getRecommendationPerusahaan(){
    
    var teks = $("#control_namaperusahaan").val();
    var length = teks.length;
    if(teks != ""){
        $.ajax({
            url:"<?php echo base_url();?>interface/perusahaan/searchCustomerByName",
            type:"POST",
            dataType:"JSON",
            data:{nama_perusahaan:teks},
            success:function(respond){
                if(respond.length != 0){
                    $("#customerNotFound").css("display","none");
                    $("#namaperusahaan").val(respond["nama_perusahaan"]);
                    var sumber = document.getElementById("namaperusahaan");
                    sumber.focus();
                    sumber.setSelectionRange(length,respond["nama_perusahaan"].length);
                    $("#id_perusahaan").val(respond["id_perusahaan"]);
                }
                else{
                    $("#customerNotFound").css("display","block");
                }
            }
        });
    }
    
}
</script>
<script>
function getRecommendationProduk(baris){
    var teks = $("#control_namaproduk"+baris).val();
    var length = teks.length;
    if(teks != ""){
        $.ajax({
            url:"<?php echo base_url();?>interface/produk/searchProdukByName",
            type:"POST",
            dataType:"JSON",
            data:{nama_produk:teks},
            success:function(respond){
                if(respond.length != 0){
                    $("#produkNotFound"+baris).css("display","none");
                    $("#namaproduk"+baris).val(respond["deskripsi_produk"]);
                    var sumber = document.getElementById("namaproduk"+baris);
                    sumber.focus();
                    sumber.setSelectionRange(length,respond["deskripsi_produk"].length);
                    $("#id_produk"+baris).val(respond["id_produk"]);
                }
                else{
                    $("#produkNotFound"+baris).css("display","block");
                    $("#id_produk"+baris).val(0);
                }
            }
        });
    }
    
}
</script>