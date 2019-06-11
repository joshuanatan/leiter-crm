<?php
class Mdproduk extends CI_Model{
    public function select($where){
        return $this->db->get_where("produk",$where);
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
    public function produk_vendor($where){
        $this->db->join("produk_vendor","produk_vendor.id_produk = produk.id_produk","left outer");
        $this->db->group_by("produk.id_produk");
        return $this->db->get_where("produk",$where);
    }
}
?>