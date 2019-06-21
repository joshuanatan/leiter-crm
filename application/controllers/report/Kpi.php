<?php
class Kpi extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function req(){
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("plugin/chart-widget/chart-widget-css");
        $this->load->view("plugin/chart-js/chart-js-css");
        $this->load->view("req/head-close");
        $this->load->view("report/report-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        //$this->load->view("plugin/chart-widget/chart-widget-js");
        $this->load->view("plugin/chart-js/chart-js-js");
        $this->load->view("report/kpi/js/chart-js");
        $this->load->view("report/report-close");
        $this->load->view("req/html-close"); 
    }
    public function index(){
        $this->req();
        $this->load->view("report/content-open");
        $this->load->view("report/kpi/category-header");
        $this->load->view("report/kpi/category-body");
        $this->load->view("report/content-close");
        $this->close();
    }
    public function weekly($i){
        $this->req();
        $this->load->view("report/content-open");
        $this->load->view("report/kpi/category-header");
        $this->load->view("report/kpi/weekly-report");
        $this->load->view("report/content-close");
        $this->close();
    }
}