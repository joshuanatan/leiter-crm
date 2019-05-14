<?php
class Product extends CI_Controller{
    public function __construct(){
        parent::__construct();
        
        $this->load->model("Mdproduk");
        $this->load->model("Mdsatuan");

    }
    private function req(){
        $this->load->view("req/head");
        $this->load->view("master/product/css/datatable-css");
        $this->load->view("master/product/css/breadcrumb-css");
        $this->load->view("master/product/css/modal-css");
        $this->load->view("master/product/css/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function index(){
        $where = array(
            "produk" => array(),
            "satuan" => array(),
        );
        $data = array(
            "produk" => $this->Mdproduk->select($where["produk"]),
            "satuan" => $this->Mdsatuan->select($where["satuan"])
        );
        $this->req();
        $this->load->view("master/content-open");
        $this->load->view("master/product/category-header");
        $this->load->view("master/product/category-body",$data);
        $this->load->view("master/content-close");
        $this->close();
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("master/product/js/jqtabledit-js");
        $this->load->view("master/product/js/page-datatable-js");
        $this->load->view("master/product/js/form-js");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
    public function insert(){
        $uom = "";
        if($this->input->post("satuan_produk_add") != ""){
            $data = array(
                "nama_satuan" => $this->input->post("satuan_produk_add"),
                "id_user_add" => $this->session->id_user
            );
            $this->Mdsatuan->insert($data);
            $uom = $this->input->post("satuan_produk_add");
        }
        else{
            $uom = $this->input->post("satuan_produk");
        }
        $name = array(
            "bn_produk","nama_produk","satuan_produk","deskripsi_produk"
        );
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $uom,
            $name[3] => $this->input->post($name[3]),
            "id_user_add" => $this->session->id_user
        );
        $this->Mdproduk->insert($data);
        redirect("master/product");
    }
    public function getuom(){
        $where = array(
            "id_produk" => $this->input->post("id_produk")
        );
        $result = $this->Mdproduk->select($where);
        foreach($result->result() as $a){
            echo json_encode(strtoupper($a->satuan_produk));
        }
    }
}
?>