<?php
class OC extends CI_Controller{
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
                "status_oc" => 0
            )
        );
        $result["oc"] = $this->Mdorder_confirmation->select($where["oc"]);
        $data["oc"] = array();
        $counter = 0;
        foreach($result["oc"]->result() as $a){
            $data["oc"][$counter] = array(
                "id_oc" => $a->id_oc,
                "no_oc" => $a->no_oc,
                "no_quotation" => get1Value("quotation","no_quo", array("id_quo" => $a->id_quotation)),
                "versi_quotation" => $a->versi_quotation,
                "nama_perusahaan" => get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => get1Value("quotation","id_perusahaan",array("id_quo" => $a->id_quotation, "versi_quo" => $a->versi_quotation)))),
                "nama_cp" => get1Value("contact_person","nama_cp",array("id_cp" => get1Value("quotation","id_cp",array("id_quo" => $a->id_quotation, "versi_quo" => $a->versi_quotation)))),
                "no_po" => $a->no_po_customer,
                "jumlah_item"=> getAmount("quotation_item","id_request_item",array("id_quotation" => $a->id_quotation,"quo_version" => $a->versi_quotation,"status_oc_item" => 0))
            );
            $counter++;
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
                "status_quo" => 2
            )   
        );
        $data = array(
            "oc" => $this->Mdquotation->select($where["oc"]),
            "maxId" => $this->Mdorder_confirmation->maxId()
        );
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
        $data = array(
            "id_oc" => $this->input->post("id_oc"),
            "no_oc" => $this->input->post("no_oc"),
            "id_quotation" => $this->input->post("id_quotation"),
            "versi_quotation" => $this->input->post("versi_quo"),
            "no_po_customer" => $this->input->post("no_po"),
            "id_user_add" => $this->session->id_user
        );
        $this->Mdorder_confirmation->insert($data);
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
                "final_selling_price" => $itemArray[2][$a],
                "status_oc_item" => 0,
                "id_oc" => $this->input->post("id_oc")
            );
            $this->Mdquotation_item->update($data,$where);
        }
        $id_quotation_versi = $this->input->post("id_quotation");
        $split = explode("-",$id_quotation_versi);
        $where = array(
            "id_quo" => $split[0],
            "versi_quo" => $split[1]
        );
        $data = array(
            "status_quo" => 3 /*yang udah create oc, ditandain*/
        );
        $this->Mdquotation->update($data,$where);

        /*masukin ke invoice*/
        $where = array(
            "id_quotation" => $split[0],
            "id_versi" => $split[1]
        );
        $data = array(
            "id_oc" => $this->input->post("id_oc"),
            
        ); 
        $this->Mdmetode_pembayaran->update($data,$where);
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
    public function accepted($id_oc){
        $where = array(
            "id_oc" => $id_oc
        );
        $data = array(
            "status_oc" => 2
        );
        $this->Mdorder_confirmation->update($data,$where);
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