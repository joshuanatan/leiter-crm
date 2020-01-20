<?php
/**
 * Class ini dibuat untuk mempermudah penggunaan datatable agar tidak perlu melihat pada project-project sebelumnya
 * library ini hanya membantu penyimpanan data sementara dan mengembalikan data tersebut apabila dibutuhkan
 * library ini tidak melakukan koneksi ke database, controller yang akan melakukan koneksi ke database
 */
class Datatable{
    private $order_by = "";
    private $order_direction = "";
    private $search_key = "";
    private $page_number = "";
    private $search_offset = "";
    private $data_limit = "";
    private $search_field = array();
    private $sort_field = array();
    private $print_field = array();
    
    public function __construct($config){
        $this->search_field = $config["search_field"];
        $this->sort_field = $config["sort_field"];
        $this->print_field = $config["print_field"];
        $this->data_limit = $config["limit"];
        $this->order_by = $config["order_by"];
        $this->order_direction = $config["order_direction"];
        $this->page_number = 1;
        $this->search_offset = 0;
    }
    public function sort($input_order_by, $input_direction){
        $this->order_by = $input_order_by;
        $this->order_direction = $input_direction;
    }
    public function search($search_key){
        $this->search_key = $search_key;
    }
    public function removeFilter(){
        $this->order_by = "";
        $this->order_direction = "";
        $this->search = "";
    }
    public function page($page){
        $this->page_number = $page;
        $this->search_offset = 10*($page-1);
        $data["numbering"] = $this->page_numbering($page);
        $data["sort_field"] = $this->sort_field;
        $data["search_print"] = $this->print_field;
        $data["or_like"] = $this->create_search_variable;
        $data["order_by"] = $this->order_by;
        $data["order_direction"] = $this->order_direction;
    }
    private function page_numbering($page_number){
        if($page_number <= 3){
            $data["numbers"] = array(1,2,3,4,5);
            $data["prev"] = 1;
            $data["search"] = 1;
        }
        else{
            for($a = 0; $a<5; $a++){
                $data["numbers"][$a] = $page_number+$a-2;
                $data["prev"] = 0;
                $data["search"] = 1;
            }
        }
        return $data;
    }
    private function create_search_variable(){
        if($this->search != ""){
            $field = $this->search_field; //ngambil field apa aja yang mau di cari
            for($a = 0; $a<count($field); $a++){
                $search_variable[$field[$a]] = $this->search; // $search_variable["field 1"] = "asdf"
            }
            $search_variable["is_search"] = 1; //kalau ada yang di cari
        }
        else{
            $search_variable["is_search"] = 0; //kalau tidak ada yang di cari
        }
        return $search_variable;
    }

}