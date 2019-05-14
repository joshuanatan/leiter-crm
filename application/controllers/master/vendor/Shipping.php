<?php
class Shipping extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdperusahaan");
        $this->load->model("Mdcontact_person");
        $this->load->model("Mdmetode_pengiriman_shipping");
    }
    private function req(){
        $this->load->view("req/head");
        $this->load->view("master/vendor-shipping/css/datatable-css");
        $this->load->view("master/vendor-shipping/css/breadcrumb-css");
        $this->load->view("master/vendor-shipping/css/modal-css");
        $this->load->view("master/vendor-shipping/css/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function index(){
        $where = array(
            "perusahaan" => array(
                "peran_perusahaan" => "SHIPPING"
            ),
        );
        $data = array(
            "perusahaan" => $this->Mdperusahaan->select($where["perusahaan"]),
        );
        $this->req();
        $this->load->view("master/content-open");
        $this->load->view("master/vendor-shipping/category-header");
        $this->load->view("master/vendor-shipping/category-body",$data);
        $this->load->view("master/content-close");
        $this->close();
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("master/vendor-shipping/js/jqtabledit-js");
        $this->load->view("master/vendor-shipping/js/page-datatable-js");
        $this->load->view("master/vendor-shipping/js/form-js");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
    public function register(){
        $name = array("nama_perusahaan","jenis_perusahaan","alamat_perusahaan","notelp_perusahaan");
        $nameCp = array("nama_cp","jk_cp","email_cp","nohp_cp","jabatan_cp");
        $delivery = array("delivery");
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => $this->input->post($name[3]),
            "peran_perusahaan" => "SHIPPING",
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
        $method = $this->input->post($delivery[0]);
        $metode = array("SEA","AIR","LAND");
        for($a = 0 ; $a<count($metode); $a++){
            $data = array(
                "id_perusahaan" => $result,
                "metode_pengiriman" => $metode[$a],
                "id_user_add" => $this->session->id_user
            );
            $this->Mdmetode_pengiriman_shipping->insert($data);
        }
        foreach($method as $a){
            $where = array(
                "id_perusahaan" => $result,
                "metode_pengiriman" => $a,
            );
            $data = array(
                "status_metode_pengiriman" => 0,
                "id_user_add" => $this->session->id_user
            );
            $this->Mdmetode_pengiriman_shipping->update($data,$where);
        }
        redirect("master/vendor/shipping");
    }
}
?>