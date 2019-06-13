<?php
class Mdquotation extends CI_Model{
    public function select($where){
        return $this->db->get_where("quotation",$where);
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
    public function select2($data){
        $this->db->join("contact_person","contact_person.id_cp = quotation.id_cp","inner");
        $this->db->join("perusahaan","contact_person.id_perusahaan = perusahaan.id_perusahaan","inner");
        $this->db->join("price_request","price_request.id_request = quotation.id_request","inner");
        $this->db->join("quotation_item","quotation_item.id_quotation = quotation.id_quo and quotation_item.quo_version = quotation.versi_quo","inner");
        $this->db->group_by("quotation.id_quo,quotation.versi_quo");
        return $this->db->get_where("quotation",$data);
    }
    public function maxVersion($where){
        $this->db->select("max(versi_quo) as a");
        $row = $this->db->get_where("quotation",$where);
        foreach($row->result() as $a){
            return $a->a+1;
        }
    }
    public function selectForOc($data){
        $this->db->join("contact_person","contact_person.id_cp = quotation.id_cp","inner");
        $this->db->join("perusahaan","contact_person.id_perusahaan = perusahaan.id_perusahaan","inner");
        $this->db->join("price_request","price_request.id_request = quotation.id_request","inner");
        $this->db->join("quotation_item","quotation_item.id_quotation = quotation.id_quo and quotation_item.quo_version = quotation.versi_quo","inner");
        $this->db->group_by("quotation.id_quo,quotation.versi_quo");
        $this->db->where("quotation.id_quotation not in (select id_quotation from order_confirmation");
        return $this->db->get_where("quotation",$data);
    }
}
?>