<?php
class Pib extends CI_Controller{
    public function __constrcut(){
        parent::__construct();
    }
    
    public function index(){
        $where = array(
            "pib" => array(
                "status_aktif_pib" => 0
            )
        );
        $field = array(
            "pib" => array(
                "no_pib","tgl_pib_masuk","ppn_impor","pph_impor","bea_cukai","no_po","notes_pib","attachment","status_bayar_pib","id_pib"
            )
        );
        $print = array(
            "pib" => array(
                "no_pib","tgl_pib_masuk","ppn_impor","pph_impor","bea_cukai","no_po","notes_pib","attachment","status_bayar_pib","id_pib"
            )
        );
        $result["pib"] = selectRow("pib",$where["pib"]);
        $data["pib"] = foreachMultipleResult($result["pib"],$field["pib"],$print["pib"]);
        for($a = 0; $a<count($data["pib"]); $a++){
            $data["pib"][$a]["total_tagihan"] = $data["pib"][$a]["ppn_impor"]+$data["pib"][$a]["pph_impor"]+$data["pib"][$a]["bea_cukai"];

            if($data["pib"][$a]["status_bayar_pib"] == 0){
                $where["payment_detail"] = array(
                    "id_refrensi" => $data["pib"][$a]["no_pib"]
                );
                $field["payment_detail"] = array(
                    "id_pembayaran","id_refrensi","subject_pembayaran","tgl_bayar","attachment","notes_pembayaran","nominal_pembayaran","metode_pembayaran"
                );
                $print["payment_detail"] = array(
                    "id_pembayaran","id_refrensi","subject_pembayaran","tgl_bayar","attachment","notes_pembayaran","nominal_pembayaran","metode_pembayaran"
                );
                $result["payment_detail"] = selectRow("pembayaran",$where["payment_detail"]);
                $data["pib"][$a]["payment_detail"] = foreachResult($result["payment_detail"],$field["payment_detail"],$print["payment_detail"]);
            }
        }
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/tax/pib/category-header");
        $this->load->view("finance/tax/pib/category-body",$data);
        $this->load->view("finance/content-close");
        $this->close();
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
    public function insert(){
        $config = array(
            "upload_path" => "./assets/dokumen/pib/",
            "allowed_types" => "jpg|jpeg|pdf|png|gif|docx|doc|xls|xlsx"
        );
        $this->load->library("upload",$config);
        if($this->upload->do_upload("attachment")){
            $fileData = $this->upload->data();
        }
        else{
            $fileData["file_name"] = "-";
        }
        $data = array(
            "no_pib" => $this->input->post("no_pib"),
            "tgl_pib_masuk" => $this->input->post("tgl_pib_masuk"),
            "ppn_impor" =>splitterMoney($this->input->post("ppn_impor"),","),
            "pph_impor" => splitterMoney($this->input->post("pph_impor"),","),
            "bea_cukai" => splitterMoney($this->input->post("bea_masuk"),","),
            "no_po" => $this->input->post("no_refrence"),
            "notes_pib" => $this->input->post("notes_pib"),
            "attachment" => $fileData["file_name"],
        );
        insertRow("pib",$data);
        redirect("finance/tax/pib");
    }
    public function pay($id_pib){
        /*ubah is paid*/
        $where = array(
            "id_pib" => $id_pib
        );
        $data = array(
            "status_bayar_pib" => 0
        );
        updateRow("pib",$data,$where);
        /*done ubah jadi paid*/

        $config = array(
            "upload_path" => "./assets/dokumen/buktibayar/",
            "allowed_types" => "jpg|png|jpeg|gif|pdf"
        );
        $this->load->library("upload",$config);
        if($this->upload->do_upload("pay_attachment")){
            $fileData = $this->upload->data();
        }
        else{
            $fileData["file_name"] = "-";
        }
        /*masukin ke table pembayran */
        $data = array(
            "id_refrensi" =>  $this->input->post("id_refrensi"), /*id pib harusnya*/
            "subject_pembayaran" => $this->input->post("subject_pembayaran"),
            "tgl_bayar" => $this->input->post("tgl_bayar"),
            "attachment" => $fileData["file_name"],
            "notes_pembayaran" => $this->input->post("notes_pembayaran"),
            "nominal_pembayaran" => splitterMoney($this->input->post("nominal"),","),
            "kurs_pembayaran" => 1,
            "mata_uang_pembayaran" => "IDR",
            "total_pembayaran" => splitterMoney($this->input->post("nominal"),","),
            "metode_pembayaran" => $this->input->post("metode_pembayaran")
        );
        insertRow("pembayaran",$data);

        /*masukin ke cashflow*/
        $data = array(
            "id_jenis_transaksi" => 5,
            "nominal" => splitterMoneY($this->input->post("nominal"),","),
            "id_refrensi" => $this->input->post("id_refrensi"),
            "bukti_bon" => $fileData["file_name"],
            "metode_pembayaran" => $this->input->post("metode_pembayaran")
        );
        insertRow("cashflow",$data);

        /*insert ke tax juga */
        $data = array(
            "bulan_pajak" => date("m"),
            "tahun_pajak" => date("Y"),
            "jumlah_pajak" => get1Value("pib","pph_impor",array("id_pib" => $id_pib)),
            "tipe_pajak" => "MASUKAN",
            "jenis_pajak" => "PPH",
            "status_aktif_pajak" => 0,
            "id_refrensi" => $this->input->post("id_refrensi")
        );
        insertRow("tax",$data);

        $data = array(
            "bulan_pajak" => date("m"),
            "tahun_pajak" => date("Y"),
            "jumlah_pajak" => get1Value("pib","ppn_impor",array("id_pib" => $id_pib)),
            "tipe_pajak" => "MASUKAN",
            "jenis_pajak" => "PPN",
            "status_aktif_pajak" => 0,
            "id_refrensi" => $this->input->post("id_refrensi")
        );
        insertRow("tax",$data);

        $data = array(
            "bulan_pajak" => date("m"),
            "tahun_pajak" => date("Y"),
            "jumlah_pajak" => get1Value("pib","bea_cukai",array("id_pib" => $id_pib)),
            "tipe_pajak" => "MASUKAN",
            "jenis_pajak" => "BEA CUKAI",
            "status_aktif_pajak" => 0,
            "id_refrensi" => $this->input->post("id_refrensi")
        );
        insertRow("tax",$data);
        redirect("finance/tax/pib");
    }
    public function edit($id_pib){
        $where = array(
            "id_pib" => $id_pib
        );
        $config = array(
            "upload_path" => "./assets/dokumen/pib/",
            "allowed_types" => "png|jpg|jpeg|pdf|gif"
        );
        $this->load->library("upload",$config);
        if($this->upload->do_upload("attachment")){
            $fileData = $this->upload->data();
            $data = array(
                "no_pib" => $this->input->post("no_pib"),
                "tgl_pib_masuk" => $this->input->post("tgl_pib_masuk"),
                "ppn_impor" => splitterMoney($this->input->post("ppn_impor"),","),
                "pph_impor" =>  splitterMoney($this->input->post("pph_impor"),","),
                "bea_cukai" =>  splitterMoney($this->input->post("bea_masuk"),","),
                "attachment" => $fileData["file_name"],
                "no_po" => $this->input->post("no_refrence"),
                "notes_pib" => $this->input->post("notes_pib"),
                "attachment" => $fileData["file_name"],
            );
            updateRow("pib",$data,$where);
        }
        else{
            $data = array(
                "no_pib" => $this->input->post("no_pib"),
                "tgl_pib_masuk" => $this->input->post("tgl_pib_masuk"),
                "ppn_impor" => splitterMoney($this->input->post("ppn_impor"),","),
                "pph_impor" =>  splitterMoney($this->input->post("pph_impor"),","),
                "bea_cukai" =>  splitterMoney($this->input->post("bea_masuk"),","),
                "no_po" => $this->input->post("no_refrence"),
                "notes_pib" => $this->input->post("notes_pib"),
            );
            updateRow("pib",$data,$where);
        }
        redirect("finance/tax/pib");
    }
    public function remove($id_pib){
        $where = array(
            "id_pib" => $id_pib
        );
        $data = array(
            "status_aktif_pib" => 1
        );
        updateRow("pib",$data,$where);
        redirect("finance/tax/pib");
    }
}

?>