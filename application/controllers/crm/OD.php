<?php
class OD extends CI_Controller{
    public function __construct(){
        parent::__construct();  
        $this->load->model("Mdorder_confirmation");
        $this->load->model("Mdperusahaan");
        $this->load->model("Mdod_core");
        $this->load->model("Mdod_item");

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
        $where = array(
            "od" => array(
                "status_od" => 0
            )
        );
        $result = array(
            "od" => $this->Mdod_core->select($where["od"])
        );
        $counter = 0;
        foreach($result["od"]->result() as $a){
            $data["od"][$counter] = array(
                "no_od" => $a->no_od,
                "no_oc" => get1value("order_confirmation","no_oc", array("id_oc" => $a->id_oc)),
                "no_po_cusomter" => $a->no_po_customer,
                "nama_courier" => get1value("perusahaan","nama_perusahaan", array("id_perusahaan" => $a->id_courier)),
                "nama_perusahaan" =>  $a->nama_perusahaan,
                "franco" => get1value("price_request","franco",array("id_request" => $a->id_request)),
                "date_issued" => $a->date_od_add
            );
            $counter++;
        }
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/od/category-header");
        $this->load->view("crm/od/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("crm/od/js/request-ajax");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    public function create(){
        $where = array(
            "order_confirmation" => array(
                "status_oc" => 2,
            ),
            "courier" => array(
                "status_perusahaan" => 0,
                "peran_perusahaan" => "SHIPPING"
            )
        );
        $result["order_confirmation"] = $this->Mdorder_confirmation->select($where["order_confirmation"]);
        $result["courier"] = $this->Mdperusahaan->select($where["courier"]);
        $data["order_confirmation"] = $result["order_confirmation"]; 
        $data["courier"] = $result["courier"]; 
        $data["maxId"] = findMaxId("od_core","id_od",array());
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/od/category-header");
        $this->load->view("crm/od/add-od",$data);
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
        $this->load->view("detail/od/profile");
        $this->load->view("detail/tab-open");
        $this->load->view("detail/od/tab-item");
        $this->load->view("detail/od/tab-content");
        $this->load->view("detail/tab-close");
        $this->load->view("detail/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("detail/js/detail-js");
        $this->load->view("detail/detail-close");
        $this->load->view("req/html-close");
    }
    public function createod(){
        $input = array(
            "id_quotation_item" => $this->input->post("id_quotation_item"), 
            "jumlah_kirim" => $this->input->post("jumlah_kirim"), 
        );
        $array = array(
            "id_quotation_item" => array(),
            "jumlah_kirim" => array()
        );
        $counter = 0 ;
        foreach($input["id_quotation_item"] as $a){
            $array["id_quotation_item"][$counter] = $a;
            $counter++;
        }
        $counter = 0 ;
        foreach($input["jumlah_kirim"] as $a){
            $array["jumlah_kirim"][$counter] = $a;
            $counter++;
        }
        for($a = 0; $a<count($array["jumlah_kirim"]); $a++){
            $data = array(
                "id_od" => $this->input->post("id_od"),
                "id_quotation_item" => $array["id_quotation_item"][$a],
                "item_qty" => $array["jumlah_kirim"][$a]
            );
            $this->Mdod_item->insert($data);
        }
        /*end insert od item*/
        /*begin insert od core */
        $data = array(
            "id_od" => $this->input->post("id_od"),
            "no_od" => $this->input->post("no_od"),
            "id_oc" => $this->input->post("id_oc"),
            "id_courier" => $this->input->post("courier"),
            "delivery_method" => $this->input->post("method"),
            "id_user_add" => $this->session->id_user
        );
        $this->Mdod_core->insert($data);
        redirect("crm/od");
    }
}
?>