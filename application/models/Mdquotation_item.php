<?php
class Mdquotation_item extends CI_Model{
    public function select($data){
        $this->db->join("price_request_item","price_request_item.id_request_item = quotation_item.id_request_item","inner");
        $this->db->join("produk","produk.id_produk = price_request_item.id_produk","inner");
        return $this->db->get_where("quotation_item",$data);
    }
    public function insert($data){
        $this->db->insert("quotation_item",$data);
        return $this->db->insert_id();
    }
    public function update($data,$where){
        $this->db->update("quotation_item",$data,$where);
    }
    public function delete($where){
        $this->db->delete("quotation_item",$where);
    }
    public function countAllPrice($where){
        $this->db->select("sum(selling_price) as totalTagihan");
        $this->db->Where($where);
        return $this->db->get("quotation_item");
    }
}
?>