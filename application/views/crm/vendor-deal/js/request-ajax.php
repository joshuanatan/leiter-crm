<script>
function getDetailPriceRequestItem(){
    $(document).ready(function(){
        var id_request_item = $("#items").val();
        $.ajax({
            url:"<?php echo base_url();?>interface/price_request_item/getDetailRequestItem/"+id_request_item,
            dataType:"JSON",
            success:function(respond){
                $("#nama_produk").val(respond["nama_produk"]);
                $("#jumlah_produk").val(respond["jumlah_produk"]);
                $("#note_produk").val(respond["notes_produk"]);
                $("#file_produk").attr("href","<?php echo base_url();?>assets/rfq/"+respond["file"]);
            }
        });
        $.ajax({
            url: "<?php echo base_url();?>interface/harga_vendor/getEachSupplierPrice/"+id_request_item,
            dataType: "JSON",
            success:function(respond){
                for(var a = 0 ; a<10; a++){
                    $("#supplier"+a).val("");
                    $("#pic"+a).val("");
                    $("#email"+a).html("");
                    $("#phone"+a).html("");
                    $("#price"+a).val("");
                    $("#rate"+a).val("");
                    $("#kurs"+a).val("");
                    $("#notes"+a).val("");
                }
                for(var a = 0; a<respond.length; a++){
                    $("#supplier"+a).val(respond[a]["id_perusahaan"]);
                    $("#pic"+a).val(respond[a]["id_cp"]);
                    $("#email"+a).html(respond[a]["email_cp"]);
                    $("#phone"+a).html(respond[a]["nohp_cp"]);
                    $("#price"+a).val(respond[a]["harga_produk"]);
                    $("#rate"+a).val(respond[a]["vendor_price_rate"]);
                    $("#kurs"+a).val(respond[a]["mata_uang"]);
                    $("#notes"+a).val(respond[a]["notes"]);
                    commas('price'+a);
                    commas('rate'+a);
                }
            }
        });
    });
}
</script>
<script>
function getCp(urutan){
    var id_supplier = $("#supplier"+urutan).val();
    $.ajax({
        url:"<?php echo base_url();?>interface/contact_person/getContactPerson/"+id_supplier,
        dataType:"JSON",
        success:function(respond){
            var html = "<option>Choose CP</option>";
            for(var a = 0; a<respond.length; a++){
                html +="<option value = '"+respond[a]["id_cp"]+"'>"+respond[a]["jk_cp"]+". "+respond[a]["nama_cp"]+"</option>";
            }
            $("#pic"+urutan).html(html);
        }
    })
}
</script>
<script>
function getDetailCp(urutan){
    var id_cp = $("#pic"+urutan).val();
    $.ajax({
        url:"<?php echo base_url();?>interface/contact_person/getDetailContactPerson/"+id_cp,
        dataType:"JSON",
        success:function(respond){
            $("#email"+urutan).html(respond["email_cp"]);
            $("#phone"+urutan).html(respond["nohp_cp"]);
        }
    })
}
</script>
<script>
function loadItemData(){
    loadVendorPrice();
    var id_request_item = $("#items").val();
    $.ajax({
        data:{id_request_item:id_request_item},
        dataType: "JSON",
        type: "POST",
        url: "<?php echo base_url();?>crm/vendor/getitemdimension",
        success:function(respond){
            $("#dimension").val(respond);
        }
    });
}
</script>
<script>
function countKurs(a){
    var price = $("#biaya"+a).val();
    var kurs = $("#kurs"+a).val();
    $("#total"+a).val(addCommas(splitter(price,",")*splitter(kurs,",")));
}
</script>
<script>
function submitData(counterId){
    var id_perusahaan = "";
    var id_cp = "";
    $(document).ready(function(){
        var id_supplier = $("#supplier"+counterId).val();
        if(id_supplier == 0){ /*option value 0, new supplier*/
            /*insert supplier here*/
            alert($("#supplier_add_name"+counterId).val());
            var data = {
                nama_perusahaan: $("#supplier_add_name"+counterId).val(),
                peran_perusahaan: "PRODUK",
                permanent:"1"
            };
            $.ajax({
                url:"<?php echo base_url();?>interface/perusahaan/insertSupplier",
                data: {supplier_data:data},
                dataType:"JSON",
                type:"POST",
                success:function(respond){
                    id_perusahaan = respond;
                }
            });

            var data = {
                nama_cp: $("#supplier_add_pic"+counterId).val(),
                jk_cp: $("#supplier_add_jk"+counterId).val(),
                email_cp:$("#supplier_add_email"+counterId).val(),
                nohp_cp:$("#supplier_add_phone"+counterId).val(),
            };
            $.ajax({
                url:"<?php echo base_url();?>interface/contact_person/insertContactPerson",
                data: {cp_data:data},
                dataType:"JSON",
                type:"POST",
                success:function(respond){
                    id_cp = respond
                }

            });
            /*load id_supplier & id_cp*/
        }
        else{
            id_perusahaan = id_supplier;
            id_cp = $("#pic"+counterId).val();
            /*load id_supplier & id_cp*/
        }
        /*
        Ambil price, rate, mata uang, notes
        */
        var data = {
            nama_cp: $("#supplier_add_pic"+counterId).val(),
            jk_cp: $("#supplier_add_jk"+counterId).val(),
            email_cp:$("#supplier_add_email"+counterId).val(),
            nohp_cp:$("#supplier_add_phone"+counterId).val(),
        };
        var datas = {
            id_request_item: $("#items").val(),
            id_perusahaan:id_perusahaan,
            id_cp:id_cp,
            harga_produk: splitter($("#price"+counterId).val(),","),
            satuan_harga_produk: 1,
            vendor_price_rate:splitter($("#rate"+counterId).val(),","),
            mata_uang:$("#kurs"+counterId).val(),
            notes:$("#notes"+counterId).val()
        };
        $.ajax({
            url:"<?php echo base_url()?>interface/harga_vendor/insertVendorPrice/",
            data:{harga_vendor_data:datas},
            type: "POST",
            success:function(respond){

                alert("Data Recorded Successfully");
            }
        });
        
    });
}
</script>
<script>
function loadShippingMethod(){
    var id_perusahaan = $("#shipper").val();
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getshippingmethod",
            data:{id_perusahaan:id_perusahaan},
            type: "POST",
            dataType: "JSON",
            success:function(respond){
                $("#metodePengiriman").html(respond);
            }
        });
    });
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getContactPerson",
            data:{id_perusahaan:id_perusahaan},
            type: "POST",
            dataType: "JSON",
            success:function(respond){
                $("#cp").html(respond);
            }
        });
    });
}
</script>
<script>
function loadShippingPrice(){
    var id_perusahaan = $("#shipper").val();
    var metode_pengiriman = $("#metodePengiriman").val();
    var id_request_item = $("#items").val();
    var purpose = $("#purpose").val();
    console.log("1. "+id_perusahaan);
    console.log("2. "+metode_pengiriman);
    console.log("3. "+id_request_item);
    console.log("4. "+purpose);
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getShippingPrice",
            type: "POST",
            dataType: "JSON",
            data:{id_perusahaan:id_perusahaan,metode_pengiriman:metode_pengiriman,id_request_item:id_request_item,purpose:purpose},
            success:function(respond){
                $("#shippingVariablePrice").html(respond);
            }
        });
    });
}
</script>
<script>
function loadCourierPrice(){
    var id_perusahaan = $("#shipper").val();
    var metode_pengiriman = $("#metodePengiriman").val();
    var id_request_item = $("#items").val();
    var purpose = $("#purpose").val();
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getCourierPrice",
            type: "POST",
            dataType: "JSON",
            data:{id_perusahaan:id_perusahaan,metode_pengiriman:metode_pengiriman,id_request_item:id_request_item,purpose:purpose},
            success:function(respond){
                $("#shippingVariablePrice").html(respond);
            }
        });
    });
}
</script>