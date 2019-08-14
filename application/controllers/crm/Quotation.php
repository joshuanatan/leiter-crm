<?php
class Quotation extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdquotation");
        $this->load->model("Mdprice_request");
        $this->load->model("Mdquotation_item");
        $this->load->model("Mdmetode_pembayaran");
        $this->load->model("Mdprice_request_item");

        $this->load->library('Pdf_oc');
    }
    /*default function*/
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
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/jqtabledit/jqtabledit-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("crm/quotation/js/request-ajax");
        $this->load->view("crm/quotation/js/payment-script");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    /*page*/
    public function index(){ 
        if($this->session->id_user == "") redirect("login/welcome");//sudah di cek
        $this->session->id_submit_request = "";
        $where = array(
            "status_aktif_quotation" => 0
        );
        $data["quotation_id"] = getMaxId("quotation","id_quotation",array("status_aktif_quotation" => 0,"bulan_quotation" => date("m"), "tahun_quotation" => date("Y")));
        
        $where = array(
            "price_request.status_request" => 3, /*ngambil yang sudah kasih harga vendor */
            "status_buat_quo" => 1,
            "untuk_stock" => 1
        );
        $field = array(
            "id_submit_request","no_request"
        );
        $result = selectRow("price_request",$where,$field);
        $data["request"] = $result->result_array();

        $where = array(
            "status_aktif_quotation" => 0
        );
        $field = array(
            "id_submit_quotation","versi_quotation","no_quotation","id_request","status_quotation","date_quotation_add","total_quotation_price","hal_quotation","durasi_pengiriman_quotation","franco","durasi_pembayaran_quotation","alamat_perusahaan","nama_perusahaan","nama_cp","up_cp_quotation"
        );
        $result = selectRow("order_detail",$where,$field);
        $data["quotation"] = $result->result_array();
        for($a = 0; $a<count($data["quotation"]); $a++){

            $where = array(
                "id_submit_quotation" => $data["quotation"][$a]["id_submit_quotation"]
            );

            $field = array(
                "nama_produk_leiter","attachment_quotation","harga_produk_shipping","harga_produk_vendor","harga_produk_courier","vendor_price_rate_vendor","vendor_price_rate_shipping","attachment_quotation","vendor_price_rate_courier","item_amount_quotation","satuan_produk_quotation","selling_price_quotation","margin_price_quotation","nama_shipper","nama_vendor","nama_courier"
            );
            $result = selectRow("order_item_detail",$where,$field);
            
            $data["quotation"][$a]["jumlah_quotation_item"] = $result->num_rows();
            $data["quotation"][$a]["quotation_item"] = $result->result_array();


            $field = array(
                "persentase_pembayaran","nominal_pembayaran","trigger_pembayaran","is_ada_transaksi","persentase_pembayaran2","nominal_pembayaran2","trigger_pembayaran2","is_ada_transaksi2","kurs"
            );
            $result = selectRow("quotation_metode_pembayaran",$where,$field);
            $data["quotation"][$a]["metode_pembayaran"] = $result->result_array();
            if($data["quotation"][$a]["metode_pembayaran"][0]["trigger_pembayaran"] == 1){
                $data["quotation"][$a]["metode_pembayaran"][0]["trigger_pembayaran"] = "BEFORE ORDER DELIVERY";
            }
            else{
                $data["quotation"][$a]["metode_pembayaran"][0]["trigger_pembayaran"] = "AFTER ORDER DELIVERY";
            }
            if($data["quotation"][$a]["metode_pembayaran"][0]["trigger_pembayaran2"] == 1){
                $data["quotation"][$a]["metode_pembayaran"][0]["trigger_pembayaran2"] = "BEFORE ORDER DELIVERY";
            }
            else{
                $data["quotation"][$a]["metode_pembayaran"][0]["trigger_pembayaran2"] = "AFTER ORDER DELIVERY";
            }
        }
        $field = array(
            "no_request","id_submit_request","nama_perusahaan","nama_cp"
        );
        $where = array(
            "status_buat_quo" => 1,
            "status_aktif_request" => 0
        );
        $result = selectRow("order_detail",$where,$field);
        $data["price_request"] = $result->result_array();
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function create(){ //sudah di cek
        if($this->session->id_user == ""){
            redirect("welcome");
        }
        if($this->session->id_submit_request == ""){
            $this->session->id_submit_request = $this->input->post("id_submit_request");
        }
        $where = array(
            "id_submit_request" => $this->session->id_submit_request
        );
        $field = array(
            "id_submit_request","no_request","id_perusahaan","nama_perusahaan","nama_cp"
            
        );
        $result = selectRow("order_detail",$where,$field);
        $data["request"] = $result->result_array();
        $data["request"][0]["alamat_perusahaan"] = get1Value("perusahaan","alamat_perusahaan",array("id_perusahaan" => $data["request"][0]["id_perusahaan"]));

        $data["quotation_id"] = getMaxId("quotation","id_quotation",array("bulan_quotation" => date("m"),"tahun_quotation" => date("Y"), "status_aktif_quotation" => 0));
        $data["id_submit_quotation"] = getMaxId("quotation","id_submit_quotation",array());

        $field = array(
            "id_request_item","nama_produk_request","jumlah_produk_request","satuan_produk_request","file","notes_produk_request"
        );
        $where = array(
            "id_submit_request" => $this->session->id_submit_request           
        );
        $result = selectRow("order_item_detail",$where,$field);
        $data["items"] = $result->result_array();

        $field = array(
            "id_perusahaan","nama_perusahaan"
        );
        $where = array(
            "status_perusahaan" => 0,
            "peran_perusahaan" => "PRODUK"
        );
        $result = selectRow("perusahaan",$where,$field);
        $data["vendor"] = $result->result_array();

        $where = array(
            "status_perusahaan" => 0,
            "peran_perusahaan" => "SHIPPING"
        );
        $result = selectRow("perusahaan",$where,$field);
        $data["shipper"] = $result->result_array();
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/add-quotation",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function revision($id_submit_quotation){//sudah di cek /*bagian ini terjadi sebelum pengiriman ke customer*/
        updateRow("quotation",array("status_quotation" => 5), array("id_submit_quotation" => $id_submit_quotation));
        $this->req();
        $id_submit_request = get1Value("quotation","id_request",array("id_submit_quotation" => $id_submit_quotation));
        $where = array(
            "quotation" => array(
                "id_submit_quotation" => $id_submit_quotation
            ),
            "quotation_item" => array(
                "id_submit_quotation" => $id_submit_quotation
            ),
            "quotation_metode_pembayaran" => array(
                "id_submit_quotation" => $id_submit_quotation
            ),
            "request_item" => array(
                "id_submit_request" => $id_submit_request
            )
        );
        $field = array(
            "quotation" => array(
                "no_quotation","total_quotation_price","hal_quotation","up_cp","durasi_pengiriman","franco","durasi_pembayaran","alamat_perusahaan","dateline_quotation","id_submit_quotation","versi_quotation","id_request","id_quotation"   
            ),
            "quotation_item" => array(
                "nama_produk_leiter","attachment","id_quotation_item","id_harga_vendor","id_harga_courier","id_harga_shipping","item_amount","satuan_produk","selling_price","margin_price","id_request_item"
            ),
            "quotation_metode_pembayaran" => array(
                "persentase_pembayaran","nominal_pembayaran","trigger_pembayaran","persentase_pembayaran2","nominal_pembayaran2","trigger_pembayaran2","kurs"
            ),
            "request_item" => array(
                "id_request_item","nama_produk"
            )
        );
        $result["quotation"] = selectRow("quotation",$where["quotation"]);
        $data["quotation"] = foreachResult($result["quotation"],$field["quotation"],$field["quotation"]);
        $data["quotation"]["no_request"] = get1Value("price_request","no_request",array("id_request" => $data["quotation"]["id_request"]));
        $data["quotation"]["id_perusahaan"] = get1Value("price_request","id_perusahaan",array("id_submit_request" => $data["quotation"]["id_request"] ));
        $data["quotation"]["id_cp"] = get1Value("price_request","id_cp",array("id_submit_request" => $data["quotation"]["id_request"] ));
        $data["quotation"]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan", array("id_perusahaan" => $data["quotation"]["id_perusahaan"]));
        $data["quotation"]["nama_cp"] = get1Value("contact_person","nama_cp", array("id_cp" => $data["quotation"]["id_cp"]));

        $result["quotation_item"] = selectRow("quotation_item",$where["quotation_item"]);
        $data["quotation_item"] = foreachMultipleResult($result["quotation_item"],$field["quotation_item"],$field["quotation_item"]);

        $result["quotation_metode_pembayaran"] = selectRow("quotation_metode_pembayaran",$where["quotation_metode_pembayaran"]);
        $data["quotation_metode_pembayaran"] = foreachResult($result["quotation_metode_pembayaran"],$field["quotation_metode_pembayaran"],$field["quotation_metode_pembayaran"]);

        $result["request_item"] = selectRow("price_request_item",$where["request_item"]);
        $data["request_item"] = foreachMultipleResult($result["request_item"],$field["request_item"],$field["request_item"]);

        $data["last_version"] = getMaxId("quotation","versi_quotation",array("id_quotation" => $data["quotation"]["id_quotation"]));

        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/revisi-quotation",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function edit($id_submit_quotation){ //sudah di cek /*bagian ini terjadi sebelum pengiriman ke customer*/
        $this->req();
        $id_submit_request = get1Value("quotation","id_request",array("id_submit_quotation" => $id_submit_quotation));
        $where = array(
            "quotation" => array(
                "id_submit_quotation" => $id_submit_quotation
            ),
            "quotation_item" => array(
                "id_submit_quotation" => $id_submit_quotation
            ),
            "quotation_metode_pembayaran" => array(
                "id_submit_quotation" => $id_submit_quotation
            ),
            "request_item" => array(
                "id_submit_request" => $id_submit_request
            )
        );
        $field = array(
            "quotation" => array(
                "no_quotation","total_quotation_price","hal_quotation","up_cp","durasi_pengiriman","franco","durasi_pembayaran","alamat_perusahaan","dateline_quotation","id_submit_quotation","versi_quotation","id_request"   
            ),
            "quotation_item" => array(
                "nama_produk_leiter","attachment","id_quotation_item","id_harga_vendor","id_harga_courier","id_harga_shipping","item_amount","satuan_produk","selling_price","margin_price","id_request_item"
            ),
            "quotation_metode_pembayaran" => array(
                "persentase_pembayaran","nominal_pembayaran","trigger_pembayaran","persentase_pembayaran2","nominal_pembayaran2","trigger_pembayaran2","kurs"
            ),
            "request_item" => array(
                "id_request_item","nama_produk"
            )
        );
        $result["quotation"] = selectRow("quotation",$where["quotation"]);
        $data["quotation"] = foreachResult($result["quotation"],$field["quotation"],$field["quotation"]);
        $data["quotation"]["no_request"] = get1Value("price_request","no_request",array("id_request" => $data["quotation"]["id_request"]));
        $data["quotation"]["id_perusahaan"] = get1Value("price_request","id_perusahaan",array("id_submit_request" => $data["quotation"]["id_request"] ));
        $data["quotation"]["id_cp"] = get1Value("price_request","id_cp",array("id_submit_request" => $data["quotation"]["id_request"] ));
        $data["quotation"]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan", array("id_perusahaan" => $data["quotation"]["id_perusahaan"]));
        $data["quotation"]["nama_cp"] = get1Value("contact_person","nama_cp", array("id_cp" => $data["quotation"]["id_cp"]));

        $result["quotation_item"] = selectRow("quotation_item",$where["quotation_item"]);
        $data["quotation_item"] = foreachMultipleResult($result["quotation_item"],$field["quotation_item"],$field["quotation_item"]);

        $result["quotation_metode_pembayaran"] = selectRow("quotation_metode_pembayaran",$where["quotation_metode_pembayaran"]);
        $data["quotation_metode_pembayaran"] = foreachResult($result["quotation_metode_pembayaran"],$field["quotation_metode_pembayaran"],$field["quotation_metode_pembayaran"]);

        $result["request_item"] = selectRow("price_request_item",$where["request_item"]);
        $data["request_item"] = foreachMultipleResult($result["request_item"],$field["request_item"],$field["request_item"]);

        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/edit-quotation",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    /*function*/
    public function insertquotation(){ //sudah di cek
        /*insert data quotation*/
        $data = array(
            "id_quotation" => $this->input->post("id_quotation") ,
            "bulan_quotation" => date("m"),
            "tahun_quotation" => date("Y"),
            "versi_quotation" => $this->input->post("versi_quotation") ,
            "no_quotation" => $this->input->post("no_quotation") ,
            "id_request" => $this->session->id_submit_request ,
            "total_quotation_price" => splitterMoney($this->input->post("total_quotation_price"),","),
            "hal_quotation" => $this->input->post("hal_quotation") ,
            "up_cp" => $this->input->post("up_cp") ,
            "durasi_pengiriman" => $this->input->post("durasi_pengiriman") ,
            "franco" => $this->input->post("franco") ,
            "durasi_pembayaran" => $this->input->post("durasi_pembayaran") ,
            "alamat_perusahaan" => $this->input->post("alamat_perusahaan") ,
            "dateline_quotation" => $this->input->post("dateline_quotation"),
            "status_quotation" => "0",
            "status_aktif_quotation" => "0",
            //"id_user_add" => "",
            "id_user_add" => $this->session->id_user,
            "date_quotation_add" => date("Y-m-d H:i:s"),
            "id_user_edit" => $this->session->id_user,
            "date_quotation_edit" => date("Y-m-d H:i:s"),
            "id_user_edit" => "0",
            "date_quotation_delete" => date("Y-m-d H:i:s")
        );
        if(in_array("",$data)){
            $this->session->set_flashdata("invalid","[Data gagal disubmit] Terdapat form yang kosong, mohon mengisi dengan hati-hati");
            $report = "Your Input Before: ";
            foreach($data as $key => $value){
                $report .= $key." = ".$value."<br/>";
            }
            $this->session->set_flashdata("report",$report);
            redirect("crm/quotation/create/");
        }
        $id_submit_quotation = insertRow("quotation",$data);
        /*---- Metode Pembayaran ----*/
        
        /*insert quotation item*/
        $config = array(
            "upload_path" => "./assets/dokumen/quotation/",
            "allowed_types" => "jpg|png|gif|jpeg"
        );
        $this->load->library("upload",$config);
        $check = $this->input->post("checks");
        foreach($check as $checked){ 
            $data = array(
                "id_request_item" => $checked,
                "id_perusahaan" => $this->input->post("vendor".$checked),
                "id_cp" => "-1",
                "harga_produk" => $this->input->post("harga_produk_vendor".$checked),
                "vendor_price_rate" => $this->input->post("rate_vendor".$checked),
                "mata_uang" => $this->input->post("mata_uang_vendor".$checked),
                "nama_produk_vendor" => $this->input->post("nama_produk_vendor".$checked),
                "notes" => $this->input->post("notes_vendor".$checked),
                "attachment" => "-",
                "status_harga_vendor" => "0",
                "id_user_add" => $this->session->id_user,
                "date_harga_vendor_add" => date("Y-m-d H:i:s"),
            );
            if(in_array("",$data)){
                $this->session->set_flashdata("invalid","[Data gagal disubmit] Terdapat form yang kosong, mohon mengisi dengan hati-hati");
                $report = "Your Input Before: ";
                foreach($data as $key => $value){
                    $report .= $key." = ".$value."<br/>";
                }
                $this->session->set_flashdata("report",$report);
                redirect("crm/quotation/create/");
            }
            $id_harga_vendor = insertRow("harga_vendor",$data);
            $data = array(
                "id_harga_vendor" => $id_harga_vendor,
                "id_perusahaan" => $this->input->post("shipper".$checked),
                "id_cp" => "-1",
                "harga_produk" => $this->input->post("harga_produk_shipper".$checked),
                "vendor_price_rate" => $this->input->post("rate_shipper".$checked),
                "mata_uang" => $this->input->post("mata_uang_shipper".$checked),
                "notes" => $this->input->post("notes_shipper".$checked),
                "attachment" => "-",
                "metode_pengiriman" => "-",
                "status_aktif_harga_shipping" => "0",
                "id_user_add" => $this->session->id_user,
                "date_harga_shipping_add" => date("Y-m-d H:i:s"),
            );
            if(in_array("",$data)){
                $this->session->set_flashdata("invalid","[Data gagal disubmit] Terdapat form yang kosong, mohon mengisi dengan hati-hati");
                $report = "Your Input Before: ";
                foreach($data as $key => $value){
                    $report .= $key." = ".$value."<br/>";
                }
                $this->session->set_flashdata("report",$report);
                redirect("crm/quotation/create/");
            }
            $id_harga_shipping = insertRow("harga_shipping",$data);
            $data = array(
                "id_request_item" => $checked,
                "id_perusahaan" => $this->input->post("kurir".$checked),
                "id_cp" => "-1",
                "harga_produk" => $this->input->post("harga_produk_kurir".$checked),
                "vendor_price_rate" => $this->input->post("rate_kurir".$checked),
                "mata_uang" => $this->input->post("mata_uang_kurir".$checked),
                "notes" => $this->input->post("notes_kurir".$checked),
                "attachment" => "-",
                "metode_pengiriman" => "-",
                "status_aktif_harga_shipping" => "0",
                "id_user_add" => $this->session->id_user,
                "date_harga_shipping_add" => date("Y-m-d H:i:s"),
            );
            if(in_array("",$data)){
                $this->session->set_flashdata("invalid","[Data gagal disubmit] Terdapat form yang kosong, mohon mengisi dengan hati-hati");
                $report = "Your Input Before: ";
                foreach($data as $key => $value){
                    $report .= $key." = ".$value."<br/>";
                }
                $this->session->set_flashdata("report",$report);
                redirect("crm/quotation/create/");
            }
            $id_harga_kurir = insertRow("harga_courier",$data);

            if($this->upload->do_upload("attachment".$checked)){
                $fileData = $this->upload->data();
            }
            else{
                $fileData["file_name"] = "-";
            }
            $item_amount = $this->input->post("item_amount".$checked);
            if($item_amount == ""){
                $this->session->set_flashdata("invalid","[Data gagal disubmit] Jumlah item kosong, mohon diisi");
                redirect("crm/quotation/create/");
                
            }
            $item_amount_split = explode(" ",$item_amount);
            if(count($item_amount_split) == 1){
                $item_amount_split[1] = "-";
            }
            $margin_price = $this->input->post("margin_price".$checked);
            if($margin_price == ""){
                $this->session->set_flashdata("invalid","[Data gagal disubmit] Jumlah item kosong, mohon diisi");
                redirect("crm/quotation/create/");
                
            }
            $margin_price_split = explode("%",$margin_price);

            $data["quotation_item"] = array( /*siapin data per nomor urut*/
                "id_submit_quotation" => $id_submit_quotation,
                "id_request_item" => $checked,
                "nama_produk_leiter" => $this->input->post("nama_produk_leiter".$checked) ,
                "attachment" => $fileData["file_name"], // abc.jpg / -
                "id_harga_vendor" => $id_harga_vendor ,
                "id_harga_shipping" => $id_harga_shipping ,
                "id_harga_courier" => $id_harga_kurir ,
                "item_amount" => $item_amount_split[0] , //23 Meter => 23
                "satuan_produk" => $item_amount_split[1] , // 23 Meter => Meter
                "selling_price" => splitterMoney($this->input->post("selling_price".$checked),","), //123.456.789 => 123456789
                "margin_price" => $margin_price_split[0] // 3,78% => 3,78
            );
            insertRow("quotation_item",$data["quotation_item"]);
        }
        /*insert metode pembayaran beserta logicnya*/
        /*kalau DPnya 0%, status paid langsung tidak ada transaksi (status_bayar = 2) sehingga tidak keluar di tempat bikin invoice dan tidak keluar di list invoice yang sudah di bayar*/

        /*kalau DP 100%, maka pelunasan ga ada transaksi*/
        /*kalau pelunasan 100% sebelum pengiriman, berarti DP tidak ada transaksi dan OD menunggu status_bayar2 = 0*/
        /*kalua DP 50%, OD menunggu status_bayar = 0. Apabila pelunasan setelah OD, maka bisa kirim OD, kalau pelunasan sebelum OD, maka OD akan menunggu status_bayar2 = 0*/
        $is_ada_transaksi = 0;
        if($this->input->post("persentase_pembayaran") == 0){ //persentase DP 0
            $is_ada_transaksi = 1;
        }
        $is_ada_transaksi2 = 0;
        if($this->input->post("persentase_pembayaran2") == 0){ //persentase pelunasan 0
            $is_ada_transaksi2 = 1;
        }
        $pembayaran = array(
            "id_submit_quotation" => $id_submit_quotation,
            "persentase_pembayaran" => $this->input->post("persentase_pembayaran"), // 50
            "nominal_pembayaran" => splitterMoney($this->input->post("nominal_pembayaran"),","), //123.456.789 => 123456789
            "trigger_pembayaran" => $this->input->post("trigger_pembayaran"), // 1 / 2
            "status_bayar" => 1, //karena pasti belum pembayaran
            "is_ada_transaksi" => $is_ada_transaksi,
            "persentase_pembayaran2" =>$this->input->post("persentase_pembayaran2"), //50%
            "nominal_pembayaran2" => splitterMoney($this->input->post("nominal_pembayaran2"),","), //123.456.789 => 123456789
            "trigger_pembayaran2" =>$this->input->post("trigger_pembayaran2"), // 1/2
            "status_bayar2" => 1, //karena pasti belum pembayaran
            "is_ada_transaksi2" => $is_ada_transaksi2,
            "kurs" => $this->input->post("mata_uang_pembayaran"),
        );
        insertRow("quotation_metode_pembayaran",$pembayaran);
        
        /*update status buat quotation di price request supaya gabisa dibuat ulang yang udah pernah dibuat*/
        $where["price_request"] = array(
            "id_request" => $this->input->post("id_request")
        );
        $data["price_request"] = array(
            "status_buat_quo" => "0"
        );
        updateRow("price_request",$data["price_request"],$where["price_request"]);
        redirect("crm/quotation");
    }
    public function insertrevision(){ //sudah di cek
        $data["quotation"] = array(
            "id_quotation" => $this->input->post("id_quotation") ,
            "versi_quotation" => $this->input->post("versi_quotation") ,
            "no_quotation" => $this->input->post("no_quotation") ,
            "id_request" => $this->input->post("id_request") ,
            "total_quotation_price" => splitterMoney($this->input->post("total_quotation_price"),","),
            "hal_quotation" => $this->input->post("hal_quotation") ,
            "up_cp" => $this->input->post("up_cp") ,
            "durasi_pengiriman" => $this->input->post("durasi_pengiriman") ,
            "franco" => $this->input->post("franco") ,
            "durasi_pembayaran" => $this->input->post("durasi_pembayaran") ,
            "alamat_perusahaan" => $this->input->post("alamat_perusahaan") ,
            "dateline_quotation" => $this->input->post("dateline_quotation") ,
            "bulan_quotation" => date("m"),
            "tahun_quotation" => date("Y"),
            "id_user_add" => $this->session->id_user,
        );
        $id_submit_quotation = insertRow("quotation",$data["quotation"]);
        /*---- Metode Pembayaran ----*/
        
        /*insert quotation item*/
        $config = array(
            "upload_path" => "./assets/dokumen/quotation/",
            "allowed_types" => "jpg|png|gif|jpeg"
        );
        $this->load->library("upload",$config);
        $check = $this->input->post("checks");
        foreach($check as $checked){ /*keambil value setiap yang di check, dalam hal ini nomor urut*/
            if($this->upload->do_upload("attachment".$checked)){
                $fileData = $this->upload->data();
            }
            else{
                $fileData["file_name"] = "-";
            }
            $item_amount = $this->input->post("item_amount".$checked);
            $item_amount_split = explode(" ",$item_amount);
            $margin_price = $this->input->post("margin_price".$checked);
            $margin_price_split = explode("%",$margin_price);
            $data["quotation_item"] = array( /*siapin data per nomor urut*/
                "id_submit_quotation" => $id_submit_quotation,
                "id_request_item" => $this->input->post("id_request_item".$checked) ,
                "nama_produk_leiter" => $this->input->post("nama_produk_leiter".$checked) ,
                "attachment" => $fileData["file_name"], // abc.jpg / -
                "id_harga_vendor" => $this->input->post("id_harga_vendor".$checked) ,
                "id_harga_shipping" => $this->input->post("id_harga_shipping".$checked) ,
                "id_harga_courier" => $this->input->post("id_harga_courier".$checked) ,
                "item_amount" => $item_amount_split[0] , //23 Meter => 23
                "satuan_produk" => $item_amount_split[1] , // 23 Meter => Meter
                "selling_price" => splitterMoney($this->input->post("selling_price".$checked),","), //123.456.789 => 123456789
                "margin_price" => $margin_price_split[0] // 3,78% => 3,78
            );
            insertRow("quotation_item",$data["quotation_item"]);
        }
        /*insert metode pembayaran beserta logicnya*/
        /*kalau DPnya 0%, status paid langsung tidak ada transaksi (status_bayar = 2) sehingga tidak keluar di tempat bikin invoice dan tidak keluar di list invoice yang sudah di bayar*/

        /*kalau DP 100%, maka pelunasan ga ada transaksi*/
        /*kalau pelunasan 100% sebelum pengiriman, berarti DP tidak ada transaksi dan OD menunggu status_bayar2 = 0*/
        /*kalua DP 50%, OD menunggu status_bayar = 0. Apabila pelunasan setelah OD, maka bisa kirim OD, kalau pelunasan sebelum OD, maka OD akan menunggu status_bayar2 = 0*/
        $is_ada_transaksi = 0;
        if($this->input->post("persentase_pembayaran") == 0){ //persentase DP 0
            $is_ada_transaksi = 1;
        }
        $is_ada_transaksi2 = 0;
        if($this->input->post("persentase_pembayaran2") == 0){ //persentase pelunasan 0
            $is_ada_transaksi2 = 1;
        }
        $pembayaran = array(
            "id_submit_quotation" => $id_submit_quotation,
            "persentase_pembayaran" => $this->input->post("persentase_pembayaran"), // 50
            "nominal_pembayaran" => splitterMoney($this->input->post("nominal_pembayaran"),","), //123.456.789 => 123456789
            "trigger_pembayaran" => $this->input->post("trigger_pembayaran"), // 1 / 2
            "status_bayar" => 1, //karena pasti belum pembayaran
            "is_ada_transaksi" => $is_ada_transaksi,
            "persentase_pembayaran2" =>$this->input->post("persentase_pembayaran2"), //50%
            "nominal_pembayaran2" => splitterMoney($this->input->post("nominal_pembayaran2"),","), //123.456.789 => 123456789
            "trigger_pembayaran2" =>$this->input->post("trigger_pembayaran2"), // 1/2
            "status_bayar2" => 1, //karena pasti belum pembayaran
            "is_ada_transaksi2" => $is_ada_transaksi2,
            "kurs" => $this->input->post("mata_uang_pembayaran"),
        );
        insertRow("quotation_metode_pembayaran",$pembayaran);
        redirect("crm/quotation");
    }
    public function editquotation(){ //sudah di cek
        $where["id_submit_quotation"] = array(
            "id_submit_quotation" => $this->input->post("id_submit_quotation")
        );
        $data["quotation"] = array(
            "total_quotation_price" => splitterMoney($this->input->post("total_quotation_price"),","),
            "hal_quotation" => $this->input->post("hal_quotation") ,
            "alamat_perusahaan" => $this->input->post("alamat_perusahaan") ,
            "up_cp" => $this->input->post("up_cp") ,
            "durasi_pengiriman" => $this->input->post("durasi_pengiriman") ,
            "dateline_quotation" => $this->input->post("dateline_quotation") ,
            "franco" => $this->input->post("franco") ,
            "durasi_pembayaran" => $this->input->post("durasi_pembayaran") ,
        );
        updateRow("quotation",$data["quotation"],$where["id_submit_quotation"]);
        /*---- Metode Pembayaran ----*/
        
        /*insert quotation item*/
        $config = array(
            "upload_path" => "./assets/dokumen/quotation/",
            "allowed_types" => "jpg|png|gif|jpeg"
        );
        $this->load->library("upload",$config);
        $check = $this->input->post("checks");
        deleteRow("quotation_item",$where["id_submit_quotation"]); //hapus semua item yang id submit quotation ini
        
        foreach($check as $checked){ /*keambil value setiap yang di check, dalam hal ini nomor urut*/
            //sudah ada
            if($this->upload->do_upload("attachment".$checked)){
                $fileData = $this->upload->data();
                
            }
            else{
                $fileData["file_name"] = "-";
            }
            $item_amount = $this->input->post("item_amount".$checked); //ga kesubmit
            $item_amount_split = explode(" ",$item_amount);
            $margin_price = $this->input->post("margin_price".$checked);
            $margin_price_split = explode("%",$margin_price);
            $data["quotation_item"] = array( /*siapin data per nomor urut*/
                "id_submit_quotation" => $this->input->post("id_submit_quotation"),
                "id_request_item" => $this->input->post("id_request_item".$checked) ,
                "nama_produk_leiter" => $this->input->post("nama_produk_leiter".$checked) ,
                "attachment" => $fileData["file_name"], // abc.jpg / -
                "id_harga_vendor" => $this->input->post("id_harga_vendor".$checked) ,
                "id_harga_shipping" => $this->input->post("id_harga_shipping".$checked) ,
                "id_harga_courier" => $this->input->post("id_harga_courier".$checked) ,
                "item_amount" => $item_amount_split[0] , //23 Meter => 23
                "satuan_produk" => $item_amount_split[1] , // 23 Meter => Meter
                "selling_price" => splitterMoney($this->input->post("selling_price".$checked),","), //123.456.789 => 123456789
                "margin_price" => $margin_price_split[0] // 3,78% => 3,78
            );
            echo $item_amount;
            insertRow("quotation_item",$data["quotation_item"]);
        }
        /*insert metode pembayaran beserta logicnya*/
        /*kalau DPnya 0%, status paid langsung tidak ada transaksi (status_bayar = 2) sehingga tidak keluar di tempat bikin invoice dan tidak keluar di list invoice yang sudah di bayar*/

        /*kalau DP 100%, maka pelunasan ga ada transaksi*/
        /*kalau pelunasan 100% sebelum pengiriman, berarti DP tidak ada transaksi dan OD menunggu status_bayar2 = 0*/
        /*kalua DP 50%, OD menunggu status_bayar = 0. Apabila pelunasan setelah OD, maka bisa kirim OD, kalau pelunasan sebelum OD, maka OD akan menunggu status_bayar2 = 0*/
        $is_ada_transaksi = 0;
        if($this->input->post("persentase_pembayaran") == 0){ //persentase DP 0
            $is_ada_transaksi = 1;
        }
        $is_ada_transaksi2 = 0;
        if($this->input->post("persentase_pembayaran2") == 0){ //persentase pelunasan 0
            $is_ada_transaksi2 = 1;
        }
        $pembayaran = array(
            "persentase_pembayaran" => $this->input->post("persentase_pembayaran"), // 50
            "nominal_pembayaran" => splitterMoney($this->input->post("nominal_pembayaran"),","), //123.456.789 => 123456789
            "trigger_pembayaran" => $this->input->post("trigger_pembayaran"), // 1 / 2
            "status_bayar" => 1, //karena pasti belum pembayaran
            "is_ada_transaksi" => $is_ada_transaksi,
            "persentase_pembayaran2" =>$this->input->post("persentase_pembayaran2"), //50%
            "nominal_pembayaran2" => splitterMoney($this->input->post("nominal_pembayaran2"),","), //123.456.789 => 123456789
            "trigger_pembayaran2" =>$this->input->post("trigger_pembayaran2"), // 1/2
            "status_bayar2" => 1, //karena pasti belum pembayaran
            "is_ada_transaksi2" => $is_ada_transaksi2,
            "kurs" => $this->input->post("mata_uang_pembayaran"),
        );
        updateRow("quotation_metode_pembayaran",$pembayaran,$where["id_submit_quotation"]);
        
        /*update status buat quotation di price request supaya gabisa dibuat ulang yang udah pernah dibuat*/
        redirect("crm/quotation/edit/".$this->input->post("id_submit_quotation"));
    }
    public function loss($id_submit_quotation){ //sudah di cek
        $data = array(
            "status_quotation" => 1
        );
        $where = array(
            "id_submit_quotation" => $id_submit_quotation
        );
        updateRow("quotation",$data,$where);
        redirect("crm/quotation");
    }
    public function accepted($id_submit_quotation){ //sudah di cek
        $data = array(
            "status_quotation" => 2
        );
        $where = array(
            "id_submit_quotation" => $id_submit_quotation
        );
        updateRow("quotation",$data,$where);
        redirect("crm/quotation");
        
    }
    public function remove($id_submit_quotation){ //sudah di cek
        $data = array(
            "status_aktif_quotation" => 2
        );
        $where = array(
            "id_submit_quotation" => $id_submit_quotation
        );
        updateRow("quotation",$data,$where);
        $id_submit_request = get1Value("order_detail","id_submit_request",$where);
        $data = array(
            "status_buat_quo" => "1"
        );
        $where = array(
            "id_submit_request" => $id_submit_request
        );
        updateRow("price_request",$data,$where);
        redirect("crm/quotation");
    }
    /*ajax*/

    function quoPdf($id_submit_quotation){ //sudah di cek
        $where = array(
            "id_submit_quotation" => $id_submit_quotation
        );
        
        $this->load->model('M_pdf_quotation');
        $quotation = $this->M_pdf_quotation->selectQuotation($where);
        
        $perusahaan = $this->M_pdf_quotation->selectPerusahaan($where);

        $itemnya = $this->M_pdf_quotation->selectBarang($where);

        $data = array(
            "quotation"=> $quotation,
            "perusahaan" => $perusahaan,
            "items" => $itemnya,
            "persentase1" => get1Value("quotation_metode_pembayaran","persentase_pembayaran",array("id_submit_quotation" => $id_submit_quotation)),
            "persentase2" => get1Value("quotation_metode_pembayaran","persentase_pembayaran2",array("id_submit_quotation" => $id_submit_quotation)),
            "trigger_pembayaran2" => get1Value("quotation_metode_pembayaran","trigger_pembayaran2",array("id_submit_quotation" => $id_submit_quotation))
        );
        $this->load->view('crm/quotation/pdf_quotation',$data);
    }

}
?>