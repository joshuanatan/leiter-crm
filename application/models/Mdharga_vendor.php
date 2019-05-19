<?php
class Mdharga_vendor extends CI_Model{
    public function select($data){
        $this->db->join("contact_person","contact_person.id_cp = harga_vendor.id_cp","inner");
        $this->db->join("perusahaan","contact_person.id_perusahaan = perusahaan.id_perusahaan","inner");
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
        $this->db->join("produk","produk.id_produk = produk_vendor.id_produk","inner"); /*untuk tau detail produknya*/
        $this->db->join("price_request_item","price_request_item.id_produk = produk.id_produk","inner"); /*nyaring dengan yang dipesan*/
        $this->db->join("harga_vendor","harga_vendor.id_request_item = price_request_item.id_request_item","inner"); /*sambungin ke harga vendor sesuai barang yang dipesan */
        $this->db->join("contact_person","contact_person.id_cp = harga_vendor.id_cp","inner"); /*detail contact person */
        $this->db->join("perusahaan","perusahaan.id_perusahaan = contact_person.id_perusahaan","inner"); /*untuk tau detail perusahaan*/
        $this->db->group_by("harga_vendor.id_cp");
        return $this->db->get_where("produk_vendor",$where); /*menghubungkan antar produk dan vendor*/

        //query = SELECT * FROM `produk_vendor` /*menghubungkan antar produk dan vendor*/ inner join produk on produk.id_produk = produk_vendor.id_produk /*untuk tau detail produknya*/ inner join price_request_item on price_request_item.id_produk = produk.id_produk /*nyaring dengan yang dipesan*/ inner join harga_vendor on harga_vendor.id_request_item = price_request_item.id_request_item /*sambungin ke harga vendor sesuai barang yang dipesan */ inner join contact_person on contact_person.id_cp = harga_vendor.id_cp /*detail contact person */ inner join perusahaan on perusahaan.id_perusahaan = contact_person.id_perusahaan /*untuk tau detail perusahaan*/ where price_request_item.id_request_item = 43 group BY harga_vendor.id_cp
    }
    public function selectVendorItem($where){

        $this->db->join("contact_person","contact_person.id_cp = harga_vendor.id_cp","inner");
        $this->db->join("perusahaan","contact_person.id_perusahaan = perusahaan.id_perusahaan","inner");
        $this->db->group_by("perusahaan.id_perusahaan");
        return $this->db->get_where("harga_vendor",$where);
        
    }
    public function countPrice($where){
        $this->db->select("(harga_produk/satuan_harga_produk) as 'total'");
        return $this->db->get_where("harga_vendor",$where);
    }
}
?>