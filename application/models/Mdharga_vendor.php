<?php
class Mdharga_vendor extends CI_Model{
    public function select($data){

        return $this->db->get_where("harga_vendor",$data);
        
    }
    public function insert($data){
        $this->db->insert("harga_vendor",$data);
        return $this->db->insert_id();
    }
    public function update($data,$where){
        $this->db->update("harga_vendor",$data,$where);
    }
    public function delete($where){
        $this->db->delete("harga_vendor",$where);
    }
    public function selectPenawaran($where){
        $this->db->join("produk","produk.id_produk = produk_vendor.id_produk","inner");
        $this->db->join("perusahaan","perusahaan.id_perusahaan = produk_vendor.id_perusahaan","inner");
        $this->db->join("price_request_item","price_request_item.id_produk = produk.id_produk","inner");
        $this->db->join("harga_vendor","harga_vendor.id_request_item = price_request_item.id_request_item","left outer");
        return $this->db->get_where("produk_vendor",$where);
        /*query = SELECT * FROM `produk_vendor` inner join produk on produk.id_produk = produk_vendor.id_produk inner join perusahaan on perusahaan.id_perusahaan = produk_vendor.id_perusahaan inner join price_request_item on price_request_item.id_produk = produk.id_produk left outer join harga_vendor on harga_vendor.id_request_item = price_request_item.id_request_item where price_request_item.id_request_item = */
    }
}
?>