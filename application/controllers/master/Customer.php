<?php
class Customer extends CI_Controller{
    public function __construct(){
        parent::__construct();

    }
    private function req(){
        $this->load->view("req/head");
        $this->load->view("master/Customer/css/datatable-css");
        $this->load->view("master/Customer/css/breadcrumb-css");
        $this->load->view("master/Customer/css/modal-css");
        $this->load->view("master/Customer/css/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function index(){
        $this->req();
        $this->load->view("master/content-open");
        $this->load->view("master/Customer/category-header");
        $this->load->view("master/Customer/category-body");
        $this->load->view("master/content-close");
        $this->close();
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("master/Customer/js/jqtabledit-js");
        $this->load->view("master/Customer/js/page-datatable-js");
        $this->load->view("master/Customer/js/form-js");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
    public function detail(){
        $this->load->view("req/head");
        $this->load->view("detail/css/detail-css");
        $this->load->view("req/head-close");
        $this->load->view("detail/detail-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $this->load->view("detail/content-open");
        $this->load->view("detail/customer/profile");
        $this->load->view("detail/tab-open");
        $this->load->view("detail/customer/tab-item");
        $this->load->view("detail/customer/tab-content");
        $this->load->view("detail/tab-close");
        $this->load->view("detail/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("detail/js/detail-js");
        $this->load->view("detail/detail-close");
        $this->load->view("req/html-close");
    }
}
?>