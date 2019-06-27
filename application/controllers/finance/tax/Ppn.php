<?php
class Ppn extends CI_Controller{
    public function __constrcut(){
        parent::__construct();
    }
    public function index(){
        $data = array(
            "bulan" => array(
                "01" => "JANUARI",
                "02" => "FEBRUARI",
                "03" => "MARET",
                "04" => "APRIL",
                "05" => "MEI",
                "06" => "JUNI",
                "07" => "JULI",
                "08" => "AGUSTUS",
                "09" => "SEPTEMBER",
                "10" => "OKTOBER",
                "11" => "NOVEMBER",
                "12" => "DESEMBER"
            ),
            "tahun" => array(
                "2019"
            )
        );
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/tax/ppn/category-header");
        $this->load->view("finance/tax/ppn/category-body",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
    
    public function req(){
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("plugin/card/card-css");
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
    public function detail(){
        $where = array(
            "tax" => array(
                "bulan_pajak" => $this->input->post("bulan_pajak"),
                "tahun_pajak" => $this->input->post("tahun_pajak"),
                "jenis_pajak" => "PPN"
            )
        );
        $field = array(
            "tax" => array(
                "id_tax","jumlah_pajak","tipe_pajak","jenis_pajak","id_refrensi","status_aktif_pajak","is_pib"
            )
        );
        $print = array(
            "tax" => array(
                "id_tax","jumlah_pajak","tipe_pajak","jenis_pajak","id_refrensi","status_aktif_pajak","is_pib"
            )
        );
        $result["tax"] = selectRow("tax",$where["tax"]);
        $data["tax"] = foreachMultipleResult($result["tax"],$field["tax"],$print["tax"]);
        for($a = 0; $a < count($data["tax"]); $a++){
            $id_tagihan = $data["tax"][$a]["id_refrensi"]; /*id refrensi = id  */
            $data["tax"][$a]["bukti_bayar"] = get1Value("pembayaran","attachment",array("id_refrensi" => $id_tagihan));
            if($data["tax"][$a]["tipe_pajak"] == "MASUKAN"){ /*berarti dari tagihan*/
                $data["tax"][$a]["invoice"] = get1Value("tagihan","attachment",array("id_tagihan" => $id_tagihan));
                $data["ppn"][$a]["no_tagihan"] = get1Value("tagihan","no_invoice",array("id_tagihan" => $id_tagihan));
            }
            else{
                $data["tax"][$a]["invoice"] = get1Value("invoice","id_invoice",array("no_invoice" => $id_tagihan)); /*nanti a href aja */
                $data["ppn"][$a]["no_tagihan"] = get1Value("tagihan","no_invoice",array("id_tagihan" => $id_tagihan));
            }
            if($data["tax"][$a]["is_pib"] == 0){ /*refrence ke tax*/
                $data["ppn"][$a]["no_tagihan"] = $data["tax"][$a]["id_refrensi"];
                $data["tax"][$a]["invoice"] = get1Value("pib","attachment",array("no_pib" => $id_tagihan));
            }
        }
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/tax/ppn/category-header");
        $this->load->view("finance/tax/ppn/detail-ppn",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
}

?>