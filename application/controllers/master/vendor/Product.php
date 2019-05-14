<?php
class Product extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdperusahaan");
        $this->load->model("Mdsatuan");
        $this->load->model("Mdcontact_person");
        $this->load->model("Mdproduk_vendor");
        $this->load->model("Mdproduk");

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
        );
        $data = array(
            "perusahaan" => $this->Mdperusahaan->select($where["perusahaan"]),
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
    public function items($i){
        $where = array(
            "items" => array(
                "perusahaan.id_perusahaan" => $i
            ),
            "catalog" => array(),
            "satuan" => array(),
            "perusahaan" => array(
                "perusahaan.id_perusahaan" => $i
            )
        );
        $data = array(
            "product" => $this->Mdproduk_vendor->select($where["items"]), /*catalog vendor*/
            "catalog" => $this->Mdproduk->select($where["catalog"]), /*buat di form input, catalog vendor tersebut = barang apa */
            "satuan" => $this->Mdsatuan->select($where["satuan"]), /*satuan dari vendor produk */
            "perusahaan" => $this->Mdperusahaan->select($where["perusahaan"]), /*detail perusahaan, diload di category-header*/
        );    
        $this->load->view("req/head");
        $this->load->view("master/vendor-product-item/css/datatable-css");
        $this->load->view("master/vendor-product-item/css/breadcrumb-css");
        $this->load->view("master/vendor-product-item/css/modal-css");
        $this->load->view("master/vendor-product-item/css/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /* ------------------------------------------------ */
        $this->load->view("master/content-open");
        $this->load->view("master/vendor-product-item/category-header",$data);
        $this->load->view("master/vendor-product-item/category-body",$data);
        $this->load->view("master/content-close");
        /* ------------------------------------------------ */
        $this->load->view("req/script");
        $this->load->view("master/vendor-product-item/js/jqtabledit-js");
        $this->load->view("master/vendor-product-item/js/page-datatable-js");
        $this->load->view("master/vendor-product-item/js/form-js");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
    public function registeritem(){
        $uom = "";
        if($this->input->post("satuan_produk_vendor_add") != ""){
            $data = array(
                "nama_satuan" => $this->input->post("satuan_produk_vendor_add"),
                "id_user_add" => $this->session->id_user
            );
            $this->Mdsatuan->insert($data);
            $uom = $this->input->post("satuan_produk_vendor_add");
        }
        else{
            $uom = $this->input->post("satuan_produk_vendor");
        }
        $name = array(
            "bn_produk_vendor","nama_produk_vendor","satuan_produk_vendor","deskripsi_produk_vendor","id_produk","id_perusahaan"
        );
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $uom,
            $name[3] => $this->input->post($name[3]),
            $name[4] => $this->input->post($name[4]),
            $name[5] => $this->input->post($name[5]),
            
            "id_user_add" => $this->session->id_user
        );
        $this->Mdproduk_vendor->insert($data);
        redirect("master/vendor/product/items/".$this->input->post($name[5]));
    }
}
?>