<?php
class Product extends CI_Controller{
    public function __construct(){
        parent::__construct();
        
        $this->load->model("Mdproduk");
        $this->load->model("Mdsatuan");

    }
    /*page*/
    public function index(){
        if($this->session->id_user == "") redirect("login/welcome");
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("plugin/toastr/css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        $where = array(
            "produk" => array(
                "status_produk" => 0
            ),
            "satuan" => array(
                "status_satuan" => 0
            ),
        );
        $result = array(
            "produk" => $this->Mdproduk->select($where["produk"]),
            "satuan" => $this->Mdsatuan->select($where["satuan"])
        );
        $data = array(
            "produk" => array(),
            "satuan" => array()
        );
        $counter = 0 ;
        foreach($result["produk"]->result() as $a){
            $data["produk"][$counter] = array(
                "id_produk" => $a->id_produk,
                "bn_produk" => $a->bn_produk,
                "nama_produk" => "-",
                "satuan_produk" => $a->satuan_produk,
                "deskripsi_produk" => $a->deskripsi_produk,
                "gambar_produk" => $a->gambar_produk,
            );
            $counter++;
        }
        $counter = 0 ; 
        foreach($result["satuan"]->result() as $a){
            $data["satuan"][$counter] = array(
                "id_satuan" => $a->id_satuan,
                "nama_satuan" => $a->nama_satuan,
            );
            $counter++;
        }
        $this->load->view("master/content-open");
        $this->load->view("master/product/category-header");
        $this->load->view("master/product/category-body",$data);
        $this->load->view("master/content-close");

        $this->load->view("req/script");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/toastr/js");
        $this->load->view("master/product/js/form-script");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
    /*function*/
    public function insert(){
        $uom = "";
        if($this->input->post("uom") == "0"){
            $data = array(
                "nama_satuan" => strtoupper($this->input->post("uom_baru")),
                "id_user_add" => $this->session->id_user    
            );
            $this->Mdsatuan->insert($data);
            $uom = $this->input->post("uom_baru");
        }
        else{
            $uom = $this->input->post("uom");
        }
        $config['upload_path']          = './assets/system/produk/';
        $config['allowed_types']        = 'gif|jpg|png';
        $this->load->library('upload', $config);

        if ( !$this->upload->do_upload('gambar_produk')){
            $data = array(
                "bn_produk" => $this->input->post("bn_produk"),
                "nama_produk" => "-",
                "satuan_produk" => strtoupper($uom),
                "deskripsi_produk" => $this->input->post("deskripsi_produk"),
                "gambar_produk" => "-",
                "id_user_add" => $this->session->id_user
            );
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            $data = array(
                "bn_produk" => $this->input->post("bn_produk"),
                "nama_produk" => "-",
                "satuan_produk" => strtoupper($uom),
                "deskripsi_produk" => $this->input->post("deskripsi_produk"),
                "gambar_produk" => $data["upload_data"]["file_name"],
                "id_user_add" => $this->session->id_user
            );
        }
        $this->Mdproduk->insert($data);
        redirect("master/product");
    }
    public function delete($id_produk){
        $where = array(
            "id_produk" => $id_produk
        );
        $data = array(
            "status_produk" => 1
        );
        $this->Mdproduk->update($data,$where);
        redirect("master/product");
    }
    public function edit($id_produk){
        $where = array(
            "id_produk" => $id_produk
        );
        
        if(isExistsInTable("satuan",array("nama_satuan" => $this->input->post("uom"))) == 1){ /*Ternyata gak ada*/
            $data = array(
                "nama_satuan" => strtoupper($this->input->post("uom")),
                "id_user_add" => $this->session->id_user
            );
            $this->Mdsatuan->insert($data);
        }
        $config['upload_path']          = './assets/system/produk/';
        $config['allowed_types']        = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if ( !$this->upload->do_upload('gambar_produk')){
            $data = array(
                "bn_produk" => $this->input->post("bn_produk"),
                "nama_produk" => $this->input->post("nama_produk"),
                "satuan_produk" => $this->input->post("uom"),
                "deskripsi_produk" => $this->input->post("deskripsi_produk"),
                "id_user_add" => $this->session->id_user
            );
            $this->Mdproduk->update($data,$where);
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            $data = array(
                "bn_produk" => $this->input->post("bn_produk"),
                "nama_produk" => $this->input->post("nama_produk"),
                "satuan_produk" => $this->input->post("uom"),
                "deskripsi_produk" => $this->input->post("deskripsi_produk"),
                "gambar_produk" => $data["upload_data"]["file_name"],
                "id_user_add" => $this->session->id_user
            );
            $this->Mdproduk->update($data,$where);
        }
        redirect("master/product");
    }
    /*ajax*/
    public function getuom(){
        $where = array(
            "produk.id_produk" => $this->input->post("id_produk")
        );
        $result = $this->Mdproduk->select($where);
        foreach($result->result() as $a){
            echo json_encode(strtoupper($a->satuan_produk));
        }
    }
    public function getDetailProduct(){
        $where = array(
            "id_produk" => $this->input->post("id_produk")
        );
        $result = $this->Mdproduk->select($where);
        foreach($result->result() as $a){
            $data = array(
                "id_produk" => $a->id_produk,
                "bn_produk" => $a->bn_produk,
                "nama_produk" => $a->nama_produk,
                "satuan_produk" => $a->satuan_produk,
                "deskripsi_produk" => $a->deskripsi_produk,
                "status_produk" => $a->status_produk
            );
        }
        echo json_encode($data);
    }
    public function showTransaction($id_produk){
        $where = array(
            "status_aktif_oc" => 0,
            "id_produk_oc" => $id_produk
        );
        $field = array(
            "order_detail.id_submit_quotation","no_po_customer","no_oc","id_oc","bulan_oc","tahun_oc","order_detail.id_submit_oc","tgl_po_customer","total_oc_price","nama_perusahaan","nama_cp","no_quotation"
        );
        $result = $this->Mdproduk->showTransaction($where,$field);

        $data["oc"]= $result->result_array();

        for($a = 0; $a<count($data["oc"]);$a++){
            
            $where = array(
                "id_submit_oc" => $data["oc"][$a]["id_submit_oc"]
            );
            $field = array(
                "id_oc_item","nama_oc_item","final_amount_oc","satuan_produk_oc","final_selling_price_oc","status_oc_item"
            );
            $result = selectRow("order_item_detail",$where,$field);
            $data["oc"][$a]["oc_item"] = $result->result_array();

            $where = array(
                "id_submit_oc" => $data["oc"][$a]["id_submit_oc"]
            );
            $field = array(
                "persentase_pembayaran","nominal_pembayaran","trigger_pembayaran","status_bayar","is_ada_transaksi","persentase_pembayaran2","nominal_pembayaran2","trigger_pembayaran2","status_bayar2","is_ada_transaksi2","kurs"
            );
            $result = selectRow("order_confirmation_metode_pembayaran",$where,$field);
            $data["oc"][$a]["metode_pembayaran"] = $result->result_array();

            if($data["oc"][$a]["metode_pembayaran"][0]["trigger_pembayaran"] == 1){
                $data["oc"][$a]["metode_pembayaran"][0]["trigger_pembayaran"] = "BEFORE ORDER DELIVERY";
            }
            else{
                $data["oc"][$a]["metode_pembayaran"][0]["trigger_pembayaran"] = "AFTER ORDER DELIVERY";
            }
            if($data["oc"][$a]["metode_pembayaran"][0]["trigger_pembayaran2"] == 1){
                $data["oc"][$a]["metode_pembayaran"][0]["trigger_pembayaran2"] = "BEFORE ORDER DELIVERY";
            }
            else{
                $data["oc"][$a]["metode_pembayaran"][0]["trigger_pembayaran2"] = "AFTER ORDER DELIVERY";
            }

        }
        $where = array(
            "status_aktif_oc" => 0,
            "id_produk_oc" => $id_produk
        );
        $field = array(
            "count(order_detail.id_submit_oc) as jumlah_transaksi"
        );
        $result = $this->Mdproduk->showTransaction($where,$field);
        $result_array = $result->result_array();
        $data["jumlah_transaksi"] = $result_array[0]["jumlah_transaksi"];
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("plugin/toastr/css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        $this->load->view("master/content-open");
        $this->load->view("master/product/category-header");
        $this->load->view("master/product/transaction",$data);
        $this->load->view("master/content-close");

        $this->load->view("req/script");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/toastr/js");
        $this->load->view("master/product/js/form-script");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
}
?>