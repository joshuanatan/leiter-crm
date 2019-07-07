<?php
class Oc extends CI_Controller{ 
    public function loadPoDetail($no_po_customer){
        $where = array(
            "no_po_customer" => $no_po_customer
        );
        $field = array(
            "no_po_customer","no_quotation","versi_quotation"
        );
        $print = array(
            "no_po_customer","no_quotation","versi_quotation"
        );
        $result = selectRow("order_confirmation",$where);
        $data = foreachResult($result,$field,$print);
        echo json_encode($data);
    }  
    public function getOcItem(){ /*dipake di PO*/
        $this->load->model("Mdquotation_item");
        $this->load->model("Mdod_core");
        $where = array(
            "item_oc" => array(
                "id_submit_oc" => $this->input->post("id_submit_oc"),
                "status_oc_item" => 0
            ),
            "od" => array(
                "id_submit_oc" => $this->input->post("id_submit_oc")
            )
        );
        $field = array(
            "item_oc" => array(
                "nama_oc_item","final_amount","satuan_produk","final_selling_price"
            )
        );
        $result["item_oc"] = selectRow("order_confirmation_item",$where["item_oc"]); //ambil smua yang 1 oc dari quotation item
        $data["item_oc"] = foreachMultipleResult($result["item_oc"],$field["item_oc"],$field["item_oc"]);
        echo json_encode($data["item_oc"]);
    }
    
}
?>