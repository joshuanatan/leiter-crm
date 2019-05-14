<?php
class Request extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdprice_request");
        $this->load->model("Mdperusahaan");
        $this->load->model("Mdproduk");
        $this->load->model("Mdprice_request_item");
    }
    private function req(){
        $this->load->view("req/head");
        $this->load->view("crm/request/css/datatable-css");
        $this->load->view("crm/request/css/breadcrumb-css");
        $this->load->view("crm/request/css/modal-css");
        $this->load->view("crm/request/css/form-css");
        $this->load->view("req/head-close");
        $this->load->view("crm/crm-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function index(){
        $this->req();
        $where = array(
            "customer" => array(
                "peran_perusahaan" => "CUSTOMER",
                "status_perusahaan" => 0
            ),
            "produk" => array(
                "produk.status_produk" => 0
            ),
            "price_request" => array(
                "price_request.status_request" => 0
            )
        );
        $data = array(
            "request_id" => $this->Mdprice_request->maxId(),
            "customer" => $this->Mdperusahaan->select($where["customer"]),
            "produk" => $this->Mdproduk->select($where["produk"]),
            "request" => $this->Mdprice_request->select($where["price_request"])
        );
        $this->load->view("crm/content-open");
        $this->load->view("crm/request/category-header");
        $this->load->view("crm/request/category-body",$data);
        $this->load->view("crm/content-close");$this->load->view("req/script");
        $this->load->view("crm/request/js/jqtabledit-js");
        $this->load->view("crm/request/js/page-datatable-js");
        $this->load->view("crm/request/js/form-js");
        $this->load->view("crm/request/js/dynamic-form-js",$data);
        $this->load->view("crm/request/js/request-ajax");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("crm/request/js/jqtabledit-js");
        $this->load->view("crm/request/js/page-datatable-js");
        $this->load->view("crm/request/js/form-js");
        $this->load->view("crm/request/js/dynamic-form-js");
        $this->load->view("crm/request/js/request-ajax");
        $this->load->view("crm/crm-close");
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
        $this->load->view("detail/request/profile");
        $this->load->view("detail/tab-open");
        $this->load->view("detail/request/tab-item");
        $this->load->view("detail/request/tab-content");
        $this->load->view("detail/tab-close");
        $this->load->view("detail/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("detail/js/detail-js");
        $this->load->view("detail/detail-close");
        $this->load->view("req/html-close");
    }
    public function insert(){
        $name = array("id_request","tgl_dateline_request","id_perusahaan","id_cp","id_user_add");
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[0]),
            $name[3] => $this->input->post($name[3]),
            $name[4] => $this->session->id_user,
        );
        //$this->Mdprice_request->insert($data);
        $result = $this->input->post($name[0]);
        /* ------- insert barangnya --------- */
        $name = array("id_produk","jumlah_produk");
        $produk = array();
        $jumlah = array();
        /*tujuannya mau ngisi kedua array ini */
        $counts = 0;
        foreach($this->input->post("id_produk") as $b){
            $produk[$counts] = $b;
            $array[0][$counts] = $b;
            $counts++;
        }
        $counts = 0;
        foreach($this->input->post("jumlah_produk") as $b){
            $jumlah[$counts] = $b;
            $counts++;
        }
        for($a = 0; $a<count($produk); $a++){ /*berapa field yang mau dimasukin*/
            $data = array(
                "id_request" => $result,
                "id_produk" => $produk[$a],
                "jumlah_produk" => $jumlah[$a],
                "id_user_add" => $this->session->id_user
            );
            $this->Mdprice_request_item->insert($data);
        }
        redirect("crm/request");
    }
    public function items($i){
        $this->session->id_detail = $i;
        $where = array(
            "customer" => array(
                "peran_perusahaan" => "CUSTOMER",
                "status_perusahaan" => 0
            ),
            "produk" => array(
                "produk.status_produk" => 0
            ),
            "produkrequest" => array(
                "price_request_item.id_request" => $i,
                "status_request_item" => 0
            ),
            "price_request" => array(
                "price_request.status_request" => 0
            )
        );
        $data = array(
            "request_id" => $this->Mdprice_request->maxId(),
            "customer" => $this->Mdperusahaan->select($where["customer"]),
            "produk" => $this->Mdproduk->select($where["produk"]),
            "produkrequest" => $this->Mdprice_request_item->select($where["produkrequest"]),
            "request" => $this->Mdprice_request->select($where["price_request"])
        );

        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/request/category-header");
        $this->load->view("crm/request/detail-request",$data);
        $this->load->view("crm/content-close");
        $this->load->view("req/script");
        $this->load->view("crm/request/js/jqtabledit-js");
        $this->load->view("crm/request/js/page-datatable-js");
        $this->load->view("crm/request/js/form-js");
        $this->load->view("crm/request/js/dynamic-form-js",$data);
        $this->load->view("crm/request/js/request-ajax");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    public function delete($i){
        $where = array(
            "id_request_item" => $i
        );
        $data = array(
            "status_request_item" => 1
        );
        $this->Mdprice_request_item->update($data,$where);
        redirect("crm/request/items/".$this->session->id_detail);
    }
    public function remove($i){
        $where = array(
            "id_request" => $i
        );
        $data = array(
            "status_request" => 1
        );
        $this->Mdprice_request->update($data,$where);
        redirect("crm/request");
    }
}
?>