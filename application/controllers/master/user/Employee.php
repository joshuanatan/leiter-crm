<?php
class Employee extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mduser");
        $this->load->model("Mdmenu");
        $this->load->model("Mdprivilage");
    }
    /*page*/
    public function index(){
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $where = array(
            "employee" => array(
                "status_user" => 0
            ),
            "menu" => array(),
            "privilege" => array()
        );
        $data = array(
            "employee" => $this->Mduser->select($where["employee"]),
            "menu" => $this->Mdmenu->select($where["menu"]),
            "privilege" => $this->Mdprivilage->select($where["privilege"])
        );
        $this->load->view("master/content-open");
        $this->load->view("master/employee/category-header");
        $this->load->view("master/employee/category-body",$data);
        $this->load->view("master/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("plugin/jqtabledit/jqtabledit-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("master/employee/js/employee-additional-js");
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
    public function detail(){ /*coming soon*/
        $this->load->view("req/head");
        $this->load->view("detail/css/detail-css");
        $this->load->view("req/head-close");
        $this->load->view("detail/detail-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $this->load->view("detail/content-open");
        $this->load->view("detail/employee/profile");
        $this->load->view("detail/tab-open");
        $this->load->view("detail/employee/tab-item");
        $this->load->view("detail/employee/tab-content");
        $this->load->view("detail/tab-close");
        $this->load->view("detail/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("detail/js/detail-js");
        $this->load->view("detail/detail-close");
        $this->load->view("req/html-close");
        redirect("master/user/employee");
    }
    /*function*/
    public function register(){
        $where = array(
            "menuType" => array()
        );
        $name = array(
            "nama_user",
            "email_user",
            "nohp_user",
            "password",
            "jenis_user"
        );
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => md5($this->input->post($name[3])),
            $name[4] => $this->input->post($name[4]),
            "id_user_add" => $this->session->id_user
        );
        $insertID = $this->Mduser->insert($data); /*last user id*/
        $data = array(
            "id_user" => $insertID,
            "id_tipe" => 0
        );
        $this->Mduser->insertTipe($data);
        /*----------- end insert personal data ------------ */

        /*----------- begin update privilege   ------------ */
        $menuType = $this->Mdmenu->selectType($where["menuType"]);
        foreach($menuType->result() as $a){
            $category = $this->input->post(strtolower($a->type_menu));
            count($category);
            foreach($category as $a){
                $data = array(
                    "status_privilage" => 0,
                    "id_user_edit" => $this->session->id_user,
                    "date_user_edit" => date("Y-m-d H:i:s")
                );
                $where = array(
                    "id_menu" => $a,
                    "id_user" => $insertID
                );
                $this->Mdprivilage->update($data,$where);
            }
        }
        /*----------- end update privilege   ------------ */
        redirect("master/user/employee");
    }
    public function editemployee(){
        $name = array(
            "nama_user",
            "email_user",
            "nohp_user",
            "jenis_user"
        );
        $where = array(
            "user.id_user" => $this->input->post("id_user")
        );
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => $this->input->post($name[3]),
            "id_user_edit" => $this->session->id_user
        );
        $this->Mduser->update($data,$where);
        redirect("master/user/employee");
    }
    public function delete($i){
        $where = array(
            "user.id_user" => $i
        );
        $data = array(
            "status_user" => 1,
            "id_user_delete" => $this->session->id_user
        );
        $this->Mduser->update($data,$where);
        redirect("master/user/employee/");
    }
    public function editprivilege($i){
        $where = array(
            "id_user" => $i /*karena kan semua yang diprivilage di jagain sama iduser dan idmenu. idmenu mau di update statusnya semua jadi bisa diabaikan idmenunya dalam proses update status*/
        );
        $data = array(
            "privilage.status_privilage" => 1,
            "id_user_edit" => $this->session->id_user,
            "date_user_edit" => date("Y-m-d H:i:s")
        );
        $this->Mdprivilage->update($data,$where); /*statusnya di satuin dulu semua */

        $where = array(
            "menuType" => array()
        );
        $menuType = $this->Mdmenu->selectType($where["menuType"]); /*ngambil semua tipe menu yang ada */
        foreach($menuType->result() as $a){
            $category = $this->input->post(strtolower($a->type_menu)); /*ngepost perkategori*/
            count($category);
            foreach($category as $a){ /*update ke semua menu yang terdaftar*/
                $data = array(
                    "status_privilage" => 0, /*ubah jadi aktif*/
                    "id_user_edit" => $this->session->id_user,
                    "date_user_edit" => date("Y-m-d H:i:s")
                );
                $where = array(
                    "id_menu" => $a,
                    "id_user" => $i
                );
                $this->Mdprivilage->update($data,$where);
            }
        }
        redirect("master/user/employee");
    }
}
?>