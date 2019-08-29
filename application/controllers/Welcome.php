<?php
class Welcome extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mduser");
        $this->load->model("Mdmenu");
        $this->load->model("Mddashboard");
    }
    public function index(){
        if($this->session->id_user == "") redirect("login/welcome");
        $year = date("Y");
        $durasi = 3;

        $field = array(
            "bulan_invoice","tahun_invoice","total"
        );
        $where = array();
        $result = $this->Mddashboard->getSalesMonthly($field,$where,$year,$durasi);
        $data["penghasilan"] = $result->result_array();

        $field = array(
            "count(distinct(no_po_customer)) as total",
            "bulan_oc",
            "tahun_oc"
        );
        $where = array();
        $result = $this->Mddashboard->getJumlahPo($field,$where,$year,$durasi);
        $data["po"] = $result->result_array();

        $result = $this->Mddashboard->getCustomerOrder($year);
        $data["customer_order"] = $result->result_array();
        
        $this->load->view("req/head");
        $this->load->view("plugin/chart-js/chart-js-css");
        $this->load->view("req/head-close");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $this->load->view("dashboard/main");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("req/html-close");
        $this->load->view("plugin/chart-js/chart-js-js");
        $this->load->view("dashboard/js/main-js",$data);
    }
    public function finance(){
        if($this->session->id_user == "") redirect("login/welcome");
        $year = date("Y");
        $field = array(
            "sum(total_pembayaran) as cashflow"
        );
        $where = array(
            "bulan_transaksi" => (int)date("m"),
            "tahun_transaksi" => date("Y")
        );
        $result = selectRow("cashflow_overview",$where,$field);
        $data["cashflow_balance"] = $result->result_array();
        
        $field = array(
            "sum(total_pembayaran) as cashflow"
        );
        $where = array(
            "bulan_transaksi" => (int)date("m"),
            "tahun_transaksi" => date("Y"),
            "total_pembayaran <" => 0
        );
        $result = selectRow("cashflow_overview",$where,$field);
        $data["pengeluaran"] = $result->result_array();
        
        $field = array(
            "sum(total_pembayaran) as cashflow"
        );
        $where = array(
            "bulan_transaksi" => (int)date("m"),
            "tahun_transaksi" => date("Y"),
            "total_pembayaran >" => 0
        );
        $result = selectRow("cashflow_overview",$where,$field);
        $data["pemasukan"] = $result->result_array();
        
        
        $field = array(
            "sum(total_pembayaran) as total_pembayaran"
        );
        $where = array(
            "bulan_transaksi" => (int)date("m"),
            "tahun_transaksi" => date("Y")
        );
        $result = selectRow("margin_overview",$where,$field);
        $selisih = $result->result_array();
        $field = array(
            "sum(total_pembayaran) as total_pembayaran"
        );
        $where = array(
            "bulan_transaksi" => (int)date("m"),
            "tahun_transaksi" => date("Y"),
            "total_pembayaran >" => 0
        );
        $result = selectRow("margin_overview",$where,$field);
        $jual = $result->result_array();
        $data["margin_overview"] = $selisih[0]["total_pembayaran"]/$jual[0]["total_pembayaran"]*100;

        $field = array(
            "sum(total_pembayaran) as total_pembayaran",
            "bulan_transaksi",
            "tahun_transaksi"
        );
        $where = array(
            "tahun_transaksi " => $year,
            "total_pembayaran >" => 0
        );
        $group_by = array(
            "bulan_transaksi"
        );
        $result = selectRow("cashflow_overview",$where,$field,"","","","",$group_by);
        $data["uang_masuk_bulanan"] = $result->result_array();

        $where = array(
            "tahun_transaksi " => $year,
            "total_pembayaran <" => 0
        );
        $group_by = array(
            "bulan_transaksi"
        );
        $result = selectRow("cashflow_overview",$where,$field,"","","","",$group_by);
        $data["uang_keluar_bulanan"] = $result->result_array();

        $field = array(
            "sum(total_pembayaran) as selisih,bulan_transaksi", "tahun_transaksi","bulan_transaksi"
        );
        $where = array(
            "tahun_transaksi >=" => $year-2,
            "total_pembayaran <" => 0  
        );
        $group_by = array(
            "bulan_transaksi","tahun_transaksi"
        );
        $result = selectRow("margin_overview",$where,$field,"","","","",$group_by);
        $data["selisih_untuk_margin"] = $result->result_array();

        $field = array(
            "sum(total_pembayaran) as jual,bulan_transaksi", "tahun_transaksi","bulan_transaksi"
        );
        $where = array(
            "tahun_transaksi >=" => $year-2,
            "total_pembayaran >" => 0  
        );
        $group_by = array(
            "bulan_transaksi","tahun_transaksi"
        );
        $result = selectRow("margin_overview",$where,$field,"","","","",$group_by);
        $data["jual_untuk_margin"] = $result->result_array();

        $this->load->view("req/head");
        $this->load->view("plugin/chart-js/chart-js-css");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req/head-close");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $this->load->view("dashboard/finance",$data);
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("req/html-close");
        $this->load->view("plugin/chart-js/chart-js-js");
        $this->load->view("dashboard/js/finance-js",$data);
        $this->load->view("plugin/datatable/page-datatable-js");
    }
    public function register(){
        $name = array(
            "nama_user",
            "email_user",
            "nohp_user",
            "password"
        );
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => md5($this->input->post($name[3])),
            "id_user_add" => $this->session->id_user
        );
        $this->Mduser->insert($data);
        $this->session->res_msg = "Data Recorded";
        redirect("master/user/employee");
    }
}
?>