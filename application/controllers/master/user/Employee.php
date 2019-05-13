<?php
class Employee extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mduser");
        $this->load->model("Mdmenu");
    }
    public function index(){
        $this->load->view("req/head");
        $this->load->view("master/employee/css/datatable-css");
        $this->load->view("master/employee/css/breadcrumb-css");
        $this->load->view("master/employee/css/modal-css");
        $this->load->view("master/employee/css/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $where = array(
            "employee" => array(),
            "menu" => array()
        );
        $data = array(
            "employee" => $this->Mduser->select($where["employee"]),
            "menu" => $this->Mdmenu->select($where["menu"])
        );
        $this->load->view("master/content-open");
        $this->load->view("master/employee/category-header");
        $this->load->view("master/employee/category-body",$data);
        $this->load->view("master/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("master/employee/js/jqtabledit-js");
        $this->load->view("master/employee/js/page-datatable-js");
        $this->load->view("master/employee/js/form-js");
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
        $this->load->view("detail/employee/profile");
        $this->load->view("detail/tab-open");
        $this->load->view("detail/employee/tab-item");
        $this->load->view("detail/employee/tab-content");
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