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
        /*cari semua item yang belum di assign ke vendor tersebut*/
        $this->db->where("produk.id_produk not in (select id_produk from produk_vendor where id_perusahaan = ".$this->session->id_supplier.")");
        return $this->db->get_where("produk",$where);
    }
    public function showTransaction($where,$field){
        $this->db->select($field);
        $this->db->join("order_detail","order_detail.id_submit_oc = detail_finished_order_item.id_submit_oc","inner");
        return $this->db->get_where("detail_finished_order_item",$where);
    }
}
?>