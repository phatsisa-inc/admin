<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function addOrder() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $ord_list = $this->input->post('ord_list');
            $ord_destination = $this->input->post('ord_destination');
            $cus_id = $this->input->post('cus_id');
            $ord_delivery_fee = $this->input->post('ord_delivery_fee');

            $this->form_validation->set_rules('ord_list', 'ord_list', 'required|trim');
            $this->form_validation->set_rules('ord_destination', 'ord_destination', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                echo 1;
                exit();
            } else {
                $data = $this->Order_Model->createOrdrer($ord_list, $ord_destination, $cus_id, $ord_delivery_fee);
                echo $data;
            }
        } else {
            redirect('login');
        }
    }

    public function getNewOrders() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $dvr_assigned;
            $ord_status;
            $data = "ord_status='1' OR ord_status='2'";
            $query = $this->db->get_where("_tbl_orders", $data);
            $data = [];
            foreach ($query->result() as $r) {
                if ($r->drv_id == 0) {
                    $dvr_assigned = '<a href="#" class="assignBtn" id="' . $r->ord_id . '"><i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i></a>';
                } else {
                    $dvr_assigned = '<i class="fa fa-circle text-success" aria-hidden="true"></i>';
                }
                if ($r->ord_status == 1) {
                    $ord_status = 'Initiated';
                } else {
                    $ord_status = 'Bought';
                }
                $data[] = array(
                    $r->ord_id,
                    $r->ord_create_date,
                    $ord_status,
                    $dvr_assigned,
                    '<a href="" class="mr-2 text-success ordEdit" id="' . $r->ord_id . '"><i class="fa fa-edit" aria-hidden="true"></i></a><a href="" class="mr-2 text-danger ordDelete" id="' . $r->ord_id . '"><i class="fa fa-trash" aria-hidden="true"></i></a><a href="" class="mr-2 text-info ordView" id="' . $r->ord_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>'
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

    public function getAttendedOrders() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $data = "ord_status='3'";
            $query = $this->db->get_where("_tbl_orders", $data);
            $data = [];
            foreach ($query->result() as $r) {
                $service_fee = $r->ord_service_fee + $r->ord_price;
                $data[] = array(
                    $r->ord_id,
                    $r->ord_create_date,
                    $service_fee,
                    $r->ord_delivery_fee,
                    '<a href="" class="mr-2 text-success ordView" id="' . $r->ord_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>'
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

    public function fetch_single_order() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $output = array();
            $data = $this->Order_Model->fetch_single_order($_POST['ord_id']);
            foreach ($data as $row) {
                $output['ord_id'] = $row->ord_id;
                $output['ord_list'] = $row->ord_list;
                $output['ord_price'] = $row->ord_price;
                $output['ord_create_date'] = $row->ord_create_date;
                $output['ord_status'] = $row->ord_status;
                $output['ord_destination'] = $row->ord_destination;
                $output['ord_service_fee'] = $row->ord_service_fee;
                $output['ord_delivery_fee'] = $row->ord_delivery_fee;
                $output['cus_id'] = $row->cus_id;
                $output['drv_id'] = $row->drv_id;
            }
            echo json_encode($output);
        } else {
            redirect('login');
        }
    }

    public function editOrder() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $ord_id = $this->input->post('ord_id');
            $data = array(
                'ord_list' => $this->input->post('ord_list'),
                'ord_price' => $this->input->post('ord_price'),
                'ord_status' => $this->input->post('ord_status'),
                'ord_destination' => $this->input->post('ord_destination'),
                'ord_service_fee' => $this->input->post('ord_service_fee'),
                'ord_delivery_fee' => $this->input->post('ord_delivery_fee'),
                'cus_id' => $this->input->post('cus_id'),
                'drv_id' => $this->input->post('drv_id')
            );
            if ($this->Order_Model->updateOrder($ord_id, $data)) {
                echo 'Data Edited';
            } else {
                echo 'Error Editing Data';
            }
        } else {
            redirect('login');
        }
    }

    public function delete_single_order() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $this->Order_Model->delete_single_order($_POST["ord_id"]);
            echo 'Data Deleted';
        } else {
            redirect('login');
        }
    }

    public function restore_single_order() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $this->Order_Model->restore_single_order($_POST["ord_id"]);
            echo 'Data Restored';
        } else {
            redirect('login');
        }
    }

    public function fetch_assign_drivers() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $where = "usr_type='2'";
            $query = $this->db->get_where("_tbl_users", $where);
            $data = [];
            foreach ($query->result() as $r) {
                $data[] = array(
                    '<option value="' . $r->usr_id . '">' . $r->usr_fname . ' ' . $r->usr_lname . '</option>'
                );
            }
            echo json_encode($data);
        } else {
            redirect('login');
        }
    }

    public function assignDriver() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $ord_id = $this->input->post('ord_id');
            $data = array(
                'drv_id' => $this->input->post('drv_id')
            );
            if ($this->Order_Model->assignDriver($ord_id, $data)) {
                echo 'Driver Assigned';
            } else {
                echo 'Error Assigning Driver';
            }
        } else {
            redirect('login');
        }
    }

    public function claimDriverOrders() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $usr_id = $this->input->post('user_id');
            $clm_fee = $this->input->post('tdfee');
            $data = array(
                'ord_status' => 3,
                'drv_id' => $usr_id
            );
            if ($this->Order_Model->claimOrder($data)) {
                $this->insertClaimedOrders($usr_id, $clm_fee);
                echo 'Data Edited';
            } else {
                echo 'Error Editing Data';
            }
        } else {
            redirect('login');
        }
    }

    public function insertClaimedOrders($usr_id, $tclaim) {
        $data = array(
            'clm_fee' => $tclaim,
            'drv_id' => $usr_id
        );
        $this->db->insert('_tbl_driver_claims', $data);
    }

}
