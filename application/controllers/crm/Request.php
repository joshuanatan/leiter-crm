<?php
date_default_timezone_set("Asia/Bangkok");
class Request extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdprice_request");
    }
    public function index(){ 
        $this->session->page = 1;
        if($this->session->id_user == "") redirect("login/welcome");//sudah di cek
        $this->removeFilter();
        redirect("crm/request/page/".$this->session->page);
    }
    public function add(){ //sudah di cek
        $this->check_session();
        $where = array(
            "peran_perusahaan" => "CUSTOMER",
            "status_perusahaan" => 0
        );
        $field = array(
            "id_perusahaan","nama_perusahaan"
        );
        $result = selectRow("perusahaan",$where,$field);
        $data["customer"] = $result->result_array();

        $where = array(
            "bulan_request" => date("m"),
            "tahun_request" => date("Y"),
            "status_aktif_request" => 0
        );
        $data["maxId"] = getMaxId("price_request","id_request",$where);
        
        $this->page_generator->req();
        $this->load->view("plugin/form/form-css");
        $this->page_generator->head_close();
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("crm/request/category-header");
        $this->load->view("crm/request/add-request",$data);
        $this->page_generator->close();
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("crm/request/js/request-ajax");
    }
    public function edit($id_submit_request){ //sudah di cek
        $this->check_session();
        $where = array(
            "id_submit_request" => $id_submit_request
        );
        $field = array(
            "id_request","no_request","tgl_dateline_request","id_perusahaan","id_cp","franco"
        );
        $data["price_request"] = selectRow("price_request",$where,$field)->result_array();

        $where = array(
            "status_perusahaan" => 0,
            "peran_perusahaan" => "CUSTOMER"
        );
        $field = array(
            "id_perusahaan","nama_perusahaan"
        );
        $data["perusahaan"] = selectRow("perusahaan",$where,$field)->result_array();

        $where = array(
            "id_perusahaan" => $data["price_request"][0]["id_perusahaan"],
            "status_cp" => 0
        );
        $field = array(
            "id_cp","nama_cp","jk_cp"
        );
        $data["cp"] = selectRow("contact_person",$where,$field)->result_array(); /*list cp*/

        $where = array(
            "id_cp" => $data["price_request"][0]["id_cp"]
        );
        $field = array(
            "email_cp", "nohp_cp","email_cp"
        );
        $data["detail_cp"] = selectRow("contact_person",$where,$field)->result_array();
        
        $where = array(
            "id_submit_request" => $id_submit_request
        );
        $field = array(
            "nama_produk","jumlah_produk","notes_produk","file","satuan_produk"
        );
        $data["items"]  = selectRow("price_request_item",$where,$field)->result_array();
        
        $data["id_submit_request"] = $id_submit_request;
        /*end load list item yang sudah tersubmit */
        $this->page_generator->req();
        $this->load->view("plugin/form/form-css");
        $this->page_generator->head_close();
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("crm/request/category-header");
        $this->load->view("crm/request/detail-request",$data);
        $this->page_generator->close();
        $this->load->view("plugin/form/form-js");
        $this->load->view("crm/request/js/request-ajax");
    }
    public function insert(){ //sudah di cek
        /*insert price_request*/
        $this->check_session();
        $config = array(
            array(
                "field" => "id_request",
                "label" => "ID Request",
                "rules" => "required"
            ),
            array(
                "field" => "no_request",
                "label" => "Nomor Request",
                "rules" => "required"
            ),
            array(
                "field" => "id_perusahaan",
                "label" => "Perusahaan Customer",
                "rules" => "required"
            ),
            array(
                "field" => "id_cp",
                "label" => "PIC Customer",
                "rules" => "required" 
            ),
            array(
                "field" => "franco",
                "label" => "Franco",
                "rules" => "required" 
            ),
            array(
                "field" => "tgl_dateline_request",
                "label" => "Dateline",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
        
            $data = array(
                "id_request" => $this->input->post("id_request"),
                "bulan_request" => date("m"),
                "tahun_request" => date("Y"),
                "no_request" => $this->input->post("no_request"),
                "id_perusahaan" => $this->input->post("id_perusahaan"),
                "id_cp" => $this->input->post("id_cp"),
                "franco" => $this->input->post("franco"),
                "untuk_stock" => '1',
                "tgl_dateline_request" => $this->input->post("tgl_dateline_request"),
                "status_request" => '0' , //jatoh disini
                "id_user_add" => $this->session->id_user,
                "date_request_add" => date("Y-m-d H:i:s"),
                "date_request_edit" => date("Y-m-d H:i:s")
            );

            $id_submit_request = insertRow("price_request",$data);
            $checks = $this->input->post("checks");
            
            if($checks != ""){
                $config['upload_path']          = './assets/rfq/';
                $config['allowed_types']        = 'docx|jpeg|jpg|pdf|gif|png|xls|xlsx|doc';
                $this->load->library('upload', $config);

                foreach($checks as $a){ //mengambil barang-barang yang di check di depan berdasarkan centang
                    $check_data = array(
                        "jumlah" => $this->input->post("jumlah_produk".$a),
                        "nama_produk" => $this->input->post("item".$a),
                        "notes_produk" => $this->input->post("notes".$a),
                    );
                    if($check_data["jumlah"] == ""){ //kalau kosong aja
                        $check_data["jumlah"] = "0 -"; 
                    }
                    if($check_data["nama_produk"] == ""){ //kalau kosong aja
                        $check_data["nama_produk"] = "-";
                    }
                    if($check_data["notes_produk"] == ""){ //kalau kosong aja
                        $check_data["notes_produk"] = "-";
                    }

                    $split = explode(" ",$check_data["jumlah"]);
                    if(count($split) == 1){ //kalau diinputnya jumlah doang
                        $split[1] = "-";
                    }
                    if($this->upload->do_upload("attachment".$a)){
                        $report = $this->upload->data();
                        $data = array(
                            "id_submit_request" => $id_submit_request,
                            "nama_produk" => $check_data["nama_produk"],
                            "jumlah_produk" => $split[0],
                            "satuan_produk" => $split[1],
                            "notes_produk" => $check_data["notes_produk"],
                            "file" =>$report["file_name"],
                            "id_user_add" => $this->session->id_user
                        );
                    }
                    else{
                        $report = array('upload_data' => $this->upload->display_errors());
                        $data = array(
                            "id_submit_request" => get1Value("price_request","id_submit_request", array("no_request" => $this->input->post("no_request"))),
                            "nama_produk" => $check_data["nama_produk"],
                            "jumlah_produk" => $split[0],
                            "satuan_produk" => $split[1],
                            "notes_produk" => $check_data["notes_produk"],
                            "file" =>"-",
                            "id_user_add" => $this->session->id_user
                        );
                    }
                    insertRow("price_request_item",$data);
                }
            }
            $this->session->set_flashdata("status","success");
            $this->session->set_flashdata("msg","RFQ is successfully created");
            redirect("crm/request/page/".$this->session->page);
        }
        else{
            $this->session->set_flashdata("status","danger");
            $this->session->set_flashdata("msg",validation_errors());
            redirect("crm/request/add");
        }
    }
    public function update(){ //sudah di cek
        $this->check_session();
        $config = array(
            array(
                "field" => "id_submit_request",
                "label" => "ID Submit Request",
                "rules" => "required"
            ),
            array(
                "field" => "tgl_dateline_request",
                "label" => "Dateline",
                "rules" => "required"
            ),
            array(
                "field" => "id_perusahaan",
                "label" => "Perusahaan Customer",
                "rules" => "required"
            ),
            array(
                "field" => "id_cp",
                "label" => "PIC Customer",
                "rules" => "required"
            ),
            array(
                "field" => "franco",
                "label" => "Franco",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $where = array(            
                "id_submit_request" => $this->input->post("id_submit_request")
            );
            $data = array(
                "tgl_dateline_request" => $this->input->post("tgl_dateline_request"),
                "id_perusahaan" => $this->input->post("id_perusahaan"),
                "id_cp" => $this->input->post("id_cp"),
                "franco" => $this->input->post("franco"),
                "id_user_edit" => $this->session->id_user,
                "date_request_edit" => date("Y-m-d H:i:s")
            );
            updateRow("price_request",$data,$where);

            deleteRow("price_request_item",$where);
            $checks_ordered = $this->input->post("ordered_checks");
            $config['upload_path']          = './assets/rfq/';
            $config['allowed_types']        = 'docx|jpeg|jpg|pdf|gif|png|xls|xlsx|doc';

            $this->load->library('upload', $config);
        
            if($checks_ordered != ""){
                foreach($checks_ordered as $a){
                    $check_data = array(
                        "jumlah" => $this->input->post("ordered_amount".$a),
                        "nama_produk" => $this->input->post("ordered_nama".$a),
                        "notes_produk" => $this->input->post("ordered_notes".$a),
                    );
                    if($check_data["jumlah"] == ""){ //kalau kosong aja
                        $check_data["jumlah"] = "0 -"; 
                    }
                    if($check_data["nama_produk"] == ""){ //kalau kosong aja
                        $check_data["nama_produk"] = "-";
                    }
                    if($check_data["notes_produk"] == ""){ //kalau kosong aja
                        $check_data["notes_produk"] = "-";
                    }
                    $split = explode(" ",$check_data["jumlah"]);
                    if(count($split) == 1){ //kalau diinputnya jumlah doang
                        $split[1] = "-";
                    }
                    /*kalau dia centang dan upload file baru*/
                    if($this->upload->do_upload("ordered_new_attachment".$a)){ 
                        $report = $this->upload->data();
                        $data = array(
                            "id_submit_request" => $where["id_submit_request"],
                            "nama_produk" => $check_data["nama_produk"],
                            "jumlah_produk" => $split[0], 
                            "satuan_produk" => $split[1], 
                            "notes_produk" => $check_data["notes_produk"],
                            "file" =>$report["file_name"],
                            "id_user_add" => $this->session->id_user
                        );
                    }
                    /*kalau dia centang tapi tidak uplaod file baru*/
                    else{
                        $data = array(
                            "id_submit_request" => $where["id_submit_request"],
                            "nama_produk" => $check_data["nama_produk"],
                            "jumlah_produk" => $split[0], 
                            "satuan_produk" => $split[1], 
                            "notes_produk" => $check_data["notes_produk"],
                            "file" => "-",
                            "id_user_add" => $this->session->id_user
                        );
                    }
                    insertRow("price_request_item",$data);
                    
                }
            }
            /*barang baru yang di centang*/
            $checks = $this->input->post("checks");
            if($checks != ""){
                foreach($checks as $a){
                    $check_data = array(
                        "jumlah" => $this->input->post("jumlah_produk".$a),
                        "nama_produk" => $this->input->post("item".$a),
                        "notes_produk" => $this->input->post("notes".$a),
                    );
                    if($check_data["jumlah"] == ""){ //kalau kosong aja
                        $check_data["jumlah"] = "0 -"; 
                    }
                    if($check_data["nama_produk"] == ""){ //kalau kosong aja
                        $check_data["nama_produk"] = "-";
                    }
                    if($check_data["notes_produk"] == ""){ //kalau kosong aja
                        $check_data["notes_produk"] = "-";
                    }
                    $split = explode(" ",$check_data["jumlah"]);
                    if(count($split) == 1){ //kalau diinputnya jumlah doang
                        $split[1] = "-";
                    }
                    /*yang dicentang, upload file*/
                    if($this->upload->do_upload("attachment".$a)){
                        $report = $this->upload->data();
                        $data = array(
                            "id_submit_request" => $where["id_submit_request"],
                            "nama_produk" => $check_data["nama_produk"],
                            "jumlah_produk" => $split[0], 
                            "satuan_produk" => $split[1], 
                            "notes_produk" => $check_data["notes_produk"],
                            "file" =>$report["file_name"],
                            "id_user_add" => $this->session->id_user
                        );
                    }
                    /*yang dicentang, tidak upload*/
                    else{
                        $data = array(
                            "id_submit_request" => $where["id_submit_request"],
                            "nama_produk" => $check_data["nama_produk"],
                            "jumlah_produk" => $split[0], 
                            "satuan_produk" => $split[1], 
                            "notes_produk" => $check_data["notes_produk"],
                            "file" =>"-",
                            "id_user_add" => $this->session->id_user
                        );
                    }
                    insertRow("price_request_item",$data);
                }
            }
            $this->session->set_flashdata("status","success");
            $this->session->set_flashdata("msg","Data is successfully updated to database");
            redirect("crm/request/page/".$this->session->page);
        }
        else{
            $this->session->set_flashdata("status","danger");
            $this->session->set_flashdata("msg",validation_errors());
            redirect("crm/request/page/".$this->session->page);
        }
    }
    public function delete($id_submit_request){ //sudah di cek
        $this->check_session();
        $where = array(
            "id_submit_request" => $id_submit_request
        );
        $data = array(
            "status_aktif_request" => 1
        );
        updateRow("price_request",$data,$where);
        $this->session->set_flashdata("status","danger");
        $this->session->set_flashdata("msg","Data is successfully removed from system");
        redirect("crm/request/page/".$this->session->page);
    }
    public function confirm($id_submit_request){ //sudah di cek
        $this->check_session();
        $where = array(
            "id_submit_request" => $id_submit_request
        );
        $data = array(
            "status_request" => 3
        );
        updateRow("price_request",$data,$where);
        $this->session->set_flashdata("status","success");
        $this->session->set_flashdata("msg","Data is successfully finalized");
        redirect("crm/request/page/".$this->session->page);
    }
    public function insertNewCustomer(){ //sudah di cek
        $this->check_session();
        $config = array(
            array(
                "field" => "add_nama_customer",
                "label" => "Nama Perusahaan",
                "rules" => "required"
            ),
            array(
                "field" => "add_segment_customer",
                "label" => "Segment Perusahaan",
                "rules" => "required"
            ),
            array(
                "field" => "add_address_customer",
                "label" => "Alamat Perusahaan",
                "rules" => "required"
            ),
            array(
                "field" => "add_pengiriman_customer",
                "label" => "Alamat Pengiriman",
                "rules" => "required"
            ),
            array(
                "field" => "add_pic",
                "label" => "Nama PIC",
                "rules" => "required"
            ),
            array(
                "field" => "add_email_pic",
                "label" => "Email PIC",
                "rules" => "required"
            ),
            array(
                "field" => "add_jk_pic",
                "label" => "Gender PIC",
                "rules" => "required"
            ),
            array(
                "field" => "add_phone_pic",
                "label" => "Phone PIC",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $no_urut = getMaxId("perusahaan","no_urut",array("peran_perusahaan" => "customer","status_perusahaan" => 0));
            $data = array(
                "no_urut" => $no_urut,
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
            $this->session->set_flashdata("status","success");
            $this->session->set_flashdata("msg","Customer is successfully added to database");
        }
        else{
            $this->session->set_flashdata("status","danger");
            $this->session->set_flashdata("msg",validation_errors());
        }
        redirect("crm/request/add");
    }
    /******** DATA TABLE SECTION *********8 */
    public function sort(){
        $this->session->order_by = $this->input->post("order_by");
        $this->session->order_direction = $this->input->post("order_direction");
        redirect("crm/request/page/".$this->session->page);
    }
    public function search(){
        $search = $this->input->post("search");
        $this->session->search = $search;
        redirect("crm/request/page/".$this->session->page);
    }
    public function removeFilter(){
        $this->session->unset_userdata("order_by");
        $this->session->unset_userdata("order_direction");
        $this->session->unset_userdata("search");
        redirect("crm/request/page/".$this->session->page);
    }
    /**
     * ini yang diganti tinggal search, search_print, field, cara cari datanya
     */
    public function page($i){
        $this->check_session();
        /*page data*/
        $this->session->page = $i;
        $limit = 10;
        $offset = 10*($i-1);
        if($i <= 3){
            $data["numbers"] = array(1,2,3,4,5);
            $data["prev"] = 1;
            $data["search"] = 1;
        }
        else{
            for($a = 0; $a<5; $a++){
                $data["numbers"][$a] = $i+$a-2;
                $data["prev"] = 0;
                $data["search"] = 1;
            }
        }
        $data["search"] = array(
            "no_request","franco","tgl_dateline_request","date_request_edit","nama_perusahaan","nama_cp",
        );
        $data["search_print"] = array(
            "no request","franco","tgl dateline request","tanggal edit","nama perusahaan","nama cp",
        );
        /*end page data*/

        /*form condition*/
        if($this->session->search != ""){
            $or_like = array(
                "no_request" => $this->session->search,
                "franco" => $this->session->search,
                "tgl_dateline_request" => $this->session->search,
                "date_request_edit" => $this->session->search,
                "nama_perusahaan" => $this->session->search,
                "nama_cp" => $this->session->search,
            );
        }
        else{
            $or_like = "";
        }
        if($this->session->order_by != ""){
            $order_by = $this->session->order_by;
        }
        else{
            $order_by = "date_request_edit";
        }
        if($this->session->order_direction != ""){
            $direction = $this->session->order_direction;
        }
        else{
            $direction = "DESC";
        }
        /*end form condition*/

        /*ganti bawah ini*/
        $where = array(
            "id_user_add_request" => "-999"
        );
        if(isExistsInTable("privilage", array("id_user" => $this->session->id_user,"id_menu" => "view_created_rfq")) == 0){
            $where = array(
                "status_aktif_request" => 0,
                "id_user_add_request" => $this->session->id_user
            );
        }
        if(isExistsInTable("privilage", array("id_user" => $this->session->id_user,"id_menu" => "view_all_rfq")) == 0){
            $where = array(
                "status_aktif_request" => 0
            );
        }
        $field = array(
            "id_submit_request","id_request","bulan_request","tahun_request","no_request","id_perusahaan","id_cp","franco","untuk_stock","tgl_dateline_request","status_buat_quo","status_aktif_request","status_request","date_request_add","date_request_edit","date_request_delete","nama_perusahaan","nama_cp"
        );
        $group_by = array(
            "id_submit_request"
        );
        $result = $this->Mdprice_request->getDataTable($where,$field,$or_like,$order_by,$direction,$limit,$offset,$group_by);
        $data["request"] = $result->result_array();

        
        for($a = 0; $a<count($data["request"]); $a++){ 

            $data["request"][$a]["jumlah"] = getAmount("price_request_item","id_request_item",array("id_submit_request" => $data["request"][$a]["id_submit_request"],"status_request_item" => 0));

            $where = array(
                "id_submit_request" => $data["request"][$a]["id_submit_request"]
            );
            $field = array(
                "nama_produk","jumlah_produk","notes_produk","file","satuan_produk"
            );
            $result = selectRow("price_request_item",$where,$field);
            $data["request"][$a]["items"] = $result->result_array();
        }
        $this->page_generator->req();
        $this->page_generator->head_close();
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("crm/request/category-header");
        $this->load->view("crm/request/category-body",$data);
        $this->page_generator->close();
    }
    private function check_session(){
        if($this->session->id_user == ""){
            redirect("login/welcome");
        }
    }
}
?>