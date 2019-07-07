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
    public function getAlamatPerusahaan($id_perusahaan){
        $tipe_variable = $this->input->post("tipe_variable");
        if($tipe_variable == "id_harga_vendor"){
            $id_perusahaan = get1Value("harga_vendor","id_perusahaan",array("id_harga_vendor" => $id_perusahaan));
        }
        $where = array(
            "id_perusahaan" => $id_perusahaan
        );
        $alamat_perusahaan = get1Value("perusahaan","alamat_perusahaan",$where);
        echo json_encode($alamat_perusahaan);
    }
    public function getDetailPerusahaan($id_perusahaan){
        $where = array(
            "id_perusahaan" => $id_perusahaan
        );
        $field = array(
            "nama_perusahaan","nofax_perusahaan","alamat_perusahaan","notelp_perusahaan","peran_perusahaan","jenis_perusahaan"
        );
        $result = selectRow("perusahaan",$where);
        $data = foreachResult($result,$field,$field);
        echo json_encode($data);
    }
}