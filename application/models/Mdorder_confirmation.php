<?php
class Mdorder_confirmation extends CI_Model{
    public function select($where){
        $this->db->join("quotation","quotation.id_quo = order_confirmation.id_quotation and quotation.versi_quo = order_confirmation.versi_quotation","inner");
        $this->db->join("contact_person","contact_person.id_cp = quotation.id_cp","inner");
        $this->db->join("perusahaan","perusahaan.id_perusahaan = contact_person.id_perusahaan","inner");
        return $this->db->get_where("order_confirmation",$where);
    }
    public function insert($data){
        $this->db->insert("order_confirmation",$data);
        return $this->db->insert_id();
    }
    public function update($data,$where){
        $this->db->update("order_confirmation",$data,$where);
    }
    public function delete($where){
        $this->db->delete("order_confirmation",$where);
    }
    public function maxId(){
        $this->db->select("max(id_oc) as a");
        $row = $this->db->get("order_confirmation");
        foreach($row->result() as $a){
            if($a->a != ""){
                return $a->a+1;
            }
            else return 1;
        }
    }
    /************************************************************** */
    public function getListOc($where){
        $this->db->order_by("id_submit_oc","DESC");
        return $this->db->get_where("order_confirmation",$where);
    }
    public function getListOcForOd(){
        
    }
}