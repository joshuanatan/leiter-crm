<?php
class Oc extends CI_Controller{
    public function getOcDetail($id_oc){
        $where = array(
            "id_oc" => $id_oc
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
    public function getOcItem(){
        $this->load->model("Mdquotation_item");
        $this->load->model("Mdod_core");
        $where = array(
            "item_oc" => array(
                "no_oc" => $this->input->post("no_oc")
            ),
            "od" => array(
                "no_oc" => $this->input->post("no_oc")
            )
        );
        $result["item_oc"] = selectRow("quotation_item",$where["item_oc"]); //ambil smua yang 1 oc dari quotation item
        $data["item_oc"] = foreachMultipleResult($result["item_oc"],array("id_request_item","item_amount","id_quotation_item"),array("id_request_item","item_amount","id_quotation_item"));
        for($a = 0; $a<count($data["item_oc"]); $a++){
            $data["item_oc"][$a]["nama_produk"] = get1Value("price_request_item","nama_produk", array("id_request_item" => $data["item_oc"][$a]["id_request_item"]));
            $data["item_oc"][$a]["terkirim"] = getTotal("od_item","item_qty",array("id_quotation_item" => $data["item_oc"][$a]["id_quotation_item"]));
            if($data["item_oc"][$a]["terkirim"] == "") $data["item_oc"][$a]["terkirim"] = 0;
            $data["item_oc"][$a]["final_amount"] = get1Value("quotation_item","final_amount",array("id_quotation_item" => $data["item_oc"][$a]["id_quotation_item"]));
        }
        /*
        $counter = 0 ;
        $result["od"] = $this->Mdod_core->select($where["od"]); /*ambil semua od yang ocnya terkair 
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
        }*/
        echo json_encode($data);
    }
}
?>