<?php
class Od extends CI_Controller{
    public function isExists($no_od){
        $where = array(
            "no_od" => $no_od
        );
        echo json_encode(isExistsInTable("od_core",$where));

    }  
    public function getOd(){
        $where = array(
            "no_oc" => $this->input->post("no_oc")
        );
        $field = array(
            "id_od","no_od"
        );
        $print = array(
            "id_od","no_od"
        );
        $result = selectRow("od_core",$where);
        $data = foreachMultipleResult($result,$field,$print);
        
        echo json_encode($data);
    }
    public function getOdItemPayment(){
        $total = 0;
        $where = array(
            "id_od" => $this->input->post("id_od") /*1 od bisa banyak item*/
        );
        //echo $this->input->post("id_od");
        $field = array(
            "id_od_item","id_od","id_quotation_item","item_qty"
        );
        $print = array(
            "id_od_item","id_od","id_quotation_item","item_qty"
        );
        $result = selectRow("od_item",$where);
        $data = foreachMultipleResult($result,$field,$print); /*1 od bisa banyak item*/
        $no_oc = get1Value("od_core","no_oc",$where);
        for($a = 0; $a<count($data);$a++){ /*puter setiap item*/
            /*ambil harga, item, dan nama produk tiap item*/
            $sellingPrice = get1Value("quotation_item","final_selling_price",array("id_quotation_item" => $data[$a]["id_quotation_item"]));
            $finalAmount = get1Value("quotation_item","final_amount",array("id_quotation_item" => $data[$a]["id_quotation_item"]));
            $persenSisa = get1Value("metode_pembayaran","persentase_pembayaran2",array("no_oc" => $no_oc));

            $id_produk = get1Value("quotation_item","id_request_item",array("id_quotation_item" => $data[$a]["id_quotation_item"]));
            $nama_produk = get1Value("price_request_item","nama_produk",array("id_request_item" => $id_produk));
            /*untuk nama produk*/

            /*butuh yang barang yang dianter*/
            $item_qty = get1Value("od_item","item_qty",array("id_od" => $this->input->post("id_od"))); /* cari OD based on id_quotation dan id_od */
            $data[$a]["nama_produk"] = $nama_produk;
            $data[$a]["item_qty"] = $item_qty."/".$finalAmount;
            $data[$a]["selling_price"] = number_format($sellingPrice);
            $data[$a]["final_price"] = number_format((($item_qty*$sellingPrice)/$finalAmount)*($persenSisa/100));
            $total += (($item_qty*$sellingPrice)/$finalAmount)*($persenSisa/100);
        }
        $this->session->totalinvoice = $total;
        echo json_encode($data);
    }
    /*************************************************************** */
    public function getSentItemAmount(){
        $where = array(
            "id_oc_item" => $this->input->post("id_oc_item")
        );
        $jumlah_terkirim = 0;
        $jumlah_terkirim = getTotal("od_item","item_qty",$where);
        echo json_encode(array("jumlah_terkirim" => $jumlah_terkirim));
    }
}
?>