<script>
function add() {
    $("#t1").append('<tr class="grade"><td><select class = "form-control" id = "items" data-plugin="select2"><option disabled selected>Choose Vendor ID</option><option>PT Mitra Abc</option></select></td> <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" /></td> <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" /></td> <td><input type="text" class="form-control" name="touchSpinVertical" data-plugin="TouchSpin"  data-verticalbuttons="true" value="0" /></td><td> <button class = "btn btn-sm btn-success col-lg-12">Use</button></td></tr>');

    $("#items").select2({});
}
function addVariable(){
  $("#shippingVariablePrice").append("<tr><td><input type = 'text' class = 'form-control' name = 'variable[]'></td><td><input type = 'text' class = 'form-control' name = 'biaya[]'></td><td><input type = 'text' class = 'form-control' name = 'kurs[]'></td><td><input type = 'text' class = 'form-control' name = 'total[]'></td><td><button class = 'btn btn-sm btn-primary btn-danger' onclick = 'deleteRow(this)'>REMOVE</button></td></tr>");
}
function deleteRow(e,v) {
  var tr = e.parentElement.parentElement;
  var tbl = e.parentElement.parentElement.parentElement;
  tbl.removeChild(tr);

}
</script>
