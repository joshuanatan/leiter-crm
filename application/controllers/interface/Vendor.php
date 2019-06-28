<?php
class Vendor extends CI_Controller{
    public function getVendors(){
        $where = array(
            "harga_vendor.id_request_item" => $this->input->post("id_request_item"),
        );
        $field = array(
            "id_harga_vendor","nama_perusahaan","nama_cp"
        );
        $print = array(
            "id_harga_vendor","nama_perusahaan","nama_cp"
        );
        $result = selectRow("harga_vendor",$where);
        $data = foreachMultipleResult($result,$field,$print);
        echo json_encode($data);
    }
    
    public function getCouriers(){
        $this->session->id_request_item = $this->input->post("id_request_item");
        $where = array(
            "harga_courier.id_request_item" => $this->input->post("id_request_item")
        );
        $field = array(
            "id_harga_courier","nama_perusahaan","nama_cp"
        );
        $print = array(
            "id_harga_courier","nama_perusahaan","nama_cp"
        );
        $result = selectRow("harga_courier",$where);
        $data = foreachMultipleResult($result,$field,$print);
        
        echo json_encode($data);
    } 
    public function getVendorPrices(){
        $where = array(
            "id_harga_vendor" => $this->input->post("id_harga_vendor")
        );
        $field = array(
            "harga_produk","vendor_price_rate","mata_uang"
        );
        $print = array(
            "harga_produk","vendor_price_rate","mata_uang"
        );
        $result = selectRow("harga_vendor",$where);
        $data = foreachResult($result,$field,$print);

        echo json_encode($data);
    }
    public function getShipper(){ /*ajax response to get specific shippers based on chosen supplier and items */
        $where = array(
            "id_harga_vendor" => $this->input->post("id_harga_vendor")
        );
        $field = array(
            "metode_pengiriman","id_harga_shipping","nama_perusahaan"
        );
        $print = array(
            "metode_pengiriman","id_harga_shipping","nama_perusahaan"
        );
        $result = selectRow("harga_shipping",$where);
        $data = foreachMultipleResult($result,$field,$print);
        for($a = 0; $a<count($data); $a++){
            $data[$a]["metode_pengiriman"] = strtoupper($data[$a]["metode_pengiriman"]);
            $data[$a]["nama_perusahaan"] = ucwords($data[$a]["nama_perusahaan"]);
        }
        echo json_encode($data);
    }
    public function getCourierPrices(){ /*ini yang ajax di quotation*/
        $where = array(
            "id_harga_courier" => $this->input->post("id_harga_courier")
        );
        $field = array(
            "harga_produk","vendor_price_rate"
        );
        $print = array(
            "harga_produk","vendor_price_rate"
        );
        $result = selectRow("harga_courier",$where);
        $data = foreachResult($result,$field,$print);
        echo json_encode($data);
    }
    public function getShipperPrice(){ /*ini yang ajax di quotation*/
        $where = array(
            "id_harga_shipping" => $this->input->post("id_harga_shipping")
        );
        $field = array(
            "harga_produk","vendor_price_rate"
        );
        $print = array(
            "harga_produk","vendor_price_rate"
        );
        $result = selectRow("harga_shipping",$where);
        $data = foreachResult($result,$field,$print);
        echo json_encode($data);
    }
}
?>