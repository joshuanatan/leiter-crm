<?php
class Receivable extends CI_Controller{
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
        $this->load->view("finance/finance-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("finance/receivable/js/request-ajax");
        $this->load->view("finance/finance-close");
        $this->load->view("req/html-close");
    }
    public function index(){
        $where = array(
            "invoice" => array()
        );
        $result["invoice"] = $this->Mdinvoice_core->select($where["invoice"]);
        $data["invoice"] = array();
        
        $counter = 0 ;
        foreach($result["invoice"]->result() as $a){
            if($a->id_od == ""){ $od = "-"; $status = "DOWN PAYMENT";} else{ $od = "OD-".sprintf("%05d",$a->id_od);$status = "REST PAYMENT";}
            if($a->persen_pembayaran == "") $persen = "-"; else $persen = $a->persen_pembayaran;

            $data["invoice"][$counter] = array(
                "id_invoice" =>$a->id_invoice,
                "no_invoice" =>$a->no_invoice,
                "no_oc" =>get1Value("order_confirmation","no_oc", array("id_oc" => $a->id_oc)),
                "id_od" =>$od,
                "persen_pembayaran" =>$persen,
                "nominal_pembayaran" =>$a->nominal_pembayaran,
                "purpose" => $status,
                "mata_uang" =>$a->mata_uang
            );
            $counter++;
        }
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/receivable/category-header");
        $this->load->view("finance/receivable/category-body",$data);
        $this->load->view("finance/content-close");
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
        $this->load->view("finance/content-open");
        $this->load->view("finance/receivable/category-header");
        $this->load->view("finance/receivable/add-invoice",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
    public function edit($i){

    }
    public function word(){
        header("Content-type:application/vnd.ms-word");
        header("Content-Disposition:attachment;Filename=invoice.doc");
        header("Pragma: no-cache");
        header("Expires:0");
        $this->load->view("finance/print/invoice");
    }
    public function pdf(){
        $this->load->view("finance/pdf/invoice");
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
    public function createinvoice(){
        $data = array(
            "id_invoice" =>$this->input->post("id_invoice"),
            "no_invoice" => $this->input->post("no_invoice"),
            "id_oc" =>$this->input->post("id_oc"),
            "id_od" => $this->input->post("id_od"),
            "persen_pembayaran" => $this->input->post("persentase_pembayaran"),
            "nominal_pembayaran" => $this->input->post("nominal_pembayaran"),
            "kurs_pembayaran" => 1,
            "mata_uang" => "IDR",
            "id_user_add" => $this->session->id_user
        );
        $this->Mdinvoice_core->insert($data);
        $data = array(
            "id_invoice" =>$this->input->post("id_invoice"),
            "status_invoice" => 0
        );
        $where =array(
            "id_oc" => $this->input->post("id_oc"), /*yang penting uda tau uda DP*/
        );
        redirect("finance/receivable");

    }
    public function getDp(){
        $where = array(
            "id_oc" => $this->input->post("id_oc"),
            "status_invoice" => 1,
            "trigger_pembayaran" => 1
        );
        $result = $this->Mdmetode_pembayaran->select($where);
        $data = array();
        foreach($result->result() as $a){
            $data["persentase"] = $a->persentase_pembayaran;
            $data["nominal"] = number_format($a->nominal_pembayaran);
            $data["total"] = number_format(100*splitterMoney($data["nominal"],",")/$data["persentase"]);
            $data["clean_nominal"] = splitterMoney($data["nominal"],",");
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