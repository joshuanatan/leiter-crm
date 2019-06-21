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
    /*page*/
    public function contact($i){
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /* ------------------------------------------------ */
        $where = array(
            "contact_person.id_perusahaan" => $i,
            "contact_person.status_cp" => 0
        );
        $data = array(
            "cp" => $this->Mdcontact_person->select($where),
            "id_perusahaan" => $i
        );
        $this->load->view("master/content-open");
        $this->load->view("master/vendor-product/category-header",$data);
        $this->load->view("master/vendor-product/contact-vendor-product",$data);
        $this->load->view("master/content-close");
        /* ------------------------------------------------ */
        $this->load->view("req/script");
        $this->load->view("plugin/jqtabledit/jqtabledit-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("master/vendor-product-item/js/ajax-request");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
    public function index(){
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /* ------------------------------------------------ */
        $where = array(
            "perusahaan" => array(
                "peran_perusahaan" => "PRODUK",
                "perusahaan.status_perusahaan" => 0
            ),
        );
        $data = array(
            "perusahaan" => $this->Mdperusahaan->select($where["perusahaan"]),
        );
        $this->load->view("master/content-open");
        $this->load->view("master/vendor-product/category-header");
        $this->load->view("master/vendor-product/category-body",$data);
        $this->load->view("master/content-close");
        /* ------------------------------------------------ */
        $this->load->view("req/script");
        $this->load->view("plugin/jqtabledit/jqtabledit-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
    public function items($i){
        $this->session->id_supplier = $i;
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /* ------------------------------------------------ */
        $where = array(
            "items" => array(
                "perusahaan.id_perusahaan" => $i
            ),
            "catalog" => array(
                //"status_produk_vendor" => 0
                "status_produk" => 0
            ),
            "satuan" => array(
                "status_satuan" => 0
            ),
            "perusahaan" => array(
                "perusahaan.id_perusahaan" => $i
            )
        );
        $data = array(
            "product" => $this->Mdproduk_vendor->select($where["items"]), /*catalog vendor*/
            "catalog" => $this->Mdproduk->produk_vendor($where["catalog"]), /*buat di form input, catalog vendor tersebut = barang apa */
            "satuan" => $this->Mdsatuan->select($where["satuan"]), /*satuan dari vendor produk */
            "perusahaan" => $this->Mdperusahaan->select($where["perusahaan"]), /*detail perusahaan, diload di category-header*/
            "id_perusahaan" => $i
        );  
        $this->load->view("master/content-open");
        $this->load->view("master/vendor-product-item/category-header",$data);
        $this->load->view("master/vendor-product-item/category-body",$data);
        $this->load->view("master/content-close");
        /* ------------------------------------------------ */
        $this->load->view("req/script");
        $this->load->view("plugin/jqtabledit/jqtabledit-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("master/vendor-product-item/js/ajax-request");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
    public function edit($i){
        
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $where = array(
            "perusahaan.id_perusahaan" => $i
        );
        $data = array(
            "perusahaan" => $this->Mdperusahaan->select($where)
        );  
        $this->load->view("master/content-open");
        $this->load->view("master/vendor-product/category-header");
        $this->load->view("master/vendor-product/edit-vendor-product",$data);
        $this->load->view("master/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("plugin/jqtabledit/jqtabledit-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }

    /*functions*/
    public function registeritem(){
        /*register product first*/
        $uom = "";
        if($this->input->post("satuan_produk_new") != ""){
            $data = array(
                "nama_satuan" => $this->input->post("satuan_produk_new"),
                "id_user_add" => $this->session->id_user
            );
            $this->Mdsatuan->insert($data);
            $uom = $this->input->post("satuan_produk_new");
        }
        else{
            $uom = $this->input->post("satuan_produk");
        }
        if($this->input->post("id_produk" == 0)){
            $data = array(
                "bn_produk" => $this->input->post("bn_produk"),
                "nama_produk" => "-",
                "bn_produk" => $uom,
                "deskripsi_produk" => $this->input->post("deskripsi_produk"),
                "id_user_add" => $this->session->id_user,
            );
            $last_id = $this->Mdproduk->insert($data);
        }
        else{
            $last_id = $this->input->post("id_produk");
        }
        /*end insert data, dapet last_id*/
        if($this->input->post("satuan_produk_new_vendor") != ""){
            $data = array(
                "nama_satuan" => strtoupper($this->input->post("satuan_produk_new_vendor")),
                "id_user_add" => $this->session->id_user
            );
            $this->Mdsatuan->insert($data);
            $uom = strtoupper($this->input->post("satuan_produk_new_vendor"));
        }
        else{
            $uom = $this->input->post("satuan_produk_vendor");
        }
        $name = array(
            "bn_produk_vendor","nama_produk_vendor","satuan_produk_vendor","id_produk","deskripsi_produk_vendor","id_perusahaan"
        );
        $data = array(
            "bn_produk_vendor" => $this->input->post("bn_produk_vendor"),
            "nama_produk_vendor" => "-",
            "satuan_produk_vendor" => $uom,
            "id_produk" => $last_id,
            "deskripsi_produk_vendor" => $this->input->post("deskripsi_produk_vendor"),
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            
            "id_user_add" => $this->session->id_user
        );
        $this->Mdproduk_vendor->insert($data);
        redirect("master/vendor/product/items/".$this->input->post($name[5]));
    }
    public function deleteitem($i){
        $where = array(
            "id_produk_vendor" => $i
        );
        $this->Mdproduk_vendor->delete($where);
        redirect("master/vendor/product/items/".$this->session->id_supplier);
    }
    public function delete($i){
        
        $where = array(
            "perusahaan.id_perusahaan" => $i
        );
        $data = array(
            "status_perusahaan" => 1,
            "id_user_delete" => $this->session->id_user
        );
        $this->Mdperusahaan->update($data,$where);
        redirect("master/vendor/product");
    }
    public function editvendor(){
        $where = array(
            "perusahaan.id_perusahaan" => $this->input->post("id_perusahaan")
        );
        $data = array(
            "nama_perusahaan" => $this->input->post("nama_perusahaan"),
            "jenis_perusahaan" => $this->input->post("jenis_perusahaan"),
            "alamat_perusahaan" => $this->input->post("alamat_perusahaan"),
            "notelp_perusahaan" => $this->input->post("notelp_perusahaan"),
            "id_user_edit" => $this->session->id_user
        );
        $this->Mdperusahaan->update($data,$where);
        redirect("master/vendor/product/edit/".$this->input->post("id_perusahaan"));
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
    public function removecp($i,$page){
        
        $data = array(
            "status_cp" => 1,
            "id_user_delete" => $this->session->id_user
        );
        $where = array(
            "id_cp" => $i
        );  
        $this->Mdcontact_person->update($data,$where);
        redirect("master/vendor/product/contact/".$page);
    }
    public function editcp(){
        $nameCp = array("nama_cp","jk_cp","email_cp","nohp_cp","jabatan_cp","id_perusahaan","id_cp");
        $where = array(
            "id_cp" => $this->input->post($nameCp[6])
        );
        $data = array(
            $nameCp[0] => $this->input->post($nameCp[0]),
            $nameCp[1] => $this->input->post($nameCp[1]),
            $nameCp[2] => $this->input->post($nameCp[2]),
            $nameCp[3] => $this->input->post($nameCp[3]),
            $nameCp[4] => $this->input->post($nameCp[4]),
            $nameCp[5] => $this->input->post($nameCp[5]),
            "id_user_edit" => $this->session->id_user
        );
        $this->Mdcontact_person->update($data,$where);
        redirect("master/vendor/product/contact/".$this->input->post($nameCp[5]));
    }
    public function registercp(){
        $nameCp = array("nama_cp","jk_cp","email_cp","nohp_cp","jabatan_cp","id_perusahaan");
        $data = array(
            $nameCp[0] => $this->input->post($nameCp[0]),
            $nameCp[1] => $this->input->post($nameCp[1]),
            $nameCp[2] => $this->input->post($nameCp[2]),
            $nameCp[3] => $this->input->post($nameCp[3]),
            $nameCp[4] => $this->input->post($nameCp[4]),
            $nameCp[5] => $this->input->post($nameCp[5]),
            "id_user_add" => $this->session->id_user
        );
        $this->Mdcontact_person->insert($data);
        redirect("master/vendor/product/contact/".$this->input->post($nameCp[5]));
    }
    public function updateitem($id_produk_vendor){
        $where = array(
            "id_produk_vendor" => $id_produk_vendor
        );
        $uom = "";
        /*end insert data, dapet last_id*/
        if($this->input->post("satuan_produk_new_vendor") != ""){
            $data = array(
                "nama_satuan" => strtoupper($this->input->post("satuan_produk_new_vendor")),
                "id_user_add" => $this->session->id_user
            );
            $this->Mdsatuan->insert($data);
            $uom = strtoupper($this->input->post("satuan_produk_new_vendor"));
        }
        else{
            $uom = $this->input->post("satuan_produk_vendor");
        }
        $name = array(
            "bn_produk_vendor","nama_produk_vendor","satuan_produk_vendor","deskripsi_produk_vendor"
        );
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $uom,
            $name[3] => $this->input->post($name[3]),
            
            "id_user_add" => $this->session->id_user
        );
        $this->Mdproduk_vendor->update($data,$where);
        redirect("master/vendor/product/items/".$this->input->post("id_perusahaan"));
    }
}
?>