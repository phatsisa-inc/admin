<?php

class Report_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function fetchClaimedOrders() {
        $this->db->select('ord_id,ord_create_date,ord_price,ord_service_fee,ord_delivery_fee');
        $query = $this->db->get_where('_tbl_orders', array('ord_status' => 4));
        $response = $query->result_array();
        return $response;
    }

    public function fetchUnclaimedOrders() {
        $this->db->select('ord_id,ord_create_date,ord_price,ord_service_fee,ord_delivery_fee');
        $query = $this->db->get_where('_tbl_orders', array('ord_status' => 3));
        $response = $query->result_array();
        return $response;
    }

    public function fetchDeletedOrders() {
        $this->db->select('ord_id,ord_create_date,ord_price,ord_service_fee,ord_delivery_fee');
        $query = $this->db->get('_tbl_deleted_orders');
        $response = $query->result_array();
        return $response;
    }

}
