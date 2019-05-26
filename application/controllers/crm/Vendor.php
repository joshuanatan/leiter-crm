<?php
class Vendor extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mdprice_request");
        $this->load->model("Mdprice_request_item");
        $this->load->model("Mdproduk_vendor");
        $this->load->model("Mdharga_vendor");
        $this->load->model("Mdcontact_person");
        $this->load->model("Mdmetode_pengiriman_shipping");
        $this->load->model("Mdperusahaan");
        $this->load->model("Mdvariable_shipping_price");
        $this->load->model("Mdvariable_courier_price");
    }
    /*default function*/
    private function req(){
        $this->load->view("req/head");
        $this->load->view("crm/vendor-deal/css/datatable-css");
        $this->load->view("crm/vendor-deal/css/breadcrumb-css");
        $this->load->view("crm/vendor-deal/css/modal-css");
        $this->load->view("crm/vendor-deal/css/form-css");
        $this->load->view("req/head-close");
        $this->load->view("crm/crm-open");
        $this->load->view("req/top-navbar");
        $this->load->view("req/navbar");
    }
    public function close(){
        $this->load->view("req/script");
        $this->load->view("crm/vendor-deal/js/jqtabledit-js");
        $this->load->view("crm/vendor-deal/js/page-datatable-js");
        $this->load->view("crm/vendor-deal/js/form-js");
        $this->load->view("crm/vendor-deal/js/dynamic-form-js");
        $this->load->view("crm/crm-close");
        $this->load->view("req/html-close");
    }
    /*page*/
    public function index(){
        $where = array(
            "request" => array(
                "price_request.status_request" => 2
            )
        );
        $data = array(
            "request" => $this->Mdprice_request->select($where["request"])
        );
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/vendor-deal/category-header");
        $this->load->view("crm/vendor-deal/category-body",$data);
        $this->load->view("crm/content-close");
        $this->close();
    }
    public function produk($i){
        $this->session->id_request = $i;
        $where = array(
            "requestitem" => array(
                "price_request_item.id_request"=>$i,
                "price_request_item.status_request_item" => 0
            ),
            "vendoritem" => array(
                "status_produk_vendor" => 0,
            )
        );
        $data = array(
            "requestitem" => $this->Mdprice_request_item->select($where["requestitem"]),
            "vendoritem" => $this->Mdproduk_vendor->select($where["vendoritem"])
        );
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/vendor-deal/category-header");
        $this->load->view("crm/vendor-deal/product-vendor-price",$data);
        $this->load->view("crm/content-close");
        $this->close();
        $this->load->view("crm/vendor-deal/js/request-ajax");
    }
    public function suppliershipping($i,$id_perusahaan){
        $this->session->id_detail = $i;
        $this->session->id_supplier = $id_perusahaan;
        $where = array(
            "requestitem" => array(
                "price_request_item.id_request_item"=>$i,
                "price_request_item.status_request_item" => 0
            ),
            "shipper" => array(
                "perusahaan.peran_perusahaan" => "SHIPPING",
                "perusahaan.status_perusahaan" => 0
            ),
            "supplier" => array(
                "perusahaan.id_perusahaan" => $id_perusahaan 
            )
            
        );
        $data = array(
            "requestitemid" => $i,
            "requestitem" => $this->Mdprice_request_item->select($where["requestitem"]),
            "shipper" => $this->Mdperusahaan->select($where["shipper"]),
            "supplier" => $this->Mdperusahaan->select($where["supplier"])
        );
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/vendor-deal/category-header");
        $this->load->view("crm/vendor-deal/shipping-vendor-price",$data);
        $this->load->view("crm/content-close");
        $this->close();
        $this->load->view("crm/vendor-deal/js/request-ajax");
    }
    public function courier($i){
        $this->session->id_detail = $i;
        $where = array(
            "requestitem" => array(
                "price_request_item.id_request"=>$i,
                "price_request_item.status_request_item" => 0
            ),
            "shipper" => array(
                "perusahaan.peran_perusahaan" => "SHIPPING",
                "perusahaan.status_perusahaan" => 0
            ),
            
        );
        $data = array(
            "requestitem" => $this->Mdprice_request_item->select($where["requestitem"]),
            "shipper" => $this->Mdperusahaan->select($where["shipper"])
        );
        $this->req();
        $this->load->view("crm/content-open");
        $this->load->view("crm/vendor-deal/category-header");
        $this->load->view("crm/vendor-deal/courier-vendor-price",$data);
        $this->load->view("crm/content-close");
        $this->close();
        $this->load->view("crm/vendor-deal/js/request-ajax");
    }
    /*ajax*/
    public function getvendorprice(){
        
        $html = "";
        $where = array(
            "price_request_item.id_request_item" => $this->input->post("id_request_item")
        );
        $perusahaan = $this->Mdperusahaan->itemsupplier($where); 
        /*untuk ambil semua perusahaan yang punya barang ini */
        $counterId = 0;
        foreach($perusahaan->result() as $b){
            $where = array(
                "price_request_item.id_request_item" => $this->input->post("id_request_item"),
                "harga_vendor.id_cp" => $b->id_cp, /*butuh step ini untuk ngeload setiap cp nya */
            );
            $where2 = array(
                "id_perusahaan" => $b->id_perusahaan
            );
            $resultCp = $this->Mdcontact_person->select($where2);
            $cp = "";
            foreach($resultCp->result() as $optionCp){
                $cp .= "<option value = '".$optionCp->id_cp."'>".ucwords($optionCp->nama_cp)."</option>";
            }
            $result = $this->Mdharga_vendor->selectPenawaran($where); 
            $tracingError = "";
            $tracingError .= "CPnya = ".$b->id_cp." id_request_item = ".$where["price_request_item.id_request_item"]." jumlah row = ".$result->num_rows();
            if($result->num_rows() > 0){/*nah kalau misalnya udah ada di produk vendor dan ada di harga vendor */
                $tracingError .= " Status:Masuk If ";
                foreach($result->result() as $a){
                    $harga=0;
                    $satuan=0;
                    $rate=0;
                    if($a->harga_produk == ""){
                        $harga = 0;
                    }
                    else{
                        $harga = $a->harga_produk;
                    }
                    if($a->satuan_harga_produk == ""){
                        $satuan = 0;
                    }
                    else{
                        $satuan = $a->satuan_harga_produk;
                    }
                    if($a->vendor_price_rate == ""){
                        $rate = 0;
                    }
                    else{
                        $rate = $a->vendor_price_rate;
                    }
                    
                    $html .= "<tr><input type ='hidden' value = '".$this->input->post("id_request_item")."' id = 'id_request_item".$counterId."'><td>".$a->nama_perusahaan."</td><td><select class = 'form-control' id = 'cp".$counterId."'>".$cp."</select></td><td>".$a->bn_produk_vendor."</td><td>".$a->nama_produk_vendor."</td><td><input type ='number' id = 'price".$counterId."' class = 'form-control' value = '".$harga."'></td><td><input type ='number' id = 'vendor_price_rate".$counterId."' class = 'form-control' value = '".$rate."'></td><td><input type ='number' id = 'satuan_harga_produk".$counterId."' class = 'form-control' value = '".$satuan."'></td><td><a href = '".base_url()."crm/vendor/suppliershipping/".$this->input->post("id_request_item")."/".$a->id_perusahaan."' class = 'btn btn-sm btn-outline btn-primary' >SHIPPING PRICE</a></td><td><button type = 'submit' class = 'btn btn-sm btn-primary btn-outline' onclick = 'submitData(".$counterId.")'>SAVE</button></td></tr>";
                }
            }
            else{/*nah kalau misalnya udah ada di produk vendor dan belum masukin harga vendor */
                $tracingError .= " Status:else ";
                $html .= "<tr><input type ='hidden' value = '".$this->input->post("id_request_item")."' id = 'id_request_item".$counterId."'><td>".$b->nama_perusahaan."</td><td><select class = 'form-control' id = 'cp".$counterId."'>".$cp."</select></td><td>".$b->bn_produk_vendor."</td><td>".$b->nama_produk_vendor."</td><td><input type ='number' id = 'price".$counterId."' class = 'form-control' value = '0'></td><td><input type ='number' id = 'vendor_price_rate".$counterId."' class = 'form-control' value = '0'></td><td><input type ='number' id = 'satuan_harga_produk".$counterId."' class = 'form-control' value = '0'></td><td><a href = '".base_url()."crm/vendor/suppliershipping/".$this->input->post("id_request_item")."/".$b->id_perusahaan."' class = 'btn btn-sm btn-outline btn-primary' >SHIPPING PRICE</a></td><td><button type = 'submit' class = 'btn btn-sm btn-primary btn-outline' onclick = 'submitData(".$counterId.")'>SAVE</button></td></tr>";
            }
            $counterId++;
            //echo $tracingError;
        }
        
        echo json_encode($html);
    }
    public function insertvendorprice(){
        $where = array(
            "id_request_item" =>$this->input->post("id_request_item"),
            "id_cp" => $this->input->post("idcp"),
        );
        $data = array(
            "status_harga_vendor" => 1
        );
        $this->Mdharga_vendor->delete($where);
        $data = array(
            "id_request_item" =>$this->input->post("id_request_item"),
            "id_cp" => $this->input->post("idcp"),
            "harga_produk" => $this->input->post("price"),
            "satuan_harga_produk" => $this->input->post("uom"),
            "vendor_price_rate" => $this->input->post("rate"),
            "id_user_add" => $this->session->id_user
        );
        
        $this->Mdharga_vendor->insert($data);
    }
    public function getshippingmethod(){
        $where = array(
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "status_metode_pengiriman" => 0
        );
        $result = $this->Mdmetode_pengiriman_shipping->select($where);
        $html = "<option selected disabled>Choose Shipping Method</option>";
        foreach($result->result() as $a){
            $html .= "<option value ='".$a->metode_pengiriman."'>".$a->metode_pengiriman."</option>";
        }
        echo json_encode($html);
    }
    public function getContactPerson(){
        $where = array(
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "status_cp" => 0
        );
        $result = $this->Mdcontact_person->select($where);
        $html = "<option selected disabled>Choose Shipping Vendor CP</option>";
        foreach($result->result() as $a){
            $html .= "<option value ='".$a->id_cp."'>".$a->nama_cp."</option>";
        }
        echo json_encode($html);
    }
    public function getShippingPrice(){
        $where = array(
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "metode_pengiriman" => $this->input->post("metode_pengiriman"),
            "id_request_item" => $this->input->post("id_request_item"),
            "id_supplier" => $this->session->id_supplier,
            "shipping_purpose" => $this->input->post("purpose"),
            "status_variable" => 0
        );
        $result = $this->Mdvariable_shipping_price->select($where);
        $html = "";
        foreach($result->result() as $a){
            $html .= "<tr><td>".$a->nama_variable."</td><td>".$a->biaya_variable."</td><td>".$a->kurs_variable."</td><td>".$a->biaya_variable*$a->kurs_variable."</td><td><a href = '".base_url()."crm/vendor/removevariable/".$a->id_variable_shipping."' class = 'btn btn-sm btn-primary btn-outline'>REMOVE</a></td></tr>";
        }
        echo json_encode($html);
    }
    public function getCourierPrice(){
        $where = array(
            "metode_pengiriman" => $this->input->post("metode_pengiriman"),
            "id_request_item" => $this->input->post("id_request_item"),
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "shipping_purpose" => $this->input->post("purpose"),
            "status_variable" => 0
        );
        $result = $this->Mdvariable_courier_price->select($where);
        $html = "";
        foreach($result->result() as $a){
            $html .= "<tr><td>".$a->nama_variable."</td><td>".$a->biaya_variable."</td><td>".$a->kurs_variable."</td><td>".$a->biaya_variable*$a->kurs_variable."</td><td><a href = '".base_url()."crm/vendor/removecouriervariable/".$a->id_variable_courier."' class = 'btn btn-sm btn-primary btn-outline'>REMOVE</a></td></tr>";
        }
        echo json_encode($html);
    }
    public function getitemdimension(){
        $where = array(
            "id_request_item" => $this->input->post("id_request_item")
        );
        $result = $this->Mdprice_request_item->select($where);
        foreach($result->result() as $a){
            echo json_encode($a->jumlah_produk." ".$a->satuan_produk);
        }
    }
    public function getVendors(){
        $where = array(
            "harga_vendor.id_request_item" => $this->input->post("id_request_item")
        );
        $result = $this->Mdharga_vendor->selectVendorItem($where);
        $html = "<option selected disabled>Choose Vendor</option>";
        foreach($result->result() as $a){
            $html .= "<option value = '".$a->id_cp."'>".$a->nama_perusahaan."</option>";
        }
        echo json_encode($html);
    }
    public function getVendorPrices(){
        $where = array(
            "harga_vendor.id_cp" => $this->input->post("id_perusahaan"),
            "status_harga_vendor" => 0,
            "id_request_item" => $this->session->id_request_item
        );
        $result = $this->Mdharga_vendor->countPrice($where);
        foreach($result->result() as $a){
            echo json_encode(number_format($a->total),2);
        }
    }
    public function getShippers(){
        $this->session->id_request_item = $this->input->post("id_request_item");
        $where = array(
            "variable_shipping_price.id_request_item" => $this->input->post("id_request_item")
        );
        $result = $this->Mdvariable_shipping_price->selectVendorShipping($where);
        $html = "<option selected disabled>Choose Shippers</option>";
        foreach($result->result() as $a){
            $html .= "<option value = '".$a->id_cp."-".$a->metode_pengiriman."'>".$a->nama_perusahaan." - ".$a->metode_pengiriman."</option>";
        }
        echo json_encode($html);
    }
    public function getShipperPrice(){ /*ini yang ajax di quotation*/
        $where = array(
            "variable_shipping_price.id_request_item" => $this->session->id_request_item,
            "variable_shipping_price.id_cp" => $this->input->post("id_cp"),
            "variable_shipping_price.metode_pengiriman" => $this->input->post("metode_pengiriman"),
            "status_variable" => 0
        );
        $result = $this->Mdvariable_shipping_price->countPrice($where);
        foreach($result->result() as $a){
            echo json_encode(number_format(ceil($a->total)),2);
        }
    }
    public function getCouriers(){
        $this->session->id_request_item = $this->input->post("id_request_item");
        $where = array(
            "variable_courier_price.id_request_item" => $this->input->post("id_request_item")
        );
        $result = $this->Mdvariable_courier_price->selectVendorShipping($where);
        $html = "<option selected disabled>Choose Courier</option>";
        foreach($result->result() as $a){
            $html .= "<option value = '".$a->id_cp."-".$a->metode_pengiriman."'>".$a->nama_perusahaan." - ".$a->metode_pengiriman."</option>";
        }
        echo json_encode($html);
    } 
    public function getCourierPrices(){ /*ini yang ajax di quotation*/
        $where = array(
            "variable_courier_price.id_request_item" => $this->session->id_request_item,
            "variable_courier_price.id_cp" => $this->input->post("id_cp"),
            "variable_courier_price.metode_pengiriman" => $this->input->post("metode_pengiriman"),
            "status_variable" => 0
        );
        $result = $this->Mdvariable_courier_price->countPrice($where);
        foreach($result->result() as $a){
            echo json_encode(number_format(ceil($a->total)),2);
        }
    }
    /*function*/
    public function removecouriervariable($i){
        $where = array(
            "id_variable_courier" => $i
        );
        $data = array(
            "status_variable" => 1
        );
        $this->Mdvariable_courier_price->update($data,$where);
        redirect("crm/vendor/courier/".$this->session->id_detail);
    }
    public function insertshippingdata(){
        $nama = array();
        $cost = array();
        $rate = array();

        $variablee = $this->input->post("variable");
        $biayae = $this->input->post("biaya");
        $kurse = $this->input->post("kurs");
        //echo var_dump($this->input->post("variable"));
        $count = 0;
        foreach($variablee as $a){
            $nama[$count] = $a;
            $count++;
        }
        echo "countnya = ".$count;
        $count = 0;
        foreach($biayae as $a){
            $cost[$count] = $a;
            $count++;
        }
        $count = 0;
        foreach($kurse as $a){
            $rate[$count] = $a;
            $count++;
        }
        
        for($a = 0; $a<count($cost); $a++){
            $data = array(
                "id_perusahaan" => $this->input->post("id_perusahaan"),
                "shipping_purpose" => $this->input->post("shipping_purpose"),
                "id_supplier" => $this->input->post("id_supplier"),
                "id_cp" => $this->input->post("id_cp"),
                "metode_pengiriman" => $this->input->post("metode_pengiriman"),
                "nama_variable" => $nama[$a],
                "biaya_variable" => $cost[$a],
                "kurs_variable" => $rate[$a],
                "id_request_item" => $this->input->post("items"),
                "id_user_add" => $this->session->id_user
            );
            $this->Mdvariable_shipping_price->insert($data);
        }
        redirect("crm/vendor/suppliershipping/".$this->session->id_detail."/".$this->session->id_supplier);

    }
    public function insertcouriershippingdata(){
        $nama = array();
        $cost = array();
        $rate = array();

        $variablee = $this->input->post("variable");
        $biayae = $this->input->post("biaya");
        $kurse = $this->input->post("kurs");
        //echo var_dump($this->input->post("variable"));
        $count = 0;
        foreach($variablee as $a){
            $nama[$count] = $a;
            $count++;
        }
        echo "countnya = ".$count;
        $count = 0;
        foreach($biayae as $a){
            $cost[$count] = $a;
            $count++;
        }
        $count = 0;
        foreach($kurse as $a){
            $rate[$count] = $a;
            $count++;
        }
        
        for($a = 0; $a<count($cost); $a++){
            $data = array(
                "shipping_purpose" => $this->input->post("shipping_purpose"),
                "id_perusahaan" => $this->input->post("id_perusahaan"),
                "id_cp" => $this->input->post("id_cp"),
                "metode_pengiriman" => $this->input->post("metode_pengiriman"),
                "nama_variable" => $nama[$a],
                "biaya_variable" => $cost[$a],
                "kurs_variable" => $rate[$a],
                "id_request_item" => $this->input->post("items"),
                "id_user_add" => $this->session->id_user
            );
            $this->Mdvariable_courier_price->insert($data);
        }
        redirect("crm/vendor/courier/".$this->session->id_detail);

    }
    public function removevariable($i){
        $where = array(
            "id_variable_shipping" => $i
        );
        $data = array(
            "status_variable" => 1
        );
        $this->Mdvariable_shipping_price->update($data,$where);
        redirect("crm/vendor/suppliershipping/".$this->session->id_detail."/".$this->session->id_supplier);
    }
    public function delete($i){
        $where = array(
            "price_request.id_request" => $i
        );
        $data = array(
            "price_request.status_request" => 1
        );
        $this->Mdprice_request->update($data,$where);
        redirect("crm/vendor");
    }
    public function submit($i){
        $where = array(
            "price_request.id_request" => $i
        );
        $data = array(
            "price_request.status_request" => 3
        );
        $this->Mdprice_request->update($data,$where);
        redirect("crm/vendor");
    }
}
?>