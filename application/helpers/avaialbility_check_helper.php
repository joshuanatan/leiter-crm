<?php
if ( ! function_exists('isExistsInTable')){
    function isExistsInTable($table,$where){
        $CI =& get_instance();
        $result = $CI->db->get_where($table,$where);
        if($result->num_rows() > 0){
            return 0; /*exists*/
        }
        else return 1; /*not exists*/
    }   
}
if ( ! function_exists('findMaxId')){
    function findMaxId($table,$coloumn,$where){
        $CI =& get_instance();
        $CI->db->select("max(".$coloumn.") as maxId");
        $result = $CI->db->get_where($table,$where);
        foreach($result->result() as $a){
            if($a->maxId != ""){
                return $a->maxId+1;
            }
            else return 1;
        }
    }   
}
if ( ! function_exists('get1Value')){
    function get1Value($table,$coloumn,$where){
        $CI =& get_instance();
        $CI->db->select($coloumn);
        $result = $CI->db->get_where($table,$where);
        foreach($result->result() as $a){
            return $a->$coloumn;
            break;
        }
    }
}
if ( ! function_exists('getAmount')){
    function getAmount($table,$coloumn,$where){
        $CI =& get_instance();
        $CI->db->select("count(".$coloumn.") as 'amount'");
        $CI->db->group_by($coloumn);
        $result = $CI->db->get_where($table,$where);
        return $result->num_rows(); /*karena yang penting bukan di count dari sqlnya melainkan jumlah row yang didapat dari query ini*/
    }
}
if ( ! function_exists('getTotal')){
    function getTotal($table,$coloumn,$where){
        $CI =& get_instance();
        $CI->db->select("sum(".$coloumn.") as 'total'");
        $result = $CI->db->get_where($table,$where);
        foreach($result->result() as $a){
            return $a->total;
            break;
        }
    }
}

?>