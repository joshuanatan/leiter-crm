<?php
class Po extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdprice_request");
        $this->load->model("Mdharga_vendor");
        $this->load->model("Mdmata_uang");
        $this->load->model("Mdprice_request_item");
        $this->load->model("MdPo_setting");
        $this->load->model("MdPo_item");
        $this->load->model("Mdpo_core");
        $this->load->model("Mdorder_confirmation");
        $this->load->model("Mdquotation_item");
    }
    private function req(){
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("req/head-close");
        $this->load->view("crm/crm-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function print(){
        $this->load->view("crm/print/po");
    }
    public function index(){
        $where["purchase_order"] = array(
            "status_aktif_po" => 0
        );
        $field["purchase_order"] = array(
            "id_submit_po","no_po","id_supplier","id_shipper","shipping_method","total_supplier_payment","id_submit_oc"
        );
        $result["purchase_order"] = $this->Mdpo_core->getListPo($where["purchase_order"]);
        $data["purchase_order"] = foreachMultipleResult($result["purchase_order"],$field["purchase_order"],$field["purchase_order"]);
        for($a = 0; $a<count($data["purchase_order"]); $a++){
            $data["purchase_order"][$a]["nama_supplier"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["purchase_order"][$a]["id_supplier"]));
            $data["purchase_order"][$a]["nama_shipper"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["purchase_order"][$a]["id_shipper"]));
            
            $id_submit_quotation = get1Value("order_confirmation","id_submit_quotation", array("id_submit_oc" => $data["purchase_order"][$a]["id_submit_oc"]));
            $id_submit_request = get1Value("quotation","id_request",array("id_submit_quotation" => $id_submit_quotation));
            $id_perusahaan = get1Value("price_request","id_perusahaan",array("id_submit_request" => $id_submit_request));
            $id_cp = get1Value("price_request","id_cp",array("id_submit_request" => $id_submit_request));

            $data["purchase_order"][$a]["nama_perusahaan"] = array("perusahaan","nama_perusahaan",array("id_perusahaan" => $id_perusahaan));
            $data["purchase_order"][$a]["nama_cp"] = array("contact_person","nama_cp",array("id_cp" => $id_cp));
        }

        
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/po/category-header");
        $this->load->view("crm/po/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("crm/po/js/request-ajax");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    
    public function create(){
        $data["maxId"] = getMaxId("po_core","id_po",array("bulan_po" => date("m"), "tahun_po" => date("Y"),"status_aktif_po" => 0));

        $where["list_oc"] = array(
            "status_aktif_oc" => 0
        );
        $field["list_oc"] = array(
            "id_submit_oc","id_submit_quotation","no_po_customer"
        );
        $result["list_oc"] = $this->Mdorder_confirmation->getListOc($where["list_oc"]);
        $data["list_oc"] = foreachMultipleResult($result["list_oc"],$field["list_oc"],$field["list_oc"]);
        for($a = 0; $a<count($data["list_oc"]); $a++){
            $id_submit_request = get1Value("quotation","id_request",array("id_submit_quotation" => $data["list_oc"][$a]["id_submit_quotation"]));
            $id_perusahaan = get1value("price_request","id_perusahaan",array("id_submit_request" => $id_submit_request));
            $data["list_oc"][$a]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan", array("id_perusahaan" => $id_perusahaan));
            $data["list_oc"][$a]["id_perusahaan"] = $id_perusahaan;
        }
        
        $field["perusahaan"] = array(
            "nama_perusahaan","id_perusahaan"
        );
        $where["supplier"] = array(
            "status_perusahaan" => 0,
            "peran_perusahaan" => "PRODUK"
        );
        $result["supplier"] = selectRow("perusahaan",$where["supplier"]);
        $data["supplier"] = foreachMultipleResult($result["supplier"],$field["perusahaan"],$field["perusahaan"]);
        $where["shipper"] = array(
            "status_perusahaan" => 0,
            "peran_perusahaan" => "SHIPPING"
        );
        $result["shipper"] = selectRow("perusahaan",$where["shipper"]);
        $data["shipper"] = foreachMultipleResult($result["shipper"],$field["perusahaan"],$field["perusahaan"]);
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/po/category-header");
        $this->load->view("crm/po/add-po",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function insertPo(){
        $data = array(
            "id_submit_oc" => $this->input->post("id_submit_oc"),
            "id_po" => $this->input->post("id_po"),
            "bulan_po" => date("m"),
            "tahun_po" => date("Y"),
            "no_po" => $this->input->post("no_po"),
            "id_supplier" => $this->input->post("id_supplier"),
            "id_cp_supplier" => $this->input->post("id_cp_supplier"),
            "id_shipper" => $this->input->post("id_shipper"),
            "id_cp_shipper" => $this->input->post("id_cp_shipper"),
            "shipping_method" => $this->input->post("shipping_method"),
            "shipping_term" => $this->input->post("shipping_term"),
            "requirement_date" => $this->input->post("requirement_date"),
            "destination" => $this->input->post("destination"),
            "total_supplier_payment" => 0,
            "mata_uang_pembayaran" => $this->input->post("mata_uang_pembayaran"),
            "id_user_add" => $this->session->id_user
        );
        $id_submit_po = insertRow("po_core",$data);
        $checks = $this->input->post("checks");
        foreach($checks as $checked){ /*bkin PO dari yang di centang aja*/
            $jumlah = $this->input->post("jumlah_produk".$checked);
            $split = explode(" ",$jumlah);
            $data = array(
                "id_submit_po" => $id_submit_po,
                "nama_produk_vendor" => $this->input->post("nama_produk_vendor".$checked),
                "harga_item" => $this->input->post("harga_satuan_produk".$checked),
                "jumlah_item" => $split[0],
                "satuan_item" => $split[1],
            );
            insertRow("po_item",$data);
        }
        redirect("crm/po");
    }
}
?>