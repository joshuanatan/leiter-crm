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
        $this->load->view("report/main/js/request-ajax");
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

    public function visit(){ /*nampilin visit report yang udah di submit oleh orang yang lagi login*/
        $where = array(
            "id_user_add" => $this->session->id_user,
            "jenis_report" => 1
        );
        $result = selectRow("visit_call_report",$where);
        $field = array(
            "id_submit_report", "action_date", "id_perusahaan", "action_location", "action_duration", "action_purpose", "action_pic", "pic_position", "action_conversation", "potential_machine", "action_conclusion", "action_percentage_order", "support_need", "followup_date", "id_user_add", "tgl_report_add", "status_aktif_report", "status_cetak_report", "jenis_report","conversation_image"
        );
        $data["visit"] = foreachMultipleResult($result,$field,$field);
        for($a = 0; $a<count($data["visit"]); $a++){
            $data["visit"][$a]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["visit"][$a]["id_perusahaan"]));
            $where = array(
                "id_submit_report" => $data["visit"][$a]["id_submit_report"],
                "status_next_action" => 0
            );  
            $result = selectRow("visit_call_report_next_action",$where);
            $field = array(
                "id_submit_next_action","remarks","pic","status_next_action"
            );  
            $data["visit"][$a]["next_action"] = foreachMultipleResult($result,$field,$field);
        }
        $this->req();
        $this->load->view("report/content-open");
        $this->load->view("report/main/visit-header");
        $this->load->view("report/main/visit-report",$data);
        $this->load->view("report/content-close");
        $this->close();
    }
    public function insertVisitReport(){
        if($this->session->id_user == "") redirect("login/welcome");

        $config['upload_path']          = './assets/report/visit/';
        $config['allowed_types']        = 'gif|jpg|png';
        $this->load->library('upload', $config);
        
        if($this->upload->do_upload("conversation_image")){
            $data = array('upload_data' => $this->upload->data());
            $fileName = $data["upload_data"]["file_name"];
        }
        else{
            $fileName = "-";
        }
        $data = array(
            "id_perusahaan" => $this->input->post("id_perusahaan") ,
            "action_date" => $this->input->post("action_date") ,
            "action_location" => $this->input->post("action_location") ,
            "action_duration" => $this->input->post("action_duration") ,
            "action_purpose" => $this->input->post("action_purpose") ,
            "action_pic" => $this->input->post("action_pic") ,
            "pic_position" => $this->input->post("pic_position") ,
            "action_conversation" => $this->input->post("action_conversation") ,
            "conversation_image" => $fileName,
            "potential_machine" => $this->input->post("potential_machine") ,
            "action_conclusion" => $this->input->post("action_conclusion") ,
            "action_percentage_order" => $this->input->post("action_percentage_order") ,
            "support_need" => $this->input->post("support_need") ,
            "followup_date" => $this->input->post("followup_date") ,
            "id_user_add" => $this->session->id_user,
            "jenis_report" => 1
        );
        $id_submit_report = insertRow("visit_call_report",$data);

        $checks = $this->input->post("checks");
        foreach($checks as $checked){
            $data = array(
                "remarks" => $this->input->post("remarks".$checked),
                "pic" => $this->input->post("pic".$checked),
                "id_submit_report" => $id_submit_report
            );
            insertRow("visit_call_report_next_action",$data);
        }
        redirect("report/main/visit");
    }
    public function updateVisitReport(){

    }
    public function removeVisitReport($id_submit_report){
        $where = array(
            "id_submit_report" => $id_submit_report
        );  
        $data = array(
            "status_aktif_report" => 1
        );
        updateRow("visit_call_report",$data,$where);
        redirect("report/main/visit");
    }
    public function pdfVisitReport($id_submit_report){
        $where = array(
            "id_submit_report" => $id_submit_report
        );
        $result = selectRow("visit_call_report",$where);
        $field = array(
            "id_submit_report", "action_date", "id_perusahaan", "action_location", "action_duration", "action_purpose", "action_pic", "pic_position", "action_conversation", "potential_machine", "action_conclusion", "action_percentage_order", "support_need", "followup_date", "id_user_add", "tgl_report_add", "status_aktif_report", "status_cetak_report", "jenis_report","conversation_image"
        );
        $data["visit"] = foreachResult($result,$field,$field);
        $data["visit"]["nama_perusahaan"] = get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $data["visit"]["id_perusahaan"]));
        $where = array(
            "id_submit_report" => $data["visit"]["id_submit_report"],
            "status_next_action" => 0
        );  
        $result = selectRow("visit_call_report_next_action",$where);
        $field = array(
            "id_submit_next_action","remarks","pic","status_next_action"
        );  
        $data["visit"]["next_action"] = foreachMultipleResult($result,$field,$field);
        $data["visit"]["sales_name"] = get1Value("user","nama_user",array("id_user" => $data["visit"]["id_user_add"]));

        $date = date_create($data["visit"]["action_date"]);
        $data["visit"]["action_date"] = date_format($date,"D d-m-Y");
        $date = date_create($data["visit"]["followup_date"]);
        $data["visit"]["followup_date"] = date_format($date,"D d-m-Y");
        $split = explode(":",$data["visit"]["action_duration"]);
        $data["visit"]["action_duration"] = $split[0]." Jam ".$split[1]." Menit";
        $this->load->view("report/main/pdf-visit-report",$data);
    }
}