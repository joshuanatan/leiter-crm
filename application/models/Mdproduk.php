<?php
class Mdproduk extends CI_Model{
    public function select($data){
        return $this->db->get_where("produk",$data);
    }
    public function insert($data){
        $this->db->insert("produk",$data);
        return $this->db->insert_id();
    }
    public function update($data,$where){
        $this->db->update("produk",$data,$where);
    }
    public function delete($where){
        $this->db->delete("produk",$where);
    }
}
?>