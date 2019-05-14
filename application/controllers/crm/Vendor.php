<?php
class Vendor extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdprice_request");
        $this->load->model("Mdprice_request_item");
        $this->load->model("Mdproduk_vendor");
        $this->load->model("Mdharga_vendor");
        $this->load->model("Mdcontact_person");
    }
    private function req(){
        $this->load->view("req/head");
        $this->load->view("crm/vendor-deal/css/datatable-css");
        $this->load->view("crm/vendor-deal/css/breadcrumb-css");
        $this->load->view("crm/vendor-deal/css/modal-css");
        $this->load->view("crm/vendor-deal/css/form-css");
        $this->load->view("req/head-close");
        $this->load->view("crm/crm-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function index(){
        $where = array(
            "request" => array(
                "price_request.status_request" => 0
            )
        );
        $data = array(
            "request" => $this->Mdprice_request->select($where["request"])
        );
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/vendor-deal/category-header");
        $this->load->view("crm/vendor-deal/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("crm/vendor-deal/js/jqtabledit-js");
        $this->load->view("crm/vendor-deal/js/page-datatable-js");
        $this->load->view("crm/vendor-deal/js/form-js");
        $this->load->view("crm/vendor-deal/js/dynamic-form-js");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    public function produk($i){
        $where = array(
            "requestitem" => array(
                "price_request_item.id_request"=>$i,
                "price_request_item.status_request_item" => 0
            ),
            "vendoritem" => array(
                "status_produk_vendor" => 0,
            )
        );
        $data = array(
            "requestitem" => $this->Mdprice_request_item->select($where["requestitem"]),
            "vendoritem" => $this->Mdproduk_vendor->select($where["vendoritem"])
        );
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/vendor-deal/category-header");
        $this->load->view("crm/vendor-deal/product-vendor-price",$data);
        $this->load->view("crm/content-close");
        $this->close();
        $this->load->view("crm/vendor-deal/js/request-ajax");
    }
    public function getvendorprice(){
        $where = array(
            "price_request_item.id_request_item" => $this->input->post("id_request_item"),
        );
        $result = $this->Mdharga_vendor->selectPenawaran($where);
        $html = "";
        foreach($result->result() as $a){
            if($a->harga_produk == ""){
                $harga = 0;
            }
            else{
                $harga = $a->harga_produk;
            }
            if($a->satuan_harga_produk == ""){
                $satuan = 0;
            }
            else{
                $satuan = $a->satuan_harga_produk;
            }
            if($a->standar_minimal == ""){
                $minimal = 0;
            }
            else{
                $minimal = $a->standar_minimal;
            }
            $where2 = array(
                "id_perusahaan" => $a->id_perusahaan
            );
            $resultCp = $this->Mdcontact_person->select($where2);
            $cp = "";
            foreach($resultCp->result() as $optionCp){
                $cp .= "<option value = '".$optionCp->id_cp."'>".ucwords($optionCp->nama_cp)."</option>";
            }
            $html .= "<tr><input type ='hidden' value = '".$this->input->post("id_request_item")."' id = 'id_request_item'><td>".$a->nama_perusahaan."</td><td><select class = 'form-control' id = 'cp'>".$cp."</select></td><td>".$a->bn_produk_vendor."</td><td>".$a->nama_produk_vendor."</td><td><input type ='number' id = 'price' class = 'form-control' value = '".$harga."'></td><td><input type ='number' id = 'satuan' class = 'form-control' value = '".$satuan."'></td><td><input type ='number' id = 'minimum' class = 'form-control' value = '".$minimal."'></td><td><button type = 'submit' class = 'btn btn-sm btn-primary btn-outline' onclick = 'submitData()'>SAVE</button></td></tr>";
        }
        echo json_encode($html);
    }
    public function insertvendorprice(){
        $where = array(
            "id_request_item" =>$this->input->post("id_request_item"),
            "id_cp" => $this->input->post("idcp"),
        );
        $data = array(
            "status_harga_vendor" => 1
        );
        $this->Mdharga_vendor->delete($where);
        $data = array(
            "id_request_item" =>$this->input->post("id_request_item"),
            "id_cp" => $this->input->post("idcp"),
            "harga_produk" => $this->input->post("price"),
            "satuan_harga_produk" => $this->input->post("uom"),
            "standar_minimal" => $this->input->post("min"),
            "id_user_add" => $this->session->id_user
        );
        
        $this->Mdharga_vendor->insert($data);
    }
}
?>