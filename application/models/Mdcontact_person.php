<?php
class Mdcontact_person extends CI_Model{
    public function select($data){
        return $this->db->get_where("contact_person",$data);
    }
    public function insert($data){
        $this->db->insert("contact_person",$data);
        return $this->db->insert_id();
    }
    public function update($data,$where){
        $this->db->update("contact_person",$data,$where);
    }
    public function delete($where){
        $this->db->delete("contact_person",$where);
    }
    public function selectRequestCp($where){
        $this->db->join("perusahaan","perusahaan.id_perusahaan = contact_person.id_perusahaan","inner");
        $this->db->join("price_request","price_request.id_perusahaan = perusahaan.id_perusahaan","inner");
        return $this->db->get_where("contact_person",$where);
    }
}
?>