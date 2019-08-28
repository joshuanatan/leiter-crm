<?php
class Welcome extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mduser");
        $this->load->model("Mdmenu");
        $this->load->model("Mddashboard");
    }
    public function index(){
        if($this->session->id_user == "") redirect("login/welcome");
        $year = date("Y");
        $field = array(
            "bulan_invoice","tahun_invoice","total"
        );
        $durasi = 3;
        $where = array();
        $result = $this->Mddashboard->getSalesMonthly($field,$where,$year,$durasi);
        $data["penghasilan"] = $result->result_array();
        $this->load->view("req/head");
        $this->load->view("plugin/chart-js/chart-js-css");
        $this->load->view("req/head-close");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $this->load->view("dashboard/main");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("req/html-close");
        $this->load->view("plugin/chart-js/chart-js-js");
        $this->load->view("welcome/js/chart-js",$data);
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
    public function register(){
        $name = array(
            "nama_user",
            "email_user",
            "nohp_user",
            "password"
        );
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => md5($this->input->post($name[3])),
            "id_user_add" => $this->session->id_user
        );
        $this->Mduser->insert($data);
        $this->session->res_msg = "Data Recorded";
        redirect("master/user/employee");
    }
}
?>