<?php
class Margin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdmargin_calculation");
        $this->load->model("Mdorder_data");
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
        if($this->session->id_user == "") redirect("login/welcome");
        $kolom = array(
            "no_po_customer","tgl_po_customer","nama_perusahaan","no_oc","total_oc_price","id_submit_oc","notes_oc"
        );
        $where = array(
            "status_aktif_request" => 0,
            "status_aktif_quotation" => 0,
            "status_aktif_oc" => 0
        );
        $limit  = array(
            "offset" => 0,
            "limit" => 10
        );
        $result = $this->Mdorder_data->getListInvoice($kolom,$where,$limit);
        $data["oc"] = $result->result_array();
        $data["total"] = ($this->Mdorder_data->getTotalData($where)->row()->total_item)/10;
        $data["page"] = 1;
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/margin/category-header");
        $this->load->view("finance/margin/category-body",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
    public function page($page){
        if($this->session->id_user == "") redirect("login/welcome");
        $kolom = array(
            "no_po_customer","tgl_po_customer","nama_perusahaan","no_oc","total_oc_price","id_submit_oc"
        );
        $where = array(
            "status_aktif_request" => 0,
            "status_aktif_quotation" => 0,
            "status_aktif_oc" => 0
        );
        $limit  = array(
            "offset" => 10*($page-1),
            "limit" => 10
        );
        $result = $this->Mdorder_data->getListInvoice($kolom,$where,$limit);
        $data["oc"] = $result->result_array();
        $data["total"] = ($this->Mdorder_data->getTotalData($where)->row()->total_item)/10;
        $data["page"] = $page;
        $data["kolom"] = $kolom;
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/margin/category-header");
        $this->load->view("finance/margin/category-body",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
    public function detail($id_oc){
        $where = array(
            "id_submit_oc" => $id_oc
        );
        $field = array(
            "id_pembayaran","total_pembayaran","no_invoice","id_submit_oc","status_transaksi","total_pembayaran","tgl_bayar","subject_pembayaran","is_lain_lain","flow_transaksi"
        );
        $result = selectRow("list_transaksi_per_oc",$where,$field);
        $data["pembayaran"] = $result->result_array();
        
        $where = array(
            "id_submit_oc" => $id_oc
        );
        $field = array(
            "sum(total_pembayaran) as selisih"
        );
        $selisih = getTotal("list_transaksi_per_oc","total_pembayaran",$where);
        $where = array(
            "id_submit_oc" => $id_oc,
            "total_pembayaran > " => 0 
        );
        $masuk = getTotal("list_transaksi_per_oc","total_pembayaran",$where);
        $data["selisih"] = $selisih;
        $data["masuk"] = $masuk;
        if($masuk != 0){
            $data["margin"] = ($selisih/$masuk)*100;
        }
        else $data["margin"] = 0;
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/margin/category-header");
        $this->load->view("finance/margin/detail-margin",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
    public function insertSupplier($id_quotation_item){
        $id_oc = $this->input->post("id_oc");
        $total = $this->input->post("current_supplier");
        $add = $this->input->post("harga_supplier");
        $data = array(
            "harga_supplier" => ($total+$add),
            "notes_supplier" => $this->input->post("notes_supplier")
        );
        $where = array(
            "id_quotation_item" => $id_quotation_item
        );
        updateRow("item_margin",$data,$where);
        $this->countMargin($id_quotation_item);
        redirect("finance/margin/detail/".$id_oc);
    }
    public function insertShipper($id_quotation_item){
        $id_oc = $this->input->post("id_oc");
        $total = $this->input->post("current_shipping");
        $add = $this->input->post("harga_shipping");
        $data = array(
            "harga_shipping" => ($total+$add),
            "notes_shipper" => $this->input->post("notes_shipper")
        );
        $where = array(
            "id_quotation_item" => $id_quotation_item
        );
        updateRow("item_margin",$data,$where);
        $this->countMargin($id_quotation_item);
        redirect("finance/margin/detail/".$id_oc);
    }
    public function insertCourier($id_quotation_item){
        $id_oc = $this->input->post("id_oc");
        $total = $this->input->post("current_courier");
        $add = $this->input->post("harga_courier");
        $data = array(
            "harga_courier" => ($total+$add),
            "notes_courier" => $this->input->post("notes_courier")
        );
        $where = array(
            "id_quotation_item" => $id_quotation_item
        );
        updateRow("item_margin",$data,$where);
        $this->countMargin($id_quotation_item);
        redirect("finance/margin/detail/".$id_oc);
    }
    public function countMargin($id_quotation_item){
        $where["item_margin"] = array(
            "id_quotation_item" => $id_quotation_item
        );
        $field["item_margin"] = array(
            "margin_produk","harga_supplier","harga_shipping","harga_courier","notes_shipper","notes_supplier","notes_courier"
        );
        $print["item_margin"] = array(
            "margin_produk","harga_supplier","harga_shipping","harga_courier","notes_shipper","notes_supplier","notes_courier"
        );
        $result["item_margin"] = selectRow("item_margin",$where["item_margin"]);
        $data["item_margin"] = foreachResult($result["item_margin"],$field["item_margin"],$print["item_margin"]);
        $margin = $data["item_margin"]["harga_supplier"]+$data["item_margin"]["harga_shipping"]+$data["item_margin"]["harga_courier"];
        $harga_jual = get1Value("quotation_item","final_selling_price",array("id_quotation_item" => $id_quotation_item));
        $data = array(
            "margin_produk" => round((($harga_jual-$margin)/$harga_jual)*100,2)
        );
        $where = array(
            "id_quotation_item" => $id_quotation_item
        );
        updateRow("item_margin",$data,$where);
    }
    public function transaksitambahan(){
        $config["upload_path"] = './assets/dokumen/invoice/';
        $config["allowed_types"] = 'pdf|docx|doc|xls|xlsx|png|jpg|jpeg';
        $this->load->library("upload",$config);
        $doc_data = array();
        if($this->upload->do_upload("attachment")){
            $doc_data = $this->upload->data();
        }
        else $doc_data = array("file_name" => "-");
        $data = array(
            "id_pembayaran" => getMaxId("tambahan_transaksi","id_pembayaran",array()),
            "no_refrence" => $this->input->post("no_refrence"),
            "peruntukan_tagihan" => $this->input->post("peruntukan_tagihan"),
            "id_submit_oc" => $this->input->post("id_submit_oc"),
            "subject_pembayaran" => $this->input->post("subject_pembayaran"),
            "tgl_bayar" => $this->input->post("tgl_bayar"),
            "attachment" => $doc_data["file_name"],
            "notes_pembayaran" => "-",
            "nominal_pembayaran" => splitterMoney($this->input->post("nominal_pembayaran"),","),
            "kurs_pembayaran" => splitterMoney($this->input->post("kurs_pembayaran"),","),
            "mata_uang_pembayaran" => $this->input->post("mata_uang_pembayaran"),
            "total_pembayaran" => splitterMoney($this->input->post("nominal_pembayaran"),",")*splitterMoney($this->input->post("kurs_pembayaran"),","),
            "metode_pembayaran" => $this->input->post("metode_pembayaran"),
            "status_transaksi" => $this->input->post("status_pembayaran"),
        );
        insertRow("tambahan_transaksi",$data);
        redirect("finance/margin/detail/".$this->input->post("id_submit_oc"));
    }
    public function removelainlain(){
        $where = array(
            "id_pembayaran" => $this->input->post("id_pembayaran")
        );
        deleteRow("tambahan_transaksi",$where);
        redirect("finance/margin/detail/".$this->input->post("id_submit_oc"));
    }
    public function insertnotes(){
        $where = array(
            "id_submit_oc" => $this->input->post("id_submit_oc")
        );
        $data = array(
            "notes" => $this->input->post("notes")
        );
        updateRow("order_confirmation",$data,$where);
        redirect("finance/margin");
    }
}

?>