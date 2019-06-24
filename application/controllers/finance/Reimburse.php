<?php
class Reimburse extends CI_Controller{
    public function __construct(){
        parent::__construct();
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
            "expanses_type" => array(
                "variable_type" => "EXPANSES",
                "usage_type" => "CASH",
                "status_type" => 0
            ),
            "reimburse" => array(
                "status_aktif_reimburse" => 0
            )
        );
        $field = array(
            "expanses_type" => array(
                "id_type","name_type"
            ),
            "reimburse" => array(
                "id_reimburse","subject_reimburse","nominal_reimburse","attachment","notes","id_user_add","tgl_reimburse_add","expanses_type","status_paid",
            )
        );
        $print = array(
            "expanses_type" => array(
                "id_type","name_type"
            ),
            "reimburse" => array(
                "id_reimburse","subject","amount","attachment","notes","id_user_add","tgl_reimburse_add","expanses_type","status_paid",
            )
        );
        $result["expanses_type"] = selectRow("finance_usage_type",$where["expanses_type"]);
        $data["expanses_type"] = foreachMultipleResult($result["expanses_type"],$field["expanses_type"],$print["expanses_type"]);

        $result["reimburse"] = selectRow("reimburse",$where["reimburse"]);
        $data["reimburse"] = foreachMultipleResult($result["reimburse"],$field["reimburse"],$print["reimburse"]);
        for($a = 0; $a<count($data["reimburse"]);$a++){
            $data["reimburse"][$a]["nama_user"] = get1Value("user","nama_user",array("id_user" => $data["reimburse"][$a]["id_user_add"]));
            $data["reimburse"][$a]["nama_expanses"] = get1Value("finance_usage_type","name_type",array("id_type" => $data["reimburse"][$a]["expanses_type"]));

            if($data["reimburse"][$a]["status_paid"] == 0){
                /*kalau sudah dibayar*/
                /*load data dari pembayaran untuk reimburse ini */
                $result["payment_data"] = selectRow("pembayaran",array("id_refrensi" => "REIMBURSE-".$data["reimburse"][$a]["id_reimburse"]));
                $field["payment_data"] = array(
                    "id_pembayaran","subject_pembayaran","tgl_bayar","attachment","notes_pembayaran","nominal_pembayaran","metode_pembayaran"
                );
                /*end data pembayaran*/
                /*masukin ke variable payment data*/
                $data["reimburse"][$a]["payment_data"] = foreachResult($result["payment_data"],$field["payment_data"],$field["payment_data"]);
            }

        }
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/reimburse/category-header");
        $this->load->view("finance/reimburse/category-body",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
    public function insert(){
        $config["upload_path"] = "./assets/dokumen/reimburse/";
        $config["allowed_types"] = "jpg|png|jpeg|gif|pdf";
        $this->load->library("upload",$config);
        if($this->upload->do_upload("attachment")){
            $dataFile = $this->upload->data();
        }
        else{
            $dataFile = array("file_name" => "-");
        }
        $data = array(
            "subject_reimburse" =>$this->input->post("subject"),
            "nominal_reimburse" =>splitterMoney($this->input->post("amount"),","),
            "attachment" =>$dataFile["file_name"],
            "notes" => $this->input->post("notes"),
            "expanses_type" => $this->input->post("expanses"),
            "id_user_add" => $this->session->id_user,
            "tgl_reimburse_add" => date("Y-m-d"),
        );
        insertRow("reimburse",$data);
        redirect("finance/reimburse");
    }
    public function edit($id_reimburse){
        /*kalau ngedit yang bentuknya menunggu pelunasan, gaperlu ganti yang di cashflow & pembayaran*/
        $where = array(
            "id_reimburse" => $id_reimburse
        );
        $config["upload_path"] = "./assets/dokumen/reimburse/";
        $config["allowed_types"] = "jpg|png|jpeg|gif|pdf";
        $this->load->library("upload",$config);
        if($this->upload->do_upload("attachment_edit")){
            $dataFile = $this->upload->data();
            $data = array(
                "subject_reimburse" =>$this->input->post("subject_edit"),
                "nominal_reimburse" =>splitterMoney($this->input->post("amount_edit"),","),
                "attachment" =>$dataFile["file_name"],
                "notes" => $this->input->post("notes_edit"),
                "expanses_type" => $this->input->post("expanses_edit"),
                "id_user_add" => $this->session->id_user,
                "tgl_reimburse_add" => date("Y-m-d"),
            );
            updateRow("reimburse",$data,$where);
        }
        else{
            $data = array(
                "subject_reimburse" =>$this->input->post("subject_edit"),
                "nominal_reimburse" =>splitterMoney($this->input->post("amount_edit"),","),
                "notes" => $this->input->post("notes_edit"),
                "expanses_type" => $this->input->post("expanses_edit"),
                "id_user_add" => $this->session->id_user,
                "tgl_reimburse_add" => date("Y-m-d"),
            );
            updateRow("reimburse",$data,$where);
        }
    }
    public function remove($id_reimburse){
        $where = array(
            "id_reimburse" => $id_reimburse
        );
        $data = array(
            "status_aktif_reimburse" => 1
        );
        updateRow("reimburse",$data,$where);
        redirect("finance/reimburse");
    }
    public function pay($id_reimburse){
        $where = array(
            "id_reimburse" => $id_reimburse
        );
        $data = array(
            "status_paid" => 0
        );
        updateRow("reimburse",$data,$where);
        $config["upload_path"] = "./assets/dokumen/buktibayar/";
        $config["allowed_types"] = "jpg|png|gif|jpeg";
        $this->load->library("upload",$config);
        if($this->upload->do_upload("pay_attachment")){
            $fileData = $this->upload->data();
        }
        else{
            $fileData["file_name"] = "-";
        }
        /*insert pembayaran*/
        $data = array(
            "id_refrensi" => "REIMBURSE-".$id_reimburse,
            "subject_pembayaran" => $this->input->post("pay_subject"),
            "tgl_bayar" => $this->input->post("pay_tgl_bayar"),
            "attachment" => $fileData["file_name"],
            "notes_pembayaran" => $this->input->post("pay_notes"),
            "metode_pembayaran" => $this->input->post("metode_pembayaran"),
            "nominal_pembayaran"=> splitterMoney($this->input->post("pay_amount"),","),
            "total_pembayaran"=> splitterMoney($this->input->post("pay_amount"),","),
            "kurs_pembayaran" => 1,
            "mata_uang_pembayaran" => "IDR"
        );
        insertRow("pembayaran",$data);

        /*insert ke cashflow*/
        $data = array(
            "id_jenis_transaksi" => 1, /*reimburse*/
            "nominal" => $this->input->post("pay_amount"),
            "tgl_transaksi" => $this->input->post("pay_tgl_bayar"),
            "metode_pembayaran" => $this->input->post("metode_pembayaran"),
            "id_refrensi" => "REIMBURSE-".$id_reimburse,
            "bukti_bon" => $fileData["file_name"],
        );
        insertRow("cashflow",$data);
    }
}

?>