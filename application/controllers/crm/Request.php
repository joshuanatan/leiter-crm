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
            "customer" => array(
                "peran_perusahaan" => "CUSTOMER",
                "status_perusahaan" => 0
            ),
            "produk" => array(
                "produk.status_produk" => 0
            ),
            "price_request" => array(
                "price_request.status_aktif_request" => 0,
            ),
        );
        $field = array(
            "request" => array(
                "id_request","no_request","id_perusahaan","id_cp","franco","bulan_request","tahun_request","status_request","tgl_dateline_request"
            ),
            "items" => array(
                "nama_produk","jumlah_produk","notes_produk","file"
            )
        );
        $print = array(
            "request" => array(
                "id_request","no_request","id_perusahaan","id_cp","franco","bulan_request","tahun_request","status_request","dateline"
            ),
            "items" => array(
                "nama_produk","jumlah_produk","notes_produk","file"
            )
        );
        $result["request"] = selectRow("price_request",$where["price_request"]);
        $data["request"] = foreachMultipleResult($result["request"],$field["request"],$print["request"]);

        /*merubah id_perusahaan dan id_cp dan mencari jumlah jenis barang yang dipesan jadi nama masing-masing*/
        for($a = 0; $a<count($data["request"]); $a++){ 
            $data["request"][$a]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan"=>$data["request"][$a]["id_perusahaan"]));
            $data["request"][$a]["nama_cp"] = get1Value("contact_person","nama_cp", array("id_cp" => $data["request"][$a]["id_cp"]));
            $data["request"][$a]["jumlah"] = getAmount("price_request_item","id_request_item",array("no_request" => $data["request"][$a]["no_request"],"status_request_item" => 0));

            /*ngeload item*/
            $resultItem = selectRow("price_request_item",array("no_request" => $data["request"][$a]["no_request"]));
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
                "status_perusahaan" => 0
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
        $result["customer"] = selectRow("perusahaan",$where["customer"]);
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
    public function edit($id_request,$bulan,$tahun){
        $where = array(
            "price_request" => array(
                "id_request" => $id_request,
                "bulan_request" => $bulan,
                "tahun_request" => $tahun
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
                "nama_produk","jumlah_produk","notes_produk","file"
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
                "nama_produk","jumlah_produk","notes_produk","file"
            )
        );
        $result = selectRow("price_request",$where["price_request"]);
        $data["price_request"] = foreachResult($result,$field["price_request"],$print["price_request"]);

        $result = selectRow("perusahaan",$where["perusahaan"]);
        $data["perusahaan"] = foreachMultipleResult($result,$field["perusahaan"],$print["perusahaan"]); /*list customer*/

        $where["cp"] = array(
            "id_perusahaan" => $data["price_request"]["id_perusahaan"],
            "status_cp" => 0
        );
        $result = selectRow("contact_person",$where["cp"]);
        $data["cp"] = foreachMultipleResult($result,$field["cp"],$print["cp"]); /*list cp*/

        $where["detail_cp"] = array(
            "id_cp" => $data["price_request"]["id_cp"]
        );
        $result = selectRow("contact_person",$where["detail_cp"]);
        $data["detail_cp"] = foreachResult($result,$field["detail_cp"],$print["detail_cp"]);

        $where["items"] = array(
            "no_request" => $data["price_request"]["no_request"]
        );
        $result = selectRow("price_request_item",$where["items"]);
        $data["items"] = foreachMultipleResult($result,$field["items"],$print["items"]);

        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/request/category-header");
        $this->load->view("crm/request/detail-request",$data);
        $this->load->view("crm/content-close");
        $this->load->view("req/script");
        $this->close();
    }

    public function insert(){
        $data = array(
            "id_request" => $this->input->post("id_request"),
            "no_request" => $this->input->post("no_request"),
            "tgl_dateline_request" => $this->input->post("tgl_dateline_request"),
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "id_cp" => $this->input->post("id_cp"),
            "franco" => $this->input->post("franco"),
            "bulan_request" => date("m"),
            "tahun_request" => date("Y"),
            "status_request" => 0 ,
            "untuk_stock" => 1,
            "status_aktif_request" => 0,
            "id_user_add" => $this->session->id_user
        );
        insertRow("price_request",$data);
        $checks = $this->input->post("checks");
        if(count($checks) != 0){
            $config['upload_path']          = './assets/rfq/';
            $config['allowed_types']        = 'docx|jpeg|jpg|pdf|gif|png|xls|xlsx|doc';

            $this->load->library('upload', $config);
        }
        foreach($checks as $a){
            if($this->upload->do_upload("attachment".$a)){
                $report = $this->upload->data();
                $data = array(
                    "no_request" => $this->input->post("no_request"),
                    "nama_produk" => $this->input->post("item".$a),
                    "jumlah_produk" => $this->input->post("jumlah_produk".$a),
                    "notes_produk" => $this->input->post("notes".$a),
                    "file" =>$report["file_name"],
                    "id_user_add" => $this->session->id_user
                );
            }
            else{
                $report = array('upload_data' => $this->upload->display_errors());
                $data = array(
                    "no_request" => $this->input->post("no_request"),
                    "nama_produk" => $this->input->post("item".$a),
                    "jumlah_produk" => $this->input->post("jumlah_produk".$a),
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
            "no_request" => $this->input->post("no_request"),
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
                /*kalau dia centang dan upload file baru*/
                if($this->upload->do_upload("ordered_new_attachment".$a)){ 
                    $report = $this->upload->data();
                    $data = array(
                        "no_request" => $this->input->post("no_request"),
                        "nama_produk" => $this->input->post("ordered_nama".$a),
                        "jumlah_produk" => $this->input->post("ordered_amount".$a),
                        "notes_produk" => $this->input->post("ordered_notes".$a),
                        "file" =>$report["file_name"],
                        "id_user_add" => $this->session->id_user
                    );
                }
                /*kalau dia centang tapi tidak uplaod file baru*/
                else{
                    $report = array('upload_data' => $this->upload->display_errors());
                    $data = array(
                        "no_request" => $this->input->post("no_request"),
                        "nama_produk" => $this->input->post("item".$a),
                        "jumlah_produk" => $this->input->post("jumlah_produk".$a),
                        "notes_produk" => $this->input->post("notes".$a),
                        "file" =>$this->input->post("ordered_attachment".$a),
                        "id_user_add" => $this->session->id_user
                    );
                }
                insertRow("price_request_item",$data);
                $checks = $this->input->post("checks");
                
            }
        }
        /*barang baru yang di centang*/
        $checks = $this->input->post("checks");
        
        if($checks != "" && count($checks) != 0){
            foreach($checks as $a){
                /*yang dicentang, upload file*/
                if($this->upload->do_upload("attachment".$a)){
                    $report = $this->upload->data();
                    $data = array(
                        "no_request" => $this->input->post("no_request"),
                        "nama_produk" => $this->input->post("item".$a),
                        "jumlah_produk" => $this->input->post("jumlah_produk".$a),
                        "notes_produk" => $this->input->post("notes".$a),
                        "file" =>$report["file_name"],
                        "id_user_add" => $this->session->id_user
                    );
                }
                /*yang dicentang, tidak upload*/
                else{
                    $report = array('upload_data' => $this->upload->display_errors());
                    $data = array(
                        "no_request" => $this->input->post("no_request"),
                        "nama_produk" => $this->input->post("item".$a),
                        "jumlah_produk" => $this->input->post("jumlah_produk".$a),
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
    public function delete($id_request,$bulan,$tahun){
        $where = array(
            "id_request" => $id_request,
            "bulan_request" => $bulan,
            "tahun_request" => $tahun
        );
        $data = array(
            "status_aktif_request" => 1
        );
        updateRow("price_request",$data,$where);
        redirect("crm/request");
    }
    public function confirm($id_request,$bulan,$tahun){
        $where = array(
            "id_request" => $id_request,
            "bulan_request" => $bulan,
            "tahun_request" => $tahun
        );
        $data = array(
            "status_request" => 1
        );
        updateRow("price_request",$data,$where);
        redirect("crm/request");
    }
    public function getRequestDetail(){
        $where = array(
            "price_request.id_request" => $this->input->post("id_request")
        );
        $result = $this->Mdprice_request->select($where);
        $value = array();
        foreach($result->result() as $a){
            $value = array(
                "nama_perusahaan" =>  strtoupper(get1Value("perusahaan","nama_perusahaan", array("id_perusahaan" => $a->id_perusahaan))),
                "nama_cp" => ucwords(get1Value("contact_person","nama_cp", array("id_perusahaan" => $a->id_perusahaan))),
                "id_cp" => $a->id_cp,
                "id_perusahaan" => $a->id_perusahaan,
                "alamat_perusahaan" => get1Value("perusahaan","alamat_perusahaan", array("id_perusahaan" => $a->id_perusahaan)),
                "franco" => $a->franco
            );
        }
        /* -------------------------------------------------------------------------------- */
        $where = array(
            "price_request_item.id_request" => $this->input->post("id_request"),
            "price_request_item.status_request_item" => 0
        );
        $result = $this->Mdprice_request_item->select($where); /*ambil semua data price request item*/
        $counter = 0;
        foreach($result->result() as $a){
            $value["items"][$counter] = array(
                "id_request_item" => $a->id_request_item,
                "nama_produk" => get1Value("produk","nama_produk", array("id_produk" => $a->id_produk))
            );
            $counter++;
        }
        /* -------------------------------------------------------------------------------- */
        echo json_encode($value);
    }
    public function getAmountOrders(){
        $where = array(
            "id_request_item" => $this->input->post("id_request_item")
        );
        $id_produk = get1Value("price_request_item","id_produk", $where);
        $id_request =  get1Value("price_request_item","id_request",array("id_request_item"=>$this->input->post("id_request_item")));
        $total = getTotal("price_request_item","jumlah_produk",array("id_produk" => $id_produk,"id_request" => $id_request)); //harusnya yang 1 id _request
        $satuan_produk = get1Value("produk","satuan_produk",array("id_produk" => $id_produk));
        echo json_encode($total." ".$satuan_produk);
    }
}
?>