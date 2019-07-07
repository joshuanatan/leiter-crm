<?php
class Oc extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdquotation");
        $this->load->model("Mdorder_confirmation");
        $this->load->model("Mdquotation_item");
        $this->load->model("Mdod_item");
        $this->load->model("Mdod_core");
        $this->load->model("Mdmetode_pembayaran");
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
    public function print(){
        $this->load->view("crm/print/oc");
    }
    public function pdf(){
        $this->load->view("crm/pdf/oc");
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
                "status_aktif_oc" => 0
            )
        );
        $field = array(
            "oc" => array(
                "id_submit_quotation","no_po_customer","no_oc","id_oc","bulan_oc","tahun_oc","id_submit_oc","tgl_po_customer"
            )
        );
        $result["oc"] = selectRow("order_confirmation",$where["oc"]);

        $data["oc"]= foreachMultipleResult($result["oc"],$field["oc"],$field["oc"]);
        for($a = 0; $a<count($data["oc"]);$a++){
            $id_submit_request = get1Value("quotation","id_request",array("id_submit_quotation" => $data["oc"][$a]["id_submit_quotation"]));
            $data["oc"][$a]["id_perusahaan"] = get1Value("price_request","id_perusahaan",array("id_submit_request" => $id_submit_request));
            $data["oc"][$a]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["oc"][$a]["id_perusahaan"]));
            
            $id_submit_request = get1Value("quotation","id_request",array("id_submit_quotation" => $data["oc"][$a]["id_submit_quotation"]));
            $data["oc"][$a]["id_cp"] = get1Value("price_request","id_cp",array("id_submit_request" => $id_submit_request));
            $data["oc"][$a]["nama_cp"] = get1Value("contact_person","nama_cp",array("id_cp" => $data["oc"][$a]["id_cp"]));

            $data["oc"][$a]["no_quotation"] = get1Value("quotation","no_quotation",array("id_submit_quotation" => $data["oc"][$a]["id_submit_quotation"]));
            $data["oc"][$a]["jumlah_item"] = getAmount("order_confirmation_item","id_oc_item",array("id_submit_oc" => $data["oc"][$a]["id_submit_oc"],"status_oc_item" => 0)); 
        }
        $this->load->view("crm/content-open");
        $this->load->view("crm/oc/category-header");
        $this->load->view("crm/oc/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function create(){
        $where = array(
            "oc" => array(
                "status_quotation" => 2,
            )   
        );
        $field = array(
            "oc" => array(
                "id_submit_quotation","no_quotation"
            )
        );
        $result["oc"] = selectRow("quotation",$where["oc"]);
        $data["oc"] = foreachMultipleResult($result["oc"],$field["oc"],$field["oc"]);
        for($a = 0; $a<count($data["oc"]); $a++){
            $data["oc"][$a]["id_submit_request"] = get1Value("quotation","id_request",array("id_submit_quotation" => $data["oc"][$a]["id_submit_quotation"]));
            $data["oc"][$a]["id_perusahaan"] = get1Value("price_request","id_perusahaan",array("id_submit_request" => $data["oc"][$a]["id_submit_request"]));
            $data["oc"][$a]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["oc"][$a]["id_perusahaan"]));
        }
        $data["maxId"] = getMaxId("order_confirmation","id_oc",array("bulan_oc" => date("m"), "tahun_oc" => date("Y")));
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/oc/category-header");
        $this->load->view("crm/oc/add-oc",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    /*function*/
    public function insertoc(){
        /*insert ke oc tanpa total_oc_price*/
        $data = array(
            "id_submit_quotation" => $this->input->post("id_submit_quotation"),
            "id_oc" => $this->input->post("id_oc"),
            "bulan_oc" => date("m"),
            "tahun_oc" => date("Y"),
            "no_oc" => $this->input->post("no_oc"),
            "no_po_customer" => $this->input->post("no_po_customer"),
            "tgl_po_customer" => $this->input->post("tgl_po_customer"),
            "total_oc_price" => 0,
            "up_cp" => $this->input->post("up_cp"),
            "durasi_pembayaran" => $this->input->post("durasi_pembayaran"),
            "durasi_pengiriman" => $this->input->post("durasi_pengiriman"),
            "metode_pengiriman" => $this->input->post("metode_pengiriman"),
            "total_oc_price" => splitterMoney($this->input->post("total_oc_price"),","),
            "franco" => $this->input->post("franco"),
            "id_user_add" => $this->session->id_user
        );
        $id_submit_oc = insertRow("order_confirmation",$data);
        /*insert ke item oc*/
        $checks = $this->input->post("checkbox");
        $id_quotation_item = $this->input->post("id_quotation_item");
        $nama_oc_item = $this->input->post("nama_oc_item");
        $final_amount = $this->input->post("final_amount");
        $final_selling_price = $this->input->post("final_selling_price");
        
        /*sekarang masukin per item detailnya*/
        $category = array();
        $is_checked = array();
        $urutan = 0;
        foreach($checks as $checked){
            $is_checked[$urutan] = $checked; /*nampung id yang ke checked pake value (urutan baris dari 0 - ... di front end) */
            $urutan++;
        }
        $urutan = 0;
        foreach($id_quotation_item as $a){
            $category[$urutan]["id_quotation_item"] = $a; /*variable ini urutan 1, 2, 3, 4, dst*/
            $urutan++;
        }
        $urutan = 0;
        foreach($nama_oc_item as $a){
            $category[$urutan]["nama_oc_item"] = $a; /*variable ini urutan 1, 2, 3, 4, dst*/
            $urutan++;
        }
        $urutan = 0;
        foreach($final_amount as $a){
            $category[$urutan]["final_amount"] = $a; /*variable ini urutan 1, 2, 3, 4, dst*/
            $urutan++;
        }
        $urutan = 0;
        foreach($final_selling_price as $a){
            $category[$urutan]["final_selling_price"] = $a; /*variable ini urutan 1, 2, 3, 4, dst*/
            $urutan++;
        }
        for($a = 0; $a<count($category); $a++){ /*ngontrol jumlah barang karena semua item ada ngepost baik dipilih atau tidak didepan*/
            $split = explode(" ",$category[$a]["final_amount"]); /*mecahin final amountnya dari urutan ini*/
            $items[$a] = array(/*barang 1, 2, 3, 4, ... */
                "id_submit_oc" => $id_submit_oc,
                "id_quotation_item" => $category[$a]["id_quotation_item"], /*quotation barang 1*/
                "nama_oc_item" => $category[$a]["nama_oc_item"], /*nama produk oc barang 1*/
                "final_amount" => $split[0], /*3*/
                "satuan_produk" => $split[1], /*meter*/
                "final_selling_price" =>splitterMoney($category[$a]["final_selling_price"],","),
            );
            $id_oc_item = insertRow("order_confirmation_item",$items[$a]);
            if(in_array($a,$is_checked)){ /*kalau yang urutan baris/item ada di array is_checked*/
                $where = array(
                    "id_oc_item" => $id_oc_item
                );
                $data =  array(
                    "status_oc_item" => 0
                );
                updateRow("order_confirmation_item",$data,$where);
            }
        }
        /*end masukin oc_item*/
        /*masukin metode pembayaran*/
        $is_ada_transaksi = 0;
        if($this->input->post("persentase_pembayaran") == 0){ //persentase DP 0
            $is_ada_transaksi = 1;
        }
        $is_ada_transaksi2 = 0;
        if($this->input->post("persentase_pembayaran2") == 0){ //persentase pelunasan 0
            $is_ada_transaksi2 = 1;
        }
        $data = array(
            "id_submit_oc" => $id_submit_oc,
            "persentase_pembayaran" => $this->input->post("persentase_pembayaran"),
            "nominal_pembayaran" => $this->input->post("nominal_pembayaran"),
            "trigger_pembayaran" => $this->input->post("trigger_pembayaran"),
            "status_bayar" => 1,
            "is_ada_transaksi" => $is_ada_transaksi,
            "persentase_pembayaran2" => $this->input->post("persentase_pembayaran2"),
            "nominal_pembayaran2" => $this->input->post("nominal_pembayaran2"),
            "trigger_pembayaran2" => $this->input->post("trigger_pembayaran2"),
            "status_bayar2" => 1,
            "is_ada_transaksi2" => $is_ada_transaksi2,
            "kurs" => $this->input->post("mata_uang_pembayaran")
        );
        insertRow("order_confirmation_metode_pembayaran",$data);
        /*end metode pembayaran*/
        $where = array(
            "id_submit_quotation" => $this->input->post("id_submit_quotation"),
        );
        $data = array(
            "status_quo" => 3 /*yang udah create oc, ditandain*/
        );

        //updateRow("quotation",$data,$where);
        redirect("crm/oc");
    }   
    public function delete($id_oc){
        $where = array("id_oc" => $id_oc);
        $data = array("status_oc" => 1);
        $this->Mdorder_confirmation->update($data,$where);
        redirect("crm/oc");
    }
    public function getOcDetail(){
        $where = array(
            "id_oc" => $this->input->post("id_oc")
        );
        $result = $this->Mdorder_confirmation->select($where);
        foreach($result->result() as $a){
            $data = array(
                "no_po" => $a->no_po_customer,
                "nama_perusahaan" => strtoupper($a->nama_perusahaan),
                "nama_customer" => ucwords($a->nama_cp),
                "franco" => $a->franco,
                "up_cp" => $a->up_cp
            );    
        }
        echo json_encode($data);
    }
    public function accepted($id_oc,$bulan,$tahun){
        $where = array(
            "id_oc" => $id_oc,
            "bulan_oc" => $bulan,
            "tahun_oc" => $tahun
        );
        $data = array(
            "status_oc" => 2
        );
        updateRow("order_confirmation",$data,$where);
        redirect("crm/oc");
    }
    public function getOcItem(){
        $where = array(
            "item_oc" => array(
                "id_oc" => $this->input->post("id_oc")
            ),
            "od" => array(
                "id_oc" => $this->input->post("id_oc")
            )
        );
        $result["item_oc"] = $this->Mdquotation_item->select($where["item_oc"]);
        $counter = 0 ;
        $result["od"] = $this->Mdod_core->select($where["od"]); /*ambil semua od yang ocnya terkair */
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
        }
        echo json_encode($data);
    }
}
?>