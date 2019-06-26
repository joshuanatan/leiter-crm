<?php
class Od extends CI_Controller{
    public function isExists($no_od){
        $where = array(
            "no_od" => $no_od
        );
        echo json_encode(isExistsInTable("od_core",$where));

    }  
}
?>