<?php
class Request extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdprice_request");
        $this->load->model("Mdperusahaan");
        $this->load->model("Mdproduk");
        $this->load->model("Mdprice_request_item"); 
        $this->load->model("Mdcontact_person"); 
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
                "price_request.status_request" => 0,
                "price_request_item.status_request_item" => 0
            ),
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
    public function insertitems($result){
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
        redirect("crm/request/items/".$result);
    }
    public function insert(){
        $name = array("id_request","tgl_dateline_request","id_perusahaan","id_cp","id_user_add","franco");
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => $this->input->post($name[3]),
            $name[4] => $this->session->id_user,
            $name[5] => $this->input->post($name[5]),

        );
        $this->Mdprice_request->insert($data);
        echo 
        $result = $this->input->post($name[0]);
        echo "hello";
        /* ------- insert barangnya --------- */$name = array("id_produk","jumlah_produk");
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
            "produkrequest" => array(
                "price_request_item.id_request" => $i,
                "status_request_item" => 0
            ),
            "priceRequest" => array(
                "price_request.id_request" => $i
            ),
            "produk" => array(
                "status_produk" => 0
            ),
            "customer" => array(
                "peran_perusahaan" => "CUSTOMER",
                "status_perusahaan" => 0,
            ),
            "contactPerson" => array(
                "id_request" => $i
            )
        );
        $data = array(
            "request_id" => $this->Mdprice_request->maxId(),
            "produkrequest" => $this->Mdprice_request_item->select($where["produkrequest"]),
            "request" => $this->Mdprice_request->select($where["priceRequest"]),
            "id_request" => $i,
            "produk" => $this->Mdproduk->select($where["produk"]),
            "customer" => $this->Mdperusahaan->select($where["customer"]),
            "contactPerson" => $this->Mdcontact_person->selectRequestCp($where["contactPerson"])
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
    public function getRequestDetail(){
        $where = array(
            "price_request.id_request" => $this->input->post("id_request")
        );
        $result = $this->Mdprice_request->select($where);
        $value = array();
        foreach($result->result() as $a){
            $value = array(
                strtoupper($a->nama_perusahaan),
                ucwords($a->nama_cp),
                $a->id_cp
            );
        }
        $length = count($value);
        $where = array(
            "price_request.id_request" => $this->input->post("id_request"),
            "price_request_item.status_request_item" => 0
        );
        $result = $this->Mdprice_request_item->select($where);
        $count = 0;
        foreach($result->result() as $a){
            $value[$length][$count] = $a->id_request_item;
            $value[$length+1][$count] = ucwords($a->nama_produk);
            $count++;
        }
        echo json_encode($value);
    }
    public function getAmountOrders(){
        $where = array(
            "id_request_item" => $this->input->post("id_request_item")
        );
        $result = $this->Mdprice_request_item->select($where);
        foreach($result->result() as $a){
            echo json_encode($a->jumlah_produk);
        }
    }
    public function submitedit(){
        $name = array(
            "id_request","tgl_dateline_request","id_perusahaan","id_cp","franco"
        );
        $where = array(
            $name[0] => $this->input->post($name[0]),
        );
        $data = array(
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => $this->input->post($name[3]),
            $name[4] => $this->input->post($name[4]),
            "id_user_edit" => $this->session->id_user,
            "date_request_edit" => date("Y-m-d H:i:s")
        );
        $this->Mdprice_request->update($data,$where);
        redirect("crm/request/items/".$this->input->post($name[0]));
    }
    public function submit($i){
        $where = array(
            "id_request" => $i
        );
        $data = array(
            "status_request" => 2
        );
        $this->Mdprice_request->update($data,$where);
        redirect("crm/request");
    }
}
?>