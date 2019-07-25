<?php
class Produk extends CI_Controller{

    public function searchProdukByName(){ //dipake di data entry oc
        $like = array(
            "deskripsi_produk",$this->input->post("nama_produk"),"after"
        );
        $where = array(
            "status_produk" => 0,
        );
        $result = selectLike("produk",$like,$where,1);
        $field = array(
            "deskripsi_produk","id_produk"
        );
        $data = foreachResult($result,$field,$field);
        $data["deskripsi_produk"] = $data["deskripsi_produk"];
        echo json_encode($data);
    }
}
?>