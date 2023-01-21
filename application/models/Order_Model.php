<?php

class Order_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function createOrdrer($ord_list, $ord_destination, $cus_id, $ord_delivery_fee) {
        $data = array(
            'ord_list' => $ord_list,
            'ord_price' => 0,
            'ord_status' => 1,
            'ord_destination' => $ord_destination,
            'ord_service_fee' => 10,
            'ord_delivery_fee' => $ord_delivery_fee,
            'cus_id' => $cus_id,
            'drv_id' => 0,
            'adm_id' => $_SESSION['is_session_on']['usr_id']
        );
        if ($this->db->insert('_tbl_orders', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getNewOrders() {
        $query = $this->db->get("_tbl_orders");
        $query->result();
    }

    public function fetch_single_order($ord_id) {
        $this->db->where("ord_id", $ord_id);
        $query = $this->db->get('_tbl_orders');
        return $query->result();
    }

    public function updateOrder($ord_id, $data) {
        $this->db->where("ord_id", $ord_id);
        if ($this->db->update("_tbl_orders", $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_single_order($ord_id) {
        $this->db->where("ord_id", $ord_id);
        $this->db->delete("_tbl_orders");
    }

    public function restore_single_order($ord_id) {
        $this->db->where("ord_id", $ord_id);
        $this->db->delete("_tbl_deleted_orders");
    }

    public function assignDriver($ord_id, $data) {
        $this->db->where("ord_id", $ord_id);
        if ($this->db->update("_tbl_orders", $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function claimOrder($data) {
        $data_array = array(
            'ord_status' => 4,
        );
        $this->db->where($data);
        if ($this->db->update("_tbl_orders", $data_array)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
