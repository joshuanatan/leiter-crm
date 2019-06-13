<?php
class PO extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdprice_request");
        $this->load->model("Mdharga_vendor");
        $this->load->model("Mdmata_uang");
        $this->load->model("Mdprice_request_item");
        $this->load->model("MdPo_setting");
        $this->load->model("MdPo_item");
        $this->load->model("MdPo_core");
        $this->load->model("Mdorder_confirmation");
        $this->load->model("Mdquotation_item");
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
    public function print(){
        header("Content-type:application/vnd.ms-word");
        header("Content-Disposition:attachment;Filename=asdf.doc");
        header("Pragma: no-cache");
        header("Expires:0");
        $this->load->view("crm/print/po");
    }
    public function index(){
        $where = array(
            "purchase_order"=>array(
                "status_po" => 0
            )
        );
        $result = array(
            "purchase_order" => $this->MdPo_core->select($where["purchase_order"])
        );
        $array = array(
            "purchase_order" => array()
        );
        $counter = 0 ;
        foreach($result["purchase_order"]->result() as $a){
            $array["purchase_order"][$counter] = array(
                "no_po" => $a->no_po,
                "supplier" => get1value("perusahaan","nama_perusahaan", array("id_perusahaan" => $a->id_supplier)),
                "shipper" => get1value("perusahaan","nama_perusahaan", array("id_perusahaan" => $a->id_shipper)),
                "items_amount" => $this->MdPo_item->getItemTypeAmount(array("id_po" => $a->id_po)),
                "issued_date" => $a->date_po_core_add
            );
            $counter++;
        }
        $data = array(
            "purchase_order" => $array["purchase_order"]
        );

        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/po/category-header");
        $this->load->view("crm/po/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/datatable/page-datatable-js");
        $this->load->view("plugin/tabs/tabs-js");
        $this->load->view("crm/po/js/request-ajax");
        $this->load->view("crm/crm-close");
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
        $this->load->view("detail/po/profile");
        $this->load->view("detail/tab-open");
        $this->load->view("detail/po/tab-item");
        $this->load->view("detail/po/tab-content");
        $this->load->view("detail/tab-close");
        $this->load->view("detail/content-close");
        /*--------------------------------------------------------*/
        $this->load->view("req/script");
        $this->load->view("detail/js/detail-js");
        $this->load->view("detail/detail-close");
        $this->load->view("req/html-close");
    }
    public function create(){
        $where = array(
            "oc" => array(
            ),
        );
        $result["oc"] = $this->Mdorder_confirmation->select($where["oc"]);
        $counter = 0 ;
        foreach($result["oc"]->result() as $a){
            $array["oc"][$counter] = array(
                "no_oc" => $a->no_oc,
                "id_oc" => $a->id_oc,
                "customer_po" => $a->no_po_customer ,
                "customer_firm" => get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $a->id_perusahaan)),
                "items_amount" => getAmount("quotation_item","id_quotation_item",array("id_oc" => $a->id_oc)),
                "alreadySet" => isExistsInTable("po_setting",array("id_oc" => $a->id_oc))
            );
            if(isExistsInTable("po_setting",array("id_oc" => $a->id_oc)) == 0){
                $array["oc"][$counter]["id_po_setting"] = get1Value("po_setting","id_po_setting",array("id_oc" => $a->id_oc));
            }
            $counter++;
        }
        $data = array(
            "order_confirmation" => $array["oc"]
        );
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/po/category-header");
        $this->load->view("crm/po/add-po",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function finalPo(){
        $where = array(

        );
        $data = array(
            "status_oc" => 2
        );
        $this->Mdorder_confirmation->update($data,$where);
        redirect("crm/po/create");
    }
    public function setting($id_oc){ 
        /*load primary data*/
        /*load items*/
        $where = array(
            "primary_data" => array(
                "id_oc" => $id_oc
            ),
            "items" => array(
                "id_oc" => $id_oc
            )
        );
    /*primary data*/
        $result["primary_data"] = $this->Mdorder_confirmation->select($where["primary_data"]);
        foreach($result["primary_data"]->result() as $a){
            $data["primary_data"] = array(
                "id_oc" => $a->id_oc,
                "no_oc" => $a->no_oc,
                "no_po_customer" => $a->no_po_customer,
                "perusahaan_customer" => get1value("perusahaan","nama_perusahaan",array("id_perusahaan" => $a->id_perusahaan)),
                "nama_customer" => get1value("contact_person","nama_cp",array("id_cp" => $a->id_cp))
            );
        }
    /*end primary data*/

        $result["items"] = $this->Mdquotation_item->select($where["items"]);
        $data["items"] = array();
        $counter = 0;
        foreach($result["items"]->result() as $a){
            $data["items"][$counter] = array(
                "id_request_item" => $a->id_request_item,
                "nama_produk" => $a->nama_produk
            );
            $counter++;
        }
        $data["id_po_setting"] = findMaxId("po_setting","id_po_setting",array());
        $where["mata_uang"] = array();
        $data["mata_uang"] = $this->Mdmata_uang->select($where["mata_uang"]);

        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/po/category-header");
        $this->load->view("crm/po/setting-po",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function addItemToPoItem(){
        $data = array(
            "id_po_setting" => $this->input->post("id_po_setting"),
            "id_request_item" => $this->input->post("id_request_item"),
            "jumlah_item" => $this->input->post("jumlah_item"),
            "harga_item" => splitterMoney($this->input->post("harga_item"),","),
            "kurs" => splitterMoney($this->input->post("kurs"),","),
            "mata_uang" => $this->input->post("mata_uang"),
            "id_supplier" => $this->input->post("id_supplier"),
            "id_shipper" => $this->input->post("id_shipper"),
            "shipping_method" => $this->input->post("shipping_method"),
            "harga_shipping" => splitterMoney($this->input->post("harga_shipping"),",")
        );
        $this->MdPo_item->insert($data);
    }
    public function removeitem(){
        $where = array(
            "id_po_item" => $this->input->post("id_po_item")
        );
        $this->MdPo_item->delete($where);

    }
    public function getpoItem(){
        $where = array(
            "id_po_setting" => $this->input->post("id_po_setting")
        );
        $result = $this->MdPo_item->select($where);
        $data = array();
        $counter = 0;
        foreach($result->result() as $a){
            $data[$counter] = array(
                "id_po_item" => $a->id_po_item,
                "id_request_iten" => $a->id_request_item,
                "nama_produk" => get1Value("produk","nama_produk", array("id_produk" => get1Value("price_request_item","id_produk", array("id_request_item" => $a->id_request_item)))),
                "jumlah" => $a->jumlah_item,
                "harga_beli" => $a->harga_item,
                "mata_uang" => $a->mata_uang,
                "shipper" => get1Value("perusahaan","nama_perusahaan",array("id_perusahaan" => $a->id_shipper))
            );
            $counter++;
        }
        echo json_encode($data);
    }
    public function settingstock($id_request){
        $where = array(
            "primary_data" => array(
                "price_request.id_request" => $id_request
            ),
            "items" => array(
                "price_request.id_request" => $id_request
            ),
            "mata_uang" => array(),
        );
        $item_result = $this->Mdprice_request_item->select($where["items"]);
        $count = 0;
        $item = array();
        foreach($item_result->result() as $a){
            /*check apakah sudah di PO apa belum*/
            $where += ["already_po" => ["Po_item.id_request_item" => $a->id_request_item]];
            $alreadyPo = isExistsInTable("Po_item", $where["already_po"]);
            /*end check*/
            /*load supplier*/
            $where += ["harga_vendor" => ["harga_vendor.id_request_item" => $a->id_request_item]];
            $result = $this->Mdharga_vendor->selectVendorItem($where["harga_vendor"]);
            $vendors = array();
            $counter =  0;
            foreach($result->result() as $b){
                $vendors[$counter] = array(
                    "id_vendor" => $b->id_perusahaan,
                    "nama_vendor" => $b->nama_perusahaan,
                );
                $counter++;
            }
            /*end load supplier*/
            
            /*kita butuh ambil id request item, somehow dapetin vendornya*/
            $item[$count] = array(
                "id_produk" => $a->id_request_item,
                "nama_produk" => $a->nama_produk,
                "satuan_produk" => $a->satuan_produk,
                "suppliers" => $vendors,
                "status_po" => $alreadyPo
            ); /*item ke sekian*/
            $count++; /*urutan item*/
        }
        $data = array(
            "maxId" => $this->MdPo_setting->maxId(),
            "primary_data" => $this->Mdprice_request->select($where["primary_data"]),
            "items" => $item,
            "mata_uang" => $this->Mdmata_uang->select($where["mata_uang"])
        );
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/po/category-header");
        $this->load->view("crm/po/setting-stock",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function stock(){
        $where = array(
            "price_request" => array(
                "untuk_stock" => 0,
                "status_buatquo" => 1
            ),
            "price_request_item" => array(),
            "check_item" => array(),
            "already_setting" => array(),
            "id_po_setting" => array()
        );
        $result = array(
            "price_request" => $this->Mdprice_request->select($where["price_request"]),
            "id_po_setting" => array()
        );
        $array = array(
            "price_request" => array(),
            "price_request_item" => array()
        );
        /*check apakah barang sudah disetting semua*/
        
        /*end checking*/
        $counter = 0 ;
        foreach($result["price_request"]->result() as $a){
            /*kalau barang uda d cek semua, actionnay dimattin aja*/
            $where["price_request_item"] = array("price_request_item.id_request" => $a->id_request);
            $result["price_request_item"] = $this->Mdprice_request_item->select($where["price_request_item"]);
            $tempArray = [0,0];
            foreach($result["price_request_item"]->result() as $request_item){
                $where["check_item"] = array("id_request_item" => $request_item->id_request_item);
                $resulte = isExistsInTable("Po_item",$where["check_item"]);
                $tempArray[$resulte]++;
            }
            $where["already_setting"] = array("id_request" => $a->id_request);
            $array["price_request"][$counter] = array(
                "id_request" => $a->id_request,
                "tgl_dateline_request" => $a->tgl_dateline_request,
                "nama_user" => $a->nama_user,
                "date_request_add" => $a->date_request_add,
                "items_ordered" => $tempArray,
                "already_setting" => isExistsinTable("Po_setting",$where["already_setting"])
            );
            if(isExistsinTable("Po_setting",$where["already_setting"]) == 0){
                $where["id_po_setting"] = array("po_setting.id_request" => $a->id_request);
                $result["id_po_setting"] = $this->MdPo_setting->select($where["id_po_setting"]);
                foreach($result["id_po_setting"]->result() as $b){
                    $array["price_request"][$counter] += ["id_po_setting" => $b->id_po_setting];
                }
            }
            $counter++;
        }
        $data = array(
            "price_request" => $array["price_request"]
        );
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/po/category-header");
        $this->load->view("crm/po/add-po-stock",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function submitSettingPoStock(){
        $data=  array(
            "id_po_setting" => $this->input->post("id_po_setting"),
            "id_request" => $this->input->post("id_request"),
            "id_user_add" => $this->session->id_user,
        );
        $this->MdPo_setting->insert($data);
        redirect("crm/po/stock");
    }
    public function submitSettingStock(){
        $data=  array(
            "id_po_setting" => $this->input->post("id_po_setting"),
            "id_oc" => $this->input->post("id_oc"),
            "id_user_add" => $this->session->id_user,
        );
        $this->MdPo_setting->insert($data);
        redirect("crm/po/create");
    }
    public function insertItemPO(){
        $data = array(
            "id_po_setting"=> $this->input->post("id_po_setting"), 
            "id_request_item"=> $this->input->post("id_request_item"), 
            "harga_item"=> $this->input->post("harga_item"), 
            "kurs"=> $this->input->post("kurs"), 
            "mata_uang"=> $this->input->post("mata_uang"), 
            "id_supplier"=> $this->input->post("id_supplier"), 
            "id_shipper"=> $this->input->post("id_shipper"),
            "shipping_method"=> $this->input->post("shipping_method"),
            "harga_shipping"=> $this->input->post("harga_shipping"), 
            "mata_uang_shipping"=> $this->input->post("mata_uang_shipping"),
        );
        echo $this->input->post("mata_uang");
        $this->MdPo_item->insert($data);
    }
    public function generate($id_po_setting){
        $where = array(
            "po_item" => array(
                "id_po_setting" => $id_po_setting
            ),
            "po_detail" => array()
        );
        $result["supplier_vendor_po"] = $this->MdPo_item->selectSupplierShipper($where["po_item"]);

        $array = array(
            "supplier_vender" => array()
        );
        $counter = 0;
        foreach($result["supplier_vendor_po"]->result() as $a){
            $array["supplier_vendor"][$counter] = array( /*dapet list supplier vendor*/
                "id_supplier" => $a->id_supplier,
                "id_shipper" => $a->id_shipper,
                "shipping_method" => $a->shipping_method
            );
            $counter++;
        }
        for($a = 0; $a<count($array["supplier_vendor"]); $a++){
            $where["po_detail"] = array(
                "id_supplier" => $array["supplier_vendor"][$a]["id_supplier"],
                "id_shipper" => $array["supplier_vendor"][$a]["id_shipper"],
                "shipping_method" => $array["supplier_vendor"][$a]["shipping_method"],
                "id_po_setting" => $id_po_setting
            );
            $where["max_id"] = array();
            $maxId = findMaxId("po_core","id_po",$where["max_id"]);
            $data_po = array(
                "id_po" => $maxId,
                "no_po" => "PO-".sprintf("%05d",$maxId),
                "id_supplier" => $array["supplier_vendor"][$a]["id_supplier"],
                "id_shipper" => $array["supplier_vendor"][$a]["id_shipper"],
                "shipping_method" => $array["supplier_vendor"][$a]["shipping_method"],
                "total_supplier_payment" => $this->MdPo_item->sumSupplier($where["po_detail"]), /*hasil sum dari semua hasil*/
                "total_shipper_payment" => $this->MdPo_item->sumShipper($where["po_detail"]), /*hasil sum dari semua hasil*/
                "kurs_supplier" => $this->MdPo_item->get1Value("mata_uang",$where["po_detail"]), /*hasil dari select*/
                "kurs_shipping" => $this->MdPo_item->get1Value("mata_uang_shipping",$where["po_detail"]), /*hasil dari select*/
                "id_user_add" => $this->session->id_user,
            );
            $this->MdPo_core->insert($data_po);
            /*harus assign ini setiap produk konek kemana*/
            $result["item_po"] = $this->MdPo_item->select($where["po_detail"]);
            foreach($result["item_po"]->result() as $items){
                $where = array(
                    "id_po_item" => $items->id_po_item,
                );
                $data = array(
                    "id_po" => $maxId
                );
                $this->MdPo_item->update($data,$where);
            }
        }
        redirect("crm/po");
    }
}
?>