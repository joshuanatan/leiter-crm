<?php
class Margin extends CI_Controller{
    public function __construct(){
        parent::__construct();
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
        $where = array(
            "oc" => array(
                "status_oc" => 0
            )
        );
        $field = array(
            "oc" => array(
                "id_oc","no_oc","no_po_customer"
            )
        );
        $print = array(
            "oc" => array(
                "id_oc","no_oc","no_po_customer"
            )
        );
        $result["oc"] = selectRow("order_confirmation",$where["oc"]);
        $data["oc"] = foreachMultipleResult($result["oc"],$field["oc"],$print["oc"]);
        for($a = 0; $a< count($data["oc"]); $a++){
            $data["oc"][$a]["items"] = selectRow("quotation_item",array("id_oc" => $data["oc"][$a]["id_oc"]))->num_rows();
        }
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/margin/category-header");
        $this->load->view("finance/margin/category-body",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
    public function detail($id_oc){
        $where = array(
            "oc_item" => array(
                "id_oc" => $id_oc
            )
        );
        $field = array(
            "oc_item" => array(
                "id_quotation_item","id_request_item","final_amount","final_selling_price"
            )
        );
        $print = array(
            "oc_item" => array(
                "id_quotation_item","id_request_item","final_amount","final_selling_price"
            )
        );
        $result["oc_item"] = selectRow("quotation_item",$where["oc_item"]);
        $data["oc_item"] = foreachMultipleResult($result["oc_item"],$field["oc_item"],$print["oc_item"]);

        for($a = 0; $a< count($data["oc_item"]); $a++){
            $data["oc_item"][$a]["nama_item"] = get1Value("price_request_item","nama_produk",array("id_request_item" => $data["oc_item"][$a]["id_request_item"]));
            $data["oc_item"][$a]["jumlah_pesan"] = $data["oc_item"][$a]["final_amount"];
            $data["oc_item"][$a]["harga_jual"] = $data["oc_item"][$a]["final_selling_price"];
            
            $where["item_margin"] = array(
                "id_quotation_item" => $data["oc_item"][$a]["id_quotation_item"]
            );
            $field["item_margin"] = array(
                "margin_produk","harga_supplier","harga_shipping","harga_courier","notes_shipper","notes_supplier","notes_courier"
            );
            $print["item_margin"] = array(
                "margin_produk","harga_supplier","harga_shipping","harga_courier","notes_shipper","notes_supplier","notes_courier"
            );
            $result["item_margin"] = selectRow("item_margin",$where["item_margin"]);
            $data["item_margin"] = foreachResult($result["item_margin"],$field["item_margin"],$print["item_margin"]);
            if(count($data["item_margin"]) > 0){

                $data["oc_item"][$a]["harga_supplier"] = $data["item_margin"]["harga_supplier"];
                $data["oc_item"][$a]["harga_courier"] = $data["item_margin"]["harga_courier"];
                $data["oc_item"][$a]["harga_shipping"] = $data["item_margin"]["harga_shipping"];
                $data["oc_item"][$a]["notes_shipper"] = $data["item_margin"]["notes_shipper"];
                $data["oc_item"][$a]["notes_courier"] = $data["item_margin"]["notes_courier"];
                $data["oc_item"][$a]["notes_supplier"] = $data["item_margin"]["notes_supplier"];
                $data["oc_item"][$a]["margin"] = $data["item_margin"]["margin_produk"];
            }
            else{
                $insertMargin = array(
                    "id_quotation_item" => $data["oc_item"][$a]["id_quotation_item"],
                    "margin_produk" => 0,
                    "harga_supplier" => 0,
                    "harga_shipping" => 0,
                    "harga_courier" => 0,
                    "notes_supplier" => "-",
                    "notes_shipper" => "-",
                    "notes_courier" => "-",
                );
                insertRow("item_margin",$insertMargin);
                $data["oc_item"][$a]["harga_supplier"] = "0";
                $data["oc_item"][$a]["harga_courier"] = "0";
                $data["oc_item"][$a]["harga_shipping"] = "0";
                $data["oc_item"][$a]["margin"] = "0";
                $data["oc_item"][$a]["notes_supplier"] = "-";
                $data["oc_item"][$a]["notes_shipper"] = "-";
                $data["oc_item"][$a]["notes_courier"] = "-";
            }
        }
        $result["oc"] = selectRow("order_confirmation",$where["oc_item"]);
        $data["oc"] = foreachResult($result["oc"],array("no_po_customer","no_oc"),array("no_po_customer","no_oc"));
        $data["id_oc"] = $id_oc;
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
}

?>