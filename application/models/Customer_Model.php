<?php

class Customer_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function addCustomer($data_user) {
        if ($this->db->insert('_tbl_users', $data_user)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getCustomer($cus_phone) {
        $query = $this->db->get_where('_tbl_users', array('usr_phone' => $cus_phone, 'usr_type' => 3));
        return $query->result();
    }

    function fetch_single_customer($usr_id) {
        $this->db->where("usr_id", $usr_id);
        $query = $this->db->get('_tbl_users');
        return $query->result();
    }

    function updateCustomer($user_id, $data) {
        $this->db->where("usr_id", $user_id);
        if ($this->db->update("_tbl_users", $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_single_customer($user_id) {
        $this->db->where("usr_id", $user_id);
        if ($this->db->delete("_tbl_users")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
