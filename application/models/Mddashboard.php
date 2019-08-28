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
    public function getJumlahPo($field,$where,$tahun,$durasi){
        $this->db->select($field);
        $this->db->where("tahun_oc >=",$tahun-$durasi-1); /*3 thun termasuk yang kali ini*/
        $this->db->group_by(array("bulan_oc","tahun_oc"));
        return $this->db->get_where("order_detail",$where);

    }
}
?>