<script>
function copy(id_source, id_target){
    var text = $("#"+id_source).val();
    $("#"+id_target).val(text);
}
</script>
<script>
function getRecommendationPerusahaan(){
    
    var teks = $("#backup").val();
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