<?php
class Product extends CI_Controller{
    public function __construct(){
        parent::__construct();

    }
    private function req(){
        $this->load->view("req/head");
        $this->load->view("master/vendor-product/css/datatable-css");
        $this->load->view("master/vendor-product/css/breadcrumb-css");
        $this->load->view("master/vendor-product/css/modal-css");
        $this->load->view("master/vendor-product/css/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function index(){
        $this->req();
        $this->load->view("master/content-open");
        $this->load->view("master/vendor-product/category-header");
        $this->load->view("master/vendor-product/category-body");
        $this->load->view("master/content-close");
        $this->close();
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("master/vendor-product/js/jqtabledit-js");
        $this->load->view("master/vendor-product/js/page-datatable-js");
        $this->load->view("master/vendor-product/js/form-js");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
}
?>