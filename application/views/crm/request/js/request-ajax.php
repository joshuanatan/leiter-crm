<script>
function getContactPerson(){
    var id_perusahaan = $("#idperusahaan").val();
    console.log(id_perusahaan);
    $(document).ready(function(){
        $.ajax({
            url: "<?php echo base_url();?>master/customer/getcp",
            data: {id_perusahaan:id_perusahaan},
            type: "POST",
            dataType:"JSON",
            success:function(respond){
                $("#cpperusahaan").append(respond);
            }
        });
    });
    
}
</script>
<script>
function getuom(a){
    var id_produk = $("#items"+a).val();
    console.log(id_produk);
    $(document).ready(function(){
        $.ajax({
            url: "<?php echo base_url();?>master/product/getuom",
            data: {id_produk:id_produk},
            type: "POST",
            dataType:"JSON",
            success:function(respond){
                $("#uom"+a).html(respond);
            }
        });
    });
    
}
</script>