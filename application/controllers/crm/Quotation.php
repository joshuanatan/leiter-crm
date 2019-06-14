<?php
class Quotation extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdquotation");
        $this->load->model("Mdprice_request");
        $this->load->model("Mdquotation_item");
        $this->load->model("Mdmetode_pembayaran");
        $this->load->model("Mdprice_request_item");
    }
    /*default function*/
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
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/jqtabledit/jqtabledit-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("crm/quotation/js/dynamic-form-js");
        $this->load->view("crm/quotation/js/request-ajax");
        $this->load->view("crm/quotation/js/payment-script");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    /*page*/
    public function index(){
        $this->req();
        $where = array(
            "quotation" => array(
                //"status_quo" => 0  
            ),
            "price_request" => array(
                "price_request.status_request" => 3 /*ngambil yang sudah kasih harga vendor */
            )
        );
        $result["quotation"] = $this->Mdquotation->select($where["quotation"]);
        $counter = 0 ;
        
        $data = array(
            "quotation_id" => $this->Mdquotation->maxId(),
            "request" => $this->Mdprice_request->select($where["price_request"])
        );
        foreach($result["quotation"]->result() as $a){
            $data["quotation"][$counter] = array(
                "id_quotation" => $a->id_quo,
                "version" => $a->versi_quo,
                "nama_perusahaan" => get1Value("perusahaan","nama_perusahaan", array("id_perusahaan" => $a->id_perusahaan)),
                "nama_cp" => get1Value("contact_person","nama_cp", array("id_cp" => $a->id_cp)),
                "status_quotation" => $a->status_quo,
                "sending_date" => $a->date_quo_add,
            );
            $counter++;
        }
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    
    public function revision($i,$ver){ /*bagian ini terjadi sebelum pengiriman ke customer*/
        $this->req();
        $where = array(
            "quotation" => array(
                "quotation.id_quo" => $i,
                "quotation.versi_quo" => $ver
            ),
            "price_request" => array(
                "price_request.status_request" => 0
            ),
            "last_version" => array(
                "quotation.id_quo" => $i
            ),
        );
        $result["quotation"] = $this->Mdquotation->select($where["quotation"]);
        $data = array(
            "quotation",
            "items",
            "pembayaran",
            "quotation_item"
        );
        //echo print_r($result["quotation"]->result());
        foreach($result["quotation"]->result() as $a){
            $data["quotation"] = array(
                "id_request" => $a->id_request,
                "no_quo" => $a->no_quo,
                "id_quo" => $a->id_quo,
                "quo_versi" => $a->versi_quo,
                "nama_perusahaan" => get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $a->id_perusahaan)),
                "nama_cp" =>get1Value("contact_person","nama_cp",array("id_cp" => $a->id_cp)),
                "hal_quo" => $a->hal_quo,
                "id_cp" => $a->id_cp,
                "id_perusahaan" => $a->id_perusahaan,
                "up_cp" => $a->up_cp,
                "alamat_perusahaan" => $a->alamat_perusahaan,
                "durasi_pembayaran" => $a->durasi_pembayaran,
                "durasi_pengiriman" => $a->durasi_pengiriman,
                "dateline_quo" => $a->dateline_quo,
                "franco" => $a->franco
            );
            $where["quotation_item"] = array(
                "id_quotation" => $a->id_quo,
                "quo_version" => $a->versi_quo
            );
            $result["quotation_item"] = $this->Mdquotation_item->select($where["quotation_item"]);
            $data["quotation_item"] = array();
            $counter = 0;
            foreach($result["quotation_item"]->result() as $d){
                $data["quotation_item"][$counter] = array(
                    "id_request_item" => $d->id_request_item,
                    "nama_produk" => get1Value("produk","nama_produk", array("id_produk" => get1Value("price_request_item","id_produk",array("id_request_item" => $d->id_request_item)))),
                    "jumlah" =>  $d->id_request_item,
                    "selling_price" => $d->selling_price,
                    "margin" => $d->margin_price, 
                    "id_quotation_item" => $d->id_quotation_item
                );
                $counter++;
            }
            /*mengambil semua barang yang sudah dipesan sesuai id requestnya */
            $where["price_request_item"] = array(
                "id_request" => $a->id_request,
                "status_request_item" => 0
            );
            $result["items"] = $this->Mdprice_request_item->select($where["price_request_item"]);
            $counter = 0;
            foreach($result["items"]->result() as $b){
                $data["items"][$counter] = array(
                    "id_request_item" => $b->id_request_item,
                    "nama_produk" => get1Value("produk","nama_produk", array("id_produk" => $b->id_produk))
                );
                $counter++;
            }
            /*mengambil metode pembayaran yang sudah di assign*/
            $where["metode_pembayaran"] = array(
                "id_quotation" => $a->id_quo,
                "id_versi" => $a->versi_quo
            );
            $data["metode_pembayaran"] = array();
            $result["metode_pembayaran"] = $this->Mdmetode_pembayaran->select($where["metode_pembayaran"]);
            $counter = 0;
            foreach($result["metode_pembayaran"]->result() as $c){
                $data["metode_pembayaran"][$counter] = array(
                    "persentase_pembayaran" => $c->persentase_pembayaran,
                    "nominal_pembayaran" => $c->nominal_pembayaran,
                    "trigger_pembayaran" => $c->trigger_pembayaran,
                    "mata_uang" => $c->kurs
                );
                $counter++;
            }
        }
        $data["last_version"] = findMaxId("quotation","versi_quo",array("id_quo" => $i));
        $data["id_revision"] = $data["last_version"]-1;
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/revisi-quotation",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function edit($i,$ver){ /*bagian ini terjadi sebelum pengiriman ke customer*/
        $this->req();
        $where = array(
            "quotation" => array(
                "quotation.id_quo" => $i,
                "quotation.versi_quo" => $ver
            ),
            "price_request" => array(
                "price_request.status_request" => 0
            ),
            "last_version" => array(
                "quotation.id_quo" => $i
            ),
        );
        $result["quotation"] = $this->Mdquotation->select($where["quotation"]);
        $data = array(
            "quotation",
            "items",
            "pembayaran",
            "quotation_item"
        );
        //echo print_r($result["quotation"]->result());
        foreach($result["quotation"]->result() as $a){
            $data["quotation"] = array(
                "id_request" => $a->id_request,
                "no_quo" => $a->no_quo,
                "id_quo" => $a->id_quo,
                "quo_versi" => $a->versi_quo,
                "nama_perusahaan" => get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $a->id_perusahaan)),
                "nama_cp" =>get1Value("contact_person","nama_cp",array("id_cp" => $a->id_cp)),
                "hal_quo" => $a->hal_quo,
                "up_cp" => $a->up_cp,
                "alamat_perusahaan" => $a->alamat_perusahaan,
                "durasi_pembayaran" => $a->durasi_pembayaran,
                "durasi_pengiriman" => $a->durasi_pengiriman,
                "dateline_quo" => $a->dateline_quo,
                "franco" => $a->franco
            );
            $where["quotation_item"] = array(
                "id_quotation" => $a->id_quo,
                "quo_version" => $a->versi_quo
            );
            $result["quotation_item"] = $this->Mdquotation_item->select($where["quotation_item"]);
            $data["quotation_item"] = array();
            $counter = 0;
            foreach($result["quotation_item"]->result() as $d){
                $data["quotation_item"][$counter] = array(
                    "id_request_item" => $d->id_request_item,
                    "nama_produk" => get1Value("produk","nama_produk", array("id_produk" => get1Value("price_request_item","id_produk",array("id_request_item" => $d->id_request_item)))),
                    "jumlah" =>  $d->id_request_item,
                    "selling_price" => $d->selling_price,
                    "margin" => $d->margin_price, 
                    "id_quotation_item" => $d->id_quotation_item
                );
                $counter++;
            }
            /*mengambil semua barang yang sudah dipesan sesuai id requestnya */
            $where["price_request_item"] = array(
                "id_request" => $a->id_request,
                "status_request_item" => 0
            );
            $result["items"] = $this->Mdprice_request_item->select($where["price_request_item"]);
            $counter = 0;
            foreach($result["items"]->result() as $b){
                $data["items"][$counter] = array(
                    "id_request_item" => $b->id_request_item,
                    "nama_produk" => get1Value("produk","nama_produk", array("id_produk" => $b->id_produk))
                );
                $counter++;
            }
            /*mengambil metode pembayaran yang sudah di assign*/
            $where["metode_pembayaran"] = array(
                "id_quotation" => $a->id_quo,
                "id_versi" => $a->versi_quo
            );
            $data["metode_pembayaran"] = array();
            $result["metode_pembayaran"] = $this->Mdmetode_pembayaran->select($where["metode_pembayaran"]);
            $counter = 0;
            foreach($result["metode_pembayaran"]->result() as $c){
                $data["metode_pembayaran"][$counter] = array(
                    "persentase_pembayaran" => $c->persentase_pembayaran,
                    "nominal_pembayaran" => $c->nominal_pembayaran,
                    "trigger_pembayaran" => $c->trigger_pembayaran,
                    "mata_uang" => $c->kurs
                );
                $counter++;
            }
        }
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/edit-quotation",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function editUi(){
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/edit-quotation");
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function create(){
        $this->req();
        $where = array(
            "quotation" => array(
                "status_quo" => 0  
            ),
            "price_request" => array(
                "price_request.status_request" => 3,
                "status_buatquo" => 1,
                "untuk_stock" => 1
            ),
        );
        $data = array(
            "quotation_id" => $this->Mdquotation->maxId(),
            "quotation" => $this->Mdquotation->select($where["quotation"]),
            "request" => $this->Mdprice_request->select($where["price_request"]),
        );
        $this->load->view("crm/content-open");
        $this->load->view("crm/quotation/category-header");
        $this->load->view("crm/quotation/add-quotation",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    
    /*function*/
    public function insertquotation(){
        $name = array("id_quo","versi_quo","id_request","no_quo","hal_quo","id_perusahaan","id_cp","up_cp","durasi_pengiriman","franco","durasi_pembayaran","mata_uang_pembayaran","dateline_quo","alamat_perusahaan");
        $data = array();
        for($a=0; $a<count($name); $a++){
            $data += [$name[$a] => $this->input->post($name[$a])];
        }
        $data += ["id_user_add" => $this->session->id_user];
        $this->Mdquotation->insert($data);
        
        /*---- Metode Pembayaran ----*/

        $method = $this->input->post("paymentMethod");
        //$methodDetail = explode("",$method);

        $persen = $this->input->post("persen");
        $persenDetail = array();
        $b=0;
        foreach($persen as $a){
            $persenDetail[$b] = $a;
            $b++;
        }

        $jumlah = $this->input->post("jumlah");
        $jumlahDetail = array();
        $b = 0;
        foreach($jumlah as $a){
            $jumlahDetail[$b] = $a;
            $b++;
        }
        echo count($jumlahDetail);
        print_r($jumlahDetail);
        $kurs = $this->input->post("mata_uang_pembayaran");

        for($a = 0; $a<count($jumlahDetail);$a++){
            $data = array(
                "urutan_pembayaran" => $a+1,
                "persentase_pembayaran" => $persenDetail[$a],
                "nominal_pembayaran" => splitterMoney($jumlahDetail[$a],","),
                "trigger_pembayaran" => $method[$a],
                "id_quotation" => $this->input->post("id_quo"),
                "id_versi" => $this->input->post("versi_quo"),
                "kurs" => $kurs
            );
            $this->Mdmetode_pembayaran->insert($data);
        }
        /*update status buat quotation di price request supaya gabisa dibuat ulang yang udah pernah dibuat*/
        $where = array(
            "id_request" => $this->input->post("id_request")
        );
        $data = array(
            "status_buatquo" => 0
        );
        $this->Mdprice_request->update($data,$where);
        redirect("crm/quotation");
    }
    public function insertrevision(){
        $name = array("id_quo","versi_quo","id_request","no_quo","hal_quo","id_perusahaan","id_cp","up_cp","durasi_pengiriman","franco","durasi_pembayaran","mata_uang_pembayaran","dateline_quo","alamat_perusahaan");
        $data = array();
        for($a=0; $a<count($name); $a++){
            $data += [$name[$a] => $this->input->post($name[$a])];
        }
        $data += ["id_user_add" => $this->session->id_user];
        $this->Mdquotation->insert($data);
        
        /*---- Metode Pembayaran ----*/

        $method = $this->input->post("paymentMethod");
        //$methodDetail = explode("",$method);

        $persen = $this->input->post("persen");
        $persenDetail = array();
        $b=0;
        foreach($persen as $a){
            $persenDetail[$b] = $a;
            $b++;
        }

        $jumlah = $this->input->post("jumlah");
        $jumlahDetail = array();
        $b = 0;
        foreach($jumlah as $a){
            $jumlahDetail[$b] = $a;
            $b++;
        }
        echo count($jumlahDetail);
        print_r($jumlahDetail);
        $kurs = $this->input->post("mata_uang_pembayaran");

        for($a = 0; $a<count($jumlahDetail);$a++){
            $data = array(
                "urutan_pembayaran" => $a+1,
                "persentase_pembayaran" => $persenDetail[$a],
                "nominal_pembayaran" => splitterMoney($jumlahDetail[$a],","),
                "trigger_pembayaran" => $method[$a],
                "id_quotation" => $this->input->post("id_quo"),
                "id_versi" => $this->input->post("versi_quo"),
                "kurs" => $kurs
            );
            $this->Mdmetode_pembayaran->insert($data);
        }
        /*update status buat quotation di price request supaya gabisa dibuat ulang yang udah pernah dibuat*/
        redirect("crm/quotation");
    }
    public function loss($id,$ver){
        $data = array(
            "status_quo" => 1
        );
        $where = array(
            "versi_quo" => $ver,
            "id_quo" => $id
        );
        $this->Mdquotation->update($data,$where);
        redirect("crm/quotation");
    }
    public function accepted($id,$ver){
        $data = array(
            "status_quo" => 2
        );
        $where = array(
            "versi_quo" => $ver,
            "id_quo" => $id
        );
        $this->Mdquotation->update($data,$where);
        redirect("crm/quotation");
        
    }
    public function editquotation(){
        $where = array(
            "id_quo" => $this->input->post("id_quo")
        );
        $name = array("hal_quo","up_cp","durasi_pengiriman","franco","durasi_pembayaran","mata_uang_pembayaran","dateline_quo","alamat_perusahaan");
        $data = array();
        for($a=0; $a<count($name); $a++){
            $data += [$name[$a] => $this->input->post($name[$a])];
        }
        $data += ["id_user_edit" => $this->session->id_user];
        $this->Mdquotation->update($data,$where);
        $where = array(
            "id_quotation" => $this->input->post("id_quo"),
            "id_versi" => $this->input->post("versi_quo")
        );
        $this->Mdmetode_pembayaran->delete($where);
        $method = $this->input->post("paymentMethod");
        //$methodDetail = explode("",$method);

        $persen = $this->input->post("persen");
        $persenDetail = array();
        $b=0;
        foreach($persen as $a){
            $persenDetail[$b] = $a;
            $b++;
        }

        $jumlah = $this->input->post("jumlah");
        $jumlahDetail = array();
        $b = 0;
        foreach($jumlah as $a){
            $jumlahDetail[$b] = $a;
            $b++;
        }

        $kurs = $this->input->post("mata_uang_pembayaran");

        for($a = 0; $a<count($jumlahDetail);$a++){
            $data = array(
                "urutan_pembayaran" => $a+1,
                "persentase_pembayaran" => $persenDetail[$a],
                "nominal_pembayaran" => splitterMoney($jumlahDetail[$a],","),
                "trigger_pembayaran" => $method[$a], //ini gara2 valuenya kurang
                "id_quotation" => $this->input->post("id_quo"),
                "id_versi" => $this->input->post("versi_quo"),
                "kurs" => $kurs
            );
            $this->Mdmetode_pembayaran->insert($data);
        }
        redirect("crm/quotation/edit/".$this->input->post("id_quo"));
    }
    /*ajax*/
    public function addItemToQuotation(){
        $name = array("id_quotation","quo_version","id_request_item","item_amount","selling_price","margin_price","id_cp_shipper","id_cp_vendor","id_cp_courier","metode_shipping","metode_courier");
        $data = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
            $name[2] => $this->input->post($name[2]),
            $name[3] => $this->input->post($name[3]),
            $name[4] => $this->input->post($name[4]),
            $name[5] => $this->input->post($name[5]),
            $name[6] => $this->input->post($name[6]),
            $name[7] => $this->input->post($name[7]),
            $name[8] => $this->input->post($name[8]),
            $name[9] => $this->input->post($name[9]),
            $name[10] => $this->input->post($name[10]),
        );
        echo $this->input->post($name[5]);
        $this->Mdquotation_item->insert($data);
    }
    public function getQuotationItem(){
        $name = array("id_quotation","quo_version","id_request_item","item_amount","selling_price","margin_price");
        $where = array(
            $name[0] => $this->input->post($name[0]),
            $name[1] => $this->input->post($name[1]),
        );  
        $result = $this->Mdquotation_item->select($where);
        $html = "";
        foreach($result->result() as $a){
            $html .= "<tr><td>".$a->id_request_item."</td><td>".$a->nama_produk."</td><td>".$a->item_amount."</td><td>".number_format($a->selling_price)."</td><td>".number_format($a->margin_price,2)."%</td><td><button type = 'button' class = 'btn btn-danger btn-outline btn-sm' onclick = 'removeQuotationItem(".$a->id_quotation_item.")' >REMOVE</button></td></tr>";
        }
        echo json_encode($html);
    }
    public function removeQuotationitem(){
        $where = array(
            "id_quotation_item" => $this->input->post("id_quotation_item")
        );
        $this->Mdquotation_item->delete($where);
    }
    public function countTotalQuotationPrice(){
        $where = array(
            "id_quotation" => $this->input->post("id_quotation"),
            "quo_version" => $this->input->post("quo_version"),
        );
        //print_r($where);
        echo json_encode(getTotal("quotation_item","selling_price",$where));
    }
    public function getQuotationDetail(){
        //echo $this->input->post("id_quo"); echo $this->input->post("versi_quo");
        $where = array(
            "id_quo" => $this->input->post("id_quo"),
            "versi_quo" => $this->input->post("versi_quo")
        );
        $result = $this->Mdquotation->select($where);
        $data = array();
        foreach($result->result() as $a){   
            $data = array(
                "no_quo" => strtoupper($a->no_quo),
                "id_quo" => $a->id_quo,
                "versi_quo" => $a->versi_quo,
                "nama_perusahaan" => strtoupper(get1Value("perusahaan","nama_perusahaan",array("id_perusahaan"=>$a->id_perusahaan))),
                "nama_cp" => ucwords(get1Value("contact_person","nama_cp",array("id_cp"=>$a->id_cp))),
                "id_cp" => $a->id_cp,
                "id_perusahaan" => $a->id_perusahaan,
                "alamat_perusahaan" => get1Value("perusahaan","alamat_perusahaan", array("id_perusahaan"=>$a->id_perusahaan)),
                "up_cp" => $a->up_cp,
                "durasi_pengiriman" => $a->durasi_pengiriman,
                "durasi_pembayaran" => $a->durasi_pembayaran,
                "franco" => $a->franco,
            );
        }
        echo json_encode($data);
    }
    public function print(){
        /*header("Content-type:application/vnd.ms-word");
        header("Content-Disposition:attachment;Filename=asdf.doc");
        header("Pragma: no-cache");
        header("Expires:0");*/
        $this->load->view("crm/print/quotation");
    }
    public function getOrderedItem(){
        $where = array(
            "id_quotation" => $this->input->post("id_quo"),
            "quo_version" => $this->input->post("versi_quo")
        );  
        $result = $this->Mdquotation_item->select($where);
        $data = array();
        $b = 0;
        foreach($result->result() as $a){
            $data[$b] = array(
                "id_quotation_item" => $a->id_quotation_item,
                "nama_produk" => $a->nama_produk,
                "item_amount" => $a->item_amount,
                "selling_price" => number_format($a->selling_price),
                "status_oc_item" => $a->status_oc_item
            );
            $b++;
        }
        echo json_encode($data);
    }
    public function getMetodePembayaran(){
        $where = array(
            "id_quotation" => $this->input->post("id_quotation"),
            "id_versi" => $this->input->post("id_versi")
        );
        $result = $this->Mdmetode_pembayaran->select($where);
        $data = array();
        $b = 0;
        foreach($result->result() as $a){
            $text = "";
            switch($a->trigger_pembayaran){
                case 1: $text = "SEBELUM BARANG DIKIRIMKAN";
                break;
                case 2: $text = "SESUDAH BARANG DIKIRIMKAN";
                break;
            }
            $data[$b] = array(
                "urutan_pembayaran" => $a->urutan_pembayaran,
                "persentase_pembayaran" => $a->persentase_pembayaran,
                "nominal_pembayaran" => number_format($a->nominal_pembayaran),
                "trigger_pembayaran" => $text,
                "kurs" => $a->kurs
            );
            $b++;
        }
        echo json_encode($data);

    }
}
?>