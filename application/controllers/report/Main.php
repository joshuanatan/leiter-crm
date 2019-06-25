<?php
class main extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function req(){
        $this->load->view("req/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/breadcrumb/breadcrumb-css");
        $this->load->view("plugin/modal/modal-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("plugin/chart-widget/chart-widget-css");
        $this->load->view("plugin/chart-js/chart-js-css");
        $this->load->view("req/head-close");
        $this->load->view("report/report-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("plugin/chart-js/chart-js-js");
        $this->load->view("report/report-close");
        $this->load->view("req/html-close"); 
    }
    public function index(){
        /*ngambil kpi user yang udah diset buat orang yang lagi login*/
        $where = array(
            "kpi_user" => array(
                "id_user" => $this->session->id_user,
                "status_aktif_kpi" => 0
            ),
            "kpi_report" => array(
                "id_user_add" => $this->session->id_user,
                "status_aktif_report" => 0
            )
        );
        $field = array(
            "kpi_user" => array(
                "id_user","kpi"
            ),
            "kpi_report" => array(
                "id_report","tipe_report","pic_target","location","progress_percentage","report","tgl_report","judul_report","attachment","support_need","next_plan"
            )
        );
        $print = array(
            "kpi_user" => array(
                "id_user","kpi"
            ),
            "kpi_report" => array(
                "id_report","tipe_report","pic_target","location","progress_percentage","report","tgl_report","judul_report","attachment","support_need","next_plan"
            )
        );
        $result["kpi_user"] = selectRow("kpi_user",$where["kpi_user"]);
        $data["kpi_user"] = foreachMultipleResult($result["kpi_user"],$field["kpi_user"],$print["kpi_user"]);
        
        $result["kpi_report"] = selectRow("report",$where["kpi_report"]);
        $data["kpi_report"] = foreachMultipleResult($result["kpi_report"],$field["kpi_report"],$print["kpi_report"]);
        
        $this->req();
        $this->load->view("report/content-open");
        $this->load->view("report/main/category-header");
        $this->load->view("report/main/category-body",$data);
        $this->load->view("report/content-close");
        $this->close();
    }
    public function insertReport(){
        $config = array(
            "upload_path" => "./assets/dokumen/report/",
            "allowed_types" => "jpg|png|jpeg|gif|docx|doc|pdf|xls|xlsx"
        );
        $this->load->library("upload",$config);
        if($this->upload->do_upload("attachment")){
            $fileData = $this->upload->data();
        }
        else{
            $fileData["file_name"] ="-";
        }
        $data = array(
            "tipe_report" => $this->input->post("tipe_report"),
            "pic_target" => $this->input->post("pic_target"),
            "location" => $this->input->post("location"),
            "progress_percentage" => $this->input->post("progress_percentage"),
            "report" => $this->input->post("report"),
            "judul_report" => $this->input->post("judul_report"),
            "attachment" => $fileData["file_name"],
            "support_need" => $this->input->post("support_need"),
            "id_user_add" => $this->session->id_user,
            "next_plan" => $this->input->post("next_plan")
        );
        insertRow("report",$data);
        redirect("report/main");
    }
    public function updateReport($id_report){
        $where = array(
            "id_report" => $id_report
        );
        $config = array(
            "upload_path" => "./assets/dokumen/report/",
            "allowed_types" => "jpg|png|jpeg|gif|docx|doc|pdf|xls|xlsx"
        );
        $this->load->library("upload",$config);
        if($this->upload->do_upload("attachment")){
            $fileData = $this->upload->data();
            $data = array(
                "tipe_report" => $this->input->post("tipe_report") ,
                "pic_target" => $this->input->post("pic_target") ,
                "location" => $this->input->post("location") ,
                "progress_percentage" => $this->input->post("progress_percentage") ,
                "report" => $this->input->post("report") ,
                "judul_report" => $this->input->post("judul_report") ,
                "attachment"=> $fileData["file_name"],
                "support_need" => $this->input->post("support_need"),
                "next_plan" => $this->input->post("next_plan"),
            );
        }
        else{
            $data = array(
                "tipe_report" => $this->input->post("tipe_report") ,
                "pic_target" => $this->input->post("pic_target") ,
                "location" => $this->input->post("location") ,
                "progress_percentage" => $this->input->post("progress_percentage") ,
                "report" => $this->input->post("report") ,
                "judul_report" => $this->input->post("judul_report") ,
                "support_need" => $this->input->post("support_need"),
                "next_plan" => $this->input->post("next_plan"),
            );
        }
        
        updateRow("report",$data,$where);
        redirect("report/main/");
    }
    public function remove($id_report){
        $where = array(
            "id_report" => $id_report
        );
        $data = array(
            "status_aktif_report" => 1
        );
        updateRow("report",$data,$where);
        redirect("report/main");
    }
}