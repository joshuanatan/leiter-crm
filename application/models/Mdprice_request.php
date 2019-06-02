<?php
class Mdprice_request extends CI_Model{
    public function select($data){
        $this->db->select("*,count(id_request_item) as 'a'");
        $this->db->join("price_request_item","price_request_item.id_request = price_request.id_request","inner");
        $this->db->join("contact_person","contact_person.id_cp = price_request.id_cp","inner");
        $this->db->join("perusahaan","contact_person.id_perusahaan = perusahaan.id_perusahaan","inner");
        $this->db->where("price_request_item.status_request_item",0);
        $this->db->where("price_request_item.id_produk in (select id_produk from produk_vendor)",NULL,FALSE);
        $this->db->group_by("price_request_item.id_request");
        return $this->db->get_where("price_request",$data);
    }
    public function insert($data){
        $this->db->insert("price_request",$data);
        return $this->db->insert_id();
    }
    public function update($data,$where){
        $this->db->update("price_request",$data,$where);
    }
    public function delete($where){
        $this->db->delete("price_request",$where);
    }
    public function maxId(){
        $this->db->select("max(id_request) as a");
        $row = $this->db->get("price_request");
        foreach($row->result() as $a){
            if($a->a != ""){
                return $a->a+1;
            }
            else return 1;
        }
    }
}
?>