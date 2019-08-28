<?php
class Mddashboard extends CI_Model{
    public function select($data){
        $this->db->group_by("nama_satuan");
        return $this->db->get_where("satuan",$data);
    }

    public function getSalesMonthly($field,$where,$tahun,$durasi){
        $this->db->select($field);
        $this->db->where("tahun_invoice >=",$tahun-$durasi-1); /*3 thun termasuk yang kali ini*/
        return $this->db->get_where("sales_monthly",$where);
    }
}
?>