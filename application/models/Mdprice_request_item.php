<?php
class Mdprice_request_item extends CI_Model{
    public function select($data){
        $this->db->join("price_request","price_request.id_request = price_request_item.id_request","inner");
        $this->db->join("produk","produk.id_produk = price_request_item.id_produk","inner");
        return $this->db->get_where("price_request_item",$data);
    }
    public function insert($data){
        $this->db->insert("price_request_item",$data);
        return $this->db->insert_id();
    }
    public function update($data,$where){
        $this->db->update("price_request_item",$data,$where);
    }
    public function delete($where){
        $this->db->delete("price_request_item",$where);
    }
}
?>