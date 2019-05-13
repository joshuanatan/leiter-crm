<?php
class Mdproduk_vendor extends CI_Model{
    public function select($data){
        return $this->db->get_where("produk_vendor",$data);
    }
    public function insert($data){
        $this->db->insert("produk_vendor",$data);
        return $this->db->insert_id();
    }
    public function update($data,$where){
        $this->db->update("produk_vendor",$data,$where);
    }
    public function delete($where){
        $this->db->delete("produk_vendor",$where);
    }
}
?>