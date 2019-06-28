<?php
class Pph23 extends CI_Controller{
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
        $this->load->view("finance/tax/pph23/category-header");
        $this->load->view("finance/tax/pph23/category-body",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
    public function detail(){
        $where = array(
            "pph" => array(
                "jenis_pajak" => "PPH",
                "status_aktif_pajak" => 0,
                "bulan_pajak" => $this->input->post("bulan_pajak"),
                "tahun_pajak" => $this->input->post("tahun_pajak")
            ),
        );
        $field = array(
            "pph" => array(
                "id_tax","jumlah_pajak","tipe_pajak","jenis_pajak","id_refrensi","status_aktif_pajak"
            )
        );
        $print = array(
            "pph" => array(
                "id_tax","jumlah_pajak","tipe_pajak","jenis_pajak","id_refrensi","status_aktif_pajak"
            )
        );
        $result["pph"] = selectRow("tax",$where["pph"]);
        $data["pph"] = foreachMultipleResult($result["pph"],$field["pph"],$print["pph"]);
        $resultPph = 0;
        for($a = 0; $a<count($data["pph"]);$a++){
            $resultPph += $data["pph"][$a]["jumlah_pajak"];
        }
        $data["jumlahPph"] = $resultPph;

        for($a = 0; $a < count($data["pph"]); $a++){
            $id_tagihan = $data["pph"][$a]["id_refrensi"]; /*id refrensi = id  */
            $data["pph"][$a]["bukti_bayar"] = get1Value("pembayaran","attachment",array("id_refrensi" => $id_tagihan));
            $data["pph"][$a]["invoice"] = get1Value("tagihan","attachment",array("id_tagihan" => $id_tagihan));
            $data["pph"][$a]["no_tagihan"] = get1Value("tagihan","no_invoice",array("id_tagihan" => $id_tagihan));
        }
        
        if($data["pph"][$a]["is_pib"] == 0){ /*refrence ke tax*/
            $data["pph"][$a]["no_tagihan"] = $data["pph"][$a]["id_refrensi"];
        }
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/tax/pph23/category-header");
        $this->load->view("finance/tax/pph23/detail-pph",$data);
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
}

?>