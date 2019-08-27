<?php
class Od extends CI_Controller{
    public function __construct(){
        parent::__construct();  
        $this->load->model("Mdorder_confirmation");
        $this->load->model("Mdperusahaan");
        $this->load->model("Mdod_core");
        $this->load->model("Mdod_item");

        $this->load->library('Pdf_noHead');
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
    public function index(){
        if($this->session->id_user == "") redirect("login/welcome");
        $where = array(
            "status_od" => 0
        );
        $field = array(
            "id_submit_od","id_submit_oc","no_od","id_courier","delivery_method","alamat_pengiriman","up_cp","date_od_add","nama_perusahaan","nama_cp","nama_courier","no_po_customer"
        );
        $result = selectRow("od_detail",$where,$field);
        $data["od"] = $result->result_array();

        for($a = 0; $a<count($data["od"]);$a++){
           
            $where = array(
                "id_submit_od" => $data["od"][$a]["id_submit_od"]
            );
            
            $field = array(
                "id_od_item","id_oc_item","item_qty","nama_oc_item","satuan_produk"
            );
            $result = selectRow("od_item_detail",$where,$field);
            $data["od"][$a]["items"] = $result->result_array();
        }

        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/od/category-header");
        $this->load->view("crm/od/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("crm/od/js/request-ajax");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    public function create(){ //sudah di tes
        $where = array(
            "status_aktif_oc" => 0
        );
        $field = array(
            "id_submit_oc", "no_po_customer","id_submit_quotation","nama_perusahaan","id_perusahaan"
        );
        $result = $this->Mdorder_confirmation->getListOcForOd($where,$field);
        
        $data["oc"] = $result->result_array();
        
        $where = array(
            "status_perusahaan" => 0,
            "peran_perusahaan" => "SHIPPING"
        );
        $field = array(
            "nama_perusahaan","id_perusahaan"
        );
        $result = selectRow("perusahaan",$where,$field);
        
        $data["courier"] = $result->result_array(); 
        $data["maxId"] = getMaxId("od_core","id_od",array("bulan_od" => date("m"),"tahun_od" => date("Y"),"status_aktif_od" => 0));
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/od/category-header");
        $this->load->view("crm/od/add-od",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function remove($id_submit_od){ //sudah di tes
        $where = array(
            "id_submit_od" => $id_submit_od
        );
        $this->Mdod_core->delete($where);
        $this->Mdod_item->delete($where);
        redirect("crm/od");
    }
    public function createod(){ //sudah di tes
        $input = array(
            "id_oc_item" => $this->input->post("id_oc_item"), 
            "jumlah_kirim" => $this->input->post("jumlah_kirim"), 
        );
        $array = array(
            "id_oc_item" => array(),
            "jumlah_kirim" => array()
        );
        $counter = 0 ;
        foreach($input["id_oc_item"] as $a){
            $array["id_oc_item"][$counter] = $a;
            $counter++;
        }
        $counter = 0 ;
        foreach($input["jumlah_kirim"] as $a){
            $array["jumlah_kirim"][$counter] = $a;
            $counter++;
        }
        /*end insert od item*/
        /*begin insert od core */
        $data = array(
            "id_submit_oc" => $this->input->post("id_submit_oc"),
            "id_od" => $this->input->post("id_od"),
            "bulan_od" => date("m"),
            "tahun_od" => date("Y"),
            "no_od" => $this->input->post("no_od"),
            "id_courier" => $this->input->post("courier"),
            "delivery_method" => $this->input->post("method"),
            "alamat_pengiriman" => $this->input->post("alamat_pengiriman"),
            "up_cp" => $this->input->post("up_cp"),
            "id_user_add" => $this->session->id_user
        );
        $id_submit_od = insertRow("od_core",$data);
        
        for($a = 0; $a<count($array["jumlah_kirim"]); $a++){
            $data = array(
                "id_submit_od" => $id_submit_od,
                "id_oc_item" => $array["id_oc_item"][$a],
                "item_qty" => $array["jumlah_kirim"][$a]
            );
            insertRow("od_item",$data);
        }
        redirect("crm/od");
    }
    public function edit($id_submit_od){ //sudah di tes
        $where = array(
            "id_submit_od" => $id_submit_od
        );
        $field = array(
            "id_submit_od","id_submit_oc","no_od","id_courier","delivery_method","alamat_pengiriman","up_cp","date_od_add","no_po_customer"
        );
        $result = selectRow("od_detail",$where,$field);
        $data["od"] = $result->result_array();

        $where = array(
            "status_perusahaan" => 0,
            "peran_perusahaan" => "SHIPPING"
        );
        $field = array(
            "nama_perusahaan","id_perusahaan"
        );
        $result= selectRow("perusahaan",$where,$field);
        
        $data["courier"] = $result->result_array(); 


        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/od/category-header");
        $this->load->view("crm/od/edit-od",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function editOd(){ //sudah di tes
        $where = array(
            "id_submit_od" => $this->input->post("id_submit_od")
        );
        $data = array(
            "id_courier" => $this->input->post("courier"),
            "delivery_method" => $this->input->post("method"),
            "up_cp" => $this->input->post("up_cp"),
            "alamat_pengiriman" => $this->input->post("alamat_pengiriman"),
        );
        updateRow("od_core",$data,$where);
        redirect("crm/od/edit/".$this->input->post("id_submit_od"));
    }
    function odPdf($id_submit_od){ //sudah di tes
        $where = array(
            "id_submit_od" => $id_submit_od,
        );
        $this->load->model('M_pdf_od');
        $od = $this->M_pdf_od->selectOd($where);

        $perusahaan = $this->M_pdf_od->selectPerusahaan($where);

        $barang = $this->M_pdf_od->selectBarang($where);

        $nopo = $this->M_pdf_od->selectNoPoCus($where);
        $data=array(
            "od" => $od,
            "perusahaan" => $perusahaan,
            "barang" =>$barang,
            "nopo" =>$nopo,
        );
        $this->load->view('crm/od/pdf_od',$data);
    }
}
?>