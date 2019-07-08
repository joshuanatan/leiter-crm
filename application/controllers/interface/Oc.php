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
    public function getOcItem(){ /*dipake di PO*/ /*dipake di invoice*/ /*dipake di od*/
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
                "nama_oc_item","final_amount","satuan_produk","final_selling_price","id_oc_item"
            )
        );
        $result["item_oc"] = selectRow("order_confirmation_item",$where["item_oc"]); //ambil smua yang 1 oc dari quotation item
        $data["item_oc"] = foreachMultipleResult($result["item_oc"],$field["item_oc"],$field["item_oc"]);
        echo json_encode($data["item_oc"]);
    }
    public function getOcPaymentMethod($id_submit_oc){
        $where = array(
            "id_submit_oc" => $id_submit_oc
        );
        $result = selectRow("order_confirmation_metode_pembayaran",$where);
        $field = array(
            "id_metode_pembayaran","persentase_pembayaran","nominal_pembayaran","trigger_pembayaran","status_bayar","is_ada_transaksi","persentase_pembayaran2","nominal_pembayaran2","trigger_pembayaran2","status_bayar2","is_ada_transaksi2"
        );
        $data = foreachResult($result,$field,$field);
        echo json_encode($data);
    }
    
}
?>