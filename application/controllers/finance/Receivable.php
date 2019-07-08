<?php
class Receivable extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdinvoice_core");
        $this->load->model("Mdorder_confirmation");
        $this->load->model("Mdmetode_pembayaran");
        $this->load->model("Mdinvoice_core");
        $this->load->model("Mdod_core");
        $this->load->library('Pdf');
    }
    private function req(){
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
        $this->load->view("finance/receivable/js/request-ajax");
        $this->load->view("finance/finance-close");
        $this->load->view("req/html-close");
    }
    public function index(){
        $where = array(
            "invoice" => array(
                "status_aktif_invoice" => 0
            )
        );
        $field["invoice"] = array(
            "id_submit_invoice","no_invoice","id_oc","id_od","nominal_pembayaran","tipe_invoice","kurs_pembayaran","mata_uang","is_ppn","ppn","franco","att","alamat_penagihan","status_lunas","jatuh_tempo","no_rekening","jumlah_box","berat_bersih","berat_kotor","dimensi"
        );
        $result["invoice"] = $this->Mdinvoice_core->getListInvoice($where["invoice"]);
        $data["invoice"] = foreachMultipleResult($result["invoice"],$field["invoice"],$field["invoice"]);

        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/receivable/category-header");
        $this->load->view("finance/receivable/category-body",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
    
    public function create(){
        $where = array(
            "oc" => array(
                "status_aktif_oc" => 0
            )   
        );
        $field["oc"] = array(
            "id_submit_oc","no_po_customer","id_submit_quotation",
        );
        $result["oc"] = selectRow("order_confirmation",$where["oc"]);
        $data["oc"] = foreachMultipleResult($result["oc"],$field["oc"],$field["oc"]);
        for($a = 0; $a<count($data["oc"]);$a++){
            $id_submit_request = get1Value("quotation","id_request",array("id_submit_quotation" => $data["oc"][$a]["id_submit_quotation"]));
            $id_cp = get1Value("price_request","id_cp",array("id_submit_request" => $id_submit_request));
            $id_perusahaan = get1Value("price_request","id_perusahaan",array("id_submit_request" => $id_submit_request));
            $data["oc"][$a]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan", array("id_perusahaan" => $id_perusahaan));
            $data["oc"][$a]["nama_cp"] = get1Value("contact_person","nama_cp", array("id_cp" => $id_cp));
        }
        $data["maxId"] = getMaxId("invoice_core","id_invoice",array("bulan_invoice" => date("m"),"tahun_invoice" => date("Y"),"status_aktif_invoice" => 0));

        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/receivable/category-header");
        $this->load->view("finance/receivable/add-invoice",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
    public function createinvoice(){
        $ppn_check = $this->input->post("ppn");
        $is_ppn = 1;
        foreach($ppn_check as $a){
            $is_ppn = 0;
        }
        $jumlah_ppn = 0;
        if($is_ppn == 0){
            $jumlah_ppn = 0.1*splitterMoney($this->input->post("nominal_pembayaran"),",");
        }
        if($this->input->post("id_od") == "") $id_od = "-"; else $id_od = $this->input->post("id_od");
        $data = array(
            "id_invoice" =>  $this->input->post("id_invoice"),
            "bulan_invoice" => date("m"),
            "tahun_invoice" => date("Y"),
            "no_invoice" =>  $this->input->post("no_invoice"),
            "id_submit_oc" =>  $this->input->post("id_submit_oc"), 
            "tipe_invoice" =>  $this->input->post("tipe_invoice"),
            "id_submit_od" =>  $id_od,
            "is_ppn" =>  $is_ppn,
            "ppn" =>  $jumlah_ppn,
            "franco" =>  $this->input->post("franco"),
            "att" =>  $this->input->post("att"),
            "alamat_penagihan" =>  $this->input->post("alamat_penagihan"),
            "durasi_pembayaran" =>  $this->input->post("durasi_pembayaran"),
            "jatuh_tempo" =>  $this->input->post("jatuh_tempo"),
            "nominal_pembayaran" =>  splitterMoney($this->input->post("nominal_pembayaran"),","),
            "no_rekening" => $this->input->post("no_rekening"), 
            "jumlah_box" => 0,
            "berat_bersih" => 0,
            "berat_kotor" => 0,
            "dimensi" => "-",
            "id_user_add" => $this->session->id_user 
        );
        $id_submit_invoice = insertRow("invoice_core",$data);

        $checks = $this->input->post("checks");
        $maxVolumeBox = 0;
        $maxBoxDimensi = "";
        $beratBersih = 0;
        $beratKotor = 0;
        $jumlah_box = 0;
        foreach($checks as $checked){
            $jumlah_box++;
            $data = array(
                "id_submit_invoice" => $id_submit_invoice,
                "berat_bersih" => $this->input->post("berat_bersih".$checked),
                "berat_kotor" => $this->input->post("berat_kotor".$checked),
                "dimensi_box" => $this->input->post("dimensi_box".$checked),
            );
            insertRow("invoice_packaging_box",$data);
            $beratBersih += $this->input->post("berat_bersih".$checked);
            $beratKotor += $this->input->post("berat_kotor".$checked);
            $split_box = explode("*",$this->input->post("dimensi_box".$checked));
            $volumeBox = 1;
            for($a = 0; $a<count($split_box); $a++){
                $volumeBox *= $split_box[$a];
            }
            if($volumeBox > $maxVolumeBox ){
                $maxVolumeBox = $volumeBox;
                $maxBoxDimensi = $this->input->post("dimensi_box".$checked);
            }
        }
        if($jumlah_box > 0){
            $where = array(
                "id_submit_invoice" => $id_submit_invoice,
            );
            $data = array(
                "jumlah_box" => $jumlah_box,
                "berat_bersih" => $beratBersih,
                "berat_kotor" => $beratKotor,
                "dimensi" => $maxBoxDimensi,
            );
            updateRow("invoice_core",$data,$where);
        }
        redirect("finance/receivable");
    }
    public function edit($i){

    }
    public function word(){
        header("Content-type:application/vnd.ms-word");
        header("Content-Disposition:attachment;Filename=invoice.doc");
        header("Pragma: no-cache");
        header("Expires:0");
        $this->load->view("finance/print/invoice");
    }
    public function pdf(){
        $this->load->view("finance/pdf/invoice");
    }
    public function getMetodePembayaran(){
        $where = array(
            "id_oc" => $this->input->post("id_oc")
        );
        $result = $this->Mdmetode_pembayaran->select($where);
        $count = 0;
        foreach($result->result() as $a){
            $array[$count] = array(
                "id_metode_pembayaran" => $a->id_metode_pembayaran,
                "persentase" => $a->persentase_pembayaran,
                "nominal" => $a->nominal_pembayaran,
                "trigger_pembayaran" => $a->trigger_pembayaran
            );
            $count++;
        }
        echo json_encode($array);
    }
    public function getDetailMetodePembayaran(){
        $where = array(
            "id_metode_pembayaran" => $this->input->post("id_metode_pembayaran")
        );
        $result = $this->Mdmetode_pembayaran->select($where);
        $data = array();
        foreach($result->result() as $a){
            $data = array(
                "persentase" => $a->persentase_pembayaran,
                "nominal" => $a->nominal_pembayaran,
                "trigger_pembayaran" => $a->trigger_pembayaran
            );
        }
        echo json_encode($data);
    }
    public function getPaymentWithOd(){
        $where = array(
            "invoice_core.id_oc" => $this->input->post("id_oc"),
            "invoice_core.use_od" => $this->input->post("use_od")
        );
        $data = array(
            "historyOd" => array(),
        );
        $result = $this->Mdinvoice_core->select($where);
        $count = 0;
        $data = array();
        foreach($result->result() as $a){
            $data["historyOd"][$count] = array(
                "no_invoice" => $a->no_invoice,
                "id_invoice" => $a->id_invoice,
                "no_od" => get1Value("od_core","no_od",array("id_od" => $a->id_od)),
                "persentase" => $a->persen_pembayaran,
                "nominal" => $a->nominal_pembayaran,
                "mata_uang" => $a->mata_uang,
                "tanggal_keluar" => $a->tgl_invoice_add
            );
            $count++;
        }
        
        echo json_encode($data);
    }
    public function getDp(){
        $where = array(
            "id_oc" => $this->input->post("id_oc"),
            "status_invoice" => 1,
            "trigger_pembayaran" => 1
        );
        $result = $this->Mdmetode_pembayaran->select($where);
        $data = array();
        foreach($result->result() as $a){
            $data["persentase"] = $a->persentase_pembayaran;
            $data["nominal"] = number_format($a->nominal_pembayaran);
            $data["total"] = number_format(100*splitterMoney($data["nominal"],",")/$data["persentase"]);
            $data["clean_nominal"] = splitterMoney($data["nominal"],",");
        }
        echo json_encode($data);

    }
    public function pay($id_tagihan){
        $where = array(
            "id_tagihan" => $id_tagihan
        );
        $data = array(
            "status_lunas" => 0
        );
        updateRow("tagihan",$data,$where);
        /*masukin ke pembayaran*/
        $config["upload_path"] = "./assets/dokumen/buktibayar/";
        $config["allowed_types"] = "gif|jpg|jpeg|pdf|png";
        $this->load->library("upload",$config);
        $fileData = array();
        if($this->upload->do_upload("attachment")){
            $fileData = $this->upload->data();
        }
        else{
            $fileData["file_name"] = "-";
        }
        $data = array(
            "id_refrensi" => $this->input->post("id_refrensi"),
            "subject_pembayaran" => $this->input->post("subject_pembayaran"),
            "tgl_bayar" => $this->input->post("tgl_bayar"),
            "attachment" =>  $fileData["file_name"],
            "notes_pembayaran" =>  $this->input->post("notes_pembayaran"),
            "nominal_pembayaran" =>  splitterMoney($this->input->post("nominal_pembayaran"),","),
            "kurs_pembayaran" =>  1,
            "mata_uang_pembayaran" => "IDR",
            "total_pembayaran" => splitterMoney($this->input->post("nominal_pembayaran"),","),
            "metode_pembayaran" => $this->input->post("metode_pembayaran"),
            "jenis_pembayaran" => "MASUK",
            "kategori_pembayaran" => 3
        );
        insertRow("pembayaran",$data);
    
        /*masukin ke tax */
        /*pajak pasti masukan karena ini kita bayar ke supplier*/
        $tagihan = splitterMoney($this->input->post("nominal_pembayaran"),",");


        if(get1Value("tagihan","is_ppn",array("id_tagihan" => $id_tagihan)) == 0){
            $data = array(
                "bulan_pajak" => date("m"),
                "tahun_pajak" => date("Y"),
                "jumlah_pajak" => $tagihan/11, /*tagihan ini uda termasuk ppn, ahrus cari ppnnya sendiri*/
                "tipe_pajak" => "KELUARAN",
                "jenis_pajak" => "PPN",
                "status_aktif_pajak" => 0,
                "id_refrensi" => $this->input->post("id_refrensi")
            );
            insertRow("tax",$data);
        }
        redirect("finance/receivable");
    }
    function invoicePdf(){
        $this->load->view('finance/receivable/pdf_invoice');
    }
}
?>