<?php
class Kpi extends CI_Controller{
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
        //$this->load->view("plugin/chart-widget/chart-widget-js");
        $this->load->view("plugin/chart-js/chart-js-js");
        $this->load->view("report/report-close");
        $this->load->view("req/html-close"); 
    }
    public function index(){
        $where = array(
            "week" => array(
                "tahun" => date("Y")
            )
        );  
        $field = array(
            "week" => array(
                "id_weeks","tgl_mulai","tgl_selesai"
            ),
            "employee" => array(
                "id_user","nama_user"
            )
        );
        $print = array(
            "week" => array(
                "id_weeks","tgl_mulai","tgl_selesai"
            ),
            "employee" => array(
                "id_user","nama_user"
            )
        );
        $result["week"] = selectRow("report_weeks",$where["week"]);
        $result["employee"] = selectRow("user",array("status_user" => 0));
        $data = array(
            "maxId" => getMaxId("report_weeks","id_weeks",array("tahun" => date("Y"))),
            "week" => foreachMultipleResult($result["week"],$field["week"],$print["week"]),
            "employee" => foreachMultipleResult($result["employee"],$field["employee"],$print["employee"])
        );
        
        $this->req();
        $this->load->view("report/content-open");
        $this->load->view("report/kpi/category-header");
        $this->load->view("report/kpi/category-body",$data);
        $this->load->view("report/content-close");
        $this->close();
    }
    public function user(){
        $where = array(
            "user" => array(
                "status_user" => 0
            )
        );
        $field = array(
            "user" => array(
                "nama_user","email_user","nohp_user","id_user"
            )
        );
        $print = array(
            "user" => array(
                "nama_user","email_user","nohp_user","id_user"
            )
        );
        $result["user"] = selectRow("user",$where["user"]);
        $data["user"] = foreachMultipleResult($result["user"],$field["user"],$print["user"]);

        for($a = 0; $a<count($data["user"]);$a++){
            $where["kpi"] = array(
                "id_user" => $data["user"][$a]["id_user"]
            );
            $result["kpi"] = selectRow("kpi_user",$where["kpi"]);
            $field["kpi"] = array(
                "kpi","target_kpi","status_aktif_kpi"
            );
            $print["kpi"] = array(
                "kpi","target_kpi","status_aktif_kpi"
            );
            $data["user"][$a]["kpi"] = foreachMultipleResult($result["kpi"], $field["kpi"],$print["kpi"]);
        }
        $this->req();
        $this->load->view("report/content-open");
        $this->load->view("report/user/category-header");
        $this->load->view("report/user/category-body",$data);
        $this->load->view("report/content-close");
        $this->close();
    }
    public function weekly($id_weeks){ /*ini udah ngecek peruser*/
        
        $where = array(
            "week" => array(
                "id_weeks" => $id_weeks
            ),
            "report" => array(
                "id_user_add" => $this->input->post("user")
            ),
            "kpi_user" => array(
                "id_user" => $this->input->post("user"),
                "status_aktif_kpi" => 0
            )
        );
        $field = array(
            "week" => array(
                "tgl_mulai","tgl_selesai"
            ),
            "report" => array(
                "id_report","tipe_report","pic_target","location","progress_percentage","report","tgl_report","judul_report","attachment","support_need","next_plan"
            ),
            "kpi_user" => array(
                "kpi","target_kpi"
            )
        );
        $print = array(
            "week" => array(
                "tgl_mulai","tgl_selesai"
            ),
            "report" => array(
                "id_report","tipe_report","pic_target","location","progress_percentage","report","tgl_report","judul_report","attachment","support_need","next_plan"
            ),
            "kpi_user" => array(
                "kpi","target_kpi"
            )
        );
        $where["week"] = array(

        );
        $result["week"] = selectRow("report_weeks",$where["week"]);
        $data["week"] = foreachResult($result["week"],$field["week"],$print["week"]); 
        $constraint = array(
            "awal" => $data["week"]["tgl_mulai"],
            "akhir" => $data["week"]["tgl_selesai"]
        );
        /*ambil start dan end date dari week*/
        $result["report"] = selectRowBetweenDates("report","tgl_report",$constraint,$where["report"]);
        $data["report"] = foreachMultipleResult($result["report"],$field["report"],$print["report"]);
        
        $data["kpi_detail"] = array(
            "week" => "WEEK ".$id_weeks,
            "nama_user" => get1Value("user","nama_user",array("id_user" => $this->input->post("user")))
        );
        $result["kpi_user"] = selectRow("kpi_user",$where["kpi_user"]);
        $data["kpi_user"] = foreachMultipleResult($result["kpi_user"],$field["kpi_user"],$print["kpi_user"]);
        $this->req();
        $this->load->view("report/content-open");
        $this->load->view("report/kpi/category-header");
        $this->load->view("report/kpi/weekly-report",$data);
        $this->load->view("report/content-close");
        $this->close();
        
        /*fungsi untuk mencari jumlah report di masing2 week, user, kpi*/
        $mingguMax = $id_weeks; /*jadi kalau misalnya maxnya di week 10, maka hitung turun terus sampe 6 karena cuman mau nampilin 5 kebelakang*/
        $data["kpi_graph"] = array();
        for($minggu = 0; $minggu<5; $minggu++){
            $data["kpi_graph"][$minggu] = array(
                "nama_week" => "Week ".$mingguMax
            );
            $result["kpi_user"] = selectRow("kpi_user",$where["kpi_user"]);
            for($kpi = 0; $kpi< count($data["kpi_user"]) ; $kpi++){ /*ngeloop sesuai jumlah kpi user*/

                /*mencari tgl awal dan tgl akhir minggu yang dituju*/
                $where["week"] = array(
                    "id_weeks" => $mingguMax
                );
                $result["week"] = selectRow("report_weeks",$where["week"]);
                $data["week"] = foreachResult($result["week"],$field["week"],$print["week"]); 
                $constraint = array(
                    "awal" => $data["week"]["tgl_mulai"],
                    "akhir" => $data["week"]["tgl_selesai"]
                );
                $where["report"] = array(
                    "tipe_report" => $data["kpi_user"][$kpi]["kpi"], /*mendapatkan nama kpi dalam iterasi tersebut*/
                    "id_user_add" => $this->input->post("user")
                );
                /*end mencari tgl awal dan tgl akhir minggu yang dituju*/

                /*mencari report dalam tanggal tersebut*/
                $result["report"] = selectRowBetweenDates("report","tgl_report",$constraint,$where["report"]);
                $data["report"] = foreachMultipleResult($result["report"],$field["report"],$print["report"]);
                /* end jumlah report mingguan */

                $data["kpi_graph"][$minggu]["kpi"][$kpi] = array(
                    "nama_kpi" => $data["kpi_user"][$kpi]["kpi"],
                    "jumlah_report" => count($data["report"]),
                );
            }
            $mingguMax--; /*pengurangan max minggu supaya ga sampe mines*/
            if($mingguMax == 0) break;
        }
        /*sekarang harus mencari target setiap kpi setiap orang */
        for($kpi = 0; $kpi<count($data["kpi_user"]); $kpi++){ /*pake iterasi KPI*/
            $data["kpi_graph_support"]["target_kpi"][$kpi]["target"] = $data["kpi_user"][$kpi]["target_kpi"];
            $data["kpi_graph_support"]["target_kpi"][$kpi]["nama"] = $data["kpi_user"][$kpi]["kpi"];
        }

        /*ngeload kpi labelnya pake nama kpi*/

        $this->load->view("report/kpi/js/chart-js",$data);
    }
    public function insertKpi(){
        /*hapus yang sudah ada dulu*/
        /*delete semua kpi yang orang ini*/
        $where = array(
            "id_user" => $this->input->post("id_user"),
        );
        deleteRow("kpi_user",$where);


        $checks = $this->input->post("check");
        for($a = 0; $a<10; $a++){
            /*kasih 1 ke semua elemen array*/
            $status[$a] = 1;
        }
        foreach($checks as $a){
            /*dari depan juga pake start 0, yang indexnya ada disini, dijadiin aktif*/
            $status[$a] = 0;
            
        }
        /*insert aja semua yang tertulis*/
        for($a = 0; $a<10; $a++){
            $data = array(
                "id_user" => $this->input->post("id_user"),
                "kpi" => $this->input->post("kpi".$a),
                "target_kpi" => $this->input->post("target".$a),
                "status_aktif_kpi" => $status[$a]
            );
            insertRow("kpi_user",$data);
        }
        redirect("report/kpi/user");
        /*aktif non aktif, ikut centang*/
    }
    public function insertWeek(){
        $data = array(
            "id_weeks" => $this->input->post("week_id"),
            "tahun" => date("Y"),
            "tgl_mulai" => $this->input->post("start_date"),
            "tgl_selesai" => $this->input->post("end_date"), 
        );
        insertRow("report_weeks",$data);
        redirect("report/kpi");
    }
}