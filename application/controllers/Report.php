<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
public function addAdmin() {
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
                'usr_type' => 1,
                'usr_status' => 1,
                'usr_region' => $usr_region,
                'usr_constituency' => $usr_constituency,
                'usr_chiefdom' => $usr_chiefdom,
                'usr_near_facility' => $usr_near_facility);

            if ($this->form_validation->run() === FALSE) {
                redirect('customer');
                echo 0;
            } else {
                if ($this->User_Model->addAdmin($data_user)) {
                    echo 'Data Inserted';
                } else {
                    echo 'Error Inserting Data';
                }
            }
        } else {
            redirect('login');
        }
    }
    public function getUnclaimedOrders() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));

            $query = $this->db->get_where('_tbl_orders', array('ord_status' => 3));
            $data = [];
            foreach ($query->result() as $r) {

                $data[] = array(
                    $r->ord_id,
                    $r->ord_create_date,
                    $r->ord_price,
                    $r->ord_service_fee,
                    $r->ord_delivery_fee
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

    public function exportUnclaimedOrders() {
        /* file name */
        $filename = 'unclaimedorders_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        /* get data */
        $usersData = $this->Report_Model->fetchUnclaimedOrders();
        /* file creation */
        $file = fopen('php://output', 'w');

        $header = array("ORDER ID", "ORDER CREATE DATE", "ORDER PRICE", "SERVICE FEE", "DELIVERY FEE");
        fputcsv($file, $header);
        foreach ($usersData as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }

    public function getClaimedOrders() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));

            $query = $this->db->get_where('_tbl_orders', array('ord_status' => 4));
            $data = [];
            foreach ($query->result() as $r) {

                $data[] = array(
                    $r->ord_id,
                    $r->ord_create_date,
                    $r->ord_price,
                    $r->ord_service_fee,
                    $r->ord_delivery_fee
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

    public function exportClaimedOrders() {
        /* file name */
        $filename = 'claimedorders_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        /* get data */
        $usersData = $this->Report_Model->fetchClaimedOrders();
        /* file creation */
        $file = fopen('php://output', 'w');

        $header = array("ORDER ID", "ORDER CREATE DATE", "ORDER PRICE", "SERVICE FEE", "DELIVERY FEE");
        fputcsv($file, $header);
        foreach ($usersData as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }

    public function getDeletedOrders() {
        if (isset($_SESSION['is_session_on']['usr_id'])) {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));

            $query = $this->db->get('_tbl_deleted_orders');
            $data = [];
            foreach ($query->result() as $r) {

                $data[] = array(
                    $r->ord_id,
                    $r->ord_create_date,
                    $r->ord_price,
                    $r->ord_delivery_fee,
                    '<a  class="btn btn-warning restoreBtn" name="restoreBtn" id="' . $r->ord_id . '">Restore <i class="fa fa-undo" aria-hidden="true"></i></a>'
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

    public function exportDeletedOrders() {
        /* file name */
        $filename = 'deletedorders_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        /* get data */
        $usersData = $this->Report_Model->fetchDeletedOrders();
        /* file creation */
        $file = fopen('php://output', 'w');

        $header = array("ORDER ID", "ORDER CREATE DATE", "ORDER PRICE", "SERVICE FEE", "DELIVERY FEE");
        
        fputcsv($file, $header);
        foreach ($usersData as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }

}
