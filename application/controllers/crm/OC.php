<?php
class Oc extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdquotation");
        $this->load->model("Mdorder_confirmation");
        $this->load->model("Mdquotation_item");
        $this->load->model("Mdod_item");
        $this->load->model("Mdod_core");
        $this->load->model("Mdorder_confirmation_item");
        $this->load->model("Mdmetode_pembayaran");
        $this->load->model("Mdperusahaan");
        $this->load->library('Pdf_oc');
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
        if($this->session->id_user == "") redirect("login/welcome");
        $this->req();
        $where = array(
            "oc" => array(
                "status_aktif_oc" => 0
            )
        );
        $field = array(
            "oc" => array(
                "id_submit_quotation","no_po_customer","no_oc","id_oc","bulan_oc","tahun_oc","id_submit_oc","tgl_po_customer","total_oc_price",
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

            $where["oc_item"] = array(
                "status_oc_item" => 0,
                "id_submit_oc" => $data["oc"][$a]["id_submit_oc"]
            );
            $field["oc_item"] = array(
                "id_oc_item","nama_oc_item","final_amount","satuan_produk","final_selling_price","status_oc_item"
            );
            $result["oc_item"] = $this->Mdorder_confirmation_item->getListOrderConfirmationItem($where["oc_item"]);
            $data["oc"][$a]["oc_item"] = foreachMultipleResult($result["oc_item"],$field["oc_item"],$field["oc_item"]);

            $where["metode_pembayaran"] = array(
                "id_submit_oc" => $data["oc"][$a]["id_submit_oc"]
            );
            $field["metode_pembayaran"] = array(
                "persentase_pembayaran","nominal_pembayaran","trigger_pembayaran","status_bayar","is_ada_transaksi","persentase_pembayaran2","nominal_pembayaran2","trigger_pembayaran2","status_bayar2","is_ada_transaksi2","kurs"
            );
            $result["metode_pembayaran"] = selectRow("order_confirmation_metode_pembayaran",$where["metode_pembayaran"]);

            $data["oc"][$a]["metode_pembayaran"] = foreachResult($result["metode_pembayaran"],$field["metode_pembayaran"],$field["metode_pembayaran"]);
            if($data["oc"][$a]["metode_pembayaran"]["trigger_pembayaran"] == 1){
                $data["oc"][$a]["metode_pembayaran"]["trigger_pembayaran"] = "BEFORE ORDER DELIVERY";
            }
            else{
                $data["oc"][$a]["metode_pembayaran"]["trigger_pembayaran"] = "AFTER ORDER DELIVERY";
            }
            if($data["oc"][$a]["metode_pembayaran"]["trigger_pembayaran2"] == 1){
                $data["oc"][$a]["metode_pembayaran"]["trigger_pembayaran2"] = "BEFORE ORDER DELIVERY";
            }
            else{
                $data["oc"][$a]["metode_pembayaran"]["trigger_pembayaran2"] = "AFTER ORDER DELIVERY";
            }

        }
        $this->load->view("crm/content-open");
        $this->load->view("crm/oc/category-header");
        $this->load->view("crm/oc/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function create(){ //sudah di cek
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
        $result["oc"] = $this->Mdquotation->getListQuotation($where["oc"]);
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
    public function edit($id_submit_oc){ //sudah di cek
        $where = array(
            "id_submit_oc" => $id_submit_oc
        );
        $field = array(
            "detail" => array(
                "id_submit_quotation","no_oc","id_submit_oc","total_oc_price","no_po_customer","tgl_po_customer","up_cp","durasi_pengiriman","metode_pengiriman","franco","durasi_pembayaran"
            ),
            "items" => array(
                "nama_oc_item","final_amount","satuan_produk","final_selling_price","status_oc_item","id_quotation_item","id_oc_item"
            ),
            "pembayaran" => array(
                "persentase_pembayaran","nominal_pembayaran","trigger_pembayaran","status_bayar","is_ada_transaksi","persentase_pembayaran2","nominal_pembayaran2","trigger_pembayaran2","status_bayar2","is_ada_transaksi2","kurs"
            )
        );
        $result["detail"] = selectRow("order_confirmation",$where);
        $data["detail"] = foreachResult($result["detail"],$field["detail"],$field["detail"]);
        $id_submit_request = get1Value("quotation","id_request",array("id_submit_quotation" => $data["detail"]["id_submit_quotation"]));

        $id_perusahaan = get1Value("price_request","id_perusahaan",array("id_submit_request" => $id_submit_request));
        $data["detail"]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $id_perusahaan));
        $data["detail"]["alamat_perusahaan"] = get1Value("perusahaan","alamat_perusahaan",array("id_perusahaan" => $id_perusahaan));

        $id_cp = get1Value("price_request","id_cp",array("id_submit_request" => $id_submit_request));
        $data["detail"]["nama_cp"] = get1Value("contact_person","nama_cp",array("id_cp" => $id_cp));

        $result["items"] = selectRow("order_confirmation_item",$where);
        $data["items"] = foreachMultipleResult($result["items"],$field["items"],$field["items"]);

        $result["pembayaran"] = selectRow("order_confirmation_metode_pembayaran",$where);
        $data["pembayaran"] = foreachResult($result["pembayaran"],$field["pembayaran"],$field["pembayaran"]);
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/oc/category-header");
        $this->load->view("crm/oc/edit-oc",$data);
        $this->load->view("crm/content-close");
        $this->close();

    }
    /*function*/
    public function editoc(){ //sudah di cek
        /*insert ke oc tanpa total_oc_price*/
        $where["main"] = array(
            "id_submit_oc" => $this->input->post("id_submit_oc")
        );
        $data = array(
            "no_po_customer" => $this->input->post("no_po_customer"),
            "tgl_po_customer" => $this->input->post("tgl_po_customer"),
            "up_cp" => $this->input->post("up_cp"),
            "durasi_pengiriman" => $this->input->post("durasi_pengiriman"),
            "metode_pengiriman" => $this->input->post("metode_pengiriman"),
            "franco" => $this->input->post("franco"),
            "durasi_pembayaran" => $this->input->post("durasi_pembayaran"),
            "total_oc_price" => splitterMoney($this->input->post("total_oc_price"),","),
        );
        updateRow("order_confirmation",$data,$where["main"]);
        /*insert ke item oc*/

        $checks = $this->input->post("checkbox");
        $id_quotation_item = $this->input->post("id_quotation_item");
        $nama_oc_item = $this->input->post("nama_oc_item");
        $final_amount = $this->input->post("final_amount");
        $final_selling_price = $this->input->post("final_selling_price");
        $id_oc_item = $this->input->post("id_oc_item");
        
        /*sekarang masukin per item detailnya*/
        $category = array();
        $is_checked = array();
        $urutan = 0;
        foreach($checks as $checked){
            $is_checked[$urutan] = $checked; /*nampung id yang ke checked pake value (urutan baris dari 0 - ... di front end) */
            $urutan++;
        }
        $urutan = 0;
        foreach($id_oc_item as $a){
            $category[$urutan]["id_oc_item"] = $a; /*variable ini urutan 1, 2, 3, 4, dst*/
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
            $where["item"] = array(
                "id_oc_item" => $category[$a]["id_oc_item"]
            );
            $split = explode(" ",$category[$a]["final_amount"]); /*mecahin final amountnya dari urutan ini*/
            $items[$a] = array(/*barang 1, 2, 3, 4, ... */
                "nama_oc_item" => $category[$a]["nama_oc_item"], /*nama produk oc barang 1*/
                "final_amount" => $split[0], /*3*/
                "satuan_produk" => $split[1], /*meter*/
                "final_selling_price" =>splitterMoney($category[$a]["final_selling_price"],","),
            );
            
            updateRow("order_confirmation_item",$items[$a],$where["item"]); //update berdasarkan id_oc_item

            if(in_array($a,$is_checked)){ /*kalau yang urutan baris/item ada di array is_checked*/
                $data =  array(
                    "status_oc_item" => 0
                );
                updateRow("order_confirmation_item",$data,$where["item"]);
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
        $data["pembayaran"] = array(
            "persentase_pembayaran" => $this->input->post("persentase_pembayaran"),
            "nominal_pembayaran" => splitterMoney($this->input->post("nominal_pembayaran"),","),
            "trigger_pembayaran" => $this->input->post("trigger_pembayaran"),
            "status_bayar" => 1,
            "is_ada_transaksi" => $is_ada_transaksi,
            "persentase_pembayaran2" => $this->input->post("persentase_pembayaran2"),
            "nominal_pembayaran2" => splitterMoney($this->input->post("nominal_pembayaran2"),","),
            "trigger_pembayaran2" => $this->input->post("trigger_pembayaran2"),
            "status_bayar2" => 1,
            "is_ada_transaksi2" => $is_ada_transaksi2,
            "kurs" => $this->input->post("mata_uang_pembayaran")
        );
        updateRow("order_confirmation_metode_pembayaran",$data["pembayaran"],$where["main"]);
        /*end metode pembayaran*/
        redirect("crm/oc");
    }   
    public function openDataEntry(){
        $where = array(
            "customer" => array(
                "peran_perusahaan" => "CUSTOMER",
                "status_perusahaan" => "0"
            )
        );
        $result = $this->Mdperusahaan->select($where["customer"]);
        $field["customer"] = array(
            "id_cp","nama_cp","id_perusahaan","nama_perusahaan"
        );
        $data = array(
            "customer" => foreachMultipleResult($result,$field["customer"],$field["customer"])
        );
        $where = array(
            "status_produk" => 0
        );  
        $result = selectRow("produk",$where);
        $field["produk"] = array(
            "id_produk","nama_produk"
        );
        $data["produk"] = foreachMultipleResult($result,$field["produk"],$field["produk"]);
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/oc/category-header");
        $this->load->view("crm/oc/data-entry-oc",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function dataentry(){ //sudah di cek
        
        /*data submitted*/
        $input_data = array(
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "no_po_customer" => $this->input->post("no_po_customer"),
            "no_oc" => $this->input->post("no_oc"),
            "franco" => $this->input->post("franco"),
            "tgl_po_customer" => $this->input->post("tgl_po_customer"),
        );
        $split = explode("-",$input_data["id_perusahaan"]);
        $input_data["id_perusahaan"] = $split[0];
        $input_data["id_cp_perusahaan"] = $split[1];

        $split = explode("-",$input_data["tgl_po_customer"]);
        $tahun_input = $split[0];
        $bulan_input = $split[1];
        /*items submitted*/
        $id_quotation_item = $this->input->post("id_quotation_item");
        $nama_oc_item = $this->input->post("nama_oc_item");
        $id_produk = $this->input->post("id_produk");
        $final_amount = $this->input->post("final_amount");
        $final_selling_price = $this->input->post("final_selling_price");
        $category = array();

        $urutan = 0;
        foreach($id_produk as $a){
            if($a == "") break;
            $category[$urutan]["id_produk"] = $a; /*variable ini urutan 1, 2, 3, 4, dst*/
            $urutan++;
        }
        $urutan = 0;
        foreach($nama_oc_item as $a){
            if($a == "") break;
            $category[$urutan]["nama_oc_item"] = $a; /*variable ini urutan 1, 2, 3, 4, dst*/
            $urutan++;
        }
        $urutan = 0;
        foreach($final_amount as $a){
            if($a == "") break;
            $category[$urutan]["final_amount"] = $a; /*variable ini urutan 1, 2, 3, 4, dst*/
            $split = explode(" ",$category[$urutan]["final_amount"]);
            
            $category[$urutan]["jumlah"] = $split[0];
            $category[$urutan]["satuan"] = $split[1];
            $urutan++;
        }
        $urutan = 0;
        foreach($final_selling_price as $a){
            if($a == "") break;
            $category[$urutan]["final_selling_price"] = splitterMoney($a,","); /*variable ini urutan 1, 2, 3, 4, dst*/
            $urutan++;
        }
        
        $id_request = getMaxId("price_request","id_request",array("bulan_request" => $bulan_input,"tahun_request" => $tahun_input, "status_aktif_request" => 0));
        $no_request =  "LI-".sprintf("%03d",$id_request)."/RFQ/".bulanRomawi($bulan_input)."/".$tahun_input;
        $data = array(
            "id_request" => $id_request,
            "status_aktif_request" => 0,
            "bulan_request" => $bulan_input,
            "tahun_request" => $tahun_input,
            "no_request" => $no_request,
            "id_perusahaan" => $input_data["id_perusahaan"], // customer
            "id_cp" => $input_data["id_cp_perusahaan"],
            "franco" => $input_data["franco"],
            "untuk_stock" => 1,
            "tgl_dateline_request" => $input_data["tgl_po_customer"],
            "status_buat_quo" => 0,
            "status_request" => 3
        );
        $id_submit_request = insertRow("price_request",$data);
        /******************************************************************** */
        //QUOTATION//
        /******************************************************************** */
        $id_quotation = getMaxId("quotation","id_quotation",array("status_aktif_quotation" => 0,"bulan_quotation" => $bulan_input,"tahun_quotation" => $tahun_input));
        $no_quotation =  "LI-".sprintf("%03d",$id_quotation)."/QUO/".bulanRomawi($bulan_input)."/".$tahun_input;
        $data = array(
            "id_quotation" => $id_quotation,
            "bulan_quotation" => $bulan_input,
            "tahun_quotation" => $tahun_input,
            "versi_quotation" => 1,
            "no_quotation" => $no_quotation,
            "id_request" => $id_submit_request,
            "total_quotation_price" =>  splitterMoney($this->input->post("total_oc_price"),","), //nanti ini diisi setelah quotation item ketotal
            "hal_quotation" => "-",
            "up_cp" => "-",
            "durasi_pengiriman" => "-",
            "franco" => $input_data["franco"],
            "durasi_pembayaran" => "-", 
            "alamat_perusahaan" => "-",
            "dateline_quotation" =>  $input_data["tgl_po_customer"],
            "status_quotation" => 2,
            "id_user_add" => $this->session->id_user
        );
        $id_submit_quotation = insertRow("quotation",$data);
        /******************************************************************** */
        //OC//
        /******************************************************************** */
        $no_oc = $this->input->post("no_oc");
        $id_oc = substr($no_oc,-4); //LI20190003 = 0003 => 3
        $data = array(
            "id_submit_quotation" => $id_submit_quotation,
            "id_oc" => $id_oc,
            "bulan_oc" => $bulan_input,
            "tahun_oc" => $tahun_input,
            "no_oc" => $no_oc,
            "no_po_customer" => $input_data["no_po_customer"],
            "tgl_po_customer" => $input_data["tgl_po_customer"],
            "total_oc_price" =>  splitterMoney($this->input->post("total_oc_price"),","),
            "up_cp" => "-",
            "durasi_pembayaran" => "-",
            "durasi_pengiriman" => "-",
            "metode_pengiriman" => "-",
            "franco" => $input_data["franco"],
            "id_user_add" => $this->session->id_user
        );
        $id_submit_oc = insertRow("order_confirmation",$data);

        /*nanti di loop sesuai yang dicentang yang dimasukin dari oc item*/
        $counter = 0;
        for($a = 0; $a<count($category); $a++){
            $data = array(
                "id_submit_request" => $id_submit_request,
                "nama_produk" => $category[$a]["nama_oc_item"],
                "jumlah_produk" => $category[$a]["jumlah"],
                "satuan_produk" => $category[$a]["satuan"],
                "notes_produk" => "-",
                "file" => "-",
                "id_user_add" => $this->session->id_user
            );
            $id_request_item = insertRow("price_request_item",$data);
            $data = array(
                "id_request_item" => $id_request_item,
                "id_perusahaan" => -1, // klo data entry abaikan aja, cuman buat jalanin sistemnya
                "id_cp" => -1, // klo data entry abaikan aja, cuman buat jalanin sistemnya
                "harga_produk" => 1, //gaperlu masukin karena gapenting
                "vendor_price_rate" => 1, //gaperlu masukin karena gapenting
                "mata_uang" => "-",
                "nama_produk_vendor" => "-",
                "notes" => "-",
                "attachment" => "-",
                "id_user_add" => $this->session->id_user
            );
            $id_harga_vendor = insertRow("harga_vendor",$data);
            $data = array(
                "id_harga_vendor" => $id_harga_vendor,
                "id_perusahaan" => -1, // klo data entry abaikan aja, cuman buat jalanin sistemnya
                "id_cp" => -1, // klo data entry abaikan aja, cuman buat jalanin sistemnya
                "harga_produk" => 1,
                "vendor_price_rate" => 1,
                "mata_uang" => "-",
                "notes" => "-",
                "attachment" => "-",
                "metode_pengiriman" => "-",    
                "id_user_add" => $this->session->id_user
            );
            $id_harga_shipping = insertRow("harga_shipping",$data);
            $data = array(
                "id_request_item" => $id_request_item,
                "id_perusahaan" => -1, // klo data entry abaikan aja, cuman buat jalanin sistemnya
                "id_cp" => -1, // klo data entry abaikan aja, cuman buat jalanin sistemnya
                "harga_produk" => 1,
                "vendor_price_rate" => 1,
                "mata_uang" => "-",
                "notes" => "-",
                "attachment" => "-",
                "metode_pengiriman" => "-",    
                "id_user_add" => $this->session->id_user
            );
            $id_harga_courier = insertRow("harga_courier",$data);
            $data = array(
                "id_submit_quotation" => $id_submit_quotation,
                "id_request_item" => $id_request_item[$a],
                "nama_produk_leiter" => $category[$a]["nama_oc_item"],
                "attachment" => "-",
                "id_harga_vendor" => $id_harga_vendor[$a],
                "id_harga_courier" => $id_harga_courier[$a],
                "id_harga_shipping" => $id_harga_shipping[$a],
                "item_amount" => $category[$a]["jumlah"],
                "satuan_produk" => $category[$a]["satuan"],
                "selling_price" => $category[$a]["final_selling_price"],
                "margin_price" => "0%"
            );
            $id_quotation_item = insertRow("quotation_item",$data);
            $data = array(
                "id_submit_oc" => $id_submit_oc,
                "id_quotation_item" => $id_quotation_item, /*quotation barang 1*/
                "nama_oc_item" => $category[$a]["nama_oc_item"], /*nama produk oc barang 1*/
                "id_produk" => $category[$a]["id_produk"], 
                "final_amount" => $category[$a]["jumlah"], /*3*/
                "satuan_produk" => $category[$a]["satuan"], /*meter*/
                "final_selling_price" => $category[$a]["final_selling_price"],
                "status_oc_item" => 0
            );
            $id_oc_item = insertRow("order_confirmation_item",$data);
        }
        
        
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
            "nominal_pembayaran" => splitterMoney($this->input->post("nominal_pembayaran"),","),
            "trigger_pembayaran" => $this->input->post("trigger_pembayaran"),
            "status_bayar" => 1,
            "is_ada_transaksi" => $is_ada_transaksi,
            "persentase_pembayaran2" => $this->input->post("persentase_pembayaran2"),
            "nominal_pembayaran2" => splitterMoney($this->input->post("nominal_pembayaran2"),","),
            "trigger_pembayaran2" => $this->input->post("trigger_pembayaran2"),
            "status_bayar2" => 1,
            "is_ada_transaksi2" => $is_ada_transaksi2,
            "kurs" => $this->input->post("mata_uang_pembayaran")
        );
        insertRow("order_confirmation_metode_pembayaran",$data);
        $data = array(
            "id_submit_quotation" => $id_submit_quotation,
            "persentase_pembayaran" => $this->input->post("persentase_pembayaran"),
            "nominal_pembayaran" => splitterMoney($this->input->post("nominal_pembayaran"),","),
            "trigger_pembayaran" => $this->input->post("trigger_pembayaran"),
            "status_bayar" => 1,
            "is_ada_transaksi" => $is_ada_transaksi,
            "persentase_pembayaran2" => $this->input->post("persentase_pembayaran2"),
            "nominal_pembayaran2" => splitterMoney($this->input->post("nominal_pembayaran2"),","),
            "trigger_pembayaran2" => $this->input->post("trigger_pembayaran2"),
            "status_bayar2" => 1,
            "is_ada_transaksi2" => $is_ada_transaksi2,
            "kurs" => $this->input->post("mata_uang_pembayaran")
        );
        insertRow("quotation_metode_pembayaran",$data);

        redirect("crm/oc");
    }   
    public function insertoc(){ //sudah di cek
        /*insert ke oc tanpa total_oc_price*/
        $data = array(
            "id_submit_quotation" => $this->input->post("id_submit_quotation"),
            "id_oc" => $this->input->post("id_oc"),
            "bulan_oc" => date("m"),
            "tahun_oc" => date("Y"),
            "no_oc" => $this->input->post("no_oc"),
            "no_po_customer" => $this->input->post("no_po_customer"),
            "tgl_po_customer" => $this->input->post("tgl_po_customer"),
            "total_oc_price" => splitterMoney($this->input->post("total_oc_price"),","),
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
            "nominal_pembayaran" => splitterMoney($this->input->post("nominal_pembayaran"),","),
            "trigger_pembayaran" => $this->input->post("trigger_pembayaran"),
            "status_bayar" => 1,
            "is_ada_transaksi" => $is_ada_transaksi,
            "persentase_pembayaran2" => $this->input->post("persentase_pembayaran2"),
            "nominal_pembayaran2" => splitterMoney($this->input->post("nominal_pembayaran2"),","),
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
            "status_quotation" => 3 /*yang udah create oc, ditandain*/
        );

        updateRow("quotation",$data,$where);
        redirect("crm/oc");
    }   
    public function delete($id_submit_oc){ //sudah di cek
        $where = array(
            "id_submit_oc" => $id_submit_oc
        );
        $data = array(
            "status_aktif_oc" => 1
        );
        updateRow("order_confirmation",$data,$where);
        redirect("crm/oc");
    }
    public function accepted($id_submit_oc){
        $where = array(
            "id_submit_oc" => $id_submit_oc
        );
        $data = array(
            "status_oc" => 2
        );
        updateRow("order_confirmation",$data,$where);
        redirect("crm/oc");
    }
    function ocPdf($id_submit_oc){ //sudah di cek   
        $where=array(
            "id_submit_oc"=>$id_submit_oc,
        );

        $this->load->model('M_pdf_oc');
        $oc = $this->M_pdf_oc->selectOC($where);
        $perusahaan =$this->M_pdf_oc->selectPerusahaan($where);
        $barang = $this->M_pdf_oc->selectBarang($where);
        $metodebayar = $this->M_pdf_oc->selectMetodeBayar($where);

        $data=array(
            "order_confirmation"=>$oc,
            "perusahaan"=>$perusahaan,
            "barang"=>$barang,
            "metodebayar"=>$metodebayar,
        );
        $this->load->view('crm/oc/pdf_oc',$data);
    }
}
?>