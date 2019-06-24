<?php
class Po extends CI_Controller{
    public function isExists($no_po){
        $where = array(
            "no_po" => $no_po
        );
        echo json_encode(isExistsInTable("po_core",$where));

    }  
}
?>