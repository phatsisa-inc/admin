<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function addDriver() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $usr_fname = $this->input->post('usr_fname');
            $usr_lname = $this->input->post('usr_lname');
            $usr_email = $this->input->post('usr_email');
            $usr_phone = $this->input->post('usr_phone');
            $usr_region = $this->input->post('usr_region');
            $usr_constituency = $this->input->post('usr_constituency');
            $usr_chiefdom = $this->input->post('usr_chiefdom');
            $usr_near_facility = $this->input->post('usr_near_facility');

            $strPassword = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-/';
            $password = substr(str_shuffle($strPassword), 0, 6);

            $this->form_validation->set_rules('usr_fname', 'usr_fname', 'required|trim');
            $this->form_validation->set_rules('usr_lname', 'usr_lname', 'required|trim');
            $this->form_validation->set_rules('usr_email', 'usr_email', 'required|trim');
            $this->form_validation->set_rules('usr_phone', 'usr_phone', 'required|trim');
            $this->form_validation->set_rules('usr_region', 'usr_region', 'required|trim');
            $this->form_validation->set_rules('usr_constituency', 'usr_constituency', 'required|trim');
            $this->form_validation->set_rules('usr_chiefdom', 'usr_chiefdom', 'required|trim');
            $this->form_validation->set_rules('usr_near_facility', 'usr_near_facility', 'required|trim');
            $data_user = array(
                'usr_username' => $usr_phone,
                'usr_fname' => $usr_fname,
                'usr_lname' => $usr_lname,
                'usr_email' => $usr_email,
                'usr_phone' => $usr_phone,
                'usr_password' => $password,
                'usr_type' => 2,
                'usr_status' => 1,
                'usr_region' => $usr_region,
                'usr_constituency' => $usr_constituency,
                'usr_chiefdom' => $usr_chiefdom,
                'usr_near_facility' => $usr_near_facility);

            if ($this->form_validation->run() === FALSE) {
                redirect('driver');
            } else {
                if ($this->Driver_Model->addDriver($data_user)) {
                    echo 'Data Inserted';
                } else {
                    echo 'Error Inserting Data';
                }
            }
        } else {
            redirect('login');
        }
    }

    public function getDrivers() {

        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $user_status;
            $query = $this->db->get_where('_tbl_users', array('usr_type' => 2));
            $data = [];
            foreach ($query->result() as $r) {
                if ($r->usr_status == 1) {
                    $user_status = '<i class="fa fa-circle text-success" aria-hidden="true"></i>';
                } else {
                    $user_status = '<i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i>';
                }
                $data[] = array(
                    $r->usr_id,
                    $r->usr_fname . ' ' . $r->usr_lname,
                    '<a href="" id="' . $r->usr_email . '" class="mr-3 text-dark viewEmail"><i class="fa fa-envelope" aria-hidden="true"></i></a><a href="" id="' . $r->usr_phone . '" class="text-danger viewPhone"><i class="fa fa-phone" aria-hidden="true"></i></a>',
                    $user_status,
                    '<a href="" class="mr-2 text-success dvrEdit" name="dvrEdit" id="' . $r->usr_id . '"><i class="fa fa-edit" aria-hidden="true"></i></a><a href="" class="mr-2 text-danger dvrDelete" name="dvrDelete" id="' . $r->usr_id . '"><i class="fa fa-trash" aria-hidden="true"></i></a><a href="" class="mr-2 text-info dvrView" name="dvrView" id="' . $r->usr_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>'
                );
            }

            $result = array(
                "draw" => $draw,
                "recordsTotal" => $query->num_rows(),
                "recordsFiltered" => $query->num_rows(),
                "data" => $data
            );
            echo json_encode($result);
            exit();
        } else {
            redirect('login');
        }
    }

    public function getDriverClaims() {

        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $user_status;
            $query = $this->db->get_where('_tbl_users', array('usr_type' => 2));
            $data = [];
            foreach ($query->result() as $r) {
                if ($r->usr_status == 1) {
                    $user_status = '<i class="fa fa-circle text-success" aria-hidden="true"></i>';
                } else {
                    $user_status = '<i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i>';
                }
                $data[] = array(
                    $r->usr_id,
                    $r->usr_fname . ' ' . $r->usr_lname,
                    '<a id="' . $r->usr_email . '" class="mr-3 text-dark viewEmail"><i class="fa fa-envelope" aria-hidden="true"></i></a><a id="' . $r->usr_phone . '" class="text-danger viewPhone"><i class="fa fa-phone" aria-hidden="true"></i></a>',
                    $user_status,
                    '<a class="btn btn-sm btn-info mr-2 viewClaims" name="viewClaims" id="' . $r->usr_id . '">View Claim</a>'
                );
            }

            $result = array(
                "draw" => $draw,
                "recordsTotal" => $query->num_rows(),
                "recordsFiltered" => $query->num_rows(),
                "data" => $data
            );
            echo json_encode($result);
            exit();
        } else {
            redirect('login');
        }
    }

    public function getClaims() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $usr_id = $this->input->post('drv_id');
            $query = $this->db->get_where('_tbl_orders', array('drv_id' => $usr_id, 'ord_status' => 3));
            $total_ofee = 0;
            $total_dfee = 0;
            echo '<div class="modal-header"><h4 class="modal-title">Driver Claims</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>';
            echo '<div  class="modal-body"></p><table class="table table-striped table-bordered" style="width:100%"><thead><tr><th>ID</th><th>DATE</th><th>ORDER</th><th>DELIVERY</th></tr></thead><tbody>';
            foreach ($query->result() as $r) {
                echo '<tr><td>' . $r->ord_id . '</td><td>' . $r->ord_create_date . '</td><td>' . $r->ord_price . '</td><td>' . $r->ord_delivery_fee . '</td></tr>';
                $total_ofee = $total_ofee + $r->ord_price;
                $total_dfee = $total_dfee + $r->ord_delivery_fee;
            }
            echo '<tr><td colspan="2">TOTAL</td><td>' . $total_ofee . '</td><td>' . $total_dfee . '</td></tr>';
            echo '</tbody></table></div>';
            echo '<div class="modal-footer"><input id="totalDFee" type="hidden" value="' . ($total_dfee * 0.8) . '"/><button class="btn btn-danger" type="button" data-dismiss="modal">Close</button><button id="' . $usr_id . '" name="claimBtn" class="btn btn-info claimBtn" type="button" >Claim Orders</button></div>';
        } else {
            redirect('login');
        }
    }

    public function editDriver() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {

            $user_id = $this->input->post('user_id');
            $data = array(
                'usr_username' => $this->input->post('user_phone'),
                'usr_fname' => $this->input->post('user_fname'),
                'usr_lname' => $this->input->post('user_lname'),
                'usr_email' => $this->input->post('user_email'),
                'usr_phone' => $this->input->post('user_phone'),
                'usr_password' => $this->input->post('user_password'),
                'usr_type' => 2,
                'usr_status' => $this->input->post('user_status'),
                'usr_region' => $this->input->post('user_region'),
                'usr_constituency' => $this->input->post('user_constituency'),
                'usr_chiefdom' => $this->input->post('user_chiefdom'),
                'usr_near_facility' => $this->input->post('user_near_facility')
            );

            if ($this->Driver_Model->updateDriver($user_id, $data)) {
                echo 'Data Edited';
            } else {
                echo 'Error Editing Data';
            }
        } else {
            redirect('login');
        }
    }

    function fetch_single_driver() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $output = array();
            $data = $this->Driver_Model->fetch_single_driver($_POST['user_id']);
            foreach ($data as $row) {
                $output['usr_id'] = $row->usr_id;
                $output['usr_fname'] = $row->usr_fname;
                $output['usr_lname'] = $row->usr_lname;
                $output['usr_email'] = $row->usr_email;
                $output['usr_phone'] = $row->usr_phone;
                $output['usr_status'] = $row->usr_status;
                $output['usr_password'] = $row->usr_password;
                $output['usr_constituency'] = $row->usr_constituency;
                $output['usr_chiefdom'] = $row->usr_chiefdom;
                $output['usr_near_facility'] = $row->usr_near_facility;
                $output['usr_region'] = $row->usr_region;
            }
            echo json_encode($output);
        } else {
            redirect('login');
        }
    }

    public function delete_single_driver() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $user_id = $this->input->post('user_id');
            echo $user_id;
//            if ($this->Driver_Model->delete_single_driver($user_id)) {
//                echo 'Data Deleted';
//            } else {
//                echo 'Error Deleting Data';
//            }
        } else {
            redirect('login');
        }
    }

}
