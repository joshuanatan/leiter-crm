<?php
class Petty extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function req(){
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
            "petty" => array(
                "status_aktif_petty" => 0
            )
        );
        $field = array(
            "expanses_type" => array(
                "id_type","name_type"
            ),
            "petty" => array(
                "id_transaksi_petty","id_user_add","amount","expanses_type","notes","subject","attachment","tgl_transaksi_petty"
            )
        );
        $print = array(
            "expanses_type" => array(
                "id_type","name_type"
            ),
            "petty" => array(
                "id_transaksi_petty","id_user_add","amount","expanses_type","notes","subject","attachment","tgl_transaksi"
            )
        );
        $result["expanses_type"] = selectRow("finance_usage_type",$where["expanses_type"]);
        $data["expanses_type"] = foreachMultipleResult($result["expanses_type"],$field["expanses_type"],$print["expanses_type"]);

        $result["petty"] = selectRow("petty_cash",$where["petty"]);
        $data["petty"] = foreachMultipleResult($result["petty"],$field["petty"],$print["petty"]);
        for($a = 0; $a<count($data["petty"]);$a++){
            $data["petty"][$a]["user_name"] = get1Value("user","nama_user",array("id_user" => $data["petty"][$a]["id_user_add"]));
            $data["petty"][$a]["nama_expanses"] = get1Value("finance_usage_type","name_type",array("id_type" => $data["petty"][$a]["expanses_type"]));
        }
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/petty/category-header");
        $this->load->view("finance/petty/category-body",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
    public function insert(){
        $config["upload_path"] = "./assets/dokumen/petty/";
        $config["allowed_types"] = "png|jpg|jpeg|pdf|gif";
        $this->load->library("upload",$config);
        if($this->upload->do_upload("attachment")){
            $fileData = $this->upload->data();
        }
        else{
            $error =$this->upload->display_errors();
            print_r($error);
            $fileData = array(
                "file_name" => "-"
            );
        }
        $money = splitterMoney($this->input->post("amount"),",");
        $data = array(
            "id_user_add" => $this->session->id_user,
            "subject" => $this->input->post("subject"),
            "expanses_type" => $this->input->post("expanses"),
            "amount" => $money,
            "notes" => $this->input->post("notes"),
            "attachment" => $fileData["file_name"],
        );
        $id_petty_cash = insertRow("petty_cash",$data);

        $data = array(
            "id_jenis_transaksi" => $this->input->post("expanses"),
            "nominal" => $money,
            "id_refrensi" => "PETTY-".$id_petty_cash,
            "bukti_bon" => $fileData["file_name"]
        );
        insertRow("cashflow",$data);
    }
    public function remove($id_transaksi_petty){
        $where = array(
            "id_transaksi_petty" => $id_transaksi_petty
        );
        $data = array(
            "status_aktif_petty" => 1
        );
        updateRow("petty_cash",$data,$where);
        $where = array(
            "id_refrensi" => "PETTY-".$id_transaksi_petty
        );
        $data = array(
            "status_aktif_transaksi" => 1
        );
        updateRow("cashflow",$data,$where);
        redirect("finance/petty");
    }
    public function update($id_transaksi_petty){
        $money = splitterMoney($this->input->post("amount"),",");
        $where = array(
            "id_transaksi_petty" => $id_transaksi_petty
        );
        
        $config["upload_path"] = "./assets/dokumen/petty/";
        $config["allowed_types"] = "png|jpg|jpeg|pdf|gif";
        $this->load->library("upload",$config);
        if($this->upload->do_upload("attachment")){
            $fileData = $this->upload->data();
            $data = array(
                "tgl_transaksi_petty" => $this->input->post("tgl_transaksi"),
                "id_user_add" => $this->session->id_user,
                "subject" => $this->input->post("subject"),
                "expanses_type" => $this->input->post("expanses"),
                "amount" => $money,
                "notes" => $this->input->post("notes"),
                "attachment" => $fileData["file_name"],
            );
            updateRow("petty_cash",$data,$where);
            $where = array(
                "id_refrensi" => "PETTY-".$id_transaksi_petty
            );
            $data = array(
                "id_jenis_transaksi" => $this->input->post("expanses"),
                "nominal" => $money,
                "bukti_bon" => $fileData["file_name"]
            );
            updateRow("cashflow",$data,$where);
        }
        else{
            $data = array(
                "tgl_transaksi_petty" => $this->input->post("tgl_transaksi"),
                "id_user_add" => $this->session->id_user,
                "subject" => $this->input->post("subject"),
                "expanses_type" => $this->input->post("expanses"),
                "amount" => $money,
                "notes" => $this->input->post("notes"),
            );
            updateRow("petty_cash",$data,$where);
            $where = array(
                "id_refrensi" => "PETTY-".$id_transaksi_petty
            );
            $data = array(
                "id_jenis_transaksi" => $this->input->post("expanses"),
                "nominal" => $money,
            );        
            updateRow("cashflow",$data,$where);
        }
        
        
        redirect("finance/petty");
    }

}

?>