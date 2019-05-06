<?php
class expanses extends CI_Controller{
    public function __construct(){
        parent::__construct();

    }
    private function req(){
        $this->load->view("req/head");
        $this->load->view("master/expanses/css/datatable-css");
        $this->load->view("master/expanses/css/breadcrumb-css");
        $this->load->view("master/expanses/css/modal-css");
        $this->load->view("master/expanses/css/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function index(){
        $this->req();
        $this->load->view("master/content-open");
        $this->load->view("master/expanses/category-header");
        $this->load->view("master/expanses/category-body");
        $this->load->view("master/content-close");
        $this->close();
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("master/expanses/js/jqtabledit-js");
        $this->load->view("master/expanses/js/page-datatable-js");
        $this->load->view("master/expanses/js/form-js");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
}
?>