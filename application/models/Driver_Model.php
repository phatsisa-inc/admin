<?php

class Driver_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function addDriver($data_user) {
        if ($this->db->insert('_tbl_users', $data_user)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function fetch_single_driver($usr_id) {
        $this->db->where("usr_id", $usr_id);
        $query = $this->db->get('_tbl_users');
        return $query->result();
    }

    function updateDriver($user_id, $data) {
        $this->db->where("usr_id", $user_id);
        if ($this->db->update("_tbl_users", $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function delete_single_driver($user_id) {
        $this->db->where("usr_id", $user_id);
        if ($this->db->delete("_tbl_users")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
