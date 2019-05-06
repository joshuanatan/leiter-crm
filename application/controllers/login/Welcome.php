<?php
class Welcome extends CI_Controller{
    public function __construct(){
        parent::__construct();

    }
    public function index(){
        $this->load->view("req/head");
        $this->load->view("req/head-close");
        $this->load->view("login/login-open");
        $this->load->view("login/main-logo");
        $this->load->view("login/main-form");
        //$this->load->view("req/footer");
        $this->load->view("login/login-close");
        $this->load->view("req/script");
        $this->load->view("login/js/page-js");
        $this->load->view("req/html-close");
        
    }
}

?>