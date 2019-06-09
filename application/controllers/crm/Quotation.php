<?php
class Quotation extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdquotation");
        $this->load->model("Mdprice_request");
        $this->load->model("Mdquotation_item");
        $this->load->model("Mdmetode_pembayaran");
    }
    /*default function*/
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
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/jqtabledit/jqtabledit-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("crm/quotation/js/dynamic-form-js");
        $this->load->view("crm/quotation/js/request-ajax");
        $this->load->view("crm/quotation/js/payment-script");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    /*page*/
    public function index(){
        $this->req();
        $where = array(
            "quotation" => array(
                //"status_quo" => 0  
            ),
            "price_request" => array(
                "price_request.status_request" => 3
            )
        );
        $data = array(
            "quotation_id" => $this->Mdquotation->maxId(),
            "quotation" => $this->Mdquotation->select($where["quotation"]),
            "request" => $this->Mdprice_request->select($where["price_request"])
        );
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
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
        $this->load->view("detail/quotation/profile");
        $this->load->view("detail/tab-open");
        $this->load->view("detail/quotation/tab-item");
        $this->load->view("detail/quotation/tab-content");
        $this->load->view("detail/tab-close");
        $this->load->view("detail/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("detail/js/detail-js");
        $this->load->view("detail/detail-close");
        $this->load->view("req/html-close");
    }
    public function edit($i){
        $this->req();
        $where = array(
            "quotation" => array(
                "quotation.id_quo" => $i 
            ),
            "price_request" => array(
                "price_request.status_request" => 0
            ),
            "last_version" => array(
                "quotation.id_quo" => $i
            ),
        );
        $data = array(
            "quotation_id" => $this->Mdquotation->maxId(),
            "last_version" => $this->Mdquotation->maxVersion($where["last_version"]),
            "quotation" => $this->Mdquotation->select($where["quotation"]),
            "request" => $this->Mdprice_request->select($where["price_request"])
        );
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/edit-quotation",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function editUi(){
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/edit-quotation");
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function create(){
        $this->req();
        $where = array(
            "quotation" => array(
                "status_quo" => 0  
            ),
            "price_request" => array(
                "price_request.status_request" => 3,
                "status_buatquo" => 1,
                "untuk_stock" => 1
            ),
        );
        $data = array(
            "quotation_id" => $this->Mdquotation->maxId(),
            "quotation" => $this->Mdquotation->select($where["quotation"]),
            "request" => $this->Mdprice_request->select($where["price_request"]),
        );
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/add-quotation",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    
    /*function*/
    public function insertquotation(){
        $name = array("id_quo","versi_quo","id_request","no_quo","hal_quo","id_cp","up_cp","durasi_pengiriman","franco","durasi_pembayaran","mata_uang_pembayaran","dateline_quo","id_user_add");
        $data = array();
        for($a=0; $a<count($name)-1; $a++){
            $data += [$name[$a] => $this->input->post($name[$a])];
        }
        $data += ["id_user_add" => $this->session->id_user];
        $this->Mdquotation->insert($data);
        
        /*---- Metode Pembayaran ----*/

        $method = $this->input->post("paymentMethod");
        //$methodDetail = explode("",$method);

        $persen = $this->input->post("persen");
        $persenDetail = array();
        $b=0;
        foreach($persen as $a){
            $persenDetail[$b] = $a;
            $b++;
        }

        $jumlah = $this->input->post("jumlah");
        $jumlahDetail = array();
        $b = 0;
        foreach($jumlah as $a){
            $jumlahDetail[$b] = $a;
            $b++;
        }

        $kurs = $this->input->post("mata_uang_pembayaran");

        for($a = 0; $a<count($jumlahDetail);$a++){
            $data = array(
                "urutan_pembayaran" => $a+1,
                "persentase_pembayaran" => $persenDetail[$a],
                "nominal_pembayaran" => $jumlahDetail[$a],
                "trigger_pembayaran" => $method[$a],
                "id_quotation" => $this->input->post("id_quo"),
                "id_versi" => $this->input->post("versi_quo"),
                "kurs" => $kurs
            );
            $this->Mdmetode_pembayaran->insert($data);
        }
        /*update status buat quotation di price request supaya gabisa dibuat ulang yang udah pernah dibuat*/
        $where = array(
            "id_request" => $this->input->post("id_quo")
        );
        $data = array(
            "status_buatquo" => 0
        );
        $this->Mdquotation->update($data,$where);
        redirect("crm/quotation");
    }
    public function loss($id,$ver){
        $data = array(
            "status_quo" => 1
        );
        $where = array(
            "versi_quo" => $ver,
            "id_quo" => $id
        );
        $this->Mdquotation->update($data,$where);
        redirect("crm/quotation");
    }
    public function accepted($id,$ver){
        $data = array(
            "status_quo" => 2
        );
        $where = array(
            "versi_quo" => $ver,
            "id_quo" => $id
        );
        $this->Mdquotation->update($data,$where);
        redirect("crm/quotation");
        
    }

    /*ajax*/
    public function addItemToQuotation(){
        $name = array("id_quotation","quo_version","id_request_item","item_amount","selling_price","margin_price","id_cp_shipper","id_cp_vendor","id_cp_courier","metode_shipping","metode_courier");
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => $this->input->post($name[3]),
            $name[4] => $this->input->post($name[4]),
            $name[5] => $this->input->post($name[5]),
            $name[6] => $this->input->post($name[6]),
            $name[7] => $this->input->post($name[7]),
            $name[8] => $this->input->post($name[8]),
            $name[9] => $this->input->post($name[9]),
            $name[10] => $this->input->post($name[10]),
        );
        echo $this->input->post($name[5]);
        $this->Mdquotation_item->insert($data);
    }
    public function getQuotationItem(){
        $name = array("id_quotation","quo_version","id_request_item","item_amount","selling_price","margin_price");
        $where = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
        );  
        $result = $this->Mdquotation_item->select($where);
        $html = "";
        foreach($result->result() as $a){
            $html .= "<tr><td>".$a->id_request_item."</td><td>".$a->nama_produk."</td><td>".$a->item_amount."</td><td>".number_format($a->selling_price)."</td><td>".number_format($a->margin_price,2)."%</td><td><button type = 'button' class = 'btn btn-danger btn-outline btn-sm' onclick = 'removeQuotationItem(".$a->id_quotation_item.")' >REMOVE</button></td></tr>";
        }
        echo json_encode($html);
    }
    public function removeQuotationitem(){
        $where = array(
            "id_quotation_item" => $this->input->post("id_quotation_item")
        );
        $this->Mdquotation_item->delete($where);
    }
    public function countTotalQuotationPrice(){
        $where = array(
            "id_quotation" => $this->input->post("id_quotation"),
            "quo_version" => $this->input->post("quo_version"),
        );
        $result = $this->Mdquotation_item->countAllPrice($where);
        foreach($result->result() as $a){
            echo json_encode($a->totalTagihan);
        }
    }
    public function getQuotationDetail(){
        //echo $this->input->post("id_quo"); echo $this->input->post("versi_quo");
        $where = array(
            "id_quo" => $this->input->post("id_quo"),
            "versi_quo" => $this->input->post("versi_quo")
        );
        $result = $this->Mdquotation->select($where);
        $data = array();
        foreach($result->result() as $a){   
            $data = array(
                "no_quo" => strtoupper($a->no_quo),
                "id_quo" => $a->id_quo,
                "versi_quo" => $a->versi_quo,
                "nama_perusahaan" => strtoupper($a->nama_perusahaan),
                "nama_cp" => ucwords($a->nama_cp),
                "id_cp" => $a->id_cp,
                "alamat_perusahaan" => $a->alamat_perusahaan,
                "up_cp" => $a->up_cp,
                "durasi_pengiriman" => $a->durasi_pengiriman,
                "durasi_pembayaran" => $a->durasi_pembayaran,
                "metode_courier" => $a->metode_courier,
                "franco" => $a->franco,
            );
        }
        echo json_encode($data);
    }
    public function getOrderedItem(){
        $where = array(
            "id_quotation" => $this->input->post("id_quo"),
            "quo_version" => $this->input->post("versi_quo")
        );  
        $result = $this->Mdquotation_item->select($where);
        $data = array();
        $b = 0;
        foreach($result->result() as $a){
            $data[$b] = array(
                "id_quotation_item" => $a->id_quotation_item,
                "nama_produk" => $a->nama_produk,
                "item_amount" => $a->item_amount,
                "selling_price" => number_format($a->selling_price),
                "status_oc_item" => $a->status_oc_item
            );
            $b++;
        }
        echo json_encode($data);
    }
    public function getMetodePembayaran(){
        $where = array(
            "id_quotation" => $this->input->post("id_quotation"),
            "id_versi" => $this->input->post("id_versi")
        );
        $result = $this->Mdmetode_pembayaran->select($where);
        $data = array();
        $b = 0;
        foreach($result->result() as $a){
            $text = "";
            switch($a->trigger_pembayaran){
                case 1: $text = "SEBELUM BARANG DIKIRIMKAN";
                break;
                case 2: $text = "SESUDAH BARANG DIKIRIMKAN";
                break;
            }
            $data[$b] = array(
                "urutan_pembayaran" => $a->urutan_pembayaran,
                "persentase_pembayaran" => $a->persentase_pembayaran,
                "nominal_pembayaran" => number_format($a->nominal_pembayaran),
                "trigger_pembayaran" => $text,
                "kurs" => $a->kurs
            );
            $b++;
        }
        echo json_encode($data);

    }
}
?>