<?php
class Payable extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function req(){
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
        $this->load->view("finance/payable/js/form-js");
        $this->load->view("finance/finance-close");
        $this->load->view("req/html-close"); 
    }
    public function index(){
        $where = array(
            "tagihan" => array(
                "status_aktif_invoice" => 0
            )
        );
        $field = array(
            "tagihan" => array(
                "id_tagihan","no_invoice","no_refrence","peruntukan_tagihan","total","rekening_pembayaran","status_lunas","notes_tagihan","attachment","mata_uang","dateline_invoice"
            )
            
        );
        $print = array(
            "tagihan" => array(
                "id_tagihan","no_invoice","no_refrence","peruntukan_tagihan","total","rekening","status_lunas","notes","attachment","mata_uang","dateline_invoice"
                )
        );
        $result["tagihan"] = selectRow("tagihan",$where["tagihan"]);
        $data["tagihan"] = foreachMultipleResult(($result["tagihan"]),$field["tagihan"],$print["tagihan"]);
        for($a = 0; $a<count($data["tagihan"]);$a++){
            $id_supplier = "";
            switch($data["tagihan"][$a]["peruntukan_tagihan"]){
                case "SUPPLIER":
                $id_supplier = get1Value("po_core","id_supplier",array("no_po" => $data["tagihan"][$a]["no_refrence"]));
                break;
                case "SHIPPER":
                $id_supplier = get1Value("po_core","id_shipper",array("no_po" => $data["tagihan"][$a]["no_refrence"]));
                break;
                case "COURIER":
                $id_supplier = get1Value("od_core","id_courier",array("no_od" => $data["tagihan"][$a]["no_refrence"]));
            }
            $data["tagihan"][$a]["nama_target"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan"=>$id_supplier));

        }
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/payable/category-header");
        $this->load->view("finance/payable/category-body",$data);
        $this->load->view("finance/content-close");
        $this->close();
    }
    public function insert(){
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/payable/category-header");
        $this->load->view("finance/payable/add-invoice");
        $this->load->view("finance/content-close");
        $this->close();
    }
    public function edit($i){
        $this->req();
        $this->load->view("finance/content-open");
        $this->load->view("finance/payable/category-header");
        $this->load->view("finance/payable/edit-invoice");
        $this->load->view("finance/content-close");
        $this->close();
    }
    public function insertinvoice(){
        
        /*masukin data primarynya*/
        $check_ppn = $this->input->post("is_ppn");
        if(isChecked($check_ppn)) $is_ppn = 0; else $is_ppn = 1;
        $check_pph = $this->input->post("is_pph");
        if(isChecked($check_pph)) $is_pph = 0; else $is_pph = 1;

        $config["upload_path"] = './assets/dokumen/invoice/';
        $config["allowed_types"] = 'pdf|docx|doc|xls|xlsx';
        $this->load->library("upload",$config);
        $doc_data = array();
        if($this->upload->do_upload("attachment")){
            $doc_data = $this->upload->data();
        }
        else $doc_data = array("file_name" => "-");
        $data = array(
            "no_invoice" => $this->input->post("no_invoice"),
            "no_refrence" => $this->input->post("no_refrence"),
            "peruntukan_tagihan" => $this->input->post("peruntukan_tagihan"),
            "rekening_pembayaran" => $this->input->post("rekening"),
            "subtotal" => splitterMoney($this->input->post("subtotal"),","),
            "is_ppn" =>  $is_ppn,
            "is_pph" =>  $is_pph,
            "discount" => splitterMoney($this->input->post("discount"),","),
            "total" => splitterMoney($this->input->post("total"),","),
            "mata_uang" =>  $this->input->post("mata_uang"),
            "notes_tagihan" => $this->input->post("notes_tagihan"),
            "attachment" => $doc_data["file_name"],
            "dateline_invoice" => $this->input->post["dateline"],
            "status_lunas"=> 1,
        );
        insertRow("tagihan",$data);
        /*masukin ke table tax kalau taxnya di centang*/
        redirect("finance/payable");
    }
    public function pay($id_tagihan){
        $where = array(
            "id_tagihan" => $id_tagihan
        );
        $data = array(
            "status_lunas" => 0
        );
        updateRow("tagihan",$data,$where);
        /*masukin ke pembayran*/
        $config["upload_path"] = "./assets/dokumen/buktibayar/";
        $config["allowed_types"] = "gif|jpg|jpeg|pdf|png";
        $this->load->library("upload",$config);
        $dataUpload = array();
        if($this->upload->do_upload("attachment")){
            $dataUpload = $this->upload->data();
        }
        else{
            $dataUpload["file_name"] = "-";
        }
        $data = array(
            "id_refrensi" => $this->input->post("id_refrensi"),
            "subject_pembayaran" => $this->input->post("subject_pembayaran"),
            "tgl_bayar" => $this->input->post("tgl_bayar"),
            "attachment" =>  $dataUpload["file_name"],
            "notes_pembayaran" =>  $this->input->post("notes_pembayaran"),
            "nominal_pembayaran" =>  splitterMoney($this->input->post("nominal_pembayaran"),","),
            "kurs_pembayaran" =>  $this->input->post("kurs_pembayaran"),
            "mata_uang_pembayaran" => $this->input->post("mata_uang_pembayaran"),
            "total_pembayaran" => splitterMoney($this->input->post("nominal_pembayaran"),",")*splitterMoney($this->input->post("kurs_pembayaran"),","),
        );
        $id_pembayaran = insertRow("pembayaran",$data);
    
        /*masukin ke tax */
        /*pajak pasti masukan karena ini kita bayar ke supplier*/
        $subtotal = get1Value("tagihan","subtotal",array("id_tagihan" => $id_tagihan));
        $diskon = get1Value("tagihan","discount",array("id_tagihan" => $id_tagihan));
        $tagihan = $subtotal-$diskon;
        if(get1Value("tagihan","is_ppn",array("id_tagihan" => $id_tagihan)) == 0){


            $data = array(
                "bulan_pajak" => date("m"),
                "tahun_pajak" => date("Y"),
                "jumlah_pajak" => 0.1*$tagihan,
                "tipe_pajak" => "MASUKAN",
                "jenis_pajak" => "PPN",
                "status_aktif_pajak" => 0,
                "id_refrensi" => get1Value("tagihan","no_invoice",array("id_tagihan" => $id_tagihan))
            );
            insertRow("tax",$data);
        }
        
        if(get1Value("tagihan","is_pph",array("id_tagihan" => $id_tagihan)) == 0){
            $data = array(
                "bulan_pajak" => date("m"),
                "tahun_pajak" => date("Y"),
                "jumlah_pajak" => 0.02*$tagihan,
                "tipe_pajak" => "MASUKAN",
                "jenis_pajak" => "PPH",
                "status_aktif_pajak" => 0,
                "id_refrensi" => get1Value("tagihan","no_invoice",array("id_tagihan" => $id_tagihan))
            );
            insertRow("tax",$data);
        }
        /*masukin ke uang keluar */
        /*benar2 uang yang keluar, so sesuai tagihan*/
        $data = array(
            "id_jenis_transaksi" => 3 /*id_jenis_transaksi nomor 3 ini jangan dirubah2 di master expanses type*/,
            "nominal" => splitterMoney($this->input->post("nominal_pembayaran"),",")*splitterMoney($this->input->post("kurs_pembayaran"),","),/*ini yang ditransfer*/
            "tgl_transaksi" => $this->input->post("tgl_bayar"),
            "status_aktif_transaksi" => 0,
            "id_refrensi" => get1Value("tagihan","no_invoice",array("id_tagihan" => $id_tagihan)),
            "bukti_bon" =>$dataUpload["file_name"]
        );
        insertRow("cashflow",$data);
        redirect("finance/payable");
        /*selain ubah jadi paid, insert tax juga disini kalau emang dicentang di settingnya, cek is_ppn dan is_pph di db*/
    }
    public function remove($i){

    }
    public function editinvoice(){

    }

}

?>