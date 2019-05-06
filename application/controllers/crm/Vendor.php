<?php
class Vendor extends CI_Controller{
    public function __construct(){
        parent::__construct();

    }
    private function req(){
        $this->load->view("req/head");
        $this->load->view("crm/vendor-deal/css/datatable-css");
        $this->load->view("crm/vendor-deal/css/breadcrumb-css");
        $this->load->view("crm/vendor-deal/css/modal-css");
        $this->load->view("crm/vendor-deal/css/form-css");
        $this->load->view("req/head-close");
        $this->load->view("crm/crm-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function index(){
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/vendor-deal/category-header");
        $this->load->view("crm/vendor-deal/category-body");
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("crm/vendor-deal/js/jqtabledit-js");
        $this->load->view("crm/vendor-deal/js/page-datatable-js");
        $this->load->view("crm/vendor-deal/js/form-js");
        $this->load->view("crm/crm-close");
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
        $this->load->view("detail/vendor/profile");
        $this->load->view("detail/tab-open");
        $this->load->view("detail/vendor/tab-item");
        $this->load->view("detail/vendor/tab-content");
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