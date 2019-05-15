<?php
class Mdquotation extends CI_Model{
    public function select($data){
        $this->db->join("contact_person","contact_person.id_cp = quotation.id_cp","inner");
        $this->db->join("perusahaan","contact_person.id_perusahaan = perusahaan.id_perusahaan","inner");
        return $this->db->get_where("quotation",$data);
    }
    public function insert($data){
        $this->db->insert("quotation",$data);
        return $this->db->insert_id();
    }
    public function update($data,$where){
        $this->db->update("quotation",$data,$where);
    }
    public function delete($where){
        $this->db->delete("quotation",$where);
    }
    public function maxId(){
        $this->db->select("max(id_quo) as a");
        $row = $this->db->get("quotation");
        foreach($row->result() as $a){
            if($a->a != ""){
                return $a->a+1;
            }
            else return 1;
        }
    }
}
?>