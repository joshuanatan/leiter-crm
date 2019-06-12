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
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
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
            ),
        );
        $result["request"] = $this->Mdprice_request->select($where["price_request"]);
        $counter = 0;
        $array["request"] = array();
        foreach($result["request"]->result() as $a){
            $array["request"][$counter] = array(
                "id_request" => $a->id_request,
                "tgl_dateline_request" => $a->tgl_dateline_request,
                "nama_perusahaan" => get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $a->id_perusahaan)),
                "nama_cp" => get1Value("contact_person","nama_cp",array("id_cp" => $a->id_cp)),
                "franco" => $a->franco,
                "quantity" => getAmount("price_request_item","id_produk",array("id_request" => $a->id_request,"status_request_item" => 0))
            );
            $counter++;
        }
        $data = array(
            "request_id" => $this->Mdprice_request->maxId(),
            "customer" => $this->Mdperusahaan->select($where["customer"]),
            "produk" => $this->Mdproduk->select($where["produk"]),
            "request" => $array["request"]
        );
        $this->load->view("crm/content-open");
        $this->load->view("crm/request/category-header");
        $this->load->view("crm/request/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
        $this->load->view("crm/request/js/dynamic-form-js",$data);
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("crm/request/js/request-ajax");
        $this->load->view("crm/crm-close");
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
        $stock = 1;
        if($this->input->post("requeststock") != ""){
            foreach($this->input->post("requeststock") as $a){
                $stock = 0;
                $data = array(
                    $name[0] => $this->input->post($name[0]),
                    $name[1] => $this->input->post($name[1]),
                    $name[2] => 0,
                    $name[3] => 0,
                    $name[4] => $this->session->id_user,
                    $name[5] => $this->input->post($name[5]),
                    "untuk_stock" => 0
                );
            }
        }
        if($stock == 1){
            $data = array(
                $name[0] => $this->input->post($name[0]),
                $name[1] => $this->input->post($name[1]),
                $name[2] => $this->input->post($name[2]),
                $name[3] => $this->input->post($name[3]),
                $name[4] => $this->session->id_user,
                $name[5] => $this->input->post($name[5]),
            );
        }
        $this->Mdprice_request->insert($data);
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
            "produk_request" => array(
                "price_request_item.id_request" => $i,
                "status_request_item" => 0
            ),
            "price_request" => array(
                "price_request.id_request" => $i
            ),
            "produk" => array(
                "status_produk" => 0
            ),
            "customer" => array(
                "peran_perusahaan" => "CUSTOMER",
                "status_perusahaan" => 0,
            ),
        );
        $result["product_request"] = $this->Mdprice_request_item->select($where["produk_request"]);
        $result["price_request"] = $this->Mdprice_request->select($where["price_request"]);

        $counter = 0 ;
        foreach($result["product_request"]->result() as $a){
            $array["produk_request"][$counter] = array(
                "id_request_item" => $a->id_request_item,
                "bn_produk" => get1Value("produk","bn_produk",array("id_produk" => $a->id_produk)),
                "nama_produk" => get1Value("produk","nama_produk",array("id_produk" => $a->id_produk)),
                "quantity" => getTotal("price_request_item","jumlah_produk",array("id_produk" => $a->id_produk,"id_request" => $a->id_request)), /*hitung semua barang yang sejenis dan satu id request*/
                "satuan" => get1Value("produk","satuan_produk", array("id_produk" => $a->id_produk))
            );
            $counter++;
        }
        foreach($result["price_request"]->result() as $a){
            $array["price_request"] = array(
                "id_request" => $a->id_request,
                "dateline_request" => $a->tgl_dateline_request,
                "franco"=> $a->franco,
                "nama_perusahaan" => get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $a->id_perusahaan)),
                "id_perusahaan" => $a->id_perusahaan,
                "nama_cp" => get1Value("contact_person","nama_cp", array("id_cp" => $a->id_cp)),
                "list_cp" => $this->Mdcontact_person->select(array("id_perusahaan" => $a->id_perusahaan)),
                "id_cp" => $a->id_cp
            );
        }
        $data = array(
            "request_id" => $this->Mdprice_request->maxId(),
            "produkrequest" => $array["produk_request"],
            "request" => $array["price_request"],
            "id_request" => $i,
            "produk" => $this->Mdproduk->select($where["produk"]),
            "customer" => $this->Mdperusahaan->select($where["customer"]),
        );

        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/request/category-header");
        $this->load->view("crm/request/detail-request",$data);
        $this->load->view("crm/content-close");
        $this->load->view("req/script");
        $this->close();
        $this->load->view("crm/request/js/dynamic-form-js",$data);
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
                $a->id_cp,
                $a->alamat_perusahaan,
                $a->franco
            );
        }
        $length = count($value);
        $where = array(
            "price_request.id_request" => $this->input->post("id_request"),
            "price_request_item.status_request_item" => 0
        );
        $result = $this->Mdprice_request_item->selectFullPrice($where);
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