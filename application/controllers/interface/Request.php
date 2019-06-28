<?php
class Request extends CI_Controller{
    public function getRequestDetail(){
        $where = array(
            "price_request.no_request" => $this->input->post("no_request")
        );
        $field["price_request"] = array(
            "id_perusahaan","id_cp","franco",
        );
        $print["price_request"] = array(
            "id_perusahaan","id_cp","franco",
        );
        $result = selectRow("price_request",$where);
        $data["price_request"] = foreachResult($result,$field["price_request"],$print["price_request"]);

        $data["price_request"]["nama_perusahaan"] = strtoupper(get1Value("perusahaan","nama_perusahaan", array("id_perusahaan" => $data["price_request"]["id_perusahaan"])));

        $data["price_request"]["nama_cp"] = strtoupper(get1Value("contact_person","nama_cp", array("id_perusahaan" => $data["price_request"]["id_perusahaan"])));

        $data["price_request"]["alamat_perusahaan"] = get1Value("perusahaan","alamat_perusahaan", array("id_perusahaan" => $data["price_request"]["id_perusahaan"]));

        if($data["price_request"]["alamat_perusahaan"] == "") {
            $data["price_request"]["alamat_perusahaan"] = "NO ADDRESS, NEW CUSTOMER";
        }

        
        $where = array(
            "price_request_item.no_request" => $this->input->post("no_request"),
            "price_request_item.status_request_item" => 0
        );
        $field["price_request_item"] = array(
            "id_request_item","nama_produk","jumlah_produk","notes_produk","file"
        );
        $print["price_request_item"] = array(
            "id_request_item","nama_produk","jumlah_produk","notes_produk","file"
        );
        $result = selectRow("price_request_item",$where); /*ambil semua data price request item*/
        $data["price_request_item"] = foreachMultipleResult($result,$field["price_request_item"],$print["price_request_item"]);
        
        /* -------------------------------------------------------------------------------- */
        echo json_encode($data);
    }
    public function getAmountOrders(){
        $where = array(
            "id_request_item" => $this->input->post("id_request_item")
        );
        $data = get1Value("price_request_item","jumlah_produk",$where);
        echo json_encode($data);
    }
    
}
?>