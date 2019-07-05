<?php
class Quotation extends CI_Controller{
    public function addItemToQuotation(){
        $satuan = $this->input->post("satuan_produk");
        $split = explode(",",$satuan);
        $data = array(
            "id_submit_quotation" => $this->input->post("id_submit_quotation"),
            "id_request_item" => $this->input->post("id_request_item"),
            "nama_produk_leiter" => $this->input->post("nama_produk_leiter"),
            "gambar_item" => $this->input->post("gambar_item"),
            "id_harga_shipping" => $this->input->post("id_harga_shipping"),
            "id_harga_vendor" => $this->input->post("id_harga_vendor"),
            "id_harga_courier" => $this->input->post("id_harga_courier"),
            "item_amount" => $split[0], /*nanti ini hasil split*/
            "satuan_produk" => $split[1], /*nanti ini hasil split*/
            "selling_price" => $this->input->post("selling_price"),
            "margin_price" => $this->input->post("margin_price"),
        );
        insertRow("quotation_item",$data);
    }
    public function getQuotationItem(){
        $where = array(
            "no_quotation" => $this->input->post("no_quotation"),
            "versi_quotation" => $this->input->post("quo_version"),
        );  
        $field = array(
            "id_quotation_item","id_request_item","item_amount","selling_price","margin_price"
        );
        $print = array(
            "id_quotation_item","id_request_item","item_amount","selling_price","margin_price"
        );
        $result = selectRow("quotation_item",$where);
        $data = foreachMultipleResult($result,$field,$print);
        for($a = 0; $a<count($data);$a++){
            $data[$a]["nama_produk"] = get1Value("price_request_item","nama_produk",array("id_request_item" => $data[$a]["id_request_item"]));
            $data[$a]["selling_price"] = number_format($data[$a]["selling_price"]);
            $data[$a]["margin_price"] = number_format($data[$a]["margin_price"],2);
        }
        echo json_encode($data);
    }
    public function countTotalQuotationPrice(){
        $where = array(
            "no_quotation" => $this->input->post("no_quotation"),
            "versi_quotation" => $this->input->post("versi_quotation"),
        );
        //print_r($where);
        echo json_encode(getTotal("quotation_item","selling_price",$where));
    }
    public function getQuotationDetail(){
        $where = array(
            "no_quo" => $this->input->post("no_quo"),
            "versi_quo" => $this->input->post("versi_quo")
        );
        $result = selectRow("quotation",$where);
        $field = array(
            "id_perusahaan","id_cp","alamat_perusahaan","up_cp","durasi_pengiriman","durasi_pembayaran","franco"
        );
        $print = array(
            "id_perusahaan","id_cp","alamat_perusahaan","up_cp","durasi_pengiriman","durasi_pembayaran","franco"
        );
        $data = foreachResult($result,$field,$print);
        $data["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["id_perusahaan"]));
        $data["nama_cp"] = get1Value("contact_person","nama_cp",array("id_perusahaan" => $data["id_perusahaan"]));
        echo json_encode($data);
    }
    public function getOrderedItem(){
        //echo $this->input->post("no_quo");
        //echo $this->input->post("versi_quo");
        $where = array(
            "no_quotation" => $this->input->post("no_quo"),
            "versi_quotation" => $this->input->post("versi_quo")
        );
        $result = selectRow("quotation_item",$where);
        $field = array(
            "id_quotation_item","id_request_item","item_amount","selling_price","status_oc_item"
        );
        $print = array(
            "id_quotation_item","id_request_item","item_amount","selling_price","status_oc_item"
        );
        $data = foreachMultipleResult($result,$field,$print);
        for($a = 0; $a<count($data);$a++){
            $data[$a]["nama_produk"] = get1Value("price_request_item","nama_produk",array("id_request_item" => $data[$a]["id_request_item"]));
            $data[$a]["selling_price"] = number_format($data[$a]["selling_price"]);
        }
        echo json_encode($data);
    }
    public function getMetodePembayaran(){
        $where = array(
            "no_quotation" => $this->input->post("no_quo"),
            "versi_quotation" => $this->input->post("versi_quo")
        );
        $result = selectRow("metode_pembayaran",$where);
        $field = array(
            "persentase_pembayaran","nominal_pembayaran","trigger_pembayaran","persentase_pembayaran2","nominal_pembayaran2","trigger_pembayaran2","kurs"
        );
        $print = array(
            "persentase_pembayaran","nominal_pembayaran","trigger_pembayaran","persentase_pembayaran2","nominal_pembayaran2","trigger_pembayaran2","kurs"
        );
        $data = foreachResult($result,$field,$print);
        if($data["trigger_pembayaran"] == 1 ){
            $data["trigger_pembayaran"] = "SEBELUM PENGIRIMAN";
        }
        else{
            $data["trigger_pembayaran"] = "SESUDAH PENGIRIMAN";
        }
        if($data["trigger_pembayaran2"] == 1 ){

            $data["trigger_pembayaran2"] = "SEBELUM PENGIRIMAN";
        }
        else{
            $data["trigger_pembayaran2"] = "SESUDAH PENGIRIMAN";
        }
        echo json_encode($data);

    }

}
?>