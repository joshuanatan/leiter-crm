<?php
class M_pdf_invoice extends CI_Model{
    
    function selectInvoice($where){
        return $this->db->get_where("invoice_core",$where);
    }

    function selectPerusahaan($where){
        return $this->db->query("select * from invoice_core join order_confirmation on order_confirmation.id_submit_oc=invoice_core.id_submit_oc join quotation on quotation.id_submit_quotation = order_confirmation.id_submit_quotation join price_request on price_request.id_submit_request = quotation.id_request join perusahaan on price_request.id_perusahaan= perusahaan.id_perusahaan WHERE invoice_core.id_submit_invoice=" . $where['id_submit_invoice']);
    }

    function selectBarang($where){
        return $this->db->query("select * from invoice_core join order_confirmation_item on invoice_core.id_submit_oc = order_confirmation_item.id_submit_oc where invoice_core.id_submit_invoice=". $where['id_submit_invoice']);
    }

    function selectMetodeBayar($where){
        return $this->db->get_where("order_confirmation_metode_pembayaran",$where);
    }
}
?>