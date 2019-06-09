<?php
class OC extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdquotation");
        $this->load->model("Mdorder_confirmation");
        $this->load->model("Mdquotation_item");
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
                ""
            )
        );
        $data = array(
            "oc" => $this->Mdorder_confirmation->select($where["oc"])
        );
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
            "id_quotation" => $this->input->post("id_quotation"),
            "id_oc" => $this->input->post("id_oc"),
            "no_oc" => $this->input->post("no_oc"),
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
                "status_oc_item" => 0
            );
            $this->Mdquotation_item->update($data,$where);
        }
        $where = array(
            "id_quotation" => $this->input->post("id_quotation"),
            "versi_quotation" => $this->input->post("versi_quo"),
        );
        $data = array(
            "status_quo" => 3 /*yang udah create oc, ditandain*/
        );
        $this->Mdquotation->update($data,$where);
        redirect("crm/oc");
    }   
}
?>