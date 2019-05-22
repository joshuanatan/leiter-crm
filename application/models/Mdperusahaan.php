<?php
class Mdperusahaan extends CI_Model{
    public function select($data){
        $this->db->join("contact_person","contact_person.id_perusahaan = perusahaan.id_perusahaan","inner");
        $this->db->group_by("perusahaan.id_perusahaan");
        return $this->db->get_where("perusahaan",$data);
    }
    public function insert($data){
        $this->db->insert("perusahaan",$data);
        return $this->db->insert_id();
    }
    public function update($data,$where){
        $this->db->update("perusahaan",$data,$where);
    }
    public function delete($where){
        $this->db->delete("perusahaan",$where);
    }
    public function itemsupplier($data){
        $this->db->join("price_request","price_request.id_request = price_request_item.id_request","inner");
        $this->db->join("produk","produk.id_produk = price_request_item.id_produk","inner");
        $this->db->join("produk_vendor","produk_vendor.id_produk = produk.id_produk","inner");
        $this->db->join("perusahaan","perusahaan.id_perusahaan = produk_vendor.id_perusahaan","inner");
        $this->db->join("contact_person","contact_person.id_perusahaan = perusahaan.id_perusahaan","inner");
        $this->db->group_by("perusahaan.id_perusahaan");
        return $this->db->get_where("price_request_item",$data);
    }
}
?>