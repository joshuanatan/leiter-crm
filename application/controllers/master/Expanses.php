<?php
class expanses extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdfinance_usage_type");
    }
    private function req(){
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function index(){
        $where = array(
            "finance_type" => array(
                "status_type" => 0
            )
        );
        $result["finance_type"] = $this->Mdfinance_usage_type->select($where["finance_type"]);
        $data = array(
            "finance_type" => array()
        );
        $counter = 0;
        foreach($result["finance_type"]->result() as $a){
            $data["finance_type"][$counter] = array(
                "id_type" => $a->id_type,
                "variable_type" => $a->variable_type,
                "usage_type" => $a->usage_type,
                "name_type" => $a->name_type
            );  
            $counter++;
        }
        $this->req();
        $this->load->view("master/content-open");
        $this->load->view("master/expanses/category-header");
        $this->load->view("master/expanses/category-body",$data);
        $this->load->view("master/content-close");
        $this->close();
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
    public function insert(){
        $data = array(
            "variable_type" => $this->input->post("variable_type"),
            "usage_type" => $this->input->post("usage_type"),
            "name_type" => ucwords($this->input->post("name_type")),
            "id_user_add" => $this->session->id_user
        );
        $this->Mdfinance_usage_type->insert($data);
        redirect("master/expanses");
    }
    public function delete($id_type){
        $where = array(
            "id_type" => $id_type
        );
        $data = array(
            "status_type" => 1
        );
        $this->Mdfinance_usage_type->update($data,$where);
        redirect("master/expanses");
    }
    public function edit($id_type){
        $where = array(
            "id_type" => $id_type
        );
        $data = array(
            "variable_type" => $this->input->post("variable_type"),
            "usage_type" => $this->input->post("usage_type"),
            "name_type" => $this->input->post("name_type")
        );
        $this->Mdfinance_usage_type->update($data,$where);
        redirect("master/expanses");
    }
}
?>