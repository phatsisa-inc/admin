<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function addAdmin($data_user) {
        if ($this->db->insert('_tbl_users', $data_user)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function validate($username, $password) {
        $this->db->select('*');
        $this->db->from('_tbl_users');
        $this->db->where('usr_password', $password);
        $this->db->where('usr_phone', $username);
        $this->db->where('usr_type', 1);
        $this->db->where('usr_status', 1);
        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }

    function countOrders() {
        $query = $this->db->get_where('_tbl_orders', array('ord_status' => 4));
        $results = $query->num_rows();
        return $results;
    }

    function countCustomers() {
        $query = $this->db->get_where('_tbl_users', array('usr_type' => 3));
        $results = $query->num_rows();
        return $results;
    }

    function countDrivers() {
        $query = $this->db->get_where('_tbl_users', array('usr_type' => 2));
        $results = $query->num_rows();
        return $results;
    }

    function fetch_single_user($usr_id) {
        $data = array('usr_id' => $usr_id);
        $query = $this->db->get_where('_tbl_users', $data);
        return $query->result();
    }

    function updateUser_Password($usr_id, $data) {
        $this->db->where("usr_id", $usr_id);
        if ($this->db->update("_tbl_users", $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
