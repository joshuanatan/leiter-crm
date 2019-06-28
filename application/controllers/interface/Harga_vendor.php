<?php
class Harga_vendor extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    /* 
    method ini akan digunakan untuk mendapatkan harga supplier
    parameter: 
    -id_request_item (ini dikarenakan, harga supplier sangat terikat pada item dalam 1 RFQ)
    -id_supplier

    return value: harga_vendor
    */
    public function getSupplierPrice($id_request_item,$id_supplier){
        $where = array(
            "id_request_item" => $id_request_item,
            "id_perusahaan" => $id_supplier
        );
        $field = array(
            "harga_produk","vendor_price_rate"
        );
        $print = array(
            "harga_produk","vendor_price_rate"
        );
        $result = selectRow("harga_vendor",$where);
        $data = foreachResult($result,$field,$print);
        $harga_vendor = $data["harga_vendor"]*$data["vendor_price_rate"];
        echo json_encode($harga_vendor);
    }
    /*
    method ini ditujukan untuk mendapatkan harga dari setiap supplier dari 1 request item
    parameter: id_request_item
    return value: 
    -id_harga_vendor,
    -id_perusahaan,
    -id_cp,
    -harga_produk,
    -vendor_price_
    -rate,
    -mata_uang,
    -notes
    -harga_vendor = harga x kurs
    -nama_vendor
    -nama_cp
    -email_cp
    -nohp_cp
    */
    public function getEachSupplierPrice($id_request_item){
        $where = array(
            "id_request_item" => $id_request_item
        );
        $field = array(
            "id_harga_vendor","nama_perusahaan","nama_cp","harga_produk", "vendor_price_rate","mata_uang","notes","attachment"
        );
        $print = array(
            "id_harga_vendor","nama_perusahaan","nama_cp","harga_produk", "vendor_price_rate","mata_uang","notes","attachment"
        );
        $result = selectRow("harga_vendor",$where);
        $data = foreachMultipleResult($result,$field,$print);
        echo json_encode($data);
    }
    public function getEachCourierPrice($id_request_item){
        $where = array(
            "id_request_item" => $id_request_item
        );
        $field = array(
            "nama_perusahaan","nama_cp","harga_produk", "vendor_price_rate","mata_uang","notes","attachment","metode_pengiriman"
        );
        $print = array(
            "nama_perusahaan","nama_cp","harga_produk", "vendor_price_rate","mata_uang","notes","attachment","metode_pengiriman"
        );
        $result = selectRow("harga_courier",$where);
        $data = foreachMultipleResult($result,$field,$print);
        echo json_encode($data);
    }
    public function getEachShippingPrice($id_harga_vendor){
        $where = array(
            "id_harga_vendor" => $id_harga_vendor
        );
        $field = array(
            "nama_perusahaan","nama_cp","harga_produk", "vendor_price_rate","mata_uang","notes","attachment","metode_pengiriman"
        );
        $print = array(
            "nama_perusahaan","nama_cp","harga_produk", "vendor_price_rate","mata_uang","notes","attachment","metode_pengiriman"
        );
        $result = selectRow("harga_shipping",$where);
        $data = foreachMultipleResult($result,$field,$print);
        echo json_encode($data);
    }
    /*method ini digunakan untuk menginsert harga vendor*/
    public function insertVendorPrice(){
        $data = $this->input->post("harga_vendor_data");
        insertRow("harga_vendor",$data);
    }
}