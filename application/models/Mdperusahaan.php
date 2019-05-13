<?php
class Mdperusahaan extends CI_Model{
    public function select($data){
        return $this->db->get_where("perusahaan",$data);
    }
    public function insert($data){
        $this->db->join("contact_person","contact_person.id_perusahaan = perusahaan.id_perusahaan","inner");
        $this->db->insert("perusahaan",$data);
        return $this->db->insert_id();
    }
    public function update($data,$where){
        $this->db->update("perusahaan",$data,$where);
    }
    public function delete($where){
        $this->db->delete("perusahaan",$where);
    }
}
?>