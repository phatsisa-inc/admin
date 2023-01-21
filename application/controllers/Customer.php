<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function addCustomer() {
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
                'usr_type' => 3,
                'usr_status' => 1,
                'usr_region' => $usr_region,
                'usr_constituency' => $usr_constituency,
                'usr_chiefdom' => $usr_chiefdom,
                'usr_near_facility' => $usr_near_facility);

            if ($this->form_validation->run() === FALSE) {
                redirect('customer');
                echo 0;
            } else {
                if ($this->Customer_Model->addCustomer($data_user)) {
                    echo 'Data Inserted';
                } else {
                    echo 'Error Inserting Data';
                }
            }
        } else {
            redirect('login');
        }
    }

    function findCustomer() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $cus_phone = $this->input->post('cus_phone');
            if (!isset($cus_phone) || $cus_phone == '' || $cus_phone == 'undefined') {
                echo 2;
                exit();
            }
            $this->form_validation->set_rules('cus_phone', 'cus_phone', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo 3;
                exit();
            } else {
                $data = $this->Customer_Model->getCustomer($cus_phone);
                if (count($data) == 1) {
                    foreach ($data as $row) {
                        echo '<div class="form-group"><label>Customer Fullname*</label><input id="cus_id" type="hidden" value="' . $row->usr_id . '" /><input type="text" placeholder="' . $row->usr_fname . ' ' . $row->usr_lname . '" class="form-control" disabled/></div>';
                        echo '<div class="form-group"><label>Order List*</label><textarea name="ord_list" id="ord_list" type="text" rows="10" class="form-control"></textarea></div>';
                        echo '<div class="form-group"><label>Order Destination*</label><input name="ord_destination" id="ord_destination" type="text" class="form-control"/></div>';
                        echo '<div class="form-group"><label>Delivery Fee*</label><input name="ord_delivery_fee" id="ord_delivery_fee" type="number" class="form-control"/></div>';
                    }
                } else {
                    echo '<label class="text-danger">Customer not found. Click below to add new customer!!</label><a href="' . base_url('customer') . '" class="btn btn-info form-control">Add New Customer</a>';
                }
            }
        } else {
            redirect('login');
        }
    }

    function getCustomers() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $user_status;

            $query = $this->db->get_where('_tbl_users', array('usr_type' => 3));
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
                    '<a href="" id="' . $r->usr_email . '" class="mr-3 text-dark viewEmail"><i class="fa fa-envelope" aria-hidden="true"></i></a><a href="" id="' . $r->usr_phone . '" class="text-danger viewPhone" ><i class="fa fa-phone" aria-hidden="true"></i></a>',
                    $user_status,
                    '<a href="" class="mr-2 text-success cusEdit"  name="cusEdit" id="' . $r->usr_id . '"><i class="fa fa-edit" aria-hidden="true"></i></a><a href="" class="mr-2 text-danger cusDelete" name="cusDelete" id="' . $r->usr_id . '"><i class="fa fa-trash" aria-hidden="true"></i></a><a href="" class="mr-2 text-info cusView" name="cusView" id="' . $r->usr_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>'
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

    function fetch_single_customer() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $output = array();
            $data = $this->Customer_Model->fetch_single_customer($_POST['user_id']);
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

    function editCustomer() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $user_id = $this->input->post('user_id');
            $data = array(
                'usr_username' => $this->input->post('user_phone'),
                'usr_fname' => $this->input->post('user_fname'),
                'usr_lname' => $this->input->post('user_lname'),
                'usr_email' => $this->input->post('user_email'),
                'usr_phone' => $this->input->post('user_phone'),
                'usr_password' => $this->input->post('user_password'),
                'usr_type' => 3,
                'usr_status' => $this->input->post('user_status'),
                'usr_region' => $this->input->post('user_region'),
                'usr_constituency' => $this->input->post('user_constituency'),
                'usr_chiefdom' => $this->input->post('user_chiefdom'),
                'usr_near_facility' => $this->input->post('user_near_facility')
            );
            if ($this->Customer_Model->updateCustomer($user_id, $data)) {
                echo 'Data Edited';
            } else {
                echo 'Error Editing Data';
            }
        } else {
            redirect('login');
        }
    }

    function delete_single_customer() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $user_id = $this->input->post('user_id');
            if ($this->Customer_Model->delete_single_customer($user_id)) {
                echo 'Data Deleted';
            } else {
                echo 'Error Deleting Data!';
                echo $user_id;
            }
        } else {
            redirect('login');
        }
    }

}
