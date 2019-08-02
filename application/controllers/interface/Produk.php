<?php
class Produk extends CI_Controller{

    public function searchProdukByName(){ //dipake di data entry oc
        $like = array(
            "deskripsi_produk",$this->input->post("nama_produk"),"both"
        );
        $where = array(
            "status_produk" => 0,
        );

        $sql = "select produk.deskripsi_produk, produk.id_produk,satuan_produk from produk
        where produk.status_produk = 0 and
        produk.deskripsi_produk like '%".$this->input->post("nama_produk")."%'";
        $result = executeQuery($sql);

        $field = array(
            "deskripsi_produk","id_produk","satuan_produk"
        );
        $data = foreachMultipleResult($result,$field,$field);
        echo json_encode($data);
    }
}
?>