<?php
class Customer extends CI_Controller{
    public function __construct(){
        parent::__construct();  
        $this->load->model("Mdperusahaan");
        $this->load->model("Mdcontact_person");

    }
    /*page*/
    public function contact($i){
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("plugin/contact/contact-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $this->load->view("master/content-open");
        $this->load->view("master/Customer/category-header");
        $where = array(
            "contact_person.id_perusahaan" => $i,
            "contact_person.status_cp" => 0
        );
        $data = array(
            "cp" => $this->Mdcontact_person->select($where),
            "id_perusahaan" => $i
        );
        $this->load->view("master/Customer/contact-customer",$data);
        $this->load->view("master/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
    public function index(){
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("plugin/contact/contact-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $this->load->view("master/content-open");
        $this->load->view("master/Customer/category-header");
        $where = array(
            "perusahaan" => array(
                "peran_perusahaan" => "CUSTOMER",
                "perusahaan.status_perusahaan" => 0
            )
        );
        $data = array(
            "perusahaan" => $this->Mdperusahaan->select($where["perusahaan"])
        );
        $this->load->view("master/Customer/category-body",$data);
        $this->load->view("master/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("plugin/jqtabledit/jqtabledit-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
    public function edit($i){
        
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("plugin/contact/contact-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $where = array(
            "perusahaan.id_perusahaan" => $i
        );
        $data = array(
            "perusahaan" => $this->Mdperusahaan->select($where)
        );  
        $this->load->view("master/content-open");
        $this->load->view("master/Customer/category-header");
        $this->load->view("master/Customer/edit-customer",$data);
        $this->load->view("master/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("plugin/jqtabledit/jqtabledit-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("master/master-close");
        $this->load->view("req/html-close");
    }
    public function detail(){
        $this->load->view("req/head");
        $this->load->view("detail/css/detail-css");
        $this->load->view("req/head-close");
        $this->load->view("detail/detail-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $this->load->view("detail/content-open");
        $this->load->view("detail/customer/profile");
        $this->load->view("detail/tab-open");
        $this->load->view("detail/customer/tab-item");
        $this->load->view("detail/customer/tab-content");
        $this->load->view("detail/tab-close");
        $this->load->view("detail/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("detail/js/detail-js");
        $this->load->view("detail/detail-close");
        $this->load->view("req/html-close");
    }
    /*function*/
    public function register(){
        $name = array("nama_perusahaan","jenis_perusahaan","alamat_perusahaan","notelp_perusahaan");
        $nameCp = array("nama_cp","jk_cp","email_cp","nohp_cp","jabatan_cp");
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => $this->input->post($name[3]),
            "peran_perusahaan" => "CUSTOMER",
            "id_user_add" => $this->session->id_user
        );
        $result = $this->Mdperusahaan->insert($data);
        $data = array(
            $nameCp[0] => $this->input->post($nameCp[0]),
            $nameCp[1] => $this->input->post($nameCp[1]),
            $nameCp[2] => $this->input->post($nameCp[2]),
            $nameCp[3] => $this->input->post($nameCp[3]),
            $nameCp[4] => $this->input->post($nameCp[4]),
            "id_perusahaan" => $result,
            "id_user_add" => $this->session->id_user
        );
        $this->Mdcontact_person->insert($data);
        redirect("master/customer");
    }
    public function removecp($i,$page){
        $data = array(
            "status_cp" => 1,
            "id_user_delete" => $this->session->id_user
        );
        $where = array(
            "id_cp" => $i
        );  
        $this->Mdcontact_person->update($data,$where);
        redirect("master/customer/contact/".$page);
    }
    public function editcp(){
        $nameCp = array("nama_cp","jk_cp","email_cp","nohp_cp","jabatan_cp","id_perusahaan","id_cp");
        $where = array(
            "id_cp" => $this->input->post($nameCp[6])
        );
        $data = array(
            $nameCp[0] => $this->input->post($nameCp[0]),
            $nameCp[1] => $this->input->post($nameCp[1]),
            $nameCp[2] => $this->input->post($nameCp[2]),
            $nameCp[3] => $this->input->post($nameCp[3]),
            $nameCp[4] => $this->input->post($nameCp[4]),
            $nameCp[5] => $this->input->post($nameCp[5]),
            "id_user_edit" => $this->session->id_user
        );
        $this->Mdcontact_person->update($data,$where);
        redirect("master/customer/contact/".$this->input->post($nameCp[5]));
    }
    public function registercp(){
        $nameCp = array("nama_cp","jk_cp","email_cp","nohp_cp","jabatan_cp","id_perusahaan");
        $data = array(
            $nameCp[0] => $this->input->post($nameCp[0]),
            $nameCp[1] => $this->input->post($nameCp[1]),
            $nameCp[2] => $this->input->post($nameCp[2]),
            $nameCp[3] => $this->input->post($nameCp[3]),
            $nameCp[4] => $this->input->post($nameCp[4]),
            $nameCp[5] => $this->input->post($nameCp[5]),
            "id_user_add" => $this->session->id_user
        );
        $this->Mdcontact_person->insert($data);
        redirect("master/customer/contact/".$this->input->post($nameCp[5]));
    }
    public function editcustomer(){
        $where = array(
            "perusahaan.id_perusahaan" => $this->input->post("id_perusahaan")
        );
        $data = array(
            "nama_perusahaan" => $this->input->post("nama_perusahaan"),
            "jenis_perusahaan" => $this->input->post("jenis_perusahaan"),
            "alamat_perusahaan" => $this->input->post("alamat_perusahaan"),
            "notelp_perusahaan" => $this->input->post("notelp_perusahaan"),
            "id_user_edit" => $this->session->id_user
        );
        $this->Mdperusahaan->update($data,$where);
        redirect("master/customer/edit/".$this->input->post("id_perusahaan"));
    }
    public function delete($i){
        $where = array(
            "perusahaan.id_perusahaan" => $i
        );
        $data = array(
            "status_perusahaan" => 1,
            "id_user_delete" => $this->session->id_user
        );
        $this->Mdperusahaan->update($data,$where);
        redirect("master/customer/");
    }
    /*ajax*/
    public function getcp(){
        $where = array(
            "id_perusahaan" => $this->input->post("id_perusahaan")
        );
        $result = $this->Mdcontact_person->select($where);
        $html = "";
        foreach($result->result() as $a){
            $html .= "<option value = ".$a->id_cp.">".ucwords($a->nama_cp)."</option>";
        }
        echo json_encode($html);
    }
}
?>