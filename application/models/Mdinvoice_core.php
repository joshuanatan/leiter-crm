<?php
class Mdinvoice_core extends CI_Model{
    
    public function insert($data){
        $this->db->insert("invoice_core",$data);
        return $this->db->insert_id();
    }
    public function update($data,$where){
        $this->db->update("invoice_core",$data,$where);
    }
    public function delete($where){
        $this->db->delete("invoice_core",$where);
    }
    /********************************************** */
    public function getListInvoice($where){
        $this->db->order_by("id_submit_invoice","DESC");
        return $this->db->get_where("invoice_core",$where);
    }
}
?>