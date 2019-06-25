<?php
class Ppn extends CI_Controller{
    public function __constrcut(){
        parent::__construct();
    }
    public function index(){
        $data = array(
            "bulan" => array(
                "1" => "JANUARI",
                "2" => "FEBRUARI",
                "3" => "MARET",
                "4" => "APRIL",
                "5" => "MEI",
                "6" => "JUNI",
                "7" => "JULI",
                "8" => "AGUSTUS",
                "9" => "SEPTEMBER",
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
                "jenis_pajak" => $this->input->post("PPN")
            )
        );
        $field = array(
            "tax" => array(
                "id_tax","jumlah_pajak","tipe_pajak","jenis_pajak","id_refrensi","status_aktif_pajak"
            )
        );
        $print = array(
            "tax" => array(
                "id_tax","jumlah_pajak","tipe_pajak","jenis_pajak","id_refrensi","status_aktif_pajak"
            )
        );
        $result["tax"] = selectRow("tax",$where["tax"]);
        $data["tax"] = foreachMultipleResult($result["tax"],$field["tax"],$print["tax"]);
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/tax/ppn/category-header");
        $this->load->view("finance/tax/ppn/detail-ppn",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
}

?>