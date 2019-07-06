<?php
class Request extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdprice_request");
        $this->load->model("Mdperusahaan");
        $this->load->model("Mdproduk");
        $this->load->model("Mdprice_request_item"); 
        $this->load->model("Mdcontact_person"); 
    }
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
        $this->load->view("crm/request/js/request-ajax");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    public function index(){
        $this->req();
        $where = array(
            "price_request" => array(
                "price_request.status_aktif_request" => 0,
            ),
        );
        $field = array(
            "request" => array(
                "id_request","no_request","id_perusahaan","id_cp","franco","bulan_request","tahun_request","status_request","tgl_dateline_request","id_submit_request"
            ),
            "items" => array(
                "nama_produk","jumlah_produk","notes_produk","file","satuan_produk"
            )
        );
        $print = array(
            "request" => array(
                "id_request","no_request","id_perusahaan","id_cp","franco","bulan_request","tahun_request","status_request","dateline","id_submit_request"
            ),
            "items" => array(
                "nama_produk","jumlah_produk","notes_produk","file","satuan_produk"
            )
        );
        $result["request"] = $this->Mdprice_request->getListPriceRequest($where["price_request"]); //load list request
        $data["request"] = foreachMultipleResult($result["request"],$field["request"],$print["request"]); //ngebuka foreach list request

        //muterin list request
        for($a = 0; $a<count($data["request"]); $a++){ 

            $data["request"][$a]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan"=>$data["request"][$a]["id_perusahaan"]));
            $data["request"][$a]["nama_cp"] = get1Value("contact_person","nama_cp", array("id_cp" => $data["request"][$a]["id_cp"]));

            $data["request"][$a]["jumlah"] = getAmount("price_request_item","id_request_item",array(
                "id_submit_request" => $data["request"][$a]["id_submit_request"],"status_request_item" => 0));

            /*ngeload item*/
            $resultItem = selectRow("price_request_item",array("id_submit_request" => $data["request"][$a]["id_submit_request"]));
            $items = foreachMultipleResult($resultItem,$field["items"],$print["items"]);
            
            $data["request"][$a]["items"] = $items;
        }

        $this->load->view("crm/content-open");
        $this->load->view("crm/request/category-header");
        $this->load->view("crm/request/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function add(){
        $where = array(
            "customer" => array(
                "peran_perusahaan" => "CUSTOMER",
            ),
            "maxId" => array(
                "bulan_request" => date("m"),
                "tahun_request" => date("Y")
            )
        );
        $field = array(
            "customer" => array(
                "id_perusahaan", "nama_perusahaan"
            )
        );
        $print = array(
            "customer" => array(
                "id_perusahaan","nama_perusahaan"
            )
        );
        $result["customer"] = $this->Mdperusahaan->getListPerusahaan($where["customer"]);
        $data = array(
            "maxId" => getMaxId("price_request","id_request", $where["maxId"]),
            "customer" => foreachMultipleResult($result["customer"],$field["customer"],$print["customer"])
        );

        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/request/category-header");
        $this->load->view("crm/request/add-request",$data);
        $this->load->view("crm/content-close");
        $this->load->view("req/script");
        $this->close();
    }
    public function edit($id_submit_request){
        $where = array(
            "price_request" => array(
                "id_submit_request" => $id_submit_request
            ),
            "perusahaan" => array(
                "status_perusahaan" => 0,
                "peran_perusahaan" => "CUSTOMER"
            ),
        );
        $field = array(
            "price_request" => array(
                "id_request","no_request","tgl_dateline_request","id_perusahaan","id_cp","franco"
            ),
            "perusahaan" => array(
                "id_perusahaan","nama_perusahaan"
            ),
            "cp" => array(
                "id_cp","nama_cp","jk_cp"
            ),
            "detail_cp" => array(
                "email_cp", "nohp_cp"
            ),
            "items" => array(
                "nama_produk","jumlah_produk","notes_produk","file","satuan_produk"
            )
        );
        $print = array(
            "price_request" => array(
                "id_request","no_request","tgl_dateline_request","id_perusahaan","id_cp","franco"
            ),
            "perusahaan" => array(
                "id_perusahaan","nama_perusahaan"
            ),
            "cp" => array(
                "id_cp","nama_cp","jk_cp"
            ),
            "detail_cp" => array(
                "email_cp", "nohp_cp"
            ),
            "items" => array(
                "nama_produk","jumlah_produk","notes_produk","file","satuan_produk"
            )
        );
        
        /*load detail price request*/
        $result = selectRow("price_request",$where["price_request"]);
        $data["price_request"] = foreachResult($result,$field["price_request"],$print["price_request"]);
        /*end load detail price request*/

        /*load dropdown perusahaan*/
        $result = $this->Mdperusahaan->getListPerusahaan($where["perusahaan"]);
        $data["perusahaan"] = foreachMultipleResult($result,$field["perusahaan"],$print["perusahaan"]); /*list customer*/
        /*end load dropdown perusahaan*/

        /*load dropdown cp dari perusahaan terkait*/
        $where["cp"] = array(
            "id_perusahaan" => $data["price_request"]["id_perusahaan"],
            "status_cp" => 0
        );
        $result = $this->Mdcontact_person->getListCp($where["cp"]);
        $data["cp"] = foreachMultipleResult($result,$field["cp"],$print["cp"]); /*list cp*/
        /*end load dropdown cp*/
        
        /*load detail cp dari cp terkait*/
        $where["detail_cp"] = array(
            "id_cp" => $data["price_request"]["id_cp"]
        );
        $result = selectRow("contact_person",$where["detail_cp"]);
        $data["detail_cp"] = foreachResult($result,$field["detail_cp"],$print["detail_cp"]);
        /*end load detail cp dari cp terkait */

        /*load list item yang sudah tersubmit*/
        $where["items"] = array(
            "id_submit_request" => $id_submit_request
        );
        $result = selectRow("price_request_item",$where["items"]);
        $data["items"] = foreachMultipleResult($result,$field["items"],$print["items"]);
        /*end load list item yang sudah tersubmit */
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/request/category-header");
        $this->load->view("crm/request/detail-request",$data);
        $this->load->view("crm/content-close");
        $this->load->view("req/script");
        $this->close();
    }
    public function insert(){
        /*insert price_request*/
        $data = array(
            "id_request" => $this->input->post("id_request"),
            "bulan_request" => date("m"),
            "tahun_request" => date("Y"),
            "no_request" => $this->input->post("no_request"),
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "id_cp" => $this->input->post("id_cp"),
            "franco" => $this->input->post("franco"),
            "untuk_stock" => 1,
            "tgl_dateline_request" => $this->input->post("tgl_dateline_request"),
            "status_request" => 0 ,
            "id_user_add" => $this->session->id_user
        );
        $id_submit_request = insertRow("price_request",$data);
        /*end price_request*/

        $checks = $this->input->post("checks"); //ngambil yang di centang
        if(count($checks) != 0){ //kalau ada barang yang disubmit
            $config['upload_path']          = './assets/rfq/';
            $config['allowed_types']        = 'docx|jpeg|jpg|pdf|gif|png|xls|xlsx|doc';

            $this->load->library('upload', $config);
        }
        foreach($checks as $a){ //mengambil barang-barang yang di check di depan berdasarkan centang
            $produk = $this->input->post("jumlah_produk".$a);
            $split = explode(" ",$produk);
            if($this->upload->do_upload("attachment".$a)){
                $report = $this->upload->data();
                $data = array(
                    "id_submit_request" => $id_submit_request,
                    "nama_produk" => $this->input->post("item".$a),
                    "jumlah_produk" => $split[0],
                    "satuan_produk" => $split[1],
                    "notes_produk" => $this->input->post("notes".$a),
                    "file" =>$report["file_name"],
                    "id_user_add" => $this->session->id_user
                );
            }
            else{
                $report = array('upload_data' => $this->upload->display_errors());
                $data = array(
                    "id_submit_request" => get1Value("price_request","id_submit_request", array("no_request" => $this->input->post("no_request"))),
                    "nama_produk" => $this->input->post("item".$a),
                    "jumlah_produk" => $split[0],
                    "satuan_produk" => $split[1],
                    "notes_produk" => $this->input->post("notes".$a),
                    "file" =>"-",
                    "id_user_add" => $this->session->id_user
                );
            }
            insertRow("price_request_item",$data);
        }
        redirect("crm/request");
    }
    public function update(){ /*terakhir disini*/
        $where = array(            
            "id_submit_request" => get1Value("price_request","id_submit_request", array("no_request" => $this->input->post("no_request"))),
        );
        $data = array(
            "tgl_dateline_request" => $this->input->post("tgl_dateline_request"),
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "id_cp" => $this->input->post("id_cp"),
            "franco" => $this->input->post("franco"),
        );
        updateRow("price_request",$data,$where);
        deleteRow("price_request_item",$where);
        $checks_ordered = $this->input->post("ordered_checks");
        $config['upload_path']          = './assets/rfq/';
        $config['allowed_types']        = 'docx|jpeg|jpg|pdf|gif|png|xls|xlsx|doc';

        $this->load->library('upload', $config);
    
        if($checks_ordered != "" && count($checks_ordered) != 0){
            
            foreach($checks_ordered as $a){
                $produk = $this->input->post("ordered_amount".$a);
                $split = explode(" ",$produk);
                /*kalau dia centang dan upload file baru*/
                if($this->upload->do_upload("ordered_new_attachment".$a)){ 
                    $report = $this->upload->data();
                    $data = array(
                        "id_submit_request" => get1Value("price_request","id_submit_request", array("no_request" => $this->input->post("no_request"))),
                        "nama_produk" => $this->input->post("ordered_nama".$a),
                        "jumlah_produk" => $split[0], 
                        "satuan_produk" => $split[1], 
                        "notes_produk" => $this->input->post("ordered_notes".$a),
                        "file" =>$report["file_name"],
                        "id_user_add" => $this->session->id_user
                    );
                }
                /*kalau dia centang tapi tidak uplaod file baru*/
                else{
                    $report = array('upload_data' => $this->upload->display_errors());
                    $data = array(
                        "id_submit_request" => get1Value("price_request","id_submit_request", array("no_request" => $this->input->post("no_request"))),
                        "nama_produk" => $this->input->post("ordered_nama".$a),
                        "jumlah_produk" => $split[0], 
                        "satuan_produk" => $split[1], 
                        "notes_produk" => $this->input->post("ordered_notes".$a),
                        "file" =>$this->input->post("ordered_attachment".$a),
                        "id_user_add" => $this->session->id_user
                    );
                }
                insertRow("price_request_item",$data);
                
            }
        }
        /*barang baru yang di centang*/
        $checks = $this->input->post("checks");
        
        if($checks != "" && count($checks) != 0){
            foreach($checks as $a){
                $produk = $this->input->post("jumlah_produk".$a);
                $split = explode(" ",$produk);
                /*yang dicentang, upload file*/
                if($this->upload->do_upload("attachment".$a)){
                    $report = $this->upload->data();
                    $data = array(
                        "id_submit_request" => get1Value("price_request","id_submit_request", array("no_request" => $this->input->post("no_request"))),
                        "nama_produk" => $this->input->post("item".$a),
                        "jumlah_produk" => $split[0], 
                        "satuan_produk" => $split[1], 
                        "notes_produk" => $this->input->post("notes".$a),
                        "file" =>$report["file_name"],
                        "id_user_add" => $this->session->id_user
                    );
                }
                /*yang dicentang, tidak upload*/
                else{
                    $report = array('upload_data' => $this->upload->display_errors());
                    $data = array(
                        "id_submit_request" => get1Value("price_request","id_submit_request", array("no_request" => $this->input->post("no_request"))),
                        "nama_produk" => $this->input->post("item".$a),
                        "jumlah_produk" => $split[0], 
                        "satuan_produk" => $split[1], 
                        "notes_produk" => $this->input->post("notes".$a),
                        "file" =>"-",
                        "id_user_add" => $this->session->id_user
                    );
                }
                insertRow("price_request_item",$data);
            }
        }
        redirect("crm/request");
    }
    public function delete($id_submit_request){
        $where = array(
            "id_submit_request" => $id_submit_request
        );
        $data = array(
            "status_aktif_request" => 1
        );
        updateRow("price_request",$data,$where);
        redirect("crm/request");
    }
    public function confirm($id_submit_request){
        $where = array(
            "id_submit_request" => $id_submit_request
        );
        $data = array(
            "status_request" => 1
        );
        updateRow("price_request",$data,$where);
        redirect("crm/request");
    }
    public function insertNewCustomer(){
        $data = array(
            "nama_perusahaan" => $this->input->post("add_nama_customer"),
            "jenis_perusahaan" => $this->input->post("add_segment_customer"),
            "alamat_perusahaan" => $this->input->post("add_address_customer"),
            "alamat_pengiriman" => $this->input->post("add_pengiriman_customer"),
            "permanent" => 1,
            "peran_perusahaan" => "CUSTOMER"
        );
        $id_perusahaan = insertRow("perusahaan",$data);
        $data = array(
            "id_perusahaan" => $id_perusahaan,
            "nama_cp" => $this->input->post("add_pic"),
            "email_cp" =>  $this->input->post("add_email_pic"),
            "jk_cp" =>  $this->input->post("add_jk_pic"),
            "nohp_cp" =>  $this->input->post("add_phone_pic")
        );
        insertRow("contact_person",$data);
        redirect("crm/request/add");
    }
}
?>