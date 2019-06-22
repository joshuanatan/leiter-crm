<?php 
class Perusahaan extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function insertSupplier(){
        $data = $this->input->post("supplier_data"); /*list formnya*/
        $id_perusahaan = insertRow("perusahaan",$data);
        echo json_encode($id_perusahaan);
    }
}