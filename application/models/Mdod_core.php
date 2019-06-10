<?php
class Mdod_core extends CI_Model{
    public function select($where){
        $this->db->join("order_confirmation","order_confirmation.id_oc = od_core.id_oc","inner");
        $this->db->join("quotation","order_confirmation.id_quotation = quotation.id_quo","inner");
        $this->db->join("contact_person","quotation.id_cp = contact_person.id_cp","inner");
        $this->db->join("perusahaan","perusahaan.id_perusahaan = contact_person.id_perusahaan","inner");
        return $this->db->get_where("od_core", $where);
    }
    public function insert($data){
        $this->db->insert("od_core",$data);
    }
}

?>