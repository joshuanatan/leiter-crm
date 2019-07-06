<?php
class Quotation extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdquotation");
        $this->load->model("Mdprice_request");
        $this->load->model("Mdquotation_item");
        $this->load->model("Mdmetode_pembayaran");
        $this->load->model("Mdprice_request_item");
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
        $this->load->view("crm/quotation/js/dynamic-form-js");
        $this->load->view("crm/quotation/js/request-ajax");
        $this->load->view("crm/quotation/js/payment-script");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    /*page*/
    public function index(){
        $this->req();
        $where = array(
            "quotation" => array(
                "status_aktif_quotation" => 0
            ),
            "price_request" => array(
                "price_request.status_request" => 3 /*ngambil yang sudah kasih harga vendor */
            )
        );
        $data = array(
            "quotation_id" => getMaxId("quotation","id_quotation",array("status_aktif_quotation" => 0,"bulan_quotation" => date("m"), "tahun_quotation" => date("Y"))),
            "request" => $this->Mdprice_request->select($where["price_request"])
        );
        $field["quotation"] = array(
            "id_submit_quotation","versi_quotation","no_quotation","id_request","status_quotation","date_quotation_add","total_quotation_price","hal_quotation","up_cp","durasi_pengiriman","franco","durasi_pembayaran","alamat_perusahaan"
        );
        $result["quotation"] = $this->Mdquotation->getListQuotation($where["quotation"]);
        $data["quotation"] = foreachMultipleResult($result["quotation"],$field["quotation"],$field["quotation"]);
        for($a = 0; $a<count($data["quotation"]); $a++){

            $data["quotation"][$a]["id_perusahaan"] = get1Value("price_request","id_perusahaan", array("id_request" => $data["quotation"][$a]["id_request"]));
            $data["quotation"][$a]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan", array("id_perusahaan" => $data["quotation"][$a]["id_perusahaan"]));

            $data["quotation"][$a]["id_cp"] = get1Value("price_request","id_cp", array("id_request" => $data["quotation"][$a]["id_request"]));
            $data["quotation"][$a]["nama_cp"] = get1Value("contact_person","nama_cp", array("id_cp" => $data["quotation"][$a]["id_cp"]));

            $where["quotation_item"] = array(
                "id_submit_quotation" => $data["quotation"][$a]["id_submit_quotation"]
            );
            $result["quotation_item"] = $this->Mdquotation_item->getListQuotationItem($where["quotation_item"]);
            $field["quotation_item"] = array(
                "nama_produk_leiter","attachment","harga_shipping","harga_shipping","harga_courier","vendor_price_rate","shipping_price_rate","courier_price_rate","item_amount","satuan_produk","selling_price","margin_price","id_shipper","id_vendor","id_courier","product_image"
            );
            $data["quotation"][$a]["jumlah_quotation_item"] = $result["quotation"]->num_rows();
            $data["quotation"][$a]["quotation_item"] = foreachMultipleResult($result["quotation_item"],$field["quotation_item"],$field["quotation_item"]); /*list quotation item dalam 1 quotation*/
            for($b = 0; $b<count($data["quotation"][$a]["quotation_item"]); $b++){
                $data["quotation"][$a]["quotation_item"][$b]["nama_supplier"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["quotation"][$a]["quotation_item"][$b]["id_vendor"]));
                $data["quotation"][$a]["quotation_item"][$b]["nama_shipper"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["quotation"][$a]["quotation_item"][$b]["id_shipper"]));
                $data["quotation"][$a]["quotation_item"][$b]["nama_courier"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["quotation"][$a]["quotation_item"][$b]["id_courier"]));
            }
            $where["metode_pembayaran"] = array(
                "id_submit_quotation" => $data["quotation"][$a]["id_submit_quotation"]
            );
            $result["metode_pembayaran"] = $this->Mdmetode_pembayaran->getListQuotationMetodePembayaran($where["metode_pembayaran"]);
            $field["metode_pembayaran"] = array(
                "persentase_pembayaran","nominal_pembayaran","trigger_pembayaran","is_ada_transaksi","persentase_pembayaran2","nominal_pembayaran2","trigger_pembayaran2","is_ada_transaksi2","kurs"
            );
            $data["quotation"][$a]["metode_pembayaran"] = foreachResult($result["metode_pembayaran"],$field["metode_pembayaran"],$field["metode_pembayaran"]);
            if($data["quotation"][$a]["metode_pembayaran"]["trigger_pembayaran"] == 1){
                $data["quotation"][$a]["metode_pembayaran"]["trigger_pembayaran"] = "BEFORE ORDER DELIVERY";
            }
            else{
                $data["quotation"][$a]["metode_pembayaran"]["trigger_pembayaran"] = "AFTER ORDER DELIVERY";
            }
            if($data["quotation"][$a]["metode_pembayaran"]["trigger_pembayaran2"] == 1){
                $data["quotation"][$a]["metode_pembayaran"]["trigger_pembayaran2"] = "BEFORE ORDER DELIVERY";
            }
            else{
                $data["quotation"][$a]["metode_pembayaran"]["trigger_pembayaran2"] = "AFTER ORDER DELIVERY";
            }
        }
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function create(){
        $this->req();
        $where = array(
            "quotation" => array(
                "status_quo" => 0  
            ),
            "price_request" => array(
                "price_request.status_request" => 3,
                "status_buat_quo" => 1,
                "untuk_stock" => 1
            ),
            
        );
        $field = array(
            "request" => array(
                "id_submit_request","no_request","id_perusahaan"
            )
        );
        $result["request"] = $this->Mdprice_request->getListPriceRequest($where["price_request"]);
        $data["request"] = foreachMultipleResult($result["request"],$field["request"],$field["request"]);
        for($a = 0; $a<count($data["request"]); $a++){
            $data["request"][$a]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan", array("id_perusahaan" => $data["request"][$a]["id_perusahaan"]));
        }
        $data["quotation_id"] = getMaxId("quotation","id_quotation",array("bulan_quotation" => date("m"),"tahun_quotation" => date("Y"), "status_aktif_quotation" => 0));
        $data["id_submit_quotation"] = getMaxId("quotation","id_submit_quotation",array());
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/add-quotation",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function revision($id_submit_quotation){ /*bagian ini terjadi sebelum pengiriman ke customer*/
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
    public function edit($id_submit_quotation){ /*bagian ini terjadi sebelum pengiriman ke customer*/
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
    public function insertquotation(){
        /*insert data quotation*/
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
        
        /*update status buat quotation di price request supaya gabisa dibuat ulang yang udah pernah dibuat*/
        $where["price_request"] = array(
            "id_request" => $this->input->post("id_request")
        );
        $data["price_request"] = array(
            "status_buat_quo" => 0
        );
        updateRow("price_request",$data["price_request"],$where["price_request"]);
        redirect("crm/quotation");
    }
    public function insertrevision(){
        $name = array("id_quo","versi_quo","id_request","no_quo","hal_quo","id_perusahaan","id_cp","up_cp","durasi_pengiriman","franco","durasi_pembayaran","mata_uang_pembayaran","dateline_quo","alamat_perusahaan");
        $data = array();
        for($a=0; $a<count($name); $a++){
            $data += [$name[$a] => $this->input->post($name[$a])];
        }
        $data += ["id_user_add" => $this->session->id_user];
        $this->Mdquotation->insert($data);
        
        /*---- Metode Pembayaran ----*/

        $pembayaran = array(
            "persentase_pembayaran" => $this->input->post("persenDp"),
            "nominal_pembayaran" => $this->input->post("jumlahDpClean"),
            "trigger_pembayaran" => $this->input->post("paymentMethod"),
            "persentase_pembayaran2" =>$this->input->post("persenSisa"),
            "nominal_pembayaran2" => $this->input->post("jumlahSisaClean"),
            "trigger_pembayaran2" =>$this->input->post("paymentMethod2"),
            "no_quotation" =>$this->input->post("no_quo"),
            "versi_quotation" =>$this->input->post("versi_quo"),
            "kurs" => $this->input->post("mata_uang_pembayaran"),
        );
        insertRow("metode_pembayaran",$pembayaran);
        /*update status buat quotation di price request supaya gabisa dibuat ulang yang udah pernah dibuat*/
        redirect("crm/quotation");
    }
    public function loss($id,$ver){
        $data = array(
            "status_quo" => 1
        );
        $where = array(
            "versi_quo" => $ver,
            "id_quo" => $id
        );
        $this->Mdquotation->update($data,$where);
        redirect("crm/quotation");
    }
    public function accepted($id,$ver,$bulan,$tahun){
        $data = array(
            "status_quo" => 2
        );
        $where = array(
            "versi_quo" => $ver,
            "id_quo" => $id,
            "bulan_quotation" => $bulan,
            "tahun_quotation" => $tahun
        );
        $this->Mdquotation->update($data,$where);
        redirect("crm/quotation");
        
    }
    public function editquotation(){
        $where = array(
            "id_quo" => $this->input->post("id_quo")
        );
        $name = array("hal_quo","up_cp","durasi_pengiriman","franco","durasi_pembayaran","mata_uang_pembayaran","dateline_quo","alamat_perusahaan");
        $data = array();
        for($a=0; $a<count($name); $a++){
            $data += [$name[$a] => $this->input->post($name[$a])];
        }
        $data += ["id_user_edit" => $this->session->id_user];
        $this->Mdquotation->update($data,$where);
        $where = array(
            "id_quotation" => $this->input->post("id_quo"),
            "id_versi" => $this->input->post("versi_quo")
        );
        $this->Mdmetode_pembayaran->delete($where);
        $method = $this->input->post("paymentMethod");
        //$methodDetail = explode("",$method);

        $persen = $this->input->post("persen");
        $persenDetail = array();
        $b=0;
        foreach($persen as $a){
            $persenDetail[$b] = $a;
            $b++;
        }

        $jumlah = $this->input->post("jumlah");
        $jumlahDetail = array();
        $b = 0;
        foreach($jumlah as $a){
            $jumlahDetail[$b] = $a;
            $b++;
        }

        $kurs = $this->input->post("mata_uang_pembayaran");

        for($a = 0; $a<count($jumlahDetail);$a++){
            $data = array(
                "urutan_pembayaran" => $a+1,
                "persentase_pembayaran" => $persenDetail[$a],
                "nominal_pembayaran" => splitterMoney($jumlahDetail[$a],","),
                "trigger_pembayaran" => $method[$a], //ini gara2 valuenya kurang
                "id_quotation" => $this->input->post("id_quo"),
                "id_versi" => $this->input->post("versi_quo"),
                "kurs" => $kurs
            );
            $this->Mdmetode_pembayaran->insert($data);
        }
        redirect("crm/quotation/edit/".$this->input->post("id_quo"));
    }
    /*ajax*/
}
?>