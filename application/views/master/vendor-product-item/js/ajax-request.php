<script>
function getProductData(){
    $(document).ready(function(){
        var id_produk = $("#id_produk").val();
        if(id_produk == 0){
            $("#bn_produk").val("");
            $("#nama_produk").val("");
            $("#satuan_produk").val("");
            $("#satuan_produk_value").val("");
            $("#deskripsi_produk").val("");

            $("#bn_produk_new").val("");
            $("#nama_produk_new").val("");
            $("#satuan_produk_new").val("");
            $("#deskripsi_produk_new").val("");

            $("#bn_produk").attr('readonly',false);
            $("#nama_produk").attr('readonly',false);
            $("#satuan_produk").attr('disabled',false);
            $("#satuan_produk_new").attr('disabled',false);
            $("#deskripsi_produk").attr('readonly',false);
        }
        else{
            $.ajax({
                data: {id_produk:id_produk},
                url:"<?php echo base_url();?>master/product/getDetailProduct",
                dataType:"JSON",
                type:"POST",
                success:function(respond){
                    $("#bn_produk").val(respond["bn_produk"]);
                    $("#nama_produk").val(respond["nama_produk"]);
                    $("#satuan_produk").val(respond["satuan_produk"]);
                    $("#satuan_produk_value").val(respond["satuan_produk"]);
                    $("#deskripsi_produk").val(respond["deskripsi_produk"]);

                    $("#bn_produk_vendor").val(respond["bn_produk"]);
                    $("#nama_produk_vendor").val(respond["nama_produk"]);
                    $("#satuan_produk_vendor").val(respond["satuan_produk"]);
                    $("#deskripsi_produk_vendor").val(respond["deskripsi_produk"]);

                    $("#bn_produk").attr('readonly',true);
                    $("#nama_produk").attr('readonly',true);
                    $("#satuan_produk").attr('disabled',true);
                    $("#satuan_produk_new").attr('disabled',true);
                    $("#deskripsi_produk").attr('readonly',true);
                }
            });
        }
        
    }); 
}
</script>
<script>
function updateSupplierForm(id){
    $(document).ready(function(){
        $('#'+id+'_vendor').val($('#'+id).val());
    });
}
</script>
<script>
function updateSupplierUOM(id){

}
</script>