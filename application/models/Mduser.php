<?php
class Mduser extends CI_Model{
    public function select($data){
        return $this->db->get_where("user",$data);
    }
    public function insert($data){
        $this->db->insert("user",$data);
    }
    public function update($data,$where){
        $this->db->update("user",$data,$where);
    }
    public function delete($where){
        $this->db->delete("user",$where);
    }
}
?>