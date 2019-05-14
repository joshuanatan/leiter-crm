<script>
  var num = 0;
function add() {
  num++;
  console.log(num);
    <?php 
    $html = "";
    foreach($produk->result() as $a){ 
      $html .= "<option value = ".$a->id_produk.">".ucwords($a->nama_produk)."</option>";
    }
    ?>
    $("#t1").append("<tr class='gradeA'><td><select onchange = 'getuom("+num+")' class = 'form-control' id ='items"+num+"' data-plugin='select2' name = 'id_produk[]'><option disabled selected>Choose Item</option><?php echo $html;?></select></td><td><input type='text' class='form-control' name='jumlah_produk[]' data-plugin='TouchSpin' data-verticalbuttons='true' value='0' /></td><td id = uom"+num+"> </td><td><button class = 'btn btn-sm btn-danger col-lg-12' onclick='deleteRow(this)' >Remove</button></td></tr>");
    $("#items").select2({});
}

function deleteRow(e,v) {
  num--;
  var tr = e.parentElement.parentElement;
  var tbl = e.parentElement.parentElement.parentElement;
  tbl.removeChild(tr);

}
</script>
