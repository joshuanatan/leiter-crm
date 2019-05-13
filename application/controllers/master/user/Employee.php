<?php
class Employee extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mduser");
        $this->load->model("Mdmenu");
        $this->load->model("Mdprivilage");
    }
    public function index(){
        $this->load->view("req/head");
        $this->load->view("master/employee/css/datatable-css");
        $this->load->view("master/employee/css/breadcrumb-css");
        $this->load->view("master/employee/css/modal-css");
        $this->load->view("master/employee/css/form-css");
        $this->load->view("req/head-close");
        $this->load->view("master/master-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
        /*--------------------------------------------------------*/
        $where = array(
            "employee" => array(),
            "menu" => array()
        );
        $data = array(
            "employee" => $this->Mduser->select($where["employee"]),
            "menu" => $this->Mdmenu->select($where["menu"])
        );
        $this->load->view("master/content-open");
        $this->load->view("master/employee/category-header");
        $this->load->view("master/employee/category-body",$data);
        $this->load->view("master/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("master/employee/js/jqtabledit-js");
        $this->load->view("master/employee/js/page-datatable-js");
        $this->load->view("master/employee/js/form-js");
        $this->load->view("master/employee/js/employee-additional-js");
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
    }
    public function register(){
        $where = array(
            "menuType" => array()
        );
        $name = array(
            "nama_user",
            "email_user",
            "nohp_user",
            "password"
        );
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => md5($this->input->post($name[3])),
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
}
?>