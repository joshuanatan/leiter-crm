<?php
class Oc extends CI_Controller{
    public function getOcDetail($id_oc){
        $where = array(
            "id_oc" => $id_oc
        );
        $field = array(
            "no_po_customer","id_quotation","versi_quotation"
        );
        $print = array(
            "no_po_customer","id_quotation","versi_quotation"
        );
        $result = selectRow("order_confirmation",$where);
        $data = foreachResult($result,$field,$print);
        echo json_encode($data);
    }  
}
?>