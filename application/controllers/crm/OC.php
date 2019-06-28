<?php
class Oc extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdquotation");
        $this->load->model("Mdorder_confirmation");
        $this->load->model("Mdquotation_item");
        $this->load->model("Mdod_item");
        $this->load->model("Mdod_core");
        $this->load->model("Mdmetode_pembayaran");
    }
    /*defaul function*/
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
        $this->load->view("crm/print/oc");
    }
    public function pdf(){
        $this->load->view("crm/pdf/oc");
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("crm/oc/js/dynamic-form-js");
        $this->load->view("crm/oc/js/form-script");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    /*page*/
    public function index(){
        $this->req();
        $where = array(
            "oc" => array(
                "status_aktif_oc" => 0
            )
        );
        $field = array(
            "oc" => array(
                "no_quotation","versi_quotation","no_po_customer","no_oc","id_oc","bulan_oc","tahun_oc"
            )
        );
        $print = array(
            "oc" => array(
                "no_quotation","versi_quotation","no_po_customer","no_oc","id_oc","bulan_oc","tahun_oc"
            )
        );
        $result["oc"] = selectRow("order_confirmation",$where["oc"]);
        $data["oc"]= foreachMultipleResult($result["oc"],$field["oc"],$print["oc"]);
        for($a = 0; $a<count($data["oc"]);$a++){
            $data["oc"][$a]["id_perusahaan"] = get1Value("quotation","id_perusahaan",array("no_quo" => $data["oc"][$a]["no_quotation"]));
            $data["oc"][$a]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["oc"][$a]["id_perusahaan"]));
            $data["oc"][$a]["id_cp"] = get1Value("quotation","id_cp",array("no_quo" => $data["oc"][$a]["no_quotation"]));
            $data["oc"][$a]["nama_cp"] = get1Value("contact_person","nama_cp",array("id_cp" => $data["oc"][$a]["id_cp"]));
            $data["oc"][$a]["jumlah_item"] = getAmount("quotation_item","id_quotation_item",array("no_oc" => $data["oc"][$a]["no_oc"])); 
        }
        $this->load->view("crm/content-open");
        $this->load->view("crm/oc/category-header");
        $this->load->view("crm/oc/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function create(){
        $where = array(
            "oc" => array(
                "status_quo" => 2,
                
            )   
        );
        $result["oc"] = selectRow("quotation",$where["oc"]);
        $data["oc"] = foreachMultipleResult($result["oc"],array("no_quo","versi_quo"),array("no_quo","versi_quo"));
        $data["maxId"] = getMaxId("order_confirmation","id_oc",array("bulan_oc" => date("m"), "tahun_oc" => date("Y")));
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/oc/category-header");
        $this->load->view("crm/oc/add-oc",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    /*function*/
    public function insertoc(){
        /*data OC*/
        $no_quotation = $this->input->post("no_quotation");
        $splitQuotation = explode(",",$no_quotation);
        $data = array(
            "no_oc" => $this->input->post("no_oc"),
            "id_oc" => $this->input->post("id_oc"),
            "no_quotation" => $splitQuotation[0],
            "versi_quotation" => $splitQuotation[1],
            "no_po_customer" => $this->input->post("no_po"),
            "id_user_add" => $this->session->id_user,
            "bulan_oc" => date("m"),
            "tahun_oc" => date("Y")
        );
        insertRow("order_confirmation",$data);

        $items = array(
            $this->input->post("id_quotation_item"),
            $this->input->post("amount"),
            $this->input->post("finalPrice"),
        );
        $itemArray = array(
            array(), /*id_quotation_item [0] */ 
            array(), /*amount [1] */
            array()  /*final price [2] */
        );
        for($b = 0; $b<count($itemArray); $b++){
            $c = 0;
            foreach($items[$b] as $a){
                $itemArray[$b][$c] = $a;
                $c++;
            }
        }
        
        $options = $this->input->post("checkbox");
        foreach($options as $a){
            $where = array(
                "id_quotation_item" => $itemArray[0][$a]
            );
            $data = array(
                "final_amount" => $itemArray[1][$a],
                "final_selling_price" => splitterMoney($itemArray[2][$a],","),
                "status_oc_item" => 0,
                "no_oc" => $this->input->post("no_oc")
            );
            updateRow("quotation_item",$data,$where);
        }
        $where = array(
            "no_quo" => $splitQuotation[0],
            "versi_quo" => $splitQuotation[1],
        );
        $data = array(
            "status_quo" => 3 /*yang udah create oc, ditandain*/
        );
        updateRow("quotation",$data,$where);
        /*masukin ke invoice*/
        $where = array(
            "no_quotation" => $splitQuotation[0],
            "versi_quotation" => $splitQuotation[1]
        );
        $data = array(
            "no_oc" => $this->input->post("no_oc"),
            
        ); 
        updateRow("metode_pembayaran",$data,$where);
        redirect("crm/oc");
    }   
    public function delete($id_oc){
        $where = array("id_oc" => $id_oc);
        $data = array("status_oc" => 1);
        $this->Mdorder_confirmation->update($data,$where);
        redirect("crm/oc");
    }
    public function getOcDetail(){
        $where = array(
            "id_oc" => $this->input->post("id_oc")
        );
        $result = $this->Mdorder_confirmation->select($where);
        foreach($result->result() as $a){
            $data = array(
                "no_po" => $a->no_po_customer,
                "nama_perusahaan" => strtoupper($a->nama_perusahaan),
                "nama_customer" => ucwords($a->nama_cp),
                "franco" => $a->franco,
                "up_cp" => $a->up_cp
            );    
        }
        echo json_encode($data);
    }
    public function accepted($id_oc,$bulan,$tahun){
        $where = array(
            "id_oc" => $id_oc,
            "bulan_oc" => $bulan,
            "tahun_oc" => $tahun
        );
        $data = array(
            "status_oc" => 2
        );
        updateRow("order_confirmation",$data,$where);
        redirect("crm/oc");
    }
    public function getOcItem(){
        $where = array(
            "item_oc" => array(
                "id_oc" => $this->input->post("id_oc")
            ),
            "od" => array(
                "id_oc" => $this->input->post("id_oc")
            )
        );
        $result["item_oc"] = $this->Mdquotation_item->select($where["item_oc"]);
        $counter = 0 ;
        $result["od"] = $this->Mdod_core->select($where["od"]); /*ambil semua od yang ocnya terkair */
        $result["jumlah"] = array();
        foreach($result["od"]->result() as $idOd){
            $result["jumlah"][$counter] = get1Value("od_item","item_qty",array("id_od" => $idOd->id_od));
            $counter++;
        }
        $data = array();
        $counter = 0;
        foreach($result["item_oc"]->result() as $a){
            $data[$counter] = array(
                "id_quotation_item" => $a->id_quotation_item,
                "nama_produk" => $a->nama_produk,
                "jumlah_pesan" => $a->final_amount,
                "terkirim" => array_sum($result["jumlah"]),
                "uom" => $a->satuan_produk
            );
            $counter ++;
        }
        echo json_encode($data);
    }
}
?>