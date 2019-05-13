<script>
function add() {
    $("#t1").append('<tr class="grade"><td><select class = "form-control" id = "items" data-plugin="select2"><option disabled selected>Choose Vendor ID</option><option>PT Mitra Abc</option></select></td> <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" /></td> <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" /></td> <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" /></td><td> <button class = "btn btn-sm btn-success col-lg-12">Use</button></td></tr>');

    $("#items").select2({});
}

function deleteRow(e,v) {
  var tr = e.parentElement.parentElement;
  var tbl = e.parentElement.parentElement.parentElement;
  tbl.removeChild(tr);

}
</script>
