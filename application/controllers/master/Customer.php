<?php
class Customer extends CI_Controller{
    public function __construct(){
        parent::__construct();  
        $this->load->model("Mdperusahaan");
        $this->load->model("Mdcontact_person");

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
        $where = array(
            "perusahaan" => array(
                "peran_perusahaan" => "CUSTOMER"
            )
        );
        $data = array(
            "perusahaan" => $this->Mdperusahaan->select($where["perusahaan"])
        );
        $this->load->view("master/Customer/category-body",$data);
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
    public function register(){
        $name = array("nama_perusahaan","jenis_perusahaan","alamat_perusahaan","notelp_perusahaan");
        $nameCp = array("nama_cp","jk_cp","email_cp","nohp_cp","jabatan_cp");
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => $this->input->post($name[3]),
            "peran_perusahaan" => "CUSTOMER",
            "id_user_add" => $this->session->id_user
        );
        $result = $this->Mdperusahaan->insert($data);
        $data = array(
            $nameCp[0] => $this->input->post($nameCp[0]),
            $nameCp[1] => $this->input->post($nameCp[1]),
            $nameCp[2] => $this->input->post($nameCp[2]),
            $nameCp[3] => $this->input->post($nameCp[3]),
            $nameCp[4] => $this->input->post($nameCp[4]),
            "id_perusahaan" => $result,
            "id_user_add" => $this->session->id_user
        );
        $this->Mdcontact_person->insert($data);
        redirect("master/customer");
    }
}
?>