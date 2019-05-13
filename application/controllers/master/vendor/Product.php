<?php
class Product extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdperusahaan");
        $this->load->model("Mdsatuan");
        $this->load->model("Mdcontact_person");
        $this->load->model("Mdproduk_vendor");

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
        $where = array(
            "perusahaan" => array(
                "peran_perusahaan" => "PRODUK"
            ),
            "produk" => array(
                 
            ),
            "satuan" => array()
        );
        $data = array(
            "perusahaan" => $this->Mdperusahaan->select($where["perusahaan"]),
            "products" => $this->Mdproduk_vendor->select($where["produk"]),
            "satuan" => $this->Mdproduk_vendor->select($where["satuan"])
        );
        $this->load->view("master/content-open");
        $this->load->view("master/vendor-product/category-header");
        $this->load->view("master/vendor-product/category-body",$data);
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
    public function register(){
        $name = array("nama_perusahaan","jenis_perusahaan","alamat_perusahaan","notelp_perusahaan");
        $nameCp = array("nama_cp","jk_cp","email_cp","nohp_cp","jabatan_cp");
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => $this->input->post($name[3]),
            "peran_perusahaan" => "PRODUK",
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
        redirect("master/vendor/product");
    }
}
?>