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

        $this->load->library('Pdf_oc');
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
    public function index(){
        $where["purchase_order"] = array(
            "status_aktif_po" => 0
        );
        $field["purchase_order"] = array(
            "id_submit_po","no_po","id_supplier","id_shipper","shipping_method","total_supplier_payment","id_submit_oc","requirement_date","destination","date_po_core_add","id_cp_supplier","id_cp_shipper","shipping_term","mata_uang_pembayaran"
        );
        $result["purchase_order"] = $this->Mdpo_core->getListPo($where["purchase_order"]);
        $data["purchase_order"] = foreachMultipleResult($result["purchase_order"],$field["purchase_order"],$field["purchase_order"]);
        for($a = 0; $a<count($data["purchase_order"]); $a++){
            $data["purchase_order"][$a]["nama_supplier"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["purchase_order"][$a]["id_supplier"]));
            $data["purchase_order"][$a]["nama_pic_supplier"] = get1Value("contact_person","nama_cp",array("id_cp" => $data["purchase_order"][$a]["id_cp_supplier"]));

            $data["purchase_order"][$a]["nama_shipper"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["purchase_order"][$a]["id_shipper"]));
            $data["purchase_order"][$a]["nama_pic_shipper"] = get1Value("contact_person","nama_cp",array("id_cp" => $data["purchase_order"][$a]["id_cp_shipper"]));
            
            $id_submit_quotation = get1Value("order_confirmation","id_submit_quotation", array("id_submit_oc" => $data["purchase_order"][$a]["id_submit_oc"]));
            $id_submit_request = get1Value("quotation","id_request",array("id_submit_quotation" => $id_submit_quotation));
            $id_perusahaan = get1Value("price_request","id_perusahaan",array("id_submit_request" => $id_submit_request));
            $id_cp = get1Value("price_request","id_cp",array("id_submit_request" => $id_submit_request));

            $data["purchase_order"][$a]["nama_perusahaan"] = array("perusahaan","nama_perusahaan",array("id_perusahaan" => $id_perusahaan));
            $data["purchase_order"][$a]["nama_cp"] = array("contact_person","nama_cp",array("id_cp" => $id_cp));

            $where["po_item"] = array(
                "id_submit_po" => $data["purchase_order"][$a]["id_submit_po"]
            );
            $field["po_item"] = array(
                "nama_produk_vendor","harga_item","jumlah_item","satuan_item","id_oc_item"
            );
            $result["po_item"] = selectRow("po_item",$where["po_item"]);
            $data["purchase_order"][$a]["items"] = foreachMultipleResult($result["po_item"],$field["po_item"],$field["po_item"]);
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
    
    public function create(){ //sudah di tes
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
    public function insertPo(){ //sudah dites
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
            "notify_party" => $this->input->post("notify_party"),
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
                "harga_item" => splitterMoney($this->input->post("harga_satuan_produk".$checked),","),
                "jumlah_item" => $split[0],
                "satuan_item" => $split[1],
                "id_oc_item" => $this->input->post("id_oc_item".$checked)
            );
            insertRow("po_item",$data);
        }
        redirect("crm/po");
    }
    public function edit($id_submit_po){ //sudah di cek
        $where["main"] = array(
            "id_submit_po" => $id_submit_po
        );
        $field["po_core"] = array(
            "id_submit_oc","id_submit_po","no_po","id_supplier","id_cp_supplier","id_shipper","id_cp_shipper","shipping_method","shipping_term","requirement_date","destination","mata_uang_pembayaran","notify_party"
        );
        $result["po_core"] = selectRow("po_core", $where["main"]);
        $data["po_core"] = foreachResult($result["po_core"],$field["po_core"],$field["po_core"]);

        /*detail oc dan pencarian customer*/
        $id_submit_quotation = get1Value("order_confirmation","id_submit_quotation",array("id_submit_oc" => $data["po_core"]["id_submit_oc"]));
        $id_submit_request = get1Value("quotation","id_request", array("id_submit_quotation" => $id_submit_quotation));
        $id_customer = get1Value("price_request","id_perusahaan",array("id_submit_request" => $id_submit_request));
        $id_pic_customer = get1Value("price_request","id_cp",array("id_submit_request" => $id_submit_request));
        $data["po_core"]["nama_customer"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $id_customer));
        $data["po_core"]["nama_pic_customer"] = get1Value("contact_person","nama_cp",array("id_cp" => $id_pic_customer));

        $data["po_core"]["no_po_customer"] = get1Value("order_confirmation","no_po_customer",array("id_submit_oc" => $data["po_core"]["id_submit_oc"]));
        /*end detail oc dan pencarian customer*/

        /*detail supplier*/
        $where["detail_supplier"] = array(
            "id_perusahaan" => $data["po_core"]["id_supplier"]
        );
        $field["detail_supplier"] = array(
            "nofax_perusahaan","alamat_perusahaan","notelp_perusahaan"
        );
        $result["detail_supplier"] = selectRow("perusahaan",$where["detail_supplier"]);
        $data["detail_supplier"] = foreachResult($result["detail_supplier"],$field["detail_supplier"],$field["detail_supplier"]);
        /*end supplier*/

        /*detail shipper*/
        $where["detail_shipper"] = array(
            "id_perusahaan" => $data["po_core"]["id_shipper"]
        );
        $field["detail_shipper"] = array(
            "notelp_perusahaan","nofax_perusahaan","alamat_perusahaan"
        );
        $result["detail_shipper"] = selectRow("perusahaan",$where["detail_shipper"]);
        $data["detail_shipper"] = foreachResult($result["detail_shipper"],$field["detail_shipper"],$field["detail_shipper"]);

        /*end shipper*/

        
        $field["perusahaan"] = array(
            "nama_perusahaan","id_perusahaan"
        );
        /*load list supplier*/
        $where["supplier"] = array(
            "status_perusahaan" => 0,
            "peran_perusahaan" => "PRODUK"
        );
        $result["supplier"] = selectRow("perusahaan",$where["supplier"]);
        $data["supplier"] = foreachMultipleResult($result["supplier"],$field["perusahaan"],$field["perusahaan"]);
        /*end load list supplier*/

        /*load list shipper*/
        $where["shipper"] = array(
            "status_perusahaan" => 0,
            "peran_perusahaan" => "SHIPPING"
        );
        $result["shipper"] = selectRow("perusahaan",$where["shipper"]);
        $data["shipper"] = foreachMultipleResult($result["shipper"],$field["perusahaan"],$field["perusahaan"]);
        /*end load list supplier*/

        $field["cp"] = array(
            "nama_cp","id_cp"
        );
        /*load list supplier*/
        $where["pic_supplier"] = array(
            "status_cp" => 0,
            "id_perusahaan" => $data["po_core"]["id_supplier"]
        );
        $result["pic_supplier"] = selectRow("contact_person",$where["pic_supplier"]);
        $data["pic_supplier"] = foreachMultipleResult($result["pic_supplier"],$field["cp"],$field["cp"]);
        /*end load list supplier*/

        /*load list shipper*/
        $where["pic_shipper"] = array(
            "status_cp" => 0,
            "id_perusahaan" => $data["po_core"]["id_shipper"]
        );
        $result["pic_shipper"] = selectRow("contact_person",$where["pic_shipper"]);
        $data["pic_shipper"] = foreachMultipleResult($result["pic_shipper"],$field["cp"],$field["cp"]);
        /*end load list supplier*/

        /*load item dari oc*/
        $where["items"] = array(
            "status_oc_item" => 0,
            "id_submit_oc" => $data["po_core"]["id_submit_oc"]
        );
        $field["items"] = array(
            "nama_oc_item","final_selling_price","final_amount","satuan_produk","id_oc_item"
        );
        $result["items"] = selectRow("order_confirmation_item",$where["items"]);
        $data["items"] = foreachMultipleResult($result["items"],$field["items"],$field["items"]);

        /*ngecek apakah sudah ada pemesanan atau belum, beserta ambil jumlahnya*/
        for($items = 0; $items < count($data["items"]); $items++){
            /*cek dan langsung masukin statusnya apakh dia atau tidak, kalau ada, in_po = 0; else in_po = 1;*/
            $data["items"][$items]["in_po"] = isExistsInTable("po_item",array("id_oc_item" => $data["items"][$items]["id_oc_item"]));
            if($data["items"][$items]["in_po"] == 0) { //kalau ada  
                $data["items"][$items]["jumlah_item"] = get1Value("po_item","jumlah_item",array("id_oc_item" => $data["items"][$items]["id_oc_item"]));
                $data["items"][$items]["satuan_item"] = get1Value("po_item","satuan_item",array("id_oc_item" => $data["items"][$items]["id_oc_item"]));
                $data["items"][$items]["nama_produk_vendor"] = get1Value("po_item","nama_produk_vendor",array("id_oc_item" => $data["items"][$items]["id_oc_item"]));
                $data["items"][$items]["harga_item"] = get1Value("po_item","harga_item",array("id_oc_item" => $data["items"][$items]["id_oc_item"]));
            }
            else{
                $data["items"][$items]["jumlah_item"] = 0;
                $data["items"][$items]["satuan_item"] = $data["items"][$items]["satuan_produk"];
                $data["items"][$items]["nama_produk_vendor"] = "";
                $data["items"][$items]["harga_item"] = 0;
            }
        }
        /*end load item dari oc*/
        /*end ngecek apakah sudah ada pemesanan atau belum, beserta ambil jumlahnya*/
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/po/category-header");
        $this->load->view("crm/po/edit-po",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function editPo(){ //sudah di cek
        $where["main"] = array(
            "id_submit_po" => $this->input->post("id_submit_po")
        );
        $data["po_core"] = array(
            "id_supplier" => $this->input->post("id_supplier"),
            "id_cp_supplier" => $this->input->post("id_cp_supplier"),
            "id_shipper" => $this->input->post("id_shipper"),
            "id_cp_shipper" => $this->input->post("id_cp_shipper"),
            "shipping_method" => $this->input->post("shipping_method"),
            "shipping_term" => $this->input->post("shipping_term"),
            "requirement_date" => $this->input->post("requirement_date"), 
            "notify_party" => $this->input->post("notify_party"), 
            "destination" => $this->input->post("destination"),
            "mata_uang_pembayaran" => $this->input->post("mata_uang_pembayaran"),
        );
        updateRow("po_core",$data["po_core"],$where["main"]);
        
        /*delete po item yang sudah ada*/
        deleteRow("po_item",$where["main"]);
        /* end delete po item yang sudah ada*/

        /*ngambil yang di checks*/
        $checks = $this->input->post("checks");
        foreach($checks as $checked){ /*ngambil row yang di check*/
            $jumlah = $this->input->post("jumlah_produk".$checked);
            $split = explode(" ",$jumlah);
            $data["po_item"] = array(
                "id_submit_po" => $this->input->post("id_submit_po"),
                "id_oc_item" => $this->input->post("id_oc_item".$checked),
                "nama_produk_vendor" => $this->input->post("nama_produk_vendor".$checked),
                "harga_item" => splitterMoney($this->input->post("harga_satuan_produk".$checked),","),
                "jumlah_item" => $split[0],
                "satuan_item" => $split[1],
            );
            insertRow("po_item",$data["po_item"]);
            /*masukin po item*/
        }   
        redirect("crm/po");
    }
    function poPdf($id_submit_po){ //sudah di cek
        $where = array(
            "id_submit_po" => $id_submit_po,
        );
        $this->load->model('M_pdf_po');
        $purchaseorder = $this->M_pdf_po->selectPo($where);
        $vendorr= $this->M_pdf_po->selectVendor($where);
        $custt= $this->M_pdf_po->selectCust($where);
        $barangg= $this->M_pdf_po->selectBarang($where);
        $data = array(
            "purchaseorder"=>$purchaseorder,
            "vendor"=>$vendorr,
            "customer"=>$custt,
            "barang"=>$barangg,
            "mata_uang" => get1Value("po_core","mata_uang_pembayaran",array("id_submit_po" => $id_submit_po)),
            "notify_party" => get1Value("po_core","notify_party",array("id_submit_po" => $id_submit_po))
        );
        $this->load->view('crm/po/pdf_po',$data);
    }
    public function delete($id_submit_po){ //sudah di cek
        $where = array(
            "id_submit_po" => $id_submit_po
        );
        $data = array(
            "status_aktif_po" => 1
        );
        updateRow("po_core",$data,$where);
        redirect("crm/po");
    }
}
?>