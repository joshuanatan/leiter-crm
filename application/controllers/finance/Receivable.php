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
            "id_submit_invoice","no_invoice","id_submit_oc","id_submit_od","nominal_pembayaran","tipe_invoice","kurs_pembayaran","mata_uang","is_ppn","ppn","franco","att","alamat_penagihan","status_lunas","jatuh_tempo","no_rekening","jumlah_box","berat_bersih","berat_kotor","dimensi"
        );
        $result["invoice"] = $this->Mdinvoice_core->getListInvoice($where["invoice"]);
        $data["invoice"] = foreachMultipleResult($result["invoice"],$field["invoice"],$field["invoice"]);
        for($a = 0; $a<count($data["invoice"]); $a++){
            switch($data["invoice"][$a]["tipe_invoice"]){
                case 1:
                $data["invoice"][$a]["purpose"] = "PELUNASAN UTUH";
                break;
                case 2:
                $data["invoice"][$a]["purpose"] = "PEMBAYARAN DP";
                break;
                case 3:
                $data["invoice"][$a]["purpose"] = "PELUNASAN (BER-DP)";
                break;
            }
            $data["invoice"][$a]["no_oc"] = get1Value("order_confirmation","no_oc",array("id_submit_oc" => $data["invoice"][$a]["id_submit_oc"]));
            $data["invoice"][$a]["no_po_customer"] = get1Value("order_confirmation","no_po_customer",array("id_submit_oc" => $data["invoice"][$a]["id_submit_oc"]));
            
        }
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
        $result["oc"] = $this->Mdorder_confirmation->getListOc($where["oc"]);
        $data["oc"] = foreachMultipleResult($result["oc"],$field["oc"],$field["oc"]);
        for($a = 0; $a<count($data["oc"]);$a++){
            $id_submit_request = get1Value("quotation","id_request",array("id_submit_quotation" => $data["oc"][$a]["id_submit_quotation"]));
            $id_cp = get1Value("price_request","id_cp",array("id_submit_request" => $id_submit_request));
            $id_perusahaan = get1Value("price_request","id_perusahaan",array("id_submit_request" => $id_submit_request));
            $data["oc"][$a]["id_perusahaan"] = $id_perusahaan;
            $data["oc"][$a]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan", array("id_perusahaan" => $id_perusahaan));
            $data["oc"][$a]["nama_cp"] = get1Value("contact_person","nama_cp", array("id_cp" => $id_cp));
            
            $data["oc"][$a]["not_new"] = isExistsInTable("invoice_core",array("id_submit_oc" => $data["oc"][$a]["id_submit_oc"],"status_aktif_invoice" => 0));
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
            "nominal_pembayaran" =>  splitterMoney($this->input->post("nominal_pembayaran"),",")+$jumlah_ppn,
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
            $split_satuan = explode(" ",$this->input->post("dimensi_box".$checked)); // 8*9*10 m => [8*9*10] [m]
            $split_box = explode("*",$split_satuan[0]); //8*9*10 => [8][9][10]
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
    public function pay($id_submit_invoice){
        $where = array(
            "id_submit_invoice" => $id_submit_invoice
        );
        $data = array(
            "status_lunas" => 0
        );
        updateRow("invoice_core",$data,$where);


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
            "kategori_pembayaran" => "PELUNASAN CUSTOMER"
        );
        insertRow("pembayaran",$data);

        /*sekarang yang di metode pembayaran*/
        $tipe_invoice = get1Value("invoice_core","tipe_invoice",array("id_submit_invoice" => $id_submit_invoice));
        switch($tipe_invoice){
            case 1: //invoice tipe 1 dan 3 adalah pelunasan
            case 3: //invoice tipe 1 dan 3 adalah pelunasan
            $data["status_bayar"] = array(
                "status_bayar2" => 0
            );
            break;
            case 2: //invoice tipe 2 adalah DP
            $data["status_bayar"] = array(
                "status_bayar" => 0
            );
        }
        $id_submit_oc =  get1Value("invoice_core","id_submit_oc",array("id_submit_invoice" => $id_submit_invoice)); //cari id_submit_oc dari tabel invoice

        updateRow("order_confirmation_metode_pembayaran",$data["status_bayar"],array("id_submit_oc" => $id_submit_oc)); //update oc_metode_pembayaran menggunakan id_submit_oc

        /*masukin ke tax */
        /*pajak pasti masukan karena ini kita bayar ke supplier*/
        $tagihan = splitterMoney($this->input->post("nominal_pembayaran"),",");


        if(get1Value("invoice_core","is_ppn",array("id_submit_invoice" => $id_submit_invoice)) == 0){ //kalau ada PPn
            $data = array(
                "bulan_pajak" => date("m"),
                "tahun_pajak" => date("Y"),
                "jumlah_pajak" => $tagihan/11, /*tagihan ini uda termasuk ppn, ahrus cari ppnnya sendiri*/
                "tipe_pajak" => "KELUARAN",
                "jenis_pajak" => "PPN",
                "status_aktif_pajak" => 0,
                "id_refrensi" => $this->input->post("no_refrence")
            );
            insertRow("tax",$data);
        }
        redirect("finance/receivable");
    }
    public function delete($id_submit_invoice){
        $where = array(
            "id_submit_invoice" => $id_submit_invoice
        );
        $data = array(
            "status_aktif_invoice" => 1
        );
        updateRow("invoice_core",$data,$where);
        redirect("finance/receivable");
    }
    function invoicePdf($id_submit_invoice){
        $where=array(
            "id_submit_invoice"=>$id_submit_invoice,
        );

        $this->load->model('M_pdf_invoice');
        $invoice = $this->M_pdf_invoice->selectInvoice($where);
        $perusahaan = $this->M_pdf_invoice->selectPerusahaan($where);
        $barang = $this->M_pdf_invoice->selectBarang($where);

        $data=array(
            "invoice"=>$invoice,
            "perusahaan"=>$perusahaan,
            "barang"=>$barang,
        );

        $tipe_invoice = get1Value("invoice_core","tipe_invoice",array("id_submit_invoice"=>$id_submit_invoice));

        if($tipe_invoice=="1"){
            $this->load->view('finance/receivable/pdf_invoice',$data);
        }else if($tipe_invoice="2"){
            $this->load->view('finance/receivable/pdf_invoice2',$data);
        }else{
            $this->load->view('finance/receivable/pdf_invoice3',$data);
        }
    }
}
?>