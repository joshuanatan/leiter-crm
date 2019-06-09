<script>
function getVendorDetailPrice(counter){
    //alert(counter);
    $("#shipppingprice"+counter).val("");
    var id_supplier = $("#idsupplier"+counter).val();
    var id_request_item = $("#idrequestitem"+counter).val();
    $(document).ready(function(){
        $.ajax({
            data:{id_request_item:id_request_item,id_perusahaan:id_supplier,result:"array"},
            type:"POST",
            dataType:"JSON",
            url:"<?php echo base_url();?>crm/vendor/getSupplierPriceWithResult",
            success:function(respond){
                $("#hargabarang"+counter).val(addCommas(respond[0]));
                $("#ratebarang"+counter).val(addCommas(respond[1]));
                $("#matauangbarang"+counter).val(respond[2]);
                $("#minimumbarang"+counter).val(respond[3]);
                $("#namaperusahaan"+counter).val(respond[4]);
                $("#alamatperusahaan"+counter).val(respond[5]);
            }
        });
        /*abis supplier dirubah, langsung cari shipper yang udah di masukin harganya yang berkaitan denagn orang ini*/
        $.ajax({
            data:{id_request_item:id_request_item,id_supplier:id_supplier,result:"array"},
            type:"POST",
            dataType:"JSON",
            url:"<?php echo base_url();?>crm/vendor/getShipperWithResult",
            success:function(respond){
                var html = "<option>Choose Shipper</option>";
                for(var a= 0; a<respond.length; a++){
                    html += "<option value = '"+respond[a]["id_shipper"]+"-"+respond[a]["metode_pengiriman"]+"'>"+respond[a]["nama_shipper"]+" - "+respond[a]["metode_pengiriman"]+"</option>";
                }
                $("#idshipper"+counter).html(html);
            }
        });
    });
}
</script>
<script>
function getShipperDetailPrice(counter){
    alert(counter);
    var id_request_item = $("#idrequestitem"+counter).val();
    var id_supplier = $("#idsupplier"+counter).val();
    var shipping = $("#idshipper"+counter).val();
    var detailShipper = splitToArray(shipping,"-");
    $("#shippingmethod"+counter).val(detailShipper[1]);
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url();?>crm/vendor/getShipperPriceWithResult",
            type:"POST",
            dataType:"JSON",
            data:{id_supplier:id_supplier,metode_pengiriman:detailShipper[1],id_perusahaan:detailShipper[0],id_request_item:id_request_item,result:"array"},
            success:function(respond){
                $("#hargashipping"+counter).val(addCommas(respond[0]["total"]));
                $("#matauangshipping"+counter).val(addCommas(respond["currency"]));
            }
        })
    })
}
</script>
<script>
function saveItemPO(counter){
    $(document).ready(function(){
        var id_po_setting = $("#idposetting").val();
        var id_request = $("#idrequest").val();
        var id_request_item = $("#idrequestitem"+counter).val();
        var id_supplier = $("#idsupplier"+counter).val();
        var harga_item = splitter($("#hargabarang"+counter).val(),',');
        var kurs = splitter($("#ratebarang"+counter).val(),',');
        var mata_uang = $("#matauangbarang"+counter).val();
        var id_shipper = $("#idshipper"+counter).val();
        var shipping_method = $("#shippingmethod"+counter).val();
        var harga_shipping = splitter($("#hargashipping"+counter).val(),',');
        var mata_uang_shipping = splitter($("#matauangshipping"+counter).val(),',');
        alert(mata_uang_shipping);
        $.ajax({
            url:"<?php echo base_url();?>crm/po/insertItemPO",
            data:{
                id_request:id_request,id_po_setting:id_po_setting,id_request_item:id_request_item,harga_item:harga_item,kurs:kurs,mata_uang:mata_uang,id_supplier:id_supplier,id_shipper:id_shipper,shipping_method:shipping_method,harga_shipping:harga_shipping,mata_uang_shipping:mata_uang_shipping,
            },
            type:"POST",
            success:function(respond){
                alert("DATA RECORDED");
            }
        });
    });
}
</script>