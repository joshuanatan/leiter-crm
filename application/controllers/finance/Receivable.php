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
            if($a->id_od == "0"){ $od = "-"; $status = "DOWN PAYMENT";} else{ $od = "OD-".sprintf("%05d",$a->id_od);$status = "REST PAYMENT";}

            $data["invoice"][$counter] = array(
                "id_invoice" =>$a->id_invoice,
                "no_invoice" =>$a->no_invoice,
                "no_oc" =>get1Value("order_confirmation","no_oc", array("id_oc" => $a->id_oc)),
                "id_od" =>$od,
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
                "status_aktif_oc" => 0
                /*tampilin semua, tapi kalau udah kedelete, jangan*/
            )   
        );
        $field["oc"] = array(
            "id_oc","no_oc","id_quotation","versi_quotation","no_po_customer","date_oc_add",
        );
        $print["oc"] = array(
            "id_oc","no_oc","id_quotation","versi_quotation","no_po_customer","date_issued",
        );
        $result["oc"] = selectRow("order_confirmation",$where["oc"]);
        $data["oc"] = foreachMultipleResult($result["oc"],$field["oc"],$print["oc"]);
        $data["maxId"] = getMaxId("invoice_core","id_invoice",array("bulan_invoice" => date("m"),"tahun_invoice" => date("Y"),""));

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
        $check_ppn = $this->input->post("ppn");
        $is_ppn = 1;
        foreach($check_ppn as $a){
            $is_ppn = 0;
            $ppn = 0.1*$this->session->totalinvoice;
        }
        $data = array(
            "id_invoice" =>$this->input->post("id_invoice"),
            "no_invoice" => $this->input->post("no_invoice"),
            "id_oc" =>$this->input->post("id_oc"),
            "id_od" => $this->input->post("id_od"),
            "bulan_invoice" => date("m"),
            "tahun_invoice" => date("Y"),
            "is_ppn" => $is_ppn,
            "ppn" => $ppn,
            //"nominal_pembayaran" => $this->input->post("nominal_pembayaran"),
            "nominal_pembayaran" => ($this->session->totalinvoice*1.1),
            "franco" => $this->input->post("franco"),
            "up" => $this->input->post("up"),
            "kurs_pembayaran" => 1,
            "mata_uang" => "IDR",
            "status_aktif_invoice" => "0",
            "id_user_add" => $this->session->id_user
        );
        insertRow("invoice_core",$data);
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
    public function pay($id_tagihan){
        $where = array(
            "id_tagihan" => $id_tagihan
        );
        $data = array(
            "status_lunas" => 0
        );
        updateRow("tagihan",$data,$where);
        /*masukin ke pembayaran*/
        $config["upload_path"] = "./assets/dokumen/buktibayar/";
        $config["allowed_types"] = "gif|jpg|jpeg|pdf|png";
        $this->load->library("upload",$config);
        $fileData = array();
        if($this->upload->do_upload("attachment")){
            $fileData = $this->upload->data();
        }
        else{
            $fileData["file_name"] = "-";
        }
        $data = array(
            "id_refrensi" => $this->input->post("id_refrensi"),
            "subject_pembayaran" => $this->input->post("subject_pembayaran"),
            "tgl_bayar" => $this->input->post("tgl_bayar"),
            "attachment" =>  $fileData["file_name"],
            "notes_pembayaran" =>  $this->input->post("notes_pembayaran"),
            "nominal_pembayaran" =>  splitterMoney($this->input->post("nominal_pembayaran"),","),
            "kurs_pembayaran" =>  1,
            "mata_uang_pembayaran" => "IDR",
            "total_pembayaran" => splitterMoney($this->input->post("nominal_pembayaran"),","),
            "metode_pembayaran" => $this->input->post("metode_pembayaran"),
            "jenis_pembayaran" => "MASUK",
            "kategori_pembayaran" => 3
        );
        insertRow("pembayaran",$data);
    
        /*masukin ke tax */
        /*pajak pasti masukan karena ini kita bayar ke supplier*/
        $tagihan = splitterMoney($this->input->post("nominal_pembayaran"),",");


        if(get1Value("tagihan","is_ppn",array("id_tagihan" => $id_tagihan)) == 0){
            $data = array(
                "bulan_pajak" => date("m"),
                "tahun_pajak" => date("Y"),
                "jumlah_pajak" => $tagihan/11, /*tagihan ini uda termasuk ppn, ahrus cari ppnnya sendiri*/
                "tipe_pajak" => "KELUARAN",
                "jenis_pajak" => "PPN",
                "status_aktif_pajak" => 0,
                "id_refrensi" => $this->input->post("id_refrensi")
            );
            insertRow("tax",$data);
        }
        redirect("finance/receivable");
    }
}
?>