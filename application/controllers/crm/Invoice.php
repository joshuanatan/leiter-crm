<?php
class Invoice extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdinvoice_core");
        $this->load->model("Mdorder_confirmation");
        $this->load->model("Mdmetode_pembayaran");
        $this->load->model("Mdinvoice_core");
        $this->load->model("Mdod_core");
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
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("crm/invoice/js/request-ajax");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    public function index(){
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/invoice/category-header");
        $this->load->view("crm/invoice/category-body");
        $this->load->view("crm/content-close");
        $this->close();
    }
    
    public function create(){
        $where = array(
            "oc" => array(
                /*tampilin semua, tapi kalau udah kedelete, jangan*/
            )   
        );
        $result["oc"] =$this->Mdorder_confirmation->select($where["oc"]);
        $counter = 0 ;
        foreach($result["oc"]->result() as $a){
            $array["oc"][$counter] = array(
                "id_oc" => $a->id_oc,
                "no_oc" => $a->no_oc,
                "id_quotation" => $a->id_quotation,
                "versi_quotation" => $a->versi_quotation,
                "no_po_customer" => $a->no_po_customer,
                "date_issued" => $a->date_oc_add
            );
            $counter++;
        }
        $data = array(
            "maxId" => findMaxId("invoice_core","id_invoice",array()),
            "oc" => $array["oc"]
        );
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/invoice/category-header");
        $this->load->view("crm/invoice/add-invoice",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function getMetodePembayaran(){
        $where = array(
            "id_oc" => $this->input->post("id_oc")
        );
        $result = $this->Mdmetode_pembayaran->select($where);
        $count = 0;
        foreach($result->result() as $a){
            $array[$count] = array(
                "id_metode_pembayaran" => $a->id_metode_pembayaran,
                "persentase" => $a->persentase_pembayaran,
                "nominal" => $a->nominal_pembayaran,
                "trigger_pembayaran" => $a->trigger_pembayaran
            );
            $count++;
        }
        echo json_encode($array);
    }
    public function getDetailMetodePembayaran(){
        $where = array(
            "id_metode_pembayaran" => $this->input->post("id_metode_pembayaran")
        );
        $result = $this->Mdmetode_pembayaran->select($where);
        $data = array();
        foreach($result->result() as $a){
            $data = array(
                "persentase" => $a->persentase_pembayaran,
                "nominal" => $a->nominal_pembayaran,
                "trigger_pembayaran" => $a->trigger_pembayaran
            );
        }
        echo json_encode($data);
    }
    public function getPaymentWithOd(){
        $where = array(
            "invoice_core.id_oc" => $this->input->post("id_oc"),
            "invoice_core.use_od" => $this->input->post("use_od")
        );
        $data = array(
            "historyOd" => array(),
        );
        $result = $this->Mdinvoice_core->select($where);
        $count = 0;
        $data = array();
        foreach($result->result() as $a){
            $data["historyOd"][$count] = array(
                "no_invoice" => $a->no_invoice,
                "id_invoice" => $a->id_invoice,
                "no_od" => get1Value("od_core","no_od",array("id_od" => $a->id_od)),
                "persentase" => $a->persen_pembayaran,
                "nominal" => $a->nominal_pembayaran,
                "mata_uang" => $a->mata_uang,
                "tanggal_keluar" => $a->tgl_invoice_add
            );
            $count++;
        }
        
        echo json_encode($data);
    }
    public function getOD(){
        $data = array(
            "od" => array()
        );
        $result2 = $this->Mdod_core->select(array("od_core.id_oc" =>$this->input->post("id_oc")));
        $count = 0;
        $data = array();
        
        foreach($result2->result() as $a){
            $data["od"][$count] = array(
                "id_od" => $a->id_od,
                "no_od" => $a->no_od
            );
            $count++;
        }
        echo json_encode($data);
    }
}
?>