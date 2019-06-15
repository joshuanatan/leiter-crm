<?php
class Od extends CI_Controller{
    public function __construct(){
        parent::__construct();  
        $this->load->model("Mdorder_confirmation");
        $this->load->model("Mdperusahaan");
        $this->load->model("Mdod_core");
        $this->load->model("Mdod_item");

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
        $where = array(
            "od" => array(
                "status_od" => 0
            )
        );
        $result = array(
            "od" => $this->Mdod_core->select($where["od"]),
        );
        $counter = 0;
        $data["od"] = array();
        foreach($result["od"]->result() as $a){
            $data["od"][$counter] = array(
                "id_od" => $a->id_od,
                "no_od" => $a->no_od,
                "no_oc" => get1value("order_confirmation","no_oc", array("id_oc" => $a->id_oc)),
                "no_po_cusomter" => get1Value("order_confirmation","no_po_customer",array("id_oc" => $a->id_oc)),
                "nama_courier" => get1value("perusahaan","nama_perusahaan", array("id_perusahaan" => $a->id_courier)),
                "nama_perusahaan" =>  get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => get1Value("quotation","id_perusahaan",array("id_quo" => get1Value("order_confirmation","id_quotation",array("id_oc" => $a->id_oc)))))),
                "franco" => get1value("quotation","franco",array("id_quo" => get1Value("order_confirmation","id_quotation",array("id_oc" => $a->id_oc)))),
                "date_issued" => $a->date_od_add,
                
            );
            $data["od"][$counter]["items"] = array();
            $result["od_item"] = $this->Mdod_item->select(array("id_od" => $a->id_od));
            $counter2 = 0;
            foreach($result["od_item"]->result() as $items){
                $data["od"][$counter]["items"][$counter2] = array(
                    "nama_produk" => get1Value("produk","nama_produk", array("id_produk" => get1Value("price_request_item","id_produk",array("id_request_item" => get1Value("quotation_item","id_request_item",array("id_quotation_item" => $items->id_quotation_item)))))),
                    "jumlah" => $items->item_qty
                );
                $counter2++;
            }
            $counter++;
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
    public function create(){
        $where = array(
            "order_confirmation" => array(
                "status_oc" => 2,
            ),
            "courier" => array(
                "status_perusahaan" => 0,
                "peran_perusahaan" => "SHIPPING"
            )
        );
        $result["order_confirmation"] = $this->Mdorder_confirmation->select($where["order_confirmation"]);
        $result["courier"] = $this->Mdperusahaan->select($where["courier"]);
        $data["order_confirmation"] = $result["order_confirmation"]; 
        $data["courier"] = $result["courier"]; 
        $data["maxId"] = findMaxId("od_core","id_od",array());
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/od/category-header");
        $this->load->view("crm/od/add-od",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function remove($id_od){
        $where = array(
            "id_od" => $id_od
        );
        $this->Mdod_core->delete($where);
        $this->Mdod_item->delete($where);
        redirect("crm/od");
    }
    public function createod(){
        $input = array(
            "id_quotation_item" => $this->input->post("id_quotation_item"), 
            "jumlah_kirim" => $this->input->post("jumlah_kirim"), 
        );
        $array = array(
            "id_quotation_item" => array(),
            "jumlah_kirim" => array()
        );
        $counter = 0 ;
        foreach($input["id_quotation_item"] as $a){
            $array["id_quotation_item"][$counter] = $a;
            $counter++;
        }
        $counter = 0 ;
        foreach($input["jumlah_kirim"] as $a){
            $array["jumlah_kirim"][$counter] = $a;
            $counter++;
        }
        for($a = 0; $a<count($array["jumlah_kirim"]); $a++){
            $data = array(
                "id_od" => $this->input->post("id_od"),
                "id_quotation_item" => $array["id_quotation_item"][$a],
                "item_qty" => $array["jumlah_kirim"][$a]
            );
            $this->Mdod_item->insert($data);
        }
        /*end insert od item*/
        /*begin insert od core */
        $data = array(
            "id_od" => $this->input->post("id_od"),
            "no_od" => $this->input->post("no_od"),
            "id_oc" => $this->input->post("id_oc"),
            "id_courier" => $this->input->post("courier"),
            "delivery_method" => $this->input->post("method"),
            "id_user_add" => $this->session->id_user
        );
        $this->Mdod_core->insert($data);
        redirect("crm/od");
    }
    public function print(){
        $this->load->view("crm/print/od");
    }
    public function getOD(){
        $where = array(
            "id_oc" => $this->input->post("id_oc")
        );
        $result = $this->Mdod_core->select($where);
        $data = array();
        $counter = 0 ;
        foreach($result->result() as $a){
            $data[$counter] = array(
                "id_od" => $a->id_od,
                "no_od" => $a->no_od
            );
            $counter++;
        }
        echo json_encode($data);
    }
    public function getOdItemPayment(){
        $where = array(
            "id_od" => $this->input->post("id_od")
        );
        //echo $this->input->post("id_od");
        $result = $this->Mdod_item->select($where);
        $count = 0;
        $data = array();
        $total = 0;
        foreach($result->result() as $a){
            $sellingPrice = get1Value("quotation_item","final_selling_price",array("id_quotation_item" => $a->id_quotation_item));
            $finalAmount = get1Value("quotation_item","final_amount",array("id_quotation_item" => $a->id_quotation_item));
            $id_produk = get1Value("price_request_item","id_produk",array("id_request_item" => get1Value("quotation_item","id_request_item",array("id_quotation_item" => $a->id_quotation_item))));
            
            $dp = get1Value("metode_pembayaran","nominal_pembayaran", array("id_oc" => get1Value("od_core","id_oc",array("id_od" => $this->input->post("id_od"))),"urutan_pembayaran" => 1));
            $amount = ($a->item_qty*($sellingPrice-$dp))/$finalAmount;
            $total += $amount;
            $data[$count] = array(
                "nama_produk" => get1Value("produk","nama_produk",array("id_produk" => $id_produk)),
                "item_qty" => $a->item_qty."/".$finalAmount." ITEMS SENT",
                "selling_price" => number_format($sellingPrice-$dp),
                "paymentAmount" => number_format($amount),
                "clean_nominal" => $total
            );
            $count++;
        }
        echo json_encode($data);
    }
}
?>